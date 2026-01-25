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

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
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

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
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

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
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

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
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

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
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

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
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

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
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

            foreach ($variants as $variant) {
                ArticleType::updateOrCreate([
                    'name' => $variant,
                    'article_sub_category_id' => $subCat->id
                ]);
            }
        }

        $this->command->info('✅ Taxonomie des consoles créée avec succès !');
        $this->command->info('   - 1 catégorie : Consoles');
        $this->command->info('   - 8 marques : Nintendo, Sony, Microsoft, Sega, Atari, NEC, SNK, Autres');
        $this->command->info('   - ' . ArticleSubCategory::count() . ' modèles de consoles');
        $this->command->info('   - ' . ArticleType::count() . ' variantes avec symboles Ⓢ (standard) et Ⓒ (collector)');
    }
}

