<?php
//==============================================================================
// Скрипт предназначен для вывода квестов игрока
//==============================================================================
include_once("include/report_generator.php");

function showPlayerQuests($guid, $char_data)
{
  global $lang;
  // Показ активных квестов
  echo "<TABLE class=report width=500><TBODY>";
  echo "<TR><TD colspan=3 class=head>".$lang['player_active_quest']."</TD></TR>";
  for ($i=0;$i<25;$i++)
  {
   $questId = $char_data[PLAYER_QUEST_LOG_1_1 + $i*4];
   if ($questId AND $quest=getQuest($questId))
   {
    echo '<tr>';
    echo '<td>';r_questLvl($quest); echo '</td>';
    echo '<td class=left>';r_questName($quest); echo '</td>';
    echo '<td class=left>';r_questReward($quest);echo '</td>';
    echo '</tr>';
   }
  }
  echo "</TBODY></TABLE>";
}
?>