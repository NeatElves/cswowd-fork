<?php
include_once("include/functions.php");
include_once("include/report_generator.php");
##########
/*
 * Скрипт показывает список владельцев вещи по её id
 */

$itemid = intval(@$_REQUEST['itemOwner']);
$FindRefrence="?itemOwner=$itemid";

$item=getItem($itemid);
if (!$item)
{
   RenderError("$lang[item_not_found]");
}
else
{
 if ($ajaxmode==0)
 {
   echo "<table cellspacing=0 cellpadding=0 width=500><tbody><tr>";
   echo "<td vAlign=top align=right width=20%>";
   $icon = getItemIcon($item['displayid']);
   echo "<br><a href=\"#\"><img height=64 width=64 border=0 src='$icon'></a></td>";
   echo "<td>";generateItemTable($item);echo "</td>";
   echo "</tr></tbody></table>";

   if ($item['BuyPrice']) echo "$lang[buy_price]: ".money($item['BuyPrice']);
   echo "<br /><br />";
 }

 $show_fields= array('PL_REPORT_LEVEL', 'PL_REPORT_RACE', 'PL_REPORT_CLASS', 'PL_REPORT_NAME', 'PL_REPORT_ITEM');

 $p_search = new PlayerReportGenerator('item');
 $p_search->disableMark();
 $p_search->Init($show_fields, $FindRefrence, 'searchOwners', $config['fade_limit'], 'name');
 $p_search->itemOwner($itemid);
 $number = $p_search->getTotalDataCount();
 if ($number <= 0)
    echo $lang['owner_no_found'];
 else
    $p_search->createReport(sprintf($lang['owner_list'], $number));
}
?>
