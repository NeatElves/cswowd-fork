<?php

$ls_type_name = array(
'i'=>'Item',
'q'=>'Quest',
'n'=>'NPC',
'g'=>'GO',
's'=>'Spell',
'f'=>'Faction',
'a'=>'Area',
'set'=>'Item Set'
);

//*************** Item enums ************************************
$UseorEquip = array(
'0'=>'Use:',
'1'=>'Equip:',
'2'=>'Chance on hit:',
'4'=>'Soulstone:',
'5'=>'',
'6'=>'Use for learn:'
);

$iBonus = array(
 '0'=>'%d Mana',        // ITEM_MOD_MANA      = 0
 '1'=>'%d Health',      // ITEM_MOD_HEALTH    = 1
 '3'=>'%d Agility',     // ITEM_MOD_AGILITY   = 3
 '4'=>'%d Strength',    // ITEM_MOD_STRENGTH  = 4
 '5'=>'%d Intellect',   // ITEM_MOD_INTELLECT = 5
 '6'=>'%d Spirit',      // ITEM_MOD_SPIRIT    = 6
 '7'=>'%d Stamina',     // ITEM_MOD_STAMINA   = 7
'12'=>'Equip: Increases defense raiting by %d.',              // ITEM_MOD_DEFENSE_SKILL_RATING     = 12
'13'=>'Equip: Increases dodge raiting by %d.',                // ITEM_MOD_DODGE_RATING             = 13
'14'=>'Equip: Increases parry raiting by %d.',                // ITEM_MOD_PARRY_RATING             = 14
'15'=>'Equip: Increases block raiting by %d.',                // ITEM_MOD_BLOCK_RATING             = 15
'16'=>'Equip: Increases melee hit raiting by %d.',            // ITEM_MOD_HIT_MELEE_RATING         = 16
'17'=>'Equip: Increases ranged hit raiting by %d.',           // ITEM_MOD_HIT_RANGED_RATING        = 17
'18'=>'Equip: Increases spell hit raiting by %d.',            // ITEM_MOD_HIT_SPELL_RATING         = 18
'19'=>'Equip: Improves melee critical strike rating by %d.',  // ITEM_MOD_CRIT_MELEE_RATING        = 19
'20'=>'Equip: Improves ranged critical strike rating by %d.', // ITEM_MOD_CRIT_RANGED_RATING       = 20
'21'=>'Equip: Improves spell critical strike rating by %d.',  // ITEM_MOD_CRIT_SPELL_RATING        = 21
'22'=>'Equip: Melee hit taken by %d.',                        // ITEM_MOD_HIT_TAKEN_MELEE_RATING   = 22
'23'=>'Equip: Ranged hit taken by %d.',                       // ITEM_MOD_HIT_TAKEN_RANGED_RATING  = 23
'24'=>'Equip: Spell hit taken by %d.',                        // ITEM_MOD_HIT_TAKEN_SPELL_RATING   = 24
'25'=>'Equip: Melee crit taken by %d.',                       // ITEM_MOD_CRIT_TAKEN_MELEE_RATING  = 25
'26'=>'Equip: Ranged crit taken by %d.',                      // ITEM_MOD_CRIT_TAKEN_RANGED_RATING = 26
'27'=>'Equip: Spell crit taken by %d.',                       // ITEM_MOD_CRIT_TAKEN_SPELL_RATING  = 27
'28'=>'Equip: Melee haste by %d.',                            // ITEM_MOD_HASTE_MELEE_RATING       = 28
'29'=>'Equip: Ranged haste by %d.',                           // ITEM_MOD_HASTE_RANGED_RATING      = 29
'30'=>'Equip: Spell haste by %d.',                            // ITEM_MOD_HASTE_SPELL_RATING       = 30
'31'=>'Equip: Improves hit raiting by %d.',                   // ITEM_MOD_HIT_RATING               = 31
'32'=>'Equip: Improves critical strike rating by %d.',        // ITEM_MOD_CRIT_RATING              = 32
'33'=>'Equip: Hit taken by %d.',                              // ITEM_MOD_HIT_TAKEN_RATING         = 33
'34'=>'Equip: Crit taken by %d.',                             // ITEM_MOD_CRIT_TAKEN_RATING        = 34
'35'=>'Equip: Improves your resilience rating by %d.',        // ITEM_MOD_RESILIENCE_RATING        = 35
'36'=>'Equip: Improves haste raiting by %d.',                 // ITEM_MOD_HASTE_RATING             = 36
'37'=>'Equip: Increases your expertise rating by %d.',        // ITEM_MOD_EXPERTISE_RATING         = 37
'38'=>'Equip: Increases attack power by %d.',                 // ITEM_MOD_ATTACK_POWER             = 38
'39'=>'Equip: Increases ranged attack power by %d.',          // ITEM_MOD_RANGED_ATTACK_POWER      = 39
'40'=>'Equip: Increases attack power by %d in Cat, Bear, Dire Bear, and Moonkin forms only.',// ITEM_MOD_FERAL_ATTACK_POWER       = 40
'41'=>'Equip: Increases healing done by magical spells and effects by up to %d.',            // ITEM_MOD_SPELL_HEALING_DONE       = 41
'42'=>'Equip: Increases damage done by magical spells and effects by up to %d.',             // ITEM_MOD_SPELL_DAMAGE_DONE        = 42
'43'=>'Equip: Restores %d mana per 5 sec.',                   // ITEM_MOD_MANA_REGENERATION        = 43
'44'=>'Equip: Increases your armor penetration rating by %d.',// ITEM_MOD_ARMOR_PENETRATION_RATING = 44
'45'=>'Equip: Increases spell power by %d.'                   // ITEM_MOD_SPELL_POWER              = 45
);

