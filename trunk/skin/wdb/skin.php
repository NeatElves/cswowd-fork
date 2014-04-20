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
        <a href="?s=i"><?php  echo $lang['item_lookup']; ?></a><br>
        <a href="?s=q"><?php  echo $lang['quest_lookup']; ?></a><br>
        <a href="?s=s"><?php  echo $lang['spell_lookup']; ?></a><br>
        <a href="?s=n"><?php  echo $lang['creature_lookup']; ?></a><br>
        <a href="?s=o"><?php  echo $lang['object_lookup']; ?></a><br>
        <a href="?s=p"><?php  echo $lang['player_lookup']; ?></a><br>
        <a href="?auction"><?php  echo $lang['auction']; ?></a><br>
        <a href="?guild=list"><?php  echo $lang['guild']; ?></a><br />
        <a href="?instance"><?php  echo $lang['instance']; ?></a><br />  
        <hr>

        <span style="display: inline">
	    <?php  echo $config['servername']; ?></span><br>

        <a href="index.php"><?php  echo $lang['main']; ?></a><br>
        <hr>
	    <?php  echo $lang['top_lookup']; ?><br>
        <a href="?top=money"><?php  echo $lang['top_money']; ?></a><br>
        <a href="?top=honor"><?php  echo $lang['top_honor']; ?></a><br>
        <a href="?top=arena2"><?php  echo $lang['top_arena2']; ?></a><br>
        <a href="?top=arena3"><?php  echo $lang['top_arena3']; ?></a><br>
        <a href="?top=arena5"><?php  echo $lang['top_arena5']; ?></a><br>
        <hr>

        Primary Skill<br>
        <a href="?skill=Alchemy">Alchemy</a><br>
        <a href="?skill=Blacksmithing">Blacksmithing</a><br>
        <a href="?skill=Enchanting">Enchanting</a><br>
        <a href="?skill=Engineering">Engineering</a><br>
        <a href="?skill=Herbalism">Herbalism</a><br>
        <a href="?skill=Jewelcrafting">Jewelcrafting</a><br>
        <a href="?skill=Leatherworking">Leatherworking</a><br>
        <a href="?skill=Mining">Mining</a><br>
        <a href="?skill=Skinning">Skinning</a><br>
        <a href="?skill=Tailoring">Tailoring</a><br>
        <hr>

        Secondary Skill<br>
        <a href="?skill=Cooking">Cooking</a><br>
        <a href="?skill=First Aid">First Aid</a><br>
        <a href="?skill=Fishing">Fishing</a><br>
        <hr>

        <?php  echo $lang['menu_faq']; ?>:<br>
        <a href="?faq=classes"><?php  echo $lang['faq_classes']; ?></a><br>
        <a href="?faq=professions"><?php  echo $lang['faq_professions']; ?></a><br>
        <a href="?faq=slang"><?php  echo $lang['faq_slang']; ?></a><br>
        <a href="?faq=step1"><?php  echo $lang['step_1']; ?></a><br>
        <a href="?faq=aggro"><?php  echo $lang['about_aggro']; ?></a><br>
	    <a href="?faq=city"><?php  echo $lang['about_city']; ?></a><br>
	    <a href="?faq=guild"><?php  echo $lang['about_guild']; ?></a><br>
        <a href="?faq=socket"><?php  echo $lang['about_socket']; ?></a><br>
        <a href="?faq=macro"><?php  echo $lang['about_macro']; ?></a><br>
        <a href="?faq=raidhill"><?php  echo $lang['about_raid_hill']; ?></a><br>
        <hr>

	    <?php  echo $lang['menu_5']; ?>:<br />
        <a href="?register"><?php  echo $lang['register']; ?></a><br />
        <hr>

	    <?php  echo $lang['menu_6']; ?>:<br />
        <a href="?stat"><?php  echo $lang['statistic']; ?></a><br />
        <a href="module/talents/talents.html" target=_blank><?php  echo $lang['talent_calc']; ?></a><br>
        <a href="map/index.html"><?php  echo $lang['cartograph'];?></a><br>
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