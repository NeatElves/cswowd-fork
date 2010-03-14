<?php
include_once('include/map_data.php');
$areaId = intval(@$_REQUEST['jsarea']);;
$area_data = getRenderAreaData($areaId);
$list = $dDB->select(
'SELECT
   \'n\' AS `type`,
   `guid`,
   `id`,
   `map`,
   `spawnMask`,
   `phaseMask`,
   `modelid`,
   `equipment_id`,
   `position_x`,
   `position_y`,
   `position_z`,
   `orientation`,
   `spawntimesecs`,
   `spawndist`,
   `currentwaypoint`,
   `curhealth`,
   `curmana`,
   `DeathState`,
   `MovementType`
FROM `creature`
WHERE `map` = ?d AND `position_x` > ?d AND `position_x` < ?d AND `position_y` > ?d AND `position_y` < ?d', $area_data[0], $area_data[5], $area_data[4], $area_data[3], $area_data[2]);
$data = get_mapAreaData($areaId, $list);
echo php2js($data);
?>