$gInventoryType = array(
'0'=>'All type',
'1'=>'Head',
'2'=>'Neck',
'3'=>'Shoulders',
'4'=>'Shirt',
'5'=>'Chest',
'6'=>'Waist',
'7'=>'Legs',
'8'=>'Feet',
'9'=>'Wrist',
'10'=>'Hands',
'11'=>'Finger',
'12'=>'Trinket',
'13'=>'One-Hand',
'14'=>'Shield',
'15'=>'Ranged',
'16'=>'Back',
'17'=>'Two-Hand',
'18'=>'Bag',
'19'=>'Tabard',
'20'=>'Robe',
'21'=>'Main Hand',
'22'=>'Off Hand',
'23'=>'Holdable',
'24'=>'Ammo',
'25'=>'Thrown',
'26'=>'Ranged',
'27'=>'Quiver',
'28'=>'Relic',
'29'=>'Inventory types',
);

$itemClassSubclass = array(
'-1'=>'All items',
'0'=>'Consumable',
'0.0'=>'Consumable',
'0.1'=>'Potion',
'0.2'=>'Elixir',
'0.3'=>'Flask',
'0.4'=>'Scroll',
'0.5'=>'Food & Drink',
'0.6'=>'Item Enhancement',
'0.7'=>'Bandage',
'0.8'=>'Other',

'1'=>'Container',
'1.0'=>'Bag',
'1.1'=>'Soul Bag',
'1.2'=>'Herb Bag',
'1.3'=>'Enchanting Bag',
'1.4'=>'Engineering Bag',
'1.5'=>'Gem Bag',
'1.6'=>'Mining Bag',
'1.7'=>'Leatherworking Bag',
'1.8'=>'Inscription Bag',

'2'=>'Weapon',
'2.0'=>'Axe:One-Handed Axes',
'2.1'=>'Axe:Two-Handed Axes',
'2.2'=>'Bow:Bows',
'2.3'=>'Gun:Guns',
'2.4'=>'Mace:One-Handed Maces',
'2.5'=>'Mace:Two-Handed Maces',
'2.6'=>'Polearm:Polearms',
'2.7'=>'Sword:One-Handed Swords',
'2.8'=>'Sword:Two-Handed Swords',
'2.9'=>'Obsolete',
'2.10'=>'Staff:Staves',
'2.11'=>'Exotic:One-Handed Exotics',
'2.12'=>'Exotic:Two-Handed Exotics',
'2.13'=>'Fist Weapon:Fist Weapons',
'2.14'=>'Miscellaneous',
'2.15'=>'Dagger:Daggers',
'2.16'=>'Thrown:Thrown',
'2.17'=>'Spear:Spears',
'2.18'=>'Crossbow:Crossbows',
'2.19'=>'Wand:Wands',
'2.20'=>'Fishing Pole:Fishing Poles',

'3'=>'Gem',
'3.0'=>'Red',
'3.1'=>'Blue',
'3.2'=>'Yellow',
'3.3'=>'Purple',
'3.4'=>'Green',
'3.5'=>'Orange',
'3.6'=>'Meta',
'3.7'=>'Simple',
'3.8'=>'Prismatic',

'4'=>'Armor',
'4.0'=>'Miscellaneous',
'4.1'=>'Cloth:Cloth',
'4.2'=>'Leather:Leather',
'4.3'=>'Mail:Mail',
'4.4'=>'Plate:Plate',
'4.5'=>'Buckler(OBSOLETE):Bucklers',
'4.6'=>'Shield:Shields',
'4.7'=>'Libram:Librams',
'4.8'=>'Idol:Idols',
'4.9'=>'Totem:Totems',
'4.10'=>'Sigil:Sigils',

'5'=>'Reagent',
'5.0'=>'Reagent',

'6'=>'Projectile',
'6.0'=>'Wand(OBSOLETE)',
'6.1'=>'Bolt(OBSOLETE)',
'6.2'=>'Arrow',
'6.3'=>'Bullet',
'6.4'=>'Thrown(OBSOLETE)',

'7'=>'Trade Goods',
'7.0'=>'Trade Goods',
'7.1'=>'Parts',
'7.2'=>'Explosives',
'7.3'=>'Devices',
'7.4'=>'Jewelcrafting',
'7.5'=>'Cloth',
'7.6'=>'Leather',
'7.7'=>'Metal & Stone',
'7.8'=>'Meat',
'7.9'=>'Herb',
'7.10'=>'Elemental',
'7.11'=>'Other',
'7.12'=>'Enchanting',
'7.13'=>'Materials',
'7.14'=>'Armor Enchantment:Armor Enchantment',
'7.15'=>'Weapon Enchantment:Weapon Enchantment',

'8'=>'Generic',
'8.0'=>'Generic',

'9'=>'Recipe',
'8.0'=>'Generic(OBSOLETE)',
'9.0'=>'Book',
'9.1'=>'Leatherworking',
'9.2'=>'Tailoring',
'9.3'=>'Engineering',
'9.4'=>'Blacksmithing',
'9.5'=>'Cooking',
'9.6'=>'Alchemy',
'9.7'=>'First Aid',
'9.8'=>'Enchanting',
'9.9'=>'Fishing',
'9.10'=>'Jewelcrafting',

'10'=>'Money',
'10.0'=>'Money(OBSOLETE)',

'11'=>'Quiver',
'11.0'=>'Quiver(OBSOLETE)',
'11.1'=>'Quiver(OBSOLETE)',
'11.2'=>'Quiver',
'11.3'=>'Ammo Pouch',

'12'=>'Quest',
'12.0'=>'Quest',

'13'=>'Key & Lockpick',
'13.0'=>'Key',
'13.1'=>'Lockpick',

'14'=>'Permanent',
'14.0'=>'Permanent',

'15'=>'Misc',
'15.0'=>'Junk',
'15.1'=>'Reagent',
'15.2'=>'Pet',
'15.3'=>'Holiday',
'15.4'=>'Other',
'15.5'=>'Mount:Mount',

'16'=>'Glyph',
'16.1'=>'Warrior:Warrior',
'16.2'=>'Paladin:Paladin',
'16.3'=>'Hunter:Hunter',
'16.4'=>'Rogue:Rogue',
'16.5'=>'Priest:Priest',
'16.6'=>'Death Knight:Death Knight',
'16.7'=>'Shaman:Shaman',
'16.8'=>'Mage:Mage',
'16.9'=>'Warlock:Warlock',
'16.11'=>'Druid:Druid',
);

