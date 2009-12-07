<?php
// Have 'Open Search' result like: "Dirty Leather Vest (Item)"
// Need fix it by extract name and type (get $name = "Dirty Leather Vest" and $type = "Item"
if (isset($_REQUEST['name']) && preg_match('/(^.*)\s\((.*?)\)/i', $_REQUEST['name'], $result))
{
 // After need convert $type to search mode
 if ($type = array_search($result[2],$ls_type_name))
 {
  $_REQUEST['s'] = $type;
  $_REQUEST['name'] = $result[1]; // name
 }
}

$s = @$_REQUEST['s'];
$name = @$_REQUEST['name'];

switch ($s)
{
  case 'i':
   include("search_item.php");
   break;
  case 'n':
   include("search_npc.php");
   break;
  case 'q':
   include("search_quest.php");
   break;
  case 's':
   include("search_spell.php");
   break;
  case 'o':
   include("search_go.php");
   break;
  case 'f':
   include("search_faction.php");
   break;
  case 'p':
   include("search_player.php");
   break;
  case 'set':
   include("search_itemset.php");
   break;
  case 'a':
   include("search_area.php");
   break;
  case 'all':
//   include_once("include/report_generator.php");
//   createReportTab();

   echo '<h3>'.$lang['search_item_req'].'</h3>';
   include("search_item.php");

   echo "<br><hr><br>";
   echo '<h3>'.$lang['search_set_req'].'</h3>';
   include("search_itemset.php");

   echo "<br><hr><br>";
   echo '<h3>'.$lang['search_faction_req'].'</h3>';
   include("search_faction.php");

   echo "<br><hr><br>";
   echo '<h3>'.$lang['search_npc_req'].'</h3>';
   include("search_npc.php");

   echo "<br><hr><br>";
   echo '<h3>'.$lang['search_quest_req'].'</h3>';
   include("search_quest.php");

   echo "<br><hr><br>";
   echo '<h3>'.$lang['search_go_req'].'</h3>';
   include("search_go.php");

   echo "<br><hr><br>";
   echo '<h3>'.$lang['search_spell_req'].'</h3>';
   include("search_spell.php");

   echo "<br><hr><br>";
   echo '<h3>'.$lang['search_area_req'].'</h3>';
   include("search_area.php");

   break;
 }
 ?>