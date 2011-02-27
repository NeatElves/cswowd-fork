<link href="skin/wdb/style.css" type="text/css" rel="stylesheet">
<p align="center">
 <table width="1020" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
  <tr>
   <td width="1020" height="215" valign="top" background="skin/wdb/WDB-top.jpg">
    <table width="1020" border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td width="25" height="50"></td>
      <td width="570" height="50"></td>
      <td width="425" height="50"></td>
     </tr>
     <tr>
      <td width="25" height="150"></td>
      <td width="570" height="150"></td>
      <td width="425" height="150"></td>
     </tr>
     <tr>
      <td width="25" height="15"></td>
      <td width="570" height="15"></td>
      <td width="425" height="15"></td>
     </tr>
    </table>
   </td>
  </tr>
  <tr>
   <td width="1020" valign="top" background="skin/wdb/WDB-middle.jpg">
     <table class="mainbody" width="1020" border="0" cellspacing="0" cellpadding="0">
      <tr>
       <td width="25" height="2"></td>
       <td width="735" height="2"></td>
       <td width="35" height="2"></td>
       <td width="195" height="2"></td>
       <td width="30" height="2"></td>
      </tr>
      <tr>
       <td width="25"></td>
       <td width="735" align="center" valign="top"><?php include("main.php");?></td>
       <td width="35"></td>
       <td width="195" align="left" valign="top">

        <?php  echo $lang['search_database']; ?>:<form style="display: inline" method="get">
        <input name="s" type="hidden" value="all"><input class="ls_search" alt="all" name="name"></form><br>
        <hr>

        <?php  echo $lang['find']; ?>:<br>
        <A href="?s=i"><?php  echo $lang['item_lookup']; ?></A><br>
        <A href="?s=q"><?php  echo $lang['quest_lookup']; ?></A><br>
        <A href="?s=s"><?php  echo $lang['spell_lookup']; ?></A><br>
        <A href="?s=n"><?php  echo $lang['creature_lookup']; ?></A><br>
        <A href="?s=o"><?php  echo $lang['object_lookup']; ?></A><br>
        <A href="?s=p"><?php  echo $lang['player_lookup']; ?></A><br>
        <A href="?auction"><?php  echo $lang['auction']; ?></A><br>
        <A href="?guild=list"><?php  echo $lang['guild']; ?></A><br />
        <A href="?instance"><?php  echo $lang['instance']; ?></A><br />  
        <hr>

        <span style="display: inline">
	    <?php  echo $config['servername']; ?></span><br>

        <A href="index.php"><?php  echo $lang['main']; ?></A><br>
        <hr>
	    <?php  echo $lang['top_lookup']; ?><br>
        <A href="?top=money"><?php  echo $lang['top_money']; ?></A><br>
        <A href="?top=honor"><?php  echo $lang['top_honor']; ?></A><br>
        <A href="?top=arena2"><?php  echo $lang['top_arena2']; ?></A><br>
        <A href="?top=arena3"><?php  echo $lang['top_arena3']; ?></A><br>
        <A href="?top=arena5"><?php  echo $lang['top_arena5']; ?></A><br>
        <hr>

        Primary Skill<br>
        <A href="?skill=Alchemy">Alchemy</A><br>
        <A href="?skill=Blacksmithing">Blacksmithing</A><br>
        <A href="?skill=Enchanting">Enchanting</A><br>
        <A href="?skill=Engineering">Engineering</A><br>
        <A href="?skill=Herbalism">Herbalism</A><br>
        <A href="?skill=Jewelcrafting">Jewelcrafting</A><br>
        <A href="?skill=Leatherworking">Leatherworking</A><br>
        <A href="?skill=Mining">Mining</A><br>
        <A href="?skill=Skinning">Skinning</A><br>
        <A href="?skill=Tailoring">Tailoring</A><br>
        <hr>

        Secondary Skill<br>
        <A href="?skill=Cooking">Cooking</A><br>
        <A href="?skill=First Aid">First Aid</A><br>
        <A href="?skill=Fishing">Fishing</A><br>
        <hr>

        <?php  echo $lang['menu_faq']; ?>:<br>
        <A href="?faq=classes"><?php  echo $lang['faq_classes']; ?></A><br>
        <A href="?faq=professions"><?php  echo $lang['faq_professions']; ?></A><br>
        <A href="?faq=slang"><?php  echo $lang['faq_slang']; ?></A><br>
        <A href="?faq=step1"><?php  echo $lang['step_1']; ?></A><br>
        <A href="?faq=aggro"><?php  echo $lang['about_aggro']; ?></A><br>
	    <A href="?faq=city"><?php  echo $lang['about_city']; ?></A><br>
	    <A href="?faq=guild"><?php  echo $lang['about_guild']; ?></A><br>
        <A href="?faq=socket"><?php  echo $lang['about_socket']; ?></A><br>
        <A href="?faq=macro"><?php  echo $lang['about_macro']; ?></A><br>
        <A href="?faq=raidhill"><?php  echo $lang['about_raid_hill']; ?></A><br>
        <hr>

	    <?php  echo $lang['menu_5']; ?>:<br />
        <A href="?register"><?php  echo $lang['register']; ?></A><br />
        <hr>

	    <?php  echo $lang['menu_6']; ?>:<br />
        <A href="?stat"><?php  echo $lang['statistic']; ?></A><br />
        <A href="module/talents/talents.html" target=_blank><?php  echo $lang['talent_calc']; ?></A><br>
        <A href="map/index.html"><?php  echo $lang['cartograph'];?></A><br>
       </td>
      </tr>
     </table>
   </td>
  </tr>
  <tr>
   <td width="1020" height="40" background="skin/wdb/WDB-bottom.jpg"></td>
  </tr>
 </table>
</p>