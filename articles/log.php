<?php echo "<br>"; ?><!DOCTYPE html >
<head>
	<title>Logs</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
</head>

<body>
	<?
    $rawPost = isset($_SERVER['HTTP_RAW_POST_DATA']) ? $_SERVER['HTTP_RAW_POST_DATA'] : '';
    if (!$rawPost) {
        $rawPost = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    }
    $postData = print_r($_POST, 1);
    $date = date('Y-m-d H:i:s');
    $data = "date: {$date}\n\n==========================================\n\npost:\n\n{$postData}\n\nRAW:\n\n{$rawPost}";
    file_put_contents( dirname(__FILE__) . '/log.log', $data, FILE_APPEND );
    ?>
</body>

</html>
