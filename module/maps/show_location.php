<?php
include_once("include/map_data.php");
echo "<script type=\"text/javascript\" src=\"js/mapper.js\"></script>";

$zone = $_REQUEST['location'];

// Передаём клиенту данные о картах
$mapdata = array();
foreach($gMapCoord as $mapId=>$map)
{
    $mapdata['m'.$mapId]['header'] = getMapName($mapId);
    $mapdata['m'.$mapId]['imageX'] = $map[5];
    $mapdata['m'.$mapId]['imageY'] = $map[4];
    $mapdata['m'.$mapId]['image']  = "images/map_image/maps/".$map[6];
}
foreach($gAreaImagesCoord as $areaId=>$area)
{
    $mapdata['a'.$areaId]['header'] = $area[1] == 0 ? getMapName($area[0]): getAreaName($area[1]);
    $mapdata['a'.$areaId]['imageX'] = 1002;
    $mapdata['a'.$areaId]['imageY'] =  668;
    $mapdata['a'.$areaId]['image']  = "images/map_image/areas/".$area[6];
}
echo "<script type=\"text/javascript\">
var data=".php2js($mapdata).";
function renderMap(id)
{
    var m = data[id];
    if (m)
    {
        setMapData(m);
        renderInstance('mapper',0);
    }
    else
        document.getElementById('mapper').innerHTML = 'No map present';
}
setBestScale(1002);
</script>";
$azeroth  = array( 14, 15, 16, 17, 19, 20, 21, 22, 23, 24, 26, 27, 28, 29, 30, 32, 34, 35, 36, 37, 38, 39, 40,301,341,382,480,462,463,499,502);
$kalimdor = array( 13,  4,  9, 11, 41, 42, 43, 61, 81,101,121,141,161,181,182,201,241,261,281,321,362,381,471,464,476);
$outland  = array(466,465,467,473,475,477,478,479,481);
$northrend= array(485,486,488,490,491,492,493,495,496,501,504,510,541);
$others   = array(401,443,461,482,512,540);
echo "<select onchange=\"renderMap(this.value)\">";
foreach ($azeroth as $id)
    echo "<option value=a".$id.">".getAreaNameFromId($id)."</option>";
echo "</select>";
echo "<select onchange=\"renderMap(this.value)\">";
foreach ($kalimdor as $id)
    echo "<option value=a".$id.">".getAreaNameFromId($id)."</option>";
echo "</select><br>";
echo "<select onchange=\"renderMap(this.value)\">";
foreach ($outland as $id)
    echo "<option value=a".$id.">".getAreaNameFromId($id)."</option>";
echo "</select>";
echo "<select onchange=\"renderMap(this.value)\">";
foreach ($northrend as $id)
    echo "<option value=a".$id.">".getAreaNameFromId($id)."</option>";
echo "</select><br>";

echo "<select onchange=\"renderMap(this.value)\">";
foreach ($others as $id)
    echo "<option value=a".$id.">".getAreaNameFromId($id)."</option>";
echo "</select>";

echo "<div id=mapper></div>\n";

if (isset($mapdata[$zone]))
    echo "<script type=\"text/javascript\">setBestScale(data['$zone'].imageX);renderMap('$zone');</script>";
?>