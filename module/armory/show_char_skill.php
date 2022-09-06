<?php
//==============================================================================
// Скрипт предназначен для вывода скилов игрока
//==============================================================================

function getCharacterSkills($guid_id)
{
  global $cDB;
  return $cDB->select("-- CACHE: 1h
  SELECT * FROM `character_skills` WHERE `guid` = ?d", $guid_id);
}

function showPlayerSkills($guid)
{
  global $wDB, $lang;
  $skill_category = $wDB->select('-- CACHE: 1h
  SELECT `id` AS ARRAY_KEY, `name`, `order` FROM `wowd_skill_line_category`');
  $skill_rev = array();
  // Помещаем данные о скилах в буфер для сотрировки их по классу
  $playerSkill=array();

  $skillcount = getCharacterSkills($guid);
  if ($skillcount)
  foreach ($skillcount as $guid)
 {
   $skillId   = $guid['skill']; // skill id
   if ($skillId == 0)
       continue;

   $skill     = $guid['value']; // skill
   $maxskill  = $guid['max'];        // max skill

   $skillPerm  = 0; // Баф с талантов (добавляется и к skill, и к maxSkill(занулил пока)
   $skillTemp  = 0;        // Временный баф, влияет только на skill(занулил пока)

   if ($skillLine = getSkillLine($skillId))
   {
    $skill    = $skill    + $skillPerm;
    $maxskill = $maxskill + $skillPerm;
    $category = $skillLine['Category'];

    // Категория 12 скрыта
    if ($category == 12)
      continue;
    $order = $skill_category[$category]['order'];
    $skill_rev[$order] = $category;
    $playerSkill[$order][] =
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
    echo '<table class=report cellSpacing=0 cellPadding=0><tbody>';
    echo '<tr><td class=head colspan=3>'.$lang['player_skills'].'</td></tr>';
    foreach($playerSkill as $id=>$skill_data)
    {
      $id = $skill_rev[$id];
      echo '<tr><td class=skill_category colspan=3> '.$skill_category[$id]['name'].'</td></tr>';
      foreach($skill_data as $skill)
      {
        if ($skill['Description']!='')
        {
          $tip = '<table class=skilltip><tr class=top><td>'.$skill['Name'].'</td></tr><tr><td>'.$skill['Description'].'</td></tr></table>';
          echo '<tr '.addTooltip($tip,'BORDER, false, STICKY, false').'>';
        }
        else
          echo '<tr>';
        $pct = intval($skill['Skill']/$skill['maxSkill']*100);
        $text = $skill['Skill'];
             if ($skill['bonus'] > 0) $text.='<font class=posstat>+'.$skill['bonus'].'</font>';
        else if ($skill['bonus'] < 0) $text.='<font class=negstat>'.$skill['bonus'].'</font>';
        $text.=' / '.$skill['maxSkill'];
//      $ico = '';
//      if ($skill['icon'] > 1)
//          $ico = '<img src='.getSpellIcon($skill['icon']).'>';
//      echo '<td class=skill_ico>'.$ico.'</td>';
        echo '<td class=skill_name><A href="?skill='.$skill['id'].'&guid='.$guid.'">'.$skill['Name'].'</td>';
        echo '<td class=skill_bar><div class=skill_bar><b class=s1 style="width: '.$pct.'%;"></b><span>'.$text.'</span></div></td>';
        echo '</tr>';
      }
    }
    echo '</tbody></table>';
  }
}
?>