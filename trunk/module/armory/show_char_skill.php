<?php
//==============================================================================
// Скрипт предназначен для вывода скилов игрока
//==============================================================================

function showPlayerSkills($guid, $char_data)
{
  global $gSkillCategory, $lang;
  $skill_order=array(5=>1,6=>5,7=>2,8=>6,9=>4,10=>7,11=>3,12=>8);
  $skill_rev  =array(1=>5,5=>6,2=>7,6=>8,4=>9,7=>10,3=>11,8=>12);

  // Помещаем данные о скилах в буфер для сотрировки их по классу
  $playerSkill=array();
  for ($i=0;$i<128;$i++)
  {
   $data0 = $char_data[PLAYER_SKILL_INFO_1_1 + $i*3];
   $data1 = $char_data[PLAYER_SKILL_INFO_1_1 + $i*3 + 1];
   $data2 = $char_data[PLAYER_SKILL_INFO_1_1 + $i*3 + 2];
   $skillId   = $data0&0x0000FFFF; // skill id
   if ($skillId == 0)
       continue;
   $skillFlag = $data0>>16;        // Unlearn button enabled if & 1

   $skill     = $data1&0x0000FFFF; // skill
   $maxskill  = $data1>>16;        // max skill

   $skillPerm  = $data2&0x0000FFFF; // Баф с талантов (добавляется и к skill, и к maxSkill
   $skillTemp  = $data2>>16;        // Временный баф, влияет только на skill

   if ($skillLine = getSkillLine($skillId))
   {
    $skill    = $skill    + $skillPerm;
    $maxskill = $maxskill + $skillPerm;
    $category = $skillLine['Category'];

    // Категория 12 скрыта
    if ($category == 12)
      continue;
    $playerSkill[$skill_order[$category]][] =
    array('id'=>$skillId,
          'Name'=>$skillLine['Name'],
          'Category'=>$category,
          'Description'=>$skillLine['Description'],
          'icon'=>$skillLine['iconId'],
          'Skill'=>$skill,
          'maxSkill'=>$maxskill,
          'bonus'=>$skillTemp);
   }
  }
  if ($playerSkill)
  {
    ksort($playerSkill);
    // Выводим данные в таблицу
    echo "<table class=report cellSpacing=0 cellPadding=0><TBODY>";
    echo "<tr><td class=head colspan=3>".$lang['player_skills']."</td></tr>";
    foreach($playerSkill as $id=>$skill_data)
    {
      $id = $skill_rev[$id];
      echo "<tr><td class=skill_category colspan=3>".$gSkillCategory[$id]."</td></tr>";
      foreach($skill_data as $skill)
      {
        if ($skill['Description']!="")
          echo "<tr onmouseover=\"Tip('<table class=skilltip><tr class=top><td>$skill[Name]</td></tr><tr><td>".validateText($skill['Description'])."</td></tr></table>',BORDER,false, STICKY, false);\">";
        else
          echo "<tr>";
        $pct = intval($skill['Skill']/$skill['maxSkill']*100);
        $text = $skill['Skill'];
             if ($skill['bonus'] > 0) $text.="<font class=posstat>+".$skill['bonus']."</font>";
        else if ($skill['bonus'] < 0) $text.="<font class=negstat>".$skill['bonus']."</font>";
        $text.=" / ".$skill['maxSkill'];
//      $ico = "";
//      if ($skill['icon'] > 1)
//          $ico = "<img src=".getSpellIcon($skill['icon']).">";
//      echo "<td class=skill_ico>$ico</td>";
        echo "<td class=skill_name><A href=\"?skill=".$skill['id']."&guid=$guid\">".$skill['Name']."</td>";
        echo "<td class=skill_bar><div class=skill_bar><b class=s1 style=\"width: ".$pct."%;\"></b><span>".$text."</span></div></td>";
        echo "</tr>";
      }
    }
    echo "</tbody></table>";
  }
}
?>