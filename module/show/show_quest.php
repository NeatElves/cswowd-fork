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
 echo "<TR><TD>&nbsp;&nbsp;<A href=\"?item=$item_id\">$name</A>: $count/$maxcount</TD></TR>";
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
     echo "<A href=\"?npc=$ReqCreatureOrGOId\">$text</A>";
   else
     echo $lang['kill'].' '.getCreatureName($ReqCreatureOrGOId);
  }
  else
  {
//    $spell_name=getSpellName($ReqSpellCast);
    if (!$text) $text = $lang['cast'];
    echo "<a href=\"?spell=$ReqSpellCast\">$text</a> $lang[cast_on] ".getCreatureName($ReqCreatureOrGOId);
  }
  echo ": $count/$ReqCreatureOrGOCount</td></tr>";
 }
 else if ($ReqCreatureOrGOId<0)
 {
  $ReqCreatureOrGOId=-$ReqCreatureOrGOId;
  echo "<TR><TD><A style='float: right;' href=\"?map&obj=$ReqCreatureOrGOId\">$lang[map]</A>&nbsp;&nbsp;";
  if ($ReqSpellCast==0) // Требуется использовать геймобьект
  {
   if ($text)
     echo "<A href=\"?object=$ReqCreatureOrGOId\">$text</A>";
   else
     echo $lang['use'].' '.getGameobjectName($ReqCreatureOrGOId);
  }
  else
  {
    if (!$text) $text = $lang['cast'];
//    $spell_name=getSpellName($ReqSpellCast);
    echo "<A href=\"?spell=$ReqSpellCast\">$text</A> $lang[cast_on] ".getGameobjectName($ReqCreatureOrGOId);
  }
  echo ": $count/$ReqCreatureOrGOCount</TD></TR>";
 }
}
function renderQuestSource($srcID, $srcCount)
{
 if (!$srcID)
   return;
 $name=getItemName($srcID);
 echo "<TR><TD>&nbsp;&nbsp;<A href=\"?item=$srcID\">$name</a>".($srcCount?' x '.$srcCount:'').'</TD></TR>';
}

########

$entry = intval(@$_REQUEST['quest']);
$guid  = intval(@$_REQUEST['guid']);

