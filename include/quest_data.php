<?php
define('QUEST_FLAGS_STAY_ALIVE',    0x00000001);                // Not used currently
define('QUEST_FLAGS_PARTY_ACCEPT',  0x00000002);                // Not used currently. If player in party, all players that can accept this quest will receive confirmation box to accept quest CMSG_QUEST_CONFIRM_ACCEPT/SMSG_QUEST_CONFIRM_ACCEPT
define('QUEST_FLAGS_EXPLORATION',   0x00000004);                // Not used currently
define('QUEST_FLAGS_SHARABLE',      0x00000008);                // Can be shared
define('QUEST_FLAGS_NONE2',         0x00000010);                // Not used currently
define('QUEST_FLAGS_EPIC',          0x00000020);                // Not used currently: Unsure of content
define('QUEST_FLAGS_RAID',          0x00000040);                // Not used currently
define('QUEST_FLAGS_TBC',           0x00000080);                // Not used currently: Available if TBC expension enabled only
define('QUEST_FLAGS_UNK2',          0x00000100);                // Not used currently: _DELIVER_MORE Quest needs more than normal _q-item_ drops from mobs
define('QUEST_FLAGS_HIDDEN_REWARDS',0x00000200);                // Items and money rewarded only sent in SMSG_QUESTGIVER_OFFER_REWARD (not in SMSG_QUESTGIVER_QUEST_DETAILS or in client quest log(SMSG_QUEST_QUERY_RESPONSE))
define('QUEST_FLAGS_AUTO_REWARDED', 0x00000400);                // These quests are automatically rewarded on quest complete and they will never appear in quest log client side.
define('QUEST_FLAGS_TBC_RACES',     0x00000800);                // Not used currently: Blood elf/Draenei starting zone quests
define('QUEST_FLAGS_DAILY',         0x00001000);                // Used to know quest is Daily one
define('QUEST_FLAGS_FLAGS_PVP',     0x00002000);                // activates PvP on accept
define('QUEST_FLAGS_UNK4',          0x00004000);                // ? Membership Card Renewal
define('QUEST_FLAGS_WEEKLY',        0x00008000);                // Weekly quest. Can be done once a week. Quests reset at regular intervals for all players.
define('QUEST_FLAGS_AUTOCOMPLETE',  0x00010000);                // auto complete
define('QUEST_FLAGS_UNK5',          0x00020000);                // has something to do with ReqItemId and SrcItemId
define('QUEST_FLAGS_UNK6',          0x00040000);                // use Objective text as Complete text
define('QUEST_FLAGS_AUTO_ACCEPT',   0x00080000);                // quests in starting areas

    // Mangos flags for set SpecialFlags in DB if required but used only at server
define('QUEST_SPECIAL_FLAG_REPEATABLE',          0x001);     // Set by 1 in SpecialFlags from DB
define('QUEST_SPECIAL_FLAG_EXPLORATION_OR_EVENT',0x002);     // Set by 2 in SpecialFlags from DB (if required area explore, spell SPELL_EFFECT_QUEST_COMPLETE casting, table `*_script` command SCRIPT_COMMAND_QUEST_EXPLORED use, set from script DLL)
define('QUEST_SPECIAL_FLAG_MONTHLY',             0x004);     // |4 in SpecialFlags. Quest reset for player at beginning of month.
define('QUEST_SPECIAL_FLAG_DUNGEON_FINDER_QUEST',0x008);     // |8 in SpecialFlags. Quest used by dungeon finder.
define('QUEST_SPECIAL_FLAG_DELIVER',             0x010);     // Internal flag computed only
define('QUEST_SPECIAL_FLAG_SPEAKTO',             0x020);     // Internal flag computed only
define('QUEST_SPECIAL_FLAG_KILL_OR_CAST',        0x040);     // Internal flag computed only
define('QUEST_SPECIAL_FLAG_TIMED',               0x080);     // Internal flag computed only
define('QUEST_SPECIAL_FLAGS_PLAYER_KILL',        0x100);     // Internal flag computed only
?>