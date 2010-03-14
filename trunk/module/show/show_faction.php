<?php
include_once("conf.php");
include_once("include/info_table_generator.php");
include_once("include/report_generator.php");
include_once("include/faction_table.php");

##########
/*
 Скрипт показывает фракцию по $entry
 Показывает:
 - Входящие в состав фракции
 - Входит в группу фракций
 - Существа из данной фракции
   Как можно получить репутацию:
   - Награда за квест
   - Получена от спелла
*/

$entry = intval(@$_REQUEST['faction']);

$page=intval(@$_REQUEST['page']);
$sort=@$_REQUEST['sort'];
$mark=@$_REQUEST['mark'];
$faction=getFaction($entry);
if (!$faction)
{
  RenderError("Faction not found");
}
else
{
  $baseLink = "?faction=$entry";

  if ($ajaxmode==0)
    generateFactionTable($faction);

  createReportTab();
  if ($ajaxmode==0)
  {
    // Входящие в состав фракции
    $page_seek = init_pagePerMark($mark, "teamLIST", $page);
    $rows = $wDB->selectPage($totalRecords,
    'SELECT
     *
     FROM `wowd_faction`
     WHERE `team` = ?d
     LIMIT ?d, ?d', $entry, $page_seek, $config['fade_limit']);
    renderFactionGroupList($faction, $rows, $lang['faction_contain'], $page_seek, $totalRecords, $baseLink, 'teamLIST');
    // Входит в группу фракций
    if ($faction['team'])
    {
      $parent = getFaction($faction['team']);
      $page_seek = init_pagePerMark($mark, "cteamLIST", $page);
      $rows = $wDB->selectPage($totalRecords,
      'SELECT
       *
       FROM `wowd_faction`
       WHERE `team` = ?d
       LIMIT ?d, ?d', $faction['team'], $page_seek, $config['fade_limit']);
      renderFactionGroupList($parent, $rows, $lang['faction_in'], $page_seek, $totalRecords, $baseLink, 'cteamLIST');
    }/**/
  }

  $templatesId = 0;
  // Состав фракции
  // Существа из данной фракции
  $npc =& new CreatureReportGenerator();
  $fields = array('NPC_REPORT_LEVEL', 'NPC_REPORT_NAME', 'NPC_REPORT_REACTION', 'NPC_REPORT_MAP');
  if ($npc->Init($fields, $baseLink, 'creatureLIST', $config['fade_limit'], 'level'))
  {
    $npc->inFaction($entry);
    $npc->createReport($lang['faction_npc']);
  }
  // Объекты из данной фракции
  $go =& new GameobjectReportGenerator();
  $fields = array('GO_REPORT_NAME','GO_REPORT_TYPE','GO_REPORT_MAP');
  if ($go->Init($fields, $baseLink, 'gameobjectLIST', $config['fade_limit'], 'name'))
  {
    $go->inFaction($entry);
    $go->createReport($lang['faction_go']);
  }
  //********************************************************************************
  // Вещи требующие данной фракции
  //********************************************************************************
  $item_req =& new ItemReportGenerator();
  $fields = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQREP_RANK');
  if ($item_req->Init($fields, $baseLink, 'itemreqLIST', $config['fade_limit'], 'rep_rank'))
  {
    $item_req->requireReputation($entry);
    $item_req->createReport($lang['faction_item']);
  }
  //********************************************************************************
  // Как можно получить репутацию:
  //********************************************************************************
  // Награда за квест
  //********************************************************************************
  $quest_list =& new QuestReportGenerator();
  $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'QUEST_REPORT_REWARD');
  if ($quest_list->Init($fields, $baseLink, 'questLIST', $config['fade_limit'], 'name'))
  {
    $quest_list->rewardReputation($entry);
    $quest_list->createReport($lang['faction_quest_rew']);
  }
  //********************************************************************************
  // Награда за существо
  //********************************************************************************
  $r_npc =& new CreatureReportGenerator('reputation');
  $fields = array('NPC_REPORT_LEVEL', 'NPC_REPORT_RNAME', 'ONKILL_REPUTATION', 'NPC_REPORT_MAP');
  if ($r_npc->Init($fields, $baseLink, 'r_creatureLIST', $config['fade_limit'], 'rep'))
  {
    $r_npc->rewardFactionReputation($entry);
    $r_npc->createReport($lang['faction_kill_rew']);
  }

  //********************************************************************************
  // Награда от спелла
  //********************************************************************************
  $spell_list =& new SpellReportGenerator;
  $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_NAME');
  if ($spell_list->Init($fields, $baseLink, 'spellLIST', $config['fade_limit'], 'name'))
  {
    $spell_list->giveReputation($entry);
    $spell_list->createReport($lang['faction_spell_rew']);
  }
}
?>