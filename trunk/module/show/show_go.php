<?php
include_once("conf.php");
include_once("include/gameobject_table.php");
include_once("include/info_table_generator.php");
include_once("include/report_generator.php");
##########
/*
  Script show GO data by its entry
  Show:
   - Show simple GO table tooltip
   - Details GO info
   - Summoned by spell
   - Cast spells
   - How can possible open it (lock info)
   - Required for quest list
   - Give quest list
   - Take quest list
   - Item loot
*/
$entry = intval(@$_REQUEST['object']);
$page  = intval(@$_REQUEST['page']);
$mark  = @$_REQUEST['mark'];

$obj=getGameobject($entry);
if (!$obj)
{
  RenderError($lang['go_not_found']);
}
else
{
 $baseLink = '?object='.$entry;
	if ('www_gameobject' != '')
	echo "<a href=\"".sprintf($config[www_gameobject], $entry)."\" target=\"_blank\"\">".sprintf($config[www_gameobject], $entry)."</a><br>";
 include_once("module/maps/map.php");
 if ($ajaxmode==0)
 {
  echo "<TABLE cellSpacing=0 cellPadding=0 width=500>";
  echo "<TBODY>";
  echo "<TR>";
  // $icon = "--";//getObjIcon($obj[displayId]);
  // echo "<TD vAlign=top align=right width=20%><br><A href=\"#\"><IMG height=64 width=64 border=0 src='$icon'></A></TD>";
  echo "<TD align=center>";generateGameobjectTable($obj);echo "</TD>";
  echo "</TR>";
  echo "<TR><TD colSpan=2 align=center><a href=\"?map&obj=$obj[entry]\">$lang[show_map] (".getGameobjectCount($obj['entry']).")</a></TD></TR>";
  echo "</TBODY></TABLE>";

  if ($config['show_go_details'])
  {
   echo "<br><TABLE class=details width=600>";
   echo "<TBODY>";
   echo "<tr><td colspan=4 class=head>$lang[detail_info]</td></tr>";
//   echo "<tr><th width=100px></th><th></th></tr>";
   echo "<tr><th>Type</th><td colspan=3>".getGameobjectType($obj['type'])."</td></tr>";
   echo "<tr><th>Flags</th><td colspan=3>";
   if ($flag = $obj['flags'])
   {
     if ($flag & GO_FLAG_IN_USE)       echo "GO_FLAG_IN_USE<br>";
     if ($flag & GO_FLAG_LOCKED)       echo "GO_FLAG_LOCKED<br>";
     if ($flag & GO_FLAG_INTERACT_COND)echo "GO_FLAG_INTERACT_COND<br>";
     if ($flag & GO_FLAG_TRANSPORT)    echo "GO_FLAG_TRANSPORT<br>";
     if ($flag & GO_FLAG_UNK1)         echo "GO_FLAG_UNK1<br>";
     if ($flag & GO_FLAG_NODESPAWN)    echo "GO_FLAG_NODESPAWN<br>";
     if ($flag & GO_FLAG_TRIGGERED)    echo "GO_FLAG_TRIGGERED<br>";
     if ($flag & GO_FLAG_UNK2)         echo "GO_FLAG_UNK2<br>";
   }
   else
     echo "n/a";
   echo "</td></tr>";
   switch ($obj['type'])
   {
     case GAMEOBJECT_TYPE_DOOR:
      echo "<tr><th>startOpen</th><td>".($obj['data0']?"opened":"closed")."</td>";
      echo "<th>lockId</th><td>".($obj['data1'])."</td></tr>";
      echo "<tr><th>autoCloseTime</th><td>".($obj['data2']/0x10000)." secs</td>";
      echo "<th>noDamageImmune</th><td>".$obj['data3']."</td></tr>";
      echo "<tr><th>openTextID</th><td>".$obj['data4']."</td>";
      echo "<th>closeTextID</th><td>".$obj['data5']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_BUTTON:
      echo "<tr><th>startOpen</th><td>".($obj['data0']?"opened":"closed")."</td>";
      echo "<th>lockId</th><td>".($obj['data1'])."</td></tr>";
      echo "<tr><th>autoCloseTime</th><td>".($obj['data2']/0x10000)." secs</td>";
      echo "<th>linkedTrap</th><td>".($obj['data3']?getGameobjectName($obj['data3']):"n/a")."</td></tr>";
      echo "<tr><th>noDamageImmune</th><td>".$obj['data4']."</td>";
      echo "<th>large</th><td>".$obj['data5']."</td></tr>";
      echo "<tr><th>openTextID</th><td>".$obj['data6']."</td>";
      echo "<th>closeTextID</th><td>".$obj['data7']."</td></tr>";
      echo "<tr><th>losOK</th><td>".$obj['data8']."</td><td colspan=3></td></tr>";
     break;
     case GAMEOBJECT_TYPE_QUESTGIVER:
      echo "<tr><th>lockId</th><td>".$obj['data0']."</td>";
      echo "<th>questList</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>pageMaterial</th><td>".$obj['data2']."</td>";
      echo "<th>gossipID</th><td>".$obj['data3']."</td></tr>";
      echo "<tr><th>customAnim</th><td>".$obj['data4']."</td>";
      echo "<th>noDamageImmune</th><td>".$obj['data5']."</td></tr>";
      echo "<tr><th>openTextID</th><td>".$obj['data6']."</td>";
      echo "<th>losOK</th><td>".$obj['data7']."</td></tr>";
      echo "<tr><th>allowMounted</th><td>".$obj['data8']."</td>";
      echo "<th>large</th><td>".$obj['data9']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_CHEST:
      echo "<tr><th>lockId</th><td>".$obj['data0']."</td>";
      echo "<th>lootId</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>chestRestockTime</th><td>".$obj['data2']."</td>";
      echo "<th>consumable</th><td>".$obj['data3']."</td></tr>";
      echo "<tr><th>minSuccessOpens</th><td>".$obj['data4']."</td>";
      echo "<th>maxSuccessOpens</th><td>".$obj['data5']."</td></tr>";
      echo "<tr><th>eventId</th><td>".$obj['data6']."</td>";
      echo "<th>linkedTrapId</th><td>".($obj['data7']?getGameobjectName($obj['data7']):"n/a")."</td></tr>";
      echo "<tr><th>questId</th><td>".($obj['data8']?getQuestName($obj['data8']):"n/a")."</td>";
      echo "<th>level</th><td>".$obj['data9']."</td></tr>";
      echo "<tr><th>losOK</th><td>".$obj['data10']."</td>";
      echo "<th>leaveLoot</th><td>".$obj['data11']."</td></tr>";
      echo "<tr><th>notInCombat</th><td>".$obj['data12']."</td>";
      echo "<th>logLoot</th><td>".$obj['data13']."</td></tr>";
      echo "<tr><th>openTextID</th><td>".$obj['data14']."</td>";
      echo "<th>groupLootRules</th><td>".$obj['data15']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_BINDER:
     break;
     case GAMEOBJECT_TYPE_GENERIC:
      echo "<tr><th>floatingTooltip</th><td>".$obj['data0']."</td>";
      echo "<th>highlight</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>serverOnly</th><td>".$obj['data2']."</td>";
      echo "<th>large</th><td>".$obj['data3']."</td></tr>";
      echo "<tr><th>floatOnWater</th><td>".$obj['data4']."</td>";
      echo "<th>questID</th><td>".($obj['data5']?getQuestName($obj['data5']):"n/a")."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_TRAP:
      echo "<tr><th>lockId</th><td>".$obj['data0']."</td>";
      echo "<th>level</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>radius</th><td>".$obj['data2']."</td>";
      echo "<th>spellId</th><td>".($obj['data3']?getSpellNameFromId($obj['data3']):"n/a")."</td></tr>";
      echo "<tr><th>charges</th><td>".$obj['data4']."</td>";
      echo "<th>cooldown</th><td>".$obj['data5']." sec</td></tr>";
      echo "<tr><th>autoCloseTime</th><td>".($obj['data6']/0x10000)." sec</td>";
      echo "<th>startDelay</th><td>".$obj['data7']."</td></tr>";
      echo "<tr><th>serverOnly</th><td>".$obj['data8']."</td>";
      echo "<th>stealthed</th><td>".$obj['data9']."</td></tr>";
      echo "<tr><th>large</th><td>".$obj['data10']."</td>";
      echo "<th>stealthAffected</th><td>".$obj['data11']."</td></tr>";
      echo "<tr><th>openTextID</th><td>".$obj['data12']."</td>";
      echo "<th>closeTextID</th><td>".$obj['data13']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_CHAIR:
      echo "<tr><th>slots</th><td>".$obj['data0']."</td></tr>";
      echo "<tr><th>height</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>onlyCreatorUse</th><td>".$obj['data2']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_SPELL_FOCUS:
      echo "<tr><th>focusId</th><td>".($obj['data0']?getSpellFocusName($obj['data0'], 1):"n/a")."</td>";
      echo "<th>dist</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>linkedTrapId</th><td>".($obj['data2']?getGameobjectName($obj['data2']):"n/a")."</td>";
      echo "<th>serverOnly</th><td>".$obj['data3']."</td></tr>";
      echo "<tr><th>questID</th><td>".($obj['data4']?getQuestName($obj['data4']):"n/a")."</td>";
      echo "<td colspan=2></td></tr>";
     break;
     case GAMEOBJECT_TYPE_TEXT:
      echo "<tr><th>pageID</th><td>".$obj['data0']."</td></tr>";
      echo "<tr><th>language</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>pageMaterial</th><td>".$obj['data2']."</td></tr>";
      echo "<tr><th>allowMounted</th><td>".$obj['data3']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_GOOBER:
      echo "<tr><th>lockId</th><td>".$obj['data0']."</td>";
      echo "<th>questId</th><td>".($obj['data1']?getQuestName($obj['data1']):"n/a")."</td></tr>";
      echo "<tr><th>eventId</th><td>".$obj['data2']."</td>";
      echo "<th>autoCloseTime</th><td>".($obj['data3']/0x10000)." secs</td></tr>";
      echo "<tr><th>customAnim</th><td>".$obj['data4']."</td>";
      echo "<th>consumable</th><td>".$obj['data5']."</td></tr>";
      echo "<tr><th>cooldown</th><td>".$obj['data6']."</td>";
      echo "<th>pageId</th><td>".$obj['data7']."</td></tr>";
      echo "<tr><th>language</th><td>".$obj['data8']."</td>";
      echo "<th>pageMaterial</th><td>".$obj['data9']."</td></tr>";
      echo "<tr><th>spellId</th><td>".($obj['data10']?getSpellNameFromId($obj['data10']):"n/a")."</td>";
      echo "<th>noDamageImmune</th><td>".$obj['data11']."</td></tr>";
      echo "<tr><th>linkedTrapId</th><td>".($obj['data12']?getGameobjectName($obj['data12']):"n/a")."</td>";
      echo "<th>large</th><td>".$obj['data13']."</td></tr>";
      echo "<tr><th>openTextID</th><td>".$obj['data14']."</td>";
      echo "<th>closeTextID</th><td>".$obj['data15']."</td></tr>";
      echo "<tr><th>losOK</th><td>".$obj['data16']."</td>";
      echo "<th>allowMounted</th><td>".$obj['data17']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_TRANSPORT:
     break;
     case GAMEOBJECT_TYPE_AREADAMAGE:
     break;
     case GAMEOBJECT_TYPE_CAMERA:
      echo "<tr><th>lockId</th><td>".$obj['data0']."</td></tr>";
      echo "<tr><th>cinematicId</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>eventID</th><td>".$obj['data2']."</td></tr>";
      echo "<tr><th>openTextID</th><td>".$obj['data3']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_MAP_OBJECT:
     break;
     case GAMEOBJECT_TYPE_MO_TRANSPORT:
      echo "<tr><th>taxiPathId</th><td>".$obj['data0']."</td></tr>";
      echo "<tr><th>moveSpeed</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>accelRate</th><td>".$obj['data2']."</td></tr>";
      echo "<tr><th>startEventID</th><td>".$obj['data3']."</td></tr>";
      echo "<tr><th>stopEventID</th><td>".$obj['data4']."</td></tr>";
      echo "<tr><th>transportPhysics</th><td>".$obj['data5']."</td></tr>";
      echo "<tr><th>mapID</th><td>".getMapName($obj['data6'])."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_DUEL_ARBITER:
     break;
     case GAMEOBJECT_TYPE_FISHINGNODE:
      echo "<tr><th>_data0</th><td>".$obj['data0']."</td></tr>";
      echo "<tr><th>lootId</th><td>".$obj['data1']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_SUMMONING_RITUAL:
      echo "<tr><th>reqParticipants</th><td>".$obj['data0']."</td></tr>";
      echo "<tr><th>spellId</th><td>".($obj['data1']?getSpellNameFromId($obj['data1']):"n/a")."</td></tr>";
      echo "<tr><th>animSpell</th><td>".$obj['data2']."</td></tr>";
      echo "<tr><th>ritualPersistent</th><td>".$obj['data3']."</td></tr>";
      echo "<tr><th>casterTargetSpell</th><td>".$obj['data4']."</td></tr>";
      echo "<tr><th>casterTargetSpellTargets</th><td>".$obj['data5']."</td></tr>";
      echo "<tr><th>castersGrouped</th><td>".$obj['data6']."</td></tr>";
      echo "<tr><th>ritualNoTargetCheck</th><td>".$obj['data7']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_MAILBOX:
     break;
     case GAMEOBJECT_TYPE_AUCTIONHOUSE:
      echo "<tr><th>data0</th><td>".$obj['data0']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_GUARDPOST:
     break;
     case GAMEOBJECT_TYPE_SPELLCASTER:
      echo "<tr><th>spellId</th><td>".($obj['data0']?getSpellNameFromId($obj['data0']):"n/a")."</td></tr>";
      echo "<tr><th>charges</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>partyOnly</th><td>".$obj['data2']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_MEETINGSTONE:
      echo "<tr><th>minLevel</th><td>".$obj['data0']."</td></tr>";
      echo "<tr><th>maxLevel</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>areaID</th><td>".getAreaName($obj['data2'])."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_FLAGSTAND:
      echo "<tr><th>data0</th><td>".$obj['data0']."</td>";
      echo "<th>data1</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>data2</th><td>".$obj['data2']."</td>";
      echo "<th>data3</th><td>".$obj['data3']."</td></tr>";
      echo "<tr><th>data4</th><td>".$obj['data4']."</td>";
      echo "<th>data5</th><td>".$obj['data5']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_FISHINGHOLE:
      echo "<tr><th>radius</th><td>".$obj['data0']."</td></tr>";
      echo "<tr><th>lootId</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>minSuccessOpens</th><td>".$obj['data2']."</td></tr>";
      echo "<tr><th>maxSuccessOpens</th><td>".$obj['data3']."</td></tr>";
      echo "<tr><th>lockId</th><td>".$obj['data4']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_FISHINGHOLE:
     break;
     case GAMEOBJECT_TYPE_FLAGDROP:
      echo "<tr><th>data0</th><td>".$obj['data0']."</td>";
      echo "<th>data1</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>data2</th><td>".$obj['data2']."</td>";
      echo "<th>data3</th><td>".$obj['data3']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_MINI_GAME:
      echo "<tr><th>gameId</th><td>".$obj['data0']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_LOTTERY_KIOSK:
     break;
     case GAMEOBJECT_TYPE_CAPTURE_POINT:
      echo "<tr><th>data0</th><td>".$obj['data0']."</td>";
      echo "<th>data1</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>data2</th><td>".$obj['data2']."</td>";
      echo "<th>data3</th><td>".$obj['data3']."</td></tr>";
      echo "<tr><th>data4</th><td>".$obj['data4']."</td>";
      echo "<th>data5</th><td>".$obj['data5']."</td></tr>";
      echo "<tr><th>data6</th><td>".$obj['data6']."</td>";
      echo "<th>data7</th><td>".$obj['data7']."</td></tr>";
      echo "<tr><th>data8</th><td>".$obj['data8']."</td>";
      echo "<th>data9</th><td>".$obj['data9']."</td></tr>";
      echo "<tr><th>data10</th><td>".$obj['data10']."</td>";
      echo "<th>data11</th><td>".$obj['data11']."</td></tr>";
      echo "<tr><th>data12</th><td>".$obj['data12']."</td>";
      echo "<th>data13</th><td>".$obj['data13']."</td></tr>";
      echo "<tr><th>data14</th><td>".$obj['data14']."</td>";
      echo "<th>data15</th><td>".$obj['data15']."</td></tr>";
      echo "<tr><th>data16</th><td>".$obj['data16']."</td>";
      echo "<th>data17</th><td>".$obj['data17']."</td></tr>";
      echo "<tr><th>data18</th><td>".$obj['data18']."</td>";
      echo "<td colspan=2></td></tr>";
     break;
     case GAMEOBJECT_TYPE_AURA_GENERATOR:
      echo "<tr><th>data0</th><td>".$obj['data0']."</td></tr>";
      echo "<tr><th>data1</th><td>".$obj['data1']."</td></tr>";
      echo "<tr><th>spellId1</th><td>".($obj['data2']?getSpellNameFromId($obj['data2']):"n/a")."</td></tr>";
      echo "<tr><th>spellId2</th><td>".($obj['data3']?getSpellNameFromId($obj['data3']):"n/a")."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_DUNGEON_DIFFICULTY:
      echo "<tr><th>data0</th><td>".$obj['data0']."</td></tr>";
      echo "<tr><th>data1</th><td>".$obj['data1']."</td></tr>";
     break;
     case GAMEOBJECT_TYPE_BARBERSHOP:
     break;
     case GAMEOBJECT_TYPE_BARBER_CHAIR:
     break;
     case GAMEOBJECT_TYPE_GUILD_BANK:
     break;
     default:
     break;
   }
   echo "";
   echo "</TBODY></TABLE><br>";
  }
 }
 createReportTab();
 //********************************************************************************
 // Summoned by spell
 //********************************************************************************
 $summoned_by =& new SpellReportGenerator;
 $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_NAME');
 if ($summoned_by->Init($fields, $baseLink, 'summonLIST', $config['fade_limit'], 'name'))
 {
    $summoned_by->summonGO($entry);
    $summoned_by->createReport($lang['go_summoned_by']);
 }
 //********************************************************************************
 //  Cast spells
 //********************************************************************************
 $cast_spell =& new SpellReportGenerator;
 $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_NAME');
 if ($cast_spell->Init($fields, $baseLink, 'castLIST', $config['fade_limit'], 'name'))
 {
  $spellid = 0;
       if ($obj['type'] == GAMEOBJECT_TYPE_TRAP)             $spellid = $obj['data3'];
  else if ($obj['type'] == GAMEOBJECT_TYPE_GOOBER)           $spellid = $obj['data10'];
  else if ($obj['type'] == GAMEOBJECT_TYPE_SUMMONING_RITUAL) $spellid = $obj['data1'];
  else if ($obj['type'] == GAMEOBJECT_TYPE_SPELLCASTER)      $spellid = $obj['data0'];
  if ($spellid)
  {
    $cast_spell->doRequirest('`id` = ?d', $entry);
    $cast_spell->createReport($lang['go_cast_spell']);
  }
 }
 //********************************************************************************
 // How can possible open it (lock info)
 //********************************************************************************
 $locked =& new LockReportGenerator();
 $fields = array('LOCK_REPORT_ID', 'LOCK_REPORT_KEY');
 if ($locked->Init($fields, $baseLink, 'lockLIST', $config['fade_limit'], ''))
 {
  $lockid = 0;
       if ($obj['type'] == GAMEOBJECT_TYPE_DOOR)   $lockid = $obj['data1'];
  else if ($obj['type'] == GAMEOBJECT_TYPE_BUTTON) $lockid = $obj['data1'];
  else if ($obj['type'] == GAMEOBJECT_TYPE_QUESTGIVER) $lockid = $obj['data0'];
  else if ($obj['type'] == GAMEOBJECT_TYPE_CHEST)  $lockid = $obj['data0'];
  else if ($obj['type'] == GAMEOBJECT_TYPE_TRAP)   $lockid = $obj['data0'];
  else if ($obj['type'] == GAMEOBJECT_TYPE_GOOBER) $lockid = $obj['data0'];
  else if ($obj['type'] == GAMEOBJECT_TYPE_CAMERA) $lockid = $obj['data0'];
  if ($lockid)
  {
    $locked->doRequirest('`id` = ?d', $lockid);
    $locked->createReport($lang['go_locked']);
  }
 }

 //********************************************************************************
 // Required for quest list
 //********************************************************************************
 $reqForQuest =&new QuestReportGenerator();
 $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'QUEST_REPORT_REWARD');
 if ($reqForQuest->Init($fields, $baseLink, 'qreqLIST', $config['fade_limit'], 'name'))
 {
    $reqForQuest->requireGO($entry);
    $reqForQuest->createReport($lang['req_for_quest']);
 }
 //********************************************************************************
 // Give quest list
 //********************************************************************************
 $giveQuest =&new QuestReportGenerator('go_giver');
 $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_REWARD');
 if ($giveQuest->Init($fields, $baseLink, 'qgLIST', $config['fade_limit'], 'name'))
 {
    $giveQuest->getGiveTakeList($entry);
    $giveQuest->createReport($lang['give_quest']);
 }
 //********************************************************************************
 // Take quest list
 //********************************************************************************
 $takeQuest =&new QuestReportGenerator('go_take');
 $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_REWARD');
 if ($takeQuest->Init($fields, $baseLink, 'qtLIST', $config['fade_limit'], 'name'))
 {
    $takeQuest->getGiveTakeList($entry);
    $takeQuest->createReport($lang['take_quest']);
 }
 //********************************************************************************
 // Item loot
 //********************************************************************************
 if ($ajaxmode==0)
 {
  if ($obj['type']==GAMEOBJECT_TYPE_CHEST OR $obj['type']==GAMEOBJECT_TYPE_FISHINGHOLE)
  {
   $page_seek = init_pagePerMark($mark, "g_lootLIST", $page);
   $rows = getLootList($obj['data1'], "gameobject_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
   renderLootTableList($rows,  $lang['can_loot'], $page_seek, $totalRecords, $baseLink, "g_lootLIST");
  }
 }

}


