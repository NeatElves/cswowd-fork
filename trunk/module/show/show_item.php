<?php
include_once("conf.php");
include_once("include/info_table_generator.php");
include_once("include/gameobject_table.php");
include_once("include/report_generator.php");

##########
/*
  Скрипт показывает вещь по entry
  Показывает:
   - Если часть набора - весь набор
   - Если рецепт, что можно сделать
   - Рандом энчанты вещи
   - Список предметов которые можно обменять на нее
   - Если заперта, что нужно для открытия
   - Список предметов/go которые можно открыть предметом
   - Начинает квест
   - Лут вещи как с сундука
   - Лут вещи как с руды
   - Лут вещи как с растения (milling)
   - Лут вещи дизэнчантом
   - Используется в качестве реагента
   - Создана спеллом
   - Продавцы вещи
   - Награда за квест
   - Нужен для квеста
   - Высылаемая по почте при завершении квеста
   - Даётся при взятии квеста
   - Лут с мобов
   - Украсть у мобов
   - Ошкурено с мобов
   - Лут с обьектов
   - Лут с очистки руды
   - Лут с вещей
   - Лут с дизэнчанта
   - Лут с рыбалки
*/

// Can be pointer ?item=g1000 - so need load and show item by guid
// Else load item by entry
$str = @$_REQUEST['item'];
if (substr($str,0,1) == 'g')
{
    $item_data = getItemData(intval(substr($str,1,10)));
    $entry = $item_data[ITEM_FIELD_ENTRY];
}
else
{
    $item_data = 0;
    $entry = intval($str);
}
$page  = intval(@$_REQUEST['page']);
$mark  = @$_REQUEST['mark'];
// Получаем вещь
$item = getItem($entry);

$flags2 = getItemFlags2($entry);

