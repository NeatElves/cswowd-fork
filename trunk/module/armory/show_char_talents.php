<?php
//==============================================================================
// Скрипт предназначен для вывода талантов игрока
//==============================================================================
include_once("include/talent_calc.php");

function showPlayerTalents($guid, $class, $level)
{
  global $lang;
  $bild = generateCharacterBild($guid, $class);
  $calc = array('none', 'warrior', 'paladin', 'hunter', 'rogue', 'priest', 'FUTURE_1', 'shaman', 'mage', 'warlock', 'FUTURE_2', 'druid');
  echo '<div id="talent"></div>';
  echo '<a href="?talent='.$calc[$class].'" id=talent_bild_link>'.$lang['player_talent_calc'].'</a><br>';
  includeTalentScript($class, -1, $level, getClass($class));
  echo '<script type="text/javascript">tc_bildFromStr("'.$bild['calc_bild'].'");</script>';
  echo '<script type="text/javascript">tc_renderTree("talent");</script>';
}
?>