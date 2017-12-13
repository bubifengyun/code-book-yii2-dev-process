<?php
namespace common\models;

use Yii;
use Overtrue\Pinyin\Pinyin;

/**
 * could be used every where.
 *
 */

class PublicFunction
{
    /**
     * 时间格式为多少年或者多少月多少天之前。
     * url:http://blog.csdn.net/china_skag/article/details/37569505
     * @param $exactStringTime 标准时间格式,比如1990-01-01 12:12:12
     * @return string
     */
    public static function timeBeforeFormate($exactStringTime)
    {
        $time = strtotime($exactStringTime);
        $now = time();
        $timeDiff = $now - $time;

        $formate = [
            '31536000'=>'年',
            '2592000'=>'个月',
            '604800'=>'星期',
            '86400'=>'天',
            '3600'=>'小时',
            '60'=>'分钟',
        ];
        foreach ($formate as $key => $value) {
            $count = floor($timeDiff / (int)$key);
            if (0 != $count) {
                return $count . $value . '前';
            }
        }
        return $timeDiff . '秒前';
    }

    public static function twoYears()
    {
        $lastyear = date('Y', strtotime('-1 year'));
        $thisyear = date('Y');
        
        return [
            $lastyear => $lastyear,
            $thisyear => $thisyear,
        ];
    }

    public static function addSpaceToArray($filterArray)
    {
        $lastkey = implode(',', array_keys($filterArray));
        return array_merge($filterArray, [$lastkey=>'']);
    }

