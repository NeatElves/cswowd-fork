<?php
//=============================================================================
// Script allow do search in database by name, output result in 2 modes
// ls - Live Search -> for web script (if user input data on web page)
// os - Open Search -> for browser Open Search toolbar
// Search in item, itemset, quest, NPC, GO, spell, faction tables
//=============================================================================

include_once("include/functions.php");

function highliteText($text, $sub)
{
   return preg_replace('/'.$sub.'/i', '<b>$0</b>', $text);
}

$type = isset($_REQUEST['ls']) ? $_REQUEST['ls'] : @$_REQUEST['os'];
$name = @$_REQUEST['name'];

// Localisation
if ($config['locales_lang']) $localised = preg_match($config['locales_charset'], $name);
else                         $localised = false;
$locale = $config['locales_lang'];

// Result limit from config
$limit = $config['ls_limit'];

// Fill this array
$result = array();

// Item search
if ($type == 'i' OR $type == 'all')
{
 $filter  = '`name` like ?';
 $tables  = '`item_template`';
 $filelds = '`item_template`.`entry`, `Quality`, `displayid`, `name`';
 if ($localised)
 {
   $tables = '`item_template` LEFT JOIN `locales_item` ON `item_template`.`entry` = `locales_item`.`entry`';
   $filter = str_replace('`name`', '`name_loc'.$locale.'`', $filter);
   $filelds= str_replace('`name`', '`locales_item`.`name_loc'.$locale.'` AS `name`', $filelds);
 }
 if ($items = $dDB->select("SELECT $filelds FROM $tables WHERE $filter LIMIT 0, ?d", '%'.$name.'%', $limit))
 foreach ($items as $item)
    $result['i'][]=array('ico'=>getItemIcon($item['displayid'], 0), 'class'=>$Quality[$item['Quality']], 'link'=>'?item='.$item['entry'], 'txt'=>$item['name'], 'type'=>$ls_type_name['i']);
}

// Item Set search
if ($type == 'set' OR $type == 'all')
{
 if ($set = $wDB->select('SELECT `id`, `name` FROM `wowd_itemset` WHERE `name` LIKE ? LIMIT 0, ?d', '%'.$name.'%', $limit))
 foreach ($set as $s)
    $result['set'][]=array('txt'=>$s['name'], 'link'=>'?itemset='.$s['id'], 'type'=>$ls_type_name['set']);
}

// Quest search
if ($type == 'q' OR $type == 'all')
{
 $filter = '`Title` like ?';
 $tables = '`quest_template`';
 $filelds = '`quest_template`.`entry`, `Title`';
 if ($localised)
 {
   $tables = '`quest_template` LEFT JOIN `locales_quest` ON `quest_template`.`entry` = `locales_quest`.`entry`';
   $filter = str_replace('`Title`', '`Title_loc'.$locale.'`', $filter);
   $filelds= str_replace('`Title`', '`locales_quest`.`Title_loc'.$locale.'` AS `Title`', $filelds);
 }
 if ($quests = $dDB->select("SELECT $filelds FROM $tables WHERE $filter LIMIT 0, ?d", '%'.$name.'%', $limit))
 foreach($quests as $quest)
    $result['q'][]=array('txt'=>$quest['Title'], 'link'=>'?quest='.$quest['entry'], 'type'=>$ls_type_name['q']);
}

// NPC search
if ($type == 'n' OR $type == 'all')
{
 $filter  = '`name` like ?';
 $tables  = '`creature_template`';
 $filelds = '`creature_template`.`entry`, `name`';
 if ($localised)
 {
   $tables = '`creature_template` LEFT JOIN `locales_creature` ON `creature_template`.`entry` = `locales_creature`.`entry`';
   $filter = str_replace('`name`', '`name_loc'.$locale.'`', $filter);
   $filelds= str_replace('`name`', '`locales_creature`.`name_loc'.$locale.'` AS `name`', $filelds);
 }
 if ($npcs= $dDB->select("SELECT $filelds FROM $tables WHERE $filter LIMIT 0, ?d", '%'.$name.'%', $limit))
 foreach ($npcs as $npc)
    $result['n'][]=array('txt'=>$npc['name'], 'link'=>'?npc='.$npc['entry'], 'type'=>$ls_type_name['n']);
}

