<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleCategory;
use App\Models\ArticleBrand;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;

class ConsoleTaxonomySeeder extends Seeder
{
    /**
     * Générer une description pour un article en fonction de son type et de sa sous-catégorie
     */
    private function generateDescription(string $consoleModel, string $variant): string
    {
        $descriptions = [
            // Game & Watch
            'Game & Watch' => "Console portable LCD monoécran de Nintendo (1980-1991). Jeu unique préinstallé, design compact avec horloge intégrée. Collection emblématique du gaming rétro.",
            
            // Game Boy Family
            'Game Boy' => "Console portable 8-bit (1989). Écran LCD monochrome 160×144px, processeur Sharp LR35902 4.19MHz. Autonomie 15-30h. Jeux cultes : Tetris, Pokémon R/B/J, Super Mario Land, Link's Awakening.",
            'Game Boy Pocket' => "Version compacte du Game Boy (1996). Plus petite et légère, écran amélioré, 2 piles AAA. 🔄 Rétrocompatible Game Boy. Autonomie 10h.",
            'Game Boy Light' => "Game Boy avec rétroéclairage (Japon uniquement, 1998). Écran éclairé pour jouer dans le noir. 🔄 Rétrocompatible Game Boy. Rare collector.",
            'Game Boy Color' => "Game Boy couleur (1998). Écran TFT 160×144px 56 couleurs, processeur 8MHz. 🔄 Rétrocompatible Game Boy (cartouches mono jouables). Jeux phares : Pokémon Or/Argent/Cristal, Zelda Oracle, Mario Tennis.",
            'Game Boy Advance' => "Console 32-bit (2001). Écran 240×160px, processeur ARM7 16.78MHz. 🔄 Rétrocompatible Game Boy + Game Boy Color. Hits : Pokémon RSE, Metroid Fusion, Mario Kart, FF Tactics Advance.",
            'Game Boy Advance SP' => "GBA format clapet avec rétroéclairage (2003). Batterie rechargeable Li-Ion 10h, écran frontal illuminé. 🔄 Rétrocompatible GB/GBC. Modèle AGS-101 à rétroéclairage amélioré très recherché.",
            'Game Boy Micro' => "Ultra-compact GBA (2005). Écran 2\" rétroéclairé, faceplates interchangeables. ⚠️ Pas de rétrocompatibilité GB/GBC (seulement GBA). Rare collector.",
            
            // Nintendo DS Family  
            'Nintendo DS' => "Console double écran tactile (2004). Écrans 3\" TFT, microphone, Wi-Fi. 🔄 Rétrocompatible Game Boy Advance (slot GBA). Jeux : Nintendogs, Mario Kart DS, Pokémon D/P, Brain Training.",
            'Nintendo DS Lite' => "DS redesigné plus fin et lumineux (2006). Écrans plus brillants (4 niveaux), batterie 15-19h. 🔄 Rétrocompatible GBA. Best-seller mondial avec New Super Mario Bros.",
            'Nintendo DSi' => "DS avec caméras et apps (2008). 2 caméras 0.3MP, slot SD, DSiWare downloadable. Écrans 3.25\" améliorés. ⚠️ Pas de slot GBA (uniquement DS/DSi).",
            'Nintendo DSi XL' => "DSi grands écrans 4.2\" (2009). Confort visuel accru, stylets XL. ⚠️ Pas de rétrocompatibilité GBA. Idéal bibliothèque DS/DSi massive.",
            
            // Nintendo 3DS Family
            'Nintendo 3DS' => "Console 3D sans lunettes (2011). Écran supérieur 3.53\" 3D, gyroscope, réalité augmentée. 🔄 Rétrocompatible DS/DSi. Jeux : Pokémon X/Y, Zelda OoT 3D, Mario 3D Land, Fire Emblem Awakening.",
            'Nintendo 3DS XL' => "3DS écrans agrandis (2012). Écrans 90% plus grands (4.88\" & 4.18\"), meilleur confort. 🔄 Rétrocompatible DS/DSi. Batterie 3.5-6.5h.",
            'New Nintendo 3DS' => "3DS amélioré (2014). C-stick, boutons ZL/ZR, CPU plus rapide, 3D stabilisée (eye-tracking). 🔄 Rétrocompatible DS/DSi. Exclusivités : Xenoblade Chronicles, Binding of Isaac.",
            'New Nintendo 3DS XL' => "Version grands écrans du New 3DS (2015). Écrans XL + améliorations New 3DS. 🔄 Rétrocompatible DS/DSi. Console ultime pour bibliothèque 3DS/DS.",
            'Nintendo 2DS' => "3DS sans 3D format ardoise (2013). Prix accessible, robuste. 🔄 Rétrocompatible DS/DSi. Parfait pour enfants ou joueurs insensibles à la 3D.",
            'New Nintendo 2DS XL' => "2DS charnière XL (2017). Design moderne clapet, écrans 4.88\", specs New 3DS sans 3D. 🔄 Rétrocompatible DS/DSi. Excellent rapport qualité/prix.",
            
            // NES/Famicom
            'NES' => "Console 8-bit Nintendo Entertainment System (1985). Processeur MOS 6502 1.79MHz, 2KB RAM. Jeux iconiques : Super Mario Bros., Zelda, Mega Man, Metroid, Castlevania. ⚠️ Pas de rétrocompatibilité.",
            'Famicom' => "Family Computer japonaise (1983). Équivalent NES, manettes fixes, Famicom Disk System compatible. Bibliothèque exclusive énorme. 🔄 Compatible Famicom Disk System (via extension FDS).",
            
            // SNES/Super Famicom  
            'SNES' => "Super Nintendo 16-bit (1991). CPU 65c816 3.58MHz, Mode 7, puce son SPC700. Chefs-d'œuvre : Chrono Trigger, FF6, SMW, Zelda ALttP, Super Metroid. ⚠️ Pas de rétrocompatibilité NES.",
            'Super Famicom' => "Super Nintendo japonaise (1990). Design différent, région-locked. Jeux exclusifs : Seiken Densetsu 3, Fire Emblem, Mother 2. ⚠️ Pas de rétrocompatibilité Famicom.",
            
            // N64
            'Nintendo 64' => "Console 64-bit avec stick analogique (1996). CPU MIPS R4300i 93.75MHz, 4MB RAM, cartouches. Révolutionnaires : Mario 64, Zelda OoT/MM, GoldenEye 007, Perfect Dark. ⚠️ Pas de rétrocompatibilité SNES.",
            
            // GameCube
            'GameCube' => "Console mini-DVD Nintendo (2001). CPU PowerPC 485MHz, GPU ATI Flipper. 🔄 Rétrocompatible Game Boy Advance via câble link (certains jeux). Exclusivités : Smash Bros Melee, Resident Evil 4, Metroid Prime, Wind Waker, F-Zero GX.",
            
            // Wii Family
            'Wii' => "Console motion gaming (2006). Wiimotes gyroscopiques. 🔄 Rétrocompatible GameCube (manettes/memory cards GC + Virtual Console NES/SNES/N64). Phénomène : Wii Sports, Mario Galaxy, Smash Bros Brawl, Xenoblade.",
            'Wii U' => "Wii avec GamePad tablette (2012). Écran tactile 6.2\", jeu asymétrique. 🔄 Rétrocompatible Wii (disques + téléchargements WiiWare). Gems : Zelda BotW, Splatoon, Mario Maker, Bayonetta 2.",
            'Wii Mini' => "Wii ultra-compacte sans Wi-Fi (2012). Design rouge/noir, prix accessible. 🔄 Rétrocompatible GameCube supprimée. ⚠️ Pas de connectivité en ligne ni Virtual Console.",
            
            // Switch
            'Nintendo Switch' => "Console hybride salon/portable (2017). CPU Tegra X1, écrans 6.2\" 720p, Joy-Cons détachables. Révolution : Zelda BotW/TotK, Animal Crossing, Smash Ultimate, Splatoon 3. ⚠️ Pas de rétrocompatibilité Wii U (catalogue digital séparé).",
            'Nintendo Switch Lite' => "Switch portable uniquement (2019). Compacte, légère, manettes intégrées. Écran 5.5\". Idéale pour jeux solo portables. ⚠️ Pas de rétrocompatibilité.",
            'Nintendo Switch OLED' => "Switch écran OLED 7\" (2021). Meilleurs contrastes, couleurs vives, dock LAN, 64GB. Expérience portable premium. ⚠️ Pas de rétrocompatibilité Wii U.",
            
            // PlayStation
            'PlayStation' => "Console 32-bit Sony (1995). CPU MIPS R3000 33MHz, CD-ROM. Révolution 3D : Final Fantasy 7-9, MGS, Resident Evil, Crash, Spyro, Gran Turismo.",
            'PS One' => "PlayStation compacte redesignée (2000). Petit format, économie d'énergie, écran LCD optionnel. 🔄 100% compatible PS1.",
            'PlayStation 2' => "Console best-seller all-time (2000). DVD, lecteur Blu-ray. 🔄 Rétrocompatible PlayStation 1 (toutes versions). Catalogue immense : GTA, God of War, FF10/12, Shadow of Colossus, DMC, Persona.",
            'PlayStation 2 Slim' => "PS2 redesignée fine (2004). 75% plus petite, refroidissement amélioré. 🔄 Rétrocompatible PS1. 5 niveaux modèles (SCPH-70000 à 90000).",
            'PlayStation 3' => "Console Blu-ray Cell (2006). Processeur Cell 3.2GHz, GPU RSX. 🔄 Rétrocompatible PS1 (toutes) + PS2 (premiers modèles CECHA/CECHB uniquement). Chefs-d'œuvre : Last of Us, Uncharted, Demon's Souls, MGS4, Yakuza.",
            'PlayStation 3 Slim' => "PS3 redesignée (2009). 33% plus petite, 34% plus légère, consommation réduite. 🔄 Rétrocompatible PS1 uniquement (pas PS2).",
            'PlayStation 3 Super Slim' => "PS3 ultra-compacte (2012). Lecteur tiroir, design ridgé, moins chère. 🔄 Rétrocompatible PS1 uniquement (pas PS2).",
            'PlayStation 4' => "Console 8ème gen x86 (2013). CPU AMD Jaguar 1.6GHz, GPU 1.84TFLOPS. ⚠️ Pas de rétrocompatibilité physique (remasters/remakes disponibles). Blockbusters : Spider-Man, Horizon, God of War, Bloodborne, Ghost of Tsushima.",
            'PlayStation 4 Slim' => "PS4 redesignée (2016). 30% plus petite, consommation réduite, HDR supporté. ⚠️ Pas de rétrocompatibilité.",
            'PlayStation 4 Pro' => "PS4 4K (2016). GPU 4.2TFLOPS, 1TB, 4K/HDR gaming, boost mode PS4. ⚠️ Pas de rétrocompatibilité.",
            'PlayStation 5' => "Console next-gen SSD (2020). CPU Zen 2 3.5GHz, GPU RDNA2 10.3TFLOPS, SSD ultra-rapide, raytracing. 🔄 Rétrocompatible PS4 (~99% catalogue). Dualsense haptique révolutionnaire.",
            'PlayStation 5 Digital Edition' => "PS5 sans lecteur disque (2020). Tout dématérialisé, prix réduit. 🔄 Rétrocompatible PS4 (versions digitales). Mêmes performances.",
            
            // PSP/Vita
            'PSP' => "PlayStation Portable (2004). Écran 4.3\" LCD, UMD, multimédia. Hits : God of War, Monster Hunter, Crisis Core, Persona 3P.",
            'PSP Slim' => "PSP-2000/3000 redesignée (2007-2008). 33% plus légère, sortie vidéo, micro intégré.",
            'PSP Street' => "PSP budget E1000 (2011). Sans Wi-Fi, monocouleur, prix bas. Europe uniquement.",
            'PSP Go' => "PSP coulissante digitale (2009). Design slider, écran 3.8\", Bluetooth. Pas de UMD.",
            'PlayStation Vita' => "Console portable tactile OLED (2012). Écrans 5\" OLED tactile + arrière, dual analog. Gems : Persona 4 Golden, Gravity Rush, Uncharted GA.",
            'PlayStation Vita Slim' => "Vita LCD redesignée (2013). Plus légère, écran LCD, batterie 4-6h, 1GB mémoire.",
            
            // Xbox
            'Xbox' => "Console Microsoft (2001). CPU Intel Pentium III 733MHz, GPU NV2A, HDD 8GB. Halo CE, KOTOR, Fable, Ninja Gaiden. ⚠️ Pas de rétrocompatibilité.",
            'Xbox 360' => "Console HD Xbox Live (2005). CPU PowerPC Tri-core 3.2GHz. 🔄 Rétrocompatible Xbox originale (sélection ~500 jeux via émulation). Iconiques : Halo 3, Gears of War, Mass Effect, Red Dead Redemption.",
            'Xbox 360 S' => "360 Slim redesignée (2010). Design noir brillant, Wi-Fi intégré, port USB 3.0, 250GB. 🔄 Rétrocompatible Xbox (sélection).",
            'Xbox 360 E' => "360 finale redesignée (2013). Design Xbox One-like, plus compacte. 🔄 Rétrocompatible Xbox (sélection).",
            'Xbox One' => "Console all-in-one (2013). CPU AMD Jaguar 8-core 1.75GHz, HDMI pass-through, Kinect. 🔄 Rétrocompatible Xbox 360 + Xbox originale (600+ jeux). Halo 5, Forza, Sunset Overdrive.",
            'Xbox One S' => "One 40% plus petite 4K video (2016). HDR, UHD Blu-ray, design vertical/horizontal. 🔄 Rétrocompatible 360 + Xbox.",
            'Xbox One X' => "Console 4K native la plus puissante (2017). GPU 6TFLOPS, 12GB RAM, enhanced games. 🔄 Rétrocompatible 360 + Xbox avec améliorations graphiques.",
            'Xbox Series S' => "Console next-gen digitale compacte (2020). 1440p 120fps, 512GB SSD, raytracing, prix accessible. 🔄 Rétrocompatible 4 générations (Xbox/360/One) avec FPS Boost/Auto HDR.",
            'Xbox Series X' => "Console 4K 12TFLOPS (2020). GPU RDNA2, SSD 1TB, Game Pass ultime. 🔄 Rétrocompatible 4 générations (Xbox/360/One) avec améliorations massives.",
            
            // Sega
            'Master System' => "Console 8-bit Sega (1987). CPU Z80 3.58MHz. Alex Kidd, Phantasy Star, Wonder Boy, Sonic 8-bit. ⚠️ Pas de rétrocompatibilité.",
            'Master System II' => "Master System redesignée (1990). Compacte, Alex Kidd intégré. ⚠️ Pas de rétrocompatibilité.",
            'Mega Drive' => "Console 16-bit légendaire (1988). CPU Motorola 68000 7.6MHz, puce son Yamaha. Sonic, Streets of Rage, Golden Axe, Shinobi. 🔄 Compatible Sega CD + 32X (via extensions).",
            'Mega Drive II' => "Mega Drive compacte (1993). Design redessiné, économique. 🔄 Compatible Sega CD + 32X (via extensions).",
            'Sega CD' => "Extension CD Mega Drive (1991). FMV, musique CD, sauvegardes. Sonic CD, Lunar, Snatcher. 🔄 Rétrocompatible Mega Drive (lit les cartouches MD).",
            'Sega 32X' => "Extension 32-bit Mega Drive (1994). Deux CPU SH-2 23MHz. Tour hybride. Doom, Virtua Fighter. 🔄 Rétrocompatible Mega Drive (lit les cartouches MD).",
            'Sega Saturn' => "Console 32-bit dual-CPU (1994). 2D excellence, imports japonais. Panzer Dragoon, Nights, VF2, Radiant Silvergun. ⚠️ Pas de rétrocompatibilité Mega Drive/Mega CD/32X.",
            'Dreamcast' => "Dernière console Sega (1998). 128-bit, modem 56K, VMU. Culte : Shenmue, Skies of Arcadia, Jet Set Radio, Sonic Adventure. ⚠️ Pas de rétrocompatibilité Saturn.",
            'Game Gear' => "Portable couleur Sega (1990). Écran TFT rétroéclairé 3.2\", architecture Master System. Sonic, Shinobi, Streets of Rage. 🔄 Rétrocompatible Master System (via adaptateur cartouche Master Gear).",
            
            // Atari
            'Atari 2600' => "Console pionnière cartouches (1977). CPU MOS 6507 1.19MHz. Icônes : Space Invaders, Pac-Man, Pitfall, Adventure. ⚠️ Pas de rétrocompatibilité.",
            'Atari 5200' => "Console 8-bit avancée (1982). Contrôleurs analogiques, graphismes améliorés. ⚠️ Pas de rétrocompatibilité 2600.",
            'Atari 7800' => "Console rétrocompat 2600 (1986). Graphismes 320×240, puce MARIA. 🔄 Rétrocompatible Atari 2600.",
            'Atari Lynx' => "Première portable couleur (1989). Écran 3.5\" LCD backlit, CPU 16-bit, design ambidextre. ⚠️ Pas de rétrocompatibilité.",
            'Atari Jaguar' => "Console 64-bit (1993). Architecture complexe, échec commercial. Alien vs Predator, Tempest 2000. ⚠️ Pas de rétrocompatibilité.",
            
            // NEC
            'PC Engine' => "Console 8/16-bit HuCard (1987, Japon). CPU HuC6280 7.16MHz. R-Type, Bomberman, Castlevania Rondo. 🔄 Compatible extension Super CD-ROM².",
            'TurboGrafx-16' => "PC Engine version US (1989). Mêmes specs, design différent, bibliothèque réduite. 🔄 Compatible extension TurboGrafx-CD.",
            'PC Engine Duo' => "PC Engine + CD intégré (1991). Super System Card 3.0, Ys, Dracula X. 🔄 Rétrocompatible HuCards + CD-ROM².",
            'TurboDuo' => "TurboGrafx CD intégré US (1992). Équivalent PC Engine Duo occidental. 🔄 Rétrocompatible TurboGrafx-16 + CD.",
            'PC Engine GT' => "PC Engine portable (1990). Écran TFT 3.2\" couleur, lit HuCards, sortie TV. Très rare. 🔄 Compatible HuCards PC Engine.",
            'PC Engine LT' => "Laptop PC Engine (1991). Écran LCD 4\", batterie, contrôleurs détachables. Ultra-rare. 🔄 Compatible HuCards PC Engine.",
            
            // SNK
            'Neo Geo AES' => "Console arcade-perfect (1990). Cartouches MVS identiques, RAM 64KB, sprites 380. Fatal Fury, KOF, Metal Slug, Samurai Shodown. Très chère à l'époque. ⚠️ Pas de rétrocompatibilité.",
            'Neo Geo CD' => "Neo Geo CD-ROM (1994). Versions CD moins chères, temps de chargement longs. ⚠️ Pas de compatibilité cartouches AES/MVS.",
            'Neo Geo Pocket' => "Portable SNK monochrome (1998). Écran LCD 160×152, stick clicky. Japon/Europe. ⚠️ Pas de rétrocompatibilité.",
            'Neo Geo Pocket Color' => "NGPC couleur (1999). Écran 160×152 couleur, stick micro-switch précis. SNK vs Capcom, KOF, Metal Slug. 🔄 Rétrocompatible Neo Geo Pocket (jeux mono).",
            
            // Autres marques
            '3DO Interactive Multiplayer' => "Console multimédia 32-bit (1993). CD-ROM, FMV. Gex, Road Rash, Star Control II. ⚠️ Pas de rétrocompatibilité.",
            'Amstrad GX4000' => "Console Amstrad CPC (1990). Cartouches, échec commercial. Europe uniquement. ⚠️ Pas de rétrocompatibilité.",
            'Bandai Pippin' => "Console Apple/Bandai (1996). PowerPC, CD-ROM, modem. Échec total, ultra-rare. ⚠️ Pas de rétrocompatibilité.",
            'Casio Loopy' => "Console créative Casio (1995). Imprimante stickers intégrée. Japon uniquement, rare. ⚠️ Pas de rétrocompatibilité.",
            'Coleco Telstar' => "Pong home console (1976). Jeux Pong variants, circuits AY-3-8500. ⚠️ Pas de rétrocompatibilité.",
            'ColecoVision' => "Console 8-bit (1982). Z80, graphismes avancés. Donkey Kong, Zaxxon. 🔄 Rétrocompatible Atari 2600 (via module Expansion #1).",
            'Commodore 64 GS' => "C64 console (1990). Clavier enlevé, cartouches. Flop commercial. ⚠️ Pas de rétrocompatibilité.",
            'Fairchild Channel F' => "Première console ROM cartouches (1976). CPU F8, 26 jeux. ⚠️ Pas de rétrocompatibilité.",
            'Intellivision' => "Console Mattel (1979). Contrôleurs disque + clavier, voix. Baseball, D&D. ⚠️ Pas de rétrocompatibilité.",
            'Magnavox Odyssey' => "Toute première console (1972). Analogique, overlays TV, pas de son. Historique absolue. ⚠️ Pas de rétrocompatibilité.",
            'Mattel HyperScan' => "Console RFID cartes (2006). Scanner cartes pour jeux, qualité médiocre. ⚠️ Pas de rétrocompatibilité.",
            'Nuon' => "Plateforme DVD multimédia (2000). VM Labs, rares jeux. Tempest 3000. ⚠️ Pas de rétrocompatibilité.",
            'Philips CDi' => "Console multimédia interactive (1991). CD-i, FMV. Zelda CDi notoires. ⚠️ Pas de rétrocompatibilité.",
            'Sega Pico' => "Console éducative enfants (1993). Stylet tactile, livres-cartouches. 3-7 ans. ⚠️ Pas de rétrocompatibilité.",
            'Vectrex' => "Console vecteur monochrome (1982). Écran CRT intégré 9\", graphiques vectoriels. Unique. ⚠️ Pas de rétrocompatibilité.",
            'VTech CreatiVision' => "Console/ordinateur hybride (1981). Clavier optionnel, 16 couleurs. ⚠️ Pas de rétrocompatibilité.",
            'Watara Supervision' => "Portable clone Game Boy (1992). LCD 160×160, moins chère. Rare.",
            'Wonderswan' => "Portable Bandai/Gunpei Yokoi (1999). Écran 224×144, orientable, excellent batterie. Japon.",
            'Wonderswan Color' => "Wonderswan couleur (2000). TFT 241 couleurs, rétrocompat. Final Fantasy, Gundam.",
            
            // Pokémon TCG - Éditions avec cartes recherchées et prix moyens
            'XY12 - Évolutions (2016)' => "Édition spéciale nostalgique réinterprétant le Set de Base 1999. 108 cartes + 5 secrètes. 🔥 CARTES RECHERCHÉES : Méga-Dracaufeu-EX Full Art (180€), Dracaufeu Holo reverse (45€), Ninetales BREAK (25€), Pikachu Full Art (40€).",
            
            'SL - Soleil et Lune (2019-2020)' => "Série principale Alola avec cartes GX ultra-puissantes. Mécaniques Z-Moves et Ultra-Chimères. 🔥 CARTES RECHERCHÉES : Primo Groudon & Kyogre GX Full Art (120€), Arceus & Dialga & Palkia GX Rainbow (200€), Reshiram & Charizard GX Rainbow (280€), Pikachu & Zekrom GX Secret (150€).",
            
            'EB - Épée et Bouclier (2020-2022)' => "Série Galar avec Pokémon V/VMAX Dynamax. Cartes Full Art spectaculaires. 🔥 CARTES RECHERCHÉES : Dracaufeu VMAX Rainbow (450€), Pikachu VMAX Rainbow (320€), Dracaufeu V Shiny (280€), Dresseur Marnie Rainbow (350€).",
            
            'EV1 - Écarlate et Violet (2023)' => "Lancement génération 9 Paldea. Introduction Pokémon ex et cartes Téra. Graphismes modernisés. 🔥 CARTES RECHERCHÉES : Miraidon ex Full Art (85€), Koraidon ex Full Art (90€), Meowscarada ex Special (65€), Iono Full Art (120€).",
            
            'EV2.5 - 151 (2023)' => "Set nostalgie ultime célébrant les 151 Pokémon Kanto. 165+ cartes retravaillées. 🔥 CARTES RECHERCHÉES : Charizard ex Special (380€), Mew ex Hyper (220€), Erika's Invitation Full Art (180€), Alakazam ex Illustration (95€).",
            'EV3 - Couronne Zénith (2023)' => "Expansion premium avec Trainer Gallery spéciale. Subset de luxe très prisé. 🔥 CARTES RECHERCHÉES : Lugia V Alt Art (320€), Giratina V Alt Art (280€), Colress's Experiment Full Art (95€), Skyla Full Art (110€).",
            
            'EV3.5 - Flammes Obsidiennes (2024)' => "Extension Pokémon Feu et Ténèbres. Méga-évolutions retravaillées. 🔥 CARTES RECHERCHÉES : Charizard ex Illustration (290€), Magcargo ex Special (75€), Darkrai VSTAR Rainbow (140€), Armarouge ex Full Art (85€).",
            
            'EV4 - Paradoxe des Forces (2024)' => "Pokémon Paradoxes anciens/futurs. Design sci-fi/préhistorique unique. 🔥 CARTES RECHERCHÉES : Roaring Moon ex (150€), Iron Valiant ex (135€), Scream Tail ex (95€), Sandy Shocks ex Special (110€).",
            
            'EV4.5 - Évolutions à Kitakami (2024)' => "Mini-set Kitakami DLC. Ogerpon 4 formes masquées. 🔥 CARTES RECHERCHÉES : Ogerpon Teal Mask ex (120€), Bloodmoon Ursaluna ex (105€), Sinistcha ex Special (88€), Carmine Full Art (92€).",
            
            'EV5 - Destinées à Paldea (2024)' => "Focus région Paldea avec Terapagos et légendaires. Cartes ex variées. 🔥 CARTES RECHERCHÉES : Terapagos ex Special (180€), Miraidon ex Alt Art (145€), Koraidon ex Illustration (155€), Professor Sada Full Art (110€).",
            
            'EV5.5 - Fables Nébuleuses (2024)' => "Set mystique avec Pokémon légendaires de Kitakami. Illustrations atmosphériques brumeuses. 🔥 CARTES RECHERCHÉES : Pecharunt ex Secret (165€), Munkidori ex Alt Art (125€), Fezandipiti ex Rainbow (140€), Bloodmoon Ursaluna VMAX (180€).",
            
            'EV6 - Couronne Stellaire (2024)' => "Édition couronne avec Terapagos forme Téracristal. Mécaniques Stellar innovantes. 🔥 CARTES RECHERCHÉES : Terapagos ex Stellar Crown (250€), Stellar Charizard ex (320€), Stellar Pikachu Gold (280€), Arven Secret Rare (145€).",
            
            'EV6.5 - Voyage Ensemble (2025)' => "Set thème aventure et amitié. Dresseurs et partenaires iconiques. 🔥 CARTES RECHERCHÉES : Red & Pikachu GX Alt Art (380€), N's Reshiram Full Art (220€), Cynthia's Garchomp ex (195€), Lillie Full Art (260€).",
            
            'EV7 - Mega Evolution (2025)' => "Retour Méga-Évolutions ! Méga-Dracaufeu X/Y, Méga-Rayquaza. 🔥 CARTES RECHERCHÉES : Méga-Rayquaza ex Special (420€), Méga-Charizard ex X Rainbow (350€), Méga-Mewtwo ex Y (280€), Méga-Lucario ex Full Art (165€).",
            
            'EV7.5 - Évolutions Prismatiques (2025)' => "Subset premium ultra-rare. Cristaux Téra arc-en-ciel, finitions rainbow. 🔥 CARTES RECHERCHÉES : Pikachu Prismatic (450€), Charizard Téra Rainbow (580€), Mew Prismatic Secret (380€), Rayquaza Crystal Edge (420€).",
            
            'EV8 - Étincelles Déferlantes (2025)' => "Extension Pokémon Électrik. Pikachu ex, Électhor Galar. 🔥 CARTES RECHERCHÉES : Pikachu ex Surfing (320€), Galarian Zapdos V Alt Art (195€), Miraidon ex Gold (240€), Tapu Koko VMAX (125€).",
            
            'EV9 - Celebration 30 ans (2026)' => "Méga-édition 30 ans Pokémon TCG ! Reprises cartes mythiques 1996-2026. 🔥 CARTES RECHERCHÉES : Charizard 1st Edition Reprint Gold (850€), Pikachu Illustrator Tribute (1200€), Ancient Mew 30th (380€), Umbreon Gold Star Remaster (650€).",
        ];
        
        // Retourner description si existe, sinon description générique
        return $descriptions[$consoleModel] ?? "Console {$consoleModel} - Édition {$variant}. Console de jeux vidéo rétro recherchée par les collectionneurs.";
    }

