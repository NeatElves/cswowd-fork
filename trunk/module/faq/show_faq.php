<?php
$faq = @$_REQUEST['faq'];

$faq_list = array(
'list'=>'list.html',
'step1'=>'step1.html',
'socket'=>'socket.html',
'guild'=>'guild.html',
'aggro'=>'aggro.html',
'macro'=>'macro.html',
'raidhill'=>'raidhill.html',
//'rules'=>'rules.html',
'slang'=>'slang.html',
//'levelchart'=>'levelchart.html',

// class faq
'classes'=>'classfaq/classes.html',
'class-druid'=>'classfaq/class-druid.html',
'class-hunter'=>'classfaq/class-hunter.html',
'class-mage'=>'classfaq/class-mage.html',
'class-paladin'=>'classfaq/class-paladin.html',
'class-priest'=>'classfaq/class-priest.html',
'class-rogue'=>'classfaq/class-rogue.html',
'class-shaman'=>'classfaq/class-shaman.html',
'class-warlock'=>'classfaq/class-warlock.html',
'class-warrior'=>'classfaq/class-warrior.html',
'class-death_knight'=>'classfaq/class-death_knight.html',

// Proffesions faq & guide
'professions'=>'proffaq/professions.html',
'guide-alchemy'=>'proffaq/guide-alchemy.html',
'guide-blacksmithing'=>'proffaq/guide-blacksmithing.html',
'guide-cooking'=>'proffaq/guide-cooking.html',
'guide-enchanting'=>'proffaq/guide-enchanting.html',
'guide-engineering'=>'proffaq/guide-engineering.html',
'guide-first_aid'=>'proffaq/guide-first_aid.html',
'guide-fishing'=>'proffaq/guide-fishing.html',
'guide-herbalism'=>'proffaq/guide-herbalism.html',
'guide-jewelcrafting'=>'proffaq/guide-jewelcrafting.html',
'guide-leatherworking'=>'proffaq/guide-leatherworking.html',
'guide-mining'=>'proffaq/guide-mining.html',
'guide-skinning'=>'proffaq/guide-skinning.html',
'guide-tailoring'=>'proffaq/guide-tailoring.html',
'prof-alchemy'=>'proffaq/prof-alchemy.html',
'prof-blacksmithing'=>'proffaq/prof-blacksmithing.html',
'prof-cooking'=>'proffaq/prof-cooking.html',
'prof-enchanting'=>'proffaq/prof-enchanting.html',
'prof-engineering'=>'proffaq/prof-engineering.html',
'prof-first_aid'=>'proffaq/prof-first_aid.html',
'prof-fishing'=>'proffaq/prof-fishing.html',
'prof-herbalism'=>'proffaq/prof-herbalism.html',
'prof-jewelcrafting'=>'proffaq/prof-jewelcrafting.html',
'prof-leatherworking'=>'proffaq/prof-leatherworking.html',
'prof-mining'=>'proffaq/prof-mining.html',
'prof-skinning'=>'proffaq/prof-skinning.html',
'prof-tailoring'=>'proffaq/prof-tailoring.html',

// Race faq
'race-humans'=>'racefaq/race-humans.html',
'race-night_elves'=>'racefaq/race-night_elves.html',
'race-dwarves'=>'racefaq/race-dwarves.html',
'race-gnomes'=>'racefaq/race-gnomes.html',
'race-orcs'=>'racefaq/race-orcs.html',
'race-taurens'=>'racefaq/race-taurens.html',
'race-undeads'=>'racefaq/race-undeads.html',
'race-trolls'=>'racefaq/race-trolls.html',
'race-draenei'=>'racefaq/race-draenei.html',
'race-blood_elves'=>'racefaq/race-blood_elves.html',

// Race info
'blood_elves'=>'raceinfo/blood_elves.html',
'high_elves'=>'raceinfo/high_elves.html',
'high_elves_and_blood_elves'=>'raceinfo/high_elves_and_blood_elves.html',
'night_elves'=>'raceinfo/night_elves.html',

// Leaders
'aedelas_blackmoore'=>'raceinfo/aedelas_blackmoore.html',
'aegwyn'=>'raceinfo/aegwyn.html',
'alleria_windrunner'=>'raceinfo/alleria_windrunner.html',
'anasterian_sunstrider'=>'raceinfo/anasterian_sunstrider.html',
'anduin_lothar'=>'raceinfo/anduin_lothar.html',
'antonidas'=>'raceinfo/antonidas.html',
'arthas_menethil'=>'raceinfo/arthas_menethil.html',
'blackhand'=>'raceinfo/blackhand.html',
'cairne_bloodhoof'=>'raceinfo/cairne_bloodhoof.html',
'daelin_proudmoore'=>'raceinfo/daelin_proudmoore.html',
'dathremar_sunstrider'=>'raceinfo/dathremar_sunstrider.html',
'dejahna'=>'raceinfo/dejahna.html',
'desdel_stareye'=>'raceinfo/desdel_stareye.html',
'durotan'=>'raceinfo/durotan.html',
'fandral_staghelm'=>'raceinfo/fandral_staghelm.html',
'grom_hellscream'=>'raceinfo/grom_hellscream.html',
'guldan'=>'raceinfo/guldan.html',
'jaina_proudmoore'=>'raceinfo/jaina_proudmoore.html',
'jarod_shadowsong'=>'raceinfo/jarod_shadowsong.html',
'kaelthas_sunstrider'=>'raceinfo/kaelthas_sunstrider.html',
'kelthuzad'=>'raceinfo/kelthuzad.html',
'khadgar'=>'raceinfo/khadgar.html',
'kilrogg_deadeye'=>'raceinfo/kilrogg_deadeye.html',
'kurtalos_ravencrest'=>'raceinfo/kurtalos_ravencrest.html',
'latosius'=>'raceinfo/latosius.html',
'maiev_shadowsong'=>'raceinfo/maiev_shadowsong.html',
'tyrande_whisperwind'=>'raceinfo/tyrande_whisperwind.html',
'medivh'=>'raceinfo/medivh.html',
'muradin_bronzebeard'=>'raceinfo/muradin_bronzebeard.html',
'naga'=>'raceinfo/naga.html',
'nekros_skullcrusher'=>'raceinfo/nekros_skullcrusher.html',
'nerzhul'=>'raceinfo/nerzhul.html',
'nielas_aran'=>'raceinfo/nielas_aran.html',
'orgrim_doomhammer'=>'raceinfo/orgrim_doomhammer.html',
'rhonin'=>'raceinfo/rhonin.html',
'terenas_menethil'=>'raceinfo/terenas_menethil.html',
'thral'=>'raceinfo/thral.html',
'turalyon'=>'raceinfo/turalyon.html',
'malfurion_stormrage'=>'raceinfo/malfurion_stormrage.html',
'uther'=>'raceinfo/uther.html',
'valstann_staghelm'=>'raceinfo/valstann_staghelm.html',
'vashj'=>'raceinfo/vashj.html',
'vereesa_windrunner'=>'raceinfo/vereesa_windrunner.html',

// Immortals
'azshara'=>'immortals/azshara.html',
'cenarius'=>'immortals/cenarius.html',
'demigods'=>'immortals/demigods.html',
'elune'=>'immortals/elune.html',
'gods'=>'immortals/gods.html',
'immortals'=>'immortals/immortals.html',
'malorne'=>'immortals/malorne.html',

// Demon faq
'demon-info'=>'demons/demon-info.html',
'demon-archimonde'=>'demons/demon-archimonde.html',
'demon-kiljaeden'=>'demons/demon-kiljaeden.html',
'demon-mannoroth'=>'demons/demon-mannoroth.html',
'demon-sargeras'=>'demons/demon-sargeras.html',
'demon-satyrs'=>'demons/demon-satyrs.html',
'demon-xavius'=>'demons/demon-xavius.html',
'demon-illidan_stormrage'=>'demons/demon-illidan_stormrage.html',

// Faction faq
'faction-alliance'=>'faction/faction-alliance.html',
'faction-horde'=>'faction/faction-horde.html',
'faction-sentinels'=>'faction/faction-sentinels.html',
'faction-sisterhood_of_elune'=>'faction/faction-sisterhood_of_elune.html',
'faction-highborne'=>'faction/faction-highborne.html',
'faction-burning_legion'=>'faction/faction-burning_legion.html',
'faction-scourge'=>'faction/faction-scourge.html',
'faction-scarlet_crusade'=>'faction/faction-scarlet_crusade.html',
'faction-cenarion_circle'=>'faction/faction-cenarion_circle.html',
'faction-moon_guard'=>'faction/faction-moon_guard.html',
'faction-farstriders'=>'faction/faction-farstriders.html',
'faction-watchers'=>'faction/faction-watchers.html',

// Wow world
'azeroth'=>'world/azeroth.html',
'mythos'=>'world/chapter_1_mythos.html',
'last_keeper'=>'world/chapter_2_last_keeper.html',
'born_of_horde'=>'world/chapter_3_birth_horde.html',
'dark_portal'=>'world/chapter_4_dark_portal.html',
'old_enemy'=>'world/chapter_5_old_enemies.html',
'new_era'=>'world/chapter_6_new_era.html',
'emerald_dream'=>'world/emerald_dream.html',
'first_war_chronicles'=>'world/first_war_chronicles.html',
'history_and_legends'=>'world/history_and_legends.html',
'twisting_nether'=>'world/twisting_nether.html',
'warcraft_universe'=>'world/warcraft_universe.html',

// Wow transport
'transport'=>'transport/transport.html',
'flight_paths'=>'transport/flight_paths.html',
'mounts'=>'transport/mounts.html',

// Zone faq
'city'=>'zones/city.html',
'zone-stranglethorn_vale'=>'zones/zone-stranglethorn_vale.html',
'zone-westfall'=>'zones/zone-westfall.html',
'zone-dun_morogh'=>'zones/zone-dun_morogh.html',
'zone-duskwood'=>'zones/zone-duskwood.html',
'zone-elwynn_forest'=>'zones/zone-elwynn_forest.html',
'zone-teldrassil'=>'zones/zone-teldrassil.html',

// Instance faq
'inst-hellfire_citadel'=>'inst/inst-hellfire_citadel.html',
'inst-caverns_of_time'=>'inst/inst-caverns_of_time.html',
'inst-karazhan'=>'inst/inst-karazhan.html',
'inst-wailing_caverns'=>'inst/inst-wailing_caverns.html',

// Burning crusade
'bc-outland'=>'bc/bc-outland.html',
'bc-beasts'=>'bc/bc-beasts.html',
'bc-history'=>'bc/bc-history.html',
);

$text = @$faq_list[$faq];
echo "<div class=faq>";
if (!empty($text))
   include($text);
else
   echo "Error";
echo "</div>";
?>