if (!$item)
{
   RenderError("$lang[item_not_found]");
}
else
{
  $baseLink = '?item='.$str;
  if ($config['www_item'])
	echo "<a href=\"".sprintf($config['www_item'], $entry)."\" target=\"_blank\"\">".sprintf($config['www_item'], $entry)."</a><br>";
  if ($ajaxmode==0)
  {
   echo "<TABLE cellSpacing=0 cellPadding=0 width=500><TBODY><TR>";
   echo "<TD vAlign=top align=right width=20%>";
   $icon = getItemIcon($item['displayid']);
   echo "<br><A id='no_tip' href=\"?item=$entry\"><IMG height=64 width=64 border=0 src='$icon'></A></TD>";
   echo "<TD>";generateItemTable($item,$item_data,0);echo "</TD>";
   echo "</TR></TBODY></TABLE>";

   if ($item['minMoneyLoot']) echo "$lang[Rew_money] ".money($item['minMoneyLoot']);
   if (($item['maxMoneyLoot']) && ($item['maxMoneyLoot']>$item['minMoneyLoot'])) echo " - ".money($item['maxMoneyLoot']);

   if ($flags2&ITEM_FLAGS2_HORDE_ONLY) echo "<FONT color=#ff0000> $lang[reqirement]: $lang[Horde]</FONT>";
   if ($flags2&ITEM_FLAGS2_ALLIANCE_ONLY) echo "<FONT color=#0000ff> $lang[reqirement]: $lang[Alliance]</FONT>";
   echo "<br />";
   if ($item['BuyPrice']) echo "$lang[buy_price]: ".money($item['BuyPrice']);
   echo "<br />";

   //********************************************************************************
   // Если часть набора - выводим весь набор
   //********************************************************************************
   if ($item['itemset'])
   {
    $set    = getItemSet($item['itemset']);
    $setkey = array_keys($set);
    if ($set)
    {
     echo "<TABLE class=report width=500 border = 1>";
     echo "<TBODY>";
     echo '<TR><TD class=head>'.$lang['this_item_part_of_set'].' - ';r_setName($set); echo '</TD></TR>';
     echo "<TR><TD class=set>";r_setItems($set);echo "</TD></TR>";
     echo "<TR><TD class=left>";r_setSpells($set);echo "</TD></TR>";
    }
    else
     echo "<TR><TD>Unknown SET = $item[itemset]</TD></TR>";
    echo "</TBODY></TABLE>";
   }
  }
  createReportTab();
  //********************************************************************************
  // Если item class -> recipe выводим что можно сделать
  //********************************************************************************
  if ($item['spellid_1'] == 483)
  {
   $recipe =& new SpellReportGenerator;
   $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_RECIPE','SPELL_REPORT_REAGENTS', 'SPELL_REPORT_CREATE');
   if ($recipe->Init($fields, $baseLink, 'recipeLIST', $config['fade_limit'], ''))
   {
     $recipe->doRequirest('`id` = ?d', $item['spellid_2']);
     $recipe->createReport($lang['recipe_for']);
   }
  }
  //********************************************************************************
  // Рандом энчанты вещи
  //********************************************************************************
  if ($ajaxmode==0 AND ($item['RandomProperty'] OR $item['RandomSuffix']))
  {
      $randEnch = $item['RandomProperty'] ? $item['RandomProperty']:$item['RandomSuffix'];
      $rows = $dDB->selectPage($totalRecords, "SELECT * FROM `item_enchantment_template` WHERE `entry` = ?d ORDER BY `chance` DESC", $randEnch);
      if ($rows)
      {
       $points = getRandomPropertyPoint($item['ItemLevel'], $item['InventoryType'], $item['Quality']);
       echo '<div class=reportContainer id=randList>';
       addTab($lang['random_enchants'].' ('.$totalRecords.')', 'randList');
       echo "<table class=report width=500>";
       echo "<tbody>";
       echo "<TR class=head><TD colSpan=4>$lang[random_enchants]</TD></TR>";
       echo "<tr><th>$lang[enchant_id]</th><th>$lang[random_enc_name]</th><th>$lang[random_enc_info]</th><th>$lang[random_enc_cnance]</th></tr>";
       foreach ($rows as $i_ench)
       {
          echo "<tr>";
          if ($item['RandomSuffix'])
          {
           $prop = getRandomSuffix($i_ench['ench']);
           echo "<td class=small>".$prop['id']."</td>";
           echo "<td class=left>&nbsp;... ".$prop['name']."</td>";
           echo "<td class=left>";
           for ($j=1;$j<=3;$j++)
              if ($prop['EnchantID_'.$j])
              {
                 $text = getEnchantmentDesc($prop['EnchantID_'.$j]);
                 echo str_ireplace('$i', round($points * $prop['Prefix_'.$j]/10000, 0), $text)."<br>";
              }
           echo "</td>";
           echo "<td>$i_ench[chance]%</td>";
           echo "</tr>";
          }
          else
          {
           $prop = getRandomProperty($i_ench['ench']);
           echo "<td>".$prop['id']."</td>";
           echo "<td>".$prop['name']."</td>";
           echo "<td>";
           for ($j=1;$j<=5;$j++)
              if ($prop['EnchantID_'.$j])
                 echo getEnchantmentDesc($prop['EnchantID_'.$j])."<br>";
           echo "</td>";
          echo "<td align=center>$i_ench[chance]%</td>";
           echo "</tr>";
          }
       }
       echo "</tbody></table></div>";
      }
  }

  //********************************************************************************
  // Является ценой для других предметов
  //********************************************************************************
  $excost =& new ExCostReportGenerator();
  $fields = array('EXCOST_REPORT_ID', 'EXCOST_REPORT_ITEM', 'EXCOST_REPORT_COST');
  if ($excost->Init($fields, $baseLink, 'excostLIST', $config['fade_limit'], 'cost'))
  {
    $excost->useItemAsCost($entry);
    $excost->createReport($lang['item_is_ex_cost']);
  }
  //********************************************************************************
  // How can possible open it (lock info)
  //********************************************************************************
  if ($item['lockid'])
  {
   $locked =& new LockReportGenerator();
   $fields = array('LOCK_REPORT_ID', 'LOCK_REPORT_KEY');
   if ($locked->Init($fields, $baseLink, 'lockLIST', $config['fade_limit'], ''))
   {
    $locked->doRequirest('`id` = ?d', $item['lockid']);
    $locked->createReport($lang['locked_item']);
   }
  }
  //********************************************************************************
  // This item is key for:
  //********************************************************************************
  $locked =& new LockReportGenerator();
  $fields = array('LOCK_REPORT_ID', 'LOCK_REPORT_HAVE');
  if ($locked->Init($fields, $baseLink, 'lockLIST', $config['fade_limit'], ''))
  {
    $locked->haveItemAsKey($entry);
    $locked->createReport($lang['can_unlock']);
  }
  //********************************************************************************
  // Give quest list
  //********************************************************************************
  if ($item['startquest'])
  {
   $giveQuest =&new QuestReportGenerator('item_giver');
   $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_REWARD');
   if ($giveQuest->Init($fields, $baseLink, 'qgLIST', $config['fade_limit'], 'name'))
   {
     $giveQuest->oneQuest($item['startquest']);
     $giveQuest->createReport($lang['give_quest']);
   }
  }
  //********************************************************************************
  // Лут с этой вещи
  //********************************************************************************
  if ($ajaxmode==0)
  {
  // Как с сундука
  if ($item['Flags' ]& ITEM_FLAGS_OPENABLE)
  {
   $page_seek = init_pagePerMark($mark, "lock_lootLIST", $page);
   $rows = getLootList($item['entry'], "item_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
   renderLootTableList($rows, $lang['item_contain_loot'], $page_seek, $totalRecords, $baseLink, "lock_lootLIST");
  }
  // Как с руды
  if ($item['Flags'] & ITEM_FLAGS_PROSPECTABLE)
  {
   $page_seek = init_pagePerMark($mark, "prospect_lootLIST", $page);
   $rows = getLootList($item['entry'], "prospecting_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
   renderLootTableList($rows, $lang['contain_prospecting_loot'], $page_seek, $totalRecords, $baseLink, "prospect_lootLIST");
  }
  // Если растолочь
  if ($item['Flags'] & ITEM_FLAGS_MILLABLE)
  {
   $page_seek = init_pagePerMark($mark, "milling_lootLIST", $page);
   $rows = getLootList($item['entry'], "milling_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
   renderLootTableList($rows, $lang['contain_milling_loot'], $page_seek, $totalRecords, $baseLink, "milling_lootLIST");
  }
  // Как дизэнчантом
  if ($item['DisenchantID'])
  {
   $page_seek = init_pagePerMark($mark, "disenchant_lootLIST", $page);
   $rows = getLootList($item['DisenchantID'], "disenchant_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
   renderLootTableList($rows, $lang['contain_disenchant_loot'], $page_seek, $totalRecords, $baseLink, "disenchant_lootLIST");
  }
  }
  //********************************************************************************
  // Используется в качестве реагента
  //********************************************************************************
  $reagent_in =& new SpellReportGenerator;
  $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_RECIPE','SPELL_REPORT_REAGENTS', 'SPELL_REPORT_CREATE');
  if ($reagent_in->Init($fields, $baseLink, 'reagentLIST', $config['fade_limit'], 'icon'))
  {
    $reagent_in->useRegent($entry);
    $reagent_in->createReport($lang['item_use_in_spell']);
  }
  //********************************************************************************
  // Spell loot
  //********************************************************************************
  $created_by =& new SpellReportGenerator;
  $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_RECIPE','SPELL_REPORT_REAGENTS', 'SPELL_REPORT_CREATE');
  if ($created_by->Init($fields, $baseLink, 'createLIST', $config['fade_limit'], 'name'))
  {
    $created_by->createItem($entry);
    $created_by->createReport($lang['create_from_spell']);
  }
  //********************************************************************************
  // Создана спеллом
  //********************************************************************************
  $spell_loot =& new SpellReportGenerator;
  $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_RECIPE', 'SPELL_REPORT_REAGENTS');
  if ($spell_loot->Init($fields, $baseLink, 'spelllootLIST', $config['fade_limit'], 'name'))
  {
    $spell_loot->lootItem($entry);
    $spell_loot->createReport($lang['loot_from_spell']);
  }
  //********************************************************************************
  // Продавцы вещи
  //********************************************************************************
  $vendors =& new CreatureReportGenerator('vendor');
  $fields = array('NPC_REPORT_RNAME', 'VENDOR_REPORT_COST', 'VENDOR_REPORT_COUNT', 'VENDOR_REPORT_INCTIME', 'NPC_REPORT_MAP');
  if ($vendors->Init($fields, $baseLink, 'vendorLIST', $config['fade_limit'], 'name'))
  {
    $vendors->soldItem($entry, $item['BuyPrice']);
    $vendors->createReport($lang['npc_sold_loot']);
  }
  //********************************************************************************
  // Quest list reward this item
  //********************************************************************************
  $qReward =&new QuestReportGenerator();
  $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'QUEST_REPORT_REWARD');
  if ($qReward->Init($fields, $baseLink, 'qrewardLIST', $config['fade_limit'], 'name'))
  {
    $qReward->rewardItem($entry);
    $qReward->createReport($lang['quest_reward_loot']);
  }
  //********************************************************************************
  // Required for quest (except if this item quest)
  //********************************************************************************
  $reqForQuest =&new QuestReportGenerator();
  $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'QUEST_REPORT_REWARD');
  if ($reqForQuest->Init($fields, $baseLink, 'qreqLIST', $config['fade_limit'], 'name'))
  {
    $reqForQuest->requireItem($entry, $item['startquest']);
    $reqForQuest->createReport($lang['quest_req_loot']);
  }
  //********************************************************************************
  // Give on quest take (except if this item quest)
  //********************************************************************************
  $srcForQuest =&new QuestReportGenerator();
  $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'QUEST_REPORT_REWARD');
  if ($srcForQuest->Init($fields, $baseLink, 'qgiveLIST', $config['fade_limit'], 'name'))
  {
    $srcForQuest->provideItem($entry, $item['startquest']);
    $srcForQuest->createReport($lang['quest_src_loot']);
  }
  //********************************************************************************
  // Quest mail loot
  //********************************************************************************
  $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'LOOT_REPORT_REQ', 'LOOT_REPORT_CHANCE');
  $quest_loot =& new QuestReportGenerator('mail_loot');
  if ($quest_loot->Init($fields, $baseLink, 'qlootLIST', $config['fade_limit'], 'chance'))
  {
    $quest_loot->lootItem($entry);
    $quest_loot->createReport($lang['quest_mail_loot']);
  }
  //********************************************************************************
  // Лут с мобов
  //********************************************************************************
  $loot =& new CreatureReportGenerator('loot');
  $fields = array('NPC_REPORT_LEVEL', 'NPC_REPORT_RNAME', 'LOOT_REPORT_REQ', 'LOOT_REPORT_CHANCE', 'NPC_REPORT_MAP');
  if ($loot->Init($fields, $baseLink, 'dropLIST', $config['fade_limit'], 'chance'))
  {
    $loot->lootItem($entry);
    $loot->createReport($lang['drop_loot']);
  }
  //********************************************************************************
  // Украдено у мобов
  //********************************************************************************
  $pick =& new CreatureReportGenerator('pick');
  if ($pick->Init($fields, $baseLink, 'pickLIST', $config['fade_limit'], 'chance'))
  {
    $pick->lootItem($entry);
    $pick->createReport($lang['pickpocketing_loot']);
  }
  //********************************************************************************
  // Ошкурено с мобов
  //********************************************************************************
  $skin =& new CreatureReportGenerator('skin');
  if ($skin->Init($fields, $baseLink, 'skinLIST', $config['fade_limit'], 'chance'))
  {
    $skin->lootItem($entry);
    $skin->createReport($lang['skinning_loot']);
  }
  //************************************************************************************************************************
  // Лут с обьектов
  //********************************************************************************
  $go_loot =& new GameobjectReportGenerator('loot');
  $fields = array('GO_REPORT_NAME', 'GO_REPORT_TYPE', 'LOOT_REPORT_REQ', 'LOOT_REPORT_CHANCE', 'GO_REPORT_MAP');
  if ($go_loot->Init($fields, $baseLink, 'go_lootLIST', $config['fade_limit'], 'chance'))
  {
    $go_loot->lootItem($entry);
    $go_loot->createReport($lang['go_drop_loot']);
  }
  //********************************************************************************
  // Лут с вещей
  //********************************************************************************
  $item_loot =& new ItemReportGenerator('loot');
  $fields = array('ITEM_REPORT_ICON', 'ITEM_REPORT_NAME', 'LOOT_REPORT_REQ', 'LOOT_REPORT_CHANCE');
  if ($item_loot->Init($fields, $baseLink, 'lootLIST', $config['fade_limit'], 'chance'))
  {
    $item_loot->lootItem($entry);
    $item_loot->createReport($lang['item_lock_loot']);
  }
  //********************************************************************************
  // Лут с очистки руды
  //********************************************************************************
  $item_loot =& new ItemReportGenerator('prospect');
  if ($item_loot->Init($fields, $baseLink, 'prospectLIST', $config['fade_limit'], 'chance'))
  {
    $item_loot->lootItem($entry);
    $item_loot->createReport($lang['prospecting_loot']);
  }
  //********************************************************************************
  // Лут с milling
  //********************************************************************************
  $milling_loot =& new ItemReportGenerator('milling');
  if ($milling_loot->Init($fields, $baseLink, 'millingLIST', $config['fade_limit'], 'chance'))
  {
    $milling_loot->lootItem($entry);
    $milling_loot->createReport($lang['milling_loot']);
  }
  //********************************************************************************
  // Лут с дизэнчанта
  //********************************************************************************
  $disenchant_loot =& new ItemReportGenerator('disenchant');
  if ($disenchant_loot->Init($fields, $baseLink, 'disenchantLIST', $config['fade_limit'], 'chance'))
  {
    $disenchant_loot->lootItem($entry);
    $disenchant_loot->createReport($lang['disenchant_loot']);
  }

  if ($ajaxmode==0)
  {
  //********************************************************************************
  // Лут с рыбалки
  //********************************************************************************
  $refLoot = & getRefrenceItemLoot($entry);
  $refList = array_keys($refLoot);                  // Получаем список рефренс лута

  $page_seek = init_pagePerMark($mark, "fishing_src_LIST", $page);
  $rows = $dDB->selectPage($totalRecords,
   "SELECT
    `fishing_loot_template`.`entry` AS `loot_entry`,
    `fishing_loot_template`.`ChanceOrQuestChance` AS `ChanceOrQuestChance`,
    `fishing_loot_template`.`groupid` AS `groupid`,
    `fishing_loot_template`.`mincountOrRef` AS `mincountOrRef`,
    `fishing_loot_template`.`maxcount` AS `maxcount`,
    `fishing_loot_template`.`lootcondition` AS `lootcondition`,
    `fishing_loot_template`.`condition_value1` AS `condition_value1`,
    `fishing_loot_template`.`condition_value2` AS `condition_value2`
   FROM
       `fishing_loot_template`
   WHERE
       (`fishing_loot_template`.`item` = ?d AND `fishing_loot_template`.`mincountOrRef` > 0)
       { OR -`fishing_loot_template`.`mincountOrRef` IN (?a) }
   ORDER BY
       ABS(`ChanceOrQuestChance`) DESC
   LIMIT ?d,?d",$item['entry'], empty($refList) ? DBSIMPLE_SKIP : $refList, $page_seek, $config['fade_limit']);
   renderItemFishingList($rows, $refLoot, $lang['fishing_loot'], $page_seek, $totalRecords, $baseLink, "fishing_src_LIST");
 }  /**/
}
?>


