<?php
include_once("include/functions.php");
include_once("include/simple_cacher.php");
?>
<LINK href="skin/default/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="skin/default/menu.js"></script>
<TABLE class=foundation cellSpacing=0 cellPadding=0 width="99%" border=0px>
  <TBODY>
  <TR>
    <TD align=center height=30><IMG alt="wowd" src="images/wowdsmall.jpg" border=0></TD>
    <TD align=center><DIV class=sitetitle><B>WOWD::<?php  echo $config['servername']; ?></B></DIV>
    </TD>
  </TR>
  <TR>
    <TD class=menu>
      <DIV class=menutitle><?php  echo $lang['search_database']; ?>:</DIV>
      <DIV class=menutitle>
       <form style="DISPLAY: inline" method=get>
        <input name="s" type="hidden" value="all">
        <input class=ls_search alt="all" name=name>
       </form>
      </DIV>
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
    </TD>
    <TD class=body align=center vAlign=top><?php include("main.php");?></TD>
    </TR>
  </TBODY>
</TABLE>
