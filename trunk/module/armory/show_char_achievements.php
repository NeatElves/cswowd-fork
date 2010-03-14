<?php
//==============================================================================
// Скрипт предназначен для вывода достижений игрока
//==============================================================================
include_once("include/achievements.php");

function showPlayerAchievements($guid, $faction)
{
    renderAchievementData(0, $guid, $faction);
}
?>