<?php

define('ACHIEVEMENT_FLAG_COUNTER',           0x0001);        // Just count statistic (nether stop and complete)
define('ACHIEVEMENT_FLAG_UNK2',              0x0002);        // no used possibly min criteria value
define('ACHIEVEMENT_FLAG_MAX_VALUE',         0x0004);        // Show max criteria value (only value)
define('ACHIEVEMENT_FLAG_SUMM',              0x0008);        // Show summ criteria value from all reqirements
define('ACHIEVEMENT_FLAG_MAX_USED',          0x0010);        // Show max criteria
define('ACHIEVEMENT_FLAG_REQ_COUNT',         0x0020);        // Show not zero req count
define('ACHIEVEMENT_FLAG_AVERANGE',          0x0040);        // Show as averange value (value / time_in_days) depend from other flag
define('ACHIEVEMENT_FLAG_BAR',               0x0080);        // Show as progress bar (value / max vale) depend from other flag
define('ACHIEVEMENT_FLAG_REALM_FIRST_REACH', 0x0100);        //
define('ACHIEVEMENT_FLAG_REALM_FIRST_KILL',  0x0200);        //

define('CUSTOM_ACHIEVEMENT_SHOW', ACHIEVEMENT_FLAG_SUMM|ACHIEVEMENT_FLAG_MAX_USED|ACHIEVEMENT_FLAG_REQ_COUNT);

define('ACHIEVEMENT_CRITERIA_FLAG_SHOW_PROGRESS_BAR', 0x00000001);   // Show progress as bar
define('ACHIEVEMENT_CRITERIA_FLAG_HIDE_CRITERIA',     0x00000002);   // Not show criteria in client
define('ACHIEVEMENT_CRITERIA_FLAG_UNK3',              0x00000004);   // BG related??
define('ACHIEVEMENT_CRITERIA_FLAG_UNK4',              0x00000008);   //
define('ACHIEVEMENT_CRITERIA_FLAG_UNK5',              0x00000010);   // not used
define('ACHIEVEMENT_CRITERIA_FLAG_MONEY_COUNTER',     0x00000020);   // Displays counter as money

$player_total_time_in_days = 0;

function getFormattedDate($timestamp)
{
    return date("Y-m-d H:i:s", $timestamp);
}

function getFormattedDateSmall($timestamp)
{
    return date("Y-m-d", $timestamp);
}

function cmp($a, $b)
{
    if (($a['date']) || $b['date'])
      return $a['date'] > $b['date'] ? -1 : 1;
    return ($a['OrderInCategory'] < $b['OrderInCategory']) ? -1 : 1;
}

