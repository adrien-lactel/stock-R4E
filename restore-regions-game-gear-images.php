<?php

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║        RESTAURATION RÉGIONS - GAME GEAR IMAGES                               ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

$imageDir = __DIR__ . '/public/images/taxonomy/gamegear';
$renamed = 0;
$skipped = 0;

// 5 in One FunPak → 5 in One FunPak (USA)
if (file_exists($imageDir . '/5 in One FunPak-artwork.png')) {
    if (!file_exists($imageDir . '/5 in One FunPak (USA)-artwork.png')) {
        if (rename($imageDir . '/5 in One FunPak-artwork.png', $imageDir . '/5 in One FunPak (USA)-artwork.png')) {
            echo "✓ 5 in One FunPak-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: 5 in One FunPak (USA)-artwork.png\n";
        $skipped++;
    }
}

// 5 in One FunPak → 5 in One FunPak (USA)
if (file_exists($imageDir . '/5 in One FunPak-cover.png')) {
    if (!file_exists($imageDir . '/5 in One FunPak (USA)-cover.png')) {
        if (rename($imageDir . '/5 in One FunPak-cover.png', $imageDir . '/5 in One FunPak (USA)-cover.png')) {
            echo "✓ 5 in One FunPak-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: 5 in One FunPak (USA)-cover.png\n";
        $skipped++;
    }
}

// 5 in One FunPak → 5 in One FunPak (USA)
if (file_exists($imageDir . '/5 in One FunPak-gameplay.png')) {
    if (!file_exists($imageDir . '/5 in One FunPak (USA)-gameplay.png')) {
        if (rename($imageDir . '/5 in One FunPak-gameplay.png', $imageDir . '/5 in One FunPak (USA)-gameplay.png')) {
            echo "✓ 5 in One FunPak-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: 5 in One FunPak (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Aa Harimanada → Aa Harimanada (Japan)
if (file_exists($imageDir . '/Aa Harimanada-artwork.png')) {
    if (!file_exists($imageDir . '/Aa Harimanada (Japan)-artwork.png')) {
        if (rename($imageDir . '/Aa Harimanada-artwork.png', $imageDir . '/Aa Harimanada (Japan)-artwork.png')) {
            echo "✓ Aa Harimanada-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aa Harimanada (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Aa Harimanada → Aa Harimanada (Japan)
if (file_exists($imageDir . '/Aa Harimanada-cover.png')) {
    if (!file_exists($imageDir . '/Aa Harimanada (Japan)-cover.png')) {
        if (rename($imageDir . '/Aa Harimanada-cover.png', $imageDir . '/Aa Harimanada (Japan)-cover.png')) {
            echo "✓ Aa Harimanada-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aa Harimanada (Japan)-cover.png\n";
        $skipped++;
    }
}

// Aa Harimanada → Aa Harimanada (Japan)
if (file_exists($imageDir . '/Aa Harimanada-gameplay.png')) {
    if (!file_exists($imageDir . '/Aa Harimanada (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Aa Harimanada-gameplay.png', $imageDir . '/Aa Harimanada (Japan)-gameplay.png')) {
            echo "✓ Aa Harimanada-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aa Harimanada (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Addams Family, The → Addams Family, The (World)
if (file_exists($imageDir . '/Addams Family, The-artwork.png')) {
    if (!file_exists($imageDir . '/Addams Family, The (World)-artwork.png')) {
        if (rename($imageDir . '/Addams Family, The-artwork.png', $imageDir . '/Addams Family, The (World)-artwork.png')) {
            echo "✓ Addams Family, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Addams Family, The (World)-artwork.png\n";
        $skipped++;
    }
}

// Addams Family, The → Addams Family, The (World)
if (file_exists($imageDir . '/Addams Family, The-cover.png')) {
    if (!file_exists($imageDir . '/Addams Family, The (World)-cover.png')) {
        if (rename($imageDir . '/Addams Family, The-cover.png', $imageDir . '/Addams Family, The (World)-cover.png')) {
            echo "✓ Addams Family, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Addams Family, The (World)-cover.png\n";
        $skipped++;
    }
}

// Addams Family, The → Addams Family, The (World)
if (file_exists($imageDir . '/Addams Family, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Addams Family, The (World)-gameplay.png')) {
        if (rename($imageDir . '/Addams Family, The-gameplay.png', $imageDir . '/Addams Family, The (World)-gameplay.png')) {
            echo "✓ Addams Family, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Addams Family, The (World)-gameplay.png\n";
        $skipped++;
    }
}

// Adventures of Batman _ Robin, The → Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)
if (file_exists($imageDir . '/Adventures of Batman _ Robin, The-artwork.png')) {
    if (!file_exists($imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-artwork.png')) {
        if (rename($imageDir . '/Adventures of Batman _ Robin, The-artwork.png', $imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-artwork.png')) {
            echo "✓ Adventures of Batman _ Robin, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-artwork.png\n";
        $skipped++;
    }
}

// Adventures of Batman _ Robin, The → Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)
if (file_exists($imageDir . '/Adventures of Batman _ Robin, The-cover.png')) {
    if (!file_exists($imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-cover.png')) {
        if (rename($imageDir . '/Adventures of Batman _ Robin, The-cover.png', $imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-cover.png')) {
            echo "✓ Adventures of Batman _ Robin, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-cover.png\n";
        $skipped++;
    }
}

// Adventures of Batman _ Robin, The → Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)
if (file_exists($imageDir . '/Adventures of Batman _ Robin, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-gameplay.png')) {
        if (rename($imageDir . '/Adventures of Batman _ Robin, The-gameplay.png', $imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-gameplay.png')) {
            echo "✓ Adventures of Batman _ Robin, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-gameplay.png\n";
        $skipped++;
    }
}

// Aerial Assault → Aerial Assault (World)
if (file_exists($imageDir . '/Aerial Assault-artwork.png')) {
    if (!file_exists($imageDir . '/Aerial Assault (World)-artwork.png')) {
        if (rename($imageDir . '/Aerial Assault-artwork.png', $imageDir . '/Aerial Assault (World)-artwork.png')) {
            echo "✓ Aerial Assault-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aerial Assault (World)-artwork.png\n";
        $skipped++;
    }
}

// Aerial Assault → Aerial Assault (World)
if (file_exists($imageDir . '/Aerial Assault-cover.png')) {
    if (!file_exists($imageDir . '/Aerial Assault (World)-cover.png')) {
        if (rename($imageDir . '/Aerial Assault-cover.png', $imageDir . '/Aerial Assault (World)-cover.png')) {
            echo "✓ Aerial Assault-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aerial Assault (World)-cover.png\n";
        $skipped++;
    }
}

// Aerial Assault → Aerial Assault (World)
if (file_exists($imageDir . '/Aerial Assault-gameplay.png')) {
    if (!file_exists($imageDir . '/Aerial Assault (World)-gameplay.png')) {
        if (rename($imageDir . '/Aerial Assault-gameplay.png', $imageDir . '/Aerial Assault (World)-gameplay.png')) {
            echo "✓ Aerial Assault-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aerial Assault (World)-gameplay.png\n";
        $skipped++;
    }
}

// Aladdin (Japan) → Aladdin (Japan) (En)
if (file_exists($imageDir . '/Aladdin (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Aladdin (Japan) (En)-cover.png')) {
        if (rename($imageDir . '/Aladdin (Japan)-cover.png', $imageDir . '/Aladdin (Japan) (En)-cover.png')) {
            echo "✓ Aladdin (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aladdin (Japan) (En)-cover.png\n";
        $skipped++;
    }
}

// Alien 3 (Japan) → Alien 3 (Japan) (En)
if (file_exists($imageDir . '/Alien 3 (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Alien 3 (Japan) (En)-cover.png')) {
        if (rename($imageDir . '/Alien 3 (Japan)-cover.png', $imageDir . '/Alien 3 (Japan) (En)-cover.png')) {
            echo "✓ Alien 3 (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Alien 3 (Japan) (En)-cover.png\n";
        $skipped++;
    }
}

// Alien Syndrome (Japan) → Alien Syndrome (Japan) (En)
if (file_exists($imageDir . '/Alien Syndrome (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Alien Syndrome (Japan) (En)-cover.png')) {
        if (rename($imageDir . '/Alien Syndrome (Japan)-cover.png', $imageDir . '/Alien Syndrome (Japan) (En)-cover.png')) {
            echo "✓ Alien Syndrome (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Alien Syndrome (Japan) (En)-cover.png\n";
        $skipped++;
    }
}

// Alien Syndrome → Alien Syndrome (Europe)
if (file_exists($imageDir . '/Alien Syndrome-artwork.png')) {
    if (!file_exists($imageDir . '/Alien Syndrome (Europe)-artwork.png')) {
        if (rename($imageDir . '/Alien Syndrome-artwork.png', $imageDir . '/Alien Syndrome (Europe)-artwork.png')) {
            echo "✓ Alien Syndrome-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Alien Syndrome (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Alien Syndrome → Alien Syndrome (Europe)
if (file_exists($imageDir . '/Alien Syndrome-cover.png')) {
    if (!file_exists($imageDir . '/Alien Syndrome (Europe)-cover.png')) {
        if (rename($imageDir . '/Alien Syndrome-cover.png', $imageDir . '/Alien Syndrome (Europe)-cover.png')) {
            echo "✓ Alien Syndrome-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Alien Syndrome (Europe)-cover.png\n";
        $skipped++;
    }
}

// Alien Syndrome → Alien Syndrome (Europe)
if (file_exists($imageDir . '/Alien Syndrome-gameplay.png')) {
    if (!file_exists($imageDir . '/Alien Syndrome (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Alien Syndrome-gameplay.png', $imageDir . '/Alien Syndrome (Europe)-gameplay.png')) {
            echo "✓ Alien Syndrome-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Alien Syndrome (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Andre Agassi Tennis → Andre Agassi Tennis (USA)
if (file_exists($imageDir . '/Andre Agassi Tennis-artwork.png')) {
    if (!file_exists($imageDir . '/Andre Agassi Tennis (USA)-artwork.png')) {
        if (rename($imageDir . '/Andre Agassi Tennis-artwork.png', $imageDir . '/Andre Agassi Tennis (USA)-artwork.png')) {
            echo "✓ Andre Agassi Tennis-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Andre Agassi Tennis (USA)-artwork.png\n";
        $skipped++;
    }
}

// Andre Agassi Tennis → Andre Agassi Tennis (USA)
if (file_exists($imageDir . '/Andre Agassi Tennis-cover.png')) {
    if (!file_exists($imageDir . '/Andre Agassi Tennis (USA)-cover.png')) {
        if (rename($imageDir . '/Andre Agassi Tennis-cover.png', $imageDir . '/Andre Agassi Tennis (USA)-cover.png')) {
            echo "✓ Andre Agassi Tennis-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Andre Agassi Tennis (USA)-cover.png\n";
        $skipped++;
    }
}

// Andre Agassi Tennis → Andre Agassi Tennis (USA)
if (file_exists($imageDir . '/Andre Agassi Tennis-gameplay.png')) {
    if (!file_exists($imageDir . '/Andre Agassi Tennis (USA)-gameplay.png')) {
        if (rename($imageDir . '/Andre Agassi Tennis-gameplay.png', $imageDir . '/Andre Agassi Tennis (USA)-gameplay.png')) {
            echo "✓ Andre Agassi Tennis-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Andre Agassi Tennis (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Arcade Classics → Arcade Classics (USA)
if (file_exists($imageDir . '/Arcade Classics-artwork.png')) {
    if (!file_exists($imageDir . '/Arcade Classics (USA)-artwork.png')) {
        if (rename($imageDir . '/Arcade Classics-artwork.png', $imageDir . '/Arcade Classics (USA)-artwork.png')) {
            echo "✓ Arcade Classics-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arcade Classics (USA)-artwork.png\n";
        $skipped++;
    }
}

// Arcade Classics → Arcade Classics (USA)
if (file_exists($imageDir . '/Arcade Classics-cover.png')) {
    if (!file_exists($imageDir . '/Arcade Classics (USA)-cover.png')) {
        if (rename($imageDir . '/Arcade Classics-cover.png', $imageDir . '/Arcade Classics (USA)-cover.png')) {
            echo "✓ Arcade Classics-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arcade Classics (USA)-cover.png\n";
        $skipped++;
    }
}

// Arcade Classics → Arcade Classics (USA)
if (file_exists($imageDir . '/Arcade Classics-gameplay.png')) {
    if (!file_exists($imageDir . '/Arcade Classics (USA)-gameplay.png')) {
        if (rename($imageDir . '/Arcade Classics-gameplay.png', $imageDir . '/Arcade Classics (USA)-gameplay.png')) {
            echo "✓ Arcade Classics-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arcade Classics (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Arch Rivals - The Arcade Game → Arch Rivals - The Arcade Game (USA)
if (file_exists($imageDir . '/Arch Rivals - The Arcade Game-artwork.png')) {
    if (!file_exists($imageDir . '/Arch Rivals - The Arcade Game (USA)-artwork.png')) {
        if (rename($imageDir . '/Arch Rivals - The Arcade Game-artwork.png', $imageDir . '/Arch Rivals - The Arcade Game (USA)-artwork.png')) {
            echo "✓ Arch Rivals - The Arcade Game-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arch Rivals - The Arcade Game (USA)-artwork.png\n";
        $skipped++;
    }
}

// Arch Rivals - The Arcade Game → Arch Rivals - The Arcade Game (USA)
if (file_exists($imageDir . '/Arch Rivals - The Arcade Game-cover.png')) {
    if (!file_exists($imageDir . '/Arch Rivals - The Arcade Game (USA)-cover.png')) {
        if (rename($imageDir . '/Arch Rivals - The Arcade Game-cover.png', $imageDir . '/Arch Rivals - The Arcade Game (USA)-cover.png')) {
            echo "✓ Arch Rivals - The Arcade Game-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arch Rivals - The Arcade Game (USA)-cover.png\n";
        $skipped++;
    }
}

// Arch Rivals - The Arcade Game → Arch Rivals - The Arcade Game (USA)
if (file_exists($imageDir . '/Arch Rivals - The Arcade Game-gameplay.png')) {
    if (!file_exists($imageDir . '/Arch Rivals - The Arcade Game (USA)-gameplay.png')) {
        if (rename($imageDir . '/Arch Rivals - The Arcade Game-gameplay.png', $imageDir . '/Arch Rivals - The Arcade Game (USA)-gameplay.png')) {
            echo "✓ Arch Rivals - The Arcade Game-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arch Rivals - The Arcade Game (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Archer Maclean's Dropzone → Archer Maclean's Dropzone (Europe)
if (file_exists($imageDir . '/Archer Maclean\'s Dropzone-artwork.png')) {
    if (!file_exists($imageDir . '/Archer Maclean\'s Dropzone (Europe)-artwork.png')) {
        if (rename($imageDir . '/Archer Maclean\'s Dropzone-artwork.png', $imageDir . '/Archer Maclean\'s Dropzone (Europe)-artwork.png')) {
            echo "✓ Archer Maclean\'s Dropzone-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Archer Maclean\'s Dropzone (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Archer Maclean's Dropzone → Archer Maclean's Dropzone (Europe)
if (file_exists($imageDir . '/Archer Maclean\'s Dropzone-cover.png')) {
    if (!file_exists($imageDir . '/Archer Maclean\'s Dropzone (Europe)-cover.png')) {
        if (rename($imageDir . '/Archer Maclean\'s Dropzone-cover.png', $imageDir . '/Archer Maclean\'s Dropzone (Europe)-cover.png')) {
            echo "✓ Archer Maclean\'s Dropzone-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Archer Maclean\'s Dropzone (Europe)-cover.png\n";
        $skipped++;
    }
}

// Archer Maclean's Dropzone → Archer Maclean's Dropzone (Europe)
if (file_exists($imageDir . '/Archer Maclean\'s Dropzone-gameplay.png')) {
    if (!file_exists($imageDir . '/Archer Maclean\'s Dropzone (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Archer Maclean\'s Dropzone-gameplay.png', $imageDir . '/Archer Maclean\'s Dropzone (Europe)-gameplay.png')) {
            echo "✓ Archer Maclean\'s Dropzone-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Archer Maclean\'s Dropzone (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Ariel - The Little Mermaid → Ariel - The Little Mermaid (USA, Europe, Brazil)
if (file_exists($imageDir . '/Ariel - The Little Mermaid-cover.png')) {
    if (!file_exists($imageDir . '/Ariel - The Little Mermaid (USA, Europe, Brazil)-cover.png')) {
        if (rename($imageDir . '/Ariel - The Little Mermaid-cover.png', $imageDir . '/Ariel - The Little Mermaid (USA, Europe, Brazil)-cover.png')) {
            echo "✓ Ariel - The Little Mermaid-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ariel - The Little Mermaid (USA, Europe, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Arliel - Crystal Densetsu → Arliel - Crystal Densetsu (Japan)
if (file_exists($imageDir . '/Arliel - Crystal Densetsu-artwork.png')) {
    if (!file_exists($imageDir . '/Arliel - Crystal Densetsu (Japan)-artwork.png')) {
        if (rename($imageDir . '/Arliel - Crystal Densetsu-artwork.png', $imageDir . '/Arliel - Crystal Densetsu (Japan)-artwork.png')) {
            echo "✓ Arliel - Crystal Densetsu-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arliel - Crystal Densetsu (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Arliel - Crystal Densetsu → Arliel - Crystal Densetsu (Japan)
if (file_exists($imageDir . '/Arliel - Crystal Densetsu-cover.png')) {
    if (!file_exists($imageDir . '/Arliel - Crystal Densetsu (Japan)-cover.png')) {
        if (rename($imageDir . '/Arliel - Crystal Densetsu-cover.png', $imageDir . '/Arliel - Crystal Densetsu (Japan)-cover.png')) {
            echo "✓ Arliel - Crystal Densetsu-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arliel - Crystal Densetsu (Japan)-cover.png\n";
        $skipped++;
    }
}

// Arliel - Crystal Densetsu → Arliel - Crystal Densetsu (Japan)
if (file_exists($imageDir . '/Arliel - Crystal Densetsu-gameplay.png')) {
    if (!file_exists($imageDir . '/Arliel - Crystal Densetsu (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Arliel - Crystal Densetsu-gameplay.png', $imageDir . '/Arliel - Crystal Densetsu (Japan)-gameplay.png')) {
            echo "✓ Arliel - Crystal Densetsu-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arliel - Crystal Densetsu (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue → Asterix and the Great Rescue (USA, Brazil)
if (file_exists($imageDir . '/Asterix and the Great Rescue-artwork.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue (USA, Brazil)-artwork.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue-artwork.png', $imageDir . '/Asterix and the Great Rescue (USA, Brazil)-artwork.png')) {
            echo "✓ Asterix and the Great Rescue-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue (USA, Brazil)-artwork.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue → Asterix and the Great Rescue (USA, Brazil)
if (file_exists($imageDir . '/Asterix and the Great Rescue-cover.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue (USA, Brazil)-cover.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue-cover.png', $imageDir . '/Asterix and the Great Rescue (USA, Brazil)-cover.png')) {
            echo "✓ Asterix and the Great Rescue-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue (USA, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue → Asterix and the Great Rescue (USA, Brazil)
if (file_exists($imageDir . '/Asterix and the Great Rescue-gameplay.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue (USA, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue-gameplay.png', $imageDir . '/Asterix and the Great Rescue (USA, Brazil)-gameplay.png')) {
            echo "✓ Asterix and the Great Rescue-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue (USA, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// Asterix and the Secret Mission → Asterix and the Secret Mission (Europe) (En,Fr,De)
if (file_exists($imageDir . '/Asterix and the Secret Mission-artwork.png')) {
    if (!file_exists($imageDir . '/Asterix and the Secret Mission (Europe) (En,Fr,De)-artwork.png')) {
        if (rename($imageDir . '/Asterix and the Secret Mission-artwork.png', $imageDir . '/Asterix and the Secret Mission (Europe) (En,Fr,De)-artwork.png')) {
            echo "✓ Asterix and the Secret Mission-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Secret Mission (Europe) (En,Fr,De)-artwork.png\n";
        $skipped++;
    }
}

// Asterix and the Secret Mission → Asterix and the Secret Mission (Europe) (En,Fr,De)
if (file_exists($imageDir . '/Asterix and the Secret Mission-cover.png')) {
    if (!file_exists($imageDir . '/Asterix and the Secret Mission (Europe) (En,Fr,De)-cover.png')) {
        if (rename($imageDir . '/Asterix and the Secret Mission-cover.png', $imageDir . '/Asterix and the Secret Mission (Europe) (En,Fr,De)-cover.png')) {
            echo "✓ Asterix and the Secret Mission-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Secret Mission (Europe) (En,Fr,De)-cover.png\n";
        $skipped++;
    }
}

// Asterix and the Secret Mission → Asterix and the Secret Mission (Europe) (En,Fr,De)
if (file_exists($imageDir . '/Asterix and the Secret Mission-gameplay.png')) {
    if (!file_exists($imageDir . '/Asterix and the Secret Mission (Europe) (En,Fr,De)-gameplay.png')) {
        if (rename($imageDir . '/Asterix and the Secret Mission-gameplay.png', $imageDir . '/Asterix and the Secret Mission (Europe) (En,Fr,De)-gameplay.png')) {
            echo "✓ Asterix and the Secret Mission-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Secret Mission (Europe) (En,Fr,De)-gameplay.png\n";
        $skipped++;
    }
}

// Ax Battler - A Legend of Golden Axe v2.4 → Ax Battler - A Legend of Golden Axe v2.4 [tr fr]
if (file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe v2.4-cover.png')) {
    if (!file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-cover.png')) {
        if (rename($imageDir . '/Ax Battler - A Legend of Golden Axe v2.4-cover.png', $imageDir . '/Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-cover.png')) {
            echo "✓ Ax Battler - A Legend of Golden Axe v2.4-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-cover.png\n";
        $skipped++;
    }
}

// Ax Battler - A Legend of Golden Axe → Ax Battler - A Legend of Golden Axe v2.4 [tr fr]
if (file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe-artwork.png')) {
    if (!file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-artwork.png')) {
        if (rename($imageDir . '/Ax Battler - A Legend of Golden Axe-artwork.png', $imageDir . '/Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-artwork.png')) {
            echo "✓ Ax Battler - A Legend of Golden Axe-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-artwork.png\n";
        $skipped++;
    }
}

// Ax Battler - A Legend of Golden Axe → Ax Battler - A Legend of Golden Axe v2.4 [tr fr]
if (file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe-cover.png')) {
    if (!file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-cover.png')) {
        if (rename($imageDir . '/Ax Battler - A Legend of Golden Axe-cover.png', $imageDir . '/Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-cover.png')) {
            echo "✓ Ax Battler - A Legend of Golden Axe-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-cover.png\n";
        $skipped++;
    }
}

// Ax Battler - A Legend of Golden Axe → Ax Battler - A Legend of Golden Axe v2.4 [tr fr]
if (file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe-gameplay.png')) {
    if (!file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-gameplay.png')) {
        if (rename($imageDir . '/Ax Battler - A Legend of Golden Axe-gameplay.png', $imageDir . '/Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-gameplay.png')) {
            echo "✓ Ax Battler - A Legend of Golden Axe-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - A Legend of Golden Axe v2.4 [tr fr]-gameplay.png\n";
        $skipped++;
    }
}

// Ax Battler - Golden Axe Densetsu → Ax Battler - Golden Axe Densetsu (Japan)
if (file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu-artwork.png')) {
    if (!file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-artwork.png')) {
        if (rename($imageDir . '/Ax Battler - Golden Axe Densetsu-artwork.png', $imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-artwork.png')) {
            echo "✓ Ax Battler - Golden Axe Densetsu-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - Golden Axe Densetsu (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Ax Battler - Golden Axe Densetsu → Ax Battler - Golden Axe Densetsu (Japan)
if (file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu-cover.png')) {
    if (!file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-cover.png')) {
        if (rename($imageDir . '/Ax Battler - Golden Axe Densetsu-cover.png', $imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-cover.png')) {
            echo "✓ Ax Battler - Golden Axe Densetsu-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - Golden Axe Densetsu (Japan)-cover.png\n";
        $skipped++;
    }
}

// Ax Battler - Golden Axe Densetsu → Ax Battler - Golden Axe Densetsu (Japan)
if (file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu-gameplay.png')) {
    if (!file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Ax Battler - Golden Axe Densetsu-gameplay.png', $imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-gameplay.png')) {
            echo "✓ Ax Battler - Golden Axe Densetsu-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - Golden Axe Densetsu (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Ayrton Senna's Super Monaco GP II → Ayrton Senna's Super Monaco GP II (Japan)
if (file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-artwork.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II (Japan)-artwork.png')) {
        if (rename($imageDir . '/Ayrton Senna\'s Super Monaco GP II-artwork.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II (Japan)-artwork.png')) {
            echo "✓ Ayrton Senna\'s Super Monaco GP II-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ayrton Senna\'s Super Monaco GP II (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Ayrton Senna's Super Monaco GP II → Ayrton Senna's Super Monaco GP II (Japan)
if (file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-cover.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II (Japan)-cover.png')) {
        if (rename($imageDir . '/Ayrton Senna\'s Super Monaco GP II-cover.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II (Japan)-cover.png')) {
            echo "✓ Ayrton Senna\'s Super Monaco GP II-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ayrton Senna\'s Super Monaco GP II (Japan)-cover.png\n";
        $skipped++;
    }
}

// Ayrton Senna's Super Monaco GP II → Ayrton Senna's Super Monaco GP II (Japan)
if (file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-gameplay.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Ayrton Senna\'s Super Monaco GP II-gameplay.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II (Japan)-gameplay.png')) {
            echo "✓ Ayrton Senna\'s Super Monaco GP II-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ayrton Senna\'s Super Monaco GP II (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Baku Baku Animal - Sekai Shiikugakari Senshu-ken → Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)
if (file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-artwork.png')) {
    if (!file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-artwork.png')) {
        if (rename($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-artwork.png', $imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-artwork.png')) {
            echo "✓ Baku Baku Animal - Sekai Shiikugakari Senshu-ken-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Baku Baku Animal - Sekai Shiikugakari Senshu-ken → Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)
if (file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-cover.png')) {
    if (!file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-cover.png')) {
        if (rename($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-cover.png', $imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-cover.png')) {
            echo "✓ Baku Baku Animal - Sekai Shiikugakari Senshu-ken-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-cover.png\n";
        $skipped++;
    }
}

// Baku Baku Animal - Sekai Shiikugakari Senshu-ken → Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)
if (file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-gameplay.png')) {
    if (!file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-gameplay.png', $imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-gameplay.png')) {
            echo "✓ Baku Baku Animal - Sekai Shiikugakari Senshu-ken-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Baku Baku → Baku Baku (USA)
if (file_exists($imageDir . '/Baku Baku-artwork.png')) {
    if (!file_exists($imageDir . '/Baku Baku (USA)-artwork.png')) {
        if (rename($imageDir . '/Baku Baku-artwork.png', $imageDir . '/Baku Baku (USA)-artwork.png')) {
            echo "✓ Baku Baku-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku (USA)-artwork.png\n";
        $skipped++;
    }
}

// Baku Baku → Baku Baku (USA)
if (file_exists($imageDir . '/Baku Baku-cover.png')) {
    if (!file_exists($imageDir . '/Baku Baku (USA)-cover.png')) {
        if (rename($imageDir . '/Baku Baku-cover.png', $imageDir . '/Baku Baku (USA)-cover.png')) {
            echo "✓ Baku Baku-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku (USA)-cover.png\n";
        $skipped++;
    }
}

// Baku Baku → Baku Baku (USA)
if (file_exists($imageDir . '/Baku Baku-gameplay.png')) {
    if (!file_exists($imageDir . '/Baku Baku (USA)-gameplay.png')) {
        if (rename($imageDir . '/Baku Baku-gameplay.png', $imageDir . '/Baku Baku (USA)-gameplay.png')) {
            echo "✓ Baku Baku-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Batman Returns → Batman Returns (World)
if (file_exists($imageDir . '/Batman Returns-artwork.png')) {
    if (!file_exists($imageDir . '/Batman Returns (World)-artwork.png')) {
        if (rename($imageDir . '/Batman Returns-artwork.png', $imageDir . '/Batman Returns (World)-artwork.png')) {
            echo "✓ Batman Returns-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batman Returns (World)-artwork.png\n";
        $skipped++;
    }
}

// Batman Returns → Batman Returns (World)
if (file_exists($imageDir . '/Batman Returns-cover.png')) {
    if (!file_exists($imageDir . '/Batman Returns (World)-cover.png')) {
        if (rename($imageDir . '/Batman Returns-cover.png', $imageDir . '/Batman Returns (World)-cover.png')) {
            echo "✓ Batman Returns-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batman Returns (World)-cover.png\n";
        $skipped++;
    }
}

// Batman Returns → Batman Returns (World)
if (file_exists($imageDir . '/Batman Returns-gameplay.png')) {
    if (!file_exists($imageDir . '/Batman Returns (World)-gameplay.png')) {
        if (rename($imageDir . '/Batman Returns-gameplay.png', $imageDir . '/Batman Returns (World)-gameplay.png')) {
            echo "✓ Batman Returns-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batman Returns (World)-gameplay.png\n";
        $skipped++;
    }
}

// Batter Up → Batter Up (USA)
if (file_exists($imageDir . '/Batter Up-artwork.png')) {
    if (!file_exists($imageDir . '/Batter Up (USA)-artwork.png')) {
        if (rename($imageDir . '/Batter Up-artwork.png', $imageDir . '/Batter Up (USA)-artwork.png')) {
            echo "✓ Batter Up-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batter Up (USA)-artwork.png\n";
        $skipped++;
    }
}

// Batter Up → Batter Up (USA)
if (file_exists($imageDir . '/Batter Up-cover.png')) {
    if (!file_exists($imageDir . '/Batter Up (USA)-cover.png')) {
        if (rename($imageDir . '/Batter Up-cover.png', $imageDir . '/Batter Up (USA)-cover.png')) {
            echo "✓ Batter Up-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batter Up (USA)-cover.png\n";
        $skipped++;
    }
}

// Batter Up → Batter Up (USA)
if (file_exists($imageDir . '/Batter Up-gameplay.png')) {
    if (!file_exists($imageDir . '/Batter Up (USA)-gameplay.png')) {
        if (rename($imageDir . '/Batter Up-gameplay.png', $imageDir . '/Batter Up (USA)-gameplay.png')) {
            echo "✓ Batter Up-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batter Up (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Battleship - The Classic Naval Combat Game → Battleship - The Classic Naval Combat Game (USA)
if (file_exists($imageDir . '/Battleship - The Classic Naval Combat Game-artwork.png')) {
    if (!file_exists($imageDir . '/Battleship - The Classic Naval Combat Game (USA)-artwork.png')) {
        if (rename($imageDir . '/Battleship - The Classic Naval Combat Game-artwork.png', $imageDir . '/Battleship - The Classic Naval Combat Game (USA)-artwork.png')) {
            echo "✓ Battleship - The Classic Naval Combat Game-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battleship - The Classic Naval Combat Game (USA)-artwork.png\n";
        $skipped++;
    }
}

// Battleship - The Classic Naval Combat Game → Battleship - The Classic Naval Combat Game (USA)
if (file_exists($imageDir . '/Battleship - The Classic Naval Combat Game-cover.png')) {
    if (!file_exists($imageDir . '/Battleship - The Classic Naval Combat Game (USA)-cover.png')) {
        if (rename($imageDir . '/Battleship - The Classic Naval Combat Game-cover.png', $imageDir . '/Battleship - The Classic Naval Combat Game (USA)-cover.png')) {
            echo "✓ Battleship - The Classic Naval Combat Game-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battleship - The Classic Naval Combat Game (USA)-cover.png\n";
        $skipped++;
    }
}

// Battleship - The Classic Naval Combat Game → Battleship - The Classic Naval Combat Game (USA)
if (file_exists($imageDir . '/Battleship - The Classic Naval Combat Game-gameplay.png')) {
    if (!file_exists($imageDir . '/Battleship - The Classic Naval Combat Game (USA)-gameplay.png')) {
        if (rename($imageDir . '/Battleship - The Classic Naval Combat Game-gameplay.png', $imageDir . '/Battleship - The Classic Naval Combat Game (USA)-gameplay.png')) {
            echo "✓ Battleship - The Classic Naval Combat Game-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battleship - The Classic Naval Combat Game (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Battletoads → Battletoads (USA)
if (file_exists($imageDir . '/Battletoads-artwork.png')) {
    if (!file_exists($imageDir . '/Battletoads (USA)-artwork.png')) {
        if (rename($imageDir . '/Battletoads-artwork.png', $imageDir . '/Battletoads (USA)-artwork.png')) {
            echo "✓ Battletoads-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battletoads (USA)-artwork.png\n";
        $skipped++;
    }
}

// Battletoads → Battletoads (USA)
if (file_exists($imageDir . '/Battletoads-cover.png')) {
    if (!file_exists($imageDir . '/Battletoads (USA)-cover.png')) {
        if (rename($imageDir . '/Battletoads-cover.png', $imageDir . '/Battletoads (USA)-cover.png')) {
            echo "✓ Battletoads-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battletoads (USA)-cover.png\n";
        $skipped++;
    }
}

// Battletoads → Battletoads (USA)
if (file_exists($imageDir . '/Battletoads-gameplay.png')) {
    if (!file_exists($imageDir . '/Battletoads (USA)-gameplay.png')) {
        if (rename($imageDir . '/Battletoads-gameplay.png', $imageDir . '/Battletoads (USA)-gameplay.png')) {
            echo "✓ Battletoads-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battletoads (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Beavis and Butt-Head → Beavis and Butt-Head (USA, Europe)
if (file_exists($imageDir . '/Beavis and Butt-Head-artwork.png')) {
    if (!file_exists($imageDir . '/Beavis and Butt-Head (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Beavis and Butt-Head-artwork.png', $imageDir . '/Beavis and Butt-Head (USA, Europe)-artwork.png')) {
            echo "✓ Beavis and Butt-Head-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Beavis and Butt-Head (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Beavis and Butt-Head → Beavis and Butt-Head (USA, Europe)
if (file_exists($imageDir . '/Beavis and Butt-Head-cover.png')) {
    if (!file_exists($imageDir . '/Beavis and Butt-Head (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Beavis and Butt-Head-cover.png', $imageDir . '/Beavis and Butt-Head (USA, Europe)-cover.png')) {
            echo "✓ Beavis and Butt-Head-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Beavis and Butt-Head (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Beavis and Butt-Head → Beavis and Butt-Head (USA, Europe)
if (file_exists($imageDir . '/Beavis and Butt-Head-gameplay.png')) {
    if (!file_exists($imageDir . '/Beavis and Butt-Head (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Beavis and Butt-Head-gameplay.png', $imageDir . '/Beavis and Butt-Head (USA, Europe)-gameplay.png')) {
            echo "✓ Beavis and Butt-Head-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Beavis and Butt-Head (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Berenstain Bears' Camping Adventure, The → Berenstain Bears' Camping Adventure, The (USA)
if (file_exists($imageDir . '/Berenstain Bears\' Camping Adventure, The-artwork.png')) {
    if (!file_exists($imageDir . '/Berenstain Bears\' Camping Adventure, The (USA)-artwork.png')) {
        if (rename($imageDir . '/Berenstain Bears\' Camping Adventure, The-artwork.png', $imageDir . '/Berenstain Bears\' Camping Adventure, The (USA)-artwork.png')) {
            echo "✓ Berenstain Bears\' Camping Adventure, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Berenstain Bears\' Camping Adventure, The (USA)-artwork.png\n";
        $skipped++;
    }
}

// Berenstain Bears' Camping Adventure, The → Berenstain Bears' Camping Adventure, The (USA)
if (file_exists($imageDir . '/Berenstain Bears\' Camping Adventure, The-cover.png')) {
    if (!file_exists($imageDir . '/Berenstain Bears\' Camping Adventure, The (USA)-cover.png')) {
        if (rename($imageDir . '/Berenstain Bears\' Camping Adventure, The-cover.png', $imageDir . '/Berenstain Bears\' Camping Adventure, The (USA)-cover.png')) {
            echo "✓ Berenstain Bears\' Camping Adventure, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Berenstain Bears\' Camping Adventure, The (USA)-cover.png\n";
        $skipped++;
    }
}

// Berenstain Bears' Camping Adventure, The → Berenstain Bears' Camping Adventure, The (USA)
if (file_exists($imageDir . '/Berenstain Bears\' Camping Adventure, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Berenstain Bears\' Camping Adventure, The (USA)-gameplay.png')) {
        if (rename($imageDir . '/Berenstain Bears\' Camping Adventure, The-gameplay.png', $imageDir . '/Berenstain Bears\' Camping Adventure, The (USA)-gameplay.png')) {
            echo "✓ Berenstain Bears\' Camping Adventure, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Berenstain Bears\' Camping Adventure, The (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Berlin no Kabe → Berlin no Kabe (Japan)
if (file_exists($imageDir . '/Berlin no Kabe-artwork.png')) {
    if (!file_exists($imageDir . '/Berlin no Kabe (Japan)-artwork.png')) {
        if (rename($imageDir . '/Berlin no Kabe-artwork.png', $imageDir . '/Berlin no Kabe (Japan)-artwork.png')) {
            echo "✓ Berlin no Kabe-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Berlin no Kabe (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Berlin no Kabe → Berlin no Kabe (Japan)
if (file_exists($imageDir . '/Berlin no Kabe-cover.png')) {
    if (!file_exists($imageDir . '/Berlin no Kabe (Japan)-cover.png')) {
        if (rename($imageDir . '/Berlin no Kabe-cover.png', $imageDir . '/Berlin no Kabe (Japan)-cover.png')) {
            echo "✓ Berlin no Kabe-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Berlin no Kabe (Japan)-cover.png\n";
        $skipped++;
    }
}

// Berlin no Kabe → Berlin no Kabe (Japan)
if (file_exists($imageDir . '/Berlin no Kabe-gameplay.png')) {
    if (!file_exists($imageDir . '/Berlin no Kabe (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Berlin no Kabe-gameplay.png', $imageDir . '/Berlin no Kabe (Japan)-gameplay.png')) {
            echo "✓ Berlin no Kabe-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Berlin no Kabe (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Bram Stoker's Dracula → Bram Stoker's Dracula (USA)
if (file_exists($imageDir . '/Bram Stoker\'s Dracula-artwork.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula (USA)-artwork.png')) {
        if (rename($imageDir . '/Bram Stoker\'s Dracula-artwork.png', $imageDir . '/Bram Stoker\'s Dracula (USA)-artwork.png')) {
            echo "✓ Bram Stoker\'s Dracula-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bram Stoker\'s Dracula (USA)-artwork.png\n";
        $skipped++;
    }
}

// Bram Stoker's Dracula → Bram Stoker's Dracula (USA)
if (file_exists($imageDir . '/Bram Stoker\'s Dracula-cover.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula (USA)-cover.png')) {
        if (rename($imageDir . '/Bram Stoker\'s Dracula-cover.png', $imageDir . '/Bram Stoker\'s Dracula (USA)-cover.png')) {
            echo "✓ Bram Stoker\'s Dracula-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bram Stoker\'s Dracula (USA)-cover.png\n";
        $skipped++;
    }
}

// Bram Stoker's Dracula → Bram Stoker's Dracula (USA)
if (file_exists($imageDir . '/Bram Stoker\'s Dracula-gameplay.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula (USA)-gameplay.png')) {
        if (rename($imageDir . '/Bram Stoker\'s Dracula-gameplay.png', $imageDir . '/Bram Stoker\'s Dracula (USA)-gameplay.png')) {
            echo "✓ Bram Stoker\'s Dracula-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bram Stoker\'s Dracula (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Bubble Bobble → Bubble Bobble (USA)
if (file_exists($imageDir . '/Bubble Bobble-artwork.png')) {
    if (!file_exists($imageDir . '/Bubble Bobble (USA)-artwork.png')) {
        if (rename($imageDir . '/Bubble Bobble-artwork.png', $imageDir . '/Bubble Bobble (USA)-artwork.png')) {
            echo "✓ Bubble Bobble-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bubble Bobble (USA)-artwork.png\n";
        $skipped++;
    }
}

// Bubble Bobble → Bubble Bobble (USA)
if (file_exists($imageDir . '/Bubble Bobble-cover.png')) {
    if (!file_exists($imageDir . '/Bubble Bobble (USA)-cover.png')) {
        if (rename($imageDir . '/Bubble Bobble-cover.png', $imageDir . '/Bubble Bobble (USA)-cover.png')) {
            echo "✓ Bubble Bobble-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bubble Bobble (USA)-cover.png\n";
        $skipped++;
    }
}

// Bubble Bobble → Bubble Bobble (USA)
if (file_exists($imageDir . '/Bubble Bobble-gameplay.png')) {
    if (!file_exists($imageDir . '/Bubble Bobble (USA)-gameplay.png')) {
        if (rename($imageDir . '/Bubble Bobble-gameplay.png', $imageDir . '/Bubble Bobble (USA)-gameplay.png')) {
            echo "✓ Bubble Bobble-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bubble Bobble (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Bugs Bunny in Double Trouble → Bugs Bunny in Double Trouble (USA, Europe)
if (file_exists($imageDir . '/Bugs Bunny in Double Trouble-artwork.png')) {
    if (!file_exists($imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Bugs Bunny in Double Trouble-artwork.png', $imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-artwork.png')) {
            echo "✓ Bugs Bunny in Double Trouble-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bugs Bunny in Double Trouble (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Bugs Bunny in Double Trouble → Bugs Bunny in Double Trouble (USA, Europe)
if (file_exists($imageDir . '/Bugs Bunny in Double Trouble-cover.png')) {
    if (!file_exists($imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Bugs Bunny in Double Trouble-cover.png', $imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-cover.png')) {
            echo "✓ Bugs Bunny in Double Trouble-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bugs Bunny in Double Trouble (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Bugs Bunny in Double Trouble → Bugs Bunny in Double Trouble (USA, Europe)
if (file_exists($imageDir . '/Bugs Bunny in Double Trouble-gameplay.png')) {
    if (!file_exists($imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Bugs Bunny in Double Trouble-gameplay.png', $imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-gameplay.png')) {
            echo "✓ Bugs Bunny in Double Trouble-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bugs Bunny in Double Trouble (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Bust-A-Move → Bust-A-Move (USA)
if (file_exists($imageDir . '/Bust-A-Move-artwork.png')) {
    if (!file_exists($imageDir . '/Bust-A-Move (USA)-artwork.png')) {
        if (rename($imageDir . '/Bust-A-Move-artwork.png', $imageDir . '/Bust-A-Move (USA)-artwork.png')) {
            echo "✓ Bust-A-Move-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bust-A-Move (USA)-artwork.png\n";
        $skipped++;
    }
}

// Bust-A-Move → Bust-A-Move (USA)
if (file_exists($imageDir . '/Bust-A-Move-cover.png')) {
    if (!file_exists($imageDir . '/Bust-A-Move (USA)-cover.png')) {
        if (rename($imageDir . '/Bust-A-Move-cover.png', $imageDir . '/Bust-A-Move (USA)-cover.png')) {
            echo "✓ Bust-A-Move-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bust-A-Move (USA)-cover.png\n";
        $skipped++;
    }
}

// Bust-A-Move → Bust-A-Move (USA)
if (file_exists($imageDir . '/Bust-A-Move-gameplay.png')) {
    if (!file_exists($imageDir . '/Bust-A-Move (USA)-gameplay.png')) {
        if (rename($imageDir . '/Bust-A-Move-gameplay.png', $imageDir . '/Bust-A-Move (USA)-gameplay.png')) {
            echo "✓ Bust-A-Move-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bust-A-Move (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Buster Ball → Buster Ball (Japan)
if (file_exists($imageDir . '/Buster Ball-artwork.png')) {
    if (!file_exists($imageDir . '/Buster Ball (Japan)-artwork.png')) {
        if (rename($imageDir . '/Buster Ball-artwork.png', $imageDir . '/Buster Ball (Japan)-artwork.png')) {
            echo "✓ Buster Ball-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Ball (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Buster Ball → Buster Ball (Japan)
if (file_exists($imageDir . '/Buster Ball-cover.png')) {
    if (!file_exists($imageDir . '/Buster Ball (Japan)-cover.png')) {
        if (rename($imageDir . '/Buster Ball-cover.png', $imageDir . '/Buster Ball (Japan)-cover.png')) {
            echo "✓ Buster Ball-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Ball (Japan)-cover.png\n";
        $skipped++;
    }
}

// Buster Ball → Buster Ball (Japan)
if (file_exists($imageDir . '/Buster Ball-gameplay.png')) {
    if (!file_exists($imageDir . '/Buster Ball (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Buster Ball-gameplay.png', $imageDir . '/Buster Ball (Japan)-gameplay.png')) {
            echo "✓ Buster Ball-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Ball (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Buster Fight → Buster Fight (Japan)
if (file_exists($imageDir . '/Buster Fight-artwork.png')) {
    if (!file_exists($imageDir . '/Buster Fight (Japan)-artwork.png')) {
        if (rename($imageDir . '/Buster Fight-artwork.png', $imageDir . '/Buster Fight (Japan)-artwork.png')) {
            echo "✓ Buster Fight-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Fight (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Buster Fight → Buster Fight (Japan)
if (file_exists($imageDir . '/Buster Fight-cover.png')) {
    if (!file_exists($imageDir . '/Buster Fight (Japan)-cover.png')) {
        if (rename($imageDir . '/Buster Fight-cover.png', $imageDir . '/Buster Fight (Japan)-cover.png')) {
            echo "✓ Buster Fight-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Fight (Japan)-cover.png\n";
        $skipped++;
    }
}

// Buster Fight → Buster Fight (Japan)
if (file_exists($imageDir . '/Buster Fight-gameplay.png')) {
    if (!file_exists($imageDir . '/Buster Fight (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Buster Fight-gameplay.png', $imageDir . '/Buster Fight (Japan)-gameplay.png')) {
            echo "✓ Buster Fight-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Fight (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// CJ Elephant Fugitive → CJ Elephant Fugitive (USA, Europe)
if (file_exists($imageDir . '/CJ Elephant Fugitive-artwork.png')) {
    if (!file_exists($imageDir . '/CJ Elephant Fugitive (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/CJ Elephant Fugitive-artwork.png', $imageDir . '/CJ Elephant Fugitive (USA, Europe)-artwork.png')) {
            echo "✓ CJ Elephant Fugitive-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CJ Elephant Fugitive (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// CJ Elephant Fugitive → CJ Elephant Fugitive (USA, Europe)
if (file_exists($imageDir . '/CJ Elephant Fugitive-cover.png')) {
    if (!file_exists($imageDir . '/CJ Elephant Fugitive (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/CJ Elephant Fugitive-cover.png', $imageDir . '/CJ Elephant Fugitive (USA, Europe)-cover.png')) {
            echo "✓ CJ Elephant Fugitive-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CJ Elephant Fugitive (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// CJ Elephant Fugitive → CJ Elephant Fugitive (USA, Europe)
if (file_exists($imageDir . '/CJ Elephant Fugitive-gameplay.png')) {
    if (!file_exists($imageDir . '/CJ Elephant Fugitive (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/CJ Elephant Fugitive-gameplay.png', $imageDir . '/CJ Elephant Fugitive (USA, Europe)-gameplay.png')) {
            echo "✓ CJ Elephant Fugitive-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CJ Elephant Fugitive (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Caesars Palace → Caesars Palace (USA)
if (file_exists($imageDir . '/Caesars Palace-artwork.png')) {
    if (!file_exists($imageDir . '/Caesars Palace (USA)-artwork.png')) {
        if (rename($imageDir . '/Caesars Palace-artwork.png', $imageDir . '/Caesars Palace (USA)-artwork.png')) {
            echo "✓ Caesars Palace-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Caesars Palace (USA)-artwork.png\n";
        $skipped++;
    }
}

// Caesars Palace → Caesars Palace (USA)
if (file_exists($imageDir . '/Caesars Palace-cover.png')) {
    if (!file_exists($imageDir . '/Caesars Palace (USA)-cover.png')) {
        if (rename($imageDir . '/Caesars Palace-cover.png', $imageDir . '/Caesars Palace (USA)-cover.png')) {
            echo "✓ Caesars Palace-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Caesars Palace (USA)-cover.png\n";
        $skipped++;
    }
}

// Caesars Palace → Caesars Palace (USA)
if (file_exists($imageDir . '/Caesars Palace-gameplay.png')) {
    if (!file_exists($imageDir . '/Caesars Palace (USA)-gameplay.png')) {
        if (rename($imageDir . '/Caesars Palace-gameplay.png', $imageDir . '/Caesars Palace (USA)-gameplay.png')) {
            echo "✓ Caesars Palace-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Caesars Palace (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Captain America and the Avengers → Captain America and the Avengers (USA)
if (file_exists($imageDir . '/Captain America and the Avengers-artwork.png')) {
    if (!file_exists($imageDir . '/Captain America and the Avengers (USA)-artwork.png')) {
        if (rename($imageDir . '/Captain America and the Avengers-artwork.png', $imageDir . '/Captain America and the Avengers (USA)-artwork.png')) {
            echo "✓ Captain America and the Avengers-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Captain America and the Avengers (USA)-artwork.png\n";
        $skipped++;
    }
}

// Captain America and the Avengers → Captain America and the Avengers (USA)
if (file_exists($imageDir . '/Captain America and the Avengers-cover.png')) {
    if (!file_exists($imageDir . '/Captain America and the Avengers (USA)-cover.png')) {
        if (rename($imageDir . '/Captain America and the Avengers-cover.png', $imageDir . '/Captain America and the Avengers (USA)-cover.png')) {
            echo "✓ Captain America and the Avengers-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Captain America and the Avengers (USA)-cover.png\n";
        $skipped++;
    }
}

// Captain America and the Avengers → Captain America and the Avengers (USA)
if (file_exists($imageDir . '/Captain America and the Avengers-gameplay.png')) {
    if (!file_exists($imageDir . '/Captain America and the Avengers (USA)-gameplay.png')) {
        if (rename($imageDir . '/Captain America and the Avengers-gameplay.png', $imageDir . '/Captain America and the Avengers (USA)-gameplay.png')) {
            echo "✓ Captain America and the Avengers-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Captain America and the Avengers (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Car Licence → Car Licence (Japan)
if (file_exists($imageDir . '/Car Licence-artwork.png')) {
    if (!file_exists($imageDir . '/Car Licence (Japan)-artwork.png')) {
        if (rename($imageDir . '/Car Licence-artwork.png', $imageDir . '/Car Licence (Japan)-artwork.png')) {
            echo "✓ Car Licence-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Car Licence (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Car Licence → Car Licence (Japan)
if (file_exists($imageDir . '/Car Licence-cover.png')) {
    if (!file_exists($imageDir . '/Car Licence (Japan)-cover.png')) {
        if (rename($imageDir . '/Car Licence-cover.png', $imageDir . '/Car Licence (Japan)-cover.png')) {
            echo "✓ Car Licence-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Car Licence (Japan)-cover.png\n";
        $skipped++;
    }
}

// Car Licence → Car Licence (Japan)
if (file_exists($imageDir . '/Car Licence-gameplay.png')) {
    if (!file_exists($imageDir . '/Car Licence (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Car Licence-gameplay.png', $imageDir . '/Car Licence (Japan)-gameplay.png')) {
            echo "✓ Car Licence-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Car Licence (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Casino FunPak → Casino FunPak (USA)
if (file_exists($imageDir . '/Casino FunPak-artwork.png')) {
    if (!file_exists($imageDir . '/Casino FunPak (USA)-artwork.png')) {
        if (rename($imageDir . '/Casino FunPak-artwork.png', $imageDir . '/Casino FunPak (USA)-artwork.png')) {
            echo "✓ Casino FunPak-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Casino FunPak (USA)-artwork.png\n";
        $skipped++;
    }
}

// Casino FunPak → Casino FunPak (USA)
if (file_exists($imageDir . '/Casino FunPak-cover.png')) {
    if (!file_exists($imageDir . '/Casino FunPak (USA)-cover.png')) {
        if (rename($imageDir . '/Casino FunPak-cover.png', $imageDir . '/Casino FunPak (USA)-cover.png')) {
            echo "✓ Casino FunPak-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Casino FunPak (USA)-cover.png\n";
        $skipped++;
    }
}

// Casino FunPak → Casino FunPak (USA)
if (file_exists($imageDir . '/Casino FunPak-gameplay.png')) {
    if (!file_exists($imageDir . '/Casino FunPak (USA)-gameplay.png')) {
        if (rename($imageDir . '/Casino FunPak-gameplay.png', $imageDir . '/Casino FunPak (USA)-gameplay.png')) {
            echo "✓ Casino FunPak-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Casino FunPak (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Castle of Illusion Starring Mickey Mouse → Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)
if (file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse-artwork.png')) {
    if (!file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-artwork.png')) {
        if (rename($imageDir . '/Castle of Illusion Starring Mickey Mouse-artwork.png', $imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-artwork.png')) {
            echo "✓ Castle of Illusion Starring Mickey Mouse-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-artwork.png\n";
        $skipped++;
    }
}

// Castle of Illusion Starring Mickey Mouse → Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)
if (file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse-cover.png')) {
    if (!file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png')) {
        if (rename($imageDir . '/Castle of Illusion Starring Mickey Mouse-cover.png', $imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png')) {
            echo "✓ Castle of Illusion Starring Mickey Mouse-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Castle of Illusion Starring Mickey Mouse → Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)
if (file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse-gameplay.png')) {
    if (!file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/Castle of Illusion Starring Mickey Mouse-gameplay.png', $imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png')) {
            echo "✓ Castle of Illusion Starring Mickey Mouse-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// Championship Hockey → Championship Hockey (Europe)
if (file_exists($imageDir . '/Championship Hockey-artwork.png')) {
    if (!file_exists($imageDir . '/Championship Hockey (Europe)-artwork.png')) {
        if (rename($imageDir . '/Championship Hockey-artwork.png', $imageDir . '/Championship Hockey (Europe)-artwork.png')) {
            echo "✓ Championship Hockey-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Championship Hockey (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Championship Hockey → Championship Hockey (Europe)
if (file_exists($imageDir . '/Championship Hockey-cover.png')) {
    if (!file_exists($imageDir . '/Championship Hockey (Europe)-cover.png')) {
        if (rename($imageDir . '/Championship Hockey-cover.png', $imageDir . '/Championship Hockey (Europe)-cover.png')) {
            echo "✓ Championship Hockey-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Championship Hockey (Europe)-cover.png\n";
        $skipped++;
    }
}

// Championship Hockey → Championship Hockey (Europe)
if (file_exists($imageDir . '/Championship Hockey-gameplay.png')) {
    if (!file_exists($imageDir . '/Championship Hockey (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Championship Hockey-gameplay.png', $imageDir . '/Championship Hockey (Europe)-gameplay.png')) {
            echo "✓ Championship Hockey-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Championship Hockey (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Cheese Cat-Astrophe Starring Speedy Gonzales → Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)
if (file_exists($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-artwork.png')) {
    if (!file_exists($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)-artwork.png')) {
        if (rename($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-artwork.png', $imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)-artwork.png')) {
            echo "✓ Cheese Cat-Astrophe Starring Speedy Gonzales-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)-artwork.png\n";
        $skipped++;
    }
}

// Cheese Cat-Astrophe Starring Speedy Gonzales → Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)
if (file_exists($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-cover.png')) {
    if (!file_exists($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)-cover.png')) {
        if (rename($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-cover.png', $imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)-cover.png')) {
            echo "✓ Cheese Cat-Astrophe Starring Speedy Gonzales-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)-cover.png\n";
        $skipped++;
    }
}

// Cheese Cat-Astrophe Starring Speedy Gonzales → Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)
if (file_exists($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-gameplay.png')) {
    if (!file_exists($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)-gameplay.png')) {
        if (rename($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-gameplay.png', $imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)-gameplay.png')) {
            echo "✓ Cheese Cat-Astrophe Starring Speedy Gonzales-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cheese Cat-Astrophe Starring Speedy Gonzales (USA, Europe, Brazil) (En,Fr,De,Es)-gameplay.png\n";
        $skipped++;
    }
}

// Chicago Syndicate → Chicago Syndicate (USA, Brazil)
if (file_exists($imageDir . '/Chicago Syndicate-cover.png')) {
    if (!file_exists($imageDir . '/Chicago Syndicate (USA, Brazil)-cover.png')) {
        if (rename($imageDir . '/Chicago Syndicate-cover.png', $imageDir . '/Chicago Syndicate (USA, Brazil)-cover.png')) {
            echo "✓ Chicago Syndicate-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chicago Syndicate (USA, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Chicago Syndicate → Chicago Syndicate (USA, Brazil)
if (file_exists($imageDir . '/Chicago Syndicate-gameplay.png')) {
    if (!file_exists($imageDir . '/Chicago Syndicate (USA, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/Chicago Syndicate-gameplay.png', $imageDir . '/Chicago Syndicate (USA, Brazil)-gameplay.png')) {
            echo "✓ Chicago Syndicate-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chicago Syndicate (USA, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// Choplifter III → Choplifter III (USA)
if (file_exists($imageDir . '/Choplifter III-artwork.png')) {
    if (!file_exists($imageDir . '/Choplifter III (USA)-artwork.png')) {
        if (rename($imageDir . '/Choplifter III-artwork.png', $imageDir . '/Choplifter III (USA)-artwork.png')) {
            echo "✓ Choplifter III-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Choplifter III (USA)-artwork.png\n";
        $skipped++;
    }
}

// Choplifter III → Choplifter III (USA)
if (file_exists($imageDir . '/Choplifter III-cover.png')) {
    if (!file_exists($imageDir . '/Choplifter III (USA)-cover.png')) {
        if (rename($imageDir . '/Choplifter III-cover.png', $imageDir . '/Choplifter III (USA)-cover.png')) {
            echo "✓ Choplifter III-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Choplifter III (USA)-cover.png\n";
        $skipped++;
    }
}

// Choplifter III → Choplifter III (USA)
if (file_exists($imageDir . '/Choplifter III-gameplay.png')) {
    if (!file_exists($imageDir . '/Choplifter III (USA)-gameplay.png')) {
        if (rename($imageDir . '/Choplifter III-gameplay.png', $imageDir . '/Choplifter III (USA)-gameplay.png')) {
            echo "✓ Choplifter III-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Choplifter III (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck → Chuck Rock II - Son of Chuck (USA)
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck-artwork.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck (USA)-artwork.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck-artwork.png', $imageDir . '/Chuck Rock II - Son of Chuck (USA)-artwork.png')) {
            echo "✓ Chuck Rock II - Son of Chuck-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck (USA)-artwork.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck → Chuck Rock II - Son of Chuck (USA)
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck-cover.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck (USA)-cover.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck-cover.png', $imageDir . '/Chuck Rock II - Son of Chuck (USA)-cover.png')) {
            echo "✓ Chuck Rock II - Son of Chuck-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck (USA)-cover.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck → Chuck Rock II - Son of Chuck (USA)
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck-gameplay.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck (USA)-gameplay.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck-gameplay.png', $imageDir . '/Chuck Rock II - Son of Chuck (USA)-gameplay.png')) {
            echo "✓ Chuck Rock II - Son of Chuck-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Chuck Rock → Chuck Rock (World)
if (file_exists($imageDir . '/Chuck Rock-artwork.png')) {
    if (!file_exists($imageDir . '/Chuck Rock (World)-artwork.png')) {
        if (rename($imageDir . '/Chuck Rock-artwork.png', $imageDir . '/Chuck Rock (World)-artwork.png')) {
            echo "✓ Chuck Rock-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock (World)-artwork.png\n";
        $skipped++;
    }
}

// Chuck Rock → Chuck Rock (World)
if (file_exists($imageDir . '/Chuck Rock-cover.png')) {
    if (!file_exists($imageDir . '/Chuck Rock (World)-cover.png')) {
        if (rename($imageDir . '/Chuck Rock-cover.png', $imageDir . '/Chuck Rock (World)-cover.png')) {
            echo "✓ Chuck Rock-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock (World)-cover.png\n";
        $skipped++;
    }
}

// Chuck Rock → Chuck Rock (World)
if (file_exists($imageDir . '/Chuck Rock-gameplay.png')) {
    if (!file_exists($imageDir . '/Chuck Rock (World)-gameplay.png')) {
        if (rename($imageDir . '/Chuck Rock-gameplay.png', $imageDir . '/Chuck Rock (World)-gameplay.png')) {
            echo "✓ Chuck Rock-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock (World)-gameplay.png\n";
        $skipped++;
    }
}

// Cliffhanger → Cliffhanger (USA)
if (file_exists($imageDir . '/Cliffhanger-artwork.png')) {
    if (!file_exists($imageDir . '/Cliffhanger (USA)-artwork.png')) {
        if (rename($imageDir . '/Cliffhanger-artwork.png', $imageDir . '/Cliffhanger (USA)-artwork.png')) {
            echo "✓ Cliffhanger-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cliffhanger (USA)-artwork.png\n";
        $skipped++;
    }
}

// Cliffhanger → Cliffhanger (USA)
if (file_exists($imageDir . '/Cliffhanger-cover.png')) {
    if (!file_exists($imageDir . '/Cliffhanger (USA)-cover.png')) {
        if (rename($imageDir . '/Cliffhanger-cover.png', $imageDir . '/Cliffhanger (USA)-cover.png')) {
            echo "✓ Cliffhanger-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cliffhanger (USA)-cover.png\n";
        $skipped++;
    }
}

// Cliffhanger → Cliffhanger (USA)
if (file_exists($imageDir . '/Cliffhanger-gameplay.png')) {
    if (!file_exists($imageDir . '/Cliffhanger (USA)-gameplay.png')) {
        if (rename($imageDir . '/Cliffhanger-gameplay.png', $imageDir . '/Cliffhanger (USA)-gameplay.png')) {
            echo "✓ Cliffhanger-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cliffhanger (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Clutch Hitter → Clutch Hitter (USA)
if (file_exists($imageDir . '/Clutch Hitter-artwork.png')) {
    if (!file_exists($imageDir . '/Clutch Hitter (USA)-artwork.png')) {
        if (rename($imageDir . '/Clutch Hitter-artwork.png', $imageDir . '/Clutch Hitter (USA)-artwork.png')) {
            echo "✓ Clutch Hitter-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Clutch Hitter (USA)-artwork.png\n";
        $skipped++;
    }
}

// Clutch Hitter → Clutch Hitter (USA)
if (file_exists($imageDir . '/Clutch Hitter-cover.png')) {
    if (!file_exists($imageDir . '/Clutch Hitter (USA)-cover.png')) {
        if (rename($imageDir . '/Clutch Hitter-cover.png', $imageDir . '/Clutch Hitter (USA)-cover.png')) {
            echo "✓ Clutch Hitter-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Clutch Hitter (USA)-cover.png\n";
        $skipped++;
    }
}

// Clutch Hitter → Clutch Hitter (USA)
if (file_exists($imageDir . '/Clutch Hitter-gameplay.png')) {
    if (!file_exists($imageDir . '/Clutch Hitter (USA)-gameplay.png')) {
        if (rename($imageDir . '/Clutch Hitter-gameplay.png', $imageDir . '/Clutch Hitter (USA)-gameplay.png')) {
            echo "✓ Clutch Hitter-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Clutch Hitter (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Cool Spot → Cool Spot (USA)
if (file_exists($imageDir . '/Cool Spot-artwork.png')) {
    if (!file_exists($imageDir . '/Cool Spot (USA)-artwork.png')) {
        if (rename($imageDir . '/Cool Spot-artwork.png', $imageDir . '/Cool Spot (USA)-artwork.png')) {
            echo "✓ Cool Spot-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cool Spot (USA)-artwork.png\n";
        $skipped++;
    }
}

// Cool Spot → Cool Spot (USA)
if (file_exists($imageDir . '/Cool Spot-cover.png')) {
    if (!file_exists($imageDir . '/Cool Spot (USA)-cover.png')) {
        if (rename($imageDir . '/Cool Spot-cover.png', $imageDir . '/Cool Spot (USA)-cover.png')) {
            echo "✓ Cool Spot-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cool Spot (USA)-cover.png\n";
        $skipped++;
    }
}

// Cool Spot → Cool Spot (USA)
if (file_exists($imageDir . '/Cool Spot-gameplay.png')) {
    if (!file_exists($imageDir . '/Cool Spot (USA)-gameplay.png')) {
        if (rename($imageDir . '/Cool Spot-gameplay.png', $imageDir . '/Cool Spot (USA)-gameplay.png')) {
            echo "✓ Cool Spot-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cool Spot (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Crayon Shin-chan - Taiketsu! Kantam Panic!! → Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)
if (file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-artwork.png')) {
    if (!file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)-artwork.png')) {
        if (rename($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-artwork.png', $imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)-artwork.png')) {
            echo "✓ Crayon Shin-chan - Taiketsu! Kantam Panic!!-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Crayon Shin-chan - Taiketsu! Kantam Panic!! → Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)
if (file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-cover.png')) {
    if (!file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)-cover.png')) {
        if (rename($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-cover.png', $imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)-cover.png')) {
            echo "✓ Crayon Shin-chan - Taiketsu! Kantam Panic!!-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)-cover.png\n";
        $skipped++;
    }
}

// Crayon Shin-chan - Taiketsu! Kantam Panic!! → Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)
if (file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-gameplay.png')) {
    if (!file_exists($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!!-gameplay.png', $imageDir . '/Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)-gameplay.png')) {
            echo "✓ Crayon Shin-chan - Taiketsu! Kantam Panic!!-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Crayon Shin-chan - Taiketsu! Kantam Panic!! (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// CutThroat Island → CutThroat Island (USA)
if (file_exists($imageDir . '/CutThroat Island-artwork.png')) {
    if (!file_exists($imageDir . '/CutThroat Island (USA)-artwork.png')) {
        if (rename($imageDir . '/CutThroat Island-artwork.png', $imageDir . '/CutThroat Island (USA)-artwork.png')) {
            echo "✓ CutThroat Island-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CutThroat Island (USA)-artwork.png\n";
        $skipped++;
    }
}

// CutThroat Island → CutThroat Island (USA)
if (file_exists($imageDir . '/CutThroat Island-cover.png')) {
    if (!file_exists($imageDir . '/CutThroat Island (USA)-cover.png')) {
        if (rename($imageDir . '/CutThroat Island-cover.png', $imageDir . '/CutThroat Island (USA)-cover.png')) {
            echo "✓ CutThroat Island-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CutThroat Island (USA)-cover.png\n";
        $skipped++;
    }
}

// CutThroat Island → CutThroat Island (USA)
if (file_exists($imageDir . '/CutThroat Island-gameplay.png')) {
    if (!file_exists($imageDir . '/CutThroat Island (USA)-gameplay.png')) {
        if (rename($imageDir . '/CutThroat Island-gameplay.png', $imageDir . '/CutThroat Island (USA)-gameplay.png')) {
            echo "✓ CutThroat Island-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CutThroat Island (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Deep Duck Trouble Starring Donald Duck → Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)
if (file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck-artwork.png')) {
    if (!file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-artwork.png')) {
        if (rename($imageDir . '/Deep Duck Trouble Starring Donald Duck-artwork.png', $imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-artwork.png')) {
            echo "✓ Deep Duck Trouble Starring Donald Duck-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-artwork.png\n";
        $skipped++;
    }
}

// Deep Duck Trouble Starring Donald Duck → Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)
if (file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck-cover.png')) {
    if (!file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-cover.png')) {
        if (rename($imageDir . '/Deep Duck Trouble Starring Donald Duck-cover.png', $imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-cover.png')) {
            echo "✓ Deep Duck Trouble Starring Donald Duck-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-cover.png\n";
        $skipped++;
    }
}

// Deep Duck Trouble Starring Donald Duck → Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)
if (file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck-gameplay.png')) {
    if (!file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-gameplay.png')) {
        if (rename($imageDir . '/Deep Duck Trouble Starring Donald Duck-gameplay.png', $imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-gameplay.png')) {
            echo "✓ Deep Duck Trouble Starring Donald Duck-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-gameplay.png\n";
        $skipped++;
    }
}

// Defenders of Oasis → Defenders of Oasis (USA, Europe)
if (file_exists($imageDir . '/Defenders of Oasis-artwork.png')) {
    if (!file_exists($imageDir . '/Defenders of Oasis (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Defenders of Oasis-artwork.png', $imageDir . '/Defenders of Oasis (USA, Europe)-artwork.png')) {
            echo "✓ Defenders of Oasis-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Defenders of Oasis (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Defenders of Oasis → Defenders of Oasis (USA, Europe)
if (file_exists($imageDir . '/Defenders of Oasis-cover.png')) {
    if (!file_exists($imageDir . '/Defenders of Oasis (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Defenders of Oasis-cover.png', $imageDir . '/Defenders of Oasis (USA, Europe)-cover.png')) {
            echo "✓ Defenders of Oasis-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Defenders of Oasis (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Defenders of Oasis → Defenders of Oasis (USA, Europe)
if (file_exists($imageDir . '/Defenders of Oasis-gameplay.png')) {
    if (!file_exists($imageDir . '/Defenders of Oasis (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Defenders of Oasis-gameplay.png', $imageDir . '/Defenders of Oasis (USA, Europe)-gameplay.png')) {
            echo "✓ Defenders of Oasis-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Defenders of Oasis (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E. Coyote → Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-artwork.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)-artwork.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-artwork.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)-artwork.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E. Coyote-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)-artwork.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E. Coyote → Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)-cover.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)-cover.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E. Coyote → Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)-gameplay.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Speedtrap Starring Road Runner and Wile E. Coyote (USA, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// Desert Strike - Return to the Gulf → Desert Strike - Return to the Gulf (USA)
if (file_exists($imageDir . '/Desert Strike - Return to the Gulf-artwork.png')) {
    if (!file_exists($imageDir . '/Desert Strike - Return to the Gulf (USA)-artwork.png')) {
        if (rename($imageDir . '/Desert Strike - Return to the Gulf-artwork.png', $imageDir . '/Desert Strike - Return to the Gulf (USA)-artwork.png')) {
            echo "✓ Desert Strike - Return to the Gulf-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Strike - Return to the Gulf (USA)-artwork.png\n";
        $skipped++;
    }
}

// Desert Strike - Return to the Gulf → Desert Strike - Return to the Gulf (USA)
if (file_exists($imageDir . '/Desert Strike - Return to the Gulf-cover.png')) {
    if (!file_exists($imageDir . '/Desert Strike - Return to the Gulf (USA)-cover.png')) {
        if (rename($imageDir . '/Desert Strike - Return to the Gulf-cover.png', $imageDir . '/Desert Strike - Return to the Gulf (USA)-cover.png')) {
            echo "✓ Desert Strike - Return to the Gulf-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Strike - Return to the Gulf (USA)-cover.png\n";
        $skipped++;
    }
}

// Desert Strike - Return to the Gulf → Desert Strike - Return to the Gulf (USA)
if (file_exists($imageDir . '/Desert Strike - Return to the Gulf-gameplay.png')) {
    if (!file_exists($imageDir . '/Desert Strike - Return to the Gulf (USA)-gameplay.png')) {
        if (rename($imageDir . '/Desert Strike - Return to the Gulf-gameplay.png', $imageDir . '/Desert Strike - Return to the Gulf (USA)-gameplay.png')) {
            echo "✓ Desert Strike - Return to the Gulf-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Strike - Return to the Gulf (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Devilish → Devilish (USA)
if (file_exists($imageDir . '/Devilish-artwork.png')) {
    if (!file_exists($imageDir . '/Devilish (USA)-artwork.png')) {
        if (rename($imageDir . '/Devilish-artwork.png', $imageDir . '/Devilish (USA)-artwork.png')) {
            echo "✓ Devilish-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Devilish (USA)-artwork.png\n";
        $skipped++;
    }
}

// Devilish → Devilish (USA)
if (file_exists($imageDir . '/Devilish-cover.png')) {
    if (!file_exists($imageDir . '/Devilish (USA)-cover.png')) {
        if (rename($imageDir . '/Devilish-cover.png', $imageDir . '/Devilish (USA)-cover.png')) {
            echo "✓ Devilish-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Devilish (USA)-cover.png\n";
        $skipped++;
    }
}

// Devilish → Devilish (USA)
if (file_exists($imageDir . '/Devilish-gameplay.png')) {
    if (!file_exists($imageDir . '/Devilish (USA)-gameplay.png')) {
        if (rename($imageDir . '/Devilish-gameplay.png', $imageDir . '/Devilish (USA)-gameplay.png')) {
            echo "✓ Devilish-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Devilish (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Donald Duck no 4-Tsu no Hihou → Donald Duck no 4-Tsu no Hihou (Japan)
if (file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou-artwork.png')) {
    if (!file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-artwork.png')) {
        if (rename($imageDir . '/Donald Duck no 4-Tsu no Hihou-artwork.png', $imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-artwork.png')) {
            echo "✓ Donald Duck no 4-Tsu no Hihou-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no 4-Tsu no Hihou (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Donald Duck no 4-Tsu no Hihou → Donald Duck no 4-Tsu no Hihou (Japan)
if (file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou-cover.png')) {
    if (!file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-cover.png')) {
        if (rename($imageDir . '/Donald Duck no 4-Tsu no Hihou-cover.png', $imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-cover.png')) {
            echo "✓ Donald Duck no 4-Tsu no Hihou-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no 4-Tsu no Hihou (Japan)-cover.png\n";
        $skipped++;
    }
}

// Donald Duck no 4-Tsu no Hihou → Donald Duck no 4-Tsu no Hihou (Japan)
if (file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou-gameplay.png')) {
    if (!file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Donald Duck no 4-Tsu no Hihou-gameplay.png', $imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-gameplay.png')) {
            echo "✓ Donald Duck no 4-Tsu no Hihou-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no 4-Tsu no Hihou (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Donald Duck no Lucky Dime → Donald Duck no Lucky Dime (Japan)
if (file_exists($imageDir . '/Donald Duck no Lucky Dime-artwork.png')) {
    if (!file_exists($imageDir . '/Donald Duck no Lucky Dime (Japan)-artwork.png')) {
        if (rename($imageDir . '/Donald Duck no Lucky Dime-artwork.png', $imageDir . '/Donald Duck no Lucky Dime (Japan)-artwork.png')) {
            echo "✓ Donald Duck no Lucky Dime-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no Lucky Dime (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Donald Duck no Lucky Dime → Donald Duck no Lucky Dime (Japan)
if (file_exists($imageDir . '/Donald Duck no Lucky Dime-cover.png')) {
    if (!file_exists($imageDir . '/Donald Duck no Lucky Dime (Japan)-cover.png')) {
        if (rename($imageDir . '/Donald Duck no Lucky Dime-cover.png', $imageDir . '/Donald Duck no Lucky Dime (Japan)-cover.png')) {
            echo "✓ Donald Duck no Lucky Dime-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no Lucky Dime (Japan)-cover.png\n";
        $skipped++;
    }
}

// Donald Duck no Lucky Dime → Donald Duck no Lucky Dime (Japan)
if (file_exists($imageDir . '/Donald Duck no Lucky Dime-gameplay.png')) {
    if (!file_exists($imageDir . '/Donald Duck no Lucky Dime (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Donald Duck no Lucky Dime-gameplay.png', $imageDir . '/Donald Duck no Lucky Dime (Japan)-gameplay.png')) {
            echo "✓ Donald Duck no Lucky Dime-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no Lucky Dime (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Donald no Magical World → Donald no Magical World (Japan) (En,Ja)
if (file_exists($imageDir . '/Donald no Magical World-artwork.png')) {
    if (!file_exists($imageDir . '/Donald no Magical World (Japan) (En,Ja)-artwork.png')) {
        if (rename($imageDir . '/Donald no Magical World-artwork.png', $imageDir . '/Donald no Magical World (Japan) (En,Ja)-artwork.png')) {
            echo "✓ Donald no Magical World-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald no Magical World (Japan) (En,Ja)-artwork.png\n";
        $skipped++;
    }
}

// Donald no Magical World → Donald no Magical World (Japan) (En,Ja)
if (file_exists($imageDir . '/Donald no Magical World-cover.png')) {
    if (!file_exists($imageDir . '/Donald no Magical World (Japan) (En,Ja)-cover.png')) {
        if (rename($imageDir . '/Donald no Magical World-cover.png', $imageDir . '/Donald no Magical World (Japan) (En,Ja)-cover.png')) {
            echo "✓ Donald no Magical World-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald no Magical World (Japan) (En,Ja)-cover.png\n";
        $skipped++;
    }
}

// Donald no Magical World → Donald no Magical World (Japan) (En,Ja)
if (file_exists($imageDir . '/Donald no Magical World-gameplay.png')) {
    if (!file_exists($imageDir . '/Donald no Magical World (Japan) (En,Ja)-gameplay.png')) {
        if (rename($imageDir . '/Donald no Magical World-gameplay.png', $imageDir . '/Donald no Magical World (Japan) (En,Ja)-gameplay.png')) {
            echo "✓ Donald no Magical World-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald no Magical World (Japan) (En,Ja)-gameplay.png\n";
        $skipped++;
    }
}

// Doraemon - Noranosuke no Yabou → Doraemon - Noranosuke no Yabou (Japan)
if (file_exists($imageDir . '/Doraemon - Noranosuke no Yabou-artwork.png')) {
    if (!file_exists($imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-artwork.png')) {
        if (rename($imageDir . '/Doraemon - Noranosuke no Yabou-artwork.png', $imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-artwork.png')) {
            echo "✓ Doraemon - Noranosuke no Yabou-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Noranosuke no Yabou (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Doraemon - Noranosuke no Yabou → Doraemon - Noranosuke no Yabou (Japan)
if (file_exists($imageDir . '/Doraemon - Noranosuke no Yabou-cover.png')) {
    if (!file_exists($imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-cover.png')) {
        if (rename($imageDir . '/Doraemon - Noranosuke no Yabou-cover.png', $imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-cover.png')) {
            echo "✓ Doraemon - Noranosuke no Yabou-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Noranosuke no Yabou (Japan)-cover.png\n";
        $skipped++;
    }
}

// Doraemon - Noranosuke no Yabou → Doraemon - Noranosuke no Yabou (Japan)
if (file_exists($imageDir . '/Doraemon - Noranosuke no Yabou-gameplay.png')) {
    if (!file_exists($imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Doraemon - Noranosuke no Yabou-gameplay.png', $imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-gameplay.png')) {
            echo "✓ Doraemon - Noranosuke no Yabou-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Noranosuke no Yabou (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Doraemon - Waku Waku Pocket Paradise → Doraemon - Waku Waku Pocket Paradise (Japan)
if (file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise-artwork.png')) {
    if (!file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-artwork.png')) {
        if (rename($imageDir . '/Doraemon - Waku Waku Pocket Paradise-artwork.png', $imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-artwork.png')) {
            echo "✓ Doraemon - Waku Waku Pocket Paradise-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Waku Waku Pocket Paradise (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Doraemon - Waku Waku Pocket Paradise → Doraemon - Waku Waku Pocket Paradise (Japan)
if (file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise-cover.png')) {
    if (!file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-cover.png')) {
        if (rename($imageDir . '/Doraemon - Waku Waku Pocket Paradise-cover.png', $imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-cover.png')) {
            echo "✓ Doraemon - Waku Waku Pocket Paradise-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Waku Waku Pocket Paradise (Japan)-cover.png\n";
        $skipped++;
    }
}

// Doraemon - Waku Waku Pocket Paradise → Doraemon - Waku Waku Pocket Paradise (Japan)
if (file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise-gameplay.png')) {
    if (!file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Doraemon - Waku Waku Pocket Paradise-gameplay.png', $imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-gameplay.png')) {
            echo "✓ Doraemon - Waku Waku Pocket Paradise-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Waku Waku Pocket Paradise (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Dr. Robotnik's Mean Bean Machine → Dr. Robotnik's Mean Bean Machine (USA, Europe)
if (file_exists($imageDir . '/Dr. Robotnik\'s Mean Bean Machine-artwork.png')) {
    if (!file_exists($imageDir . '/Dr. Robotnik\'s Mean Bean Machine (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Dr. Robotnik\'s Mean Bean Machine-artwork.png', $imageDir . '/Dr. Robotnik\'s Mean Bean Machine (USA, Europe)-artwork.png')) {
            echo "✓ Dr. Robotnik\'s Mean Bean Machine-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dr. Robotnik\'s Mean Bean Machine (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Dr. Robotnik's Mean Bean Machine → Dr. Robotnik's Mean Bean Machine (USA, Europe)
if (file_exists($imageDir . '/Dr. Robotnik\'s Mean Bean Machine-cover.png')) {
    if (!file_exists($imageDir . '/Dr. Robotnik\'s Mean Bean Machine (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Dr. Robotnik\'s Mean Bean Machine-cover.png', $imageDir . '/Dr. Robotnik\'s Mean Bean Machine (USA, Europe)-cover.png')) {
            echo "✓ Dr. Robotnik\'s Mean Bean Machine-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dr. Robotnik\'s Mean Bean Machine (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Dr. Robotnik's Mean Bean Machine → Dr. Robotnik's Mean Bean Machine (USA, Europe)
if (file_exists($imageDir . '/Dr. Robotnik\'s Mean Bean Machine-gameplay.png')) {
    if (!file_exists($imageDir . '/Dr. Robotnik\'s Mean Bean Machine (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Dr. Robotnik\'s Mean Bean Machine-gameplay.png', $imageDir . '/Dr. Robotnik\'s Mean Bean Machine (USA, Europe)-gameplay.png')) {
            echo "✓ Dr. Robotnik\'s Mean Bean Machine-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dr. Robotnik\'s Mean Bean Machine (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Dragon - The Bruce Lee Story → Dragon - The Bruce Lee Story (USA)
if (file_exists($imageDir . '/Dragon - The Bruce Lee Story-artwork.png')) {
    if (!file_exists($imageDir . '/Dragon - The Bruce Lee Story (USA)-artwork.png')) {
        if (rename($imageDir . '/Dragon - The Bruce Lee Story-artwork.png', $imageDir . '/Dragon - The Bruce Lee Story (USA)-artwork.png')) {
            echo "✓ Dragon - The Bruce Lee Story-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon - The Bruce Lee Story (USA)-artwork.png\n";
        $skipped++;
    }
}

// Dragon - The Bruce Lee Story → Dragon - The Bruce Lee Story (USA)
if (file_exists($imageDir . '/Dragon - The Bruce Lee Story-cover.png')) {
    if (!file_exists($imageDir . '/Dragon - The Bruce Lee Story (USA)-cover.png')) {
        if (rename($imageDir . '/Dragon - The Bruce Lee Story-cover.png', $imageDir . '/Dragon - The Bruce Lee Story (USA)-cover.png')) {
            echo "✓ Dragon - The Bruce Lee Story-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon - The Bruce Lee Story (USA)-cover.png\n";
        $skipped++;
    }
}

// Dragon - The Bruce Lee Story → Dragon - The Bruce Lee Story (USA)
if (file_exists($imageDir . '/Dragon - The Bruce Lee Story-gameplay.png')) {
    if (!file_exists($imageDir . '/Dragon - The Bruce Lee Story (USA)-gameplay.png')) {
        if (rename($imageDir . '/Dragon - The Bruce Lee Story-gameplay.png', $imageDir . '/Dragon - The Bruce Lee Story (USA)-gameplay.png')) {
            echo "✓ Dragon - The Bruce Lee Story-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon - The Bruce Lee Story (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Dragon Crystal - Tsurani no Meikyuu → Dragon Crystal - Tsurani no Meikyuu (Japan)
if (file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-artwork.png')) {
    if (!file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-artwork.png')) {
        if (rename($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-artwork.png', $imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-artwork.png')) {
            echo "✓ Dragon Crystal - Tsurani no Meikyuu-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon Crystal - Tsurani no Meikyuu (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Dragon Crystal - Tsurani no Meikyuu → Dragon Crystal - Tsurani no Meikyuu (Japan)
if (file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-cover.png')) {
    if (!file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-cover.png')) {
        if (rename($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-cover.png', $imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-cover.png')) {
            echo "✓ Dragon Crystal - Tsurani no Meikyuu-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon Crystal - Tsurani no Meikyuu (Japan)-cover.png\n";
        $skipped++;
    }
}

// Dragon Crystal - Tsurani no Meikyuu → Dragon Crystal - Tsurani no Meikyuu (Japan)
if (file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-gameplay.png')) {
    if (!file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-gameplay.png', $imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-gameplay.png')) {
            echo "✓ Dragon Crystal - Tsurani no Meikyuu-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon Crystal - Tsurani no Meikyuu (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Earthworm Jim → Earthworm Jim (USA)
if (file_exists($imageDir . '/Earthworm Jim-artwork.png')) {
    if (!file_exists($imageDir . '/Earthworm Jim (USA)-artwork.png')) {
        if (rename($imageDir . '/Earthworm Jim-artwork.png', $imageDir . '/Earthworm Jim (USA)-artwork.png')) {
            echo "✓ Earthworm Jim-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Earthworm Jim (USA)-artwork.png\n";
        $skipped++;
    }
}

// Earthworm Jim → Earthworm Jim (USA)
if (file_exists($imageDir . '/Earthworm Jim-cover.png')) {
    if (!file_exists($imageDir . '/Earthworm Jim (USA)-cover.png')) {
        if (rename($imageDir . '/Earthworm Jim-cover.png', $imageDir . '/Earthworm Jim (USA)-cover.png')) {
            echo "✓ Earthworm Jim-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Earthworm Jim (USA)-cover.png\n";
        $skipped++;
    }
}

// Earthworm Jim → Earthworm Jim (USA)
if (file_exists($imageDir . '/Earthworm Jim-gameplay.png')) {
    if (!file_exists($imageDir . '/Earthworm Jim (USA)-gameplay.png')) {
        if (rename($imageDir . '/Earthworm Jim-gameplay.png', $imageDir . '/Earthworm Jim (USA)-gameplay.png')) {
            echo "✓ Earthworm Jim-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Earthworm Jim (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Ecco The Dolphin → Ecco The Dolphin (Japan)
if (file_exists($imageDir . '/Ecco The Dolphin-artwork.png')) {
    if (!file_exists($imageDir . '/Ecco The Dolphin (Japan)-artwork.png')) {
        if (rename($imageDir . '/Ecco The Dolphin-artwork.png', $imageDir . '/Ecco The Dolphin (Japan)-artwork.png')) {
            echo "✓ Ecco The Dolphin-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco The Dolphin (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Ecco The Dolphin → Ecco The Dolphin (Japan)
if (file_exists($imageDir . '/Ecco The Dolphin-cover.png')) {
    if (!file_exists($imageDir . '/Ecco The Dolphin (Japan)-cover.png')) {
        if (rename($imageDir . '/Ecco The Dolphin-cover.png', $imageDir . '/Ecco The Dolphin (Japan)-cover.png')) {
            echo "✓ Ecco The Dolphin-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco The Dolphin (Japan)-cover.png\n";
        $skipped++;
    }
}

// Ecco The Dolphin → Ecco The Dolphin (Japan)
if (file_exists($imageDir . '/Ecco The Dolphin-gameplay.png')) {
    if (!file_exists($imageDir . '/Ecco The Dolphin (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Ecco The Dolphin-gameplay.png', $imageDir . '/Ecco The Dolphin (Japan)-gameplay.png')) {
            echo "✓ Ecco The Dolphin-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco The Dolphin (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Ecco the Dolphin II → Ecco the Dolphin II (Japan)
if (file_exists($imageDir . '/Ecco the Dolphin II-artwork.png')) {
    if (!file_exists($imageDir . '/Ecco the Dolphin II (Japan)-artwork.png')) {
        if (rename($imageDir . '/Ecco the Dolphin II-artwork.png', $imageDir . '/Ecco the Dolphin II (Japan)-artwork.png')) {
            echo "✓ Ecco the Dolphin II-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco the Dolphin II (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Ecco the Dolphin II → Ecco the Dolphin II (Japan)
if (file_exists($imageDir . '/Ecco the Dolphin II-cover.png')) {
    if (!file_exists($imageDir . '/Ecco the Dolphin II (Japan)-cover.png')) {
        if (rename($imageDir . '/Ecco the Dolphin II-cover.png', $imageDir . '/Ecco the Dolphin II (Japan)-cover.png')) {
            echo "✓ Ecco the Dolphin II-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco the Dolphin II (Japan)-cover.png\n";
        $skipped++;
    }
}

// Ecco the Dolphin II → Ecco the Dolphin II (Japan)
if (file_exists($imageDir . '/Ecco the Dolphin II-gameplay.png')) {
    if (!file_exists($imageDir . '/Ecco the Dolphin II (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Ecco the Dolphin II-gameplay.png', $imageDir . '/Ecco the Dolphin II (Japan)-gameplay.png')) {
            echo "✓ Ecco the Dolphin II-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco the Dolphin II (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Evander Holyfield's 'Real Deal' Boxing → Evander Holyfield's 'Real Deal' Boxing (USA, Europe)
if (file_exists($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-artwork.png')) {
    if (!file_exists($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-artwork.png', $imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing (USA, Europe)-artwork.png')) {
            echo "✓ Evander Holyfield\'s \'Real Deal\' Boxing-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Evander Holyfield\'s \'Real Deal\' Boxing (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Evander Holyfield's 'Real Deal' Boxing → Evander Holyfield's 'Real Deal' Boxing (USA, Europe)
if (file_exists($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-cover.png')) {
    if (!file_exists($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-cover.png', $imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing (USA, Europe)-cover.png')) {
            echo "✓ Evander Holyfield\'s \'Real Deal\' Boxing-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Evander Holyfield\'s \'Real Deal\' Boxing (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Evander Holyfield's 'Real Deal' Boxing → Evander Holyfield's 'Real Deal' Boxing (USA, Europe)
if (file_exists($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-gameplay.png')) {
    if (!file_exists($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing-gameplay.png', $imageDir . '/Evander Holyfield\'s \'Real Deal\' Boxing (USA, Europe)-gameplay.png')) {
            echo "✓ Evander Holyfield\'s \'Real Deal\' Boxing-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Evander Holyfield\'s \'Real Deal\' Boxing (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Excellent Dizzy Collection, The → Excellent Dizzy Collection, The (Europe)
if (file_exists($imageDir . '/Excellent Dizzy Collection, The-artwork.png')) {
    if (!file_exists($imageDir . '/Excellent Dizzy Collection, The (Europe)-artwork.png')) {
        if (rename($imageDir . '/Excellent Dizzy Collection, The-artwork.png', $imageDir . '/Excellent Dizzy Collection, The (Europe)-artwork.png')) {
            echo "✓ Excellent Dizzy Collection, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Excellent Dizzy Collection, The (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Excellent Dizzy Collection, The → Excellent Dizzy Collection, The (Europe)
if (file_exists($imageDir . '/Excellent Dizzy Collection, The-cover.png')) {
    if (!file_exists($imageDir . '/Excellent Dizzy Collection, The (Europe)-cover.png')) {
        if (rename($imageDir . '/Excellent Dizzy Collection, The-cover.png', $imageDir . '/Excellent Dizzy Collection, The (Europe)-cover.png')) {
            echo "✓ Excellent Dizzy Collection, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Excellent Dizzy Collection, The (Europe)-cover.png\n";
        $skipped++;
    }
}

// Excellent Dizzy Collection, The → Excellent Dizzy Collection, The (Europe)
if (file_exists($imageDir . '/Excellent Dizzy Collection, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Excellent Dizzy Collection, The (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Excellent Dizzy Collection, The-gameplay.png', $imageDir . '/Excellent Dizzy Collection, The (Europe)-gameplay.png')) {
            echo "✓ Excellent Dizzy Collection, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Excellent Dizzy Collection, The (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// F-15 Strike Eagle → F-15 Strike Eagle (USA, Europe)
if (file_exists($imageDir . '/F-15 Strike Eagle-artwork.png')) {
    if (!file_exists($imageDir . '/F-15 Strike Eagle (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/F-15 Strike Eagle-artwork.png', $imageDir . '/F-15 Strike Eagle (USA, Europe)-artwork.png')) {
            echo "✓ F-15 Strike Eagle-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F-15 Strike Eagle (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// F-15 Strike Eagle → F-15 Strike Eagle (USA, Europe)
if (file_exists($imageDir . '/F-15 Strike Eagle-cover.png')) {
    if (!file_exists($imageDir . '/F-15 Strike Eagle (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/F-15 Strike Eagle-cover.png', $imageDir . '/F-15 Strike Eagle (USA, Europe)-cover.png')) {
            echo "✓ F-15 Strike Eagle-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F-15 Strike Eagle (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// F-15 Strike Eagle → F-15 Strike Eagle (USA, Europe)
if (file_exists($imageDir . '/F-15 Strike Eagle-gameplay.png')) {
    if (!file_exists($imageDir . '/F-15 Strike Eagle (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/F-15 Strike Eagle-gameplay.png', $imageDir . '/F-15 Strike Eagle (USA, Europe)-gameplay.png')) {
            echo "✓ F-15 Strike Eagle-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F-15 Strike Eagle (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// F1 - World Championship Edition → F1 - World Championship Edition (Europe)
if (file_exists($imageDir . '/F1 - World Championship Edition-artwork.png')) {
    if (!file_exists($imageDir . '/F1 - World Championship Edition (Europe)-artwork.png')) {
        if (rename($imageDir . '/F1 - World Championship Edition-artwork.png', $imageDir . '/F1 - World Championship Edition (Europe)-artwork.png')) {
            echo "✓ F1 - World Championship Edition-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F1 - World Championship Edition (Europe)-artwork.png\n";
        $skipped++;
    }
}

// F1 - World Championship Edition → F1 - World Championship Edition (Europe)
if (file_exists($imageDir . '/F1 - World Championship Edition-cover.png')) {
    if (!file_exists($imageDir . '/F1 - World Championship Edition (Europe)-cover.png')) {
        if (rename($imageDir . '/F1 - World Championship Edition-cover.png', $imageDir . '/F1 - World Championship Edition (Europe)-cover.png')) {
            echo "✓ F1 - World Championship Edition-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F1 - World Championship Edition (Europe)-cover.png\n";
        $skipped++;
    }
}

// F1 - World Championship Edition → F1 - World Championship Edition (Europe)
if (file_exists($imageDir . '/F1 - World Championship Edition-gameplay.png')) {
    if (!file_exists($imageDir . '/F1 - World Championship Edition (Europe)-gameplay.png')) {
        if (rename($imageDir . '/F1 - World Championship Edition-gameplay.png', $imageDir . '/F1 - World Championship Edition (Europe)-gameplay.png')) {
            echo "✓ F1 - World Championship Edition-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F1 - World Championship Edition (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// FIFA International Soccer → FIFA International Soccer (Japan)
if (file_exists($imageDir . '/FIFA International Soccer-artwork.png')) {
    if (!file_exists($imageDir . '/FIFA International Soccer (Japan)-artwork.png')) {
        if (rename($imageDir . '/FIFA International Soccer-artwork.png', $imageDir . '/FIFA International Soccer (Japan)-artwork.png')) {
            echo "✓ FIFA International Soccer-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: FIFA International Soccer (Japan)-artwork.png\n";
        $skipped++;
    }
}

// FIFA International Soccer → FIFA International Soccer (Japan)
if (file_exists($imageDir . '/FIFA International Soccer-cover.png')) {
    if (!file_exists($imageDir . '/FIFA International Soccer (Japan)-cover.png')) {
        if (rename($imageDir . '/FIFA International Soccer-cover.png', $imageDir . '/FIFA International Soccer (Japan)-cover.png')) {
            echo "✓ FIFA International Soccer-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: FIFA International Soccer (Japan)-cover.png\n";
        $skipped++;
    }
}

// FIFA International Soccer → FIFA International Soccer (Japan)
if (file_exists($imageDir . '/FIFA International Soccer-gameplay.png')) {
    if (!file_exists($imageDir . '/FIFA International Soccer (Japan)-gameplay.png')) {
        if (rename($imageDir . '/FIFA International Soccer-gameplay.png', $imageDir . '/FIFA International Soccer (Japan)-gameplay.png')) {
            echo "✓ FIFA International Soccer-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: FIFA International Soccer (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Fatal Fury Special → Fatal Fury Special (USA)
if (file_exists($imageDir . '/Fatal Fury Special-artwork.png')) {
    if (!file_exists($imageDir . '/Fatal Fury Special (USA)-artwork.png')) {
        if (rename($imageDir . '/Fatal Fury Special-artwork.png', $imageDir . '/Fatal Fury Special (USA)-artwork.png')) {
            echo "✓ Fatal Fury Special-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fatal Fury Special (USA)-artwork.png\n";
        $skipped++;
    }
}

// Fatal Fury Special → Fatal Fury Special (USA)
if (file_exists($imageDir . '/Fatal Fury Special-cover.png')) {
    if (!file_exists($imageDir . '/Fatal Fury Special (USA)-cover.png')) {
        if (rename($imageDir . '/Fatal Fury Special-cover.png', $imageDir . '/Fatal Fury Special (USA)-cover.png')) {
            echo "✓ Fatal Fury Special-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fatal Fury Special (USA)-cover.png\n";
        $skipped++;
    }
}

// Fatal Fury Special → Fatal Fury Special (USA)
if (file_exists($imageDir . '/Fatal Fury Special-gameplay.png')) {
    if (!file_exists($imageDir . '/Fatal Fury Special (USA)-gameplay.png')) {
        if (rename($imageDir . '/Fatal Fury Special-gameplay.png', $imageDir . '/Fatal Fury Special (USA)-gameplay.png')) {
            echo "✓ Fatal Fury Special-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fatal Fury Special (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Foreman for Real → Foreman for Real (Japan, USA)
if (file_exists($imageDir . '/Foreman for Real-cover.png')) {
    if (!file_exists($imageDir . '/Foreman for Real (Japan, USA)-cover.png')) {
        if (rename($imageDir . '/Foreman for Real-cover.png', $imageDir . '/Foreman for Real (Japan, USA)-cover.png')) {
            echo "✓ Foreman for Real-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Foreman for Real (Japan, USA)-cover.png\n";
        $skipped++;
    }
}

// Foreman for Real → Foreman for Real (Japan, USA)
if (file_exists($imageDir . '/Foreman for Real-gameplay.png')) {
    if (!file_exists($imageDir . '/Foreman for Real (Japan, USA)-gameplay.png')) {
        if (rename($imageDir . '/Foreman for Real-gameplay.png', $imageDir . '/Foreman for Real (Japan, USA)-gameplay.png')) {
            echo "✓ Foreman for Real-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Foreman for Real (Japan, USA)-gameplay.png\n";
        $skipped++;
    }
}

// Frank Thomas Big Hurt Baseball → Frank Thomas Big Hurt Baseball (USA)
if (file_exists($imageDir . '/Frank Thomas Big Hurt Baseball-artwork.png')) {
    if (!file_exists($imageDir . '/Frank Thomas Big Hurt Baseball (USA)-artwork.png')) {
        if (rename($imageDir . '/Frank Thomas Big Hurt Baseball-artwork.png', $imageDir . '/Frank Thomas Big Hurt Baseball (USA)-artwork.png')) {
            echo "✓ Frank Thomas Big Hurt Baseball-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Frank Thomas Big Hurt Baseball (USA)-artwork.png\n";
        $skipped++;
    }
}

// Frank Thomas Big Hurt Baseball → Frank Thomas Big Hurt Baseball (USA)
if (file_exists($imageDir . '/Frank Thomas Big Hurt Baseball-cover.png')) {
    if (!file_exists($imageDir . '/Frank Thomas Big Hurt Baseball (USA)-cover.png')) {
        if (rename($imageDir . '/Frank Thomas Big Hurt Baseball-cover.png', $imageDir . '/Frank Thomas Big Hurt Baseball (USA)-cover.png')) {
            echo "✓ Frank Thomas Big Hurt Baseball-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Frank Thomas Big Hurt Baseball (USA)-cover.png\n";
        $skipped++;
    }
}

// Frank Thomas Big Hurt Baseball → Frank Thomas Big Hurt Baseball (USA)
if (file_exists($imageDir . '/Frank Thomas Big Hurt Baseball-gameplay.png')) {
    if (!file_exists($imageDir . '/Frank Thomas Big Hurt Baseball (USA)-gameplay.png')) {
        if (rename($imageDir . '/Frank Thomas Big Hurt Baseball-gameplay.png', $imageDir . '/Frank Thomas Big Hurt Baseball (USA)-gameplay.png')) {
            echo "✓ Frank Thomas Big Hurt Baseball-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Frank Thomas Big Hurt Baseball (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Fray - Shugyou Hen → Fray - Shugyou Hen (Japan)
if (file_exists($imageDir . '/Fray - Shugyou Hen-artwork.png')) {
    if (!file_exists($imageDir . '/Fray - Shugyou Hen (Japan)-artwork.png')) {
        if (rename($imageDir . '/Fray - Shugyou Hen-artwork.png', $imageDir . '/Fray - Shugyou Hen (Japan)-artwork.png')) {
            echo "✓ Fray - Shugyou Hen-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fray - Shugyou Hen (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Fray - Shugyou Hen → Fray - Shugyou Hen (Japan)
if (file_exists($imageDir . '/Fray - Shugyou Hen-cover.png')) {
    if (!file_exists($imageDir . '/Fray - Shugyou Hen (Japan)-cover.png')) {
        if (rename($imageDir . '/Fray - Shugyou Hen-cover.png', $imageDir . '/Fray - Shugyou Hen (Japan)-cover.png')) {
            echo "✓ Fray - Shugyou Hen-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fray - Shugyou Hen (Japan)-cover.png\n";
        $skipped++;
    }
}

// Fray - Shugyou Hen → Fray - Shugyou Hen (Japan)
if (file_exists($imageDir . '/Fray - Shugyou Hen-gameplay.png')) {
    if (!file_exists($imageDir . '/Fray - Shugyou Hen (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Fray - Shugyou Hen-gameplay.png', $imageDir . '/Fray - Shugyou Hen (Japan)-gameplay.png')) {
            echo "✓ Fray - Shugyou Hen-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fray - Shugyou Hen (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Fred Couples Golf → Fred Couples Golf (USA)
if (file_exists($imageDir . '/Fred Couples Golf-artwork.png')) {
    if (!file_exists($imageDir . '/Fred Couples Golf (USA)-artwork.png')) {
        if (rename($imageDir . '/Fred Couples Golf-artwork.png', $imageDir . '/Fred Couples Golf (USA)-artwork.png')) {
            echo "✓ Fred Couples Golf-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fred Couples Golf (USA)-artwork.png\n";
        $skipped++;
    }
}

// Fred Couples Golf → Fred Couples Golf (USA)
if (file_exists($imageDir . '/Fred Couples Golf-cover.png')) {
    if (!file_exists($imageDir . '/Fred Couples Golf (USA)-cover.png')) {
        if (rename($imageDir . '/Fred Couples Golf-cover.png', $imageDir . '/Fred Couples Golf (USA)-cover.png')) {
            echo "✓ Fred Couples Golf-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fred Couples Golf (USA)-cover.png\n";
        $skipped++;
    }
}

// Fred Couples Golf → Fred Couples Golf (USA)
if (file_exists($imageDir . '/Fred Couples Golf-gameplay.png')) {
    if (!file_exists($imageDir . '/Fred Couples Golf (USA)-gameplay.png')) {
        if (rename($imageDir . '/Fred Couples Golf-gameplay.png', $imageDir . '/Fred Couples Golf (USA)-gameplay.png')) {
            echo "✓ Fred Couples Golf-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fred Couples Golf (USA)-gameplay.png\n";
        $skipped++;
    }
}

// From TV Animation Slam Dunk - Shouri e no Starting 5 → From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)
if (file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-artwork.png')) {
    if (!file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-artwork.png')) {
        if (rename($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-artwork.png', $imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-artwork.png')) {
            echo "✓ From TV Animation Slam Dunk - Shouri e no Starting 5-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-artwork.png\n";
        $skipped++;
    }
}

// From TV Animation Slam Dunk - Shouri e no Starting 5 → From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)
if (file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-cover.png')) {
    if (!file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-cover.png')) {
        if (rename($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-cover.png', $imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-cover.png')) {
            echo "✓ From TV Animation Slam Dunk - Shouri e no Starting 5-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-cover.png\n";
        $skipped++;
    }
}

// From TV Animation Slam Dunk - Shouri e no Starting 5 → From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)
if (file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-gameplay.png')) {
    if (!file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-gameplay.png')) {
        if (rename($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-gameplay.png', $imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-gameplay.png')) {
            echo "✓ From TV Animation Slam Dunk - Shouri e no Starting 5-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// G-LOC - Air Battle → G-LOC - Air Battle (Japan)
if (file_exists($imageDir . '/G-LOC - Air Battle-artwork.png')) {
    if (!file_exists($imageDir . '/G-LOC - Air Battle (Japan)-artwork.png')) {
        if (rename($imageDir . '/G-LOC - Air Battle-artwork.png', $imageDir . '/G-LOC - Air Battle (Japan)-artwork.png')) {
            echo "✓ G-LOC - Air Battle-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: G-LOC - Air Battle (Japan)-artwork.png\n";
        $skipped++;
    }
}

// G-LOC - Air Battle → G-LOC - Air Battle (Japan)
if (file_exists($imageDir . '/G-LOC - Air Battle-cover.png')) {
    if (!file_exists($imageDir . '/G-LOC - Air Battle (Japan)-cover.png')) {
        if (rename($imageDir . '/G-LOC - Air Battle-cover.png', $imageDir . '/G-LOC - Air Battle (Japan)-cover.png')) {
            echo "✓ G-LOC - Air Battle-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: G-LOC - Air Battle (Japan)-cover.png\n";
        $skipped++;
    }
}

// G-LOC - Air Battle → G-LOC - Air Battle (Japan)
if (file_exists($imageDir . '/G-LOC - Air Battle-gameplay.png')) {
    if (!file_exists($imageDir . '/G-LOC - Air Battle (Japan)-gameplay.png')) {
        if (rename($imageDir . '/G-LOC - Air Battle-gameplay.png', $imageDir . '/G-LOC - Air Battle (Japan)-gameplay.png')) {
            echo "✓ G-LOC - Air Battle-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: G-LOC - Air Battle (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// GG Portrait - Pai Chan → GG Portrait - Pai Chan (Japan)
if (file_exists($imageDir . '/GG Portrait - Pai Chan-artwork.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Pai Chan (Japan)-artwork.png')) {
        if (rename($imageDir . '/GG Portrait - Pai Chan-artwork.png', $imageDir . '/GG Portrait - Pai Chan (Japan)-artwork.png')) {
            echo "✓ GG Portrait - Pai Chan-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Pai Chan (Japan)-artwork.png\n";
        $skipped++;
    }
}

// GG Portrait - Pai Chan → GG Portrait - Pai Chan (Japan)
if (file_exists($imageDir . '/GG Portrait - Pai Chan-cover.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Pai Chan (Japan)-cover.png')) {
        if (rename($imageDir . '/GG Portrait - Pai Chan-cover.png', $imageDir . '/GG Portrait - Pai Chan (Japan)-cover.png')) {
            echo "✓ GG Portrait - Pai Chan-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Pai Chan (Japan)-cover.png\n";
        $skipped++;
    }
}

// GG Portrait - Pai Chan → GG Portrait - Pai Chan (Japan)
if (file_exists($imageDir . '/GG Portrait - Pai Chan-gameplay.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Pai Chan (Japan)-gameplay.png')) {
        if (rename($imageDir . '/GG Portrait - Pai Chan-gameplay.png', $imageDir . '/GG Portrait - Pai Chan (Japan)-gameplay.png')) {
            echo "✓ GG Portrait - Pai Chan-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Pai Chan (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// GG Portrait - Yuuki Akira → GG Portrait - Yuuki Akira (Japan)
if (file_exists($imageDir . '/GG Portrait - Yuuki Akira-artwork.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Yuuki Akira (Japan)-artwork.png')) {
        if (rename($imageDir . '/GG Portrait - Yuuki Akira-artwork.png', $imageDir . '/GG Portrait - Yuuki Akira (Japan)-artwork.png')) {
            echo "✓ GG Portrait - Yuuki Akira-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Yuuki Akira (Japan)-artwork.png\n";
        $skipped++;
    }
}

// GG Portrait - Yuuki Akira → GG Portrait - Yuuki Akira (Japan)
if (file_exists($imageDir . '/GG Portrait - Yuuki Akira-cover.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Yuuki Akira (Japan)-cover.png')) {
        if (rename($imageDir . '/GG Portrait - Yuuki Akira-cover.png', $imageDir . '/GG Portrait - Yuuki Akira (Japan)-cover.png')) {
            echo "✓ GG Portrait - Yuuki Akira-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Yuuki Akira (Japan)-cover.png\n";
        $skipped++;
    }
}

// GG Portrait - Yuuki Akira → GG Portrait - Yuuki Akira (Japan)
if (file_exists($imageDir . '/GG Portrait - Yuuki Akira-gameplay.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Yuuki Akira (Japan)-gameplay.png')) {
        if (rename($imageDir . '/GG Portrait - Yuuki Akira-gameplay.png', $imageDir . '/GG Portrait - Yuuki Akira (Japan)-gameplay.png')) {
            echo "✓ GG Portrait - Yuuki Akira-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Yuuki Akira (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// GG Shinobi Part II, The - The Silent Fury → GG Shinobi Part II, The - The Silent Fury [b2]
if (file_exists($imageDir . '/GG Shinobi Part II, The - The Silent Fury-cover.png')) {
    if (!file_exists($imageDir . '/GG Shinobi Part II, The - The Silent Fury [b2]-cover.png')) {
        if (rename($imageDir . '/GG Shinobi Part II, The - The Silent Fury-cover.png', $imageDir . '/GG Shinobi Part II, The - The Silent Fury [b2]-cover.png')) {
            echo "✓ GG Shinobi Part II, The - The Silent Fury-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Shinobi Part II, The - The Silent Fury [b2]-cover.png\n";
        $skipped++;
    }
}

// Gamble Panic → Gamble Panic (Japan)
if (file_exists($imageDir . '/Gamble Panic-artwork.png')) {
    if (!file_exists($imageDir . '/Gamble Panic (Japan)-artwork.png')) {
        if (rename($imageDir . '/Gamble Panic-artwork.png', $imageDir . '/Gamble Panic (Japan)-artwork.png')) {
            echo "✓ Gamble Panic-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gamble Panic (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Gamble Panic → Gamble Panic (Japan)
if (file_exists($imageDir . '/Gamble Panic-cover.png')) {
    if (!file_exists($imageDir . '/Gamble Panic (Japan)-cover.png')) {
        if (rename($imageDir . '/Gamble Panic-cover.png', $imageDir . '/Gamble Panic (Japan)-cover.png')) {
            echo "✓ Gamble Panic-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gamble Panic (Japan)-cover.png\n";
        $skipped++;
    }
}

// Gamble Panic → Gamble Panic (Japan)
if (file_exists($imageDir . '/Gamble Panic-gameplay.png')) {
    if (!file_exists($imageDir . '/Gamble Panic (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Gamble Panic-gameplay.png', $imageDir . '/Gamble Panic (Japan)-gameplay.png')) {
            echo "✓ Gamble Panic-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gamble Panic (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Gambler Jiko Chuushinha → Gambler Jiko Chuushinha (Japan)
if (file_exists($imageDir . '/Gambler Jiko Chuushinha-artwork.png')) {
    if (!file_exists($imageDir . '/Gambler Jiko Chuushinha (Japan)-artwork.png')) {
        if (rename($imageDir . '/Gambler Jiko Chuushinha-artwork.png', $imageDir . '/Gambler Jiko Chuushinha (Japan)-artwork.png')) {
            echo "✓ Gambler Jiko Chuushinha-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gambler Jiko Chuushinha (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Gambler Jiko Chuushinha → Gambler Jiko Chuushinha (Japan)
if (file_exists($imageDir . '/Gambler Jiko Chuushinha-cover.png')) {
    if (!file_exists($imageDir . '/Gambler Jiko Chuushinha (Japan)-cover.png')) {
        if (rename($imageDir . '/Gambler Jiko Chuushinha-cover.png', $imageDir . '/Gambler Jiko Chuushinha (Japan)-cover.png')) {
            echo "✓ Gambler Jiko Chuushinha-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gambler Jiko Chuushinha (Japan)-cover.png\n";
        $skipped++;
    }
}

// Gambler Jiko Chuushinha → Gambler Jiko Chuushinha (Japan)
if (file_exists($imageDir . '/Gambler Jiko Chuushinha-gameplay.png')) {
    if (!file_exists($imageDir . '/Gambler Jiko Chuushinha (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Gambler Jiko Chuushinha-gameplay.png', $imageDir . '/Gambler Jiko Chuushinha (Japan)-gameplay.png')) {
            echo "✓ Gambler Jiko Chuushinha-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gambler Jiko Chuushinha (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Ganbare Gorby! → Ganbare Gorby! (Japan)
if (file_exists($imageDir . '/Ganbare Gorby!-artwork.png')) {
    if (!file_exists($imageDir . '/Ganbare Gorby! (Japan)-artwork.png')) {
        if (rename($imageDir . '/Ganbare Gorby!-artwork.png', $imageDir . '/Ganbare Gorby! (Japan)-artwork.png')) {
            echo "✓ Ganbare Gorby!-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ganbare Gorby! (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Ganbare Gorby! → Ganbare Gorby! (Japan)
if (file_exists($imageDir . '/Ganbare Gorby!-cover.png')) {
    if (!file_exists($imageDir . '/Ganbare Gorby! (Japan)-cover.png')) {
        if (rename($imageDir . '/Ganbare Gorby!-cover.png', $imageDir . '/Ganbare Gorby! (Japan)-cover.png')) {
            echo "✓ Ganbare Gorby!-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ganbare Gorby! (Japan)-cover.png\n";
        $skipped++;
    }
}

// Ganbare Gorby! → Ganbare Gorby! (Japan)
if (file_exists($imageDir . '/Ganbare Gorby!-gameplay.png')) {
    if (!file_exists($imageDir . '/Ganbare Gorby! (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Ganbare Gorby!-gameplay.png', $imageDir . '/Ganbare Gorby! (Japan)-gameplay.png')) {
            echo "✓ Ganbare Gorby!-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ganbare Gorby! (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Garfield - Caught in the Act → Garfield - Caught in the Act (USA, Europe)
if (file_exists($imageDir . '/Garfield - Caught in the Act-artwork.png')) {
    if (!file_exists($imageDir . '/Garfield - Caught in the Act (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Garfield - Caught in the Act-artwork.png', $imageDir . '/Garfield - Caught in the Act (USA, Europe)-artwork.png')) {
            echo "✓ Garfield - Caught in the Act-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garfield - Caught in the Act (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Garfield - Caught in the Act → Garfield - Caught in the Act (USA, Europe)
if (file_exists($imageDir . '/Garfield - Caught in the Act-cover.png')) {
    if (!file_exists($imageDir . '/Garfield - Caught in the Act (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Garfield - Caught in the Act-cover.png', $imageDir . '/Garfield - Caught in the Act (USA, Europe)-cover.png')) {
            echo "✓ Garfield - Caught in the Act-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garfield - Caught in the Act (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Garfield - Caught in the Act → Garfield - Caught in the Act (USA, Europe)
if (file_exists($imageDir . '/Garfield - Caught in the Act-gameplay.png')) {
    if (!file_exists($imageDir . '/Garfield - Caught in the Act (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Garfield - Caught in the Act-gameplay.png', $imageDir . '/Garfield - Caught in the Act (USA, Europe)-gameplay.png')) {
            echo "✓ Garfield - Caught in the Act-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garfield - Caught in the Act (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Garou Densetsu Special → Garou Densetsu Special (Japan)
if (file_exists($imageDir . '/Garou Densetsu Special-artwork.png')) {
    if (!file_exists($imageDir . '/Garou Densetsu Special (Japan)-artwork.png')) {
        if (rename($imageDir . '/Garou Densetsu Special-artwork.png', $imageDir . '/Garou Densetsu Special (Japan)-artwork.png')) {
            echo "✓ Garou Densetsu Special-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garou Densetsu Special (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Garou Densetsu Special → Garou Densetsu Special (Japan)
if (file_exists($imageDir . '/Garou Densetsu Special-cover.png')) {
    if (!file_exists($imageDir . '/Garou Densetsu Special (Japan)-cover.png')) {
        if (rename($imageDir . '/Garou Densetsu Special-cover.png', $imageDir . '/Garou Densetsu Special (Japan)-cover.png')) {
            echo "✓ Garou Densetsu Special-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garou Densetsu Special (Japan)-cover.png\n";
        $skipped++;
    }
}

// Garou Densetsu Special → Garou Densetsu Special (Japan)
if (file_exists($imageDir . '/Garou Densetsu Special-gameplay.png')) {
    if (!file_exists($imageDir . '/Garou Densetsu Special (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Garou Densetsu Special-gameplay.png', $imageDir . '/Garou Densetsu Special (Japan)-gameplay.png')) {
            echo "✓ Garou Densetsu Special-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garou Densetsu Special (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Gear Stadium Heiseiban → Gear Stadium Heiseiban (Japan)
if (file_exists($imageDir . '/Gear Stadium Heiseiban-artwork.png')) {
    if (!file_exists($imageDir . '/Gear Stadium Heiseiban (Japan)-artwork.png')) {
        if (rename($imageDir . '/Gear Stadium Heiseiban-artwork.png', $imageDir . '/Gear Stadium Heiseiban (Japan)-artwork.png')) {
            echo "✓ Gear Stadium Heiseiban-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium Heiseiban (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Gear Stadium Heiseiban → Gear Stadium Heiseiban (Japan)
if (file_exists($imageDir . '/Gear Stadium Heiseiban-cover.png')) {
    if (!file_exists($imageDir . '/Gear Stadium Heiseiban (Japan)-cover.png')) {
        if (rename($imageDir . '/Gear Stadium Heiseiban-cover.png', $imageDir . '/Gear Stadium Heiseiban (Japan)-cover.png')) {
            echo "✓ Gear Stadium Heiseiban-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium Heiseiban (Japan)-cover.png\n";
        $skipped++;
    }
}

// Gear Stadium Heiseiban → Gear Stadium Heiseiban (Japan)
if (file_exists($imageDir . '/Gear Stadium Heiseiban-gameplay.png')) {
    if (!file_exists($imageDir . '/Gear Stadium Heiseiban (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Gear Stadium Heiseiban-gameplay.png', $imageDir . '/Gear Stadium Heiseiban (Japan)-gameplay.png')) {
            echo "✓ Gear Stadium Heiseiban-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium Heiseiban (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Gear Stadium → Gear Stadium (Japan)
if (file_exists($imageDir . '/Gear Stadium-artwork.png')) {
    if (!file_exists($imageDir . '/Gear Stadium (Japan)-artwork.png')) {
        if (rename($imageDir . '/Gear Stadium-artwork.png', $imageDir . '/Gear Stadium (Japan)-artwork.png')) {
            echo "✓ Gear Stadium-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Gear Stadium → Gear Stadium (Japan)
if (file_exists($imageDir . '/Gear Stadium-cover.png')) {
    if (!file_exists($imageDir . '/Gear Stadium (Japan)-cover.png')) {
        if (rename($imageDir . '/Gear Stadium-cover.png', $imageDir . '/Gear Stadium (Japan)-cover.png')) {
            echo "✓ Gear Stadium-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium (Japan)-cover.png\n";
        $skipped++;
    }
}

// Gear Stadium → Gear Stadium (Japan)
if (file_exists($imageDir . '/Gear Stadium-gameplay.png')) {
    if (!file_exists($imageDir . '/Gear Stadium (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Gear Stadium-gameplay.png', $imageDir . '/Gear Stadium (Japan)-gameplay.png')) {
            echo "✓ Gear Stadium-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Gear Works → Gear Works (USA)
if (file_exists($imageDir . '/Gear Works-artwork.png')) {
    if (!file_exists($imageDir . '/Gear Works (USA)-artwork.png')) {
        if (rename($imageDir . '/Gear Works-artwork.png', $imageDir . '/Gear Works (USA)-artwork.png')) {
            echo "✓ Gear Works-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Works (USA)-artwork.png\n";
        $skipped++;
    }
}

// Gear Works → Gear Works (USA)
if (file_exists($imageDir . '/Gear Works-cover.png')) {
    if (!file_exists($imageDir . '/Gear Works (USA)-cover.png')) {
        if (rename($imageDir . '/Gear Works-cover.png', $imageDir . '/Gear Works (USA)-cover.png')) {
            echo "✓ Gear Works-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Works (USA)-cover.png\n";
        $skipped++;
    }
}

// Gear Works → Gear Works (USA)
if (file_exists($imageDir . '/Gear Works-gameplay.png')) {
    if (!file_exists($imageDir . '/Gear Works (USA)-gameplay.png')) {
        if (rename($imageDir . '/Gear Works-gameplay.png', $imageDir . '/Gear Works (USA)-gameplay.png')) {
            echo "✓ Gear Works-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Works (USA)-gameplay.png\n";
        $skipped++;
    }
}

// George Foreman's KO Boxing → George Foreman's KO Boxing (USA, Europe)
if (file_exists($imageDir . '/George Foreman\'s KO Boxing-artwork.png')) {
    if (!file_exists($imageDir . '/George Foreman\'s KO Boxing (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/George Foreman\'s KO Boxing-artwork.png', $imageDir . '/George Foreman\'s KO Boxing (USA, Europe)-artwork.png')) {
            echo "✓ George Foreman\'s KO Boxing-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: George Foreman\'s KO Boxing (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// George Foreman's KO Boxing → George Foreman's KO Boxing (USA, Europe)
if (file_exists($imageDir . '/George Foreman\'s KO Boxing-cover.png')) {
    if (!file_exists($imageDir . '/George Foreman\'s KO Boxing (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/George Foreman\'s KO Boxing-cover.png', $imageDir . '/George Foreman\'s KO Boxing (USA, Europe)-cover.png')) {
            echo "✓ George Foreman\'s KO Boxing-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: George Foreman\'s KO Boxing (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// George Foreman's KO Boxing → George Foreman's KO Boxing (USA, Europe)
if (file_exists($imageDir . '/George Foreman\'s KO Boxing-gameplay.png')) {
    if (!file_exists($imageDir . '/George Foreman\'s KO Boxing (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/George Foreman\'s KO Boxing-gameplay.png', $imageDir . '/George Foreman\'s KO Boxing (USA, Europe)-gameplay.png')) {
            echo "✓ George Foreman\'s KO Boxing-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: George Foreman\'s KO Boxing (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Global Gladiators → Global Gladiators (Europe)
if (file_exists($imageDir . '/Global Gladiators-artwork.png')) {
    if (!file_exists($imageDir . '/Global Gladiators (Europe)-artwork.png')) {
        if (rename($imageDir . '/Global Gladiators-artwork.png', $imageDir . '/Global Gladiators (Europe)-artwork.png')) {
            echo "✓ Global Gladiators-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Global Gladiators (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Global Gladiators → Global Gladiators (Europe)
if (file_exists($imageDir . '/Global Gladiators-cover.png')) {
    if (!file_exists($imageDir . '/Global Gladiators (Europe)-cover.png')) {
        if (rename($imageDir . '/Global Gladiators-cover.png', $imageDir . '/Global Gladiators (Europe)-cover.png')) {
            echo "✓ Global Gladiators-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Global Gladiators (Europe)-cover.png\n";
        $skipped++;
    }
}

// Global Gladiators → Global Gladiators (Europe)
if (file_exists($imageDir . '/Global Gladiators-gameplay.png')) {
    if (!file_exists($imageDir . '/Global Gladiators (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Global Gladiators-gameplay.png', $imageDir . '/Global Gladiators (Europe)-gameplay.png')) {
            echo "✓ Global Gladiators-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Global Gladiators (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Gojira - Kaijuu Daishingeki → Gojira - Kaijuu Daishingeki (Japan)
if (file_exists($imageDir . '/Gojira - Kaijuu Daishingeki-artwork.png')) {
    if (!file_exists($imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-artwork.png')) {
        if (rename($imageDir . '/Gojira - Kaijuu Daishingeki-artwork.png', $imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-artwork.png')) {
            echo "✓ Gojira - Kaijuu Daishingeki-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gojira - Kaijuu Daishingeki (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Gojira - Kaijuu Daishingeki → Gojira - Kaijuu Daishingeki (Japan)
if (file_exists($imageDir . '/Gojira - Kaijuu Daishingeki-cover.png')) {
    if (!file_exists($imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-cover.png')) {
        if (rename($imageDir . '/Gojira - Kaijuu Daishingeki-cover.png', $imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-cover.png')) {
            echo "✓ Gojira - Kaijuu Daishingeki-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gojira - Kaijuu Daishingeki (Japan)-cover.png\n";
        $skipped++;
    }
}

// Gojira - Kaijuu Daishingeki → Gojira - Kaijuu Daishingeki (Japan)
if (file_exists($imageDir . '/Gojira - Kaijuu Daishingeki-gameplay.png')) {
    if (!file_exists($imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Gojira - Kaijuu Daishingeki-gameplay.png', $imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-gameplay.png')) {
            echo "✓ Gojira - Kaijuu Daishingeki-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gojira - Kaijuu Daishingeki (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Greendog - The Beached Surfer Dude! → Greendog - The Beached Surfer Dude! (USA, Brazil)
if (file_exists($imageDir . '/Greendog - The Beached Surfer Dude!-artwork.png')) {
    if (!file_exists($imageDir . '/Greendog - The Beached Surfer Dude! (USA, Brazil)-artwork.png')) {
        if (rename($imageDir . '/Greendog - The Beached Surfer Dude!-artwork.png', $imageDir . '/Greendog - The Beached Surfer Dude! (USA, Brazil)-artwork.png')) {
            echo "✓ Greendog - The Beached Surfer Dude!-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Greendog - The Beached Surfer Dude! (USA, Brazil)-artwork.png\n";
        $skipped++;
    }
}

// Greendog - The Beached Surfer Dude! → Greendog - The Beached Surfer Dude! (USA, Brazil)
if (file_exists($imageDir . '/Greendog - The Beached Surfer Dude!-cover.png')) {
    if (!file_exists($imageDir . '/Greendog - The Beached Surfer Dude! (USA, Brazil)-cover.png')) {
        if (rename($imageDir . '/Greendog - The Beached Surfer Dude!-cover.png', $imageDir . '/Greendog - The Beached Surfer Dude! (USA, Brazil)-cover.png')) {
            echo "✓ Greendog - The Beached Surfer Dude!-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Greendog - The Beached Surfer Dude! (USA, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Greendog - The Beached Surfer Dude! → Greendog - The Beached Surfer Dude! (USA, Brazil)
if (file_exists($imageDir . '/Greendog - The Beached Surfer Dude!-gameplay.png')) {
    if (!file_exists($imageDir . '/Greendog - The Beached Surfer Dude! (USA, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/Greendog - The Beached Surfer Dude!-gameplay.png', $imageDir . '/Greendog - The Beached Surfer Dude! (USA, Brazil)-gameplay.png')) {
            echo "✓ Greendog - The Beached Surfer Dude!-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Greendog - The Beached Surfer Dude! (USA, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// Gunstar Heroes → Gunstar Heroes (Japan)
if (file_exists($imageDir . '/Gunstar Heroes-artwork.png')) {
    if (!file_exists($imageDir . '/Gunstar Heroes (Japan)-artwork.png')) {
        if (rename($imageDir . '/Gunstar Heroes-artwork.png', $imageDir . '/Gunstar Heroes (Japan)-artwork.png')) {
            echo "✓ Gunstar Heroes-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gunstar Heroes (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Gunstar Heroes → Gunstar Heroes (Japan)
if (file_exists($imageDir . '/Gunstar Heroes-cover.png')) {
    if (!file_exists($imageDir . '/Gunstar Heroes (Japan)-cover.png')) {
        if (rename($imageDir . '/Gunstar Heroes-cover.png', $imageDir . '/Gunstar Heroes (Japan)-cover.png')) {
            echo "✓ Gunstar Heroes-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gunstar Heroes (Japan)-cover.png\n";
        $skipped++;
    }
}

// Gunstar Heroes → Gunstar Heroes (Japan)
if (file_exists($imageDir . '/Gunstar Heroes-gameplay.png')) {
    if (!file_exists($imageDir . '/Gunstar Heroes (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Gunstar Heroes-gameplay.png', $imageDir . '/Gunstar Heroes (Japan)-gameplay.png')) {
            echo "✓ Gunstar Heroes-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gunstar Heroes (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Head Buster → Head Buster (Japan)
if (file_exists($imageDir . '/Head Buster-artwork.png')) {
    if (!file_exists($imageDir . '/Head Buster (Japan)-artwork.png')) {
        if (rename($imageDir . '/Head Buster-artwork.png', $imageDir . '/Head Buster (Japan)-artwork.png')) {
            echo "✓ Head Buster-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Head Buster (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Head Buster → Head Buster (Japan)
if (file_exists($imageDir . '/Head Buster-cover.png')) {
    if (!file_exists($imageDir . '/Head Buster (Japan)-cover.png')) {
        if (rename($imageDir . '/Head Buster-cover.png', $imageDir . '/Head Buster (Japan)-cover.png')) {
            echo "✓ Head Buster-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Head Buster (Japan)-cover.png\n";
        $skipped++;
    }
}

// Head Buster → Head Buster (Japan)
if (file_exists($imageDir . '/Head Buster-gameplay.png')) {
    if (!file_exists($imageDir . '/Head Buster (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Head Buster-gameplay.png', $imageDir . '/Head Buster (Japan)-gameplay.png')) {
            echo "✓ Head Buster-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Head Buster (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Heavy Weight Champ → Heavy Weight Champ (Japan)
if (file_exists($imageDir . '/Heavy Weight Champ-artwork.png')) {
    if (!file_exists($imageDir . '/Heavy Weight Champ (Japan)-artwork.png')) {
        if (rename($imageDir . '/Heavy Weight Champ-artwork.png', $imageDir . '/Heavy Weight Champ (Japan)-artwork.png')) {
            echo "✓ Heavy Weight Champ-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Heavy Weight Champ (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Heavy Weight Champ → Heavy Weight Champ (Japan)
if (file_exists($imageDir . '/Heavy Weight Champ-cover.png')) {
    if (!file_exists($imageDir . '/Heavy Weight Champ (Japan)-cover.png')) {
        if (rename($imageDir . '/Heavy Weight Champ-cover.png', $imageDir . '/Heavy Weight Champ (Japan)-cover.png')) {
            echo "✓ Heavy Weight Champ-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Heavy Weight Champ (Japan)-cover.png\n";
        $skipped++;
    }
}

// Heavy Weight Champ → Heavy Weight Champ (Japan)
if (file_exists($imageDir . '/Heavy Weight Champ-gameplay.png')) {
    if (!file_exists($imageDir . '/Heavy Weight Champ (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Heavy Weight Champ-gameplay.png', $imageDir . '/Heavy Weight Champ (Japan)-gameplay.png')) {
            echo "✓ Heavy Weight Champ-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Heavy Weight Champ (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Honoo no Toukyuuji - Dodge Danpei → Honoo no Toukyuuji - Dodge Danpei (Japan)
if (file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei-artwork.png')) {
    if (!file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-artwork.png')) {
        if (rename($imageDir . '/Honoo no Toukyuuji - Dodge Danpei-artwork.png', $imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-artwork.png')) {
            echo "✓ Honoo no Toukyuuji - Dodge Danpei-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Honoo no Toukyuuji - Dodge Danpei (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Honoo no Toukyuuji - Dodge Danpei → Honoo no Toukyuuji - Dodge Danpei (Japan)
if (file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei-cover.png')) {
    if (!file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-cover.png')) {
        if (rename($imageDir . '/Honoo no Toukyuuji - Dodge Danpei-cover.png', $imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-cover.png')) {
            echo "✓ Honoo no Toukyuuji - Dodge Danpei-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Honoo no Toukyuuji - Dodge Danpei (Japan)-cover.png\n";
        $skipped++;
    }
}

// Honoo no Toukyuuji - Dodge Danpei → Honoo no Toukyuuji - Dodge Danpei (Japan)
if (file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei-gameplay.png')) {
    if (!file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Honoo no Toukyuuji - Dodge Danpei-gameplay.png', $imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-gameplay.png')) {
            echo "✓ Honoo no Toukyuuji - Dodge Danpei-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Honoo no Toukyuuji - Dodge Danpei (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai → Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)
if (file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-artwork.png')) {
    if (!file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-artwork.png')) {
        if (rename($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-artwork.png', $imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-artwork.png')) {
            echo "✓ Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai → Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)
if (file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-cover.png')) {
    if (!file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-cover.png')) {
        if (rename($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-cover.png', $imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-cover.png')) {
            echo "✓ Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-cover.png\n";
        $skipped++;
    }
}

// Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai → Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)
if (file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-gameplay.png')) {
    if (!file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-gameplay.png', $imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-gameplay.png')) {
            echo "✓ Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Hyper Pro Yakyuu '92 → Hyper Pro Yakyuu '92 (Japan)
if (file_exists($imageDir . '/Hyper Pro Yakyuu \'92-artwork.png')) {
    if (!file_exists($imageDir . '/Hyper Pro Yakyuu \'92 (Japan)-artwork.png')) {
        if (rename($imageDir . '/Hyper Pro Yakyuu \'92-artwork.png', $imageDir . '/Hyper Pro Yakyuu \'92 (Japan)-artwork.png')) {
            echo "✓ Hyper Pro Yakyuu \'92-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Hyper Pro Yakyuu \'92 (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Hyper Pro Yakyuu '92 → Hyper Pro Yakyuu '92 (Japan)
if (file_exists($imageDir . '/Hyper Pro Yakyuu \'92-cover.png')) {
    if (!file_exists($imageDir . '/Hyper Pro Yakyuu \'92 (Japan)-cover.png')) {
        if (rename($imageDir . '/Hyper Pro Yakyuu \'92-cover.png', $imageDir . '/Hyper Pro Yakyuu \'92 (Japan)-cover.png')) {
            echo "✓ Hyper Pro Yakyuu \'92-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Hyper Pro Yakyuu \'92 (Japan)-cover.png\n";
        $skipped++;
    }
}

// Hyper Pro Yakyuu '92 → Hyper Pro Yakyuu '92 (Japan)
if (file_exists($imageDir . '/Hyper Pro Yakyuu \'92-gameplay.png')) {
    if (!file_exists($imageDir . '/Hyper Pro Yakyuu \'92 (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Hyper Pro Yakyuu \'92-gameplay.png', $imageDir . '/Hyper Pro Yakyuu \'92 (Japan)-gameplay.png')) {
            echo "✓ Hyper Pro Yakyuu \'92-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Hyper Pro Yakyuu \'92 (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// In the Wake of Vampire → In the Wake of Vampire (Japan) (En)
if (file_exists($imageDir . '/In the Wake of Vampire-artwork.png')) {
    if (!file_exists($imageDir . '/In the Wake of Vampire (Japan) (En)-artwork.png')) {
        if (rename($imageDir . '/In the Wake of Vampire-artwork.png', $imageDir . '/In the Wake of Vampire (Japan) (En)-artwork.png')) {
            echo "✓ In the Wake of Vampire-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: In the Wake of Vampire (Japan) (En)-artwork.png\n";
        $skipped++;
    }
}

// In the Wake of Vampire → In the Wake of Vampire (Japan) (En)
if (file_exists($imageDir . '/In the Wake of Vampire-cover.png')) {
    if (!file_exists($imageDir . '/In the Wake of Vampire (Japan) (En)-cover.png')) {
        if (rename($imageDir . '/In the Wake of Vampire-cover.png', $imageDir . '/In the Wake of Vampire (Japan) (En)-cover.png')) {
            echo "✓ In the Wake of Vampire-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: In the Wake of Vampire (Japan) (En)-cover.png\n";
        $skipped++;
    }
}

// In the Wake of Vampire → In the Wake of Vampire (Japan) (En)
if (file_exists($imageDir . '/In the Wake of Vampire-gameplay.png')) {
    if (!file_exists($imageDir . '/In the Wake of Vampire (Japan) (En)-gameplay.png')) {
        if (rename($imageDir . '/In the Wake of Vampire-gameplay.png', $imageDir . '/In the Wake of Vampire (Japan) (En)-gameplay.png')) {
            echo "✓ In the Wake of Vampire-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: In the Wake of Vampire (Japan) (En)-gameplay.png\n";
        $skipped++;
    }
}

// Incredible Crash Dummies, The → Incredible Crash Dummies, The (World)
if (file_exists($imageDir . '/Incredible Crash Dummies, The-artwork.png')) {
    if (!file_exists($imageDir . '/Incredible Crash Dummies, The (World)-artwork.png')) {
        if (rename($imageDir . '/Incredible Crash Dummies, The-artwork.png', $imageDir . '/Incredible Crash Dummies, The (World)-artwork.png')) {
            echo "✓ Incredible Crash Dummies, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Crash Dummies, The (World)-artwork.png\n";
        $skipped++;
    }
}

// Incredible Crash Dummies, The → Incredible Crash Dummies, The (World)
if (file_exists($imageDir . '/Incredible Crash Dummies, The-cover.png')) {
    if (!file_exists($imageDir . '/Incredible Crash Dummies, The (World)-cover.png')) {
        if (rename($imageDir . '/Incredible Crash Dummies, The-cover.png', $imageDir . '/Incredible Crash Dummies, The (World)-cover.png')) {
            echo "✓ Incredible Crash Dummies, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Crash Dummies, The (World)-cover.png\n";
        $skipped++;
    }
}

// Incredible Crash Dummies, The → Incredible Crash Dummies, The (World)
if (file_exists($imageDir . '/Incredible Crash Dummies, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Incredible Crash Dummies, The (World)-gameplay.png')) {
        if (rename($imageDir . '/Incredible Crash Dummies, The-gameplay.png', $imageDir . '/Incredible Crash Dummies, The (World)-gameplay.png')) {
            echo "✓ Incredible Crash Dummies, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Crash Dummies, The (World)-gameplay.png\n";
        $skipped++;
    }
}

// Incredible Hulk, The → Incredible Hulk, The (USA, Europe)
if (file_exists($imageDir . '/Incredible Hulk, The-artwork.png')) {
    if (!file_exists($imageDir . '/Incredible Hulk, The (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Incredible Hulk, The-artwork.png', $imageDir . '/Incredible Hulk, The (USA, Europe)-artwork.png')) {
            echo "✓ Incredible Hulk, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Hulk, The (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Incredible Hulk, The → Incredible Hulk, The (USA, Europe)
if (file_exists($imageDir . '/Incredible Hulk, The-cover.png')) {
    if (!file_exists($imageDir . '/Incredible Hulk, The (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Incredible Hulk, The-cover.png', $imageDir . '/Incredible Hulk, The (USA, Europe)-cover.png')) {
            echo "✓ Incredible Hulk, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Hulk, The (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Incredible Hulk, The → Incredible Hulk, The (USA, Europe)
if (file_exists($imageDir . '/Incredible Hulk, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Incredible Hulk, The (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Incredible Hulk, The-gameplay.png', $imageDir . '/Incredible Hulk, The (USA, Europe)-gameplay.png')) {
            echo "✓ Incredible Hulk, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Hulk, The (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Indiana Jones and the Last Crusade → Indiana Jones and the Last Crusade (USA, Europe, Brazil)
if (file_exists($imageDir . '/Indiana Jones and the Last Crusade-artwork.png')) {
    if (!file_exists($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil)-artwork.png')) {
        if (rename($imageDir . '/Indiana Jones and the Last Crusade-artwork.png', $imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil)-artwork.png')) {
            echo "✓ Indiana Jones and the Last Crusade-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Indiana Jones and the Last Crusade (USA, Europe, Brazil)-artwork.png\n";
        $skipped++;
    }
}

// Indiana Jones and the Last Crusade → Indiana Jones and the Last Crusade (USA, Europe, Brazil)
if (file_exists($imageDir . '/Indiana Jones and the Last Crusade-cover.png')) {
    if (!file_exists($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil)-cover.png')) {
        if (rename($imageDir . '/Indiana Jones and the Last Crusade-cover.png', $imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil)-cover.png')) {
            echo "✓ Indiana Jones and the Last Crusade-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Indiana Jones and the Last Crusade (USA, Europe, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Indiana Jones and the Last Crusade → Indiana Jones and the Last Crusade (USA, Europe, Brazil)
if (file_exists($imageDir . '/Indiana Jones and the Last Crusade-gameplay.png')) {
    if (!file_exists($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/Indiana Jones and the Last Crusade-gameplay.png', $imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil)-gameplay.png')) {
            echo "✓ Indiana Jones and the Last Crusade-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Indiana Jones and the Last Crusade (USA, Europe, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// Iron Man X-O Manowar in Heavy Metal → Iron Man X-O Manowar in Heavy Metal (USA)
if (file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal-artwork.png')) {
    if (!file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-artwork.png')) {
        if (rename($imageDir . '/Iron Man X-O Manowar in Heavy Metal-artwork.png', $imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-artwork.png')) {
            echo "✓ Iron Man X-O Manowar in Heavy Metal-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Iron Man X-O Manowar in Heavy Metal (USA)-artwork.png\n";
        $skipped++;
    }
}

// Iron Man X-O Manowar in Heavy Metal → Iron Man X-O Manowar in Heavy Metal (USA)
if (file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal-cover.png')) {
    if (!file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-cover.png')) {
        if (rename($imageDir . '/Iron Man X-O Manowar in Heavy Metal-cover.png', $imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-cover.png')) {
            echo "✓ Iron Man X-O Manowar in Heavy Metal-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Iron Man X-O Manowar in Heavy Metal (USA)-cover.png\n";
        $skipped++;
    }
}

// Iron Man X-O Manowar in Heavy Metal → Iron Man X-O Manowar in Heavy Metal (USA)
if (file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal-gameplay.png')) {
    if (!file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-gameplay.png')) {
        if (rename($imageDir . '/Iron Man X-O Manowar in Heavy Metal-gameplay.png', $imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-gameplay.png')) {
            echo "✓ Iron Man X-O Manowar in Heavy Metal-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Iron Man X-O Manowar in Heavy Metal (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Itchy _ Scratchy Game, The → Itchy _ Scratchy Game, The (USA, Europe)
if (file_exists($imageDir . '/Itchy _ Scratchy Game, The-artwork.png')) {
    if (!file_exists($imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Itchy _ Scratchy Game, The-artwork.png', $imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-artwork.png')) {
            echo "✓ Itchy _ Scratchy Game, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Itchy _ Scratchy Game, The (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Itchy _ Scratchy Game, The → Itchy _ Scratchy Game, The (USA, Europe)
if (file_exists($imageDir . '/Itchy _ Scratchy Game, The-cover.png')) {
    if (!file_exists($imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Itchy _ Scratchy Game, The-cover.png', $imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-cover.png')) {
            echo "✓ Itchy _ Scratchy Game, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Itchy _ Scratchy Game, The (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Itchy _ Scratchy Game, The → Itchy _ Scratchy Game, The (USA, Europe)
if (file_exists($imageDir . '/Itchy _ Scratchy Game, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Itchy _ Scratchy Game, The-gameplay.png', $imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-gameplay.png')) {
            echo "✓ Itchy _ Scratchy Game, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Itchy _ Scratchy Game, The (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// J.League GG Pro-Striker '94 → J.League GG Pro-Striker '94 (Japan)
if (file_exists($imageDir . '/J.League GG Pro-Striker \'94-artwork.png')) {
    if (!file_exists($imageDir . '/J.League GG Pro-Striker \'94 (Japan)-artwork.png')) {
        if (rename($imageDir . '/J.League GG Pro-Striker \'94-artwork.png', $imageDir . '/J.League GG Pro-Striker \'94 (Japan)-artwork.png')) {
            echo "✓ J.League GG Pro-Striker \'94-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: J.League GG Pro-Striker \'94 (Japan)-artwork.png\n";
        $skipped++;
    }
}

// J.League GG Pro-Striker '94 → J.League GG Pro-Striker '94 (Japan)
if (file_exists($imageDir . '/J.League GG Pro-Striker \'94-cover.png')) {
    if (!file_exists($imageDir . '/J.League GG Pro-Striker \'94 (Japan)-cover.png')) {
        if (rename($imageDir . '/J.League GG Pro-Striker \'94-cover.png', $imageDir . '/J.League GG Pro-Striker \'94 (Japan)-cover.png')) {
            echo "✓ J.League GG Pro-Striker \'94-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: J.League GG Pro-Striker \'94 (Japan)-cover.png\n";
        $skipped++;
    }
}

// J.League GG Pro-Striker '94 → J.League GG Pro-Striker '94 (Japan)
if (file_exists($imageDir . '/J.League GG Pro-Striker \'94-gameplay.png')) {
    if (!file_exists($imageDir . '/J.League GG Pro-Striker \'94 (Japan)-gameplay.png')) {
        if (rename($imageDir . '/J.League GG Pro-Striker \'94-gameplay.png', $imageDir . '/J.League GG Pro-Striker \'94 (Japan)-gameplay.png')) {
            echo "✓ J.League GG Pro-Striker \'94-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: J.League GG Pro-Striker \'94 (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// J.League Soccer - Dream Eleven → J.League Soccer - Dream Eleven (Japan)
if (file_exists($imageDir . '/J.League Soccer - Dream Eleven-artwork.png')) {
    if (!file_exists($imageDir . '/J.League Soccer - Dream Eleven (Japan)-artwork.png')) {
        if (rename($imageDir . '/J.League Soccer - Dream Eleven-artwork.png', $imageDir . '/J.League Soccer - Dream Eleven (Japan)-artwork.png')) {
            echo "✓ J.League Soccer - Dream Eleven-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: J.League Soccer - Dream Eleven (Japan)-artwork.png\n";
        $skipped++;
    }
}

// J.League Soccer - Dream Eleven → J.League Soccer - Dream Eleven (Japan)
if (file_exists($imageDir . '/J.League Soccer - Dream Eleven-cover.png')) {
    if (!file_exists($imageDir . '/J.League Soccer - Dream Eleven (Japan)-cover.png')) {
        if (rename($imageDir . '/J.League Soccer - Dream Eleven-cover.png', $imageDir . '/J.League Soccer - Dream Eleven (Japan)-cover.png')) {
            echo "✓ J.League Soccer - Dream Eleven-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: J.League Soccer - Dream Eleven (Japan)-cover.png\n";
        $skipped++;
    }
}

// J.League Soccer - Dream Eleven → J.League Soccer - Dream Eleven (Japan)
if (file_exists($imageDir . '/J.League Soccer - Dream Eleven-gameplay.png')) {
    if (!file_exists($imageDir . '/J.League Soccer - Dream Eleven (Japan)-gameplay.png')) {
        if (rename($imageDir . '/J.League Soccer - Dream Eleven-gameplay.png', $imageDir . '/J.League Soccer - Dream Eleven (Japan)-gameplay.png')) {
            echo "✓ J.League Soccer - Dream Eleven-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: J.League Soccer - Dream Eleven (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// James Bond 007 - The Duel → James Bond 007 - The Duel (Europe)
if (file_exists($imageDir . '/James Bond 007 - The Duel-artwork.png')) {
    if (!file_exists($imageDir . '/James Bond 007 - The Duel (Europe)-artwork.png')) {
        if (rename($imageDir . '/James Bond 007 - The Duel-artwork.png', $imageDir . '/James Bond 007 - The Duel (Europe)-artwork.png')) {
            echo "✓ James Bond 007 - The Duel-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Bond 007 - The Duel (Europe)-artwork.png\n";
        $skipped++;
    }
}

// James Bond 007 - The Duel → James Bond 007 - The Duel (Europe)
if (file_exists($imageDir . '/James Bond 007 - The Duel-cover.png')) {
    if (!file_exists($imageDir . '/James Bond 007 - The Duel (Europe)-cover.png')) {
        if (rename($imageDir . '/James Bond 007 - The Duel-cover.png', $imageDir . '/James Bond 007 - The Duel (Europe)-cover.png')) {
            echo "✓ James Bond 007 - The Duel-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Bond 007 - The Duel (Europe)-cover.png\n";
        $skipped++;
    }
}

// James Bond 007 - The Duel → James Bond 007 - The Duel (Europe)
if (file_exists($imageDir . '/James Bond 007 - The Duel-gameplay.png')) {
    if (!file_exists($imageDir . '/James Bond 007 - The Duel (Europe)-gameplay.png')) {
        if (rename($imageDir . '/James Bond 007 - The Duel-gameplay.png', $imageDir . '/James Bond 007 - The Duel (Europe)-gameplay.png')) {
            echo "✓ James Bond 007 - The Duel-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Bond 007 - The Duel (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// James Pond 3 - Operation Starfi5h → James Pond 3 - Operation Starfi5h (Europe)
if (file_exists($imageDir . '/James Pond 3 - Operation Starfi5h-artwork.png')) {
    if (!file_exists($imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-artwork.png')) {
        if (rename($imageDir . '/James Pond 3 - Operation Starfi5h-artwork.png', $imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-artwork.png')) {
            echo "✓ James Pond 3 - Operation Starfi5h-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond 3 - Operation Starfi5h (Europe)-artwork.png\n";
        $skipped++;
    }
}

// James Pond 3 - Operation Starfi5h → James Pond 3 - Operation Starfi5h (Europe)
if (file_exists($imageDir . '/James Pond 3 - Operation Starfi5h-cover.png')) {
    if (!file_exists($imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-cover.png')) {
        if (rename($imageDir . '/James Pond 3 - Operation Starfi5h-cover.png', $imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-cover.png')) {
            echo "✓ James Pond 3 - Operation Starfi5h-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond 3 - Operation Starfi5h (Europe)-cover.png\n";
        $skipped++;
    }
}

// James Pond 3 - Operation Starfi5h → James Pond 3 - Operation Starfi5h (Europe)
if (file_exists($imageDir . '/James Pond 3 - Operation Starfi5h-gameplay.png')) {
    if (!file_exists($imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-gameplay.png')) {
        if (rename($imageDir . '/James Pond 3 - Operation Starfi5h-gameplay.png', $imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-gameplay.png')) {
            echo "✓ James Pond 3 - Operation Starfi5h-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond 3 - Operation Starfi5h (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// James Pond II - Codename RoboCod → James Pond II - Codename RoboCod (USA)
if (file_exists($imageDir . '/James Pond II - Codename RoboCod-artwork.png')) {
    if (!file_exists($imageDir . '/James Pond II - Codename RoboCod (USA)-artwork.png')) {
        if (rename($imageDir . '/James Pond II - Codename RoboCod-artwork.png', $imageDir . '/James Pond II - Codename RoboCod (USA)-artwork.png')) {
            echo "✓ James Pond II - Codename RoboCod-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond II - Codename RoboCod (USA)-artwork.png\n";
        $skipped++;
    }
}

// James Pond II - Codename RoboCod → James Pond II - Codename RoboCod (USA)
if (file_exists($imageDir . '/James Pond II - Codename RoboCod-cover.png')) {
    if (!file_exists($imageDir . '/James Pond II - Codename RoboCod (USA)-cover.png')) {
        if (rename($imageDir . '/James Pond II - Codename RoboCod-cover.png', $imageDir . '/James Pond II - Codename RoboCod (USA)-cover.png')) {
            echo "✓ James Pond II - Codename RoboCod-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond II - Codename RoboCod (USA)-cover.png\n";
        $skipped++;
    }
}

// James Pond II - Codename RoboCod → James Pond II - Codename RoboCod (USA)
if (file_exists($imageDir . '/James Pond II - Codename RoboCod-gameplay.png')) {
    if (!file_exists($imageDir . '/James Pond II - Codename RoboCod (USA)-gameplay.png')) {
        if (rename($imageDir . '/James Pond II - Codename RoboCod-gameplay.png', $imageDir . '/James Pond II - Codename RoboCod (USA)-gameplay.png')) {
            echo "✓ James Pond II - Codename RoboCod-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond II - Codename RoboCod (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Jeopardy! - Sports Edition → Jeopardy! - Sports Edition (USA)
if (file_exists($imageDir . '/Jeopardy! - Sports Edition-artwork.png')) {
    if (!file_exists($imageDir . '/Jeopardy! - Sports Edition (USA)-artwork.png')) {
        if (rename($imageDir . '/Jeopardy! - Sports Edition-artwork.png', $imageDir . '/Jeopardy! - Sports Edition (USA)-artwork.png')) {
            echo "✓ Jeopardy! - Sports Edition-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jeopardy! - Sports Edition (USA)-artwork.png\n";
        $skipped++;
    }
}

// Jeopardy! - Sports Edition → Jeopardy! - Sports Edition (USA)
if (file_exists($imageDir . '/Jeopardy! - Sports Edition-cover.png')) {
    if (!file_exists($imageDir . '/Jeopardy! - Sports Edition (USA)-cover.png')) {
        if (rename($imageDir . '/Jeopardy! - Sports Edition-cover.png', $imageDir . '/Jeopardy! - Sports Edition (USA)-cover.png')) {
            echo "✓ Jeopardy! - Sports Edition-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jeopardy! - Sports Edition (USA)-cover.png\n";
        $skipped++;
    }
}

// Jeopardy! - Sports Edition → Jeopardy! - Sports Edition (USA)
if (file_exists($imageDir . '/Jeopardy! - Sports Edition-gameplay.png')) {
    if (!file_exists($imageDir . '/Jeopardy! - Sports Edition (USA)-gameplay.png')) {
        if (rename($imageDir . '/Jeopardy! - Sports Edition-gameplay.png', $imageDir . '/Jeopardy! - Sports Edition (USA)-gameplay.png')) {
            echo "✓ Jeopardy! - Sports Edition-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jeopardy! - Sports Edition (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Jeopardy! → Jeopardy! (USA)
if (file_exists($imageDir . '/Jeopardy!-artwork.png')) {
    if (!file_exists($imageDir . '/Jeopardy! (USA)-artwork.png')) {
        if (rename($imageDir . '/Jeopardy!-artwork.png', $imageDir . '/Jeopardy! (USA)-artwork.png')) {
            echo "✓ Jeopardy!-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jeopardy! (USA)-artwork.png\n";
        $skipped++;
    }
}

// Jeopardy! → Jeopardy! (USA)
if (file_exists($imageDir . '/Jeopardy!-cover.png')) {
    if (!file_exists($imageDir . '/Jeopardy! (USA)-cover.png')) {
        if (rename($imageDir . '/Jeopardy!-cover.png', $imageDir . '/Jeopardy! (USA)-cover.png')) {
            echo "✓ Jeopardy!-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jeopardy! (USA)-cover.png\n";
        $skipped++;
    }
}

// Jeopardy! → Jeopardy! (USA)
if (file_exists($imageDir . '/Jeopardy!-gameplay.png')) {
    if (!file_exists($imageDir . '/Jeopardy! (USA)-gameplay.png')) {
        if (rename($imageDir . '/Jeopardy!-gameplay.png', $imageDir . '/Jeopardy! (USA)-gameplay.png')) {
            echo "✓ Jeopardy!-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jeopardy! (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Joe Montana Football → Joe Montana Football (USA, Europe)
if (file_exists($imageDir . '/Joe Montana Football-artwork.png')) {
    if (!file_exists($imageDir . '/Joe Montana Football (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Joe Montana Football-artwork.png', $imageDir . '/Joe Montana Football (USA, Europe)-artwork.png')) {
            echo "✓ Joe Montana Football-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Joe Montana Football (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Joe Montana Football → Joe Montana Football (USA, Europe)
if (file_exists($imageDir . '/Joe Montana Football-cover.png')) {
    if (!file_exists($imageDir . '/Joe Montana Football (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Joe Montana Football-cover.png', $imageDir . '/Joe Montana Football (USA, Europe)-cover.png')) {
            echo "✓ Joe Montana Football-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Joe Montana Football (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Joe Montana Football → Joe Montana Football (USA, Europe)
if (file_exists($imageDir . '/Joe Montana Football-gameplay.png')) {
    if (!file_exists($imageDir . '/Joe Montana Football (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Joe Montana Football-gameplay.png', $imageDir . '/Joe Montana Football (USA, Europe)-gameplay.png')) {
            echo "✓ Joe Montana Football-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Joe Montana Football (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Journey from Darkness - Strider Returns → Journey from Darkness - Strider Returns (USA, Europe)
if (file_exists($imageDir . '/Journey from Darkness - Strider Returns-artwork.png')) {
    if (!file_exists($imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Journey from Darkness - Strider Returns-artwork.png', $imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-artwork.png')) {
            echo "✓ Journey from Darkness - Strider Returns-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Journey from Darkness - Strider Returns (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Journey from Darkness - Strider Returns → Journey from Darkness - Strider Returns (USA, Europe)
if (file_exists($imageDir . '/Journey from Darkness - Strider Returns-cover.png')) {
    if (!file_exists($imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Journey from Darkness - Strider Returns-cover.png', $imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-cover.png')) {
            echo "✓ Journey from Darkness - Strider Returns-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Journey from Darkness - Strider Returns (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Journey from Darkness - Strider Returns → Journey from Darkness - Strider Returns (USA, Europe)
if (file_exists($imageDir . '/Journey from Darkness - Strider Returns-gameplay.png')) {
    if (!file_exists($imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Journey from Darkness - Strider Returns-gameplay.png', $imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-gameplay.png')) {
            echo "✓ Journey from Darkness - Strider Returns-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Journey from Darkness - Strider Returns (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Junction → Junction (USA)
if (file_exists($imageDir . '/Junction-artwork.png')) {
    if (!file_exists($imageDir . '/Junction (USA)-artwork.png')) {
        if (rename($imageDir . '/Junction-artwork.png', $imageDir . '/Junction (USA)-artwork.png')) {
            echo "✓ Junction-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Junction (USA)-artwork.png\n";
        $skipped++;
    }
}

// Junction → Junction (USA)
if (file_exists($imageDir . '/Junction-cover.png')) {
    if (!file_exists($imageDir . '/Junction (USA)-cover.png')) {
        if (rename($imageDir . '/Junction-cover.png', $imageDir . '/Junction (USA)-cover.png')) {
            echo "✓ Junction-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Junction (USA)-cover.png\n";
        $skipped++;
    }
}

// Junction → Junction (USA)
if (file_exists($imageDir . '/Junction-gameplay.png')) {
    if (!file_exists($imageDir . '/Junction (USA)-gameplay.png')) {
        if (rename($imageDir . '/Junction-gameplay.png', $imageDir . '/Junction (USA)-gameplay.png')) {
            echo "✓ Junction-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Junction (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Jungle Book, The → Jungle Book, The (USA)
if (file_exists($imageDir . '/Jungle Book, The-artwork.png')) {
    if (!file_exists($imageDir . '/Jungle Book, The (USA)-artwork.png')) {
        if (rename($imageDir . '/Jungle Book, The-artwork.png', $imageDir . '/Jungle Book, The (USA)-artwork.png')) {
            echo "✓ Jungle Book, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Book, The (USA)-artwork.png\n";
        $skipped++;
    }
}

// Jungle Book, The → Jungle Book, The (USA)
if (file_exists($imageDir . '/Jungle Book, The-cover.png')) {
    if (!file_exists($imageDir . '/Jungle Book, The (USA)-cover.png')) {
        if (rename($imageDir . '/Jungle Book, The-cover.png', $imageDir . '/Jungle Book, The (USA)-cover.png')) {
            echo "✓ Jungle Book, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Book, The (USA)-cover.png\n";
        $skipped++;
    }
}

// Jungle Book, The → Jungle Book, The (USA)
if (file_exists($imageDir . '/Jungle Book, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Jungle Book, The (USA)-gameplay.png')) {
        if (rename($imageDir . '/Jungle Book, The-gameplay.png', $imageDir . '/Jungle Book, The (USA)-gameplay.png')) {
            echo "✓ Jungle Book, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Book, The (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Jungle Strike → Jungle Strike (USA)
if (file_exists($imageDir . '/Jungle Strike-artwork.png')) {
    if (!file_exists($imageDir . '/Jungle Strike (USA)-artwork.png')) {
        if (rename($imageDir . '/Jungle Strike-artwork.png', $imageDir . '/Jungle Strike (USA)-artwork.png')) {
            echo "✓ Jungle Strike-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Strike (USA)-artwork.png\n";
        $skipped++;
    }
}

// Jungle Strike → Jungle Strike (USA)
if (file_exists($imageDir . '/Jungle Strike-cover.png')) {
    if (!file_exists($imageDir . '/Jungle Strike (USA)-cover.png')) {
        if (rename($imageDir . '/Jungle Strike-cover.png', $imageDir . '/Jungle Strike (USA)-cover.png')) {
            echo "✓ Jungle Strike-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Strike (USA)-cover.png\n";
        $skipped++;
    }
}

// Jungle Strike → Jungle Strike (USA)
if (file_exists($imageDir . '/Jungle Strike-gameplay.png')) {
    if (!file_exists($imageDir . '/Jungle Strike (USA)-gameplay.png')) {
        if (rename($imageDir . '/Jungle Strike-gameplay.png', $imageDir . '/Jungle Strike (USA)-gameplay.png')) {
            echo "✓ Jungle Strike-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Strike (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Jurassic Park → Jurassic Park (Japan)
if (file_exists($imageDir . '/Jurassic Park-artwork.png')) {
    if (!file_exists($imageDir . '/Jurassic Park (Japan)-artwork.png')) {
        if (rename($imageDir . '/Jurassic Park-artwork.png', $imageDir . '/Jurassic Park (Japan)-artwork.png')) {
            echo "✓ Jurassic Park-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jurassic Park (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Jurassic Park → Jurassic Park (Japan)
if (file_exists($imageDir . '/Jurassic Park-cover.png')) {
    if (!file_exists($imageDir . '/Jurassic Park (Japan)-cover.png')) {
        if (rename($imageDir . '/Jurassic Park-cover.png', $imageDir . '/Jurassic Park (Japan)-cover.png')) {
            echo "✓ Jurassic Park-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jurassic Park (Japan)-cover.png\n";
        $skipped++;
    }
}

// Jurassic Park → Jurassic Park (Japan)
if (file_exists($imageDir . '/Jurassic Park-gameplay.png')) {
    if (!file_exists($imageDir . '/Jurassic Park (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Jurassic Park-gameplay.png', $imageDir . '/Jurassic Park (Japan)-gameplay.png')) {
            echo "✓ Jurassic Park-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jurassic Park (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Kaitou Saint Tail → Kaitou Saint Tail (Japan)
if (file_exists($imageDir . '/Kaitou Saint Tail-artwork.png')) {
    if (!file_exists($imageDir . '/Kaitou Saint Tail (Japan)-artwork.png')) {
        if (rename($imageDir . '/Kaitou Saint Tail-artwork.png', $imageDir . '/Kaitou Saint Tail (Japan)-artwork.png')) {
            echo "✓ Kaitou Saint Tail-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kaitou Saint Tail (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Kaitou Saint Tail → Kaitou Saint Tail (Japan)
if (file_exists($imageDir . '/Kaitou Saint Tail-cover.png')) {
    if (!file_exists($imageDir . '/Kaitou Saint Tail (Japan)-cover.png')) {
        if (rename($imageDir . '/Kaitou Saint Tail-cover.png', $imageDir . '/Kaitou Saint Tail (Japan)-cover.png')) {
            echo "✓ Kaitou Saint Tail-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kaitou Saint Tail (Japan)-cover.png\n";
        $skipped++;
    }
}

// Kaitou Saint Tail → Kaitou Saint Tail (Japan)
if (file_exists($imageDir . '/Kaitou Saint Tail-gameplay.png')) {
    if (!file_exists($imageDir . '/Kaitou Saint Tail (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Kaitou Saint Tail-gameplay.png', $imageDir . '/Kaitou Saint Tail (Japan)-gameplay.png')) {
            echo "✓ Kaitou Saint Tail-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kaitou Saint Tail (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Kawasaki Superbike Challenge → Kawasaki Superbike Challenge (USA)
if (file_exists($imageDir . '/Kawasaki Superbike Challenge-artwork.png')) {
    if (!file_exists($imageDir . '/Kawasaki Superbike Challenge (USA)-artwork.png')) {
        if (rename($imageDir . '/Kawasaki Superbike Challenge-artwork.png', $imageDir . '/Kawasaki Superbike Challenge (USA)-artwork.png')) {
            echo "✓ Kawasaki Superbike Challenge-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kawasaki Superbike Challenge (USA)-artwork.png\n";
        $skipped++;
    }
}

// Kawasaki Superbike Challenge → Kawasaki Superbike Challenge (USA)
if (file_exists($imageDir . '/Kawasaki Superbike Challenge-cover.png')) {
    if (!file_exists($imageDir . '/Kawasaki Superbike Challenge (USA)-cover.png')) {
        if (rename($imageDir . '/Kawasaki Superbike Challenge-cover.png', $imageDir . '/Kawasaki Superbike Challenge (USA)-cover.png')) {
            echo "✓ Kawasaki Superbike Challenge-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kawasaki Superbike Challenge (USA)-cover.png\n";
        $skipped++;
    }
}

// Kawasaki Superbike Challenge → Kawasaki Superbike Challenge (USA)
if (file_exists($imageDir . '/Kawasaki Superbike Challenge-gameplay.png')) {
    if (!file_exists($imageDir . '/Kawasaki Superbike Challenge (USA)-gameplay.png')) {
        if (rename($imageDir . '/Kawasaki Superbike Challenge-gameplay.png', $imageDir . '/Kawasaki Superbike Challenge (USA)-gameplay.png')) {
            echo "✓ Kawasaki Superbike Challenge-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kawasaki Superbike Challenge (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Kenyuu Densetsu Yaiba → Kenyuu Densetsu Yaiba (Japan)
if (file_exists($imageDir . '/Kenyuu Densetsu Yaiba-artwork.png')) {
    if (!file_exists($imageDir . '/Kenyuu Densetsu Yaiba (Japan)-artwork.png')) {
        if (rename($imageDir . '/Kenyuu Densetsu Yaiba-artwork.png', $imageDir . '/Kenyuu Densetsu Yaiba (Japan)-artwork.png')) {
            echo "✓ Kenyuu Densetsu Yaiba-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kenyuu Densetsu Yaiba (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Kenyuu Densetsu Yaiba → Kenyuu Densetsu Yaiba (Japan)
if (file_exists($imageDir . '/Kenyuu Densetsu Yaiba-cover.png')) {
    if (!file_exists($imageDir . '/Kenyuu Densetsu Yaiba (Japan)-cover.png')) {
        if (rename($imageDir . '/Kenyuu Densetsu Yaiba-cover.png', $imageDir . '/Kenyuu Densetsu Yaiba (Japan)-cover.png')) {
            echo "✓ Kenyuu Densetsu Yaiba-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kenyuu Densetsu Yaiba (Japan)-cover.png\n";
        $skipped++;
    }
}

// Kenyuu Densetsu Yaiba → Kenyuu Densetsu Yaiba (Japan)
if (file_exists($imageDir . '/Kenyuu Densetsu Yaiba-gameplay.png')) {
    if (!file_exists($imageDir . '/Kenyuu Densetsu Yaiba (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Kenyuu Densetsu Yaiba-gameplay.png', $imageDir . '/Kenyuu Densetsu Yaiba (Japan)-gameplay.png')) {
            echo "✓ Kenyuu Densetsu Yaiba-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kenyuu Densetsu Yaiba (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Kick _ Rush → Kick _ Rush (Japan)
if (file_exists($imageDir . '/Kick _ Rush-artwork.png')) {
    if (!file_exists($imageDir . '/Kick _ Rush (Japan)-artwork.png')) {
        if (rename($imageDir . '/Kick _ Rush-artwork.png', $imageDir . '/Kick _ Rush (Japan)-artwork.png')) {
            echo "✓ Kick _ Rush-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kick _ Rush (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Kick _ Rush → Kick _ Rush (Japan)
if (file_exists($imageDir . '/Kick _ Rush-cover.png')) {
    if (!file_exists($imageDir . '/Kick _ Rush (Japan)-cover.png')) {
        if (rename($imageDir . '/Kick _ Rush-cover.png', $imageDir . '/Kick _ Rush (Japan)-cover.png')) {
            echo "✓ Kick _ Rush-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kick _ Rush (Japan)-cover.png\n";
        $skipped++;
    }
}

// Kick _ Rush → Kick _ Rush (Japan)
if (file_exists($imageDir . '/Kick _ Rush-gameplay.png')) {
    if (!file_exists($imageDir . '/Kick _ Rush (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Kick _ Rush-gameplay.png', $imageDir . '/Kick _ Rush (Japan)-gameplay.png')) {
            echo "✓ Kick _ Rush-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kick _ Rush (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Kinetic Connection → Kinetic Connection (Japan) (En)
if (file_exists($imageDir . '/Kinetic Connection-artwork.png')) {
    if (!file_exists($imageDir . '/Kinetic Connection (Japan) (En)-artwork.png')) {
        if (rename($imageDir . '/Kinetic Connection-artwork.png', $imageDir . '/Kinetic Connection (Japan) (En)-artwork.png')) {
            echo "✓ Kinetic Connection-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kinetic Connection (Japan) (En)-artwork.png\n";
        $skipped++;
    }
}

// Kinetic Connection → Kinetic Connection (Japan) (En)
if (file_exists($imageDir . '/Kinetic Connection-cover.png')) {
    if (!file_exists($imageDir . '/Kinetic Connection (Japan) (En)-cover.png')) {
        if (rename($imageDir . '/Kinetic Connection-cover.png', $imageDir . '/Kinetic Connection (Japan) (En)-cover.png')) {
            echo "✓ Kinetic Connection-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kinetic Connection (Japan) (En)-cover.png\n";
        $skipped++;
    }
}

// Kinetic Connection → Kinetic Connection (Japan) (En)
if (file_exists($imageDir . '/Kinetic Connection-gameplay.png')) {
    if (!file_exists($imageDir . '/Kinetic Connection (Japan) (En)-gameplay.png')) {
        if (rename($imageDir . '/Kinetic Connection-gameplay.png', $imageDir . '/Kinetic Connection (Japan) (En)-gameplay.png')) {
            echo "✓ Kinetic Connection-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kinetic Connection (Japan) (En)-gameplay.png\n";
        $skipped++;
    }
}

// Kishin Douji Zenki → Kishin Douji Zenki (Japan)
if (file_exists($imageDir . '/Kishin Douji Zenki-artwork.png')) {
    if (!file_exists($imageDir . '/Kishin Douji Zenki (Japan)-artwork.png')) {
        if (rename($imageDir . '/Kishin Douji Zenki-artwork.png', $imageDir . '/Kishin Douji Zenki (Japan)-artwork.png')) {
            echo "✓ Kishin Douji Zenki-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kishin Douji Zenki (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Kishin Douji Zenki → Kishin Douji Zenki (Japan)
if (file_exists($imageDir . '/Kishin Douji Zenki-cover.png')) {
    if (!file_exists($imageDir . '/Kishin Douji Zenki (Japan)-cover.png')) {
        if (rename($imageDir . '/Kishin Douji Zenki-cover.png', $imageDir . '/Kishin Douji Zenki (Japan)-cover.png')) {
            echo "✓ Kishin Douji Zenki-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kishin Douji Zenki (Japan)-cover.png\n";
        $skipped++;
    }
}

// Kishin Douji Zenki → Kishin Douji Zenki (Japan)
if (file_exists($imageDir . '/Kishin Douji Zenki-gameplay.png')) {
    if (!file_exists($imageDir . '/Kishin Douji Zenki (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Kishin Douji Zenki-gameplay.png', $imageDir . '/Kishin Douji Zenki (Japan)-gameplay.png')) {
            echo "✓ Kishin Douji Zenki-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kishin Douji Zenki (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Krusty's Fun House → Krusty's Fun House (USA, Europe)
if (file_exists($imageDir . '/Krusty\'s Fun House-artwork.png')) {
    if (!file_exists($imageDir . '/Krusty\'s Fun House (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Krusty\'s Fun House-artwork.png', $imageDir . '/Krusty\'s Fun House (USA, Europe)-artwork.png')) {
            echo "✓ Krusty\'s Fun House-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Krusty\'s Fun House (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Krusty's Fun House → Krusty's Fun House (USA, Europe)
if (file_exists($imageDir . '/Krusty\'s Fun House-cover.png')) {
    if (!file_exists($imageDir . '/Krusty\'s Fun House (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Krusty\'s Fun House-cover.png', $imageDir . '/Krusty\'s Fun House (USA, Europe)-cover.png')) {
            echo "✓ Krusty\'s Fun House-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Krusty\'s Fun House (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Krusty's Fun House → Krusty's Fun House (USA, Europe)
if (file_exists($imageDir . '/Krusty\'s Fun House-gameplay.png')) {
    if (!file_exists($imageDir . '/Krusty\'s Fun House (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Krusty\'s Fun House-gameplay.png', $imageDir . '/Krusty\'s Fun House (USA, Europe)-gameplay.png')) {
            echo "✓ Krusty\'s Fun House-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Krusty\'s Fun House (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku Part 2 → Kuni-chan no Game Tengoku Part 2 (Japan)
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2-artwork.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-artwork.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku Part 2-artwork.png', $imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-artwork.png')) {
            echo "✓ Kuni-chan no Game Tengoku Part 2-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku Part 2 (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku Part 2 → Kuni-chan no Game Tengoku Part 2 (Japan)
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2-cover.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-cover.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku Part 2-cover.png', $imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-cover.png')) {
            echo "✓ Kuni-chan no Game Tengoku Part 2-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku Part 2 (Japan)-cover.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku Part 2 → Kuni-chan no Game Tengoku Part 2 (Japan)
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2-gameplay.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku Part 2-gameplay.png', $imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-gameplay.png')) {
            echo "✓ Kuni-chan no Game Tengoku Part 2-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku Part 2 (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku → Kuni-chan no Game Tengoku (Japan)
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku-artwork.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku (Japan)-artwork.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku-artwork.png', $imageDir . '/Kuni-chan no Game Tengoku (Japan)-artwork.png')) {
            echo "✓ Kuni-chan no Game Tengoku-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku → Kuni-chan no Game Tengoku (Japan)
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku-cover.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku (Japan)-cover.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku-cover.png', $imageDir . '/Kuni-chan no Game Tengoku (Japan)-cover.png')) {
            echo "✓ Kuni-chan no Game Tengoku-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku (Japan)-cover.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku → Kuni-chan no Game Tengoku (Japan)
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku-gameplay.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku-gameplay.png', $imageDir . '/Kuni-chan no Game Tengoku (Japan)-gameplay.png')) {
            echo "✓ Kuni-chan no Game Tengoku-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Land of Illusion Starring Mickey Mouse → Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)
if (file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse-artwork.png')) {
    if (!file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-artwork.png')) {
        if (rename($imageDir . '/Land of Illusion Starring Mickey Mouse-artwork.png', $imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-artwork.png')) {
            echo "✓ Land of Illusion Starring Mickey Mouse-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-artwork.png\n";
        $skipped++;
    }
}

// Land of Illusion Starring Mickey Mouse → Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)
if (file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse-cover.png')) {
    if (!file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png')) {
        if (rename($imageDir . '/Land of Illusion Starring Mickey Mouse-cover.png', $imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png')) {
            echo "✓ Land of Illusion Starring Mickey Mouse-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Land of Illusion Starring Mickey Mouse → Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)
if (file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse-gameplay.png')) {
    if (!file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/Land of Illusion Starring Mickey Mouse-gameplay.png', $imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png')) {
            echo "✓ Land of Illusion Starring Mickey Mouse-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// Last Action Hero → Last Action Hero (USA)
if (file_exists($imageDir . '/Last Action Hero-artwork.png')) {
    if (!file_exists($imageDir . '/Last Action Hero (USA)-artwork.png')) {
        if (rename($imageDir . '/Last Action Hero-artwork.png', $imageDir . '/Last Action Hero (USA)-artwork.png')) {
            echo "✓ Last Action Hero-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Last Action Hero (USA)-artwork.png\n";
        $skipped++;
    }
}

// Last Action Hero → Last Action Hero (USA)
if (file_exists($imageDir . '/Last Action Hero-cover.png')) {
    if (!file_exists($imageDir . '/Last Action Hero (USA)-cover.png')) {
        if (rename($imageDir . '/Last Action Hero-cover.png', $imageDir . '/Last Action Hero (USA)-cover.png')) {
            echo "✓ Last Action Hero-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Last Action Hero (USA)-cover.png\n";
        $skipped++;
    }
}

// Last Action Hero → Last Action Hero (USA)
if (file_exists($imageDir . '/Last Action Hero-gameplay.png')) {
    if (!file_exists($imageDir . '/Last Action Hero (USA)-gameplay.png')) {
        if (rename($imageDir . '/Last Action Hero-gameplay.png', $imageDir . '/Last Action Hero (USA)-gameplay.png')) {
            echo "✓ Last Action Hero-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Last Action Hero (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Legend of Illusion Starring Mickey Mouse → Legend of Illusion Starring Mickey Mouse (USA, Europe)
if (file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse-artwork.png')) {
    if (!file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Legend of Illusion Starring Mickey Mouse-artwork.png', $imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-artwork.png')) {
            echo "✓ Legend of Illusion Starring Mickey Mouse-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Legend of Illusion Starring Mickey Mouse (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Legend of Illusion Starring Mickey Mouse → Legend of Illusion Starring Mickey Mouse (USA, Europe)
if (file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse-cover.png')) {
    if (!file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Legend of Illusion Starring Mickey Mouse-cover.png', $imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-cover.png')) {
            echo "✓ Legend of Illusion Starring Mickey Mouse-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Legend of Illusion Starring Mickey Mouse (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Legend of Illusion Starring Mickey Mouse → Legend of Illusion Starring Mickey Mouse (USA, Europe)
if (file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse-gameplay.png')) {
    if (!file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Legend of Illusion Starring Mickey Mouse-gameplay.png', $imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-gameplay.png')) {
            echo "✓ Legend of Illusion Starring Mickey Mouse-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Legend of Illusion Starring Mickey Mouse (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Lion King, The → Lion King, The (Japan)
if (file_exists($imageDir . '/Lion King, The-artwork.png')) {
    if (!file_exists($imageDir . '/Lion King, The (Japan)-artwork.png')) {
        if (rename($imageDir . '/Lion King, The-artwork.png', $imageDir . '/Lion King, The (Japan)-artwork.png')) {
            echo "✓ Lion King, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lion King, The (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Lion King, The → Lion King, The (Japan)
if (file_exists($imageDir . '/Lion King, The-cover.png')) {
    if (!file_exists($imageDir . '/Lion King, The (Japan)-cover.png')) {
        if (rename($imageDir . '/Lion King, The-cover.png', $imageDir . '/Lion King, The (Japan)-cover.png')) {
            echo "✓ Lion King, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lion King, The (Japan)-cover.png\n";
        $skipped++;
    }
}

// Lion King, The → Lion King, The (Japan)
if (file_exists($imageDir . '/Lion King, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Lion King, The (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Lion King, The-gameplay.png', $imageDir . '/Lion King, The (Japan)-gameplay.png')) {
            echo "✓ Lion King, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lion King, The (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Lost World, The - Jurassic Park → Lost World, The - Jurassic Park (USA)
if (file_exists($imageDir . '/Lost World, The - Jurassic Park-artwork.png')) {
    if (!file_exists($imageDir . '/Lost World, The - Jurassic Park (USA)-artwork.png')) {
        if (rename($imageDir . '/Lost World, The - Jurassic Park-artwork.png', $imageDir . '/Lost World, The - Jurassic Park (USA)-artwork.png')) {
            echo "✓ Lost World, The - Jurassic Park-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lost World, The - Jurassic Park (USA)-artwork.png\n";
        $skipped++;
    }
}

// Lost World, The - Jurassic Park → Lost World, The - Jurassic Park (USA)
if (file_exists($imageDir . '/Lost World, The - Jurassic Park-cover.png')) {
    if (!file_exists($imageDir . '/Lost World, The - Jurassic Park (USA)-cover.png')) {
        if (rename($imageDir . '/Lost World, The - Jurassic Park-cover.png', $imageDir . '/Lost World, The - Jurassic Park (USA)-cover.png')) {
            echo "✓ Lost World, The - Jurassic Park-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lost World, The - Jurassic Park (USA)-cover.png\n";
        $skipped++;
    }
}

// Lost World, The - Jurassic Park → Lost World, The - Jurassic Park (USA)
if (file_exists($imageDir . '/Lost World, The - Jurassic Park-gameplay.png')) {
    if (!file_exists($imageDir . '/Lost World, The - Jurassic Park (USA)-gameplay.png')) {
        if (rename($imageDir . '/Lost World, The - Jurassic Park-gameplay.png', $imageDir . '/Lost World, The - Jurassic Park (USA)-gameplay.png')) {
            echo "✓ Lost World, The - Jurassic Park-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lost World, The - Jurassic Park (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Lucky Dime Caper Starring Donald Duck, The → Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)
if (file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-artwork.png')) {
    if (!file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-artwork.png')) {
        if (rename($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-artwork.png', $imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-artwork.png')) {
            echo "✓ Lucky Dime Caper Starring Donald Duck, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-artwork.png\n";
        $skipped++;
    }
}

// Lucky Dime Caper Starring Donald Duck, The → Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)
if (file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-cover.png')) {
    if (!file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-cover.png')) {
        if (rename($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-cover.png', $imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-cover.png')) {
            echo "✓ Lucky Dime Caper Starring Donald Duck, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Lucky Dime Caper Starring Donald Duck, The → Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)
if (file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-gameplay.png', $imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-gameplay.png')) {
            echo "✓ Lucky Dime Caper Starring Donald Duck, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// Lunar - Sanposuru Gakuen [tr en] → Lunar - Sanposuru Gakuen [tr en] (Japan)
if (file_exists($imageDir . '/Lunar - Sanposuru Gakuen [tr en]-cover.png')) {
    if (!file_exists($imageDir . '/Lunar - Sanposuru Gakuen [tr en] (Japan)-cover.png')) {
        if (rename($imageDir . '/Lunar - Sanposuru Gakuen [tr en]-cover.png', $imageDir . '/Lunar - Sanposuru Gakuen [tr en] (Japan)-cover.png')) {
            echo "✓ Lunar - Sanposuru Gakuen [tr en]-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lunar - Sanposuru Gakuen [tr en] (Japan)-cover.png\n";
        $skipped++;
    }
}

// Lunar - Sanposuru Gakuen → Lunar - Sanposuru Gakuen (Japan)
if (file_exists($imageDir . '/Lunar - Sanposuru Gakuen-artwork.png')) {
    if (!file_exists($imageDir . '/Lunar - Sanposuru Gakuen (Japan)-artwork.png')) {
        if (rename($imageDir . '/Lunar - Sanposuru Gakuen-artwork.png', $imageDir . '/Lunar - Sanposuru Gakuen (Japan)-artwork.png')) {
            echo "✓ Lunar - Sanposuru Gakuen-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lunar - Sanposuru Gakuen (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Lunar - Sanposuru Gakuen → Lunar - Sanposuru Gakuen (Japan)
if (file_exists($imageDir . '/Lunar - Sanposuru Gakuen-cover.png')) {
    if (!file_exists($imageDir . '/Lunar - Sanposuru Gakuen (Japan)-cover.png')) {
        if (rename($imageDir . '/Lunar - Sanposuru Gakuen-cover.png', $imageDir . '/Lunar - Sanposuru Gakuen (Japan)-cover.png')) {
            echo "✓ Lunar - Sanposuru Gakuen-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lunar - Sanposuru Gakuen (Japan)-cover.png\n";
        $skipped++;
    }
}

// Lunar - Sanposuru Gakuen → Lunar - Sanposuru Gakuen (Japan)
if (file_exists($imageDir . '/Lunar - Sanposuru Gakuen-gameplay.png')) {
    if (!file_exists($imageDir . '/Lunar - Sanposuru Gakuen (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Lunar - Sanposuru Gakuen-gameplay.png', $imageDir . '/Lunar - Sanposuru Gakuen (Japan)-gameplay.png')) {
            echo "✓ Lunar - Sanposuru Gakuen-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lunar - Sanposuru Gakuen (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// MLBPA Baseball → MLBPA Baseball (USA)
if (file_exists($imageDir . '/MLBPA Baseball-artwork.png')) {
    if (!file_exists($imageDir . '/MLBPA Baseball (USA)-artwork.png')) {
        if (rename($imageDir . '/MLBPA Baseball-artwork.png', $imageDir . '/MLBPA Baseball (USA)-artwork.png')) {
            echo "✓ MLBPA Baseball-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: MLBPA Baseball (USA)-artwork.png\n";
        $skipped++;
    }
}

// MLBPA Baseball → MLBPA Baseball (USA)
if (file_exists($imageDir . '/MLBPA Baseball-cover.png')) {
    if (!file_exists($imageDir . '/MLBPA Baseball (USA)-cover.png')) {
        if (rename($imageDir . '/MLBPA Baseball-cover.png', $imageDir . '/MLBPA Baseball (USA)-cover.png')) {
            echo "✓ MLBPA Baseball-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: MLBPA Baseball (USA)-cover.png\n";
        $skipped++;
    }
}

// MLBPA Baseball → MLBPA Baseball (USA)
if (file_exists($imageDir . '/MLBPA Baseball-gameplay.png')) {
    if (!file_exists($imageDir . '/MLBPA Baseball (USA)-gameplay.png')) {
        if (rename($imageDir . '/MLBPA Baseball-gameplay.png', $imageDir . '/MLBPA Baseball (USA)-gameplay.png')) {
            echo "✓ MLBPA Baseball-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: MLBPA Baseball (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Madden NFL 95 → Madden NFL 95 (USA)
if (file_exists($imageDir . '/Madden NFL 95-artwork.png')) {
    if (!file_exists($imageDir . '/Madden NFL 95 (USA)-artwork.png')) {
        if (rename($imageDir . '/Madden NFL 95-artwork.png', $imageDir . '/Madden NFL 95 (USA)-artwork.png')) {
            echo "✓ Madden NFL 95-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madden NFL 95 (USA)-artwork.png\n";
        $skipped++;
    }
}

// Madden NFL 95 → Madden NFL 95 (USA)
if (file_exists($imageDir . '/Madden NFL 95-cover.png')) {
    if (!file_exists($imageDir . '/Madden NFL 95 (USA)-cover.png')) {
        if (rename($imageDir . '/Madden NFL 95-cover.png', $imageDir . '/Madden NFL 95 (USA)-cover.png')) {
            echo "✓ Madden NFL 95-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madden NFL 95 (USA)-cover.png\n";
        $skipped++;
    }
}

// Madden NFL 95 → Madden NFL 95 (USA)
if (file_exists($imageDir . '/Madden NFL 95-gameplay.png')) {
    if (!file_exists($imageDir . '/Madden NFL 95 (USA)-gameplay.png')) {
        if (rename($imageDir . '/Madden NFL 95-gameplay.png', $imageDir . '/Madden NFL 95 (USA)-gameplay.png')) {
            echo "✓ Madden NFL 95-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madden NFL 95 (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Madou Monogatari A - Dokidoki Vacation → Madou Monogatari A - Dokidoki Vacation (Japan)
if (file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation-artwork.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-artwork.png')) {
        if (rename($imageDir . '/Madou Monogatari A - Dokidoki Vacation-artwork.png', $imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-artwork.png')) {
            echo "✓ Madou Monogatari A - Dokidoki Vacation-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari A - Dokidoki Vacation (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Madou Monogatari A - Dokidoki Vacation → Madou Monogatari A - Dokidoki Vacation (Japan)
if (file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation-cover.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-cover.png')) {
        if (rename($imageDir . '/Madou Monogatari A - Dokidoki Vacation-cover.png', $imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-cover.png')) {
            echo "✓ Madou Monogatari A - Dokidoki Vacation-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari A - Dokidoki Vacation (Japan)-cover.png\n";
        $skipped++;
    }
}

// Madou Monogatari A - Dokidoki Vacation → Madou Monogatari A - Dokidoki Vacation (Japan)
if (file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation-gameplay.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Madou Monogatari A - Dokidoki Vacation-gameplay.png', $imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-gameplay.png')) {
            echo "✓ Madou Monogatari A - Dokidoki Vacation-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari A - Dokidoki Vacation (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Madou Monogatari I - 3tsu no Madoukyuu → Madou Monogatari I - 3tsu no Madoukyuu (Japan)
if (file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-artwork.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-artwork.png')) {
        if (rename($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-artwork.png', $imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-artwork.png')) {
            echo "✓ Madou Monogatari I - 3tsu no Madoukyuu-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari I - 3tsu no Madoukyuu (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Madou Monogatari I - 3tsu no Madoukyuu → Madou Monogatari I - 3tsu no Madoukyuu (Japan)
if (file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-cover.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-cover.png')) {
        if (rename($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-cover.png', $imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-cover.png')) {
            echo "✓ Madou Monogatari I - 3tsu no Madoukyuu-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari I - 3tsu no Madoukyuu (Japan)-cover.png\n";
        $skipped++;
    }
}

// Madou Monogatari I - 3tsu no Madoukyuu → Madou Monogatari I - 3tsu no Madoukyuu (Japan)
if (file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-gameplay.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-gameplay.png', $imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-gameplay.png')) {
            echo "✓ Madou Monogatari I - 3tsu no Madoukyuu-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari I - 3tsu no Madoukyuu (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Madou Monogatari II - Arle 16-Sai → Madou Monogatari II - Arle 16-Sai (Japan)
if (file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai-artwork.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-artwork.png')) {
        if (rename($imageDir . '/Madou Monogatari II - Arle 16-Sai-artwork.png', $imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-artwork.png')) {
            echo "✓ Madou Monogatari II - Arle 16-Sai-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari II - Arle 16-Sai (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Madou Monogatari II - Arle 16-Sai → Madou Monogatari II - Arle 16-Sai (Japan)
if (file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai-cover.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-cover.png')) {
        if (rename($imageDir . '/Madou Monogatari II - Arle 16-Sai-cover.png', $imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-cover.png')) {
            echo "✓ Madou Monogatari II - Arle 16-Sai-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari II - Arle 16-Sai (Japan)-cover.png\n";
        $skipped++;
    }
}

// Madou Monogatari II - Arle 16-Sai → Madou Monogatari II - Arle 16-Sai (Japan)
if (file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai-gameplay.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Madou Monogatari II - Arle 16-Sai-gameplay.png', $imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-gameplay.png')) {
            echo "✓ Madou Monogatari II - Arle 16-Sai-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari II - Arle 16-Sai (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Madou Monogatari III - Kyuukyoku Joou-sama → Madou Monogatari III - Kyuukyoku Joou-sama (Japan)
if (file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-artwork.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-artwork.png')) {
        if (rename($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-artwork.png', $imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-artwork.png')) {
            echo "✓ Madou Monogatari III - Kyuukyoku Joou-sama-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Madou Monogatari III - Kyuukyoku Joou-sama → Madou Monogatari III - Kyuukyoku Joou-sama (Japan)
if (file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-cover.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-cover.png')) {
        if (rename($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-cover.png', $imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-cover.png')) {
            echo "✓ Madou Monogatari III - Kyuukyoku Joou-sama-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-cover.png\n";
        $skipped++;
    }
}

// Madou Monogatari III - Kyuukyoku Joou-sama → Madou Monogatari III - Kyuukyoku Joou-sama (Japan)
if (file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-gameplay.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-gameplay.png', $imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-gameplay.png')) {
            echo "✓ Madou Monogatari III - Kyuukyoku Joou-sama-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth 2 - Making of Magic Knight → Magic Knight Rayearth 2 - Making of Magic Knight (Japan)
if (file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-artwork.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-artwork.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-artwork.png', $imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-artwork.png')) {
            echo "✓ Magic Knight Rayearth 2 - Making of Magic Knight-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth 2 - Making of Magic Knight → Magic Knight Rayearth 2 - Making of Magic Knight (Japan)
if (file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-cover.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-cover.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-cover.png', $imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-cover.png')) {
            echo "✓ Magic Knight Rayearth 2 - Making of Magic Knight-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-cover.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth 2 - Making of Magic Knight → Magic Knight Rayearth 2 - Making of Magic Knight (Japan)
if (file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-gameplay.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-gameplay.png', $imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-gameplay.png')) {
            echo "✓ Magic Knight Rayearth 2 - Making of Magic Knight-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth → Magic Knight Rayearth (Japan)
if (file_exists($imageDir . '/Magic Knight Rayearth-artwork.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth (Japan)-artwork.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth-artwork.png', $imageDir . '/Magic Knight Rayearth (Japan)-artwork.png')) {
            echo "✓ Magic Knight Rayearth-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth → Magic Knight Rayearth (Japan)
if (file_exists($imageDir . '/Magic Knight Rayearth-cover.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth (Japan)-cover.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth-cover.png', $imageDir . '/Magic Knight Rayearth (Japan)-cover.png')) {
            echo "✓ Magic Knight Rayearth-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth (Japan)-cover.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth → Magic Knight Rayearth (Japan)
if (file_exists($imageDir . '/Magic Knight Rayearth-gameplay.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth-gameplay.png', $imageDir . '/Magic Knight Rayearth (Japan)-gameplay.png')) {
            echo "✓ Magic Knight Rayearth-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Magical Puzzle Popils → Magical Puzzle Popils (World)
if (file_exists($imageDir . '/Magical Puzzle Popils-artwork.png')) {
    if (!file_exists($imageDir . '/Magical Puzzle Popils (World)-artwork.png')) {
        if (rename($imageDir . '/Magical Puzzle Popils-artwork.png', $imageDir . '/Magical Puzzle Popils (World)-artwork.png')) {
            echo "✓ Magical Puzzle Popils-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Puzzle Popils (World)-artwork.png\n";
        $skipped++;
    }
}

// Magical Puzzle Popils → Magical Puzzle Popils (World)
if (file_exists($imageDir . '/Magical Puzzle Popils-cover.png')) {
    if (!file_exists($imageDir . '/Magical Puzzle Popils (World)-cover.png')) {
        if (rename($imageDir . '/Magical Puzzle Popils-cover.png', $imageDir . '/Magical Puzzle Popils (World)-cover.png')) {
            echo "✓ Magical Puzzle Popils-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Puzzle Popils (World)-cover.png\n";
        $skipped++;
    }
}

// Magical Puzzle Popils → Magical Puzzle Popils (World)
if (file_exists($imageDir . '/Magical Puzzle Popils-gameplay.png')) {
    if (!file_exists($imageDir . '/Magical Puzzle Popils (World)-gameplay.png')) {
        if (rename($imageDir . '/Magical Puzzle Popils-gameplay.png', $imageDir . '/Magical Puzzle Popils (World)-gameplay.png')) {
            echo "✓ Magical Puzzle Popils-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Puzzle Popils (World)-gameplay.png\n";
        $skipped++;
    }
}

// Magical Taruruuto-kun → Magical Taruruuto-kun (Japan)
if (file_exists($imageDir . '/Magical Taruruuto-kun-artwork.png')) {
    if (!file_exists($imageDir . '/Magical Taruruuto-kun (Japan)-artwork.png')) {
        if (rename($imageDir . '/Magical Taruruuto-kun-artwork.png', $imageDir . '/Magical Taruruuto-kun (Japan)-artwork.png')) {
            echo "✓ Magical Taruruuto-kun-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Taruruuto-kun (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Magical Taruruuto-kun → Magical Taruruuto-kun (Japan)
if (file_exists($imageDir . '/Magical Taruruuto-kun-cover.png')) {
    if (!file_exists($imageDir . '/Magical Taruruuto-kun (Japan)-cover.png')) {
        if (rename($imageDir . '/Magical Taruruuto-kun-cover.png', $imageDir . '/Magical Taruruuto-kun (Japan)-cover.png')) {
            echo "✓ Magical Taruruuto-kun-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Taruruuto-kun (Japan)-cover.png\n";
        $skipped++;
    }
}

// Magical Taruruuto-kun → Magical Taruruuto-kun (Japan)
if (file_exists($imageDir . '/Magical Taruruuto-kun-gameplay.png')) {
    if (!file_exists($imageDir . '/Magical Taruruuto-kun (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Magical Taruruuto-kun-gameplay.png', $imageDir . '/Magical Taruruuto-kun (Japan)-gameplay.png')) {
            echo "✓ Magical Taruruuto-kun-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Taruruuto-kun (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Majors, The - Pro Baseball → Majors, The - Pro Baseball (USA)
if (file_exists($imageDir . '/Majors, The - Pro Baseball-artwork.png')) {
    if (!file_exists($imageDir . '/Majors, The - Pro Baseball (USA)-artwork.png')) {
        if (rename($imageDir . '/Majors, The - Pro Baseball-artwork.png', $imageDir . '/Majors, The - Pro Baseball (USA)-artwork.png')) {
            echo "✓ Majors, The - Pro Baseball-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Majors, The - Pro Baseball (USA)-artwork.png\n";
        $skipped++;
    }
}

// Majors, The - Pro Baseball → Majors, The - Pro Baseball (USA)
if (file_exists($imageDir . '/Majors, The - Pro Baseball-cover.png')) {
    if (!file_exists($imageDir . '/Majors, The - Pro Baseball (USA)-cover.png')) {
        if (rename($imageDir . '/Majors, The - Pro Baseball-cover.png', $imageDir . '/Majors, The - Pro Baseball (USA)-cover.png')) {
            echo "✓ Majors, The - Pro Baseball-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Majors, The - Pro Baseball (USA)-cover.png\n";
        $skipped++;
    }
}

// Majors, The - Pro Baseball → Majors, The - Pro Baseball (USA)
if (file_exists($imageDir . '/Majors, The - Pro Baseball-gameplay.png')) {
    if (!file_exists($imageDir . '/Majors, The - Pro Baseball (USA)-gameplay.png')) {
        if (rename($imageDir . '/Majors, The - Pro Baseball-gameplay.png', $imageDir . '/Majors, The - Pro Baseball (USA)-gameplay.png')) {
            echo "✓ Majors, The - Pro Baseball-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Majors, The - Pro Baseball (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Man Overboard! → Man Overboard! (Europe)
if (file_exists($imageDir . '/Man Overboard!-artwork.png')) {
    if (!file_exists($imageDir . '/Man Overboard! (Europe)-artwork.png')) {
        if (rename($imageDir . '/Man Overboard!-artwork.png', $imageDir . '/Man Overboard! (Europe)-artwork.png')) {
            echo "✓ Man Overboard!-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Man Overboard! (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Man Overboard! → Man Overboard! (Europe)
if (file_exists($imageDir . '/Man Overboard!-cover.png')) {
    if (!file_exists($imageDir . '/Man Overboard! (Europe)-cover.png')) {
        if (rename($imageDir . '/Man Overboard!-cover.png', $imageDir . '/Man Overboard! (Europe)-cover.png')) {
            echo "✓ Man Overboard!-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Man Overboard! (Europe)-cover.png\n";
        $skipped++;
    }
}

// Man Overboard! → Man Overboard! (Europe)
if (file_exists($imageDir . '/Man Overboard!-gameplay.png')) {
    if (!file_exists($imageDir . '/Man Overboard! (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Man Overboard!-gameplay.png', $imageDir . '/Man Overboard! (Europe)-gameplay.png')) {
            echo "✓ Man Overboard!-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Man Overboard! (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Mega Man → Mega Man (USA)
if (file_exists($imageDir . '/Mega Man-artwork.png')) {
    if (!file_exists($imageDir . '/Mega Man (USA)-artwork.png')) {
        if (rename($imageDir . '/Mega Man-artwork.png', $imageDir . '/Mega Man (USA)-artwork.png')) {
            echo "✓ Mega Man-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mega Man (USA)-artwork.png\n";
        $skipped++;
    }
}

// Mega Man → Mega Man (USA)
if (file_exists($imageDir . '/Mega Man-cover.png')) {
    if (!file_exists($imageDir . '/Mega Man (USA)-cover.png')) {
        if (rename($imageDir . '/Mega Man-cover.png', $imageDir . '/Mega Man (USA)-cover.png')) {
            echo "✓ Mega Man-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mega Man (USA)-cover.png\n";
        $skipped++;
    }
}

// Mega Man → Mega Man (USA)
if (file_exists($imageDir . '/Mega Man-gameplay.png')) {
    if (!file_exists($imageDir . '/Mega Man (USA)-gameplay.png')) {
        if (rename($imageDir . '/Mega Man-gameplay.png', $imageDir . '/Mega Man (USA)-gameplay.png')) {
            echo "✓ Mega Man-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mega Man (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible Special → Megami Tensei Gaiden - Last Bible Special (Japan)
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special-artwork.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-artwork.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible Special-artwork.png', $imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-artwork.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible Special-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible Special (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible Special → Megami Tensei Gaiden - Last Bible Special (Japan)
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special-cover.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-cover.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible Special-cover.png', $imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-cover.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible Special-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible Special (Japan)-cover.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible Special → Megami Tensei Gaiden - Last Bible Special (Japan)
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special-gameplay.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible Special-gameplay.png', $imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-gameplay.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible Special-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible Special (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible → Megami Tensei Gaiden - Last Bible (Japan)
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible-artwork.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-artwork.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible-artwork.png', $imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-artwork.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible → Megami Tensei Gaiden - Last Bible (Japan)
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible-cover.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-cover.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible-cover.png', $imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-cover.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible (Japan)-cover.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible → Megami Tensei Gaiden - Last Bible (Japan)
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible-gameplay.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible-gameplay.png', $imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-gameplay.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Mickey Mouse Densetsu no Oukoku - Legend of Illusion → Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)
if (file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-artwork.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-artwork.png')) {
        if (rename($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-artwork.png', $imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-artwork.png')) {
            echo "✓ Mickey Mouse Densetsu no Oukoku - Legend of Illusion-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Mickey Mouse Densetsu no Oukoku - Legend of Illusion → Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)
if (file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-cover.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-cover.png')) {
        if (rename($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-cover.png', $imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-cover.png')) {
            echo "✓ Mickey Mouse Densetsu no Oukoku - Legend of Illusion-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-cover.png\n";
        $skipped++;
    }
}

// Mickey Mouse Densetsu no Oukoku - Legend of Illusion → Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)
if (file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-gameplay.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-gameplay.png', $imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-gameplay.png')) {
            echo "✓ Mickey Mouse Densetsu no Oukoku - Legend of Illusion-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Castle Illusion → Mickey Mouse no Castle Illusion (Japan) (En)
if (file_exists($imageDir . '/Mickey Mouse no Castle Illusion-artwork.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-artwork.png')) {
        if (rename($imageDir . '/Mickey Mouse no Castle Illusion-artwork.png', $imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-artwork.png')) {
            echo "✓ Mickey Mouse no Castle Illusion-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse no Castle Illusion (Japan) (En)-artwork.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Castle Illusion → Mickey Mouse no Castle Illusion (Japan) (En)
if (file_exists($imageDir . '/Mickey Mouse no Castle Illusion-cover.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-cover.png')) {
        if (rename($imageDir . '/Mickey Mouse no Castle Illusion-cover.png', $imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-cover.png')) {
            echo "✓ Mickey Mouse no Castle Illusion-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse no Castle Illusion (Japan) (En)-cover.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Castle Illusion → Mickey Mouse no Castle Illusion (Japan) (En)
if (file_exists($imageDir . '/Mickey Mouse no Castle Illusion-gameplay.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-gameplay.png')) {
        if (rename($imageDir . '/Mickey Mouse no Castle Illusion-gameplay.png', $imageDir . '/Mickey Mouse no Castle Illusion (Japan) (En)-gameplay.png')) {
            echo "✓ Mickey Mouse no Castle Illusion-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse no Castle Illusion (Japan) (En)-gameplay.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Mahou no Crystal → Mickey Mouse no Mahou no Crystal (Japan)
if (file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal-artwork.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-artwork.png')) {
        if (rename($imageDir . '/Mickey Mouse no Mahou no Crystal-artwork.png', $imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-artwork.png')) {
            echo "✓ Mickey Mouse no Mahou no Crystal-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse no Mahou no Crystal (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Mahou no Crystal → Mickey Mouse no Mahou no Crystal (Japan)
if (file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal-cover.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-cover.png')) {
        if (rename($imageDir . '/Mickey Mouse no Mahou no Crystal-cover.png', $imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-cover.png')) {
            echo "✓ Mickey Mouse no Mahou no Crystal-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse no Mahou no Crystal (Japan)-cover.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Mahou no Crystal → Mickey Mouse no Mahou no Crystal (Japan)
if (file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal-gameplay.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Mickey Mouse no Mahou no Crystal-gameplay.png', $imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-gameplay.png')) {
            echo "✓ Mickey Mouse no Mahou no Crystal-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse no Mahou no Crystal (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Mickey's Ultimate Challenge → Mickey's Ultimate Challenge (USA)
if (file_exists($imageDir . '/Mickey\'s Ultimate Challenge-artwork.png')) {
    if (!file_exists($imageDir . '/Mickey\'s Ultimate Challenge (USA)-artwork.png')) {
        if (rename($imageDir . '/Mickey\'s Ultimate Challenge-artwork.png', $imageDir . '/Mickey\'s Ultimate Challenge (USA)-artwork.png')) {
            echo "✓ Mickey\'s Ultimate Challenge-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey\'s Ultimate Challenge (USA)-artwork.png\n";
        $skipped++;
    }
}

// Mickey's Ultimate Challenge → Mickey's Ultimate Challenge (USA)
if (file_exists($imageDir . '/Mickey\'s Ultimate Challenge-cover.png')) {
    if (!file_exists($imageDir . '/Mickey\'s Ultimate Challenge (USA)-cover.png')) {
        if (rename($imageDir . '/Mickey\'s Ultimate Challenge-cover.png', $imageDir . '/Mickey\'s Ultimate Challenge (USA)-cover.png')) {
            echo "✓ Mickey\'s Ultimate Challenge-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey\'s Ultimate Challenge (USA)-cover.png\n";
        $skipped++;
    }
}

// Mickey's Ultimate Challenge → Mickey's Ultimate Challenge (USA)
if (file_exists($imageDir . '/Mickey\'s Ultimate Challenge-gameplay.png')) {
    if (!file_exists($imageDir . '/Mickey\'s Ultimate Challenge (USA)-gameplay.png')) {
        if (rename($imageDir . '/Mickey\'s Ultimate Challenge-gameplay.png', $imageDir . '/Mickey\'s Ultimate Challenge (USA)-gameplay.png')) {
            echo "✓ Mickey\'s Ultimate Challenge-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey\'s Ultimate Challenge (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Micro Machines 2 - Turbo Tournament → Micro Machines 2 - Turbo Tournament (Europe)
if (file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament-artwork.png')) {
    if (!file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-artwork.png')) {
        if (rename($imageDir . '/Micro Machines 2 - Turbo Tournament-artwork.png', $imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-artwork.png')) {
            echo "✓ Micro Machines 2 - Turbo Tournament-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Micro Machines 2 - Turbo Tournament (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Micro Machines 2 - Turbo Tournament → Micro Machines 2 - Turbo Tournament (Europe)
if (file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament-cover.png')) {
    if (!file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-cover.png')) {
        if (rename($imageDir . '/Micro Machines 2 - Turbo Tournament-cover.png', $imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-cover.png')) {
            echo "✓ Micro Machines 2 - Turbo Tournament-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Micro Machines 2 - Turbo Tournament (Europe)-cover.png\n";
        $skipped++;
    }
}

// Micro Machines 2 - Turbo Tournament → Micro Machines 2 - Turbo Tournament (Europe)
if (file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament-gameplay.png')) {
    if (!file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Micro Machines 2 - Turbo Tournament-gameplay.png', $imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-gameplay.png')) {
            echo "✓ Micro Machines 2 - Turbo Tournament-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Micro Machines 2 - Turbo Tournament (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Mighty Morphin Power Rangers - The Movie → Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)
if (file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie-artwork.png')) {
    if (!file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-artwork.png')) {
        if (rename($imageDir . '/Mighty Morphin Power Rangers - The Movie-artwork.png', $imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-artwork.png')) {
            echo "✓ Mighty Morphin Power Rangers - The Movie-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-artwork.png\n";
        $skipped++;
    }
}

// Mighty Morphin Power Rangers - The Movie → Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)
if (file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie-cover.png')) {
    if (!file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-cover.png')) {
        if (rename($imageDir . '/Mighty Morphin Power Rangers - The Movie-cover.png', $imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-cover.png')) {
            echo "✓ Mighty Morphin Power Rangers - The Movie-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Mighty Morphin Power Rangers - The Movie → Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)
if (file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie-gameplay.png')) {
    if (!file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/Mighty Morphin Power Rangers - The Movie-gameplay.png', $imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-gameplay.png')) {
            echo "✓ Mighty Morphin Power Rangers - The Movie-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// Moldorian - Hikari to Yami no Sister → Moldorian - Hikari to Yami no Sister (Japan)
if (file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister-artwork.png')) {
    if (!file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-artwork.png')) {
        if (rename($imageDir . '/Moldorian - Hikari to Yami no Sister-artwork.png', $imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-artwork.png')) {
            echo "✓ Moldorian - Hikari to Yami no Sister-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Moldorian - Hikari to Yami no Sister (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Moldorian - Hikari to Yami no Sister → Moldorian - Hikari to Yami no Sister (Japan)
if (file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister-cover.png')) {
    if (!file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-cover.png')) {
        if (rename($imageDir . '/Moldorian - Hikari to Yami no Sister-cover.png', $imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-cover.png')) {
            echo "✓ Moldorian - Hikari to Yami no Sister-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Moldorian - Hikari to Yami no Sister (Japan)-cover.png\n";
        $skipped++;
    }
}

// Moldorian - Hikari to Yami no Sister → Moldorian - Hikari to Yami no Sister (Japan)
if (file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister-gameplay.png')) {
    if (!file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Moldorian - Hikari to Yami no Sister-gameplay.png', $imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-gameplay.png')) {
            echo "✓ Moldorian - Hikari to Yami no Sister-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Moldorian - Hikari to Yami no Sister (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Monster Truck Wars → Monster Truck Wars (USA, Europe)
if (file_exists($imageDir . '/Monster Truck Wars-artwork.png')) {
    if (!file_exists($imageDir . '/Monster Truck Wars (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Monster Truck Wars-artwork.png', $imageDir . '/Monster Truck Wars (USA, Europe)-artwork.png')) {
            echo "✓ Monster Truck Wars-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster Truck Wars (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Monster Truck Wars → Monster Truck Wars (USA, Europe)
if (file_exists($imageDir . '/Monster Truck Wars-cover.png')) {
    if (!file_exists($imageDir . '/Monster Truck Wars (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Monster Truck Wars-cover.png', $imageDir . '/Monster Truck Wars (USA, Europe)-cover.png')) {
            echo "✓ Monster Truck Wars-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster Truck Wars (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Monster Truck Wars → Monster Truck Wars (USA, Europe)
if (file_exists($imageDir . '/Monster Truck Wars-gameplay.png')) {
    if (!file_exists($imageDir . '/Monster Truck Wars (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Monster Truck Wars-gameplay.png', $imageDir . '/Monster Truck Wars (USA, Europe)-gameplay.png')) {
            echo "✓ Monster Truck Wars-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster Truck Wars (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Monster World II - Dragon no Wana → Monster World II - Dragon no Wana (Japan)
if (file_exists($imageDir . '/Monster World II - Dragon no Wana-artwork.png')) {
    if (!file_exists($imageDir . '/Monster World II - Dragon no Wana (Japan)-artwork.png')) {
        if (rename($imageDir . '/Monster World II - Dragon no Wana-artwork.png', $imageDir . '/Monster World II - Dragon no Wana (Japan)-artwork.png')) {
            echo "✓ Monster World II - Dragon no Wana-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster World II - Dragon no Wana (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Monster World II - Dragon no Wana → Monster World II - Dragon no Wana (Japan)
if (file_exists($imageDir . '/Monster World II - Dragon no Wana-cover.png')) {
    if (!file_exists($imageDir . '/Monster World II - Dragon no Wana (Japan)-cover.png')) {
        if (rename($imageDir . '/Monster World II - Dragon no Wana-cover.png', $imageDir . '/Monster World II - Dragon no Wana (Japan)-cover.png')) {
            echo "✓ Monster World II - Dragon no Wana-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster World II - Dragon no Wana (Japan)-cover.png\n";
        $skipped++;
    }
}

// Monster World II - Dragon no Wana → Monster World II - Dragon no Wana (Japan)
if (file_exists($imageDir . '/Monster World II - Dragon no Wana-gameplay.png')) {
    if (!file_exists($imageDir . '/Monster World II - Dragon no Wana (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Monster World II - Dragon no Wana-gameplay.png', $imageDir . '/Monster World II - Dragon no Wana (Japan)-gameplay.png')) {
            echo "✓ Monster World II - Dragon no Wana-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster World II - Dragon no Wana (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Mortal Kombat - Shinken Kourin Densetsu → Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)
if (file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-artwork.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-artwork.png')) {
        if (rename($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-artwork.png', $imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-artwork.png')) {
            echo "✓ Mortal Kombat - Shinken Kourin Densetsu-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-artwork.png\n";
        $skipped++;
    }
}

// Mortal Kombat - Shinken Kourin Densetsu → Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)
if (file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-cover.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-cover.png')) {
        if (rename($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-cover.png', $imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-cover.png')) {
            echo "✓ Mortal Kombat - Shinken Kourin Densetsu-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-cover.png\n";
        $skipped++;
    }
}

// Mortal Kombat - Shinken Kourin Densetsu → Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)
if (file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-gameplay.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-gameplay.png')) {
        if (rename($imageDir . '/Mortal Kombat - Shinken Kourin Densetsu-gameplay.png', $imageDir . '/Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-gameplay.png')) {
            echo "✓ Mortal Kombat - Shinken Kourin Densetsu-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat - Shinken Kourin Densetsu (Japan) (En)-gameplay.png\n";
        $skipped++;
    }
}

// Mortal Kombat 3 → Mortal Kombat 3 (Europe)
if (file_exists($imageDir . '/Mortal Kombat 3-artwork.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat 3 (Europe)-artwork.png')) {
        if (rename($imageDir . '/Mortal Kombat 3-artwork.png', $imageDir . '/Mortal Kombat 3 (Europe)-artwork.png')) {
            echo "✓ Mortal Kombat 3-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat 3 (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Mortal Kombat 3 → Mortal Kombat 3 (Europe)
if (file_exists($imageDir . '/Mortal Kombat 3-cover.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat 3 (Europe)-cover.png')) {
        if (rename($imageDir . '/Mortal Kombat 3-cover.png', $imageDir . '/Mortal Kombat 3 (Europe)-cover.png')) {
            echo "✓ Mortal Kombat 3-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat 3 (Europe)-cover.png\n";
        $skipped++;
    }
}

// Mortal Kombat 3 → Mortal Kombat 3 (Europe)
if (file_exists($imageDir . '/Mortal Kombat 3-gameplay.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat 3 (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Mortal Kombat 3-gameplay.png', $imageDir . '/Mortal Kombat 3 (Europe)-gameplay.png')) {
            echo "✓ Mortal Kombat 3-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat 3 (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Mortal Kombat II → Mortal Kombat II (World)
if (file_exists($imageDir . '/Mortal Kombat II-artwork.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat II (World)-artwork.png')) {
        if (rename($imageDir . '/Mortal Kombat II-artwork.png', $imageDir . '/Mortal Kombat II (World)-artwork.png')) {
            echo "✓ Mortal Kombat II-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat II (World)-artwork.png\n";
        $skipped++;
    }
}

// Mortal Kombat II → Mortal Kombat II (World)
if (file_exists($imageDir . '/Mortal Kombat II-cover.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat II (World)-cover.png')) {
        if (rename($imageDir . '/Mortal Kombat II-cover.png', $imageDir . '/Mortal Kombat II (World)-cover.png')) {
            echo "✓ Mortal Kombat II-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat II (World)-cover.png\n";
        $skipped++;
    }
}

// Mortal Kombat II → Mortal Kombat II (World)
if (file_exists($imageDir . '/Mortal Kombat II-gameplay.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat II (World)-gameplay.png')) {
        if (rename($imageDir . '/Mortal Kombat II-gameplay.png', $imageDir . '/Mortal Kombat II (World)-gameplay.png')) {
            echo "✓ Mortal Kombat II-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat II (World)-gameplay.png\n";
        $skipped++;
    }
}

// Ms. Pac-Man → Ms. Pac-Man (USA)
if (file_exists($imageDir . '/Ms. Pac-Man-artwork.png')) {
    if (!file_exists($imageDir . '/Ms. Pac-Man (USA)-artwork.png')) {
        if (rename($imageDir . '/Ms. Pac-Man-artwork.png', $imageDir . '/Ms. Pac-Man (USA)-artwork.png')) {
            echo "✓ Ms. Pac-Man-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ms. Pac-Man (USA)-artwork.png\n";
        $skipped++;
    }
}

// Ms. Pac-Man → Ms. Pac-Man (USA)
if (file_exists($imageDir . '/Ms. Pac-Man-cover.png')) {
    if (!file_exists($imageDir . '/Ms. Pac-Man (USA)-cover.png')) {
        if (rename($imageDir . '/Ms. Pac-Man-cover.png', $imageDir . '/Ms. Pac-Man (USA)-cover.png')) {
            echo "✓ Ms. Pac-Man-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ms. Pac-Man (USA)-cover.png\n";
        $skipped++;
    }
}

// Ms. Pac-Man → Ms. Pac-Man (USA)
if (file_exists($imageDir . '/Ms. Pac-Man-gameplay.png')) {
    if (!file_exists($imageDir . '/Ms. Pac-Man (USA)-gameplay.png')) {
        if (rename($imageDir . '/Ms. Pac-Man-gameplay.png', $imageDir . '/Ms. Pac-Man (USA)-gameplay.png')) {
            echo "✓ Ms. Pac-Man-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ms. Pac-Man (USA)-gameplay.png\n";
        $skipped++;
    }
}

// NBA Action Starring David Robinson → NBA Action Starring David Robinson (USA, Brazil)
if (file_exists($imageDir . '/NBA Action Starring David Robinson-artwork.png')) {
    if (!file_exists($imageDir . '/NBA Action Starring David Robinson (USA, Brazil)-artwork.png')) {
        if (rename($imageDir . '/NBA Action Starring David Robinson-artwork.png', $imageDir . '/NBA Action Starring David Robinson (USA, Brazil)-artwork.png')) {
            echo "✓ NBA Action Starring David Robinson-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Action Starring David Robinson (USA, Brazil)-artwork.png\n";
        $skipped++;
    }
}

// NBA Action Starring David Robinson → NBA Action Starring David Robinson (USA, Brazil)
if (file_exists($imageDir . '/NBA Action Starring David Robinson-cover.png')) {
    if (!file_exists($imageDir . '/NBA Action Starring David Robinson (USA, Brazil)-cover.png')) {
        if (rename($imageDir . '/NBA Action Starring David Robinson-cover.png', $imageDir . '/NBA Action Starring David Robinson (USA, Brazil)-cover.png')) {
            echo "✓ NBA Action Starring David Robinson-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Action Starring David Robinson (USA, Brazil)-cover.png\n";
        $skipped++;
    }
}

// NBA Action Starring David Robinson → NBA Action Starring David Robinson (USA, Brazil)
if (file_exists($imageDir . '/NBA Action Starring David Robinson-gameplay.png')) {
    if (!file_exists($imageDir . '/NBA Action Starring David Robinson (USA, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/NBA Action Starring David Robinson-gameplay.png', $imageDir . '/NBA Action Starring David Robinson (USA, Brazil)-gameplay.png')) {
            echo "✓ NBA Action Starring David Robinson-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Action Starring David Robinson (USA, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// NBA Jam - Tournament Edition → NBA Jam - Tournament Edition (World)
if (file_exists($imageDir . '/NBA Jam - Tournament Edition-artwork.png')) {
    if (!file_exists($imageDir . '/NBA Jam - Tournament Edition (World)-artwork.png')) {
        if (rename($imageDir . '/NBA Jam - Tournament Edition-artwork.png', $imageDir . '/NBA Jam - Tournament Edition (World)-artwork.png')) {
            echo "✓ NBA Jam - Tournament Edition-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Jam - Tournament Edition (World)-artwork.png\n";
        $skipped++;
    }
}

// NBA Jam - Tournament Edition → NBA Jam - Tournament Edition (World)
if (file_exists($imageDir . '/NBA Jam - Tournament Edition-cover.png')) {
    if (!file_exists($imageDir . '/NBA Jam - Tournament Edition (World)-cover.png')) {
        if (rename($imageDir . '/NBA Jam - Tournament Edition-cover.png', $imageDir . '/NBA Jam - Tournament Edition (World)-cover.png')) {
            echo "✓ NBA Jam - Tournament Edition-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Jam - Tournament Edition (World)-cover.png\n";
        $skipped++;
    }
}

// NBA Jam - Tournament Edition → NBA Jam - Tournament Edition (World)
if (file_exists($imageDir . '/NBA Jam - Tournament Edition-gameplay.png')) {
    if (!file_exists($imageDir . '/NBA Jam - Tournament Edition (World)-gameplay.png')) {
        if (rename($imageDir . '/NBA Jam - Tournament Edition-gameplay.png', $imageDir . '/NBA Jam - Tournament Edition (World)-gameplay.png')) {
            echo "✓ NBA Jam - Tournament Edition-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Jam - Tournament Edition (World)-gameplay.png\n";
        $skipped++;
    }
}

// NFL '95 → NFL '95 (USA)
if (file_exists($imageDir . '/NFL \'95-artwork.png')) {
    if (!file_exists($imageDir . '/NFL \'95 (USA)-artwork.png')) {
        if (rename($imageDir . '/NFL \'95-artwork.png', $imageDir . '/NFL \'95 (USA)-artwork.png')) {
            echo "✓ NFL \'95-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL \'95 (USA)-artwork.png\n";
        $skipped++;
    }
}

// NFL '95 → NFL '95 (USA)
if (file_exists($imageDir . '/NFL \'95-cover.png')) {
    if (!file_exists($imageDir . '/NFL \'95 (USA)-cover.png')) {
        if (rename($imageDir . '/NFL \'95-cover.png', $imageDir . '/NFL \'95 (USA)-cover.png')) {
            echo "✓ NFL \'95-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL \'95 (USA)-cover.png\n";
        $skipped++;
    }
}

// NFL '95 → NFL '95 (USA)
if (file_exists($imageDir . '/NFL \'95-gameplay.png')) {
    if (!file_exists($imageDir . '/NFL \'95 (USA)-gameplay.png')) {
        if (rename($imageDir . '/NFL \'95-gameplay.png', $imageDir . '/NFL \'95 (USA)-gameplay.png')) {
            echo "✓ NFL \'95-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL \'95 (USA)-gameplay.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club 96 → NFL Quarterback Club 96 (USA)
if (file_exists($imageDir . '/NFL Quarterback Club 96-artwork.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club 96 (USA)-artwork.png')) {
        if (rename($imageDir . '/NFL Quarterback Club 96-artwork.png', $imageDir . '/NFL Quarterback Club 96 (USA)-artwork.png')) {
            echo "✓ NFL Quarterback Club 96-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club 96 (USA)-artwork.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club 96 → NFL Quarterback Club 96 (USA)
if (file_exists($imageDir . '/NFL Quarterback Club 96-cover.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club 96 (USA)-cover.png')) {
        if (rename($imageDir . '/NFL Quarterback Club 96-cover.png', $imageDir . '/NFL Quarterback Club 96 (USA)-cover.png')) {
            echo "✓ NFL Quarterback Club 96-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club 96 (USA)-cover.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club 96 → NFL Quarterback Club 96 (USA)
if (file_exists($imageDir . '/NFL Quarterback Club 96-gameplay.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club 96 (USA)-gameplay.png')) {
        if (rename($imageDir . '/NFL Quarterback Club 96-gameplay.png', $imageDir . '/NFL Quarterback Club 96 (USA)-gameplay.png')) {
            echo "✓ NFL Quarterback Club 96-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club 96 (USA)-gameplay.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club → NFL Quarterback Club (World)
if (file_exists($imageDir . '/NFL Quarterback Club-artwork.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club (World)-artwork.png')) {
        if (rename($imageDir . '/NFL Quarterback Club-artwork.png', $imageDir . '/NFL Quarterback Club (World)-artwork.png')) {
            echo "✓ NFL Quarterback Club-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club (World)-artwork.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club → NFL Quarterback Club (World)
if (file_exists($imageDir . '/NFL Quarterback Club-cover.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club (World)-cover.png')) {
        if (rename($imageDir . '/NFL Quarterback Club-cover.png', $imageDir . '/NFL Quarterback Club (World)-cover.png')) {
            echo "✓ NFL Quarterback Club-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club (World)-cover.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club → NFL Quarterback Club (World)
if (file_exists($imageDir . '/NFL Quarterback Club-gameplay.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club (World)-gameplay.png')) {
        if (rename($imageDir . '/NFL Quarterback Club-gameplay.png', $imageDir . '/NFL Quarterback Club (World)-gameplay.png')) {
            echo "✓ NFL Quarterback Club-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club (World)-gameplay.png\n";
        $skipped++;
    }
}

// NHL All-Star Hockey → NHL All-Star Hockey (USA)
if (file_exists($imageDir . '/NHL All-Star Hockey-artwork.png')) {
    if (!file_exists($imageDir . '/NHL All-Star Hockey (USA)-artwork.png')) {
        if (rename($imageDir . '/NHL All-Star Hockey-artwork.png', $imageDir . '/NHL All-Star Hockey (USA)-artwork.png')) {
            echo "✓ NHL All-Star Hockey-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NHL All-Star Hockey (USA)-artwork.png\n";
        $skipped++;
    }
}

// NHL All-Star Hockey → NHL All-Star Hockey (USA)
if (file_exists($imageDir . '/NHL All-Star Hockey-cover.png')) {
    if (!file_exists($imageDir . '/NHL All-Star Hockey (USA)-cover.png')) {
        if (rename($imageDir . '/NHL All-Star Hockey-cover.png', $imageDir . '/NHL All-Star Hockey (USA)-cover.png')) {
            echo "✓ NHL All-Star Hockey-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NHL All-Star Hockey (USA)-cover.png\n";
        $skipped++;
    }
}

// NHL All-Star Hockey → NHL All-Star Hockey (USA)
if (file_exists($imageDir . '/NHL All-Star Hockey-gameplay.png')) {
    if (!file_exists($imageDir . '/NHL All-Star Hockey (USA)-gameplay.png')) {
        if (rename($imageDir . '/NHL All-Star Hockey-gameplay.png', $imageDir . '/NHL All-Star Hockey (USA)-gameplay.png')) {
            echo "✓ NHL All-Star Hockey-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NHL All-Star Hockey (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Nazo Puyo - Arle no Roux → Nazo Puyo - Arle no Roux (Japan)
if (file_exists($imageDir . '/Nazo Puyo - Arle no Roux-artwork.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo - Arle no Roux (Japan)-artwork.png')) {
        if (rename($imageDir . '/Nazo Puyo - Arle no Roux-artwork.png', $imageDir . '/Nazo Puyo - Arle no Roux (Japan)-artwork.png')) {
            echo "✓ Nazo Puyo - Arle no Roux-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo - Arle no Roux (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Nazo Puyo - Arle no Roux → Nazo Puyo - Arle no Roux (Japan)
if (file_exists($imageDir . '/Nazo Puyo - Arle no Roux-cover.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo - Arle no Roux (Japan)-cover.png')) {
        if (rename($imageDir . '/Nazo Puyo - Arle no Roux-cover.png', $imageDir . '/Nazo Puyo - Arle no Roux (Japan)-cover.png')) {
            echo "✓ Nazo Puyo - Arle no Roux-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo - Arle no Roux (Japan)-cover.png\n";
        $skipped++;
    }
}

// Nazo Puyo - Arle no Roux → Nazo Puyo - Arle no Roux (Japan)
if (file_exists($imageDir . '/Nazo Puyo - Arle no Roux-gameplay.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo - Arle no Roux (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Nazo Puyo - Arle no Roux-gameplay.png', $imageDir . '/Nazo Puyo - Arle no Roux (Japan)-gameplay.png')) {
            echo "✓ Nazo Puyo - Arle no Roux-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo - Arle no Roux (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Nazo Puyo 2 → Nazo Puyo 2 (Japan)
if (file_exists($imageDir . '/Nazo Puyo 2-artwork.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo 2 (Japan)-artwork.png')) {
        if (rename($imageDir . '/Nazo Puyo 2-artwork.png', $imageDir . '/Nazo Puyo 2 (Japan)-artwork.png')) {
            echo "✓ Nazo Puyo 2-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo 2 (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Nazo Puyo 2 → Nazo Puyo 2 (Japan)
if (file_exists($imageDir . '/Nazo Puyo 2-cover.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo 2 (Japan)-cover.png')) {
        if (rename($imageDir . '/Nazo Puyo 2-cover.png', $imageDir . '/Nazo Puyo 2 (Japan)-cover.png')) {
            echo "✓ Nazo Puyo 2-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo 2 (Japan)-cover.png\n";
        $skipped++;
    }
}

// Nazo Puyo 2 → Nazo Puyo 2 (Japan)
if (file_exists($imageDir . '/Nazo Puyo 2-gameplay.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo 2 (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Nazo Puyo 2-gameplay.png', $imageDir . '/Nazo Puyo 2 (Japan)-gameplay.png')) {
            echo "✓ Nazo Puyo 2-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo 2 (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Neko Daisuki! → Neko Daisuki! (Japan)
if (file_exists($imageDir . '/Neko Daisuki!-artwork.png')) {
    if (!file_exists($imageDir . '/Neko Daisuki! (Japan)-artwork.png')) {
        if (rename($imageDir . '/Neko Daisuki!-artwork.png', $imageDir . '/Neko Daisuki! (Japan)-artwork.png')) {
            echo "✓ Neko Daisuki!-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Neko Daisuki! (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Neko Daisuki! → Neko Daisuki! (Japan)
if (file_exists($imageDir . '/Neko Daisuki!-cover.png')) {
    if (!file_exists($imageDir . '/Neko Daisuki! (Japan)-cover.png')) {
        if (rename($imageDir . '/Neko Daisuki!-cover.png', $imageDir . '/Neko Daisuki! (Japan)-cover.png')) {
            echo "✓ Neko Daisuki!-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Neko Daisuki! (Japan)-cover.png\n";
        $skipped++;
    }
}

// Neko Daisuki! → Neko Daisuki! (Japan)
if (file_exists($imageDir . '/Neko Daisuki!-gameplay.png')) {
    if (!file_exists($imageDir . '/Neko Daisuki! (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Neko Daisuki!-gameplay.png', $imageDir . '/Neko Daisuki! (Japan)-gameplay.png')) {
            echo "✓ Neko Daisuki!-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Neko Daisuki! (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Ninja Gaiden → Ninja Gaiden (Japan)
if (file_exists($imageDir . '/Ninja Gaiden-artwork.png')) {
    if (!file_exists($imageDir . '/Ninja Gaiden (Japan)-artwork.png')) {
        if (rename($imageDir . '/Ninja Gaiden-artwork.png', $imageDir . '/Ninja Gaiden (Japan)-artwork.png')) {
            echo "✓ Ninja Gaiden-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninja Gaiden (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Ninja Gaiden → Ninja Gaiden (Japan)
if (file_exists($imageDir . '/Ninja Gaiden-cover.png')) {
    if (!file_exists($imageDir . '/Ninja Gaiden (Japan)-cover.png')) {
        if (rename($imageDir . '/Ninja Gaiden-cover.png', $imageDir . '/Ninja Gaiden (Japan)-cover.png')) {
            echo "✓ Ninja Gaiden-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninja Gaiden (Japan)-cover.png\n";
        $skipped++;
    }
}

// Ninja Gaiden → Ninja Gaiden (Japan)
if (file_exists($imageDir . '/Ninja Gaiden-gameplay.png')) {
    if (!file_exists($imageDir . '/Ninja Gaiden (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Ninja Gaiden-gameplay.png', $imageDir . '/Ninja Gaiden (Japan)-gameplay.png')) {
            echo "✓ Ninja Gaiden-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninja Gaiden (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Ninku 2 - Tenkuuryuu-e no Michi → Ninku 2 - Tenkuuryuu-e no Michi (Japan)
if (file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-artwork.png')) {
    if (!file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-artwork.png')) {
        if (rename($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-artwork.png', $imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-artwork.png')) {
            echo "✓ Ninku 2 - Tenkuuryuu-e no Michi-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku 2 - Tenkuuryuu-e no Michi (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Ninku 2 - Tenkuuryuu-e no Michi → Ninku 2 - Tenkuuryuu-e no Michi (Japan)
if (file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-cover.png')) {
    if (!file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-cover.png')) {
        if (rename($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-cover.png', $imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-cover.png')) {
            echo "✓ Ninku 2 - Tenkuuryuu-e no Michi-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku 2 - Tenkuuryuu-e no Michi (Japan)-cover.png\n";
        $skipped++;
    }
}

// Ninku 2 - Tenkuuryuu-e no Michi → Ninku 2 - Tenkuuryuu-e no Michi (Japan)
if (file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-gameplay.png')) {
    if (!file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-gameplay.png', $imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-gameplay.png')) {
            echo "✓ Ninku 2 - Tenkuuryuu-e no Michi-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku 2 - Tenkuuryuu-e no Michi (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Ninku Gaiden - Hiroyuki Daikatsugeki → Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)
if (file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-artwork.png')) {
    if (!file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-artwork.png')) {
        if (rename($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-artwork.png', $imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-artwork.png')) {
            echo "✓ Ninku Gaiden - Hiroyuki Daikatsugeki-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Ninku Gaiden - Hiroyuki Daikatsugeki → Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)
if (file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-cover.png')) {
    if (!file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-cover.png')) {
        if (rename($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-cover.png', $imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-cover.png')) {
            echo "✓ Ninku Gaiden - Hiroyuki Daikatsugeki-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-cover.png\n";
        $skipped++;
    }
}

// Ninku Gaiden - Hiroyuki Daikatsugeki → Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)
if (file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-gameplay.png')) {
    if (!file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-gameplay.png', $imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-gameplay.png')) {
            echo "✓ Ninku Gaiden - Hiroyuki Daikatsugeki-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Nomo Hideo no World Series Baseball → Nomo Hideo no World Series Baseball (Japan)
if (file_exists($imageDir . '/Nomo Hideo no World Series Baseball-artwork.png')) {
    if (!file_exists($imageDir . '/Nomo Hideo no World Series Baseball (Japan)-artwork.png')) {
        if (rename($imageDir . '/Nomo Hideo no World Series Baseball-artwork.png', $imageDir . '/Nomo Hideo no World Series Baseball (Japan)-artwork.png')) {
            echo "✓ Nomo Hideo no World Series Baseball-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nomo Hideo no World Series Baseball (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Nomo Hideo no World Series Baseball → Nomo Hideo no World Series Baseball (Japan)
if (file_exists($imageDir . '/Nomo Hideo no World Series Baseball-cover.png')) {
    if (!file_exists($imageDir . '/Nomo Hideo no World Series Baseball (Japan)-cover.png')) {
        if (rename($imageDir . '/Nomo Hideo no World Series Baseball-cover.png', $imageDir . '/Nomo Hideo no World Series Baseball (Japan)-cover.png')) {
            echo "✓ Nomo Hideo no World Series Baseball-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nomo Hideo no World Series Baseball (Japan)-cover.png\n";
        $skipped++;
    }
}

// Nomo Hideo no World Series Baseball → Nomo Hideo no World Series Baseball (Japan)
if (file_exists($imageDir . '/Nomo Hideo no World Series Baseball-gameplay.png')) {
    if (!file_exists($imageDir . '/Nomo Hideo no World Series Baseball (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Nomo Hideo no World Series Baseball-gameplay.png', $imageDir . '/Nomo Hideo no World Series Baseball (Japan)-gameplay.png')) {
            echo "✓ Nomo Hideo no World Series Baseball-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nomo Hideo no World Series Baseball (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// OutRun Europa → OutRun Europa (USA)
if (file_exists($imageDir . '/OutRun Europa-artwork.png')) {
    if (!file_exists($imageDir . '/OutRun Europa (USA)-artwork.png')) {
        if (rename($imageDir . '/OutRun Europa-artwork.png', $imageDir . '/OutRun Europa (USA)-artwork.png')) {
            echo "✓ OutRun Europa-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa (USA)-artwork.png\n";
        $skipped++;
    }
}

// OutRun Europa → OutRun Europa (USA)
if (file_exists($imageDir . '/OutRun Europa-cover.png')) {
    if (!file_exists($imageDir . '/OutRun Europa (USA)-cover.png')) {
        if (rename($imageDir . '/OutRun Europa-cover.png', $imageDir . '/OutRun Europa (USA)-cover.png')) {
            echo "✓ OutRun Europa-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa (USA)-cover.png\n";
        $skipped++;
    }
}

// OutRun Europa → OutRun Europa (USA)
if (file_exists($imageDir . '/OutRun Europa-gameplay.png')) {
    if (!file_exists($imageDir . '/OutRun Europa (USA)-gameplay.png')) {
        if (rename($imageDir . '/OutRun Europa-gameplay.png', $imageDir . '/OutRun Europa (USA)-gameplay.png')) {
            echo "✓ OutRun Europa-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Pac-Attack → Pac-Attack (USA)
if (file_exists($imageDir . '/Pac-Attack-artwork.png')) {
    if (!file_exists($imageDir . '/Pac-Attack (USA)-artwork.png')) {
        if (rename($imageDir . '/Pac-Attack-artwork.png', $imageDir . '/Pac-Attack (USA)-artwork.png')) {
            echo "✓ Pac-Attack-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Attack (USA)-artwork.png\n";
        $skipped++;
    }
}

// Pac-Attack → Pac-Attack (USA)
if (file_exists($imageDir . '/Pac-Attack-cover.png')) {
    if (!file_exists($imageDir . '/Pac-Attack (USA)-cover.png')) {
        if (rename($imageDir . '/Pac-Attack-cover.png', $imageDir . '/Pac-Attack (USA)-cover.png')) {
            echo "✓ Pac-Attack-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Attack (USA)-cover.png\n";
        $skipped++;
    }
}

// Pac-Attack → Pac-Attack (USA)
if (file_exists($imageDir . '/Pac-Attack-gameplay.png')) {
    if (!file_exists($imageDir . '/Pac-Attack (USA)-gameplay.png')) {
        if (rename($imageDir . '/Pac-Attack-gameplay.png', $imageDir . '/Pac-Attack (USA)-gameplay.png')) {
            echo "✓ Pac-Attack-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Attack (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Pac-Man → Pac-Man (USA)
if (file_exists($imageDir . '/Pac-Man-artwork.png')) {
    if (!file_exists($imageDir . '/Pac-Man (USA)-artwork.png')) {
        if (rename($imageDir . '/Pac-Man-artwork.png', $imageDir . '/Pac-Man (USA)-artwork.png')) {
            echo "✓ Pac-Man-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Man (USA)-artwork.png\n";
        $skipped++;
    }
}

// Pac-Man → Pac-Man (USA)
if (file_exists($imageDir . '/Pac-Man-cover.png')) {
    if (!file_exists($imageDir . '/Pac-Man (USA)-cover.png')) {
        if (rename($imageDir . '/Pac-Man-cover.png', $imageDir . '/Pac-Man (USA)-cover.png')) {
            echo "✓ Pac-Man-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Man (USA)-cover.png\n";
        $skipped++;
    }
}

// Pac-Man → Pac-Man (USA)
if (file_exists($imageDir . '/Pac-Man-gameplay.png')) {
    if (!file_exists($imageDir . '/Pac-Man (USA)-gameplay.png')) {
        if (rename($imageDir . '/Pac-Man-gameplay.png', $imageDir . '/Pac-Man (USA)-gameplay.png')) {
            echo "✓ Pac-Man-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Man (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Panzer Dragoon Mini → Panzer Dragoon Mini (Japan) (En)
if (file_exists($imageDir . '/Panzer Dragoon Mini-artwork.png')) {
    if (!file_exists($imageDir . '/Panzer Dragoon Mini (Japan) (En)-artwork.png')) {
        if (rename($imageDir . '/Panzer Dragoon Mini-artwork.png', $imageDir . '/Panzer Dragoon Mini (Japan) (En)-artwork.png')) {
            echo "✓ Panzer Dragoon Mini-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Panzer Dragoon Mini (Japan) (En)-artwork.png\n";
        $skipped++;
    }
}

// Panzer Dragoon Mini → Panzer Dragoon Mini (Japan) (En)
if (file_exists($imageDir . '/Panzer Dragoon Mini-cover.png')) {
    if (!file_exists($imageDir . '/Panzer Dragoon Mini (Japan) (En)-cover.png')) {
        if (rename($imageDir . '/Panzer Dragoon Mini-cover.png', $imageDir . '/Panzer Dragoon Mini (Japan) (En)-cover.png')) {
            echo "✓ Panzer Dragoon Mini-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Panzer Dragoon Mini (Japan) (En)-cover.png\n";
        $skipped++;
    }
}

// Panzer Dragoon Mini → Panzer Dragoon Mini (Japan) (En)
if (file_exists($imageDir . '/Panzer Dragoon Mini-gameplay.png')) {
    if (!file_exists($imageDir . '/Panzer Dragoon Mini (Japan) (En)-gameplay.png')) {
        if (rename($imageDir . '/Panzer Dragoon Mini-gameplay.png', $imageDir . '/Panzer Dragoon Mini (Japan) (En)-gameplay.png')) {
            echo "✓ Panzer Dragoon Mini-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Panzer Dragoon Mini (Japan) (En)-gameplay.png\n";
        $skipped++;
    }
}

// Paperboy 2 → Paperboy 2 (USA)
if (file_exists($imageDir . '/Paperboy 2-artwork.png')) {
    if (!file_exists($imageDir . '/Paperboy 2 (USA)-artwork.png')) {
        if (rename($imageDir . '/Paperboy 2-artwork.png', $imageDir . '/Paperboy 2 (USA)-artwork.png')) {
            echo "✓ Paperboy 2-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Paperboy 2 (USA)-artwork.png\n";
        $skipped++;
    }
}

// Paperboy 2 → Paperboy 2 (USA)
if (file_exists($imageDir . '/Paperboy 2-cover.png')) {
    if (!file_exists($imageDir . '/Paperboy 2 (USA)-cover.png')) {
        if (rename($imageDir . '/Paperboy 2-cover.png', $imageDir . '/Paperboy 2 (USA)-cover.png')) {
            echo "✓ Paperboy 2-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Paperboy 2 (USA)-cover.png\n";
        $skipped++;
    }
}

// Paperboy 2 → Paperboy 2 (USA)
if (file_exists($imageDir . '/Paperboy 2-gameplay.png')) {
    if (!file_exists($imageDir . '/Paperboy 2 (USA)-gameplay.png')) {
        if (rename($imageDir . '/Paperboy 2-gameplay.png', $imageDir . '/Paperboy 2 (USA)-gameplay.png')) {
            echo "✓ Paperboy 2-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Paperboy 2 (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Pet Club - Inu Daisuki! → Pet Club - Inu Daisuki! (Japan)
if (file_exists($imageDir . '/Pet Club - Inu Daisuki!-artwork.png')) {
    if (!file_exists($imageDir . '/Pet Club - Inu Daisuki! (Japan)-artwork.png')) {
        if (rename($imageDir . '/Pet Club - Inu Daisuki!-artwork.png', $imageDir . '/Pet Club - Inu Daisuki! (Japan)-artwork.png')) {
            echo "✓ Pet Club - Inu Daisuki!-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pet Club - Inu Daisuki! (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Pet Club - Inu Daisuki! → Pet Club - Inu Daisuki! (Japan)
if (file_exists($imageDir . '/Pet Club - Inu Daisuki!-cover.png')) {
    if (!file_exists($imageDir . '/Pet Club - Inu Daisuki! (Japan)-cover.png')) {
        if (rename($imageDir . '/Pet Club - Inu Daisuki!-cover.png', $imageDir . '/Pet Club - Inu Daisuki! (Japan)-cover.png')) {
            echo "✓ Pet Club - Inu Daisuki!-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pet Club - Inu Daisuki! (Japan)-cover.png\n";
        $skipped++;
    }
}

// Pet Club - Inu Daisuki! → Pet Club - Inu Daisuki! (Japan)
if (file_exists($imageDir . '/Pet Club - Inu Daisuki!-gameplay.png')) {
    if (!file_exists($imageDir . '/Pet Club - Inu Daisuki! (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Pet Club - Inu Daisuki!-gameplay.png', $imageDir . '/Pet Club - Inu Daisuki! (Japan)-gameplay.png')) {
            echo "✓ Pet Club - Inu Daisuki!-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pet Club - Inu Daisuki! (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Pete Sampras Tennis → Pete Sampras Tennis (USA)
if (file_exists($imageDir . '/Pete Sampras Tennis-artwork.png')) {
    if (!file_exists($imageDir . '/Pete Sampras Tennis (USA)-artwork.png')) {
        if (rename($imageDir . '/Pete Sampras Tennis-artwork.png', $imageDir . '/Pete Sampras Tennis (USA)-artwork.png')) {
            echo "✓ Pete Sampras Tennis-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pete Sampras Tennis (USA)-artwork.png\n";
        $skipped++;
    }
}

// Pete Sampras Tennis → Pete Sampras Tennis (USA)
if (file_exists($imageDir . '/Pete Sampras Tennis-cover.png')) {
    if (!file_exists($imageDir . '/Pete Sampras Tennis (USA)-cover.png')) {
        if (rename($imageDir . '/Pete Sampras Tennis-cover.png', $imageDir . '/Pete Sampras Tennis (USA)-cover.png')) {
            echo "✓ Pete Sampras Tennis-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pete Sampras Tennis (USA)-cover.png\n";
        $skipped++;
    }
}

// Pete Sampras Tennis → Pete Sampras Tennis (USA)
if (file_exists($imageDir . '/Pete Sampras Tennis-gameplay.png')) {
    if (!file_exists($imageDir . '/Pete Sampras Tennis (USA)-gameplay.png')) {
        if (rename($imageDir . '/Pete Sampras Tennis-gameplay.png', $imageDir . '/Pete Sampras Tennis (USA)-gameplay.png')) {
            echo "✓ Pete Sampras Tennis-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pete Sampras Tennis (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Phantasy Star Adventure → Phantasy Star Adventure (Japan)
if (file_exists($imageDir . '/Phantasy Star Adventure-artwork.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Adventure (Japan)-artwork.png')) {
        if (rename($imageDir . '/Phantasy Star Adventure-artwork.png', $imageDir . '/Phantasy Star Adventure (Japan)-artwork.png')) {
            echo "✓ Phantasy Star Adventure-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Adventure (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Phantasy Star Adventure → Phantasy Star Adventure (Japan)
if (file_exists($imageDir . '/Phantasy Star Adventure-cover.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Adventure (Japan)-cover.png')) {
        if (rename($imageDir . '/Phantasy Star Adventure-cover.png', $imageDir . '/Phantasy Star Adventure (Japan)-cover.png')) {
            echo "✓ Phantasy Star Adventure-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Adventure (Japan)-cover.png\n";
        $skipped++;
    }
}

// Phantasy Star Adventure → Phantasy Star Adventure (Japan)
if (file_exists($imageDir . '/Phantasy Star Adventure-gameplay.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Adventure (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Phantasy Star Adventure-gameplay.png', $imageDir . '/Phantasy Star Adventure (Japan)-gameplay.png')) {
            echo "✓ Phantasy Star Adventure-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Adventure (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Phantasy Star Gaiden → Phantasy Star Gaiden (Japan)
if (file_exists($imageDir . '/Phantasy Star Gaiden-artwork.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Gaiden (Japan)-artwork.png')) {
        if (rename($imageDir . '/Phantasy Star Gaiden-artwork.png', $imageDir . '/Phantasy Star Gaiden (Japan)-artwork.png')) {
            echo "✓ Phantasy Star Gaiden-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Gaiden (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Phantasy Star Gaiden → Phantasy Star Gaiden (Japan)
if (file_exists($imageDir . '/Phantasy Star Gaiden-cover.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Gaiden (Japan)-cover.png')) {
        if (rename($imageDir . '/Phantasy Star Gaiden-cover.png', $imageDir . '/Phantasy Star Gaiden (Japan)-cover.png')) {
            echo "✓ Phantasy Star Gaiden-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Gaiden (Japan)-cover.png\n";
        $skipped++;
    }
}

// Phantasy Star Gaiden → Phantasy Star Gaiden (Japan)
if (file_exists($imageDir . '/Phantasy Star Gaiden-gameplay.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Gaiden (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Phantasy Star Gaiden-gameplay.png', $imageDir . '/Phantasy Star Gaiden (Japan)-gameplay.png')) {
            echo "✓ Phantasy Star Gaiden-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Gaiden (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Pinball Dreams → Pinball Dreams (USA)
if (file_exists($imageDir . '/Pinball Dreams-artwork.png')) {
    if (!file_exists($imageDir . '/Pinball Dreams (USA)-artwork.png')) {
        if (rename($imageDir . '/Pinball Dreams-artwork.png', $imageDir . '/Pinball Dreams (USA)-artwork.png')) {
            echo "✓ Pinball Dreams-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pinball Dreams (USA)-artwork.png\n";
        $skipped++;
    }
}

// Pinball Dreams → Pinball Dreams (USA)
if (file_exists($imageDir . '/Pinball Dreams-cover.png')) {
    if (!file_exists($imageDir . '/Pinball Dreams (USA)-cover.png')) {
        if (rename($imageDir . '/Pinball Dreams-cover.png', $imageDir . '/Pinball Dreams (USA)-cover.png')) {
            echo "✓ Pinball Dreams-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pinball Dreams (USA)-cover.png\n";
        $skipped++;
    }
}

// Pinball Dreams → Pinball Dreams (USA)
if (file_exists($imageDir . '/Pinball Dreams-gameplay.png')) {
    if (!file_exists($imageDir . '/Pinball Dreams (USA)-gameplay.png')) {
        if (rename($imageDir . '/Pinball Dreams-gameplay.png', $imageDir . '/Pinball Dreams (USA)-gameplay.png')) {
            echo "✓ Pinball Dreams-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pinball Dreams (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Pocket Jansou → Pocket Jansou (Japan)
if (file_exists($imageDir . '/Pocket Jansou-artwork.png')) {
    if (!file_exists($imageDir . '/Pocket Jansou (Japan)-artwork.png')) {
        if (rename($imageDir . '/Pocket Jansou-artwork.png', $imageDir . '/Pocket Jansou (Japan)-artwork.png')) {
            echo "✓ Pocket Jansou-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pocket Jansou (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Pocket Jansou → Pocket Jansou (Japan)
if (file_exists($imageDir . '/Pocket Jansou-cover.png')) {
    if (!file_exists($imageDir . '/Pocket Jansou (Japan)-cover.png')) {
        if (rename($imageDir . '/Pocket Jansou-cover.png', $imageDir . '/Pocket Jansou (Japan)-cover.png')) {
            echo "✓ Pocket Jansou-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pocket Jansou (Japan)-cover.png\n";
        $skipped++;
    }
}

// Pocket Jansou → Pocket Jansou (Japan)
if (file_exists($imageDir . '/Pocket Jansou-gameplay.png')) {
    if (!file_exists($imageDir . '/Pocket Jansou (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Pocket Jansou-gameplay.png', $imageDir . '/Pocket Jansou (Japan)-gameplay.png')) {
            echo "✓ Pocket Jansou-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pocket Jansou (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Blackjack → Poker Face Paul's Blackjack (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Blackjack-artwork.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Blackjack (USA)-artwork.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Blackjack-artwork.png', $imageDir . '/Poker Face Paul\'s Blackjack (USA)-artwork.png')) {
            echo "✓ Poker Face Paul\'s Blackjack-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Blackjack (USA)-artwork.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Blackjack → Poker Face Paul's Blackjack (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Blackjack-cover.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Blackjack (USA)-cover.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Blackjack-cover.png', $imageDir . '/Poker Face Paul\'s Blackjack (USA)-cover.png')) {
            echo "✓ Poker Face Paul\'s Blackjack-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Blackjack (USA)-cover.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Blackjack → Poker Face Paul's Blackjack (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Blackjack-gameplay.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Blackjack (USA)-gameplay.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Blackjack-gameplay.png', $imageDir . '/Poker Face Paul\'s Blackjack (USA)-gameplay.png')) {
            echo "✓ Poker Face Paul\'s Blackjack-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Blackjack (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Gin → Poker Face Paul's Gin (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Gin-artwork.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Gin (USA)-artwork.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Gin-artwork.png', $imageDir . '/Poker Face Paul\'s Gin (USA)-artwork.png')) {
            echo "✓ Poker Face Paul\'s Gin-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Gin (USA)-artwork.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Gin → Poker Face Paul's Gin (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Gin-cover.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Gin (USA)-cover.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Gin-cover.png', $imageDir . '/Poker Face Paul\'s Gin (USA)-cover.png')) {
            echo "✓ Poker Face Paul\'s Gin-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Gin (USA)-cover.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Gin → Poker Face Paul's Gin (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Gin-gameplay.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Gin (USA)-gameplay.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Gin-gameplay.png', $imageDir . '/Poker Face Paul\'s Gin (USA)-gameplay.png')) {
            echo "✓ Poker Face Paul\'s Gin-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Gin (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Poker → Poker Face Paul's Poker (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Poker-artwork.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Poker (USA)-artwork.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Poker-artwork.png', $imageDir . '/Poker Face Paul\'s Poker (USA)-artwork.png')) {
            echo "✓ Poker Face Paul\'s Poker-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Poker (USA)-artwork.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Poker → Poker Face Paul's Poker (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Poker-cover.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Poker (USA)-cover.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Poker-cover.png', $imageDir . '/Poker Face Paul\'s Poker (USA)-cover.png')) {
            echo "✓ Poker Face Paul\'s Poker-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Poker (USA)-cover.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Poker → Poker Face Paul's Poker (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Poker-gameplay.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Poker (USA)-gameplay.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Poker-gameplay.png', $imageDir . '/Poker Face Paul\'s Poker (USA)-gameplay.png')) {
            echo "✓ Poker Face Paul\'s Poker-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Poker (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Solitaire → Poker Face Paul's Solitaire (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Solitaire-artwork.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Solitaire (USA)-artwork.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Solitaire-artwork.png', $imageDir . '/Poker Face Paul\'s Solitaire (USA)-artwork.png')) {
            echo "✓ Poker Face Paul\'s Solitaire-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Solitaire (USA)-artwork.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Solitaire → Poker Face Paul's Solitaire (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Solitaire-cover.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Solitaire (USA)-cover.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Solitaire-cover.png', $imageDir . '/Poker Face Paul\'s Solitaire (USA)-cover.png')) {
            echo "✓ Poker Face Paul\'s Solitaire-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Solitaire (USA)-cover.png\n";
        $skipped++;
    }
}

// Poker Face Paul's Solitaire → Poker Face Paul's Solitaire (USA)
if (file_exists($imageDir . '/Poker Face Paul\'s Solitaire-gameplay.png')) {
    if (!file_exists($imageDir . '/Poker Face Paul\'s Solitaire (USA)-gameplay.png')) {
        if (rename($imageDir . '/Poker Face Paul\'s Solitaire-gameplay.png', $imageDir . '/Poker Face Paul\'s Solitaire (USA)-gameplay.png')) {
            echo "✓ Poker Face Paul\'s Solitaire-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Poker Face Paul\'s Solitaire (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Popeye no Beach Volleyball → Popeye no Beach Volleyball (Japan)
if (file_exists($imageDir . '/Popeye no Beach Volleyball-artwork.png')) {
    if (!file_exists($imageDir . '/Popeye no Beach Volleyball (Japan)-artwork.png')) {
        if (rename($imageDir . '/Popeye no Beach Volleyball-artwork.png', $imageDir . '/Popeye no Beach Volleyball (Japan)-artwork.png')) {
            echo "✓ Popeye no Beach Volleyball-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Popeye no Beach Volleyball (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Popeye no Beach Volleyball → Popeye no Beach Volleyball (Japan)
if (file_exists($imageDir . '/Popeye no Beach Volleyball-cover.png')) {
    if (!file_exists($imageDir . '/Popeye no Beach Volleyball (Japan)-cover.png')) {
        if (rename($imageDir . '/Popeye no Beach Volleyball-cover.png', $imageDir . '/Popeye no Beach Volleyball (Japan)-cover.png')) {
            echo "✓ Popeye no Beach Volleyball-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Popeye no Beach Volleyball (Japan)-cover.png\n";
        $skipped++;
    }
}

// Popeye no Beach Volleyball → Popeye no Beach Volleyball (Japan)
if (file_exists($imageDir . '/Popeye no Beach Volleyball-gameplay.png')) {
    if (!file_exists($imageDir . '/Popeye no Beach Volleyball (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Popeye no Beach Volleyball-gameplay.png', $imageDir . '/Popeye no Beach Volleyball (Japan)-gameplay.png')) {
            echo "✓ Popeye no Beach Volleyball-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Popeye no Beach Volleyball (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Power Drive → Power Drive (Europe)
if (file_exists($imageDir . '/Power Drive-artwork.png')) {
    if (!file_exists($imageDir . '/Power Drive (Europe)-artwork.png')) {
        if (rename($imageDir . '/Power Drive-artwork.png', $imageDir . '/Power Drive (Europe)-artwork.png')) {
            echo "✓ Power Drive-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Power Drive (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Power Drive → Power Drive (Europe)
if (file_exists($imageDir . '/Power Drive-cover.png')) {
    if (!file_exists($imageDir . '/Power Drive (Europe)-cover.png')) {
        if (rename($imageDir . '/Power Drive-cover.png', $imageDir . '/Power Drive (Europe)-cover.png')) {
            echo "✓ Power Drive-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Power Drive (Europe)-cover.png\n";
        $skipped++;
    }
}

// Power Drive → Power Drive (Europe)
if (file_exists($imageDir . '/Power Drive-gameplay.png')) {
    if (!file_exists($imageDir . '/Power Drive (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Power Drive-gameplay.png', $imageDir . '/Power Drive (Europe)-gameplay.png')) {
            echo "✓ Power Drive-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Power Drive (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Pro Yakyuu '91, The → Pro Yakyuu '91, The (Japan)
if (file_exists($imageDir . '/Pro Yakyuu \'91, The-artwork.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu \'91, The (Japan)-artwork.png')) {
        if (rename($imageDir . '/Pro Yakyuu \'91, The-artwork.png', $imageDir . '/Pro Yakyuu \'91, The (Japan)-artwork.png')) {
            echo "✓ Pro Yakyuu \'91, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu \'91, The (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Pro Yakyuu '91, The → Pro Yakyuu '91, The (Japan)
if (file_exists($imageDir . '/Pro Yakyuu \'91, The-cover.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu \'91, The (Japan)-cover.png')) {
        if (rename($imageDir . '/Pro Yakyuu \'91, The-cover.png', $imageDir . '/Pro Yakyuu \'91, The (Japan)-cover.png')) {
            echo "✓ Pro Yakyuu \'91, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu \'91, The (Japan)-cover.png\n";
        $skipped++;
    }
}

// Pro Yakyuu '91, The → Pro Yakyuu '91, The (Japan)
if (file_exists($imageDir . '/Pro Yakyuu \'91, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu \'91, The (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Pro Yakyuu \'91, The-gameplay.png', $imageDir . '/Pro Yakyuu \'91, The (Japan)-gameplay.png')) {
            echo "✓ Pro Yakyuu \'91, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu \'91, The (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Pro Yakyuu GG League '94 → Pro Yakyuu GG League '94 (Japan)
if (file_exists($imageDir . '/Pro Yakyuu GG League \'94-artwork.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League \'94 (Japan)-artwork.png')) {
        if (rename($imageDir . '/Pro Yakyuu GG League \'94-artwork.png', $imageDir . '/Pro Yakyuu GG League \'94 (Japan)-artwork.png')) {
            echo "✓ Pro Yakyuu GG League \'94-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu GG League \'94 (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Pro Yakyuu GG League '94 → Pro Yakyuu GG League '94 (Japan)
if (file_exists($imageDir . '/Pro Yakyuu GG League \'94-cover.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League \'94 (Japan)-cover.png')) {
        if (rename($imageDir . '/Pro Yakyuu GG League \'94-cover.png', $imageDir . '/Pro Yakyuu GG League \'94 (Japan)-cover.png')) {
            echo "✓ Pro Yakyuu GG League \'94-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu GG League \'94 (Japan)-cover.png\n";
        $skipped++;
    }
}

// Pro Yakyuu GG League '94 → Pro Yakyuu GG League '94 (Japan)
if (file_exists($imageDir . '/Pro Yakyuu GG League \'94-gameplay.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League \'94 (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Pro Yakyuu GG League \'94-gameplay.png', $imageDir . '/Pro Yakyuu GG League \'94 (Japan)-gameplay.png')) {
            echo "✓ Pro Yakyuu GG League \'94-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu GG League \'94 (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Pro Yakyuu GG League → Pro Yakyuu GG League (Japan)
if (file_exists($imageDir . '/Pro Yakyuu GG League-artwork.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League (Japan)-artwork.png')) {
        if (rename($imageDir . '/Pro Yakyuu GG League-artwork.png', $imageDir . '/Pro Yakyuu GG League (Japan)-artwork.png')) {
            echo "✓ Pro Yakyuu GG League-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu GG League (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Pro Yakyuu GG League → Pro Yakyuu GG League (Japan)
if (file_exists($imageDir . '/Pro Yakyuu GG League-cover.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League (Japan)-cover.png')) {
        if (rename($imageDir . '/Pro Yakyuu GG League-cover.png', $imageDir . '/Pro Yakyuu GG League (Japan)-cover.png')) {
            echo "✓ Pro Yakyuu GG League-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu GG League (Japan)-cover.png\n";
        $skipped++;
    }
}

// Pro Yakyuu GG League → Pro Yakyuu GG League (Japan)
if (file_exists($imageDir . '/Pro Yakyuu GG League-gameplay.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Pro Yakyuu GG League-gameplay.png', $imageDir . '/Pro Yakyuu GG League (Japan)-gameplay.png')) {
            echo "✓ Pro Yakyuu GG League-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu GG League (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Puyo Puyo Tsuu → Puyo Puyo Tsuu (Japan)
if (file_exists($imageDir . '/Puyo Puyo Tsuu-artwork.png')) {
    if (!file_exists($imageDir . '/Puyo Puyo Tsuu (Japan)-artwork.png')) {
        if (rename($imageDir . '/Puyo Puyo Tsuu-artwork.png', $imageDir . '/Puyo Puyo Tsuu (Japan)-artwork.png')) {
            echo "✓ Puyo Puyo Tsuu-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puyo Puyo Tsuu (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Puyo Puyo Tsuu → Puyo Puyo Tsuu (Japan)
if (file_exists($imageDir . '/Puyo Puyo Tsuu-cover.png')) {
    if (!file_exists($imageDir . '/Puyo Puyo Tsuu (Japan)-cover.png')) {
        if (rename($imageDir . '/Puyo Puyo Tsuu-cover.png', $imageDir . '/Puyo Puyo Tsuu (Japan)-cover.png')) {
            echo "✓ Puyo Puyo Tsuu-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puyo Puyo Tsuu (Japan)-cover.png\n";
        $skipped++;
    }
}

// Puyo Puyo Tsuu → Puyo Puyo Tsuu (Japan)
if (file_exists($imageDir . '/Puyo Puyo Tsuu-gameplay.png')) {
    if (!file_exists($imageDir . '/Puyo Puyo Tsuu (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Puyo Puyo Tsuu-gameplay.png', $imageDir . '/Puyo Puyo Tsuu (Japan)-gameplay.png')) {
            echo "✓ Puyo Puyo Tsuu-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puyo Puyo Tsuu (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Puzzle Bobble → Puzzle Bobble (Japan)
if (file_exists($imageDir . '/Puzzle Bobble-artwork.png')) {
    if (!file_exists($imageDir . '/Puzzle Bobble (Japan)-artwork.png')) {
        if (rename($imageDir . '/Puzzle Bobble-artwork.png', $imageDir . '/Puzzle Bobble (Japan)-artwork.png')) {
            echo "✓ Puzzle Bobble-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle Bobble (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Puzzle Bobble → Puzzle Bobble (Japan)
if (file_exists($imageDir . '/Puzzle Bobble-cover.png')) {
    if (!file_exists($imageDir . '/Puzzle Bobble (Japan)-cover.png')) {
        if (rename($imageDir . '/Puzzle Bobble-cover.png', $imageDir . '/Puzzle Bobble (Japan)-cover.png')) {
            echo "✓ Puzzle Bobble-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle Bobble (Japan)-cover.png\n";
        $skipped++;
    }
}

// Puzzle Bobble → Puzzle Bobble (Japan)
if (file_exists($imageDir . '/Puzzle Bobble-gameplay.png')) {
    if (!file_exists($imageDir . '/Puzzle Bobble (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Puzzle Bobble-gameplay.png', $imageDir . '/Puzzle Bobble (Japan)-gameplay.png')) {
            echo "✓ Puzzle Bobble-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle Bobble (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Ichidanto-R → Puzzle _ Action - Ichidanto-R (Japan)
if (file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R-artwork.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-artwork.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Ichidanto-R-artwork.png', $imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-artwork.png')) {
            echo "✓ Puzzle _ Action - Ichidanto-R-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Ichidanto-R (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Ichidanto-R → Puzzle _ Action - Ichidanto-R (Japan)
if (file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R-cover.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-cover.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Ichidanto-R-cover.png', $imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-cover.png')) {
            echo "✓ Puzzle _ Action - Ichidanto-R-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Ichidanto-R (Japan)-cover.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Ichidanto-R → Puzzle _ Action - Ichidanto-R (Japan)
if (file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R-gameplay.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Ichidanto-R-gameplay.png', $imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-gameplay.png')) {
            echo "✓ Puzzle _ Action - Ichidanto-R-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Ichidanto-R (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Tanto-R → Puzzle _ Action - Tanto-R (Japan)
if (file_exists($imageDir . '/Puzzle _ Action - Tanto-R-artwork.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Tanto-R (Japan)-artwork.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Tanto-R-artwork.png', $imageDir . '/Puzzle _ Action - Tanto-R (Japan)-artwork.png')) {
            echo "✓ Puzzle _ Action - Tanto-R-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Tanto-R (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Tanto-R → Puzzle _ Action - Tanto-R (Japan)
if (file_exists($imageDir . '/Puzzle _ Action - Tanto-R-cover.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Tanto-R (Japan)-cover.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Tanto-R-cover.png', $imageDir . '/Puzzle _ Action - Tanto-R (Japan)-cover.png')) {
            echo "✓ Puzzle _ Action - Tanto-R-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Tanto-R (Japan)-cover.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Tanto-R → Puzzle _ Action - Tanto-R (Japan)
if (file_exists($imageDir . '/Puzzle _ Action - Tanto-R-gameplay.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Tanto-R (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Tanto-R-gameplay.png', $imageDir . '/Puzzle _ Action - Tanto-R (Japan)-gameplay.png')) {
            echo "✓ Puzzle _ Action - Tanto-R-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Tanto-R (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Quest for the Shaven Yak Starring Ren Hoek _ Stimpy → Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)
if (file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-artwork.png')) {
    if (!file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-artwork.png', $imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-artwork.png')) {
            echo "✓ Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Quest for the Shaven Yak Starring Ren Hoek _ Stimpy → Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)
if (file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-cover.png')) {
    if (!file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-cover.png', $imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-cover.png')) {
            echo "✓ Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Quest for the Shaven Yak Starring Ren Hoek _ Stimpy → Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)
if (file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-gameplay.png')) {
    if (!file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-gameplay.png', $imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-gameplay.png')) {
            echo "✓ Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Quiz Gear Fight!!, The → Quiz Gear Fight!!, The (Japan)
if (file_exists($imageDir . '/Quiz Gear Fight!!, The-artwork.png')) {
    if (!file_exists($imageDir . '/Quiz Gear Fight!!, The (Japan)-artwork.png')) {
        if (rename($imageDir . '/Quiz Gear Fight!!, The-artwork.png', $imageDir . '/Quiz Gear Fight!!, The (Japan)-artwork.png')) {
            echo "✓ Quiz Gear Fight!!, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Quiz Gear Fight!!, The (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Quiz Gear Fight!!, The → Quiz Gear Fight!!, The (Japan)
if (file_exists($imageDir . '/Quiz Gear Fight!!, The-cover.png')) {
    if (!file_exists($imageDir . '/Quiz Gear Fight!!, The (Japan)-cover.png')) {
        if (rename($imageDir . '/Quiz Gear Fight!!, The-cover.png', $imageDir . '/Quiz Gear Fight!!, The (Japan)-cover.png')) {
            echo "✓ Quiz Gear Fight!!, The-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Quiz Gear Fight!!, The (Japan)-cover.png\n";
        $skipped++;
    }
}

// Quiz Gear Fight!!, The → Quiz Gear Fight!!, The (Japan)
if (file_exists($imageDir . '/Quiz Gear Fight!!, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Quiz Gear Fight!!, The (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Quiz Gear Fight!!, The-gameplay.png', $imageDir . '/Quiz Gear Fight!!, The (Japan)-gameplay.png')) {
            echo "✓ Quiz Gear Fight!!, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Quiz Gear Fight!!, The (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// R.B.I. Baseball '94 → R.B.I. Baseball '94 (USA)
if (file_exists($imageDir . '/R.B.I. Baseball \'94-artwork.png')) {
    if (!file_exists($imageDir . '/R.B.I. Baseball \'94 (USA)-artwork.png')) {
        if (rename($imageDir . '/R.B.I. Baseball \'94-artwork.png', $imageDir . '/R.B.I. Baseball \'94 (USA)-artwork.png')) {
            echo "✓ R.B.I. Baseball \'94-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: R.B.I. Baseball \'94 (USA)-artwork.png\n";
        $skipped++;
    }
}

// R.B.I. Baseball '94 → R.B.I. Baseball '94 (USA)
if (file_exists($imageDir . '/R.B.I. Baseball \'94-cover.png')) {
    if (!file_exists($imageDir . '/R.B.I. Baseball \'94 (USA)-cover.png')) {
        if (rename($imageDir . '/R.B.I. Baseball \'94-cover.png', $imageDir . '/R.B.I. Baseball \'94 (USA)-cover.png')) {
            echo "✓ R.B.I. Baseball \'94-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: R.B.I. Baseball \'94 (USA)-cover.png\n";
        $skipped++;
    }
}

// R.B.I. Baseball '94 → R.B.I. Baseball '94 (USA)
if (file_exists($imageDir . '/R.B.I. Baseball \'94-gameplay.png')) {
    if (!file_exists($imageDir . '/R.B.I. Baseball \'94 (USA)-gameplay.png')) {
        if (rename($imageDir . '/R.B.I. Baseball \'94-gameplay.png', $imageDir . '/R.B.I. Baseball \'94 (USA)-gameplay.png')) {
            echo "✓ R.B.I. Baseball \'94-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: R.B.I. Baseball \'94 (USA)-gameplay.png\n";
        $skipped++;
    }
}

// R.C. Grand Prix → R.C. Grand Prix (USA)
if (file_exists($imageDir . '/R.C. Grand Prix-artwork.png')) {
    if (!file_exists($imageDir . '/R.C. Grand Prix (USA)-artwork.png')) {
        if (rename($imageDir . '/R.C. Grand Prix-artwork.png', $imageDir . '/R.C. Grand Prix (USA)-artwork.png')) {
            echo "✓ R.C. Grand Prix-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: R.C. Grand Prix (USA)-artwork.png\n";
        $skipped++;
    }
}

// R.C. Grand Prix → R.C. Grand Prix (USA)
if (file_exists($imageDir . '/R.C. Grand Prix-cover.png')) {
    if (!file_exists($imageDir . '/R.C. Grand Prix (USA)-cover.png')) {
        if (rename($imageDir . '/R.C. Grand Prix-cover.png', $imageDir . '/R.C. Grand Prix (USA)-cover.png')) {
            echo "✓ R.C. Grand Prix-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: R.C. Grand Prix (USA)-cover.png\n";
        $skipped++;
    }
}

// R.C. Grand Prix → R.C. Grand Prix (USA)
if (file_exists($imageDir . '/R.C. Grand Prix-gameplay.png')) {
    if (!file_exists($imageDir . '/R.C. Grand Prix (USA)-gameplay.png')) {
        if (rename($imageDir . '/R.C. Grand Prix-gameplay.png', $imageDir . '/R.C. Grand Prix (USA)-gameplay.png')) {
            echo "✓ R.C. Grand Prix-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: R.C. Grand Prix (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Rastan Saga → Rastan Saga (Japan)
if (file_exists($imageDir . '/Rastan Saga-artwork.png')) {
    if (!file_exists($imageDir . '/Rastan Saga (Japan)-artwork.png')) {
        if (rename($imageDir . '/Rastan Saga-artwork.png', $imageDir . '/Rastan Saga (Japan)-artwork.png')) {
            echo "✓ Rastan Saga-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rastan Saga (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Rastan Saga → Rastan Saga (Japan)
if (file_exists($imageDir . '/Rastan Saga-cover.png')) {
    if (!file_exists($imageDir . '/Rastan Saga (Japan)-cover.png')) {
        if (rename($imageDir . '/Rastan Saga-cover.png', $imageDir . '/Rastan Saga (Japan)-cover.png')) {
            echo "✓ Rastan Saga-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rastan Saga (Japan)-cover.png\n";
        $skipped++;
    }
}

// Rastan Saga → Rastan Saga (Japan)
if (file_exists($imageDir . '/Rastan Saga-gameplay.png')) {
    if (!file_exists($imageDir . '/Rastan Saga (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Rastan Saga-gameplay.png', $imageDir . '/Rastan Saga (Japan)-gameplay.png')) {
            echo "✓ Rastan Saga-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rastan Saga (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Riddick Bowe Boxing → Riddick Bowe Boxing (USA)
if (file_exists($imageDir . '/Riddick Bowe Boxing-artwork.png')) {
    if (!file_exists($imageDir . '/Riddick Bowe Boxing (USA)-artwork.png')) {
        if (rename($imageDir . '/Riddick Bowe Boxing-artwork.png', $imageDir . '/Riddick Bowe Boxing (USA)-artwork.png')) {
            echo "✓ Riddick Bowe Boxing-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Riddick Bowe Boxing (USA)-artwork.png\n";
        $skipped++;
    }
}

// Riddick Bowe Boxing → Riddick Bowe Boxing (USA)
if (file_exists($imageDir . '/Riddick Bowe Boxing-cover.png')) {
    if (!file_exists($imageDir . '/Riddick Bowe Boxing (USA)-cover.png')) {
        if (rename($imageDir . '/Riddick Bowe Boxing-cover.png', $imageDir . '/Riddick Bowe Boxing (USA)-cover.png')) {
            echo "✓ Riddick Bowe Boxing-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Riddick Bowe Boxing (USA)-cover.png\n";
        $skipped++;
    }
}

// Riddick Bowe Boxing → Riddick Bowe Boxing (USA)
if (file_exists($imageDir . '/Riddick Bowe Boxing-gameplay.png')) {
    if (!file_exists($imageDir . '/Riddick Bowe Boxing (USA)-gameplay.png')) {
        if (rename($imageDir . '/Riddick Bowe Boxing-gameplay.png', $imageDir . '/Riddick Bowe Boxing (USA)-gameplay.png')) {
            echo "✓ Riddick Bowe Boxing-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Riddick Bowe Boxing (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Rise of the Robots → Rise of the Robots (USA, Europe)
if (file_exists($imageDir . '/Rise of the Robots-artwork.png')) {
    if (!file_exists($imageDir . '/Rise of the Robots (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Rise of the Robots-artwork.png', $imageDir . '/Rise of the Robots (USA, Europe)-artwork.png')) {
            echo "✓ Rise of the Robots-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rise of the Robots (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Rise of the Robots → Rise of the Robots (USA, Europe)
if (file_exists($imageDir . '/Rise of the Robots-cover.png')) {
    if (!file_exists($imageDir . '/Rise of the Robots (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Rise of the Robots-cover.png', $imageDir . '/Rise of the Robots (USA, Europe)-cover.png')) {
            echo "✓ Rise of the Robots-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rise of the Robots (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Rise of the Robots → Rise of the Robots (USA, Europe)
if (file_exists($imageDir . '/Rise of the Robots-gameplay.png')) {
    if (!file_exists($imageDir . '/Rise of the Robots (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Rise of the Robots-gameplay.png', $imageDir . '/Rise of the Robots (USA, Europe)-gameplay.png')) {
            echo "✓ Rise of the Robots-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rise of the Robots (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Road Rash → Road Rash (USA)
if (file_exists($imageDir . '/Road Rash-artwork.png')) {
    if (!file_exists($imageDir . '/Road Rash (USA)-artwork.png')) {
        if (rename($imageDir . '/Road Rash-artwork.png', $imageDir . '/Road Rash (USA)-artwork.png')) {
            echo "✓ Road Rash-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Road Rash (USA)-artwork.png\n";
        $skipped++;
    }
}

// Road Rash → Road Rash (USA)
if (file_exists($imageDir . '/Road Rash-cover.png')) {
    if (!file_exists($imageDir . '/Road Rash (USA)-cover.png')) {
        if (rename($imageDir . '/Road Rash-cover.png', $imageDir . '/Road Rash (USA)-cover.png')) {
            echo "✓ Road Rash-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Road Rash (USA)-cover.png\n";
        $skipped++;
    }
}

// Road Rash → Road Rash (USA)
if (file_exists($imageDir . '/Road Rash-gameplay.png')) {
    if (!file_exists($imageDir . '/Road Rash (USA)-gameplay.png')) {
        if (rename($imageDir . '/Road Rash-gameplay.png', $imageDir . '/Road Rash (USA)-gameplay.png')) {
            echo "✓ Road Rash-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Road Rash (USA)-gameplay.png\n";
        $skipped++;
    }
}

// RoboCop Versus The Terminator → RoboCop Versus The Terminator (USA, Europe)
if (file_exists($imageDir . '/RoboCop Versus The Terminator-artwork.png')) {
    if (!file_exists($imageDir . '/RoboCop Versus The Terminator (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/RoboCop Versus The Terminator-artwork.png', $imageDir . '/RoboCop Versus The Terminator (USA, Europe)-artwork.png')) {
            echo "✓ RoboCop Versus The Terminator-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: RoboCop Versus The Terminator (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// RoboCop Versus The Terminator → RoboCop Versus The Terminator (USA, Europe)
if (file_exists($imageDir . '/RoboCop Versus The Terminator-cover.png')) {
    if (!file_exists($imageDir . '/RoboCop Versus The Terminator (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/RoboCop Versus The Terminator-cover.png', $imageDir . '/RoboCop Versus The Terminator (USA, Europe)-cover.png')) {
            echo "✓ RoboCop Versus The Terminator-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: RoboCop Versus The Terminator (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// RoboCop Versus The Terminator → RoboCop Versus The Terminator (USA, Europe)
if (file_exists($imageDir . '/RoboCop Versus The Terminator-gameplay.png')) {
    if (!file_exists($imageDir . '/RoboCop Versus The Terminator (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/RoboCop Versus The Terminator-gameplay.png', $imageDir . '/RoboCop Versus The Terminator (USA, Europe)-gameplay.png')) {
            echo "✓ RoboCop Versus The Terminator-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: RoboCop Versus The Terminator (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Royal Stone - Hirakareshi Toki no Tobira → Royal Stone - Hirakareshi Toki no Tobira (Japan)
if (file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-artwork.png')) {
    if (!file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-artwork.png')) {
        if (rename($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-artwork.png', $imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-artwork.png')) {
            echo "✓ Royal Stone - Hirakareshi Toki no Tobira-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone - Hirakareshi Toki no Tobira (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Royal Stone - Hirakareshi Toki no Tobira → Royal Stone - Hirakareshi Toki no Tobira (Japan)
if (file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-cover.png')) {
    if (!file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-cover.png')) {
        if (rename($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-cover.png', $imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-cover.png')) {
            echo "✓ Royal Stone - Hirakareshi Toki no Tobira-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone - Hirakareshi Toki no Tobira (Japan)-cover.png\n";
        $skipped++;
    }
}

// Royal Stone - Hirakareshi Toki no Tobira → Royal Stone - Hirakareshi Toki no Tobira (Japan)
if (file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-gameplay.png')) {
    if (!file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-gameplay.png', $imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-gameplay.png')) {
            echo "✓ Royal Stone - Hirakareshi Toki no Tobira-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone - Hirakareshi Toki no Tobira (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Royal Stone → Royal Stone (USA)
if (file_exists($imageDir . '/Royal Stone-artwork.png')) {
    if (!file_exists($imageDir . '/Royal Stone (USA)-artwork.png')) {
        if (rename($imageDir . '/Royal Stone-artwork.png', $imageDir . '/Royal Stone (USA)-artwork.png')) {
            echo "✓ Royal Stone-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone (USA)-artwork.png\n";
        $skipped++;
    }
}

// Royal Stone → Royal Stone (USA)
if (file_exists($imageDir . '/Royal Stone-cover.png')) {
    if (!file_exists($imageDir . '/Royal Stone (USA)-cover.png')) {
        if (rename($imageDir . '/Royal Stone-cover.png', $imageDir . '/Royal Stone (USA)-cover.png')) {
            echo "✓ Royal Stone-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone (USA)-cover.png\n";
        $skipped++;
    }
}

// Royal Stone → Royal Stone (USA)
if (file_exists($imageDir . '/Royal Stone-gameplay.png')) {
    if (!file_exists($imageDir . '/Royal Stone (USA)-gameplay.png')) {
        if (rename($imageDir . '/Royal Stone-gameplay.png', $imageDir . '/Royal Stone (USA)-gameplay.png')) {
            echo "✓ Royal Stone-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone (USA)-gameplay.png\n";
        $skipped++;
    }
}

// SD Gundam - Winner's History → SD Gundam - Winner's History (Japan)
if (file_exists($imageDir . '/SD Gundam - Winner\'s History-artwork.png')) {
    if (!file_exists($imageDir . '/SD Gundam - Winner\'s History (Japan)-artwork.png')) {
        if (rename($imageDir . '/SD Gundam - Winner\'s History-artwork.png', $imageDir . '/SD Gundam - Winner\'s History (Japan)-artwork.png')) {
            echo "✓ SD Gundam - Winner\'s History-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: SD Gundam - Winner\'s History (Japan)-artwork.png\n";
        $skipped++;
    }
}

// SD Gundam - Winner's History → SD Gundam - Winner's History (Japan)
if (file_exists($imageDir . '/SD Gundam - Winner\'s History-cover.png')) {
    if (!file_exists($imageDir . '/SD Gundam - Winner\'s History (Japan)-cover.png')) {
        if (rename($imageDir . '/SD Gundam - Winner\'s History-cover.png', $imageDir . '/SD Gundam - Winner\'s History (Japan)-cover.png')) {
            echo "✓ SD Gundam - Winner\'s History-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: SD Gundam - Winner\'s History (Japan)-cover.png\n";
        $skipped++;
    }
}

// SD Gundam - Winner's History → SD Gundam - Winner's History (Japan)
if (file_exists($imageDir . '/SD Gundam - Winner\'s History-gameplay.png')) {
    if (!file_exists($imageDir . '/SD Gundam - Winner\'s History (Japan)-gameplay.png')) {
        if (rename($imageDir . '/SD Gundam - Winner\'s History-gameplay.png', $imageDir . '/SD Gundam - Winner\'s History (Japan)-gameplay.png')) {
            echo "✓ SD Gundam - Winner\'s History-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: SD Gundam - Winner\'s History (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Samurai Shodown → Samurai Shodown (USA)
if (file_exists($imageDir . '/Samurai Shodown-artwork.png')) {
    if (!file_exists($imageDir . '/Samurai Shodown (USA)-artwork.png')) {
        if (rename($imageDir . '/Samurai Shodown-artwork.png', $imageDir . '/Samurai Shodown (USA)-artwork.png')) {
            echo "✓ Samurai Shodown-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Shodown (USA)-artwork.png\n";
        $skipped++;
    }
}

// Samurai Shodown → Samurai Shodown (USA)
if (file_exists($imageDir . '/Samurai Shodown-cover.png')) {
    if (!file_exists($imageDir . '/Samurai Shodown (USA)-cover.png')) {
        if (rename($imageDir . '/Samurai Shodown-cover.png', $imageDir . '/Samurai Shodown (USA)-cover.png')) {
            echo "✓ Samurai Shodown-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Shodown (USA)-cover.png\n";
        $skipped++;
    }
}

// Samurai Shodown → Samurai Shodown (USA)
if (file_exists($imageDir . '/Samurai Shodown-gameplay.png')) {
    if (!file_exists($imageDir . '/Samurai Shodown (USA)-gameplay.png')) {
        if (rename($imageDir . '/Samurai Shodown-gameplay.png', $imageDir . '/Samurai Shodown (USA)-gameplay.png')) {
            echo "✓ Samurai Shodown-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Shodown (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Samurai Spirits → Samurai Spirits (Japan)
if (file_exists($imageDir . '/Samurai Spirits-artwork.png')) {
    if (!file_exists($imageDir . '/Samurai Spirits (Japan)-artwork.png')) {
        if (rename($imageDir . '/Samurai Spirits-artwork.png', $imageDir . '/Samurai Spirits (Japan)-artwork.png')) {
            echo "✓ Samurai Spirits-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Spirits (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Samurai Spirits → Samurai Spirits (Japan)
if (file_exists($imageDir . '/Samurai Spirits-cover.png')) {
    if (!file_exists($imageDir . '/Samurai Spirits (Japan)-cover.png')) {
        if (rename($imageDir . '/Samurai Spirits-cover.png', $imageDir . '/Samurai Spirits (Japan)-cover.png')) {
            echo "✓ Samurai Spirits-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Spirits (Japan)-cover.png\n";
        $skipped++;
    }
}

// Samurai Spirits → Samurai Spirits (Japan)
if (file_exists($imageDir . '/Samurai Spirits-gameplay.png')) {
    if (!file_exists($imageDir . '/Samurai Spirits (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Samurai Spirits-gameplay.png', $imageDir . '/Samurai Spirits (Japan)-gameplay.png')) {
            echo "✓ Samurai Spirits-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Spirits (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Sassou Shounen Eiyuuden - Coca-Cola Kid → Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)
if (file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-artwork.png')) {
    if (!file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-artwork.png')) {
        if (rename($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-artwork.png', $imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-artwork.png')) {
            echo "✓ Sassou Shounen Eiyuuden - Coca-Cola Kid-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Sassou Shounen Eiyuuden - Coca-Cola Kid → Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)
if (file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-cover.png')) {
    if (!file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-cover.png')) {
        if (rename($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-cover.png', $imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-cover.png')) {
            echo "✓ Sassou Shounen Eiyuuden - Coca-Cola Kid-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-cover.png\n";
        $skipped++;
    }
}

// Sassou Shounen Eiyuuden - Coca-Cola Kid → Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)
if (file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-gameplay.png')) {
    if (!file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-gameplay.png', $imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-gameplay.png')) {
            echo "✓ Sassou Shounen Eiyuuden - Coca-Cola Kid-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Schtroumpfs Autour du Monde, Les → Schtroumpfs Autour du Monde, Les (Europe) (En,Fr,De,Es)
if (file_exists($imageDir . '/Schtroumpfs Autour du Monde, Les-artwork.png')) {
    if (!file_exists($imageDir . '/Schtroumpfs Autour du Monde, Les (Europe) (En,Fr,De,Es)-artwork.png')) {
        if (rename($imageDir . '/Schtroumpfs Autour du Monde, Les-artwork.png', $imageDir . '/Schtroumpfs Autour du Monde, Les (Europe) (En,Fr,De,Es)-artwork.png')) {
            echo "✓ Schtroumpfs Autour du Monde, Les-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Schtroumpfs Autour du Monde, Les (Europe) (En,Fr,De,Es)-artwork.png\n";
        $skipped++;
    }
}

// Schtroumpfs Autour du Monde, Les → Schtroumpfs Autour du Monde, Les (Europe) (En,Fr,De,Es)
if (file_exists($imageDir . '/Schtroumpfs Autour du Monde, Les-cover.png')) {
    if (!file_exists($imageDir . '/Schtroumpfs Autour du Monde, Les (Europe) (En,Fr,De,Es)-cover.png')) {
        if (rename($imageDir . '/Schtroumpfs Autour du Monde, Les-cover.png', $imageDir . '/Schtroumpfs Autour du Monde, Les (Europe) (En,Fr,De,Es)-cover.png')) {
            echo "✓ Schtroumpfs Autour du Monde, Les-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Schtroumpfs Autour du Monde, Les (Europe) (En,Fr,De,Es)-cover.png\n";
        $skipped++;
    }
}

// Scratch Golf → Scratch Golf (USA)
if (file_exists($imageDir . '/Scratch Golf-artwork.png')) {
    if (!file_exists($imageDir . '/Scratch Golf (USA)-artwork.png')) {
        if (rename($imageDir . '/Scratch Golf-artwork.png', $imageDir . '/Scratch Golf (USA)-artwork.png')) {
            echo "✓ Scratch Golf-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Scratch Golf (USA)-artwork.png\n";
        $skipped++;
    }
}

// Scratch Golf → Scratch Golf (USA)
if (file_exists($imageDir . '/Scratch Golf-cover.png')) {
    if (!file_exists($imageDir . '/Scratch Golf (USA)-cover.png')) {
        if (rename($imageDir . '/Scratch Golf-cover.png', $imageDir . '/Scratch Golf (USA)-cover.png')) {
            echo "✓ Scratch Golf-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Scratch Golf (USA)-cover.png\n";
        $skipped++;
    }
}

// Scratch Golf → Scratch Golf (USA)
if (file_exists($imageDir . '/Scratch Golf-gameplay.png')) {
    if (!file_exists($imageDir . '/Scratch Golf (USA)-gameplay.png')) {
        if (rename($imageDir . '/Scratch Golf-gameplay.png', $imageDir . '/Scratch Golf (USA)-gameplay.png')) {
            echo "✓ Scratch Golf-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Scratch Golf (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Sega Game Pack 4 in 1 → Sega Game Pack 4 in 1 (Europe)
if (file_exists($imageDir . '/Sega Game Pack 4 in 1-artwork.png')) {
    if (!file_exists($imageDir . '/Sega Game Pack 4 in 1 (Europe)-artwork.png')) {
        if (rename($imageDir . '/Sega Game Pack 4 in 1-artwork.png', $imageDir . '/Sega Game Pack 4 in 1 (Europe)-artwork.png')) {
            echo "✓ Sega Game Pack 4 in 1-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sega Game Pack 4 in 1 (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Sega Game Pack 4 in 1 → Sega Game Pack 4 in 1 (Europe)
if (file_exists($imageDir . '/Sega Game Pack 4 in 1-cover.png')) {
    if (!file_exists($imageDir . '/Sega Game Pack 4 in 1 (Europe)-cover.png')) {
        if (rename($imageDir . '/Sega Game Pack 4 in 1-cover.png', $imageDir . '/Sega Game Pack 4 in 1 (Europe)-cover.png')) {
            echo "✓ Sega Game Pack 4 in 1-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sega Game Pack 4 in 1 (Europe)-cover.png\n";
        $skipped++;
    }
}

// Sega Game Pack 4 in 1 → Sega Game Pack 4 in 1 (Europe)
if (file_exists($imageDir . '/Sega Game Pack 4 in 1-gameplay.png')) {
    if (!file_exists($imageDir . '/Sega Game Pack 4 in 1 (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Sega Game Pack 4 in 1-gameplay.png', $imageDir . '/Sega Game Pack 4 in 1 (Europe)-gameplay.png')) {
            echo "✓ Sega Game Pack 4 in 1-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sega Game Pack 4 in 1 (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Sensible Soccer - European Champions → Sensible Soccer - European Champions (Europe)
if (file_exists($imageDir . '/Sensible Soccer - European Champions-artwork.png')) {
    if (!file_exists($imageDir . '/Sensible Soccer - European Champions (Europe)-artwork.png')) {
        if (rename($imageDir . '/Sensible Soccer - European Champions-artwork.png', $imageDir . '/Sensible Soccer - European Champions (Europe)-artwork.png')) {
            echo "✓ Sensible Soccer - European Champions-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sensible Soccer - European Champions (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Sensible Soccer - European Champions → Sensible Soccer - European Champions (Europe)
if (file_exists($imageDir . '/Sensible Soccer - European Champions-cover.png')) {
    if (!file_exists($imageDir . '/Sensible Soccer - European Champions (Europe)-cover.png')) {
        if (rename($imageDir . '/Sensible Soccer - European Champions-cover.png', $imageDir . '/Sensible Soccer - European Champions (Europe)-cover.png')) {
            echo "✓ Sensible Soccer - European Champions-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sensible Soccer - European Champions (Europe)-cover.png\n";
        $skipped++;
    }
}

// Sensible Soccer - European Champions → Sensible Soccer - European Champions (Europe)
if (file_exists($imageDir . '/Sensible Soccer - European Champions-gameplay.png')) {
    if (!file_exists($imageDir . '/Sensible Soccer - European Champions (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Sensible Soccer - European Champions-gameplay.png', $imageDir . '/Sensible Soccer - European Champions (Europe)-gameplay.png')) {
            echo "✓ Sensible Soccer - European Champions-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sensible Soccer - European Champions (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Shadam Crusader - Harukanaru Oukoku → Shadam Crusader - Harukanaru Oukoku (Japan)
if (file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku-artwork.png')) {
    if (!file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-artwork.png')) {
        if (rename($imageDir . '/Shadam Crusader - Harukanaru Oukoku-artwork.png', $imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-artwork.png')) {
            echo "✓ Shadam Crusader - Harukanaru Oukoku-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shadam Crusader - Harukanaru Oukoku (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Shadam Crusader - Harukanaru Oukoku → Shadam Crusader - Harukanaru Oukoku (Japan)
if (file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku-cover.png')) {
    if (!file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-cover.png')) {
        if (rename($imageDir . '/Shadam Crusader - Harukanaru Oukoku-cover.png', $imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-cover.png')) {
            echo "✓ Shadam Crusader - Harukanaru Oukoku-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shadam Crusader - Harukanaru Oukoku (Japan)-cover.png\n";
        $skipped++;
    }
}

// Shadam Crusader - Harukanaru Oukoku → Shadam Crusader - Harukanaru Oukoku (Japan)
if (file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku-gameplay.png')) {
    if (!file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Shadam Crusader - Harukanaru Oukoku-gameplay.png', $imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-gameplay.png')) {
            echo "✓ Shadam Crusader - Harukanaru Oukoku-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shadam Crusader - Harukanaru Oukoku (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Shaq Fu → Shaq Fu (USA)
if (file_exists($imageDir . '/Shaq Fu-artwork.png')) {
    if (!file_exists($imageDir . '/Shaq Fu (USA)-artwork.png')) {
        if (rename($imageDir . '/Shaq Fu-artwork.png', $imageDir . '/Shaq Fu (USA)-artwork.png')) {
            echo "✓ Shaq Fu-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shaq Fu (USA)-artwork.png\n";
        $skipped++;
    }
}

// Shaq Fu → Shaq Fu (USA)
if (file_exists($imageDir . '/Shaq Fu-cover.png')) {
    if (!file_exists($imageDir . '/Shaq Fu (USA)-cover.png')) {
        if (rename($imageDir . '/Shaq Fu-cover.png', $imageDir . '/Shaq Fu (USA)-cover.png')) {
            echo "✓ Shaq Fu-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shaq Fu (USA)-cover.png\n";
        $skipped++;
    }
}

// Shaq Fu → Shaq Fu (USA)
if (file_exists($imageDir . '/Shaq Fu-gameplay.png')) {
    if (!file_exists($imageDir . '/Shaq Fu (USA)-gameplay.png')) {
        if (rename($imageDir . '/Shaq Fu-gameplay.png', $imageDir . '/Shaq Fu (USA)-gameplay.png')) {
            echo "✓ Shaq Fu-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shaq Fu (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Shining Force - The Sword of Hajya → Shining Force - The Sword of Hajya (USA)
if (file_exists($imageDir . '/Shining Force - The Sword of Hajya-artwork.png')) {
    if (!file_exists($imageDir . '/Shining Force - The Sword of Hajya (USA)-artwork.png')) {
        if (rename($imageDir . '/Shining Force - The Sword of Hajya-artwork.png', $imageDir . '/Shining Force - The Sword of Hajya (USA)-artwork.png')) {
            echo "✓ Shining Force - The Sword of Hajya-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force - The Sword of Hajya (USA)-artwork.png\n";
        $skipped++;
    }
}

// Shining Force - The Sword of Hajya → Shining Force - The Sword of Hajya (USA)
if (file_exists($imageDir . '/Shining Force - The Sword of Hajya-cover.png')) {
    if (!file_exists($imageDir . '/Shining Force - The Sword of Hajya (USA)-cover.png')) {
        if (rename($imageDir . '/Shining Force - The Sword of Hajya-cover.png', $imageDir . '/Shining Force - The Sword of Hajya (USA)-cover.png')) {
            echo "✓ Shining Force - The Sword of Hajya-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force - The Sword of Hajya (USA)-cover.png\n";
        $skipped++;
    }
}

// Shining Force - The Sword of Hajya → Shining Force - The Sword of Hajya (USA)
if (file_exists($imageDir . '/Shining Force - The Sword of Hajya-gameplay.png')) {
    if (!file_exists($imageDir . '/Shining Force - The Sword of Hajya (USA)-gameplay.png')) {
        if (rename($imageDir . '/Shining Force - The Sword of Hajya-gameplay.png', $imageDir . '/Shining Force - The Sword of Hajya (USA)-gameplay.png')) {
            echo "✓ Shining Force - The Sword of Hajya-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force - The Sword of Hajya (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Ensei, Jashin no Kuni e → Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)
if (file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-artwork.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-artwork.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-artwork.png', $imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-artwork.png')) {
            echo "✓ Shining Force Gaiden - Ensei, Jashin no Kuni e-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Ensei, Jashin no Kuni e → Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)
if (file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-cover.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-cover.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-cover.png', $imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-cover.png')) {
            echo "✓ Shining Force Gaiden - Ensei, Jashin no Kuni e-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-cover.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Ensei, Jashin no Kuni e → Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)
if (file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-gameplay.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-gameplay.png', $imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-gameplay.png')) {
            echo "✓ Shining Force Gaiden - Ensei, Jashin no Kuni e-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Final Conflict → Shining Force Gaiden - Final Conflict (Japan)
if (file_exists($imageDir . '/Shining Force Gaiden - Final Conflict-artwork.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-artwork.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Final Conflict-artwork.png', $imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-artwork.png')) {
            echo "✓ Shining Force Gaiden - Final Conflict-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Final Conflict (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Final Conflict → Shining Force Gaiden - Final Conflict (Japan)
if (file_exists($imageDir . '/Shining Force Gaiden - Final Conflict-cover.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-cover.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Final Conflict-cover.png', $imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-cover.png')) {
            echo "✓ Shining Force Gaiden - Final Conflict-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Final Conflict (Japan)-cover.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Final Conflict → Shining Force Gaiden - Final Conflict (Japan)
if (file_exists($imageDir . '/Shining Force Gaiden - Final Conflict-gameplay.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Final Conflict-gameplay.png', $imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-gameplay.png')) {
            echo "✓ Shining Force Gaiden - Final Conflict-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Final Conflict (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden II - Jashin no Kakusei → Shining Force Gaiden II - Jashin no Kakusei (Japan)
if (file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-artwork.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-artwork.png')) {
        if (rename($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-artwork.png', $imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-artwork.png')) {
            echo "✓ Shining Force Gaiden II - Jashin no Kakusei-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden II - Jashin no Kakusei (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden II - Jashin no Kakusei → Shining Force Gaiden II - Jashin no Kakusei (Japan)
if (file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-cover.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-cover.png')) {
        if (rename($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-cover.png', $imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-cover.png')) {
            echo "✓ Shining Force Gaiden II - Jashin no Kakusei-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden II - Jashin no Kakusei (Japan)-cover.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden II - Jashin no Kakusei → Shining Force Gaiden II - Jashin no Kakusei (Japan)
if (file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-gameplay.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-gameplay.png', $imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-gameplay.png')) {
            echo "✓ Shining Force Gaiden II - Jashin no Kakusei-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden II - Jashin no Kakusei (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Shinobi II - The Silent Fury → Shinobi II - The Silent Fury (World)
if (file_exists($imageDir . '/Shinobi II - The Silent Fury-artwork.png')) {
    if (!file_exists($imageDir . '/Shinobi II - The Silent Fury (World)-artwork.png')) {
        if (rename($imageDir . '/Shinobi II - The Silent Fury-artwork.png', $imageDir . '/Shinobi II - The Silent Fury (World)-artwork.png')) {
            echo "✓ Shinobi II - The Silent Fury-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shinobi II - The Silent Fury (World)-artwork.png\n";
        $skipped++;
    }
}

// Shinobi II - The Silent Fury → Shinobi II - The Silent Fury (World)
if (file_exists($imageDir . '/Shinobi II - The Silent Fury-cover.png')) {
    if (!file_exists($imageDir . '/Shinobi II - The Silent Fury (World)-cover.png')) {
        if (rename($imageDir . '/Shinobi II - The Silent Fury-cover.png', $imageDir . '/Shinobi II - The Silent Fury (World)-cover.png')) {
            echo "✓ Shinobi II - The Silent Fury-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shinobi II - The Silent Fury (World)-cover.png\n";
        $skipped++;
    }
}

// Shinobi II - The Silent Fury → Shinobi II - The Silent Fury (World)
if (file_exists($imageDir . '/Shinobi II - The Silent Fury-gameplay.png')) {
    if (!file_exists($imageDir . '/Shinobi II - The Silent Fury (World)-gameplay.png')) {
        if (rename($imageDir . '/Shinobi II - The Silent Fury-gameplay.png', $imageDir . '/Shinobi II - The Silent Fury (World)-gameplay.png')) {
            echo "✓ Shinobi II - The Silent Fury-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shinobi II - The Silent Fury (World)-gameplay.png\n";
        $skipped++;
    }
}

// Side Pocket → Side Pocket (USA)
if (file_exists($imageDir . '/Side Pocket-artwork.png')) {
    if (!file_exists($imageDir . '/Side Pocket (USA)-artwork.png')) {
        if (rename($imageDir . '/Side Pocket-artwork.png', $imageDir . '/Side Pocket (USA)-artwork.png')) {
            echo "✓ Side Pocket-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Side Pocket (USA)-artwork.png\n";
        $skipped++;
    }
}

// Side Pocket → Side Pocket (USA)
if (file_exists($imageDir . '/Side Pocket-cover.png')) {
    if (!file_exists($imageDir . '/Side Pocket (USA)-cover.png')) {
        if (rename($imageDir . '/Side Pocket-cover.png', $imageDir . '/Side Pocket (USA)-cover.png')) {
            echo "✓ Side Pocket-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Side Pocket (USA)-cover.png\n";
        $skipped++;
    }
}

// Side Pocket → Side Pocket (USA)
if (file_exists($imageDir . '/Side Pocket-gameplay.png')) {
    if (!file_exists($imageDir . '/Side Pocket (USA)-gameplay.png')) {
        if (rename($imageDir . '/Side Pocket-gameplay.png', $imageDir . '/Side Pocket (USA)-gameplay.png')) {
            echo "✓ Side Pocket-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Side Pocket (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bart vs. the Space Mutants → Simpsons, The - Bart vs. the Space Mutants (USA, Europe)
if (file_exists($imageDir . '/Simpsons, The - Bart vs. the Space Mutants-artwork.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the Space Mutants (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Simpsons, The - Bart vs. the Space Mutants-artwork.png', $imageDir . '/Simpsons, The - Bart vs. the Space Mutants (USA, Europe)-artwork.png')) {
            echo "✓ Simpsons, The - Bart vs. the Space Mutants-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bart vs. the Space Mutants (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bart vs. the Space Mutants → Simpsons, The - Bart vs. the Space Mutants (USA, Europe)
if (file_exists($imageDir . '/Simpsons, The - Bart vs. the Space Mutants-cover.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the Space Mutants (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Simpsons, The - Bart vs. the Space Mutants-cover.png', $imageDir . '/Simpsons, The - Bart vs. the Space Mutants (USA, Europe)-cover.png')) {
            echo "✓ Simpsons, The - Bart vs. the Space Mutants-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bart vs. the Space Mutants (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bart vs. the Space Mutants → Simpsons, The - Bart vs. the Space Mutants (USA, Europe)
if (file_exists($imageDir . '/Simpsons, The - Bart vs. the Space Mutants-gameplay.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the Space Mutants (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Simpsons, The - Bart vs. the Space Mutants-gameplay.png', $imageDir . '/Simpsons, The - Bart vs. the Space Mutants (USA, Europe)-gameplay.png')) {
            echo "✓ Simpsons, The - Bart vs. the Space Mutants-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bart vs. the Space Mutants (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bart vs. the World → Simpsons, The - Bart vs. the World (World)
if (file_exists($imageDir . '/Simpsons, The - Bart vs. the World-artwork.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the World (World)-artwork.png')) {
        if (rename($imageDir . '/Simpsons, The - Bart vs. the World-artwork.png', $imageDir . '/Simpsons, The - Bart vs. the World (World)-artwork.png')) {
            echo "✓ Simpsons, The - Bart vs. the World-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bart vs. the World (World)-artwork.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bart vs. the World → Simpsons, The - Bart vs. the World (World)
if (file_exists($imageDir . '/Simpsons, The - Bart vs. the World-cover.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the World (World)-cover.png')) {
        if (rename($imageDir . '/Simpsons, The - Bart vs. the World-cover.png', $imageDir . '/Simpsons, The - Bart vs. the World (World)-cover.png')) {
            echo "✓ Simpsons, The - Bart vs. the World-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bart vs. the World (World)-cover.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bart vs. the World → Simpsons, The - Bart vs. the World (World)
if (file_exists($imageDir . '/Simpsons, The - Bart vs. the World-gameplay.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bart vs. the World (World)-gameplay.png')) {
        if (rename($imageDir . '/Simpsons, The - Bart vs. the World-gameplay.png', $imageDir . '/Simpsons, The - Bart vs. the World (World)-gameplay.png')) {
            echo "✓ Simpsons, The - Bart vs. the World-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bart vs. the World (World)-gameplay.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bartman Meets Radioactive Man → Simpsons, The - Bartman Meets Radioactive Man (USA)
if (file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-artwork.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-artwork.png')) {
        if (rename($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-artwork.png', $imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-artwork.png')) {
            echo "✓ Simpsons, The - Bartman Meets Radioactive Man-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bartman Meets Radioactive Man (USA)-artwork.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bartman Meets Radioactive Man → Simpsons, The - Bartman Meets Radioactive Man (USA)
if (file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-cover.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-cover.png')) {
        if (rename($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-cover.png', $imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-cover.png')) {
            echo "✓ Simpsons, The - Bartman Meets Radioactive Man-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bartman Meets Radioactive Man (USA)-cover.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bartman Meets Radioactive Man → Simpsons, The - Bartman Meets Radioactive Man (USA)
if (file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-gameplay.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-gameplay.png')) {
        if (rename($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-gameplay.png', $imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-gameplay.png')) {
            echo "✓ Simpsons, The - Bartman Meets Radioactive Man-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bartman Meets Radioactive Man (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Smurfs Travel the World, The → Smurfs Travel the World, The (Europe) (En,Fr,De,Es)
if (file_exists($imageDir . '/Smurfs Travel the World, The-artwork.png')) {
    if (!file_exists($imageDir . '/Smurfs Travel the World, The (Europe) (En,Fr,De,Es)-artwork.png')) {
        if (rename($imageDir . '/Smurfs Travel the World, The-artwork.png', $imageDir . '/Smurfs Travel the World, The (Europe) (En,Fr,De,Es)-artwork.png')) {
            echo "✓ Smurfs Travel the World, The-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Smurfs Travel the World, The (Europe) (En,Fr,De,Es)-artwork.png\n";
        $skipped++;
    }
}

// Smurfs Travel the World, The → Smurfs Travel the World, The (Europe) (En,Fr,De,Es)
if (file_exists($imageDir . '/Smurfs Travel the World, The-gameplay.png')) {
    if (!file_exists($imageDir . '/Smurfs Travel the World, The (Europe) (En,Fr,De,Es)-gameplay.png')) {
        if (rename($imageDir . '/Smurfs Travel the World, The-gameplay.png', $imageDir . '/Smurfs Travel the World, The (Europe) (En,Fr,De,Es)-gameplay.png')) {
            echo "✓ Smurfs Travel the World, The-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Smurfs Travel the World, The (Europe) (En,Fr,De,Es)-gameplay.png\n";
        $skipped++;
    }
}

// Solitaire FunPak → Solitaire FunPak (USA)
if (file_exists($imageDir . '/Solitaire FunPak-artwork.png')) {
    if (!file_exists($imageDir . '/Solitaire FunPak (USA)-artwork.png')) {
        if (rename($imageDir . '/Solitaire FunPak-artwork.png', $imageDir . '/Solitaire FunPak (USA)-artwork.png')) {
            echo "✓ Solitaire FunPak-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Solitaire FunPak (USA)-artwork.png\n";
        $skipped++;
    }
}

// Solitaire FunPak → Solitaire FunPak (USA)
if (file_exists($imageDir . '/Solitaire FunPak-cover.png')) {
    if (!file_exists($imageDir . '/Solitaire FunPak (USA)-cover.png')) {
        if (rename($imageDir . '/Solitaire FunPak-cover.png', $imageDir . '/Solitaire FunPak (USA)-cover.png')) {
            echo "✓ Solitaire FunPak-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Solitaire FunPak (USA)-cover.png\n";
        $skipped++;
    }
}

// Solitaire FunPak → Solitaire FunPak (USA)
if (file_exists($imageDir . '/Solitaire FunPak-gameplay.png')) {
    if (!file_exists($imageDir . '/Solitaire FunPak (USA)-gameplay.png')) {
        if (rename($imageDir . '/Solitaire FunPak-gameplay.png', $imageDir . '/Solitaire FunPak (USA)-gameplay.png')) {
            echo "✓ Solitaire FunPak-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Solitaire FunPak (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Sonic Blast → Sonic Blast (World)
if (file_exists($imageDir . '/Sonic Blast-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic Blast (World)-artwork.png')) {
        if (rename($imageDir . '/Sonic Blast-artwork.png', $imageDir . '/Sonic Blast (World)-artwork.png')) {
            echo "✓ Sonic Blast-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Blast (World)-artwork.png\n";
        $skipped++;
    }
}

// Sonic Blast → Sonic Blast (World)
if (file_exists($imageDir . '/Sonic Blast-cover.png')) {
    if (!file_exists($imageDir . '/Sonic Blast (World)-cover.png')) {
        if (rename($imageDir . '/Sonic Blast-cover.png', $imageDir . '/Sonic Blast (World)-cover.png')) {
            echo "✓ Sonic Blast-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Blast (World)-cover.png\n";
        $skipped++;
    }
}

// Sonic Blast → Sonic Blast (World)
if (file_exists($imageDir . '/Sonic Blast-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic Blast (World)-gameplay.png')) {
        if (rename($imageDir . '/Sonic Blast-gameplay.png', $imageDir . '/Sonic Blast (World)-gameplay.png')) {
            echo "✓ Sonic Blast-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Blast (World)-gameplay.png\n";
        $skipped++;
    }
}

// Sonic Drift 2 → Sonic Drift 2 (World)
if (file_exists($imageDir . '/Sonic Drift 2-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic Drift 2 (World)-artwork.png')) {
        if (rename($imageDir . '/Sonic Drift 2-artwork.png', $imageDir . '/Sonic Drift 2 (World)-artwork.png')) {
            echo "✓ Sonic Drift 2-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Drift 2 (World)-artwork.png\n";
        $skipped++;
    }
}

// Sonic Drift 2 → Sonic Drift 2 (World)
if (file_exists($imageDir . '/Sonic Drift 2-cover.png')) {
    if (!file_exists($imageDir . '/Sonic Drift 2 (World)-cover.png')) {
        if (rename($imageDir . '/Sonic Drift 2-cover.png', $imageDir . '/Sonic Drift 2 (World)-cover.png')) {
            echo "✓ Sonic Drift 2-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Drift 2 (World)-cover.png\n";
        $skipped++;
    }
}

// Sonic Drift 2 → Sonic Drift 2 (World)
if (file_exists($imageDir . '/Sonic Drift 2-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic Drift 2 (World)-gameplay.png')) {
        if (rename($imageDir . '/Sonic Drift 2-gameplay.png', $imageDir . '/Sonic Drift 2 (World)-gameplay.png')) {
            echo "✓ Sonic Drift 2-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Drift 2 (World)-gameplay.png\n";
        $skipped++;
    }
}

// Sonic Labyrinth → Sonic Labyrinth [b2]
if (file_exists($imageDir . '/Sonic Labyrinth-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic Labyrinth [b2]-artwork.png')) {
        if (rename($imageDir . '/Sonic Labyrinth-artwork.png', $imageDir . '/Sonic Labyrinth [b2]-artwork.png')) {
            echo "✓ Sonic Labyrinth-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Labyrinth [b2]-artwork.png\n";
        $skipped++;
    }
}

// Sonic Labyrinth → Sonic Labyrinth [b2]
if (file_exists($imageDir . '/Sonic Labyrinth-cover.png')) {
    if (!file_exists($imageDir . '/Sonic Labyrinth [b2]-cover.png')) {
        if (rename($imageDir . '/Sonic Labyrinth-cover.png', $imageDir . '/Sonic Labyrinth [b2]-cover.png')) {
            echo "✓ Sonic Labyrinth-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Labyrinth [b2]-cover.png\n";
        $skipped++;
    }
}

// Sonic Labyrinth → Sonic Labyrinth [b2]
if (file_exists($imageDir . '/Sonic Labyrinth-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic Labyrinth [b2]-gameplay.png')) {
        if (rename($imageDir . '/Sonic Labyrinth-gameplay.png', $imageDir . '/Sonic Labyrinth [b2]-gameplay.png')) {
            echo "✓ Sonic Labyrinth-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Labyrinth [b2]-gameplay.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog - Triple Trouble → Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)
if (file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-artwork.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog - Triple Trouble-artwork.png', $imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-artwork.png')) {
            echo "✓ Sonic The Hedgehog - Triple Trouble-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-artwork.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog - Triple Trouble → Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)
if (file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble-cover.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-cover.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog - Triple Trouble-cover.png', $imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-cover.png')) {
            echo "✓ Sonic The Hedgehog - Triple Trouble-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-cover.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog - Triple Trouble → Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)
if (file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-gameplay.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog - Triple Trouble-gameplay.png', $imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-gameplay.png')) {
            echo "✓ Sonic The Hedgehog - Triple Trouble-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-gameplay.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog 2 → Sonic The Hedgehog 2 (World)
if (file_exists($imageDir . '/Sonic The Hedgehog 2-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2 (World)-artwork.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog 2-artwork.png', $imageDir . '/Sonic The Hedgehog 2 (World)-artwork.png')) {
            echo "✓ Sonic The Hedgehog 2-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog 2 (World)-artwork.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog 2 → Sonic The Hedgehog 2 (World)
if (file_exists($imageDir . '/Sonic The Hedgehog 2-cover.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2 (World)-cover.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog 2-cover.png', $imageDir . '/Sonic The Hedgehog 2 (World)-cover.png')) {
            echo "✓ Sonic The Hedgehog 2-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog 2 (World)-cover.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog 2 → Sonic The Hedgehog 2 (World)
if (file_exists($imageDir . '/Sonic The Hedgehog 2-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2 (World)-gameplay.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog 2-gameplay.png', $imageDir . '/Sonic The Hedgehog 2 (World)-gameplay.png')) {
            echo "✓ Sonic The Hedgehog 2-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog 2 (World)-gameplay.png\n";
        $skipped++;
    }
}

// Sorcery Saga II - Arle, Age 16 → Sorcery Saga II - Arle, Age 16 (USA)
if (file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16-artwork.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-artwork.png')) {
        if (rename($imageDir . '/Sorcery Saga II - Arle, Age 16-artwork.png', $imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-artwork.png')) {
            echo "✓ Sorcery Saga II - Arle, Age 16-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga II - Arle, Age 16 (USA)-artwork.png\n";
        $skipped++;
    }
}

// Sorcery Saga II - Arle, Age 16 → Sorcery Saga II - Arle, Age 16 (USA)
if (file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16-cover.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-cover.png')) {
        if (rename($imageDir . '/Sorcery Saga II - Arle, Age 16-cover.png', $imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-cover.png')) {
            echo "✓ Sorcery Saga II - Arle, Age 16-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga II - Arle, Age 16 (USA)-cover.png\n";
        $skipped++;
    }
}

// Sorcery Saga II - Arle, Age 16 → Sorcery Saga II - Arle, Age 16 (USA)
if (file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16-gameplay.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-gameplay.png')) {
        if (rename($imageDir . '/Sorcery Saga II - Arle, Age 16-gameplay.png', $imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-gameplay.png')) {
            echo "✓ Sorcery Saga II - Arle, Age 16-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga II - Arle, Age 16 (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Sorcery Saga III - The Ultimate Queen → Sorcery Saga III - The Ultimate Queen (USA)
if (file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen-artwork.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-artwork.png')) {
        if (rename($imageDir . '/Sorcery Saga III - The Ultimate Queen-artwork.png', $imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-artwork.png')) {
            echo "✓ Sorcery Saga III - The Ultimate Queen-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga III - The Ultimate Queen (USA)-artwork.png\n";
        $skipped++;
    }
}

// Sorcery Saga III - The Ultimate Queen → Sorcery Saga III - The Ultimate Queen (USA)
if (file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen-cover.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-cover.png')) {
        if (rename($imageDir . '/Sorcery Saga III - The Ultimate Queen-cover.png', $imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-cover.png')) {
            echo "✓ Sorcery Saga III - The Ultimate Queen-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga III - The Ultimate Queen (USA)-cover.png\n";
        $skipped++;
    }
}

// Sorcery Saga III - The Ultimate Queen → Sorcery Saga III - The Ultimate Queen (USA)
if (file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen-gameplay.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-gameplay.png')) {
        if (rename($imageDir . '/Sorcery Saga III - The Ultimate Queen-gameplay.png', $imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-gameplay.png')) {
            echo "✓ Sorcery Saga III - The Ultimate Queen-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga III - The Ultimate Queen (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Space Harrier → Space Harrier (World)
if (file_exists($imageDir . '/Space Harrier-artwork.png')) {
    if (!file_exists($imageDir . '/Space Harrier (World)-artwork.png')) {
        if (rename($imageDir . '/Space Harrier-artwork.png', $imageDir . '/Space Harrier (World)-artwork.png')) {
            echo "✓ Space Harrier-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Space Harrier (World)-artwork.png\n";
        $skipped++;
    }
}

// Space Harrier → Space Harrier (World)
if (file_exists($imageDir . '/Space Harrier-cover.png')) {
    if (!file_exists($imageDir . '/Space Harrier (World)-cover.png')) {
        if (rename($imageDir . '/Space Harrier-cover.png', $imageDir . '/Space Harrier (World)-cover.png')) {
            echo "✓ Space Harrier-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Space Harrier (World)-cover.png\n";
        $skipped++;
    }
}

// Space Harrier → Space Harrier (World)
if (file_exists($imageDir . '/Space Harrier-gameplay.png')) {
    if (!file_exists($imageDir . '/Space Harrier (World)-gameplay.png')) {
        if (rename($imageDir . '/Space Harrier-gameplay.png', $imageDir . '/Space Harrier (World)-gameplay.png')) {
            echo "✓ Space Harrier-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Space Harrier (World)-gameplay.png\n";
        $skipped++;
    }
}

// Spider-Man - Return of the Sinister Six → Spider-Man - Return of the Sinister Six (USA, Europe)
if (file_exists($imageDir . '/Spider-Man - Return of the Sinister Six-artwork.png')) {
    if (!file_exists($imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Spider-Man - Return of the Sinister Six-artwork.png', $imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-artwork.png')) {
            echo "✓ Spider-Man - Return of the Sinister Six-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Spider-Man - Return of the Sinister Six (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Spider-Man - Return of the Sinister Six → Spider-Man - Return of the Sinister Six (USA, Europe)
if (file_exists($imageDir . '/Spider-Man - Return of the Sinister Six-cover.png')) {
    if (!file_exists($imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Spider-Man - Return of the Sinister Six-cover.png', $imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-cover.png')) {
            echo "✓ Spider-Man - Return of the Sinister Six-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Spider-Man - Return of the Sinister Six (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Spider-Man - Return of the Sinister Six → Spider-Man - Return of the Sinister Six (USA, Europe)
if (file_exists($imageDir . '/Spider-Man - Return of the Sinister Six-gameplay.png')) {
    if (!file_exists($imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Spider-Man - Return of the Sinister Six-gameplay.png', $imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-gameplay.png')) {
            echo "✓ Spider-Man - Return of the Sinister Six-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Spider-Man - Return of the Sinister Six (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Sports Illustrated - Championship Football _ Baseball → Sports Illustrated - Championship Football _ Baseball (USA)
if (file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball-artwork.png')) {
    if (!file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-artwork.png')) {
        if (rename($imageDir . '/Sports Illustrated - Championship Football _ Baseball-artwork.png', $imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-artwork.png')) {
            echo "✓ Sports Illustrated - Championship Football _ Baseball-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Illustrated - Championship Football _ Baseball (USA)-artwork.png\n";
        $skipped++;
    }
}

// Sports Illustrated - Championship Football _ Baseball → Sports Illustrated - Championship Football _ Baseball (USA)
if (file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball-cover.png')) {
    if (!file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-cover.png')) {
        if (rename($imageDir . '/Sports Illustrated - Championship Football _ Baseball-cover.png', $imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-cover.png')) {
            echo "✓ Sports Illustrated - Championship Football _ Baseball-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Illustrated - Championship Football _ Baseball (USA)-cover.png\n";
        $skipped++;
    }
}

// Sports Illustrated - Championship Football _ Baseball → Sports Illustrated - Championship Football _ Baseball (USA)
if (file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball-gameplay.png')) {
    if (!file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-gameplay.png')) {
        if (rename($imageDir . '/Sports Illustrated - Championship Football _ Baseball-gameplay.png', $imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-gameplay.png')) {
            echo "✓ Sports Illustrated - Championship Football _ Baseball-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Illustrated - Championship Football _ Baseball (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Sports Trivia - Championship Edition → Sports Trivia - Championship Edition (USA)
if (file_exists($imageDir . '/Sports Trivia - Championship Edition-artwork.png')) {
    if (!file_exists($imageDir . '/Sports Trivia - Championship Edition (USA)-artwork.png')) {
        if (rename($imageDir . '/Sports Trivia - Championship Edition-artwork.png', $imageDir . '/Sports Trivia - Championship Edition (USA)-artwork.png')) {
            echo "✓ Sports Trivia - Championship Edition-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia - Championship Edition (USA)-artwork.png\n";
        $skipped++;
    }
}

// Sports Trivia - Championship Edition → Sports Trivia - Championship Edition (USA)
if (file_exists($imageDir . '/Sports Trivia - Championship Edition-cover.png')) {
    if (!file_exists($imageDir . '/Sports Trivia - Championship Edition (USA)-cover.png')) {
        if (rename($imageDir . '/Sports Trivia - Championship Edition-cover.png', $imageDir . '/Sports Trivia - Championship Edition (USA)-cover.png')) {
            echo "✓ Sports Trivia - Championship Edition-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia - Championship Edition (USA)-cover.png\n";
        $skipped++;
    }
}

// Sports Trivia - Championship Edition → Sports Trivia - Championship Edition (USA)
if (file_exists($imageDir . '/Sports Trivia - Championship Edition-gameplay.png')) {
    if (!file_exists($imageDir . '/Sports Trivia - Championship Edition (USA)-gameplay.png')) {
        if (rename($imageDir . '/Sports Trivia - Championship Edition-gameplay.png', $imageDir . '/Sports Trivia - Championship Edition (USA)-gameplay.png')) {
            echo "✓ Sports Trivia - Championship Edition-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia - Championship Edition (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Sports Trivia → Sports Trivia (USA)
if (file_exists($imageDir . '/Sports Trivia-artwork.png')) {
    if (!file_exists($imageDir . '/Sports Trivia (USA)-artwork.png')) {
        if (rename($imageDir . '/Sports Trivia-artwork.png', $imageDir . '/Sports Trivia (USA)-artwork.png')) {
            echo "✓ Sports Trivia-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia (USA)-artwork.png\n";
        $skipped++;
    }
}

// Sports Trivia → Sports Trivia (USA)
if (file_exists($imageDir . '/Sports Trivia-cover.png')) {
    if (!file_exists($imageDir . '/Sports Trivia (USA)-cover.png')) {
        if (rename($imageDir . '/Sports Trivia-cover.png', $imageDir . '/Sports Trivia (USA)-cover.png')) {
            echo "✓ Sports Trivia-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia (USA)-cover.png\n";
        $skipped++;
    }
}

// Sports Trivia → Sports Trivia (USA)
if (file_exists($imageDir . '/Sports Trivia-gameplay.png')) {
    if (!file_exists($imageDir . '/Sports Trivia (USA)-gameplay.png')) {
        if (rename($imageDir . '/Sports Trivia-gameplay.png', $imageDir . '/Sports Trivia (USA)-gameplay.png')) {
            echo "✓ Sports Trivia-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Star Trek - The Next Generation - The Advanced Holodeck Tutorial → Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)
if (file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-artwork.png')) {
    if (!file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-artwork.png')) {
        if (rename($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-artwork.png', $imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-artwork.png')) {
            echo "✓ Star Trek - The Next Generation - The Advanced Holodeck Tutorial-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-artwork.png\n";
        $skipped++;
    }
}

// Star Trek - The Next Generation - The Advanced Holodeck Tutorial → Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)
if (file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-cover.png')) {
    if (!file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-cover.png')) {
        if (rename($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-cover.png', $imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-cover.png')) {
            echo "✓ Star Trek - The Next Generation - The Advanced Holodeck Tutorial-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-cover.png\n";
        $skipped++;
    }
}

// Star Trek - The Next Generation - The Advanced Holodeck Tutorial → Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)
if (file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-gameplay.png')) {
    if (!file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-gameplay.png')) {
        if (rename($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-gameplay.png', $imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-gameplay.png')) {
            echo "✓ Star Trek - The Next Generation - The Advanced Holodeck Tutorial-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Star Trek Generations - Beyond the Nexus → Star Trek Generations - Beyond the Nexus (USA)
if (file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus-artwork.png')) {
    if (!file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-artwork.png')) {
        if (rename($imageDir . '/Star Trek Generations - Beyond the Nexus-artwork.png', $imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-artwork.png')) {
            echo "✓ Star Trek Generations - Beyond the Nexus-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek Generations - Beyond the Nexus (USA)-artwork.png\n";
        $skipped++;
    }
}

// Star Trek Generations - Beyond the Nexus → Star Trek Generations - Beyond the Nexus (USA)
if (file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus-cover.png')) {
    if (!file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-cover.png')) {
        if (rename($imageDir . '/Star Trek Generations - Beyond the Nexus-cover.png', $imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-cover.png')) {
            echo "✓ Star Trek Generations - Beyond the Nexus-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek Generations - Beyond the Nexus (USA)-cover.png\n";
        $skipped++;
    }
}

// Star Trek Generations - Beyond the Nexus → Star Trek Generations - Beyond the Nexus (USA)
if (file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus-gameplay.png')) {
    if (!file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-gameplay.png')) {
        if (rename($imageDir . '/Star Trek Generations - Beyond the Nexus-gameplay.png', $imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-gameplay.png')) {
            echo "✓ Star Trek Generations - Beyond the Nexus-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek Generations - Beyond the Nexus (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Streets of Rage 2 → Streets of Rage 2 (World)
if (file_exists($imageDir . '/Streets of Rage 2-artwork.png')) {
    if (!file_exists($imageDir . '/Streets of Rage 2 (World)-artwork.png')) {
        if (rename($imageDir . '/Streets of Rage 2-artwork.png', $imageDir . '/Streets of Rage 2 (World)-artwork.png')) {
            echo "✓ Streets of Rage 2-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Streets of Rage 2 (World)-artwork.png\n";
        $skipped++;
    }
}

// Streets of Rage 2 → Streets of Rage 2 (World)
if (file_exists($imageDir . '/Streets of Rage 2-cover.png')) {
    if (!file_exists($imageDir . '/Streets of Rage 2 (World)-cover.png')) {
        if (rename($imageDir . '/Streets of Rage 2-cover.png', $imageDir . '/Streets of Rage 2 (World)-cover.png')) {
            echo "✓ Streets of Rage 2-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Streets of Rage 2 (World)-cover.png\n";
        $skipped++;
    }
}

// Streets of Rage 2 → Streets of Rage 2 (World)
if (file_exists($imageDir . '/Streets of Rage 2-gameplay.png')) {
    if (!file_exists($imageDir . '/Streets of Rage 2 (World)-gameplay.png')) {
        if (rename($imageDir . '/Streets of Rage 2-gameplay.png', $imageDir . '/Streets of Rage 2 (World)-gameplay.png')) {
            echo "✓ Streets of Rage 2-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Streets of Rage 2 (World)-gameplay.png\n";
        $skipped++;
    }
}

// Super Battletank → Super Battletank (USA)
if (file_exists($imageDir . '/Super Battletank-artwork.png')) {
    if (!file_exists($imageDir . '/Super Battletank (USA)-artwork.png')) {
        if (rename($imageDir . '/Super Battletank-artwork.png', $imageDir . '/Super Battletank (USA)-artwork.png')) {
            echo "✓ Super Battletank-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Battletank (USA)-artwork.png\n";
        $skipped++;
    }
}

// Super Battletank → Super Battletank (USA)
if (file_exists($imageDir . '/Super Battletank-cover.png')) {
    if (!file_exists($imageDir . '/Super Battletank (USA)-cover.png')) {
        if (rename($imageDir . '/Super Battletank-cover.png', $imageDir . '/Super Battletank (USA)-cover.png')) {
            echo "✓ Super Battletank-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Battletank (USA)-cover.png\n";
        $skipped++;
    }
}

// Super Battletank → Super Battletank (USA)
if (file_exists($imageDir . '/Super Battletank-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Battletank (USA)-gameplay.png')) {
        if (rename($imageDir . '/Super Battletank-gameplay.png', $imageDir . '/Super Battletank (USA)-gameplay.png')) {
            echo "✓ Super Battletank-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Battletank (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Super Columns → Super Columns (Japan)
if (file_exists($imageDir . '/Super Columns-artwork.png')) {
    if (!file_exists($imageDir . '/Super Columns (Japan)-artwork.png')) {
        if (rename($imageDir . '/Super Columns-artwork.png', $imageDir . '/Super Columns (Japan)-artwork.png')) {
            echo "✓ Super Columns-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Columns (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Super Columns → Super Columns (Japan)
if (file_exists($imageDir . '/Super Columns-cover.png')) {
    if (!file_exists($imageDir . '/Super Columns (Japan)-cover.png')) {
        if (rename($imageDir . '/Super Columns-cover.png', $imageDir . '/Super Columns (Japan)-cover.png')) {
            echo "✓ Super Columns-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Columns (Japan)-cover.png\n";
        $skipped++;
    }
}

// Super Columns → Super Columns (Japan)
if (file_exists($imageDir . '/Super Columns-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Columns (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Super Columns-gameplay.png', $imageDir . '/Super Columns (Japan)-gameplay.png')) {
            echo "✓ Super Columns-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Columns (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Super Golf → Super Golf (USA)
if (file_exists($imageDir . '/Super Golf-artwork.png')) {
    if (!file_exists($imageDir . '/Super Golf (USA)-artwork.png')) {
        if (rename($imageDir . '/Super Golf-artwork.png', $imageDir . '/Super Golf (USA)-artwork.png')) {
            echo "✓ Super Golf-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Golf (USA)-artwork.png\n";
        $skipped++;
    }
}

// Super Golf → Super Golf (USA)
if (file_exists($imageDir . '/Super Golf-cover.png')) {
    if (!file_exists($imageDir . '/Super Golf (USA)-cover.png')) {
        if (rename($imageDir . '/Super Golf-cover.png', $imageDir . '/Super Golf (USA)-cover.png')) {
            echo "✓ Super Golf-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Golf (USA)-cover.png\n";
        $skipped++;
    }
}

// Super Golf → Super Golf (USA)
if (file_exists($imageDir . '/Super Golf-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Golf (USA)-gameplay.png')) {
        if (rename($imageDir . '/Super Golf-gameplay.png', $imageDir . '/Super Golf (USA)-gameplay.png')) {
            echo "✓ Super Golf-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Golf (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Super Momotarou Dentetsu III → Super Momotarou Dentetsu III (Japan)
if (file_exists($imageDir . '/Super Momotarou Dentetsu III-artwork.png')) {
    if (!file_exists($imageDir . '/Super Momotarou Dentetsu III (Japan)-artwork.png')) {
        if (rename($imageDir . '/Super Momotarou Dentetsu III-artwork.png', $imageDir . '/Super Momotarou Dentetsu III (Japan)-artwork.png')) {
            echo "✓ Super Momotarou Dentetsu III-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Momotarou Dentetsu III (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Super Momotarou Dentetsu III → Super Momotarou Dentetsu III (Japan)
if (file_exists($imageDir . '/Super Momotarou Dentetsu III-cover.png')) {
    if (!file_exists($imageDir . '/Super Momotarou Dentetsu III (Japan)-cover.png')) {
        if (rename($imageDir . '/Super Momotarou Dentetsu III-cover.png', $imageDir . '/Super Momotarou Dentetsu III (Japan)-cover.png')) {
            echo "✓ Super Momotarou Dentetsu III-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Momotarou Dentetsu III (Japan)-cover.png\n";
        $skipped++;
    }
}

// Super Momotarou Dentetsu III → Super Momotarou Dentetsu III (Japan)
if (file_exists($imageDir . '/Super Momotarou Dentetsu III-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Momotarou Dentetsu III (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Super Momotarou Dentetsu III-gameplay.png', $imageDir . '/Super Momotarou Dentetsu III (Japan)-gameplay.png')) {
            echo "✓ Super Momotarou Dentetsu III-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Momotarou Dentetsu III (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Super Smash T.V. → Super Smash T.V. (World)
if (file_exists($imageDir . '/Super Smash T.V.-artwork.png')) {
    if (!file_exists($imageDir . '/Super Smash T.V. (World)-artwork.png')) {
        if (rename($imageDir . '/Super Smash T.V.-artwork.png', $imageDir . '/Super Smash T.V. (World)-artwork.png')) {
            echo "✓ Super Smash T.V.-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Smash T.V. (World)-artwork.png\n";
        $skipped++;
    }
}

// Super Smash T.V. → Super Smash T.V. (World)
if (file_exists($imageDir . '/Super Smash T.V.-cover.png')) {
    if (!file_exists($imageDir . '/Super Smash T.V. (World)-cover.png')) {
        if (rename($imageDir . '/Super Smash T.V.-cover.png', $imageDir . '/Super Smash T.V. (World)-cover.png')) {
            echo "✓ Super Smash T.V.-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Smash T.V. (World)-cover.png\n";
        $skipped++;
    }
}

// Super Smash T.V. → Super Smash T.V. (World)
if (file_exists($imageDir . '/Super Smash T.V.-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Smash T.V. (World)-gameplay.png')) {
        if (rename($imageDir . '/Super Smash T.V.-gameplay.png', $imageDir . '/Super Smash T.V. (World)-gameplay.png')) {
            echo "✓ Super Smash T.V.-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Smash T.V. (World)-gameplay.png\n";
        $skipped++;
    }
}

// Super Space Invaders → Super Space Invaders (USA, Europe)
if (file_exists($imageDir . '/Super Space Invaders-artwork.png')) {
    if (!file_exists($imageDir . '/Super Space Invaders (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Super Space Invaders-artwork.png', $imageDir . '/Super Space Invaders (USA, Europe)-artwork.png')) {
            echo "✓ Super Space Invaders-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Space Invaders (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Super Space Invaders → Super Space Invaders (USA, Europe)
if (file_exists($imageDir . '/Super Space Invaders-cover.png')) {
    if (!file_exists($imageDir . '/Super Space Invaders (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Super Space Invaders-cover.png', $imageDir . '/Super Space Invaders (USA, Europe)-cover.png')) {
            echo "✓ Super Space Invaders-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Space Invaders (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Super Space Invaders → Super Space Invaders (USA, Europe)
if (file_exists($imageDir . '/Super Space Invaders-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Space Invaders (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Super Space Invaders-gameplay.png', $imageDir . '/Super Space Invaders (USA, Europe)-gameplay.png')) {
            echo "✓ Super Space Invaders-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Space Invaders (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Super Star Wars - Return of the Jedi → Super Star Wars - Return of the Jedi (USA, Europe)
if (file_exists($imageDir . '/Super Star Wars - Return of the Jedi-artwork.png')) {
    if (!file_exists($imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Super Star Wars - Return of the Jedi-artwork.png', $imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-artwork.png')) {
            echo "✓ Super Star Wars - Return of the Jedi-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Star Wars - Return of the Jedi (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Super Star Wars - Return of the Jedi → Super Star Wars - Return of the Jedi (USA, Europe)
if (file_exists($imageDir . '/Super Star Wars - Return of the Jedi-cover.png')) {
    if (!file_exists($imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Super Star Wars - Return of the Jedi-cover.png', $imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-cover.png')) {
            echo "✓ Super Star Wars - Return of the Jedi-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Star Wars - Return of the Jedi (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Super Star Wars - Return of the Jedi → Super Star Wars - Return of the Jedi (USA, Europe)
if (file_exists($imageDir . '/Super Star Wars - Return of the Jedi-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Super Star Wars - Return of the Jedi-gameplay.png', $imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-gameplay.png')) {
            echo "✓ Super Star Wars - Return of the Jedi-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Star Wars - Return of the Jedi (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Superman - The Man of Steel → Superman - The Man of Steel (Europe)
if (file_exists($imageDir . '/Superman - The Man of Steel-artwork.png')) {
    if (!file_exists($imageDir . '/Superman - The Man of Steel (Europe)-artwork.png')) {
        if (rename($imageDir . '/Superman - The Man of Steel-artwork.png', $imageDir . '/Superman - The Man of Steel (Europe)-artwork.png')) {
            echo "✓ Superman - The Man of Steel-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Superman - The Man of Steel (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Superman - The Man of Steel → Superman - The Man of Steel (Europe)
if (file_exists($imageDir . '/Superman - The Man of Steel-cover.png')) {
    if (!file_exists($imageDir . '/Superman - The Man of Steel (Europe)-cover.png')) {
        if (rename($imageDir . '/Superman - The Man of Steel-cover.png', $imageDir . '/Superman - The Man of Steel (Europe)-cover.png')) {
            echo "✓ Superman - The Man of Steel-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Superman - The Man of Steel (Europe)-cover.png\n";
        $skipped++;
    }
}

// Superman - The Man of Steel → Superman - The Man of Steel (Europe)
if (file_exists($imageDir . '/Superman - The Man of Steel-gameplay.png')) {
    if (!file_exists($imageDir . '/Superman - The Man of Steel (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Superman - The Man of Steel-gameplay.png', $imageDir . '/Superman - The Man of Steel (Europe)-gameplay.png')) {
            echo "✓ Superman - The Man of Steel-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Superman - The Man of Steel (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Sylvan Tale → Sylvan Tale (USA)
if (file_exists($imageDir . '/Sylvan Tale-artwork.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale (USA)-artwork.png')) {
        if (rename($imageDir . '/Sylvan Tale-artwork.png', $imageDir . '/Sylvan Tale (USA)-artwork.png')) {
            echo "✓ Sylvan Tale-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale (USA)-artwork.png\n";
        $skipped++;
    }
}

// Sylvan Tale → Sylvan Tale (USA)
if (file_exists($imageDir . '/Sylvan Tale-cover.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale (USA)-cover.png')) {
        if (rename($imageDir . '/Sylvan Tale-cover.png', $imageDir . '/Sylvan Tale (USA)-cover.png')) {
            echo "✓ Sylvan Tale-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale (USA)-cover.png\n";
        $skipped++;
    }
}

// Sylvan Tale → Sylvan Tale (USA)
if (file_exists($imageDir . '/Sylvan Tale-gameplay.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale (USA)-gameplay.png')) {
        if (rename($imageDir . '/Sylvan Tale-gameplay.png', $imageDir . '/Sylvan Tale (USA)-gameplay.png')) {
            echo "✓ Sylvan Tale-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale (USA)-gameplay.png\n";
        $skipped++;
    }
}

// T2 - The Arcade Game → T2 - The Arcade Game (Japan) (En)
if (file_exists($imageDir . '/T2 - The Arcade Game-artwork.png')) {
    if (!file_exists($imageDir . '/T2 - The Arcade Game (Japan) (En)-artwork.png')) {
        if (rename($imageDir . '/T2 - The Arcade Game-artwork.png', $imageDir . '/T2 - The Arcade Game (Japan) (En)-artwork.png')) {
            echo "✓ T2 - The Arcade Game-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: T2 - The Arcade Game (Japan) (En)-artwork.png\n";
        $skipped++;
    }
}

// T2 - The Arcade Game → T2 - The Arcade Game (Japan) (En)
if (file_exists($imageDir . '/T2 - The Arcade Game-cover.png')) {
    if (!file_exists($imageDir . '/T2 - The Arcade Game (Japan) (En)-cover.png')) {
        if (rename($imageDir . '/T2 - The Arcade Game-cover.png', $imageDir . '/T2 - The Arcade Game (Japan) (En)-cover.png')) {
            echo "✓ T2 - The Arcade Game-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: T2 - The Arcade Game (Japan) (En)-cover.png\n";
        $skipped++;
    }
}

// T2 - The Arcade Game → T2 - The Arcade Game (Japan) (En)
if (file_exists($imageDir . '/T2 - The Arcade Game-gameplay.png')) {
    if (!file_exists($imageDir . '/T2 - The Arcade Game (Japan) (En)-gameplay.png')) {
        if (rename($imageDir . '/T2 - The Arcade Game-gameplay.png', $imageDir . '/T2 - The Arcade Game (Japan) (En)-gameplay.png')) {
            echo "✓ T2 - The Arcade Game-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: T2 - The Arcade Game (Japan) (En)-gameplay.png\n";
        $skipped++;
    }
}

// Tails' Skypatrol → Tails' Skypatrol (Japan) (En)
if (file_exists($imageDir . '/Tails\' Skypatrol-artwork.png')) {
    if (!file_exists($imageDir . '/Tails\' Skypatrol (Japan) (En)-artwork.png')) {
        if (rename($imageDir . '/Tails\' Skypatrol-artwork.png', $imageDir . '/Tails\' Skypatrol (Japan) (En)-artwork.png')) {
            echo "✓ Tails\' Skypatrol-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tails\' Skypatrol (Japan) (En)-artwork.png\n";
        $skipped++;
    }
}

// Tails' Skypatrol → Tails' Skypatrol (Japan) (En)
if (file_exists($imageDir . '/Tails\' Skypatrol-cover.png')) {
    if (!file_exists($imageDir . '/Tails\' Skypatrol (Japan) (En)-cover.png')) {
        if (rename($imageDir . '/Tails\' Skypatrol-cover.png', $imageDir . '/Tails\' Skypatrol (Japan) (En)-cover.png')) {
            echo "✓ Tails\' Skypatrol-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tails\' Skypatrol (Japan) (En)-cover.png\n";
        $skipped++;
    }
}

// Tails' Skypatrol → Tails' Skypatrol (Japan) (En)
if (file_exists($imageDir . '/Tails\' Skypatrol-gameplay.png')) {
    if (!file_exists($imageDir . '/Tails\' Skypatrol (Japan) (En)-gameplay.png')) {
        if (rename($imageDir . '/Tails\' Skypatrol-gameplay.png', $imageDir . '/Tails\' Skypatrol (Japan) (En)-gameplay.png')) {
            echo "✓ Tails\' Skypatrol-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tails\' Skypatrol (Japan) (En)-gameplay.png\n";
        $skipped++;
    }
}

// Taisen Mahjong HaoPai 2 → Taisen Mahjong HaoPai 2 (Japan)
if (file_exists($imageDir . '/Taisen Mahjong HaoPai 2-artwork.png')) {
    if (!file_exists($imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-artwork.png')) {
        if (rename($imageDir . '/Taisen Mahjong HaoPai 2-artwork.png', $imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-artwork.png')) {
            echo "✓ Taisen Mahjong HaoPai 2-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen Mahjong HaoPai 2 (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Taisen Mahjong HaoPai 2 → Taisen Mahjong HaoPai 2 (Japan)
if (file_exists($imageDir . '/Taisen Mahjong HaoPai 2-cover.png')) {
    if (!file_exists($imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-cover.png')) {
        if (rename($imageDir . '/Taisen Mahjong HaoPai 2-cover.png', $imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-cover.png')) {
            echo "✓ Taisen Mahjong HaoPai 2-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen Mahjong HaoPai 2 (Japan)-cover.png\n";
        $skipped++;
    }
}

// Taisen Mahjong HaoPai 2 → Taisen Mahjong HaoPai 2 (Japan)
if (file_exists($imageDir . '/Taisen Mahjong HaoPai 2-gameplay.png')) {
    if (!file_exists($imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Taisen Mahjong HaoPai 2-gameplay.png', $imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-gameplay.png')) {
            echo "✓ Taisen Mahjong HaoPai 2-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen Mahjong HaoPai 2 (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Taisen-gata Daisenryaku G → Taisen-gata Daisenryaku G (Japan)
if (file_exists($imageDir . '/Taisen-gata Daisenryaku G-artwork.png')) {
    if (!file_exists($imageDir . '/Taisen-gata Daisenryaku G (Japan)-artwork.png')) {
        if (rename($imageDir . '/Taisen-gata Daisenryaku G-artwork.png', $imageDir . '/Taisen-gata Daisenryaku G (Japan)-artwork.png')) {
            echo "✓ Taisen-gata Daisenryaku G-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen-gata Daisenryaku G (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Taisen-gata Daisenryaku G → Taisen-gata Daisenryaku G (Japan)
if (file_exists($imageDir . '/Taisen-gata Daisenryaku G-cover.png')) {
    if (!file_exists($imageDir . '/Taisen-gata Daisenryaku G (Japan)-cover.png')) {
        if (rename($imageDir . '/Taisen-gata Daisenryaku G-cover.png', $imageDir . '/Taisen-gata Daisenryaku G (Japan)-cover.png')) {
            echo "✓ Taisen-gata Daisenryaku G-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen-gata Daisenryaku G (Japan)-cover.png\n";
        $skipped++;
    }
}

// Taisen-gata Daisenryaku G → Taisen-gata Daisenryaku G (Japan)
if (file_exists($imageDir . '/Taisen-gata Daisenryaku G-gameplay.png')) {
    if (!file_exists($imageDir . '/Taisen-gata Daisenryaku G (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Taisen-gata Daisenryaku G-gameplay.png', $imageDir . '/Taisen-gata Daisenryaku G (Japan)-gameplay.png')) {
            echo "✓ Taisen-gata Daisenryaku G-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen-gata Daisenryaku G (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Tama _ Friends - 3 Choume Kouen Tamalympic → Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)
if (file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-artwork.png')) {
    if (!file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-artwork.png')) {
        if (rename($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-artwork.png', $imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-artwork.png')) {
            echo "✓ Tama _ Friends - 3 Choume Kouen Tamalympic-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Tama _ Friends - 3 Choume Kouen Tamalympic → Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)
if (file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-cover.png')) {
    if (!file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-cover.png')) {
        if (rename($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-cover.png', $imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-cover.png')) {
            echo "✓ Tama _ Friends - 3 Choume Kouen Tamalympic-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-cover.png\n";
        $skipped++;
    }
}

// Tama _ Friends - 3 Choume Kouen Tamalympic → Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)
if (file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-gameplay.png')) {
    if (!file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-gameplay.png', $imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-gameplay.png')) {
            echo "✓ Tama _ Friends - 3 Choume Kouen Tamalympic-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Tarot no Yakata → Tarot no Yakata (Japan)
if (file_exists($imageDir . '/Tarot no Yakata-artwork.png')) {
    if (!file_exists($imageDir . '/Tarot no Yakata (Japan)-artwork.png')) {
        if (rename($imageDir . '/Tarot no Yakata-artwork.png', $imageDir . '/Tarot no Yakata (Japan)-artwork.png')) {
            echo "✓ Tarot no Yakata-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarot no Yakata (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Tarot no Yakata → Tarot no Yakata (Japan)
if (file_exists($imageDir . '/Tarot no Yakata-cover.png')) {
    if (!file_exists($imageDir . '/Tarot no Yakata (Japan)-cover.png')) {
        if (rename($imageDir . '/Tarot no Yakata-cover.png', $imageDir . '/Tarot no Yakata (Japan)-cover.png')) {
            echo "✓ Tarot no Yakata-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarot no Yakata (Japan)-cover.png\n";
        $skipped++;
    }
}

// Tarot no Yakata → Tarot no Yakata (Japan)
if (file_exists($imageDir . '/Tarot no Yakata-gameplay.png')) {
    if (!file_exists($imageDir . '/Tarot no Yakata (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Tarot no Yakata-gameplay.png', $imageDir . '/Tarot no Yakata (Japan)-gameplay.png')) {
            echo "✓ Tarot no Yakata-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarot no Yakata (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Tarzan - Lord of the Jungle → Tarzan - Lord of the Jungle (Europe)
if (file_exists($imageDir . '/Tarzan - Lord of the Jungle-artwork.png')) {
    if (!file_exists($imageDir . '/Tarzan - Lord of the Jungle (Europe)-artwork.png')) {
        if (rename($imageDir . '/Tarzan - Lord of the Jungle-artwork.png', $imageDir . '/Tarzan - Lord of the Jungle (Europe)-artwork.png')) {
            echo "✓ Tarzan - Lord of the Jungle-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarzan - Lord of the Jungle (Europe)-artwork.png\n";
        $skipped++;
    }
}

// Tarzan - Lord of the Jungle → Tarzan - Lord of the Jungle (Europe)
if (file_exists($imageDir . '/Tarzan - Lord of the Jungle-cover.png')) {
    if (!file_exists($imageDir . '/Tarzan - Lord of the Jungle (Europe)-cover.png')) {
        if (rename($imageDir . '/Tarzan - Lord of the Jungle-cover.png', $imageDir . '/Tarzan - Lord of the Jungle (Europe)-cover.png')) {
            echo "✓ Tarzan - Lord of the Jungle-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarzan - Lord of the Jungle (Europe)-cover.png\n";
        $skipped++;
    }
}

// Tarzan - Lord of the Jungle → Tarzan - Lord of the Jungle (Europe)
if (file_exists($imageDir . '/Tarzan - Lord of the Jungle-gameplay.png')) {
    if (!file_exists($imageDir . '/Tarzan - Lord of the Jungle (Europe)-gameplay.png')) {
        if (rename($imageDir . '/Tarzan - Lord of the Jungle-gameplay.png', $imageDir . '/Tarzan - Lord of the Jungle (Europe)-gameplay.png')) {
            echo "✓ Tarzan - Lord of the Jungle-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarzan - Lord of the Jungle (Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Tatakae! Pro Yakyuu Twin League → Tatakae! Pro Yakyuu Twin League (Japan)
if (file_exists($imageDir . '/Tatakae! Pro Yakyuu Twin League-artwork.png')) {
    if (!file_exists($imageDir . '/Tatakae! Pro Yakyuu Twin League (Japan)-artwork.png')) {
        if (rename($imageDir . '/Tatakae! Pro Yakyuu Twin League-artwork.png', $imageDir . '/Tatakae! Pro Yakyuu Twin League (Japan)-artwork.png')) {
            echo "✓ Tatakae! Pro Yakyuu Twin League-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tatakae! Pro Yakyuu Twin League (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Tatakae! Pro Yakyuu Twin League → Tatakae! Pro Yakyuu Twin League (Japan)
if (file_exists($imageDir . '/Tatakae! Pro Yakyuu Twin League-cover.png')) {
    if (!file_exists($imageDir . '/Tatakae! Pro Yakyuu Twin League (Japan)-cover.png')) {
        if (rename($imageDir . '/Tatakae! Pro Yakyuu Twin League-cover.png', $imageDir . '/Tatakae! Pro Yakyuu Twin League (Japan)-cover.png')) {
            echo "✓ Tatakae! Pro Yakyuu Twin League-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tatakae! Pro Yakyuu Twin League (Japan)-cover.png\n";
        $skipped++;
    }
}

// Tatakae! Pro Yakyuu Twin League → Tatakae! Pro Yakyuu Twin League (Japan)
if (file_exists($imageDir . '/Tatakae! Pro Yakyuu Twin League-gameplay.png')) {
    if (!file_exists($imageDir . '/Tatakae! Pro Yakyuu Twin League (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Tatakae! Pro Yakyuu Twin League-gameplay.png', $imageDir . '/Tatakae! Pro Yakyuu Twin League (Japan)-gameplay.png')) {
            echo "✓ Tatakae! Pro Yakyuu Twin League-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tatakae! Pro Yakyuu Twin League (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Taz in Escape from Mars → Taz in Escape from Mars [h]
if (file_exists($imageDir . '/Taz in Escape from Mars-artwork.png')) {
    if (!file_exists($imageDir . '/Taz in Escape from Mars [h]-artwork.png')) {
        if (rename($imageDir . '/Taz in Escape from Mars-artwork.png', $imageDir . '/Taz in Escape from Mars [h]-artwork.png')) {
            echo "✓ Taz in Escape from Mars-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taz in Escape from Mars [h]-artwork.png\n";
        $skipped++;
    }
}

// Taz in Escape from Mars → Taz in Escape from Mars [h]
if (file_exists($imageDir . '/Taz in Escape from Mars-cover.png')) {
    if (!file_exists($imageDir . '/Taz in Escape from Mars [h]-cover.png')) {
        if (rename($imageDir . '/Taz in Escape from Mars-cover.png', $imageDir . '/Taz in Escape from Mars [h]-cover.png')) {
            echo "✓ Taz in Escape from Mars-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taz in Escape from Mars [h]-cover.png\n";
        $skipped++;
    }
}

// Taz in Escape from Mars → Taz in Escape from Mars [h]
if (file_exists($imageDir . '/Taz in Escape from Mars-gameplay.png')) {
    if (!file_exists($imageDir . '/Taz in Escape from Mars [h]-gameplay.png')) {
        if (rename($imageDir . '/Taz in Escape from Mars-gameplay.png', $imageDir . '/Taz in Escape from Mars [h]-gameplay.png')) {
            echo "✓ Taz in Escape from Mars-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taz in Escape from Mars [h]-gameplay.png\n";
        $skipped++;
    }
}

// Tempo Jr. → Tempo Jr. (World)
if (file_exists($imageDir . '/Tempo Jr.-artwork.png')) {
    if (!file_exists($imageDir . '/Tempo Jr. (World)-artwork.png')) {
        if (rename($imageDir . '/Tempo Jr.-artwork.png', $imageDir . '/Tempo Jr. (World)-artwork.png')) {
            echo "✓ Tempo Jr.-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tempo Jr. (World)-artwork.png\n";
        $skipped++;
    }
}

// Tempo Jr. → Tempo Jr. (World)
if (file_exists($imageDir . '/Tempo Jr.-cover.png')) {
    if (!file_exists($imageDir . '/Tempo Jr. (World)-cover.png')) {
        if (rename($imageDir . '/Tempo Jr.-cover.png', $imageDir . '/Tempo Jr. (World)-cover.png')) {
            echo "✓ Tempo Jr.-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tempo Jr. (World)-cover.png\n";
        $skipped++;
    }
}

// Tempo Jr. → Tempo Jr. (World)
if (file_exists($imageDir . '/Tempo Jr.-gameplay.png')) {
    if (!file_exists($imageDir . '/Tempo Jr. (World)-gameplay.png')) {
        if (rename($imageDir . '/Tempo Jr.-gameplay.png', $imageDir . '/Tempo Jr. (World)-gameplay.png')) {
            echo "✓ Tempo Jr.-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tempo Jr. (World)-gameplay.png\n";
        $skipped++;
    }
}

// Tengen World Cup Soccer → Tengen World Cup Soccer (USA, Europe)
if (file_exists($imageDir . '/Tengen World Cup Soccer-artwork.png')) {
    if (!file_exists($imageDir . '/Tengen World Cup Soccer (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Tengen World Cup Soccer-artwork.png', $imageDir . '/Tengen World Cup Soccer (USA, Europe)-artwork.png')) {
            echo "✓ Tengen World Cup Soccer-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tengen World Cup Soccer (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Tengen World Cup Soccer → Tengen World Cup Soccer (USA, Europe)
if (file_exists($imageDir . '/Tengen World Cup Soccer-cover.png')) {
    if (!file_exists($imageDir . '/Tengen World Cup Soccer (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Tengen World Cup Soccer-cover.png', $imageDir . '/Tengen World Cup Soccer (USA, Europe)-cover.png')) {
            echo "✓ Tengen World Cup Soccer-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tengen World Cup Soccer (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Tengen World Cup Soccer → Tengen World Cup Soccer (USA, Europe)
if (file_exists($imageDir . '/Tengen World Cup Soccer-gameplay.png')) {
    if (!file_exists($imageDir . '/Tengen World Cup Soccer (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Tengen World Cup Soccer-gameplay.png', $imageDir . '/Tengen World Cup Soccer (USA, Europe)-gameplay.png')) {
            echo "✓ Tengen World Cup Soccer-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tengen World Cup Soccer (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Terminator 2 - Judgment Day → Terminator 2 - Judgment Day (World)
if (file_exists($imageDir . '/Terminator 2 - Judgment Day-artwork.png')) {
    if (!file_exists($imageDir . '/Terminator 2 - Judgment Day (World)-artwork.png')) {
        if (rename($imageDir . '/Terminator 2 - Judgment Day-artwork.png', $imageDir . '/Terminator 2 - Judgment Day (World)-artwork.png')) {
            echo "✓ Terminator 2 - Judgment Day-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Terminator 2 - Judgment Day (World)-artwork.png\n";
        $skipped++;
    }
}

// Terminator 2 - Judgment Day → Terminator 2 - Judgment Day (World)
if (file_exists($imageDir . '/Terminator 2 - Judgment Day-cover.png')) {
    if (!file_exists($imageDir . '/Terminator 2 - Judgment Day (World)-cover.png')) {
        if (rename($imageDir . '/Terminator 2 - Judgment Day-cover.png', $imageDir . '/Terminator 2 - Judgment Day (World)-cover.png')) {
            echo "✓ Terminator 2 - Judgment Day-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Terminator 2 - Judgment Day (World)-cover.png\n";
        $skipped++;
    }
}

// Terminator 2 - Judgment Day → Terminator 2 - Judgment Day (World)
if (file_exists($imageDir . '/Terminator 2 - Judgment Day-gameplay.png')) {
    if (!file_exists($imageDir . '/Terminator 2 - Judgment Day (World)-gameplay.png')) {
        if (rename($imageDir . '/Terminator 2 - Judgment Day-gameplay.png', $imageDir . '/Terminator 2 - Judgment Day (World)-gameplay.png')) {
            echo "✓ Terminator 2 - Judgment Day-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Terminator 2 - Judgment Day (World)-gameplay.png\n";
        $skipped++;
    }
}

// Tesserae → Tesserae (USA)
if (file_exists($imageDir . '/Tesserae-artwork.png')) {
    if (!file_exists($imageDir . '/Tesserae (USA)-artwork.png')) {
        if (rename($imageDir . '/Tesserae-artwork.png', $imageDir . '/Tesserae (USA)-artwork.png')) {
            echo "✓ Tesserae-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tesserae (USA)-artwork.png\n";
        $skipped++;
    }
}

// Tesserae → Tesserae (USA)
if (file_exists($imageDir . '/Tesserae-cover.png')) {
    if (!file_exists($imageDir . '/Tesserae (USA)-cover.png')) {
        if (rename($imageDir . '/Tesserae-cover.png', $imageDir . '/Tesserae (USA)-cover.png')) {
            echo "✓ Tesserae-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tesserae (USA)-cover.png\n";
        $skipped++;
    }
}

// Tesserae → Tesserae (USA)
if (file_exists($imageDir . '/Tesserae-gameplay.png')) {
    if (!file_exists($imageDir . '/Tesserae (USA)-gameplay.png')) {
        if (rename($imageDir . '/Tesserae-gameplay.png', $imageDir . '/Tesserae (USA)-gameplay.png')) {
            echo "✓ Tesserae-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tesserae (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Torarete Tamaruka → Torarete Tamaruka (Japan)
if (file_exists($imageDir . '/Torarete Tamaruka-artwork.png')) {
    if (!file_exists($imageDir . '/Torarete Tamaruka (Japan)-artwork.png')) {
        if (rename($imageDir . '/Torarete Tamaruka-artwork.png', $imageDir . '/Torarete Tamaruka (Japan)-artwork.png')) {
            echo "✓ Torarete Tamaruka-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Torarete Tamaruka (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Torarete Tamaruka → Torarete Tamaruka (Japan)
if (file_exists($imageDir . '/Torarete Tamaruka-cover.png')) {
    if (!file_exists($imageDir . '/Torarete Tamaruka (Japan)-cover.png')) {
        if (rename($imageDir . '/Torarete Tamaruka-cover.png', $imageDir . '/Torarete Tamaruka (Japan)-cover.png')) {
            echo "✓ Torarete Tamaruka-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Torarete Tamaruka (Japan)-cover.png\n";
        $skipped++;
    }
}

// Torarete Tamaruka → Torarete Tamaruka (Japan)
if (file_exists($imageDir . '/Torarete Tamaruka-gameplay.png')) {
    if (!file_exists($imageDir . '/Torarete Tamaruka (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Torarete Tamaruka-gameplay.png', $imageDir . '/Torarete Tamaruka (Japan)-gameplay.png')) {
            echo "✓ Torarete Tamaruka-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Torarete Tamaruka (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// Urban Strike → Urban Strike (USA)
if (file_exists($imageDir . '/Urban Strike-artwork.png')) {
    if (!file_exists($imageDir . '/Urban Strike (USA)-artwork.png')) {
        if (rename($imageDir . '/Urban Strike-artwork.png', $imageDir . '/Urban Strike (USA)-artwork.png')) {
            echo "✓ Urban Strike-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Urban Strike (USA)-artwork.png\n";
        $skipped++;
    }
}

// Urban Strike → Urban Strike (USA)
if (file_exists($imageDir . '/Urban Strike-cover.png')) {
    if (!file_exists($imageDir . '/Urban Strike (USA)-cover.png')) {
        if (rename($imageDir . '/Urban Strike-cover.png', $imageDir . '/Urban Strike (USA)-cover.png')) {
            echo "✓ Urban Strike-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Urban Strike (USA)-cover.png\n";
        $skipped++;
    }
}

// Urban Strike → Urban Strike (USA)
if (file_exists($imageDir . '/Urban Strike-gameplay.png')) {
    if (!file_exists($imageDir . '/Urban Strike (USA)-gameplay.png')) {
        if (rename($imageDir . '/Urban Strike-gameplay.png', $imageDir . '/Urban Strike (USA)-gameplay.png')) {
            echo "✓ Urban Strike-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Urban Strike (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Vampire - Master of Darkness → Vampire - Master of Darkness (USA)
if (file_exists($imageDir . '/Vampire - Master of Darkness-artwork.png')) {
    if (!file_exists($imageDir . '/Vampire - Master of Darkness (USA)-artwork.png')) {
        if (rename($imageDir . '/Vampire - Master of Darkness-artwork.png', $imageDir . '/Vampire - Master of Darkness (USA)-artwork.png')) {
            echo "✓ Vampire - Master of Darkness-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Vampire - Master of Darkness (USA)-artwork.png\n";
        $skipped++;
    }
}

// Vampire - Master of Darkness → Vampire - Master of Darkness (USA)
if (file_exists($imageDir . '/Vampire - Master of Darkness-cover.png')) {
    if (!file_exists($imageDir . '/Vampire - Master of Darkness (USA)-cover.png')) {
        if (rename($imageDir . '/Vampire - Master of Darkness-cover.png', $imageDir . '/Vampire - Master of Darkness (USA)-cover.png')) {
            echo "✓ Vampire - Master of Darkness-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Vampire - Master of Darkness (USA)-cover.png\n";
        $skipped++;
    }
}

// Vampire - Master of Darkness → Vampire - Master of Darkness (USA)
if (file_exists($imageDir . '/Vampire - Master of Darkness-gameplay.png')) {
    if (!file_exists($imageDir . '/Vampire - Master of Darkness (USA)-gameplay.png')) {
        if (rename($imageDir . '/Vampire - Master of Darkness-gameplay.png', $imageDir . '/Vampire - Master of Darkness (USA)-gameplay.png')) {
            echo "✓ Vampire - Master of Darkness-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Vampire - Master of Darkness (USA)-gameplay.png\n";
        $skipped++;
    }
}

// Virtua Fighter Animation → Virtua Fighter Animation (USA, Europe)
if (file_exists($imageDir . '/Virtua Fighter Animation-artwork.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Animation (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/Virtua Fighter Animation-artwork.png', $imageDir . '/Virtua Fighter Animation (USA, Europe)-artwork.png')) {
            echo "✓ Virtua Fighter Animation-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Animation (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// Virtua Fighter Animation → Virtua Fighter Animation (USA, Europe)
if (file_exists($imageDir . '/Virtua Fighter Animation-cover.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Animation (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/Virtua Fighter Animation-cover.png', $imageDir . '/Virtua Fighter Animation (USA, Europe)-cover.png')) {
            echo "✓ Virtua Fighter Animation-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Animation (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// Virtua Fighter Animation → Virtua Fighter Animation (USA, Europe)
if (file_exists($imageDir . '/Virtua Fighter Animation-gameplay.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Animation (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/Virtua Fighter Animation-gameplay.png', $imageDir . '/Virtua Fighter Animation (USA, Europe)-gameplay.png')) {
            echo "✓ Virtua Fighter Animation-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Animation (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Virtua Fighter Mini → Virtua Fighter Mini (Japan)
if (file_exists($imageDir . '/Virtua Fighter Mini-artwork.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Mini (Japan)-artwork.png')) {
        if (rename($imageDir . '/Virtua Fighter Mini-artwork.png', $imageDir . '/Virtua Fighter Mini (Japan)-artwork.png')) {
            echo "✓ Virtua Fighter Mini-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Mini (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Virtua Fighter Mini → Virtua Fighter Mini (Japan)
if (file_exists($imageDir . '/Virtua Fighter Mini-cover.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Mini (Japan)-cover.png')) {
        if (rename($imageDir . '/Virtua Fighter Mini-cover.png', $imageDir . '/Virtua Fighter Mini (Japan)-cover.png')) {
            echo "✓ Virtua Fighter Mini-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Mini (Japan)-cover.png\n";
        $skipped++;
    }
}

// Virtua Fighter Mini → Virtua Fighter Mini (Japan)
if (file_exists($imageDir . '/Virtua Fighter Mini-gameplay.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Mini (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Virtua Fighter Mini-gameplay.png', $imageDir . '/Virtua Fighter Mini (Japan)-gameplay.png')) {
            echo "✓ Virtua Fighter Mini-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Mini (Japan)-gameplay.png\n";
        $skipped++;
    }
}

// WWF Wrestlemania - Steel Cage Challenge → WWF Wrestlemania - Steel Cage Challenge (USA, Europe)
if (file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge-artwork.png')) {
    if (!file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-artwork.png')) {
        if (rename($imageDir . '/WWF Wrestlemania - Steel Cage Challenge-artwork.png', $imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-artwork.png')) {
            echo "✓ WWF Wrestlemania - Steel Cage Challenge-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-artwork.png\n";
        $skipped++;
    }
}

// WWF Wrestlemania - Steel Cage Challenge → WWF Wrestlemania - Steel Cage Challenge (USA, Europe)
if (file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge-cover.png')) {
    if (!file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-cover.png')) {
        if (rename($imageDir . '/WWF Wrestlemania - Steel Cage Challenge-cover.png', $imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-cover.png')) {
            echo "✓ WWF Wrestlemania - Steel Cage Challenge-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-cover.png\n";
        $skipped++;
    }
}

// WWF Wrestlemania - Steel Cage Challenge → WWF Wrestlemania - Steel Cage Challenge (USA, Europe)
if (file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge-gameplay.png')) {
    if (!file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-gameplay.png')) {
        if (rename($imageDir . '/WWF Wrestlemania - Steel Cage Challenge-gameplay.png', $imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-gameplay.png')) {
            echo "✓ WWF Wrestlemania - Steel Cage Challenge-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-gameplay.png\n";
        $skipped++;
    }
}

// Wagyan Land → Wagyan Land (Japan)
if (file_exists($imageDir . '/Wagyan Land-artwork.png')) {
    if (!file_exists($imageDir . '/Wagyan Land (Japan)-artwork.png')) {
        if (rename($imageDir . '/Wagyan Land-artwork.png', $imageDir . '/Wagyan Land (Japan)-artwork.png')) {
            echo "✓ Wagyan Land-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Wagyan Land (Japan)-artwork.png\n";
        $skipped++;
    }
}

// Wagyan Land → Wagyan Land (Japan)
if (file_exists($imageDir . '/Wagyan Land-cover.png')) {
    if (!file_exists($imageDir . '/Wagyan Land (Japan)-cover.png')) {
        if (rename($imageDir . '/Wagyan Land-cover.png', $imageDir . '/Wagyan Land (Japan)-cover.png')) {
            echo "✓ Wagyan Land-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Wagyan Land (Japan)-cover.png\n";
        $skipped++;
    }
}

// Wagyan Land → Wagyan Land (Japan)
if (file_exists($imageDir . '/Wagyan Land-gameplay.png')) {
    if (!file_exists($imageDir . '/Wagyan Land (Japan)-gameplay.png')) {
        if (rename($imageDir . '/Wagyan Land-gameplay.png', $imageDir . '/Wagyan Land (Japan)-gameplay.png')) {
            echo "✓ Wagyan Land-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Wagyan Land (Japan)-gameplay.png\n";
        $skipped++;
    }
}

echo "\n═══════════════════════════════════════════════════════════════════════════════\n";
echo "✅ Renommés: $renamed | ⚠️ Ignorés: $skipped\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n";
