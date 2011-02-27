<?php
include_once("conf.php");
include_once("include/creature_table.php");
include_once("include/info_table_generator.php");
include_once("include/report_generator.php");
##########
/*
 Скрипт показывает Creature по его $entry
 Показывает:
  - Что кастует
  - Каким спеллом может быть призыван
  - Что он продаёт
  - Чему обучает
  - Нужен для какого квеста
  - В какую группу входит существо (kredit)
  - Какие квесты даёт
  - Какие квесты принимает
  - Лут с существа
  - Лут который можно украсть у существа
  - Лут шкурок с трупа существа
*/
$entry = intval(@$_REQUEST['npc']);
$page  = intval(@$_REQUEST['page']);
$mark  = @$_REQUEST['mark'];

$cr=getCreature($entry);
if (!$cr)
{
  RenderError("$lang[creature_not_found]");
}
else
{
 $baseLink = '?npc='.$entry;

 if ($ajaxmode==0)
 {
 if ($lang['www_creature'])
	echo "<a href=\"".sprintf($lang['www_creature'], $entry)."\" target=\"_blank\"\">".sprintf($lang['www_creature'], $entry)."</a><br>";
  echo "<table cellspacing=0 cellpadding=0 width=500>";
  echo "<tbody>";
  echo "<tr>";
  echo "<td align=center>";generateCreatureTable($cr);echo "</td>";
  echo "</tr>";
  echo "</tbody></table>";

  if ($cr['mingold']!=0)
   echo "<b>$lang[money]</b>&nbsp;&nbsp;".money ($cr['mingold'])."&nbsp&nbsp;-&nbsp;&nbsp;".money ($cr['maxgold'])."<br>";
  $heroic=getHeroicList();
  $hentry=isset($heroic[$entry])?$heroic[$entry]:$entry;
  echo "<a href=\"?map&npc=$hentry\">$lang[show_map] (".getCreatureCount($hentry).")</a><br>";

  if ($config['show_npc_detalis'])
  {
   echo "<br><table class=details width=600>";
   echo "<tbody>";
   echo "<tr><td colspan=4 class=head>$lang[detail_info]</td></tr>";
   echo "<tr><th>entry</th><td>".$cr['entry']."</td><th>difficulty_entry_1</th><td>".$cr['difficulty_entry_1']."</td></tr>";
   echo "<tr><th>difficulty_entry_2</th><td>".$cr['difficulty_entry_2']."</td><th>difficulty_entry_3</th><td>".$cr['difficulty_entry_3']."</td></tr>";
   echo "<tr><th>modelid_1</th><td>".$cr['modelid_1']."</td><th>modelid_3</th><td>".$cr['modelid_3']."</td></tr>";
   echo "<tr><th>modelid_2</th><td>".$cr['modelid_2']."</td><th>modelid_4</th><td>".$cr['modelid_4']."</td></tr>";
   echo "<tr><th>name</th><td>".$cr['name']."<br><div class=subname>".$cr['subname']."</div></td>";
   echo "<th>IconName</th><td>".$cr['IconName']."</td></tr>";
   echo "<tr><th>level</th><td>".$cr['minlevel']." - ".$cr['maxlevel']."</td>";
   echo "<th>armor</th><td>".$cr['armor']."</td></tr>";
   echo "<tr><th>health</th><td>".$cr['minhealth']." - ".$cr['maxhealth']."</td>";
   echo "<th>mana</th><td>".$cr['minmana']." - ".$cr['maxmana']."</td></tr>";
   echo "<tr><th>faction_A</th><td>".$cr['faction_A']."</td><th>faction_H</th><td>".$cr['faction_H']."</td></tr>";
   echo "<tr><th>npcflag</th><td>".$cr['npcflag']."</td><th>gossip_menu_id</th><td>".$cr['gossip_menu_id']."</td></tr>";
   echo "<tr><th>speed_walk</th><td>".$cr['speed_walk']."</td><th>speed_run</th><td>".$cr['speed_run']."</td></tr>";
   echo "<tr><th>scale</th><td>".$cr['scale']."</td><th>rank</th><td>".$cr['rank']."</td></tr>";
   echo "<tr><th>mindmg</th><td>".$cr['mindmg']."</td><th>maxdmg</th><td>".$cr['maxdmg']."</td></tr>";
   echo "<tr><th>dmgschool</th><td>".$cr['dmgschool']."</td><th>dmg_multiplier</th><td>".$cr['dmg_multiplier']."</td></tr>";
   echo "<tr><th>attackpower</th><td>".$cr['attackpower']."</td><th>rangedattackpower</th><td>".$cr['rangedattackpower']."</td></tr>";
   echo "<tr><th>baseattacktime</th><td>".$cr['baseattacktime']."</td><th>rangeattacktime</th><td>".$cr['rangeattacktime']."</td></tr>";
   echo "<tr><th>unit_flags</th><td>".$cr['unit_flags']."</td><th>dynamicflags</th><td>".$cr['dynamicflags']."</td></tr>";
   echo "<tr><th>unit_class</th><td>".$cr['unit_class']."</td><th>family</th><td>".$cr['family']."</td></tr>";
   echo "<tr><th>trainer_type</th><td>".$cr['trainer_type']."</td><th>trainer_spell</th><td>".$cr['trainer_spell']."</td></tr>";
   echo "<tr><th>trainer_class</th><td>".$cr['trainer_class']."</td><th>trainer_race</th><td>".$cr['trainer_race']."</td></tr>";
   echo "<tr><th>minrangedmg</th><td>".$cr['minrangedmg']."</td><th>maxrangedmg</th><td>".$cr['maxrangedmg']."</td></tr>";
   echo "<tr><th>type</th><td>".$cr['type']."</td><th>type_flags</th><td>".$cr['type_flags']."</td></tr>";
   echo "<tr><th>lootid</th><td>".$cr['lootid']."</td></tr>";
   echo "<tr><th>pickpocketloot</th><td>".$cr['pickpocketloot']."</td></tr>";
   echo "<tr><th>skinloot</th><td>".$cr['skinloot']."</td></tr>";
   echo "<tr><th>resistance1</th><td>".$cr['resistance1']."</td><th>resistance2</th><td>".$cr['resistance2']."</td></tr>";
   echo "<tr><th>resistance3</th><td>".$cr['resistance3']."</td><th>resistance4</th><td>".$cr['resistance4']."</td></tr>";
   echo "<tr><th>resistance5</th><td>".$cr['resistance5']."</td><th>resistance6</th><td>".$cr['resistance6']."</td></tr>";
   echo "<tr><th>spell1</th><td>".$cr['spell1']."</td><th>spell2</th><td>".$cr['spell2']."</td></tr>";
   echo "<tr><th>spell3</th><td>".$cr['spell3']."</td><th>spell4</th><td>".$cr['spell4']."</td></tr>";
   echo "<tr><th>PetSpellDataId</th><td>".$cr['PetSpellDataId']."</td></tr>";
   echo "<tr><th>mingold</th><td>".$cr['mingold']."</td><th>maxgold</th><td>".$cr['maxgold']."</td></tr>";
   echo "<tr><th>MovementType</th><td>".$cr['MovementType']."</td><th>InhabitType</th><td>".$cr['InhabitType']."</td></tr>";
   echo "<tr><th>RacialLeader</th><td>".$cr['RacialLeader']."</td><th>RegenHealth</th><td>".$cr['RegenHealth']."</td></tr>";
   echo "<tr><th>equipment_id</th><td>".$cr['equipment_id']."</td></tr>";
   echo "<tr><th>mechanic_immune_mask</th><td>".$cr['mechanic_immune_mask']."</td></tr>";
   echo "<tr><th>flags_extra</th><td>".$cr['flags_extra']."</td></tr>";
   echo "<tr><th>AIName</th><td>".$cr['AIName']."</td><th>ScriptName</th><td>".$cr['ScriptName']."</td></tr>";
   echo "</tbody></table>";
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
    $summoned_by->summonCreature($entry);
    $summoned_by->createReport($lang['summoned_by_spell']);
 }
 //********************************************************************************
 //  Cast spells
 //********************************************************************************
 $cast_spell =& new SpellReportGenerator;
 $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_NAME');
 if ($cast_spell->Init($fields, $baseLink, 'castLIST', $config['fade_limit'], 'name'))
 {
   $cast_spell->castByCreature($cr);
   $cast_spell->createReport($lang['cast_spells']);
 }
 //**************************************************
 // Vendor items list
 //**************************************************
 if ($cr['npcflag']&(UNIT_NPC_FLAG_VENDOR|UNIT_NPC_FLAG_VENDOR_AMMO|UNIT_NPC_FLAG_VENDOR_FOOD|UNIT_NPC_FLAG_VENDOR_POISON|UNIT_NPC_FLAG_VENDOR_REAGENT))
 {
  $sold =& new ItemReportGenerator('vendor');
  $fields = array('ITEM_REPORT_ICON','ITEM_REPORT_NAME', 'VENDOR_REPORT_COST', 'VENDOR_REPORT_COUNT', 'VENDOR_REPORT_INCTIME');
  if ($sold->Init($fields, $baseLink, 'vendorLIST', $config['fade_limit'], 'name'))
  {
    $sold->vendorItemList($entry);
    $sold->createReport($lang['sold']);
  }
 }
 //**************************************************
 // Train spells
 //**************************************************
 if ($cr['npcflag']&(UNIT_NPC_FLAG_TRAINER|UNIT_NPC_FLAG_TRAINER_CLASS|UNIT_NPC_FLAG_TRAINER_PROFESSION))
 {
  $train =& new NPCTrainerReportGenerator();
  $fields = array('TRAIN_REPORT_LEVEL','TRAIN_REPORT_ICON', 'TRAIN_REPORT_NAME', 'TRAIN_REPORT_SKILL', 'TRAIN_REPORT_VALUE', 'TRAIN_REPORT_COST');
  if ($train->Init($fields, $baseLink, 'trainLIST', $config['fade_limit'], 'level'))
  {
    $train->trainSpell($entry);
    $train->createReport($lang['train']);
  }
 }
 //********************************************************************************
 // Required for quest list
 //********************************************************************************
 $reqForQuest =& new QuestReportGenerator();
 $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'QUEST_REPORT_REWARD');
 if ($reqForQuest->Init($fields, $baseLink, 'qreqLIST', $config['fade_limit'], 'name'))
 {
    $reqForQuest->requireCreature($entry);
    $reqForQuest->createReport($lang['req_for_quest']);
 }
 //********************************************************************************
 // Kill kredit list
 //********************************************************************************
 $kredit =& new CreatureReportGenerator();
 $fields = array('NPC_REPORT_LEVEL', 'NPC_REPORT_RNAME', 'NPC_REPORT_MAP');
 if ($kredit->Init($fields, $baseLink, 'r_creatureLIST', $config['fade_limit'], 'name'))
 {
    $kredit->kreditGroup($entry);
    $kredit->createReport($lang['kill_kredit_group']);
 }
 //**************************************************
 // Give quests
 //**************************************************
 if ($cr['npcflag']&(UNIT_NPC_FLAG_QUESTGIVER))
 {
  $giveQuest =& new QuestReportGenerator('npc_giver');
  $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_REWARD');
  if ($giveQuest->Init($fields, $baseLink, 'qgLIST', $config['fade_limit'], 'name'))
  {
    $giveQuest->getGiveTakeList($entry);
    $giveQuest->createReport($lang['give_quest']);
  }
 }
 //**************************************************
 // Take quests
 //**************************************************
 if ($cr['npcflag']&(UNIT_NPC_FLAG_QUESTGIVER))
 {
  $takeQuest =& new QuestReportGenerator('npc_take');
  $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_REWARD');
  if ($takeQuest->Init($fields, $baseLink, 'qtLIST', $config['fade_limit'], 'name'))
  {
    $takeQuest->getGiveTakeList($entry);
    $takeQuest->createReport($lang['take_quest']);
  }
 }

 //**************************************************
 // Loot list
 //**************************************************
 if ($ajaxmode==0)
 {
  if ($cr['lootid'])
  {
   /*
   $loot =& new LootReportGenerator('creature_loot');
   if ($loot->Init($fields, $baseLink, 'lootLIST', $config['fade_limit'], ''))
   {
     $loot->getLootList($cr['lootid']);
     $loot->createReport($lang['can_loot']);
   }*/
   $page_seek = init_pagePerMark($mark, "lootLIST", $page);
   $rows = getLootList($cr['lootid'], "creature_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
   renderLootTableList($rows, $lang['can_loot'], $page_seek, $totalRecords, $baseLink, "lootLIST");
  }
 }
 //**************************************************
 // Pickpocket loot
 //**************************************************
 if ($ajaxmode==0)
 {
  if ($cr['pickpocketloot'])
  {
   $page_seek = init_pagePerMark($mark, "pickpocketLIST", $page);
   $rows = getLootList($cr['pickpocketloot'], "pickpocketing_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
   renderLootTableList($rows, $lang['can_pickpocketing'], $page_seek, $totalRecords, $baseLink, "pickpocketLIST");
  }
 }
 //**************************************************
 // Skining loot
 //**************************************************
 if ($ajaxmode==0)
 {
  if ($cr['skinloot'])
  {
   $page_seek = init_pagePerMark($mark, "skinLIST", $page);
   $rows = getLootList($cr['skinloot'], "skinning_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
  if ($cr['type_flags'] & CREATURE_TYPEFLAGS_HERBLOOT)
   renderLootTableList($rows, $lang['give_herb'], $page_seek, $totalRecords, $baseLink, "skinLIST");
  else if ($cr['type_flags'] & CREATURE_TYPEFLAGS_MININGLOOT)
   renderLootTableList($rows, $lang['give_mining'], $page_seek, $totalRecords, $baseLink, "skinLIST");
  else if ($cr['type_flags'] & CREATURE_TYPEFLAGS_ENGINEERLOOT)
   renderLootTableList($rows, $lang['give_engineer'], $page_seek, $totalRecords, $baseLink, "skinLIST");
  else
   renderLootTableList($rows, $lang['give_skin'], $page_seek, $totalRecords, $baseLink, "skinLIST");
  }
 }
}