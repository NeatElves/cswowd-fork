ALTER TABLE `wowd_spell` CHANGE `unk_320_1` `AttributesEx7` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `casterAuraSpell` `CasterAuraSpell` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `targetAuraSpell` `TargetAuraSpell` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `excludeCasterAuraSpell` `ExcludeCasterAuraSpell` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `excludeTargetAuraSpell` `ExcludeTargetAuraSpell` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `procFlags` `ProcFlags` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `procChance` `ProcChance` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `procCharges` `ProcCharges` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `maxLevel` `MaxLevel` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `baseLevel` `BaseLevel` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `spellLevel` `SpellLevel` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `DurationIndex` `DurationIndex` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `powerType` `PowerType` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `manaCost` `ManaCost` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `manaCostPerlevel` `ManaCostPerlevel` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `manaPerSecond` `ManaPerSecond` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `manaPerSecondPerLevel` `ManaPerSecondPerLevel` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `rangeIndex` `RangeIndex` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `Totem_1` `Totem1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `Totem_2` `Totem2` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `TotemCategory_1` `TotemCategory1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `TotemCategory_2` `TotemCategory2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `AreaGroupId` `AreaId` INT(10) NULL DEFAULT '0',
CHANGE `runeCostID` `RuneCostID` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `Reagent_1` `Reagent1` INT(10) NULL DEFAULT '0',
CHANGE `Reagent_2` `Reagent2` INT(10) NULL DEFAULT '0',
CHANGE `Reagent_3` `Reagent3` INT(10) NULL DEFAULT '0',
CHANGE `Reagent_4` `Reagent4` INT(10) NULL DEFAULT '0',
CHANGE `Reagent_5` `Reagent5` INT(10) NULL DEFAULT '0',
CHANGE `Reagent_6` `Reagent6` INT(10) NULL DEFAULT '0',
CHANGE `Reagent_7` `Reagent7` INT(10) NULL DEFAULT '0',
CHANGE `Reagent_8` `Reagent8` INT(10) NULL DEFAULT '0',
CHANGE `ReagentCount_1` `ReagentCount1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `ReagentCount_2` `ReagentCount2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `ReagentCount_3` `ReagentCount3` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `ReagentCount_4` `ReagentCount4` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `ReagentCount_5` `ReagentCount5` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `ReagentCount_6` `ReagentCount6` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `ReagentCount_7` `ReagentCount7` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `ReagentCount_8` `ReagentCount8` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `EffectBasePoints_1` `EffectBaseDice1` INT(10) NULL DEFAULT '0',
CHANGE `EffectBasePoints_2` `EffectBaseDice2` INT(10) NULL DEFAULT '0',
CHANGE `EffectBasePoints_3` `EffectBaseDice3` INT(10) NULL DEFAULT '0',
CHANGE `EffectMechanic_1` `EffectMechanic1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectMechanic_2` `EffectMechanic2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectMechanic_3` `EffectMechanic3` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `Effect_1` `Effect1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `Effect_2` `Effect2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `Effect_3` `Effect3` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectDieSides_1` `EffectDieSides1` INT(10) NULL DEFAULT '0',
CHANGE `EffectDieSides_2` `EffectDieSides2` INT(10) NULL DEFAULT '0',
CHANGE `EffectDieSides_3` `EffectDieSides3` INT(10) NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `EffectRealPointsPerLevel_1` `EffectRealPointsPerLevel1` FLOAT NULL DEFAULT '0',
CHANGE `EffectRealPointsPerLevel_2` `EffectRealPointsPerLevel2` FLOAT NULL DEFAULT '0',
CHANGE `EffectRealPointsPerLevel_3` `EffectRealPointsPerLevel3` FLOAT NULL DEFAULT '0',
CHANGE `SpellVisual_1` `SpellVisual` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `SpellVisual_2` `SpellVisual2` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `EffectItemType_1` `EffectItemType1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectItemType_2` `EffectItemType2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectItemType_3` `EffectItemType3` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `EffectImplicitTargetA_1` `EffectImplicitTargetA1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectImplicitTargetA_2` `EffectImplicitTargetA2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectImplicitTargetA_3` `EffectImplicitTargetA3` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectImplicitTargetB_1` `EffectImplicitTargetB1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectImplicitTargetB_2` `EffectImplicitTargetB2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectImplicitTargetB_3` `EffectImplicitTargetB3` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `EffectRadiusIndex_1` `EffectRadiusIndex1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectRadiusIndex_2` `EffectRadiusIndex2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectRadiusIndex_3` `EffectRadiusIndex3` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectApplyAuraName_1` `EffectApplyAuraName1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectApplyAuraName_2` `EffectApplyAuraName2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectApplyAuraName_3` `EffectApplyAuraName3` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `EffectAmplitude_1` `EffectAmplitude1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectAmplitude_2` `EffectAmplitude2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectAmplitude_3` `EffectAmplitude3` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectMultipleValue_1` `EffectMultipleValue1` FLOAT NULL DEFAULT '0',
CHANGE `EffectMultipleValue_2` `EffectMultipleValue2` FLOAT NULL DEFAULT '0',
CHANGE `EffectMultipleValue_3` `EffectMultipleValue3` FLOAT NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `EffectChainTarget_1` `EffectChainTarget1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectChainTarget_2` `EffectChainTarget2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectChainTarget_3` `EffectChainTarget3` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectTriggerSpell_1` `EffectTriggerSpell1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectTriggerSpell_2` `EffectTriggerSpell2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectTriggerSpell_3` `EffectTriggerSpell3` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `EffectMiscValue_1` `EffectMiscValue1` INT(10) NULL DEFAULT '0',
CHANGE `EffectMiscValue_2` `EffectMiscValue2` INT(10) NULL DEFAULT '0',
CHANGE `EffectMiscValue_3` `EffectMiscValue3` INT(10) NULL DEFAULT '0',
CHANGE `EffectMiscValue2_1` `EffectMiscValueB1` INT(10) NULL DEFAULT '0',
CHANGE `EffectMiscValue2_2` `EffectMiscValueB2` INT(10) NULL DEFAULT '0',
CHANGE `EffectMiscValue2_3` `EffectMiscValueB3` INT(10) NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `EffectPointsPerComboPoint_1` `EffectPointsPerComboPoint1` FLOAT NULL DEFAULT '0',
CHANGE `EffectPointsPerComboPoint_2` `EffectPointsPerComboPoint2` FLOAT NULL DEFAULT '0',
CHANGE `EffectPointsPerComboPoint_3` `EffectPointsPerComboPoint3` FLOAT NULL DEFAULT '0',
CHANGE `EffectSpellClassMaskA_1` `EffectSpellClassMask1_1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectSpellClassMaskA_2` `EffectSpellClassMask1_2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectSpellClassMaskA_3` `EffectSpellClassMask1_3` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `EffectSpellClassMaskB_1` `EffectSpellClassMask2_1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectSpellClassMaskB_2` `EffectSpellClassMask2_2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectSpellClassMaskB_3` `EffectSpellClassMask2_3` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectSpellClassMaskC_1` `EffectSpellClassMask3_1` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectSpellClassMaskC_2` `EffectSpellClassMask3_2` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `EffectSpellClassMaskC_3` `EffectSpellClassMask3_3` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `activeIconID` `ActiveIconID` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `spellPriority` `SpellPriority` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `AffectedTargetLevel` `MaxAffectedTargets` INT(10) UNSIGNED NULL DEFAULT '0',
CHANGE `DmgMultiplier_1` `DmgMultiplier1` FLOAT NULL DEFAULT '0',
CHANGE `DmgMultiplier_2` `DmgMultiplier2` FLOAT NULL DEFAULT '0',
CHANGE `DmgMultiplier_3` `DmgMultiplier3` FLOAT NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `SpellFamilyFlags_1` `SpellFamilyFlags` BIGINT(20) UNSIGNED NULL DEFAULT '0',
CHANGE `SpellFamilyFlags_3` `SpellFamilyFlags2` INT(10) UNSIGNED NULL DEFAULT '0';
ALTER TABLE `wowd_spell` CHANGE `RangeIndex` `RangeIndex` INT(10) UNSIGNED NULL DEFAULT '1';