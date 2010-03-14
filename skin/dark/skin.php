<?php
include_once("include/functions.php");
include_once("include/simple_cacher.php");
?>
<LINK href="skin/dark/style.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="skin/dark/menu.js"></script>
<body>
<table width=100% align="center"><tr><td>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align="center" background="skin/dark/img/top-tile.gif" border=0>
 <TBODY>
  <TR>
   <TD align=left><IMG  src="skin/dark/img/gryphon-left.gif"></TD>
   <TD width=100% align=center><IMG src="skin/dark/img/logo.gif"></TD>
   <TD align=right><IMG src="skin/dark/img/gryphon-right.gif"></TD>
  </TR>
  <TR>
   <TD align=center width="100%" background="skin/dark/img/up.gif" colSpan=3 height=33><IMG src="skin/dark/img/logo2.gif"></TD>
  </TR>
 </TBODY>
</TABLE>

<TABLE cellSpacing=0 cellPadding=0 width="100%" align="center" background="skin/dark/img/up-center.gif" border=0>
 <TBODY>
  <TR>
    <TD align=left><IMG src="skin/dark/img/up-left.gif"></TD>
    <TD width=100% align=center>text1 | text2</TD>
    <TD align=right><IMG src="skin/dark/img/up-right.gif"></TD>
  </TR>
 </TBODY>
</TABLE>

