<?php
//==============================================================================
// Скрипт предназначен для вывода репутации игрока
//==============================================================================

// Сортируем по возрастанию
function rcmp($a, $b)
{
  if (isset($a['childs']))
    return isset($b['childs']) ? strcmp($a['name'], $b['name']) : 1;
  return !isset($b['childs']) ? strcmp($a['name'], $b['name']) : -1;
}

define('FACTION_FLAG_VISIBLE', 0x01);         // makes visible in client (set or can be set at interaction with target of this faction)
define('FACTION_FLAG_AT_WAR', 0x02);          // enable AtWar-button in client. player controlled (except opposition team always war state), Flag only set on initial creation
define('FACTION_FLAG_HIDDEN', 0x04);          // hidden faction from reputation pane in client (player can gain reputation, but this update not sent to client)
define('FACTION_FLAG_INVISIBLE_FORCED', 0x08);// always overwrite FACTION_FLAG_VISIBLE and hide faction in rep.list, used for hide opposite team factions
define('FACTION_FLAG_PEACE_FORCED', 0x10);    // always overwrite FACTION_FLAG_AT_WAR, used for prevent war with own team factions
define('FACTION_FLAG_INACTIVE', 0x20);        // player controlled, state
define('FACTION_FLAG_RIVAL', 0x40);           // flag for the two competing outland factions

function dumpRep($depth, $tree, &$rep)
{
    $pre='';
    if ($depth!=0)
    {
      for ($i=0;$i<$depth;$i++)
        $pre.='&nbsp;&nbsp;&nbsp;';
    }
    uasort($tree, 'rcmp');
    foreach($tree as $id=>$t)
    {
      if ($t['details'])
      {
        $tip = '<table class=skilltip><tr class=top><td>'.$t['name'].'</td></tr><tr><td>'.$t['details'].'</td></tr></table>';
        echo '<tr '.addTooltip($tip, 'STICKY, false, BORDER, false').'>';
      }
      else
        echo '<tr>';
      if (isset($t['childs']))
      {
        echo '<td class=teamreputation colspan=3><a id="no_tip" href="?faction='.$t['id'].'">'.$pre.$t['name'].'</a></td></tr>';
        dumpRep($depth+1, $t['childs'], $rep);
      }
      else
      {
        $rep_data = getReputationDataFromReputation($rep[$id]['standing']);
        echo '<td class=reputation><a id="no_tip" href="?faction='.$id.'">'.$pre.$t['name'].'</a></td>';
        echo '<td class=rep_value>'.$rep_data['rank_name'].'</td>';
        echo '<td class=rep_bar><div class=rep_bar><b class=rep'.$rep_data['rank'].' style="width: '.intval($rep_data['rep']/$rep_data['max']*100).'%;"></b><span>'.$rep_data['rep'].'/'.$rep_data['max'].'</span></div></td>';
        echo '</tr>';
      }
    }
}

function showPlayerReputation($guid, $class, $race)
{
 global $lang, $game_text, $cDB;
 // Load player reputation
 $repdata = array();
 $rep_tree= array();
 $reputation = $cDB->select(
 "SELECT
  `faction` AS ARRAY_KEY,
  `standing`,
  `flags`
  FROM `character_reputation` WHERE `guid` = ?d", $guid);
 if(!$reputation)
 {
  echo "Error";
  return;
 }
 // Load reputation tree
 foreach($reputation as $id=>$r)
 {
  $rep=&$reputation[$id];
  // Skip hidden
  if (!($rep['flags']&FACTION_FLAG_VISIBLE) OR $rep['flags']&(FACTION_FLAG_HIDDEN|FACTION_FLAG_INVISIBLE_FORCED))
      continue;
  // Upload faction if not set
  if (!isset($rep_tree[$id]))
    $rep_tree[$id] = getFaction($id);
  // Correct reputation amount
  $rep['standing']+= getBaseReputationForFaction($rep_tree[$id], $race, $class);
  // Insert faction in tree if exist parent
  while($tid = $rep_tree[$id]['team'])
  {
    // Load parent faction data if not loaded
    if (!isset($rep_tree[$tid]))
      $rep_tree[$tid] = getFaction($tid);
    // Insert child if not inserted
    if (!isset($rep_tree[$tid]['childs'][$id]))
      $rep_tree[$tid]['childs'][$id] =& $rep_tree[$id];
    $id = $tid;
  }
 }
 // Remove inserted as childs nodes
 foreach($rep_tree as $id=>$r)
   if ($r['team'])
     unset($rep_tree[$id]);

 if (empty($rep_tree))
 {
  echo "Error";
  return;
 }
 echo '<table class=report cellSpacing=0 cellPadding=0><tbody>';
 echo '<tr><td class=head colspan=3>'.$lang['player_reputation'].'</td></tr>';
 dumpRep(0, $rep_tree, $reputation);
 echo '</tbody></table>';
}
?>