$quest=getQuest($entry);
if (!$quest)
{
  RenderError("$lang[quest_not_found]");
}
else
{
 $q_status = 0;
 if ($guid)
   $q_status = $cDB->selectRow("SELECT * FROM `character_queststatus` WHERE `guid` = ?d AND `quest` = ?d", $guid, $entry);
 if ($config['www_quest'])
	echo "<a href=\"".sprintf($config['www_quest'], $entry)."\" target=\"_blank\"\">".sprintf($config['www_quest'], $entry)."</a><br>";

 echo "<TABLE class=quest width=550>";
 echo "<TBODY>";

 echo "<TR><TD class=head>$quest[Title]";
 if ($quest['Type'])
   echo "<br><FONT size=-3>&lt;".getQuestType($quest['Type'])."&gt;</FONT>";

 echo "</br>";

 if (getAllowableRace($quest['RequiredRaces']) && ($quest['RequiredRaces'] & 1101) && ($quest['RequiredRaces'] !=1791))
 {
     echo "<br><FONT color=#0000ff>$lang[required_races] $lang[Alliance]</FONT>";
     echo '<br><FONT color=#0000ff>'.$game_text['allowable_race'].' '.getAllowableRace($quest['RequiredRaces']).'</FONT>';
 }
 
if (getAllowableRace($quest['RequiredRaces']) && ($quest['RequiredRaces'] & 690) && ($quest['RequiredRaces'] !=1791))
 {
     echo "<br><FONT color=#ff0000>$lang[required_races] $lang[Horde]</FONT>";
     echo '<br><FONT color=#ff0000>'.$game_text['allowable_race'].' '.getAllowableRace($quest['RequiredRaces']).'</FONT>';
 }

if (($quest['RequiredRaces'] == 0) OR ($quest['RequiredRaces'] == 1791))
 {
     echo "<br><FONT color=#008800>$lang[required_races] $lang[Both]</FONT>";
     echo '<br><FONT color=#008800>'.$game_text['allowable_race'].' '.getAllowableRace(1791).'</FONT>';
 }

 if (getAllowableClass($quest['RequiredClasses']))
     echo '<br><FONT color=#000000>'.$game_text['allowable_class'].' '.getAllowableClass($quest['RequiredClasses']).'</FONT>';

 echo "</TH></TR>";
 echo "</TH></TR>";

 echo '<tr><td>';
 if ($quest['ZoneOrSort']>0)
   echo "<a style='float: right;' href=\"?s=q&ZoneID=".$quest['ZoneOrSort']."\">".getAreaName($quest['ZoneOrSort'], 0)."</a>";
 else
 if (($quest['ZoneOrSort']<0 && $quest['RequiredSkillValue'] == 0) and ($quest['ZoneOrSort'] != -263) and ($quest['ZoneOrSort'] != -262) and ($quest['ZoneOrSort'] != -261) and ($quest['ZoneOrSort'] != -372)
 and ($quest['ZoneOrSort'] != -161) and ($quest['ZoneOrSort'] != -162) and ($quest['ZoneOrSort'] != -82) and ($quest['ZoneOrSort'] != -141) and ($quest['ZoneOrSort'] != -61) and ($quest['ZoneOrSort'] != -81))
   echo "<a style='float: right;' href=\"?s=q&SortID=".(-$quest['ZoneOrSort'])."\">".getQuestSort(-$quest['ZoneOrSort'], 0)."</a>";
 echo "$lang[quest_level] $quest[QuestLevel]</td></tr>";
 if ($quest['RequiredSkill'])
   echo "<a style='float: right;' href=\"?s=q&SortID=".($quest['RequiredSkill'])."\">".getSkillName($quest['RequiredSkill'], 0)." ($quest[RequiredSkillValue])</a>";
   echo "$lang[obtained_at_level] $quest[MinLevel]</td></tr>";

 if ($quest['RequiredMinRepFaction'])
   echo "<TR><TD>$lang[item_faction_rank]:</TD></TR>";

 if ($quest['RequiredMinRepFaction'])
   echo "<TR><TD> ".getFactionName($quest['RequiredMinRepFaction']).": $quest[RequiredMinRepValue]($lang[item_min_level])</TD></TR>";

 if ($quest['RequiredMaxRepFaction'])
   echo "<TR><TD>".getFactionName($quest['RequiredMaxRepFaction']).": $quest[RequiredMaxRepValue]($lang[item_max_level])</TD></TR>";

 echo "<TR><TD>".getQuestText($quest['Objectives'])."<hr></TD></TR>";
 ### Рек собрать
 if ($quest['RepObjectiveFaction'])
   echo "<TR><TD>$lang[item_faction_rank]:</TD></TR>";

 if ($quest['RepObjectiveFaction'])
   echo "<TR><TD> ".getFactionName($quest['RepObjectiveFaction']).": $quest[RepObjectiveValue]($lang[item_min_level])</TD></TR>";

 if ($quest['ReqItemId1'] OR $quest['ReqItemId2'] OR $quest['ReqItemId3'] OR $quest['ReqItemId4'] OR $quest['ReqItemId5'] OR $quest['ReqItemId6'])
 {
  echo "<TR><TD class=mark>$lang[collect]</TD></TR>";
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
// echo "<TR><TD class=mark>$lang[kill]</TD></TR>";
 renderReqKillOrCast($quest['ObjectiveText1'],$quest['ReqCreatureOrGOId1'],$quest['ReqCreatureOrGOCount1'],$quest['ReqSpellCast1'],$q_status?$q_status['mobcount1']:0);
 renderReqKillOrCast($quest['ObjectiveText2'],$quest['ReqCreatureOrGOId2'],$quest['ReqCreatureOrGOCount2'],$quest['ReqSpellCast2'],$q_status?$q_status['mobcount2']:0);
 renderReqKillOrCast($quest['ObjectiveText3'],$quest['ReqCreatureOrGOId3'],$quest['ReqCreatureOrGOCount3'],$quest['ReqSpellCast3'],$q_status?$q_status['mobcount3']:0);
 renderReqKillOrCast($quest['ObjectiveText4'],$quest['ReqCreatureOrGOId4'],$quest['ReqCreatureOrGOCount4'],$quest['ReqSpellCast4'],$q_status?$q_status['mobcount4']:0);
}

if ($quest['ReqSourceId1'] != 0 OR $quest['ReqSourceId2'] != 0 OR
    $quest['ReqSourceId3'] != 0 OR $quest['ReqSourceId4'] != 0 )
{
 echo "<TR><TD class=mark>$lang[req_items]</TD></TR>";
 renderQuestSource($quest['ReqSourceId1'],$quest['ReqSourceCount1']);
 renderQuestSource($quest['ReqSourceId2'],$quest['ReqSourceCount2']);
 renderQuestSource($quest['ReqSourceId3'],$quest['ReqSourceCount3']);
 renderQuestSource($quest['ReqSourceId4'],$quest['ReqSourceCount4']);
}

###
echo "<TR><TD>".getQuestText($quest['Details'])."</TD></TR>";
if ($quest['SrcItemId'] || $quest['SrcSpell'])
{
 echo "<TR><TD class = head>$lang[provided]</TD></TR>";
 if ($quest['SrcItemId'])
 {
   $item = getItem($quest['SrcItemId'], "`entry`, `name`, `Quality`, `displayid`");
   echo '<TR><TD class=reward>&nbsp;'.text_show_item($item['entry'], $item['displayid']);
   echo '&nbsp;<a class='.$Quality[$item['Quality']].' href="?item='.$item['entry'].'">'.$item['name'].'</a>';
   if ($quest['SrcItemCount']>1) echo "&nbsp;x$quest[SrcItemCount]";
   echo "</TD></TR>";
 }
 if ($quest['SrcSpell'])
 {
  $spell=getSpell($quest['SrcSpell']); // Кастуемый спелл
  if ($spell) $spellName = getSpellName($spell);
  else        $spellName = "Spell $quest[SrcSpell]";
  echo "<TR><TD class=reward>&nbsp;";show_spell($spell['id'], $spell['SpellIconID']);
  echo " <A href=\"?spell=$spell[id]\">$spell[SpellName]</a></TD></TR>";
 }
}
echo "<TR><TD class = head>$lang[quest_rewards]</TD></TR>";

if ($quest['RewItemId1'] OR $quest['RewItemId1'] OR $quest['RewItemId1'] OR $quest['RewItemId1'])
{
 echo "<TR><TD class=mark>$lang[Rew_item]</TD></TR>";
 echo "<TR><TD class=reward>&nbsp;";
 if ($quest['RewItemId1']) {show_item($quest['RewItemId1']);}
 if ($quest['RewItemId2']) {echo $lang['item_sel_and'];show_item($quest['RewItemId2']);}
 if ($quest['RewItemId3']) {echo $lang['item_sel_and'];show_item($quest['RewItemId3']);}
 if ($quest['RewItemId4']) {echo $lang['item_sel_and'];show_item($quest['RewItemId4']);}
 echo "</TD></TR>";
}
if ($quest['RewChoiceItemId1'] OR $quest['RewChoiceItemId2'] OR $quest['RewChoiceItemId3'] OR
    $quest['RewChoiceItemId4'] OR $quest['RewChoiceItemId5'] OR $quest['RewChoiceItemId6'])
{
 echo "<TR><TD class=mark>$lang[Rew_select_item]</TD></TR>";
 echo "<TR><TD class=reward>&nbsp;";
 if ($quest['RewChoiceItemId1']) {show_item($quest['RewChoiceItemId1']);}
 if ($quest['RewChoiceItemId2']) {echo $lang['item_sel_or'];show_item($quest['RewChoiceItemId2']);}
 if ($quest['RewChoiceItemId3']) {echo $lang['item_sel_or'];show_item($quest['RewChoiceItemId3']);}
 if ($quest['RewChoiceItemId4']) {echo $lang['item_sel_or'];show_item($quest['RewChoiceItemId4']);}
 if ($quest['RewChoiceItemId5']) {echo $lang['item_sel_or'];show_item($quest['RewChoiceItemId5']);}
 if ($quest['RewChoiceItemId6']) {echo $lang['item_sel_or'];show_item($quest['RewChoiceItemId6']);}
 echo "</TD></TR>";
}
if ($quest['RewMailTemplateId'])
{
 $MailTime=$quest['RewMailDelaySecs']/60/60;
 $ItemMail=getItemMail($quest['RewMailTemplateId']);
 if ($ItemMail)
  {
    echo "<TR><TD class=mark>$lang[Rew_mail] $lang[Mail_item_time]".$MailTime."$lang[Mail_time]";
    echo "<TR><TD class=mark>$lang[Rew_item_mail]</TD></TR>";
    echo "<TR><TD class=reward>&nbsp;";{show_item($ItemMail);}
    echo "</TD></TR>";
  }
  else
  {
    echo "<TR><TD class=mark>$lang[Rew_mail] $lang[Mail_item_time]".$MailTime."$lang[Mail_time]";
    echo "</TD></TR>";
  }
}
if ($quest['RewSpell'] || $quest['RewSpellCast'])
{
 $learn = $quest['RewSpell'] ? $quest['RewSpell'] : $quest['RewSpellCast'];
 $spell=getSpell($learn);
 if ($spell) $spellName = getSpellName($spell);
 else        $spellName = "Spell $learn";
 echo '<TR><TD class=mark>'.($quest['RewSpell']?$lang['learn_spell']:$lang['cast_spell']).'</TD></TR>';
 echo "<TR><TD class=reward>&nbsp;";show_spell($spell['id'], $spell['SpellIconID']);
 echo " <A href=\"?spell=$spell[id]\">$spell[SpellName]</a></TD></TR>";
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
 echo "<TR><TD class=mark>$lang[Rew_reputation]</TD></TR>";
 if ($quest['RewRepFaction1'] && $quest['RewRepValue1'])echo "<TR><TD>&nbsp;".getFactionName($quest['RewRepFaction1']).": $quest[RewRepValue1]</TD></TR>";
 if ($quest['RewRepFaction2'] && $quest['RewRepValue2'])echo "<TR><TD>&nbsp;".getFactionName($quest['RewRepFaction2']).": $quest[RewRepValue2]</TD></TR>";
 if ($quest['RewRepFaction3'] && $quest['RewRepValue3'])echo "<TR><TD>&nbsp;".getFactionName($quest['RewRepFaction3']).": $quest[RewRepValue3]</TD></TR>";
 if ($quest['RewRepFaction4'] && $quest['RewRepValue4'])echo "<TR><TD>&nbsp;".getFactionName($quest['RewRepFaction4']).": $quest[RewRepValue4]</TD></TR>";
 if ($quest['RewRepFaction5'] && $quest['RewRepValue5'])echo "<TR><TD>&nbsp;".getFactionName($quest['RewRepFaction5']).": $quest[RewRepValue5]</TD></TR>";
}
if($quest['RewMoneyMaxLevel'])  echo "<TR><TD class=mark>$lang[Rew_XP] ".getQuestXPValue($quest)." xp";
if($quest['RewOrReqMoney']) echo "<TR><TD class=mark>$lang[Rew_money]&nbsp;".money($quest['RewOrReqMoney'])."</TD></TR>";
###

$number = 0;
echo "<TR><TD class = head>$lang[start]:</TD></TR>";
if ($rows = $dDB->select("SELECT *
                          FROM `creature_template` join `creature_questrelation`
                          WHERE
                          `creature_questrelation`.`quest` = ?d AND
                          `creature_questrelation`.`id` = `creature_template`.`entry`", $quest['entry']))
foreach ($rows as $creature)
{
  localiseCreature($creature);
  $loyality = getLoyality($creature['faction_A']);
  echo "<TR><TD><A style='float: right;' href=\"?map&npc=$creature[entry]\">$lang[map]</A>";
  echo "<A href=\"?npc=$creature[entry]\">$creature[name]</A> ($loyality)";
  if ($creature['subname'] != "")
   echo "<BR><FONT color=#008800 size=-3>&lt;$creature[subname]&gt;</FONT>";
  echo "</TD></TR>";
  $number++;
}
else
if ($rows = $dDB->select("SELECT *
                          FROM `creature_template` join `game_event_creature_quest`
                          WHERE
                          `game_event_creature_quest`.`quest` = ?d AND
                          `game_event_creature_quest`.`id` = `creature_template`.`entry`", $quest['entry']))
foreach ($rows as $creature)
{
  localiseCreature($creature);
  $loyality = getLoyality($creature['faction_A']);
  echo "<TR><TD><A style='float: right;' href=\"?map&npc=$creature[entry]\">$lang[map]</A>";
  echo "<A href=\"?npc=$creature[entry]\">$creature[name]</A> ($loyality)";
  if ($creature['subname'] != "")
   echo "<BR><FONT color=#008800 size=-3>&lt;$creature[subname]&gt;</FONT>";
  echo "</TD></TR>";
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
  echo "<TR><TD><A style='float: right;' href=\"?map&obj=$go[entry]\">$lang[map]</A>";
  echo "<A href=\"?object=$go[entry]\">$go[name]</A></TD></TR>";
  $number++;
}

if ($rows = $dDB->select("SELECT `entry`, `name`,`Quality`, `displayid` FROM `item_template` WHERE `startquest` = ?d", $quest['entry']))
foreach ($rows as $item)
{
 localiseItem($item);
 echo '<TR><TD class=reward>&nbsp;'.text_show_item($item['entry'], $item['displayid']);
 echo '&nbsp;<a class='.$Quality[$item['Quality']].' href="?item='.$item['entry'].'">'.$item['name'].'</a>';
 $number++;
}

if ($number==0)
echo "<TR><TD bgColor=#ff0000>-----NOT&nbsp;FOUND!------</TD></TR>";

$number = 0;
echo "<TR><TD class = head>$lang[end_q]:</TD></TR>";
if ($rows = $dDB->select("SELECT *
                          FROM `creature_template` join `creature_involvedrelation`
                          WHERE
                          `creature_involvedrelation`.`quest` = ?d AND
                          `creature_involvedrelation`.`id` = `creature_template`.`entry`", $quest['entry']))
foreach ($rows as $creature)
{
  localiseCreature($creature);
  $loyality = getLoyality($creature['faction_A']);
  echo "<TR><TD><A style='float: right;' href=\"?map&npc=$creature[entry]\">$lang[map]</A>";
  echo "<A href=\"?npc=$creature[entry]\">$creature[name]</A> ($loyality)";
  if ($creature['subname'] != "")
   echo "<BR><FONT color=#008800 size=-3>&lt;$creature[subname]&gt;</FONT>";
  echo "</TD></TR>";
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
  echo "<TR><TD><A style='float: right;' href=\"?map&obj=$go[entry]\">$lang[map]</A>";
  echo "<A href=\"?object=$go[entry]\">$go[name]</A></TD></TR>";
  $number++;
}

if ($number==0)
echo "<TR><TD bgColor=#ff0000>-----NOT&nbsp;FOUND!------</TD></TR>";

### этот квест часть серии:
$needForQuest = $dDB->selectRow("SELECT * FROM `quest_template` WHERE ABS(`PrevQuestId`) = ?d", $quest['entry']);
if ($quest['PrevQuestId'] != 0 or $quest['NextQuestId'] != 0 or $needForQuest)
{
 echo "<TR><TD class = head>$lang[this_quest_is_part_of_a_series]</TD></TR>";
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
     echo "<TR><TD>";
     echo "<div style='float: right;'>($lang[level] $qinfo[QuestLevel])</div>";
     echo "Step ($step)&nbsp;<A href=\"?quest=$qinfo[entry]\">$qinfo[Title]</A>";
     echo "</TD></TR>";
     $step++;
    }
 }
 echo "<TR><TD>";
 echo "<div style='float: right;'>($lang[level] $quest[QuestLevel])</div>";
 echo "Step ($step)&nbsp;$quest[Title]";
 echo "</TD></TR>";
 $step++;
 // Пытаемся найти следующие квесты
 $nextquest = $quest;
 while($nextquest!=0)
 {
   // Сначала по полю NextQuestId
   if ($nextquest['NextQuestId']!=0)
   {
     $nextquest = getQuest(abs($nextquest['NextQuestId']));
     echo "<TR><TD>";
     echo "<div style='float: right;'>($lang[level] $nextquest[QuestLevel])</div>";
     echo "Step ($step)&nbsp;<A href=\"?quest=$nextquest[entry]\">$nextquest[Title]</A>";
     echo "</TD></TR>";
   }
   // Если не вышло то по полю PrevQuestId = $nextquest[entry](у других квестов)
   else
   {
    if ($needForQuest)
    {
     localiseQuest($needForQuest);
     $nextquest=$needForQuest;
     echo "<TR><TD>";
     echo "<div style='float: right;'>($lang[level] $nextquest[QuestLevel])</div>";
     echo "Step ($step)&nbsp;<A href=\"?quest=$nextquest[entry]\">$nextquest[Title]</A>";
     echo "</TD></TR>";
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
 echo "<TR><TD class = head>$lang[req_for_quest]</TD></TR>";
 foreach ($needForQuest as $nextquest)
 {
  localiseQuest($nextquest);
  echo "<TR><TD>";
  echo "<div style='float: right;'>($lang[level] $nextquest[QuestLevel])</div>";
  echo "<A href=\"?quest=$nextquest[entry]\">$nextquest[Title]</A>";
  echo "</TD></TR>";
 }
}

###
echo "<TR><TD class = head>$lang[additional_info]</TD></TR>";
echo "<TR><TD><b style='float: right;'>".getNumPalayersCompletedQuest($quest['entry'])."</b>{$lang['players_completed_quest']}:</TD></TR>";
echo "<TR><TD><b style='float: right;'>".getNumPalayersWithThisQuest($quest['entry'])."</b>{$lang['players_with_this_quest']}:</TD></TR>";
echo "</TBODY></TABLE>";
}
?>