    /**
     * Générer une description pour un accessoire
     */
    private function generateAccessoryDescription(string $accessoryType, string $compatibility): string
    {
        $descriptions = [
            // Manettes
            'Manettes Nintendo' => "Manettes officielles Nintendo. Build quality premium, boutons réactifs, ergonomie testée. Compatibles consoles {$compatibility}. Idéales jeu compétitif et collection.",
            'Manettes Sony' => "Contrôleurs PlayStation officiels. DualShock vibration, sticks analogiques précis. Design iconique ergonomique. Compatibilité {$compatibility}.",
            'Manettes Microsoft' => "Manettes Xbox officielles. Ergonomie réputée, triggers analogiques, build solide. Compatible {$compatibility}. Standard industrie pour FPS.",
            'Manettes Sega' => "Contrôleurs Sega authentiques. Design rétro, croix directionnelle précise. Collection et jeu sur {$compatibility}.",
            
            // Câbles
            'Câbles Nintendo' => "Câbles officiels/compatibles Nintendo. Qualité signal optimale, connecteurs robustes. Alimentation, audio/vidéo, link cable. Pour {$compatibility}.",
            'Câbles Sony' => "Câbles PlayStation certifiés. AV composite, composante, HDMI selon modèle. Signal stable, blindage EMI. Compatible {$compatibility}.",
            'Câbles Microsoft' => "Câbles Xbox officiels. Connectique propriétaire/standard, transfert audio-vidéo HD. Alimentation et données. Pour {$compatibility}.",
            'Câbles Sega' => "Câbles Sega authentiques. RF, composite, RGB selon console. Qualité image optimale sur {$compatibility}.",
            'Câbles Atari' => "Câblerie Atari rétro. RF switch, alimentation originale. Compatible {$compatibility}. Parfait restoration.",
            'Câbles NEC' => "Câbles NEC PC Engine/TurboGrafx. Multi-tap, AV, RGB. Rare et recherché. Pour {$compatibility}.",
            
            // Cartes mémoire
            'Cartes mémoire Nintendo' => "Memory Cards Nintendo officielles. Sauvegarde fiable, capacités variables. Compatible {$compatibility}. Indispensable pour vos sauvegardes.",
            'Cartes mémoire Sony' => "Cartes mémoire PlayStation officielles. 1MB à 64MB selon modèle. Format Memory Stick/propriétaire. Pour {$compatibility}.",
            'Cartes mémoire Sega' => "VMU et cartes mémoire Sega. Visual Memory Unit Dreamcast avec écran LCD. Stockage sauvegardes {$compatibility}.",
            'Cartes mémoire Microsoft' => "Cartes mémoire Xbox 360/originale. Stockage profils, sauvegardes, DLC. Compatible {$compatibility}.",
            
            // Étuis
            'Étuis Nintendo' => "Étuis de transport Nintendo officiels. Protection rigide/souple, compartiments cartouches. Design compact pour {$compatibility}. Parfait nomade.",
            'Étuis Sony' => "Housses PSP/Vita officielles. Protection écran, poches accessoires, fermeture sécurisée. Pour {$compatibility}.",
            
            // Chargeurs
            'Chargeurs Nintendo' => "Chargeurs secteur Nintendo officiels. Voltage certifié, protection surcharge, connecteurs durables. Compatible {$compatibility}.",
            'Chargeurs Sony' => "Adaptateurs AC PlayStation. Ampérage correct, câbles renforcés. Certifiés {$compatibility}.",
            'Chargeurs Microsoft' => "Blocs d'alimentation Xbox officiels. Brique secteur ou cable USB selon modèle. Pour {$compatibility}.",
            
            // Batteries
            'Batteries Nintendo' => "Batteries Li-Ion Nintendo officielles. Capacité mAh d'origine, durée vie optimale. Pour portables {$compatibility}. Cellules qualité.",
            'Batteries Sony' => "Batteries PSP/Vita Sony authentiques. 1200-2200mAh, autonomie longue durée. Compatible {$compatibility}.",
            'Batteries Microsoft' => "Packs batteries Xbox rechargeable. NiMH/Li-Ion, kit charge & play. Pour manettes {$compatibility}.",
            
            // Boîtes collector
            'Boîtes collector Nintendo' => "Coffrets éditions limitées Nintendo. Packaging premium, goodies exclusifs, certificates. Thèmes {$compatibility}. Collector rare.",
            'Boîtes collector Sony' => "Éditions collector PlayStation. Steelbook, artbook, figurines, DLC. Séries {$compatibility}. Haute valeur.",
            'Boîtes collector Microsoft' => "Coffrets Xbox éditions limitées. Console custom, manette exclusive, contenus bonus. Pour {$compatibility}.",
            'Boîtes collector Sega' => "Éditions collector Sega rares. Packaging japonais, artworks exclusifs. Thème {$compatibility}.",
            'Boîtes collector NEC' => "Coffrets PC Engine ultra-rares. Versions japonaises limitées, packaging deluxe. Pour {$compatibility}.",
            
            // Accessoires spéciaux
            'Accessoires spéciaux Nintendo' => "Accessoires exclusifs Nintendo. Expansion Pack N64, Rumble Pak, E-Reader GBA. Hardware additionnel pour {$compatibility}. Rare collector.",
            'Accessoires spéciaux NEC' => "Périphériques PC Engine rares. TV Tuner GT, Com Link cable. Extensions {$compatibility}. Ultra-rare collectionneur.",
        ];
        
        return $descriptions[$accessoryType] ?? "Accessoire {$accessoryType} compatible {$compatibility}. Accessoire gaming rétro pour votre collection.";
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Catégorie principale
        $consoleCategory = ArticleCategory::updateOrCreate([
            'name' => 'Consoles'
        ]);

        // ========================================
        // NINTENDO
        // ========================================
        $nintendo = ArticleBrand::updateOrCreate([
            'name' => 'Nintendo',
            'article_category_id' => $consoleCategory->id
        ]);

        $nintendoConsoles = [
            'Game & Watch' => [
                'Ⓢ Ball',
                'Ⓢ Flagman',
                'Ⓢ Vermin',
                'Ⓢ Fire',
                'Ⓢ Judge',
                'Ⓢ Manhole',
                'Ⓢ Helmet',
                'Ⓢ Lion',
                'Ⓢ Parachute',
                'Ⓢ Octopus',
                'Ⓢ Popeye',
                'Ⓢ Chef',
                'Ⓢ Mickey Mouse',
                'Ⓢ Egg',
                'Ⓢ Fire Attack',
                'Ⓢ Snoopy',
                'Ⓢ Turtle Bridge',
                'Ⓢ Donkey Kong',
                'Ⓢ Donkey Kong II',
                'Ⓢ Mickey & Donald',
                'Ⓢ Green House',
                'Ⓢ Donkey Kong Jr.',
                'Ⓢ Mario Bros.',
                'Ⓢ Rain Shower',
                'Ⓢ Life Boat',
                'Ⓢ Pinball',
                'Ⓢ Bomb Sweeper',
                'Ⓢ Oil Panic',
                'Ⓢ Tropical Fish',
                'Ⓢ Mario\'s Cement Factory',
                'Ⓢ Spit Ball Sparky',
                'Ⓢ Squish',
                'Ⓢ Boxing',
                'Ⓢ Donkey Kong 3',
                'Ⓢ Donkey Kong Circus',
                'Ⓢ Donkey Kong Hockey',
                'Ⓢ Super Mario Bros.',
                'Ⓢ Climber',
                'Ⓢ Balloon Fight',
                'Ⓢ Zelda',
                'Ⓢ Mario the Juggler',
                'Ⓒ Gold (5K ex.)',
                'Ⓒ Panorama Screen',
                'Ⓒ Crystal Screen',
            ],
            'Game Boy' => ['Ⓢ Gray', 'Ⓢ Red', 'Ⓢ Blue', 'Ⓢ Green', 'Ⓢ Yellow', 'Ⓢ White', 'Ⓢ Black', 'Ⓢ Clear'],
            'Game Boy Pocket' => ['Ⓢ Silver', 'Ⓢ Red', 'Ⓢ Blue', 'Ⓢ Green', 'Ⓢ Yellow', 'Ⓢ Clear', 'Ⓢ Black', 'Ⓢ Pink', 'Ⓢ Gold', 'Ⓢ Ice Blue', 'Ⓒ Famitsu (3K ex.)'],
            'Game Boy Light' => ['Ⓢ Silver', 'Ⓢ Gold', 'Ⓒ Famitsu (5K ex.)'],
            'Game Boy Color' => [
                'Ⓢ Atomic Purple',
                'Ⓢ Teal',
                'Ⓢ Dandelion',
                'Ⓢ Kiwi',
                'Ⓢ Berry',
                'Ⓢ Grape',
                'Ⓢ Clear Purple',
                'Ⓢ Neotones Ice',
                'Ⓒ Pikachu Yellow (3M ex.)',
                'Ⓒ Pokemon Gold/Silver (5M ex.)',
                'Ⓒ Celebi Edition (300K ex.)',
                'Ⓒ Lugia Edition (300K ex.)',
                'Ⓒ Ho-Oh Edition (300K ex.)',
                'Ⓒ Pokemon Center NY (50K ex.)',
                'Ⓒ Toys R Us Gold/Silver (500K ex.)',
                'Ⓒ Hello Kitty (100K ex.)',
                'Ⓒ Cardcaptor Sakura (50K ex.)',
                'Ⓒ Ozzie Smith (10K ex.)',
                'Ⓒ Daiei Hawks (20K ex.)',
                'Ⓒ Tommy Hilfiger (50K ex.)',
                'Ⓒ Jusco Limited (30K ex.)',
                'Ⓒ Hanshin Tigers (30K ex.)',
                'Ⓢ Crystal Clear',
                'Ⓢ Midnight Blue',
                'Ⓢ Extreme Green',
                'Ⓒ Sakura Taisen (70K ex.)',
                'Ⓒ Chee-Chai Alien (20K ex.)',
            ],
            'Game Boy Advance' => [
                'Ⓢ Arctic',
                'Ⓢ Black',
                'Ⓢ Platinum',
                'Ⓢ Indigo',
                'Ⓢ Fuchsia',
                'Ⓢ Glacier',
                'Ⓢ Flame Red',
                'Ⓒ Pokemon Center (100K ex.)',
                'Ⓒ Celebi (50K ex.)',
                'Ⓒ Suicune (50K ex.)',
                'Ⓒ Latias/Latios (150K ex.)',
                'Ⓒ Toys R Us (200K ex.)',
                'Ⓒ NES Classic (800K ex.)',
            ],
            'Game Boy Advance SP' => [
                'Ⓢ Platinum',
                'Ⓢ Cobalt Blue',
                'Ⓢ Flame Red',
                'Ⓢ Graphite',
                'Ⓢ Pearl Blue',
                'Ⓢ Pearl Pink',
                'Ⓢ Lime Green',
                'Ⓢ Surf Blue',
                'Ⓒ Famicom (10K ex.)',
                'Ⓒ NES Classic (800K ex.)',
                'Ⓒ Zelda Minish Cap (25K ex.)',
                'Ⓒ Pokemon Center (50K ex.)',
                'Ⓒ Pikachu (100K ex.)',
                'Ⓒ Groudon (200K ex.)',
                'Ⓒ Kyogre (200K ex.)',
                'Ⓒ Rayquaza (100K ex.)',
                'Ⓒ Latias/Latios (150K ex.)',
            ],
            'Game Boy Micro' => [
                'Ⓢ Silver',
                'Ⓢ Black',
                'Ⓢ Blue',
                'Ⓢ Pink',
                'Ⓒ Famicom (25K ex.)',
                'Ⓒ Mother 3 (20K ex.)',
                'Ⓒ Final Fantasy IV (15K ex.)',
            ],
            'Nintendo DS' => [
                'Ⓢ Silver',
                'Ⓢ Blue',
                'Ⓢ Pink',
                'Ⓢ Red',
                'Ⓢ Black',
                'Ⓒ Pokemon Dialga/Palkia (350K ex.)',
                'Ⓒ Zelda Phantom Hourglass (100K ex.)',
                'Ⓒ Mario Kart (500K ex.)',
            ],
            'Nintendo DS Lite' => [
                'Ⓢ White',
                'Ⓢ Black',
                'Ⓢ Ice Blue',
                'Ⓢ Enamel Navy',
                'Ⓢ Crimson/Black',
                'Ⓢ Pink',
                'Ⓢ Red',
                'Ⓢ Onyx',
                'Ⓢ Gloss Silver',
                'Ⓢ Metallic Rose',
                'Ⓒ Pokemon Dialga/Palkia (1M ex.)',
                'Ⓒ Zelda Gold (100K ex.)',
                'Ⓒ Mario Red (500K ex.)',
                'Ⓒ Pikachu (300K ex.)',
                'Ⓒ Club Nintendo (50K ex.)',
            ],
            'Nintendo DSi' => [
                'Ⓢ White',
                'Ⓢ Black',
                'Ⓢ Blue',
                'Ⓢ Pink',
                'Ⓒ Pokemon Black/White (400K ex.)',
                'Ⓒ Zelda (75K ex.)',
            ],
            'Nintendo DSi XL' => [
                'Ⓢ Bronze',
                'Ⓢ Wine Red',
                'Ⓢ Dark Brown',
                'Ⓢ Green',
                'Ⓒ Mario 25th Anniversary (200K ex.)',
            ],
            'Nintendo 3DS' => [
                'Ⓢ Aqua Blue',
                'Ⓢ Cosmo Black',
                'Ⓢ Flame Red',
                'Ⓢ Ice White',
                'Ⓢ Pink',
                'Ⓢ Midnight Purple',
                'Ⓒ Zelda 25th Anniversary (100K ex.)',
                'Ⓒ Pokemon X/Y Blue (500K ex.)',
                'Ⓒ Pokemon X/Y Red (500K ex.)',
                'Ⓒ Pikachu Yellow (1M ex.)',
                'Ⓒ Animal Crossing (300K ex.)',
            ],
            'Nintendo 3DS XL' => [
                'Ⓢ Red/Black',
                'Ⓢ Blue/Black',
                'Ⓢ Silver/Black',
                'Ⓢ White',
                'Ⓢ Pink/White',
                'Ⓒ Zelda Link Between Worlds (200K ex.)',
                'Ⓒ Pokemon X/Y (800K ex.)',
                'Ⓒ Pikachu (500K ex.)',
                'Ⓒ Super Smash Bros (300K ex.)',
            ],
            'New Nintendo 3DS' => [
                'Ⓢ White',
                'Ⓢ Black',
                'Ⓒ Animal Crossing (500K ex.)',
                'Ⓒ Pokemon 20th (300K ex.)',
                'Ⓒ Super Mario (400K ex.)',
            ],
            'New Nintendo 3DS XL' => [
                'Ⓢ Red',
                'Ⓢ Black',
                'Ⓢ Metallic Blue',
                'Ⓢ Pearl White',
                'Ⓒ Zelda Hyrule (500K ex.)',
                'Ⓒ Zelda Majora Mask (200K ex.)',
                'Ⓒ Pokemon Sun/Moon (1M ex.)',
                'Ⓒ Samus Returns (100K ex.)',
                'Ⓒ Pikachu (800K ex.)',
                'Ⓒ Super NES Edition (200K ex.)',
            ],
            'Nintendo 2DS' => [
                'Ⓢ Red/White',
                'Ⓢ Blue/Black',
                'Ⓢ Sea Green',
                'Ⓒ Pokemon (400K ex.)',
                'Ⓒ Peach Pink (150K ex.)',
            ],
            'New Nintendo 2DS XL' => [
                'Ⓢ Black/Turquoise',
                'Ⓢ White/Orange',
                'Ⓢ Black/Lime',
                'Ⓒ Pikachu Edition (300K ex.)',
                'Ⓒ Minecraft (200K ex.)',
            ],
            'Nintendo Entertainment System (NES)' => [
                'Ⓢ Standard',
                'Ⓢ Gray (NES-001)',
                'Ⓢ Top Loader (NES-101)',
                'Ⓒ Gold Edition (10K ex.)',
            ],
            'Super Nintendo Entertainment System (SNES)' => [
                'Ⓢ Standard',
                'Ⓢ Gray (SNS-001)',
                'Ⓢ Super Famicom Jr (SHVC-101)',
                'Ⓒ Yoshi Limited (50K ex.)',
                'Ⓒ Street Fighter II (30K ex.)',
            ],
            'Nintendo 64' => [
                'Ⓢ Standard',
                'Ⓢ Charcoal Gray',
                'Ⓢ Jungle Green',
                'Ⓢ Grape Purple',
                'Ⓢ Fire Orange',
                'Ⓢ Ice Blue',
                'Ⓒ Pikachu Blue/Yellow (1M ex.)',
                'Ⓒ Gold (500K ex.)',
                'Ⓒ Clear Red/Blue/Green',
                'Ⓒ Funtastic Series (2M ex.)',
            ],
            'GameCube' => [
                'Ⓢ Standard',
                'Ⓢ Indigo (DOL-001)',
                'Ⓢ Jet Black',
                'Ⓢ Platinum Silver',
                'Ⓒ Spice Orange (100K ex.)',
                'Ⓒ Resident Evil 4 (5K ex.)',
                'Ⓒ Tales of Symphonia (10K ex.)',
                'Ⓒ Panasonic Q (10K ex.)',
            ],
            'Wii' => [
                'Ⓢ Standard',
                'Ⓢ White',
                'Ⓢ Black',
                'Ⓒ Red Mario 25th (500K ex.)',
                'Ⓒ Blue (200K ex.)',
                'Ⓒ Family Edition Black (1M ex.)',
            ],
            'Wii U' => [
                'Ⓢ Standard',
                'Ⓢ White Basic (8GB)',
                'Ⓢ Black Deluxe (32GB)',
                'Ⓒ Zelda Wind Waker HD (50K ex.)',
                'Ⓒ Splatoon (200K ex.)',
                'Ⓒ Super Mario Maker (100K ex.)',
            ],
            'Nintendo Switch' => [
                'Ⓢ Gray Joy-Con',
                'Ⓢ Neon Blue/Red',
                'Ⓒ Splatoon 2 (1M ex.)',
                'Ⓒ Pokemon Lets Go (500K ex.)',
                'Ⓒ Super Smash Bros (1M ex.)',
                'Ⓒ Animal Crossing (2M ex.)',
                'Ⓒ Fortnite (1M ex.)',
                'Ⓒ Mario Red/Blue (2M ex.)',
            ],
            'Nintendo Switch OLED' => [
                'Ⓢ White',
                'Ⓢ Neon Blue/Red',
                'Ⓒ Splatoon 3 (1M ex.)',
                'Ⓒ Pokemon Scarlet/Violet (800K ex.)',
                'Ⓒ Zelda Tears of the Kingdom (1.5M ex.)',
            ],
            'Nintendo Switch Lite' => [
                'Ⓢ Yellow',
                'Ⓢ Gray',
                'Ⓢ Turquoise',
                'Ⓢ Coral',
                'Ⓢ Blue',
                'Ⓒ Zacian/Zamazenta (500K ex.)',
                'Ⓒ Dialga/Palkia (300K ex.)',
                'Ⓒ Animal Crossing (1M ex.)',
            ],
        ];

        foreach ($nintendoConsoles as $consoleName => $variants) {
            $subCat = ArticleSubCategory::updateOrCreate([
                'name' => $consoleName,
                'article_category_id' => $consoleCategory->id,
                'article_brand_id' => $nintendo->id
            ]);

            $description = $this->generateDescription($consoleName, '');

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
                ], [
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id,
                    'description' => $description
                ]);
            }
        }

        // ========================================
        // SONY
        // ========================================
        $sony = ArticleBrand::updateOrCreate([
            'name' => 'Sony',
            'article_category_id' => $consoleCategory->id
        ]);

        $sonyConsoles = [
            'PlayStation' => [
                'Ⓢ Standard',
                'Ⓢ Gray (SCPH-1000)',
                'Ⓢ SCPH-5500',
                'Ⓢ SCPH-7000',
                'Ⓢ SCPH-9000',
                'Ⓒ Net Yaroze (10K ex.)',
                'Ⓒ Debugging Station (5K ex.)',
            ],
            'PlayStation One (PSOne)' => [
                'Ⓢ White (SCPH-100)',
                'Ⓒ Video CD Pack (50K ex.)',
            ],
            'PlayStation 2' => [
                'Ⓢ Black (SCPH-30000)',
                'Ⓢ SCPH-39000',
                'Ⓢ SCPH-50000',
                'Ⓒ Aqua Blue (100K ex.)',
                'Ⓒ Ceramic White (300K ex.)',
                'Ⓒ Sakura Pink (50K ex.)',
                'Ⓒ Gran Turismo 3 (200K ex.)',
            ],
            'PlayStation 2 Slim' => [
                'Ⓢ Black (SCPH-70000)',
                'Ⓢ Silver',
                'Ⓒ Ceramic White (500K ex.)',
                'Ⓒ Sakura (75K ex.)',
            ],
            'PlayStation 3' => [
                'Ⓢ Black (CECHA)',
                'Ⓢ 60GB',
                'Ⓢ 80GB',
                'Ⓒ White (100K ex.)',
                'Ⓒ Metal Gear Solid 4 (100K ex.)',
            ],
            'PlayStation 3 Slim' => [
                'Ⓢ Black (CECH-2000)',
                'Ⓢ White',
                'Ⓒ Final Fantasy XIII (50K ex.)',
                'Ⓒ Uncharted 3 (100K ex.)',
            ],
            'PlayStation 3 Super Slim' => [
                'Ⓢ Black (CECH-4000)',
                'Ⓢ White',
                'Ⓒ GTA V (200K ex.)',
            ],
            'PlayStation 4' => [
                'Ⓢ Jet Black (CUH-1000)',
                'Ⓢ Glacier White',
                'Ⓒ Destiny (1M ex.)',
                'Ⓒ Metal Gear Solid V (100K ex.)',
                'Ⓒ Star Wars (1M ex.)',
                'Ⓒ Uncharted 4 (500K ex.)',
            ],
            'PlayStation 4 Slim' => [
                'Ⓢ Jet Black (CUH-2000)',
                'Ⓢ Glacier White',
                'Ⓒ Gold (100K ex.)',
                'Ⓒ Silver (150K ex.)',
            ],
            'PlayStation 4 Pro' => [
                'Ⓢ Jet Black (CUH-7000)',
                'Ⓒ God of War (100K ex.)',
                'Ⓒ Spider-Man (500K ex.)',
                'Ⓒ Death Stranding (50K ex.)',
                'Ⓒ The Last of Us Part II (100K ex.)',
                'Ⓒ 500 Million Edition (50K ex.)',
            ],
            'PlayStation 5' => [
                'Ⓢ White (CFI-1000)',
                'Ⓒ Horizon Forbidden West (300K ex.)',
                'Ⓒ God of War Ragnarök (200K ex.)',
            ],
            'PlayStation 5 Digital Edition' => [
                'Ⓢ White (CFI-1000B)',
            ],
            'PlayStation Portable (PSP)' => [
                'Ⓢ Black (PSP-1000)',
                'Ⓢ Silver (PSP-2000)',
                'Ⓢ PSP-3000',
                'Ⓒ Star Wars (100K ex.)',
                'Ⓒ Monster Hunter (500K ex.)',
                'Ⓒ Final Fantasy VII (200K ex.)',
                'Ⓒ Gran Turismo (150K ex.)',
            ],
            'PSP Go' => [
                'Ⓢ Black (PSP-N1000)',
                'Ⓢ White',
                'Ⓒ Gran Turismo (50K ex.)',
            ],
            'PlayStation Vita' => [
                'Ⓢ Black (PCH-1000)',
                'Ⓢ White',
                'Ⓒ Hatsune Miku (100K ex.)',
                'Ⓒ Final Fantasy X (75K ex.)',
            ],
            'PlayStation Vita Slim' => [
                'Ⓢ Black (PCH-2000)',
                'Ⓢ White',
                'Ⓢ Aqua Blue',
                'Ⓒ Minecraft (200K ex.)',
            ],
        ];

        foreach ($sonyConsoles as $consoleName => $variants) {
            $subCat = ArticleSubCategory::updateOrCreate([
                'name' => $consoleName,
                'article_category_id' => $consoleCategory->id,
                'article_brand_id' => $sony->id
            ]);

            $description = $this->generateDescription($consoleName, '');

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
                ], [
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id,
                    'description' => $description
                ]);
            }
        }

        // ========================================
        // MICROSOFT
        // ========================================
        $microsoft = ArticleBrand::updateOrCreate([
            'name' => 'Microsoft',
            'article_category_id' => $consoleCategory->id
        ]);

        $microsoftConsoles = [
            'Xbox' => [
                'Ⓢ Standard',
                'Ⓢ Black',
                'Ⓒ Crystal (50K ex.)',
                'Ⓒ Halo Edition (200K ex.)',
                'Ⓒ Mountain Dew (5K ex.)',
            ],
            'Xbox 360' => [
                'Ⓢ White (Xenon)',
                'Ⓢ Elite Black',
                'Ⓒ Halo 3 (200K ex.)',
                'Ⓒ Resident Evil 5 (50K ex.)',
                'Ⓒ Gears of War 2 (100K ex.)',
            ],
            'Xbox 360 Slim' => [
                'Ⓢ Black (Trinity)',
                'Ⓢ White',
                'Ⓒ Halo Reach (500K ex.)',
                'Ⓒ Star Wars (400K ex.)',
                'Ⓒ Gears of War 3 (200K ex.)',
            ],
            'Xbox 360 E' => [
                'Ⓢ Black',
                'Ⓒ Gears of War Judgment (50K ex.)',
            ],
            'Xbox One' => [
                'Ⓢ Black (Day One)',
                'Ⓢ White',
                'Ⓒ Titanfall (1M ex.)',
                'Ⓒ Sunset Overdrive (100K ex.)',
                'Ⓒ Call of Duty (500K ex.)',
            ],
            'Xbox One S' => [
                'Ⓢ White (1TB)',
                'Ⓢ Black',
                'Ⓒ Gears of War 4 (2TB) (200K ex.)',
                'Ⓒ Battlefield 1 (500K ex.)',
                'Ⓒ Minecraft (1M ex.)',
            ],
            'Xbox One X' => [
                'Ⓢ Black (1TB)',
                'Ⓒ Project Scorpio (100K ex.)',
                'Ⓒ Fallout 76 (50K ex.)',
                'Ⓒ Cyberpunk 2077 (45K ex.)',
            ],
            'Xbox Series S' => [
                'Ⓢ White (512GB)',
                'Ⓒ Fortnite & Rocket League (300K ex.)',
                'Ⓒ Gilded Hunter (5K ex.)',
            ],
            'Xbox Series X' => [
                'Ⓢ Black (1TB)',
                'Ⓒ Halo Infinite (1M ex.)',
                'Ⓒ Starfield (10K ex.)',
            ],
        ];

        foreach ($microsoftConsoles as $consoleName => $variants) {
            $subCat = ArticleSubCategory::updateOrCreate([
                'name' => $consoleName,
                'article_category_id' => $consoleCategory->id,
                'article_brand_id' => $microsoft->id
            ]);

            $description = $this->generateDescription($consoleName, '');

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
                ], [
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id,
                    'description' => $description
                ]);
            }
        }

        // ========================================
        // SEGA
        // ========================================
        $sega = ArticleBrand::updateOrCreate([
            'name' => 'Sega',
            'article_category_id' => $consoleCategory->id
        ]);

        $segaConsoles = [
            'Master System' => [
                'Ⓢ Standard',
                'Ⓢ Black (Modèle 1)',
                'Ⓢ Modèle 2',
                'Ⓒ Alex Kidd (100K ex.)',
            ],
            'Mega Drive' => [
                'Ⓢ Standard',
                'Ⓢ Black (Model 1)',
                'Ⓢ High Definition Graphics',
                'Ⓒ Sonic 25th Anniversary (10K ex.)',
            ],
            'Mega Drive 2' => [
                'Ⓢ Black',
                'Ⓒ Sonic & Knuckles (200K ex.)',
            ],
            'Mega-CD' => [
                'Ⓢ Black (Modèle 1)',
            ],
            'Mega-CD 2' => [
                'Ⓢ Black (Modèle 2)',
            ],
            'Saturn' => [
                'Ⓢ Standard',
                'Ⓢ Gray (HST-3200)',
                'Ⓢ White (HST-3220)',
                'Ⓒ Virtua Fighter (100K ex.)',
                'Ⓒ Nights (75K ex.)',
                'Ⓒ Skeleton (5K ex.)',
                'Ⓒ Derby Stallion (10K ex.)',
            ],
            'Dreamcast' => [
                'Ⓢ Standard',
                'Ⓢ White (HKT-3020)',
                'Ⓢ Black (Sega Sports)',
                'Ⓒ Sonic Blue (10K ex.)',
                'Ⓒ R7 (5K ex.)',
                'Ⓒ Divers 2000 (3K ex.)',
                'Ⓒ Hello Kitty (50K ex.)',
            ],
            'Game Gear' => [
                'Ⓢ Black',
                'Ⓢ Blue',
                'Ⓢ Red',
                'Ⓒ Coca-Cola (10K ex.)',
                'Ⓒ Kids Gear (20K ex.)',
            ],
            'Nomad' => [
                'Ⓢ Black (MK-1900)',
            ],
        ];

        foreach ($segaConsoles as $consoleName => $variants) {
            $subCat = ArticleSubCategory::updateOrCreate([
                'name' => $consoleName,
                'article_category_id' => $consoleCategory->id,
                'article_brand_id' => $sega->id
            ]);

            $description = $this->generateDescription($consoleName, '');

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
                ], [
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id,
                    'description' => $description
                ]);
            }
        }

        // ========================================
        // ATARI
        // ========================================
        $atari = ArticleBrand::updateOrCreate([
            'name' => 'Atari',
            'article_category_id' => $consoleCategory->id
        ]);

        $atariConsoles = [
            'Atari 2600' => [
                'Ⓢ Heavy Sixer',
                'Ⓢ Light Sixer',
                'Ⓢ 4-switch',
                'Ⓢ 2-switch',
                'Ⓢ Jr',
            ],
            'Atari 5200' => [
                'Ⓢ 4-port',
                'Ⓢ 2-port',
            ],
            'Atari 7800' => [
                'Ⓢ Black',
            ],
            'Atari Lynx' => [
                'Ⓢ Lynx I',
                'Ⓢ Lynx II',
            ],
            'Atari Jaguar' => [
                'Ⓢ Black',
                'Ⓒ White (10K ex.)',
            ],
        ];

        foreach ($atariConsoles as $consoleName => $variants) {
            $subCat = ArticleSubCategory::updateOrCreate([
                'name' => $consoleName,
                'article_category_id' => $consoleCategory->id,
                'article_brand_id' => $atari->id
            ]);

            $description = $this->generateDescription($consoleName, '');

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
                ], [
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id,
                    'description' => $description
                ]);
            }
        }

        // ========================================
        // NEC
        // ========================================
        $nec = ArticleBrand::updateOrCreate([
            'name' => 'NEC',
            'article_category_id' => $consoleCategory->id
        ]);

        $necConsoles = [
            'PC Engine' => [
                'Ⓢ White',
                'Ⓢ Shuttle',
                'Ⓒ LT (10K ex.)',
            ],
            'PC Engine GT' => [
                'Ⓢ Black',
                'Ⓢ White',
            ],
            'PC Engine CoreGrafx' => [
                'Ⓢ CoreGrafx I',
                'Ⓢ CoreGrafx II',
            ],
            'PC Engine Duo' => [
                'Ⓢ Duo',
                'Ⓢ Duo-R',
                'Ⓢ Duo-RX',
            ],
            'TurboGrafx-16' => [
                'Ⓢ Black',
                'Ⓒ TurboExpress (1.5M ex.)',
            ],
        ];

        foreach ($necConsoles as $consoleName => $variants) {
            $subCat = ArticleSubCategory::updateOrCreate([
                'name' => $consoleName,
                'article_category_id' => $consoleCategory->id,
                'article_brand_id' => $nec->id
            ]);

            $description = $this->generateDescription($consoleName, '');

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
                ], [
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id,
                    'description' => $description
                ]);
            }
        }

        // ========================================
        // SNK
        // ========================================
        $snk = ArticleBrand::updateOrCreate([
            'name' => 'SNK',
            'article_category_id' => $consoleCategory->id
        ]);

        $snkConsoles = [
            'Neo Geo AES' => [
                'Ⓢ Black',
                'Ⓒ Gold (10K ex.)',
            ],
            'Neo Geo CD' => [
                'Ⓢ Front-loader',
                'Ⓢ Top-loader',
                'Ⓢ CDZ',
            ],
            'Neo Geo Pocket' => [
                'Ⓢ Black/White',
                'Ⓒ Crystal (5K ex.)',
            ],
            'Neo Geo Pocket Color' => [
                'Ⓢ Carbon Black',
                'Ⓢ Platinum Silver',
                'Ⓢ Crystal Blue',
                'Ⓒ Camouflage Blue (20K ex.)',
                'Ⓒ Clear Smoke (15K ex.)',
            ],
        ];

        foreach ($snkConsoles as $consoleName => $variants) {
            $subCat = ArticleSubCategory::updateOrCreate([
                'name' => $consoleName,
                'article_category_id' => $consoleCategory->id,
                'article_brand_id' => $snk->id
            ]);

            $description = $this->generateDescription($consoleName, '');

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
                ], [
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id,
                    'description' => $description
                ]);
            }
        }

        // ========================================
        // AUTRES MARQUES
        // ========================================
        $autres = ArticleBrand::updateOrCreate([
            'name' => 'Autres',
            'article_category_id' => $consoleCategory->id
        ]);

        $autresConsoles = [
            '3DO' => [
                'Ⓢ FZ-1',
                'Ⓢ FZ-10',
                'Ⓒ Goldstar (50K ex.)',
            ],
            'Amstrad GX4000' => [
                'Ⓢ Black',
            ],
            'Bandai WonderSwan' => [
                'Ⓢ Monochrome',
            ],
            'Bandai WonderSwan Color' => [
                'Ⓢ Color',
                'Ⓢ Crystal',
                'Ⓒ Final Fantasy (100K ex.)',
                'Ⓒ Gundam (50K ex.)',
            ],
            'Commodore 64' => [
                'Ⓢ C64',
                'Ⓢ C64C',
                'Ⓢ C64GS',
            ],
            'Intellivision' => [
                'Ⓢ Original',
                'Ⓢ II',
            ],
            'Odyssey' => [
                'Ⓢ Odyssey',
                'Ⓢ Odyssey 2',
            ],
            'Philips CD-i' => [
                'Ⓢ 210',
                'Ⓢ 220',
                'Ⓢ 450',
            ],
        ];

        foreach ($autresConsoles as $consoleName => $variants) {
            $subCat = ArticleSubCategory::updateOrCreate([
                'name' => $consoleName,
                'article_category_id' => $consoleCategory->id,
                'article_brand_id' => $autres->id
            ]);

            $description = $this->generateDescription($consoleName, '');

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
                ], [
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id,
                    'description' => $description
                ]);
            }
        }

        // ========================================
        // CARTES À COLLECTIONNER
        // ========================================
        $cartesCategory = ArticleCategory::updateOrCreate(
            ['name' => 'Cartes à collectionner'],
            ['name' => 'Cartes à collectionner']
        );

        // ========================================
        // POKÉMON
        // ========================================
        $pokemon = ArticleBrand::updateOrCreate(
            ['name' => 'Pokémon', 'article_category_id' => $cartesCategory->id],
            ['name' => 'Pokémon', 'article_category_id' => $cartesCategory->id]
        );

        $pokemonEditions = [
            // 2016
            'XY12 - Évolutions (2016)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Méga Coffret Dracaufeu-EX',
                'Booster individuel',
            ],
            
            // 2019-2020
            'SL - Soleil et Lune (2019-2020)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Booster individuel',
            ],
            
            // 2020-2022
            'EB - Épée et Bouclier (2020-2022)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Portfolio',
                'Booster individuel',
            ],
            
            // 2023
            'EV1 - Écarlate et Violet (2023)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Portfolio',
                'Booster individuel',
            ],
            'EV2.5 - 151 (2023)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Ultra-Premium',
                'Portfolio',
                'Booster individuel',
            ],
            'EV3 - Couronne Zénith (2023)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Ultra-Premium',
                'Booster individuel',
            ],
            
            // 2024
            'EV3.5 - Flammes Obsidiennes (2024)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Booster individuel',
            ],
            'EV4 - Paradoxe des Forces (2024)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Portfolio',
                'Booster individuel',
            ],
            'EV4.5 - Évolutions à Kitakami (2024)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Booster individuel',
            ],
            'EV5 - Destinées à Paldea (2024)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Portfolio',
                'Booster individuel',
            ],
            'EV5.5 - Fables Nébuleuses (2024)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Booster individuel',
            ],
            'EV6 - Couronne Stellaire (2024)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Portfolio',
                'Booster individuel',
            ],
            
            // 2025
            'EV6.5 - Voyage Ensemble (2025)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Booster individuel',
            ],
            'EV7 - Mega Evolution (2025)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Portfolio',
                'Booster individuel',
            ],
            'EV7.5 - Évolutions Prismatiques (2025)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Ultra-Premium',
                'Portfolio',
                'Booster individuel',
            ],
            'EV8 - Étincelles Déferlantes (2025)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Dresseur d\'Elite',
                'Portfolio',
                'Booster individuel',
            ],
            
            // 2026
            'EV9 - Celebration 30 ans (2026)' => [
                'ETB (Elite Trainer Box)',
                'Display (Booster Box)',
                'Tripack',
                'Coffret Ultra-Premium',
                'Portfolio',
                'Booster individuel',
            ],
        ];

        foreach ($pokemonEditions as $editionName => $products) {
            $subCat = ArticleSubCategory::updateOrCreate([
                'name' => $editionName,
                'article_category_id' => $cartesCategory->id,
                'article_brand_id' => $pokemon->id
            ]);

            $description = $this->generateDescription($editionName, '');

            foreach ($products as $product) {
                ArticleType::updateOrCreate([
                    'name' => $product,
                    'article_sub_category_id' => $subCat->id
                ], [
                    'name' => $product,
                    'article_sub_category_id' => $subCat->id,
                    'description' => $description
                ]);
            }
        }

        // ========================================
        // CATÉGORIE : ACCESSOIRES
        // ========================================
        $accessoiresCategory = ArticleCategory::updateOrCreate([
            'name' => 'Accessoires'
        ]);

        // Réutiliser les marques existantes pour la compatibilité
        $nintendoAccessoires = ArticleBrand::updateOrCreate([
            'name' => 'Nintendo',
            'article_category_id' => $accessoiresCategory->id
        ]);

        $sonyAccessoires = ArticleBrand::updateOrCreate([
            'name' => 'Sony',
            'article_category_id' => $accessoiresCategory->id
        ]);

        $microsoftAccessoires = ArticleBrand::updateOrCreate([
            'name' => 'Microsoft',
            'article_category_id' => $accessoiresCategory->id
        ]);

        $segaAccessoires = ArticleBrand::updateOrCreate([
            'name' => 'Sega',
            'article_category_id' => $accessoiresCategory->id
        ]);

        $atariAccessoires = ArticleBrand::updateOrCreate([
            'name' => 'Atari',
            'article_category_id' => $accessoiresCategory->id
        ]);

        $necAccessoires = ArticleBrand::updateOrCreate([
            'name' => 'NEC',
            'article_category_id' => $accessoiresCategory->id
        ]);

        $snkAccessoires = ArticleBrand::updateOrCreate([
            'name' => 'SNK',
            'article_category_id' => $accessoiresCategory->id
        ]);

        $autresAccessoires = ArticleBrand::updateOrCreate([
            'name' => 'Autres',
            'article_category_id' => $accessoiresCategory->id
        ]);

        // =====================
        // MANETTES NINTENDO
        // =====================
        $manettesNintendoSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Manettes Nintendo',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $nintendoAccessoires->id
        ]);

        $manettesN64 = [
            // Couleurs standard N64
            'Manette N64 Grise',
            'Manette N64 Noire',
            'Manette N64 Bleue',
            'Manette N64 Rouge',
            'Manette N64 Verte',
            'Manette N64 Jaune',
            'Manette N64 Atomic Purple',
            'Manette N64 Ice Blue',
            'Manette N64 Fire Orange',
            'Manette N64 Smoke Black',
            'Manette N64 Watermelon Red',
            'Manette N64 Jungle Green',
            'Manette N64 Grape Purple',
            
            // Éditions collector N64
            'Manette N64 Gold (Ⓒ)',
            'Manette N64 Pikachu (Ⓒ)',
            'Manette N64 Pokémon Snap (Ⓒ)',
            'Manette N64 Donkey Kong 64 (Ⓒ)',
            'Manette N64 Funtastic Clear Blue (Ⓒ)',
            
            // Autres consoles Nintendo
            'Manette NES',
            'Manette SNES',
            'Manette GameCube Noire',
            'Manette GameCube Indigo',
            'Manette GameCube Platinum',
            'Manette GameCube Orange Spice (Ⓒ)',
            'Manette Wii Remote',
            'Manette Wii Classic Controller',
            'Manette Wii U Pro',
            'Joy-Con Gris (Gauche)',
            'Joy-Con Gris (Droite)',
            'Joy-Con Néon Rouge (Gauche)',
            'Joy-Con Néon Bleu (Droite)',
            'Pro Controller Switch',
        ];

        $description = $this->generateAccessoryDescription('Manettes Nintendo', 'N64');
        
        foreach ($manettesN64 as $manette) {
            ArticleType::updateOrCreate([
                'name' => $manette,
                'article_sub_category_id' => $manettesNintendoSub->id
            ], [
                'name' => $manette,
                'article_sub_category_id' => $manettesNintendoSub->id,
                'description' => $description
            ]);
        }

        // =====================
        // MANETTES SONY
        // =====================
        $manettesSonySub = ArticleSubCategory::updateOrCreate([
            'name' => 'Manettes Sony',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $sonyAccessoires->id
        ]);

        $manettesSony = [
            // PlayStation 1
            'Manette PS1 Grise',
            'DualShock PS1 Grise',
            
            // PlayStation 2
            'DualShock 2 Noire',
            'DualShock 2 Silver',
            'DualShock 2 Ocean Blue (Ⓒ)',
            'DualShock 2 Ceramic White (Ⓒ)',
            
            // PlayStation 3
            'DualShock 3 Noire',
            'DualShock 3 Blanche',
            'DualShock 3 Rouge',
            'DualShock 3 Bleue',
            
            // PlayStation 4
            'DualShock 4 Jet Black',
            'DualShock 4 Wave Blue',
            'DualShock 4 Magma Red',
            'DualShock 4 Steel Black',
            'DualShock 4 Crystal (Ⓒ)',
            '20th Anniversary Controller (Ⓒ)',
            
            // PlayStation 5
            'DualSense Blanc',
            'DualSense Noir',
            'DualSense Cosmic Red',
            'DualSense Midnight Black',
            'DualSense Nova Pink',
            'DualSense Starlight Blue',
            'DualSense Edge',
            
            // PSP/PS Vita
            'PSP Analog Nub Replacement',
        ];

        $description = $this->generateAccessoryDescription('Manettes Sony', 'PlayStation');
        
        foreach ($manettesSony as $manette) {
            ArticleType::updateOrCreate([
                'name' => $manette,
                'article_sub_category_id' => $manettesSonySub->id
            ], [
                'name' => $manette,
                'article_sub_category_id' => $manettesSonySub->id,
                'description' => $description
            ]);
        }

        // =====================
        // MANETTES MICROSOFT
        // =====================
        $manettesMicrosoftSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Manettes Microsoft',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $microsoftAccessoires->id
        ]);

        $manettesMicrosoft = [
            'Manette Xbox Duke (Ⓒ)',
            'Manette Xbox S Controller',
            'Manette Xbox 360 Blanche',
            'Manette Xbox 360 Noire',
            'Manette Xbox One Noire',
            'Manette Xbox One Blanche',
            'Manette Xbox Series X/S Carbon Black',
            'Manette Xbox Series X/S Robot White',
            'Elite Wireless Controller Series 2',
        ];

        $description = $this->generateAccessoryDescription('Manettes Microsoft', 'Xbox');
        
        foreach ($manettesMicrosoft as $manette) {
            ArticleType::updateOrCreate([
                'name' => $manette,
                'article_sub_category_id' => $manettesMicrosoftSub->id
            ], [
                'name' => $manette,
                'article_sub_category_id' => $manettesMicrosoftSub->id,
                'description' => $description
            ]);
        }

        // =====================
        // MANETTES SEGA
        // =====================
        $manettesSegaSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Manettes Sega',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $segaAccessoires->id
        ]);

        $manettesSega = [
            'Manette Mega Drive 3 boutons',
            'Manette Mega Drive 6 boutons',
            'Manette Saturn',
            'Manette Dreamcast',
        ];

        $description = $this->generateAccessoryDescription('Manettes Sega', 'Sega');
        
        foreach ($manettesSega as $manette) {
            ArticleType::updateOrCreate([
                'name' => $manette,
                'article_sub_category_id' => $manettesSegaSub->id
            ], [
                'name' => $manette,
                'article_sub_category_id' => $manettesSegaSub->id,
                'description' => $description
            ]);
        }

        // =====================
        // ACCESSOIRES NEC
        // =====================
        $accessoiresNECSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Accessoires NEC',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $necAccessoires->id
        ]);

        $accessoiresNEC = [
            'PC Engine GT - Câble de liaison (Com Link)',
            'PC Engine GT - Tuner TV',
        ];

        $description = $this->generateAccessoryDescription('Accessoires spéciaux NEC', 'PC Engine');
        
        foreach ($accessoiresNEC as $accessoire) {
            ArticleType::updateOrCreate([
                'name' => $accessoire,
                'article_sub_category_id' => $accessoiresNECSub->id
            ], [
                'name' => $accessoire,
                'article_sub_category_id' => $accessoiresNECSub->id,
                'description' => $description
            ]);
        }

        // =====================
        // ACCESSOIRES SPÉCIAUX NINTENDO
        // =====================
        $accessoiresSpeciauxNintendoSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Accessoires spéciaux Nintendo',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $nintendoAccessoires->id
        ]);

        $accessoiresSpeciauxNintendo = [
            // N64
            'Expansion Pack N64 (Officiel)',
            'Expansion Pack N64 (Générique)',
            'Rumble Pack N64',
            'Pokémon Transfer Pack N64',
            
            // Game Boy Advance
            'E-Reader GBA',
            'E-Reader+ GBA',
        ];

        $description = $this->generateAccessoryDescription('Accessoires spéciaux Nintendo', 'N64/GBA');
        
        foreach ($accessoiresSpeciauxNintendo as $accessoire) {
            ArticleType::updateOrCreate([
                'name' => $accessoire,
                'article_sub_category_id' => $accessoiresSpeciauxNintendoSub->id
            ], [
                'name' => $accessoire,
                'article_sub_category_id' => $accessoiresSpeciauxNintendoSub->id,
                'description' => $description
            ]);
        }

        // =====================
        // CARTES MÉMOIRE
        // =====================
        
        // Nintendo
        $cartesNintendoSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Cartes mémoire Nintendo',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $nintendoAccessoires->id
        ]);

        $cartesNintendo = [
            'Carte mémoire GameCube 59 blocs (Officielle)',
            'Carte mémoire GameCube 251 blocs (Officielle)',
            'Carte mémoire GameCube 1019 blocs (Officielle)',
            'Carte mémoire GameCube (Générique)',
            'Carte mémoire Wii (SD)',
        ];

        $description = $this->generateAccessoryDescription('Cartes mémoire Nintendo', 'compatible');


        


        foreach ($cartesNintendo as $carte) {


            ArticleType::updateOrCreate([


                'name' => $carte,


                'article_sub_category_id' => $cartesNintendoSub->id


            ], [


                'name' => $carte,


                'article_sub_category_id' => $cartesNintendoSub->id,


                'description' => $description


            ]);
        }

        // Sony
        $cartesSonySub = ArticleSubCategory::updateOrCreate([
            'name' => 'Cartes mémoire Sony',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $sonyAccessoires->id
        ]);

        $cartesSony = [
            // PlayStation 1
            'Carte mémoire PS1 (Officielle)',
            'Carte mémoire PS1 (Générique)',
            
            // PlayStation 2
            'Carte mémoire PS2 8 MB (Officielle)',
            'Carte mémoire PS2 16 MB',
            'Carte mémoire PS2 32 MB',
            'Carte mémoire PS2 64 MB',
            'Carte mémoire PS2 128 MB',
            
            // PSP
            'Memory Stick Duo 32 MB',
            'Memory Stick Duo 64 MB',
            'Memory Stick Duo 128 MB',
            'Memory Stick Duo 256 MB',
            'Memory Stick Duo 512 MB',
            'Memory Stick Duo 1 GB',
            'Memory Stick Duo 2 GB',
            'Memory Stick Pro Duo 4 GB',
            'Memory Stick Pro Duo 8 GB',
            'Memory Stick Pro Duo 16 GB',
            
            // PS Vita
            'Carte mémoire PS Vita 4 GB',
            'Carte mémoire PS Vita 8 GB',
            'Carte mémoire PS Vita 16 GB',
            'Carte mémoire PS Vita 32 GB',
            'Carte mémoire PS Vita 64 GB',
        ];

        $description = $this->generateAccessoryDescription('Cartes mémoire Sony', 'compatible');


        


        foreach ($cartesSony as $carte) {


            ArticleType::updateOrCreate([


                'name' => $carte,


                'article_sub_category_id' => $cartesSonySub->id


            ], [


                'name' => $carte,


                'article_sub_category_id' => $cartesSonySub->id,


                'description' => $description


            ]);
        }

        // Sega
        $cartesSegaSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Cartes mémoire Sega',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $segaAccessoires->id
        ]);

        $cartesSega = [
            'Carte mémoire Dreamcast VMU (Officielle)',
            'Carte mémoire Dreamcast VMU (Générique)',
            'Carte mémoire Saturn',
        ];

        $description = $this->generateAccessoryDescription('Cartes mémoire Sega', 'compatible');


        


        foreach ($cartesSega as $carte) {


            ArticleType::updateOrCreate([


                'name' => $carte,


                'article_sub_category_id' => $cartesSegaSub->id


            ], [


                'name' => $carte,


                'article_sub_category_id' => $cartesSegaSub->id,


                'description' => $description


            ]);
        }

        // Microsoft
        $cartesMicrosoftSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Cartes mémoire Microsoft',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $microsoftAccessoires->id
        ]);

        $cartesMicrosoft = [
            'Carte mémoire Xbox (Officielle)',
            'Carte mémoire Xbox (Générique)',
            'Disque dur Xbox 360 20 GB',
            'Disque dur Xbox 360 60 GB',
            'Disque dur Xbox 360 120 GB',
            'Disque dur Xbox 360 250 GB',
            'Disque dur Xbox 360 320 GB',
        ];

        $description = $this->generateAccessoryDescription('Cartes mémoire Microsoft', 'compatible');


        


        foreach ($cartesMicrosoft as $carte) {


            ArticleType::updateOrCreate([


                'name' => $carte,


                'article_sub_category_id' => $cartesMicrosoftSub->id


            ], [


                'name' => $carte,


                'article_sub_category_id' => $cartesMicrosoftSub->id,


                'description' => $description


            ]);
        }

        // =====================
        // CÂBLES
        // =====================
        
        // Nintendo
        $cablesNintendoSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Câbles Nintendo',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $nintendoAccessoires->id
        ]);

        $cablesNintendo = [
            // Universels Nintendo
            'Câble AV Composite (RCA) - NES/SNES/N64/GameCube',
            'Câble S-Video - SNES/N64/GameCube',
            'Câble RGB Péritel - SNES/N64/GameCube',
            
            // Spécifiques
            'Câble RF Antenne - NES',
            'Câble alimentation NES',
            'Câble alimentation SNES',
            'Câble alimentation N64',
            'Câble alimentation GameCube',
            'Câble Component HD - Wii',
            'Câble HDMI - Wii U',
            'Câble HDMI - Switch',
            'Câble USB-C - Switch',
            
            // Link Cable
            'Link Cable Game Boy/Game Boy Color',
            'Link Cable Game Boy Advance',
            'Câble GBA vers GameCube',
        ];

        $description = $this->generateAccessoryDescription('Câbles Nintendo', 'compatible');


        


        foreach ($cablesNintendo as $cable) {


            ArticleType::updateOrCreate([


                'name' => $cable,


                'article_sub_category_id' => $cablesNintendoSub->id


            ], [


                'name' => $cable,


                'article_sub_category_id' => $cablesNintendoSub->id,


                'description' => $description


            ]);
        }

        // Sony
        $cablesSonySub = ArticleSubCategory::updateOrCreate([
            'name' => 'Câbles Sony',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $sonyAccessoires->id
        ]);

        $cablesSony = [
            // PlayStation 1
            'Câble AV Composite (RCA) - PS1',
            'Câble S-Video - PS1',
            'Câble RGB Péritel - PS1',
            'Câble alimentation PS1',
            
            // PlayStation 2
            'Câble AV Composite (RCA) - PS2',
            'Câble Component HD - PS2',
            'Câble RGB Péritel - PS2',
            'Câble alimentation PS2',
            
            // PlayStation 3
            'Câble HDMI - PS3',
            'Câble Component HD - PS3',
            'Câble AV Composite (RCA) - PS3',
            'Câble alimentation PS3',
            
            // PlayStation 4/5
            'Câble HDMI - PS4',
            'Câble alimentation PS4',
            'Câble HDMI 2.1 - PS5',
            'Câble alimentation PS5',
            
            // PSP/PS Vita
            'Câble USB - PSP',
            'Câble AV - PSP',
            'Câble alimentation PSP',
            'Câble USB - PS Vita',
            'Câble alimentation PS Vita',
        ];

        $description = $this->generateAccessoryDescription('Câbles Sony', 'compatible');


        


        foreach ($cablesSony as $cable) {


            ArticleType::updateOrCreate([


                'name' => $cable,


                'article_sub_category_id' => $cablesSonySub->id


            ], [


                'name' => $cable,


                'article_sub_category_id' => $cablesSonySub->id,


                'description' => $description


            ]);
        }

        // Microsoft
        $cablesMicrosoftSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Câbles Microsoft',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $microsoftAccessoires->id
        ]);

        $cablesMicrosoft = [
            // Xbox
            'Câble AV Composite (RCA) - Xbox',
            'Câble Component HD - Xbox',
            'Câble RGB Péritel - Xbox',
            'Câble alimentation Xbox',
            
            // Xbox 360
            'Câble HDMI - Xbox 360',
            'Câble Component HD - Xbox 360',
            'Câble AV Composite - Xbox 360',
            'Câble VGA - Xbox 360',
            'Câble alimentation Xbox 360',
            
            // Xbox One/Series
            'Câble HDMI - Xbox One',
            'Câble alimentation Xbox One',
            'Câble HDMI 2.1 - Xbox Series X/S',
            'Câble alimentation Xbox Series X/S',
        ];

        $description = $this->generateAccessoryDescription('Câbles Microsoft', 'compatible');


        


        foreach ($cablesMicrosoft as $cable) {


            ArticleType::updateOrCreate([


                'name' => $cable,


                'article_sub_category_id' => $cablesMicrosoftSub->id


            ], [


                'name' => $cable,


                'article_sub_category_id' => $cablesMicrosoftSub->id,


                'description' => $description


            ]);
        }

        // Sega
        $cablesSegaSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Câbles Sega',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $segaAccessoires->id
        ]);

        $cablesSega = [
            // Mega Drive
            'Câble AV Composite (RCA) - Mega Drive',
            'Câble RGB Péritel - Mega Drive',
            'Câble RF Antenne - Mega Drive',
            'Câble alimentation Mega Drive',
            
            // Saturn
            'Câble AV Composite (RCA) - Saturn',
            'Câble RGB Péritel - Saturn',
            'Câble S-Video - Saturn',
            'Câble alimentation Saturn',
            
            // Dreamcast
            'Câble AV Composite (RCA) - Dreamcast',
            'Câble VGA - Dreamcast',
            'Câble RGB Péritel - Dreamcast',
            'Câble S-Video - Dreamcast',
            'Câble alimentation Dreamcast',
        ];

        $description = $this->generateAccessoryDescription('Câbles Sega', 'compatible');


        


        foreach ($cablesSega as $cable) {


            ArticleType::updateOrCreate([


                'name' => $cable,


                'article_sub_category_id' => $cablesSegaSub->id


            ], [


                'name' => $cable,


                'article_sub_category_id' => $cablesSegaSub->id,


                'description' => $description


            ]);
        }

        // Atari
        $cablesAtariSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Câbles Atari',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $atariAccessoires->id
        ]);

        $cablesAtari = [
            'Câble RF Antenne - Atari 2600',
            'Câble alimentation Atari 2600',
            'Câble AV - Atari 7800',
            'Câble alimentation Atari 7800',
        ];

        $description = $this->generateAccessoryDescription('Câbles Atari', 'compatible');


        


        foreach ($cablesAtari as $cable) {


            ArticleType::updateOrCreate([


                'name' => $cable,


                'article_sub_category_id' => $cablesAtariSub->id


            ], [


                'name' => $cable,


                'article_sub_category_id' => $cablesAtariSub->id,


                'description' => $description


            ]);
        }

        // NEC
        $cablesNECSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Câbles NEC',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $necAccessoires->id
        ]);

        $cablesNEC = [
            'Câble AV - PC Engine/TurboGrafx-16',
            'Câble RGB - PC Engine',
            'Câble alimentation PC Engine',
            'Câble alimentation PC Engine GT',
        ];

        $description = $this->generateAccessoryDescription('Câbles NEC', 'compatible');


        


        foreach ($cablesNEC as $cable) {


            ArticleType::updateOrCreate([


                'name' => $cable,


                'article_sub_category_id' => $cablesNECSub->id


            ], [


                'name' => $cable,


                'article_sub_category_id' => $cablesNECSub->id,


                'description' => $description


            ]);
        }

        // =====================
        // ÉTUIS DE CONSOLES
        // =====================
        
        // Nintendo
        $etuisNintendoSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Étuis Nintendo',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $nintendoAccessoires->id
        ]);

        $etuisNintendo = [
            'Étui Game Boy',
            'Étui Game Boy Color',
            'Étui Game Boy Advance',
            'Étui Game Boy Advance SP',
            'Étui Nintendo DS',
            'Étui Nintendo DS Lite',
            'Étui Nintendo 3DS',
            'Étui Nintendo 3DS XL',
            'Étui Nintendo Switch',
            'Étui Nintendo Switch OLED',
        ];

        $description = $this->generateAccessoryDescription('Étuis Nintendo', 'compatible');


        


        foreach ($etuisNintendo as $etui) {


            ArticleType::updateOrCreate([


                'name' => $etui,


                'article_sub_category_id' => $etuisNintendoSub->id


            ], [


                'name' => $etui,


                'article_sub_category_id' => $etuisNintendoSub->id,


                'description' => $description


            ]);
        }

        // Sony
        $etuisSonySub = ArticleSubCategory::updateOrCreate([
            'name' => 'Étuis Sony',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $sonyAccessoires->id
        ]);

        $etuisSony = [
            'Étui PSP',
            'Étui PS Vita',
        ];

        $description = $this->generateAccessoryDescription('Étuis Sony', 'compatible');


        


        foreach ($etuisSony as $etui) {


            ArticleType::updateOrCreate([


                'name' => $etui,


                'article_sub_category_id' => $etuisSonySub->id


            ], [


                'name' => $etui,


                'article_sub_category_id' => $etuisSonySub->id,


                'description' => $description


            ]);
        }

        // =====================
        // CHARGEURS
        // =====================
        
        // Nintendo
        $chargeursNintendoSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Chargeurs Nintendo',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $nintendoAccessoires->id
        ]);

        $chargeursNintendo = [
            'Chargeur Game Boy Advance SP',
            'Chargeur Nintendo DS',
            'Chargeur Nintendo DS Lite',
            'Chargeur Nintendo 3DS',
            'Chargeur Nintendo Switch',
            'Dock Nintendo Switch',
        ];

        $description = $this->generateAccessoryDescription('Chargeurs Nintendo', 'compatible');


        


        foreach ($chargeursNintendo as $chargeur) {


            ArticleType::updateOrCreate([


                'name' => $chargeur,


                'article_sub_category_id' => $chargeursNintendoSub->id


            ], [


                'name' => $chargeur,


                'article_sub_category_id' => $chargeursNintendoSub->id,


                'description' => $description


            ]);
        }

        // Sony
        $chargeursSonySub = ArticleSubCategory::updateOrCreate([
            'name' => 'Chargeurs Sony',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $sonyAccessoires->id
        ]);

        $chargeursSony = [
            'Chargeur PSP',
            'Chargeur PS Vita',
            'Station de charge DualShock 4',
            'Station de charge DualSense',
        ];

        $description = $this->generateAccessoryDescription('Chargeurs Sony', 'compatible');


        


        foreach ($chargeursSony as $chargeur) {


            ArticleType::updateOrCreate([


                'name' => $chargeur,


                'article_sub_category_id' => $chargeursSonySub->id


            ], [


                'name' => $chargeur,


                'article_sub_category_id' => $chargeursSonySub->id,


                'description' => $description


            ]);
        }

        // Microsoft
        $chargeursMicrosoftSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Chargeurs Microsoft',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $microsoftAccessoires->id
        ]);

        $chargeursMicrosoft = [
            'Kit de charge Xbox 360',
            'Kit de charge Xbox One',
            'Station de charge Xbox Series X/S',
        ];

        $description = $this->generateAccessoryDescription('Chargeurs Microsoft', 'compatible');


        


        foreach ($chargeursMicrosoft as $chargeur) {


            ArticleType::updateOrCreate([


                'name' => $chargeur,


                'article_sub_category_id' => $chargeursMicrosoftSub->id


            ], [


                'name' => $chargeur,


                'article_sub_category_id' => $chargeursMicrosoftSub->id,


                'description' => $description


            ]);
        }

        // =====================
        // BATTERIES
        // =====================
        
        // Nintendo
        $batteriesNintendoSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Batteries Nintendo',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $nintendoAccessoires->id
        ]);

        $batteriesNintendo = [
            'Batterie Game Boy Advance SP',
            'Batterie Nintendo DS',
            'Batterie Nintendo DS Lite',
            'Batterie Nintendo 3DS',
            'Batterie Wii Remote',
            'Batterie Switch Joy-Con',
            'Batterie Switch Pro Controller',
        ];

        $description = $this->generateAccessoryDescription('Batteries Nintendo', 'compatible');


        


        foreach ($batteriesNintendo as $batterie) {


            ArticleType::updateOrCreate([


                'name' => $batterie,


                'article_sub_category_id' => $batteriesNintendoSub->id


            ], [


                'name' => $batterie,


                'article_sub_category_id' => $batteriesNintendoSub->id,


                'description' => $description


            ]);
        }

        // Sony
        $batteriesSonySub = ArticleSubCategory::updateOrCreate([
            'name' => 'Batteries Sony',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $sonyAccessoires->id
        ]);

        $batteriesSony = [
            'Batterie PSP 1000',
            'Batterie PSP 2000',
            'Batterie PSP 3000',
            'Batterie PS Vita',
            'Batterie DualShock 4',
            'Batterie DualSense',
        ];

        $description = $this->generateAccessoryDescription('Batteries Sony', 'compatible');


        


        foreach ($batteriesSony as $batterie) {


            ArticleType::updateOrCreate([


                'name' => $batterie,


                'article_sub_category_id' => $batteriesSonySub->id


            ], [


                'name' => $batterie,


                'article_sub_category_id' => $batteriesSonySub->id,


                'description' => $description


            ]);
        }

        // Microsoft
        $batteriesMicrosoftSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Batteries Microsoft',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $microsoftAccessoires->id
        ]);

        $batteriesMicrosoft = [
            'Batterie Xbox 360 Controller',
            'Batterie Xbox One Controller',
            'Batterie Xbox Series X/S Controller',
        ];

        $description = $this->generateAccessoryDescription('Batteries Microsoft', 'compatible');


        


        foreach ($batteriesMicrosoft as $batterie) {


            ArticleType::updateOrCreate([


                'name' => $batterie,


                'article_sub_category_id' => $batteriesMicrosoftSub->id


            ], [


                'name' => $batterie,


                'article_sub_category_id' => $batteriesMicrosoftSub->id,


                'description' => $description


            ]);
        }

        // =====================
        // BOÎTES COLLECTOR
        // =====================
        
        // Nintendo
        $boitesNintendoSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Boîtes collector Nintendo',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $nintendoAccessoires->id
        ]);

        $boitesNintendo = [
            'Boîte N64 Gold',
            'Boîte GameCube Resident Evil 4',
            'Boîte Wii 25th Anniversary Red',
            'Boîte Switch OLED Pokémon Scarlet/Violet',
            'Boîte Switch OLED Zelda TOTK',
            'Boîte Game Boy Micro Famicom',
            'Boîte 3DS XL Pikachu Yellow',
        ];

        $description = $this->generateAccessoryDescription('Boîtes collector Nintendo', 'compatible');


        


        foreach ($boitesNintendo as $boite) {


            ArticleType::updateOrCreate([


                'name' => $boite,


                'article_sub_category_id' => $boitesNintendoSub->id


            ], [


                'name' => $boite,


                'article_sub_category_id' => $boitesNintendoSub->id,


                'description' => $description


            ]);
        }

        // Sony
        $boitesSonySub = ArticleSubCategory::updateOrCreate([
            'name' => 'Boîtes collector Sony',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $sonyAccessoires->id
        ]);

        $boitesSony = [
            'Boîte PS4 20th Anniversary',
            'Boîte PS4 Pro 500 Million',
            'Boîte PS5 God of War Ragnarök',
            'Boîte PS5 Spider-Man 2',
            'Boîte PSP Final Fantasy VII Crisis Core',
        ];

        $description = $this->generateAccessoryDescription('Boîtes collector Sony', 'compatible');


        


        foreach ($boitesSony as $boite) {


            ArticleType::updateOrCreate([


                'name' => $boite,


                'article_sub_category_id' => $boitesSonySub->id


            ], [


                'name' => $boite,


                'article_sub_category_id' => $boitesSonySub->id,


                'description' => $description


            ]);
        }

        // Microsoft
        $boitesMicrosoftSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Boîtes collector Microsoft',
            'article_category_id' => $accessoiresCategory->id,
            'article_brand_id' => $microsoftAccessoires->id
        ]);

        $boitesMicrosoft = [
            'Boîte Xbox One Day One',
            'Boîte Xbox Series X Halo Infinite',
            'Boîte Xbox 360 Halo 3',
        ];

        $description = $this->generateAccessoryDescription('Boîtes collector Microsoft', 'compatible');


        


        foreach ($boitesMicrosoft as $boite) {


            ArticleType::updateOrCreate([


                'name' => $boite,


                'article_sub_category_id' => $boitesMicrosoftSub->id


            ], [


                'name' => $boite,


                'article_sub_category_id' => $boitesMicrosoftSub->id,


                'description' => $description


            ]);
        }

        $this->command->info('✅ Taxonomie des consoles créée avec succès !');
        $this->command->info('   - 4 catégories : Consoles, Cartes à collectionner, Accessoires, Jeux vidéo');
        $this->command->info('   - ' . ArticleBrand::count() . ' marques/compatibilités');
        $this->command->info('   - ' . ArticleSubCategory::count() . ' modèles/éditions/types accessoires');
        $this->command->info('   - ' . ArticleType::count() . ' variantes/produits');

        // ===================================================================
        // CATÉGORIE 4 : JEUX VIDÉO
        // ===================================================================
        $jeuxCategory = ArticleCategory::updateOrCreate([
            'name' => 'Jeux vidéo'
        ]);

        // Marques de jeux (TOUTES les marques de consoles)
        $nintendoJeux = ArticleBrand::where('name', 'Nintendo')->where('article_category_id', $consoleCategory->id)->first();
        $sonyJeux = ArticleBrand::where('name', 'Sony')->where('article_category_id', $consoleCategory->id)->first();
        $microsoftJeux = ArticleBrand::where('name', 'Microsoft')->where('article_category_id', $consoleCategory->id)->first();
        $segaJeux = ArticleBrand::where('name', 'Sega')->where('article_category_id', $consoleCategory->id)->first();
        $atariJeux = ArticleBrand::where('name', 'Atari')->where('article_category_id', $consoleCategory->id)->first();
        $necJeux = ArticleBrand::where('name', 'NEC')->where('article_category_id', $consoleCategory->id)->first();
        $snkJeux = ArticleBrand::where('name', 'SNK')->where('article_category_id', $consoleCategory->id)->first();
        $autresJeux = ArticleBrand::where('name', 'Autres')->where('article_category_id', $consoleCategory->id)->first();

        // Création des marques pour la catégorie Jeux vidéo
        $nintendoJeuxBrand = ArticleBrand::updateOrCreate([
            'name' => 'Nintendo',
            'article_category_id' => $jeuxCategory->id
        ]);

        $sonyJeuxBrand = ArticleBrand::updateOrCreate([
            'name' => 'Sony',
            'article_category_id' => $jeuxCategory->id
        ]);

        $microsoftJeuxBrand = ArticleBrand::updateOrCreate([
            'name' => 'Microsoft',
            'article_category_id' => $jeuxCategory->id
        ]);

        $segaJeuxBrand = ArticleBrand::updateOrCreate([
            'name' => 'Sega',
            'article_category_id' => $jeuxCategory->id
        ]);

        $atariJeuxBrand = ArticleBrand::updateOrCreate([
            'name' => 'Atari',
            'article_category_id' => $jeuxCategory->id
        ]);

        $necJeuxBrand = ArticleBrand::updateOrCreate([
            'name' => 'NEC',
            'article_category_id' => $jeuxCategory->id
        ]);

        $snkJeuxBrand = ArticleBrand::updateOrCreate([
            'name' => 'SNK',
            'article_category_id' => $jeuxCategory->id
        ]);

        $autresJeuxBrand = ArticleBrand::updateOrCreate([
            'name' => 'Autres',
            'article_category_id' => $jeuxCategory->id
        ]);

        // Sous-catégories = Consoles (regroupées)
        // NINTENDO
        $gbSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Game Boy',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $gbcSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Game Boy Color',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $gbaSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Game Boy Advance',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $dsSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Nintendo DS',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $threeDSSub = ArticleSubCategory::updateOrCreate([
            'name' => '3DS',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $nesSub = ArticleSubCategory::updateOrCreate([
            'name' => 'NES',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $snesSub = ArticleSubCategory::updateOrCreate([
            'name' => 'SNES',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $n64Sub = ArticleSubCategory::updateOrCreate([
            'name' => 'Nintendo 64',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $gamecubeSub = ArticleSubCategory::updateOrCreate([
            'name' => 'GameCube',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $wiiSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Wii',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $wiiuSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Wii U',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        $switchSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Nintendo Switch',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $nintendoJeuxBrand->id
        ]);

        // SONY
        $ps1Sub = ArticleSubCategory::updateOrCreate([
            'name' => 'PlayStation',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $sonyJeuxBrand->id
        ]);

        $ps2Sub = ArticleSubCategory::updateOrCreate([
            'name' => 'PlayStation 2',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $sonyJeuxBrand->id
        ]);

        $ps3Sub = ArticleSubCategory::updateOrCreate([
            'name' => 'PlayStation 3',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $sonyJeuxBrand->id
        ]);

        $ps4Sub = ArticleSubCategory::updateOrCreate([
            'name' => 'PlayStation 4',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $sonyJeuxBrand->id
        ]);

        $ps5Sub = ArticleSubCategory::updateOrCreate([
            'name' => 'PlayStation 5',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $sonyJeuxBrand->id
        ]);

        $pspSub = ArticleSubCategory::updateOrCreate([
            'name' => 'PSP',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $sonyJeuxBrand->id
        ]);

        $vitaSub = ArticleSubCategory::updateOrCreate([
            'name' => 'PS Vita',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $sonyJeuxBrand->id
        ]);

        // MICROSOFT
        $xboxSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Xbox',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $microsoftJeuxBrand->id
        ]);

        $xbox360Sub = ArticleSubCategory::updateOrCreate([
            'name' => 'Xbox 360',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $microsoftJeuxBrand->id
        ]);

        $xboxOneSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Xbox One',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $microsoftJeuxBrand->id
        ]);

        $xboxSeriesSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Xbox Series',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $microsoftJeuxBrand->id
        ]);

        // SEGA
        $masterSystemSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Master System',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $segaJeuxBrand->id
        ]);

        $megaDriveSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Mega Drive',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $segaJeuxBrand->id
        ]);

        $saturnSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Saturn',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $segaJeuxBrand->id
        ]);

        $dreamcastSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Dreamcast',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $segaJeuxBrand->id
        ]);

        $gameGearSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Game Gear',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $segaJeuxBrand->id
        ]);

        // ATARI
        $atari2600Sub = ArticleSubCategory::updateOrCreate([
            'name' => 'Atari 2600',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $atariJeuxBrand->id
        ]);

        $atari7800Sub = ArticleSubCategory::updateOrCreate([
            'name' => 'Atari 7800',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $atariJeuxBrand->id
        ]);

        $atariLynxSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Atari Lynx',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $atariJeuxBrand->id
        ]);

        $atariJaguarSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Atari Jaguar',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $atariJeuxBrand->id
        ]);

        // NEC
        $pcEngineSub = ArticleSubCategory::updateOrCreate([
            'name' => 'PC Engine',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $necJeuxBrand->id
        ]);

        $turbografx16Sub = ArticleSubCategory::updateOrCreate([
            'name' => 'TurboGrafx-16',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $necJeuxBrand->id
        ]);

        // SNK
        $neoGeoSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Neo Geo',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $snkJeuxBrand->id
        ]);

        $neoGeoPocketSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Neo Geo Pocket',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $snkJeuxBrand->id
        ]);

        // AUTRES
        $colecovisionSub = ArticleSubCategory::updateOrCreate([
            'name' => 'ColecoVision',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $autresJeuxBrand->id
        ]);

        $intellivisionSub = ArticleSubCategory::updateOrCreate([
            'name' => 'Intellivision',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $autresJeuxBrand->id
        ]);

        $wonderswanSub = ArticleSubCategory::updateOrCreate([
            'name' => 'WonderSwan',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $autresJeuxBrand->id
        ]);

        // ===================================================================
        // CRÉATION DE JEUX EXEMPLES AVEC ÉDITEURS
        // ===================================================================

        // GAME BOY - Jeux phares
        $gbGames = [
            ['name' => 'Tetris', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Version Rouge', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Version Bleue', 'publisher' => 'Nintendo'],
            ['name' => 'Super Mario Land', 'publisher' => 'Nintendo'],
            ['name' => 'The Legend of Zelda: Link\'s Awakening', 'publisher' => 'Nintendo'],
            ['name' => 'Kirby\'s Dream Land', 'publisher' => 'Nintendo'],
        ];
        foreach ($gbGames as $game) {
            ArticleType::updateOrCreate([
                'name' => $game['name'],
                'article_sub_category_id' => $gbSub->id,
            ], [
                'publisher' => $game['publisher']
            ]);
        }

        // GAME BOY COLOR - Jeux phares
        $gbcGames = [
            ['name' => 'Pokémon Version Or', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Version Argent', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Version Cristal', 'publisher' => 'Nintendo'],
            ['name' => 'The Legend of Zelda: Oracle of Seasons', 'publisher' => 'Nintendo'],
            ['name' => 'The Legend of Zelda: Oracle of Ages', 'publisher' => 'Nintendo'],
            ['name' => 'Super Mario Bros. Deluxe', 'publisher' => 'Nintendo'],
        ];
        foreach ($gbcGames as $game) {
            ArticleType::updateOrCreate([
                'name' => $game['name'],
                'article_sub_category_id' => $gbcSub->id,
            ], [
                'publisher' => $game['publisher']
            ]);
        }

        // GAME BOY ADVANCE - Jeux phares
        $gbaGames = [
            ['name' => 'Pokémon Version Rubis', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Version Saphir', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Version Émeraude', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Version Rouge Feu', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Version Vert Feuille', 'publisher' => 'Nintendo'],
            ['name' => 'The Legend of Zelda: The Minish Cap', 'publisher' => 'Nintendo'],
            ['name' => 'Mario Kart: Super Circuit', 'publisher' => 'Nintendo'],
            ['name' => 'Metroid Fusion', 'publisher' => 'Nintendo'],
            ['name' => 'Final Fantasy Tactics Advance', 'publisher' => 'Square Enix'],
            ['name' => 'Castlevania: Aria of Sorrow', 'publisher' => 'Konami'],
        ];
        foreach ($gbaGames as $game) {
            ArticleType::updateOrCreate([
                'name' => $game['name'],
                'article_sub_category_id' => $gbaSub->id,
            ], [
                'publisher' => $game['publisher']
            ]);
        }

        // NINTENDO DS - Jeux phares
        $dsGames = [
            ['name' => 'Pokémon Diamant', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Perle', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Platine', 'publisher' => 'Nintendo'],
            ['name' => 'New Super Mario Bros.', 'publisher' => 'Nintendo'],
            ['name' => 'Mario Kart DS', 'publisher' => 'Nintendo'],
            ['name' => 'The Legend of Zelda: Phantom Hourglass', 'publisher' => 'Nintendo'],
            ['name' => 'Nintendogs', 'publisher' => 'Nintendo'],
            ['name' => 'Animal Crossing: Wild World', 'publisher' => 'Nintendo'],
        ];
        foreach ($dsGames as $game) {
            ArticleType::updateOrCreate([
                'name' => $game['name'],
                'article_sub_category_id' => $dsSub->id,
            ], [
                'publisher' => $game['publisher']
            ]);
        }

        // 3DS - Jeux phares
        $threeDSGames = [
            ['name' => 'Pokémon X', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Y', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Rubis Oméga', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Saphir Alpha', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Soleil', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Lune', 'publisher' => 'Nintendo'],
            ['name' => 'The Legend of Zelda: Ocarina of Time 3D', 'publisher' => 'Nintendo'],
            ['name' => 'Super Mario 3D Land', 'publisher' => 'Nintendo'],
            ['name' => 'Mario Kart 7', 'publisher' => 'Nintendo'],
            ['name' => 'Animal Crossing: New Leaf', 'publisher' => 'Nintendo'],
        ];
        foreach ($threeDSGames as $game) {
            ArticleType::updateOrCreate([
                'name' => $game['name'],
                'article_sub_category_id' => $threeDSSub->id,
            ], [
                'publisher' => $game['publisher']
            ]);
        }

        // NINTENDO SWITCH - Jeux phares
        $switchGames = [
            ['name' => 'The Legend of Zelda: Breath of the Wild', 'publisher' => 'Nintendo'],
            ['name' => 'The Legend of Zelda: Tears of the Kingdom', 'publisher' => 'Nintendo'],
            ['name' => 'Super Mario Odyssey', 'publisher' => 'Nintendo'],
            ['name' => 'Mario Kart 8 Deluxe', 'publisher' => 'Nintendo'],
            ['name' => 'Animal Crossing: New Horizons', 'publisher' => 'Nintendo'],
            ['name' => 'Super Smash Bros. Ultimate', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Épée', 'publisher' => 'Nintendo'],
            ['name' => 'Pokémon Bouclier', 'publisher' => 'Nintendo'],
            ['name' => 'Splatoon 3', 'publisher' => 'Nintendo'],
        ];
        foreach ($switchGames as $game) {
            ArticleType::updateOrCreate([
                'name' => $game['name'],
                'article_sub_category_id' => $switchSub->id,
            ], [
                'publisher' => $game['publisher']
            ]);
        }

        // PLAYSTATION - Jeux phares
        $ps1Games = [
            ['name' => 'Final Fantasy VII', 'publisher' => 'Square Enix'],
            ['name' => 'Final Fantasy VIII', 'publisher' => 'Square Enix'],
            ['name' => 'Final Fantasy IX', 'publisher' => 'Square Enix'],
            ['name' => 'Metal Gear Solid', 'publisher' => 'Konami'],
            ['name' => 'Resident Evil 2', 'publisher' => 'Capcom'],
            ['name' => 'Crash Bandicoot', 'publisher' => 'Sony'],
            ['name' => 'Spyro the Dragon', 'publisher' => 'Sony'],
            ['name' => 'Gran Turismo', 'publisher' => 'Sony'],
        ];
        foreach ($ps1Games as $game) {
            ArticleType::updateOrCreate([
                'name' => $game['name'],
                'article_sub_category_id' => $ps1Sub->id,
            ], [
                'publisher' => $game['publisher']
            ]);
        }

        // PLAYSTATION 2 - Jeux phares
        $ps2Games = [
            ['name' => 'Grand Theft Auto: San Andreas', 'publisher' => 'Rockstar Games'],
            ['name' => 'God of War', 'publisher' => 'Sony'],
            ['name' => 'God of War II', 'publisher' => 'Sony'],
            ['name' => 'Final Fantasy X', 'publisher' => 'Square Enix'],
            ['name' => 'Kingdom Hearts', 'publisher' => 'Square Enix'],
            ['name' => 'Shadow of the Colossus', 'publisher' => 'Sony'],
            ['name' => 'Devil May Cry', 'publisher' => 'Capcom'],
        ];
        foreach ($ps2Games as $game) {
            ArticleType::updateOrCreate([
                'name' => $game['name'],
                'article_sub_category_id' => $ps2Sub->id,
            ], [
                'publisher' => $game['publisher']
            ]);
        }

        // PLAYSTATION 4 - Jeux phares
        $ps4Games = [
            ['name' => 'The Last of Us Part II', 'publisher' => 'Sony'],
            ['name' => 'God of War (2018)', 'publisher' => 'Sony'],
            ['name' => 'Spider-Man', 'publisher' => 'Sony'],
            ['name' => 'Horizon Zero Dawn', 'publisher' => 'Sony'],
            ['name' => 'Bloodborne', 'publisher' => 'Sony'],
            ['name' => 'Ghost of Tsushima', 'publisher' => 'Sony'],
        ];
        foreach ($ps4Games as $game) {
            ArticleType::updateOrCreate([
                'name' => $game['name'],
                'article_sub_category_id' => $ps4Sub->id,
            ], [
                'publisher' => $game['publisher']
            ]);
        }

        // MEGA DRIVE - Jeux phares
        $megaDriveGames = [
            ['name' => 'Sonic the Hedgehog', 'publisher' => 'Sega'],
            ['name' => 'Sonic the Hedgehog 2', 'publisher' => 'Sega'],
            ['name' => 'Streets of Rage 2', 'publisher' => 'Sega'],
            ['name' => 'Golden Axe', 'publisher' => 'Sega'],
            ['name' => 'Shinobi III', 'publisher' => 'Sega'],
            ['name' => 'Phantasy Star IV', 'publisher' => 'Sega'],
        ];
        foreach ($megaDriveGames as $game) {
            ArticleType::updateOrCreate([
                'name' => $game['name'],
                'article_sub_category_id' => $megaDriveSub->id,
            ], [
                'publisher' => $game['publisher']
            ]);
        }

        $this->command->info('✅ Catégorie Jeux vidéo créée avec toutes les sous-catégories !');
        $this->command->info('✅ ' . count($gbGames) + count($gbcGames) + count($gbaGames) + count($dsGames) + count($threeDSGames) + count($switchGames) + count($ps1Games) + count($ps2Games) + count($ps4Games) + count($megaDriveGames) . ' jeux exemples créés avec leurs éditeurs !');
        $this->command->info('   Éditeurs ajoutés : Nintendo, Sony, Sega, Capcom, Konami, Square Enix, Rockstar Games');
    }
}
