<?php
include_once ("item_table.php");
include_once ("spell_table.php");
include_once ("talent_table.php");
include_once ("gameobject_table.php");
include_once ("enchant_table.php");

function getLPageOffset($page, $limit)
{
 if ($page< 1)$page_seek = 0;
 else         $page_seek = ($page-1) * $limit;
 return $page_seek;
}

function getPageOffset($page)
{
 global $config;
 return getLPageOffset($page, $config['fade_limit']);
}

function generateLPage($totalRecords, $currentPage, $link, $limit, $colSpan)
{
   $totalPage   = floor($totalRecords /$limit+0.9999);
   if ($totalPage <=1) return;
   if ($currentPage<1)
       $currentPage = 1;
   echo "<tr><td colSpan=$colSpan class=page>";
   for ($i=1;$i<=$totalPage;$i++)
   {
    if ($i!=$currentPage) printf($link, $i, $i);
    else                  echo '<b><i>'.$i.' </i></b>';
   }
   echo "</td></tr>";
}

function generatePage($totalRecords, $currentPage, $link, $colSpan)
{
 global $config;
 generateLPage($totalRecords, $currentPage, $link, $config['fade_limit'], $colSpan);
}

function RenderError($text)
{
 echo "Error - $text";
}
function money($many, $height=10)
{
 if ($many>0)
 {
  $many = str_pad($many, 12, 0, STR_PAD_LEFT);
  $str  = "";
 }
 else if ($many == 0)
  return "n/a";
 else
 {
  $many = str_pad(-$many, 12, 0, STR_PAD_LEFT);
  $str  = "-";
 }
 $copper = intval(substr($many, -2));
 $silver = intval(substr($many, -4, -2));
 $gold   = intval(substr($many, -11, -4));
 $hstr = "";
 if ($height!=14) $hstr = "height={$height}px";
 if ($gold  ) { $str.= "$gold<img $hstr src=images/gold.gif> "; }
 if ($silver) { $str.= "$silver<img $hstr src=images/silver.gif> "; }
 if ($copper) { $str.= "$copper<img $hstr src=images/copper.gif>"; }
 return $str;
}

function getTimeText($seconds)
{
  $text = "";
  if ($seconds >=24*3600) {$text.= intval($seconds/(24*3600))." days"; if ($seconds%=24*3600) $text.=" ";}
  if ($seconds >=   3600) {$text.= intval($seconds/3600)." hours"; if ($seconds%=3600) $text.=" ";}
  if ($seconds >=     60) {$text.= intval($seconds/60)." min"; if ($seconds%=60) $text.=" ";}
  if ($seconds >       0) {$text.= $seconds." sec";}
  return $text;
}

// Функция разделения строки по точке
function mergeStrByPoint($str, &$a, &$b)
{
  $len = strlen($str);
  if ($len == 0) {$a = -1; $b = -1; return;}
  if ($x = strpos($str, '.'))
  {
     $a = intval(substr($str, 0, $x));
	 $b = intval(substr($str, $x + 1, $len - $x));
     return;
  }
  $a = intval($str);
  $b = -1;
}

/**
 * Convert a PHP scalar, array or hash to JS scalar/array/hash. This function is
 * an analog of json_encode(), but it can work with a non-UTF8 input and does not
 * analyze the passed data. Output format must be fully JSON compatible.
 *
 * @param mixed $a   Any structure to convert to JS.
 * @return string    JavaScript equivalent structure.
*/
function php2js($a=false)
{
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a)) {
        if (is_float($a)) {
            // Always use "." for floats.
            $a = str_replace(",", ".", strval($a));
        }
        // All scalars are converted to strings to avoid indeterminism.
        // PHP's "1" and 1 are equal for all PHP operators, but
        // JS's "1" and 1 are not. So if we pass "1" or 1 from the PHP backend,
        // we should get the same result in the JS frontend (string).
        // Character replacements for JSON.
        static $jsonReplaces = array(
            array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
            array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"')
        );
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
       if (key($a) !== $i) {
            $isList = false;
            break;
        }
    }
    $result = array();
    if ($isList) {
        foreach ($a as $v) {
            $result[] = php2js($v);
        }
        return '[ ' . join(', ', $result) . ' ]'."\n";
    } else {
        foreach ($a as $k => $v) {
            $result[] = php2js($k) . ': ' . php2js($v);
        }
        return '{ ' . join(', ', $result) . ' }';
    }
}

// составляет список
function getListFromArray($array, $i, $mask, $href)
{
  $text = "";
  while ($mask)
  {
    if ($mask & 1)
    {
      $data = @$array[$i]; if ($data == "") $data = "$i";
      if ($href)
        $text.="<a href=\"".sprintf($href, $i)."\">".$data."</a>";
      else
        $text.=$data;
      if ($mask!=1)
        $text.=", ";
    }
    $mask>>=1;
    $i++;
  }
  return $text;
}
// составляет список c 0
function getListFromArray_0($array, $mask, $href="")
{
  return getListFromArray($array, 0, $mask, $href);
}
// составляет список c 1
function getListFromArray_1($array, $mask, $href="")
{
  return getListFromArray($array, 1, $mask, $href);
}

