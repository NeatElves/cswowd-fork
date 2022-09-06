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
echo "<table class=report width=500>";
echo "<tbody>";
echo "<tr><td colspan=4 class=head>";
echo "<img src=\"images/gold.gif\">";
echo "<a href=\"?auction=Alliance\" style=\"Text-decoration: none; color:gold;\">&nbsp;$lang[Alliance]&nbsp;</a>";
echo "<img src=\"images/gold.gif\">";
echo "<a href=\"?auction=Horde\" style=\"Text-decoration: none; color:gold;\">&nbsp;$lang[Horde]&nbsp;</a>";
echo "<img src=\"images/gold.gif\">";
echo "<a href=\"?auction=Blackwater\" style=\"Text-decoration: none; color:gold;\">&nbsp;$lang[Blackwater]&nbsp;</a>";
echo "<img src=\"images/gold.gif\">";
echo "</td></tr>";

if ($rows)
{
 echo "<tr><td colspan=4 class=head>$number $lang[items]</td></tr>";
 echo "<tr>";
 echo "<th width=1px></th>";
 echo "<th width=50%>".$lang['auction_seller']."</th>";
 echo "<th width=25%>".$lang['auction_cost']."</th>";
 echo "<th width=25%>".$lang['auction_bye']."</th>";
 echo "</tr>\n";
 foreach ($rows as $auc_data)
 {
   $item_data = explode(' ', $auc_data['data']);
   echo "<tr>";
   echo "<td>"; show_item_by_data($item_data, 'auction'); echo "</td>";
 if ($auc_data['itemowner'] == 0)
   echo "<td align=center><font color=#ff0000>".$lang['auctionbot']."</font></td>";
 else
   echo "<td><a href=?player=$auc_data[itemowner]>".getCharacterName($auc_data['itemowner'])."</a></td>";
   echo "<td align=center>".money($auc_data['startbid'])."</td>";
   echo "<td align=center>".money($auc_data['buyoutprice'])."</td>";
   echo "</tr>\n";
 }
 generatePage($number, $page, "<a href=\"?auction=$type&page=%d\">%d </a>", 4);
}
else
 echo "<tr><td colspan=4 align=center>$lang[empty]</td></tr>";
 echo "</tbody></table>";
?>
