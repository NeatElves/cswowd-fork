<?php
include_once("include/functions.php");
$debug = @$_REQUEST['debug'];
//********************************************************************************
// списки ex cost
//********************************************************************************
if ($debug == "ex_cost")
{
 $rows = $wDB->select("SELECT * FROM `wowd_item_ex_cost`");
 if ($rows)
 {
    echo "<br><table class=report width=500>";
    echo "<tbody>";
    echo "<tr><td colspan=3 class=head>Ex costs</td></tr>";
    echo "<tr><th width=20>$lang[id]</th><th width=100%>$lang[item_list]</th><th>$lang[cost]</th></tr>";
    foreach ($rows as $cost)
    {
      echo "<tr>";
      echo "<td>".$cost['id']."</td>";
      $items = $dDB->select("SELECT `item` FROM `npc_vendor` WHERE ExtendedCost = ?d GROUP BY `item`", $cost['id']);
      if ($items)
      {
       echo "<td align=center>";
       foreach ($items as $itemid)
         show_item($itemid['item'], 0, "sell");
       echo "</td>";
      }
      else
          echo "<td align=center>$lang['not_found']</td>";
      echo "<td align=center>".showExtendCostData($cost, 0)."</td>";
      echo "</tr>";
    }
    echo "</tbody></table>";
 }
}
//********************************************************************************
// Списки lock
//********************************************************************************
else
if ($debug == "lock")
{
 $rows = $wDB->select("SELECT * FROM `wowd_lock`");
 if ($rows)
 {
  echo "<br><table class=report width=500>";
  echo "<tbody>";
  echo "<tr><td colspan=3 class=head>lock</td></tr>";
  echo "<tr><th width=1%>id</th><th>info</th><th>items and obj</th></tr>";
  foreach ($rows as $lock)
  {
   echo "<tr>";
   echo "<td>$lock[id]</td>";
   echo "<td>";
   for ($i=0;$i<8;$i++)
   {
      $type = $lock['keytype_'.$i];
      $key  = $lock['key_'.$i];
      $reqskill = $lock['reqskill_'.$i];
      $unk = $lock['unk_'.$i];
      if ($type == 0)
          continue;
      echo "&nbsp;&nbsp;";
      if ($type == 1)
          echo text_show_item($key, 0, 'cost').($reqskill?" ($reqskill)":"")." - $unk";
      if ($type == 2)
          echo getLockType($key).($reqskill?" ($reqskill)":"")." - $unk";
      echo "<br>";
   }
   echo "</td>";
   echo "<td align=center>";
   $data0 = array(2,3,6,10,13);
   $data1 = array(0, 1);
   $items = $dDB->select("SELECT `entry`, `Quality`, `displayid`, `name` FROM `item_template` WHERE `lockid` = ?d", $lock['id']);
   $go_list = $dDB->select("SELECT `entry`,`name` FROM `gameobject_template`
    WHERE
     (`type` IN (?a) AND `data0` = ?d) OR
     (`type` IN (?a) AND `data1` = ?d)", $data0, $lock['id'], $data1, $lock['id']);
   if ($items)
   foreach ($items as $_item)
      show_item($_item['entry'], $_item['displayid'], "sell");
   if ($items) echo "<br>";
   if ($go_list)
   foreach ($go_list as $go)
   {
      localiseGameobject($go);
      echo "<a href=\"?object=$go[entry]\">$go[name]</a><br>";
   }
   if ($items AND $go_list == 0)
      echo "$lang['not_found']";
   echo "</td>";
   echo "</tr>";
  }
  echo "</tbody></table>";
 }
}
//********************************************************************************
// Таблица race_class_info
//********************************************************************************
else
if ($debug == "race_class_info")
{
  echo "<br><table class=report width = 800><tbody>";
  echo "<tr><td colspan=8 class=head>skill_race_class_info</td></tr>";
  echo "<tr>";
  $skillraceclass = $wDB->select("SELECT * FROM `wowd_skill_race_class_info` order by classMask, id");
  foreach ($skillraceclass as $info)
  {
   $skillLine = getSkillLine($info['skillId']);
   if (empty($skillLine) or @$skillLine['Category']!=@$_REQUEST['cat']) continue;

   echo "<tr>";
   echo "<td>$info[Id]</td>";
   if ($skillLine)
    echo "<td>".$skillLine['Name']."-".$info['skillId']."</td>";
   else
   echo "<td>".$info['skillId']."</td>";
   echo "<td>".getAllowableRace($info['raceMask'])."</td>";
   echo "<td>".getAllowableClass($info['classMask'])."</td>";
   echo "<td>$info[Unc_5]</td>";
   echo "<td>$info[reqLevel]</td>";
   echo "<td>$info[skillTiers]</td>";
   echo "<td>$info[Unc_8]</td>";
   echo "</tr>";
  }
  echo "</tbody></table>";
}
//********************************************************************************
// Таблица skill_line_ability
//********************************************************************************
else
if ($debug == "skill_line")
{
  echo "<br><table class=report width = 500><tbody>";
  echo "<tr><td colspan=12 class=head>skill_line_ability</td></tr>";
  echo "<tr>";
  $skillAbility = $wDB->select("
  SELECT *
  FROM `wowd_skill_line_ability`
  ORDER BY `skillId`, min_value");
  $current = -1;
  $skillLine = 0;
  foreach ($skillAbility as $skill)
  {
   $n=false;
   if ($skill['skillId']!=$current)
   {
    $current = $skill['skillId'];
    $skillLine = getSkillLine($current);
    $n=true;
   }
   if ($skillLine['Category'] != 11) continue;

  if ($n)
      echo "<tr><td colspan=12 class=head>".$skillLine['Name']."(".$skillLine['Category'].")</td></tr>";
   $spell = getSpell($skill['spellId'],"`id`, `SpellIconID`, `SpellName`, `Rank`");
   if ($spell==0)
     continue;
   echo "<tr>";
//   echo "<td width=1px>";show_spell($spell['id'], $spell['SpellIconID'], "spell");echo "</td>";
   echo "<td>($skill[spellId])<a href=\"?q=s&entry=$spell[id]\">$spell[SpellName]</a>";
   if ($spell['Rank'] != "") echo "<div class=srank>($spell[Rank])</div>";
   echo "</td>";
   echo "<td>";echo getAllowableRace($skill['RaceMask']);echo "</td>";
   echo "<td>";echo getAllowableClass($skill['ClassMask']);echo "</td>";
   echo "<td>".$skill['unk3']."</td>";
   echo "<td>".$skill['unk4']."</td>";
   echo "<td>".$skill['req_skill_value']."</td>";
   if ($skill['forward_spellid'])
   {
 	  $spell = getSpell($skill['forward_spellid'],"`id`, `SpellIconID`, `SpellName`, `Rank`");
      echo "<td><a href=\"?q=s&entry=$spell[id]\">$spell[SpellName]</a>";
      if ($spell['Rank'] != "") echo "<div class=srank>($spell[Rank])</div>";
      echo "</td>";
   }
   else
      echo "<td></td>";
   echo "<td>".$skill['LearnOnGetSkill']."</td>";
   echo "<td>".$skill['min_value']."-".$skill['max_value']."</td>";
   echo "<td>".$skill['unk6']."</td>";
   echo "<td>".$skill['unk7']."</td>";
   echo "<td>".$skill['reqtrainpoints']."</td>";
   echo "</tr>";
  }
  echo "</tbody></table>";
}
//********************************************************************************
// Таблица Glyph Properties
//********************************************************************************
else
if ($debug == "glyph")
{
  echo "<br><table class=report width = 500><tbody>";
  echo "<tr><td colspan=12 class=head>GLUPH</td></tr>";
  $glyphs = $wDB->select("SELECT * FROM `wowd_glyphproperties`");
  foreach($glyphs as $glyph)
  {
   echo "<tr>";
   echo "<td>$glyph[id]</td>";
   echo "<td>".getSpellName(getSpell($glyph['SpellId']))."</td>";
   echo "<td>$glyph[TypeFlags]</td>";
   echo "<td>$glyph[Unk1]</td><td><img src=".getSpellIcon($glyph['Unk1'])." width=24></td>";
   echo "</tr>";
  }
  echo "</tbody></table>";
}
//********************************************************************************
// Таблица Achievement
//********************************************************************************
else
if ($debug == "achievement")
{
  echo "<br><table class=report width = 100%><tbody>";
  echo "<tr><td colspan=13 class=head>Achievement</td></tr>";
  $achievements = $wDB->select("
  SELECT *
  FROM `wowd_achievement`
  WHERE refAchievement <> 0
  ORDER BY categoryId, OrderInCategory");
  foreach ($achievements as $a)
  {
     echo "<tr>";
     echo "<td>$a[id]</td>";
     echo "<td>$a[factionFlag]</td>";
     echo "<td>$a[mapID]</td>";
     echo "<td>".$wDB->selectCell("SELECT `description` FROM `wowd_achievement` WHERE `id` = ?d", $a['unk1'])."</td>";
     echo "<td>$a[name]</td>";
     echo "<td>$a[description]</td>";
     echo "<td>$a[categoryId]</td>";
     echo "<td>$a[points]</td>";
     echo "<td>$a[OrderInCategory]</td>";
     echo "<td>$a[flags]</td>";
     echo "<td><img src=".getSpellIcon($a['iconId'])." width=24></td>";
     echo "<td>$a[unk2]</td>";
     echo "<td>$a[count]</td>";
     echo "<td>".$wDB->selectCell("SELECT `description` FROM `wowd_achievement` WHERE `id` = ?d", $a['refAchievement'])."</td>";
     echo "</tr>";
  }
  echo "</tbody></table>";
}
else
if ($debug == "chain")
{
   $chain = $wDB->select(
   "select
   `wowd_skill_line_ability`.`id` AS `id`,
   `wowd_spell`.`id` AS `SpellId`,
   `wowd_spell`.`SpellName` AS `SpellName`,
   `wowd_spell`.`Rank` AS `Rank`,
   `wowd_skill_line_ability`.`forward_spellid` AS `forward_spellid`,
   `wowd_spell`.`SpellIconID` AS `SpellIconID`,
   `wowd_spell`.`baseLevel` AS `baseLevel`,
   `wowd_spell`.`spellLevel` AS `spellLevel`,
   `wowd_skill_line_ability`.`skillId` AS `skillId`,
   `wowd_skill_line_ability`.`LearnOnGetSkill` AS `LearnOnGetSkill`
   from
    `wowd_skill_line_ability`
      left join
    `wowd_spell`
    on `wowd_skill_line_ability`.`spellId` = `wowd_spell`.`id`
   where
    `baseLevel` > 0 AND
    `Rank` LIKE '%Rank%' AND
    (`runeCostID` = '0' OR `ManaCostPercentage` = '0' OR `manaCost` = '0')
   ORDER BY `skillId`, `SpellName`, `baseLevel`, `Rank`"
   );
  $currentSkill = -1;
  $currentSpell = -1;

  $first = 0;
  $prev = 0;
  echo "<div class=faq>";
  foreach ($chain as $c)
  {
     if ($c['skillId']!=$currentSkill)
     {
         $currentSkill = $c['skillId'];
         echo "/* ------------------<br>";
         echo "-- (".$currentSkill.") ".getSkillName($currentSkill,0)."<br>";
         echo "-- --------------- */<br>";
     }
     if ($currentSpell != $c['SpellName'])
     {
         $currentSpell = $c['SpellName'];
         echo "/* ".$currentSpell." */<br>";
         $first = $c['SpellId'];
         $prev = 0;
     }
     $rank = str_ireplace("Rank ", "", $c['Rank']);
     echo "INSERT INTO `spell_chain` VALUES (";
     echo str_pad("'".$c['SpellId']."'", 7, "_", STR_PAD_LEFT).", ";
     echo str_pad("'".$prev."'", 7, "_", STR_PAD_LEFT).", ";
     echo str_pad("'".$first."'", 7, "_", STR_PAD_LEFT).", ";
     echo str_pad("'".$rank."'", 4, "_", STR_PAD_LEFT).", '0');<br>";

     $prev = $c['SpellId'];
  }
  echo "</div>";
}
else
if ($debug == "summon")
{
  echo "<br><table class=report width = 100%><tbody>";
  echo "<tr><td colspan=13 class=head>Summon type</td></tr>";
  $summons = $wDB->select("SELECT * FROM `wowd_summon_type` WHERE `unk2` <> 0 ORDER BY unk2");
  foreach ($summons as $s)
  {
     echo "<tr>";
     if ($s['unk2'])
          $s['unk2'] = getFactionTemplateName($s['unk2']);
     echo "<td>".$s['id']." - $s[unk1], $s[unk2], $s[unk3], $s[unk4], $s[unk5]</td>";
     echo "</tr>";
     echo "<tr>";
     echo "<td>";

     $rows = $wDB->select(
     "SELECT `id`, `SpellIconID`, `SpellName`, `Rank` FROM `wowd_spell`
      WHERE
      ((`Effect_1` = '28' AND `EffectMiscValue2_1` = ".$s['id']." ) OR
       (`Effect_2` = '28' AND `EffectMiscValue2_2` = ".$s['id']." ) OR
       (`Effect_3` = '28' AND `EffectMiscValue2_3` = ".$s['id']." ))
      -- AND SpellFamilyName > 2
        LIMIT 0, 200");
      foreach ($rows as $spell)
      {
          echo "(".$spell['id'].") <a href=?spell=".$spell['id']." onmouseover=\"ajaxTip('s$spell[id]');\">".$spell['SpellName']."</a><br>";
      }

     echo "</td>";
     echo "</tr>";
  }
  echo "</tbody></table>";
}
else
if ($debug == "talent")
{
  echo "<br><table class=report width = 100%><tbody>";
  echo "<tr><td colspan=13 class=head>Talent</td></tr>";
//  $talent = $wDB->select("SELECT * FROM `wowd_talents` WHERE `unkFlags1` <> 0  ORDER BY `TalentTab`, `Row`, `Col`");
   $petId = 0;
   $petMask1=0;
   $petMask2=0;
     if ($petId < 32) $petMask1=1<<($petId);
   else               $petMask2=1<<($petId-32);
   $talent = $wDB->select(
   "SELECT
    *
    FROM
    `wowd_talents`
    WHERE
    `TalentTab` = ?d
    AND
    ((`unkFlags1`=0 AND `unkFlags2`=0) OR (`unkFlags1`& ?d) OR (`unkFlags2`& ?d))", 411, $petMask1, $petMask2);

  foreach ($talent as $t)
  {
     echo "<tr>";
     echo "<td>";echo "$t[TalentTab], $t[Row], $t[Col]";echo "</td>";
     echo "<td>";echo getSpellName(getSpell($t['Rank_1']));echo "</td>";
//     echo "<td>";echo getSpellName(getSpell($t['Rank_2']));echo "</td>";
//     echo "<td>";echo getSpellName(getSpell($t['Rank_3']));echo "</td>";
//     echo "<td>";echo getSpellName(getSpell($t['Rank_4']));echo "</td>";
//     echo "<td>";echo getSpellName(getSpell($t['Rank_5']));echo "</td>";
     echo "<td>".getHunterPetList($t['unkFlags1'])."</td>";
     echo "</tr>";
  }
  echo "</tbody></table>";
}
?>
