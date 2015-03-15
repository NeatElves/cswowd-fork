<?php
include_once("conf.php");
include_once("include/info_table_generator.php");
include_once("include/report_generator.php");

$page  = intval(@$_REQUEST['page']);
$skill = @$_REQUEST['skill'];

$baseLink = "?skill=$skill";

// Гуид указан если перешли из показа игрока
if ($guid = intval(@$_REQUEST['guid']))
{
   $baseLink.= "&guid=$guid";
}

$sort="";

if (intval($skill) == 0)
{
 switch (strtolower($skill))
 {
  case "alchemy":        $skillID = 171; break;
  case "blacksmithing":  $skillID = 164; break;
  case "enchanting":     $skillID = 333; break;
  case "engineering":    $skillID = 202; break;
  case "herbalism":      $skillID = 182; break;
  case "jewelcrafting":  $skillID = 755; break;
  case "leatherworking": $skillID = 165; break;
  case "mining":         $skillID = 186; break;
  case "skinning":       $skillID = 393; break;
  case "tailoring":      $skillID = 197; break;
  case "inscription":    $skillID = 773; break;
  case "first aid":      $skillID = 129; break;
  case "cooking":        $skillID = 185; break;
  case "fishing":        $skillID = 356; break;
  default:               $skillID =   0; break;
 }
}
else
 $skillID = intval($skill);

$skillline = getSkillLine($skillID);
if (!$skillline)
{
 echo 'No found';
}
else
{
  $prof_list = array('SKILL_REPORT_LEVEL','SKILL_REPORT_ICON','SKILL_REPORT_NAME','SPELL_REPORT_REAGENTS');
  $spell_list= array('SPELL_REPORT_LEVEL','SPELL_REPORT_ICON','SPELL_REPORT_NAME');

  $skill =& new SpellReportGenerator('skill');
  $skill->disable_mark = true;
  if ($skillline['Category'] == 9 OR $skillline['Category'] == 11)
    $skill->Init($prof_list, $baseLink, 'skillLIST', $config['skill_fade_limit'], 'skill_lvl');
  else
    $skill->Init($spell_list, $baseLink, 'skillLIST', $config['skill_fade_limit'], 'level');

  $skill->doSkillList($skillID);
  $skill->createReport($skillline['Name']);
}
?>
