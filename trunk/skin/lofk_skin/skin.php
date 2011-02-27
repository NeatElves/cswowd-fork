<?php
include_once("include/functions.php");
include_once("include/simple_cacher.php");
?>
<link href="skin/lofk_skin/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="skin/lofk_skin/menu.js"></script>
<table class="foundation" cellspacing="0" cellpadding="0">
  <tbody>
  <tr>
    <td class="lefttitle"></td>
    <td align="center">
          <table class="sitetitle" cellspacing="0" cellpadding="0">
          <tbody>
           <tr>
            <td class="ugverhfon">&nbsp;</td>
            <td class="topfon">&nbsp;</td>
            <td class="fonmenu"><?php  echo $config['servername']; ?></td>
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
       <tr><td class=top></td></tr>
       <tr>
        <td class="body">
         <!--<?php  echo $lang['search_database']; ?><br> -->
          <form style="display: inline" method="get">
           <input name="s" type="hidden" value="all">
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
        <td class="bodytopleft"></td>
        <td class="bodytop"></td>
        <td class="bodytopright"></td>
    </tr>
    <tr>
        <td class="bodyleft"></td>
        <td class="body"><center><?php include("main.php");?></center></td>
        <td class="bodyright"></td></tr>
    <tr>
        <td class="bodybottomleft"></td>
        <td class="bodybottom"></td>
        <td class="bodybottomright"></td>
    </tr>
</tbody>
</table>
<!-- -->
  </td>
  <td class="secondmenu"></td>
  </tr>
  </tbody>
</table>
