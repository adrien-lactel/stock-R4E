-- ============================================================================
-- NORMALISATION DE LA BASE WONDERSWAN
-- Généré le: 2026-02-18 19:15:22
-- Total de modifications: 245
-- Total de doublons à supprimer: 15
-- ============================================================================

-- Début de la transaction
START TRANSACTION;

-- ============================================================================
-- SUPPRESSION DES DOUBLONS
-- ============================================================================

-- Doublon: '7 Days Left'
-- Garder ID 5: '7 Days Left (World) (Ja) (v1.00) (WonderWitch) (WWGP2002) (Unl).ws'
-- Supprimer ID 220: '7 Days Left (World) (Ja) (v1.01) (WonderWitch) (Unl)'
DELETE FROM wonderswan_games WHERE id = 220;

-- Doublon: '7 Days Left'
-- Garder ID 5: '7 Days Left (World) (Ja) (v1.00) (WonderWitch) (WWGP2002) (Unl).ws'
-- Supprimer ID 6: '7 Days Left (World) (Ja) (v1.01) (WonderWitch) (Unl).ws'
DELETE FROM wonderswan_games WHERE id = 6;

-- Doublon: 'Cave Flyer'
-- Garder ID 22: 'Cave Flyer (World) (Proto 1) (WonderWitch) (Unl).ws'
-- Supprimer ID 23: 'Cave Flyer (World) (Proto 2) (WonderWitch) (WWGP2001) (Unl).ws'
DELETE FROM wonderswan_games WHERE id = 23;

-- Doublon: 'Chocobo no Fushigi na Dungeon'
-- Garder ID 26: 'Chocobo no Fushigi na Dungeon for WonderSwan (Japan) (Rev 1).ws'
-- Supprimer ID 27: 'Chocobo no Fushigi na Dungeon for WonderSwan (Japan) (Rev 2).ws'
DELETE FROM wonderswan_games WHERE id = 27;

-- Doublon: 'Chocobo no Fushigi na Dungeon'
-- Garder ID 26: 'Chocobo no Fushigi na Dungeon for WonderSwan (Japan) (Rev 1).ws'
-- Supprimer ID 28: 'Chocobo no Fushigi na Dungeon for WonderSwan (Japan) (Rev 3).ws'
DELETE FROM wonderswan_games WHERE id = 28;

-- Doublon: 'Digital Monster - D-Project'
-- Garder ID 236: 'Digital Monster - D-Project (Japan) (Rev 1)'
-- Supprimer ID 237: 'Digital Monster - D-Project (Japan) (Rev 2)'
DELETE FROM wonderswan_games WHERE id = 237;

-- Doublon: 'Hunter X Hunter - Ishi o Tsugu Mono'
-- Garder ID 76: 'Hunter X Hunter - Ishi o Tsugu Mono (Japan) (Rev 1).ws'
-- Supprimer ID 77: 'Hunter X Hunter - Ishi o Tsugu Mono (Japan) (Rev 2).ws'
DELETE FROM wonderswan_games WHERE id = 77;

-- Doublon: 'Judgement Silversword - Rebirth Edition'
-- Garder ID 271: 'Judgement Silversword - Rebirth Edition (Japan) (Rev 4321)'
-- Supprimer ID 272: 'Judgement Silversword - Rebirth Edition (Japan) (Rev 5C21)'
DELETE FROM wonderswan_games WHERE id = 272;

-- Doublon: 'Mahjong Touryuumon'
-- Garder ID 100: 'Mahjong Touryuumon (Japan) (Rev 1).ws'
-- Supprimer ID 101: 'Mahjong Touryuumon (Japan) (Rev 3).ws'
DELETE FROM wonderswan_games WHERE id = 101;

-- Doublon: 'SD Gundam - Emotional Jam'
-- Garder ID 149: 'SD Gundam - Emotional Jam (Japan) (Rev 2).ws'
-- Supprimer ID 150: 'SD Gundam - Emotional Jam (Japan) (Rev 3).ws'
DELETE FROM wonderswan_games WHERE id = 150;

-- Doublon: 'Super Robot Taisen Compact'
-- Garder ID 172: 'Super Robot Taisen Compact (Japan) (Rev 1).ws'
-- Supprimer ID 173: 'Super Robot Taisen Compact (Japan) (Rev 2).ws'
DELETE FROM wonderswan_games WHERE id = 173;

-- Doublon: 'Super Robot Taisen Compact 3'
-- Garder ID 310: 'Super Robot Taisen Compact 3 (Japan) (Rev 5)'
-- Supprimer ID 311: 'Super Robot Taisen Compact 3 (Japan) (Rev 6)'
DELETE FROM wonderswan_games WHERE id = 311;

-- Doublon: 'Wave R'
-- Garder ID 207: 'Wave R (World) (v1.0) (WonderWitch) (WWGP2003) (Unl).ws'
-- Supprimer ID 208: 'Wave R (World) (v1.1) (WonderWitch) (Unl).ws'
DELETE FROM wonderswan_games WHERE id = 208;

-- Doublon: 'Wonder Recorder'
-- Garder ID 210: 'Wonder Recorder (World) (Ja) (v1.00) (WonderWitch) (WWGP2001) (Unl).ws'
-- Supprimer ID 211: 'Wonder Recorder (World) (Ja) (v1.01) (WonderWitch) (Unl).ws'
DELETE FROM wonderswan_games WHERE id = 211;

-- Doublon: 'WonderSwan Handy Sonar'
-- Garder ID 215: 'WonderSwan Handy Sonar (Japan) (Rev 1).ws'
-- Supprimer ID 216: 'WonderSwan Handy Sonar (Japan) (Rev 2).ws'
DELETE FROM wonderswan_games WHERE id = 216;

-- ============================================================================
-- NORMALISATION DES NOMS
-- ============================================================================

