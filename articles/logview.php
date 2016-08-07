<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Logs</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
</head>

<body>
	<?php
    echo "<pre style='background-color:#CEC5C5;'>";
    echo file_get_contents( dirname(__FILE__) . '/log.log' );
    echo "</pre>";
    ?>
</body>

</html>