function uploadAchievementData($cat, $faction, $guid, &$achievements)
{
  global $wDB, $cDB;

  // Upload achievement by category
  $achievements = $wDB->select(
  "SELECT
  `id` AS ARRAY_KEY,
  `factionFlag`,
  `mapID`,
  `parentAchievement`,
  `name`,
  `description`,
  `categoryId`,
  `points`,
  `OrderInCategory`,
  `flags`,
  `iconId`,
  `titleReward`,
  `count`,
  `refAchievement`
  FROM `wowd_achievement`
  WHERE
    categoryId = ?d AND (factionFlag = ?d OR factionFlag = '-1')
  ORDER BY OrderInCategory", $cat, $faction);
  // Prepare achievement list for load its criteria
  $key = array_keys($achievements);
  foreach ($achievements as $id=>$a)
    if ($a['refAchievement'] && !@$achievements[$a['refAchievement']])
      $key[] = $a['refAchievement'];

  // Upload criteria list
  $criteria = $wDB->select(
  "SELECT
   `referredAchievement` AS ARRAY_KEY_1,
   NULL AS ARRAY_KEY_2,
   `id`,
   `requiredType`,
   `data`,
   `value`,
   `additional_type_1`,
   `additional_value_1`,
   `additional_type_2`,
   `additional_value_2`,
   `name`,
   `completionFlag`,
   `groupFlag`,
   `unk1`,
   `timeLimit`
  FROM `wowd_achievement_criteria`
  WHERE
   `referredAchievement` IN (?a)
  ORDER BY `order`", $key);
  // Upload player progress
  if ($guid)
  {
    $completed = $cDB->selectCol("SELECT `achievement` AS ARRAY_KEY, `date` FROM `character_achievement` WHERE `guid` = ?d", $guid);
    $progress  = $cDB->select("SELECT `criteria` AS ARRAY_KEY, `counter`, `date`  FROM `character_achievement_progress` WHERE `guid` = ?d", $guid);
  }
  foreach ($achievements as $id=>$ach)
  {
    $a =& $achievements[$id];
    $req_id = $a['refAchievement'] ? $a['refAchievement'] : $id;
    $a['requirement'] = @$criteria[$req_id]; // Use loaded criteria
    $a['date'] =@$completed[$id];            // Set completed time
    if ($a['requirement'])
    foreach ($a['requirement'] as $i=>$req)  // Get achievement progress
    {
      $r=&$a['requirement'][$i];
      $r['counter'] = @$progress[$r['id']]['counter'];
      $r['date']    = @$progress[$r['id']]['date'];
    }
  }
  if(!$guid)
    return;
  // Merge completed achievements tree in last one
  foreach ($achievements as $id=>$ach)
  {
    $a =& $achievements[$id];
    if ($parent = $a['parentAchievement'])
    {
      $p =& $achievements[$parent];
      if ($a['date'])
      {
        // Disable parent output
        $p['parentAchievement'] = 1;
        $a['points']+=$p['points'];
        // add parent req to child
        $a['requirement'] = array_merge($p['requirement'], $a['requirement']);
        foreach ($a['requirement'] as $i=>$r)
          $a['requirement'][$i]['completionFlag']=0;
      }
      if ($p['date'])
        $a['parentAchievement'] = 0;
    }
  }
  // Sort it
  usort($achievements, 'cmp');
}

function getAchievementValue($a, &$value, &$maxvalue)
{
  $value = 0; $maxvalue = 0;
  if (!isset($a['requirement']))
    return 0;
  if ($a['flags']&ACHIEVEMENT_FLAG_SUMM)
  {
    // Need calculate summ completed and use (averange? all max equal) max value
    foreach($a['requirement'] as $r){$value+=$r['counter'];$maxvalue=$r['value'];}
  }
  else if ($a['flags']&ACHIEVEMENT_FLAG_MAX_USED)
  {
    $max = 0; $text = '--';
    // Need select max value (and also show name)
    foreach($a['requirement'] as $r)
      if ($max<=$r['counter'])
      {
        if ($max = $r['counter'])
          $text = $r['name'].' ('.$r['counter'].')';
        $value = $r['counter'];
        $maxvalue=$r['value'];
      }
    return $text;
  }
  else if ($a['flags']&ACHIEVEMENT_FLAG_REQ_COUNT)
  {
    foreach($a['requirement'] as $r) {$maxvalue++;if ($r['counter']) $value++;}
    // Use count as max value
    if ($a['count'])
      $maxvalue = $a['count'];
  }
  else if ($a['flags']&ACHIEVEMENT_FLAG_COUNTER)  // Only counters
  {
    // Need calculate summ completed
    foreach($a['requirement'] as $r)
      $value+=$r['counter'];
  }
  if ($a['requirement'][0]['completionFlag']&ACHIEVEMENT_CRITERIA_FLAG_MONEY_COUNTER)
    return money($value, 8);
  return $value;
}

function getAchievementFaction($guid, $faction)
{
  if (!$guid)
    return $faction;
  $player = getCharacter($guid, 'race');
  if ($player)
    return getPlayerFaction($player['race']);
  return $faction;
}

//=======================================================
//=======================================================
function renderProgress($value, $total, $money=0)
{
  $value=intval($value);
  $pct = ($value/$total*100);
  if ($pct>100) $pct=100;
  if ($money)
    $txt = $pct>=100?money($total, 6):money($value, 6);
  else
    $txt = $pct>=100?$total:$value.' / '.$total;
  return '<div class=ach_bar><div class=bar style="width: '.$pct.'%;"></div><div class=pr>'.$txt.'</div></div>';
}

function renderAchievement($id, &$a, $guid)
{
  // Skip show if not completed parent present or no_points not completed
  if ($a['parentAchievement'] || (!$a['date'] && !$a['points'] && $guid))
    return;
  echo '<div class="ach_show'.($a['date'] ? '':' locked').'" onclick="showAchReq(this);">';
  // Render icon
  echo '<img class=ach_icon  src='.getSpellIcon($a['iconId']).'>';
  echo '<div class=ach_frame></div>';
  // Render points
  if ($a['points'])
    echo '<div class=ach_point>'.$a['points'].'</div>';
  echo '<div class=ach_title>'.$a['name'].'</div>';
  echo '<div class=ach_desc>'.$a['description'].'</div>';
//  echo '<div class=ach_desc>Flags - 0x'.dechex($a['flags']).' - '.$a['count'].'</div>';
  // Render requirements
  echo '<div class=ach_req id='.$id.'>';
  if ($a['flags']&CUSTOM_ACHIEVEMENT_SHOW)
  {
    getAchievementValue(&$a, &$value, &$maxvalue);
    if ($a['flags']&ACHIEVEMENT_FLAG_BAR)
      echo '<div class="sub bar">'.renderProgress($value, $maxvalue).'</div>';
    else if ($a['flags']&ACHIEVEMENT_FLAG_MAX_USED)
      echo '<div class="sub bar">'.renderProgress($value, $maxvalue).'</div>';
    else
      echo '<div class="sub '.($value>=$maxvalue ? 'compl' : '').'">'.$value.'</div>';
  }
  foreach($a['requirement'] as $r)
  {
    if ($r['completionFlag']&ACHIEVEMENT_CRITERIA_FLAG_HIDE_CRITERIA)
      continue;
    if ($r['completionFlag']&ACHIEVEMENT_CRITERIA_FLAG_SHOW_PROGRESS_BAR)
      echo '<div class=sub_bar>'.renderProgress(@$r['counter'], $r['value'], $r['completionFlag']&ACHIEVEMENT_CRITERIA_FLAG_MONEY_COUNTER).'</div>';
    else
    {
      $text=$r['name']? $r['name'] : $a['name'];
      $completed = $r['counter'] ? ($r['counter'] >=$r['value'] ? 'compl' : '') : '';
//      $text.="-> $r[id] - f=$r[completionFlag], c=$r[counter], d=$r[data], v=$r[value]";
      echo '<div class="sub '.$completed.'">'.$text.'</div>';
    }
  }
  echo '<br clear="all"/></div>'."\n";
  // render date
  if ($a['date'])
    echo '<div class=ach_date>'.getFormattedDate($a['date']).'</div>';
  if ($a['titleReward'])
    echo '<div class=ach_reward>'.$a['titleReward'].'</div>';
  echo '</div>';
}

function getComplCount($progress, $cat, $faction, &$count)
{
  global $wDB;
  $ach = $wDB->select("SELECT `id`, `points` FROM `wowd_achievement` WHERE `categoryId` = ?d AND (factionFlag = ?d OR factionFlag = '-1')", $cat, $faction);
  if ($ach)
  foreach ($ach as $a)
  {
    $count[0]++; $count[2]+=$a['points'];
    if (@$progress[$a['id']]) {$count[1]++; $count[3]+=$a['points'];}
  }
}

// Player Achievement
function renderPlayerAchievementStats($category, $faction, $guid)
{
  if (!$guid)
    return;
  global $cDB, $wDB, $config, $lang;
  echo '<div class=ach_s_list>';
  $completed = $cDB->selectCol(
  "SELECT
   `achievement` AS ARRAY_KEY,
   `date`
   FROM `character_achievement` WHERE `guid` = ?d ORDER BY `date` DESC", $guid);
  $total = array(0,0,0,0);
  // Get base achievement category list (exclude statistic category = 1)
  $baseCat = $wDB->select("SELECT `id`, `name` FROM `wowd_achievement_category` WHERE `parent` = '-1' AND `id` NOT IN (1) ORDER BY `sortOrder`");
  foreach ($baseCat as $id=>$cat)
  {
    $count = array(0,0,0,0);
    getComplCount($completed, $cat['id'], $faction, &$count);
    $subCat = $wDB->select("SELECT `id`, `name` FROM `wowd_achievement_category` WHERE `parent` = ?d", $cat['id']);
    foreach ($subCat as $sub)
      getComplCount($completed, $sub['id'], $faction, &$count);
    $baseCat[$id]['count'] = $count;
    if ($count[2])
    foreach($total as $i=>$t)
      $total[$i] += $count[$i];
  }

  echo '<div class=ach_bar><div class=bar style="width: '.($total[1]/$total[0]*100).'%;"></div><div class=pr>'.$lang['achievment_complete'].' '.$total[1].' / '.$total[0].'</div></div>';
  echo '<br>';

  foreach ($baseCat as $cat)
  {
    if ($cat['id']!=81)
    {
      $progress  = $cat['count'][1]/$cat['count'][0]*100;
      $count_txt = $cat['count'][1].' / '.$cat['count'][0];
    }
    else
    {
      $progress  = 0;
      $count_txt = $cat['count'][1];
    }
    echo '<div class=ach_progress>';
    echo '&nbsp;'.$cat['name'].':';
    echo '<div class=ach_bar><div class=bar style="width: '.$progress.'%;"></div><div class=pr>'.$count_txt.'</div></div>';
    echo '</div>';
  }
  echo '<br clear="all"/><br>';

  echo '<b>'.$lang['achievment_last'].'</b>';
  $count = $config['achievement_last'];
  foreach ($completed as $id=>$c)
  {
    $a = $wDB->selectRow("SELECT * FROM `wowd_achievement` WHERE `id` = ?d", $id);
    echo '<div class=a_last_c>';
    echo '<div class=a_last_cdate>';
    if ($a['points'])
        echo $a['points'].' <img src=images/achievement/points_sm.gif> ';
    echo getFormattedDateSmall($c).'</div>';
    echo '<b>'.$a['name'].'</b> - '.$a['description'];
    echo '</div>';
    if (!(--$count))
        break;
  }
  echo '</div>';
}

function renderAchievementCategoryList($cat, $faction, $guid)
{
  // Out player data for 0 categiry
  if ($cat == 0)
  {
    renderPlayerAchievementStats($cat, $faction, $guid);
    return;
  }
  uploadAchievementData($cat, $faction, $guid, $achievements);
  $asstat = 1;
  foreach ($achievements as $id=>$arc)
    if ($arc['flags']&ACHIEVEMENT_FLAG_COUNTER)
      $asstat = 0;

  if ($asstat)
  {
    if ($guid)
    {
      $total = 0; $compl = 0;
      foreach ($achievements as $id=>$a)
        if (!$a['parentAchievement'] && $a['points']) {$total++;if (@$a['date']) $compl++;}
      if ($total)
        echo '<div class=ach_s_list><div class=ach_bar><div class=bar style="width: '.($compl/$total*100).'%;"></div><div class=pr>'.$compl.' / '.$total.'</div></div></div>';
    }
    foreach ($achievements as $id=>$arc)
      renderAchievement($id, &$achievements[$id], $guid);
  }
  else
  {
    global $wDB;
    $name = $wDB->selectCell("SELECT `name` FROM `wowd_achievement_category` WHERE `id` = ?d", $cat);
    echo '<div class="ach_stats_name">'.$name.'</div>';
    $i=0;
    foreach ($achievements as $id=>$a)
    {
      echo '<div class="ach_stats'.($i&1 ? ' second' : '').'">';
      // Render requirements
      echo '<div class=ach_value>'.getAchievementValue($a, &$value, &$maxvalue).'</div>';
      echo $a['name'];
/*
      echo ' ('.$id.') - 0x'.dechex($a['flags']);
      foreach($a['requirement'] as $r)
      {
        $text=$r['name']? $r['name'] : $a['name'];
        $completed = @$r['counter'] ? @$r['counter'] : 0;
        echo '<div class=a_stat_value>'.$completed.'</div>';
        $text="->($r[id]) $text - f=$r[completionFlag], c=$r[requiredType]";
        echo '<br>'.$text;
      }/**/
      echo '</div>';
      $i++;
    }
    $subcat = $wDB->select("SELECT * FROM `wowd_achievement_category` WHERE `parent` = ?d ORDER BY `sortOrder`", $cat);
    if ($subcat)
    foreach($subcat as $c)
      renderAchievementCategoryList($c['id'], $faction, $guid);
  }
}

// Render achievement table (other data uploads by Ajax)
function renderAchievementData($category, $guid, $faction)
{
  global $wDB, $lang;
  $baseptr = "?achievement";
  if ($guid)
    $baseptr.= "&guid=".$guid;
  else
    $baseptr.= "&faction=".$faction;

  echo '<script type="text/javascript" src="js/achievement.js"></script>';
  echo '<br><TABLE class=achievement cellSpacing=0 cellPadding=0><TBODY>';
  echo '<TR><TD class="a_cat" id="a_category">';

  // Output player achievement statistic
  echo '<div class=a_topcat></div>';
  $category_list = $wDB->select(
  "SELECT
  `id` AS ARRAY_KEY,
  `parent` AS PARENT_KEY,
  `parent`,
  `name`
  FROM
   `wowd_achievement_category`
  ORDER BY `sortOrder`");
  // Show 1 category if no exist
  if ($category==0 && !$guid)
  {
    reset($category_list);
    $category = key($category_list);
  }
  if ($guid)
    echo '<div class=a_bodycat'.($category==0?'_sel':'').'><a id=ach_0 href='.$baseptr.' onclick=\'return selectCat(0);\'>'.$lang['achievment_total'].'</a></div>';
  foreach ($category_list as $id=>$cat)
  {
    if ($id==1)
      continue;
    $sel_cat = '';
    if ($id == $category) $sel_cat = '_sel';
    else foreach ($cat['childNodes'] as $i=>$sub) if ($i==$category) $sel_cat = '_sel';
    echo '<div class=a_bodycat'.$sel_cat.'>';
    echo "<a id='ach_".$id."' href=".$baseptr."&category=".$id." onclick='return selectCat(".$id.");'>".$cat['name']."</a>";
    foreach ($cat['childNodes'] as $i=>$sub)
      echo "<a id='ach_".$i."' class=".($i==$category?"sel":"sub")." href=".$baseptr."&category=".$i." onclick='return selectCat(".$i.");'>".$sub['name']."</a>";
    echo '</div>';
  }
  foreach ($category_list['1']['childNodes'] as $id=>$cat)
  {
    $sel_cat = '';
    if ($id == $category) $sel_cat = '_sel';
    else foreach ($cat['childNodes'] as $i=>$sub) if ($i==$category) $sel_cat = '_sel';
    echo '<div class=a_bodycat'.$sel_cat.'>';
    echo "<a id='ach_".$id."' href=".$baseptr."&category=".$id." onclick='return selectCat(".$id.");'>".$cat['name']."</a>";
    foreach ($cat['childNodes'] as $i=>$sub)
      echo "<a id='ach_".$i."' class=".($i==$category?"sel":"sub")." href=".$baseptr."&category=".$i." onclick='return selectCat(".$i.");'>".$sub['name']."</a>";
    echo '</div>';
  }
  echo '</div>';
  echo '<div class=a_bottomcat></div>';
  echo '</TD>';
  echo '<TD class="a_data">';
  echo '<div class="a_topdata"></div>';
  echo '<div class="a_bdydata" id="a_data">';
  renderAchievementCategoryList($category, $faction, $guid);
  echo '</div>';
  echo '<div class="a_btmdata"></div>';
  echo '</TD>';
  echo '</TR>';
  echo '</TBODY></TABLE>';
  echo '<script type="text/javascript">
  ChangeCssProperty(".ach_show .ach_req", "display", "none");
  ChangeCssProperty("div.a_bodycat a.sub", "display", "none");
  cacheCat("'.$baseptr."&category=".$category.'");
  </script>';
}
?>