<?php
define("LIB_ROOT", dirname(__FILE__));
define("LIB_HROOT", "/lib");
//����� ����� ����� �� ���������� ������� ���� ������
define("LIB_CACHE_TIMEOFLIFE", 100*24*3600);
define("LIB_DEFAULT_RECORDSET_LIMIT", 10);
define("LIB_DEFAULT_RECORDSET_ITEM_PER_PAGING", 12);
define("LIB_UPLOAD_IMAGE_FOLDER", DR . "/img");
define("LIB_UPLOAD_MAX_SIZE", 5*1024*1024);
define("SUMMER_TIME", 0);
define("LIB_DEV_MODE", 1);
//define("DB_TRIGGER_OFF", true); !!
//����� ����� ���������� ������ ����� ��� ������ � ������ ������, 
//���� �� ����������� �� mySql
//require_once LIB_ROOT."/classes/db/pgsql.php";  
//require_once LIB_ROOT."/classes/db/mssql.php";
require_once LIB_ROOT."/classes/db/mysql.php";
