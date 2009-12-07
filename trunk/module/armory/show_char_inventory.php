<?php
//==============================================================================
// Скрипт предназначен для вывода инвенторя/содержимого банка/сумок банка игрока
//==============================================================================

function generateBagTable($slot)
{
  $top = ($slot&3)?"bag_top_2.gif":"bag_top_0.gif";
  $height= ((($slot + 2)>>2)-1)*41;
  $sub = ($slot&3)?21:0;
  $imgdir="images/player_info/bank/";
  return
   "<table class=noborder width=185 cellSpacing=0 cellPadding=0><tbody>"
  ."<tr><td style=\"background: url(".$imgdir.$top.") no-repeat bottom; height: ".(88-$sub)."px;\"></dt></tr>"
  ."<tr><td style=\"background: url(".$imgdir."bag_middle.gif) bottom; height: ".$height."px;\"></dt></tr>"
  ."<tr><td style=\"background: url(".$imgdir."bag_bottom.gif) no-repeat bottom; height: 3px;\"></dt></tr>"
  ."</tbody></table>";
}

function drawBankFrame($bag)
{
  $img="images/player_info/bank/bankframe.gif";
  echo "<div style=\"position: relative; width: 392px; height: 354\">";
  echo "<img src=$img style=\"position: absolute; left: 0; top: 0;\">";
  for($id = BANK_SLOT_ITEM_START; $id<BANK_SLOT_ITEM_END;$id++)
  if ($container = @$bag[$id])
  {
      $slot = $id-BANK_SLOT_ITEM_START;
      $posx = ($slot%7)*48+28;
      $posy = ((int)($slot/7))*44+28;
      show_item_by_guid($container['item'], 'armory', $posx, $posy);
  }
  for($id = BANK_SLOT_BAG_START; $id<BANK_SLOT_BAG_END;$id++)
  if ($container = @$bag[$id])
  {
      $slot = $id-BANK_SLOT_BAG_START;
      $posx = $slot*48+28;
      $posy = 229;
      show_item_by_guid($container['item'], 'armory', $posx, $posy);
  }
  echo "</div>";
}
function drawBackPack($bag)
{
  echo "<div style=\"position: relative; width: 185px;\">";
  echo generateBagTable(16);
  $bagico = "images/icons/inv_misc_bag_08.jpg";
  echo "<img src=$bagico width=38 style=\"position: absolute; left: 3; top: 3;\">";
  for($id = INVENTORY_SLOT_ITEM_START; $id<INVENTORY_SLOT_ITEM_END;$id++)
  if ($container = @$bag[$id])
  {
      $slot = $id-INVENTORY_SLOT_ITEM_START;
      $posx = ($slot &3)*41+16;
      $posy = ($slot>>2)*41+49;
      show_item_by_guid($container['item'], 'armory', $posx, $posy);
  }
  echo "</div>";
}
function drawKeyRing($bag)
{
  $count = 0;
  for($id = KEYRING_SLOT_START; $id<KEYRING_SLOT_END;$id++)
      if (@$bag[$id]) $count=$id-KEYRING_SLOT_START;
  if (!$count)
    return;
  $count = ($count+3)&(~3);
  echo "<div style=\"position: relative; width: 185px;\">";
  echo generateBagTable($count);
  for($id = KEYRING_SLOT_START; $id<KEYRING_SLOT_END;$id++)
  if ($container = @$bag[$id])
  {
      $slot = $id-KEYRING_SLOT_START;
      $posx = ($slot &3)*41+16;
      $posy = ($slot>>2)*41+49;
      show_item_by_guid($container['item'], 'armory', $posx, $posy);
  }
  echo "</div>";
}
function drawContainer($guid, $bag)
{
  $item_data = getItemData($guid);
  if ($item_data == 0 || @$item_data[ITEM_FIELD_TYPE]!=TYPE_CONTAINER)
      return;
  $slot = $item_data[CONTAINER_FIELD_NUM_SLOTS];
  echo "<div style=\"position: relative; width: 185px;\">";
  echo generateBagTable($slot);
  $bagico = getItemIconFromItemId($item_data[ITEM_FIELD_ENTRY]);
  echo "<img src=$bagico width=38 style=\"position: absolute; left: 3; top: 3;\">";
  $sub = ($slot&3)?21:0;
  foreach($bag as $id=>$container)
  {
      $pos  = $id + ($slot&3);
      $posx = ($pos &3)*41+16;
      $posy = ($pos>>2)*41+49-$sub;
      show_item_by_guid($container['item'], 'armory', $posx, $posy);
  }
  echo "</div>";
}

function showPlayerInventory($guid, $char_data)
{
  global $lang, $cDB;
  $inventory = $cDB->select(
  "SELECT
  `bag` AS ARRAY_KEY_1,
  `slot` AS ARRAY_KEY_2,
  `item`,
  `item_template`
  FROM `character_inventory`
  WHERE `guid` = ?d
  ORDER BY `bag`, `slot`", $guid);

  echo "<table width=100%><tbody><tr><td>";
  if ($inventory)
  foreach($inventory as $id=>$bag)
  {
    if ($id == 0)
    {
        drawBankFrame($bag);
        drawBackPack($bag);
        drawKeyRing($bag);

//      foreach($bag as $slot=>$container)
//        show_item_by_guid($container['item']);
    }
    else
    {
      echo "<span  style=\"float: left;\">";
      drawContainer($id, $bag);
      echo "</span>";
    }
  }
  echo "</td></tr></tbody></table>";
}
?>