$gBonding = array(
'-1'=>'Soulbound',
'0'=>'',
'1'=>'Binds when picked up',
'2'=>'Binds when equipped',
'3'=>'Binds when used',
'4'=>'Quest Item',
'5'=>'Quest Item 1',
);

$gStatType = array(
'-1'=>'All stats',
'0'=>'Strength',
'1'=>'Agility',
'2'=>'Stamina',
'3'=>'Intellect',
'4'=>'Spirit'
);

$gResistance = array(
'0'=>'Armor',
'1'=>'Holy Resistance',
'2'=>'Fire Resistance',
'3'=>'Nature Resistance',
'4'=>'Frost Resistance',
'5'=>'Shadow Resistance',
'6'=>'Arcane Resistance'
);

$gResistanceType = array(
'0'=>'%d Armor',
'1'=>'%d Holy Resistance',
'2'=>'%d Fire Resistance',
'3'=>'%d Nature Resistance',
'4'=>'%d Frost Resistance',
'5'=>'%d Shadow Resistance',
'6'=>'%d Arcane Resistance'
);

$gLockType = array(
'1'=>'Lockpicking',
'2'=>'Herbalism',
'3'=>'Mining',
'4'=>'Disarm Trap',
'5'=>'Open',
'6'=>'Treasure (DND)',
'7'=>'Calcified Elven Gems (DND)',
'8'=>'Close',
'9'=>'Arm Trap',
'10'=>'Quick Open',
'11'=>'Quick Close',
'12'=>'Open Tinkering',
'13'=>'Open Kneeling',
'14'=>'Open Attacking',
'15'=>'Gahz`ridian (DND)',
'16'=>'Blasting',
'17'=>'PvP Open',
'18'=>'PvP Close',
'19'=>'Fishing (DND)',
'20'=>'Inscription',
'21'=>'Open From Vehicle'
);
//***************** Gameobject enums ***********************************
$gameobjectType = array(
'0'=>'Door',
'1'=>'Button',
'2'=>'Questgiver',
'3'=>'Chest',
'4'=>'Binder',
'5'=>'Generic',
'6'=>'Trap',
'7'=>'Chair',
'8'=>'Spellfocus',
'9'=>'Text',
'10'=>'Gobber',
'11'=>'Transport',
'12'=>'Areadamage',
'13'=>'Camera',
'14'=>'Map Object',
'15'=>'Map Object Transport',
'16'=>'Duel Arbiter',
'17'=>'Fishing Node',
'18'=>'Summoning portal',
'19'=>'Mailbox',
'20'=>'Auction House',
'21'=>'Guardpost',
'22'=>'Spellcaster',
'23'=>'Meetingstone',
'24'=>'Flag Stand',
'25'=>'Fishing hole',
'26'=>'Flag drop',
'27'=>'Minigame',
'28'=>'Lottery Kiosk',
'29'=>'Capture point',
'30'=>'Aura Generator',
'31'=>'Dungeon Difficulty',
'32'=>'Barbershop Chair',
'33'=>'Destructable building',
'34'=>'Guild Bank'
);

// Players enums
$gReputationRank = array(
'0'=>'Hated',
'1'=>'Hostile',
'2'=>'Unfriendly',
'3'=>'Neutral',
'4'=>'Friendly',
'5'=>'Honored',
'6'=>'Revered',
'7'=>'Exalted',
);

$gGenderType = array(
'0'=>'Male',
'1'=>'Female',
);

$gFactionType = array(
'0'=>'Horde',
'1'=>'Alliance',
);