-- ID 1
UPDATE wonderswan_games SET name = '15 Game' WHERE id = 1;
-- (était: '15 Game (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 2
UPDATE wonderswan_games SET name = '15 Puzzle' WHERE id = 2;
-- (était: '15 Puzzle (World) (WonderWitch) (Unl).ws')

-- ID 3
UPDATE wonderswan_games SET name = '15 Puzzle for WW' WHERE id = 3;
-- (était: '15 Puzzle for WW (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 4
UPDATE wonderswan_games SET name = '50 Oto Nyouryoku' WHERE id = 4;
-- (était: '50 Oto Nyouryoku (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 5
UPDATE wonderswan_games SET name = '7 Days Left' WHERE id = 5;
-- (était: '7 Days Left (World) (Ja) (v1.00) (WonderWitch) (WWGP2002) (Unl).ws')

-- ID 220
UPDATE wonderswan_games SET name = '7 Days Left' WHERE id = 220;
-- (était: '7 Days Left (World) (Ja) (v1.01) (WonderWitch) (Unl)')

-- ID 6
UPDATE wonderswan_games SET name = '7 Days Left' WHERE id = 6;
-- (était: '7 Days Left (World) (Ja) (v1.01) (WonderWitch) (Unl).ws')

-- ID 7
UPDATE wonderswan_games SET name = 'Anchorz Field (Japan)' WHERE id = 7;
-- (était: 'Anchorz Field (Japan).ws')

-- ID 8
UPDATE wonderswan_games SET name = 'Armored Unit (Japan)' WHERE id = 8;
-- (était: 'Armored Unit (Japan).ws')

-- ID 9
UPDATE wonderswan_games SET name = 'Atakshii' WHERE id = 9;
-- (était: 'Atakshii (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 10
UPDATE wonderswan_games SET name = 'Atodashi' WHERE id = 10;
-- (était: 'Atodashi (World) (WonderWitch) (Unl).ws')

-- ID 11
UPDATE wonderswan_games SET name = 'B.A.F.' WHERE id = 11;
-- (était: 'B.A.F. (World) (Proto) (WonderWitch) (Unl).ws')

-- ID 13
UPDATE wonderswan_games SET name = 'Bakusou Dekotora Densetsu (Japan)' WHERE id = 13;
-- (était: 'Bakusou Dekotora Densetsu for WonderSwan (Japan).ws')

-- ID 14
UPDATE wonderswan_games SET name = 'Ball and Block' WHERE id = 14;
-- (était: 'Ball and Block (World) (WonderWitch) (Unl).ws')

-- ID 15
UPDATE wonderswan_games SET name = 'Balloon' WHERE id = 15;
-- (était: 'Balloon (World) (WonderWitch) (Unl).ws')

-- ID 16
UPDATE wonderswan_games SET name = 'Battle Mosquito' WHERE id = 16;
-- (était: 'Battle Mosquito (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 224
UPDATE wonderswan_games SET name = 'Battle Spirit - Digimon Frontier' WHERE id = 224;
-- (était: 'Battle Spirit - Digimon Frontier (Japan) (Rev 1)')

-- ID 218
UPDATE wonderswan_games SET name = 'beatmania (Japan)' WHERE id = 218;
-- (était: 'beatmania for WonderSwan (Japan).ws')

-- ID 12
UPDATE wonderswan_games SET name = 'BNU' WHERE id = 12;
-- (était: 'BNU (World) (v1.1) (WonderWitch) (Unl).ws')

-- ID 17
UPDATE wonderswan_games SET name = 'Buffers Evolution (Japan)' WHERE id = 17;
-- (était: 'Buffers Evolution (Japan).ws')

-- ID 18
UPDATE wonderswan_games SET name = 'Buro' WHERE id = 18;
-- (était: 'Buro (World) (WonderWitch) (Unl).ws')

-- ID 19
UPDATE wonderswan_games SET name = 'C-Man' WHERE id = 19;
-- (était: 'C-Man (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 20
UPDATE wonderswan_games SET name = 'Cardcaptor Sakura - Sakura to Fushigi na Clow Card (Japan)' WHERE id = 20;
-- (était: 'Cardcaptor Sakura - Sakura to Fushigi na Clow Card (Japan).ws')

-- ID 21
UPDATE wonderswan_games SET name = 'Castle' WHERE id = 21;
-- (était: 'Castle (World) (WonderWitch) (Unl).ws')

-- ID 22
UPDATE wonderswan_games SET name = 'Cave Flyer' WHERE id = 22;
-- (était: 'Cave Flyer (World) (Proto 1) (WonderWitch) (Unl).ws')

-- ID 23
UPDATE wonderswan_games SET name = 'Cave Flyer' WHERE id = 23;
-- (était: 'Cave Flyer (World) (Proto 2) (WonderWitch) (WWGP2001) (Unl).ws')

-- ID 24
UPDATE wonderswan_games SET name = 'Chaos Gear - Michibikareshi Mono (Japan)' WHERE id = 24;
-- (était: 'Chaos Gear - Michibikareshi Mono (Japan).ws')

-- ID 25
UPDATE wonderswan_games SET name = 'Chikyou o Mamore Ozon-sou' WHERE id = 25;
-- (était: 'Chikyou o Mamore Ozon-sou (World) (Ja) (Proto) (WonderWitch) (Unl).ws')

-- ID 26
UPDATE wonderswan_games SET name = 'Chocobo no Fushigi na Dungeon' WHERE id = 26;
-- (était: 'Chocobo no Fushigi na Dungeon for WonderSwan (Japan) (Rev 1).ws')

-- ID 27
UPDATE wonderswan_games SET name = 'Chocobo no Fushigi na Dungeon' WHERE id = 27;
-- (était: 'Chocobo no Fushigi na Dungeon for WonderSwan (Japan) (Rev 2).ws')

-- ID 28
UPDATE wonderswan_games SET name = 'Chocobo no Fushigi na Dungeon' WHERE id = 28;
-- (était: 'Chocobo no Fushigi na Dungeon for WonderSwan (Japan) (Rev 3).ws')

-- ID 29
UPDATE wonderswan_games SET name = 'Chou Aniki - Otoko no Tamafuda' WHERE id = 29;
-- (était: 'Chou Aniki - Otoko no Tamafuda (Japan) (Rev 4).ws')

-- ID 30
UPDATE wonderswan_games SET name = 'Chou Denki Card Battle - Youfu Makai' WHERE id = 30;
-- (était: 'Chou Denki Card Battle - Youfu Makai (Japan) (Rev 3).ws')

-- ID 31
UPDATE wonderswan_games SET name = 'Chuuka Taisen' WHERE id = 31;
-- (était: 'Chuuka Taisen (World) (WonderWitch) (Unl).ws')

-- ID 32
UPDATE wonderswan_games SET name = 'Clock Tower' WHERE id = 32;
-- (était: 'Clock Tower for WonderSwan (Japan) (Rev 1).ws')

-- ID 33
UPDATE wonderswan_games SET name = 'Crazy Climber (Japan)' WHERE id = 33;
-- (était: 'Crazy Climber (Japan).ws')

-- ID 34
UPDATE wonderswan_games SET name = 'D''s Garage 21 Koubo Game - Tane o Maku Tori (Japan)' WHERE id = 34;
-- (était: 'D''s Garage 21 Koubo Game - Tane o Maku Tori (Japan).ws')

-- ID 35
UPDATE wonderswan_games SET name = 'Dash Straight' WHERE id = 35;
-- (était: 'Dash Straight (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 36
UPDATE wonderswan_games SET name = 'Datchuchu' WHERE id = 36;
-- (était: 'Datchuchu (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 37
UPDATE wonderswan_games SET name = 'Denkou Keijiki' WHERE id = 37;
-- (était: 'Denkou Keijiki (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 38
UPDATE wonderswan_games SET name = 'Densha de Go!' WHERE id = 38;
-- (était: 'Densha de Go! (Japan) (Rev 1).ws')

-- ID 39
UPDATE wonderswan_games SET name = 'Densha de Go! 2 (Japan)' WHERE id = 39;
-- (était: 'Densha de Go! 2 (Japan).ws')

-- ID 40
UPDATE wonderswan_games SET name = 'Dexten' WHERE id = 40;
-- (était: 'Dexten (World) (WonderWitch) (Unl).ws')

-- ID 228
UPDATE wonderswan_games SET name = 'Digimon - Anode Tamer _ Cathode Tamer - Veedramon Version' WHERE id = 228;
-- (était: 'Digimon - Anode Tamer _ Cathode Tamer - Veedramon Version (Hong Kong) (En)')

-- ID 41
UPDATE wonderswan_games SET name = 'Digimon - Ver. WonderSwan' WHERE id = 41;
-- (était: 'Digimon - Ver. WonderSwan (Hong Kong) (En).ws')

-- ID 43
UPDATE wonderswan_games SET name = 'Digimon Adventure - Anode Tamer' WHERE id = 43;
-- (était: 'Digimon Adventure - Anode Tamer (Japan) (Rev 1).ws')

-- ID 42
UPDATE wonderswan_games SET name = 'Digimon Adventure - Anode Tamer (Japan)' WHERE id = 42;
-- (était: 'Digimon Adventure - Anode Tamer (Japan).ws')

-- ID 44
UPDATE wonderswan_games SET name = 'Digimon Adventure - Cathode Tamer (Japan)' WHERE id = 44;
-- (était: 'Digimon Adventure - Cathode Tamer (Japan).ws')

-- ID 229
UPDATE wonderswan_games SET name = 'Digimon Adventure 02 - D1 Tamers' WHERE id = 229;
-- (était: 'Digimon Adventure 02 - D1 Tamers (Japan) (Rev 1)')

-- ID 46
UPDATE wonderswan_games SET name = 'Digimon Adventure 02 - Tag Tamers' WHERE id = 46;
-- (était: 'Digimon Adventure 02 - Tag Tamers (Japan) (Rev 1).ws')

-- ID 45
UPDATE wonderswan_games SET name = 'Digimon Adventure 02 - Tag Tamers (Japan)' WHERE id = 45;
-- (était: 'Digimon Adventure 02 - Tag Tamers (Japan).ws')

-- ID 47
UPDATE wonderswan_games SET name = 'Digimon Adventure Campaign.wsc' WHERE id = 47;
-- (était: 'Digimon Adventure Campaign (Japan) (Limited Version).wsc')

-- ID 231
UPDATE wonderswan_games SET name = 'Digimon Tamers - Battle Spirit' WHERE id = 231;
-- (était: 'Digimon Tamers - Battle Spirit (Japan, Korea) (En,Ja)')

-- ID 233
UPDATE wonderswan_games SET name = 'Digimon Tamers - Brave Tamer' WHERE id = 233;
-- (était: 'Digimon Tamers - Brave Tamer (Japan) (Rev 1)')

-- ID 234
UPDATE wonderswan_games SET name = 'Digimon Tamers - Digimon Medley' WHERE id = 234;
-- (était: 'Digimon Tamers - Digimon Medley (Japan) (Rev 1)')

-- ID 236
UPDATE wonderswan_games SET name = 'Digital Monster - D-Project' WHERE id = 236;
-- (était: 'Digital Monster - D-Project (Japan) (Rev 1)')

-- ID 237
UPDATE wonderswan_games SET name = 'Digital Monster - D-Project' WHERE id = 237;
-- (était: 'Digital Monster - D-Project (Japan) (Rev 2)')

-- ID 48
UPDATE wonderswan_games SET name = 'Digital Monster - Ver. WonderSwan' WHERE id = 48;
-- (était: 'Digital Monster - Ver. WonderSwan (Japan) (Rev 1).ws')

-- ID 239
UPDATE wonderswan_games SET name = 'Digital Monster Card Game - Ver. WonderSwan Color' WHERE id = 239;
-- (était: 'Digital Monster Card Game - Ver. WonderSwan Color (Japan) (Rev 2)')

-- ID 49
UPDATE wonderswan_games SET name = 'Digital Partner (Japan)' WHERE id = 49;
-- (était: 'Digital Partner (Japan).ws')

-- ID 50
UPDATE wonderswan_games SET name = 'Disc Upper' WHERE id = 50;
-- (était: 'Disc Upper (World) (WonderWitch) (Unl).ws')

-- ID 51
UPDATE wonderswan_games SET name = 'Dokodemo Hamster (Japan)' WHERE id = 51;
-- (était: 'Dokodemo Hamster (Japan).ws')

-- ID 241
UPDATE wonderswan_games SET name = 'Dokodemo Hamster 3 - Odekake Saffron' WHERE id = 241;
-- (était: 'Dokodemo Hamster 3 - Odekake Saffron (Japan) (Rev 2)')

-- ID 52
UPDATE wonderswan_games SET name = 'Dolls' WHERE id = 52;
-- (était: 'Dolls (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 53
UPDATE wonderswan_games SET name = 'EF-Cribbage' WHERE id = 53;
-- (était: 'EF-Cribbage (World) (Ja) (v0.28) (Proto) (WonderWitch) (Unl).ws')

-- ID 54
UPDATE wonderswan_games SET name = 'Engacho! (Japan)' WHERE id = 54;
-- (était: 'Engacho! for WonderSwan (Japan).ws')

-- ID 55
UPDATE wonderswan_games SET name = 'Features' WHERE id = 55;
-- (était: 'Features (World) (v2.001) (WonderWitch) (Unl).ws')

-- ID 56
UPDATE wonderswan_games SET name = 'Fever - Sankyo Koushiki Pachinko Simulation (Japan)' WHERE id = 56;
-- (était: 'Fever - Sankyo Koushiki Pachinko Simulation for WonderSwan (Japan).ws')

-- ID 57
UPDATE wonderswan_games SET name = 'Final Lap 2000 (Japan)' WHERE id = 57;
-- (était: 'Final Lap 2000 (Japan).ws')

-- ID 58
UPDATE wonderswan_games SET name = 'Fire Pro Wrestling' WHERE id = 58;
-- (était: 'Fire Pro Wrestling for WonderSwan (Japan) (Rev 5).ws')

-- ID 59
UPDATE wonderswan_games SET name = 'Fishing Freaks - Bass Rise (Japan)' WHERE id = 59;
-- (était: 'Fishing Freaks - Bass Rise for WonderSwan (Japan).ws')

-- ID 60
UPDATE wonderswan_games SET name = 'From TV Animation One Piece - Mezase Kaizoku Ou! (Japan)' WHERE id = 60;
-- (était: 'From TV Animation One Piece - Mezase Kaizoku Ou! (Japan).ws')

-- ID 251
UPDATE wonderswan_games SET name = 'From TV Animation One Piece - Treasure Wars' WHERE id = 251;
-- (était: 'From TV Animation One Piece - Treasure Wars (Japan) (Rev 1)')

-- ID 61
UPDATE wonderswan_games SET name = 'Frontier' WHERE id = 61;
-- (était: 'Frontier (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 63
UPDATE wonderswan_games SET name = 'Gachagacha Nyouryoku' WHERE id = 63;
-- (était: 'Gachagacha Nyouryoku (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 64
UPDATE wonderswan_games SET name = 'Ganso Jajamaru-kun (Japan)' WHERE id = 64;
-- (était: 'Ganso Jajamaru-kun (Japan).ws')

-- ID 62
UPDATE wonderswan_games SET name = 'GB Yu-Gi-Oh Database' WHERE id = 62;
-- (était: 'GB Yu-Gi-Oh Database (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 256
UPDATE wonderswan_games SET name = 'Gensou Maden Saiyuuki Retribution - Hi no Ataru Basho de' WHERE id = 256;
-- (était: 'Gensou Maden Saiyuuki Retribution - Hi no Ataru Basho de (Japan) (Rev 2)')

-- ID 65
UPDATE wonderswan_games SET name = 'Glocal Hexcite (Japan)' WHERE id = 65;
-- (était: 'Glocal Hexcite (Japan).ws')

-- ID 66
UPDATE wonderswan_games SET name = 'Gomoku Narabe & Reversi - Touryuumon (Japan)' WHERE id = 66;
-- (était: 'Gomoku Narabe & Reversi - Touryuumon (Japan).ws')

-- ID 67
UPDATE wonderswan_games SET name = 'Goraku Ou Tango!' WHERE id = 67;
-- (était: 'Goraku Ou Tango! (Japan) (Rev 2).ws')

-- ID 68
UPDATE wonderswan_games SET name = 'GunPey (Japan)' WHERE id = 68;
-- (était: 'GunPey (Japan).ws')

-- ID 69
UPDATE wonderswan_games SET name = 'Hanafuda Shiyouyo (Japan)' WHERE id = 69;
-- (était: 'Hanafuda Shiyouyo (Japan).ws')

-- ID 262
UPDATE wonderswan_games SET name = 'Hanjuku Hero - Ah, Sekai yo Hanjuku Nare...!!' WHERE id = 262;
-- (était: 'Hanjuku Hero - Ah, Sekai yo Hanjuku Nare...!! (Japan) (Rev 1)')

-- ID 71
UPDATE wonderswan_games SET name = 'Harobots' WHERE id = 71;
-- (était: 'Harobots (Japan) (Rev 1).ws')

-- ID 70
UPDATE wonderswan_games SET name = 'Harobots (Japan)' WHERE id = 70;
-- (était: 'Harobots (Japan).ws')

-- ID 72
UPDATE wonderswan_games SET name = 'Hayauchi!' WHERE id = 72;
-- (était: 'Hayauchi! (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 73
UPDATE wonderswan_games SET name = 'Hex Calculator' WHERE id = 73;
-- (était: 'Hex Calculator (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 74
UPDATE wonderswan_games SET name = 'Hima Tsubushi' WHERE id = 74;
-- (était: 'Hima Tsubushi (World) (WonderWitch) (Unl).ws')

-- ID 75
UPDATE wonderswan_games SET name = 'Hito' WHERE id = 75;
-- (était: 'Hito (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 264
UPDATE wonderswan_games SET name = 'Hunter X Hunter - Greed Island' WHERE id = 264;
-- (était: 'Hunter X Hunter - Greed Island (Japan) (Rev 1)')

-- ID 76
UPDATE wonderswan_games SET name = 'Hunter X Hunter - Ishi o Tsugu Mono' WHERE id = 76;
-- (était: 'Hunter X Hunter - Ishi o Tsugu Mono (Japan) (Rev 1).ws')

-- ID 77
UPDATE wonderswan_games SET name = 'Hunter X Hunter - Ishi o Tsugu Mono' WHERE id = 77;
-- (était: 'Hunter X Hunter - Ishi o Tsugu Mono (Japan) (Rev 2).ws')

-- ID 78
UPDATE wonderswan_games SET name = 'Inu Renda' WHERE id = 78;
-- (était: 'Inu Renda (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 79
UPDATE wonderswan_games SET name = 'Invader DX & Boss DX' WHERE id = 79;
-- (était: 'Invader DX & Boss DX (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 80
UPDATE wonderswan_games SET name = 'Ishikari' WHERE id = 80;
-- (était: 'Ishikari (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 81
UPDATE wonderswan_games SET name = 'Jiban Ryuoki - WonderSwan Edition' WHERE id = 81;
-- (était: 'Jiban Ryuoki - WonderSwan Edition (World) (WonderWitch) (Unl).ws')

-- ID 271
UPDATE wonderswan_games SET name = 'Judgement Silversword - Rebirth Edition' WHERE id = 271;
-- (était: 'Judgement Silversword - Rebirth Edition (Japan) (Rev 4321)')

-- ID 272
UPDATE wonderswan_games SET name = 'Judgement Silversword - Rebirth Edition' WHERE id = 272;
-- (était: 'Judgement Silversword - Rebirth Edition (Japan) (Rev 5C21)')

-- ID 82
UPDATE wonderswan_games SET name = 'Jump on Step' WHERE id = 82;
-- (était: 'Jump on Step (World) (WonderWitch) (Unl).ws')

-- ID 83
UPDATE wonderswan_games SET name = 'Kakutou Ryouri Densetsu Bistro Recipe - Wonder Battle Hen (Japan)' WHERE id = 83;
-- (était: 'Kakutou Ryouri Densetsu Bistro Recipe - Wonder Battle Hen (Japan).ws')

-- ID 84
UPDATE wonderswan_games SET name = 'Kana' WHERE id = 84;
-- (était: 'Kana (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 85
UPDATE wonderswan_games SET name = 'Kaze no Klonoa - Moonlight Museum (Japan)' WHERE id = 85;
-- (était: 'Kaze no Klonoa - Moonlight Museum (Japan).ws')

-- ID 86
UPDATE wonderswan_games SET name = 'Keiba Yosou Shien Soft - Yosou Shinkaron (Japan)' WHERE id = 86;
-- (était: 'Keiba Yosou Shien Soft - Yosou Shinkaron (Japan).ws')

-- ID 87
UPDATE wonderswan_games SET name = 'Kirin Editor + Kuro Pad' WHERE id = 87;
-- (était: 'Kirin Editor + Kuro Pad (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 88
UPDATE wonderswan_games SET name = 'Kiss Communication' WHERE id = 88;
-- (était: 'Kiss Communication (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 89
UPDATE wonderswan_games SET name = 'Kiss Yori... - Seaside Serenade' WHERE id = 89;
-- (était: 'Kiss Yori... - Seaside Serenade (Japan) (Rev 2).ws')

-- ID 90
UPDATE wonderswan_games SET name = 'Kosodate Quiz - Dokodemo My Angel (Japan)' WHERE id = 90;
-- (était: 'Kosodate Quiz - Dokodemo My Angel (Japan).ws')

-- ID 280
UPDATE wonderswan_games SET name = 'Kurupara!' WHERE id = 280;
-- (était: 'Kurupara! (Japan) (Rev 1)')

-- ID 91
UPDATE wonderswan_games SET name = 'Kyousouba Ikusei Simulation - Keiba' WHERE id = 91;
-- (était: 'Kyousouba Ikusei Simulation - Keiba (Japan) (Rev 1).ws')

-- ID 93
UPDATE wonderswan_games SET name = 'Langrisser Millennium WS - The Last Century' WHERE id = 93;
-- (était: 'Langrisser Millennium WS - The Last Century (Japan) (Rev 1).ws')

-- ID 94
UPDATE wonderswan_games SET name = 'Last Stand (Japan)' WHERE id = 94;
-- (était: 'Last Stand (Japan).ws')

-- ID 95
UPDATE wonderswan_games SET name = 'LifeGame for WonderWitch' WHERE id = 95;
-- (était: 'LifeGame for WonderWitch (World) (WonderWitch) (Unl).ws')

-- ID 92
UPDATE wonderswan_games SET name = 'LNPUT' WHERE id = 92;
-- (était: 'LNPUT (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 96
UPDATE wonderswan_games SET name = 'Lode Runner (Japan)' WHERE id = 96;
-- (était: 'Lode Runner for WonderSwan (Japan).ws')

-- ID 97
UPDATE wonderswan_games SET name = 'Mac the Speed Shooter' WHERE id = 97;
-- (était: 'Mac the Speed Shooter (World) (Proto) (WonderWitch) (Unl).ws')

-- ID 98
UPDATE wonderswan_games SET name = 'Macross - True Love Song (Japan)' WHERE id = 98;
-- (était: 'Macross - True Love Song (Japan).ws')

-- ID 99
UPDATE wonderswan_games SET name = 'Magical Drop (Japan)' WHERE id = 99;
-- (était: 'Magical Drop for WonderSwan (Japan).ws')

-- ID 100
UPDATE wonderswan_games SET name = 'Mahjong Touryuumon' WHERE id = 100;
-- (était: 'Mahjong Touryuumon (Japan) (Rev 1).ws')

-- ID 101
UPDATE wonderswan_games SET name = 'Mahjong Touryuumon' WHERE id = 101;
-- (était: 'Mahjong Touryuumon (Japan) (Rev 3).ws')

-- ID 102
UPDATE wonderswan_games SET name = 'Makaimura (Japan)' WHERE id = 102;
-- (était: 'Makaimura for WonderSwan (Japan).ws')

-- ID 103
UPDATE wonderswan_games SET name = 'Medarot Perfect Edition - Kabuto Version (Japan)' WHERE id = 103;
-- (était: 'Medarot Perfect Edition - Kabuto Version (Japan).ws')

-- ID 104
UPDATE wonderswan_games SET name = 'Medarot Perfect Edition - Kuwagata Version (Japan)' WHERE id = 104;
-- (était: 'Medarot Perfect Edition - Kuwagata Version (Japan).ws')

-- ID 105
UPDATE wonderswan_games SET name = 'Meitantei Conan - Majutsushi no Chousenjou! (Japan)' WHERE id = 105;
-- (était: 'Meitantei Conan - Majutsushi no Chousenjou! (Japan).ws')

-- ID 106
UPDATE wonderswan_games SET name = 'Meitantei Conan - Nishi no Meitantei Saidai no Kiki! (Japan)' WHERE id = 106;
-- (était: 'Meitantei Conan - Nishi no Meitantei Saidai no Kiki! (Japan).ws')

-- ID 107
UPDATE wonderswan_games SET name = 'Metakomi Theraphy - Nee Kiite! (Japan)' WHERE id = 107;
-- (était: 'Metakomi Theraphy - Nee Kiite! (Japan).ws')

-- ID 108
UPDATE wonderswan_games SET name = 'Migi Mawari no Randi' WHERE id = 108;
-- (était: 'Migi Mawari no Randi (World) (Proto) (WonderWitch) (Unl).ws')

-- ID 109
UPDATE wonderswan_games SET name = 'Mingle Magnet' WHERE id = 109;
-- (était: 'Mingle Magnet (Japan) (En,Ja) (Rev 1).ws')

-- ID 110
UPDATE wonderswan_games SET name = 'Mobile Suit Gundam MSVS (Japan)' WHERE id = 110;
-- (était: 'Mobile Suit Gundam MSVS (Japan).ws')

-- ID 111
UPDATE wonderswan_games SET name = 'MobileWonderGate' WHERE id = 111;
-- (était: 'MobileWonderGate (Japan) (Rev 1).ws')

-- ID 112
UPDATE wonderswan_games SET name = 'Moero!! Pro Yakyuu Rookies (Japan)' WHERE id = 112;
-- (était: 'Moero!! Pro Yakyuu Rookies (Japan).ws')

-- ID 113
UPDATE wonderswan_games SET name = 'Mogura Tatake' WHERE id = 113;
-- (était: 'Mogura Tatake (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 114
UPDATE wonderswan_games SET name = 'Morita Shougi (Japan)' WHERE id = 114;
-- (était: 'Morita Shougi for WonderSwan (Japan).ws')

-- ID 115
UPDATE wonderswan_games SET name = 'Mr. Oha no Ko Bouken - Sai Shuushou Saraba Aishi no Shooting' WHERE id = 115;
-- (était: 'Mr. Oha no Ko Bouken - Sai Shuushou Saraba Aishi no Shooting (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 116
UPDATE wonderswan_games SET name = 'Nazo Ou Pocket (Japan)' WHERE id = 116;
-- (était: 'Nazo Ou Pocket (Japan).ws')

-- ID 117
UPDATE wonderswan_games SET name = 'Neon Genesis Evangelion - Shito Ikusei (Japan)' WHERE id = 117;
-- (était: 'Neon Genesis Evangelion - Shito Ikusei (Japan).ws')

-- ID 118
UPDATE wonderswan_games SET name = 'Nice On' WHERE id = 118;
-- (était: 'Nice On (Japan) (Rev 1).ws')

-- ID 119
UPDATE wonderswan_games SET name = 'Nigero!' WHERE id = 119;
-- (était: 'Nigero! (World) (WonderWitch) (Unl).ws')

-- ID 120
UPDATE wonderswan_games SET name = 'Nihon Pro Mahjong Renmei Kounin - Tetsuman' WHERE id = 120;
-- (était: 'Nihon Pro Mahjong Renmei Kounin - Tetsuman (Japan) (Rev 2).ws')

-- ID 121
UPDATE wonderswan_games SET name = 'Nobunaga no Yabou (Japan)' WHERE id = 121;
-- (était: 'Nobunaga no Yabou for WonderSwan (Japan).ws')

-- ID 122
UPDATE wonderswan_games SET name = 'Noiz' WHERE id = 122;
-- (était: 'Noiz (World) (v0.62) (Proto) (WonderWitch) (Unl).ws')

-- ID 123
UPDATE wonderswan_games SET name = 'Okiraku Daisakusen' WHERE id = 123;
-- (était: 'Okiraku Daisakusen (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 124
UPDATE wonderswan_games SET name = 'Omiyage o Kaou!' WHERE id = 124;
-- (était: 'Omiyage o Kaou! (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 125
UPDATE wonderswan_games SET name = 'One Kiri' WHERE id = 125;
-- (était: 'One Kiri (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 126
UPDATE wonderswan_games SET name = 'Ore no Kakeibo' WHERE id = 126;
-- (était: 'Ore no Kakeibo (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 219
UPDATE wonderswan_games SET name = 'otto' WHERE id = 219;
-- (était: 'otto (World) (WonderWitch) (Unl).ws')

-- ID 127
UPDATE wonderswan_games SET name = 'Ou-chan no Oekaki Logic (Japan)' WHERE id = 127;
-- (était: 'Ou-chan no Oekaki Logic (Japan).ws')

-- ID 128
UPDATE wonderswan_games SET name = 'Oyogu Kamo' WHERE id = 128;
-- (était: 'Oyogu Kamo (World) (Proto) (WonderWitch) (Unl).ws')

-- ID 130
UPDATE wonderswan_games SET name = 'Panzer Battle 3' WHERE id = 130;
-- (était: 'Panzer Battle 3 (World) (Ja) (v3.00) (WonderWitch) (Unl).ws')

-- ID 129
UPDATE wonderswan_games SET name = 'PDA Mini for WonderWitch' WHERE id = 129;
-- (était: 'PDA Mini for WonderWitch (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 131
UPDATE wonderswan_games SET name = 'Pepperas!' WHERE id = 131;
-- (était: 'Pepperas! (World) (v0.20) (Proto) (WonderWitch) (Unl).ws')

-- ID 132
UPDATE wonderswan_games SET name = 'Ping Pong Spy' WHERE id = 132;
-- (était: 'Ping Pong Spy (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 133
UPDATE wonderswan_games SET name = 'Pladel' WHERE id = 133;
-- (était: 'Pladel (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 134
UPDATE wonderswan_games SET name = 'Pocket Fighter (Japan)' WHERE id = 134;
-- (était: 'Pocket Fighter (Japan).ws')

-- ID 135
UPDATE wonderswan_games SET name = 'Potential Taper - Rewoke World 03' WHERE id = 135;
-- (était: 'Potential Taper - Rewoke World 03 (World) (En) (WonderWitch) (Unl).ws')

-- ID 136
UPDATE wonderswan_games SET name = 'Pro Mahjong Kiwame' WHERE id = 136;
-- (était: 'Pro Mahjong Kiwame for WonderSwan (Japan) (Rev 1).ws')

-- ID 137
UPDATE wonderswan_games SET name = 'Puchipuchi' WHERE id = 137;
-- (était: 'Puchipuchi (World) (WonderWitch) (Unl).ws')

-- ID 138
UPDATE wonderswan_games SET name = 'Pudding Maker' WHERE id = 138;
-- (était: 'Pudding Maker (World) (WonderWitch) (Unl).ws')

-- ID 139
UPDATE wonderswan_games SET name = 'Puyo Puyo Tsuu (Japan)' WHERE id = 139;
-- (était: 'Puyo Puyo Tsuu (Japan).ws')

-- ID 140
UPDATE wonderswan_games SET name = 'Puzzle Bobble (Japan)' WHERE id = 140;
-- (était: 'Puzzle Bobble (Japan).ws')

-- ID 141
UPDATE wonderswan_games SET name = 'Radius Theta' WHERE id = 141;
-- (était: 'Radius Theta (World) (WonderWitch) (Unl).ws')

-- ID 142
UPDATE wonderswan_games SET name = 'Rainbow Islands - Putty''s Party (Japan)' WHERE id = 142;
-- (était: 'Rainbow Islands - Putty''s Party (Japan).ws')

-- ID 144
UPDATE wonderswan_games SET name = 'Renda Machine' WHERE id = 144;
-- (était: 'Renda Machine (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 143
UPDATE wonderswan_games SET name = 'ReSiA System' WHERE id = 143;
-- (était: 'ReSiA System (World) (Ja) (v0.10) (Proto) (WonderWitch) (Unl).ws')

-- ID 145
UPDATE wonderswan_games SET name = 'Ring Infinity (Japan)' WHERE id = 145;
-- (était: 'Ring Infinity (Japan).ws')

-- ID 146
UPDATE wonderswan_games SET name = 'Robot Works' WHERE id = 146;
-- (était: 'Robot Works (Hong Kong) (En,Ja) (Rev 1).ws')

-- ID 147
UPDATE wonderswan_games SET name = 'Robot Works (Japan)' WHERE id = 147;
-- (était: 'Robot Works (Japan).ws')

-- ID 148
UPDATE wonderswan_games SET name = 'Rockman & Forte - Mirai Kara no Chousensha (Japan)' WHERE id = 148;
-- (était: 'Rockman & Forte - Mirai Kara no Chousensha (Japan).ws')

-- ID 294
UPDATE wonderswan_games SET name = 'Rockman EXE - N1 Battle' WHERE id = 294;
-- (était: 'Rockman EXE - N1 Battle (Japan) (Rev 1)')

-- ID 154
UPDATE wonderswan_games SET name = 'Saint Dagrat Monogatari' WHERE id = 154;
-- (était: 'Saint Dagrat Monogatari (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 156
UPDATE wonderswan_games SET name = 'Sangokushi (Japan)' WHERE id = 156;
-- (était: 'Sangokushi for WonderSwan (Japan).ws')

-- ID 155
UPDATE wonderswan_games SET name = 'Sangokushi II (Japan)' WHERE id = 155;
-- (était: 'Sangokushi II for WonderSwan (Japan).ws')

-- ID 149
UPDATE wonderswan_games SET name = 'SD Gundam - Emotional Jam' WHERE id = 149;
-- (était: 'SD Gundam - Emotional Jam (Japan) (Rev 2).ws')

-- ID 150
UPDATE wonderswan_games SET name = 'SD Gundam - Emotional Jam' WHERE id = 150;
-- (était: 'SD Gundam - Emotional Jam (Japan) (Rev 3).ws')

-- ID 151
UPDATE wonderswan_games SET name = 'SD Gundam G Generation - Gather Beat (Japan)' WHERE id = 151;
-- (était: 'SD Gundam G Generation - Gather Beat (Japan).ws')

-- ID 301
UPDATE wonderswan_games SET name = 'SD Gundam G Generation - Mono-Eye Gundams' WHERE id = 301;
-- (était: 'SD Gundam G Generation - Mono-Eye Gundams (Japan) (Rev 2)')

-- ID 153
UPDATE wonderswan_games SET name = 'SD Gundam Gashapon Senki - Episode 1' WHERE id = 153;
-- (était: 'SD Gundam Gashapon Senki - Episode 1 (Japan) (Alt).ws')

-- ID 152
UPDATE wonderswan_games SET name = 'SD Gundam Gashapon Senki - Episode 1 (Japan)' WHERE id = 152;
-- (était: 'SD Gundam Gashapon Senki - Episode 1 (Japan).ws')

-- ID 157
UPDATE wonderswan_games SET name = 'Senbetsu' WHERE id = 157;
-- (était: 'Senbetsu (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 158
UPDATE wonderswan_games SET name = 'Senkaiden - TV Animation Senkaiden Houshin Engi Yori (Japan)' WHERE id = 158;
-- (était: 'Senkaiden - TV Animation Senkaiden Houshin Engi Yori (Japan).ws')

-- ID 159
UPDATE wonderswan_games SET name = 'Sennou Millennium (Japan)' WHERE id = 159;
-- (était: 'Sennou Millennium (Japan).ws')

-- ID 305
UPDATE wonderswan_games SET name = 'Shaman King - Asu e no Ishi' WHERE id = 305;
-- (était: 'Shaman King - Asu e no Ishi (Japan) (Rev 1)')

-- ID 160
UPDATE wonderswan_games SET name = 'Shanghai Pocket (Japan)' WHERE id = 160;
-- (était: 'Shanghai Pocket (Japan).ws')

-- ID 161
UPDATE wonderswan_games SET name = 'Shin Nihon Pro Wrestling - Toukon Retsuden' WHERE id = 161;
-- (était: 'Shin Nihon Pro Wrestling - Toukon Retsuden (Japan) (Rev 1).ws')

-- ID 162
UPDATE wonderswan_games SET name = 'Shougi Touryuumon (Japan)' WHERE id = 162;
-- (était: 'Shougi Touryuumon (Japan).ws')

-- ID 163
UPDATE wonderswan_games SET name = 'Side Pocket (Japan)' WHERE id = 163;
-- (était: 'Side Pocket for WonderSwan (Japan).ws')

-- ID 164
UPDATE wonderswan_games SET name = 'Slipull' WHERE id = 164;
-- (était: 'Slipull (World) (WonderWitch) (Unl).ws')

-- ID 165
UPDATE wonderswan_games SET name = 'Slipull Lite' WHERE id = 165;
-- (était: 'Slipull Lite (World) (Proto) (WonderWitch) (Unl).ws')

-- ID 166
UPDATE wonderswan_games SET name = 'Slither Link (Japan)' WHERE id = 166;
-- (était: 'Slither Link (Japan).ws')

-- ID 167
UPDATE wonderswan_games SET name = 'Snake for WonderWitch' WHERE id = 167;
-- (était: 'Snake for WonderWitch (World) (WonderWitch) (Unl).ws')

-- ID 168
UPDATE wonderswan_games SET name = 'Soccer Yarou! - Challenge the World (Japan)' WHERE id = 168;
-- (était: 'Soccer Yarou! - Challenge the World (Japan).ws')

-- ID 307
UPDATE wonderswan_games SET name = 'Sorobang' WHERE id = 307;
-- (était: 'Sorobang (Japan) (Rev 1)')

-- ID 169
UPDATE wonderswan_games SET name = 'Sotsugyou' WHERE id = 169;
-- (était: 'Sotsugyou for WonderSwan (Japan) (Rev 1).ws')

-- ID 170
UPDATE wonderswan_games SET name = 'Space Invaders (Japan)' WHERE id = 170;
-- (était: 'Space Invaders (Japan).ws')

-- ID 309
UPDATE wonderswan_games SET name = 'Star Hearts - Hoshi to Daichi no Shisha - Taikenban' WHERE id = 309;
-- (était: 'Star Hearts - Hoshi to Daichi no Shisha - Taikenban (Japan) (Not For Sale)')

-- ID 172
UPDATE wonderswan_games SET name = 'Super Robot Taisen Compact' WHERE id = 172;
-- (était: 'Super Robot Taisen Compact (Japan) (Rev 1).ws')

-- ID 173
UPDATE wonderswan_games SET name = 'Super Robot Taisen Compact' WHERE id = 173;
-- (était: 'Super Robot Taisen Compact (Japan) (Rev 2).ws')

-- ID 171
UPDATE wonderswan_games SET name = 'Super Robot Taisen Compact (Japan)' WHERE id = 171;
-- (était: 'Super Robot Taisen Compact (Japan).ws')

-- ID 174
UPDATE wonderswan_games SET name = 'Super Robot Taisen Compact 2 - Dai-1-bu - Chijou Gekidou Hen (Japan)' WHERE id = 174;
-- (était: 'Super Robot Taisen Compact 2 - Dai-1-bu - Chijou Gekidou Hen (Japan).ws')

-- ID 175
UPDATE wonderswan_games SET name = 'Super Robot Taisen Compact 2 - Dai-2-bu - Uchuu Gekishin Hen' WHERE id = 175;
-- (était: 'Super Robot Taisen Compact 2 - Dai-2-bu - Uchuu Gekishin Hen (Japan) (Rev 4).ws')

-- ID 176
UPDATE wonderswan_games SET name = 'Super Robot Taisen Compact 2 - Dai-3-bu - Ginga Kessen Hen' WHERE id = 176;
-- (était: 'Super Robot Taisen Compact 2 - Dai-3-bu - Ginga Kessen Hen (Japan) (Rev 2).ws')

-- ID 310
UPDATE wonderswan_games SET name = 'Super Robot Taisen Compact 3' WHERE id = 310;
-- (était: 'Super Robot Taisen Compact 3 (Japan) (Rev 5)')

-- ID 311
UPDATE wonderswan_games SET name = 'Super Robot Taisen Compact 3' WHERE id = 311;
-- (était: 'Super Robot Taisen Compact 3 (Japan) (Rev 6)')

-- ID 312
UPDATE wonderswan_games SET name = 'Super Robot Taisen Compact Color (Japan)' WHERE id = 312;
-- (était: 'Super Robot Taisen Compact for WonderSwan Color (Japan)')

-- ID 177
UPDATE wonderswan_games SET name = 'Taikyoku Igo - Heisei Kiin (Japan)' WHERE id = 177;
-- (était: 'Taikyoku Igo - Heisei Kiin (Japan).ws')

-- ID 178
UPDATE wonderswan_games SET name = 'Taisen Othello Game' WHERE id = 178;
-- (était: 'Taisen Othello Game (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 179
UPDATE wonderswan_games SET name = 'Taitoru Moji Koudo-hyo' WHERE id = 179;
-- (était: 'Taitoru Moji Koudo-hyo (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 180
UPDATE wonderswan_games SET name = 'Tanjou Debut' WHERE id = 180;
-- (était: 'Tanjou Debut for WonderSwan (Japan) (Rev 1).ws')

-- ID 181
UPDATE wonderswan_games SET name = 'Tare Panda no GunPey (Japan)' WHERE id = 181;
-- (était: 'Tare Panda no GunPey (Japan).ws')

-- ID 182
UPDATE wonderswan_games SET name = 'Tekken Card Challenge (Japan)' WHERE id = 182;
-- (était: 'Tekken Card Challenge (Japan).ws')

-- ID 183
UPDATE wonderswan_games SET name = 'Tenori-on' WHERE id = 183;
-- (était: 'Tenori-on (Japan) (En).ws')

-- ID 184
UPDATE wonderswan_games SET name = 'Terrors (Japan)' WHERE id = 184;
-- (était: 'Terrors (Japan).ws')

-- ID 185
UPDATE wonderswan_games SET name = 'Testarossa' WHERE id = 185;
-- (était: 'Testarossa (World) (WonderWitch) (Unl).ws')

-- ID 186
UPDATE wonderswan_games SET name = 'Tetsujin 28 Gou (Japan)' WHERE id = 186;
-- (était: 'Tetsujin 28 Gou (Japan).ws')

-- ID 187
UPDATE wonderswan_games SET name = 'Time Bokan Series - Bokan Densetsu - Buta mo Odaterya Doronboo (Japan)' WHERE id = 187;
-- (était: 'Time Bokan Series - Bokan Densetsu - Buta mo Odaterya Doronboo (Japan).ws')

-- ID 188
UPDATE wonderswan_games SET name = 'Tokyo Majin Gakuen - Fuju Houroku (Japan)' WHERE id = 188;
-- (était: 'Tokyo Majin Gakuen - Fuju Houroku (Japan).ws')

-- ID 189
UPDATE wonderswan_games SET name = 'Trap Trap' WHERE id = 189;
-- (était: 'Trap Trap (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 190
UPDATE wonderswan_games SET name = 'Triangle' WHERE id = 190;
-- (était: 'Triangle (World) (WonderWitch) (Unl).ws')

-- ID 191
UPDATE wonderswan_games SET name = 'Truchet' WHERE id = 191;
-- (était: 'Truchet (World) (WonderWitch) (Unl).ws')

-- ID 192
UPDATE wonderswan_games SET name = 'Trump Collection - Bottom-Up Teki Trump Seikatsu' WHERE id = 192;
-- (était: 'Trump Collection - Bottom-Up Teki Trump Seikatsu (Japan) (Rev 1).ws')

-- ID 193
UPDATE wonderswan_games SET name = 'Trump Collection 2 - Bottom-Up Teki Sekaiisshuu no Tabi' WHERE id = 193;
-- (était: 'Trump Collection 2 - Bottom-Up Teki Sekaiisshuu no Tabi (Japan) (Rev 1).ws')

-- ID 194
UPDATE wonderswan_games SET name = 'Tsubo Game' WHERE id = 194;
-- (était: 'Tsubo Game (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 195
UPDATE wonderswan_games SET name = 'Tumble' WHERE id = 195;
-- (était: 'Tumble (World) (WonderWitch) (Unl).ws')

-- ID 196
UPDATE wonderswan_games SET name = 'Turntablist - DJ Battle (Japan)' WHERE id = 196;
-- (était: 'Turntablist - DJ Battle (Japan).ws')

-- ID 197
UPDATE wonderswan_games SET name = 'Umetatte' WHERE id = 197;
-- (était: 'Umetatte (World) (WonderWitch) (Unl).ws')

-- ID 198
UPDATE wonderswan_games SET name = 'Umizuri ni Ikou! (Japan)' WHERE id = 198;
-- (était: 'Umizuri ni Ikou! (Japan).ws')

-- ID 199
UPDATE wonderswan_games SET name = 'Uzumaki - Denshi Kaiki Hen' WHERE id = 199;
-- (était: 'Uzumaki - Denshi Kaiki Hen (Japan) (Rev 4).ws')

-- ID 200
UPDATE wonderswan_games SET name = 'Uzumaki - Noroi Simulation (Japan)' WHERE id = 200;
-- (était: 'Uzumaki - Noroi Simulation (Japan).ws')

-- ID 201
UPDATE wonderswan_games SET name = 'V-Attacker' WHERE id = 201;
-- (était: 'V-Attacker (World) (WonderWitch) (Unl).ws')

-- ID 202
UPDATE wonderswan_games SET name = 'Vaitz Blade' WHERE id = 202;
-- (était: 'Vaitz Blade (Japan) (Rev 1).ws')

-- ID 203
UPDATE wonderswan_games SET name = 'Virus' WHERE id = 203;
-- (était: 'Virus (World) (WonderWitch) (Unl).ws')

-- ID 204
UPDATE wonderswan_games SET name = 'Wago' WHERE id = 204;
-- (était: 'Wago (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 205
UPDATE wonderswan_games SET name = 'Wasabi Produce - Street Dancer (Japan)' WHERE id = 205;
-- (était: 'Wasabi Produce - Street Dancer (Japan).ws')

-- ID 206
UPDATE wonderswan_games SET name = 'Wave Q' WHERE id = 206;
-- (était: 'Wave Q (World) (Ja) (WonderWitch) (Unl).ws')

-- ID 207
UPDATE wonderswan_games SET name = 'Wave R' WHERE id = 207;
-- (était: 'Wave R (World) (v1.0) (WonderWitch) (WWGP2003) (Unl).ws')

-- ID 208
UPDATE wonderswan_games SET name = 'Wave R' WHERE id = 208;
-- (était: 'Wave R (World) (v1.1) (WonderWitch) (Unl).ws')

-- ID 209
UPDATE wonderswan_games SET name = 'With a Dory' WHERE id = 209;
-- (était: 'With a Dory (World) (Ja) (Proto) (WonderWitch) (Unl).ws')

-- ID 210
UPDATE wonderswan_games SET name = 'Wonder Recorder' WHERE id = 210;
-- (était: 'Wonder Recorder (World) (Ja) (v1.00) (WonderWitch) (WWGP2001) (Unl).ws')

-- ID 211
UPDATE wonderswan_games SET name = 'Wonder Recorder' WHERE id = 211;
-- (était: 'Wonder Recorder (World) (Ja) (v1.01) (WonderWitch) (Unl).ws')

-- ID 212
UPDATE wonderswan_games SET name = 'Wonder Stadium ''99 (Japan)' WHERE id = 212;
-- (était: 'Wonder Stadium ''99 (Japan).ws')

-- ID 213
UPDATE wonderswan_games SET name = 'Wonder Stadium (Japan)' WHERE id = 213;
-- (était: 'Wonder Stadium (Japan).ws')

-- ID 214
UPDATE wonderswan_games SET name = 'Wonder Su-Zi-' WHERE id = 214;
-- (était: 'Wonder Su-Zi- (World) (WonderWitch) (Unl).ws')

-- ID 215
UPDATE wonderswan_games SET name = 'WonderSwan Handy Sonar' WHERE id = 215;
-- (était: 'WonderSwan Handy Sonar (Japan) (Rev 1).ws')

-- ID 216
UPDATE wonderswan_games SET name = 'WonderSwan Handy Sonar' WHERE id = 216;
-- (était: 'WonderSwan Handy Sonar (Japan) (Rev 2).ws')

-- ID 217
UPDATE wonderswan_games SET name = 'Yopparau Game for WonderWitch' WHERE id = 217;
-- (était: 'Yopparau Game for WonderWitch (World) (WonderWitch) (Unl).ws')

-- Valider la transaction
COMMIT;

-- ============================================================================
-- RÉSUMÉ
-- ============================================================================
-- Jeux mis à jour: 245
-- Doublons supprimés: 15
-- ============================================================================
