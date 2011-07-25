<?php
include_once("conf.php");
include_once("include/functions.php");

function getQuestText($quest_text)
{
  $letter = array( '$b' ,'$B$B', '$B' ,  '$N'  ,   '$n'  , '$C'    , '$r');
  $values = array('<br>','<br>','<br>','(Name)', '(Name)','(Class)', '(Race)');
  return str_replace($letter, $values, $quest_text);
}

function renderReqCollect($item_id, $maxcount, $count)
{
 if (!$item_id > 0)
   return;
 $name=getItemName($item_id);
 echo "<tr><td>&nbsp;&nbsp;<a href=\"?item=$item_id\">$name</a>:&nbsp;$count/$maxcount</td></tr>";
}

function renderReqKillOrCast($text,$ReqCreatureOrGOId,$ReqCreatureOrGOCount,$ReqSpellCast, $count)
{
 global $lang;
 if ($ReqCreatureOrGOId>0)
 {
  echo "<tr><td><a style='float: right;' href=\"?map&npc=$ReqCreatureOrGOId\">$lang[map]</a>&nbsp;&nbsp;";
  if ($ReqSpellCast==0) // Требуется убить моба
  {
   if ($text)
     echo "<a href=\"?npc=$ReqCreatureOrGOId\">$text</a>";
   else
     echo $lang['kill'].'&nbsp;'.getCreatureName($ReqCreatureOrGOId);
  }
  else
  {
//    $spell_name=getSpellName($ReqSpellCast);
    if (!$text) $text = $lang['cast'];
    echo "<a href=\"?spell=$ReqSpellCast\">$text</a>&nbsp;$lang[cast_on]&nbsp;".getCreatureName($ReqCreatureOrGOId);
  }
  echo ":&nbsp;$count/$ReqCreatureOrGOCount</td></tr>";
 }
 else if ($ReqCreatureOrGOId<0)
 {
  $ReqCreatureOrGOId=-$ReqCreatureOrGOId;
  echo "<tr><td><a style='float: right;' href=\"?map&obj=$ReqCreatureOrGOId\">$lang[map]</a>&nbsp;&nbsp;";
  if ($ReqSpellCast==0) // Требуется использовать геймобьект
  {
   if ($text)
     echo "<a href=\"?object=$ReqCreatureOrGOId\">$text</a>";
   else
     echo $lang['use'].'&nbsp;'.getGameobjectName($ReqCreatureOrGOId);
  }
  else
  {
    if (!$text) $text = $lang['cast'];
//    $spell_name=getSpellName($ReqSpellCast);
    echo "<a href=\"?spell=$ReqSpellCast\">$text</a> $lang[cast_on]&nbsp;".getGameobjectName($ReqCreatureOrGOId);
  }
  echo ":&nbsp;$count/$ReqCreatureOrGOCount</td></tr>";
 }
}
function renderQuestSource($srcID, $srcCount)
{
 if (!$srcID)
   return;
 $name=getItemName($srcID);
 echo "<tr><td>&nbsp;&nbsp;<a href=\"?item=$srcID\">$name</a>".($srcCount?'&nbsp;x&nbsp;'.$srcCount:'').'</td></tr>';
}

########

$entry = intval(@$_REQUEST['quest']);
$guid  = intval(@$_REQUEST['guid']);