$gRaceType = array(
'0'=>'none',
'1'=>'Human',
'2'=>'Orc',
'3'=>'Dwarf',
'4'=>'Night Elf',
'5'=>'Undead',
'6'=>'Tauren',
'7'=>'Gnome',
'8'=>'Troll',
'9'=>'Goblin',
'10'=>'Blood Elf',
'11'=>'Draenei',
'12'=>'Fel Orc',
'13'=>'Naga',
'14'=>'Brocen',
'15'=>'Skeleton',
'16'=>'Vrykul',
'17'=>'Tyskarr',
'18'=>'Forest Troll',
'19'=>'Taunka',
'20'=>'Northrend Skeleton',
'21'=>'Ice Troll'
);

$gClassType = array(
'0'=>'none',
'1'=>'Warrior',
'2'=>'Paladin',
'3'=>'Hunter',
'4'=>'Rogue',
'5'=>'Priest',
'6'=>'Death Knight',
'7'=>'Shaman',
'8'=>'Mage',
'9'=>'Warlock',
'10'=>'FUTURE_2',
'11'=>'Druid'
);

$gTalentTabName = array(
'41'=>'Fire',
'61'=>'Frost',
'81'=>'Arcane',
'161'=>'Arms',
'163'=>'Protection',
'164'=>'Fury',
'181'=>'Combat',
'182'=>'Assassination',
'183'=>'Subtlety',
'201'=>'Discipline',
'202'=>'Holy',
'203'=>'Shadow',
'261'=>'Elemental',
'262'=>'Restoration',
'263'=>'Enhancement',
'281'=>'Feral Combat',
'282'=>'Restoration',
'283'=>'Balance',
'301'=>'Destruction',
'302'=>'Affliction',
'303'=>'Demonology',
'361'=>'Beast Mastery',
'362'=>'Survival',
'363'=>'Marksmanship',
'381'=>'Retribution',
'382'=>'Holy',
'383'=>'Protection',
'398'=>'Blood',
'399'=>'Frost',
'400'=>'Unholy',
'409'=>'Tenacity',
'410'=>'Ferocity',
'411'=>'Cunning'
);

$gSkillCategory = array(
 '5'=>'Attributes',
 '6'=>'Weapon Skills',
 '7'=>'Class Skills',
 '8'=>'Armor Proficiencies',
 '9'=>'Secondary Skills',
'10'=>'Languages',
'11'=>'Professions',
'12'=>'Not Displayed'
);

$gSkillRank = array(
 '1'=>'Apprentice',
 '2'=>'Journeyman',
 '3'=>'Expert',
 '4'=>'Artisan',
 '5'=>'Master',
 '6'=>'Grand Master'
);

// Quest enums
$gQuestType = array(
'0'=>'All type',
'1'=>'Group',
'21'=>'Life',
'41'=>'PvP',
'62'=>'Raid',
'81'=>'Dungeon',
'82'=>'World Event',
'83'=>'Legendary',
'84'=>'Escort',
'85'=>'Heroic',
'88'=>'Raid (10)',
'89'=>'Raid (25)'
);

$gQuestSort = array(
'0'=>'All sort',
'1'=>'Epic',
'21'=>'REUSE - old wailing caverns',
'22'=>'Seasonal',
'23'=>'REUSE - old undercity one',
'24'=>'Herbalism',
'25'=>'Battlegrounds',
'41'=>'REUSE - old uldaman',
'61'=>'Warlock',
'81'=>'Warrior',
'82'=>'Shaman',
'101'=>'Fishing',
'121'=>'Blacksmithing',
'141'=>'Paladin',
'161'=>'Mage',
'162'=>'Rogue',
'181'=>'Alchemy',
'182'=>'Leatherworking',
'201'=>'Engineering',
'221'=>'Treasure Map',
'241'=>'Tournament',
'261'=>'Hunter',
'262'=>'Priest',
'263'=>'Druid',
'264'=>'Tailoring',
'284'=>'Special',
'304'=>'Cooking',
'324'=>'First Aid',
'344'=>'Legendary',
'364'=>'Darkmoon Faire',
'365'=>'Ahn`Qiraj War',
'366'=>'Lunar Festival',
'367'=>'Reputation',
'368'=>'Invasion',
'369'=>'Midsummer',
'370'=>'Brewfest',
'371'=>'Inscription',
'372'=>'Death Knight',
'373'=>'Jevelcrafting',
'374'=>'Noblegarden'
);

// Creatures enums
$gCreatureType = array(
'0'=>'none',
'1'=>'Beast',
'2'=>'Dragonkin',
'3'=>'Demon',
'4'=>'Elemental',
'5'=>'Giant',
'6'=>'Undead',
'7'=>'Humanoid',
'8'=>'Critter',
'9'=>'Mechanical',
'10'=>'Not specified',
'11'=>'Totem',
'12'=>'Non-combat Pet',
'13'=>'Gas Cloud'
);

$gCreatureRank=array(
'0'=>'Normal',
'1'=>'Rare',
'2'=>'Elite',
'3'=>'Boss',
'4'=>'World Boss',
);

