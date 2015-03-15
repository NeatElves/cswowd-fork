<?php
include_once("include/functions.php");

$str   = @$_REQUEST['tip'];
$tip   = substr($str,0,1);
$entry = intval(substr($str,1,10));
switch ($tip)
{
  // Показ вещи
  case "i":
  if (substr($str,1,1)=='g')
  {
     $entry = intval(substr($str,2,10));
     if ($item_data = getItemData($entry))
     {
       if ($item = getItem($item_data[ITEM_FIELD_ENTRY]))
         noBorderItemTable($item, $item_data);
     }
	 else
       echo "Error item guid $entry";
  }
  else if ($item=getItem($entry))
    noBorderItemTable($item,0,0);
  else
    echo "Error item $entry";
  break;
  // Показ  Существа
  case "c":
  if ($creature=getCreature($entry))
  {
    include_once("include/creature_table.php");
    noBorderCreatureTable($creature);
  }
  else
    echo "Error creature $entry";
  break;
  // Показ Обьекта
  case "o":
  if ($obj=getGameobject($entry))
  {
    include_once("include/gameobject_table.php");
    noBorderGameobjectTable($obj);
  }
  else
    echo "Error object $entry";
  break;
  // Показ спелла
  case "s":
  if ($spell=getSpell($entry))
    noBorderSpellTable($spell);
  else
    echo "Error spell $entry";
  break;
  // Показ энчанта
  case "e":
  if ($enc=getEnchantment($entry))
    noBorderEnchantTable($enc);
  else
    echo "Error enchant $entry";
  break;
  // Показ таланта
  case "t":
  $rank  = intval(substr($str,1,1));
  $entry = intval(substr($str,2,5));
  $talentTab = $wDB->selectRow("SELECT * FROM `wowd_talents` WHERE `TalentID` = ?d", $entry);
  if ($talentTab)
    noBorderTalentTable($talentTab, $rank);
  else
    echo "Error talent $entry - $rank";
  break;
  // Показ фракции
  case "f":
  if ($faction=getFaction($entry))
  {
    include_once("include/faction_table.php");
    noBorderFactionTable($faction);
  }
  else
    echo "Error faction $entry";
  break;

}
?>