$quest=getQuest($entry);
if (!$quest)
{
  RenderError("$lang[quest_not_found1]");
}
else
{
 $q_status = 0;
 if ($guid)
   $q_status = $cDB->selectRow("SELECT * FROM `character_queststatus` WHERE `guid` = ?d AND `quest` = ?d", $guid, $entry);
 if ($lang['www_quest'])
	echo "<a href=\"".sprintf($lang['www_quest'], $entry)."\" target=\"_blank\"\">".sprintf($lang['www_quest'], $entry)."</a><br>";

 echo "<table class=quest width=550>";
 echo "<tbody>";

 echo "<tr><td class=head>$quest[Title]";
 if ($quest['Type'])
   echo "<br><FONT size=-3>&lt;".getQuestType($quest['Type'])."&gt;</FONT>";

 if (getAllowableRace($quest['RequiredRaces']) && ($quest['RequiredRaces'] & 1101) && ($quest['RequiredRaces'] !=1791))
 {
     echo "<br><FONT color=#0000ff>$lang[required_races]&nbsp;$lang[Alliance]&nbsp;</FONT><img width=22 height=22 src='images/player_info/factions_img/alliance.gif'>";
     echo '<br><FONT color=#0000ff>'.$game_text['allowable_race'].'&nbsp;'.getAllowableRace($quest['RequiredRaces']).'</FONT>';
 }
 
if (getAllowableRace($quest['RequiredRaces']) && ($quest['RequiredRaces'] & 690) && ($quest['RequiredRaces'] !=1791))
 {
     echo "<br><FONT color=#ff0000>$lang[required_races]&nbsp;$lang[Horde]&nbsp;</FONT><img width=22 height=22 src='images/player_info/factions_img/horde.gif'>";
     echo '<br><FONT color=#ff0000>'.$game_text['allowable_race'].'&nbsp;'.getAllowableRace($quest['RequiredRaces']).'</FONT>';
 }

if (($quest['RequiredRaces'] == 0) OR ($quest['RequiredRaces'] == 1791))
 {
     echo "</br>";
     echo "<br><FONT color=#008800>$lang[required_races]&nbsp;$lang[Both]</FONT>";
     echo '<br><FONT color=#008800>'.$game_text['allowable_race'].'&nbsp;'.getAllowableRace(1791).'</FONT>';
 }

 if (getAllowableClass($quest['RequiredClasses']))
     echo '<br><FONT color=#000000>'.$game_text['allowable_class'].'&nbsp;'.getQAllowableClass($quest['RequiredClasses']).'</FONT>';

 if ($entry == getQuestOld($entry))
    echo '<br><FONT color=#ff0000><b>'.$lang['quest_marked'].'</FONT></b>';

 echo "</th></tr>";
 echo "</th></tr>";

 echo '<tr><td>';
 if ($quest['ZoneOrSort']>0)
   echo "<a style='float: right;' href=\"?s=q&ZoneID=".$quest['ZoneOrSort']."\">".getAreaName($quest['ZoneOrSort'], 0)."</a>";
 else
 if ($quest['ZoneOrSort']<0 AND ((-$quest['ZoneOrSort']) >= 374 OR (-$quest['ZoneOrSort']) == 221 OR (-$quest['ZoneOrSort']) == 241 OR ((-$quest['ZoneOrSort']) >= 344 AND (-$quest['ZoneOrSort']) < 371) or
    (-$quest['ZoneOrSort']) == 284 OR (-$quest['ZoneOrSort']) == 25 OR (-$quest['ZoneOrSort']) == 41 OR (-$quest['ZoneOrSort']) < 24))
   echo "<a style='float: right;' href=\"?s=q&SortID=".(-$quest['ZoneOrSort'])."\">".getQuestSort(-$quest['ZoneOrSort'], 0)."</a>";

 echo "$lang[quest_level]&nbsp;$quest[QuestLevel]<br>";

if ($quest['RequiredSkill'])
   echo "<a style='float: right;' href=\"?s=q&SkillID=".($quest['RequiredSkill'])."\">".getSkillName($quest['RequiredSkill'], 0)."&nbsp;($quest[RequiredSkillValue])</a>";

 if ($quest['MinLevel'])
 echo "$lang[obtained_at_level]&nbsp;$quest[MinLevel]</td></tr>";

 if ($quest['SuggestedPlayers'])
     echo "<tr><td>$lang[suggestedplayers]&nbsp;<b>$quest[SuggestedPlayers]</b></td></tr>";

 if ($quest['LimitTime'])
     echo '<tr><td>'.$lang['qlimittime'].'&nbsp;'.getTimeText($quest['LimitTime']).'</td></tr>';

 if (getGameEventQuest($quest['entry']))
  {
  $qevent=getGameEventQuest($quest['entry']);
   echo '<tr><td>'.$lang['obtained_at_event'].':&nbsp;<FONT color=#E614E6>'.getGameEventName($qevent).'</FONT></td></tr>';
  }

 if ($quest['SpecialFlags'] & QUEST_SPECIAL_FLAG_MONTHLY)
     echo "<tr><td>$lang[item_type]:&nbsp;<a href=\"?s=q&Sfm=".($quest['SpecialFlags'])."\">".$lang['quest_type3']."</a></td></tr>";

 if ($quest['QuestFlags'] & QUEST_FLAGS_WEEKLY)
     echo "<tr><td>$lang[item_type]:&nbsp;<a href=\"?s=q&Sfw=".($quest['QuestFlags'])."\">".$lang['quest_type2']."</a></td></tr>";

 if ($quest['QuestFlags'] & QUEST_FLAGS_DAILY)
     echo "<tr><td>$lang[item_type]:&nbsp;<a href=\"?s=q&Sfd=".($quest['QuestFlags'])."\">".$lang['quest_type1']."</a></td></tr>";

 if (($quest['SpecialFlags'] & QUEST_SPECIAL_FLAG_REPEATABLE) && (($quest['SpecialFlags'] & QUEST_SPECIAL_FLAG_MONTHLY) ==0)&& ($quest['QuestFlags'] & (QUEST_FLAGS_DAILY | QUEST_FLAGS_WEEKLY))  == 0)
     echo "<tr><td>$lang[item_type]:&nbsp;<a href=\"?s=q&Sfr=".($quest['SpecialFlags'])."\">".$lang['quest_type0']."</a></td></tr>";

 if ($quest['RequiredMinRepFaction'])
   echo "<tr><td>$lang[item_faction_rank]:</td></tr>";

 if ($quest['RequiredMinRepFaction'])
   echo "<tr><td> ".getFactionName($quest['RequiredMinRepFaction']).":&nbsp;$quest[RequiredMinRepValue]($lang[item_min_level])</td></tr>";

 if ($quest['RequiredMaxRepFaction'])
   echo "<tr><td>".getFactionName($quest['RequiredMaxRepFaction']).":&nbsp;$quest[RequiredMaxRepValue]($lang[item_max_level])</td></tr>";

 echo "<tr><td>".getQuestText($quest['Objectives'])."<hr></td></tr>";
 ### Рек собрать
 if ($quest['RepObjectiveFaction'])
   echo "<tr><td>$lang[item_faction_rank]:</td></tr>";

 if ($quest['RepObjectiveFaction'])
   echo "<tr><td> ".getFactionName($quest['RepObjectiveFaction']).":&nbsp;$quest[RepObjectiveValue]($lang[item_min_level])</td></tr>";

 if ($quest['ReqItemId1'] OR $quest['ReqItemId2'] OR $quest['ReqItemId3'] OR $quest['ReqItemId4'] OR $quest['ReqItemId5'] OR $quest['ReqItemId6'])
 {
  echo "<tr><td class=mark>$lang[collect]</td></tr>";
  renderReqCollect($quest['ReqItemId1'],$quest['ReqItemCount1'],$q_status?$q_status['itemcount1']:0);
  renderReqCollect($quest['ReqItemId2'],$quest['ReqItemCount2'],$q_status?$q_status['itemcount2']:0);
  renderReqCollect($quest['ReqItemId3'],$quest['ReqItemCount3'],$q_status?$q_status['itemcount3']:0);
  renderReqCollect($quest['ReqItemId4'],$quest['ReqItemCount4'],$q_status?$q_status['itemcount4']:0);
  renderReqCollect($quest['ReqItemId5'],$quest['ReqItemCount5'],$q_status?$q_status['itemcount5']:0);
  renderReqCollect($quest['ReqItemId6'],$quest['ReqItemCount6'],$q_status?$q_status['itemcount6']:0);
 }
###
### Рек убить
if ($quest['ReqCreatureOrGOId1'] != 0 OR $quest['ReqCreatureOrGOId2'] != 0 OR
    $quest['ReqCreatureOrGOId3'] != 0 OR $quest['ReqCreatureOrGOId4'] != 0 )
{
// echo "<tr><td class=mark>$lang[kill]</td></tr>";
 renderReqKillOrCast($quest['ObjectiveText1'],$quest['ReqCreatureOrGOId1'],$quest['ReqCreatureOrGOCount1'],$quest['ReqSpellCast1'],$q_status?$q_status['mobcount1']:0);
 renderReqKillOrCast($quest['ObjectiveText2'],$quest['ReqCreatureOrGOId2'],$quest['ReqCreatureOrGOCount2'],$quest['ReqSpellCast2'],$q_status?$q_status['mobcount2']:0);
 renderReqKillOrCast($quest['ObjectiveText3'],$quest['ReqCreatureOrGOId3'],$quest['ReqCreatureOrGOCount3'],$quest['ReqSpellCast3'],$q_status?$q_status['mobcount3']:0);
 renderReqKillOrCast($quest['ObjectiveText4'],$quest['ReqCreatureOrGOId4'],$quest['ReqCreatureOrGOCount4'],$quest['ReqSpellCast4'],$q_status?$q_status['mobcount4']:0);
}

if ($quest['ReqSourceId1'] != 0 OR $quest['ReqSourceId2'] != 0 OR
    $quest['ReqSourceId3'] != 0 OR $quest['ReqSourceId4'] != 0 )
{
 echo "<tr><td class=mark>$lang[req_items]</td></tr>";
 renderQuestSource($quest['ReqSourceId1'],$quest['ReqSourceCount1']);
 renderQuestSource($quest['ReqSourceId2'],$quest['ReqSourceCount2']);
 renderQuestSource($quest['ReqSourceId3'],$quest['ReqSourceCount3']);
 renderQuestSource($quest['ReqSourceId4'],$quest['ReqSourceCount4']);
}

###
echo "<tr><td>".getQuestText($quest['Details'])."</td></tr>";
 if ($quest['CompletedText'])
{
   echo "<tr><td class = head>$lang[quest_completed]</td></tr>";
   echo '<tr><td>'.$quest['CompletedText'].'</td></tr>';
}
if ($quest['SrcItemId'] || $quest['SrcSpell'])
{
 echo "<tr><td class = head>$lang[provided]</td></tr>";
 if ($quest['SrcItemId'])
 {
   $item = getItem($quest['SrcItemId'], "`entry`, `name`, `Quality`, `displayid`");
   echo '<tr><td class=reward>&nbsp;'.text_show_item($item['entry'], $item['displayid']);
   echo '&nbsp;<a class='.$Quality[$item['Quality']].' href="?item='.$item['entry'].'">'.$item['name'].'</a>';
   if ($quest['SrcItemCount']>1) echo "&nbsp;x$quest[SrcItemCount]";
   echo "</td></tr>";
 }
 if ($quest['SrcSpell'])
 {
  $spell=getSpell($quest['SrcSpell']); // Кастуемый спелл
  if ($spell) $spellName = getSpellName($spell);
  else        $spellName = "Spell $quest[SrcSpell]";
  echo "<tr><td class=reward>&nbsp;";show_spell($spell['id'], $spell['SpellIconID']);
  echo " <a href=\"?spell=$spell[id]\">$spell[SpellName]</a></td></tr>";
 }
}
echo "<tr><td class = head>$lang[quest_rewards]</td></tr>";

if ($quest['RewItemId1'] OR $quest['RewItemId1'] OR $quest['RewItemId1'] OR $quest['RewItemId1'])
{
 echo "<tr><td class=mark>$lang[Rew_item]</td></tr>";
 echo "<tr><td class=reward>&nbsp;";
 if ($quest['RewItemId1']) {show_item($quest['RewItemId1']);}
 if ($quest['RewItemId2']) {echo $lang['item_sel_and'];show_item($quest['RewItemId2']);}
 if ($quest['RewItemId3']) {echo $lang['item_sel_and'];show_item($quest['RewItemId3']);}
 if ($quest['RewItemId4']) {echo $lang['item_sel_and'];show_item($quest['RewItemId4']);}
 echo "</td></tr>";
}
if ($quest['RewChoiceItemId1'] OR $quest['RewChoiceItemId2'] OR $quest['RewChoiceItemId3'] OR
    $quest['RewChoiceItemId4'] OR $quest['RewChoiceItemId5'] OR $quest['RewChoiceItemId6'])
{
 echo "<tr><td class=mark>$lang[Rew_select_item]</td></tr>";
 echo "<tr><td class=reward>&nbsp;";
 if ($quest['RewChoiceItemId1']) {show_item($quest['RewChoiceItemId1']);}
 if ($quest['RewChoiceItemId2']) {echo $lang['item_sel_or'];show_item($quest['RewChoiceItemId2']);}
 if ($quest['RewChoiceItemId3']) {echo $lang['item_sel_or'];show_item($quest['RewChoiceItemId3']);}
 if ($quest['RewChoiceItemId4']) {echo $lang['item_sel_or'];show_item($quest['RewChoiceItemId4']);}
 if ($quest['RewChoiceItemId5']) {echo $lang['item_sel_or'];show_item($quest['RewChoiceItemId5']);}
 if ($quest['RewChoiceItemId6']) {echo $lang['item_sel_or'];show_item($quest['RewChoiceItemId6']);}
 echo "</td></tr>";
}
if ($quest['RewMailTemplateId'])
{
 $MailTime=$quest['RewMailDelaySecs']/60/60;
 $ItemMail=getItemMail($quest['RewMailTemplateId']);
 if ($ItemMail)
  {
    echo "<tr><td class=mark>$lang[Rew_mail]&nbsp;$lang[Mail_item_time]".$MailTime."$lang[Mail_time]";
    echo "<tr><td class=mark>$lang[Rew_item_mail]</td></tr>";
    echo "<tr><td class=reward>&nbsp;";{show_item($ItemMail);}
    echo "</td></tr>";
  }
  else
  {
    echo "<tr><td class=mark>$lang[Rew_mail]&nbsp;$lang[Mail_item_time]".$MailTime."$lang[Mail_time]";
    echo "</td></tr>";
  }
}
if ($quest['RewSpell'] || $quest['RewSpellCast'])
{
 $learn = $quest['RewSpell'] ? $quest['RewSpell'] : $quest['RewSpellCast'];
 $spell=getSpell($learn);
 if ($spell) $spellName = getSpellName($spell);
 else        $spellName = "Spell $learn";
 echo '<tr><td class=mark>'.($quest['RewSpell']?$lang['learn_spell']:$lang['cast_spell']).'</td></tr>';
 echo "<tr><td class=reward>&nbsp;";show_spell($spell['id'], $spell['SpellIconID']);
 echo " <a href=\"?spell=$spell[id]\">$spell[SpellName]</a></td></tr>";
}

for ($i = 1; $i <= 5; $i++) 
{
 switch (ABS($quest['RewRepValueId'.$i])): 
  case 1:  $RepValueId[$i] = 10;   break; 
  case 2:  $RepValueId[$i] = 25;   break; 
  case 3:  $RepValueId[$i] = 75;   break; 
  case 4:  $RepValueId[$i] = 150;  break; 
  case 5:  $RepValueId[$i] = 250;  break; 
  case 6:  $RepValueId[$i] = 350;  break; 
  case 7:  $RepValueId[$i] = 500;  break; 
  case 8:  $RepValueId[$i] = 1000; break; 
  case 9:  $RepValueId[$i] = 5;    break; 
  default: $RepValueId[$i] = 0; 
 endswitch; 

 $quest_rate[$i] = getRepRewRate($quest['RewRepFaction'.$i]);

 if ($quest['RewRepValueId'.$i] < 0) 
  $RepValueId[$i] = -$RepValueId[$i]; 

 if ($quest['RewRepValue'.$i] && $quest['RewRepValueId'.$i]) 
  $quest['RewRepValue'.$i] = $quest['RewRepValue'.$i]/100; 

 if (!$quest['RewRepValue'.$i] && $quest['RewRepValueId'.$i]) 
  $quest['RewRepValue'.$i] = $RepValueId[$i]; 

 $quest['RewRepValue'.$i]=$quest['RewRepValue'.$i]*$quest_rate[$i];
}

 if ($quest['RewRepFaction1'] AND !$quest['RewRepFaction2'] AND
    !$quest['RewRepFaction3'] AND !$quest['RewRepFaction4'] AND
    !$quest['RewRepFaction5'])
 {
  $spillover=getRepSpillover($quest['RewRepFaction1']);
  if ($spillover)
   foreach ($spillover as $faction)
   {
     if ($faction['faction1'])
     {
     $quest['RewRepFaction2']=$faction['faction1'];
     $quest['RewRepValue2']=$quest['RewRepValue1']*$faction['rate_1'];
     }
     if ($faction['faction2'])
     {
     $quest['RewRepFaction3']=$faction['faction2'];
     $quest['RewRepValue3']=$quest['RewRepValue1']*$faction['rate_2'];
     }
     if ($faction['faction3'])
     {
     $quest['RewRepFaction4']=$faction['faction3'];
     $quest['RewRepValue4']=$quest['RewRepValue1']*$faction['rate_3'];
     }
     if ($faction['faction4'])
     {
     $quest['RewRepFaction5']=$faction['faction4'];
     $quest['RewRepValue5']=$quest['RewRepValue1']*$faction['rate_4'];
     }
   }
 }

if ($quest['RewRepFaction1'] OR $quest['RewRepFaction2'] OR
    $quest['RewRepFaction3'] OR $quest['RewRepFaction4'] OR
    $quest['RewRepFaction5'])
{
 echo "<tr><td class=mark>$lang[Rew_reputation]</td></tr>";
 if ($quest['RewRepFaction1'] && $quest['RewRepValue1'])echo "<tr><td>&nbsp;".getFactionName($quest['RewRepFaction1']).":&nbsp;$quest[RewRepValue1]</td></tr>";
 if ($quest['RewRepFaction2'] && $quest['RewRepValue2'])echo "<tr><td>&nbsp;".getFactionName($quest['RewRepFaction2']).":&nbsp;$quest[RewRepValue2]</td></tr>";
 if ($quest['RewRepFaction3'] && $quest['RewRepValue3'])echo "<tr><td>&nbsp;".getFactionName($quest['RewRepFaction3']).":&nbsp;$quest[RewRepValue3]</td></tr>";
 if ($quest['RewRepFaction4'] && $quest['RewRepValue4'])echo "<tr><td>&nbsp;".getFactionName($quest['RewRepFaction4']).":&nbsp;$quest[RewRepValue4]</td></tr>";
 if ($quest['RewRepFaction5'] && $quest['RewRepValue5'])echo "<tr><td>&nbsp;".getFactionName($quest['RewRepFaction5']).":&nbsp;$quest[RewRepValue5]</td></tr>";
}
if($quest['RewMoneyMaxLevel'])  echo "<tr><td class=mark>$lang[Rew_XP]&nbsp;".getQuestXPValue($quest)."&nbsp;xp";
if($quest['RewHonorAddition'] OR $quest['RewHonorMultiplier'])
{
if ($quest['RewHonorMultiplier'])
  $ihonor=round(getTeamContributionPoints(79)*$quest['RewHonorMultiplier']*0.1+$quest['RewHonorAddition']);
else
 $ihonor=round($quest['RewHonorAddition']);
 echo "<tr><td class=mark>$lang[Rew_honor]&nbsp;".substr($ihonor, 0, 4);
}
if($quest['RewOrReqMoney']) echo "<tr><td class=mark>$lang[Rew_money]&nbsp;".money($quest['RewOrReqMoney'])."</td></tr>";
###

$number = 0;
echo "<tr><td class = head>$lang[start]:</td></tr>";
if ($rows = $dDB->select("SELECT *
                          FROM `creature_template` join `creature_questrelation`
                          WHERE
                          `creature_questrelation`.`quest` = ?d AND
                          `creature_questrelation`.`id` = `creature_template`.`entry`", $quest['entry']))
foreach ($rows as $creature)
{
  localiseCreature($creature);
  $loyality = getLoyality($creature['faction_A']);
  echo "<tr><td><a style='float: right;' href=\"?map&npc=$creature[entry]\">$lang[map]</a>";
  echo "<a href=\"?npc=$creature[entry]\">$creature[name]</a> ($loyality)";
  if ($creature['subname'] != "")
   echo "<br><FONT color=#008800 size=-3>&lt;$creature[subname]&gt;</FONT>";
  echo "</td></tr>";
  $number++;
}

if ($rows = $dDB->select("SELECT *
                          FROM `gameobject_template` join `gameobject_questrelation`
                          WHERE
                          `gameobject_questrelation`.`quest` = ?d AND
                          `gameobject_questrelation`.`id` = `gameobject_template`.`entry`", $quest['entry']))
foreach ($rows as $go)
{
  localiseGameobject($go);
  echo "<tr><td><a style='float: right;' href=\"?map&obj=$go[entry]\">$lang[map]</a>";
  echo "<a href=\"?object=$go[entry]\">$go[name]</a></td></tr>";
  $number++;
}

if ($rows = $dDB->select("SELECT `entry`, `name`,`Quality`, `displayid` FROM `item_template` WHERE `startquest` = ?d", $quest['entry']))
foreach ($rows as $item)
{
 localiseItem($item);
 echo '<tr><td class=reward>&nbsp;'.text_show_item($item['entry'], $item['displayid']);
 echo '&nbsp;<a class='.$Quality[$item['Quality']].' href="?item='.$item['entry'].'">'.$item['name'].'</a>';
 $number++;
}

if ($number==0)
echo "<tr><td bgColor=#ff0000>$lang[quest_not_found]</td></tr>";

$number = 0;
echo "<tr><td class = head>$lang[end_q]:</td></tr>";
if ($rows = $dDB->select("SELECT *
                          FROM `creature_template` join `creature_involvedrelation`
                          WHERE
                          `creature_involvedrelation`.`quest` = ?d AND
                          `creature_involvedrelation`.`id` = `creature_template`.`entry`", $quest['entry']))
foreach ($rows as $creature)
{
  localiseCreature($creature);
  $loyality = getLoyality($creature['faction_A']);
  echo "<tr><td><a style='float: right;' href=\"?map&npc=$creature[entry]\">$lang[map]</a>";
  echo "<a href=\"?npc=$creature[entry]\">$creature[name]</a> ($loyality)";
  if ($creature['subname'] != "")
   echo "<br><FONT color=#008800 size=-3>&lt;$creature[subname]&gt;</FONT>";
  echo "</td></tr>";
  $number++;
}

if ($rows = $dDB->select("SELECT *
                          FROM `gameobject_template` join `gameobject_involvedrelation`
                          WHERE
                          `gameobject_involvedrelation`.`quest` = ?d AND
                          `gameobject_involvedrelation`.`id` = `gameobject_template`.`entry`", $quest['entry']))
foreach ($rows as $go)
{
  localiseGameobject($go);
  echo "<tr><td><a style='float: right;' href=\"?map&obj=$go[entry]\">$lang[map]</a>";
  echo "<a href=\"?object=$go[entry]\">$go[name]</a></td></tr>";
  $number++;
}

if ($number==0)
echo "<tr><td bgColor=#ff0000>$lang[quest_not_found]</td></tr>";

### этот квест часть серии:
$needForQuest = $dDB->selectRow("SELECT * FROM `quest_template` WHERE ABS(`PrevQuestId`) = ?d", $quest['entry']);
if ($quest['PrevQuestId'] != 0 OR $quest['NextQuestId'] != 0 OR $needForQuest)
{
 echo "<tr><td class = head>$lang[this_quest_is_part_of_a_series]</td></tr>";
 $step=0;
 // Разматываем цепочку квестов назад
 if ($quest['PrevQuestId']!=0)
 {
    $prevquest[0]=$quest;
    $list = 0;
    while ($prevquest[$list]['PrevQuestId']!=0)
    {
     $qbefore = getQuest(abs($prevquest[$list]['PrevQuestId']));
     if ($qbefore)
     {
      $prevquest[$list+1]=$qbefore;
      $list+=1;
     }
     else
     {
       $entry = $prevquest[$list]['PrevQuestId'];
       $prevquest[$list+1]['entry'] = $entry;
       $prevquest[$list+1]['Title'] = "Error qid = $entry";
       $prevquest[$list+1]['QuestLevel'] = "??";
       $list+=1;
       break;
     }
    }
    // Выводим все предыдущие квесты
    while ($step<$list)
    {
     $qinfo = $prevquest[$list-$step];
     echo "<tr><td>";
     echo "<div style='float: right;'>($lang[level]&nbsp;$qinfo[QuestLevel])</div>";
     echo "$lang[step]($step)&nbsp;<a href=\"?quest=$qinfo[entry]\">$qinfo[Title]</a>";
     echo "</td></tr>";
     $step++;
    }
 }
 echo "<tr><td>";
 echo "<div style='float: right;'>($lang[level]&nbsp;$quest[QuestLevel])</div>";
 echo "$lang[step]($step)&nbsp;$quest[Title]";
 echo "</td></tr>";
 $step++;
 // Пытаемся найти следующие квесты
 $nextquest = $quest;
 while($nextquest!=0)
 {
   // Сначала по полю NextQuestId
   if ($nextquest['NextQuestId']!=0)
   {
     $nextquest = getQuest(abs($nextquest['NextQuestId']));
     echo "<tr><td>";
     echo "<div style='float: right;'>($lang[level]&nbsp;$nextquest[QuestLevel])</div>";
     echo "$lang[step]($step)&nbsp;<a href=\"?quest=$nextquest[entry]\">$nextquest[Title]</a>";
     echo "</td></tr>";
   }
   // Если не вышло то по полю PrevQuestId = $nextquest[entry](у других квестов)
   else
   {
    if ($needForQuest)
    {
     localiseQuest($needForQuest);
     $nextquest=$needForQuest;
     echo "<tr><td>";
     echo "<div style='float: right;'>($lang[level]&nbsp;$nextquest[QuestLevel])</div>";
     echo "$lang[step]($step)&nbsp;<a href=\"?quest=$nextquest[entry]\">$nextquest[Title]</a>";
     echo "</td></tr>";
     $needForQuest = $dDB->selectRow("SELECT * FROM `quest_template` WHERE ABS(`PrevQuestId`) = ?d", $nextquest['entry']);
    }
    else
     $nextquest = 0;
   }
   $step++;
 }
}
// Ищем квесты требующие выполнение даного квеста
$needForQuest = $dDB->selectPage($number, "SELECT * FROM `quest_template` WHERE ABS(`PrevQuestId`) = ?d", $quest['entry']);
if ($needForQuest AND $number > 1) // если == 1 то мы уже вывели это в цепочке
{
 echo "<tr><td class = head>$lang[req_for_quest]</td></tr>";
 foreach ($needForQuest as $nextquest)
 {
  localiseQuest($nextquest);
  echo "<tr><td>";
  echo "<div style='float: right;'>($lang[level]&nbsp;$nextquest[QuestLevel])</div>";
  echo "<a href=\"?quest=$nextquest[entry]\">$nextquest[Title]</a>";
  echo "</td></tr>";
 }
}

###
echo "<tr><td class = head>$lang[additional_info]</td></tr>";
echo "<tr><td><b style='float: right;'>".getNumPalayersCompletedQuest($quest['entry'])."</b>{$lang['players_completed_quest']}:</td></tr>";
echo "<tr><td><b style='float: right;'>".getNumPalayersWithThisQuest($quest['entry'])."</b>{$lang['players_with_this_quest']}:</td></tr>";
echo "</tbody></table>";
}
?>