<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#000000">
 <tr>
  <td valign="top">
   <TABLE cellSpacing=0 cellPadding=0 width="190">
    <TR>
     <TD vAlign=top width=14><IMG height=13 src="skin/dark/img/1.gif" width=14 border=0></TD>
     <TD vAlign=top width=100% background="skin/dark/img/2.gif"></TD>
     <TD vAlign=top width=13><IMG height=13 src="skin/dark/img/3.gif" width=13 border=0></TD>
    </TR>
    <tr>
     <TD width=14 background=skin/dark/img/4.gif height="49"><IMG height=14 src="skin/dark/img/spacer.gif" width=14 border=0></TD>
     <td>
      <div class="menutitle">
       <form style="DISPLAY: inline" method=get>
        <input name="s" type="hidden" value="all">
        <input class=ls_search alt=all name=name style="width: 100%;">
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
     <TD width=14 background=skin/dark/img/6.gif ><IMG height=14 src="skin/dark/img/spacer.gif" width=14 border=0></TD>
    </tr>
    <TR>
     <TD vAlign=top width=14><IMG height=13 src="skin/dark/img/8.gif" width=14 border=0></TD>
     <TD vAlign=top width=152 background=skin/dark/img/10.gif></TD>
     <TD vAlign=top width=13><IMG height=13 src="skin/dark/img/9.gif" width=13 border=0></TD>
    </TR>
   </TABLE>
  </td>

  <td width=100% valign="top">
   <TABLE class=mainbody cellSpacing=0 cellPadding=0>
    <TR>
     <TD width=20px><IMG src="skin/dark/img/border-top-left.gif"></TD>
     <TD width=100% background="skin/dark/img/border-top-center.gif"></TD>
     <TD width=20px><IMG src="skin/dark/img/border-top-right.gif"></TD>
    </TR>

    <tr>
     <TD background=skin/dark/img/border-left.gif> </TD>

     <TD class=body align=center vAlign=top> <?php include("main.php");?></TD>

     <TD background=skin/dark/img/border-right.gif > </TD>
    </tr>
    <TR>
     <TD><IMG src="skin/dark/img/border-bot-left.gif"></TD>
     <TD background="skin/dark/img/border-bot-center.gif"> </TD>
     <TD><IMG src="skin/dark/img/border-bot-right.gif"></TD>
    </TR>
   </TABLE>
  </td>

  <td valign="top">
   <TABLE class=mainmenu cellSpacing=0 cellPadding=0 width="180">
    <TR>
     <TD vAlign=top width=14><IMG height=13 src="skin/dark/img/1.gif" width=14 border=0></TD>
     <TD vAlign=top width=152 background="skin/dark/img/2.gif"></TD>
     <TD vAlign=top width=13><IMG height=13 src="skin/dark/img/3.gif" width=13 border=0></TD>
    </TR>
    <tr>
     <TD width=14 background=skin/dark/img/4.gif><IMG height=14 src="skin/dark/img/spacer.gif" width=14 border=0></TD>
     <td>
          <form name="langform">
	      Язык сайта:
          <select name="lang" style="width: 100%;border: 0px none; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);" onchange="document.langform.submit();">
	      <option <?php if ($config['lang']=='ru') echo "selected=\"selected\""; ?> value="ru">Русский</option>
          <option <?php if ($config['lang']=='en') echo "selected=\"selected\""; ?> value="en">Английский</option>
          </select></form>

          <form name="skinform">
	      Выберите скин сайта:
          <select name="skin" style="width: 100%;border: 0px none; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);" onchange="document.skinform.submit();">
	      <option <?php if ($config['skin_type']=='default') echo "selected=\"selected\""; ?> value="default">Default</option>
          <option <?php if ($config['skin_type']=='modern') echo "selected=\"selected\""; ?> value="modern">Modern</option>
          <option <?php if ($config['skin_type']=='dark') echo "selected=\"selected\""; ?> value="dark">Dark</option>
          <option <?php if ($config['skin_type']=='lofk_skin') echo "selected=\"selected\""; ?> value="lofk_skin">LOFK</option>
          <option <?php if ($config['skin_type']=='wrath') echo "selected=\"selected\""; ?> value="wrath">Wrath</option>
          </select></form>

     </td>
     <TD width=14 background=skin/dark/img/6.gif ><IMG src="skin/dark/img/spacer.gif" width=14 border=0></TD>
    </tr>
    <TR>
     <TD vAlign=top width=14><IMG height=13 src="skin/dark/img/8.gif" width=14 border=0></TD>
     <TD vAlign=top width=152 background=skin/dark/img/10.gif></TD>
     <TD vAlign=top width=13><IMG height=13 src="skin/dark/img/9.gif" width=13 border=0></TD>
    </TR>
   </TABLE>
   <TABLE cellSpacing=0 cellPadding=0 width="180">
    <TR>
     <TD vAlign=top width=14><IMG height=13 src="skin/dark/img/1.gif" width=14 border=0></TD>
     <TD vAlign=top width=152 background="skin/dark/img/2.gif"></TD>
     <TD vAlign=top width=13><IMG height=13 src="skin/dark/img/3.gif" width=13 border=0></TD>
    </TR>
    <tr>
     <TD width=14 background=skin/dark/img/4.gif height="49"><IMG height=14 src="skin/dark/img/spacer.gif" width=14 border=0></TD>
     <td>

     </td>
     <TD width=14 background=skin/dark/img/6.gif ><IMG height=14 src="skin/dark/img/spacer.gif" width=14 border=0></TD>
    </tr>
    <TR>
     <TD vAlign=top width=14><IMG height=13 src="skin/dark/img/8.gif" width=14 border=0></TD>
     <TD vAlign=top width=152 background=skin/dark/img/10.gif></TD>
     <TD vAlign=top width=13><IMG height=13 src="skin/dark/img/9.gif" width=13 border=0></TD>
    </TR>
   </TABLE>
   <TABLE cellSpacing=0 cellPadding=0 width="180">
    <TR>
     <TD vAlign=top width=14><IMG height=13 src="skin/dark/img/1.gif" width=14 border=0></TD>
     <TD vAlign=top width=152 background="skin/dark/img/2.gif"></TD>
     <TD vAlign=top width=13><IMG height=13 src="skin/dark/img/3.gif" width=13 border=0></TD>
    </TR>
    <tr>
     <TD width=14 background=skin/dark/img/4.gif height="49"><IMG height=14 src="skin/dark/img/spacer.gif" width=14 border=0></TD>
     <td>

     </td>
     <TD width=14 background=skin/dark/img/6.gif ><IMG height=14 src="skin/dark/img/spacer.gif" width=14 border=0></TD>
    </tr>
    <TR>
     <TD vAlign=top width=14><IMG height=13 src="skin/dark/img/8.gif" width=14 border=0></TD>
     <TD vAlign=top width=152 background=skin/dark/img/10.gif></TD>
     <TD vAlign=top width=13><IMG height=13 src="skin/dark/img/9.gif" width=13 border=0></TD>
    </TR>
   </TABLE>
  </td>
 </tr>
</table>
</td></tr></table>
</body>
