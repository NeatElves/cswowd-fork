-- Loot indexes
# ALTER TABLE `creature_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `creature_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `creature_loot_template`     (`item`);
CREATE INDEX `idx_ref`  ON `creature_loot_template`     (`mincountOrRef`);
# ALTER TABLE `disenchant_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `disenchant_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `disenchant_loot_template`   (`item`);
CREATE INDEX `idx_ref`  ON `disenchant_loot_template`   (`mincountOrRef`);
# ALTER TABLE `fishing_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `fishing_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `fishing_loot_template`      (`item`);
CREATE INDEX `idx_ref`  ON `fishing_loot_template`      (`mincountOrRef`);
# ALTER TABLE `gameobject_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `gameobject_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `gameobject_loot_template`   (`item`);
CREATE INDEX `idx_ref`  ON `gameobject_loot_template`   (`mincountOrRef`);
# ALTER TABLE `item_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `item_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `item_loot_template`         (`item`);
CREATE INDEX `idx_ref`  ON `item_loot_template`         (`mincountOrRef`);
# ALTER TABLE `pickpocketing_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `pickpocketing_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `pickpocketing_loot_template`(`item`);
CREATE INDEX `idx_ref`  ON `pickpocketing_loot_template`(`mincountOrRef`);
# ALTER TABLE `prospecting_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `prospecting_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `prospecting_loot_template`  (`item`);
CREATE INDEX `idx_ref`  ON `prospecting_loot_template`  (`mincountOrRef`);
# ALTER TABLE `skinning_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `skinning_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `skinning_loot_template`     (`item`);
CREATE INDEX `idx_ref`  ON `skinning_loot_template`     (`mincountOrRef`);
# ALTER TABLE `milling_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `milling_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `milling_loot_template`      (`item`);
CREATE INDEX `idx_ref`  ON `milling_loot_template`      (`mincountOrRef`);
# ALTER TABLE `mail_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `mail_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `mail_loot_template`   		(`item`);
CREATE INDEX `idx_ref`  ON `mail_loot_template`   		(`mincountOrRef`);
# ALTER TABLE `reference_loot_template` DROP INDEX `idx_item`;
# ALTER TABLE `reference_loot_template` DROP INDEX `idx_ref`;
CREATE INDEX `idx_item` ON `reference_loot_template`    (`item`);
CREATE INDEX `idx_ref`  ON `reference_loot_template`    (`mincountOrRef`);

-- Creature indexes
# ALTER TABLE `creature_template` DROP INDEX `idx_loot`;
# ALTER TABLE `creature_template` DROP INDEX `idx_skinloot`;
# ALTER TABLE `creature_template` DROP INDEX `idx_pickpocketloot`;
# ALTER TABLE `creature_template` DROP INDEX `idx_factionA`;
# ALTER TABLE `creature_template` DROP INDEX `idx_factionH`;
CREATE INDEX `idx_loot`           ON `creature_template` (`lootid`);
CREATE INDEX `idx_skinloot`       ON `creature_template` (`skinloot`);
CREATE INDEX `idx_pickpocketloot` ON `creature_template` (`pickpocketloot`);
CREATE INDEX `idx_factionA`       ON `creature_template` (`faction_A`);
CREATE INDEX `idx_factionH`       ON `creature_template` (`faction_H`);

-- Trainer
# ALTER TABLE `npc_trainer` DROP INDEX `idx_spell`;
CREATE INDEX `idx_spell`          ON `npc_trainer`       (`spell`);

-- Vendor
# ALTER TABLE `npc_vendor` DROP INDEX `idx_sold`;
CREATE INDEX `idx_sold`           ON `npc_vendor`        (`item`);

-- Item indexes
# ALTER TABLE `item_template` DROP INDEX `idx_quest`;
# ALTER TABLE `item_template` DROP INDEX `idx_reqFaction`;
# ALTER TABLE `item_template` DROP INDEX `idx_spell1`;
# ALTER TABLE `item_template` DROP INDEX `idx_spell2`;
# ALTER TABLE `item_template` DROP INDEX `idx_spell3`;
# ALTER TABLE `item_template` DROP INDEX `idx_spell4`;
# ALTER TABLE `item_template` DROP INDEX `idx_spell5`;
# ALTER TABLE `item_template` DROP INDEX `idx_disenchant`;
CREATE INDEX `idx_quest`           ON `item_template`            (`startquest`);
CREATE INDEX `idx_reqFaction`      ON `item_template`            (`RequiredReputationFaction`);
CREATE INDEX `idx_spell1`          ON `item_template`            (`spellid_1`);
CREATE INDEX `idx_spell2`          ON `item_template`            (`spellid_2`);
CREATE INDEX `idx_spell3`          ON `item_template`            (`spellid_3`);
CREATE INDEX `idx_spell4`          ON `item_template`            (`spellid_4`);
CREATE INDEX `idx_spell5`          ON `item_template`            (`spellid_5`);
CREATE INDEX `idx_disenchant`      ON `item_template`            (`DisenchantID`);

-- Quest indexes
# ALTER TABLE `quest_template` DROP INDEX `idx_rewSpell`;
# ALTER TABLE `quest_template` DROP INDEX `idx_castSpell`;
CREATE INDEX `idx_rewSpell`        ON `quest_template`           (`RewSpell`);
CREATE INDEX `idx_castSpell`       ON `quest_template`           (`RewSpellCast`);

# ALTER TABLE `creature_questrelation` DROP INDEX `idx_quest`;
# ALTER TABLE `gameobject_questrelation` DROP INDEX `idx_quest`;
# ALTER TABLE `creature_involvedrelation` DROP INDEX `idx_quest`;
# ALTER TABLE `gameobject_involvedrelation` DROP INDEX `idx_quest`;
CREATE INDEX `idx_quest`           ON `creature_questrelation`   (`quest`);
CREATE INDEX `idx_quest`           ON `gameobject_questrelation` (`quest`);
CREATE INDEX `idx_quest`           ON `creature_involvedrelation`   (`quest`);
CREATE INDEX `idx_quest`           ON `gameobject_involvedrelation` (`quest`);


-- GO indexes
# ALTER TABLE `gameobject_template` DROP INDEX `idx_type`;
# ALTER TABLE `gameobject_template` DROP INDEX `idx_faction`;
# ALTER TABLE `gameobject_template` DROP INDEX `idx_data0`;
# ALTER TABLE `gameobject_template` DROP INDEX `idx_data1`;
# ALTER TABLE `gameobject_template` DROP INDEX `idx_data2`;
# ALTER TABLE `gameobject_template` DROP INDEX `idx_data3`;
# ALTER TABLE `gameobject_template` DROP INDEX `idx_data10`;
CREATE INDEX `idx_type`           ON `gameobject_template` (`type`);
CREATE INDEX `idx_faction`        ON `gameobject_template` (`faction`);
CREATE INDEX `idx_data0`          ON `gameobject_template` (`data0`);
CREATE INDEX `idx_data1`          ON `gameobject_template` (`data1`);
CREATE INDEX `idx_data2`          ON `gameobject_template` (`data2`);
CREATE INDEX `idx_data3`          ON `gameobject_template` (`data3`);
CREATE INDEX `idx_data10`         ON `gameobject_template` (`data10`);