function getExtendCost($excostid)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_item_ex_cost` WHERE `id` = ?d', $excostid);
}

function healthmanaex($hp)
{
 echo number_format($hp);
}

function getLootList($lootId, $table, $totalRecords, $offset=0, $count=0)
{
  global $dDB;
  $totalRecords = 0;
  $limit = "";
  if ($count) $limit =  "LIMIT $offset, $count";
  $rows = $dDB->selectPage($totalRecords, "SELECT * FROM `$table`
                                           WHERE `entry` = ?d
                                           GROUP BY  IF (`mincountOrRef` < 0, `mincountOrRef`, `item`)
                                           ORDER BY `groupid`, `ChanceOrQuestChance`>0, ABS(`ChanceOrQuestChance`) DESC $limit", $lootId);
  if (!$rows)
      return 0;
  foreach($rows as &$loot)
  {
    // Group chance
    if ($loot['ChanceOrQuestChance'] == 0)
    {
     $group = $loot['groupid'];
     $chance = 0; $n = 0;
     foreach($rows as &$g)
       if ($g['groupid'] == $group)
       {
          if ($g['ChanceOrQuestChance']>0) $chance+=$g['ChanceOrQuestChance'];
          else                             $n++;
       }
     $chance =  round((100 - $chance) / $n, 3);
     foreach($rows as &$g)
       if ($g['groupid'] == $group && $g['ChanceOrQuestChance']==0)
         $g['ChanceOrQuestChance'] =$chance;
    }
    if ($loot['mincountOrRef'] < 0)
    {
       // Получаем список
       $subcount = 0;
       $loot['item']  = getLootList(-$loot['mincountOrRef'], "reference_loot_template", $subcount);
       $loot['maxcount'] = $dDB->selectCell("SELECT count(*) FROM `$table` WHERE `entry` = ?d AND `mincountOrRef` = ?d", $lootId, $loot['mincountOrRef']);
    }
  }
  return $rows;
}

//******************************************************************************
// Локализация данных
//******************************************************************************
function localiseCreature(&$creature)
{
   global $dDB, $config;
   $locale = $config['locales_lang'];
   if ($locale == 0 OR @$creature['entry'] == 0)
       return;
   $lang = $dDB->selectRow('-- CACHE: 1h
   SELECT
   `name_loc'.$locale.'` AS `name`,
   `subname_loc'.$locale.'` AS `subname`
   FROM `locales_creature`
   WHERE `entry` = ?d', $creature['entry']);
   if ($lang)
   {
       if ($lang['name']) $creature['name'] = $lang['name'];
       if ($lang['subname']) $creature['subname'] = $lang['subname'];
   }
}

function localiseGameobject(&$go)
{
   global $dDB, $config;
   $locale = $config['locales_lang'];
   if ($locale == 0 OR $go['entry']==0)
       return;
   $lang = $dDB->selectRow('-- CACHE: 1h
   SELECT
   `name_loc'.$locale.'` AS `name`,
   `castbarcaption_loc'.$locale.'` AS `cast_name`
   FROM `locales_gameobject`
   WHERE `entry` = ?d', $go['entry']);
   if ($lang)
   {
       if ($lang['name']) $go['name'] = $lang['name'];
       if ($lang['cast_name']) $go['castBarCaption'] = $lang['cast_name'];
   }
}

function localiseQuest(&$quest)
{
   global $dDB, $config;
   $locale = $config['locales_lang'];
   if ($locale == 0 OR @$quest['entry']==0)
       return;
   $lang = $dDB->selectRow('-- CACHE: 1h
   SELECT
   `Title_loc'.$locale.'` as `Title`,
   `Details_loc'.$locale.'` as `Details`,
   `Objectives_loc'.$locale.'` as `Objectives`,
   `OfferRewardText_loc'.$locale.'` as `OfferRewardText`,
   `RequestItemsText_loc'.$locale.'` as `RequestItemsText`,
   `EndText_loc'.$locale.'` as `EndText`,
   `ObjectiveText1_loc'.$locale.'` as `ObjectiveText1`,
   `ObjectiveText2_loc'.$locale.'` as `ObjectiveText2`,
   `ObjectiveText3_loc'.$locale.'` as `ObjectiveText3`,
   `ObjectiveText4_loc'.$locale.'` as `ObjectiveText4`
   FROM `locales_quest` WHERE `entry` = ?d', $quest['entry']);
   if ($lang)
   {
    if ($lang['Title'])           $quest['Title']           = $lang['Title'];
    if ($lang['Details'])         $quest['Details']         = $lang['Details'];
    if ($lang['Objectives'])      $quest['Objectives']      = $lang['Objectives'];
    if ($lang['OfferRewardText']) $quest['OfferRewardText'] = $lang['OfferRewardText'];
    if ($lang['RequestItemsText'])$quest['RequestItemsText']= $lang['RequestItemsText'];
    if ($lang['EndText'])         $quest['EndText']         = $lang['EndText'];
    if ($lang['ObjectiveText1'])  $quest['ObjectiveText1']  = $lang['ObjectiveText1'];
    if ($lang['ObjectiveText2'])  $quest['ObjectiveText2']  = $lang['ObjectiveText2'];
    if ($lang['ObjectiveText3'])  $quest['ObjectiveText3']  = $lang['ObjectiveText3'];
    if ($lang['ObjectiveText4'])  $quest['ObjectiveText4']  = $lang['ObjectiveText4'];
   }
}

function localiseItem(&$item)
{
   global $dDB, $config;
   $locale = $config['locales_lang'];
   if ($locale == 0 OR $item['entry']==0)
       return;
   $lang = $dDB->selectRow('-- CACHE: 1h
   SELECT
   `name_loc'.$locale.'` AS `name`,
   `description_loc'.$locale.'` AS `desc`
   FROM `locales_item`
   WHERE `entry` = ?d', $item['entry']);
   if ($lang)
   {
       if ($lang['name']) $item['name'] = $lang['name'];
       if ($lang['desc']) $item['description'] = $lang['desc'];
   }
}

function getScalingStatDistribution($id)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_scaling_stat_distribution` WHERE `id` = ?d', $id);
}
function getScalingStatValues($level)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_scaling_stat_values` WHERE `level` = ?d', $level);
}

function getRandomSuffix($id)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_item_random_suffix` WHERE `id` = ?d', $id);
}