$gCreatureFamily=array(
'1'=>'Wolf',
'2'=>'Cat',
'3'=>'Spider',
'4'=>'Bear',
'5'=>'Boar',
'6'=>'Crocolisk',
'7'=>'Carrion Bird',
'8'=>'Crab',
'9'=>'Gorilla',
'11'=>'Raptor',
'12'=>'Tallstrider',
'15'=>'Felhunter',
'16'=>'Voidwalker',
'17'=>'Succubus',
'19'=>'Doomguard',
'20'=>'Scorpid',
'21'=>'Turtle',
'23'=>'Imp',
'24'=>'Bat',
'25'=>'Hyena',
'26'=>'Bird of Prey',
'27'=>'Wind Serpent',
'28'=>'Remote Control',
'29'=>'Felguard',
'30'=>'Dragonhawk',
'31'=>'Ravager',
'32'=>'Warp Stalker',
'33'=>'Sporebat',
'34'=>'Nether Ray',
'35'=>'Serpent',
'37'=>'Moth',
'38'=>'Chimera',
'39'=>'Devilsaur',
'40'=>'Ghoul',
'41'=>'Silithid',
'42'=>'Worm',
'43'=>'Rhino',
'44'=>'Wasp',
'45'=>'Core Hound',
'46'=>'Spirit Beast'
);

$gCreatureFlags = array(
 '0'=>'Gossip',
 '1'=>'QuestGiver',
 '2'=>'Unk2',
 '3'=>'Unk3',
 '4'=>'Trainer',
 '5'=>'Class Trainer',
 '6'=>'Profession Trainer',
 '7'=>'Vendor',
 '8'=>'Vendor Ammo',
 '9'=>'Vendor Food',
'10'=>'Vendor Poison',
'11'=>'Vendor Reagent',
'12'=>'Repair',
'13'=>'Flightmaster',
'14'=>'Spirit Healer',
'15'=>'Spirit Guide',
'16'=>'Innkeeper',
'17'=>'Banker',
'18'=>'Petitioner',
'19'=>'Tabard Designer',
'20'=>'Battlemaster',
'21'=>'Auctioneer',
'22'=>'Stablemaster',
'23'=>'Guild Banker',
'24'=>'Spell Click',
'25'=>'Unk25',
'26'=>'Unk26',
'27'=>'Unk27',
'28'=>'Guard',
'29'=>'Unk29',
'30'=>'Unk30',
'31'=>'Unk31',
);

// Spells
$gSpellModsType = array(
'Damage/Healing',              // 0,
'Duration',                    // 1,
'Threat',                      // 2,
'Effect 1',                    // 3,
'Charges',                     // 4,
'Range',                       // 5,
'Radius',                      // 6,
'Critical Chance',             // 7,
'All Effects',                 // 8,
'Not Lose Casting Time',       // 9,
'Casting Time',                // 10,
'Cooldown',                    // 11,
'Effect 2',                    // 12,
'13',                          // spellmod 13 unused
'Power Cost',                  // 14,
'Crit Damage Bonus',           // 15,
'Resist/Miss Chance',          // 16,
'Extra Targets',               // 17,
'Chance of Success',           // 18,
'Activation Time',             // 19,
'Mod Damage Multipler',        // 20,
'Casting Time new',            // 21,
'DOT',                         // 22,
'Effect 3',                    // 23,
'Spell Damage/Healing bonus',  // 24,
'25',                          //
'26',                          // spellmod 25, 26 unused
'Multiple Value',              // 27,
'Resist Dispell'               // 28
);

$gSpellDispelType = array(
'0'=>'n/a',
'1'=>'Magic',
'2'=>'Curse',
'3'=>'Disease',
'4'=>'Poison',
'5'=>'Stealth',
'6'=>'Invisibility',
'7'=>'Magic+Curse+Disease+Poison',
'8'=>'Special - npc only',
'9'=>'Frenzy',
'10'=>'ZG Trinkets'
);

$gRuneName = array(
'0'=>'Blood',
'1'=>'Unholy',
'2'=>'Frost',
'3'=>'Death'
);

$gSpellMechanic = array(
'0'=>'n/a',
'1'=>'Charmed',
'2'=>'Disoriented',
'3'=>'Disarmed',
'4'=>'Distracted',
'5'=>'Fleeing',
'6'=>'Clumsy',
'7'=>'Rooted',
'8'=>'Pacified',
'9'=>'Silenced',
'10'=>'Asleep',
'11'=>'Ensnared',
'12'=>'Stunned',
'13'=>'Frozen',
'14'=>'Incapacitated',
'15'=>'Bleeding',
'16'=>'Healing',
'17'=>'Polymorphed',
'18'=>'Banished',
'19'=>'Shielded',
'20'=>'Shackled',
'21'=>'Mounted',
'22'=>'Seduced',
'23'=>'Turned',
'24'=>'Horrified',
'25'=>'Invulnerable',
'26'=>'Interrupted',
'27'=>'Dazed',
'28'=>'Discovery',
'29'=>'Invulnerable',
'30'=>'Sapped',
'31'=>'Enraged'
);

$gLaungage = array(
'1'=>'Orcish',
'2'=>'Darnassian',
'3'=>'Taurahe',
'6'=>'Dwarvish',
'7'=>'Common',
'8'=>'Demonic',
'9'=>'Titan',
'10'=>'Thalassian',
'11'=>'Draconic',
'12'=>'Kalimag',
'13'=>'Gnomish',
'14'=>'Troll',
'33'=>'Gutterspeak',
'35'=>'Draenei',
'36'=>'Zombie',
'37'=>'Gnomish Binary',
'38'=>'Goblin Binary'
);

$gDmgClass = array(
'0'=>'None',
'1'=>'Magic',
'2'=>'Melee',
'3'=>'Ranged'
);

