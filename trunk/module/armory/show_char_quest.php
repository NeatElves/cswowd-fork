<?php
//==============================================================================
// Скрипт предназначен для вывода квестов игрока
//==============================================================================
include_once("include/report_generator.php");

function getCharacterQueststatus($character_id)
{
  global $cDB;
  return $cDB->select("-- CACHE: 1h
  SELECT * FROM `character_queststatus` WHERE `guid` = ?d ORDER BY `quest`", $character_id);
}

function showPlayerQuests($guid, $char_data)
{
  global $lang;
  $quests = getCharacterQueststatus($guid);
  // Показ активных квестов
  echo "<TABLE class=report width=500><TBODY>";
  echo "<TR><TD colspan=3 class=head>".$lang['player_active_quest']."</TD></TR>";
  
  if ($quests)
  foreach ($quests as $quest)
  {
   $questId = $quest['quest'];
   if ($questId AND $questinfo=getQuest($questId) AND 
	(($quest['status'] == 1 OR $quest['status'] == 3 OR $quest['status'] == 5) AND $quest['rewarded'] != 1))
   {
    echo '<tr>';
    echo '<td>';r_questLvl($questinfo); echo '</td>';
    echo '<td class=left>';r_questName($questinfo); echo '</td>';
    echo '<td class=left>';r_questReward($questinfo);echo '</td>';
    echo '</tr>';
   }
  }
  echo "</TBODY></TABLE>";
}
?>