function getRandomProperty($id)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_item_random_propety` WHERE `id` = ?d', $id);
}

function getRandomPropertyPoint($level, $type, $quality)
{
   if ($level < 0 OR $level > 300)
       return 0;
   switch ($quality)
   {
        case 2: $field = "uncommon"; break; // ITEM_QUALITY_UNCOMMON
        case 3: $field = "rare";     break; // ITEM_QUALITY_RARE
        case 4: $field = "epic";     break; // ITEM_QUALITY_EPIC
        default:
            return 0;
   }
   switch ($type)
   {
       case  0: // INVTYPE_NON_EQUIP:
       case 18: // INVTYPE_BAG:
       case 19: // INVTYPE_TABARD:
       case 24: // INVTYPE_AMMO:
       case 27: // INVTYPE_QUIVER:
       case 28: // INVTYPE_RELIC:
           return 0;
       case  1: // INVTYPE_HEAD:
       case  4: // INVTYPE_BODY:
       case  5: // INVTYPE_CHEST:
       case  7: // INVTYPE_LEGS:
       case 17: // INVTYPE_2HWEAPON:
       case 20: // INVTYPE_ROBE:
           $field.= "_0";
           break;
       case  3: // INVTYPE_SHOULDERS:
       case  6: // INVTYPE_WAIST:
       case  8: // INVTYPE_FEET:
       case 10: // INVTYPE_HANDS:
       case 12: // INVTYPE_TRINKET:
           $field.= "_1";
           break;
       case  2: // INVTYPE_NECK:
       case  9: // INVTYPE_WRISTS:
       case 11: // INVTYPE_FINGER:
       case 14: // INVTYPE_SHIELD:
       case 16: // INVTYPE_CLOAK:
       case 23: // INVTYPE_HOLDABLE:
           $field.= "_2";
           break;
       case 13: // INVTYPE_WEAPON:
       case 21: // INVTYPE_WEAPONMAINHAND:
       case 22: // INVTYPE_WEAPONOFFHAND:
           $field.= "_3";
           break;
       case 15: // INVTYPE_RANGED:
       case 25: // INVTYPE_THROWN:
       case 26: // INVTYPE_RANGEDRIGHT:
           $field.= "_4";
           break;
       default:
           return 0;
   }
   global $wDB;
   return $wDB->selectCell("-- CACHE: 1h
   SELECT `$field` FROM `wowd_random_property_points` WHERE `itemlevel` = ?d", $level);
}

function getGlyph($entry)
{
   global $wDB;
   return $wDB->selectRow('-- CACHE: 1h
   SELECT * FROM `wowd_glyphproperties` WHERE `id` = ?d', $entry);
}

function getGlyphName($entry)
{
   if ($g=getGlyph($entry))
     return getSpellName(getSpell($g['SpellId']));
   return 'Glyph_'.$entry;
}

function getLockTypeNames()
{
  global $wDB;
  return $wDB->selectCol('-- CACHE: 1h
  SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_lock_type`');
}
// Lock
function getLockType($id, $asref=1)
{
    $l = getLockTypeNames();
    $name = isset($l[$id]) ? $l[$id] : 'Lock_type_'.$id;
    if ($asref==1)
        return '<a href="?s=s&lock='.$id.'">'.$name.'</a>';
    if ($asref==2)
        return '<a href="?s=o&lockSkill='.$id.'">'.$name.'</a>';
    if ($asref==3)
        return '<a href="?s=o&lockItem='.$id.'">'.$name.'</a>';
    return $name;
}

// Работа с lock
function getLock($id)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_lock` WHERE `id` = ?d', $id);
}

// Spellfocus
function getSpellFocus($id)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_spellfocus` WHERE `id` = ?d', $id);
}

// Spellfocus
function getSpellFocusName($id, $reftype=0)
{
  $focus = getSpellFocus($id);
  if ($focus)
  {
      if ($reftype == 1) return "<a href=?s=s&focus=$id>".$focus['name']."</a>";
      if ($reftype == 2) return "<a href=?s=o&focus=$id>".$focus['name']."</a>";
      return $focus['name'];
  }
  return "Spellfocus_$id";
}

// Работа со скилами
function getSkillLineAbility($spellId)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_skill_line_ability` WHERE `spellId` = ?d', $spellId);
}

function getSkillLine($id)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_skill_line` WHERE `id` = ?d', $id);
}

function getSkillName($skillId, $as_ref=1)
{
  $skillLine = getSkillLine($skillId);
  if ($skillLine)
  {
    if ($as_ref)
      return "<a href=\"?skill=$skillId\">".$skillLine['Name']."</a>";
    else
      return $skillLine['Name'];
  }
  return "";
}

function getSkillNameForSpell($spellId, $as_ref=1)
{
  if ($SkillLineAbility = getSkillLineAbility($spellId))
    return getSkillName($SkillLineAbility['skillId'], $as_ref);
  return "";
}

