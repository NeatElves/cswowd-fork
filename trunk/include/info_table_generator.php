<?php
include_once("conf.php");
include_once("functions.php");

function init_pagePerMark($mark, $pattern, $page)
{
 global $config;
 if ($mark == $pattern && $page > 0)
     return ($page-1)*$config['fade_limit'];
 return 0;
}

function render_Page($currentOffset, $totalRecords, $colSpan, $baselink, $add)
{
   global $config;
   $link = '<a href="'.$baselink.'&page=%d&mark='.$add.'#'.$add.'">%d </a>';
   $currentPage = floor($currentOffset/$config['fade_limit']) + 1;
   generateLPage($totalRecords, $currentPage, $link, $config['fade_limit'], $colSpan);
}

function render_AjaxPage($currentOffset, $totalRecords, $colSpan, $baselink, $add)
{
   global $config;
   $link = '<a href="'.$baselink.'&page=%d&mark='.$add.'" onClick="return uploadFromHref(this, \''.$add.'\');">%d </a>';
   $currentPage = floor($currentOffset/$config['fade_limit']) + 1;
   generateLPage($totalRecords, $currentPage, $link, $config['fade_limit'], $colSpan);
}

function renderFactionGroupList($parent, $list, $header, $page_seek, $totalRecords, $baseLink, $headMARK)
{
  global $lang;
  if (!$list)
     return;
  echo '<div class=reportContainer id='.$headMARK.'>';
  addTab($header.' ('.$totalRecords.')', $headMARK);
  echo "<table class=report width=500>";
  echo "<tbody>";
  echo "<tr class=head><td><a name=\"$headMARK\">$header</a></td></tr>";
  echo '<tr>';
  echo '<td class=teamreputation>';
  echo '<a href="?faction='.$parent['id'].'">'.$parent['name'].'</a></td>';
  echo '</tr>';
  foreach($list as $f)
  {
   echo '<tr>';
   echo '<td class=reputation><a href="?faction='.$f['id'].'">&nbsp;'.$f['name'].'</a></td>';
   echo '</tr>';
  }
  render_Page($page_seek, $totalRecords, 1, $baseLink, $headMARK);
  echo "</tbody></table></div>";
}

//=======================================================================================
// Рендер лута по таблицам loot_
// creature_loot_template
// gameobject_loot_template
// item_loot_template
//=======================================================================================
function renderSubList($lootList)
{
  global  $Quality;
  if (!$lootList)
     return;
  $curloot = -1;
  foreach ($lootList as $loot)
  {
    $gtext = "";
    if ($loot['groupid']!=$curloot)
    {
        echo "<tr><th colspan = 3>Group $loot[groupid]</th></tr>";
        $curloot = $loot['groupid'];
    }
    echo "<TR>";
    if ($loot['mincountOrRef'] > 0)
    {
     if ($item = GetItem($loot['item'],"`entry`, `Quality`, `name`, `displayid`"))
     {
      $colorname = $item['Quality'];
      echo "<TD width=1%>";show_item($item['entry'], $item['displayid'], 'reagent');echo "</TD>";
      echo "<TD class=left><A class=$Quality[$colorname] href=\"?item=$item[entry]\">$item[name]</A></TD>";
     }
     else
       echo "<TD>-</TD><TD>Unknown item $loot[item]</TD>";
    }
    else // Используется список вещей (падает только одна вещь из списка)
    {
      echo "<TD align=center>".$loot['maxcount']."x</TD>";
      echo "<TD class=forsub>$gtext<TABLE class=sublist><TBODY>";
      renderSubList($loot['item']);
      echo "</TBODY></TABLE></TD>";
    }
         if ($loot['ChanceOrQuestChance'] < 0) echo "<TD align=center>Q".(-$loot['ChanceOrQuestChance'])."%</TD>";
    else if ($loot['ChanceOrQuestChance'] > 0) echo "<TD align=center>".$loot['ChanceOrQuestChance']."%</TD>";
    echo "</TR>";
  }
}

function renderLootTableList($lootList, $header, $page_seek, $totalRecords, $baseLink, $headMARK)
{
  global $lang;
  if (!$lootList)
     return;
  echo '<div class=reportContainer id='.$headMARK.'>';
  addTab($header.' ('.$totalRecords.')', $headMARK);
  echo "<TABLE class=report width=500>";
  echo "<TBODY>";
  echo "<TR class=head><TD colSpan=3><a name=\"$headMARK\">$header</a></TD></TR>";
  echo "<TR><TH width=1%></TH><TH>$lang[item_name]</TH><TH>$lang[drop]%</TH></TR>";
  renderSubList($lootList);
  render_Page($page_seek, $totalRecords, 3, $baseLink, $headMARK);
  echo "</TBODY></TABLE></div>";
}

//=======================================================================================
// Выводим зоны для рыбалки имеющие данный лут
//=======================================================================================
function renderItemFishingList($lootList, $refLoot, $header, $page_seek, $totalRecords, $baseLink, $headMARK)
{
  global $lang,$config;
  if (!$lootList)
      return;
  echo '<div class=reportContainer id='.$headMARK.'>';
  addTab($header.' ('.$totalRecords.')', $headMARK);
  echo "<TABLE class=report width=500>";
  echo "<TBODY>";
  echo "<TR><TD colSpan=2 class=head><a name=\"$headMARK\">$header</a></TD></TR>";
  echo "<TR><TH>Area</TH><TH>$lang[drop]%</TH></TR>";
  foreach ($lootList as $area_loot)
  {
    echo "<TR>";
    echo '<TD class=left>'.getFullAreaName($area_loot['loot_entry']).'</TD>';
    if ($area_loot['ChanceOrQuestChance'] < 0) echo "<TD>Q".(-$area_loot['ChanceOrQuestChance'])."%</TD>";
    else                                       echo "<TD>".$area_loot['ChanceOrQuestChance']."%</TD>";
    echo "</TR>";
  }
  render_Page($page_seek, $totalRecords, 2, $baseLink, $headMARK);
  echo "</TBODY></TABLE></div>";
}
?>
