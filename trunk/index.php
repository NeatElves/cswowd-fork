<?php
@session_start();
include("conf.php");
include("lang/lang.".$config['lang'].".php");
include("lang/game_text.".$config['lang'].".php");
?>
<HTML><HEAD><link rel="SHORTCUT ICON" href="images/favicon.ico"><TITLE>:: WOWD :: <?php echo  $config['servername']; ?></TITLE></HEAD>
<META http-equiv="content-type" content="text/html; charset=utf-8" />
<LINK rel="stylesheet" href="wowd.css" type="text/css" />
<BODY>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript" src="js/my_tooltip.js"></script>
<?php
// Подключаем скрипт только по необходимости
if (!empty($ajax_modules['ls']))
    echo '<script type="text/javascript" src="js/my_livesearch.js"></script>';

$skinfile = 'skin/'.$config['skin_type'].'/skin.php';
if (file_exists($skinfile)) include($skinfile);
else include('skin/default/skin.php');
?>
<br><hr width=90%>
<CENTER><FONT size=-1> C.S. WoWD from Chestr and Skel 2007-2009</FONT></CENTER>
</BODY></HTML>
