#! /bin/bash
# remove old mysql backup files
# it run every year at the begin of the this year

# 查找 3650 天之前创建的文档，然后把他们全部删除
find /opt/lampp/htdocs/www/wuzhishan/data/schema/* -ctime +3650 -exec rm {} -f \;