    /**
     * @url
     * @return string IP
     */
    public static function getClientIp()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $client_ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $client_ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR')) {
            $client_ip = getenv('REMOTE_ADDR');
        } else {
            $client_ip = $_SERVER['REMOTE_ADDR'];
        }
        return $client_ip;
    }

    public static function getSessionIP()
    {
        return Yii::$app->session->get('client_local_ip', 0);
    }

    /**
     * sort params in attributes by Pinyin
     * @params $params attribute name, as array
     */
    public static function sortByPinyin($dataProvider, $params)
    {
        $sorts = $dataProvider->getSort();
        foreach ($params as $param) {
            $sorts->attributes[$param] = [
                'asc' => ["CONVERT($param USING gbk)" => SORT_ASC],
                'desc' => ["CONVERT($param USING gbk)" => SORT_DESC],
            ];
        }
        $dataProvider->setSort($sorts);
    }

    public static function pinyin($name)
    {
        $pinyin = new Pinyin();
        return $pinyin->name($name);
    }

    public static function readBackup($frequency)
    {
        if ($frequency != 'hour' && $frequency != 'day') {
            echo "The frequency must be 'day' or 'hour'!\n";
            return -2;
        }

        $dir = Yii::$app->setting->get('dir_where2read');
        $coinfo = $dir . 'co.info.' . $frequency;

        if (!file_exists($coinfo)) {
            echo "Sorry, there is no $coinfo, or daemon(user) is not permitted";
            return -1;
        }

        $array_coinfo = unserialize(
            file_get_contents($coinfo)
        );

        $now = date('Y-m-d H:i:s');
        if ($frequency == 'hour') {
            $current_update_time = $array_coinfo['manage_person_record']['check_time'];
        } else {
            $current_update_time = $array_coinfo['sys_user']['check_time'];
        }
        $cut = date('Y-m-d H:i:s', strtotime($current_update_time));
        Yii::$app->setting->set(['current_update_time' => $cut]);

        $data = [];
        foreach ($array_coinfo as $key => $info) {
            if ($info['need_update']) {
                $data[$key] = unserialize(
                    file_get_contents(
                        $dir . $key . '.' .
                        $info['which_read']
                    )
                );
            }
        }

        // 下面处理是有序的，考虑了依赖。
        if (!empty($data['sys_organization'])) {
            Unit::deleteAll();
            $units = [];
            foreach ($data['sys_organization'] as $org) {
                $unit = new Unit();
                $unit->old_id = $org['code'];
                $unit->id = $org['code'];
                $unit->name = $org['full_name'];
                $unit->short_name = $org['short_name'];
                $units[$org['code']] = $unit;
            }

            foreach ($data['sys_organization'] as $org) {
                if ($org['parent '] == null || $org['parent'] == '') {
                    $units[$org['code']]->makeRoot();
                } elseif (!empty($units[$org['parent']])) {
                    $units[$org['code']]->appendTo(
                        $units[$org['parent']]
                    );
                }
            }

            $transaction = Yii::$app->db->beginTransaction();
            foreach ($units as $unit) {
                $unit->save();
            }
            $transaction->commit();
            echo "Unit had been updated successfully!\n";
            $array_coinfo['sys_organization']['read_time'] = $now;
            $array_coinfo['sys_organization']['need_update'] = false;
        }

        if (!empty($data['sys_user_post'])) {
            UserPost::deleteAll();

            $transaction = Yii::$app->db->beginTransaction();
            foreach ($data['sys_user_post'] as $post) {
                $user_post = new UserPost;
                $user_post->id = $post['id'];
                $user_post->type = $post['type'];
                $user_post->name = $post['name'];
                $user_post->org = $post['org'];

                $user_post->save();
            }
            $transaction->commit();
            echo "User Post had been updated successfully!\n";
            $array_coinfo['sys_user_post']['read_time'] = $now;
            $array_coinfo['sys_user_post']['need_update'] = false;
        }

        if (!empty($data['sys_user_type'])) {
            UserType::deleteAll();

            $transaction = Yii::$app->db->beginTransaction();
            foreach ($data['sys_user_type'] as $type) {
                $user_type = new UserType;
                $user_type->id = $type['id'];
                $user_type->name = $type['name'];

                $user_type->save();
            }
            $transaction->commit();
            echo "User Type had been updated successfully!\n";
            $array_coinfo['sys_user_type']['read_time'] = $now;
            $array_coinfo['sys_user_type']['need_update'] = false;
        }

        if (!empty($data['sys_user'])) {
            if (empty($data['sys_user_type'])) {
                $data['sys_user_type'] =
                    UserType::find()
                    ->where(1)
                    ->orderBy('id')
                    ->asArray()
                    ->all();
            }
            if (empty($data['sys_user_post'])) {
                $data['sys_user_post'] =
                    UserType::find()
                    ->where(1)
                    ->orderBy('id')
                    ->asArray()
                    ->all();
            }

            $upload_user = $data['sys_user'];
            $tag = $array_coinfo['sys_user']['which_read'];
            if ($tag == 'A') {
                $old_tag = 'B';
            } else {
                $old_tag = 'A';
            }

            $old_sys_user_file = $dir . 'sys_user.' . $old_tag;
            if (!file_exists($old_sys_user_file)) {
                $in_use_user = [];
            } else {
                $in_use_user = unserialize(
                    file_get_contents($old_sys_user_file)
                );
            }

            $upload_user_ids = array_keys($upload_user);
            $in_use_user_ids = array_keys($in_use_user);

            $may_udpate = array_intersect(
                $upload_user_ids,
                $in_use_user_ids
            );
            $update = [];
            foreach ($may_udpate as $id) {
                if ($upload_user[$id] != $in_use_user[$id]) {
                    $update[] = $id;
                }
            }

            $import = array_diff($upload_user_ids, $in_use_user_ids);
            $bye = array_diff($in_use_user_ids, $upload_user_ids);

            Personinfo::updateFromMSSQL($upload_user, $update);
            Personinfo::saveFromMSSQL($upload_user, $import);
            Personinfo::bye($bye);

            echo "User had been updated successfully!\n";
            $array_coinfo['sys_user']['read_time'] = $now;
            $array_coinfo['sys_user']['need_update'] = false;
        }

        if (!empty($data['manage_person_apply_type'])) {
            /*
            PersonApplyType::deleteAll();

            $transaction = Yii::$app->db->beginTransaction();
            foreach ($data['manage_person_apply_type'] as $type) {
                $pa_type = new PersonApplyType;
                $pa_type->id = $type['id'];
                $pa_type->name = $type['name'];
                $pa_type->local = $type['local'];

                $pa_type->save();
            }
            $transaction->commit();
             */
        }

        if (!empty($data['manage_person_apply'])) {
            // 假设全是有效的申请，无效申请不备份

            $upload_apply = $data['manage_person_apply'];
            $tag = $array_coinfo['manage_person_apply']['which_read'];
            if ($tag == 'A') {
                $old_tag = 'B';
            } else {
                $old_tag = 'A';
            }

            $old_person_apply_file = $dir . 'manage_person_apply.' . $old_tag;
            if (!file_exists($old_person_apply_file)) {
                $in_use_apply = [];
            } else {
                $in_use_apply = unserialize(
                    file_get_contents($old_person_apply_file)
                );
            }

            $upload_apply_ids = array_keys($upload_apply);
            $in_use_apply_ids = array_keys($in_use_apply);

            $may_udpate = array_intersect(
                $upload_apply_ids,
                $in_use_apply_ids
            );
            $update = [];
            foreach ($may_udpate as $id) {
                if ($upload_apply[$id] != $in_use_apply[$id]) {
                    $update[] = $id;
                }
            }

            $import = array_diff($upload_apply_ids, $in_use_apply_ids);
            //$bye = array_diff($in_use_apply_ids, $upload_apply_ids);

            PublicFunction::processApply($upload_apply, $update, true);
            PublicFunction::processApply($upload_apply, $import, false);

            StatisticsHoliday::cronDayCheckHoliday();

            echo "Person Apply had been updated successfully!\n";
            $array_coinfo['manage_person_apply']['read_time'] = $now;
            $array_coinfo['manage_person_apply']['need_update'] = false;
        }

        if (!empty($data['manage_person_record'])) {
            $upload_record = $data['manage_person_record'];
            $tag = $array_coinfo['manage_person_record']['which_read'];
            if ($tag == 'A') {
                $old_tag = 'B';
            } else {
                $old_tag = 'A';
            }

            $old_person_record_file = $dir . 'manage_person_record.' . $old_tag;
            if (!file_exists($old_person_record_file)) {
                $in_use_record = [];
            } else {
                $in_use_record = unserialize(
                    file_get_contents($old_person_record_file)
                );
            }

            $upload_record_ids = array_keys($upload_record);
            $in_use_record_ids = array_keys($in_use_record);

            $may_udpate = array_intersect(
                $upload_record_ids,
                $in_use_record_ids
            );
            $update = [];
            foreach ($may_udpate as $id) {
                if ($upload_record[$id] != $in_use_record[$id]) {
                    $update[] = $id;
                }
            }

            $import = array_diff($upload_record_ids, $in_use_record_ids);
            //$bye = array_diff($in_use_record_ids, $upload_record_ids);

            PublicFunction::processRecord($upload_record, $update, true);
            PublicFunction::processRecord($upload_record, $import, false);

            echo "Person Record had been updated successfully!\n";
            $array_coinfo['manage_person_record']['read_time'] = $now;
            $array_coinfo['manage_person_record']['need_update'] = false;
        }

        file_put_contents(
            $coinfo,
            serialize($array_coinfo)
        );
        return 0;
    }

    /**
     * 获得所有的人员数据，根据需要更新或者插入的类型，
     * 记录数据到 tbl_gate
     * 人员状态的改变
     *
     * 假设所有的记录都是有效的，不是无效的。也就是说
     * enable = true;
     */
    public static function processRecord($records, $ids, $isUpdate = true)
    {
        if ($isUpdate) {
            $transaction = Yii::$app->db->beginTransaction();
            foreach ($ids as $id) {
                $gate = Gate::findOne($id);
                $gate->person_id = $records[$id]['uid'];
                $gate->leave_time = $records[$id]['out_time'];
                $gate->leave_sentry = $records[$id]['out_mid'];
                $gate->leave_host = '未知';
                $gate->come_time = $records[$id]['in_time'];
                $gate->come_sentry = $records[$id]['in_mid'];
                $gate->come_host = '未知';
                $gate->type = 0;
                $gate->save();
            }
            $transaction->commit();
        } else {
            $transaction = Yii::$app->db->beginTransaction();
            foreach ($ids as $id) {
                $gate = new Gate;
                $gate->id = $id;
                $gate->person_id = $records[$id]['uid'];
                $gate->leave_time = $records[$id]['out_time'];
                $gate->leave_sentry = $records[$id]['out_mid'];
                $gate->leave_host = '未知';
                $gate->come_time = $records[$id]['in_time'];
                $gate->come_sentry = $records[$id]['in_mid'];
                $gate->come_host = '未知';
                $gate->type = 0;
                $gate->save();
            }
            $transaction->commit();
        }

        foreach ($ids as $id) {
            $record = $records[$id];
            $pa = PersonApply::findOne($record['apply']);
            if ($pa == null) {
                continue;
            }

            $person = Personinfo::findOne($record['uid']);
            if ($person == null) {
                continue;
            }

            if ($record['in_time']!= null) {
                $person->setStatus(Status::HERE);
            } else {
                $person->setStatus($pa->apply_type);
            }
        }
    }

    public static function processApply($applys, $ids, $isUpdate)
    {
        // save personapply for "if no apply for record"
        if ($isUpdate) {
            $transaction = Yii::$app->db->beginTransaction();
            foreach ($ids as $id) {
                $pa = PersonApply::findOne($id);
                $pa->apply_type = $applys[$id]['apply_type'];
                $pa->save();
            }
            $transaction->commit();
        } else {
            $transaction = Yii::$app->db->beginTransaction();
            foreach ($ids as $id) {
                $pa = new PersonApply;
                $pa->id = $id;
                $pa->apply_type = $applys[$id]['apply_type'];
                $pa->save();
            }
            $transaction->commit();
        }

        $transaction = Yii::$app->db->beginTransaction();
        foreach ($ids as $id) {
            $apply = $applys[$id];
            $person_id = $apply['uid'];
            if (Personinfo::findOne($person_id) == null) {
                continue;
            }
            $status = Status::findOne($apply['apply_type']);
            $is_completed_holiday =
                ($apply['end_time'] != null) &&
                ($status->officer & Status::OFFICER);

            if ($is_completed_holiday) {
                $holiday = new Holiday;
                $holiday->tel = '（尚未设置）';
                $holiday->id = $apply['uid'];
                $holiday->date_leave = date('Y-m-d', strtotime($apply['start_time']));
                $holiday->date_cancel = date('Y-m-d', strtotime($apply['end_time']));
                $holiday->which_year = date('Y', strtotime($holiday->date_leave));

                $holiday->where_leave = $apply['dest'];
                $holiday->ps = $apply['comments'];
                $holiday->boss_id = $apply['approve_uid'];
                $holiday->kind = $apply['apply_type'];
                if (!$holiday->save()) {
                    var_dump($holiday->getErrors());
                }
            }
        }
        $transaction->commit();
    }
}