// Gameobject search
if ($type == 'g' OR $type == 'all')
{
 $filter  = '`name` like ?';
 $tables  = '`gameobject_template`';
 $filelds = '`gameobject_template`.`entry`, `name`';
 if ($localised)
 {
   $tables = '`gameobject_template` LEFT JOIN `locales_gameobject` ON `gameobject_template`.`entry` = `locales_gameobject`.`entry`';
   $filter = str_replace('`name`', '`name_loc'.$locale.'`', $filter);
   $filelds= str_replace('`name`', '`locales_gameobject`.`name_loc'.$locale.'` AS `name`', $filelds);
 }
 if ($go = $dDB->select("SELECT $filelds FROM $tables WHERE $filter LIMIT 0, ?d", '%'.$name.'%', $limit))
 foreach($go as $g)
    $result['g'][]=array('txt'=>$g['name'], 'link'=>'?object='.$g['entry'], 'type'=>$ls_type_name['g']);
}

// Spell search
if ($type == 's' OR $type == 'all')
{
 if ($spells = $wDB->select('SELECT `id`, `SpellName`, `Rank1`, `SpellIconID` FROM `wowd_spell` WHERE `SpellName` like ? LIMIT 0, ?d', '%'.$name.'%', $limit))
 foreach ($spells as $spell)
 {
    $n = $spell['SpellName'];
    if ($spell['Rank1'])
      $n.=' ('.$spell['Rank1'].')';
    $result['s'][]=array('ico'=>getSpellIcon($spell['SpellIconID'], 0), 'txt'=>$n, 'link'=>'?spell='.$spell['id'], 'type'=>$ls_type_name['s']);
 }
}

// Faction search
if ($type == 'f' OR $type == 'all')
{
 $factions = $wDB->select('SELECT `id`, `name` FROM `wowd_faction` WHERE `name` like ? LIMIT 0, ?d', '%'.$name.'%', $limit);
 if ($factions)
 foreach ($factions as $f)
    $result['f'][]=array('txt'=>$f['name'], 'link'=>'?faction='.$f['id'], 'type'=>$ls_type_name['f']);
}

// Area search
if ($type == 'a' OR $type == 'all')
{
 $area = $wDB->select('SELECT `id`, `name` FROM `wowd_zones` WHERE `name` like ? LIMIT 0, ?d', '%'.$name.'%', $limit);
 if ($area)
 foreach ($area as $a)
    $result['a'][]=array('txt'=>$a['name'], 'link'=>'?zone='.$a['id'], 'type'=>$ls_type_name['a']);
}

// Results count
$count = 0;
foreach($result as $key=>$r)
  $count+=count($result[$key]);

// Limit results count to need amount by remove one result in max group step by step
while ($count > $limit)
{
   $max_key = 0;
   $cmax = 0;
   foreach($result as $key=>$r)
   {
      $c = count($result[$key]);
      if ($cmax < $c)
      {
         $cmax = $c;
         $max_key = $key;
      }
   }
   unset($result[$max_key][$cmax-1]);
   $count--;
}

// Output result
if ($count)
{
 if (isset($_REQUEST['ls']))      // Live Search mode
 {
  echo '<table class=livesearch><tbody>';
  foreach($result as $key=>$r)
  {
   foreach($result[$key] as $res)
   {
       echo '<tr>';
       echo '<td>'.(isset($res['ico'])? '<img src='.$res['ico'].'>' : '').'</td>';
       echo '<td class=lsname><a'.(isset($res['class'])?' class='.$res['class']:'').' href="'.$res['link'].'">'.highliteText($res['txt'], $name).'</a></td>';
       echo '<td class=lstype>'.$res['type'].'</td>';
       echo '</tr>';
   }
  }
  echo '</tbody></table>';
 }
 else if (isset($_REQUEST['os'])) // Open Search mode
 {
  echo '["'.$name.'", [';
  foreach($result as $key=>$r)
    foreach($result[$key] as $res)
      echo '"'.$res['txt'].' ('.$res['type'].')",';
  echo ']]';
 }
}
?>
