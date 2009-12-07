<LINK href="skin/wrath/wrath.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript" src="skin/wrath/js/wrath.js"></script>
<table class=main_body cellSpacing=0 cellPadding=0><tbody>
<tr>
<!-- TOP MENU -->
 <td class=top_menu colSpan=3>
   <a href="#" id="langmenu_0" onmouseover="dd_Select(this);" onmouseout="dd_Unselect(this);">Laungage</a>&nbsp;&nbsp;*&nbsp;&nbsp;
   <a href="#" id="skinmenu_0" onmouseover="dd_Select(this);" onmouseout="dd_Unselect(this);">Skin</a>
 </td>
</tr>
<tr class=skin_top>
 <td class=skin_topleft></td>
 <td class=skin_topcenter>
  <div style="position: relative;">
   <div class="skin_topcenter"></div>
   <div class="skin_topleft"></div>
   <div class="skin_topright"></div>
   <div class="skin_topleftimg"></div>

   <div class="skin_searchmenu">
    <table class=search>
     <tr>
      <td class=sleft></td>
      <td>
       <form method=get style="DISPLAY: inline;">
        <input name="s" type="hidden" value="all" id=_topsearch>
        <input class=ls_search alt="all" name=name id=topsearch>
       </form>
      </td>
      <td>
       <select onChange = "changeSearch(this);">
        <option value="site">All</option>
        <option value="item">Item</option>
        <option value="itemset">Item Set</option>
        <option value="quest">Quest</option>
        <option value="spell">Spell</option>
        <option value="npc">Npc</option>
        <option value="object">Object</option>
        <option value="faction">Faction</option>
        <option value="area">Area</option>
        <option value="player">Player</option>
       </select>
      </td>
      <td><a class=searhButton href="#" onclick="searchClick(this);"></a></td>
      <td class=sright></td>
     </tr>
    </table>
   </div>
  </div>

 </td>
 <td class="skin_topright"></td>
</tr>
<tr>
 <td class=skin_left>
  <div style="position: relative;">
   <div class="skin_leftimg1"></div>
   <div class="skin_leftimg2"></div>
<!--
 Left menu here
-->
   <div class="skin_leftmenu" id=leftmenu align="right">
<?php
   $left_menu_file = "left_menu_".$config['lang'].".js";
   include_once("include/simple_cacher.php");
   if (checkUseCacheJs($left_menu_file, 60*60*24))
   {
     include("site_menu.php");
     echo 'var leftmenu = '.php2js($menu).';';
     echo 'generateLeftMenu("leftmenu");';
     flushJsCache($left_menu_file);
   }
?>
   </div>
<!--
 Left menu end
-->

 </td>
 <td class=skin_center>
 <table class=body cellSpacing=0 cellPadding=0>
 <tbody>
 <tr>
  <td class=bodyleft></td>
  <td class=bodycenter align="center"><?php include("main.php");?></td>
  <td class=bodyright></td>
 </tr>
 <tr>
  <td class=bodybottom colspan="3">
   <div style="position: relative; height: 73px;">
    <div class="blimg"></div>
    <div class="brimg"></div>
   </div>
  </td>
 </tr>
 </tbody></table>
 </td>
 <td class="skin_right">
  <div style="position: relative;">
   <div class="rightimg"></div>
   <div class="rightmenu">
<!--
 Left menu here
-->
   </div>

  </div>
 </td>
</tr>
<tr><td class="skin_bottom" colspan=3></td></tr>
</tbody>
</table>