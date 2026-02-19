<?php

// Script de renommage automatique - Game Gear Images → ROM_ID
// Génére automatiquement - Ne PAS modifier manuellement

$imageDir = __DIR__ . '/public/images/taxonomy/gamegear';
$renamed = 0;
$skipped = 0;
$errors = 0;

// Adventures of Batman Robin the → Adventures of Batman _ Robin, The
if (file_exists($imageDir . '/Adventures of Batman Robin the (World)-cover.png')) {
    if (!file_exists($imageDir . '/Adventures of Batman _ Robin, The-cover.png')) {
        if (rename($imageDir . '/Adventures of Batman Robin the (World)-cover.png', $imageDir . '/Adventures of Batman _ Robin, The-cover.png')) {
            echo "✓ Adventures of Batman Robin the (World)-cover.png → Adventures of Batman _ Robin, The-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Adventures of Batman Robin the (World)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Adventures of Batman _ Robin, The-cover.png\n";
        $skipped++;
    }
}

// Archer Macleans Dropzone → Archer Maclean's Dropzone
if (file_exists($imageDir . '/Archer Macleans Dropzone (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Archer Maclean\'s Dropzone-artwork.png')) {
        if (rename($imageDir . '/Archer Macleans Dropzone (Europe)-artwork.png', $imageDir . '/Archer Maclean\'s Dropzone-artwork.png')) {
            echo "✓ Archer Macleans Dropzone (Europe)-artwork.png → Archer Maclean\'s Dropzone-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Archer Macleans Dropzone (Europe)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Archer Maclean\'s Dropzone-artwork.png\n";
        $skipped++;
    }
}

// Archer Macleans Dropzone → Archer Maclean's Dropzone
if (file_exists($imageDir . '/Archer Macleans Dropzone (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Archer Maclean\'s Dropzone-cover.png')) {
        if (rename($imageDir . '/Archer Macleans Dropzone (Europe)-cover.png', $imageDir . '/Archer Maclean\'s Dropzone-cover.png')) {
            echo "✓ Archer Macleans Dropzone (Europe)-cover.png → Archer Maclean\'s Dropzone-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Archer Macleans Dropzone (Europe)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Archer Maclean\'s Dropzone-cover.png\n";
        $skipped++;
    }
}

// Archer Macleans Dropzone → Archer Maclean's Dropzone
if (file_exists($imageDir . '/Archer Macleans Dropzone (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Archer Maclean\'s Dropzone-gameplay.png')) {
        if (rename($imageDir . '/Archer Macleans Dropzone (Europe)-gameplay.png', $imageDir . '/Archer Maclean\'s Dropzone-gameplay.png')) {
            echo "✓ Archer Macleans Dropzone (Europe)-gameplay.png → Archer Maclean\'s Dropzone-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Archer Macleans Dropzone (Europe)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Archer Maclean\'s Dropzone-gameplay.png\n";
        $skipped++;
    }
}

// Ax Battler a Legend of Golden Axe V2 4 Tr → Ax Battler - A Legend of Golden Axe v2.4
if (file_exists($imageDir . '/Ax Battler a Legend of Golden Axe V2 4 Tr (Es)-cover.png')) {
    if (!file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe v2.4-cover.png')) {
        if (rename($imageDir . '/Ax Battler a Legend of Golden Axe V2 4 Tr (Es)-cover.png', $imageDir . '/Ax Battler - A Legend of Golden Axe v2.4-cover.png')) {
            echo "✓ Ax Battler a Legend of Golden Axe V2 4 Tr (Es)-cover.png → Ax Battler - A Legend of Golden Axe v2.4-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Ax Battler a Legend of Golden Axe V2 4 Tr (Es)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Ax Battler - A Legend of Golden Axe v2.4-cover.png\n";
        $skipped++;
    }
}

// Ayrton Sennas Super Monaco Gp Ii → Ayrton Senna's Super Monaco GP II
if (file_exists($imageDir . '/Ayrton Sennas Super Monaco Gp Ii (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-artwork.png')) {
        if (rename($imageDir . '/Ayrton Sennas Super Monaco Gp Ii (Japan)-artwork.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II-artwork.png')) {
            echo "✓ Ayrton Sennas Super Monaco Gp Ii (Japan)-artwork.png → Ayrton Senna\'s Super Monaco GP II-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Ayrton Sennas Super Monaco Gp Ii (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Ayrton Senna\'s Super Monaco GP II-artwork.png\n";
        $skipped++;
    }
}

// Ayrton Sennas Super Monaco Gp Ii → Ayrton Senna's Super Monaco GP II
if (file_exists($imageDir . '/Ayrton Sennas Super Monaco Gp Ii (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-cover.png')) {
        if (rename($imageDir . '/Ayrton Sennas Super Monaco Gp Ii (Japan)-cover.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II-cover.png')) {
            echo "✓ Ayrton Sennas Super Monaco Gp Ii (Japan)-cover.png → Ayrton Senna\'s Super Monaco GP II-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Ayrton Sennas Super Monaco Gp Ii (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Ayrton Senna\'s Super Monaco GP II-cover.png\n";
        $skipped++;
    }
}

// Ayrton Sennas Super Monaco Gp Ii → Ayrton Senna's Super Monaco GP II
if (file_exists($imageDir . '/Ayrton Sennas Super Monaco Gp Ii (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-gameplay.png')) {
        if (rename($imageDir . '/Ayrton Sennas Super Monaco Gp Ii (Japan)-gameplay.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II-gameplay.png')) {
            echo "✓ Ayrton Sennas Super Monaco Gp Ii (Japan)-gameplay.png → Ayrton Senna\'s Super Monaco GP II-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Ayrton Sennas Super Monaco Gp Ii (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Ayrton Senna\'s Super Monaco GP II-gameplay.png\n";
        $skipped++;
    }
}

// Berenstain Bears Camping Adventure the → Berenstain Bears' Camping Adventure, The
if (file_exists($imageDir . '/Berenstain Bears Camping Adventure the (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Berenstain Bears\' Camping Adventure, The-artwork.png')) {
        if (rename($imageDir . '/Berenstain Bears Camping Adventure the (USA)-artwork.png', $imageDir . '/Berenstain Bears\' Camping Adventure, The-artwork.png')) {
            echo "✓ Berenstain Bears Camping Adventure the (USA)-artwork.png → Berenstain Bears\' Camping Adventure, The-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Berenstain Bears Camping Adventure the (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Berenstain Bears\' Camping Adventure, The-artwork.png\n";
        $skipped++;
    }
}

// Berenstain Bears Camping Adventure the → Berenstain Bears' Camping Adventure, The
if (file_exists($imageDir . '/Berenstain Bears Camping Adventure the (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Berenstain Bears\' Camping Adventure, The-cover.png')) {
        if (rename($imageDir . '/Berenstain Bears Camping Adventure the (USA)-cover.png', $imageDir . '/Berenstain Bears\' Camping Adventure, The-cover.png')) {
            echo "✓ Berenstain Bears Camping Adventure the (USA)-cover.png → Berenstain Bears\' Camping Adventure, The-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Berenstain Bears Camping Adventure the (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Berenstain Bears\' Camping Adventure, The-cover.png\n";
        $skipped++;
    }
}

// Berenstain Bears Camping Adventure the → Berenstain Bears' Camping Adventure, The
if (file_exists($imageDir . '/Berenstain Bears Camping Adventure the (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Berenstain Bears\' Camping Adventure, The-gameplay.png')) {
        if (rename($imageDir . '/Berenstain Bears Camping Adventure the (USA)-gameplay.png', $imageDir . '/Berenstain Bears\' Camping Adventure, The-gameplay.png')) {
            echo "✓ Berenstain Bears Camping Adventure the (USA)-gameplay.png → Berenstain Bears\' Camping Adventure, The-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Berenstain Bears Camping Adventure the (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Berenstain Bears\' Camping Adventure, The-gameplay.png\n";
        $skipped++;
    }
}

// Bram Stokers Dracula → Bram Stoker's Dracula
if (file_exists($imageDir . '/Bram Stokers Dracula (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula-artwork.png')) {
        if (rename($imageDir . '/Bram Stokers Dracula (Europe)-artwork.png', $imageDir . '/Bram Stoker\'s Dracula-artwork.png')) {
            echo "✓ Bram Stokers Dracula (Europe)-artwork.png → Bram Stoker\'s Dracula-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Bram Stokers Dracula (Europe)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Bram Stoker\'s Dracula-artwork.png\n";
        $skipped++;
    }
}

// Bram Stokers Dracula → Bram Stoker's Dracula
if (file_exists($imageDir . '/Bram Stokers Dracula (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula-cover.png')) {
        if (rename($imageDir . '/Bram Stokers Dracula (Europe)-cover.png', $imageDir . '/Bram Stoker\'s Dracula-cover.png')) {
            echo "✓ Bram Stokers Dracula (Europe)-cover.png → Bram Stoker\'s Dracula-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Bram Stokers Dracula (Europe)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Bram Stoker\'s Dracula-cover.png\n";
        $skipped++;
    }
}

// Bram Stokers Dracula → Bram Stoker's Dracula
if (file_exists($imageDir . '/Bram Stokers Dracula (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula-gameplay.png')) {
        if (rename($imageDir . '/Bram Stokers Dracula (Europe)-gameplay.png', $imageDir . '/Bram Stoker\'s Dracula-gameplay.png')) {
            echo "✓ Bram Stokers Dracula (Europe)-gameplay.png → Bram Stoker\'s Dracula-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Bram Stokers Dracula (Europe)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Bram Stoker\'s Dracula-gameplay.png\n";
        $skipped++;
    }
}

// Bram Stokers Dracula → Bram Stoker's Dracula
if (file_exists($imageDir . '/Bram Stokers Dracula (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula-artwork.png')) {
        if (rename($imageDir . '/Bram Stokers Dracula (USA)-artwork.png', $imageDir . '/Bram Stoker\'s Dracula-artwork.png')) {
            echo "✓ Bram Stokers Dracula (USA)-artwork.png → Bram Stoker\'s Dracula-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Bram Stokers Dracula (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Bram Stoker\'s Dracula-artwork.png\n";
        $skipped++;
    }
}

// Bram Stokers Dracula → Bram Stoker's Dracula
if (file_exists($imageDir . '/Bram Stokers Dracula (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula-cover.png')) {
        if (rename($imageDir . '/Bram Stokers Dracula (USA)-cover.png', $imageDir . '/Bram Stoker\'s Dracula-cover.png')) {
            echo "✓ Bram Stokers Dracula (USA)-cover.png → Bram Stoker\'s Dracula-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Bram Stokers Dracula (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Bram Stoker\'s Dracula-cover.png\n";
        $skipped++;
    }
}

// Bram Stokers Dracula → Bram Stoker's Dracula
if (file_exists($imageDir . '/Bram Stokers Dracula (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula-gameplay.png')) {
        if (rename($imageDir . '/Bram Stokers Dracula (USA)-gameplay.png', $imageDir . '/Bram Stoker\'s Dracula-gameplay.png')) {
            echo "✓ Bram Stokers Dracula (USA)-gameplay.png → Bram Stoker\'s Dracula-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Bram Stokers Dracula (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Bram Stoker\'s Dracula-gameplay.png\n";
        $skipped++;
    }
}

// Crayon Shin Chan Taiketsu Kantam Panic → Crayon Shin-chan - Taiketsu! Kantam Panic!!
if (file_exists($imageDir . '/Crayon Shin Chan Taiketsu Kantam Panic (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-artwork.png')) {
        if (rename($imageDir . '/Crayon Shin Chan Taiketsu Kantam Panic (Japan)-artwork.png', $imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-artwork.png')) {
            echo "✓ Crayon Shin Chan Taiketsu Kantam Panic (Japan)-artwork.png → Crayon Shin-chan - Taiketsu! Kantam Panic!!-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Crayon Shin Chan Taiketsu Kantam Panic (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Crayon Shin-chan - Taiketsu! Kantam Panic!!-artwork.png\n";
        $skipped++;
    }
}

// Crayon Shin Chan Taiketsu Kantam Panic → Crayon Shin-chan - Taiketsu! Kantam Panic!!
if (file_exists($imageDir . '/Crayon Shin Chan Taiketsu Kantam Panic (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-cover.png')) {
        if (rename($imageDir . '/Crayon Shin Chan Taiketsu Kantam Panic (Japan)-cover.png', $imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-cover.png')) {
            echo "✓ Crayon Shin Chan Taiketsu Kantam Panic (Japan)-cover.png → Crayon Shin-chan - Taiketsu! Kantam Panic!!-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Crayon Shin Chan Taiketsu Kantam Panic (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Crayon Shin-chan - Taiketsu! Kantam Panic!!-cover.png\n";
        $skipped++;
    }
}

// Crayon Shin Chan Taiketsu Kantam Panic → Crayon Shin-chan - Taiketsu! Kantam Panic!!
if (file_exists($imageDir . '/Crayon Shin Chan Taiketsu Kantam Panic (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-gameplay.png')) {
        if (rename($imageDir . '/Crayon Shin Chan Taiketsu Kantam Panic (Japan)-gameplay.png', $imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-gameplay.png')) {
            echo "✓ Crayon Shin Chan Taiketsu Kantam Panic (Japan)-gameplay.png → Crayon Shin-chan - Taiketsu! Kantam Panic!!-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Crayon Shin Chan Taiketsu Kantam Panic (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Crayon Shin-chan - Taiketsu! Kantam Panic!!-gameplay.png\n";
        $skipped++;
    }
}

// Crayon Shin Chan Taiketsu Kantam Panic Japan T En By Psyklax → Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan) [T-En by Psyklax]
if (file_exists($imageDir . '/Crayon Shin Chan Taiketsu Kantam Panic Japan T En By Psyklax-artwork.png')) {
    if (!file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan) [T-En by Psyklax]-artwork.png')) {
        if (rename($imageDir . '/Crayon Shin Chan Taiketsu Kantam Panic Japan T En By Psyklax-artwork.png', $imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan) [T-En by Psyklax]-artwork.png')) {
            echo "✓ Crayon Shin Chan Taiketsu Kantam Panic Japan T En By Psyklax-artwork.png → Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan) [T-En by Psyklax]-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Crayon Shin Chan Taiketsu Kantam Panic Japan T En By Psyklax-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan) [T-En by Psyklax]-artwork.png\n";
        $skipped++;
    }
}

// Crayon Shin Chan Taiketsu Kantam Panic Japan T En By Psyklax → Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan) [T-En by Psyklax]
if (file_exists($imageDir . '/Crayon Shin Chan Taiketsu Kantam Panic Japan T En By Psyklax-cover.png')) {
    if (!file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan) [T-En by Psyklax]-cover.png')) {
        if (rename($imageDir . '/Crayon Shin Chan Taiketsu Kantam Panic Japan T En By Psyklax-cover.png', $imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan) [T-En by Psyklax]-cover.png')) {
            echo "✓ Crayon Shin Chan Taiketsu Kantam Panic Japan T En By Psyklax-cover.png → Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan) [T-En by Psyklax]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Crayon Shin Chan Taiketsu Kantam Panic Japan T En By Psyklax-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan) [T-En by Psyklax]-cover.png\n";
        $skipped++;
    }
}

// Defenders of Oasis Tr Fr Generation Ixv1 0 → Defenders of Oasis [tr fr Generation IX][v1.0]
if (file_exists($imageDir . '/Defenders of Oasis Tr Fr Generation Ixv1 0-cover.png')) {
    if (!file_exists($imageDir . '/Defenders of Oasis [tr fr Generation IX][v1.0]-cover.png')) {
        if (rename($imageDir . '/Defenders of Oasis Tr Fr Generation Ixv1 0-cover.png', $imageDir . '/Defenders of Oasis [tr fr Generation IX][v1.0]-cover.png')) {
            echo "✓ Defenders of Oasis Tr Fr Generation Ixv1 0-cover.png → Defenders of Oasis [tr fr Generation IX][v1.0]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Defenders of Oasis Tr Fr Generation Ixv1 0-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Defenders of Oasis [tr fr Generation IX][v1.0]-cover.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E Coyote Usa → Desert Speedtrap Starring Road Runner and Wile E. Coyote
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa (Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa (Brazil)-cover.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E Coyote Usa (Brazil)-cover.png → Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Desert Speedtrap Starring Road Runner and Wile E Coyote Usa (Brazil)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E Coyote Usa → Desert Speedtrap Starring Road Runner and Wile E. Coyote
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa (Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa (Brazil)-gameplay.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E Coyote Usa (Brazil)-gameplay.png → Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Desert Speedtrap Starring Road Runner and Wile E Coyote Usa (Brazil)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil → Desert Speedtrap Starring Road Runner and Wile E. Coyote
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-artwork.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-artwork.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-artwork.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-artwork.png → Desert Speedtrap Starring Road Runner and Wile E. Coyote-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Desert Speedtrap Starring Road Runner and Wile E. Coyote-artwork.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil → Desert Speedtrap Starring Road Runner and Wile E. Coyote
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-cover.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-cover.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-cover.png → Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil → Desert Speedtrap Starring Road Runner and Wile E. Coyote
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-gameplay.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-gameplay.png → Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png\n";
        $skipped++;
    }
}

// Dr Robotniks Mean Bean Machine Usa → Dr. Robotnik's Mean Bean Machine
if (file_exists($imageDir . '/Dr Robotniks Mean Bean Machine Usa (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Dr. Robotnik\'s Mean Bean Machine-artwork.png')) {
        if (rename($imageDir . '/Dr Robotniks Mean Bean Machine Usa (Europe)-artwork.png', $imageDir . '/Dr. Robotnik\'s Mean Bean Machine-artwork.png')) {
            echo "✓ Dr Robotniks Mean Bean Machine Usa (Europe)-artwork.png → Dr. Robotnik\'s Mean Bean Machine-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Dr Robotniks Mean Bean Machine Usa (Europe)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Dr. Robotnik\'s Mean Bean Machine-artwork.png\n";
        $skipped++;
    }
}

// Dr Robotniks Mean Bean Machine Usa → Dr. Robotnik's Mean Bean Machine
if (file_exists($imageDir . '/Dr Robotniks Mean Bean Machine Usa (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Dr. Robotnik\'s Mean Bean Machine-cover.png')) {
        if (rename($imageDir . '/Dr Robotniks Mean Bean Machine Usa (Europe)-cover.png', $imageDir . '/Dr. Robotnik\'s Mean Bean Machine-cover.png')) {
            echo "✓ Dr Robotniks Mean Bean Machine Usa (Europe)-cover.png → Dr. Robotnik\'s Mean Bean Machine-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Dr Robotniks Mean Bean Machine Usa (Europe)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Dr. Robotnik\'s Mean Bean Machine-cover.png\n";
        $skipped++;
    }
}

// Dr Robotniks Mean Bean Machine Usa → Dr. Robotnik's Mean Bean Machine
if (file_exists($imageDir . '/Dr Robotniks Mean Bean Machine Usa (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Dr. Robotnik\'s Mean Bean Machine-gameplay.png')) {
        if (rename($imageDir . '/Dr Robotniks Mean Bean Machine Usa (Europe)-gameplay.png', $imageDir . '/Dr. Robotnik\'s Mean Bean Machine-gameplay.png')) {
            echo "✓ Dr Robotniks Mean Bean Machine Usa (Europe)-gameplay.png → Dr. Robotnik\'s Mean Bean Machine-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Dr Robotniks Mean Bean Machine Usa (Europe)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Dr. Robotnik\'s Mean Bean Machine-gameplay.png\n";
        $skipped++;
    }
}

// Dragon Crystal - Tsurani no Meikyuu (Japan) → Dragon Crystal - Tsurani no Meikyuu
if (file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-artwork.png')) {
    if (!file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-artwork.png')) {
        if (rename($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-artwork.png', $imageDir . '/Dragon Crystal - Tsurani no Meikyuu-artwork.png')) {
            echo "✓ Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-artwork.png → Dragon Crystal - Tsurani no Meikyuu-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Dragon Crystal - Tsurani no Meikyuu-artwork.png\n";
        $skipped++;
    }
}

// Dragon Crystal - Tsurani no Meikyuu (Japan) → Dragon Crystal - Tsurani no Meikyuu
if (file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-cover.png')) {
    if (!file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-cover.png')) {
        if (rename($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-cover.png', $imageDir . '/Dragon Crystal - Tsurani no Meikyuu-cover.png')) {
            echo "✓ Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-cover.png → Dragon Crystal - Tsurani no Meikyuu-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Dragon Crystal - Tsurani no Meikyuu-cover.png\n";
        $skipped++;
    }
}

// Dragon Crystal - Tsurani no Meikyuu (Japan) → Dragon Crystal - Tsurani no Meikyuu
if (file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-gameplay.png')) {
    if (!file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-gameplay.png')) {
        if (rename($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-gameplay.png', $imageDir . '/Dragon Crystal - Tsurani no Meikyuu-gameplay.png')) {
            echo "✓ Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-gameplay.png → Dragon Crystal - Tsurani no Meikyuu-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Dragon Crystal - Tsurani no Meikyuu (Japan) (Virtual Console)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Dragon Crystal - Tsurani no Meikyuu-gameplay.png\n";
        $skipped++;
    }
}

// Evander Holyfields Real Deal Boxing Usa → Evander Holyfield's 'Real Deal' Boxing
if (file_exists($imageDir . '/Evander Holyfields Real Deal Boxing Usa (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-artwork.png')) {
        if (rename($imageDir . '/Evander Holyfields Real Deal Boxing Usa (Europe)-artwork.png', $imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-artwork.png')) {
            echo "✓ Evander Holyfields Real Deal Boxing Usa (Europe)-artwork.png → Evander Holyfield\'s \'Real Deal\' Boxing-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Evander Holyfields Real Deal Boxing Usa (Europe)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Evander Holyfield\'s \'Real Deal\' Boxing-artwork.png\n";
        $skipped++;
    }
}

// Evander Holyfields Real Deal Boxing Usa → Evander Holyfield's 'Real Deal' Boxing
if (file_exists($imageDir . '/Evander Holyfields Real Deal Boxing Usa (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-cover.png')) {
        if (rename($imageDir . '/Evander Holyfields Real Deal Boxing Usa (Europe)-cover.png', $imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-cover.png')) {
            echo "✓ Evander Holyfields Real Deal Boxing Usa (Europe)-cover.png → Evander Holyfield\'s \'Real Deal\' Boxing-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Evander Holyfields Real Deal Boxing Usa (Europe)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Evander Holyfield\'s \'Real Deal\' Boxing-cover.png\n";
        $skipped++;
    }
}

// Evander Holyfields Real Deal Boxing Usa → Evander Holyfield's 'Real Deal' Boxing
if (file_exists($imageDir . '/Evander Holyfields Real Deal Boxing Usa (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-gameplay.png')) {
        if (rename($imageDir . '/Evander Holyfields Real Deal Boxing Usa (Europe)-gameplay.png', $imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-gameplay.png')) {
            echo "✓ Evander Holyfields Real Deal Boxing Usa (Europe)-gameplay.png → Evander Holyfield\'s \'Real Deal\' Boxing-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Evander Holyfields Real Deal Boxing Usa (Europe)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Evander Holyfield\'s \'Real Deal\' Boxing-gameplay.png\n";
        $skipped++;
    }
}

// Ganbare Gorby → Ganbare Gorby!
if (file_exists($imageDir . '/Ganbare Gorby (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Ganbare Gorby!-artwork.png')) {
        if (rename($imageDir . '/Ganbare Gorby (Japan)-artwork.png', $imageDir . '/Ganbare Gorby!-artwork.png')) {
            echo "✓ Ganbare Gorby (Japan)-artwork.png → Ganbare Gorby!-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Ganbare Gorby (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Ganbare Gorby!-artwork.png\n";
        $skipped++;
    }
}

// Ganbare Gorby → Ganbare Gorby!
if (file_exists($imageDir . '/Ganbare Gorby (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Ganbare Gorby!-cover.png')) {
        if (rename($imageDir . '/Ganbare Gorby (Japan)-cover.png', $imageDir . '/Ganbare Gorby!-cover.png')) {
            echo "✓ Ganbare Gorby (Japan)-cover.png → Ganbare Gorby!-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Ganbare Gorby (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Ganbare Gorby!-cover.png\n";
        $skipped++;
    }
}

// Ganbare Gorby → Ganbare Gorby!
if (file_exists($imageDir . '/Ganbare Gorby (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ganbare Gorby!-gameplay.png')) {
        if (rename($imageDir . '/Ganbare Gorby (Japan)-gameplay.png', $imageDir . '/Ganbare Gorby!-gameplay.png')) {
            echo "✓ Ganbare Gorby (Japan)-gameplay.png → Ganbare Gorby!-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Ganbare Gorby (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Ganbare Gorby!-gameplay.png\n";
        $skipped++;
    }
}

// George Foremans Ko Boxing Usa → George Foreman's KO Boxing
if (file_exists($imageDir . '/George Foremans Ko Boxing Usa (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/George Foreman\'s KO Boxing-artwork.png')) {
        if (rename($imageDir . '/George Foremans Ko Boxing Usa (Europe)-artwork.png', $imageDir . '/George Foreman\'s KO Boxing-artwork.png')) {
            echo "✓ George Foremans Ko Boxing Usa (Europe)-artwork.png → George Foreman\'s KO Boxing-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: George Foremans Ko Boxing Usa (Europe)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: George Foreman\'s KO Boxing-artwork.png\n";
        $skipped++;
    }
}

// George Foremans Ko Boxing Usa → George Foreman's KO Boxing
if (file_exists($imageDir . '/George Foremans Ko Boxing Usa (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/George Foreman\'s KO Boxing-cover.png')) {
        if (rename($imageDir . '/George Foremans Ko Boxing Usa (Europe)-cover.png', $imageDir . '/George Foreman\'s KO Boxing-cover.png')) {
            echo "✓ George Foremans Ko Boxing Usa (Europe)-cover.png → George Foreman\'s KO Boxing-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: George Foremans Ko Boxing Usa (Europe)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: George Foreman\'s KO Boxing-cover.png\n";
        $skipped++;
    }
}

// George Foremans Ko Boxing Usa → George Foreman's KO Boxing
if (file_exists($imageDir . '/George Foremans Ko Boxing Usa (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/George Foreman\'s KO Boxing-gameplay.png')) {
        if (rename($imageDir . '/George Foremans Ko Boxing Usa (Europe)-gameplay.png', $imageDir . '/George Foreman\'s KO Boxing-gameplay.png')) {
            echo "✓ George Foremans Ko Boxing Usa (Europe)-gameplay.png → George Foreman\'s KO Boxing-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: George Foremans Ko Boxing Usa (Europe)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: George Foreman\'s KO Boxing-gameplay.png\n";
        $skipped++;
    }
}

// Greendog the Beached Surfer Dude Usa → Greendog - The Beached Surfer Dude!
if (file_exists($imageDir . '/Greendog the Beached Surfer Dude Usa (Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Greendog - The Beached Surfer Dude!-cover.png')) {
        if (rename($imageDir . '/Greendog the Beached Surfer Dude Usa (Brazil)-cover.png', $imageDir . '/Greendog - The Beached Surfer Dude!-cover.png')) {
            echo "✓ Greendog the Beached Surfer Dude Usa (Brazil)-cover.png → Greendog - The Beached Surfer Dude!-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Greendog the Beached Surfer Dude Usa (Brazil)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Greendog - The Beached Surfer Dude!-cover.png\n";
        $skipped++;
    }
}

// Greendog the Beached Surfer Dude Usa → Greendog - The Beached Surfer Dude!
if (file_exists($imageDir . '/Greendog the Beached Surfer Dude Usa (Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Greendog - The Beached Surfer Dude!-gameplay.png')) {
        if (rename($imageDir . '/Greendog the Beached Surfer Dude Usa (Brazil)-gameplay.png', $imageDir . '/Greendog - The Beached Surfer Dude!-gameplay.png')) {
            echo "✓ Greendog the Beached Surfer Dude Usa (Brazil)-gameplay.png → Greendog - The Beached Surfer Dude!-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Greendog the Beached Surfer Dude Usa (Brazil)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Greendog - The Beached Surfer Dude!-gameplay.png\n";
        $skipped++;
    }
}

// Head Buster Japan T En By Chris M Covell → Head Buster (Japan) [T-En by Chris M. Covell]
if (file_exists($imageDir . '/Head Buster Japan T En By Chris M Covell-artwork.png')) {
    if (!file_exists($imageDir . '/Head Buster (Japan) [T-En by Chris M. Covell]-artwork.png')) {
        if (rename($imageDir . '/Head Buster Japan T En By Chris M Covell-artwork.png', $imageDir . '/Head Buster (Japan) [T-En by Chris M. Covell]-artwork.png')) {
            echo "✓ Head Buster Japan T En By Chris M Covell-artwork.png → Head Buster (Japan) [T-En by Chris M. Covell]-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Head Buster Japan T En By Chris M Covell-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Head Buster (Japan) [T-En by Chris M. Covell]-artwork.png\n";
        $skipped++;
    }
}

// Head Buster Japan T En By Chris M Covell → Head Buster (Japan) [T-En by Chris M. Covell]
if (file_exists($imageDir . '/Head Buster Japan T En By Chris M Covell-cover.png')) {
    if (!file_exists($imageDir . '/Head Buster (Japan) [T-En by Chris M. Covell]-cover.png')) {
        if (rename($imageDir . '/Head Buster Japan T En By Chris M Covell-cover.png', $imageDir . '/Head Buster (Japan) [T-En by Chris M. Covell]-cover.png')) {
            echo "✓ Head Buster Japan T En By Chris M Covell-cover.png → Head Buster (Japan) [T-En by Chris M. Covell]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Head Buster Japan T En By Chris M Covell-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Head Buster (Japan) [T-En by Chris M. Covell]-cover.png\n";
        $skipped++;
    }
}

// Hyper Pro Yakyuu 92 → Hyper Pro Yakyuu '92
if (file_exists($imageDir . '/Hyper Pro Yakyuu 92 (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Hyper Pro Yakyuu \'92-artwork.png')) {
        if (rename($imageDir . '/Hyper Pro Yakyuu 92 (Japan)-artwork.png', $imageDir . '/Hyper Pro Yakyuu \'92-artwork.png')) {
            echo "✓ Hyper Pro Yakyuu 92 (Japan)-artwork.png → Hyper Pro Yakyuu \'92-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Hyper Pro Yakyuu 92 (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Hyper Pro Yakyuu \'92-artwork.png\n";
        $skipped++;
    }
}

// Hyper Pro Yakyuu 92 → Hyper Pro Yakyuu '92
if (file_exists($imageDir . '/Hyper Pro Yakyuu 92 (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Hyper Pro Yakyuu \'92-cover.png')) {
        if (rename($imageDir . '/Hyper Pro Yakyuu 92 (Japan)-cover.png', $imageDir . '/Hyper Pro Yakyuu \'92-cover.png')) {
            echo "✓ Hyper Pro Yakyuu 92 (Japan)-cover.png → Hyper Pro Yakyuu \'92-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Hyper Pro Yakyuu 92 (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Hyper Pro Yakyuu \'92-cover.png\n";
        $skipped++;
    }
}

// Hyper Pro Yakyuu 92 → Hyper Pro Yakyuu '92
if (file_exists($imageDir . '/Hyper Pro Yakyuu 92 (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Hyper Pro Yakyuu \'92-gameplay.png')) {
        if (rename($imageDir . '/Hyper Pro Yakyuu 92 (Japan)-gameplay.png', $imageDir . '/Hyper Pro Yakyuu \'92-gameplay.png')) {
            echo "✓ Hyper Pro Yakyuu 92 (Japan)-gameplay.png → Hyper Pro Yakyuu \'92-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Hyper Pro Yakyuu 92 (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Hyper Pro Yakyuu \'92-gameplay.png\n";
        $skipped++;
    }
}

// J League Gg Pro Striker 94 → J.League GG Pro-Striker '94
if (file_exists($imageDir . '/J League Gg Pro Striker 94 (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/J.League GG Pro-Striker \'94-artwork.png')) {
        if (rename($imageDir . '/J League Gg Pro Striker 94 (Japan)-artwork.png', $imageDir . '/J.League GG Pro-Striker \'94-artwork.png')) {
            echo "✓ J League Gg Pro Striker 94 (Japan)-artwork.png → J.League GG Pro-Striker \'94-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: J League Gg Pro Striker 94 (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: J.League GG Pro-Striker \'94-artwork.png\n";
        $skipped++;
    }
}

// J League Gg Pro Striker 94 → J.League GG Pro-Striker '94
if (file_exists($imageDir . '/J League Gg Pro Striker 94 (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/J.League GG Pro-Striker \'94-cover.png')) {
        if (rename($imageDir . '/J League Gg Pro Striker 94 (Japan)-cover.png', $imageDir . '/J.League GG Pro-Striker \'94-cover.png')) {
            echo "✓ J League Gg Pro Striker 94 (Japan)-cover.png → J.League GG Pro-Striker \'94-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: J League Gg Pro Striker 94 (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: J.League GG Pro-Striker \'94-cover.png\n";
        $skipped++;
    }
}

// J League Gg Pro Striker 94 → J.League GG Pro-Striker '94
if (file_exists($imageDir . '/J League Gg Pro Striker 94 (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/J.League GG Pro-Striker \'94-gameplay.png')) {
        if (rename($imageDir . '/J League Gg Pro Striker 94 (Japan)-gameplay.png', $imageDir . '/J.League GG Pro-Striker \'94-gameplay.png')) {
            echo "✓ J League Gg Pro Striker 94 (Japan)-gameplay.png → J.League GG Pro-Striker \'94-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: J League Gg Pro Striker 94 (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: J.League GG Pro-Striker \'94-gameplay.png\n";
        $skipped++;
    }
}

// J League Soccer Dream Eleven → J.League Soccer - Dream Eleven
if (file_exists($imageDir . '/J League Soccer Dream Eleven (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/J.League Soccer - Dream Eleven-artwork.png')) {
        if (rename($imageDir . '/J League Soccer Dream Eleven (Japan)-artwork.png', $imageDir . '/J.League Soccer - Dream Eleven-artwork.png')) {
            echo "✓ J League Soccer Dream Eleven (Japan)-artwork.png → J.League Soccer - Dream Eleven-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: J League Soccer Dream Eleven (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: J.League Soccer - Dream Eleven-artwork.png\n";
        $skipped++;
    }
}

// J League Soccer Dream Eleven → J.League Soccer - Dream Eleven
if (file_exists($imageDir . '/J League Soccer Dream Eleven (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/J.League Soccer - Dream Eleven-cover.png')) {
        if (rename($imageDir . '/J League Soccer Dream Eleven (Japan)-cover.png', $imageDir . '/J.League Soccer - Dream Eleven-cover.png')) {
            echo "✓ J League Soccer Dream Eleven (Japan)-cover.png → J.League Soccer - Dream Eleven-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: J League Soccer Dream Eleven (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: J.League Soccer - Dream Eleven-cover.png\n";
        $skipped++;
    }
}

// J League Soccer Dream Eleven → J.League Soccer - Dream Eleven
if (file_exists($imageDir . '/J League Soccer Dream Eleven (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/J.League Soccer - Dream Eleven-gameplay.png')) {
        if (rename($imageDir . '/J League Soccer Dream Eleven (Japan)-gameplay.png', $imageDir . '/J.League Soccer - Dream Eleven-gameplay.png')) {
            echo "✓ J League Soccer Dream Eleven (Japan)-gameplay.png → J.League Soccer - Dream Eleven-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: J League Soccer Dream Eleven (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: J.League Soccer - Dream Eleven-gameplay.png\n";
        $skipped++;
    }
}

// Jeopardy → Jeopardy!
if (file_exists($imageDir . '/Jeopardy (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Jeopardy!-artwork.png')) {
        if (rename($imageDir . '/Jeopardy (USA)-artwork.png', $imageDir . '/Jeopardy!-artwork.png')) {
            echo "✓ Jeopardy (USA)-artwork.png → Jeopardy!-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Jeopardy (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Jeopardy!-artwork.png\n";
        $skipped++;
    }
}

// Jeopardy → Jeopardy!
if (file_exists($imageDir . '/Jeopardy (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Jeopardy!-cover.png')) {
        if (rename($imageDir . '/Jeopardy (USA)-cover.png', $imageDir . '/Jeopardy!-cover.png')) {
            echo "✓ Jeopardy (USA)-cover.png → Jeopardy!-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Jeopardy (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Jeopardy!-cover.png\n";
        $skipped++;
    }
}

// Jeopardy → Jeopardy!
if (file_exists($imageDir . '/Jeopardy (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Jeopardy!-gameplay.png')) {
        if (rename($imageDir . '/Jeopardy (USA)-gameplay.png', $imageDir . '/Jeopardy!-gameplay.png')) {
            echo "✓ Jeopardy (USA)-gameplay.png → Jeopardy!-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Jeopardy (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Jeopardy!-gameplay.png\n";
        $skipped++;
    }
}

// Jeopardy Sports Edition → Jeopardy! - Sports Edition
if (file_exists($imageDir . '/Jeopardy Sports Edition (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Jeopardy! - Sports Edition-artwork.png')) {
        if (rename($imageDir . '/Jeopardy Sports Edition (USA)-artwork.png', $imageDir . '/Jeopardy! - Sports Edition-artwork.png')) {
            echo "✓ Jeopardy Sports Edition (USA)-artwork.png → Jeopardy! - Sports Edition-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Jeopardy Sports Edition (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Jeopardy! - Sports Edition-artwork.png\n";
        $skipped++;
    }
}

// Jeopardy Sports Edition → Jeopardy! - Sports Edition
if (file_exists($imageDir . '/Jeopardy Sports Edition (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Jeopardy! - Sports Edition-cover.png')) {
        if (rename($imageDir . '/Jeopardy Sports Edition (USA)-cover.png', $imageDir . '/Jeopardy! - Sports Edition-cover.png')) {
            echo "✓ Jeopardy Sports Edition (USA)-cover.png → Jeopardy! - Sports Edition-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Jeopardy Sports Edition (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Jeopardy! - Sports Edition-cover.png\n";
        $skipped++;
    }
}

// Jeopardy Sports Edition → Jeopardy! - Sports Edition
if (file_exists($imageDir . '/Jeopardy Sports Edition (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Jeopardy! - Sports Edition-gameplay.png')) {
        if (rename($imageDir . '/Jeopardy Sports Edition (USA)-gameplay.png', $imageDir . '/Jeopardy! - Sports Edition-gameplay.png')) {
            echo "✓ Jeopardy Sports Edition (USA)-gameplay.png → Jeopardy! - Sports Edition-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Jeopardy Sports Edition (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Jeopardy! - Sports Edition-gameplay.png\n";
        $skipped++;
    }
}

// Krustys Fun House Usa → Krusty's Fun House
if (file_exists($imageDir . '/Krustys Fun House Usa (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Krusty\'s Fun House-artwork.png')) {
        if (rename($imageDir . '/Krustys Fun House Usa (Europe)-artwork.png', $imageDir . '/Krusty\'s Fun House-artwork.png')) {
            echo "✓ Krustys Fun House Usa (Europe)-artwork.png → Krusty\'s Fun House-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Krustys Fun House Usa (Europe)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Krusty\'s Fun House-artwork.png\n";
        $skipped++;
    }
}

// Krustys Fun House Usa → Krusty's Fun House
if (file_exists($imageDir . '/Krustys Fun House Usa (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Krusty\'s Fun House-cover.png')) {
        if (rename($imageDir . '/Krustys Fun House Usa (Europe)-cover.png', $imageDir . '/Krusty\'s Fun House-cover.png')) {
            echo "✓ Krustys Fun House Usa (Europe)-cover.png → Krusty\'s Fun House-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Krustys Fun House Usa (Europe)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Krusty\'s Fun House-cover.png\n";
        $skipped++;
    }
}

// Krustys Fun House Usa → Krusty's Fun House
if (file_exists($imageDir . '/Krustys Fun House Usa (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Krusty\'s Fun House-gameplay.png')) {
        if (rename($imageDir . '/Krustys Fun House Usa (Europe)-gameplay.png', $imageDir . '/Krusty\'s Fun House-gameplay.png')) {
            echo "✓ Krustys Fun House Usa (Europe)-gameplay.png → Krusty\'s Fun House-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Krustys Fun House Usa (Europe)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Krusty\'s Fun House-gameplay.png\n";
        $skipped++;
    }
}

// Madou Monogatari I 3tsu No Madoukyuu Compile Sega Japantr En Matts Messy Roomv1 0 → Madou Monogatari I - 3tsu no Madoukyuu (Compile - Sega) (Japan)[tr en Matt's Messy Room][v1.0]
if (file_exists($imageDir . '/Madou Monogatari I 3tsu No Madoukyuu Compile Sega Japantr En Matts Messy Roomv1 0-cover.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Compile - Sega) (Japan)[tr en Matt\'s Messy Room][v1.0]-cover.png')) {
        if (rename($imageDir . '/Madou Monogatari I 3tsu No Madoukyuu Compile Sega Japantr En Matts Messy Roomv1 0-cover.png', $imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Compile - Sega) (Japan)[tr en Matt\'s Messy Room][v1.0]-cover.png')) {
            echo "✓ Madou Monogatari I 3tsu No Madoukyuu Compile Sega Japantr En Matts Messy Roomv1 0-cover.png → Madou Monogatari I - 3tsu no Madoukyuu (Compile - Sega) (Japan)[tr en Matt\'s Messy Room][v1.0]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Madou Monogatari I 3tsu No Madoukyuu Compile Sega Japantr En Matts Messy Roomv1 0-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Madou Monogatari I - 3tsu no Madoukyuu (Compile - Sega) (Japan)[tr en Matt\'s Messy Room][v1.0]-cover.png\n";
        $skipped++;
    }
}

// Man Overboard → Man Overboard!
if (file_exists($imageDir . '/Man Overboard (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Man Overboard!-artwork.png')) {
        if (rename($imageDir . '/Man Overboard (Europe)-artwork.png', $imageDir . '/Man Overboard!-artwork.png')) {
            echo "✓ Man Overboard (Europe)-artwork.png → Man Overboard!-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Man Overboard (Europe)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Man Overboard!-artwork.png\n";
        $skipped++;
    }
}

// Man Overboard → Man Overboard!
if (file_exists($imageDir . '/Man Overboard (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Man Overboard!-cover.png')) {
        if (rename($imageDir . '/Man Overboard (Europe)-cover.png', $imageDir . '/Man Overboard!-cover.png')) {
            echo "✓ Man Overboard (Europe)-cover.png → Man Overboard!-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Man Overboard (Europe)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Man Overboard!-cover.png\n";
        $skipped++;
    }
}

// Man Overboard → Man Overboard!
if (file_exists($imageDir . '/Man Overboard (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Man Overboard!-gameplay.png')) {
        if (rename($imageDir . '/Man Overboard (Europe)-gameplay.png', $imageDir . '/Man Overboard!-gameplay.png')) {
            echo "✓ Man Overboard (Europe)-gameplay.png → Man Overboard!-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Man Overboard (Europe)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Man Overboard!-gameplay.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Castle Illusion (Japan) → Mickey Mouse no Castle Illusion
if (file_exists($imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Castle Illusion-artwork.png')) {
        if (rename($imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-artwork.png', $imageDir . '/Mickey Mouse no Castle Illusion-artwork.png')) {
            echo "✓ Mickey Mouse no Castle Illusion (Japan) (En)-artwork.png → Mickey Mouse no Castle Illusion-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Mickey Mouse no Castle Illusion (Japan) (En)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Mickey Mouse no Castle Illusion-artwork.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Castle Illusion (Japan) → Mickey Mouse no Castle Illusion
if (file_exists($imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Castle Illusion-cover.png')) {
        if (rename($imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-cover.png', $imageDir . '/Mickey Mouse no Castle Illusion-cover.png')) {
            echo "✓ Mickey Mouse no Castle Illusion (Japan) (En)-cover.png → Mickey Mouse no Castle Illusion-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Mickey Mouse no Castle Illusion (Japan) (En)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Mickey Mouse no Castle Illusion-cover.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Castle Illusion (Japan) → Mickey Mouse no Castle Illusion
if (file_exists($imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Castle Illusion-gameplay.png')) {
        if (rename($imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-gameplay.png', $imageDir . '/Mickey Mouse no Castle Illusion-gameplay.png')) {
            echo "✓ Mickey Mouse no Castle Illusion (Japan) (En)-gameplay.png → Mickey Mouse no Castle Illusion-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Mickey Mouse no Castle Illusion (Japan) (En)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Mickey Mouse no Castle Illusion-gameplay.png\n";
        $skipped++;
    }
}

// Mickeys Ultimate Challenge → Mickey's Ultimate Challenge
if (file_exists($imageDir . '/Mickeys Ultimate Challenge (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Mickey\'s Ultimate Challenge-artwork.png')) {
        if (rename($imageDir . '/Mickeys Ultimate Challenge (USA)-artwork.png', $imageDir . '/Mickey\'s Ultimate Challenge-artwork.png')) {
            echo "✓ Mickeys Ultimate Challenge (USA)-artwork.png → Mickey\'s Ultimate Challenge-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Mickeys Ultimate Challenge (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Mickey\'s Ultimate Challenge-artwork.png\n";
        $skipped++;
    }
}

// Mickeys Ultimate Challenge → Mickey's Ultimate Challenge
if (file_exists($imageDir . '/Mickeys Ultimate Challenge (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Mickey\'s Ultimate Challenge-cover.png')) {
        if (rename($imageDir . '/Mickeys Ultimate Challenge (USA)-cover.png', $imageDir . '/Mickey\'s Ultimate Challenge-cover.png')) {
            echo "✓ Mickeys Ultimate Challenge (USA)-cover.png → Mickey\'s Ultimate Challenge-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Mickeys Ultimate Challenge (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Mickey\'s Ultimate Challenge-cover.png\n";
        $skipped++;
    }
}

// Mickeys Ultimate Challenge → Mickey's Ultimate Challenge
if (file_exists($imageDir . '/Mickeys Ultimate Challenge (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mickey\'s Ultimate Challenge-gameplay.png')) {
        if (rename($imageDir . '/Mickeys Ultimate Challenge (USA)-gameplay.png', $imageDir . '/Mickey\'s Ultimate Challenge-gameplay.png')) {
            echo "✓ Mickeys Ultimate Challenge (USA)-gameplay.png → Mickey\'s Ultimate Challenge-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Mickeys Ultimate Challenge (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Mickey\'s Ultimate Challenge-gameplay.png\n";
        $skipped++;
    }
}

// Mortal Kombat - Shinken Kourin Densetsu (Japan) → Mortal Kombat - Shinken Kourin Densetsu
if (file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-artwork.png')) {
        if (rename($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-artwork.png', $imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-artwork.png')) {
            echo "✓ Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-artwork.png → Mortal Kombat - Shinken Kourin Densetsu-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Mortal Kombat - Shinken Kourin Densetsu-artwork.png\n";
        $skipped++;
    }
}

// Mortal Kombat - Shinken Kourin Densetsu (Japan) → Mortal Kombat - Shinken Kourin Densetsu
if (file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-cover.png')) {
        if (rename($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-cover.png', $imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-cover.png')) {
            echo "✓ Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-cover.png → Mortal Kombat - Shinken Kourin Densetsu-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Mortal Kombat - Shinken Kourin Densetsu-cover.png\n";
        $skipped++;
    }
}

// Mortal Kombat - Shinken Kourin Densetsu (Japan) → Mortal Kombat - Shinken Kourin Densetsu
if (file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-gameplay.png')) {
        if (rename($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-gameplay.png', $imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-gameplay.png')) {
            echo "✓ Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-gameplay.png → Mortal Kombat - Shinken Kourin Densetsu-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Mortal Kombat - Shinken Kourin Densetsu-gameplay.png\n";
        $skipped++;
    }
}

// Ms Pac Man → Ms. Pac-Man
if (file_exists($imageDir . '/Ms Pac Man (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Ms. Pac-Man-artwork.png')) {
        if (rename($imageDir . '/Ms Pac Man (USA)-artwork.png', $imageDir . '/Ms. Pac-Man-artwork.png')) {
            echo "✓ Ms Pac Man (USA)-artwork.png → Ms. Pac-Man-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Ms Pac Man (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Ms. Pac-Man-artwork.png\n";
        $skipped++;
    }
}

// Ms Pac Man → Ms. Pac-Man
if (file_exists($imageDir . '/Ms Pac Man (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Ms. Pac-Man-cover.png')) {
        if (rename($imageDir . '/Ms Pac Man (USA)-cover.png', $imageDir . '/Ms. Pac-Man-cover.png')) {
            echo "✓ Ms Pac Man (USA)-cover.png → Ms. Pac-Man-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Ms Pac Man (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Ms. Pac-Man-cover.png\n";
        $skipped++;
    }
}

// Ms Pac Man → Ms. Pac-Man
if (file_exists($imageDir . '/Ms Pac Man (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ms. Pac-Man-gameplay.png')) {
        if (rename($imageDir . '/Ms Pac Man (USA)-gameplay.png', $imageDir . '/Ms. Pac-Man-gameplay.png')) {
            echo "✓ Ms Pac Man (USA)-gameplay.png → Ms. Pac-Man-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Ms Pac Man (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Ms. Pac-Man-gameplay.png\n";
        $skipped++;
    }
}

// Neko Daisuki → Neko Daisuki!
if (file_exists($imageDir . '/Neko Daisuki (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Neko Daisuki!-artwork.png')) {
        if (rename($imageDir . '/Neko Daisuki (Japan)-artwork.png', $imageDir . '/Neko Daisuki!-artwork.png')) {
            echo "✓ Neko Daisuki (Japan)-artwork.png → Neko Daisuki!-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Neko Daisuki (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Neko Daisuki!-artwork.png\n";
        $skipped++;
    }
}

// Neko Daisuki → Neko Daisuki!
if (file_exists($imageDir . '/Neko Daisuki (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Neko Daisuki!-cover.png')) {
        if (rename($imageDir . '/Neko Daisuki (Japan)-cover.png', $imageDir . '/Neko Daisuki!-cover.png')) {
            echo "✓ Neko Daisuki (Japan)-cover.png → Neko Daisuki!-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Neko Daisuki (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Neko Daisuki!-cover.png\n";
        $skipped++;
    }
}

// Neko Daisuki → Neko Daisuki!
if (file_exists($imageDir . '/Neko Daisuki (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Neko Daisuki!-gameplay.png')) {
        if (rename($imageDir . '/Neko Daisuki (Japan)-gameplay.png', $imageDir . '/Neko Daisuki!-gameplay.png')) {
            echo "✓ Neko Daisuki (Japan)-gameplay.png → Neko Daisuki!-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Neko Daisuki (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Neko Daisuki!-gameplay.png\n";
        $skipped++;
    }
}

// Nfl 95 → NFL '95
if (file_exists($imageDir . '/Nfl 95 (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/NFL \'95-artwork.png')) {
        if (rename($imageDir . '/Nfl 95 (USA)-artwork.png', $imageDir . '/NFL \'95-artwork.png')) {
            echo "✓ Nfl 95 (USA)-artwork.png → NFL \'95-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Nfl 95 (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: NFL \'95-artwork.png\n";
        $skipped++;
    }
}

// Nfl 95 → NFL '95
if (file_exists($imageDir . '/Nfl 95 (USA)-cover.png')) {
    if (!file_exists($imageDir . '/NFL \'95-cover.png')) {
        if (rename($imageDir . '/Nfl 95 (USA)-cover.png', $imageDir . '/NFL \'95-cover.png')) {
            echo "✓ Nfl 95 (USA)-cover.png → NFL \'95-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Nfl 95 (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: NFL \'95-cover.png\n";
        $skipped++;
    }
}

// Nfl 95 → NFL '95
if (file_exists($imageDir . '/Nfl 95 (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/NFL \'95-gameplay.png')) {
        if (rename($imageDir . '/Nfl 95 (USA)-gameplay.png', $imageDir . '/NFL \'95-gameplay.png')) {
            echo "✓ Nfl 95 (USA)-gameplay.png → NFL \'95-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Nfl 95 (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: NFL \'95-gameplay.png\n";
        $skipped++;
    }
}

// Pet Club Inu Daisuki → Pet Club - Inu Daisuki!
if (file_exists($imageDir . '/Pet Club Inu Daisuki (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Pet Club - Inu Daisuki!-artwork.png')) {
        if (rename($imageDir . '/Pet Club Inu Daisuki (Japan)-artwork.png', $imageDir . '/Pet Club - Inu Daisuki!-artwork.png')) {
            echo "✓ Pet Club Inu Daisuki (Japan)-artwork.png → Pet Club - Inu Daisuki!-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Pet Club Inu Daisuki (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Pet Club - Inu Daisuki!-artwork.png\n";
        $skipped++;
    }
}

// Pet Club Inu Daisuki → Pet Club - Inu Daisuki!
if (file_exists($imageDir . '/Pet Club Inu Daisuki (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Pet Club - Inu Daisuki!-cover.png')) {
        if (rename($imageDir . '/Pet Club Inu Daisuki (Japan)-cover.png', $imageDir . '/Pet Club - Inu Daisuki!-cover.png')) {
            echo "✓ Pet Club Inu Daisuki (Japan)-cover.png → Pet Club - Inu Daisuki!-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Pet Club Inu Daisuki (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Pet Club - Inu Daisuki!-cover.png\n";
        $skipped++;
    }
}

// Pet Club Inu Daisuki → Pet Club - Inu Daisuki!
if (file_exists($imageDir . '/Pet Club Inu Daisuki (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Pet Club - Inu Daisuki!-gameplay.png')) {
        if (rename($imageDir . '/Pet Club Inu Daisuki (Japan)-gameplay.png', $imageDir . '/Pet Club - Inu Daisuki!-gameplay.png')) {
            echo "✓ Pet Club Inu Daisuki (Japan)-gameplay.png → Pet Club - Inu Daisuki!-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Pet Club Inu Daisuki (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Pet Club - Inu Daisuki!-gameplay.png\n";
        $skipped++;
    }
}

// Phantasy Star Adventure (Japan)[tr en] → Phantasy Star Adventure (Japan)[tr en AGTP][v1.00]
if (file_exists($imageDir . '/Phantasy Star Adventure (Japan)[tr en]-cover.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Adventure (Japan)[tr en AGTP][v1.00]-cover.png')) {
        if (rename($imageDir . '/Phantasy Star Adventure (Japan)[tr en]-cover.png', $imageDir . '/Phantasy Star Adventure (Japan)[tr en AGTP][v1.00]-cover.png')) {
            echo "✓ Phantasy Star Adventure (Japan)[tr en]-cover.png → Phantasy Star Adventure (Japan)[tr en AGTP][v1.00]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Phantasy Star Adventure (Japan)[tr en]-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Phantasy Star Adventure (Japan)[tr en AGTP][v1.00]-cover.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Blackjack → Poker Face Paul's Blackjack
if (file_exists($imageDir . '/Poker Face Pauls Blackjack (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Blackjack-artwork.png')) {
        if (rename($imageDir . '/Poker Face Pauls Blackjack (USA)-artwork.png', $imageDir . '/Poker Face Paul\'s Blackjack-artwork.png')) {
            echo "✓ Poker Face Pauls Blackjack (USA)-artwork.png → Poker Face Paul\'s Blackjack-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Blackjack (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Blackjack-artwork.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Blackjack → Poker Face Paul's Blackjack
if (file_exists($imageDir . '/Poker Face Pauls Blackjack (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Blackjack-cover.png')) {
        if (rename($imageDir . '/Poker Face Pauls Blackjack (USA)-cover.png', $imageDir . '/Poker Face Paul\'s Blackjack-cover.png')) {
            echo "✓ Poker Face Pauls Blackjack (USA)-cover.png → Poker Face Paul\'s Blackjack-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Blackjack (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Blackjack-cover.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Blackjack → Poker Face Paul's Blackjack
if (file_exists($imageDir . '/Poker Face Pauls Blackjack (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Blackjack-gameplay.png')) {
        if (rename($imageDir . '/Poker Face Pauls Blackjack (USA)-gameplay.png', $imageDir . '/Poker Face Paul\'s Blackjack-gameplay.png')) {
            echo "✓ Poker Face Pauls Blackjack (USA)-gameplay.png → Poker Face Paul\'s Blackjack-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Blackjack (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Blackjack-gameplay.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Gin → Poker Face Paul's Gin
if (file_exists($imageDir . '/Poker Face Pauls Gin (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Gin-artwork.png')) {
        if (rename($imageDir . '/Poker Face Pauls Gin (USA)-artwork.png', $imageDir . '/Poker Face Paul\'s Gin-artwork.png')) {
            echo "✓ Poker Face Pauls Gin (USA)-artwork.png → Poker Face Paul\'s Gin-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Gin (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Gin-artwork.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Gin → Poker Face Paul's Gin
if (file_exists($imageDir . '/Poker Face Pauls Gin (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Gin-cover.png')) {
        if (rename($imageDir . '/Poker Face Pauls Gin (USA)-cover.png', $imageDir . '/Poker Face Paul\'s Gin-cover.png')) {
            echo "✓ Poker Face Pauls Gin (USA)-cover.png → Poker Face Paul\'s Gin-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Gin (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Gin-cover.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Gin → Poker Face Paul's Gin
if (file_exists($imageDir . '/Poker Face Pauls Gin (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Gin-gameplay.png')) {
        if (rename($imageDir . '/Poker Face Pauls Gin (USA)-gameplay.png', $imageDir . '/Poker Face Paul\'s Gin-gameplay.png')) {
            echo "✓ Poker Face Pauls Gin (USA)-gameplay.png → Poker Face Paul\'s Gin-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Gin (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Gin-gameplay.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Poker → Poker Face Paul's Poker
if (file_exists($imageDir . '/Poker Face Pauls Poker (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Poker-artwork.png')) {
        if (rename($imageDir . '/Poker Face Pauls Poker (USA)-artwork.png', $imageDir . '/Poker Face Paul\'s Poker-artwork.png')) {
            echo "✓ Poker Face Pauls Poker (USA)-artwork.png → Poker Face Paul\'s Poker-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Poker (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Poker-artwork.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Poker → Poker Face Paul's Poker
if (file_exists($imageDir . '/Poker Face Pauls Poker (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Poker-cover.png')) {
        if (rename($imageDir . '/Poker Face Pauls Poker (USA)-cover.png', $imageDir . '/Poker Face Paul\'s Poker-cover.png')) {
            echo "✓ Poker Face Pauls Poker (USA)-cover.png → Poker Face Paul\'s Poker-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Poker (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Poker-cover.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Poker → Poker Face Paul's Poker
if (file_exists($imageDir . '/Poker Face Pauls Poker (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Poker-gameplay.png')) {
        if (rename($imageDir . '/Poker Face Pauls Poker (USA)-gameplay.png', $imageDir . '/Poker Face Paul\'s Poker-gameplay.png')) {
            echo "✓ Poker Face Pauls Poker (USA)-gameplay.png → Poker Face Paul\'s Poker-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Poker (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Poker-gameplay.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Solitaire → Poker Face Paul's Solitaire
if (file_exists($imageDir . '/Poker Face Pauls Solitaire (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Solitaire-artwork.png')) {
        if (rename($imageDir . '/Poker Face Pauls Solitaire (USA)-artwork.png', $imageDir . '/Poker Face Paul\'s Solitaire-artwork.png')) {
            echo "✓ Poker Face Pauls Solitaire (USA)-artwork.png → Poker Face Paul\'s Solitaire-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Solitaire (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Solitaire-artwork.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Solitaire → Poker Face Paul's Solitaire
if (file_exists($imageDir . '/Poker Face Pauls Solitaire (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Solitaire-cover.png')) {
        if (rename($imageDir . '/Poker Face Pauls Solitaire (USA)-cover.png', $imageDir . '/Poker Face Paul\'s Solitaire-cover.png')) {
            echo "✓ Poker Face Pauls Solitaire (USA)-cover.png → Poker Face Paul\'s Solitaire-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Solitaire (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Solitaire-cover.png\n";
        $skipped++;
    }
}

// Poker Face Pauls Solitaire → Poker Face Paul's Solitaire
if (file_exists($imageDir . '/Poker Face Pauls Solitaire (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Solitaire-gameplay.png')) {
        if (rename($imageDir . '/Poker Face Pauls Solitaire (USA)-gameplay.png', $imageDir . '/Poker Face Paul\'s Solitaire-gameplay.png')) {
            echo "✓ Poker Face Pauls Solitaire (USA)-gameplay.png → Poker Face Paul\'s Solitaire-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Poker Face Pauls Solitaire (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Poker Face Paul\'s Solitaire-gameplay.png\n";
        $skipped++;
    }
}

// Pro Yakyuu 91 the → Pro Yakyuu '91, The
if (file_exists($imageDir . '/Pro Yakyuu 91 the (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu \'91, The-artwork.png')) {
        if (rename($imageDir . '/Pro Yakyuu 91 the (Japan)-artwork.png', $imageDir . '/Pro Yakyuu \'91, The-artwork.png')) {
            echo "✓ Pro Yakyuu 91 the (Japan)-artwork.png → Pro Yakyuu \'91, The-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Pro Yakyuu 91 the (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Pro Yakyuu \'91, The-artwork.png\n";
        $skipped++;
    }
}

// Pro Yakyuu 91 the → Pro Yakyuu '91, The
if (file_exists($imageDir . '/Pro Yakyuu 91 the (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu \'91, The-cover.png')) {
        if (rename($imageDir . '/Pro Yakyuu 91 the (Japan)-cover.png', $imageDir . '/Pro Yakyuu \'91, The-cover.png')) {
            echo "✓ Pro Yakyuu 91 the (Japan)-cover.png → Pro Yakyuu \'91, The-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Pro Yakyuu 91 the (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Pro Yakyuu \'91, The-cover.png\n";
        $skipped++;
    }
}

// Pro Yakyuu 91 the → Pro Yakyuu '91, The
if (file_exists($imageDir . '/Pro Yakyuu 91 the (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu \'91, The-gameplay.png')) {
        if (rename($imageDir . '/Pro Yakyuu 91 the (Japan)-gameplay.png', $imageDir . '/Pro Yakyuu \'91, The-gameplay.png')) {
            echo "✓ Pro Yakyuu 91 the (Japan)-gameplay.png → Pro Yakyuu \'91, The-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Pro Yakyuu 91 the (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Pro Yakyuu \'91, The-gameplay.png\n";
        $skipped++;
    }
}

// Pro Yakyuu Gg League 94 → Pro Yakyuu GG League '94
if (file_exists($imageDir . '/Pro Yakyuu Gg League 94 (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League \'94-artwork.png')) {
        if (rename($imageDir . '/Pro Yakyuu Gg League 94 (Japan)-artwork.png', $imageDir . '/Pro Yakyuu GG League \'94-artwork.png')) {
            echo "✓ Pro Yakyuu Gg League 94 (Japan)-artwork.png → Pro Yakyuu GG League \'94-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Pro Yakyuu Gg League 94 (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Pro Yakyuu GG League \'94-artwork.png\n";
        $skipped++;
    }
}

// Pro Yakyuu Gg League 94 → Pro Yakyuu GG League '94
if (file_exists($imageDir . '/Pro Yakyuu Gg League 94 (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League \'94-cover.png')) {
        if (rename($imageDir . '/Pro Yakyuu Gg League 94 (Japan)-cover.png', $imageDir . '/Pro Yakyuu GG League \'94-cover.png')) {
            echo "✓ Pro Yakyuu Gg League 94 (Japan)-cover.png → Pro Yakyuu GG League \'94-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Pro Yakyuu Gg League 94 (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Pro Yakyuu GG League \'94-cover.png\n";
        $skipped++;
    }
}

// Pro Yakyuu Gg League 94 → Pro Yakyuu GG League '94
if (file_exists($imageDir . '/Pro Yakyuu Gg League 94 (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League \'94-gameplay.png')) {
        if (rename($imageDir . '/Pro Yakyuu Gg League 94 (Japan)-gameplay.png', $imageDir . '/Pro Yakyuu GG League \'94-gameplay.png')) {
            echo "✓ Pro Yakyuu Gg League 94 (Japan)-gameplay.png → Pro Yakyuu GG League \'94-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Pro Yakyuu Gg League 94 (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Pro Yakyuu GG League \'94-gameplay.png\n";
        $skipped++;
    }
}

// Quiz Gear Fight the → Quiz Gear Fight!!, The
if (file_exists($imageDir . '/Quiz Gear Fight the (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Quiz Gear Fight!!, The-artwork.png')) {
        if (rename($imageDir . '/Quiz Gear Fight the (Japan)-artwork.png', $imageDir . '/Quiz Gear Fight!!, The-artwork.png')) {
            echo "✓ Quiz Gear Fight the (Japan)-artwork.png → Quiz Gear Fight!!, The-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Quiz Gear Fight the (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Quiz Gear Fight!!, The-artwork.png\n";
        $skipped++;
    }
}

// Quiz Gear Fight the → Quiz Gear Fight!!, The
if (file_exists($imageDir . '/Quiz Gear Fight the (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Quiz Gear Fight!!, The-cover.png')) {
        if (rename($imageDir . '/Quiz Gear Fight the (Japan)-cover.png', $imageDir . '/Quiz Gear Fight!!, The-cover.png')) {
            echo "✓ Quiz Gear Fight the (Japan)-cover.png → Quiz Gear Fight!!, The-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Quiz Gear Fight the (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Quiz Gear Fight!!, The-cover.png\n";
        $skipped++;
    }
}

// Quiz Gear Fight the → Quiz Gear Fight!!, The
if (file_exists($imageDir . '/Quiz Gear Fight the (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Quiz Gear Fight!!, The-gameplay.png')) {
        if (rename($imageDir . '/Quiz Gear Fight the (Japan)-gameplay.png', $imageDir . '/Quiz Gear Fight!!, The-gameplay.png')) {
            echo "✓ Quiz Gear Fight the (Japan)-gameplay.png → Quiz Gear Fight!!, The-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Quiz Gear Fight the (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Quiz Gear Fight!!, The-gameplay.png\n";
        $skipped++;
    }
}

// R C Grand Prix → R.C. Grand Prix
if (file_exists($imageDir . '/R C Grand Prix (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/R.C. Grand Prix-artwork.png')) {
        if (rename($imageDir . '/R C Grand Prix (USA)-artwork.png', $imageDir . '/R.C. Grand Prix-artwork.png')) {
            echo "✓ R C Grand Prix (USA)-artwork.png → R.C. Grand Prix-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: R C Grand Prix (USA)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: R.C. Grand Prix-artwork.png\n";
        $skipped++;
    }
}

// R C Grand Prix → R.C. Grand Prix
if (file_exists($imageDir . '/R C Grand Prix (USA)-cover.png')) {
    if (!file_exists($imageDir . '/R.C. Grand Prix-cover.png')) {
        if (rename($imageDir . '/R C Grand Prix (USA)-cover.png', $imageDir . '/R.C. Grand Prix-cover.png')) {
            echo "✓ R C Grand Prix (USA)-cover.png → R.C. Grand Prix-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: R C Grand Prix (USA)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: R.C. Grand Prix-cover.png\n";
        $skipped++;
    }
}

// R C Grand Prix → R.C. Grand Prix
if (file_exists($imageDir . '/R C Grand Prix (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/R.C. Grand Prix-gameplay.png')) {
        if (rename($imageDir . '/R C Grand Prix (USA)-gameplay.png', $imageDir . '/R.C. Grand Prix-gameplay.png')) {
            echo "✓ R C Grand Prix (USA)-gameplay.png → R.C. Grand Prix-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: R C Grand Prix (USA)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: R.C. Grand Prix-gameplay.png\n";
        $skipped++;
    }
}

// Sassou Shounen Eiyuuden Coca Cola Kid Japantr En Sms Powerv1 00 → Sassou Shounen Eiyuuden Coca-Cola Kid (Japan)[tr en SMS Power][v1.00]
if (file_exists($imageDir . '/Sassou Shounen Eiyuuden Coca Cola Kid Japantr En Sms Powerv1 00-cover.png')) {
    if (!file_exists($imageDir . '/Sassou Shounen Eiyuuden Coca-Cola Kid (Japan)[tr en SMS Power][v1.00]-cover.png')) {
        if (rename($imageDir . '/Sassou Shounen Eiyuuden Coca Cola Kid Japantr En Sms Powerv1 00-cover.png', $imageDir . '/Sassou Shounen Eiyuuden Coca-Cola Kid (Japan)[tr en SMS Power][v1.00]-cover.png')) {
            echo "✓ Sassou Shounen Eiyuuden Coca Cola Kid Japantr En Sms Powerv1 00-cover.png → Sassou Shounen Eiyuuden Coca-Cola Kid (Japan)[tr en SMS Power][v1.00]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sassou Shounen Eiyuuden Coca Cola Kid Japantr En Sms Powerv1 00-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sassou Shounen Eiyuuden Coca-Cola Kid (Japan)[tr en SMS Power][v1.00]-cover.png\n";
        $skipped++;
    }
}

// Sd Gundam Winners History → SD Gundam - Winner's History
if (file_exists($imageDir . '/Sd Gundam Winners History (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/SD Gundam - Winner\'s History-artwork.png')) {
        if (rename($imageDir . '/Sd Gundam Winners History (Japan)-artwork.png', $imageDir . '/SD Gundam - Winner\'s History-artwork.png')) {
            echo "✓ Sd Gundam Winners History (Japan)-artwork.png → SD Gundam - Winner\'s History-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sd Gundam Winners History (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: SD Gundam - Winner\'s History-artwork.png\n";
        $skipped++;
    }
}

// Sd Gundam Winners History → SD Gundam - Winner's History
if (file_exists($imageDir . '/Sd Gundam Winners History (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/SD Gundam - Winner\'s History-cover.png')) {
        if (rename($imageDir . '/Sd Gundam Winners History (Japan)-cover.png', $imageDir . '/SD Gundam - Winner\'s History-cover.png')) {
            echo "✓ Sd Gundam Winners History (Japan)-cover.png → SD Gundam - Winner\'s History-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sd Gundam Winners History (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: SD Gundam - Winner\'s History-cover.png\n";
        $skipped++;
    }
}

// Sd Gundam Winners History → SD Gundam - Winner's History
if (file_exists($imageDir . '/Sd Gundam Winners History (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/SD Gundam - Winner\'s History-gameplay.png')) {
        if (rename($imageDir . '/Sd Gundam Winners History (Japan)-gameplay.png', $imageDir . '/SD Gundam - Winner\'s History-gameplay.png')) {
            echo "✓ Sd Gundam Winners History (Japan)-gameplay.png → SD Gundam - Winner\'s History-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sd Gundam Winners History (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: SD Gundam - Winner\'s History-gameplay.png\n";
        $skipped++;
    }
}

// Sd Gundam Winners History Japan T En By Gaijin Productions → SD Gundam - Winner's History (Japan) [T-En by Gaijin Productions]
if (file_exists($imageDir . '/Sd Gundam Winners History Japan T En By Gaijin Productions-artwork.png')) {
    if (!file_exists($imageDir . '/SD Gundam - Winner\'s History (Japan) [T-En by Gaijin Productions]-artwork.png')) {
        if (rename($imageDir . '/Sd Gundam Winners History Japan T En By Gaijin Productions-artwork.png', $imageDir . '/SD Gundam - Winner\'s History (Japan) [T-En by Gaijin Productions]-artwork.png')) {
            echo "✓ Sd Gundam Winners History Japan T En By Gaijin Productions-artwork.png → SD Gundam - Winner\'s History (Japan) [T-En by Gaijin Productions]-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sd Gundam Winners History Japan T En By Gaijin Productions-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: SD Gundam - Winner\'s History (Japan) [T-En by Gaijin Productions]-artwork.png\n";
        $skipped++;
    }
}

// Sd Gundam Winners History Japan T En By Gaijin Productions → SD Gundam - Winner's History (Japan) [T-En by Gaijin Productions]
if (file_exists($imageDir . '/Sd Gundam Winners History Japan T En By Gaijin Productions-cover.png')) {
    if (!file_exists($imageDir . '/SD Gundam - Winner\'s History (Japan) [T-En by Gaijin Productions]-cover.png')) {
        if (rename($imageDir . '/Sd Gundam Winners History Japan T En By Gaijin Productions-cover.png', $imageDir . '/SD Gundam - Winner\'s History (Japan) [T-En by Gaijin Productions]-cover.png')) {
            echo "✓ Sd Gundam Winners History Japan T En By Gaijin Productions-cover.png → SD Gundam - Winner\'s History (Japan) [T-En by Gaijin Productions]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sd Gundam Winners History Japan T En By Gaijin Productions-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: SD Gundam - Winner\'s History (Japan) [T-En by Gaijin Productions]-cover.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Final Conflict (Japan) → Shining Force Gaiden - Final Conflict
if (file_exists($imageDir . '/Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-artwork.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Final Conflict-artwork.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-artwork.png', $imageDir . '/Shining Force Gaiden - Final Conflict-artwork.png')) {
            echo "✓ Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-artwork.png → Shining Force Gaiden - Final Conflict-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Shining Force Gaiden - Final Conflict-artwork.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Final Conflict (Japan) → Shining Force Gaiden - Final Conflict
if (file_exists($imageDir . '/Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-cover.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Final Conflict-cover.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-cover.png', $imageDir . '/Shining Force Gaiden - Final Conflict-cover.png')) {
            echo "✓ Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-cover.png → Shining Force Gaiden - Final Conflict-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Shining Force Gaiden - Final Conflict-cover.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Final Conflict (Japan) → Shining Force Gaiden - Final Conflict
if (file_exists($imageDir . '/Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-gameplay.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Final Conflict-gameplay.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-gameplay.png', $imageDir . '/Shining Force Gaiden - Final Conflict-gameplay.png')) {
            echo "✓ Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-gameplay.png → Shining Force Gaiden - Final Conflict-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Shining Force Gaiden - Final Conflict (Japan) (Virtual Console)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Shining Force Gaiden - Final Conflict-gameplay.png\n";
        $skipped++;
    }
}

// Simpsons the Bart Vs the Space Mutants Usa → Simpsons, The - Bart vs. the Space Mutants
if (file_exists($imageDir . '/Simpsons the Bart Vs the Space Mutants Usa (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the Space Mutants-artwork.png')) {
        if (rename($imageDir . '/Simpsons the Bart Vs the Space Mutants Usa (Europe)-artwork.png', $imageDir . '/Simpsons, The - Bart vs. the Space Mutants-artwork.png')) {
            echo "✓ Simpsons the Bart Vs the Space Mutants Usa (Europe)-artwork.png → Simpsons, The - Bart vs. the Space Mutants-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Simpsons the Bart Vs the Space Mutants Usa (Europe)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Simpsons, The - Bart vs. the Space Mutants-artwork.png\n";
        $skipped++;
    }
}

// Simpsons the Bart Vs the Space Mutants Usa → Simpsons, The - Bart vs. the Space Mutants
if (file_exists($imageDir . '/Simpsons the Bart Vs the Space Mutants Usa (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the Space Mutants-cover.png')) {
        if (rename($imageDir . '/Simpsons the Bart Vs the Space Mutants Usa (Europe)-cover.png', $imageDir . '/Simpsons, The - Bart vs. the Space Mutants-cover.png')) {
            echo "✓ Simpsons the Bart Vs the Space Mutants Usa (Europe)-cover.png → Simpsons, The - Bart vs. the Space Mutants-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Simpsons the Bart Vs the Space Mutants Usa (Europe)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Simpsons, The - Bart vs. the Space Mutants-cover.png\n";
        $skipped++;
    }
}

// Simpsons the Bart Vs the Space Mutants Usa → Simpsons, The - Bart vs. the Space Mutants
if (file_exists($imageDir . '/Simpsons the Bart Vs the Space Mutants Usa (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the Space Mutants-gameplay.png')) {
        if (rename($imageDir . '/Simpsons the Bart Vs the Space Mutants Usa (Europe)-gameplay.png', $imageDir . '/Simpsons, The - Bart vs. the Space Mutants-gameplay.png')) {
            echo "✓ Simpsons the Bart Vs the Space Mutants Usa (Europe)-gameplay.png → Simpsons, The - Bart vs. the Space Mutants-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Simpsons the Bart Vs the Space Mutants Usa (Europe)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Simpsons, The - Bart vs. the Space Mutants-gameplay.png\n";
        $skipped++;
    }
}

// Simpsons the Bart Vs the World → Simpsons, The - Bart vs. the World
if (file_exists($imageDir . '/Simpsons the Bart Vs the World (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the World-artwork.png')) {
        if (rename($imageDir . '/Simpsons the Bart Vs the World (World)-artwork.png', $imageDir . '/Simpsons, The - Bart vs. the World-artwork.png')) {
            echo "✓ Simpsons the Bart Vs the World (World)-artwork.png → Simpsons, The - Bart vs. the World-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Simpsons the Bart Vs the World (World)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Simpsons, The - Bart vs. the World-artwork.png\n";
        $skipped++;
    }
}

// Simpsons the Bart Vs the World → Simpsons, The - Bart vs. the World
if (file_exists($imageDir . '/Simpsons the Bart Vs the World (World)-cover.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the World-cover.png')) {
        if (rename($imageDir . '/Simpsons the Bart Vs the World (World)-cover.png', $imageDir . '/Simpsons, The - Bart vs. the World-cover.png')) {
            echo "✓ Simpsons the Bart Vs the World (World)-cover.png → Simpsons, The - Bart vs. the World-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Simpsons the Bart Vs the World (World)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Simpsons, The - Bart vs. the World-cover.png\n";
        $skipped++;
    }
}

// Simpsons the Bart Vs the World → Simpsons, The - Bart vs. the World
if (file_exists($imageDir . '/Simpsons the Bart Vs the World (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the World-gameplay.png')) {
        if (rename($imageDir . '/Simpsons the Bart Vs the World (World)-gameplay.png', $imageDir . '/Simpsons, The - Bart vs. the World-gameplay.png')) {
            echo "✓ Simpsons the Bart Vs the World (World)-gameplay.png → Simpsons, The - Bart vs. the World-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Simpsons the Bart Vs the World (World)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Simpsons, The - Bart vs. the World-gameplay.png\n";
        $skipped++;
    }
}

// Sonic Drift (Japan) → Sonic Drift 2 (Japan)[b2]
if (file_exists($imageDir . '/Sonic Drift (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic Drift 2 (Japan)[b2]-artwork.png')) {
        if (rename($imageDir . '/Sonic Drift (Japan) (En)-artwork.png', $imageDir . '/Sonic Drift 2 (Japan)[b2]-artwork.png')) {
            echo "✓ Sonic Drift (Japan) (En)-artwork.png → Sonic Drift 2 (Japan)[b2]-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic Drift (Japan) (En)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic Drift 2 (Japan)[b2]-artwork.png\n";
        $skipped++;
    }
}

// Sonic Drift (Japan) → Sonic Drift 2 (Japan)[b2]
if (file_exists($imageDir . '/Sonic Drift (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic Drift 2 (Japan)[b2]-cover.png')) {
        if (rename($imageDir . '/Sonic Drift (Japan) (En)-cover.png', $imageDir . '/Sonic Drift 2 (Japan)[b2]-cover.png')) {
            echo "✓ Sonic Drift (Japan) (En)-cover.png → Sonic Drift 2 (Japan)[b2]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic Drift (Japan) (En)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic Drift 2 (Japan)[b2]-cover.png\n";
        $skipped++;
    }
}

// Sonic Drift (Japan) → Sonic Drift 2 (Japan)[b2]
if (file_exists($imageDir . '/Sonic Drift (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic Drift 2 (Japan)[b2]-gameplay.png')) {
        if (rename($imageDir . '/Sonic Drift (Japan) (En)-gameplay.png', $imageDir . '/Sonic Drift 2 (Japan)[b2]-gameplay.png')) {
            echo "✓ Sonic Drift (Japan) (En)-gameplay.png → Sonic Drift 2 (Japan)[b2]-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic Drift (Japan) (En)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic Drift 2 (Japan)[b2]-gameplay.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog 2 (USA) → Sonic The Hedgehog 2
if (file_exists($imageDir . '/Sonic The Hedgehog 2 (USA) (Auto Demo)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2-artwork.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog 2 (USA) (Auto Demo)-artwork.png', $imageDir . '/Sonic The Hedgehog 2-artwork.png')) {
            echo "✓ Sonic The Hedgehog 2 (USA) (Auto Demo)-artwork.png → Sonic The Hedgehog 2-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic The Hedgehog 2 (USA) (Auto Demo)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic The Hedgehog 2-artwork.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog 2 (USA) → Sonic The Hedgehog 2
if (file_exists($imageDir . '/Sonic The Hedgehog 2 (USA) (Auto Demo)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2-cover.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog 2 (USA) (Auto Demo)-cover.png', $imageDir . '/Sonic The Hedgehog 2-cover.png')) {
            echo "✓ Sonic The Hedgehog 2 (USA) (Auto Demo)-cover.png → Sonic The Hedgehog 2-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic The Hedgehog 2 (USA) (Auto Demo)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic The Hedgehog 2-cover.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog 2 (USA) → Sonic The Hedgehog 2
if (file_exists($imageDir . '/Sonic The Hedgehog 2 (USA) (Auto Demo)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2-gameplay.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog 2 (USA) (Auto Demo)-gameplay.png', $imageDir . '/Sonic The Hedgehog 2-gameplay.png')) {
            echo "✓ Sonic The Hedgehog 2 (USA) (Auto Demo)-gameplay.png → Sonic The Hedgehog 2-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic The Hedgehog 2 (USA) (Auto Demo)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic The Hedgehog 2-gameplay.png\n";
        $skipped++;
    }
}

// Sonic _ Tails (Japan) → Sonic _ Tails 2 (Japan)[t]
if (file_exists($imageDir . '/Sonic _ Tails (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic _ Tails 2 (Japan)[t]-artwork.png')) {
        if (rename($imageDir . '/Sonic _ Tails (Japan) (En)-artwork.png', $imageDir . '/Sonic _ Tails 2 (Japan)[t]-artwork.png')) {
            echo "✓ Sonic _ Tails (Japan) (En)-artwork.png → Sonic _ Tails 2 (Japan)[t]-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic _ Tails (Japan) (En)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic _ Tails 2 (Japan)[t]-artwork.png\n";
        $skipped++;
    }
}

// Sonic _ Tails (Japan) → Sonic _ Tails 2 (Japan)[t]
if (file_exists($imageDir . '/Sonic _ Tails (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic _ Tails 2 (Japan)[t]-cover.png')) {
        if (rename($imageDir . '/Sonic _ Tails (Japan) (En)-cover.png', $imageDir . '/Sonic _ Tails 2 (Japan)[t]-cover.png')) {
            echo "✓ Sonic _ Tails (Japan) (En)-cover.png → Sonic _ Tails 2 (Japan)[t]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic _ Tails (Japan) (En)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic _ Tails 2 (Japan)[t]-cover.png\n";
        $skipped++;
    }
}

// Sonic _ Tails (Japan) → Sonic _ Tails 2 (Japan)[t]
if (file_exists($imageDir . '/Sonic _ Tails (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic _ Tails 2 (Japan)[t]-gameplay.png')) {
        if (rename($imageDir . '/Sonic _ Tails (Japan) (En)-gameplay.png', $imageDir . '/Sonic _ Tails 2 (Japan)[t]-gameplay.png')) {
            echo "✓ Sonic _ Tails (Japan) (En)-gameplay.png → Sonic _ Tails 2 (Japan)[t]-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic _ Tails (Japan) (En)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic _ Tails 2 (Japan)[t]-gameplay.png\n";
        $skipped++;
    }
}

// Sonic _ Tails 2 (Japan) → Sonic _ Tails 2 (Japan)[t]
if (file_exists($imageDir . '/Sonic _ Tails 2 (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic _ Tails 2 (Japan)[t]-artwork.png')) {
        if (rename($imageDir . '/Sonic _ Tails 2 (Japan) (En)-artwork.png', $imageDir . '/Sonic _ Tails 2 (Japan)[t]-artwork.png')) {
            echo "✓ Sonic _ Tails 2 (Japan) (En)-artwork.png → Sonic _ Tails 2 (Japan)[t]-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic _ Tails 2 (Japan) (En)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic _ Tails 2 (Japan)[t]-artwork.png\n";
        $skipped++;
    }
}

// Sonic _ Tails 2 (Japan) → Sonic _ Tails 2 (Japan)[t]
if (file_exists($imageDir . '/Sonic _ Tails 2 (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic _ Tails 2 (Japan)[t]-cover.png')) {
        if (rename($imageDir . '/Sonic _ Tails 2 (Japan) (En)-cover.png', $imageDir . '/Sonic _ Tails 2 (Japan)[t]-cover.png')) {
            echo "✓ Sonic _ Tails 2 (Japan) (En)-cover.png → Sonic _ Tails 2 (Japan)[t]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic _ Tails 2 (Japan) (En)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic _ Tails 2 (Japan)[t]-cover.png\n";
        $skipped++;
    }
}

// Sonic _ Tails 2 (Japan) → Sonic _ Tails 2 (Japan)[t]
if (file_exists($imageDir . '/Sonic _ Tails 2 (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic _ Tails 2 (Japan)[t]-gameplay.png')) {
        if (rename($imageDir . '/Sonic _ Tails 2 (Japan) (En)-gameplay.png', $imageDir . '/Sonic _ Tails 2 (Japan)[t]-gameplay.png')) {
            echo "✓ Sonic _ Tails 2 (Japan) (En)-gameplay.png → Sonic _ Tails 2 (Japan)[t]-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sonic _ Tails 2 (Japan) (En)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sonic _ Tails 2 (Japan)[t]-gameplay.png\n";
        $skipped++;
    }
}

// Super Smash T V → Super Smash T.V.
if (file_exists($imageDir . '/Super Smash T V (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Super Smash T.V.-artwork.png')) {
        if (rename($imageDir . '/Super Smash T V (World)-artwork.png', $imageDir . '/Super Smash T.V.-artwork.png')) {
            echo "✓ Super Smash T V (World)-artwork.png → Super Smash T.V.-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Super Smash T V (World)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Super Smash T.V.-artwork.png\n";
        $skipped++;
    }
}

// Super Smash T V → Super Smash T.V.
if (file_exists($imageDir . '/Super Smash T V (World)-cover.png')) {
    if (!file_exists($imageDir . '/Super Smash T.V.-cover.png')) {
        if (rename($imageDir . '/Super Smash T V (World)-cover.png', $imageDir . '/Super Smash T.V.-cover.png')) {
            echo "✓ Super Smash T V (World)-cover.png → Super Smash T.V.-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Super Smash T V (World)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Super Smash T.V.-cover.png\n";
        $skipped++;
    }
}

// Super Smash T V → Super Smash T.V.
if (file_exists($imageDir . '/Super Smash T V (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Smash T.V.-gameplay.png')) {
        if (rename($imageDir . '/Super Smash T V (World)-gameplay.png', $imageDir . '/Super Smash T.V.-gameplay.png')) {
            echo "✓ Super Smash T V (World)-gameplay.png → Super Smash T.V.-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Super Smash T V (World)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Super Smash T.V.-gameplay.png\n";
        $skipped++;
    }
}

// Sylvan Tale Japantr Fr Asmodeathv0 9 → Sylvan Tale (Japan)[tr fr Asmodeath][v0.9]
if (file_exists($imageDir . '/Sylvan Tale Japantr Fr Asmodeathv0 9-cover.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale (Japan)[tr fr Asmodeath][v0.9]-cover.png')) {
        if (rename($imageDir . '/Sylvan Tale Japantr Fr Asmodeathv0 9-cover.png', $imageDir . '/Sylvan Tale (Japan)[tr fr Asmodeath][v0.9]-cover.png')) {
            echo "✓ Sylvan Tale Japantr Fr Asmodeathv0 9-cover.png → Sylvan Tale (Japan)[tr fr Asmodeath][v0.9]-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Sylvan Tale Japantr Fr Asmodeathv0 9-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Sylvan Tale (Japan)[tr fr Asmodeath][v0.9]-cover.png\n";
        $skipped++;
    }
}

// Tatakae Pro Yakyuu Twin League → Tatakae! Pro Yakyuu Twin League
if (file_exists($imageDir . '/Tatakae Pro Yakyuu Twin League (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Tatakae! Pro Yakyuu Twin League-artwork.png')) {
        if (rename($imageDir . '/Tatakae Pro Yakyuu Twin League (Japan)-artwork.png', $imageDir . '/Tatakae! Pro Yakyuu Twin League-artwork.png')) {
            echo "✓ Tatakae Pro Yakyuu Twin League (Japan)-artwork.png → Tatakae! Pro Yakyuu Twin League-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Tatakae Pro Yakyuu Twin League (Japan)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Tatakae! Pro Yakyuu Twin League-artwork.png\n";
        $skipped++;
    }
}

// Tatakae Pro Yakyuu Twin League → Tatakae! Pro Yakyuu Twin League
if (file_exists($imageDir . '/Tatakae Pro Yakyuu Twin League (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Tatakae! Pro Yakyuu Twin League-cover.png')) {
        if (rename($imageDir . '/Tatakae Pro Yakyuu Twin League (Japan)-cover.png', $imageDir . '/Tatakae! Pro Yakyuu Twin League-cover.png')) {
            echo "✓ Tatakae Pro Yakyuu Twin League (Japan)-cover.png → Tatakae! Pro Yakyuu Twin League-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Tatakae Pro Yakyuu Twin League (Japan)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Tatakae! Pro Yakyuu Twin League-cover.png\n";
        $skipped++;
    }
}

// Tatakae Pro Yakyuu Twin League → Tatakae! Pro Yakyuu Twin League
if (file_exists($imageDir . '/Tatakae Pro Yakyuu Twin League (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Tatakae! Pro Yakyuu Twin League-gameplay.png')) {
        if (rename($imageDir . '/Tatakae Pro Yakyuu Twin League (Japan)-gameplay.png', $imageDir . '/Tatakae! Pro Yakyuu Twin League-gameplay.png')) {
            echo "✓ Tatakae Pro Yakyuu Twin League (Japan)-gameplay.png → Tatakae! Pro Yakyuu Twin League-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Tatakae Pro Yakyuu Twin League (Japan)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Tatakae! Pro Yakyuu Twin League-gameplay.png\n";
        $skipped++;
    }
}

// Tempo Jr → Tempo Jr.
if (file_exists($imageDir . '/Tempo Jr (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Tempo Jr.-artwork.png')) {
        if (rename($imageDir . '/Tempo Jr (World)-artwork.png', $imageDir . '/Tempo Jr.-artwork.png')) {
            echo "✓ Tempo Jr (World)-artwork.png → Tempo Jr.-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Tempo Jr (World)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Tempo Jr.-artwork.png\n";
        $skipped++;
    }
}

// Tempo Jr → Tempo Jr.
if (file_exists($imageDir . '/Tempo Jr (World)-cover.png')) {
    if (!file_exists($imageDir . '/Tempo Jr.-cover.png')) {
        if (rename($imageDir . '/Tempo Jr (World)-cover.png', $imageDir . '/Tempo Jr.-cover.png')) {
            echo "✓ Tempo Jr (World)-cover.png → Tempo Jr.-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Tempo Jr (World)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Tempo Jr.-cover.png\n";
        $skipped++;
    }
}

// Tempo Jr → Tempo Jr.
if (file_exists($imageDir . '/Tempo Jr (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Tempo Jr.-gameplay.png')) {
        if (rename($imageDir . '/Tempo Jr (World)-gameplay.png', $imageDir . '/Tempo Jr.-gameplay.png')) {
            echo "✓ Tempo Jr (World)-gameplay.png → Tempo Jr.-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Tempo Jr (World)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Tempo Jr.-gameplay.png\n";
        $skipped++;
    }
}

// Vampire - Master of Darkness (USA) → Vampire - Master of Darkness
if (file_exists($imageDir . '/Vampire - Master of Darkness (USA) (Virtual Console)-artwork.png')) {
    if (!file_exists($imageDir . '/Vampire - Master of Darkness-artwork.png')) {
        if (rename($imageDir . '/Vampire - Master of Darkness (USA) (Virtual Console)-artwork.png', $imageDir . '/Vampire - Master of Darkness-artwork.png')) {
            echo "✓ Vampire - Master of Darkness (USA) (Virtual Console)-artwork.png → Vampire - Master of Darkness-artwork.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Vampire - Master of Darkness (USA) (Virtual Console)-artwork.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Vampire - Master of Darkness-artwork.png\n";
        $skipped++;
    }
}

// Vampire - Master of Darkness (USA) → Vampire - Master of Darkness
if (file_exists($imageDir . '/Vampire - Master of Darkness (USA) (Virtual Console)-cover.png')) {
    if (!file_exists($imageDir . '/Vampire - Master of Darkness-cover.png')) {
        if (rename($imageDir . '/Vampire - Master of Darkness (USA) (Virtual Console)-cover.png', $imageDir . '/Vampire - Master of Darkness-cover.png')) {
            echo "✓ Vampire - Master of Darkness (USA) (Virtual Console)-cover.png → Vampire - Master of Darkness-cover.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Vampire - Master of Darkness (USA) (Virtual Console)-cover.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Vampire - Master of Darkness-cover.png\n";
        $skipped++;
    }
}

// Vampire - Master of Darkness (USA) → Vampire - Master of Darkness
if (file_exists($imageDir . '/Vampire - Master of Darkness (USA) (Virtual Console)-gameplay.png')) {
    if (!file_exists($imageDir . '/Vampire - Master of Darkness-gameplay.png')) {
        if (rename($imageDir . '/Vampire - Master of Darkness (USA) (Virtual Console)-gameplay.png', $imageDir . '/Vampire - Master of Darkness-gameplay.png')) {
            echo "✓ Vampire - Master of Darkness (USA) (Virtual Console)-gameplay.png → Vampire - Master of Darkness-gameplay.png\n";
            $renamed++;
        } else {
            echo "❌ ERREUR: Vampire - Master of Darkness (USA) (Virtual Console)-gameplay.png\n";
            $errors++;
        }
    } else {
        echo "⚠️ EXISTE DÉJÀ: Vampire - Master of Darkness-gameplay.png\n";
        $skipped++;
    }
}

echo "\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "✅ Renommés: $renamed fichiers\n";
echo "⚠️ Ignorés: $skipped fichiers\n";
echo "❌ Erreurs: $errors fichiers\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n";
