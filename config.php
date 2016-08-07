<?php
#================ db====================================================
mysql_pconnect("localhost", "root", "123456") or die('connect error');
mysql_select_db("p100") or die('error select db gz');
mysql_query("SET NAMES UTF8");
#================ constant==============================================
define("DR", $_SERVER["DOCUMENT_ROOT"]);
define("TPLS", DR . '/tpl');
define("MAX_WIDTH", 240);
define("MAX_HEIGHT", 240);
define("ADMIN_PHONE", '+7 963 795 41 16');
define("SITE_EMAIL", 'gazelme@mail.ru');
define("H1_BEG", "Заказ ГАЗели в ");
define("AUTO_MODERATION_ON", false);

//mysql_close();
