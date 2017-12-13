#! /bin/bash
# backup mysql database;

/opt/lampp/bin/mysqldump --user=litianci --password="litianci" db_wuzhishan > /opt/lampp/htdocs/www/wuzhishan/data/schema/db_wuzhishan$(date +%Y%m%d%H%M%S).sql