function show_spell($entry, $iconId=0, $style=0)
{
  global $wDB;
  if (!$iconId)
      $iconId = $wDB->selectCell('-- CACHE: 1h
	  SELECT `SpellIconID` FROM `wowd_spell` WHERE `id` = ?d', $entry);
  $icon = getSpellIcon($iconId);
  echo '<a href="?spell='.$entry.'"><img'.($style?' class='.$style:'').' src="'.$icon.'"></a>';
  return;
}

function validateText($text)
{
  $letter = array("'",'"'     ,"<"   ,">"   ,">"   ,"\r","\n"  );
  $values = array("`",'&quot;',"&lt;","&gt;","&gt;",""  ,"<br>");
  return str_replace($letter, $values, $text);
}
function addTooltip($text, $extra='')
{
  if ($text=='') return '';
  return 'onmouseover="Tip(\''.validateText($text).'\''.($extra?','.$extra:'').');"';
}

function getSpellTargetPosition($id)
{
 global $dDB;
 return $dDB->selectRow("SELECT * FROM `spell_target_position` WHERE `id` = ?d", $id);
}

function getSpellScriptTarget($id)
{
 global $dDB;
 return $dDB->selectRow("SELECT * FROM `spell_script_target` WHERE `entry` = ?d", $id);
}

function getEnchantment($enchantmentId)
{
 global $wDB;
 return $wDB->selectRow('-- CACHE: 1h
 SELECT * FROM `wowd_item_enchantment` WHERE `id` = ?d', $enchantmentId);
}

function getEnchantmentDesc($enchantment)
{
 if ($enc = getEnchantment($enchantment))
     return "<a href=?enchant=$enchantment>".validateText($enc['description'])."</a>";
 return "Enchant $enchantment";
}

function getGemInfo($GemId)
{
 global $wDB;
 return $wDB->selectRow('-- CACHE: 1h
 SELECT * FROM `wowd_gemproperties` WHERE `id` = ?d', $GemId);
}

function getGemProperties($GemProperties)
{
 if ($gem = getGemInfo($GemProperties))
   return getEnchantmentDesc($gem['spellitemenchantement']);
 return "Gem Properties id - $GemProperties";
}

//********************************************************************************
function getCreature($creature_id, $fields = "*")
{
  global $dDB;
  if ($creature = $dDB->selectRow("-- CACHE: 1h
  SELECT $fields FROM `creature_template` WHERE `entry` = ?d", $creature_id))
      localiseCreature($creature);
  return $creature;
}

function getCreatureName($creature_id, $as_ref=1)
{
 if ($Creature=getCreature($creature_id, "`entry`, `name`"))
 {
    if ($Creature['name']=="") $Creature['name'] = "npc_$creature_id";
    if ($as_ref)
        return "<a href=?npc=".$Creature['entry'].">".$Creature['name']."</a>";
    return $Creature['name'];
 }
 return "Unknown creature - $creature_id";
}

function getCreatureRank($rank, $as_ref=1)
{
  global $gCreatureRank;
  $name = @$gCreatureRank[$rank];
  if (empty($name)) $name = "Rank_".$rank;
  if ($as_ref)
     return "<a href=\"?s=n&rank=$rank\">".$name."</a>";
  return $name;
}

function getCreatureFamilyNames()
{
  global $wDB;
  return $wDB->selectCol('-- CACHE: 1h
  SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_creature_family`');
}

function getCreatureFamily($family, $as_ref=1)
{
  $l = getCreatureFamilyNames();
  $name = isset($l[$family]) ? $l[$family] : 'family_'.$family;
  if ($as_ref)
      return '<a href="?s=n&family='.$family.'">'.$name.'</a>';
  return $name;
}

// Creature type
function getCreatureTypeNames()
{
  global $wDB;
  return $wDB->selectCol('-- CACHE: 1h
  SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_creature_type`');
}

function getCreatureType($i, $as_ref=1)
{
  $t = getCreatureTypeNames();
  $name = isset($t[$i]) ? $t[$i] : 'Type_'.$i;
  if ($as_ref)
      return '<a href="?s=n&type='.$i.'">'.$name.'</a>';
  return $name;
}

function getCreatureTypeList($mask, $as_ref=1)
{
  $t = getCreatureTypeNames();
  if ($as_ref)
      return getListFromArray_1($t, $mask, "?s=n&type=%d");
  return getListFromArray_1($t, $mask);
}

function getCreatureCount($creature_id)
{
  global $dDB;
  return $dDB->selectCell("SELECT count(*) FROM `creature` WHERE `id` = ?d", $creature_id);
}

function getCreatureFlagName($flag, $as_ref=1)
{
  global $gCreatureFlags;
  if ($as_ref)
      return '<a href="?s=n&flag='.$flag.'">'.@$gCreatureFlags[$flag].'</a>';
  return @$gCreatureFlags[$flag];
}

function getCreatureFlagsList($mask, $as_ref=1)
{
  global $gCreatureFlags;
  if ($as_ref)
      return getListFromArray_0($gCreatureFlags, $mask, "?s=n&flag=%d");
  return getListFromArray_0($gCreatureFlags, $mask);
}
//********************************************************************************
function getGameobject($gameobject_id, $fields="*")
{
  global $dDB;
  if ($go = $dDB->selectRow("-- CACHE: 1h
  SELECT $fields FROM `gameobject_template` WHERE `entry` = ?d", $gameobject_id))
      localiseGameobject($go);
  return $go;
}
function getGameobjectName($gameobject_id, $as_ref=1)
{
 if ($gameobject=getGameobject($gameobject_id, "`entry`, `name`"))
 {
    if (empty($gameobject['name'])) $gameobject['name'] = "go_$gameobject_id";
    if ($as_ref)
        return "<a href=?object=".$gameobject['entry'].">".$gameobject['name']."</a>";
    return $gameobject['name'];
 }
 return "Unknown go - $gameobject_id";
}

function getGameobjectType($i, $as_ref=1)
{
  global $gameobjectType;
  $type = @$gameobjectType[$i];
  if ($type!="")
  {
      if ($as_ref)
          return "<a href=?s=o&type=".$i.">".$type."</a>";
      return $type;
  }
  return "Type_$i";
}

function getGameobjectCount($gameobject_id)
{
  global $dDB;
  return $dDB->selectCell("SELECT count(*) FROM `gameobject` WHERE `id` = ?d", $gameobject_id);
}

//********************************************************************************
function getFaction($faction_id, $fields="*")
{
  global $wDB;
  return $wDB->selectRow("-- CACHE: 1h
  SELECT $fields FROM `wowd_faction` WHERE `id` = ?d", $faction_id);
}
function getFactionName($faction_id, $as_ref=1)
{
  if ($faction = getFaction($faction_id, "`name`"))
    $name = $faction['name'];
  else
    $name = "Faction ($faction_id)";
  if ($as_ref)
    $name = '<a href="?faction='.$faction_id.'">'.$name.'</a>';
  return $name;
}

function getFactionTemplate($faction_id)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_faction_template` WHERE `id` = ?d', $faction_id);
}

function getFactionTemplateName($faction_id)
{
  if ($faction_id==0)
      return 0;
  if ($faction_template = getFactionTemplate($faction_id))
      return getFactionName($faction_template['faction']);
  return "Faction template - $faction_id";
}

function getBaseReputationForFaction($faction, $race, $class)
{
    if (empty($faction)) return 0;
    $racemask  = 1<<($race -1);
    $classmask = 1<<($class-1);
    for ($i=0;$i<4;$i++)
        if ($faction['BaseRepRaceMask_'.$i] & $racemask AND
            ($faction['BaseRepClassMask_'.$i] == 0 OR $faction['BaseRepClassMask_'.$i] & $classmask))
            return $faction['BaseRepValue_'.$i];
    return 0;
}
function getBaseReputationFlagForFaction($faction, $race, $class)
{
    if (empty($faction)) return 0;
    $racemask  = 1<<($race -1);
    $classmask = 1<<($class-1);
    for ($i=0;$i<4;$i++)
        if ($faction['BaseRepRaceMask_'.$i] & $racemask AND
            ($faction['BaseRepClassMask_'.$i] == 0 OR $faction['BaseRepClassMask_'.$i] & $classmask))
            return $faction['ReputationFlags_'.$i];
    return 0;
}
function getReputationRankName($rep)
{
  global $gReputationRank;
  $text = @$gReputationRank[$rep];
  if ($text == "")
      $text = "Err Rep Rank $rep";
  return $text;
}
function getReputationDataFromReputation($rep)
{
  global $gReputationRank;
  $gBaseRep = -42000;
  $gRepStep = array(36000, 3000, 3000, 3000, 6000, 12000, 21000, 1000);
  $current  = $gBaseRep;
  for ($i=0;$i<8;$current+=$gRepStep[$i],$i++)
     if ($current + $gRepStep[$i] > $rep)
         return array('rank'=>$i, 'rank_name'=>$gReputationRank[$i], 'rep'=>$rep - $current, 'max'=>$gRepStep[$i]);
  return array('rank'=>7, 'rank_name'=>$gReputationRank[7], 'rep'=>$gRepStep[7], 'max'=>$gRepStep[7]);
}
function getFactionType($id)
{
  global $gFactionType;
  return $gFactionType[$id];
}

function getArea($Zone_id, $fields="*")
{
  global $wDB;
  return $wDB->selectRow("-- CACHE: 1h
  SELECT $fields FROM `wowd_zones` WHERE `id` = ?d", $Zone_id);
}

function getAreaName($Zone_id, $as_ref=1)
{
  $zone = getArea($Zone_id, '`name`');
  if ($zone)
  {
    $name = $zone['name'];
    if ($as_ref)
      $name = '<a href="?zone='.$Zone_id.'">'.$name.'</a>';
  }
  else
    $name = "Unknown area - $Zone_id";
  return $name;
}

function getFullAreaName($Zone_id, $as_ref=1)
{
  $zone = getArea($Zone_id, '`name`, `zone_id`');
  if ($zone)
  {
    $name = $zone['name'];
    if ($as_ref)
      $name = '<a href="?zone='.$Zone_id.'">'.$name.'</a>';
    if ($zone['zone_id'])
      $name = getAreaName($zone['zone_id'], $as_ref).' - '.$name;
  }
  else
    $name = "Unknown area - $Zone_id";
  return $name;
}

function getMapName($id)
{
 global $wDB;
 $l = $wDB->selectCol('-- CACHE: 1h
 SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_map`');
 return isset($l[$id]) ? $l[$id] : 'map_'.$id;
}
/*
    FACTION_MASK_PLAYER   = 1,                              // any player
    FACTION_MASK_ALLIANCE = 2,                              // player or creature from alliance team
    FACTION_MASK_HORDE    = 4,                              // player or creature from horde team
    FACTION_MASK_MONSTER  = 8                               // aggressive creature from monster team
*/
function getLoyality($faction_id)
{
 $faction_template=getFactionTemplate($faction_id);
 if (!$faction_template)
  return "??";
 $loyality = '';
 if ($faction_template['friendlyMask'])
 {
  $loyality.= '<span class=friendly>';
  if ($faction_template['friendlyMask']&1) $loyality.='AH';
  else
  {
   if ($faction_template['friendlyMask']&2) $loyality.='A';
   if ($faction_template['friendlyMask']&4) $loyality.='H';
//  if ($faction_template[friendlyMask]&8) $loyality.='M';
  }
  $loyality.= '</span>';
 }
 if ($faction_template['hostileMask'])
 {
  $loyality.= '<span class=hostile>';
  if ($faction_template['hostileMask']&1) $loyality.='AH';
  else
  {
   if ($faction_template['hostileMask']&2) $loyality.='A';
   if ($faction_template['hostileMask']&4) $loyality.='H';
//   if ($faction_template['hostileMask']&8) $loyality.='M';
  }
  $loyality.= '</span>';
 }
 if (($faction_template['friendlyMask']&7)==0 && ($faction_template['hostileMask']&7) == 0)
 {
   $loyality.='<span class=neitral>AH</span>';
 }
 return $loyality;
}

//********************************************************************************
function getQuest($quest_id, $fields = "*")
{
  global $dDB, $config;
  $quest = $dDB->selectRow("-- CACHE: 1h
  SELECT $fields FROM `quest_template` WHERE `entry` = ?d", $quest_id);
  if ($quest)
      localiseQuest($quest);
  return $quest;
}

function getQuestName($quest_id, $ashref=1)
{
  if ($quest = getQuest($quest_id, "`entry`, `Title`"))
  {
    if (empty($quest['Title'])) $quest['Title'] = "quest_$quest_id";
    if ($ashref)
        return "<a href=?quest=".$quest['entry'].">".$quest['Title']."</a>";
    return $quest['Title'];
  }
  return "Unknown quest - $quest_id";
}

function getQuestSort($sort)
{
    global $wDB;
	$q = $wDB->selectCol('-- CACHE: 1h
	SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_quest_sort`');
	return isset($q[$sort]) ? $q[$sort] : 'Sort_'.$sort;
}

function getQuestType($type)
{
    global $wDB;
	$q = $wDB->selectCol('-- CACHE: 1h
	SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_quest_info`');
	return isset($q[$type]) ? $q[$type] : 'Info_'.$type;
}

function getNumPalayersCompletedQuest($entry)
{
 global $cDB;
 return $cDB->selectCell("SELECT count(*) FROM `character_queststatus` WHERE `quest` = '$entry' AND `status` = '1' AND `rewarded`='1'");
}

function getNumPalayersWithThisQuest($entry)
{
 global $cDB;
 return $cDB->selectCell("SELECT count(*) FROM `character_queststatus` WHERE quest = '$entry' AND (`status` = '0' OR `status` = '3')");
}

function getQuestXPValue($quest)
{
        if ($quest['QuestLevel'] >= 15) return intval($quest['RewMoneyMaxLevel'] / 6);
   else if ($quest['QuestLevel'] == 14) return intval($quest['RewMoneyMaxLevel'] / 4.8);
   else if ($quest['QuestLevel'] == 13) return intval($quest['RewMoneyMaxLevel'] / 3.666);
   else if ($quest['QuestLevel'] == 12) return intval($quest['RewMoneyMaxLevel'] / 2.4);
   else if ($quest['QuestLevel'] == 11) return intval($quest['RewMoneyMaxLevel'] / 1.2);
   else if ($quest['QuestLevel'] <= 10) return intval($quest['RewMoneyMaxLevel'] / 0.6);
   return 0;
}
function getRepRewRate($faction_id)
{
  global $dDB, $config;
  $faction = $dDB->selectCell("-- CACHE: 1h
  SELECT `quest_rate` FROM `reputation_reward_rate` WHERE `faction` = ?d", $faction_id);
  if (!$faction)
    $faction=1;
  return $faction;
}


//********************************************************************************
$Quality = array(
'0'=>'quality0',
'1'=>'quality1',
'2'=>'quality2',
'3'=>'quality3',
'4'=>'quality4',
'5'=>'quality5',
'6'=>'quality6',
'7'=>'quality7'
);

function getItem($item_id, $fields = "*")
{
  global $dDB, $config;
  $item = $dDB->selectRow("-- CACHE: 1h
  SELECT $fields FROM `item_template` WHERE `entry` = ?d", $item_id);
  if ($item)
     localiseItem($item);
  return $item;
}

function getItemName($item_id)
{
  $item = getItem($item_id, "`entry`, `name`");
  if ($item)
      return $item['name'];
  return "Unknown item - $item_id";
}

function getItemBonusText($i, $amount)
{
    global $iBonus;
    $text = @$iBonus[$i];
    if ($text == "") $text = "Err stat $i - %d";
    if ($i >=0 && $i < 8 && $amount > 0)
        return sprintf("+".$text, $amount);
    return sprintf($text, $amount);
}

function getInventoryType($i, $as_ref=1)
{
  global $gInventoryType;
  $name = @$gInventoryType[$i];
  if ($name=="") $name = "InvType_$i";
  if ($as_ref)
      return "<a href=\"?s=i&type=$i\">".$name."</a>";
  return $name;
}

function getInventoryTypeList($mask, $as_ref=1)
{
  global $gInventoryType;
  if ($as_ref)
      return getListFromArray_0($gInventoryType, $mask, "?s=i&type=%d");
  return getListFromArray_0($gInventoryType, $mask);
}

function getClassName($class, $as_ref=1)
{
   global $itemClassSubclass;
   if ($as_ref)
       return "<a href=\"?s=i&class=$class\">".$itemClassSubclass["$class"]."</a>";
   else
       return $itemClassSubclass["$class"];
}

function getSubclassName($class,$subclass, $as_ref=1)
{
  global $itemClassSubclass;
  if ($subclass>=0)
  {
      $names = explode(":",$itemClassSubclass["$class"."."."$subclass"]);
      if (@$names[1]) $name = $names[1];
      else            $name = $names[0];
      if ($as_ref)
         return "<a href=\"?s=i&class=$class.$subclass\">".$name."</a>";
      else
         return $name;
  }
  return getClassName($class, $as_ref);
}

function getShortSubclassName($class,$subclass, $as_ref=1)
{
  global $itemClassSubclass;
  if ($subclass>=0)
  {
      $names = explode(":",$itemClassSubclass["$class"."."."$subclass"]);
      $name = $names[0];
      if ($as_ref)
         return "<a href=\"?s=i&class=$class.$subclass\">".$name."</a>";
      else
         return $name;
  }
  return getClassName($class, $as_ref);
}

function getSubclassList($class, $mask, $as_ref=1)
{
  if ($mask == 0)
      return 0;
  $text = "";
  $i=0;
  while ($mask)
  {
   if ($mask & 1) {$text.=getSubclassName($class,$i,$as_ref);if ($mask!=1)  $text.=", ";}
   $mask>>=1;
   $i++;
  }
  return $text;
}

function getSpellIconName($icon_id)
{
  global $wDB;
  $name = $wDB->selectCell('-- CACHE: 1h
  SELECT `name` FROM `wowd_spellicon` WHERE `id` = ?d', $icon_id);
  if ($name) return strtolower($name.'.jpg');
  else       return 'wowunknownitem01.jpg';
}

$bwicon_mode = false;
function setBwIconMode()   {global $bwicon_mode; $bwicon_mode = true;}
function unsetBwIconMode() {global $bwicon_mode; $bwicon_mode = false;}

function getSpellIcon($icon_id)
{
  global $wDB, $bwicon_mode;
  if ($bwicon_mode){$dir = 'bwicons';$g_bwicon_mode = 0;}
  else              $dir = 'icons';
  return 'images/'.$dir.'/'.getSpellIconName($icon_id);
}


function getItemIconName($icon_id)
{
  global $wDB;
  $name = $wDB->selectCell('-- CACHE: 1h
  SELECT `name` FROM `wowd_itemicon` WHERE `id` = ?d', $icon_id);
  if ($name) return strtolower($name.'.jpg');
  else       return 'wowunknownitem01.jpg';
}

function getItemIcon($icon_id)
{
  global $wDB, $bwicon_mode;
  if ($bwicon_mode){$dir = 'bwicons';$g_bwicon_mode = 0;}
  else              $dir = 'icons';
  return 'images/'.$dir.'/'.getItemIconName($icon_id);
}

function getItemIconFromItemId($item_id)
{
  global $dDB, $bwicon_mode;
  if ($icon = $dDB->selectCell("SELECT `displayid` FROM `item_template` WHERE `entry` = ?d", $item_id))
      return getItemIcon($icon, $bwicon_mode);
  return 'images/icons/wowunknownitem01.jpg';
}

function getItemIconFromItemData($item_data)
{
 if ($item = getItem($item_data[ITEM_FIELD_ENTRY]))
    return  getItemIcon($item['displayid']);
 return 'images/icons/wowunknownitem01.jpg';
}

function getItemSet($item_set_id)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_itemset` WHERE `id` = ?d', $item_set_id);
}

function getItemData($guid)
{
 global $cDB;
 return explode(' ', $cDB->selectCell("SELECT `data` FROM `item_instance` WHERE `guid` = ?d", $guid));
}

function getRecipeItem($recipe)
{
  global $wDB;
  if ($recipe['spellid_1'] == 483)
  {
    // Получаем спелл которому обучает
    $spell = getSpell($recipe['spellid_2']);
    if ($spell = getSpell($recipe['spellid_2']))
      return getItem($spell['EffectItemType_1']);
  }
  return 0;
}

function getCount($count)
{
  if ($count>1) return "($count)";
  return "";
}

function getRecipeReqString($spell)
{
   $text = "";
   if ($spell['Reagent_1']) $text.=getItemName($spell['Reagent_1']).getCount($spell['ReagentCount_1']);
   if ($spell['Reagent_2']) $text.=", ".getItemName($spell['Reagent_2']).getCount($spell['ReagentCount_2']);
   if ($spell['Reagent_3']) $text.=", ".getItemName($spell['Reagent_3']).getCount($spell['ReagentCount_3']);
   if ($spell['Reagent_4']) $text.=", ".getItemName($spell['Reagent_4']).getCount($spell['ReagentCount_4']);
   if ($spell['Reagent_5']) $text.=", ".getItemName($spell['Reagent_5']).getCount($spell['ReagentCount_5']);
   if ($spell['Reagent_6']) $text.=", ".getItemName($spell['Reagent_6']).getCount($spell['ReagentCount_6']);
   if ($spell['Reagent_7']) $text.=", ".getItemName($spell['Reagent_7']).getCount($spell['ReagentCount_7']);
   if ($spell['Reagent_8']) $text.=", ".getItemName($spell['Reagent_8']).getCount($spell['ReagentCount_8']);
   return $text;
}

function text_show_item($entry, $iconId = 0, $style = 0)
{
  global $dDB, $config;
  if (!$iconId)
      $iconId = $dDB->selectCell('-- CACHE: 1h
	  SELECT `displayid` FROM `item_template` WHERE `entry` = ?d', $entry);
  $icon = getItemIcon($iconId);
  $text = '<a href="?item='.$entry.'"><img'.($style?' class='.$style:'').' src="'.$icon.'"></a>';
  return $text;
}

function show_item($entry, $iconId = 0, $style = 'item')
{
  echo text_show_item($entry, $iconId, $style);
}

function getborderText($text, $posx = 'left', $dx=0, $posy = 'top', $dy=0)
{
    return
    "<div style=\"position: absolute; $posx: ".($dx-1)."px; $posy: ".($dy-1)."px; color: black;\">$text</div>
     <div style=\"position: absolute; $posx: ".($dx-1)."px; $posy: ".($dy+1)."px; color: black;\">$text</div>
     <div style=\"position: absolute; $posx: ".($dx+1)."px; $posy: ".($dy-1)."px; color: black;\">$text</div>
     <div style=\"position: absolute; $posx: ".($dx+1)."px; $posy: ".($dy+1)."px; color: black;\">$text</div>
     <div style=\"position: absolute; $posx: ".($dx  )."px; $posy: ".($dy-1)."px; color: black;\">$text</div>
     <div style=\"position: absolute; $posx: ".($dx  )."px; $posy: ".($dy+1)."px; color: black;\">$text</div>
     <div style=\"position: absolute; $posx: ".($dx-1)."px; $posy: ".($dy  )."px; color: black;\">$text</div>
     <div style=\"position: absolute; $posx: ".($dx+1)."px; $posy: ".($dy  )."px; color: black;\">$text</div>
     <div style=\"position: absolute; $posx: ".($dx  )."px; $posy: ".($dy  )."px; color: white;\">$text</div>";
}
function show_item_by_data($item_data, $style='item', $posx=0, $posy=0)
{
	$guid = $item_data[ITEM_FIELD_GUID];

	if (@$item_data[ITEM_FIELD_TYPE] == TYPE_ITEM)
		$count = $item_data[ITEM_FIELD_STACK_COUNT];
	else if (@$item_data[ITEM_FIELD_TYPE] == TYPE_CONTAINER)
		$count = $item_data[CONTAINER_FIELD_NUM_SLOTS];
	else
		return;
	$position="";
	if ($posx OR $posy)
		$position.= 'style="position: absolute; left: '.$posx.'px; top: '.$posy.'px; border: 0px;"';
	$icon = getItemIconFromItemData($item_data);
	if ($count == 1)
	{
		echo '<a style="float: left;" href="?item=g'.$guid.'">';
		echo "<IMG class=$style src='$icon' $position></a>";
	}
	else
	{
		if (empty($position))
			$position = "style=\"position: relative; left: 0px;top: 0px; border: 0px;float: left;\"";
		echo "\n<div class=$style $position>";
		echo '<a href="?item=g'.$guid.'"><IMG class="'.$style.'" src="'.$icon.'"></a>';
		echo getborderText($count, 'right', 3, 'bottom', 1);
		echo "</div>";
	}
}

function show_item_by_guid($guid, $style='item', $posx=0, $posy=0)
{
	if ($guid==0)
		return;
	if ($item_data = getItemData($guid))
		show_item_by_data($item_data, $style, $posx, $posy);
}

function show_item_from_char($id, $guid, $style='item', $posx=0, $posy=0)
{
	global $cDB;
	if ($id==0)
		return;
	$item_data = $cDB->selectCell("SELECT `guid` FROM `item_instance` WHERE `owner_guid`=?d AND (SUBSTRING_INDEX( SUBSTRING_INDEX(`data` , ' ' , 9) , ' ' , -1 )+0)=?d AND (SUBSTRING_INDEX( SUBSTRING_INDEX(`data` , ' ' , 4) , ' ' , -1 )+0)=$id", $guid, $guid, $id);
	if ($item_data = getItemData($item_data))
		show_item_by_data($item_data, $style, $posx, $posy);
}

//********************************************************************************
function getGuild($id)
{
  global $cDB;
  return $cDB->selectRow('-- CACHE: 1h
  SELECT * FROM `guild` WHERE `guildid` = ?d', $id);
}

function getGuildName($id)
{
  global $cDB;
  $name = $cDB->selectCell('-- CACHE: 1h
  SELECT `name` FROM `guild` WHERE `guildid` = ?d', $id);
  return $name ? $name : 'Unknown';
}

function getGuildRankList($id)
{
  global $cDB;
  $rows = $cDB->select('-- CACHE: 1h
  SELECT * FROM `guild_rank` WHERE `guildid` = ?d ORDER BY `rid`', $id);
  $rankList=array();
  if ($rows)
  foreach ($rows as $rank)
      $rankList[$rank['rid']-1] = $rank;
  return $rankList;
}
//********************************************************************************
function getCharacter($character_id, $fields = "*")
{
  global $cDB;
  return $cDB->selectRow("-- CACHE: 1h
  SELECT $fields FROM `characters` WHERE `guid` = ?d", $character_id);
}

function getCharacterStats($character_id, $fields = "*")
{
  global $cDB;
  return $cDB->selectRow("-- CACHE: 1h
  SELECT $fields FROM `character_stats` WHERE `guid` = ?d", $character_id);
}

function getCharacterName($character_id)
{
  global $cDB;
  $c = getCharacter($character_id, $fields = '`name`');
  return $c ? $c['name'] : 'Unknown';
}

function getGender($gender)
{
  global $gGenderType;
  return $gGenderType[$gender];
}

function getClassNames()
{
  global $wDB;
  return $wDB->selectCol('-- CACHE: 1h
  SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_chr_classes`');
}

function getClass($class)
{
  $l = getClassNames();
  return isset($l[$class]) ? $l[$class] : 'class_'.$class;
}

function getAllowableClass($mask)
{
  $mask&=0x5FF;
  // Return zero if for all class (or for none
  if ($mask == 0x5FF OR $mask == 0)
      return 0;
  return getListFromArray_1(getClassNames(), $mask);
}

function getRaceNames()
{
  global $wDB;
  return $wDB->selectCol('-- CACHE: 1h
  SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_chr_races`');
}

function getRace($race)
{
  $l = getRaceNames();
  return isset($l[$race]) ? $l[$race] : 'race_'.$race;
}

function getAllowableRace($mask)
{
  $mask&=0x7FF;
  // Return zero if for all class (or for none
  if ($mask == 0x7FF OR $mask == 0)
      return 0;
  return getListFromArray_1(getRaceNames(), $mask);
}

function getRating($level)
{
  global $wDB;
  return $wDB->selectRow('-- CACHE: 1h
  SELECT * FROM `wowd_rating` WHERE `level` = ?d', $level);
}

//********************************************************************************
function getPlayerFaction($race)
{
 global $wDB;
 $l = $wDB->selectCol('-- CACHE: 1h
 SELECT `id` AS ARRAY_KEY, `team` FROM `wowd_chr_races`');
 return isset($l[$race]) ? $l[$race] : 2;
}
function getFactionImage($race)
{
 $faction = getPlayerFaction($race);
 if ($faction == 0)
  return "images/player_info/factions_img/alliance.gif";
 if ($faction == 1)
  return "images/player_info/factions_img/horde.gif";
 return 0;
}

function getRaceImage($race, $genderid)
{
 return "images/player_info/race_img/".$race."_".$genderid.".gif";
}

function getClassImage($class)
{
 return "images/player_info/class_img/".$class.".gif";
}

function getFamilyImage($family)
{
 global $wDB;
 $l = $wDB->selectCol('-- CACHE: 1h
 SELECT `id` AS ARRAY_KEY, `icon` FROM `wowd_creature_family`');
 if (isset($l[$family]))
    return "images/icons/".$l[$family].".jpg";
 return "images/icons/wowunknownitem01.jpg";
}
function getStatTypeName($i)
{
 global $gStatType;
 return isset($gStatType[$i]) ? $gStatType[$i] : "Stat ($i)";
}

function getResistance($i)
{
 global $gResistance;
 return isset($gResistance[$i]) ? $gResistance[$i] : "Resistance ($i)";
}

function getResistanceText($i, $amount)
{
    global $gResistanceType;
    $text = @$gResistanceType[$i];
    if ($text == "") $text = "Err resist $i - %d";
    if ($i >=0 && $i < 7 && $amount > 0)
        return sprintf("+".$text, $amount);
    return sprintf($text, $amount);
}

function getSkillRank($i)
{
  global $gSkillRank;
  return @$gSkillRank[$i];
}
function getTalentName($id)
{
 global $wDB;
 $l = $wDB->selectCol('-- CACHE: 1h
 SELECT `id` AS ARRAY_KEY, `name` FROM `wowd_talent_tab`');
 return isset($l[$id]) ? $l[$id] : 'talent_'.$id;
}
?>
