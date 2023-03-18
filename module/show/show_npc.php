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
  - В какую группу входит НИП (kredit)
  - Какие квесты даёт
  - Какие квесты принимает
  - Лут с НИП
  - Лут который можно украсть у НИП
  - Лут шкурок с трупа НИП
*/
$entry = intval(@$_REQUEST['npc']);
$page  = intval(@$_REQUEST['page']);
$mark  = @$_REQUEST['mark'];

$cr=getCreature($entry);
if (!$cr)
{
  RenderError($lang['creature_not_found']);
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

  if ($cr['MinLootGold']) echo "<b>$lang[Rew_money]</b>&nbsp;&nbsp;".money($cr['MinLootGold']);
  if (($cr['MaxLootGold']) && ($cr['MaxLootGold']>$cr['MinLootGold'])) echo "&nbsp;-&nbsp;".money($cr['MaxLootGold']);
  if ($cr['MinLootGold'] OR $cr['MaxLootGold']) echo "<br>";

  $heroic = getHeroicList();
  $heroic1 = getHeroicList1();
  $heroic2 = getHeroicList2();

  $hentry = isset($heroic[$entry]) ? $heroic[$entry]:0;
  $hentry1 = isset($heroic1[$entry]) ? $heroic1[$entry]:0;
  $hentry2 = isset($heroic2[$entry]) ? $heroic2[$entry]:0;

  if ($hentry2)
  echo "<a href=\"?map&npc=$hentry2\">$lang[show_map]&nbsp;(".(getCreatureCount($hentry2) + getCreatureCountSpawn($hentry2)).")</a><br>";
  else
  if ($hentry1)
  echo "<a href=\"?map&npc=$hentry1\">$lang[show_map]&nbsp;(".(getCreatureCount($hentry1) + getCreatureCountSpawn($hentry1)).")</a><br>";
  else
  if ($hentry)
  echo "<a href=\"?map&npc=$hentry\">$lang[show_map]&nbsp;(".(getCreatureCount($hentry) + getCreatureCountSpawn($hentry)).")</a><br>";
  else 
  if ($entry)
  echo "<a href=\"?map&npc=$entry\">$lang[show_map]&nbsp;(".(getCreatureCount($entry) + getCreatureCountSpawn($entry)).")</a><br>";

  if ($config['show_npc_detalis'])
  {
   echo "<br><table class=details width=600>";
   echo "<tbody>";
   echo "<tr><td colspan=4 class=head>$lang[detail_info]</td></tr>";
   echo "<tr><th>Entry</th><td>".$cr['Entry']."</td><th>ModelId1</th><td>".$cr['ModelId1']."</td></tr>";
   echo "<tr><th>DifficultyEntry1</th><td>".$cr['DifficultyEntry1']."</td><th>ModelId2</th><td>".$cr['ModelId2']."</td></tr>";
   echo "<tr><th>DifficultyEntry2</th><td>".$cr['DifficultyEntry2']."</td><th>ModelId3</th><td>".$cr['ModelId3']."</td></tr>";
   echo "<tr><th>DifficultyEntry3</th><td>".$cr['DifficultyEntry3']."</td><th>ModelId4</th><td>".$cr['ModelId4']."</td></tr>";
   echo "<tr><th>Name</th><td>".$cr['Name']."<br><div class=subname>".$cr['SubName']."</div></td>";
   echo "<th>IconName</th><td>".$cr['IconName']."</td></tr>";
   echo "<tr><th>Level</th><td>".$cr['MinLevel']." - ".$cr['MaxLevel']."</td>";
   echo "<th>Armor</th><td>".getCreatureClasslevelstats($cr['MinLevel'], $cr['UnitClass'], $cr['Expansion'], $cr['ArmorMultiplier'], 6)."</td></tr>";
   echo "<tr><th>Health</th><td>".getCreatureClasslevelstats($cr['MinLevel'], $cr['UnitClass'], $cr['Expansion'], $cr['HealthMultiplier'], 1)." - ".getCreatureClasslevelstats($cr['MaxLevel'], $cr['UnitClass'], $cr['Expansion'], $cr['HealthMultiplier'], 1)."</td>";
   echo "<th>Mana</th><td>".getCreatureClasslevelstats($cr['MinLevel'], $cr['UnitClass'], $cr['Expansion'], $cr['PowerMultiplier'], 2)." - ".getCreatureClasslevelstats($cr['MaxLevel'], $cr['UnitClass'], $cr['Expansion'], $cr['PowerMultiplier'], 2)."</td></tr>";
   echo "<tr><th>Faction</th><td>".$cr['Faction']."</td><th>Expansion</th><td>".$cr['Expansion']."</td></tr>";
   echo "<tr><th>NpcFlags</th><td>".$cr['NpcFlags']."</td><th>GossipMenuId</th><td>".$cr['GossipMenuId']."</td></tr>";
   echo "<tr><th>UnitFlags</th><td>".$cr['UnitFlags']."</td><th>QuestgiverGreeting</th><td>".getQuestgiverGreetingCreature($cr['Entry'])."</td></tr>";
   echo "<tr><th>UnitFlags2</th><td>".$cr['UnitFlags2']."</td><th>DynamicFlags</th><td>".$cr['DynamicFlags']."</td></tr>";
   echo "<tr><th>ExtraFlags</th><td>".$cr['ExtraFlags']."</td><th>RegenerateStats</th><td>".$cr['RegenerateStats']."</td></tr>";
   echo "<tr><th>SpeedWalk</th><td>".$cr['SpeedWalk']."</td><th>SpeedRun</th><td>".$cr['SpeedRun']."</td></tr>";
   echo "<tr><th>Scale</th><td>".$cr['Scale']."</td><th>Rank</th><td>".$cr['Rank']."</td></tr>";
   $MinMeleeDmg = ROUND((getCreatureClasslevelstats($cr['MinLevel'], $cr['UnitClass'], $cr['Expansion'], $cr['DamageVariance'], 3)+(getCreatureClasslevelstats($cr['MinLevel'], $cr['UnitClass'], $cr['Expansion'], $cr['DamageMultiplier'], 4)/14)*($cr['MeleeBaseAttackTime']/1000))*$cr['DamageMultiplier']);
   $MaxMeleeDmg = ROUND($MinMeleeDmg*1.5);
   echo "<tr><th>MinMeleeDmg</th><td>$MinMeleeDmg</td><th>MaxMeleeDmg</th><td>$MaxMeleeDmg</td></tr>";
   $MinRangedDmg = ROUND((getCreatureClasslevelstats($cr['MinLevel'], $cr['UnitClass'], $cr['Expansion'], $cr['DamageVariance'], 3)+(getCreatureClasslevelstats($cr['MinLevel'], $cr['UnitClass'], $cr['Expansion'], $cr['DamageMultiplier'], 5)/14)*($cr['RangedBaseAttackTime']/1000))*$cr['DamageMultiplier']);
   $MaxRangedDmg = ROUND($MinRangedDmg*1.5);
   echo "<tr><th>MinRangedDmg</th><td>$MinRangedDmg</td><th>MaxRangedDmg</th><td>$MaxRangedDmg</td></tr>";
   echo "<tr><th>DamageSchool</th><td>".$cr['DamageSchool']."</td><th>DamageMultiplier</th><td>".$cr['DamageMultiplier']."</td></tr>";
   echo "<tr><th>MeleeAttackPower</th><td>".getCreatureClasslevelstats($cr['MinLevel'], $cr['UnitClass'], $cr['Expansion'], 1, 4)."</td><th>RangedAttackPower</th><td>".getCreatureClasslevelstats($cr['MinLevel'], $cr['UnitClass'], $cr['Expansion'], 1, 5)."</td></tr>";
   echo "<tr><th>MeleeBaseAttackTime</th><td>".$cr['MeleeBaseAttackTime']."</td><th>RangedBaseAttackTime</th><td>".$cr['RangedBaseAttackTime']."</td></tr>";
   echo "<tr><th>UnitClass</th><td>".$cr['UnitClass']."</td><th>Family</th><td>".$cr['Family']."</td></tr>";
   echo "<tr><th>TrainerType</th><td>".$cr['TrainerType']."</td><th>TrainerSpell</th><td>".$cr['TrainerSpell']."</td></tr>";
   echo "<tr><th>TrainerClass</th><td>".$cr['TrainerClass']."</td><th>TrainerRace</th><td>".$cr['TrainerRace']."</td></tr>";
   echo "<tr><th>CreatureType</th><td>".$cr['CreatureType']."</td><th>CreatureTypeFlags</th><td>".$cr['CreatureTypeFlags']."</td></tr>";
   if ($cr['MinLootGold'])echo "<tr><th>MinLootGold</th><td>".$cr['MinLootGold']."</td><th>MaxLootGold</th><td>".$cr['MaxLootGold']."</td></tr>";
   if ($cr['LootId']) echo "<tr><th>LootId</th><td>".$cr['LootId']."</td></tr>";
   if ($cr['PickpocketLootId']) echo "<tr><th>PickpocketLootId</th><td>".$cr['PickpocketLootId']."</td></tr>";
   if ($cr['SkinningLootId']) echo "<tr><th>SkinningLootId</th><td>".$cr['SkinningLootId']."</td></tr>";
   echo "<tr><th>ResistanceHoly</th><td>".$cr['ResistanceHoly']."</td><th>ResistanceFire</th><td>".$cr['ResistanceFire']."</td></tr>";
   echo "<tr><th>ResistanceNature</th><td>".$cr['ResistanceNature']."</td><th>ResistanceFrost</th><td>".$cr['ResistanceFrost']."</td></tr>";
   echo "<tr><th>ResistanceShadow</th><td>".$cr['ResistanceShadow']."</td><th>ResistanceArcane</th><td>".$cr['ResistanceArcane']."</td></tr>";
   echo "<tr><th>MovementType</th><td>".$cr['MovementType']."</td><th>InhabitType</th><td>".$cr['InhabitType']."</td></tr>";
   if ($cr['RacialLeader']) echo "<tr><th>RacialLeader</th><td>".$cr['RacialLeader']."</td></tr>";
   if ($cr['EquipmentTemplateId']) echo "<tr><th>EquipmentTemplateId</th><td>".$cr['EquipmentTemplateId']."</td></tr>";
   echo "<tr><th>MechanicImmuneMask</th><td>".$cr['MechanicImmuneMask']."</td><th>SchoolImmuneMask</th><td>".$cr['SchoolImmuneMask']."</td></tr>";
   echo "<tr><th>PetSpellDataId</th><td>".$cr['PetSpellDataId']."</td><th>VehicleTemplateId</th><td>".$cr['VehicleTemplateId']."</td></tr>";
   echo "<tr><th>TrainerTemplateId</th><td>".$cr['TrainerTemplateId']."</td><th>VendorTemplateId</th><td>".$cr['VendorTemplateId']."</td></tr>";
   echo "<tr><th>AIName</th><td>".$cr['AIName']."</td><th>ScriptName</th><td>".$cr['ScriptName']."</td></tr>";
   echo "</tbody></table>";
  }
 //==========================================================
 if ($config['show_3d_model_npc']) // Вывод 3D модели НИП
 {
                echo '<br><span><div align="center" style="margin-bottom:1px;font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<input type="button" value="+" style="width:20px;font-size:9px;margin:0px;padding:0px;" ';
                echo "       onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') ";
                echo "{ this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; ";
                echo "  this.innerText = ''; ";
                echo "  this.value = '-'; } ";
                echo " else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; ";
                echo " this.innerText = ''; ";
                echo " this.value = '+'; }\">&nbsp;&nbsp;&nbsp;<b>$lang[view3dnpc]</b></div>";
                echo '<div class="alt2" style="margin: 0px; padding: 0px; border: 0px inset;">';
                echo '<div style="display: none;">';
 {
   if ($cr['ModelId1'])
   {
                echo '<span><div align="center" style="margin-bottom:1px;font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<input type="button" value="+" style="width:20px;font-size:9px;margin:0px;padding:0px;" ';
                echo "       onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') ";
                echo "{ this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; ";
                echo "  this.innerText = ''; ";
                echo "  this.value = '-'; } ";
                echo " else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; ";
                echo " this.innerText = ''; ";
                echo " this.value = '+'; }\">&nbsp;&nbsp;&nbsp;<b>$game_text[display1]&nbsp;($cr[ModelId1])</b></div>";
                echo '<div class="alt2" style="margin: 0px; padding: 0px; border: 0px inset;">';
                echo '<div style="display: none;">';
   switch ($cr['CreatureType']):
    case 6:
    case 7:
        echo "<object data='http://static.wowhead.com/modelviewer/ModelView.swf' type='application/x-shockwave-flash' height='400' width='600'>
                <param value='high' name='quality'>
                <param value='always' name='allowscriptaccess'>
                <param value='false' name='menu'>
                <param name='wmode' value='transparent'>
                <param value='model=$cr[ModelId1]&amp;modelType=32&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1' name='flashvars'>
        </object>";
    break;
    default:
        echo "<object data='http://static.wowhead.com/modelviewer/ModelView.swf' type='application/x-shockwave-flash' height='400' width='600'>
                <param value='high' name='quality'>
                <param value='always' name='allowscriptaccess'>
                <param value='false' name='menu'>
                <param name='wmode' value='transparent'>
                <param value='model=$cr[ModelId1]&amp;modelType=8&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1' name='flashvars'>
        </object>";
    endswitch;
   echo "</div></div></span>";
   }
   if ($cr['ModelId2'])
   {
                echo '<span><div align="center" style="margin-bottom:1px;font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<input type="button" value="+" style="width:20px;font-size:9px;margin:0px;padding:0px;" ';
                echo "       onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') ";
                echo "{ this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; ";
                echo "  this.innerText = ''; ";
                echo "  this.value = '-'; } ";
                echo " else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; ";
                echo " this.innerText = ''; ";
                echo " this.value = '+'; }\">&nbsp;&nbsp;&nbsp;<b>$game_text[display2]&nbsp;($cr[ModelId2])</b></div>";
                echo '<div class="alt2" style="margin: 0px; padding: 0px; border: 0px inset;">';
                echo '<div style="display: none;">';
   switch ($cr['CreatureType']):
    case 6:
    case 7:
        echo "<object data='http://static.wowhead.com/modelviewer/ModelView.swf' type='application/x-shockwave-flash' height='400' width='600'>
                <param value='high' name='quality'>
                <param value='always' name='allowscriptaccess'>
                <param value='false' name='menu'>
                <param name='wmode' value='transparent'>
                <param value='model=$cr[ModelId2]&amp;modelType=32&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1' name='flashvars'>
        </object>";
    break;
    default:
        echo "<object data='http://static.wowhead.com/modelviewer/ModelView.swf' type='application/x-shockwave-flash' height='400' width='600'>
                <param value='high' name='quality'>
                <param value='always' name='allowscriptaccess'>
                <param value='false' name='menu'>
                <param name='wmode' value='transparent'>
                <param value='model=$cr[ModelId2]&amp;modelType=8&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1' name='flashvars'>
        </object>";
    endswitch;
   echo "</div></div></span>";
   }
   if ($cr['ModelId3'])
   {
                echo '<span><div align="center" style="margin-bottom:1px;font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<input type="button" value="+" style="width:20px;font-size:9px;margin:0px;padding:0px;" ';
                echo "       onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') ";
                echo "{ this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; ";
                echo "  this.innerText = ''; ";
                echo "  this.value = '-'; } ";
                echo " else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; ";
                echo " this.innerText = ''; ";
                echo " this.value = '+'; }\">&nbsp;&nbsp;&nbsp;<b>$game_text[display3]&nbsp;($cr[ModelId3])</b></div>";
                echo '<div class="alt2" style="margin: 0px; padding: 0px; border: 0px inset;">';
                echo '<div style="display: none;">';
   switch ($cr['CreatureType']):
    case 6:
    case 7:
        echo "<object data='http://static.wowhead.com/modelviewer/ModelView.swf' type='application/x-shockwave-flash' height='400' width='600'>
                <param value='high' name='quality'>
                <param value='always' name='allowscriptaccess'>
                <param value='false' name='menu'>
                <param name='wmode' value='transparent'>
                <param value='model=$cr[ModelId3]&amp;modelType=32&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1' name='flashvars'>
        </object>";
    break;
    default:
        echo "<object data='http://static.wowhead.com/modelviewer/ModelView.swf' type='application/x-shockwave-flash' height='400' width='600'>
                <param value='high' name='quality'>
                <param value='always' name='allowscriptaccess'>
                <param value='false' name='menu'>
                <param name='wmode' value='transparent'>
                <param value='model=$cr[ModelId3]&amp;modelType=8&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1' name='flashvars'>
        </object>";
    endswitch;
   echo "</div></div></span>";
   }
   if ($cr['ModelId4'])
   {
                echo '<span><div align="center" style="margin-bottom:1px;font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo '<input type="button" value="+" style="width:20px;font-size:9px;margin:0px;padding:0px;" ';
                echo "       onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') ";
                echo "{ this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; ";
                echo "  this.innerText = ''; ";
                echo "  this.value = '-'; } ";
                echo " else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; ";
                echo " this.innerText = ''; ";
                echo " this.value = '+'; }\">&nbsp;&nbsp;&nbsp;<b>$game_text[display4]&nbsp;($cr[ModelId4])</b></div>";
                echo '<div class="alt2" style="margin: 0px; padding: 0px; border: 0px inset;">';
                echo '<div style="display: none;">';
   switch ($cr['CreatureType']):
    case 6:
    case 7:
        echo "<object data='http://static.wowhead.com/modelviewer/ModelView.swf' type='application/x-shockwave-flash' height='400' width='600'>
                <param value='high' name='quality'>
                <param value='always' name='allowscriptaccess'>
                <param value='false' name='menu'>
                <param name='wmode' value='transparent'>
                <param value='model=$cr[ModelId4]&amp;modelType=32&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1' name='flashvars'>
        </object>";
    break;
    default:
        echo "<object data='http://static.wowhead.com/modelviewer/ModelView.swf' type='application/x-shockwave-flash' height='400' width='600'>
                <param value='high' name='quality'>
                <param value='always' name='allowscriptaccess'>
                <param value='false' name='menu'>
                <param name='wmode' value='transparent'>
                <param value='model=$cr[ModelId4]&amp;modelType=8&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1' name='flashvars'>
        </object>";
    endswitch;
   echo "</div></div></span>";
   }
  echo "</div></div></span>";
  }
 }
}

 createReportTab();
 //********************************************************************************
 // Summoned by spell
 //********************************************************************************
 $summoned_by = new SpellReportGenerator;
 $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_NAME');
 if ($summoned_by->Init($fields, $baseLink, 'summonLIST', $config['fade_limit'], 'name'))
 {
    $summoned_by->summonCreature($entry);
    $summoned_by->createReport($lang['summoned_by_spell']);
 }
 //********************************************************************************
 // Difficulty
 //********************************************************************************
 $difficulty = new CreatureReportGenerator();
 $fields = array('NPC_REPORT_LEVEL', 'NPC_REPORT_RNAME', 'NPC_REPORT_MAP');
 if ($difficulty->Init($fields, $baseLink, 'diffLIST', $config['fade_limit'], 'name'))
 {
    $difficulty->difficultyGroup($entry);
    $difficulty->createReport($lang['difficulty_entry_group']);
 }
 //********************************************************************************
 //  Cast spells
 //********************************************************************************
 $cast_spell = new SpellReportGenerator;
 $fields = array('SPELL_REPORT_ICON','SPELL_REPORT_NAME');
 if ($cast_spell->Init($fields, $baseLink, 'castLIST', $config['fade_limit'], 'name'))
 {
   $cast_spell->castByCreature($cr);
   $cast_spell->createReport($lang['cast_spells']);
 }
 //**************************************************
 // Vendor items list
 //**************************************************
 if ($cr['NpcFlags']&(UNIT_NPC_FLAG_VENDOR|UNIT_NPC_FLAG_VENDOR_AMMO|UNIT_NPC_FLAG_VENDOR_FOOD|UNIT_NPC_FLAG_VENDOR_POISON|UNIT_NPC_FLAG_VENDOR_REAGENT))
 {
  $sold = new ItemReportGenerator('vendor');
  $fields = array('ITEM_REPORT_ICON','ITEM_REPORT_NAME', 'VENDOR_REPORT_COST', 'VENDOR_REPORT_COUNT', 'VENDOR_REPORT_INCTIME', 'VENDOR_REPORT_COND');
  if ($sold->Init($fields, $baseLink, 'vendorLIST', $config['fade_limit'], 'name'))
  {
    $sold->vendorItemList($entry);
    $sold->createReport($lang['sold']);
  }
 }
 //**************************************************
 // Vendor items template list
 //**************************************************
 if ($cr['NpcFlags']&(UNIT_NPC_FLAG_VENDOR|UNIT_NPC_FLAG_VENDOR_AMMO|UNIT_NPC_FLAG_VENDOR_FOOD|UNIT_NPC_FLAG_VENDOR_POISON|UNIT_NPC_FLAG_VENDOR_REAGENT) && $cr['VendorTemplateId'])
 {
  $soldt = new ItemReportGenerator('vendort');
  $fields = array('ITEM_REPORT_ICON','ITEM_REPORT_NAME', 'VENDOR_REPORT_COST', 'VENDOR_REPORT_COUNTT', 'VENDOR_REPORT_INCTIME', 'VENDOR_REPORT_COND');
  if ($soldt->Init($fields, $baseLink, 'vendortLIST', $config['fade_limit'], 'name'))
  {
    $soldt->vendortItemList($cr['VendorTemplateId']);
    $soldt->createReport($lang['soldt']);
  }
 }
 //**************************************************
 // Train spells
 //**************************************************
 if ($cr['NpcFlags']&(UNIT_NPC_FLAG_TRAINER|UNIT_NPC_FLAG_TRAINER_CLASS|UNIT_NPC_FLAG_TRAINER_PROFESSION))
 {
  $train = new NPCTrainerReportGenerator();
  $fields = array('TRAIN_REPORT_LEVEL','TRAIN_REPORT_ICON', 'TRAIN_REPORT_NAME', 'TRAIN_REPORT_SKILL', 'TRAIN_REPORT_VALUE', 'TRAIN_REPORT_COST');
  if ($train->Init($fields, $baseLink, 'trainLIST', $config['fade_limit'], 'level'))
  {
    $train->trainSpell($entry);
    $train->createReport($lang['train']);
  }
 }
 //**************************************************
 // Train template spells
 //**************************************************
 if ($cr['NpcFlags']&(UNIT_NPC_FLAG_TRAINER|UNIT_NPC_FLAG_TRAINER_CLASS|UNIT_NPC_FLAG_TRAINER_PROFESSION) && $cr['TrainerTemplateId'])
 {
  $traint = new NPCTrainertReportGenerator();
  $fields = array('TRAIN_REPORT_LEVEL','TRAIN_REPORT_ICON', 'TRAIN_REPORT_NAME', 'TRAIN_REPORT_SKILL', 'TRAIN_REPORT_VALUE', 'TRAIN_REPORT_COST');
  if ($traint->Init($fields, $baseLink, 'traintLIST', $config['fade_limit'], 'level'))
  {
    $traint->trainSpell($cr['TrainerTemplateId']);
    $traint->createReport($lang['traint']);
  }
 }
 //********************************************************************************
 // Required for quest list
 //********************************************************************************
 $reqForQuest = new QuestReportGenerator();
 $fields = array('QUEST_REPORT_LEVEL', 'QUEST_REPORT_NAME', 'QUEST_REPORT_GIVER', 'QUEST_REPORT_GIVER_END', 'QUEST_REPORT_REWARD');
 if ($reqForQuest->Init($fields, $baseLink, 'qreqLIST', $config['fade_limit'], 'name'))
 {
    $reqForQuest->requireCreature($entry);
    $reqForQuest->createReport($lang['req_for_quest']);
 }
 //********************************************************************************
 // Kill kredit list
 //********************************************************************************
 $kredit = new CreatureReportGenerator();
 $fields = array('NPC_REPORT_LEVEL', 'NPC_REPORT_RNAME', 'NPC_REPORT_MAP');
 if ($kredit->Init($fields, $baseLink, 'kreditLIST', $config['fade_limit'], 'name'))
 {
    $kredit->kreditGroup($entry);
    $kredit->createReport($lang['kill_kredit_group']);
 }
 //**************************************************
 // Give quests
 //**************************************************
 if ($cr['NpcFlags']&(UNIT_NPC_FLAG_QUESTGIVER))
 {
  $giveQuest = new QuestReportGenerator('npc_giver');
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
 if ($cr['NpcFlags']&(UNIT_NPC_FLAG_QUESTGIVER))
 {
  $takeQuest = new QuestReportGenerator('npc_take');
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
  if ($cr['LootId'])
  {
   /*
   $loot = new LootReportGenerator('creature_loot');
   if ($loot->Init($fields, $baseLink, 'lootLIST', $config['fade_limit'], ''))
   {
     $loot->getLootList($cr['LootId']);
     $loot->createReport($lang['can_loot']);
   }*/
   $page_seek = init_pagePerMark($mark, "lootLIST", $page);
   $rows = getLootList($cr['LootId'], "creature_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
   renderLootTableList($rows, $lang['can_loot'], $page_seek, $totalRecords, $baseLink, "lootLIST");
  }
 }
 //**************************************************
 // Pickpocket loot
 //**************************************************
 if ($ajaxmode==0)
 {
  if ($cr['PickpocketLootId'])
  {
   $page_seek = init_pagePerMark($mark, "pickpocketLIST", $page);
   $rows = getLootList($cr['PickpocketLootId'], "pickpocketing_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
   renderLootTableList($rows, $lang['can_pickpocketing'], $page_seek, $totalRecords, $baseLink, "pickpocketLIST");
  }
 }
 //**************************************************
 // Skining loot
 //**************************************************
 if ($ajaxmode==0)
 {
  if ($cr['SkinningLootId'])
  {
   $page_seek = init_pagePerMark($mark, "skinLIST", $page);
   $rows = getLootList($cr['SkinningLootId'], "skinning_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
  if ($cr['CreatureTypeFlags'] & CREATURE_TYPEFLAGS_HERBLOOT)
   renderLootTableList($rows, $lang['give_herb'], $page_seek, $totalRecords, $baseLink, "skinLIST");
  else if ($cr['CreatureTypeFlags'] & CREATURE_TYPEFLAGS_MININGLOOT)
   renderLootTableList($rows, $lang['give_mining'], $page_seek, $totalRecords, $baseLink, "skinLIST");
  else if ($cr['CreatureTypeFlags'] & CREATURE_TYPEFLAGS_ENGINEERLOOT)
   renderLootTableList($rows, $lang['give_engineer'], $page_seek, $totalRecords, $baseLink, "skinLIST");
  else
   renderLootTableList($rows, $lang['give_skin'], $page_seek, $totalRecords, $baseLink, "skinLIST");
  }
 }
 //**************************************************
 // Reputation
 //**************************************************
  $r_knpc = new CreatureReportGenerator('reputation');
  $fields = array('ONKILL_REPUTATION');
  if ($r_knpc->Init($fields, $baseLink, 'r_ccreatureLIST', $config['fade_limit'], 'rep'))
  {
    $r_knpc->rewardNpcFactionReputation($entry);
    $r_knpc->createReport($lang['faction_kill_rew']);
  }
}
?>