$gSpellSchool = array(
'0'=>'Physical',
'1'=>'Holy',
'2'=>'Fire',
'3'=>'Nature',
'4'=>'Frost',
'5'=>'Shadow',
'6'=>'Arcane'
);

$gSpellRangeIndex = array(
'1'=>array(0,0,'Self Only'),
'2'=>array(0,5,'Combat Range'),
'3'=>array(0,20,'Twenty yards'),
'4'=>array(0,30,'Medium Range'),
'5'=>array(0,40,'Long Range'),
'6'=>array(0,100,'Vision Range'),
'7'=>array(0,10,'Ten yards'),
'8'=>array(10,20,'Min Range 10, 20'),
'9'=>array(10,30,'Medium Range'),
'10'=>array(10,40,'Long Range'),
'11'=>array(0,15,'Fifteen yards'),
'12'=>array(0,5,'Interact Range'),
'13'=>array(0,50000,'Anywhere'),
'14'=>array(0,60,'Extra Long Range'),
'34'=>array(0,25,'Twenty-Five yards'),
'35'=>array(0,35,'Medium-Long Range'),
'36'=>array(0,45,'Longer Range'),
'37'=>array(0,50,'Extended Range'),
'38'=>array(10,25,'Min-Range 10, 25'),
'54'=>array(5,30,'Monster Shoot'),
'74'=>array(0,30,'Ranged Weapon'),
'94'=>array(8,40,'Sting'),
'95'=>array(8,25,'Charge'),
'96'=>array(0,2,'Trap'),
'114'=>array(0,35,'Hunter Range'),
'134'=>array(0,80,'Tower 80'),
'135'=>array(0,100,'Tower 100'),
'136'=>array(30,80,'Thirty-to-80'),
'137'=>array(0,8,'Eight yards'),
'139'=>array(5,45,'Long Range Hunter Shoot'),
'140'=>array(0,6,'Six yards'),
'141'=>array(0,7,'Seven yards'),
'150'=>array(8,100,'Valgarde 8/100'),
'151'=>array(5,45,'Long Range Hunter Shoot'),
'152'=>array(0,150,'Super Long'),
'153'=>array(0,60,'Charge, 60'),
'154'=>array(10,80,'Tower 80, 10'),
'155'=>array(4,35,'Hunter Range (TEST)'),
'156'=>array(30,100,'Boulder Range'),
'157'=>array(0,90,'Ninety'),
'158'=>array(15,150,'Super Long; 15 Min'),
'159'=>array(0,100,'TEST - Long Range'),
'160'=>array(0,40,'Medium/Long Range'),
'161'=>array(0,40,'Short/Long Range'),
'162'=>array(0,30,'Medium/Short Range'),
'163'=>array(8,30,'Death Grip'),
'164'=>array(10,70,'Catapult Range'),
'165'=>array(0,14,'Fourteen yards'),
'166'=>array(0,13,'Thirteen yards'),
'167'=>array(40,150,'Super Long (Min Range)'),
'168'=>array(0,38,'Medium-Long Range (38)'),
'169'=>array(0,3,'Three Yards'),
'170'=>array(0,55,'Fifty Five Yards'),
'171'=>array(5,10,'Min Range 5; 10'),
'172'=>array(0,11,'Eleven yards'),
'173'=>array(5,50000,'Anywhere (Combat Min Range)'),
'174'=>array(0,1000,'U L T R A')
);

$gTotemCategory = array(
'1'=>'Skinning Knife (OLD)',
'2'=>'Earth Totem',
'3'=>'Air Totem',
'4'=>'Fire Totem',
'5'=>'Water Totem',
'6'=>'Runed Copper Rod',
'7'=>'Runed Silver Rod',
'8'=>'Runed Golden Rod',
'9'=>'Runed Truesilver Rod',
'10'=>'Runed Arcanite Rod',
'11'=>'Mining Pick (OLD)',
'12'=>'Philosopher\'s Stone',
'13'=>'Blacksmith Hammer (OLD)',
'14'=>'Arclight Spanner',
'15'=>'Gyromatic Micro-Adjustor',
'21'=>'Master Totem',
'41'=>'Runed Fel Iron Rod',
'62'=>'Runed Adamantite Rod',
'63'=>'Runed Eternium Rod',
'81'=>'Hollow Quill',
'101'=>'Runed Azurite Rod',
'121'=>'Virtuoso Inking Set',
'141'=>'Drums',
'161'=>'Gnomish Army Knife',
'162'=>'Blacksmith Hammer',
'165'=>'Mining Pick',
'166'=>'Skinning Knife',
'167'=>'Hammer Pick',
'168'=>'Bladed Pickaxe',
'169'=>'Flint and Tinder',
'189'=>'Runed Cobalt Rod',
'190'=>'Runed Titanium Rod'
);

$gSpellSnapeshiftForm = array(
'1'=>'Cat Form',
'2'=>'Tree of Life Form',
'3'=>'Travel Form',
'4'=>'Aquatic Form',
'5'=>'Bear Form',
'6'=>'Ambient',
'7'=>'Ghoul',
'8'=>'Dire Bear Form',
'14'=>'Creature - Bear',
'15'=>'Creature - Cat',
'16'=>'Ghost Wolf',
'17'=>'Battle Stance',
'18'=>'Defensive Stance',
'19'=>'Berserker Stance',
'20'=>'Test',
'21'=>'Zombie',
'22'=>'Demon Form',
'25'=>'Undead',
'27'=>'Flight Form, Epic',
'28'=>'Shadowform',
'29'=>'Flight Form',
'30'=>'Stealth',
'31'=>'Moonkin Form',
'32'=>'Spirit of Redemption'
);

