<?php
include_once("conf.php");
include_once("include/functions.php");
$page = intval(@$_REQUEST['page']);
$type = @$_REQUEST['auction'];

switch ($type) 
{
	case "Alliance":	
	$houseid="(houseid=1 or houseid=2 or houseid=3)";
	break;
	case "Horde":
	$houseid="(houseid=4 or houseid=5 or houseid=6)";
	break;
	case "Blackwater":
	$houseid="(houseid=7)";
	default:
	$type="Blackwater";
	$houseid="(houseid=7)";
	break;
}

$rows = $cDB->selectPage($number,
"SELECT
`auction`.`id`,
`auction`.`itemguid`,
`auction`.`item_template`,
`auction`.`itemowner`,
`auction`.`buyoutprice`,
`auction`.`time`,
`auction`.`buyguid`,
`auction`.`lastbid`,
`auction`.`startbid`,
`auction`.`deposit`,
`auction`.`houseid`,

(SUBSTRING_INDEX( SUBSTRING_INDEX(`item_instance`.`data` , ' ' , ?d) , ' ' , -1 )+0) AS `itementry`,
`item_instance`.`data`,
`item_instance`.`owner_guid`
FROM
 `auction`
   left join
 `item_instance`
  ON `auction`.`itemguid` = `item_instance`.`guid`
WHERE
 $houseid
LIMIT ?d, ?d",
ITEM_FIELD_ENTRY+1,
getPageOffset($page), $config['fade_limit']);
echo "<TABLE class=report width=500>";
echo "<TBODY>";
echo "<TR><TD colspan=4 class=head>";
echo "<img src=\"images/gold.gif\">";
echo " <a href=\"?auction=Alliance\" style=\"Text-decoration: none; color:gold;\">$lang[Alliance]</a>";
echo " <img src=\"images/gold.gif\">";
echo " <a href=\"?auction=Horde\" style=\"Text-decoration: none; color:gold;\">$lang[Horde]</a>";
echo " <img src=\"images/gold.gif\">";
echo " <a href=\"?auction=Blackwater\" style=\"Text-decoration: none; color:gold;\">$lang[Blackwater]</a>";
echo " <img src=\"images/gold.gif\">";
echo "</TD></TR>";

if ($rows)
{
 echo "<TR><TD colspan=4 class=head><font color=gold>$lang[auction] $type: </font> $number $lang[items]</TD></TR>";
 echo "<TR>";
 echo "<TH width=1px></TH>";
 echo "<TH width=50%>".$lang['auction_seller']."</TH>";
 echo "<TH width=25%>".$lang['auction_cost']."</TH>";
 echo "<TH width=25%>".$lang['auction_bye']."</TH>";
 echo "</TR>\n";
 foreach ($rows as $auc_data)
 {
   $item_data = explode(' ', $auc_data['data']);
   echo "<TR>";
   echo "<TD>"; show_item_by_data($item_data, 'auction'); echo "</TD>";
   echo "<TD><A href=?player=$auc_data[itemowner]>".getCharacterName($auc_data['itemowner'])."</A></TD>";
   echo "<TD align=center>".money($auc_data['startbid'])."</TD>";
   echo "<TD align=center>".money($auc_data['buyoutprice'])."</TD>";
   echo "</TR>\n";
 }
 generatePage($number, $page, "<A href=\"?auction=$type&page=%d\">%d </A>", 4);
}
else
 echo "<tr><td colspan=4 align=center>$lang[empty]</td></tr>";
echo "</tbody></table>";
?>