<?php
function cmpZones($a, $b)
{
  if (count($a['areas'])==1)
    return count($b['areas'])==1 ? strcmp($a['name'], $b['name']) : 1;
  return count($b['areas'])!=1 ? strcmp($a['name'], $b['name']) : -1;
}
function zoneSortSelect()
{
  global $lang, $config, $dDB, $wDB;
  $cacheFilename = 'quest_zone_sort_'.$config['lang'].'.html';
  if (checkUseCacheHtml($cacheFilename, 24*60*60))
  {
    $zone_sort = $dDB->selectCol("SELECT `ZoneOrSort` FROM `quest_template` GROUP BY `ZoneOrSort`");
    $areas = $wDB->select("SELECT `id` AS ARRAY_KEY, `map_id`, `zone_id`, `name` FROM `wowd_zones` WHERE `id` IN (?a)", $zone_sort);
    $q_zones= array();
    $q_sort = array();
    foreach($zone_sort as $z)
    {
      if ($z > 0)
      {
        $area = @$areas[$z];
        $map = $area['map_id'];
        if (!isset($q_zones[$map]))
        {
          $q_zones[$map]['name'] = getMapName($map);
          $q_zones[$map]['areas']= array();
        }
        $q_zones[$map]['areas'][$z]=$area['name'];
      }
      else if ($z < 0)
        $q_sort[-$z]=getQuestSort(-$z);
    }
    // Sort it
    uasort($q_zones, 'cmpZones');
    uasort($q_sort,  'strcmp');

    echo '<select name="ZoneID" style="width: 49%">';
    echo '<option value=0>'.$lang['anything'].'</option>'."\n";
    foreach($q_zones as $map=>$z)
    {
      if (count($z['areas']) > 1)
      {
        uasort($z['areas'], 'strcmp');
        echo '<optgroup label="'.$z['name'].'">';
        foreach($z['areas'] as $id=>$name)
          echo '<option value='.$id.'>'.$name.'</option>'."\n";
        echo '</optgroup>';
      }
      else
      {
        foreach($z['areas'] as $id=>$name)
          echo '<option value='.$id.'>'.$name.'</option>'."\n";
      }
    }
    echo "</select>\n";
    echo '<select name="SortID" style="width: 49%">';
    echo '<option value=0>'.getQuestSort(0).'</option>'."\n";
    foreach($q_sort as $id=>$name)
      echo '<option value='.$id.'>'.$name.'</option>'."\n";
    echo "</select>";
    flushHtmlCache($cacheFilename);
  }
}
?>
