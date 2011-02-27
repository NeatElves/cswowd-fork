<?php
include_once("conf.php");
include_once("include/info_table_generator.php");

$entry = intval(@$_REQUEST['itemset']);
$set = getItemSet($entry);


if (!$set)
{
   RenderError($lang['item_not_found']);
}
else
{
    $setkey = array_keys($set);
    echo "<table class=report width=500 border = 1>";
    echo "<tbody>";
    echo "<tr><td class=head>".$set['name']."</td></tr>";
    echo "<tr><td class=set>";
    for($i=1;$i<18;$i++)
    if ($set_item = $set['item_'.$i])
    {
     echo "&nbsp;";show_item($set_item);echo "&nbsp;";
    }
    echo "</td></tr>";
    echo "<tr><td class=left>";
    for($i=1; $i<9; $i++)
    if ($spellID = $set['spell_'.$i])
      echo '&nbsp;<a class=spell href="?spell='.$spellID.'">('.$set['count_'.$i].') '.get_spell_details($spellID).'</a><br>';
    echo "</td></tr>";
    echo "</tbody></table>";
}
?>