$gSpellPowerType = array(
'-1'=>'Health',
'0'=>'Mana',
'1'=>'Rage',
'2'=>'Focus',
'3'=>'Energy',
'4'=>'Happyness',
'6'=>'Runic power'
);

$gTargetsList = array(
'0'=>'Spell depend',     // 0x00000      0
'1'=>'Target 1',         // 0x00001      1
'2'=>'Target 2',         // 0x00002      2
'3'=>'Target 3',         // 0x00004      4
'4'=>'Target 4',         // 0x00008      8
'5'=>'Item',             // 0x00010     16
'6'=>'Source Location',  // 0x00020     32
'7'=>'Dest Location',    // 0x00040     64
'8'=>'Object unk',       // 0x00080    128
'9'=>'Target 9',         // 0x00100    256
'10'=>'PVP Corpse',      // 0x00200    512
'11'=>'Target 11',       // 0x00400   1024
'12'=>'Object',          // 0x00800   2048
'13'=>'Trade Item',      // 0x01000   4096
'14'=>'String',          // 0x02000   8192
'15'=>'Object',          // 0x04000  16384
'16'=>'Dead body',       // 0x08000  32768
'17'=>'Target 17'        // 0x10000  65536
);

$gRatingNames = array(
'1'=>'Weapon skill',
'2'=>'Defence skill',
'3'=>'Dodge',
'4'=>'Parry',
'5'=>'Block',
'6'=>'Melee hit',
'7'=>'Ranged hit',
'8'=>'Spell hit',
'9'=>'Melee crit',
'10'=>'Ranged crit',
'11'=>'Spell crit',
'12'=>'Melee hit taken',
'13'=>'Ranged hit taken',
'14'=>'Spell hit taken',
'15'=>'Melee crit taken',
'16'=>'Ranged crit taken',
'17'=>'Spell crit taken',
'18'=>'Melee haste',
'19'=>'Ranged haste',
'20'=>'Spell haste',
'18'=>'Weapon skill',
'19'=>'Ranged haste',
'20'=>'Spell haste',
'21'=>'Weapon skill mainhand',
'22'=>'Ranged skill offhand',
'23'=>'Spell skill renged',
'24'=>'Expertise',
'25'=>'Armor Penetration'
);

$gSpellFamilyName = array(
'0'=>'n/a',
'3'=>'Mage',
'4'=>'Warrior',
'5'=>'Warlock',
'6'=>'Priest',
'7'=>'Druid',
'8'=>'Rogue',
'9'=>'Hunter',
'10'=>'Paladin',
'11'=>'Shaman',
'13'=>'Items',
'15'=>'Death Knight'
);

