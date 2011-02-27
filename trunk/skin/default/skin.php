<?php
include_once("include/functions.php");
include_once("include/simple_cacher.php");
?>
<link href="skin/default/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="skin/default/menu.js"></script>
<table class="foundation" celspacing="0" cellpadding="0" width="99%" border="0">
  <tbody>
  <tr>
    <td align="center" height="30"><IMG alt="wowd" src="images/wowdsmall.jpg" border="0"></td>
    <td align="center"><div class="sitetitle"><b>WOWD::<?php  echo $config['servername']; ?></b></div>
    </td>
  </tr>
  <tr>
    <td class="menu">
      <div class="menutitle"><?php  echo $lang['search_database']; ?>:</div>
      <div class="menutitle">
       <form style="display: inline" method="get">
        <input name="s" type="hidden" value="all">
        <input class="ls_search" alt="all" name="name">
       </form>
      </div>
<?php
   $left_menu_file = "left_menu_".$config['lang'].".js";
   if (checkUseCacheJs($left_menu_file, 60*60*24))
   {
     include("site_menu.php");
     echo 'var leftmenu = '.php2js($menu).';';
     echo 'generateLeftMenu("leftmenu");';
     flushJsCache($left_menu_file);
   }
?>
    </td>
    <td class="body" align="center" valign="top"><?php include("main.php");?></td>
    </tr>
  </tbody>
</table>
