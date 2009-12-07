<?php
include_once("include/functions.php");
include_once("include/simple_cacher.php");
?>
<LINK href="skin/lofk_skin/style.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="skin/lofk_skin/menu.js"></script>
<TABLE class=foundation cellSpacing=0 cellPadding=0>
  <TBODY>
  <TR>
    <TD class=lefttitle></TD>
    <TD align=center>
          <table class=sitetitle cellSpacing=0 cellPadding=0>
          <tbody>
           <tr>
            <td class=ugverhfon>&nbsp;</td>
            <td class=topfon>&nbsp;</td>
            <td class=fonmenu><?php  echo $config['servername']; ?></td>
            <td class=topfon>&nbsp;</td>
            <td class=ugverhfon2>&nbsp;</td>
           </tr>
          </tbody>
          </table>
    </TD>
    <TD class=righttitle></TD>
  </TR>
  <TR>
    <TD class=leftmenu>
      <TABLE class=mainmenu>
       <TBODY>
       <TR><TD class=top></TD></TR>
       <TR>
        <TD class=body>
         <!--<?php  echo $lang['search_database']; ?><br> -->
          <FORM style="DISPLAY: inline" method=get>
           <input name="s" type="hidden" value="all">
           <INPUT class=ls_search alt="all" name=name style="width: 190px;"><br />
          </form>
<?php
   // Получаем данные для левого меню (сначала из кэша)
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
        </TR>
        <TR><TD class=bottom></TD></TR>
       </TBODY>
      </TABLE>
    </TD>
    <TD class=mybody>
<!--  -->
    <TABLE class=mainbody cellSpacing=0 cellPadding=0>
    <TBODY>
    <TR>
        <TD class=bodytopleft></TD>
        <TD class=bodytop></TD>
        <TD class=bodytopright></TD>
    </TR>
    <TR>
        <TD class=bodyleft></TD>
        <TD class=body><center><?php include("main.php");?></center></TD>
        <TD class=bodyright></TD></TR>
    <TR>
        <TD class=bodybottomleft></TD>
        <TD class=bodybottom></TD>
        <TD class=bodybottomright></TD>
    </TR>
</TBODY>
</TABLE>
<!-- -->
  </TD>
  <TD class=secondmenu></TD>
  </TR>
  </TBODY>
</TABLE>