$gMapName = array(
'0'=>'Eastern Kingdoms',
'1'=>'Kalimdor',
'13'=>'Testing',
'25'=>'Scott Test',
'29'=>'CashTest',
'30'=>'Alterac Valley',
'33'=>'Shadowfang Keep',
'34'=>'Stormwind Stockade',
'35'=>'<unused>StormwindPrison',
'36'=>'Deadmines',
'37'=>'Azshara Crater',
'42'=>'Collin\'s Test',
'43'=>'Wailing Caverns',
'44'=>'<unused> Monastery',
'47'=>'Razorfen Kraul',
'48'=>'Blackfathom Deeps',
'70'=>'Uldaman',
'90'=>'Gnomeregan',
'109'=>'Sunken Temple',
'129'=>'Razorfen Downs',
'169'=>'Emerald Dream',
'189'=>'Scarlet Monastery',
'209'=>'Zul\'Farrak',
'229'=>'Blackrock Spire',
'230'=>'Blackrock Depths',
'249'=>'Onyxia\'s Lair',
'269'=>'Opening of the Dark Portal',
'289'=>'Scholomance',
'309'=>'Zul\'Gurub',
'329'=>'Stratholme',
'349'=>'Maraudon',
'369'=>'Deeprun Tram',
'389'=>'Ragefire Chasm',
'409'=>'Molten Core',
'429'=>'Dire Maul',
'449'=>'Alliance PVP Barracks',
'450'=>'Horde PVP Barracks',
'451'=>'Development Land',
'469'=>'Blackwing Lair',
'489'=>'Warsong Gulch',
'509'=>'Ruins of Ahn\'Qiraj',
'529'=>'Arathi Basin',
'530'=>'Outland',
'531'=>'Ahn\'Qiraj Temple',
'532'=>'Karazhan',
'533'=>'Naxxramas',
'534'=>'The Battle for Mount Hyjal',
'540'=>'Hellfire Citadel: The Shattered Halls',
'542'=>'Hellfire Citadel: The Blood Furnace',
'543'=>'Hellfire Citadel: Ramparts',
'544'=>'Magtheridon\'s Lair',
'545'=>'Coilfang: The Steamvault',
'546'=>'Coilfang: The Underbog',
'547'=>'Coilfang: The Slave Pens',
'548'=>'Coilfang: Serpentshrine Cavern',
'550'=>'Tempest Keep',
'552'=>'Tempest Keep: The Arcatraz',
'553'=>'Tempest Keep: The Botanica',
'554'=>'Tempest Keep: The Mechanar',
'555'=>'Auchindoun: Shadow Labyrinth',
'556'=>'Auchindoun: Sethekk Halls',
'557'=>'Auchindoun: Mana-Tombs',
'558'=>'Auchindoun: Auchenai Crypts',
'559'=>'Nagrand Arena',
'560'=>'The Escape From Durnholde',
'562'=>'Blade\'s Edge Arena',
'564'=>'Black Temple',
'565'=>'Gruul\'s Lair',
'566'=>'Eye of the Storm',
'568'=>'Zul\'Aman',
'571'=>'Northrend',
'572'=>'Ruins of Lordaeron',
'573'=>'ExteriorTest',
'574'=>'Utgarde Keep',
'575'=>'Utgarde Pinnacle',
'576'=>'The Nexus',
'578'=>'The Oculus',
'580'=>'The Sunwell',
'582'=>'Transport: Rut\'theran to Auberdine',
'584'=>'Transport: Menethil to Theramore',
'585'=>'Magister\'s Terrace',
'586'=>'Transport: Exodar to Auberdine',
'587'=>'Transport: Feathermoon Ferry',
'588'=>'Transport: Menethil to Auberdine',
'589'=>'Transport: Orgrimmar to Grom\'Gol',
'590'=>'Transport: Grom\'Gol to Undercity',
'591'=>'Transport: Undercity to Orgrimmar',
'592'=>'Transport: Borean Tundra Test',
'593'=>'Transport: Booty Bay to Ratchet',
'594'=>'Transport: Howling Fjord Sister Mercy (Quest)',
'595'=>'The Culling of Stratholme',
'596'=>'Transport: Naglfar',
'597'=>'Craig Test',
'598'=>'Sunwell Fix (Unused)',
'599'=>'Halls of Stone',
'600'=>'Drak\'Tharon Keep',
'601'=>'Azjol-Nerub',
'602'=>'Halls of Lightning',
'603'=>'Ulduar',
'604'=>'Gundrak',
'605'=>'Development Land (non-weighted textures)',
'606'=>'QA and DVD',
'607'=>'Strand of the Ancients',
'608'=>'Violet Hold',
'609'=>'Ebon Hold',
'610'=>'Transport: Tirisfal to Vengeance Landing',
'612'=>'Transport: Menethil to Valgarde',
'613'=>'Transport: Orgrimmar to Warsong Hold',
'614'=>'Transport: Stormwind to Valiance Keep',
'615'=>'The Obsidian Sanctum',
'616'=>'The Eye of Eternity',
'617'=>'Dalaran Sewers',
'618'=>'The Ring of Valor',
'619'=>'Ahn\'kahet: The Old Kingdom',
'620'=>'Transport: Moa\'ki to Unu\'pe',
'621'=>'Transport: Moa\'ki to Kamagua',
'622'=>'Transport: Orgrim\'s Hammer',
'623'=>'Transport: The Skybreaker',
'624'=>'Wintergrasp Raid'
);

$game_text = array(
// Item tooltip
'meta_socket'=>'Meta Socket',
'red_socket'=>'Red Socket',
'yellow_socket'=>'Yellow Socket',
'blue_socket'=>'Blue Socket',
'charges'=>'%d Charges',
'min'=>'min',
'conjured_item'=>'Conjured Item',
'right_click'=>'Right Click to Open',
'unique'=>'Unique',
'slot'=>'%d Slot %s',
'weapon_damage'=>'%d - %d Damage',
'weapon_speed'=>'Speed %2.2f',
'weapon_dps'=>'(%2.2f damage per second)',
'ammo_dps'=>'Adds %2.2f damage per second',

'socket_bonus'=>'Socket Bonus: %s',
'random_enchant'=>'&lt;Random enchantment&gt;',
'prospectable'=>'Prospectable',
'millable'=>'Millable',
'ssd_req_level'=>'Requires level 1 to %d (%d)',
'durability'=>'Durability %d / %d',
'allowable_race'=>'Races:',
'allowable_class'=>'Classes:',
'req_level'=>'Requires Level %d',
'req_skill'=>'Requires %s (%d)',
'req_spell'=>'Requires',
'req_reputation'=>'Requires: %s - %s',
'req_ingridients'=>'Requires:',
'made_by'=>'Made by %s',
'start_quest'=>'This item start quest',

'entry'=>'Entry',
'locked'=>'Locked',
'faction'=>'Faction',
'go_type'=>'Type',

'npc_type'=>'Type',
'npc_rank'=>'Rank',
'npc_family'=>'Family',
'npc_level'=>'Level',
'npc_health'=>'Health',
'npc_mana'=>'Mana',
'npc_armor'=>'Armor',
'npc_damage'=>'Damage',
'npc_ap'=>'Attack Power',
'npc_attack'=>'Attack Time',
'display'=>'Display',
'displayA'=>'Display A',
'displayH'=>'Display H',
'npc_script'=>'Script',

'talent_rank'=>'Rank',
'talent_next_rank'=>'Next rank:',
'talent_req_points'=>'Require <num> points in <name> tree',

'other_faction'=>'Other',
);
?>