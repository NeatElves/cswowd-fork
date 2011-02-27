<?php
include_once("include/functions.php");
include_once("include/simple_cacher.php");
?>
<link href="skin/dark/style.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="skin/dark/menu.js"></script>
<body>
<table width=100% align="center"><tr><td>
<table cellspacing="0" cellpadding="0" width="100%" align="center" background="skin/dark/img/top-tile.gif" border="0">
 <tbody>
  <tr>
   <td align="left"><img src="skin/dark/img/gryphon-left.gif"></td>
   <td width=100% align="center"><img src="skin/dark/img/logo.gif"></td>
   <td align="right"><img src="skin/dark/img/gryphon-right.gif"></td>
  </tr>
  <tr>
   <td align="center" width="100%" background="skin/dark/img/up.gif" colspan="3" height="33"><img src="skin/dark/img/logo2.gif"></td>
  </tr>
 </tbody>
</table>

<table cellspacing="0" cellpadding="0" width="100%" align="center" background="skin/dark/img/up-center.gif" border="0">
 <tbody>
  <tr>
    <td align="left"><img src="skin/dark/img/up-left.gif"></td>
    <td width=100% align=center>text1 | text2</td>
    <td align="right"><img src="skin/dark/img/up-right.gif"></td>
  </tr>
 </tbody>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#000000">
 <tr>
  <td valign="top">
   <table cellspacing="0" cellpadding="0" width="190">
    <tr>
     <td valign="top" width="14"><img height="13" src="skin/dark/img/1.gif" width="14" border="0"></td>
     <td valign="top" width="100%" background="skin/dark/img/2.gif"></td>
     <td valign="top" width="13"><img height="13" src="skin/dark/img/3.gif" width="13" border="0"></td>
    </tr>
    <tr>
     <td width="14" background="skin/dark/img/4.gif" height="49"><img height="14" src="skin/dark/img/spacer.gif" width="14" border="0"></td>
     <td>
      <div class="menutitle">
       <form style="display: inline" method="get">
        <input name="s" type="hidden" value="all">
        <input class="ls_search" alt="all" name="name" style="width: 100%;">
       </form>
      </div>
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
     <td width="14" background="skin/dark/img/6.gif" ><img height="14" src="skin/dark/img/spacer.gif" width="14" border="0"></td>
    </tr>
    <tr>
     <td valign="top" width="14"><img height="13" src="skin/dark/img/8.gif" width="14" border="0"></td>
     <td valign="top" width="152" background="skin/dark/img/10.gif"></td>
     <td valign="top" width="13"><img height="13" src="skin/dark/img/9.gif" width="13" border="0"></td>
    </tr>
   </table>
  </td>

  <td width=100% valign="top">
   <table class="mainbody" cellspacing="0" cellpadding="0">
    <tr>
     <td width="20"><img src="skin/dark/img/border-top-left.gif"></td>
     <td width="100%" background="skin/dark/img/border-top-center.gif"></td>
     <td width="20"><img src="skin/dark/img/border-top-right.gif"></td>
    </tr>

    <tr>
     <td background="skin/dark/img/border-left.gif"> </td>

     <td class="body" align="center" valign="top"> <?php include("main.php");?></td>

     <td background="skin/dark/img/border-right.gif"> </td>
    </tr>
    <tr>
     <td><img src="skin/dark/img/border-bot-left.gif"></td>
     <td background="skin/dark/img/border-bot-center.gif"> </td>
     <td><img src="skin/dark/img/border-bot-right.gif"></td>
    </tr>
   </table>
  </td>

  <td valign="top">
   <table class="mainmenu" cellspacing="0" cellpadding="0" width="180">
    <tr>
     <td valign=top width="14"><img height="13" src="skin/dark/img/1.gif" width="14" border="0"></td>
     <td valign=top width="152" background="skin/dark/img/2.gif"></td>
     <td valign=top width="13"><img height="13" src="skin/dark/img/3.gif" width="13" border="0"></td>
    </tr>
    <tr>
     <td width="14" background="skin/dark/img/4.gif"><img height="14" src="skin/dark/img/spacer.gif" width="14" border="0"></td>
     <td>
          <form name="langform">
	      Язык сайта:
          <select name="lang" style="width: 100%;border: 0px none; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);" onChange="document.langform.submit();">
	      <option <?php if ($config['lang']=='ru') echo "selected=\"selected\""; ?> value="ru">Русский</option>
          <option <?php if ($config['lang']=='en') echo "selected=\"selected\""; ?> value="en">Английский</option>
          </select></form>

          <form name="skinform">
	      Выберите скин сайта:
          <select name="skin" style="width: 100%;border: 0px none; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);" onChange="document.skinform.submit();">
	      <option <?php if ($config['skin_type']=='default') echo "selected=\"selected\""; ?> value="default">Default</option>
          <option <?php if ($config['skin_type']=='modern') echo "selected=\"selected\""; ?> value="modern">Modern</option>
          <option <?php if ($config['skin_type']=='dark') echo "selected=\"selected\""; ?> value="dark">Dark</option>
          <option <?php if ($config['skin_type']=='lofk_skin') echo "selected=\"selected\""; ?> value="lofk_skin">LOFK</option>
          <option <?php if ($config['skin_type']=='wrath') echo "selected=\"selected\""; ?> value="wrath">Wrath</option>
          </select></form>

     </td>
     <td width="14" background="skin/dark/img/6.gif"><img src="skin/dark/img/spacer.gif" width="14" border="0"></td>
    </tr>
    <tr>
     <td valign="top" width="14"><img height="13" src="skin/dark/img/8.gif" width="14" border="0"></td>
     <td valign="top" width="152" background="skin/dark/img/10.gif"></td>
     <td valign="top" width="13"><img height="13" src="skin/dark/img/9.gif" width="13" border="0"></td>
    </tr>
   </table>
   <table cellspacing="0" cellpadding="0" width="180">
    <tr>
     <td valign="top" width="14"><img height="13" src="skin/dark/img/1.gif" width="14" border="0"></td>
     <td valign="top" width="152" background="skin/dark/img/2.gif"></td>
     <td valign="top" width="13"><img height="13" src="skin/dark/img/3.gif" width="13" border="0"></td>
    </tr>
    <tr>
     <td width="14" background="skin/dark/img/4.gif" height="49"><img height="14" src="skin/dark/img/spacer.gif" width="14" border="0"></td>
     <td>

     </td>
     <td width="14" background="skin/dark/img/6.gif"><img height="14" src="skin/dark/img/spacer.gif" width="14" border="0"></td>
    </tr>
    <tr>
     <td valign=top width="14"><img height="13" src="skin/dark/img/8.gif" width="14" border="0"></td>
     <td valign=top width="152" background="skin/dark/img/10.gif"></td>
     <td valign=top width="13"><img height=13 src="skin/dark/img/9.gif" width="13" border="0"></td>
    </tr>
   </table>
   <table cellspacing="0" cellpadding="0" width="180">
    <tr>
     <td valign="top" width="14"><img height="13" src="skin/dark/img/1.gif" width="14" border="0"></td>
     <td valign="top" width="152" background="skin/dark/img/2.gif"></td>
     <td valign="top" width="13"><img height="13" src="skin/dark/img/3.gif" width="13" border="0"></td>
    </tr>
    <tr>
     <td width="14" background="skin/dark/img/4.gif" height="49"><img height="14" src="skin/dark/img/spacer.gif" width="14" border=0></td>
     <td>

     </td>
     <td width="14" background="skin/dark/img/6.gif"><img height="14" src="skin/dark/img/spacer.gif" width="14" border="0"></td>
    </tr>
    <tr>
     <td valign="top" width="14"><img height="13" src="skin/dark/img/8.gif" width="14" border="0"></td>
     <td valign="top" width="152" background="skin/dark/img/10.gif"></td>
     <td valign="top" width="13"><img height="13" src="skin/dark/img/9.gif" width="13" border="0"></td>
    </tr>
   </table>
  </td>
 </tr>
</table>
</td></tr></table>
</body>
