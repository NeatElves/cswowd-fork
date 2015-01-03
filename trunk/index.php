<?php
@session_start();
include("conf.php");
include("lang/lang.".$config['lang'].".php");
include("lang/game_text.".$config['lang'].".php");
?>
<html>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<head><link rel="shortcut icon" href="images/favicon.ico"><title>:: C.S. WOWD :: <?php echo $config['servername']; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="wowd.css" type="text/css" />
</head>
<body>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript" src="js/my_tooltip.js"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<?php
// Подключаем скрипт только по необходимости
if (!empty($ajax_modules['ls']))
    echo '<script type="text/javascript" src="js/my_livesearch.js"></script>';

$skinfile = 'skin/'.$config['skin_type'].'/skin.php';
if (file_exists($skinfile)) include($skinfile);
else include('skin/default/skin.php');
?>
<br><hr width=90%>
<center><font size=-1>C.S. WoWD 2007-2015 (fork)</font></center>
</body></html>