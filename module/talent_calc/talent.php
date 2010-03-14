<?php
include_once("include/functions.php");
include_once("include/talent_calc.php");
//==============================================================================
// Скрипт предназначен для вывода талантов игрока
//==============================================================================
$talent = strtolower(@$_REQUEST['talent']);
if (isset($_REQUEST['pet']))
   $pid = intval($_REQUEST['pet']);
else
   $pid = -1;

$bild  = @$_REQUEST['bild'];

$cid = 0;

$link = '?talent';
$header = '';

echo '<div>';
//echo '<b>Classes:</b> ';
$cname = array(1=>'warrior',2=>'paladin',3=>'hunter',4=>'rogue',5=>'priest',6=>'death_knight',7=>'shaman',8=>'mage',9=>'warlock',11=>'druid');

foreach($cname as $c=>$name)
{
    echo '<a href="?talent='.$name.'" '.addTooltip(getClass($c)).'><img class=item src="'.getClassImage($c).'"></a>&nbsp;';
    if ($talent==$name)
    {
        $header = getClass($c);
        $link.="=".$name;
        $cid = $c;
    }
}
echo "<br>";
//echo "<br><b>Pets:</b> ";
$list = $wDB->select('SELECT `id`, `category` FROM `wowd_creature_family` WHERE `category` <> -1 ORDER BY `name`');
foreach($list as $family)
{
    $f = $family['id'];
    $c = $family['category'];
    echo '<a href="?talent&pet='.$c.'" '.addTooltip(getCreatureFamily($f,0)).'><img class=item src="'.getFamilyImage($f).'"></a>&nbsp;';
    if ($pid==$c)
    {
        $header = getCreatureFamily($f);
        $link.="&pet=".$c;
    }
}
echo '</div><br>';


if ($cid OR $pid>=0)
{
 echo '<div id="talent"></div>';
 includeTalentScript($cid, $pid, $config['talent_calc_max_level'], $header);
 if ($bild) echo '<script type="text/javascript">tc_bildFromStr("'.$bild.'");</script>';
 echo '<script type="text/javascript">tc_renderTree("talent");</script>';
}
echo '<div class=faq><center>';
echo '<a href="'.$link.'" id=talent_bild_link>Bild link</a> | <a href="#" onclick="return tc_resetBild();">Reset talents</a>';
echo '</center></div>';
?>
