<?php
include_once("conf.php");
include_once("include/info_table_generator.php");
include_once("include/spell_data.php");
include_once("include/gameobject_table.php");
include_once("include/report_generator.php");
include_once("spell_details.php");
##########
/*
  Скрипт показывает спелл по entry
  Показывает:
   - Детальную информацию о спелле
   - Кастуется рядом с обьектом
   - Вывод реагентов спелла
   - Вывод чем может быть улучшен
   - Этому спеллу обучают свитки:
   - Этому спеллу обучают за выполненный квест
   - Обучает тренер
   - Стартует с помощью другого спелла
   - Вещи получаемые со спелла
   - Вещи использующие этот спелл
   - Энчанты использующие этот спелл
   - В какой ветке талатнов этот спелл
   - Глифы использующие этот спелл (wotlk)
   - Наборы использующие этот спелл
   - Мобы кастующие этот спелл
   - Кастуют объекты
*/
$entry = intval(@$_REQUEST['spell']);
$page  = intval(@$_REQUEST['page']);
$mark  = @$_REQUEST['mark'];

$spell = getSpell($entry);

if (!$spell)
{
   RenderError($lang['spell_not_found']);
}
else
{
  $baseLink = '?spell='.$entry;
  if ($ajaxmode==0)
  {
  if ($lang['www_spell'])
   echo "<a href=\"".sprintf($lang['www_spell'], $entry)."\" target=\"_blank\"\">".sprintf($lang['www_spell'], $entry)."</a><br>";
   $icon = getSpellIcon($spell['SpellIconID']);
   echo "<table cellspacing=0 celloadding=0 width=500><tbody>";
   echo "<tr>";
   echo "<td valign=top align=right width=20%>";
   echo "<br><a href=\"#\"><img border=0 src='$icon' width=64></a></td>";
   echo "<td>";generateSpellTable($spell);echo "</td>";
   echo "</tr>";
   if ($spell['ToolTip'] && $spell['ToolTip']!=$spell['Description'])
   {
    echo "<tr>";
    echo "<td valign=top align=right>";
    if ($spell['activeIconID'] && $spell['SpellIconID']!=$spell['activeIconID'])
    {
       $buff_icon = getSpellIcon($spell['activeIconID']);
       echo "<br><a href=\"#\"><img border=0 src='$buff_icon' width=64></a>";
    }
    echo "</td>";
    echo "<td>";generateSpellBuffTable($spell);echo "</td>";
    echo "</tr>";
   }
   echo "</tbody></table>";
   echo "<br>";
   //********************************************************************************
   // Вывод данных по спеллу
   //********************************************************************************
   createSpellDetails($spell);
  }

  createReportTab();
  //********************************************************************************
  // Кастуется рядом с обьектом
  //********************************************************************************
  if ($spell['RequiresSpellFocus'])
  {
    $focus =& new GameobjectReportGenerator();
    $fields = array('GO_REPORT_NAME', 'GO_REPORT_MAP');
    if ($focus->Init($fields, $baseLink, 'focusLIST', $config['fade_limit'], 'name'))
    {
      $focus->spellFocus($spell['RequiresSpellFocus']);
      $focus->createReport(sprintf($lang['spell_req_focus'], getSpellFocusName($spell['RequiresSpellFocus'])));
    }
  }

  //********************************************************************************
  // Скорее всего спелл может быть улучшен - ищем чем..
  //********************************************************************************
  if ($spell['SpellFamilyFlags_1'] || $spell['SpellFamilyFlags_2'] || $spell['SpellFamilyFlags_3'])
  {
    $affected =& new SpellReportGenerator;
    $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_NAME');
    if ($affected->Init($fields, $baseLink, 'affectLIST', $config['fade_limit'], 'name'))
    {
      $affected->affectedBySpells($spell['SpellFamilyName'], $spell['SpellFamilyFlags_1'], $spell['SpellFamilyFlags_2'], $spell['SpellFamilyFlags_3']);
      $affected->createReport($lang['spell_affected_by']);
    }
  }
  //******************* Ищем кто или что обучает этому спеллу *********************************
  // Этому спеллу обучают свитки:
  //********************************************************************************
  $item_cast =& new ItemReportGenerator();
  $fields = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME');
  if ($item_cast->Init($fields, $baseLink, 'itemLIST', $config['fade_limit'], 'name'))
  {
    $item_cast->recipeSpell($entry);
    $item_cast->createReport($lang['spell_learned_by_recipe']);
  }
  //********************************************************************************
  // Этому спеллу обучают за выполненный квест
  //********************************************************************************
  $quest_list =& new QuestReportGenerator();
  $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'QUEST_REPORT_GIVER_END', 'QUEST_REPORT_REWARD');
  if ($quest_list->Init($fields, $baseLink, 'questLIST', $config['fade_limit'], 'name'))
  {
    $quest_list->rewardSpell($entry);
    $quest_list->createReport($lang['quest_spell_train']);
  }
  //********************************************************************************
  // Обучает тренер
  //********************************************************************************
  $trainer =& new CreatureReportGenerator('trainer');
  $fields = array('NPC_REPORT_RNAME', 'TRAINER_REPORT_COST', 'TRAINER_REPORT_SKILL', 'NPC_REPORT_MAP');
  if ($trainer->Init($fields, $baseLink, 'trainerLIST', $config['fade_limit'], 'scost'))
  {
     $trainer->trainSpell($entry);
     $trainer->createReport($lang['npc_spell_train']);
  }

  //********************************************************************************
  // Стартует с помощью другого спелла
  //********************************************************************************
  $triggers =& new SpellReportGenerator;
  $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_NAME');
  if ($triggers->Init($fields, $baseLink, 'triggersLIST', $config['fade_limit'], 'name'))
  {
    $triggers->triggerFromSpells($entry);
    $triggers->createReport($lang['spell_trigger']);
  }
  //********************************************************************************
  // Вещи получаемые со спелла
  //********************************************************************************
  {
   $page_seek = init_pagePerMark($mark, "spell_lootLIST", $page);
   $rows = getLootList($entry, "spell_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
   renderLootTableList($rows, $lang['spell_contain_loot'], $page_seek, $totalRecords, $baseLink, "spell_lootLIST");
  }
  //********************************************************************************
  // Вещи использующие этот спелл
  //********************************************************************************
  $item_cast =& new ItemReportGenerator();
  $fields = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME');
  if ($item_cast->Init($fields, $baseLink, 'itemLIST', $config['fade_limit'], 'name'))
  {
    $item_cast->useSpell($entry);
    $item_cast->createReport($lang['item_uses_spell']);
  }
  //********************************************************************************
  // Энчанты использующие этот спелл
  //********************************************************************************
  $enchant =& new EnchantReportGenerator();
  $fields = array('ENCH_REPORT_ID','ENCH_REPORT_NAME', 'ENCH_REPORT_GEM');
  if ($enchant->Init($fields, $baseLink, 'enchantLIST', $config['fade_limit'], 'name'))
  {
    $enchant->useSpell($entry);
    $enchant->createReport($lang['spell_added_by_enchant']);
  }
  //********************************************************************************
  // Ветка Талантов использующие этот спелл
  //********************************************************************************
  $talent =& new TalentReportGenerator();
  $fields = array('TALENT_REPORT_ID','TALENT_REPORT_NAME');
  if ($talent->Init($fields, $baseLink, 'talentLIST', $config['fade_limit'], ''))
  {
    $talent->useSpell($entry);
    $talent->createReport($lang['spell_talent']);
  }
  //********************************************************************************
  // Символы использующие этот спелл
  //********************************************************************************
  $glyph =& new GlyphReportGenerator();
  $fields = array('GLYPH_REPORT_ID', 'GLYPH_REPORT_ICON', 'GLYPH_REPORT_NAME');
  if ($glyph->Init($fields, $baseLink, 'glyphLIST', $config['fade_limit'], ''))
  {
    $glyph->useSpell($entry);
    $glyph->createReport($lang['spell_used_by_glyph']);
  }
  //********************************************************************************
  // Наборы использующие этот спелл
  //********************************************************************************
  $sets =& new ItemSetReportGenerator();
  $fields = array('SET_REPORT_ID', 'SET_REPORT_NAME', 'SET_REPORT_ITEM');
  if ($sets->Init($fields, $baseLink, 'setLIST', $config['fade_limit'], 'name'))
  {
     $sets->useSpell($entry);
     $sets->createReport($lang['spell_added_by_set']);
  }
  //********************************************************************************
  // Мобы кастующие этот спелл
  //********************************************************************************
  $npc =& new CreatureReportGenerator();
  $fields = array('NPC_REPORT_LEVEL', 'NPC_REPORT_NAME', 'NPC_REPORT_REACTION', 'NPC_REPORT_MAP');
  if ($npc->Init($fields, $baseLink, 'creatureLIST', $config['fade_limit'], 'level'))
  {
     $npc->castSpell($entry);
     $npc->createReport($lang['spell_casted_by']);
  }
  //********************************************************************************
  // Кастуют объекты
  //********************************************************************************
  $go =& new GameobjectReportGenerator();
  $fields = array('GO_REPORT_NAME','GO_REPORT_TYPE','GO_REPORT_MAP');
  if ($go->Init($fields, $baseLink, 'gameobjectLIST', $config['fade_limit'], 'name'))
  {
    $go->castSpell($entry);
    $go->createReport($lang['spell_go_cast']);
  }
}
?>


