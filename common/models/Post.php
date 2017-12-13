<?php
namespace common\models;

use Yii;
use yii\helpers\Html;
use common\models\Tag;
use common\models\Comment;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 * @property string $author_id
 *
 * @property Comment[] $comments
 */
class Post extends \yii\db\ActiveRecord
{
    
    const STATUS_DRAFT=1;
    const STATUS_PUBLISHED=2;
    const STATUS_ARCHIVED=3;
    
    private $_oldTags;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status', 'author_id'], 'required'],
            [['content', 'tags'], 'string'],
            [['status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['author_id'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'status' => '状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
            'author_id' => '作者',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id',])
         ->where('status = '.Comment::STATUS_APPROVED)
         ->orderBy('id');
        ;
    }


    /**
     * @return number of comments
     */
    public function getCommentCount()
    {
        return Comment::find()->where(['post_id' => $this->id,'status' => Comment::STATUS_APPROVED])->count();
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
    
    

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(
            ['post/detail','id'=>$this->id,'title'=>$this->title]
        );
    }
    
    
    
    /**
     * @return array a list of links that point to the post list filtered by every tag of this post
     */
    public function getTagLinks()
    {
        $links=[];
        foreach (Tag::string2array($this->tags) as $tag) {
            $links[]=Html::a(Html::encode($tag), ['post/home', 'PostSearch[tags]'=>$tag]);
        }
        return $links;
    }
    

    
    /**
     * Normalizes the user-entered tags.
     */
    public function normalizeTags($attribute, $params)
    {
        $this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
    }
    
    
    /**
     * Adds a new comment to this post.
     * This method will set status and post_id of the comment accordingly.
     * @param Comment the comment to be added
     * @return boolean whether the comment is saved successfully
     */
    public function addComment($comment)
    {
        if (Yii::$app->params['commentNeedApproval']) {
            $comment->status=Comment::STATUS_PENDING;
        } else {
            $comment->status=Comment::STATUS_APPROVED;
        }
            
            $comment->post_id=$this->id;
            
            return $comment->save();
    }
    
    
    
    /**
     * This is invoked when a record is populated with data from a find() call.
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags=$this->tags;
    }
    
    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->create_time = Yii::$app->formatter->asDate(time(), 'php:Y-m-d H:i:s');
            }
            $this->update_time = Yii::$app->formatter->asDate(time(), 'php:Y-m-d H:i:s');
            return true;
        }
        return false;
    }


    /**
     * This is invoked after the record is saved.
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Tag::updateFrequency($this->_oldTags, $this->tags);
    }
    
    /**
     * This is invoked after the record is deleted.
     */
    public function afterDelete()
    {
        parent::afterDelete();
        Comment::deleteAll('post_id = :post_id', [':post_id' => $this->id]);
        Tag::updateFrequency($this->tags, '');
    }
}
