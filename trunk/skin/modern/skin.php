<?php
include_once("include/functions.php");
include_once("include/simple_cacher.php");
?>
<LINK href="skin/modern/style.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="skin/modern/menu.js"></script>
<TABLE class=foundation cellSpacing=0 cellPadding=0>
  <TBODY>
  <TR>
    <TD class=lefttitle></TD>
    <TD colspan=2 align=center>
          <table class=sitetitle cellSpacing=0 cellPadding=0>
          <tbody>
           <tr>
            <td class=ugverhfon>&nbsp;</td>
            <td class=topfon>&nbsp;</td>
            <td class=fonmenu>WOWD::<?php  echo $config['servername']; ?></td>
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
           <input name="s" type="hidden" value="all"  >
           <input class=ls_search alt="all" name=name style="width: 190px;"><br />
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
        <TD class=bodytopleft>&nbsp;</TD>
        <TD class=bodytop></TD>
        <TD class=bodytopright>&nbsp;</TD>
     </TR>
     <TR>
        <TD class=bodyleft></TD>
        <TD class=body><center><?php include("main.php");?></center></TD>
        <TD class=bodyright></TD>
     </TR>
     <TR>
        <TD class=bodybottomleft></TD>
        <TD class=bodybottom></TD>
        <TD class=bodybottomright></TD>
     </TR>
     </TBODY>
     </TABLE>
<!-- -->
    </TD>
<!-- -->
    <TD valign=top width=150px>
      <TABLE class=rightmenu>
       <TBODY>
       <TR><TD class=rtop></TD></TR>
       <TR>
        <TD class=rbody>
         <form name="langform">
	     Язык:
          <select name="lang" style="width: 120;border: 0px none; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);" onchange="document.langform.submit();">
	       <option <?php if ($config['lang']=='ru') echo "selected=\"selected\""; ?> value="ru">Русский</option>
           <option <?php if ($config['lang']=='en') echo "selected=\"selected\""; ?> value="en">Английский</option>
          </select>
         </form>

         <form name="skinform">
	     Скин:
          <select name="skin" style="width: 120;border: 0px none; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);" onchange="document.skinform.submit();">
	       <option <?php if ($config['skin_type']=='default') echo "selected=\"selected\""; ?> value="default">Default</option>
           <option <?php if ($config['skin_type']=='modern') echo "selected=\"selected\""; ?> value="modern">Modern</option>
           <option <?php if ($config['skin_type']=='dark') echo "selected=\"selected\""; ?> value="dark">Dark</option>
           <option <?php if ($config['skin_type']=='lofk_skin') echo "selected=\"selected\""; ?> value="lofk_skin">LOFK</option>
           <option <?php if ($config['skin_type']=='wrath') echo "selected=\"selected\""; ?> value="wrath">Wrath</option>
          </select>
         </form>

        </TD>
      <TR><TD class=rbottom></TD></TR>
      </TR>
      </TBODY>
      </TABLE>
    </TD>
<!-- -->

  </TR>
  </TBODY>
</TABLE>
