<?php
include_once("include/functions.php");
include_once("include/report_generator.php");
##########
/*
 * Скрипт показывает список владельцев вещи по ее id
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
   echo "<TABLE cellSpacing=0 cellPadding=0 width=500><TBODY><TR>";
   echo "<TD vAlign=top align=right width=20%>";
   $icon = getItemIcon($item['displayid']);
   echo "<br><A href=\"#\"><IMG height=64 width=64 border=0 src='$icon'></A></TD>";
   echo "<TD>";generateItemTable($item);echo "</TD>";
   echo "</TR></TBODY></TABLE>";

   if ($item['BuyPrice']) echo "$lang[buy_price]: ".money($item['BuyPrice']);
   echo "<br /><br />";
 }

 $show_fields= array('PL_REPORT_LEVEL', 'PL_REPORT_RACE', 'PL_REPORT_CLASS', 'PL_REPORT_NAME', 'PL_REPORT_ITEM');

 $p_search =& new PlayerReportGenerator('item');
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
