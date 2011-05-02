<?php
include_once("include/functions.php");
include_once("include/simple_cacher.php");
?>
<link href="skin/modern/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="skin/modern/menu.js"></script>
<table class="foundation" cellspacing="0" cellpadding="0">
  <tbody>
  <tr>
    <td class="lefttitle"></td>
    <td colspan="2" align="center">
          <table class="sitetitle" cellspacing="0" cellpadding="0">
          <tbody>
           <tr>
            <td class="ugverhfon">&nbsp;</td>
            <td class="topfon">&nbsp;</td>
            <td class="fonmenu">WOWD::<?php  echo $config['servername']; ?></td>
            <td class="topfon">&nbsp;</td>
            <td class="ugverhfon2">&nbsp;</td>
           </tr>
          </tbody>
          </table>
    </td>
    <td class="righttitle"></td>
  </tr>
  <tr>
    <td class="leftmenu">
      <table class="mainmenu">
       <tbody>
       <tr><td class="top"></td></tr>
       <tr>
        <td class="body">
         <!--<?php  echo $lang['search_database']; ?><br> -->
          <form style="display: inline" method="get">
           <input name="s" type="hidden" value="all"  >
           <input class="ls_search" alt="all" name="name" style="width: 190;"><br />
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
        </td>
        </tr>
        <tr><td class="bottom"></td></tr>
       </tbody>
      </table>
    </td>
    <td class="mybody">
<!--  -->
     <table class="mainbody" cellspacing="0" cellpadding="0">
     <tbody>
     <tr>
        <td class="bodytopleft">&nbsp;</td>
        <td class="bodytop"></td>
        <td class="bodytopright">&nbsp;</td>
     </tr>
     <tr>
        <td class="bodyleft"></td>
        <td class="body"><center><?php include("main.php");?></center></td>
        <td class="bodyright"></td>
     </tr>
     <tr>
        <td class="bodybottomleft"></td>
        <td class="bodybottom"></td>
        <td class="bodybottomright"></td>
     </tr>
     </tbody>
     </table>
<!-- -->
    </td>
<!-- -->
    <td valign="top" width="150">
      <table class="rightmenu">
       <tbody>
       <tr><td class="rtop"></td></tr>
       <tr>
        <td class="rbody">
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

        </td>
      <tr><td class="rbottom"></td></tr>
      </tr>
      </tbody>
      </table>
    </td>
<!-- -->

  </tr>
  </tbody>
</table>
