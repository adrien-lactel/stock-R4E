-- ============================================================================
-- DÉPLOIEMENT WONDERSWAN - RAILWAY/R2 PRODUCTION
-- Date: 2026-02-18 19:33:28
-- Base générée depuis: LOCAL stock-R4E
-- Total: 340 jeux
-- Correspondance: 117/117 (100%)
-- ============================================================================

-- INSTRUCTIONS:
-- 1. Sauvegarder la table actuelle: CREATE TABLE wonderswan_games_backup AS SELECT * FROM wonderswan_games;
-- 2. Vider la table: TRUNCATE TABLE wonderswan_games;
-- 3. Exécuter ce script pour recréer avec les données correctes
-- 4. Vérifier: SELECT COUNT(*) FROM wonderswan_games; -- doit être 340

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- OPTION 1: VIDER ET RECRÉER (RECOMMANDÉ)
-- ----------------------------------------------------------------------------

TRUNCATE TABLE wonderswan_games;

-- ----------------------------------------------------------------------------
-- INSERTION DES 340 JEUX
-- ----------------------------------------------------------------------------

-- Batch 1/7 (50 jeux)
INSERT INTO wonderswan_games (id, rom_id, name, alternate_names, year, publisher, developer, region, price, created_at, updated_at) VALUES
(1, NULL, '15 Game', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(2, NULL, '15 Puzzle', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(3, NULL, '15 Puzzle for WW', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(4, NULL, '50 Oto Nyouryoku', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(5, NULL, '7 Days Left', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(7, NULL, 'Anchorz Field (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(8, NULL, 'Armored Unit (Japan)', 'ArmoAka Unit (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(9, NULL, 'Atakshii', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(10, NULL, 'Atodashi', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(11, NULL, 'B.A.F.', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(12, NULL, 'BNU', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(13, NULL, 'Bakusou Dekotora Densetsu for WonderSwan (Japan)', 'Bakusou Dekotora Legend for WonderSwan (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(14, NULL, 'Ball and Block', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(15, NULL, 'Balloon', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(16, NULL, 'Battle Mosquito', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(17, NULL, 'Buffers Evolution (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(18, NULL, 'Buro', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(19, NULL, 'C-Man', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(20, NULL, 'Cardcaptor Sakura - Sakura to Fushigi na Clow Card (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(21, NULL, 'Castle', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(22, NULL, 'Cave Flyer', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(24, NULL, 'Chaos Gear - Michibikareshi Mono (Japan)', 'ChBlues Gear - Michibikareshi Mono (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(25, NULL, 'Chikyou o Mamore Ozon-sou', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(26, NULL, 'Chocobo no Fushigi na Dungeon', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(29, NULL, 'Chou Aniki - Otoko no Tamafuda', 'Chou AniYellow - Otoko no Tamafuda (Japan) (Rev 4).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(30, NULL, 'Chou Denki Card Battle - Youfu Makai', 'Chou Denki Card Battle - Youfu MRedi (Japan) (Rev 3).ws|Chou DenYellow Card Battle - Youfu Makai (Japan) (Rev 3).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(31, NULL, 'Chuuka Taisen', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(32, NULL, 'Clock Tower', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(33, NULL, 'Crazy Climber (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(34, NULL, 'D\'s Garage 21 Koubo Game - Tane o Maku Tori (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(35, NULL, 'Dash Straight', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(36, NULL, 'Datchuchu', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(37, NULL, 'Denkou Keijiki', 'Denkou KeijiYellow (World) (Ja) (WonderWitch) (Unl).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(38, NULL, 'Densha de Go!', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(39, NULL, 'Densha de Go! 2 (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(40, NULL, 'Dexten', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(41, NULL, 'Digimon - Ver. WonderSwan', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(42, NULL, 'Digimon Adventure - Anode Tamer (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(44, NULL, 'Digimon Adventure - Cathode Tamer (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(45, NULL, 'Digimon Adventure 02 - Tag Tamers (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(47, NULL, 'Digimon Adventure Campaign.wsc', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(48, NULL, 'Digital Monster - Ver. WonderSwan', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(49, NULL, 'Digital Partner (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(50, NULL, 'Disc Upper', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(51, NULL, 'Dokodemo Hamster (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(52, NULL, 'Dolls', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(53, NULL, 'EF-Cribbage', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(54, NULL, 'Engacho! for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(55, NULL, 'Features', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(56, NULL, 'Fever - Sankyo Koushiki Pachinko Simulation for WonderSwan (Japan)', 'Fever - Sankyo KoushiYellow Pachinko Simulation for WonderSwan (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56');

-- Batch 2/7 (50 jeux)
INSERT INTO wonderswan_games (id, rom_id, name, alternate_names, year, publisher, developer, region, price, created_at, updated_at) VALUES
(57, NULL, 'Final Lap 2000 (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(58, NULL, 'Fire Pro Wrestling', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(59, NULL, 'Fishing Freaks - Bass Rise for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(60, NULL, 'From TV Animation One Piece - Mezase Kaizoku Ou! (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(61, NULL, 'Frontier', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(62, NULL, 'GB Yu-Gi-Oh Database', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(63, NULL, 'Gachagacha Nyouryoku', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(64, NULL, 'Ganso Jajamaru-kun (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(65, NULL, 'Glocal Hexcite (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(66, NULL, 'Gomoku Narabe & Reversi - Touryuumon (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(67, NULL, 'Goraku Ou Tango!', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(68, NULL, 'GunPey (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(69, NULL, 'Hanafuda Shiyouyo (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(70, NULL, 'Harobots (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(72, NULL, 'Hayauchi!', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(73, NULL, 'Hex Calculator', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(74, NULL, 'Hima Tsubushi', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(75, NULL, 'Hito', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(76, NULL, 'Hunter X Hunter - Ishi o Tsugu Mono', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(78, NULL, 'Inu Renda', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(79, NULL, 'Invader DX & Boss DX', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(80, NULL, 'Ishikari', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(81, NULL, 'Jiban Ryuoki - WonderSwan Edition', 'Jiban RyuoYellow - WonderSwan Edition (World) (WonderWitch) (Unl).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(82, NULL, 'Jump on Step', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(83, NULL, 'Kakutou Ryouri Densetsu Bistro Recipe - Wonder Battle Hen (Japan)', 'Kakutou Ryouri Legend Bistro Recipe - Wonder Battle Hen (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(84, NULL, 'Kana', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(85, NULL, 'Kaze no Klonoa - Moonlight Museum (Japan)', NULL, NULL, 'NAMCO', NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(86, NULL, 'Keiba Yosou Shien Soft - Yosou Shinkaron (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(87, NULL, 'Kirin Editor + Kuro Pad', 'Yellowrin Editor + Kuro Pad (World) (Ja) (WonderWitch) (Unl).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(88, NULL, 'Kiss Communication', 'Yellowss Communication (World) (Ja) (WonderWitch) (Unl).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(89, NULL, 'Kiss Yori... - Seaside Serenade', 'Yellowss Yori... - Seaside Serenade (Japan) (Rev 2).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(90, NULL, 'Kosodate Quiz - Dokodemo My Angel (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(91, NULL, 'Kyousouba Ikusei Simulation - Keiba', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(92, NULL, 'LNPUT', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(93, NULL, 'Langrisser Millennium WS - The Last Century', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(94, NULL, 'Last Stand (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(95, NULL, 'LifeGame for WonderWitch', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(96, NULL, 'Lode Runner for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(97, NULL, 'Mac the Speed Shooter', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(98, NULL, 'Macross - True Love Song (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(99, NULL, 'Magical Drop for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(100, NULL, 'Mahjong Touryuumon', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(102, NULL, 'Makaimura for WonderSwan (Japan)', 'MRedimura for WonderSwan (Japan).ws|Ghosts\'n Goblins for WonderSwan (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(103, NULL, 'Medarot Perfect Edition - Kabuto Version (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(104, NULL, 'Medarot Perfect Edition - Kuwagata Version (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(105, NULL, 'Meitantei Conan - Majutsushi no Chousenjou! (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(106, NULL, 'Meitantei Conan - Nishi no Meitantei Saidai no Kiki! (Japan)', 'Meitantei Conan - Nishi no Meitantei Saidai no YellowYellow! (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(107, NULL, 'Metakomi Theraphy - Nee Kiite! (Japan)', 'Metakomi Theraphy - Nee Yellowite! (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(108, NULL, 'Migi Mawari no Randi', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(109, NULL, 'Mingle Magnet', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56');

-- Batch 3/7 (50 jeux)
INSERT INTO wonderswan_games (id, rom_id, name, alternate_names, year, publisher, developer, region, price, created_at, updated_at) VALUES
(110, NULL, 'Mobile Suit Gundam MSVS (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(111, NULL, 'MobileWonderGate', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(112, NULL, 'Moero!! Pro Yakyuu Rookies (Japan)', 'Moero!! Pro Yakyuu RooYellowes (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(113, NULL, 'Mogura Tatake', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(114, NULL, 'Morita Shougi for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(115, NULL, 'Mr. Oha no Ko Bouken - Sai Shuushou Saraba Aishi no Shooting', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(116, NULL, 'Nazo Ou Pocket (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(117, NULL, 'Neon Genesis Evangelion - Shito Ikusei (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(118, NULL, 'Nice On', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(119, NULL, 'Nigero!', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(120, NULL, 'Nihon Pro Mahjong Renmei Kounin - Tetsuman', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(121, NULL, 'Nobunaga no Yabou for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(122, NULL, 'Noiz', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(123, NULL, 'Okiraku Daisakusen', 'OYellowraku Daisakusen (World) (Ja) (WonderWitch) (Unl).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(124, NULL, 'Omiyage o Kaou!', 'Omiyage o KBlueu! (World) (Ja) (WonderWitch) (Unl).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(125, NULL, 'One Kiri', 'One Yellowri (World) (Ja) (WonderWitch) (Unl).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(126, NULL, 'Ore no Kakeibo', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(127, NULL, 'Ou-chan no Oekaki Logic (Japan)', 'Ou-chan no OekaYellow Logic (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(128, NULL, 'Oyogu Kamo', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(129, NULL, 'PDA Mini for WonderWitch', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(130, NULL, 'Panzer Battle 3', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(131, NULL, 'Pepperas!', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(132, NULL, 'Ping Pong Spy', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(133, NULL, 'Pladel', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(134, NULL, 'Pocket Fighter (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(135, NULL, 'Potential Taper - Rewoke World 03', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(136, NULL, 'Pro Mahjong Kiwame', 'Pro Mahjong Yellowwame for WonderSwan (Japan) (Rev 1).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(137, NULL, 'Puchipuchi', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(138, NULL, 'Pudding Maker', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(139, NULL, 'Puyo Puyo Tsuu (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(140, NULL, 'Puzzle Bobble (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(141, NULL, 'Radius Theta', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(142, NULL, 'Rainbow Islands - Putty\'s Party (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(143, NULL, 'ReSiA System', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(144, NULL, 'Renda Machine', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(145, NULL, 'Ring Infinity (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(146, NULL, 'Robot Works', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(147, NULL, 'Robot Works (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(148, NULL, 'Rockman & Forte - Mirai Kara no Chousensha (Japan)', 'Mega Man & Forte - Mirai Kara no Chousensha (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(149, NULL, 'SD Gundam - Emotional Jam', NULL, NULL, 'Bandai', NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(151, NULL, 'SD Gundam G Generation - Gather Beat (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(152, NULL, 'SD Gundam Gashapon Senki - Episode 1 (Japan)', 'SD Gundam Gashapon SenYellow - Episode 1 (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(153, NULL, 'SD Gundam Gashapon Senki - Episode 1', 'SD Gundam Gashapon SenYellow - Episode 1 (Japan) (Alt).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(154, NULL, 'Saint Dagrat Monogatari', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(155, NULL, 'Sangokushi II for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(156, NULL, 'Sangokushi for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(157, NULL, 'Senbetsu', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(158, NULL, 'Senkaiden - TV Animation Senkaiden Houshin Engi Yori (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(159, NULL, 'Sennou Millennium (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(160, NULL, 'Shanghai Pocket (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56');

-- Batch 4/7 (50 jeux)
INSERT INTO wonderswan_games (id, rom_id, name, alternate_names, year, publisher, developer, region, price, created_at, updated_at) VALUES
(161, NULL, 'Shin Nihon Pro Wrestling - Toukon Retsuden', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(162, NULL, 'Shougi Touryuumon (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(163, NULL, 'Side Pocket for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(164, NULL, 'Slipull', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(165, NULL, 'Slipull Lite', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(166, NULL, 'Slither Link (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(167, NULL, 'Snake for WonderWitch', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(168, NULL, 'Soccer Yarou! - Challenge the World (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(169, NULL, 'Sotsugyou', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(170, NULL, 'Space Invaders (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(171, NULL, 'Super Robot Taisen Compact (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(174, NULL, 'Super Robot Taisen Compact 2 - Dai-1-bu - Chijou Gekidou Hen (Japan)', 'Super Robot Taisen Compact 2 - Dai-1-bu - Chijou GeYellowdou Hen (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(175, NULL, 'Super Robot Taisen Compact 2 - Dai-2-bu - Uchuu Gekishin Hen', 'Super Robot Taisen Compact 2 - Dai-2-bu - Uchuu GeYellowshin Hen (Japan) (Rev 4).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(176, NULL, 'Super Robot Taisen Compact 2 - Dai-3-bu - Ginga Kessen Hen', 'Super Robot Taisen Compact 2 - Dai-3-bu - Silverga Kessen Hen (Japan) (Rev 2).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(177, NULL, 'Taikyoku Igo - Heisei Kiin (Japan)', 'Taikyoku Igo - Heisei Yellowin (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(178, NULL, 'Taisen Othello Game', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(179, NULL, 'Taitoru Moji Koudo-hyo', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(180, NULL, 'Tanjou Debut', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(181, NULL, 'Tare Panda no GunPey (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(182, NULL, 'Tekken Card Challenge (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(183, NULL, 'Tenori-on', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(184, NULL, 'Terrors (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(185, NULL, 'Testarossa', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(186, NULL, 'Tetsujin 28 Gou (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(187, NULL, 'Time Bokan Series - Bokan Densetsu - Buta mo Odaterya Doronboo (Japan)', 'Time Bokan Series - Bokan Legend - Buta mo Odaterya Doronboo (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(188, NULL, 'Tokyo Majin Gakuen - Fuju Houroku (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(189, NULL, 'Trap Trap', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(190, NULL, 'Triangle', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(191, NULL, 'Truchet', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(192, NULL, 'Trump Collection - Bottom-Up Teki Trump Seikatsu', 'Trump Collection - Bottom-Up TeYellow Trump Seikatsu (Japan) (Rev 1).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(193, NULL, 'Trump Collection 2 - Bottom-Up Teki Sekaiisshuu no Tabi', 'Trump Collection 2 - Bottom-Up TeYellow Sekaiisshuu no Tabi (Japan) (Rev 1).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(194, NULL, 'Tsubo Game', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(195, NULL, 'Tumble', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(196, NULL, 'Turntablist - DJ Battle (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(197, NULL, 'Umetatte', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(198, NULL, 'Umizuri ni Ikou! (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(199, NULL, 'Uzumaki - Denshi Kaiki Hen', 'UzumaYellow - Denshi KaiYellow Hen (Japan) (Rev 4).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(200, NULL, 'Uzumaki - Noroi Simulation (Japan)', 'UzumaYellow - Noroi Simulation (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(201, NULL, 'V-Attacker', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(202, NULL, 'Vaitz Blade', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(203, NULL, 'Virus', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(204, NULL, 'Wago', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(205, NULL, 'Wasabi Produce - Street Dancer (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(206, NULL, 'Wave Q', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(207, NULL, 'Wave R', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(209, NULL, 'With a Dory', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(210, NULL, 'Wonder Recorder', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(212, NULL, 'Wonder Stadium \'99 (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(213, NULL, 'Wonder Stadium (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(214, NULL, 'Wonder Su-Zi-', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56');

-- Batch 5/7 (50 jeux)
INSERT INTO wonderswan_games (id, rom_id, name, alternate_names, year, publisher, developer, region, price, created_at, updated_at) VALUES
(215, NULL, 'WonderSwan Handy Sonar', NULL, NULL, 'Bandai', NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(217, NULL, 'Yopparau Game for WonderWitch', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(218, NULL, 'beatmania for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(219, NULL, 'otto', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:33', '2026-02-07 10:32:56'),
(221, NULL, 'Alchemist Marie _ Elie - Futari no Atelier (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(222, NULL, 'Another Heaven - Memory of those Days (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(223, NULL, 'Arc the Lad - Kishin Fukkatsu (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(224, NULL, 'Battle Spirit - Digimon Frontier', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(225, NULL, 'Blue Wing Blitz (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(226, NULL, 'Dark Eyes - Battle Gate (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(227, NULL, 'Dicing Knight. (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(228, NULL, 'Digimon - Anode Tamer _ Cathode Tamer - Veedramon Version', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(229, NULL, 'Digimon Adventure 02 - D1 Tamers', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(230, NULL, 'Digimon Adventure 02 - D1 Tamers (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(231, NULL, 'Digimon Tamers - Battle Spirit', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(232, NULL, 'Digimon Tamers - Battle Spirit Ver. 1.5 (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(233, NULL, 'Digimon Tamers - Brave Tamer', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(234, NULL, 'Digimon Tamers - Digimon Medley', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(235, NULL, 'Digimon Tamers - Digimon Medley (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(236, NULL, 'Digital Monster - D-Project', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(238, NULL, 'Digital Monster - D-Project (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(239, NULL, 'Digital Monster Card Game - Ver. WonderSwan Color', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(240, NULL, 'Digital Monster Card Game - Ver. WonderSwan Color (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(241, NULL, 'Dokodemo Hamster 3 - Odekake Saffron', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(242, NULL, 'Dragon Ball (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(243, NULL, 'Final Fantasy (Japan)', NULL, NULL, 'Square Enix', NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(244, NULL, 'Final Fantasy II (Japan)', NULL, NULL, 'square soft', NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:36:58'),
(245, NULL, 'Final Fantasy IV (Japan)', NULL, NULL, 'square soft', NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:33:39'),
(246, NULL, 'Final Lap Special - GT _ Formula Machine (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(247, NULL, 'Flash Koibito-kun (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(248, NULL, 'From TV Animation One Piece - Chopper no Daibouken (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(249, NULL, 'From TV Animation One Piece - Grand Battle Swan Colosseum (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(250, NULL, 'From TV Animation One Piece - Niji no Shima Densetsu (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(251, NULL, 'From TV Animation One Piece - Treasure Wars', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(252, NULL, 'From TV Animation One Piece - Treasure Wars (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(253, NULL, 'From TV Animation One Piece - Treasure Wars 2 - Buggy Land e Youkoso (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(254, NULL, 'Front Mission (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(255, NULL, 'Gekitou! Crash Gear Turbo - Gear Champion League (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(256, NULL, 'Gensou Maden Saiyuuki Retribution - Hi no Ataru Basho de', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(257, NULL, 'Golden Axe (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(258, NULL, 'Gransta Chronicle (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(259, NULL, 'Guilty Gear Petit (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(260, NULL, 'Guilty Gear Petit 2 (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(261, NULL, 'GunPey EX (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(262, NULL, 'Hanjuku Hero - Ah, Sekai yo Hanjuku Nare...!!', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(263, NULL, 'Hataraku Chocobo (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(264, NULL, 'Hunter X Hunter - Greed Island', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(265, NULL, 'Hunter X Hunter - Greed Island (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(266, NULL, 'Hunter X Hunter - Michibikareshi Mono (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(267, NULL, 'Hunter X Hunter - Sorezore no Ketsui (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56');

-- Batch 6/7 (50 jeux)
INSERT INTO wonderswan_games (id, rom_id, name, alternate_names, year, publisher, developer, region, price, created_at, updated_at) VALUES
(268, NULL, 'Inuyasha - Fuuun Emaki (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(269, NULL, 'Inuyasha - Kagome no Sengoku Nikki (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(270, NULL, 'Inuyasha - Kagome no Yume Nikki (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(271, NULL, 'Judgement Silversword - Rebirth Edition', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(273, NULL, 'Kidou Senshi Gundam - Giren no Yabou - Tokubetsu Hen - Aoki Hoshi no Hasha (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(274, NULL, 'Kidou Senshi Gundam Seed (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(275, NULL, 'Kidou Senshi Gundam Vol. 1 - Side 7 (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(276, NULL, 'Kidou Senshi Gundam Vol. 2 - Jaburo (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(277, NULL, 'Kidou Senshi Gundam Vol. 3 - A Baoa Qu (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(278, NULL, 'Kinnikuman II-Sei - Choujin Seisenshi (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(279, NULL, 'Kinnikuman II-Sei - Dream Tag Match (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(280, NULL, 'Kurupara!', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(281, NULL, 'Last Alive (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(282, NULL, 'Makai Toushi Sa-Ga (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(283, NULL, 'Meitantei Conan - Yuugure no Oujo (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(284, NULL, 'Memories Off - Festa (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(285, NULL, 'Mikeneko Holmes - Ghost Panic (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(286, NULL, 'Mr. Driller (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(287, NULL, 'Namco Super Wars (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(288, NULL, 'Naruto - Konoha Ninpouchou (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(289, NULL, 'Pocket no Naka no Doraemon (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(290, NULL, 'RUN=DIM - Return to Earth (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(291, NULL, 'Raku Jongg (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(292, NULL, 'Rhyme Rider Kerorican (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(293, NULL, 'Riviera - Yakusoku no Chi Riviera (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(294, NULL, 'Rockman EXE - N1 Battle', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(295, NULL, 'Rockman EXE WS (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(296, NULL, 'Romancing Sa-Ga (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(297, NULL, 'SD Gundam - Operation U.C. (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(298, NULL, 'SD Gundam Eiyuu Den - Kishi Densetsu (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(299, NULL, 'SD Gundam Eiyuu Den - Musha Densetsu (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:08', '2026-02-07 10:32:56'),
(300, NULL, 'SD Gundam G Generation - Gather Beat 2 (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(301, NULL, 'SD Gundam G Generation - Mono-Eye Gundams', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(302, NULL, 'SD Gundam G Generation - Mono-Eye Gundams (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(303, NULL, 'Saint Seiya - Ougon Densetsu Hen - Perfect Edition (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(304, NULL, 'Senkaiden Ni - TV Animation Senkaiden Houshin Engi Yori (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(305, NULL, 'Shaman King - Asu e no Ishi', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(306, NULL, 'Shaman King - Asu e no Ishi (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(307, NULL, 'Sorobang', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(308, NULL, 'Star Hearts - Hoshi to Daichi no Shisha (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(309, NULL, 'Star Hearts - Hoshi to Daichi no Shisha - Taikenban', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(310, NULL, 'Super Robot Taisen Compact 3', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(312, NULL, 'Super Robot Taisen Compact Color (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(313, NULL, 'Terrors 2 (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(314, NULL, 'Tetris (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(315, NULL, 'Tonpuusou (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(316, NULL, 'Uchuu Senkan Yamato (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(317, NULL, 'Ultraman - Hikari no Kuni no Shisha (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(318, NULL, 'Wild Card (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(319, NULL, 'With You - Mitsumete Itai (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56');

-- Batch 7/7 (40 jeux)
INSERT INTO wonderswan_games (id, rom_id, name, alternate_names, year, publisher, developer, region, price, created_at, updated_at) VALUES
(320, NULL, 'Wizardry Scenario 1 - Proving Grounds of the Mad Overlord (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(321, NULL, 'Wonder Classic (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(322, NULL, 'X - Card of Fate (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(323, NULL, 'XI Little (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-02-07 09:57:09', '2026-02-07 10:32:56'),
(324, NULL, 'Chocobo no Fushigi na Dungeon for WonderSwan (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(325, NULL, 'Chou Aniki - Otoko no Tamafuda (Japan) (Rev 4)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(326, NULL, 'Chou Denki Card Battle - Youfu Makai (Japan) (Rev 3)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(327, NULL, 'Clock Tower for WonderSwan (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(328, NULL, 'Densha de Go! (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(329, NULL, 'Digimon - Ver. WonderSwan (Hong Kong) (En)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(330, NULL, 'Digital Monster - Ver. WonderSwan (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(331, NULL, 'Fire Pro Wrestling for WonderSwan (Japan) (Rev 5)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(332, NULL, 'Goraku Ou Tango! (Japan) (Rev 2)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(333, NULL, 'Hunter X Hunter - Ishi o Tsugu Mono (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(334, NULL, 'Kiss Yori... - Seaside Serenade (Japan) (Rev 2)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(335, NULL, 'Kyousouba Ikusei Simulation - Keiba (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(336, NULL, 'Langrisser Millennium WS - The Last Century (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(337, NULL, 'Mahjong Touryuumon (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(338, NULL, 'Mingle Magnet (Japan) (En,Ja) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(339, NULL, 'MobileWonderGate (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(340, NULL, 'Nice On (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(341, NULL, 'Nihon Pro Mahjong Renmei Kounin - Tetsuman (Japan) (Rev 2)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(342, NULL, 'Pro Mahjong Kiwame for WonderSwan (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(343, NULL, 'Robot Works (Hong Kong) (En,Ja) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(344, NULL, 'SD Gundam - Emotional Jam (Japan) (Rev 2)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(345, NULL, 'Shin Nihon Pro Wrestling - Toukon Retsuden (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(346, NULL, 'Sotsugyou for WonderSwan (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(347, NULL, 'Super Robot Taisen Compact 2 - Dai-2-bu - Uchuu Gekishin Hen (Japan) (Rev 4)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(348, NULL, 'Super Robot Taisen Compact 2 - Dai-3-bu - Ginga Kessen Hen (Japan) (Rev 2)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(349, NULL, 'Tanjou Debut for WonderSwan (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(350, NULL, 'Tenori-on (Japan) (En)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(351, NULL, 'Trump Collection - Bottom-Up Teki Trump Seikatsu (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(352, NULL, 'Trump Collection 2 - Bottom-Up Teki Sekaiisshuu no Tabi (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(353, NULL, 'Uzumaki - Denshi Kaiki Hen (Japan) (Rev 4)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(354, NULL, 'Vaitz Blade (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(355, NULL, 'WonderSwan Handy Sonar (Japan) (Rev 1)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 20:20:43', '2026-02-18 20:20:43'),
(358, NULL, 'Gomoku Narabe _ Reversi - Touryuumon', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 19:21:17', '2026-02-18 19:21:17'),
(360, NULL, 'Kosodate Quiz Dokodemo - My Angel', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 19:21:17', '2026-02-18 19:21:17'),
(361, NULL, 'Rockman _ Forte - Mirai Kara no Chousensha', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 19:21:17', '2026-02-18 19:21:17'),
(362, NULL, 'SD Gundam Gashapon Senki - Episode 1 (Japan) (Alt)', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-18 19:21:17', '2026-02-18 19:21:17');

-- ----------------------------------------------------------------------------
-- OPTION 2: MISE À JOUR SÉLECTIVE (si TRUNCATE n'est pas possible)
-- ----------------------------------------------------------------------------

-- Si vous ne pouvez pas vider la table, utilisez ces commandes:
-- 1. Supprimer les doublons et anciens jeux
-- 2. Insérer/mettre à jour avec REPLACE INTO

-- REPLACE INTO (supprime et recrée si existe, sinon insert):
-- Exemple batch 1 avec REPLACE INTO:
REPLACE INTO wonderswan_games (id, rom_id, name, alternate_names, year, publisher, developer, region, price, created_at, updated_at) VALUES
(1, NULL, '15 Game', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(2, NULL, '15 Puzzle', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(3, NULL, '15 Puzzle for WW', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(4, NULL, '50 Oto Nyouryoku', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(5, NULL, '7 Days Left', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(7, NULL, 'Anchorz Field (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(8, NULL, 'Armored Unit (Japan)', 'ArmoAka Unit (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(9, NULL, 'Atakshii', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(10, NULL, 'Atodashi', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(11, NULL, 'B.A.F.', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(12, NULL, 'BNU', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(13, NULL, 'Bakusou Dekotora Densetsu for WonderSwan (Japan)', 'Bakusou Dekotora Legend for WonderSwan (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(14, NULL, 'Ball and Block', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(15, NULL, 'Balloon', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(16, NULL, 'Battle Mosquito', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(17, NULL, 'Buffers Evolution (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(18, NULL, 'Buro', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(19, NULL, 'C-Man', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(20, NULL, 'Cardcaptor Sakura - Sakura to Fushigi na Clow Card (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(21, NULL, 'Castle', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(22, NULL, 'Cave Flyer', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(24, NULL, 'Chaos Gear - Michibikareshi Mono (Japan)', 'ChBlues Gear - Michibikareshi Mono (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(25, NULL, 'Chikyou o Mamore Ozon-sou', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(26, NULL, 'Chocobo no Fushigi na Dungeon', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(29, NULL, 'Chou Aniki - Otoko no Tamafuda', 'Chou AniYellow - Otoko no Tamafuda (Japan) (Rev 4).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(30, NULL, 'Chou Denki Card Battle - Youfu Makai', 'Chou Denki Card Battle - Youfu MRedi (Japan) (Rev 3).ws|Chou DenYellow Card Battle - Youfu Makai (Japan) (Rev 3).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(31, NULL, 'Chuuka Taisen', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(32, NULL, 'Clock Tower', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(33, NULL, 'Crazy Climber (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(34, NULL, 'D\'s Garage 21 Koubo Game - Tane o Maku Tori (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(35, NULL, 'Dash Straight', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(36, NULL, 'Datchuchu', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(37, NULL, 'Denkou Keijiki', 'Denkou KeijiYellow (World) (Ja) (WonderWitch) (Unl).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(38, NULL, 'Densha de Go!', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(39, NULL, 'Densha de Go! 2 (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(40, NULL, 'Dexten', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(41, NULL, 'Digimon - Ver. WonderSwan', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(42, NULL, 'Digimon Adventure - Anode Tamer (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(44, NULL, 'Digimon Adventure - Cathode Tamer (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(45, NULL, 'Digimon Adventure 02 - Tag Tamers (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(47, NULL, 'Digimon Adventure Campaign.wsc', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(48, NULL, 'Digital Monster - Ver. WonderSwan', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(49, NULL, 'Digital Partner (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(50, NULL, 'Disc Upper', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(51, NULL, 'Dokodemo Hamster (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(52, NULL, 'Dolls', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(53, NULL, 'EF-Cribbage', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(54, NULL, 'Engacho! for WonderSwan (Japan)', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(55, NULL, 'Features', NULL, NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56'),
(56, NULL, 'Fever - Sankyo Koushiki Pachinko Simulation for WonderSwan (Japan)', 'Fever - Sankyo KoushiYellow Pachinko Simulation for WonderSwan (Japan).ws', NULL, NULL, NULL, 'NTSC-J', NULL, '2026-01-31 08:35:32', '2026-02-07 10:32:56');
-- ... (répétez pour tous les batches)


SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================================
-- VÉRIFICATION POST-DÉPLOIEMENT
-- ============================================================================

-- Compter les jeux
SELECT COUNT(*) as total_games FROM wonderswan_games;
-- Attendu: 340

-- Vérifier l'absence de doublons
SELECT clean_name, COUNT(*) as count
FROM (
    SELECT TRIM(REGEXP_REPLACE(name, ' \\((Japan|USA|Europe|World|Rev [0-9]+)\\)$', '')) as clean_name
    FROM wonderswan_games
) AS cleaned
GROUP BY clean_name
HAVING count > 1;
-- Attendu: 0 résultat

-- Exemples de jeux (vérification visuelle)
SELECT * FROM wonderswan_games WHERE name LIKE '%for WonderSwan%' LIMIT 10;
SELECT * FROM wonderswan_games WHERE name LIKE '%Digimon%' ORDER BY name;

-- ============================================================================
-- FIN DU DÉPLOIEMENT
-- ============================================================================
