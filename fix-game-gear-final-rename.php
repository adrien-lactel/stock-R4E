<?php

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║        RENOMMAGE FINAL - GAME GEAR IMAGES → ROM_ID                          ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

$imageDir = __DIR__ . '/public/images/taxonomy/gamegear';
$renamed = 0;
$skipped = 0;

// 5 in One FunPak (USA) → 5 in One FunPak
if (file_exists($imageDir . '/5 in One FunPak (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/5 in One FunPak-artwork.png')) {
        if (rename($imageDir . '/5 in One FunPak (USA)-artwork.png', $imageDir . '/5 in One FunPak-artwork.png')) {
            echo "✓ 5 in One FunPak (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: 5 in One FunPak-artwork.png\n";
        $skipped++;
    }
}

// 5 in One FunPak (USA) → 5 in One FunPak
if (file_exists($imageDir . '/5 in One FunPak (USA)-cover.png')) {
    if (!file_exists($imageDir . '/5 in One FunPak-cover.png')) {
        if (rename($imageDir . '/5 in One FunPak (USA)-cover.png', $imageDir . '/5 in One FunPak-cover.png')) {
            echo "✓ 5 in One FunPak (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: 5 in One FunPak-cover.png\n";
        $skipped++;
    }
}

// 5 in One FunPak (USA) → 5 in One FunPak
if (file_exists($imageDir . '/5 in One FunPak (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/5 in One FunPak-gameplay.png')) {
        if (rename($imageDir . '/5 in One FunPak (USA)-gameplay.png', $imageDir . '/5 in One FunPak-gameplay.png')) {
            echo "✓ 5 in One FunPak (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: 5 in One FunPak-gameplay.png\n";
        $skipped++;
    }
}

// Aa Harimanada (Japan) → Aa Harimanada
if (file_exists($imageDir . '/Aa Harimanada (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Aa Harimanada-artwork.png')) {
        if (rename($imageDir . '/Aa Harimanada (Japan)-artwork.png', $imageDir . '/Aa Harimanada-artwork.png')) {
            echo "✓ Aa Harimanada (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aa Harimanada-artwork.png\n";
        $skipped++;
    }
}

// Aa Harimanada (Japan) → Aa Harimanada
if (file_exists($imageDir . '/Aa Harimanada (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Aa Harimanada-cover.png')) {
        if (rename($imageDir . '/Aa Harimanada (Japan)-cover.png', $imageDir . '/Aa Harimanada-cover.png')) {
            echo "✓ Aa Harimanada (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aa Harimanada-cover.png\n";
        $skipped++;
    }
}

// Aa Harimanada (Japan) → Aa Harimanada
if (file_exists($imageDir . '/Aa Harimanada (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Aa Harimanada-gameplay.png')) {
        if (rename($imageDir . '/Aa Harimanada (Japan)-gameplay.png', $imageDir . '/Aa Harimanada-gameplay.png')) {
            echo "✓ Aa Harimanada (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aa Harimanada-gameplay.png\n";
        $skipped++;
    }
}

// Addams Family, The (World) → Addams Family, The
if (file_exists($imageDir . '/Addams Family, The (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Addams Family, The-artwork.png')) {
        if (rename($imageDir . '/Addams Family, The (World)-artwork.png', $imageDir . '/Addams Family, The-artwork.png')) {
            echo "✓ Addams Family, The (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Addams Family, The-artwork.png\n";
        $skipped++;
    }
}

// Addams Family, The (World) → Addams Family, The
if (file_exists($imageDir . '/Addams Family, The (World)-cover.png')) {
    if (!file_exists($imageDir . '/Addams Family, The-cover.png')) {
        if (rename($imageDir . '/Addams Family, The (World)-cover.png', $imageDir . '/Addams Family, The-cover.png')) {
            echo "✓ Addams Family, The (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Addams Family, The-cover.png\n";
        $skipped++;
    }
}

// Addams Family, The (World) → Addams Family, The
if (file_exists($imageDir . '/Addams Family, The (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Addams Family, The-gameplay.png')) {
        if (rename($imageDir . '/Addams Family, The (World)-gameplay.png', $imageDir . '/Addams Family, The-gameplay.png')) {
            echo "✓ Addams Family, The (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Addams Family, The-gameplay.png\n";
        $skipped++;
    }
}

// Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En) → Adventures of Batman _ Robin, The
if (file_exists($imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Adventures of Batman _ Robin, The-artwork.png')) {
        if (rename($imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-artwork.png', $imageDir . '/Adventures of Batman _ Robin, The-artwork.png')) {
            echo "✓ Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Adventures of Batman _ Robin, The-artwork.png\n";
        $skipped++;
    }
}

// Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En) → Adventures of Batman _ Robin, The
if (file_exists($imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Adventures of Batman _ Robin, The-cover.png')) {
        if (rename($imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-cover.png', $imageDir . '/Adventures of Batman _ Robin, The-cover.png')) {
            echo "✓ Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Adventures of Batman _ Robin, The-cover.png\n";
        $skipped++;
    }
}

// Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En) → Adventures of Batman _ Robin, The
if (file_exists($imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Adventures of Batman _ Robin, The-gameplay.png')) {
        if (rename($imageDir . '/Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-gameplay.png', $imageDir . '/Adventures of Batman _ Robin, The-gameplay.png')) {
            echo "✓ Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Adventures of Batman _ Robin, The-gameplay.png\n";
        $skipped++;
    }
}

// Aerial Assault (World) → Aerial Assault
if (file_exists($imageDir . '/Aerial Assault (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Aerial Assault-artwork.png')) {
        if (rename($imageDir . '/Aerial Assault (World)-artwork.png', $imageDir . '/Aerial Assault-artwork.png')) {
            echo "✓ Aerial Assault (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aerial Assault-artwork.png\n";
        $skipped++;
    }
}

// Aerial Assault (World) → Aerial Assault
if (file_exists($imageDir . '/Aerial Assault (World)-cover.png')) {
    if (!file_exists($imageDir . '/Aerial Assault-cover.png')) {
        if (rename($imageDir . '/Aerial Assault (World)-cover.png', $imageDir . '/Aerial Assault-cover.png')) {
            echo "✓ Aerial Assault (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aerial Assault-cover.png\n";
        $skipped++;
    }
}

// Aerial Assault (World) → Aerial Assault
if (file_exists($imageDir . '/Aerial Assault (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Aerial Assault-gameplay.png')) {
        if (rename($imageDir . '/Aerial Assault (World)-gameplay.png', $imageDir . '/Aerial Assault-gameplay.png')) {
            echo "✓ Aerial Assault (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Aerial Assault-gameplay.png\n";
        $skipped++;
    }
}

// Alien Syndrome (Europe) → Alien Syndrome
if (file_exists($imageDir . '/Alien Syndrome (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Alien Syndrome-artwork.png')) {
        if (rename($imageDir . '/Alien Syndrome (Europe)-artwork.png', $imageDir . '/Alien Syndrome-artwork.png')) {
            echo "✓ Alien Syndrome (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Alien Syndrome-artwork.png\n";
        $skipped++;
    }
}

// Alien Syndrome (Europe) → Alien Syndrome
if (file_exists($imageDir . '/Alien Syndrome (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Alien Syndrome-cover.png')) {
        if (rename($imageDir . '/Alien Syndrome (Europe)-cover.png', $imageDir . '/Alien Syndrome-cover.png')) {
            echo "✓ Alien Syndrome (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Alien Syndrome-cover.png\n";
        $skipped++;
    }
}

// Alien Syndrome (Europe) → Alien Syndrome
if (file_exists($imageDir . '/Alien Syndrome (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Alien Syndrome-gameplay.png')) {
        if (rename($imageDir . '/Alien Syndrome (Europe)-gameplay.png', $imageDir . '/Alien Syndrome-gameplay.png')) {
            echo "✓ Alien Syndrome (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Alien Syndrome-gameplay.png\n";
        $skipped++;
    }
}

// Alien Syndrome (Japan) → Alien Syndrome
if (file_exists($imageDir . '/Alien Syndrome (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Alien Syndrome-cover.png')) {
        if (rename($imageDir . '/Alien Syndrome (Japan)-cover.png', $imageDir . '/Alien Syndrome-cover.png')) {
            echo "✓ Alien Syndrome (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Alien Syndrome-cover.png\n";
        $skipped++;
    }
}

// Andre Agassi Tennis (USA) → Andre Agassi Tennis
if (file_exists($imageDir . '/Andre Agassi Tennis (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Andre Agassi Tennis-artwork.png')) {
        if (rename($imageDir . '/Andre Agassi Tennis (USA)-artwork.png', $imageDir . '/Andre Agassi Tennis-artwork.png')) {
            echo "✓ Andre Agassi Tennis (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Andre Agassi Tennis-artwork.png\n";
        $skipped++;
    }
}

// Andre Agassi Tennis (USA) → Andre Agassi Tennis
if (file_exists($imageDir . '/Andre Agassi Tennis (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Andre Agassi Tennis-cover.png')) {
        if (rename($imageDir . '/Andre Agassi Tennis (USA)-cover.png', $imageDir . '/Andre Agassi Tennis-cover.png')) {
            echo "✓ Andre Agassi Tennis (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Andre Agassi Tennis-cover.png\n";
        $skipped++;
    }
}

// Andre Agassi Tennis (USA) → Andre Agassi Tennis
if (file_exists($imageDir . '/Andre Agassi Tennis (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Andre Agassi Tennis-gameplay.png')) {
        if (rename($imageDir . '/Andre Agassi Tennis (USA)-gameplay.png', $imageDir . '/Andre Agassi Tennis-gameplay.png')) {
            echo "✓ Andre Agassi Tennis (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Andre Agassi Tennis-gameplay.png\n";
        $skipped++;
    }
}

// Arcade Classics (USA) → Arcade Classics
if (file_exists($imageDir . '/Arcade Classics (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Arcade Classics-artwork.png')) {
        if (rename($imageDir . '/Arcade Classics (USA)-artwork.png', $imageDir . '/Arcade Classics-artwork.png')) {
            echo "✓ Arcade Classics (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arcade Classics-artwork.png\n";
        $skipped++;
    }
}

// Arcade Classics (USA) → Arcade Classics
if (file_exists($imageDir . '/Arcade Classics (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Arcade Classics-cover.png')) {
        if (rename($imageDir . '/Arcade Classics (USA)-cover.png', $imageDir . '/Arcade Classics-cover.png')) {
            echo "✓ Arcade Classics (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arcade Classics-cover.png\n";
        $skipped++;
    }
}

// Arcade Classics (USA) → Arcade Classics
if (file_exists($imageDir . '/Arcade Classics (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Arcade Classics-gameplay.png')) {
        if (rename($imageDir . '/Arcade Classics (USA)-gameplay.png', $imageDir . '/Arcade Classics-gameplay.png')) {
            echo "✓ Arcade Classics (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arcade Classics-gameplay.png\n";
        $skipped++;
    }
}

// Arch Rivals - The Arcade Game (USA) → Arch Rivals - The Arcade Game
if (file_exists($imageDir . '/Arch Rivals - The Arcade Game (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Arch Rivals - The Arcade Game-artwork.png')) {
        if (rename($imageDir . '/Arch Rivals - The Arcade Game (USA)-artwork.png', $imageDir . '/Arch Rivals - The Arcade Game-artwork.png')) {
            echo "✓ Arch Rivals - The Arcade Game (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arch Rivals - The Arcade Game-artwork.png\n";
        $skipped++;
    }
}

// Arch Rivals - The Arcade Game (USA) → Arch Rivals - The Arcade Game
if (file_exists($imageDir . '/Arch Rivals - The Arcade Game (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Arch Rivals - The Arcade Game-cover.png')) {
        if (rename($imageDir . '/Arch Rivals - The Arcade Game (USA)-cover.png', $imageDir . '/Arch Rivals - The Arcade Game-cover.png')) {
            echo "✓ Arch Rivals - The Arcade Game (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arch Rivals - The Arcade Game-cover.png\n";
        $skipped++;
    }
}

// Arch Rivals - The Arcade Game (USA) → Arch Rivals - The Arcade Game
if (file_exists($imageDir . '/Arch Rivals - The Arcade Game (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Arch Rivals - The Arcade Game-gameplay.png')) {
        if (rename($imageDir . '/Arch Rivals - The Arcade Game (USA)-gameplay.png', $imageDir . '/Arch Rivals - The Arcade Game-gameplay.png')) {
            echo "✓ Arch Rivals - The Arcade Game (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arch Rivals - The Arcade Game-gameplay.png\n";
        $skipped++;
    }
}

// Ariel - The Little Mermaid (USA, Europe, Brazil) → Ariel - The Little Mermaid
if (file_exists($imageDir . '/Ariel - The Little Mermaid (USA, Europe, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Ariel - The Little Mermaid-cover.png')) {
        if (rename($imageDir . '/Ariel - The Little Mermaid (USA, Europe, Brazil)-cover.png', $imageDir . '/Ariel - The Little Mermaid-cover.png')) {
            echo "✓ Ariel - The Little Mermaid (USA, Europe, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ariel - The Little Mermaid-cover.png\n";
        $skipped++;
    }
}

// Arliel - Crystal Densetsu (Japan) → Arliel - Crystal Densetsu
if (file_exists($imageDir . '/Arliel - Crystal Densetsu (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Arliel - Crystal Densetsu-artwork.png')) {
        if (rename($imageDir . '/Arliel - Crystal Densetsu (Japan)-artwork.png', $imageDir . '/Arliel - Crystal Densetsu-artwork.png')) {
            echo "✓ Arliel - Crystal Densetsu (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arliel - Crystal Densetsu-artwork.png\n";
        $skipped++;
    }
}

// Arliel - Crystal Densetsu (Japan) → Arliel - Crystal Densetsu
if (file_exists($imageDir . '/Arliel - Crystal Densetsu (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Arliel - Crystal Densetsu-cover.png')) {
        if (rename($imageDir . '/Arliel - Crystal Densetsu (Japan)-cover.png', $imageDir . '/Arliel - Crystal Densetsu-cover.png')) {
            echo "✓ Arliel - Crystal Densetsu (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arliel - Crystal Densetsu-cover.png\n";
        $skipped++;
    }
}

// Arliel - Crystal Densetsu (Japan) → Arliel - Crystal Densetsu
if (file_exists($imageDir . '/Arliel - Crystal Densetsu (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Arliel - Crystal Densetsu-gameplay.png')) {
        if (rename($imageDir . '/Arliel - Crystal Densetsu (Japan)-gameplay.png', $imageDir . '/Arliel - Crystal Densetsu-gameplay.png')) {
            echo "✓ Arliel - Crystal Densetsu (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Arliel - Crystal Densetsu-gameplay.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue (USA, Brazil) (En) → Asterix and the Great Rescue
if (file_exists($imageDir . '/Asterix and the Great Rescue (USA, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue-artwork.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue (USA, Brazil) (En)-artwork.png', $imageDir . '/Asterix and the Great Rescue-artwork.png')) {
            echo "✓ Asterix and the Great Rescue (USA, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue-artwork.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue (USA, Brazil) (En) → Asterix and the Great Rescue
if (file_exists($imageDir . '/Asterix and the Great Rescue (USA, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue-cover.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue (USA, Brazil) (En)-cover.png', $imageDir . '/Asterix and the Great Rescue-cover.png')) {
            echo "✓ Asterix and the Great Rescue (USA, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue-cover.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue (USA, Brazil) (En) → Asterix and the Great Rescue
if (file_exists($imageDir . '/Asterix and the Great Rescue (USA, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue-gameplay.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue (USA, Brazil) (En)-gameplay.png', $imageDir . '/Asterix and the Great Rescue-gameplay.png')) {
            echo "✓ Asterix and the Great Rescue (USA, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue-gameplay.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue (USA, Brazil) → Asterix and the Great Rescue
if (file_exists($imageDir . '/Asterix and the Great Rescue (USA, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue-cover.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue (USA, Brazil)-cover.png', $imageDir . '/Asterix and the Great Rescue-cover.png')) {
            echo "✓ Asterix and the Great Rescue (USA, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue-cover.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue (USA, Brazil) → Asterix and the Great Rescue
if (file_exists($imageDir . '/Asterix and the Great Rescue (USA, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue-gameplay.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue (USA, Brazil)-gameplay.png', $imageDir . '/Asterix and the Great Rescue-gameplay.png')) {
            echo "✓ Asterix and the Great Rescue (USA, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue-gameplay.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue Europe En Fr De Es (It) → Asterix and the Great Rescue
if (file_exists($imageDir . '/Asterix and the Great Rescue Europe En Fr De Es (It)-artwork.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue-artwork.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue Europe En Fr De Es (It)-artwork.png', $imageDir . '/Asterix and the Great Rescue-artwork.png')) {
            echo "✓ Asterix and the Great Rescue Europe En Fr De Es (It)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue-artwork.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue Europe En Fr De Es (It) → Asterix and the Great Rescue
if (file_exists($imageDir . '/Asterix and the Great Rescue Europe En Fr De Es (It)-cover.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue-cover.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue Europe En Fr De Es (It)-cover.png', $imageDir . '/Asterix and the Great Rescue-cover.png')) {
            echo "✓ Asterix and the Great Rescue Europe En Fr De Es (It)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue-cover.png\n";
        $skipped++;
    }
}

// Asterix and the Great Rescue Europe En Fr De Es (It) → Asterix and the Great Rescue
if (file_exists($imageDir . '/Asterix and the Great Rescue Europe En Fr De Es (It)-gameplay.png')) {
    if (!file_exists($imageDir . '/Asterix and the Great Rescue-gameplay.png')) {
        if (rename($imageDir . '/Asterix and the Great Rescue Europe En Fr De Es (It)-gameplay.png', $imageDir . '/Asterix and the Great Rescue-gameplay.png')) {
            echo "✓ Asterix and the Great Rescue Europe En Fr De Es (It)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Great Rescue-gameplay.png\n";
        $skipped++;
    }
}

// Asterix and the Secret Mission Europe En Fr (De) → Asterix and the Secret Mission
if (file_exists($imageDir . '/Asterix and the Secret Mission Europe En Fr (De)-artwork.png')) {
    if (!file_exists($imageDir . '/Asterix and the Secret Mission-artwork.png')) {
        if (rename($imageDir . '/Asterix and the Secret Mission Europe En Fr (De)-artwork.png', $imageDir . '/Asterix and the Secret Mission-artwork.png')) {
            echo "✓ Asterix and the Secret Mission Europe En Fr (De)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Secret Mission-artwork.png\n";
        $skipped++;
    }
}

// Asterix and the Secret Mission Europe En Fr (De) → Asterix and the Secret Mission
if (file_exists($imageDir . '/Asterix and the Secret Mission Europe En Fr (De)-cover.png')) {
    if (!file_exists($imageDir . '/Asterix and the Secret Mission-cover.png')) {
        if (rename($imageDir . '/Asterix and the Secret Mission Europe En Fr (De)-cover.png', $imageDir . '/Asterix and the Secret Mission-cover.png')) {
            echo "✓ Asterix and the Secret Mission Europe En Fr (De)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Secret Mission-cover.png\n";
        $skipped++;
    }
}

// Asterix and the Secret Mission Europe En Fr (De) → Asterix and the Secret Mission
if (file_exists($imageDir . '/Asterix and the Secret Mission Europe En Fr (De)-gameplay.png')) {
    if (!file_exists($imageDir . '/Asterix and the Secret Mission-gameplay.png')) {
        if (rename($imageDir . '/Asterix and the Secret Mission Europe En Fr (De)-gameplay.png', $imageDir . '/Asterix and the Secret Mission-gameplay.png')) {
            echo "✓ Asterix and the Secret Mission Europe En Fr (De)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Asterix and the Secret Mission-gameplay.png\n";
        $skipped++;
    }
}

// Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En) → Ax Battler - A Legend of Golden Axe
if (file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe-artwork.png')) {
        if (rename($imageDir . '/Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En)-artwork.png', $imageDir . '/Ax Battler - A Legend of Golden Axe-artwork.png')) {
            echo "✓ Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - A Legend of Golden Axe-artwork.png\n";
        $skipped++;
    }
}

// Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En) → Ax Battler - A Legend of Golden Axe
if (file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe-cover.png')) {
        if (rename($imageDir . '/Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En)-cover.png', $imageDir . '/Ax Battler - A Legend of Golden Axe-cover.png')) {
            echo "✓ Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - A Legend of Golden Axe-cover.png\n";
        $skipped++;
    }
}

// Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En) → Ax Battler - A Legend of Golden Axe
if (file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe-gameplay.png')) {
        if (rename($imageDir . '/Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En)-gameplay.png', $imageDir . '/Ax Battler - A Legend of Golden Axe-gameplay.png')) {
            echo "✓ Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - A Legend of Golden Axe-gameplay.png\n";
        $skipped++;
    }
}

// Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil) → Ax Battler - A Legend of Golden Axe
if (file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe-cover.png')) {
        if (rename($imageDir . '/Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil)-cover.png', $imageDir . '/Ax Battler - A Legend of Golden Axe-cover.png')) {
            echo "✓ Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - A Legend of Golden Axe-cover.png\n";
        $skipped++;
    }
}

// Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil)[tr fr] → Ax Battler - A Legend of Golden Axe
if (file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil)[tr fr]-cover.png')) {
    if (!file_exists($imageDir . '/Ax Battler - A Legend of Golden Axe-cover.png')) {
        if (rename($imageDir . '/Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil)[tr fr]-cover.png', $imageDir . '/Ax Battler - A Legend of Golden Axe-cover.png')) {
            echo "✓ Ax Battler - A Legend of Golden Axe (USA, Europe, Brazil)[tr fr]-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - A Legend of Golden Axe-cover.png\n";
        $skipped++;
    }
}

// Ax Battler - Golden Axe Densetsu (Japan) → Ax Battler - Golden Axe Densetsu
if (file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu-artwork.png')) {
        if (rename($imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-artwork.png', $imageDir . '/Ax Battler - Golden Axe Densetsu-artwork.png')) {
            echo "✓ Ax Battler - Golden Axe Densetsu (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - Golden Axe Densetsu-artwork.png\n";
        $skipped++;
    }
}

// Ax Battler - Golden Axe Densetsu (Japan) → Ax Battler - Golden Axe Densetsu
if (file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu-cover.png')) {
        if (rename($imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-cover.png', $imageDir . '/Ax Battler - Golden Axe Densetsu-cover.png')) {
            echo "✓ Ax Battler - Golden Axe Densetsu (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - Golden Axe Densetsu-cover.png\n";
        $skipped++;
    }
}

// Ax Battler - Golden Axe Densetsu (Japan) → Ax Battler - Golden Axe Densetsu
if (file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ax Battler - Golden Axe Densetsu-gameplay.png')) {
        if (rename($imageDir . '/Ax Battler - Golden Axe Densetsu (Japan)-gameplay.png', $imageDir . '/Ax Battler - Golden Axe Densetsu-gameplay.png')) {
            echo "✓ Ax Battler - Golden Axe Densetsu (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ax Battler - Golden Axe Densetsu-gameplay.png\n";
        $skipped++;
    }
}

// Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil) → Ayrton Senna's Super Monaco GP II
if (file_exists($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil)-artwork.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-artwork.png')) {
        if (rename($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil)-artwork.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II-artwork.png')) {
            echo "✓ Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ayrton Senna\'s Super Monaco GP II-artwork.png\n";
        $skipped++;
    }
}

// Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil) → Ayrton Senna's Super Monaco GP II
if (file_exists($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-cover.png')) {
        if (rename($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil)-cover.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II-cover.png')) {
            echo "✓ Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ayrton Senna\'s Super Monaco GP II-cover.png\n";
        $skipped++;
    }
}

// Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil) → Ayrton Senna's Super Monaco GP II
if (file_exists($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-gameplay.png')) {
        if (rename($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil)-gameplay.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II-gameplay.png')) {
            echo "✓ Ayrton Sennas Super Monaco Gp Ii Usa Europe (Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ayrton Senna\'s Super Monaco GP II-gameplay.png\n";
        $skipped++;
    }
}

// Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En) → Ayrton Senna's Super Monaco GP II
if (file_exists($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-artwork.png')) {
        if (rename($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En)-artwork.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II-artwork.png')) {
            echo "✓ Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ayrton Senna\'s Super Monaco GP II-artwork.png\n";
        $skipped++;
    }
}

// Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En) → Ayrton Senna's Super Monaco GP II
if (file_exists($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En)-cover.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-cover.png')) {
        if (rename($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En)-cover.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II-cover.png')) {
            echo "✓ Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ayrton Senna\'s Super Monaco GP II-cover.png\n";
        $skipped++;
    }
}

// Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En) → Ayrton Senna's Super Monaco GP II
if (file_exists($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ayrton Senna\'s Super Monaco GP II-gameplay.png')) {
        if (rename($imageDir . '/Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En)-gameplay.png', $imageDir . '/Ayrton Senna\'s Super Monaco GP II-gameplay.png')) {
            echo "✓ Ayrton Sennas Super Monaco Gp Ii Usa Europe Brazil (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ayrton Senna\'s Super Monaco GP II-gameplay.png\n";
        $skipped++;
    }
}

// Baku Baku (USA) → Baku Baku
if (file_exists($imageDir . '/Baku Baku (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Baku Baku-artwork.png')) {
        if (rename($imageDir . '/Baku Baku (USA)-artwork.png', $imageDir . '/Baku Baku-artwork.png')) {
            echo "✓ Baku Baku (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku-artwork.png\n";
        $skipped++;
    }
}

// Baku Baku (USA) → Baku Baku
if (file_exists($imageDir . '/Baku Baku (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Baku Baku-cover.png')) {
        if (rename($imageDir . '/Baku Baku (USA)-cover.png', $imageDir . '/Baku Baku-cover.png')) {
            echo "✓ Baku Baku (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku-cover.png\n";
        $skipped++;
    }
}

// Baku Baku (USA) → Baku Baku
if (file_exists($imageDir . '/Baku Baku (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Baku Baku-gameplay.png')) {
        if (rename($imageDir . '/Baku Baku (USA)-gameplay.png', $imageDir . '/Baku Baku-gameplay.png')) {
            echo "✓ Baku Baku (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku-gameplay.png\n";
        $skipped++;
    }
}

// Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan) → Baku Baku Animal - Sekai Shiikugakari Senshu-ken
if (file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-artwork.png')) {
        if (rename($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-artwork.png', $imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-artwork.png')) {
            echo "✓ Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku Animal - Sekai Shiikugakari Senshu-ken-artwork.png\n";
        $skipped++;
    }
}

// Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan) → Baku Baku Animal - Sekai Shiikugakari Senshu-ken
if (file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-cover.png')) {
        if (rename($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-cover.png', $imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-cover.png')) {
            echo "✓ Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku Animal - Sekai Shiikugakari Senshu-ken-cover.png\n";
        $skipped++;
    }
}

// Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan) → Baku Baku Animal - Sekai Shiikugakari Senshu-ken
if (file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-gameplay.png')) {
        if (rename($imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-gameplay.png', $imageDir . '/Baku Baku Animal - Sekai Shiikugakari Senshu-ken-gameplay.png')) {
            echo "✓ Baku Baku Animal - Sekai Shiikugakari Senshu-ken (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Baku Baku Animal - Sekai Shiikugakari Senshu-ken-gameplay.png\n";
        $skipped++;
    }
}

// Batman Returns (World) → Batman Returns
if (file_exists($imageDir . '/Batman Returns (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Batman Returns-artwork.png')) {
        if (rename($imageDir . '/Batman Returns (World)-artwork.png', $imageDir . '/Batman Returns-artwork.png')) {
            echo "✓ Batman Returns (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batman Returns-artwork.png\n";
        $skipped++;
    }
}

// Batman Returns (World) → Batman Returns
if (file_exists($imageDir . '/Batman Returns (World)-cover.png')) {
    if (!file_exists($imageDir . '/Batman Returns-cover.png')) {
        if (rename($imageDir . '/Batman Returns (World)-cover.png', $imageDir . '/Batman Returns-cover.png')) {
            echo "✓ Batman Returns (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batman Returns-cover.png\n";
        $skipped++;
    }
}

// Batman Returns (World) → Batman Returns
if (file_exists($imageDir . '/Batman Returns (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Batman Returns-gameplay.png')) {
        if (rename($imageDir . '/Batman Returns (World)-gameplay.png', $imageDir . '/Batman Returns-gameplay.png')) {
            echo "✓ Batman Returns (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batman Returns-gameplay.png\n";
        $skipped++;
    }
}

// Batter Up (USA) → Batter Up
if (file_exists($imageDir . '/Batter Up (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Batter Up-artwork.png')) {
        if (rename($imageDir . '/Batter Up (USA)-artwork.png', $imageDir . '/Batter Up-artwork.png')) {
            echo "✓ Batter Up (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batter Up-artwork.png\n";
        $skipped++;
    }
}

// Batter Up (USA) → Batter Up
if (file_exists($imageDir . '/Batter Up (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Batter Up-cover.png')) {
        if (rename($imageDir . '/Batter Up (USA)-cover.png', $imageDir . '/Batter Up-cover.png')) {
            echo "✓ Batter Up (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batter Up-cover.png\n";
        $skipped++;
    }
}

// Batter Up (USA) → Batter Up
if (file_exists($imageDir . '/Batter Up (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Batter Up-gameplay.png')) {
        if (rename($imageDir . '/Batter Up (USA)-gameplay.png', $imageDir . '/Batter Up-gameplay.png')) {
            echo "✓ Batter Up (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Batter Up-gameplay.png\n";
        $skipped++;
    }
}

// Battleship - The Classic Naval Combat Game (USA) → Battleship - The Classic Naval Combat Game
if (file_exists($imageDir . '/Battleship - The Classic Naval Combat Game (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Battleship - The Classic Naval Combat Game-artwork.png')) {
        if (rename($imageDir . '/Battleship - The Classic Naval Combat Game (USA)-artwork.png', $imageDir . '/Battleship - The Classic Naval Combat Game-artwork.png')) {
            echo "✓ Battleship - The Classic Naval Combat Game (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battleship - The Classic Naval Combat Game-artwork.png\n";
        $skipped++;
    }
}

// Battleship - The Classic Naval Combat Game (USA) → Battleship - The Classic Naval Combat Game
if (file_exists($imageDir . '/Battleship - The Classic Naval Combat Game (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Battleship - The Classic Naval Combat Game-cover.png')) {
        if (rename($imageDir . '/Battleship - The Classic Naval Combat Game (USA)-cover.png', $imageDir . '/Battleship - The Classic Naval Combat Game-cover.png')) {
            echo "✓ Battleship - The Classic Naval Combat Game (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battleship - The Classic Naval Combat Game-cover.png\n";
        $skipped++;
    }
}

// Battleship - The Classic Naval Combat Game (USA) → Battleship - The Classic Naval Combat Game
if (file_exists($imageDir . '/Battleship - The Classic Naval Combat Game (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Battleship - The Classic Naval Combat Game-gameplay.png')) {
        if (rename($imageDir . '/Battleship - The Classic Naval Combat Game (USA)-gameplay.png', $imageDir . '/Battleship - The Classic Naval Combat Game-gameplay.png')) {
            echo "✓ Battleship - The Classic Naval Combat Game (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battleship - The Classic Naval Combat Game-gameplay.png\n";
        $skipped++;
    }
}

// Battletoads (USA) → Battletoads
if (file_exists($imageDir . '/Battletoads (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Battletoads-artwork.png')) {
        if (rename($imageDir . '/Battletoads (USA)-artwork.png', $imageDir . '/Battletoads-artwork.png')) {
            echo "✓ Battletoads (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battletoads-artwork.png\n";
        $skipped++;
    }
}

// Battletoads (USA) → Battletoads
if (file_exists($imageDir . '/Battletoads (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Battletoads-cover.png')) {
        if (rename($imageDir . '/Battletoads (USA)-cover.png', $imageDir . '/Battletoads-cover.png')) {
            echo "✓ Battletoads (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battletoads-cover.png\n";
        $skipped++;
    }
}

// Battletoads (USA) → Battletoads
if (file_exists($imageDir . '/Battletoads (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Battletoads-gameplay.png')) {
        if (rename($imageDir . '/Battletoads (USA)-gameplay.png', $imageDir . '/Battletoads-gameplay.png')) {
            echo "✓ Battletoads (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Battletoads-gameplay.png\n";
        $skipped++;
    }
}

// Beavis and Butt-Head (USA, Europe) → Beavis and Butt-Head
if (file_exists($imageDir . '/Beavis and Butt-Head (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Beavis and Butt-Head-artwork.png')) {
        if (rename($imageDir . '/Beavis and Butt-Head (USA, Europe)-artwork.png', $imageDir . '/Beavis and Butt-Head-artwork.png')) {
            echo "✓ Beavis and Butt-Head (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Beavis and Butt-Head-artwork.png\n";
        $skipped++;
    }
}

// Beavis and Butt-Head (USA, Europe) → Beavis and Butt-Head
if (file_exists($imageDir . '/Beavis and Butt-Head (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Beavis and Butt-Head-cover.png')) {
        if (rename($imageDir . '/Beavis and Butt-Head (USA, Europe)-cover.png', $imageDir . '/Beavis and Butt-Head-cover.png')) {
            echo "✓ Beavis and Butt-Head (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Beavis and Butt-Head-cover.png\n";
        $skipped++;
    }
}

// Beavis and Butt-Head (USA, Europe) → Beavis and Butt-Head
if (file_exists($imageDir . '/Beavis and Butt-Head (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Beavis and Butt-Head-gameplay.png')) {
        if (rename($imageDir . '/Beavis and Butt-Head (USA, Europe)-gameplay.png', $imageDir . '/Beavis and Butt-Head-gameplay.png')) {
            echo "✓ Beavis and Butt-Head (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Beavis and Butt-Head-gameplay.png\n";
        $skipped++;
    }
}

// Berlin no Kabe (Japan) → Berlin no Kabe
if (file_exists($imageDir . '/Berlin no Kabe (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Berlin no Kabe-artwork.png')) {
        if (rename($imageDir . '/Berlin no Kabe (Japan)-artwork.png', $imageDir . '/Berlin no Kabe-artwork.png')) {
            echo "✓ Berlin no Kabe (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Berlin no Kabe-artwork.png\n";
        $skipped++;
    }
}

// Berlin no Kabe (Japan) → Berlin no Kabe
if (file_exists($imageDir . '/Berlin no Kabe (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Berlin no Kabe-cover.png')) {
        if (rename($imageDir . '/Berlin no Kabe (Japan)-cover.png', $imageDir . '/Berlin no Kabe-cover.png')) {
            echo "✓ Berlin no Kabe (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Berlin no Kabe-cover.png\n";
        $skipped++;
    }
}

// Berlin no Kabe (Japan) → Berlin no Kabe
if (file_exists($imageDir . '/Berlin no Kabe (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Berlin no Kabe-gameplay.png')) {
        if (rename($imageDir . '/Berlin no Kabe (Japan)-gameplay.png', $imageDir . '/Berlin no Kabe-gameplay.png')) {
            echo "✓ Berlin no Kabe (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Berlin no Kabe-gameplay.png\n";
        $skipped++;
    }
}

// Bishoujo Senshi Sailor Moon S (Japan) → Bishoujo Senshi Sailor Moon S (Japan)[b2]
if (file_exists($imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)[b2]-artwork.png')) {
        if (rename($imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)-artwork.png', $imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)[b2]-artwork.png')) {
            echo "✓ Bishoujo Senshi Sailor Moon S (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bishoujo Senshi Sailor Moon S (Japan)[b2]-artwork.png\n";
        $skipped++;
    }
}

// Bishoujo Senshi Sailor Moon S (Japan) → Bishoujo Senshi Sailor Moon S (Japan)[b2]
if (file_exists($imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)[b2]-cover.png')) {
        if (rename($imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)-cover.png', $imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)[b2]-cover.png')) {
            echo "✓ Bishoujo Senshi Sailor Moon S (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bishoujo Senshi Sailor Moon S (Japan)[b2]-cover.png\n";
        $skipped++;
    }
}

// Bishoujo Senshi Sailor Moon S (Japan) → Bishoujo Senshi Sailor Moon S (Japan)[b2]
if (file_exists($imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)[b2]-gameplay.png')) {
        if (rename($imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)-gameplay.png', $imageDir . '/Bishoujo Senshi Sailor Moon S (Japan)[b2]-gameplay.png')) {
            echo "✓ Bishoujo Senshi Sailor Moon S (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bishoujo Senshi Sailor Moon S (Japan)[b2]-gameplay.png\n";
        $skipped++;
    }
}

// Bram Stokers Dracula (USA) → Bram Stoker's Dracula
if (file_exists($imageDir . '/Bram Stokers Dracula (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula-artwork.png')) {
        if (rename($imageDir . '/Bram Stokers Dracula (USA)-artwork.png', $imageDir . '/Bram Stoker\'s Dracula-artwork.png')) {
            echo "✓ Bram Stokers Dracula (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bram Stoker\'s Dracula-artwork.png\n";
        $skipped++;
    }
}

// Bram Stokers Dracula (USA) → Bram Stoker's Dracula
if (file_exists($imageDir . '/Bram Stokers Dracula (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula-cover.png')) {
        if (rename($imageDir . '/Bram Stokers Dracula (USA)-cover.png', $imageDir . '/Bram Stoker\'s Dracula-cover.png')) {
            echo "✓ Bram Stokers Dracula (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bram Stoker\'s Dracula-cover.png\n";
        $skipped++;
    }
}

// Bram Stokers Dracula (USA) → Bram Stoker's Dracula
if (file_exists($imageDir . '/Bram Stokers Dracula (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Bram Stoker\'s Dracula-gameplay.png')) {
        if (rename($imageDir . '/Bram Stokers Dracula (USA)-gameplay.png', $imageDir . '/Bram Stoker\'s Dracula-gameplay.png')) {
            echo "✓ Bram Stokers Dracula (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bram Stoker\'s Dracula-gameplay.png\n";
        $skipped++;
    }
}

// Bubble Bobble (USA) → Bubble Bobble
if (file_exists($imageDir . '/Bubble Bobble (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Bubble Bobble-artwork.png')) {
        if (rename($imageDir . '/Bubble Bobble (USA)-artwork.png', $imageDir . '/Bubble Bobble-artwork.png')) {
            echo "✓ Bubble Bobble (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bubble Bobble-artwork.png\n";
        $skipped++;
    }
}

// Bubble Bobble (USA) → Bubble Bobble
if (file_exists($imageDir . '/Bubble Bobble (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Bubble Bobble-cover.png')) {
        if (rename($imageDir . '/Bubble Bobble (USA)-cover.png', $imageDir . '/Bubble Bobble-cover.png')) {
            echo "✓ Bubble Bobble (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bubble Bobble-cover.png\n";
        $skipped++;
    }
}

// Bubble Bobble (USA) → Bubble Bobble
if (file_exists($imageDir . '/Bubble Bobble (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Bubble Bobble-gameplay.png')) {
        if (rename($imageDir . '/Bubble Bobble (USA)-gameplay.png', $imageDir . '/Bubble Bobble-gameplay.png')) {
            echo "✓ Bubble Bobble (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bubble Bobble-gameplay.png\n";
        $skipped++;
    }
}

// Bugs Bunny in Double Trouble (USA, Europe) → Bugs Bunny in Double Trouble
if (file_exists($imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Bugs Bunny in Double Trouble-artwork.png')) {
        if (rename($imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-artwork.png', $imageDir . '/Bugs Bunny in Double Trouble-artwork.png')) {
            echo "✓ Bugs Bunny in Double Trouble (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bugs Bunny in Double Trouble-artwork.png\n";
        $skipped++;
    }
}

// Bugs Bunny in Double Trouble (USA, Europe) → Bugs Bunny in Double Trouble
if (file_exists($imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Bugs Bunny in Double Trouble-cover.png')) {
        if (rename($imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-cover.png', $imageDir . '/Bugs Bunny in Double Trouble-cover.png')) {
            echo "✓ Bugs Bunny in Double Trouble (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bugs Bunny in Double Trouble-cover.png\n";
        $skipped++;
    }
}

// Bugs Bunny in Double Trouble (USA, Europe) → Bugs Bunny in Double Trouble
if (file_exists($imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Bugs Bunny in Double Trouble-gameplay.png')) {
        if (rename($imageDir . '/Bugs Bunny in Double Trouble (USA, Europe)-gameplay.png', $imageDir . '/Bugs Bunny in Double Trouble-gameplay.png')) {
            echo "✓ Bugs Bunny in Double Trouble (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bugs Bunny in Double Trouble-gameplay.png\n";
        $skipped++;
    }
}

// Bust-A-Move (USA) → Bust-A-Move
if (file_exists($imageDir . '/Bust-A-Move (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Bust-A-Move-artwork.png')) {
        if (rename($imageDir . '/Bust-A-Move (USA)-artwork.png', $imageDir . '/Bust-A-Move-artwork.png')) {
            echo "✓ Bust-A-Move (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bust-A-Move-artwork.png\n";
        $skipped++;
    }
}

// Bust-A-Move (USA) → Bust-A-Move
if (file_exists($imageDir . '/Bust-A-Move (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Bust-A-Move-cover.png')) {
        if (rename($imageDir . '/Bust-A-Move (USA)-cover.png', $imageDir . '/Bust-A-Move-cover.png')) {
            echo "✓ Bust-A-Move (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bust-A-Move-cover.png\n";
        $skipped++;
    }
}

// Bust-A-Move (USA) → Bust-A-Move
if (file_exists($imageDir . '/Bust-A-Move (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Bust-A-Move-gameplay.png')) {
        if (rename($imageDir . '/Bust-A-Move (USA)-gameplay.png', $imageDir . '/Bust-A-Move-gameplay.png')) {
            echo "✓ Bust-A-Move (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Bust-A-Move-gameplay.png\n";
        $skipped++;
    }
}

// Buster Ball (Japan) → Buster Ball
if (file_exists($imageDir . '/Buster Ball (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Buster Ball-artwork.png')) {
        if (rename($imageDir . '/Buster Ball (Japan)-artwork.png', $imageDir . '/Buster Ball-artwork.png')) {
            echo "✓ Buster Ball (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Ball-artwork.png\n";
        $skipped++;
    }
}

// Buster Ball (Japan) → Buster Ball
if (file_exists($imageDir . '/Buster Ball (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Buster Ball-cover.png')) {
        if (rename($imageDir . '/Buster Ball (Japan)-cover.png', $imageDir . '/Buster Ball-cover.png')) {
            echo "✓ Buster Ball (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Ball-cover.png\n";
        $skipped++;
    }
}

// Buster Ball (Japan) → Buster Ball
if (file_exists($imageDir . '/Buster Ball (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Buster Ball-gameplay.png')) {
        if (rename($imageDir . '/Buster Ball (Japan)-gameplay.png', $imageDir . '/Buster Ball-gameplay.png')) {
            echo "✓ Buster Ball (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Ball-gameplay.png\n";
        $skipped++;
    }
}

// Buster Fight (Japan) → Buster Fight
if (file_exists($imageDir . '/Buster Fight (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Buster Fight-artwork.png')) {
        if (rename($imageDir . '/Buster Fight (Japan)-artwork.png', $imageDir . '/Buster Fight-artwork.png')) {
            echo "✓ Buster Fight (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Fight-artwork.png\n";
        $skipped++;
    }
}

// Buster Fight (Japan) → Buster Fight
if (file_exists($imageDir . '/Buster Fight (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Buster Fight-cover.png')) {
        if (rename($imageDir . '/Buster Fight (Japan)-cover.png', $imageDir . '/Buster Fight-cover.png')) {
            echo "✓ Buster Fight (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Fight-cover.png\n";
        $skipped++;
    }
}

// Buster Fight (Japan) → Buster Fight
if (file_exists($imageDir . '/Buster Fight (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Buster Fight-gameplay.png')) {
        if (rename($imageDir . '/Buster Fight (Japan)-gameplay.png', $imageDir . '/Buster Fight-gameplay.png')) {
            echo "✓ Buster Fight (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Buster Fight-gameplay.png\n";
        $skipped++;
    }
}

// CJ Elephant Fugitive (USA, Europe) → CJ Elephant Fugitive
if (file_exists($imageDir . '/CJ Elephant Fugitive (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/CJ Elephant Fugitive-artwork.png')) {
        if (rename($imageDir . '/CJ Elephant Fugitive (USA, Europe)-artwork.png', $imageDir . '/CJ Elephant Fugitive-artwork.png')) {
            echo "✓ CJ Elephant Fugitive (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CJ Elephant Fugitive-artwork.png\n";
        $skipped++;
    }
}

// CJ Elephant Fugitive (USA, Europe) → CJ Elephant Fugitive
if (file_exists($imageDir . '/CJ Elephant Fugitive (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/CJ Elephant Fugitive-cover.png')) {
        if (rename($imageDir . '/CJ Elephant Fugitive (USA, Europe)-cover.png', $imageDir . '/CJ Elephant Fugitive-cover.png')) {
            echo "✓ CJ Elephant Fugitive (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CJ Elephant Fugitive-cover.png\n";
        $skipped++;
    }
}

// CJ Elephant Fugitive (USA, Europe) → CJ Elephant Fugitive
if (file_exists($imageDir . '/CJ Elephant Fugitive (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/CJ Elephant Fugitive-gameplay.png')) {
        if (rename($imageDir . '/CJ Elephant Fugitive (USA, Europe)-gameplay.png', $imageDir . '/CJ Elephant Fugitive-gameplay.png')) {
            echo "✓ CJ Elephant Fugitive (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CJ Elephant Fugitive-gameplay.png\n";
        $skipped++;
    }
}

// Caesars Palace (USA) → Caesars Palace
if (file_exists($imageDir . '/Caesars Palace (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Caesars Palace-artwork.png')) {
        if (rename($imageDir . '/Caesars Palace (USA)-artwork.png', $imageDir . '/Caesars Palace-artwork.png')) {
            echo "✓ Caesars Palace (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Caesars Palace-artwork.png\n";
        $skipped++;
    }
}

// Caesars Palace (USA) → Caesars Palace
if (file_exists($imageDir . '/Caesars Palace (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Caesars Palace-cover.png')) {
        if (rename($imageDir . '/Caesars Palace (USA)-cover.png', $imageDir . '/Caesars Palace-cover.png')) {
            echo "✓ Caesars Palace (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Caesars Palace-cover.png\n";
        $skipped++;
    }
}

// Caesars Palace (USA) → Caesars Palace
if (file_exists($imageDir . '/Caesars Palace (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Caesars Palace-gameplay.png')) {
        if (rename($imageDir . '/Caesars Palace (USA)-gameplay.png', $imageDir . '/Caesars Palace-gameplay.png')) {
            echo "✓ Caesars Palace (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Caesars Palace-gameplay.png\n";
        $skipped++;
    }
}

// Captain America and the Avengers (USA) → Captain America and the Avengers
if (file_exists($imageDir . '/Captain America and the Avengers (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Captain America and the Avengers-artwork.png')) {
        if (rename($imageDir . '/Captain America and the Avengers (USA)-artwork.png', $imageDir . '/Captain America and the Avengers-artwork.png')) {
            echo "✓ Captain America and the Avengers (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Captain America and the Avengers-artwork.png\n";
        $skipped++;
    }
}

// Captain America and the Avengers (USA) → Captain America and the Avengers
if (file_exists($imageDir . '/Captain America and the Avengers (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Captain America and the Avengers-cover.png')) {
        if (rename($imageDir . '/Captain America and the Avengers (USA)-cover.png', $imageDir . '/Captain America and the Avengers-cover.png')) {
            echo "✓ Captain America and the Avengers (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Captain America and the Avengers-cover.png\n";
        $skipped++;
    }
}

// Captain America and the Avengers (USA) → Captain America and the Avengers
if (file_exists($imageDir . '/Captain America and the Avengers (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Captain America and the Avengers-gameplay.png')) {
        if (rename($imageDir . '/Captain America and the Avengers (USA)-gameplay.png', $imageDir . '/Captain America and the Avengers-gameplay.png')) {
            echo "✓ Captain America and the Avengers (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Captain America and the Avengers-gameplay.png\n";
        $skipped++;
    }
}

// Car Licence (Japan) → Car Licence
if (file_exists($imageDir . '/Car Licence (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Car Licence-artwork.png')) {
        if (rename($imageDir . '/Car Licence (Japan)-artwork.png', $imageDir . '/Car Licence-artwork.png')) {
            echo "✓ Car Licence (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Car Licence-artwork.png\n";
        $skipped++;
    }
}

// Car Licence (Japan) → Car Licence
if (file_exists($imageDir . '/Car Licence (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Car Licence-cover.png')) {
        if (rename($imageDir . '/Car Licence (Japan)-cover.png', $imageDir . '/Car Licence-cover.png')) {
            echo "✓ Car Licence (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Car Licence-cover.png\n";
        $skipped++;
    }
}

// Car Licence (Japan) → Car Licence
if (file_exists($imageDir . '/Car Licence (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Car Licence-gameplay.png')) {
        if (rename($imageDir . '/Car Licence (Japan)-gameplay.png', $imageDir . '/Car Licence-gameplay.png')) {
            echo "✓ Car Licence (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Car Licence-gameplay.png\n";
        $skipped++;
    }
}

// Casino FunPak (USA) → Casino FunPak
if (file_exists($imageDir . '/Casino FunPak (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Casino FunPak-artwork.png')) {
        if (rename($imageDir . '/Casino FunPak (USA)-artwork.png', $imageDir . '/Casino FunPak-artwork.png')) {
            echo "✓ Casino FunPak (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Casino FunPak-artwork.png\n";
        $skipped++;
    }
}

// Casino FunPak (USA) → Casino FunPak
if (file_exists($imageDir . '/Casino FunPak (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Casino FunPak-cover.png')) {
        if (rename($imageDir . '/Casino FunPak (USA)-cover.png', $imageDir . '/Casino FunPak-cover.png')) {
            echo "✓ Casino FunPak (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Casino FunPak-cover.png\n";
        $skipped++;
    }
}

// Casino FunPak (USA) → Casino FunPak
if (file_exists($imageDir . '/Casino FunPak (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Casino FunPak-gameplay.png')) {
        if (rename($imageDir . '/Casino FunPak (USA)-gameplay.png', $imageDir . '/Casino FunPak-gameplay.png')) {
            echo "✓ Casino FunPak (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Casino FunPak-gameplay.png\n";
        $skipped++;
    }
}

// Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En) → Castle of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse-artwork.png')) {
        if (rename($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-artwork.png', $imageDir . '/Castle of Illusion Starring Mickey Mouse-artwork.png')) {
            echo "✓ Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Castle of Illusion Starring Mickey Mouse-artwork.png\n";
        $skipped++;
    }
}

// Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En) → Castle of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse-cover.png')) {
        if (rename($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-cover.png', $imageDir . '/Castle of Illusion Starring Mickey Mouse-cover.png')) {
            echo "✓ Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Castle of Illusion Starring Mickey Mouse-cover.png\n";
        $skipped++;
    }
}

// Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En) → Castle of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse-gameplay.png')) {
        if (rename($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-gameplay.png', $imageDir . '/Castle of Illusion Starring Mickey Mouse-gameplay.png')) {
            echo "✓ Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Castle of Illusion Starring Mickey Mouse-gameplay.png\n";
        $skipped++;
    }
}

// Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) → Castle of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse-cover.png')) {
        if (rename($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png', $imageDir . '/Castle of Illusion Starring Mickey Mouse-cover.png')) {
            echo "✓ Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Castle of Illusion Starring Mickey Mouse-cover.png\n";
        $skipped++;
    }
}

// Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil) → Castle of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Castle of Illusion Starring Mickey Mouse-gameplay.png')) {
        if (rename($imageDir . '/Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png', $imageDir . '/Castle of Illusion Starring Mickey Mouse-gameplay.png')) {
            echo "✓ Castle of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Castle of Illusion Starring Mickey Mouse-gameplay.png\n";
        $skipped++;
    }
}

// Championship Hockey (Europe) → Championship Hockey
if (file_exists($imageDir . '/Championship Hockey (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Championship Hockey-artwork.png')) {
        if (rename($imageDir . '/Championship Hockey (Europe)-artwork.png', $imageDir . '/Championship Hockey-artwork.png')) {
            echo "✓ Championship Hockey (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Championship Hockey-artwork.png\n";
        $skipped++;
    }
}

// Championship Hockey (Europe) → Championship Hockey
if (file_exists($imageDir . '/Championship Hockey (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Championship Hockey-cover.png')) {
        if (rename($imageDir . '/Championship Hockey (Europe)-cover.png', $imageDir . '/Championship Hockey-cover.png')) {
            echo "✓ Championship Hockey (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Championship Hockey-cover.png\n";
        $skipped++;
    }
}

// Championship Hockey (Europe) → Championship Hockey
if (file_exists($imageDir . '/Championship Hockey (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Championship Hockey-gameplay.png')) {
        if (rename($imageDir . '/Championship Hockey (Europe)-gameplay.png', $imageDir . '/Championship Hockey-gameplay.png')) {
            echo "✓ Championship Hockey (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Championship Hockey-gameplay.png\n";
        $skipped++;
    }
}

// Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es) → Cheese Cat-Astrophe Starring Speedy Gonzales
if (file_exists($imageDir . '/Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es)-artwork.png')) {
    if (!file_exists($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-artwork.png')) {
        if (rename($imageDir . '/Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es)-artwork.png', $imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-artwork.png')) {
            echo "✓ Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cheese Cat-Astrophe Starring Speedy Gonzales-artwork.png\n";
        $skipped++;
    }
}

// Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es) → Cheese Cat-Astrophe Starring Speedy Gonzales
if (file_exists($imageDir . '/Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es)-cover.png')) {
    if (!file_exists($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-cover.png')) {
        if (rename($imageDir . '/Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es)-cover.png', $imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-cover.png')) {
            echo "✓ Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cheese Cat-Astrophe Starring Speedy Gonzales-cover.png\n";
        $skipped++;
    }
}

// Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es) → Cheese Cat-Astrophe Starring Speedy Gonzales
if (file_exists($imageDir . '/Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es)-gameplay.png')) {
    if (!file_exists($imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-gameplay.png')) {
        if (rename($imageDir . '/Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es)-gameplay.png', $imageDir . '/Cheese Cat-Astrophe Starring Speedy Gonzales-gameplay.png')) {
            echo "✓ Cheese Cat Astrophe Starring Speedy Gonzales Usa Europe Brazil En Fr De (Es)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cheese Cat-Astrophe Starring Speedy Gonzales-gameplay.png\n";
        $skipped++;
    }
}

// Chicago Syndicate (USA, Brazil) → Chicago Syndicate
if (file_exists($imageDir . '/Chicago Syndicate (USA, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Chicago Syndicate-cover.png')) {
        if (rename($imageDir . '/Chicago Syndicate (USA, Brazil)-cover.png', $imageDir . '/Chicago Syndicate-cover.png')) {
            echo "✓ Chicago Syndicate (USA, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chicago Syndicate-cover.png\n";
        $skipped++;
    }
}

// Chicago Syndicate (USA, Brazil) → Chicago Syndicate
if (file_exists($imageDir . '/Chicago Syndicate (USA, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Chicago Syndicate-gameplay.png')) {
        if (rename($imageDir . '/Chicago Syndicate (USA, Brazil)-gameplay.png', $imageDir . '/Chicago Syndicate-gameplay.png')) {
            echo "✓ Chicago Syndicate (USA, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chicago Syndicate-gameplay.png\n";
        $skipped++;
    }
}

// Choplifter III (USA) → Choplifter III
if (file_exists($imageDir . '/Choplifter III (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Choplifter III-artwork.png')) {
        if (rename($imageDir . '/Choplifter III (USA)-artwork.png', $imageDir . '/Choplifter III-artwork.png')) {
            echo "✓ Choplifter III (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Choplifter III-artwork.png\n";
        $skipped++;
    }
}

// Choplifter III (USA) → Choplifter III
if (file_exists($imageDir . '/Choplifter III (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Choplifter III-cover.png')) {
        if (rename($imageDir . '/Choplifter III (USA)-cover.png', $imageDir . '/Choplifter III-cover.png')) {
            echo "✓ Choplifter III (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Choplifter III-cover.png\n";
        $skipped++;
    }
}

// Choplifter III (USA) → Choplifter III
if (file_exists($imageDir . '/Choplifter III (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Choplifter III-gameplay.png')) {
        if (rename($imageDir . '/Choplifter III (USA)-gameplay.png', $imageDir . '/Choplifter III-gameplay.png')) {
            echo "✓ Choplifter III (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Choplifter III-gameplay.png\n";
        $skipped++;
    }
}

// Chuck Rock (World) → Chuck Rock
if (file_exists($imageDir . '/Chuck Rock (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Chuck Rock-artwork.png')) {
        if (rename($imageDir . '/Chuck Rock (World)-artwork.png', $imageDir . '/Chuck Rock-artwork.png')) {
            echo "✓ Chuck Rock (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock-artwork.png\n";
        $skipped++;
    }
}

// Chuck Rock (World) → Chuck Rock
if (file_exists($imageDir . '/Chuck Rock (World)-cover.png')) {
    if (!file_exists($imageDir . '/Chuck Rock-cover.png')) {
        if (rename($imageDir . '/Chuck Rock (World)-cover.png', $imageDir . '/Chuck Rock-cover.png')) {
            echo "✓ Chuck Rock (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock-cover.png\n";
        $skipped++;
    }
}

// Chuck Rock (World) → Chuck Rock
if (file_exists($imageDir . '/Chuck Rock (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Chuck Rock-gameplay.png')) {
        if (rename($imageDir . '/Chuck Rock (World)-gameplay.png', $imageDir . '/Chuck Rock-gameplay.png')) {
            echo "✓ Chuck Rock (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock-gameplay.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck (Europe, Brazil) (En) → Chuck Rock II - Son of Chuck
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck (Europe, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck-artwork.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck (Europe, Brazil) (En)-artwork.png', $imageDir . '/Chuck Rock II - Son of Chuck-artwork.png')) {
            echo "✓ Chuck Rock II - Son of Chuck (Europe, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck-artwork.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck (Europe, Brazil) (En) → Chuck Rock II - Son of Chuck
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck (Europe, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck-cover.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck (Europe, Brazil) (En)-cover.png', $imageDir . '/Chuck Rock II - Son of Chuck-cover.png')) {
            echo "✓ Chuck Rock II - Son of Chuck (Europe, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck-cover.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck (Europe, Brazil) (En) → Chuck Rock II - Son of Chuck
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck (Europe, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck-gameplay.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck (Europe, Brazil) (En)-gameplay.png', $imageDir . '/Chuck Rock II - Son of Chuck-gameplay.png')) {
            echo "✓ Chuck Rock II - Son of Chuck (Europe, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck-gameplay.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck (Europe, Brazil) → Chuck Rock II - Son of Chuck
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck (Europe, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck-cover.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck (Europe, Brazil)-cover.png', $imageDir . '/Chuck Rock II - Son of Chuck-cover.png')) {
            echo "✓ Chuck Rock II - Son of Chuck (Europe, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck-cover.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck (Europe, Brazil) → Chuck Rock II - Son of Chuck
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck (Europe, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck-gameplay.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck (Europe, Brazil)-gameplay.png', $imageDir . '/Chuck Rock II - Son of Chuck-gameplay.png')) {
            echo "✓ Chuck Rock II - Son of Chuck (Europe, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck-gameplay.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck (USA) → Chuck Rock II - Son of Chuck
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck-artwork.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck (USA)-artwork.png', $imageDir . '/Chuck Rock II - Son of Chuck-artwork.png')) {
            echo "✓ Chuck Rock II - Son of Chuck (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck-artwork.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck (USA) → Chuck Rock II - Son of Chuck
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck-cover.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck (USA)-cover.png', $imageDir . '/Chuck Rock II - Son of Chuck-cover.png')) {
            echo "✓ Chuck Rock II - Son of Chuck (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck-cover.png\n";
        $skipped++;
    }
}

// Chuck Rock II - Son of Chuck (USA) → Chuck Rock II - Son of Chuck
if (file_exists($imageDir . '/Chuck Rock II - Son of Chuck (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Chuck Rock II - Son of Chuck-gameplay.png')) {
        if (rename($imageDir . '/Chuck Rock II - Son of Chuck (USA)-gameplay.png', $imageDir . '/Chuck Rock II - Son of Chuck-gameplay.png')) {
            echo "✓ Chuck Rock II - Son of Chuck (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Chuck Rock II - Son of Chuck-gameplay.png\n";
        $skipped++;
    }
}

// Cliffhanger (USA) → Cliffhanger
if (file_exists($imageDir . '/Cliffhanger (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Cliffhanger-artwork.png')) {
        if (rename($imageDir . '/Cliffhanger (USA)-artwork.png', $imageDir . '/Cliffhanger-artwork.png')) {
            echo "✓ Cliffhanger (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cliffhanger-artwork.png\n";
        $skipped++;
    }
}

// Cliffhanger (USA) → Cliffhanger
if (file_exists($imageDir . '/Cliffhanger (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Cliffhanger-cover.png')) {
        if (rename($imageDir . '/Cliffhanger (USA)-cover.png', $imageDir . '/Cliffhanger-cover.png')) {
            echo "✓ Cliffhanger (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cliffhanger-cover.png\n";
        $skipped++;
    }
}

// Cliffhanger (USA) → Cliffhanger
if (file_exists($imageDir . '/Cliffhanger (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Cliffhanger-gameplay.png')) {
        if (rename($imageDir . '/Cliffhanger (USA)-gameplay.png', $imageDir . '/Cliffhanger-gameplay.png')) {
            echo "✓ Cliffhanger (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cliffhanger-gameplay.png\n";
        $skipped++;
    }
}

// Clutch Hitter (USA) → Clutch Hitter
if (file_exists($imageDir . '/Clutch Hitter (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Clutch Hitter-artwork.png')) {
        if (rename($imageDir . '/Clutch Hitter (USA)-artwork.png', $imageDir . '/Clutch Hitter-artwork.png')) {
            echo "✓ Clutch Hitter (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Clutch Hitter-artwork.png\n";
        $skipped++;
    }
}

// Clutch Hitter (USA) → Clutch Hitter
if (file_exists($imageDir . '/Clutch Hitter (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Clutch Hitter-cover.png')) {
        if (rename($imageDir . '/Clutch Hitter (USA)-cover.png', $imageDir . '/Clutch Hitter-cover.png')) {
            echo "✓ Clutch Hitter (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Clutch Hitter-cover.png\n";
        $skipped++;
    }
}

// Clutch Hitter (USA) → Clutch Hitter
if (file_exists($imageDir . '/Clutch Hitter (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Clutch Hitter-gameplay.png')) {
        if (rename($imageDir . '/Clutch Hitter (USA)-gameplay.png', $imageDir . '/Clutch Hitter-gameplay.png')) {
            echo "✓ Clutch Hitter (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Clutch Hitter-gameplay.png\n";
        $skipped++;
    }
}

// Cool Spot (USA) → Cool Spot
if (file_exists($imageDir . '/Cool Spot (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Cool Spot-artwork.png')) {
        if (rename($imageDir . '/Cool Spot (USA)-artwork.png', $imageDir . '/Cool Spot-artwork.png')) {
            echo "✓ Cool Spot (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cool Spot-artwork.png\n";
        $skipped++;
    }
}

// Cool Spot (USA) → Cool Spot
if (file_exists($imageDir . '/Cool Spot (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Cool Spot-cover.png')) {
        if (rename($imageDir . '/Cool Spot (USA)-cover.png', $imageDir . '/Cool Spot-cover.png')) {
            echo "✓ Cool Spot (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cool Spot-cover.png\n";
        $skipped++;
    }
}

// Cool Spot (USA) → Cool Spot
if (file_exists($imageDir . '/Cool Spot (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Cool Spot-gameplay.png')) {
        if (rename($imageDir . '/Cool Spot (USA)-gameplay.png', $imageDir . '/Cool Spot-gameplay.png')) {
            echo "✓ Cool Spot (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Cool Spot-gameplay.png\n";
        $skipped++;
    }
}

// Crystal Warriors (EU-US)[tr fr] → Crystal Warriors (EU-US)[tr fr Asmodeath][v0.99]
if (file_exists($imageDir . '/Crystal Warriors (EU-US)[tr fr]-cover.png')) {
    if (!file_exists($imageDir . '/Crystal Warriors (EU-US)[tr fr Asmodeath][v0.99]-cover.png')) {
        if (rename($imageDir . '/Crystal Warriors (EU-US)[tr fr]-cover.png', $imageDir . '/Crystal Warriors (EU-US)[tr fr Asmodeath][v0.99]-cover.png')) {
            echo "✓ Crystal Warriors (EU-US)[tr fr]-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Crystal Warriors (EU-US)[tr fr Asmodeath][v0.99]-cover.png\n";
        $skipped++;
    }
}

// CutThroat Island (USA) → CutThroat Island
if (file_exists($imageDir . '/CutThroat Island (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/CutThroat Island-artwork.png')) {
        if (rename($imageDir . '/CutThroat Island (USA)-artwork.png', $imageDir . '/CutThroat Island-artwork.png')) {
            echo "✓ CutThroat Island (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CutThroat Island-artwork.png\n";
        $skipped++;
    }
}

// CutThroat Island (USA) → CutThroat Island
if (file_exists($imageDir . '/CutThroat Island (USA)-cover.png')) {
    if (!file_exists($imageDir . '/CutThroat Island-cover.png')) {
        if (rename($imageDir . '/CutThroat Island (USA)-cover.png', $imageDir . '/CutThroat Island-cover.png')) {
            echo "✓ CutThroat Island (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CutThroat Island-cover.png\n";
        $skipped++;
    }
}

// CutThroat Island (USA) → CutThroat Island
if (file_exists($imageDir . '/CutThroat Island (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/CutThroat Island-gameplay.png')) {
        if (rename($imageDir . '/CutThroat Island (USA)-gameplay.png', $imageDir . '/CutThroat Island-gameplay.png')) {
            echo "✓ CutThroat Island (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: CutThroat Island-gameplay.png\n";
        $skipped++;
    }
}

// Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En) → Deep Duck Trouble Starring Donald Duck
if (file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck-artwork.png')) {
        if (rename($imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-artwork.png', $imageDir . '/Deep Duck Trouble Starring Donald Duck-artwork.png')) {
            echo "✓ Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Deep Duck Trouble Starring Donald Duck-artwork.png\n";
        $skipped++;
    }
}

// Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En) → Deep Duck Trouble Starring Donald Duck
if (file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck-cover.png')) {
        if (rename($imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-cover.png', $imageDir . '/Deep Duck Trouble Starring Donald Duck-cover.png')) {
            echo "✓ Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Deep Duck Trouble Starring Donald Duck-cover.png\n";
        $skipped++;
    }
}

// Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En) → Deep Duck Trouble Starring Donald Duck
if (file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Deep Duck Trouble Starring Donald Duck-gameplay.png')) {
        if (rename($imageDir . '/Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-gameplay.png', $imageDir . '/Deep Duck Trouble Starring Donald Duck-gameplay.png')) {
            echo "✓ Deep Duck Trouble Starring Donald Duck (USA, Europe, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Deep Duck Trouble Starring Donald Duck-gameplay.png\n";
        $skipped++;
    }
}

// Defenders of Oasis (USA, Europe) → Defenders of Oasis
if (file_exists($imageDir . '/Defenders of Oasis (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Defenders of Oasis-artwork.png')) {
        if (rename($imageDir . '/Defenders of Oasis (USA, Europe)-artwork.png', $imageDir . '/Defenders of Oasis-artwork.png')) {
            echo "✓ Defenders of Oasis (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Defenders of Oasis-artwork.png\n";
        $skipped++;
    }
}

// Defenders of Oasis (USA, Europe) → Defenders of Oasis
if (file_exists($imageDir . '/Defenders of Oasis (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Defenders of Oasis-cover.png')) {
        if (rename($imageDir . '/Defenders of Oasis (USA, Europe)-cover.png', $imageDir . '/Defenders of Oasis-cover.png')) {
            echo "✓ Defenders of Oasis (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Defenders of Oasis-cover.png\n";
        $skipped++;
    }
}

// Defenders of Oasis (USA, Europe) → Defenders of Oasis
if (file_exists($imageDir . '/Defenders of Oasis (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Defenders of Oasis-gameplay.png')) {
        if (rename($imageDir . '/Defenders of Oasis (USA, Europe)-gameplay.png', $imageDir . '/Defenders of Oasis-gameplay.png')) {
            echo "✓ Defenders of Oasis (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Defenders of Oasis-gameplay.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It) → Desert Speedtrap Starring Road Runner and Wile E. Coyote
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It)-artwork.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-artwork.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It)-artwork.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-artwork.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Speedtrap Starring Road Runner and Wile E. Coyote-artwork.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It) → Desert Speedtrap Starring Road Runner and Wile E. Coyote
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It)-cover.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It)-cover.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It) → Desert Speedtrap Starring Road Runner and Wile E. Coyote
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It)-gameplay.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It)-gameplay.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E Coyote Europe En Fr De Es (It)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En) → Desert Speedtrap Starring Road Runner and Wile E. Coyote
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-cover.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-cover.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Speedtrap Starring Road Runner and Wile E. Coyote-cover.png\n";
        $skipped++;
    }
}

// Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En) → Desert Speedtrap Starring Road Runner and Wile E. Coyote
if (file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png')) {
        if (rename($imageDir . '/Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-gameplay.png', $imageDir . '/Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png')) {
            echo "✓ Desert Speedtrap Starring Road Runner and Wile E Coyote Usa Brazil (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Speedtrap Starring Road Runner and Wile E. Coyote-gameplay.png\n";
        $skipped++;
    }
}

// Desert Strike - Return to the Gulf (USA) → Desert Strike - Return to the Gulf
if (file_exists($imageDir . '/Desert Strike - Return to the Gulf (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Desert Strike - Return to the Gulf-artwork.png')) {
        if (rename($imageDir . '/Desert Strike - Return to the Gulf (USA)-artwork.png', $imageDir . '/Desert Strike - Return to the Gulf-artwork.png')) {
            echo "✓ Desert Strike - Return to the Gulf (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Strike - Return to the Gulf-artwork.png\n";
        $skipped++;
    }
}

// Desert Strike - Return to the Gulf (USA) → Desert Strike - Return to the Gulf
if (file_exists($imageDir . '/Desert Strike - Return to the Gulf (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Desert Strike - Return to the Gulf-cover.png')) {
        if (rename($imageDir . '/Desert Strike - Return to the Gulf (USA)-cover.png', $imageDir . '/Desert Strike - Return to the Gulf-cover.png')) {
            echo "✓ Desert Strike - Return to the Gulf (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Strike - Return to the Gulf-cover.png\n";
        $skipped++;
    }
}

// Desert Strike - Return to the Gulf (USA) → Desert Strike - Return to the Gulf
if (file_exists($imageDir . '/Desert Strike - Return to the Gulf (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Desert Strike - Return to the Gulf-gameplay.png')) {
        if (rename($imageDir . '/Desert Strike - Return to the Gulf (USA)-gameplay.png', $imageDir . '/Desert Strike - Return to the Gulf-gameplay.png')) {
            echo "✓ Desert Strike - Return to the Gulf (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Desert Strike - Return to the Gulf-gameplay.png\n";
        $skipped++;
    }
}

// Devilish (USA) → Devilish
if (file_exists($imageDir . '/Devilish (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Devilish-artwork.png')) {
        if (rename($imageDir . '/Devilish (USA)-artwork.png', $imageDir . '/Devilish-artwork.png')) {
            echo "✓ Devilish (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Devilish-artwork.png\n";
        $skipped++;
    }
}

// Devilish (USA) → Devilish
if (file_exists($imageDir . '/Devilish (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Devilish-cover.png')) {
        if (rename($imageDir . '/Devilish (USA)-cover.png', $imageDir . '/Devilish-cover.png')) {
            echo "✓ Devilish (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Devilish-cover.png\n";
        $skipped++;
    }
}

// Devilish (USA) → Devilish
if (file_exists($imageDir . '/Devilish (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Devilish-gameplay.png')) {
        if (rename($imageDir . '/Devilish (USA)-gameplay.png', $imageDir . '/Devilish-gameplay.png')) {
            echo "✓ Devilish (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Devilish-gameplay.png\n";
        $skipped++;
    }
}

// Donald Duck no 4-Tsu no Hihou (Japan) → Donald Duck no 4-Tsu no Hihou
if (file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou-artwork.png')) {
        if (rename($imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-artwork.png', $imageDir . '/Donald Duck no 4-Tsu no Hihou-artwork.png')) {
            echo "✓ Donald Duck no 4-Tsu no Hihou (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no 4-Tsu no Hihou-artwork.png\n";
        $skipped++;
    }
}

// Donald Duck no 4-Tsu no Hihou (Japan) → Donald Duck no 4-Tsu no Hihou
if (file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou-cover.png')) {
        if (rename($imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-cover.png', $imageDir . '/Donald Duck no 4-Tsu no Hihou-cover.png')) {
            echo "✓ Donald Duck no 4-Tsu no Hihou (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no 4-Tsu no Hihou-cover.png\n";
        $skipped++;
    }
}

// Donald Duck no 4-Tsu no Hihou (Japan) → Donald Duck no 4-Tsu no Hihou
if (file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Donald Duck no 4-Tsu no Hihou-gameplay.png')) {
        if (rename($imageDir . '/Donald Duck no 4-Tsu no Hihou (Japan)-gameplay.png', $imageDir . '/Donald Duck no 4-Tsu no Hihou-gameplay.png')) {
            echo "✓ Donald Duck no 4-Tsu no Hihou (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no 4-Tsu no Hihou-gameplay.png\n";
        $skipped++;
    }
}

// Donald Duck no Lucky Dime (Japan) → Donald Duck no Lucky Dime
if (file_exists($imageDir . '/Donald Duck no Lucky Dime (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Donald Duck no Lucky Dime-artwork.png')) {
        if (rename($imageDir . '/Donald Duck no Lucky Dime (Japan)-artwork.png', $imageDir . '/Donald Duck no Lucky Dime-artwork.png')) {
            echo "✓ Donald Duck no Lucky Dime (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no Lucky Dime-artwork.png\n";
        $skipped++;
    }
}

// Donald Duck no Lucky Dime (Japan) → Donald Duck no Lucky Dime
if (file_exists($imageDir . '/Donald Duck no Lucky Dime (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Donald Duck no Lucky Dime-cover.png')) {
        if (rename($imageDir . '/Donald Duck no Lucky Dime (Japan)-cover.png', $imageDir . '/Donald Duck no Lucky Dime-cover.png')) {
            echo "✓ Donald Duck no Lucky Dime (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no Lucky Dime-cover.png\n";
        $skipped++;
    }
}

// Donald Duck no Lucky Dime (Japan) → Donald Duck no Lucky Dime
if (file_exists($imageDir . '/Donald Duck no Lucky Dime (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Donald Duck no Lucky Dime-gameplay.png')) {
        if (rename($imageDir . '/Donald Duck no Lucky Dime (Japan)-gameplay.png', $imageDir . '/Donald Duck no Lucky Dime-gameplay.png')) {
            echo "✓ Donald Duck no Lucky Dime (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald Duck no Lucky Dime-gameplay.png\n";
        $skipped++;
    }
}

// Donald No Magical World Japan En (Ja) → Donald no Magical World
if (file_exists($imageDir . '/Donald No Magical World Japan En (Ja)-artwork.png')) {
    if (!file_exists($imageDir . '/Donald no Magical World-artwork.png')) {
        if (rename($imageDir . '/Donald No Magical World Japan En (Ja)-artwork.png', $imageDir . '/Donald no Magical World-artwork.png')) {
            echo "✓ Donald No Magical World Japan En (Ja)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald no Magical World-artwork.png\n";
        $skipped++;
    }
}

// Donald No Magical World Japan En (Ja) → Donald no Magical World
if (file_exists($imageDir . '/Donald No Magical World Japan En (Ja)-cover.png')) {
    if (!file_exists($imageDir . '/Donald no Magical World-cover.png')) {
        if (rename($imageDir . '/Donald No Magical World Japan En (Ja)-cover.png', $imageDir . '/Donald no Magical World-cover.png')) {
            echo "✓ Donald No Magical World Japan En (Ja)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald no Magical World-cover.png\n";
        $skipped++;
    }
}

// Donald No Magical World Japan En (Ja) → Donald no Magical World
if (file_exists($imageDir . '/Donald No Magical World Japan En (Ja)-gameplay.png')) {
    if (!file_exists($imageDir . '/Donald no Magical World-gameplay.png')) {
        if (rename($imageDir . '/Donald No Magical World Japan En (Ja)-gameplay.png', $imageDir . '/Donald no Magical World-gameplay.png')) {
            echo "✓ Donald No Magical World Japan En (Ja)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Donald no Magical World-gameplay.png\n";
        $skipped++;
    }
}

// Doraemon - Noranosuke no Yabou (Japan) → Doraemon - Noranosuke no Yabou
if (file_exists($imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Doraemon - Noranosuke no Yabou-artwork.png')) {
        if (rename($imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-artwork.png', $imageDir . '/Doraemon - Noranosuke no Yabou-artwork.png')) {
            echo "✓ Doraemon - Noranosuke no Yabou (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Noranosuke no Yabou-artwork.png\n";
        $skipped++;
    }
}

// Doraemon - Noranosuke no Yabou (Japan) → Doraemon - Noranosuke no Yabou
if (file_exists($imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Doraemon - Noranosuke no Yabou-cover.png')) {
        if (rename($imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-cover.png', $imageDir . '/Doraemon - Noranosuke no Yabou-cover.png')) {
            echo "✓ Doraemon - Noranosuke no Yabou (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Noranosuke no Yabou-cover.png\n";
        $skipped++;
    }
}

// Doraemon - Noranosuke no Yabou (Japan) → Doraemon - Noranosuke no Yabou
if (file_exists($imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Doraemon - Noranosuke no Yabou-gameplay.png')) {
        if (rename($imageDir . '/Doraemon - Noranosuke no Yabou (Japan)-gameplay.png', $imageDir . '/Doraemon - Noranosuke no Yabou-gameplay.png')) {
            echo "✓ Doraemon - Noranosuke no Yabou (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Noranosuke no Yabou-gameplay.png\n";
        $skipped++;
    }
}

// Doraemon - Waku Waku Pocket Paradise (Japan) → Doraemon - Waku Waku Pocket Paradise
if (file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise-artwork.png')) {
        if (rename($imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-artwork.png', $imageDir . '/Doraemon - Waku Waku Pocket Paradise-artwork.png')) {
            echo "✓ Doraemon - Waku Waku Pocket Paradise (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Waku Waku Pocket Paradise-artwork.png\n";
        $skipped++;
    }
}

// Doraemon - Waku Waku Pocket Paradise (Japan) → Doraemon - Waku Waku Pocket Paradise
if (file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise-cover.png')) {
        if (rename($imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-cover.png', $imageDir . '/Doraemon - Waku Waku Pocket Paradise-cover.png')) {
            echo "✓ Doraemon - Waku Waku Pocket Paradise (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Waku Waku Pocket Paradise-cover.png\n";
        $skipped++;
    }
}

// Doraemon - Waku Waku Pocket Paradise (Japan) → Doraemon - Waku Waku Pocket Paradise
if (file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Doraemon - Waku Waku Pocket Paradise-gameplay.png')) {
        if (rename($imageDir . '/Doraemon - Waku Waku Pocket Paradise (Japan)-gameplay.png', $imageDir . '/Doraemon - Waku Waku Pocket Paradise-gameplay.png')) {
            echo "✓ Doraemon - Waku Waku Pocket Paradise (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Doraemon - Waku Waku Pocket Paradise-gameplay.png\n";
        $skipped++;
    }
}

// Dragon - The Bruce Lee Story (Europe) → Dragon - The Bruce Lee Story
if (file_exists($imageDir . '/Dragon - The Bruce Lee Story (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Dragon - The Bruce Lee Story-artwork.png')) {
        if (rename($imageDir . '/Dragon - The Bruce Lee Story (Europe)-artwork.png', $imageDir . '/Dragon - The Bruce Lee Story-artwork.png')) {
            echo "✓ Dragon - The Bruce Lee Story (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon - The Bruce Lee Story-artwork.png\n";
        $skipped++;
    }
}

// Dragon - The Bruce Lee Story (Europe) → Dragon - The Bruce Lee Story
if (file_exists($imageDir . '/Dragon - The Bruce Lee Story (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Dragon - The Bruce Lee Story-cover.png')) {
        if (rename($imageDir . '/Dragon - The Bruce Lee Story (Europe)-cover.png', $imageDir . '/Dragon - The Bruce Lee Story-cover.png')) {
            echo "✓ Dragon - The Bruce Lee Story (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon - The Bruce Lee Story-cover.png\n";
        $skipped++;
    }
}

// Dragon - The Bruce Lee Story (Europe) → Dragon - The Bruce Lee Story
if (file_exists($imageDir . '/Dragon - The Bruce Lee Story (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Dragon - The Bruce Lee Story-gameplay.png')) {
        if (rename($imageDir . '/Dragon - The Bruce Lee Story (Europe)-gameplay.png', $imageDir . '/Dragon - The Bruce Lee Story-gameplay.png')) {
            echo "✓ Dragon - The Bruce Lee Story (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon - The Bruce Lee Story-gameplay.png\n";
        $skipped++;
    }
}

// Dragon - The Bruce Lee Story (USA) → Dragon - The Bruce Lee Story
if (file_exists($imageDir . '/Dragon - The Bruce Lee Story (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Dragon - The Bruce Lee Story-artwork.png')) {
        if (rename($imageDir . '/Dragon - The Bruce Lee Story (USA)-artwork.png', $imageDir . '/Dragon - The Bruce Lee Story-artwork.png')) {
            echo "✓ Dragon - The Bruce Lee Story (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon - The Bruce Lee Story-artwork.png\n";
        $skipped++;
    }
}

// Dragon - The Bruce Lee Story (USA) → Dragon - The Bruce Lee Story
if (file_exists($imageDir . '/Dragon - The Bruce Lee Story (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Dragon - The Bruce Lee Story-cover.png')) {
        if (rename($imageDir . '/Dragon - The Bruce Lee Story (USA)-cover.png', $imageDir . '/Dragon - The Bruce Lee Story-cover.png')) {
            echo "✓ Dragon - The Bruce Lee Story (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon - The Bruce Lee Story-cover.png\n";
        $skipped++;
    }
}

// Dragon - The Bruce Lee Story (USA) → Dragon - The Bruce Lee Story
if (file_exists($imageDir . '/Dragon - The Bruce Lee Story (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Dragon - The Bruce Lee Story-gameplay.png')) {
        if (rename($imageDir . '/Dragon - The Bruce Lee Story (USA)-gameplay.png', $imageDir . '/Dragon - The Bruce Lee Story-gameplay.png')) {
            echo "✓ Dragon - The Bruce Lee Story (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon - The Bruce Lee Story-gameplay.png\n";
        $skipped++;
    }
}

// Dragon Crystal - Tsurani no Meikyuu (Japan) → Dragon Crystal - Tsurani no Meikyuu
if (file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-artwork.png')) {
        if (rename($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-artwork.png', $imageDir . '/Dragon Crystal - Tsurani no Meikyuu-artwork.png')) {
            echo "✓ Dragon Crystal - Tsurani no Meikyuu (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon Crystal - Tsurani no Meikyuu-artwork.png\n";
        $skipped++;
    }
}

// Dragon Crystal - Tsurani no Meikyuu (Japan) → Dragon Crystal - Tsurani no Meikyuu
if (file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-cover.png')) {
        if (rename($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-cover.png', $imageDir . '/Dragon Crystal - Tsurani no Meikyuu-cover.png')) {
            echo "✓ Dragon Crystal - Tsurani no Meikyuu (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon Crystal - Tsurani no Meikyuu-cover.png\n";
        $skipped++;
    }
}

// Dragon Crystal - Tsurani no Meikyuu (Japan) → Dragon Crystal - Tsurani no Meikyuu
if (file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Dragon Crystal - Tsurani no Meikyuu-gameplay.png')) {
        if (rename($imageDir . '/Dragon Crystal - Tsurani no Meikyuu (Japan)-gameplay.png', $imageDir . '/Dragon Crystal - Tsurani no Meikyuu-gameplay.png')) {
            echo "✓ Dragon Crystal - Tsurani no Meikyuu (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Dragon Crystal - Tsurani no Meikyuu-gameplay.png\n";
        $skipped++;
    }
}

// Earthworm Jim (Europe) → Earthworm Jim
if (file_exists($imageDir . '/Earthworm Jim (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Earthworm Jim-artwork.png')) {
        if (rename($imageDir . '/Earthworm Jim (Europe)-artwork.png', $imageDir . '/Earthworm Jim-artwork.png')) {
            echo "✓ Earthworm Jim (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Earthworm Jim-artwork.png\n";
        $skipped++;
    }
}

// Earthworm Jim (Europe) → Earthworm Jim
if (file_exists($imageDir . '/Earthworm Jim (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Earthworm Jim-cover.png')) {
        if (rename($imageDir . '/Earthworm Jim (Europe)-cover.png', $imageDir . '/Earthworm Jim-cover.png')) {
            echo "✓ Earthworm Jim (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Earthworm Jim-cover.png\n";
        $skipped++;
    }
}

// Earthworm Jim (Europe) → Earthworm Jim
if (file_exists($imageDir . '/Earthworm Jim (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Earthworm Jim-gameplay.png')) {
        if (rename($imageDir . '/Earthworm Jim (Europe)-gameplay.png', $imageDir . '/Earthworm Jim-gameplay.png')) {
            echo "✓ Earthworm Jim (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Earthworm Jim-gameplay.png\n";
        $skipped++;
    }
}

// Earthworm Jim (USA) → Earthworm Jim
if (file_exists($imageDir . '/Earthworm Jim (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Earthworm Jim-artwork.png')) {
        if (rename($imageDir . '/Earthworm Jim (USA)-artwork.png', $imageDir . '/Earthworm Jim-artwork.png')) {
            echo "✓ Earthworm Jim (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Earthworm Jim-artwork.png\n";
        $skipped++;
    }
}

// Earthworm Jim (USA) → Earthworm Jim
if (file_exists($imageDir . '/Earthworm Jim (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Earthworm Jim-cover.png')) {
        if (rename($imageDir . '/Earthworm Jim (USA)-cover.png', $imageDir . '/Earthworm Jim-cover.png')) {
            echo "✓ Earthworm Jim (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Earthworm Jim-cover.png\n";
        $skipped++;
    }
}

// Earthworm Jim (USA) → Earthworm Jim
if (file_exists($imageDir . '/Earthworm Jim (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Earthworm Jim-gameplay.png')) {
        if (rename($imageDir . '/Earthworm Jim (USA)-gameplay.png', $imageDir . '/Earthworm Jim-gameplay.png')) {
            echo "✓ Earthworm Jim (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Earthworm Jim-gameplay.png\n";
        $skipped++;
    }
}

// Ecco The Dolphin (Japan) → Ecco The Dolphin
if (file_exists($imageDir . '/Ecco The Dolphin (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Ecco The Dolphin-artwork.png')) {
        if (rename($imageDir . '/Ecco The Dolphin (Japan)-artwork.png', $imageDir . '/Ecco The Dolphin-artwork.png')) {
            echo "✓ Ecco The Dolphin (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco The Dolphin-artwork.png\n";
        $skipped++;
    }
}

// Ecco The Dolphin (Japan) → Ecco The Dolphin
if (file_exists($imageDir . '/Ecco The Dolphin (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Ecco The Dolphin-cover.png')) {
        if (rename($imageDir . '/Ecco The Dolphin (Japan)-cover.png', $imageDir . '/Ecco The Dolphin-cover.png')) {
            echo "✓ Ecco The Dolphin (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco The Dolphin-cover.png\n";
        $skipped++;
    }
}

// Ecco The Dolphin (Japan) → Ecco The Dolphin
if (file_exists($imageDir . '/Ecco The Dolphin (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ecco The Dolphin-gameplay.png')) {
        if (rename($imageDir . '/Ecco The Dolphin (Japan)-gameplay.png', $imageDir . '/Ecco The Dolphin-gameplay.png')) {
            echo "✓ Ecco The Dolphin (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco The Dolphin-gameplay.png\n";
        $skipped++;
    }
}

// Ecco the Dolphin II (Japan) → Ecco the Dolphin II
if (file_exists($imageDir . '/Ecco the Dolphin II (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Ecco the Dolphin II-artwork.png')) {
        if (rename($imageDir . '/Ecco the Dolphin II (Japan)-artwork.png', $imageDir . '/Ecco the Dolphin II-artwork.png')) {
            echo "✓ Ecco the Dolphin II (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco the Dolphin II-artwork.png\n";
        $skipped++;
    }
}

// Ecco the Dolphin II (Japan) → Ecco the Dolphin II
if (file_exists($imageDir . '/Ecco the Dolphin II (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Ecco the Dolphin II-cover.png')) {
        if (rename($imageDir . '/Ecco the Dolphin II (Japan)-cover.png', $imageDir . '/Ecco the Dolphin II-cover.png')) {
            echo "✓ Ecco the Dolphin II (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco the Dolphin II-cover.png\n";
        $skipped++;
    }
}

// Ecco the Dolphin II (Japan) → Ecco the Dolphin II
if (file_exists($imageDir . '/Ecco the Dolphin II (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ecco the Dolphin II-gameplay.png')) {
        if (rename($imageDir . '/Ecco the Dolphin II (Japan)-gameplay.png', $imageDir . '/Ecco the Dolphin II-gameplay.png')) {
            echo "✓ Ecco the Dolphin II (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ecco the Dolphin II-gameplay.png\n";
        $skipped++;
    }
}

// Eternal Legend (Japan) → Eternal Legend (Japan)[h]
if (file_exists($imageDir . '/Eternal Legend (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Eternal Legend (Japan)[h]-artwork.png')) {
        if (rename($imageDir . '/Eternal Legend (Japan)-artwork.png', $imageDir . '/Eternal Legend (Japan)[h]-artwork.png')) {
            echo "✓ Eternal Legend (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Eternal Legend (Japan)[h]-artwork.png\n";
        $skipped++;
    }
}

// Eternal Legend (Japan) → Eternal Legend (Japan)[h]
if (file_exists($imageDir . '/Eternal Legend (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Eternal Legend (Japan)[h]-cover.png')) {
        if (rename($imageDir . '/Eternal Legend (Japan)-cover.png', $imageDir . '/Eternal Legend (Japan)[h]-cover.png')) {
            echo "✓ Eternal Legend (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Eternal Legend (Japan)[h]-cover.png\n";
        $skipped++;
    }
}

// Eternal Legend (Japan) → Eternal Legend (Japan)[h]
if (file_exists($imageDir . '/Eternal Legend (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Eternal Legend (Japan)[h]-gameplay.png')) {
        if (rename($imageDir . '/Eternal Legend (Japan)-gameplay.png', $imageDir . '/Eternal Legend (Japan)[h]-gameplay.png')) {
            echo "✓ Eternal Legend (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Eternal Legend (Japan)[h]-gameplay.png\n";
        $skipped++;
    }
}

// Excellent Dizzy Collection, The (Europe) → Excellent Dizzy Collection, The
if (file_exists($imageDir . '/Excellent Dizzy Collection, The (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Excellent Dizzy Collection, The-artwork.png')) {
        if (rename($imageDir . '/Excellent Dizzy Collection, The (Europe)-artwork.png', $imageDir . '/Excellent Dizzy Collection, The-artwork.png')) {
            echo "✓ Excellent Dizzy Collection, The (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Excellent Dizzy Collection, The-artwork.png\n";
        $skipped++;
    }
}

// Excellent Dizzy Collection, The (Europe) → Excellent Dizzy Collection, The
if (file_exists($imageDir . '/Excellent Dizzy Collection, The (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Excellent Dizzy Collection, The-cover.png')) {
        if (rename($imageDir . '/Excellent Dizzy Collection, The (Europe)-cover.png', $imageDir . '/Excellent Dizzy Collection, The-cover.png')) {
            echo "✓ Excellent Dizzy Collection, The (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Excellent Dizzy Collection, The-cover.png\n";
        $skipped++;
    }
}

// Excellent Dizzy Collection, The (Europe) → Excellent Dizzy Collection, The
if (file_exists($imageDir . '/Excellent Dizzy Collection, The (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Excellent Dizzy Collection, The-gameplay.png')) {
        if (rename($imageDir . '/Excellent Dizzy Collection, The (Europe)-gameplay.png', $imageDir . '/Excellent Dizzy Collection, The-gameplay.png')) {
            echo "✓ Excellent Dizzy Collection, The (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Excellent Dizzy Collection, The-gameplay.png\n";
        $skipped++;
    }
}

// F-15 Strike Eagle (USA, Europe) → F-15 Strike Eagle
if (file_exists($imageDir . '/F-15 Strike Eagle (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/F-15 Strike Eagle-artwork.png')) {
        if (rename($imageDir . '/F-15 Strike Eagle (USA, Europe)-artwork.png', $imageDir . '/F-15 Strike Eagle-artwork.png')) {
            echo "✓ F-15 Strike Eagle (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F-15 Strike Eagle-artwork.png\n";
        $skipped++;
    }
}

// F-15 Strike Eagle (USA, Europe) → F-15 Strike Eagle
if (file_exists($imageDir . '/F-15 Strike Eagle (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/F-15 Strike Eagle-cover.png')) {
        if (rename($imageDir . '/F-15 Strike Eagle (USA, Europe)-cover.png', $imageDir . '/F-15 Strike Eagle-cover.png')) {
            echo "✓ F-15 Strike Eagle (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F-15 Strike Eagle-cover.png\n";
        $skipped++;
    }
}

// F-15 Strike Eagle (USA, Europe) → F-15 Strike Eagle
if (file_exists($imageDir . '/F-15 Strike Eagle (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/F-15 Strike Eagle-gameplay.png')) {
        if (rename($imageDir . '/F-15 Strike Eagle (USA, Europe)-gameplay.png', $imageDir . '/F-15 Strike Eagle-gameplay.png')) {
            echo "✓ F-15 Strike Eagle (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F-15 Strike Eagle-gameplay.png\n";
        $skipped++;
    }
}

// F1 - World Championship Edition (Europe) → F1 - World Championship Edition
if (file_exists($imageDir . '/F1 - World Championship Edition (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/F1 - World Championship Edition-artwork.png')) {
        if (rename($imageDir . '/F1 - World Championship Edition (Europe)-artwork.png', $imageDir . '/F1 - World Championship Edition-artwork.png')) {
            echo "✓ F1 - World Championship Edition (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F1 - World Championship Edition-artwork.png\n";
        $skipped++;
    }
}

// F1 - World Championship Edition (Europe) → F1 - World Championship Edition
if (file_exists($imageDir . '/F1 - World Championship Edition (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/F1 - World Championship Edition-cover.png')) {
        if (rename($imageDir . '/F1 - World Championship Edition (Europe)-cover.png', $imageDir . '/F1 - World Championship Edition-cover.png')) {
            echo "✓ F1 - World Championship Edition (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F1 - World Championship Edition-cover.png\n";
        $skipped++;
    }
}

// F1 - World Championship Edition (Europe) → F1 - World Championship Edition
if (file_exists($imageDir . '/F1 - World Championship Edition (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/F1 - World Championship Edition-gameplay.png')) {
        if (rename($imageDir . '/F1 - World Championship Edition (Europe)-gameplay.png', $imageDir . '/F1 - World Championship Edition-gameplay.png')) {
            echo "✓ F1 - World Championship Edition (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: F1 - World Championship Edition-gameplay.png\n";
        $skipped++;
    }
}

// FIFA International Soccer (Japan) → FIFA International Soccer
if (file_exists($imageDir . '/FIFA International Soccer (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/FIFA International Soccer-artwork.png')) {
        if (rename($imageDir . '/FIFA International Soccer (Japan)-artwork.png', $imageDir . '/FIFA International Soccer-artwork.png')) {
            echo "✓ FIFA International Soccer (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: FIFA International Soccer-artwork.png\n";
        $skipped++;
    }
}

// FIFA International Soccer (Japan) → FIFA International Soccer
if (file_exists($imageDir . '/FIFA International Soccer (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/FIFA International Soccer-cover.png')) {
        if (rename($imageDir . '/FIFA International Soccer (Japan)-cover.png', $imageDir . '/FIFA International Soccer-cover.png')) {
            echo "✓ FIFA International Soccer (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: FIFA International Soccer-cover.png\n";
        $skipped++;
    }
}

// FIFA International Soccer (Japan) → FIFA International Soccer
if (file_exists($imageDir . '/FIFA International Soccer (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/FIFA International Soccer-gameplay.png')) {
        if (rename($imageDir . '/FIFA International Soccer (Japan)-gameplay.png', $imageDir . '/FIFA International Soccer-gameplay.png')) {
            echo "✓ FIFA International Soccer (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: FIFA International Soccer-gameplay.png\n";
        $skipped++;
    }
}

// FIFA International Soccer (USA, Europe) → FIFA International Soccer
if (file_exists($imageDir . '/FIFA International Soccer (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/FIFA International Soccer-artwork.png')) {
        if (rename($imageDir . '/FIFA International Soccer (USA, Europe)-artwork.png', $imageDir . '/FIFA International Soccer-artwork.png')) {
            echo "✓ FIFA International Soccer (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: FIFA International Soccer-artwork.png\n";
        $skipped++;
    }
}

// FIFA International Soccer (USA, Europe) → FIFA International Soccer
if (file_exists($imageDir . '/FIFA International Soccer (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/FIFA International Soccer-cover.png')) {
        if (rename($imageDir . '/FIFA International Soccer (USA, Europe)-cover.png', $imageDir . '/FIFA International Soccer-cover.png')) {
            echo "✓ FIFA International Soccer (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: FIFA International Soccer-cover.png\n";
        $skipped++;
    }
}

// FIFA International Soccer (USA, Europe) → FIFA International Soccer
if (file_exists($imageDir . '/FIFA International Soccer (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/FIFA International Soccer-gameplay.png')) {
        if (rename($imageDir . '/FIFA International Soccer (USA, Europe)-gameplay.png', $imageDir . '/FIFA International Soccer-gameplay.png')) {
            echo "✓ FIFA International Soccer (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: FIFA International Soccer-gameplay.png\n";
        $skipped++;
    }
}

// Fatal Fury Special (Europe) → Fatal Fury Special
if (file_exists($imageDir . '/Fatal Fury Special (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Fatal Fury Special-artwork.png')) {
        if (rename($imageDir . '/Fatal Fury Special (Europe)-artwork.png', $imageDir . '/Fatal Fury Special-artwork.png')) {
            echo "✓ Fatal Fury Special (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fatal Fury Special-artwork.png\n";
        $skipped++;
    }
}

// Fatal Fury Special (Europe) → Fatal Fury Special
if (file_exists($imageDir . '/Fatal Fury Special (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Fatal Fury Special-cover.png')) {
        if (rename($imageDir . '/Fatal Fury Special (Europe)-cover.png', $imageDir . '/Fatal Fury Special-cover.png')) {
            echo "✓ Fatal Fury Special (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fatal Fury Special-cover.png\n";
        $skipped++;
    }
}

// Fatal Fury Special (Europe) → Fatal Fury Special
if (file_exists($imageDir . '/Fatal Fury Special (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Fatal Fury Special-gameplay.png')) {
        if (rename($imageDir . '/Fatal Fury Special (Europe)-gameplay.png', $imageDir . '/Fatal Fury Special-gameplay.png')) {
            echo "✓ Fatal Fury Special (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fatal Fury Special-gameplay.png\n";
        $skipped++;
    }
}

// Fatal Fury Special (USA) → Fatal Fury Special
if (file_exists($imageDir . '/Fatal Fury Special (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Fatal Fury Special-artwork.png')) {
        if (rename($imageDir . '/Fatal Fury Special (USA)-artwork.png', $imageDir . '/Fatal Fury Special-artwork.png')) {
            echo "✓ Fatal Fury Special (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fatal Fury Special-artwork.png\n";
        $skipped++;
    }
}

// Fatal Fury Special (USA) → Fatal Fury Special
if (file_exists($imageDir . '/Fatal Fury Special (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Fatal Fury Special-cover.png')) {
        if (rename($imageDir . '/Fatal Fury Special (USA)-cover.png', $imageDir . '/Fatal Fury Special-cover.png')) {
            echo "✓ Fatal Fury Special (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fatal Fury Special-cover.png\n";
        $skipped++;
    }
}

// Fatal Fury Special (USA) → Fatal Fury Special
if (file_exists($imageDir . '/Fatal Fury Special (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Fatal Fury Special-gameplay.png')) {
        if (rename($imageDir . '/Fatal Fury Special (USA)-gameplay.png', $imageDir . '/Fatal Fury Special-gameplay.png')) {
            echo "✓ Fatal Fury Special (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fatal Fury Special-gameplay.png\n";
        $skipped++;
    }
}

// Foreman for Real (Japan, USA) → Foreman for Real
if (file_exists($imageDir . '/Foreman for Real (Japan, USA)-cover.png')) {
    if (!file_exists($imageDir . '/Foreman for Real-cover.png')) {
        if (rename($imageDir . '/Foreman for Real (Japan, USA)-cover.png', $imageDir . '/Foreman for Real-cover.png')) {
            echo "✓ Foreman for Real (Japan, USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Foreman for Real-cover.png\n";
        $skipped++;
    }
}

// Foreman for Real (Japan, USA) → Foreman for Real
if (file_exists($imageDir . '/Foreman for Real (Japan, USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Foreman for Real-gameplay.png')) {
        if (rename($imageDir . '/Foreman for Real (Japan, USA)-gameplay.png', $imageDir . '/Foreman for Real-gameplay.png')) {
            echo "✓ Foreman for Real (Japan, USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Foreman for Real-gameplay.png\n";
        $skipped++;
    }
}

// Frank Thomas Big Hurt Baseball (USA) → Frank Thomas Big Hurt Baseball
if (file_exists($imageDir . '/Frank Thomas Big Hurt Baseball (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Frank Thomas Big Hurt Baseball-artwork.png')) {
        if (rename($imageDir . '/Frank Thomas Big Hurt Baseball (USA)-artwork.png', $imageDir . '/Frank Thomas Big Hurt Baseball-artwork.png')) {
            echo "✓ Frank Thomas Big Hurt Baseball (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Frank Thomas Big Hurt Baseball-artwork.png\n";
        $skipped++;
    }
}

// Frank Thomas Big Hurt Baseball (USA) → Frank Thomas Big Hurt Baseball
if (file_exists($imageDir . '/Frank Thomas Big Hurt Baseball (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Frank Thomas Big Hurt Baseball-cover.png')) {
        if (rename($imageDir . '/Frank Thomas Big Hurt Baseball (USA)-cover.png', $imageDir . '/Frank Thomas Big Hurt Baseball-cover.png')) {
            echo "✓ Frank Thomas Big Hurt Baseball (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Frank Thomas Big Hurt Baseball-cover.png\n";
        $skipped++;
    }
}

// Frank Thomas Big Hurt Baseball (USA) → Frank Thomas Big Hurt Baseball
if (file_exists($imageDir . '/Frank Thomas Big Hurt Baseball (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Frank Thomas Big Hurt Baseball-gameplay.png')) {
        if (rename($imageDir . '/Frank Thomas Big Hurt Baseball (USA)-gameplay.png', $imageDir . '/Frank Thomas Big Hurt Baseball-gameplay.png')) {
            echo "✓ Frank Thomas Big Hurt Baseball (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Frank Thomas Big Hurt Baseball-gameplay.png\n";
        $skipped++;
    }
}

// Fray - Shugyou Hen (Japan) → Fray - Shugyou Hen
if (file_exists($imageDir . '/Fray - Shugyou Hen (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Fray - Shugyou Hen-artwork.png')) {
        if (rename($imageDir . '/Fray - Shugyou Hen (Japan)-artwork.png', $imageDir . '/Fray - Shugyou Hen-artwork.png')) {
            echo "✓ Fray - Shugyou Hen (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fray - Shugyou Hen-artwork.png\n";
        $skipped++;
    }
}

// Fray - Shugyou Hen (Japan) → Fray - Shugyou Hen
if (file_exists($imageDir . '/Fray - Shugyou Hen (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Fray - Shugyou Hen-cover.png')) {
        if (rename($imageDir . '/Fray - Shugyou Hen (Japan)-cover.png', $imageDir . '/Fray - Shugyou Hen-cover.png')) {
            echo "✓ Fray - Shugyou Hen (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fray - Shugyou Hen-cover.png\n";
        $skipped++;
    }
}

// Fray - Shugyou Hen (Japan) → Fray - Shugyou Hen
if (file_exists($imageDir . '/Fray - Shugyou Hen (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Fray - Shugyou Hen-gameplay.png')) {
        if (rename($imageDir . '/Fray - Shugyou Hen (Japan)-gameplay.png', $imageDir . '/Fray - Shugyou Hen-gameplay.png')) {
            echo "✓ Fray - Shugyou Hen (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fray - Shugyou Hen-gameplay.png\n";
        $skipped++;
    }
}

// Fred Couples Golf (Japan) → Fred Couples Golf
if (file_exists($imageDir . '/Fred Couples Golf (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Fred Couples Golf-artwork.png')) {
        if (rename($imageDir . '/Fred Couples Golf (Japan)-artwork.png', $imageDir . '/Fred Couples Golf-artwork.png')) {
            echo "✓ Fred Couples Golf (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fred Couples Golf-artwork.png\n";
        $skipped++;
    }
}

// Fred Couples Golf (Japan) → Fred Couples Golf
if (file_exists($imageDir . '/Fred Couples Golf (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Fred Couples Golf-cover.png')) {
        if (rename($imageDir . '/Fred Couples Golf (Japan)-cover.png', $imageDir . '/Fred Couples Golf-cover.png')) {
            echo "✓ Fred Couples Golf (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fred Couples Golf-cover.png\n";
        $skipped++;
    }
}

// Fred Couples Golf (Japan) → Fred Couples Golf
if (file_exists($imageDir . '/Fred Couples Golf (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Fred Couples Golf-gameplay.png')) {
        if (rename($imageDir . '/Fred Couples Golf (Japan)-gameplay.png', $imageDir . '/Fred Couples Golf-gameplay.png')) {
            echo "✓ Fred Couples Golf (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fred Couples Golf-gameplay.png\n";
        $skipped++;
    }
}

// Fred Couples Golf (USA) → Fred Couples Golf
if (file_exists($imageDir . '/Fred Couples Golf (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Fred Couples Golf-artwork.png')) {
        if (rename($imageDir . '/Fred Couples Golf (USA)-artwork.png', $imageDir . '/Fred Couples Golf-artwork.png')) {
            echo "✓ Fred Couples Golf (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fred Couples Golf-artwork.png\n";
        $skipped++;
    }
}

// Fred Couples Golf (USA) → Fred Couples Golf
if (file_exists($imageDir . '/Fred Couples Golf (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Fred Couples Golf-cover.png')) {
        if (rename($imageDir . '/Fred Couples Golf (USA)-cover.png', $imageDir . '/Fred Couples Golf-cover.png')) {
            echo "✓ Fred Couples Golf (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fred Couples Golf-cover.png\n";
        $skipped++;
    }
}

// Fred Couples Golf (USA) → Fred Couples Golf
if (file_exists($imageDir . '/Fred Couples Golf (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Fred Couples Golf-gameplay.png')) {
        if (rename($imageDir . '/Fred Couples Golf (USA)-gameplay.png', $imageDir . '/Fred Couples Golf-gameplay.png')) {
            echo "✓ Fred Couples Golf (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Fred Couples Golf-gameplay.png\n";
        $skipped++;
    }
}

// From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan) → From TV Animation Slam Dunk - Shouri e no Starting 5
if (file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-artwork.png')) {
        if (rename($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-artwork.png', $imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-artwork.png')) {
            echo "✓ From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: From TV Animation Slam Dunk - Shouri e no Starting 5-artwork.png\n";
        $skipped++;
    }
}

// From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan) → From TV Animation Slam Dunk - Shouri e no Starting 5
if (file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-cover.png')) {
        if (rename($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-cover.png', $imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-cover.png')) {
            echo "✓ From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: From TV Animation Slam Dunk - Shouri e no Starting 5-cover.png\n";
        $skipped++;
    }
}

// From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan) → From TV Animation Slam Dunk - Shouri e no Starting 5
if (file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-gameplay.png')) {
        if (rename($imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-gameplay.png', $imageDir . '/From TV Animation Slam Dunk - Shouri e no Starting 5-gameplay.png')) {
            echo "✓ From TV Animation Slam Dunk - Shouri e no Starting 5 (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: From TV Animation Slam Dunk - Shouri e no Starting 5-gameplay.png\n";
        $skipped++;
    }
}

// G-LOC - Air Battle (Japan) → G-LOC - Air Battle
if (file_exists($imageDir . '/G-LOC - Air Battle (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/G-LOC - Air Battle-artwork.png')) {
        if (rename($imageDir . '/G-LOC - Air Battle (Japan)-artwork.png', $imageDir . '/G-LOC - Air Battle-artwork.png')) {
            echo "✓ G-LOC - Air Battle (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: G-LOC - Air Battle-artwork.png\n";
        $skipped++;
    }
}

// G-LOC - Air Battle (Japan) → G-LOC - Air Battle
if (file_exists($imageDir . '/G-LOC - Air Battle (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/G-LOC - Air Battle-cover.png')) {
        if (rename($imageDir . '/G-LOC - Air Battle (Japan)-cover.png', $imageDir . '/G-LOC - Air Battle-cover.png')) {
            echo "✓ G-LOC - Air Battle (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: G-LOC - Air Battle-cover.png\n";
        $skipped++;
    }
}

// G-LOC - Air Battle (Japan) → G-LOC - Air Battle
if (file_exists($imageDir . '/G-LOC - Air Battle (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/G-LOC - Air Battle-gameplay.png')) {
        if (rename($imageDir . '/G-LOC - Air Battle (Japan)-gameplay.png', $imageDir . '/G-LOC - Air Battle-gameplay.png')) {
            echo "✓ G-LOC - Air Battle (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: G-LOC - Air Battle-gameplay.png\n";
        $skipped++;
    }
}

// GG Portrait - Pai Chan (Japan) → GG Portrait - Pai Chan
if (file_exists($imageDir . '/GG Portrait - Pai Chan (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Pai Chan-artwork.png')) {
        if (rename($imageDir . '/GG Portrait - Pai Chan (Japan)-artwork.png', $imageDir . '/GG Portrait - Pai Chan-artwork.png')) {
            echo "✓ GG Portrait - Pai Chan (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Pai Chan-artwork.png\n";
        $skipped++;
    }
}

// GG Portrait - Pai Chan (Japan) → GG Portrait - Pai Chan
if (file_exists($imageDir . '/GG Portrait - Pai Chan (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Pai Chan-cover.png')) {
        if (rename($imageDir . '/GG Portrait - Pai Chan (Japan)-cover.png', $imageDir . '/GG Portrait - Pai Chan-cover.png')) {
            echo "✓ GG Portrait - Pai Chan (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Pai Chan-cover.png\n";
        $skipped++;
    }
}

// GG Portrait - Pai Chan (Japan) → GG Portrait - Pai Chan
if (file_exists($imageDir . '/GG Portrait - Pai Chan (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Pai Chan-gameplay.png')) {
        if (rename($imageDir . '/GG Portrait - Pai Chan (Japan)-gameplay.png', $imageDir . '/GG Portrait - Pai Chan-gameplay.png')) {
            echo "✓ GG Portrait - Pai Chan (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Pai Chan-gameplay.png\n";
        $skipped++;
    }
}

// GG Portrait - Yuuki Akira (Japan) → GG Portrait - Yuuki Akira
if (file_exists($imageDir . '/GG Portrait - Yuuki Akira (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Yuuki Akira-artwork.png')) {
        if (rename($imageDir . '/GG Portrait - Yuuki Akira (Japan)-artwork.png', $imageDir . '/GG Portrait - Yuuki Akira-artwork.png')) {
            echo "✓ GG Portrait - Yuuki Akira (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Yuuki Akira-artwork.png\n";
        $skipped++;
    }
}

// GG Portrait - Yuuki Akira (Japan) → GG Portrait - Yuuki Akira
if (file_exists($imageDir . '/GG Portrait - Yuuki Akira (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Yuuki Akira-cover.png')) {
        if (rename($imageDir . '/GG Portrait - Yuuki Akira (Japan)-cover.png', $imageDir . '/GG Portrait - Yuuki Akira-cover.png')) {
            echo "✓ GG Portrait - Yuuki Akira (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Yuuki Akira-cover.png\n";
        $skipped++;
    }
}

// GG Portrait - Yuuki Akira (Japan) → GG Portrait - Yuuki Akira
if (file_exists($imageDir . '/GG Portrait - Yuuki Akira (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/GG Portrait - Yuuki Akira-gameplay.png')) {
        if (rename($imageDir . '/GG Portrait - Yuuki Akira (Japan)-gameplay.png', $imageDir . '/GG Portrait - Yuuki Akira-gameplay.png')) {
            echo "✓ GG Portrait - Yuuki Akira (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Portrait - Yuuki Akira-gameplay.png\n";
        $skipped++;
    }
}

// GG Shinobi Part II, The - The Silent Fury (Japan) → GG Shinobi Part II, The - The Silent Fury
if (file_exists($imageDir . '/GG Shinobi Part II, The - The Silent Fury (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/GG Shinobi Part II, The - The Silent Fury-cover.png')) {
        if (rename($imageDir . '/GG Shinobi Part II, The - The Silent Fury (Japan)-cover.png', $imageDir . '/GG Shinobi Part II, The - The Silent Fury-cover.png')) {
            echo "✓ GG Shinobi Part II, The - The Silent Fury (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: GG Shinobi Part II, The - The Silent Fury-cover.png\n";
        $skipped++;
    }
}

// Gamble Panic (Japan) → Gamble Panic
if (file_exists($imageDir . '/Gamble Panic (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Gamble Panic-artwork.png')) {
        if (rename($imageDir . '/Gamble Panic (Japan)-artwork.png', $imageDir . '/Gamble Panic-artwork.png')) {
            echo "✓ Gamble Panic (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gamble Panic-artwork.png\n";
        $skipped++;
    }
}

// Gamble Panic (Japan) → Gamble Panic
if (file_exists($imageDir . '/Gamble Panic (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Gamble Panic-cover.png')) {
        if (rename($imageDir . '/Gamble Panic (Japan)-cover.png', $imageDir . '/Gamble Panic-cover.png')) {
            echo "✓ Gamble Panic (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gamble Panic-cover.png\n";
        $skipped++;
    }
}

// Gamble Panic (Japan) → Gamble Panic
if (file_exists($imageDir . '/Gamble Panic (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Gamble Panic-gameplay.png')) {
        if (rename($imageDir . '/Gamble Panic (Japan)-gameplay.png', $imageDir . '/Gamble Panic-gameplay.png')) {
            echo "✓ Gamble Panic (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gamble Panic-gameplay.png\n";
        $skipped++;
    }
}

// Gambler Jiko Chuushinha (Japan) → Gambler Jiko Chuushinha
if (file_exists($imageDir . '/Gambler Jiko Chuushinha (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Gambler Jiko Chuushinha-artwork.png')) {
        if (rename($imageDir . '/Gambler Jiko Chuushinha (Japan)-artwork.png', $imageDir . '/Gambler Jiko Chuushinha-artwork.png')) {
            echo "✓ Gambler Jiko Chuushinha (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gambler Jiko Chuushinha-artwork.png\n";
        $skipped++;
    }
}

// Gambler Jiko Chuushinha (Japan) → Gambler Jiko Chuushinha
if (file_exists($imageDir . '/Gambler Jiko Chuushinha (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Gambler Jiko Chuushinha-cover.png')) {
        if (rename($imageDir . '/Gambler Jiko Chuushinha (Japan)-cover.png', $imageDir . '/Gambler Jiko Chuushinha-cover.png')) {
            echo "✓ Gambler Jiko Chuushinha (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gambler Jiko Chuushinha-cover.png\n";
        $skipped++;
    }
}

// Gambler Jiko Chuushinha (Japan) → Gambler Jiko Chuushinha
if (file_exists($imageDir . '/Gambler Jiko Chuushinha (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Gambler Jiko Chuushinha-gameplay.png')) {
        if (rename($imageDir . '/Gambler Jiko Chuushinha (Japan)-gameplay.png', $imageDir . '/Gambler Jiko Chuushinha-gameplay.png')) {
            echo "✓ Gambler Jiko Chuushinha (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gambler Jiko Chuushinha-gameplay.png\n";
        $skipped++;
    }
}

// Garfield - Caught in the Act (USA, Europe) → Garfield - Caught in the Act
if (file_exists($imageDir . '/Garfield - Caught in the Act (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Garfield - Caught in the Act-artwork.png')) {
        if (rename($imageDir . '/Garfield - Caught in the Act (USA, Europe)-artwork.png', $imageDir . '/Garfield - Caught in the Act-artwork.png')) {
            echo "✓ Garfield - Caught in the Act (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garfield - Caught in the Act-artwork.png\n";
        $skipped++;
    }
}

// Garfield - Caught in the Act (USA, Europe) → Garfield - Caught in the Act
if (file_exists($imageDir . '/Garfield - Caught in the Act (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Garfield - Caught in the Act-cover.png')) {
        if (rename($imageDir . '/Garfield - Caught in the Act (USA, Europe)-cover.png', $imageDir . '/Garfield - Caught in the Act-cover.png')) {
            echo "✓ Garfield - Caught in the Act (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garfield - Caught in the Act-cover.png\n";
        $skipped++;
    }
}

// Garfield - Caught in the Act (USA, Europe) → Garfield - Caught in the Act
if (file_exists($imageDir . '/Garfield - Caught in the Act (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Garfield - Caught in the Act-gameplay.png')) {
        if (rename($imageDir . '/Garfield - Caught in the Act (USA, Europe)-gameplay.png', $imageDir . '/Garfield - Caught in the Act-gameplay.png')) {
            echo "✓ Garfield - Caught in the Act (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garfield - Caught in the Act-gameplay.png\n";
        $skipped++;
    }
}

// Garou Densetsu Special (Japan) → Garou Densetsu Special
if (file_exists($imageDir . '/Garou Densetsu Special (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Garou Densetsu Special-artwork.png')) {
        if (rename($imageDir . '/Garou Densetsu Special (Japan)-artwork.png', $imageDir . '/Garou Densetsu Special-artwork.png')) {
            echo "✓ Garou Densetsu Special (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garou Densetsu Special-artwork.png\n";
        $skipped++;
    }
}

// Garou Densetsu Special (Japan) → Garou Densetsu Special
if (file_exists($imageDir . '/Garou Densetsu Special (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Garou Densetsu Special-cover.png')) {
        if (rename($imageDir . '/Garou Densetsu Special (Japan)-cover.png', $imageDir . '/Garou Densetsu Special-cover.png')) {
            echo "✓ Garou Densetsu Special (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garou Densetsu Special-cover.png\n";
        $skipped++;
    }
}

// Garou Densetsu Special (Japan) → Garou Densetsu Special
if (file_exists($imageDir . '/Garou Densetsu Special (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Garou Densetsu Special-gameplay.png')) {
        if (rename($imageDir . '/Garou Densetsu Special (Japan)-gameplay.png', $imageDir . '/Garou Densetsu Special-gameplay.png')) {
            echo "✓ Garou Densetsu Special (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Garou Densetsu Special-gameplay.png\n";
        $skipped++;
    }
}

// Gear Stadium (Japan) → Gear Stadium
if (file_exists($imageDir . '/Gear Stadium (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Gear Stadium-artwork.png')) {
        if (rename($imageDir . '/Gear Stadium (Japan)-artwork.png', $imageDir . '/Gear Stadium-artwork.png')) {
            echo "✓ Gear Stadium (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium-artwork.png\n";
        $skipped++;
    }
}

// Gear Stadium (Japan) → Gear Stadium
if (file_exists($imageDir . '/Gear Stadium (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Gear Stadium-cover.png')) {
        if (rename($imageDir . '/Gear Stadium (Japan)-cover.png', $imageDir . '/Gear Stadium-cover.png')) {
            echo "✓ Gear Stadium (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium-cover.png\n";
        $skipped++;
    }
}

// Gear Stadium (Japan) → Gear Stadium
if (file_exists($imageDir . '/Gear Stadium (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Gear Stadium-gameplay.png')) {
        if (rename($imageDir . '/Gear Stadium (Japan)-gameplay.png', $imageDir . '/Gear Stadium-gameplay.png')) {
            echo "✓ Gear Stadium (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium-gameplay.png\n";
        $skipped++;
    }
}

// Gear Stadium Heiseiban (Japan) → Gear Stadium Heiseiban
if (file_exists($imageDir . '/Gear Stadium Heiseiban (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Gear Stadium Heiseiban-artwork.png')) {
        if (rename($imageDir . '/Gear Stadium Heiseiban (Japan)-artwork.png', $imageDir . '/Gear Stadium Heiseiban-artwork.png')) {
            echo "✓ Gear Stadium Heiseiban (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium Heiseiban-artwork.png\n";
        $skipped++;
    }
}

// Gear Stadium Heiseiban (Japan) → Gear Stadium Heiseiban
if (file_exists($imageDir . '/Gear Stadium Heiseiban (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Gear Stadium Heiseiban-cover.png')) {
        if (rename($imageDir . '/Gear Stadium Heiseiban (Japan)-cover.png', $imageDir . '/Gear Stadium Heiseiban-cover.png')) {
            echo "✓ Gear Stadium Heiseiban (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium Heiseiban-cover.png\n";
        $skipped++;
    }
}

// Gear Stadium Heiseiban (Japan) → Gear Stadium Heiseiban
if (file_exists($imageDir . '/Gear Stadium Heiseiban (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Gear Stadium Heiseiban-gameplay.png')) {
        if (rename($imageDir . '/Gear Stadium Heiseiban (Japan)-gameplay.png', $imageDir . '/Gear Stadium Heiseiban-gameplay.png')) {
            echo "✓ Gear Stadium Heiseiban (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Stadium Heiseiban-gameplay.png\n";
        $skipped++;
    }
}

// Gear Works (USA) → Gear Works
if (file_exists($imageDir . '/Gear Works (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Gear Works-artwork.png')) {
        if (rename($imageDir . '/Gear Works (USA)-artwork.png', $imageDir . '/Gear Works-artwork.png')) {
            echo "✓ Gear Works (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Works-artwork.png\n";
        $skipped++;
    }
}

// Gear Works (USA) → Gear Works
if (file_exists($imageDir . '/Gear Works (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Gear Works-cover.png')) {
        if (rename($imageDir . '/Gear Works (USA)-cover.png', $imageDir . '/Gear Works-cover.png')) {
            echo "✓ Gear Works (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Works-cover.png\n";
        $skipped++;
    }
}

// Gear Works (USA) → Gear Works
if (file_exists($imageDir . '/Gear Works (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Gear Works-gameplay.png')) {
        if (rename($imageDir . '/Gear Works (USA)-gameplay.png', $imageDir . '/Gear Works-gameplay.png')) {
            echo "✓ Gear Works (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gear Works-gameplay.png\n";
        $skipped++;
    }
}

// Global Gladiators (Europe) → Global Gladiators
if (file_exists($imageDir . '/Global Gladiators (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Global Gladiators-artwork.png')) {
        if (rename($imageDir . '/Global Gladiators (Europe)-artwork.png', $imageDir . '/Global Gladiators-artwork.png')) {
            echo "✓ Global Gladiators (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Global Gladiators-artwork.png\n";
        $skipped++;
    }
}

// Global Gladiators (Europe) → Global Gladiators
if (file_exists($imageDir . '/Global Gladiators (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Global Gladiators-cover.png')) {
        if (rename($imageDir . '/Global Gladiators (Europe)-cover.png', $imageDir . '/Global Gladiators-cover.png')) {
            echo "✓ Global Gladiators (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Global Gladiators-cover.png\n";
        $skipped++;
    }
}

// Global Gladiators (Europe) → Global Gladiators
if (file_exists($imageDir . '/Global Gladiators (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Global Gladiators-gameplay.png')) {
        if (rename($imageDir . '/Global Gladiators (Europe)-gameplay.png', $imageDir . '/Global Gladiators-gameplay.png')) {
            echo "✓ Global Gladiators (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Global Gladiators-gameplay.png\n";
        $skipped++;
    }
}

// Gojira - Kaijuu Daishingeki (Japan) → Gojira - Kaijuu Daishingeki
if (file_exists($imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Gojira - Kaijuu Daishingeki-artwork.png')) {
        if (rename($imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-artwork.png', $imageDir . '/Gojira - Kaijuu Daishingeki-artwork.png')) {
            echo "✓ Gojira - Kaijuu Daishingeki (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gojira - Kaijuu Daishingeki-artwork.png\n";
        $skipped++;
    }
}

// Gojira - Kaijuu Daishingeki (Japan) → Gojira - Kaijuu Daishingeki
if (file_exists($imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Gojira - Kaijuu Daishingeki-cover.png')) {
        if (rename($imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-cover.png', $imageDir . '/Gojira - Kaijuu Daishingeki-cover.png')) {
            echo "✓ Gojira - Kaijuu Daishingeki (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gojira - Kaijuu Daishingeki-cover.png\n";
        $skipped++;
    }
}

// Gojira - Kaijuu Daishingeki (Japan) → Gojira - Kaijuu Daishingeki
if (file_exists($imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Gojira - Kaijuu Daishingeki-gameplay.png')) {
        if (rename($imageDir . '/Gojira - Kaijuu Daishingeki (Japan)-gameplay.png', $imageDir . '/Gojira - Kaijuu Daishingeki-gameplay.png')) {
            echo "✓ Gojira - Kaijuu Daishingeki (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gojira - Kaijuu Daishingeki-gameplay.png\n";
        $skipped++;
    }
}

// Greendog the Beached Surfer Dude Usa Brazil (En) → Greendog - The Beached Surfer Dude!
if (file_exists($imageDir . '/Greendog the Beached Surfer Dude Usa Brazil (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Greendog - The Beached Surfer Dude!-artwork.png')) {
        if (rename($imageDir . '/Greendog the Beached Surfer Dude Usa Brazil (En)-artwork.png', $imageDir . '/Greendog - The Beached Surfer Dude!-artwork.png')) {
            echo "✓ Greendog the Beached Surfer Dude Usa Brazil (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Greendog - The Beached Surfer Dude!-artwork.png\n";
        $skipped++;
    }
}

// Greendog the Beached Surfer Dude Usa Brazil (En) → Greendog - The Beached Surfer Dude!
if (file_exists($imageDir . '/Greendog the Beached Surfer Dude Usa Brazil (En)-cover.png')) {
    if (!file_exists($imageDir . '/Greendog - The Beached Surfer Dude!-cover.png')) {
        if (rename($imageDir . '/Greendog the Beached Surfer Dude Usa Brazil (En)-cover.png', $imageDir . '/Greendog - The Beached Surfer Dude!-cover.png')) {
            echo "✓ Greendog the Beached Surfer Dude Usa Brazil (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Greendog - The Beached Surfer Dude!-cover.png\n";
        $skipped++;
    }
}

// Greendog the Beached Surfer Dude Usa Brazil (En) → Greendog - The Beached Surfer Dude!
if (file_exists($imageDir . '/Greendog the Beached Surfer Dude Usa Brazil (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Greendog - The Beached Surfer Dude!-gameplay.png')) {
        if (rename($imageDir . '/Greendog the Beached Surfer Dude Usa Brazil (En)-gameplay.png', $imageDir . '/Greendog - The Beached Surfer Dude!-gameplay.png')) {
            echo "✓ Greendog the Beached Surfer Dude Usa Brazil (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Greendog - The Beached Surfer Dude!-gameplay.png\n";
        $skipped++;
    }
}

// Gunstar Heroes (Japan) → Gunstar Heroes
if (file_exists($imageDir . '/Gunstar Heroes (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Gunstar Heroes-artwork.png')) {
        if (rename($imageDir . '/Gunstar Heroes (Japan)-artwork.png', $imageDir . '/Gunstar Heroes-artwork.png')) {
            echo "✓ Gunstar Heroes (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gunstar Heroes-artwork.png\n";
        $skipped++;
    }
}

// Gunstar Heroes (Japan) → Gunstar Heroes
if (file_exists($imageDir . '/Gunstar Heroes (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Gunstar Heroes-cover.png')) {
        if (rename($imageDir . '/Gunstar Heroes (Japan)-cover.png', $imageDir . '/Gunstar Heroes-cover.png')) {
            echo "✓ Gunstar Heroes (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gunstar Heroes-cover.png\n";
        $skipped++;
    }
}

// Gunstar Heroes (Japan) → Gunstar Heroes
if (file_exists($imageDir . '/Gunstar Heroes (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Gunstar Heroes-gameplay.png')) {
        if (rename($imageDir . '/Gunstar Heroes (Japan)-gameplay.png', $imageDir . '/Gunstar Heroes-gameplay.png')) {
            echo "✓ Gunstar Heroes (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Gunstar Heroes-gameplay.png\n";
        $skipped++;
    }
}

// Head Buster (Japan) → Head Buster
if (file_exists($imageDir . '/Head Buster (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Head Buster-artwork.png')) {
        if (rename($imageDir . '/Head Buster (Japan)-artwork.png', $imageDir . '/Head Buster-artwork.png')) {
            echo "✓ Head Buster (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Head Buster-artwork.png\n";
        $skipped++;
    }
}

// Head Buster (Japan) → Head Buster
if (file_exists($imageDir . '/Head Buster (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Head Buster-cover.png')) {
        if (rename($imageDir . '/Head Buster (Japan)-cover.png', $imageDir . '/Head Buster-cover.png')) {
            echo "✓ Head Buster (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Head Buster-cover.png\n";
        $skipped++;
    }
}

// Head Buster (Japan) → Head Buster
if (file_exists($imageDir . '/Head Buster (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Head Buster-gameplay.png')) {
        if (rename($imageDir . '/Head Buster (Japan)-gameplay.png', $imageDir . '/Head Buster-gameplay.png')) {
            echo "✓ Head Buster (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Head Buster-gameplay.png\n";
        $skipped++;
    }
}

// Heavy Weight Champ (Japan) → Heavy Weight Champ
if (file_exists($imageDir . '/Heavy Weight Champ (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Heavy Weight Champ-artwork.png')) {
        if (rename($imageDir . '/Heavy Weight Champ (Japan)-artwork.png', $imageDir . '/Heavy Weight Champ-artwork.png')) {
            echo "✓ Heavy Weight Champ (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Heavy Weight Champ-artwork.png\n";
        $skipped++;
    }
}

// Heavy Weight Champ (Japan) → Heavy Weight Champ
if (file_exists($imageDir . '/Heavy Weight Champ (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Heavy Weight Champ-cover.png')) {
        if (rename($imageDir . '/Heavy Weight Champ (Japan)-cover.png', $imageDir . '/Heavy Weight Champ-cover.png')) {
            echo "✓ Heavy Weight Champ (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Heavy Weight Champ-cover.png\n";
        $skipped++;
    }
}

// Heavy Weight Champ (Japan) → Heavy Weight Champ
if (file_exists($imageDir . '/Heavy Weight Champ (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Heavy Weight Champ-gameplay.png')) {
        if (rename($imageDir . '/Heavy Weight Champ (Japan)-gameplay.png', $imageDir . '/Heavy Weight Champ-gameplay.png')) {
            echo "✓ Heavy Weight Champ (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Heavy Weight Champ-gameplay.png\n";
        $skipped++;
    }
}

// Honoo no Toukyuuji - Dodge Danpei (Japan) → Honoo no Toukyuuji - Dodge Danpei
if (file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei-artwork.png')) {
        if (rename($imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-artwork.png', $imageDir . '/Honoo no Toukyuuji - Dodge Danpei-artwork.png')) {
            echo "✓ Honoo no Toukyuuji - Dodge Danpei (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Honoo no Toukyuuji - Dodge Danpei-artwork.png\n";
        $skipped++;
    }
}

// Honoo no Toukyuuji - Dodge Danpei (Japan) → Honoo no Toukyuuji - Dodge Danpei
if (file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei-cover.png')) {
        if (rename($imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-cover.png', $imageDir . '/Honoo no Toukyuuji - Dodge Danpei-cover.png')) {
            echo "✓ Honoo no Toukyuuji - Dodge Danpei (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Honoo no Toukyuuji - Dodge Danpei-cover.png\n";
        $skipped++;
    }
}

// Honoo no Toukyuuji - Dodge Danpei (Japan) → Honoo no Toukyuuji - Dodge Danpei
if (file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Honoo no Toukyuuji - Dodge Danpei-gameplay.png')) {
        if (rename($imageDir . '/Honoo no Toukyuuji - Dodge Danpei (Japan)-gameplay.png', $imageDir . '/Honoo no Toukyuuji - Dodge Danpei-gameplay.png')) {
            echo "✓ Honoo no Toukyuuji - Dodge Danpei (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Honoo no Toukyuuji - Dodge Danpei-gameplay.png\n";
        $skipped++;
    }
}

// Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan) → Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai
if (file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-artwork.png')) {
        if (rename($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-artwork.png', $imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-artwork.png')) {
            echo "✓ Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-artwork.png\n";
        $skipped++;
    }
}

// Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan) → Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai
if (file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-cover.png')) {
        if (rename($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-cover.png', $imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-cover.png')) {
            echo "✓ Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-cover.png\n";
        $skipped++;
    }
}

// Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan) → Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai
if (file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-gameplay.png')) {
        if (rename($imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-gameplay.png', $imageDir . '/Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-gameplay.png')) {
            echo "✓ Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Hyokkori Hyoutan-jima - Hyoutan-jima no Daikoukai-gameplay.png\n";
        $skipped++;
    }
}

// In the Wake of Vampire (Japan) (En) → In the Wake of Vampire
if (file_exists($imageDir . '/In the Wake of Vampire (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/In the Wake of Vampire-artwork.png')) {
        if (rename($imageDir . '/In the Wake of Vampire (Japan) (En)-artwork.png', $imageDir . '/In the Wake of Vampire-artwork.png')) {
            echo "✓ In the Wake of Vampire (Japan) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: In the Wake of Vampire-artwork.png\n";
        $skipped++;
    }
}

// In the Wake of Vampire (Japan) (En) → In the Wake of Vampire
if (file_exists($imageDir . '/In the Wake of Vampire (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/In the Wake of Vampire-cover.png')) {
        if (rename($imageDir . '/In the Wake of Vampire (Japan) (En)-cover.png', $imageDir . '/In the Wake of Vampire-cover.png')) {
            echo "✓ In the Wake of Vampire (Japan) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: In the Wake of Vampire-cover.png\n";
        $skipped++;
    }
}

// In the Wake of Vampire (Japan) (En) → In the Wake of Vampire
if (file_exists($imageDir . '/In the Wake of Vampire (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/In the Wake of Vampire-gameplay.png')) {
        if (rename($imageDir . '/In the Wake of Vampire (Japan) (En)-gameplay.png', $imageDir . '/In the Wake of Vampire-gameplay.png')) {
            echo "✓ In the Wake of Vampire (Japan) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: In the Wake of Vampire-gameplay.png\n";
        $skipped++;
    }
}

// Incredible Crash Dummies, The (World) → Incredible Crash Dummies, The
if (file_exists($imageDir . '/Incredible Crash Dummies, The (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Incredible Crash Dummies, The-artwork.png')) {
        if (rename($imageDir . '/Incredible Crash Dummies, The (World)-artwork.png', $imageDir . '/Incredible Crash Dummies, The-artwork.png')) {
            echo "✓ Incredible Crash Dummies, The (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Crash Dummies, The-artwork.png\n";
        $skipped++;
    }
}

// Incredible Crash Dummies, The (World) → Incredible Crash Dummies, The
if (file_exists($imageDir . '/Incredible Crash Dummies, The (World)-cover.png')) {
    if (!file_exists($imageDir . '/Incredible Crash Dummies, The-cover.png')) {
        if (rename($imageDir . '/Incredible Crash Dummies, The (World)-cover.png', $imageDir . '/Incredible Crash Dummies, The-cover.png')) {
            echo "✓ Incredible Crash Dummies, The (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Crash Dummies, The-cover.png\n";
        $skipped++;
    }
}

// Incredible Crash Dummies, The (World) → Incredible Crash Dummies, The
if (file_exists($imageDir . '/Incredible Crash Dummies, The (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Incredible Crash Dummies, The-gameplay.png')) {
        if (rename($imageDir . '/Incredible Crash Dummies, The (World)-gameplay.png', $imageDir . '/Incredible Crash Dummies, The-gameplay.png')) {
            echo "✓ Incredible Crash Dummies, The (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Crash Dummies, The-gameplay.png\n";
        $skipped++;
    }
}

// Incredible Hulk, The (USA, Europe) → Incredible Hulk, The
if (file_exists($imageDir . '/Incredible Hulk, The (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Incredible Hulk, The-artwork.png')) {
        if (rename($imageDir . '/Incredible Hulk, The (USA, Europe)-artwork.png', $imageDir . '/Incredible Hulk, The-artwork.png')) {
            echo "✓ Incredible Hulk, The (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Hulk, The-artwork.png\n";
        $skipped++;
    }
}

// Incredible Hulk, The (USA, Europe) → Incredible Hulk, The
if (file_exists($imageDir . '/Incredible Hulk, The (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Incredible Hulk, The-cover.png')) {
        if (rename($imageDir . '/Incredible Hulk, The (USA, Europe)-cover.png', $imageDir . '/Incredible Hulk, The-cover.png')) {
            echo "✓ Incredible Hulk, The (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Hulk, The-cover.png\n";
        $skipped++;
    }
}

// Incredible Hulk, The (USA, Europe) → Incredible Hulk, The
if (file_exists($imageDir . '/Incredible Hulk, The (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Incredible Hulk, The-gameplay.png')) {
        if (rename($imageDir . '/Incredible Hulk, The (USA, Europe)-gameplay.png', $imageDir . '/Incredible Hulk, The-gameplay.png')) {
            echo "✓ Incredible Hulk, The (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Incredible Hulk, The-gameplay.png\n";
        $skipped++;
    }
}

// Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En) → Indiana Jones and the Last Crusade
if (file_exists($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Indiana Jones and the Last Crusade-artwork.png')) {
        if (rename($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En)-artwork.png', $imageDir . '/Indiana Jones and the Last Crusade-artwork.png')) {
            echo "✓ Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Indiana Jones and the Last Crusade-artwork.png\n";
        $skipped++;
    }
}

// Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En) → Indiana Jones and the Last Crusade
if (file_exists($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Indiana Jones and the Last Crusade-cover.png')) {
        if (rename($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En)-cover.png', $imageDir . '/Indiana Jones and the Last Crusade-cover.png')) {
            echo "✓ Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Indiana Jones and the Last Crusade-cover.png\n";
        $skipped++;
    }
}

// Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En) → Indiana Jones and the Last Crusade
if (file_exists($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Indiana Jones and the Last Crusade-gameplay.png')) {
        if (rename($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En)-gameplay.png', $imageDir . '/Indiana Jones and the Last Crusade-gameplay.png')) {
            echo "✓ Indiana Jones and the Last Crusade (USA, Europe, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Indiana Jones and the Last Crusade-gameplay.png\n";
        $skipped++;
    }
}

// Indiana Jones and the Last Crusade (USA, Europe, Brazil) → Indiana Jones and the Last Crusade
if (file_exists($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Indiana Jones and the Last Crusade-cover.png')) {
        if (rename($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil)-cover.png', $imageDir . '/Indiana Jones and the Last Crusade-cover.png')) {
            echo "✓ Indiana Jones and the Last Crusade (USA, Europe, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Indiana Jones and the Last Crusade-cover.png\n";
        $skipped++;
    }
}

// Indiana Jones and the Last Crusade (USA, Europe, Brazil) → Indiana Jones and the Last Crusade
if (file_exists($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Indiana Jones and the Last Crusade-gameplay.png')) {
        if (rename($imageDir . '/Indiana Jones and the Last Crusade (USA, Europe, Brazil)-gameplay.png', $imageDir . '/Indiana Jones and the Last Crusade-gameplay.png')) {
            echo "✓ Indiana Jones and the Last Crusade (USA, Europe, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Indiana Jones and the Last Crusade-gameplay.png\n";
        $skipped++;
    }
}

// Iron Man X-O Manowar in Heavy Metal (USA) → Iron Man X-O Manowar in Heavy Metal
if (file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal-artwork.png')) {
        if (rename($imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-artwork.png', $imageDir . '/Iron Man X-O Manowar in Heavy Metal-artwork.png')) {
            echo "✓ Iron Man X-O Manowar in Heavy Metal (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Iron Man X-O Manowar in Heavy Metal-artwork.png\n";
        $skipped++;
    }
}

// Iron Man X-O Manowar in Heavy Metal (USA) → Iron Man X-O Manowar in Heavy Metal
if (file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal-cover.png')) {
        if (rename($imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-cover.png', $imageDir . '/Iron Man X-O Manowar in Heavy Metal-cover.png')) {
            echo "✓ Iron Man X-O Manowar in Heavy Metal (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Iron Man X-O Manowar in Heavy Metal-cover.png\n";
        $skipped++;
    }
}

// Iron Man X-O Manowar in Heavy Metal (USA) → Iron Man X-O Manowar in Heavy Metal
if (file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Iron Man X-O Manowar in Heavy Metal-gameplay.png')) {
        if (rename($imageDir . '/Iron Man X-O Manowar in Heavy Metal (USA)-gameplay.png', $imageDir . '/Iron Man X-O Manowar in Heavy Metal-gameplay.png')) {
            echo "✓ Iron Man X-O Manowar in Heavy Metal (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Iron Man X-O Manowar in Heavy Metal-gameplay.png\n";
        $skipped++;
    }
}

// Itchy _ Scratchy Game, The (USA, Europe) → Itchy _ Scratchy Game, The
if (file_exists($imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Itchy _ Scratchy Game, The-artwork.png')) {
        if (rename($imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-artwork.png', $imageDir . '/Itchy _ Scratchy Game, The-artwork.png')) {
            echo "✓ Itchy _ Scratchy Game, The (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Itchy _ Scratchy Game, The-artwork.png\n";
        $skipped++;
    }
}

// Itchy _ Scratchy Game, The (USA, Europe) → Itchy _ Scratchy Game, The
if (file_exists($imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Itchy _ Scratchy Game, The-cover.png')) {
        if (rename($imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-cover.png', $imageDir . '/Itchy _ Scratchy Game, The-cover.png')) {
            echo "✓ Itchy _ Scratchy Game, The (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Itchy _ Scratchy Game, The-cover.png\n";
        $skipped++;
    }
}

// Itchy _ Scratchy Game, The (USA, Europe) → Itchy _ Scratchy Game, The
if (file_exists($imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Itchy _ Scratchy Game, The-gameplay.png')) {
        if (rename($imageDir . '/Itchy _ Scratchy Game, The (USA, Europe)-gameplay.png', $imageDir . '/Itchy _ Scratchy Game, The-gameplay.png')) {
            echo "✓ Itchy _ Scratchy Game, The (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Itchy _ Scratchy Game, The-gameplay.png\n";
        $skipped++;
    }
}

// James Bond 007 - The Duel (Europe) → James Bond 007 - The Duel
if (file_exists($imageDir . '/James Bond 007 - The Duel (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/James Bond 007 - The Duel-artwork.png')) {
        if (rename($imageDir . '/James Bond 007 - The Duel (Europe)-artwork.png', $imageDir . '/James Bond 007 - The Duel-artwork.png')) {
            echo "✓ James Bond 007 - The Duel (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Bond 007 - The Duel-artwork.png\n";
        $skipped++;
    }
}

// James Bond 007 - The Duel (Europe) → James Bond 007 - The Duel
if (file_exists($imageDir . '/James Bond 007 - The Duel (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/James Bond 007 - The Duel-cover.png')) {
        if (rename($imageDir . '/James Bond 007 - The Duel (Europe)-cover.png', $imageDir . '/James Bond 007 - The Duel-cover.png')) {
            echo "✓ James Bond 007 - The Duel (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Bond 007 - The Duel-cover.png\n";
        $skipped++;
    }
}

// James Bond 007 - The Duel (Europe) → James Bond 007 - The Duel
if (file_exists($imageDir . '/James Bond 007 - The Duel (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/James Bond 007 - The Duel-gameplay.png')) {
        if (rename($imageDir . '/James Bond 007 - The Duel (Europe)-gameplay.png', $imageDir . '/James Bond 007 - The Duel-gameplay.png')) {
            echo "✓ James Bond 007 - The Duel (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Bond 007 - The Duel-gameplay.png\n";
        $skipped++;
    }
}

// James Pond 3 - Operation Starfi5h (Europe) → James Pond 3 - Operation Starfi5h
if (file_exists($imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/James Pond 3 - Operation Starfi5h-artwork.png')) {
        if (rename($imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-artwork.png', $imageDir . '/James Pond 3 - Operation Starfi5h-artwork.png')) {
            echo "✓ James Pond 3 - Operation Starfi5h (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond 3 - Operation Starfi5h-artwork.png\n";
        $skipped++;
    }
}

// James Pond 3 - Operation Starfi5h (Europe) → James Pond 3 - Operation Starfi5h
if (file_exists($imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/James Pond 3 - Operation Starfi5h-cover.png')) {
        if (rename($imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-cover.png', $imageDir . '/James Pond 3 - Operation Starfi5h-cover.png')) {
            echo "✓ James Pond 3 - Operation Starfi5h (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond 3 - Operation Starfi5h-cover.png\n";
        $skipped++;
    }
}

// James Pond 3 - Operation Starfi5h (Europe) → James Pond 3 - Operation Starfi5h
if (file_exists($imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/James Pond 3 - Operation Starfi5h-gameplay.png')) {
        if (rename($imageDir . '/James Pond 3 - Operation Starfi5h (Europe)-gameplay.png', $imageDir . '/James Pond 3 - Operation Starfi5h-gameplay.png')) {
            echo "✓ James Pond 3 - Operation Starfi5h (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond 3 - Operation Starfi5h-gameplay.png\n";
        $skipped++;
    }
}

// James Pond II - Codename RoboCod (Europe) → James Pond II - Codename RoboCod
if (file_exists($imageDir . '/James Pond II - Codename RoboCod (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/James Pond II - Codename RoboCod-artwork.png')) {
        if (rename($imageDir . '/James Pond II - Codename RoboCod (Europe)-artwork.png', $imageDir . '/James Pond II - Codename RoboCod-artwork.png')) {
            echo "✓ James Pond II - Codename RoboCod (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond II - Codename RoboCod-artwork.png\n";
        $skipped++;
    }
}

// James Pond II - Codename RoboCod (Europe) → James Pond II - Codename RoboCod
if (file_exists($imageDir . '/James Pond II - Codename RoboCod (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/James Pond II - Codename RoboCod-cover.png')) {
        if (rename($imageDir . '/James Pond II - Codename RoboCod (Europe)-cover.png', $imageDir . '/James Pond II - Codename RoboCod-cover.png')) {
            echo "✓ James Pond II - Codename RoboCod (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond II - Codename RoboCod-cover.png\n";
        $skipped++;
    }
}

// James Pond II - Codename RoboCod (Europe) → James Pond II - Codename RoboCod
if (file_exists($imageDir . '/James Pond II - Codename RoboCod (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/James Pond II - Codename RoboCod-gameplay.png')) {
        if (rename($imageDir . '/James Pond II - Codename RoboCod (Europe)-gameplay.png', $imageDir . '/James Pond II - Codename RoboCod-gameplay.png')) {
            echo "✓ James Pond II - Codename RoboCod (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond II - Codename RoboCod-gameplay.png\n";
        $skipped++;
    }
}

// James Pond II - Codename RoboCod (USA) → James Pond II - Codename RoboCod
if (file_exists($imageDir . '/James Pond II - Codename RoboCod (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/James Pond II - Codename RoboCod-artwork.png')) {
        if (rename($imageDir . '/James Pond II - Codename RoboCod (USA)-artwork.png', $imageDir . '/James Pond II - Codename RoboCod-artwork.png')) {
            echo "✓ James Pond II - Codename RoboCod (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond II - Codename RoboCod-artwork.png\n";
        $skipped++;
    }
}

// James Pond II - Codename RoboCod (USA) → James Pond II - Codename RoboCod
if (file_exists($imageDir . '/James Pond II - Codename RoboCod (USA)-cover.png')) {
    if (!file_exists($imageDir . '/James Pond II - Codename RoboCod-cover.png')) {
        if (rename($imageDir . '/James Pond II - Codename RoboCod (USA)-cover.png', $imageDir . '/James Pond II - Codename RoboCod-cover.png')) {
            echo "✓ James Pond II - Codename RoboCod (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond II - Codename RoboCod-cover.png\n";
        $skipped++;
    }
}

// James Pond II - Codename RoboCod (USA) → James Pond II - Codename RoboCod
if (file_exists($imageDir . '/James Pond II - Codename RoboCod (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/James Pond II - Codename RoboCod-gameplay.png')) {
        if (rename($imageDir . '/James Pond II - Codename RoboCod (USA)-gameplay.png', $imageDir . '/James Pond II - Codename RoboCod-gameplay.png')) {
            echo "✓ James Pond II - Codename RoboCod (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: James Pond II - Codename RoboCod-gameplay.png\n";
        $skipped++;
    }
}

// Joe Montana Football (USA, Europe) → Joe Montana Football
if (file_exists($imageDir . '/Joe Montana Football (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Joe Montana Football-artwork.png')) {
        if (rename($imageDir . '/Joe Montana Football (USA, Europe)-artwork.png', $imageDir . '/Joe Montana Football-artwork.png')) {
            echo "✓ Joe Montana Football (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Joe Montana Football-artwork.png\n";
        $skipped++;
    }
}

// Joe Montana Football (USA, Europe) → Joe Montana Football
if (file_exists($imageDir . '/Joe Montana Football (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Joe Montana Football-cover.png')) {
        if (rename($imageDir . '/Joe Montana Football (USA, Europe)-cover.png', $imageDir . '/Joe Montana Football-cover.png')) {
            echo "✓ Joe Montana Football (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Joe Montana Football-cover.png\n";
        $skipped++;
    }
}

// Joe Montana Football (USA, Europe) → Joe Montana Football
if (file_exists($imageDir . '/Joe Montana Football (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Joe Montana Football-gameplay.png')) {
        if (rename($imageDir . '/Joe Montana Football (USA, Europe)-gameplay.png', $imageDir . '/Joe Montana Football-gameplay.png')) {
            echo "✓ Joe Montana Football (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Joe Montana Football-gameplay.png\n";
        $skipped++;
    }
}

// Journey from Darkness - Strider Returns (USA, Europe) → Journey from Darkness - Strider Returns
if (file_exists($imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Journey from Darkness - Strider Returns-artwork.png')) {
        if (rename($imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-artwork.png', $imageDir . '/Journey from Darkness - Strider Returns-artwork.png')) {
            echo "✓ Journey from Darkness - Strider Returns (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Journey from Darkness - Strider Returns-artwork.png\n";
        $skipped++;
    }
}

// Journey from Darkness - Strider Returns (USA, Europe) → Journey from Darkness - Strider Returns
if (file_exists($imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Journey from Darkness - Strider Returns-cover.png')) {
        if (rename($imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-cover.png', $imageDir . '/Journey from Darkness - Strider Returns-cover.png')) {
            echo "✓ Journey from Darkness - Strider Returns (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Journey from Darkness - Strider Returns-cover.png\n";
        $skipped++;
    }
}

// Journey from Darkness - Strider Returns (USA, Europe) → Journey from Darkness - Strider Returns
if (file_exists($imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Journey from Darkness - Strider Returns-gameplay.png')) {
        if (rename($imageDir . '/Journey from Darkness - Strider Returns (USA, Europe)-gameplay.png', $imageDir . '/Journey from Darkness - Strider Returns-gameplay.png')) {
            echo "✓ Journey from Darkness - Strider Returns (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Journey from Darkness - Strider Returns-gameplay.png\n";
        $skipped++;
    }
}

// Junction (USA) → Junction
if (file_exists($imageDir . '/Junction (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Junction-artwork.png')) {
        if (rename($imageDir . '/Junction (USA)-artwork.png', $imageDir . '/Junction-artwork.png')) {
            echo "✓ Junction (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Junction-artwork.png\n";
        $skipped++;
    }
}

// Junction (USA) → Junction
if (file_exists($imageDir . '/Junction (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Junction-cover.png')) {
        if (rename($imageDir . '/Junction (USA)-cover.png', $imageDir . '/Junction-cover.png')) {
            echo "✓ Junction (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Junction-cover.png\n";
        $skipped++;
    }
}

// Junction (USA) → Junction
if (file_exists($imageDir . '/Junction (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Junction-gameplay.png')) {
        if (rename($imageDir . '/Junction (USA)-gameplay.png', $imageDir . '/Junction-gameplay.png')) {
            echo "✓ Junction (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Junction-gameplay.png\n";
        $skipped++;
    }
}

// Jungle Book, The (Europe) → Jungle Book, The
if (file_exists($imageDir . '/Jungle Book, The (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Jungle Book, The-artwork.png')) {
        if (rename($imageDir . '/Jungle Book, The (Europe)-artwork.png', $imageDir . '/Jungle Book, The-artwork.png')) {
            echo "✓ Jungle Book, The (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Book, The-artwork.png\n";
        $skipped++;
    }
}

// Jungle Book, The (Europe) → Jungle Book, The
if (file_exists($imageDir . '/Jungle Book, The (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Jungle Book, The-cover.png')) {
        if (rename($imageDir . '/Jungle Book, The (Europe)-cover.png', $imageDir . '/Jungle Book, The-cover.png')) {
            echo "✓ Jungle Book, The (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Book, The-cover.png\n";
        $skipped++;
    }
}

// Jungle Book, The (Europe) → Jungle Book, The
if (file_exists($imageDir . '/Jungle Book, The (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Jungle Book, The-gameplay.png')) {
        if (rename($imageDir . '/Jungle Book, The (Europe)-gameplay.png', $imageDir . '/Jungle Book, The-gameplay.png')) {
            echo "✓ Jungle Book, The (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Book, The-gameplay.png\n";
        $skipped++;
    }
}

// Jungle Book, The (USA) → Jungle Book, The
if (file_exists($imageDir . '/Jungle Book, The (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Jungle Book, The-artwork.png')) {
        if (rename($imageDir . '/Jungle Book, The (USA)-artwork.png', $imageDir . '/Jungle Book, The-artwork.png')) {
            echo "✓ Jungle Book, The (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Book, The-artwork.png\n";
        $skipped++;
    }
}

// Jungle Book, The (USA) → Jungle Book, The
if (file_exists($imageDir . '/Jungle Book, The (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Jungle Book, The-cover.png')) {
        if (rename($imageDir . '/Jungle Book, The (USA)-cover.png', $imageDir . '/Jungle Book, The-cover.png')) {
            echo "✓ Jungle Book, The (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Book, The-cover.png\n";
        $skipped++;
    }
}

// Jungle Book, The (USA) → Jungle Book, The
if (file_exists($imageDir . '/Jungle Book, The (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Jungle Book, The-gameplay.png')) {
        if (rename($imageDir . '/Jungle Book, The (USA)-gameplay.png', $imageDir . '/Jungle Book, The-gameplay.png')) {
            echo "✓ Jungle Book, The (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Book, The-gameplay.png\n";
        $skipped++;
    }
}

// Jungle Strike (USA) → Jungle Strike
if (file_exists($imageDir . '/Jungle Strike (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Jungle Strike-artwork.png')) {
        if (rename($imageDir . '/Jungle Strike (USA)-artwork.png', $imageDir . '/Jungle Strike-artwork.png')) {
            echo "✓ Jungle Strike (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Strike-artwork.png\n";
        $skipped++;
    }
}

// Jungle Strike (USA) → Jungle Strike
if (file_exists($imageDir . '/Jungle Strike (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Jungle Strike-cover.png')) {
        if (rename($imageDir . '/Jungle Strike (USA)-cover.png', $imageDir . '/Jungle Strike-cover.png')) {
            echo "✓ Jungle Strike (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Strike-cover.png\n";
        $skipped++;
    }
}

// Jungle Strike (USA) → Jungle Strike
if (file_exists($imageDir . '/Jungle Strike (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Jungle Strike-gameplay.png')) {
        if (rename($imageDir . '/Jungle Strike (USA)-gameplay.png', $imageDir . '/Jungle Strike-gameplay.png')) {
            echo "✓ Jungle Strike (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jungle Strike-gameplay.png\n";
        $skipped++;
    }
}

// Jurassic Park (Japan) → Jurassic Park
if (file_exists($imageDir . '/Jurassic Park (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Jurassic Park-artwork.png')) {
        if (rename($imageDir . '/Jurassic Park (Japan)-artwork.png', $imageDir . '/Jurassic Park-artwork.png')) {
            echo "✓ Jurassic Park (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jurassic Park-artwork.png\n";
        $skipped++;
    }
}

// Jurassic Park (Japan) → Jurassic Park
if (file_exists($imageDir . '/Jurassic Park (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Jurassic Park-cover.png')) {
        if (rename($imageDir . '/Jurassic Park (Japan)-cover.png', $imageDir . '/Jurassic Park-cover.png')) {
            echo "✓ Jurassic Park (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jurassic Park-cover.png\n";
        $skipped++;
    }
}

// Jurassic Park (Japan) → Jurassic Park
if (file_exists($imageDir . '/Jurassic Park (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Jurassic Park-gameplay.png')) {
        if (rename($imageDir . '/Jurassic Park (Japan)-gameplay.png', $imageDir . '/Jurassic Park-gameplay.png')) {
            echo "✓ Jurassic Park (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Jurassic Park-gameplay.png\n";
        $skipped++;
    }
}

// Kaitou Saint Tail (Japan) → Kaitou Saint Tail
if (file_exists($imageDir . '/Kaitou Saint Tail (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Kaitou Saint Tail-artwork.png')) {
        if (rename($imageDir . '/Kaitou Saint Tail (Japan)-artwork.png', $imageDir . '/Kaitou Saint Tail-artwork.png')) {
            echo "✓ Kaitou Saint Tail (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kaitou Saint Tail-artwork.png\n";
        $skipped++;
    }
}

// Kaitou Saint Tail (Japan) → Kaitou Saint Tail
if (file_exists($imageDir . '/Kaitou Saint Tail (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Kaitou Saint Tail-cover.png')) {
        if (rename($imageDir . '/Kaitou Saint Tail (Japan)-cover.png', $imageDir . '/Kaitou Saint Tail-cover.png')) {
            echo "✓ Kaitou Saint Tail (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kaitou Saint Tail-cover.png\n";
        $skipped++;
    }
}

// Kaitou Saint Tail (Japan) → Kaitou Saint Tail
if (file_exists($imageDir . '/Kaitou Saint Tail (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Kaitou Saint Tail-gameplay.png')) {
        if (rename($imageDir . '/Kaitou Saint Tail (Japan)-gameplay.png', $imageDir . '/Kaitou Saint Tail-gameplay.png')) {
            echo "✓ Kaitou Saint Tail (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kaitou Saint Tail-gameplay.png\n";
        $skipped++;
    }
}

// Kawasaki Superbike Challenge (Europe) → Kawasaki Superbike Challenge
if (file_exists($imageDir . '/Kawasaki Superbike Challenge (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Kawasaki Superbike Challenge-artwork.png')) {
        if (rename($imageDir . '/Kawasaki Superbike Challenge (Europe)-artwork.png', $imageDir . '/Kawasaki Superbike Challenge-artwork.png')) {
            echo "✓ Kawasaki Superbike Challenge (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kawasaki Superbike Challenge-artwork.png\n";
        $skipped++;
    }
}

// Kawasaki Superbike Challenge (Europe) → Kawasaki Superbike Challenge
if (file_exists($imageDir . '/Kawasaki Superbike Challenge (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Kawasaki Superbike Challenge-cover.png')) {
        if (rename($imageDir . '/Kawasaki Superbike Challenge (Europe)-cover.png', $imageDir . '/Kawasaki Superbike Challenge-cover.png')) {
            echo "✓ Kawasaki Superbike Challenge (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kawasaki Superbike Challenge-cover.png\n";
        $skipped++;
    }
}

// Kawasaki Superbike Challenge (Europe) → Kawasaki Superbike Challenge
if (file_exists($imageDir . '/Kawasaki Superbike Challenge (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Kawasaki Superbike Challenge-gameplay.png')) {
        if (rename($imageDir . '/Kawasaki Superbike Challenge (Europe)-gameplay.png', $imageDir . '/Kawasaki Superbike Challenge-gameplay.png')) {
            echo "✓ Kawasaki Superbike Challenge (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kawasaki Superbike Challenge-gameplay.png\n";
        $skipped++;
    }
}

// Kawasaki Superbike Challenge (USA) → Kawasaki Superbike Challenge
if (file_exists($imageDir . '/Kawasaki Superbike Challenge (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Kawasaki Superbike Challenge-artwork.png')) {
        if (rename($imageDir . '/Kawasaki Superbike Challenge (USA)-artwork.png', $imageDir . '/Kawasaki Superbike Challenge-artwork.png')) {
            echo "✓ Kawasaki Superbike Challenge (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kawasaki Superbike Challenge-artwork.png\n";
        $skipped++;
    }
}

// Kawasaki Superbike Challenge (USA) → Kawasaki Superbike Challenge
if (file_exists($imageDir . '/Kawasaki Superbike Challenge (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Kawasaki Superbike Challenge-cover.png')) {
        if (rename($imageDir . '/Kawasaki Superbike Challenge (USA)-cover.png', $imageDir . '/Kawasaki Superbike Challenge-cover.png')) {
            echo "✓ Kawasaki Superbike Challenge (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kawasaki Superbike Challenge-cover.png\n";
        $skipped++;
    }
}

// Kawasaki Superbike Challenge (USA) → Kawasaki Superbike Challenge
if (file_exists($imageDir . '/Kawasaki Superbike Challenge (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Kawasaki Superbike Challenge-gameplay.png')) {
        if (rename($imageDir . '/Kawasaki Superbike Challenge (USA)-gameplay.png', $imageDir . '/Kawasaki Superbike Challenge-gameplay.png')) {
            echo "✓ Kawasaki Superbike Challenge (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kawasaki Superbike Challenge-gameplay.png\n";
        $skipped++;
    }
}

// Kenyuu Densetsu Yaiba (Japan) → Kenyuu Densetsu Yaiba
if (file_exists($imageDir . '/Kenyuu Densetsu Yaiba (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Kenyuu Densetsu Yaiba-artwork.png')) {
        if (rename($imageDir . '/Kenyuu Densetsu Yaiba (Japan)-artwork.png', $imageDir . '/Kenyuu Densetsu Yaiba-artwork.png')) {
            echo "✓ Kenyuu Densetsu Yaiba (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kenyuu Densetsu Yaiba-artwork.png\n";
        $skipped++;
    }
}

// Kenyuu Densetsu Yaiba (Japan) → Kenyuu Densetsu Yaiba
if (file_exists($imageDir . '/Kenyuu Densetsu Yaiba (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Kenyuu Densetsu Yaiba-cover.png')) {
        if (rename($imageDir . '/Kenyuu Densetsu Yaiba (Japan)-cover.png', $imageDir . '/Kenyuu Densetsu Yaiba-cover.png')) {
            echo "✓ Kenyuu Densetsu Yaiba (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kenyuu Densetsu Yaiba-cover.png\n";
        $skipped++;
    }
}

// Kenyuu Densetsu Yaiba (Japan) → Kenyuu Densetsu Yaiba
if (file_exists($imageDir . '/Kenyuu Densetsu Yaiba (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Kenyuu Densetsu Yaiba-gameplay.png')) {
        if (rename($imageDir . '/Kenyuu Densetsu Yaiba (Japan)-gameplay.png', $imageDir . '/Kenyuu Densetsu Yaiba-gameplay.png')) {
            echo "✓ Kenyuu Densetsu Yaiba (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kenyuu Densetsu Yaiba-gameplay.png\n";
        $skipped++;
    }
}

// Kick _ Rush (Japan) → Kick _ Rush
if (file_exists($imageDir . '/Kick _ Rush (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Kick _ Rush-artwork.png')) {
        if (rename($imageDir . '/Kick _ Rush (Japan)-artwork.png', $imageDir . '/Kick _ Rush-artwork.png')) {
            echo "✓ Kick _ Rush (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kick _ Rush-artwork.png\n";
        $skipped++;
    }
}

// Kick _ Rush (Japan) → Kick _ Rush
if (file_exists($imageDir . '/Kick _ Rush (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Kick _ Rush-cover.png')) {
        if (rename($imageDir . '/Kick _ Rush (Japan)-cover.png', $imageDir . '/Kick _ Rush-cover.png')) {
            echo "✓ Kick _ Rush (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kick _ Rush-cover.png\n";
        $skipped++;
    }
}

// Kick _ Rush (Japan) → Kick _ Rush
if (file_exists($imageDir . '/Kick _ Rush (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Kick _ Rush-gameplay.png')) {
        if (rename($imageDir . '/Kick _ Rush (Japan)-gameplay.png', $imageDir . '/Kick _ Rush-gameplay.png')) {
            echo "✓ Kick _ Rush (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kick _ Rush-gameplay.png\n";
        $skipped++;
    }
}

// Kinetic Connection (Japan) (En) → Kinetic Connection
if (file_exists($imageDir . '/Kinetic Connection (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Kinetic Connection-artwork.png')) {
        if (rename($imageDir . '/Kinetic Connection (Japan) (En)-artwork.png', $imageDir . '/Kinetic Connection-artwork.png')) {
            echo "✓ Kinetic Connection (Japan) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kinetic Connection-artwork.png\n";
        $skipped++;
    }
}

// Kinetic Connection (Japan) (En) → Kinetic Connection
if (file_exists($imageDir . '/Kinetic Connection (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Kinetic Connection-cover.png')) {
        if (rename($imageDir . '/Kinetic Connection (Japan) (En)-cover.png', $imageDir . '/Kinetic Connection-cover.png')) {
            echo "✓ Kinetic Connection (Japan) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kinetic Connection-cover.png\n";
        $skipped++;
    }
}

// Kinetic Connection (Japan) (En) → Kinetic Connection
if (file_exists($imageDir . '/Kinetic Connection (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Kinetic Connection-gameplay.png')) {
        if (rename($imageDir . '/Kinetic Connection (Japan) (En)-gameplay.png', $imageDir . '/Kinetic Connection-gameplay.png')) {
            echo "✓ Kinetic Connection (Japan) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kinetic Connection-gameplay.png\n";
        $skipped++;
    }
}

// Kishin Douji Zenki (Japan) → Kishin Douji Zenki
if (file_exists($imageDir . '/Kishin Douji Zenki (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Kishin Douji Zenki-artwork.png')) {
        if (rename($imageDir . '/Kishin Douji Zenki (Japan)-artwork.png', $imageDir . '/Kishin Douji Zenki-artwork.png')) {
            echo "✓ Kishin Douji Zenki (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kishin Douji Zenki-artwork.png\n";
        $skipped++;
    }
}

// Kishin Douji Zenki (Japan) → Kishin Douji Zenki
if (file_exists($imageDir . '/Kishin Douji Zenki (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Kishin Douji Zenki-cover.png')) {
        if (rename($imageDir . '/Kishin Douji Zenki (Japan)-cover.png', $imageDir . '/Kishin Douji Zenki-cover.png')) {
            echo "✓ Kishin Douji Zenki (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kishin Douji Zenki-cover.png\n";
        $skipped++;
    }
}

// Kishin Douji Zenki (Japan) → Kishin Douji Zenki
if (file_exists($imageDir . '/Kishin Douji Zenki (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Kishin Douji Zenki-gameplay.png')) {
        if (rename($imageDir . '/Kishin Douji Zenki (Japan)-gameplay.png', $imageDir . '/Kishin Douji Zenki-gameplay.png')) {
            echo "✓ Kishin Douji Zenki (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kishin Douji Zenki-gameplay.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku (Japan) → Kuni-chan no Game Tengoku
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku-artwork.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku (Japan)-artwork.png', $imageDir . '/Kuni-chan no Game Tengoku-artwork.png')) {
            echo "✓ Kuni-chan no Game Tengoku (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku-artwork.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku (Japan) → Kuni-chan no Game Tengoku
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku-cover.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku (Japan)-cover.png', $imageDir . '/Kuni-chan no Game Tengoku-cover.png')) {
            echo "✓ Kuni-chan no Game Tengoku (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku-cover.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku (Japan) → Kuni-chan no Game Tengoku
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku-gameplay.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku (Japan)-gameplay.png', $imageDir . '/Kuni-chan no Game Tengoku-gameplay.png')) {
            echo "✓ Kuni-chan no Game Tengoku (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku-gameplay.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku Part 2 (Japan) → Kuni-chan no Game Tengoku Part 2
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2-artwork.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-artwork.png', $imageDir . '/Kuni-chan no Game Tengoku Part 2-artwork.png')) {
            echo "✓ Kuni-chan no Game Tengoku Part 2 (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku Part 2-artwork.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku Part 2 (Japan) → Kuni-chan no Game Tengoku Part 2
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2-cover.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-cover.png', $imageDir . '/Kuni-chan no Game Tengoku Part 2-cover.png')) {
            echo "✓ Kuni-chan no Game Tengoku Part 2 (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku Part 2-cover.png\n";
        $skipped++;
    }
}

// Kuni-chan no Game Tengoku Part 2 (Japan) → Kuni-chan no Game Tengoku Part 2
if (file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Kuni-chan no Game Tengoku Part 2-gameplay.png')) {
        if (rename($imageDir . '/Kuni-chan no Game Tengoku Part 2 (Japan)-gameplay.png', $imageDir . '/Kuni-chan no Game Tengoku Part 2-gameplay.png')) {
            echo "✓ Kuni-chan no Game Tengoku Part 2 (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Kuni-chan no Game Tengoku Part 2-gameplay.png\n";
        $skipped++;
    }
}

// Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En) → Land of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse-artwork.png')) {
        if (rename($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-artwork.png', $imageDir . '/Land of Illusion Starring Mickey Mouse-artwork.png')) {
            echo "✓ Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Land of Illusion Starring Mickey Mouse-artwork.png\n";
        $skipped++;
    }
}

// Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En) → Land of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse-cover.png')) {
        if (rename($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-cover.png', $imageDir . '/Land of Illusion Starring Mickey Mouse-cover.png')) {
            echo "✓ Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Land of Illusion Starring Mickey Mouse-cover.png\n";
        $skipped++;
    }
}

// Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En) → Land of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse-gameplay.png')) {
        if (rename($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-gameplay.png', $imageDir . '/Land of Illusion Starring Mickey Mouse-gameplay.png')) {
            echo "✓ Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Land of Illusion Starring Mickey Mouse-gameplay.png\n";
        $skipped++;
    }
}

// Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) → Land of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse-cover.png')) {
        if (rename($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png', $imageDir . '/Land of Illusion Starring Mickey Mouse-cover.png')) {
            echo "✓ Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Land of Illusion Starring Mickey Mouse-cover.png\n";
        $skipped++;
    }
}

// Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil) → Land of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Land of Illusion Starring Mickey Mouse-gameplay.png')) {
        if (rename($imageDir . '/Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png', $imageDir . '/Land of Illusion Starring Mickey Mouse-gameplay.png')) {
            echo "✓ Land of Illusion Starring Mickey Mouse (USA, Europe, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Land of Illusion Starring Mickey Mouse-gameplay.png\n";
        $skipped++;
    }
}

// Last Action Hero (USA) → Last Action Hero
if (file_exists($imageDir . '/Last Action Hero (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Last Action Hero-artwork.png')) {
        if (rename($imageDir . '/Last Action Hero (USA)-artwork.png', $imageDir . '/Last Action Hero-artwork.png')) {
            echo "✓ Last Action Hero (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Last Action Hero-artwork.png\n";
        $skipped++;
    }
}

// Last Action Hero (USA) → Last Action Hero
if (file_exists($imageDir . '/Last Action Hero (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Last Action Hero-cover.png')) {
        if (rename($imageDir . '/Last Action Hero (USA)-cover.png', $imageDir . '/Last Action Hero-cover.png')) {
            echo "✓ Last Action Hero (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Last Action Hero-cover.png\n";
        $skipped++;
    }
}

// Last Action Hero (USA) → Last Action Hero
if (file_exists($imageDir . '/Last Action Hero (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Last Action Hero-gameplay.png')) {
        if (rename($imageDir . '/Last Action Hero (USA)-gameplay.png', $imageDir . '/Last Action Hero-gameplay.png')) {
            echo "✓ Last Action Hero (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Last Action Hero-gameplay.png\n";
        $skipped++;
    }
}

// Legend of Illusion Starring Mickey Mouse (USA, Europe) → Legend of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse-artwork.png')) {
        if (rename($imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-artwork.png', $imageDir . '/Legend of Illusion Starring Mickey Mouse-artwork.png')) {
            echo "✓ Legend of Illusion Starring Mickey Mouse (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Legend of Illusion Starring Mickey Mouse-artwork.png\n";
        $skipped++;
    }
}

// Legend of Illusion Starring Mickey Mouse (USA, Europe) → Legend of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse-cover.png')) {
        if (rename($imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-cover.png', $imageDir . '/Legend of Illusion Starring Mickey Mouse-cover.png')) {
            echo "✓ Legend of Illusion Starring Mickey Mouse (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Legend of Illusion Starring Mickey Mouse-cover.png\n";
        $skipped++;
    }
}

// Legend of Illusion Starring Mickey Mouse (USA, Europe) → Legend of Illusion Starring Mickey Mouse
if (file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Legend of Illusion Starring Mickey Mouse-gameplay.png')) {
        if (rename($imageDir . '/Legend of Illusion Starring Mickey Mouse (USA, Europe)-gameplay.png', $imageDir . '/Legend of Illusion Starring Mickey Mouse-gameplay.png')) {
            echo "✓ Legend of Illusion Starring Mickey Mouse (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Legend of Illusion Starring Mickey Mouse-gameplay.png\n";
        $skipped++;
    }
}

// Lion King, The (Europe) → Lion King, The (Europe)[t +1 Mystic]
if (file_exists($imageDir . '/Lion King, The (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Lion King, The (Europe)[t +1 Mystic]-artwork.png')) {
        if (rename($imageDir . '/Lion King, The (Europe)-artwork.png', $imageDir . '/Lion King, The (Europe)[t +1 Mystic]-artwork.png')) {
            echo "✓ Lion King, The (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lion King, The (Europe)[t +1 Mystic]-artwork.png\n";
        $skipped++;
    }
}

// Lion King, The (Europe) → Lion King, The (Europe)[t +1 Mystic]
if (file_exists($imageDir . '/Lion King, The (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Lion King, The (Europe)[t +1 Mystic]-cover.png')) {
        if (rename($imageDir . '/Lion King, The (Europe)-cover.png', $imageDir . '/Lion King, The (Europe)[t +1 Mystic]-cover.png')) {
            echo "✓ Lion King, The (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lion King, The (Europe)[t +1 Mystic]-cover.png\n";
        $skipped++;
    }
}

// Lion King, The (Europe) → Lion King, The (Europe)[t +1 Mystic]
if (file_exists($imageDir . '/Lion King, The (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Lion King, The (Europe)[t +1 Mystic]-gameplay.png')) {
        if (rename($imageDir . '/Lion King, The (Europe)-gameplay.png', $imageDir . '/Lion King, The (Europe)[t +1 Mystic]-gameplay.png')) {
            echo "✓ Lion King, The (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lion King, The (Europe)[t +1 Mystic]-gameplay.png\n";
        $skipped++;
    }
}

// Lion King, The (Japan) → Lion King, The
if (file_exists($imageDir . '/Lion King, The (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Lion King, The-artwork.png')) {
        if (rename($imageDir . '/Lion King, The (Japan)-artwork.png', $imageDir . '/Lion King, The-artwork.png')) {
            echo "✓ Lion King, The (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lion King, The-artwork.png\n";
        $skipped++;
    }
}

// Lion King, The (Japan) → Lion King, The
if (file_exists($imageDir . '/Lion King, The (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Lion King, The-cover.png')) {
        if (rename($imageDir . '/Lion King, The (Japan)-cover.png', $imageDir . '/Lion King, The-cover.png')) {
            echo "✓ Lion King, The (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lion King, The-cover.png\n";
        $skipped++;
    }
}

// Lion King, The (Japan) → Lion King, The
if (file_exists($imageDir . '/Lion King, The (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Lion King, The-gameplay.png')) {
        if (rename($imageDir . '/Lion King, The (Japan)-gameplay.png', $imageDir . '/Lion King, The-gameplay.png')) {
            echo "✓ Lion King, The (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lion King, The-gameplay.png\n";
        $skipped++;
    }
}

// Lost World, The - Jurassic Park (USA) → Lost World, The - Jurassic Park
if (file_exists($imageDir . '/Lost World, The - Jurassic Park (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Lost World, The - Jurassic Park-artwork.png')) {
        if (rename($imageDir . '/Lost World, The - Jurassic Park (USA)-artwork.png', $imageDir . '/Lost World, The - Jurassic Park-artwork.png')) {
            echo "✓ Lost World, The - Jurassic Park (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lost World, The - Jurassic Park-artwork.png\n";
        $skipped++;
    }
}

// Lost World, The - Jurassic Park (USA) → Lost World, The - Jurassic Park
if (file_exists($imageDir . '/Lost World, The - Jurassic Park (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Lost World, The - Jurassic Park-cover.png')) {
        if (rename($imageDir . '/Lost World, The - Jurassic Park (USA)-cover.png', $imageDir . '/Lost World, The - Jurassic Park-cover.png')) {
            echo "✓ Lost World, The - Jurassic Park (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lost World, The - Jurassic Park-cover.png\n";
        $skipped++;
    }
}

// Lost World, The - Jurassic Park (USA) → Lost World, The - Jurassic Park
if (file_exists($imageDir . '/Lost World, The - Jurassic Park (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Lost World, The - Jurassic Park-gameplay.png')) {
        if (rename($imageDir . '/Lost World, The - Jurassic Park (USA)-gameplay.png', $imageDir . '/Lost World, The - Jurassic Park-gameplay.png')) {
            echo "✓ Lost World, The - Jurassic Park (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lost World, The - Jurassic Park-gameplay.png\n";
        $skipped++;
    }
}

// Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En) → Lucky Dime Caper Starring Donald Duck, The
if (file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-artwork.png')) {
        if (rename($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En)-artwork.png', $imageDir . '/Lucky Dime Caper Starring Donald Duck, The-artwork.png')) {
            echo "✓ Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lucky Dime Caper Starring Donald Duck, The-artwork.png\n";
        $skipped++;
    }
}

// Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En) → Lucky Dime Caper Starring Donald Duck, The
if (file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-cover.png')) {
        if (rename($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En)-cover.png', $imageDir . '/Lucky Dime Caper Starring Donald Duck, The-cover.png')) {
            echo "✓ Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lucky Dime Caper Starring Donald Duck, The-cover.png\n";
        $skipped++;
    }
}

// Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En) → Lucky Dime Caper Starring Donald Duck, The
if (file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-gameplay.png')) {
        if (rename($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En)-gameplay.png', $imageDir . '/Lucky Dime Caper Starring Donald Duck, The-gameplay.png')) {
            echo "✓ Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lucky Dime Caper Starring Donald Duck, The-gameplay.png\n";
        $skipped++;
    }
}

// Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) → Lucky Dime Caper Starring Donald Duck, The
if (file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-cover.png')) {
        if (rename($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-cover.png', $imageDir . '/Lucky Dime Caper Starring Donald Duck, The-cover.png')) {
            echo "✓ Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lucky Dime Caper Starring Donald Duck, The-cover.png\n";
        $skipped++;
    }
}

// Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil) → Lucky Dime Caper Starring Donald Duck, The
if (file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Lucky Dime Caper Starring Donald Duck, The-gameplay.png')) {
        if (rename($imageDir . '/Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-gameplay.png', $imageDir . '/Lucky Dime Caper Starring Donald Duck, The-gameplay.png')) {
            echo "✓ Lucky Dime Caper Starring Donald Duck, The (USA, Europe, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lucky Dime Caper Starring Donald Duck, The-gameplay.png\n";
        $skipped++;
    }
}

// Lunar - Sanposuru Gakuen (Game Arts) (Japan)[tr pt] → Lunar - Sanposuru Gakuen (Game Arts) (Japan)[tr en Naflign][v0.17]
if (file_exists($imageDir . '/Lunar - Sanposuru Gakuen (Game Arts) (Japan)[tr pt]-cover.png')) {
    if (!file_exists($imageDir . '/Lunar - Sanposuru Gakuen (Game Arts) (Japan)[tr en Naflign][v0.17]-cover.png')) {
        if (rename($imageDir . '/Lunar - Sanposuru Gakuen (Game Arts) (Japan)[tr pt]-cover.png', $imageDir . '/Lunar - Sanposuru Gakuen (Game Arts) (Japan)[tr en Naflign][v0.17]-cover.png')) {
            echo "✓ Lunar - Sanposuru Gakuen (Game Arts) (Japan)[tr pt]-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lunar - Sanposuru Gakuen (Game Arts) (Japan)[tr en Naflign][v0.17]-cover.png\n";
        $skipped++;
    }
}

// Lunar - Sanposuru Gakuen (Japan) → Lunar - Sanposuru Gakuen
if (file_exists($imageDir . '/Lunar - Sanposuru Gakuen (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Lunar - Sanposuru Gakuen-artwork.png')) {
        if (rename($imageDir . '/Lunar - Sanposuru Gakuen (Japan)-artwork.png', $imageDir . '/Lunar - Sanposuru Gakuen-artwork.png')) {
            echo "✓ Lunar - Sanposuru Gakuen (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lunar - Sanposuru Gakuen-artwork.png\n";
        $skipped++;
    }
}

// Lunar - Sanposuru Gakuen (Japan) → Lunar - Sanposuru Gakuen
if (file_exists($imageDir . '/Lunar - Sanposuru Gakuen (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Lunar - Sanposuru Gakuen-cover.png')) {
        if (rename($imageDir . '/Lunar - Sanposuru Gakuen (Japan)-cover.png', $imageDir . '/Lunar - Sanposuru Gakuen-cover.png')) {
            echo "✓ Lunar - Sanposuru Gakuen (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lunar - Sanposuru Gakuen-cover.png\n";
        $skipped++;
    }
}

// Lunar - Sanposuru Gakuen (Japan) → Lunar - Sanposuru Gakuen
if (file_exists($imageDir . '/Lunar - Sanposuru Gakuen (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Lunar - Sanposuru Gakuen-gameplay.png')) {
        if (rename($imageDir . '/Lunar - Sanposuru Gakuen (Japan)-gameplay.png', $imageDir . '/Lunar - Sanposuru Gakuen-gameplay.png')) {
            echo "✓ Lunar - Sanposuru Gakuen (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lunar - Sanposuru Gakuen-gameplay.png\n";
        $skipped++;
    }
}

// Lunar - Sanposuru Gakuen [tr en] (Japan) → Lunar - Sanposuru Gakuen [tr en]
if (file_exists($imageDir . '/Lunar - Sanposuru Gakuen [tr en] (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Lunar - Sanposuru Gakuen [tr en]-cover.png')) {
        if (rename($imageDir . '/Lunar - Sanposuru Gakuen [tr en] (Japan)-cover.png', $imageDir . '/Lunar - Sanposuru Gakuen [tr en]-cover.png')) {
            echo "✓ Lunar - Sanposuru Gakuen [tr en] (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Lunar - Sanposuru Gakuen [tr en]-cover.png\n";
        $skipped++;
    }
}

// MLBPA Baseball (USA) → MLBPA Baseball
if (file_exists($imageDir . '/MLBPA Baseball (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/MLBPA Baseball-artwork.png')) {
        if (rename($imageDir . '/MLBPA Baseball (USA)-artwork.png', $imageDir . '/MLBPA Baseball-artwork.png')) {
            echo "✓ MLBPA Baseball (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: MLBPA Baseball-artwork.png\n";
        $skipped++;
    }
}

// MLBPA Baseball (USA) → MLBPA Baseball
if (file_exists($imageDir . '/MLBPA Baseball (USA)-cover.png')) {
    if (!file_exists($imageDir . '/MLBPA Baseball-cover.png')) {
        if (rename($imageDir . '/MLBPA Baseball (USA)-cover.png', $imageDir . '/MLBPA Baseball-cover.png')) {
            echo "✓ MLBPA Baseball (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: MLBPA Baseball-cover.png\n";
        $skipped++;
    }
}

// MLBPA Baseball (USA) → MLBPA Baseball
if (file_exists($imageDir . '/MLBPA Baseball (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/MLBPA Baseball-gameplay.png')) {
        if (rename($imageDir . '/MLBPA Baseball (USA)-gameplay.png', $imageDir . '/MLBPA Baseball-gameplay.png')) {
            echo "✓ MLBPA Baseball (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: MLBPA Baseball-gameplay.png\n";
        $skipped++;
    }
}

// Madden NFL 95 (USA) → Madden NFL 95
if (file_exists($imageDir . '/Madden NFL 95 (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Madden NFL 95-artwork.png')) {
        if (rename($imageDir . '/Madden NFL 95 (USA)-artwork.png', $imageDir . '/Madden NFL 95-artwork.png')) {
            echo "✓ Madden NFL 95 (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madden NFL 95-artwork.png\n";
        $skipped++;
    }
}

// Madden NFL 95 (USA) → Madden NFL 95
if (file_exists($imageDir . '/Madden NFL 95 (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Madden NFL 95-cover.png')) {
        if (rename($imageDir . '/Madden NFL 95 (USA)-cover.png', $imageDir . '/Madden NFL 95-cover.png')) {
            echo "✓ Madden NFL 95 (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madden NFL 95-cover.png\n";
        $skipped++;
    }
}

// Madden NFL 95 (USA) → Madden NFL 95
if (file_exists($imageDir . '/Madden NFL 95 (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Madden NFL 95-gameplay.png')) {
        if (rename($imageDir . '/Madden NFL 95 (USA)-gameplay.png', $imageDir . '/Madden NFL 95-gameplay.png')) {
            echo "✓ Madden NFL 95 (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madden NFL 95-gameplay.png\n";
        $skipped++;
    }
}

// Madou Monogatari A - Dokidoki Vacation (Japan) → Madou Monogatari A - Dokidoki Vacation
if (file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation-artwork.png')) {
        if (rename($imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-artwork.png', $imageDir . '/Madou Monogatari A - Dokidoki Vacation-artwork.png')) {
            echo "✓ Madou Monogatari A - Dokidoki Vacation (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari A - Dokidoki Vacation-artwork.png\n";
        $skipped++;
    }
}

// Madou Monogatari A - Dokidoki Vacation (Japan) → Madou Monogatari A - Dokidoki Vacation
if (file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation-cover.png')) {
        if (rename($imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-cover.png', $imageDir . '/Madou Monogatari A - Dokidoki Vacation-cover.png')) {
            echo "✓ Madou Monogatari A - Dokidoki Vacation (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari A - Dokidoki Vacation-cover.png\n";
        $skipped++;
    }
}

// Madou Monogatari A - Dokidoki Vacation (Japan) → Madou Monogatari A - Dokidoki Vacation
if (file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari A - Dokidoki Vacation-gameplay.png')) {
        if (rename($imageDir . '/Madou Monogatari A - Dokidoki Vacation (Japan)-gameplay.png', $imageDir . '/Madou Monogatari A - Dokidoki Vacation-gameplay.png')) {
            echo "✓ Madou Monogatari A - Dokidoki Vacation (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari A - Dokidoki Vacation-gameplay.png\n";
        $skipped++;
    }
}

// Madou Monogatari I - 3tsu no Madoukyuu (Japan) → Madou Monogatari I - 3tsu no Madoukyuu
if (file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-artwork.png')) {
        if (rename($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-artwork.png', $imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-artwork.png')) {
            echo "✓ Madou Monogatari I - 3tsu no Madoukyuu (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari I - 3tsu no Madoukyuu-artwork.png\n";
        $skipped++;
    }
}

// Madou Monogatari I - 3tsu no Madoukyuu (Japan) → Madou Monogatari I - 3tsu no Madoukyuu
if (file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-cover.png')) {
        if (rename($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-cover.png', $imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-cover.png')) {
            echo "✓ Madou Monogatari I - 3tsu no Madoukyuu (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari I - 3tsu no Madoukyuu-cover.png\n";
        $skipped++;
    }
}

// Madou Monogatari I - 3tsu no Madoukyuu (Japan) → Madou Monogatari I - 3tsu no Madoukyuu
if (file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-gameplay.png')) {
        if (rename($imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu (Japan)-gameplay.png', $imageDir . '/Madou Monogatari I - 3tsu no Madoukyuu-gameplay.png')) {
            echo "✓ Madou Monogatari I - 3tsu no Madoukyuu (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari I - 3tsu no Madoukyuu-gameplay.png\n";
        $skipped++;
    }
}

// Madou Monogatari II - Arle 16-Sai (Japan) → Madou Monogatari II - Arle 16-Sai
if (file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai-artwork.png')) {
        if (rename($imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-artwork.png', $imageDir . '/Madou Monogatari II - Arle 16-Sai-artwork.png')) {
            echo "✓ Madou Monogatari II - Arle 16-Sai (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari II - Arle 16-Sai-artwork.png\n";
        $skipped++;
    }
}

// Madou Monogatari II - Arle 16-Sai (Japan) → Madou Monogatari II - Arle 16-Sai
if (file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai-cover.png')) {
        if (rename($imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-cover.png', $imageDir . '/Madou Monogatari II - Arle 16-Sai-cover.png')) {
            echo "✓ Madou Monogatari II - Arle 16-Sai (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari II - Arle 16-Sai-cover.png\n";
        $skipped++;
    }
}

// Madou Monogatari II - Arle 16-Sai (Japan) → Madou Monogatari II - Arle 16-Sai
if (file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari II - Arle 16-Sai-gameplay.png')) {
        if (rename($imageDir . '/Madou Monogatari II - Arle 16-Sai (Japan)-gameplay.png', $imageDir . '/Madou Monogatari II - Arle 16-Sai-gameplay.png')) {
            echo "✓ Madou Monogatari II - Arle 16-Sai (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari II - Arle 16-Sai-gameplay.png\n";
        $skipped++;
    }
}

// Madou Monogatari III - Kyuukyoku Joou-sama (Japan) → Madou Monogatari III - Kyuukyoku Joou-sama
if (file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-artwork.png')) {
        if (rename($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-artwork.png', $imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-artwork.png')) {
            echo "✓ Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari III - Kyuukyoku Joou-sama-artwork.png\n";
        $skipped++;
    }
}

// Madou Monogatari III - Kyuukyoku Joou-sama (Japan) → Madou Monogatari III - Kyuukyoku Joou-sama
if (file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-cover.png')) {
        if (rename($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-cover.png', $imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-cover.png')) {
            echo "✓ Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari III - Kyuukyoku Joou-sama-cover.png\n";
        $skipped++;
    }
}

// Madou Monogatari III - Kyuukyoku Joou-sama (Japan) → Madou Monogatari III - Kyuukyoku Joou-sama
if (file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-gameplay.png')) {
        if (rename($imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-gameplay.png', $imageDir . '/Madou Monogatari III - Kyuukyoku Joou-sama-gameplay.png')) {
            echo "✓ Madou Monogatari III - Kyuukyoku Joou-sama (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Madou Monogatari III - Kyuukyoku Joou-sama-gameplay.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth (Japan) → Magic Knight Rayearth
if (file_exists($imageDir . '/Magic Knight Rayearth (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth-artwork.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth (Japan)-artwork.png', $imageDir . '/Magic Knight Rayearth-artwork.png')) {
            echo "✓ Magic Knight Rayearth (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth-artwork.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth (Japan) → Magic Knight Rayearth
if (file_exists($imageDir . '/Magic Knight Rayearth (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth-cover.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth (Japan)-cover.png', $imageDir . '/Magic Knight Rayearth-cover.png')) {
            echo "✓ Magic Knight Rayearth (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth-cover.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth (Japan) → Magic Knight Rayearth
if (file_exists($imageDir . '/Magic Knight Rayearth (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth-gameplay.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth (Japan)-gameplay.png', $imageDir . '/Magic Knight Rayearth-gameplay.png')) {
            echo "✓ Magic Knight Rayearth (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth-gameplay.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth 2 - Making of Magic Knight (Japan) → Magic Knight Rayearth 2 - Making of Magic Knight
if (file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-artwork.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-artwork.png', $imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-artwork.png')) {
            echo "✓ Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth 2 - Making of Magic Knight-artwork.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth 2 - Making of Magic Knight (Japan) → Magic Knight Rayearth 2 - Making of Magic Knight
if (file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-cover.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-cover.png', $imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-cover.png')) {
            echo "✓ Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth 2 - Making of Magic Knight-cover.png\n";
        $skipped++;
    }
}

// Magic Knight Rayearth 2 - Making of Magic Knight (Japan) → Magic Knight Rayearth 2 - Making of Magic Knight
if (file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-gameplay.png')) {
        if (rename($imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-gameplay.png', $imageDir . '/Magic Knight Rayearth 2 - Making of Magic Knight-gameplay.png')) {
            echo "✓ Magic Knight Rayearth 2 - Making of Magic Knight (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magic Knight Rayearth 2 - Making of Magic Knight-gameplay.png\n";
        $skipped++;
    }
}

// Magical Puzzle Popils (World) → Magical Puzzle Popils
if (file_exists($imageDir . '/Magical Puzzle Popils (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Magical Puzzle Popils-artwork.png')) {
        if (rename($imageDir . '/Magical Puzzle Popils (World)-artwork.png', $imageDir . '/Magical Puzzle Popils-artwork.png')) {
            echo "✓ Magical Puzzle Popils (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Puzzle Popils-artwork.png\n";
        $skipped++;
    }
}

// Magical Puzzle Popils (World) → Magical Puzzle Popils
if (file_exists($imageDir . '/Magical Puzzle Popils (World)-cover.png')) {
    if (!file_exists($imageDir . '/Magical Puzzle Popils-cover.png')) {
        if (rename($imageDir . '/Magical Puzzle Popils (World)-cover.png', $imageDir . '/Magical Puzzle Popils-cover.png')) {
            echo "✓ Magical Puzzle Popils (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Puzzle Popils-cover.png\n";
        $skipped++;
    }
}

// Magical Puzzle Popils (World) → Magical Puzzle Popils
if (file_exists($imageDir . '/Magical Puzzle Popils (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Magical Puzzle Popils-gameplay.png')) {
        if (rename($imageDir . '/Magical Puzzle Popils (World)-gameplay.png', $imageDir . '/Magical Puzzle Popils-gameplay.png')) {
            echo "✓ Magical Puzzle Popils (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Puzzle Popils-gameplay.png\n";
        $skipped++;
    }
}

// Magical Taruruuto-kun (Japan) → Magical Taruruuto-kun
if (file_exists($imageDir . '/Magical Taruruuto-kun (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Magical Taruruuto-kun-artwork.png')) {
        if (rename($imageDir . '/Magical Taruruuto-kun (Japan)-artwork.png', $imageDir . '/Magical Taruruuto-kun-artwork.png')) {
            echo "✓ Magical Taruruuto-kun (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Taruruuto-kun-artwork.png\n";
        $skipped++;
    }
}

// Magical Taruruuto-kun (Japan) → Magical Taruruuto-kun
if (file_exists($imageDir . '/Magical Taruruuto-kun (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Magical Taruruuto-kun-cover.png')) {
        if (rename($imageDir . '/Magical Taruruuto-kun (Japan)-cover.png', $imageDir . '/Magical Taruruuto-kun-cover.png')) {
            echo "✓ Magical Taruruuto-kun (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Taruruuto-kun-cover.png\n";
        $skipped++;
    }
}

// Magical Taruruuto-kun (Japan) → Magical Taruruuto-kun
if (file_exists($imageDir . '/Magical Taruruuto-kun (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Magical Taruruuto-kun-gameplay.png')) {
        if (rename($imageDir . '/Magical Taruruuto-kun (Japan)-gameplay.png', $imageDir . '/Magical Taruruuto-kun-gameplay.png')) {
            echo "✓ Magical Taruruuto-kun (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Magical Taruruuto-kun-gameplay.png\n";
        $skipped++;
    }
}

// Majors, The - Pro Baseball (USA) → Majors, The - Pro Baseball
if (file_exists($imageDir . '/Majors, The - Pro Baseball (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Majors, The - Pro Baseball-artwork.png')) {
        if (rename($imageDir . '/Majors, The - Pro Baseball (USA)-artwork.png', $imageDir . '/Majors, The - Pro Baseball-artwork.png')) {
            echo "✓ Majors, The - Pro Baseball (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Majors, The - Pro Baseball-artwork.png\n";
        $skipped++;
    }
}

// Majors, The - Pro Baseball (USA) → Majors, The - Pro Baseball
if (file_exists($imageDir . '/Majors, The - Pro Baseball (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Majors, The - Pro Baseball-cover.png')) {
        if (rename($imageDir . '/Majors, The - Pro Baseball (USA)-cover.png', $imageDir . '/Majors, The - Pro Baseball-cover.png')) {
            echo "✓ Majors, The - Pro Baseball (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Majors, The - Pro Baseball-cover.png\n";
        $skipped++;
    }
}

// Majors, The - Pro Baseball (USA) → Majors, The - Pro Baseball
if (file_exists($imageDir . '/Majors, The - Pro Baseball (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Majors, The - Pro Baseball-gameplay.png')) {
        if (rename($imageDir . '/Majors, The - Pro Baseball (USA)-gameplay.png', $imageDir . '/Majors, The - Pro Baseball-gameplay.png')) {
            echo "✓ Majors, The - Pro Baseball (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Majors, The - Pro Baseball-gameplay.png\n";
        $skipped++;
    }
}

// Mappy (Japan) → Mappy (Namco) (Japan)[h]
if (file_exists($imageDir . '/Mappy (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Mappy (Namco) (Japan)[h]-artwork.png')) {
        if (rename($imageDir . '/Mappy (Japan)-artwork.png', $imageDir . '/Mappy (Namco) (Japan)[h]-artwork.png')) {
            echo "✓ Mappy (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mappy (Namco) (Japan)[h]-artwork.png\n";
        $skipped++;
    }
}

// Mappy (Japan) → Mappy (Namco) (Japan)[h]
if (file_exists($imageDir . '/Mappy (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Mappy (Namco) (Japan)[h]-cover.png')) {
        if (rename($imageDir . '/Mappy (Japan)-cover.png', $imageDir . '/Mappy (Namco) (Japan)[h]-cover.png')) {
            echo "✓ Mappy (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mappy (Namco) (Japan)[h]-cover.png\n";
        $skipped++;
    }
}

// Mappy (Japan) → Mappy (Namco) (Japan)[h]
if (file_exists($imageDir . '/Mappy (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mappy (Namco) (Japan)[h]-gameplay.png')) {
        if (rename($imageDir . '/Mappy (Japan)-gameplay.png', $imageDir . '/Mappy (Namco) (Japan)[h]-gameplay.png')) {
            echo "✓ Mappy (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mappy (Namco) (Japan)[h]-gameplay.png\n";
        $skipped++;
    }
}

// Mega Man (USA) → Mega Man
if (file_exists($imageDir . '/Mega Man (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Mega Man-artwork.png')) {
        if (rename($imageDir . '/Mega Man (USA)-artwork.png', $imageDir . '/Mega Man-artwork.png')) {
            echo "✓ Mega Man (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mega Man-artwork.png\n";
        $skipped++;
    }
}

// Mega Man (USA) → Mega Man
if (file_exists($imageDir . '/Mega Man (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Mega Man-cover.png')) {
        if (rename($imageDir . '/Mega Man (USA)-cover.png', $imageDir . '/Mega Man-cover.png')) {
            echo "✓ Mega Man (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mega Man-cover.png\n";
        $skipped++;
    }
}

// Mega Man (USA) → Mega Man
if (file_exists($imageDir . '/Mega Man (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mega Man-gameplay.png')) {
        if (rename($imageDir . '/Mega Man (USA)-gameplay.png', $imageDir . '/Mega Man-gameplay.png')) {
            echo "✓ Mega Man (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mega Man-gameplay.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible (Japan) → Megami Tensei Gaiden - Last Bible
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible-artwork.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-artwork.png', $imageDir . '/Megami Tensei Gaiden - Last Bible-artwork.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible-artwork.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible (Japan) → Megami Tensei Gaiden - Last Bible
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible-cover.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-cover.png', $imageDir . '/Megami Tensei Gaiden - Last Bible-cover.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible-cover.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible (Japan) → Megami Tensei Gaiden - Last Bible
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible-gameplay.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible (Japan)-gameplay.png', $imageDir . '/Megami Tensei Gaiden - Last Bible-gameplay.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible-gameplay.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible Special (Japan) → Megami Tensei Gaiden - Last Bible Special
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special-artwork.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-artwork.png', $imageDir . '/Megami Tensei Gaiden - Last Bible Special-artwork.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible Special (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible Special-artwork.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible Special (Japan) → Megami Tensei Gaiden - Last Bible Special
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special-cover.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-cover.png', $imageDir . '/Megami Tensei Gaiden - Last Bible Special-cover.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible Special (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible Special-cover.png\n";
        $skipped++;
    }
}

// Megami Tensei Gaiden - Last Bible Special (Japan) → Megami Tensei Gaiden - Last Bible Special
if (file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Megami Tensei Gaiden - Last Bible Special-gameplay.png')) {
        if (rename($imageDir . '/Megami Tensei Gaiden - Last Bible Special (Japan)-gameplay.png', $imageDir . '/Megami Tensei Gaiden - Last Bible Special-gameplay.png')) {
            echo "✓ Megami Tensei Gaiden - Last Bible Special (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Megami Tensei Gaiden - Last Bible Special-gameplay.png\n";
        $skipped++;
    }
}

// Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan) → Mickey Mouse Densetsu no Oukoku - Legend of Illusion
if (file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-artwork.png')) {
        if (rename($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-artwork.png', $imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-artwork.png')) {
            echo "✓ Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse Densetsu no Oukoku - Legend of Illusion-artwork.png\n";
        $skipped++;
    }
}

// Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan) → Mickey Mouse Densetsu no Oukoku - Legend of Illusion
if (file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-cover.png')) {
        if (rename($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-cover.png', $imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-cover.png')) {
            echo "✓ Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse Densetsu no Oukoku - Legend of Illusion-cover.png\n";
        $skipped++;
    }
}

// Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan) → Mickey Mouse Densetsu no Oukoku - Legend of Illusion
if (file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-gameplay.png')) {
        if (rename($imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-gameplay.png', $imageDir . '/Mickey Mouse Densetsu no Oukoku - Legend of Illusion-gameplay.png')) {
            echo "✓ Mickey Mouse Densetsu no Oukoku - Legend of Illusion (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse Densetsu no Oukoku - Legend of Illusion-gameplay.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Mahou no Crystal (Japan) → Mickey Mouse no Mahou no Crystal
if (file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal-artwork.png')) {
        if (rename($imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-artwork.png', $imageDir . '/Mickey Mouse no Mahou no Crystal-artwork.png')) {
            echo "✓ Mickey Mouse no Mahou no Crystal (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse no Mahou no Crystal-artwork.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Mahou no Crystal (Japan) → Mickey Mouse no Mahou no Crystal
if (file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal-cover.png')) {
        if (rename($imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-cover.png', $imageDir . '/Mickey Mouse no Mahou no Crystal-cover.png')) {
            echo "✓ Mickey Mouse no Mahou no Crystal (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse no Mahou no Crystal-cover.png\n";
        $skipped++;
    }
}

// Mickey Mouse no Mahou no Crystal (Japan) → Mickey Mouse no Mahou no Crystal
if (file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mickey Mouse no Mahou no Crystal-gameplay.png')) {
        if (rename($imageDir . '/Mickey Mouse no Mahou no Crystal (Japan)-gameplay.png', $imageDir . '/Mickey Mouse no Mahou no Crystal-gameplay.png')) {
            echo "✓ Mickey Mouse no Mahou no Crystal (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mickey Mouse no Mahou no Crystal-gameplay.png\n";
        $skipped++;
    }
}

// Micro Machines 2 - Turbo Tournament (Europe) → Micro Machines 2 - Turbo Tournament
if (file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament-artwork.png')) {
        if (rename($imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-artwork.png', $imageDir . '/Micro Machines 2 - Turbo Tournament-artwork.png')) {
            echo "✓ Micro Machines 2 - Turbo Tournament (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Micro Machines 2 - Turbo Tournament-artwork.png\n";
        $skipped++;
    }
}

// Micro Machines 2 - Turbo Tournament (Europe) → Micro Machines 2 - Turbo Tournament
if (file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament-cover.png')) {
        if (rename($imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-cover.png', $imageDir . '/Micro Machines 2 - Turbo Tournament-cover.png')) {
            echo "✓ Micro Machines 2 - Turbo Tournament (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Micro Machines 2 - Turbo Tournament-cover.png\n";
        $skipped++;
    }
}

// Micro Machines 2 - Turbo Tournament (Europe) → Micro Machines 2 - Turbo Tournament
if (file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Micro Machines 2 - Turbo Tournament-gameplay.png')) {
        if (rename($imageDir . '/Micro Machines 2 - Turbo Tournament (Europe)-gameplay.png', $imageDir . '/Micro Machines 2 - Turbo Tournament-gameplay.png')) {
            echo "✓ Micro Machines 2 - Turbo Tournament (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Micro Machines 2 - Turbo Tournament-gameplay.png\n";
        $skipped++;
    }
}

// Mighty Morphin Power Rangers (USA, Europe) → Mighty Morphin Power Rangers - The Movie
if (file_exists($imageDir . '/Mighty Morphin Power Rangers (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie-artwork.png')) {
        if (rename($imageDir . '/Mighty Morphin Power Rangers (USA, Europe)-artwork.png', $imageDir . '/Mighty Morphin Power Rangers - The Movie-artwork.png')) {
            echo "✓ Mighty Morphin Power Rangers (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mighty Morphin Power Rangers - The Movie-artwork.png\n";
        $skipped++;
    }
}

// Mighty Morphin Power Rangers (USA, Europe) → Mighty Morphin Power Rangers - The Movie
if (file_exists($imageDir . '/Mighty Morphin Power Rangers (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie-cover.png')) {
        if (rename($imageDir . '/Mighty Morphin Power Rangers (USA, Europe)-cover.png', $imageDir . '/Mighty Morphin Power Rangers - The Movie-cover.png')) {
            echo "✓ Mighty Morphin Power Rangers (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mighty Morphin Power Rangers - The Movie-cover.png\n";
        $skipped++;
    }
}

// Mighty Morphin Power Rangers (USA, Europe) → Mighty Morphin Power Rangers - The Movie
if (file_exists($imageDir . '/Mighty Morphin Power Rangers (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie-gameplay.png')) {
        if (rename($imageDir . '/Mighty Morphin Power Rangers (USA, Europe)-gameplay.png', $imageDir . '/Mighty Morphin Power Rangers - The Movie-gameplay.png')) {
            echo "✓ Mighty Morphin Power Rangers (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mighty Morphin Power Rangers - The Movie-gameplay.png\n";
        $skipped++;
    }
}

// Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En) → Mighty Morphin Power Rangers - The Movie
if (file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie-artwork.png')) {
        if (rename($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En)-artwork.png', $imageDir . '/Mighty Morphin Power Rangers - The Movie-artwork.png')) {
            echo "✓ Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mighty Morphin Power Rangers - The Movie-artwork.png\n";
        $skipped++;
    }
}

// Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En) → Mighty Morphin Power Rangers - The Movie
if (file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie-cover.png')) {
        if (rename($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En)-cover.png', $imageDir . '/Mighty Morphin Power Rangers - The Movie-cover.png')) {
            echo "✓ Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mighty Morphin Power Rangers - The Movie-cover.png\n";
        $skipped++;
    }
}

// Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En) → Mighty Morphin Power Rangers - The Movie
if (file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie-gameplay.png')) {
        if (rename($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En)-gameplay.png', $imageDir . '/Mighty Morphin Power Rangers - The Movie-gameplay.png')) {
            echo "✓ Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mighty Morphin Power Rangers - The Movie-gameplay.png\n";
        $skipped++;
    }
}

// Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil) → Mighty Morphin Power Rangers - The Movie
if (file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Mighty Morphin Power Rangers - The Movie-cover.png')) {
        if (rename($imageDir . '/Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-cover.png', $imageDir . '/Mighty Morphin Power Rangers - The Movie-cover.png')) {
            echo "✓ Mighty Morphin Power Rangers - The Movie (USA, Europe, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mighty Morphin Power Rangers - The Movie-cover.png\n";
        $skipped++;
    }
}

// Moldorian - Hikari to Yami no Sister (Japan) → Moldorian - Hikari to Yami no Sister
if (file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister-artwork.png')) {
        if (rename($imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-artwork.png', $imageDir . '/Moldorian - Hikari to Yami no Sister-artwork.png')) {
            echo "✓ Moldorian - Hikari to Yami no Sister (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Moldorian - Hikari to Yami no Sister-artwork.png\n";
        $skipped++;
    }
}

// Moldorian - Hikari to Yami no Sister (Japan) → Moldorian - Hikari to Yami no Sister
if (file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister-cover.png')) {
        if (rename($imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-cover.png', $imageDir . '/Moldorian - Hikari to Yami no Sister-cover.png')) {
            echo "✓ Moldorian - Hikari to Yami no Sister (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Moldorian - Hikari to Yami no Sister-cover.png\n";
        $skipped++;
    }
}

// Moldorian - Hikari to Yami no Sister (Japan) → Moldorian - Hikari to Yami no Sister
if (file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Moldorian - Hikari to Yami no Sister-gameplay.png')) {
        if (rename($imageDir . '/Moldorian - Hikari to Yami no Sister (Japan)-gameplay.png', $imageDir . '/Moldorian - Hikari to Yami no Sister-gameplay.png')) {
            echo "✓ Moldorian - Hikari to Yami no Sister (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Moldorian - Hikari to Yami no Sister-gameplay.png\n";
        $skipped++;
    }
}

// Monster Truck Wars (USA, Europe) → Monster Truck Wars
if (file_exists($imageDir . '/Monster Truck Wars (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Monster Truck Wars-artwork.png')) {
        if (rename($imageDir . '/Monster Truck Wars (USA, Europe)-artwork.png', $imageDir . '/Monster Truck Wars-artwork.png')) {
            echo "✓ Monster Truck Wars (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster Truck Wars-artwork.png\n";
        $skipped++;
    }
}

// Monster Truck Wars (USA, Europe) → Monster Truck Wars
if (file_exists($imageDir . '/Monster Truck Wars (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Monster Truck Wars-cover.png')) {
        if (rename($imageDir . '/Monster Truck Wars (USA, Europe)-cover.png', $imageDir . '/Monster Truck Wars-cover.png')) {
            echo "✓ Monster Truck Wars (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster Truck Wars-cover.png\n";
        $skipped++;
    }
}

// Monster Truck Wars (USA, Europe) → Monster Truck Wars
if (file_exists($imageDir . '/Monster Truck Wars (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Monster Truck Wars-gameplay.png')) {
        if (rename($imageDir . '/Monster Truck Wars (USA, Europe)-gameplay.png', $imageDir . '/Monster Truck Wars-gameplay.png')) {
            echo "✓ Monster Truck Wars (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster Truck Wars-gameplay.png\n";
        $skipped++;
    }
}

// Monster World II - Dragon no Wana (Japan) → Monster World II - Dragon no Wana
if (file_exists($imageDir . '/Monster World II - Dragon no Wana (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Monster World II - Dragon no Wana-artwork.png')) {
        if (rename($imageDir . '/Monster World II - Dragon no Wana (Japan)-artwork.png', $imageDir . '/Monster World II - Dragon no Wana-artwork.png')) {
            echo "✓ Monster World II - Dragon no Wana (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster World II - Dragon no Wana-artwork.png\n";
        $skipped++;
    }
}

// Monster World II - Dragon no Wana (Japan) → Monster World II - Dragon no Wana
if (file_exists($imageDir . '/Monster World II - Dragon no Wana (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Monster World II - Dragon no Wana-cover.png')) {
        if (rename($imageDir . '/Monster World II - Dragon no Wana (Japan)-cover.png', $imageDir . '/Monster World II - Dragon no Wana-cover.png')) {
            echo "✓ Monster World II - Dragon no Wana (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster World II - Dragon no Wana-cover.png\n";
        $skipped++;
    }
}

// Monster World II - Dragon no Wana (Japan) → Monster World II - Dragon no Wana
if (file_exists($imageDir . '/Monster World II - Dragon no Wana (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Monster World II - Dragon no Wana-gameplay.png')) {
        if (rename($imageDir . '/Monster World II - Dragon no Wana (Japan)-gameplay.png', $imageDir . '/Monster World II - Dragon no Wana-gameplay.png')) {
            echo "✓ Monster World II - Dragon no Wana (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Monster World II - Dragon no Wana-gameplay.png\n";
        $skipped++;
    }
}

// Mortal Kombat 3 (Europe) → Mortal Kombat 3
if (file_exists($imageDir . '/Mortal Kombat 3 (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat 3-artwork.png')) {
        if (rename($imageDir . '/Mortal Kombat 3 (Europe)-artwork.png', $imageDir . '/Mortal Kombat 3-artwork.png')) {
            echo "✓ Mortal Kombat 3 (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat 3-artwork.png\n";
        $skipped++;
    }
}

// Mortal Kombat 3 (Europe) → Mortal Kombat 3
if (file_exists($imageDir . '/Mortal Kombat 3 (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat 3-cover.png')) {
        if (rename($imageDir . '/Mortal Kombat 3 (Europe)-cover.png', $imageDir . '/Mortal Kombat 3-cover.png')) {
            echo "✓ Mortal Kombat 3 (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat 3-cover.png\n";
        $skipped++;
    }
}

// Mortal Kombat 3 (Europe) → Mortal Kombat 3
if (file_exists($imageDir . '/Mortal Kombat 3 (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat 3-gameplay.png')) {
        if (rename($imageDir . '/Mortal Kombat 3 (Europe)-gameplay.png', $imageDir . '/Mortal Kombat 3-gameplay.png')) {
            echo "✓ Mortal Kombat 3 (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat 3-gameplay.png\n";
        $skipped++;
    }
}

// Mortal Kombat II (World) → Mortal Kombat II
if (file_exists($imageDir . '/Mortal Kombat II (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat II-artwork.png')) {
        if (rename($imageDir . '/Mortal Kombat II (World)-artwork.png', $imageDir . '/Mortal Kombat II-artwork.png')) {
            echo "✓ Mortal Kombat II (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat II-artwork.png\n";
        $skipped++;
    }
}

// Mortal Kombat II (World) → Mortal Kombat II
if (file_exists($imageDir . '/Mortal Kombat II (World)-cover.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat II-cover.png')) {
        if (rename($imageDir . '/Mortal Kombat II (World)-cover.png', $imageDir . '/Mortal Kombat II-cover.png')) {
            echo "✓ Mortal Kombat II (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat II-cover.png\n";
        $skipped++;
    }
}

// Mortal Kombat II (World) → Mortal Kombat II
if (file_exists($imageDir . '/Mortal Kombat II (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Mortal Kombat II-gameplay.png')) {
        if (rename($imageDir . '/Mortal Kombat II (World)-gameplay.png', $imageDir . '/Mortal Kombat II-gameplay.png')) {
            echo "✓ Mortal Kombat II (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Mortal Kombat II-gameplay.png\n";
        $skipped++;
    }
}

// NBA Action Starring David Robinson (USA, Brazil) (En) → NBA Action Starring David Robinson
if (file_exists($imageDir . '/NBA Action Starring David Robinson (USA, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/NBA Action Starring David Robinson-artwork.png')) {
        if (rename($imageDir . '/NBA Action Starring David Robinson (USA, Brazil) (En)-artwork.png', $imageDir . '/NBA Action Starring David Robinson-artwork.png')) {
            echo "✓ NBA Action Starring David Robinson (USA, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Action Starring David Robinson-artwork.png\n";
        $skipped++;
    }
}

// NBA Action Starring David Robinson (USA, Brazil) (En) → NBA Action Starring David Robinson
if (file_exists($imageDir . '/NBA Action Starring David Robinson (USA, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/NBA Action Starring David Robinson-cover.png')) {
        if (rename($imageDir . '/NBA Action Starring David Robinson (USA, Brazil) (En)-cover.png', $imageDir . '/NBA Action Starring David Robinson-cover.png')) {
            echo "✓ NBA Action Starring David Robinson (USA, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Action Starring David Robinson-cover.png\n";
        $skipped++;
    }
}

// NBA Action Starring David Robinson (USA, Brazil) (En) → NBA Action Starring David Robinson
if (file_exists($imageDir . '/NBA Action Starring David Robinson (USA, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/NBA Action Starring David Robinson-gameplay.png')) {
        if (rename($imageDir . '/NBA Action Starring David Robinson (USA, Brazil) (En)-gameplay.png', $imageDir . '/NBA Action Starring David Robinson-gameplay.png')) {
            echo "✓ NBA Action Starring David Robinson (USA, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Action Starring David Robinson-gameplay.png\n";
        $skipped++;
    }
}

// NBA Action Starring David Robinson (USA, Brazil) → NBA Action Starring David Robinson
if (file_exists($imageDir . '/NBA Action Starring David Robinson (USA, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/NBA Action Starring David Robinson-cover.png')) {
        if (rename($imageDir . '/NBA Action Starring David Robinson (USA, Brazil)-cover.png', $imageDir . '/NBA Action Starring David Robinson-cover.png')) {
            echo "✓ NBA Action Starring David Robinson (USA, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Action Starring David Robinson-cover.png\n";
        $skipped++;
    }
}

// NBA Action Starring David Robinson (USA, Brazil) → NBA Action Starring David Robinson
if (file_exists($imageDir . '/NBA Action Starring David Robinson (USA, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/NBA Action Starring David Robinson-gameplay.png')) {
        if (rename($imageDir . '/NBA Action Starring David Robinson (USA, Brazil)-gameplay.png', $imageDir . '/NBA Action Starring David Robinson-gameplay.png')) {
            echo "✓ NBA Action Starring David Robinson (USA, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Action Starring David Robinson-gameplay.png\n";
        $skipped++;
    }
}

// NBA Jam - Tournament Edition (World) → NBA Jam - Tournament Edition
if (file_exists($imageDir . '/NBA Jam - Tournament Edition (World)-artwork.png')) {
    if (!file_exists($imageDir . '/NBA Jam - Tournament Edition-artwork.png')) {
        if (rename($imageDir . '/NBA Jam - Tournament Edition (World)-artwork.png', $imageDir . '/NBA Jam - Tournament Edition-artwork.png')) {
            echo "✓ NBA Jam - Tournament Edition (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Jam - Tournament Edition-artwork.png\n";
        $skipped++;
    }
}

// NBA Jam - Tournament Edition (World) → NBA Jam - Tournament Edition
if (file_exists($imageDir . '/NBA Jam - Tournament Edition (World)-cover.png')) {
    if (!file_exists($imageDir . '/NBA Jam - Tournament Edition-cover.png')) {
        if (rename($imageDir . '/NBA Jam - Tournament Edition (World)-cover.png', $imageDir . '/NBA Jam - Tournament Edition-cover.png')) {
            echo "✓ NBA Jam - Tournament Edition (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Jam - Tournament Edition-cover.png\n";
        $skipped++;
    }
}

// NBA Jam - Tournament Edition (World) → NBA Jam - Tournament Edition
if (file_exists($imageDir . '/NBA Jam - Tournament Edition (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/NBA Jam - Tournament Edition-gameplay.png')) {
        if (rename($imageDir . '/NBA Jam - Tournament Edition (World)-gameplay.png', $imageDir . '/NBA Jam - Tournament Edition-gameplay.png')) {
            echo "✓ NBA Jam - Tournament Edition (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NBA Jam - Tournament Edition-gameplay.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club (World) → NFL Quarterback Club
if (file_exists($imageDir . '/NFL Quarterback Club (World)-artwork.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club-artwork.png')) {
        if (rename($imageDir . '/NFL Quarterback Club (World)-artwork.png', $imageDir . '/NFL Quarterback Club-artwork.png')) {
            echo "✓ NFL Quarterback Club (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club-artwork.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club (World) → NFL Quarterback Club
if (file_exists($imageDir . '/NFL Quarterback Club (World)-cover.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club-cover.png')) {
        if (rename($imageDir . '/NFL Quarterback Club (World)-cover.png', $imageDir . '/NFL Quarterback Club-cover.png')) {
            echo "✓ NFL Quarterback Club (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club-cover.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club (World) → NFL Quarterback Club
if (file_exists($imageDir . '/NFL Quarterback Club (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club-gameplay.png')) {
        if (rename($imageDir . '/NFL Quarterback Club (World)-gameplay.png', $imageDir . '/NFL Quarterback Club-gameplay.png')) {
            echo "✓ NFL Quarterback Club (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club-gameplay.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club 96 (USA) → NFL Quarterback Club 96
if (file_exists($imageDir . '/NFL Quarterback Club 96 (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club 96-artwork.png')) {
        if (rename($imageDir . '/NFL Quarterback Club 96 (USA)-artwork.png', $imageDir . '/NFL Quarterback Club 96-artwork.png')) {
            echo "✓ NFL Quarterback Club 96 (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club 96-artwork.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club 96 (USA) → NFL Quarterback Club 96
if (file_exists($imageDir . '/NFL Quarterback Club 96 (USA)-cover.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club 96-cover.png')) {
        if (rename($imageDir . '/NFL Quarterback Club 96 (USA)-cover.png', $imageDir . '/NFL Quarterback Club 96-cover.png')) {
            echo "✓ NFL Quarterback Club 96 (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club 96-cover.png\n";
        $skipped++;
    }
}

// NFL Quarterback Club 96 (USA) → NFL Quarterback Club 96
if (file_exists($imageDir . '/NFL Quarterback Club 96 (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/NFL Quarterback Club 96-gameplay.png')) {
        if (rename($imageDir . '/NFL Quarterback Club 96 (USA)-gameplay.png', $imageDir . '/NFL Quarterback Club 96-gameplay.png')) {
            echo "✓ NFL Quarterback Club 96 (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NFL Quarterback Club 96-gameplay.png\n";
        $skipped++;
    }
}

// NHL All-Star Hockey (USA) → NHL All-Star Hockey
if (file_exists($imageDir . '/NHL All-Star Hockey (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/NHL All-Star Hockey-artwork.png')) {
        if (rename($imageDir . '/NHL All-Star Hockey (USA)-artwork.png', $imageDir . '/NHL All-Star Hockey-artwork.png')) {
            echo "✓ NHL All-Star Hockey (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NHL All-Star Hockey-artwork.png\n";
        $skipped++;
    }
}

// NHL All-Star Hockey (USA) → NHL All-Star Hockey
if (file_exists($imageDir . '/NHL All-Star Hockey (USA)-cover.png')) {
    if (!file_exists($imageDir . '/NHL All-Star Hockey-cover.png')) {
        if (rename($imageDir . '/NHL All-Star Hockey (USA)-cover.png', $imageDir . '/NHL All-Star Hockey-cover.png')) {
            echo "✓ NHL All-Star Hockey (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NHL All-Star Hockey-cover.png\n";
        $skipped++;
    }
}

// NHL All-Star Hockey (USA) → NHL All-Star Hockey
if (file_exists($imageDir . '/NHL All-Star Hockey (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/NHL All-Star Hockey-gameplay.png')) {
        if (rename($imageDir . '/NHL All-Star Hockey (USA)-gameplay.png', $imageDir . '/NHL All-Star Hockey-gameplay.png')) {
            echo "✓ NHL All-Star Hockey (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: NHL All-Star Hockey-gameplay.png\n";
        $skipped++;
    }
}

// Nazo Puyo (Japan) → Nazo Puyo 2
if (file_exists($imageDir . '/Nazo Puyo (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo 2-artwork.png')) {
        if (rename($imageDir . '/Nazo Puyo (Japan)-artwork.png', $imageDir . '/Nazo Puyo 2-artwork.png')) {
            echo "✓ Nazo Puyo (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo 2-artwork.png\n";
        $skipped++;
    }
}

// Nazo Puyo (Japan) → Nazo Puyo 2
if (file_exists($imageDir . '/Nazo Puyo (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo 2-cover.png')) {
        if (rename($imageDir . '/Nazo Puyo (Japan)-cover.png', $imageDir . '/Nazo Puyo 2-cover.png')) {
            echo "✓ Nazo Puyo (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo 2-cover.png\n";
        $skipped++;
    }
}

// Nazo Puyo (Japan) → Nazo Puyo 2
if (file_exists($imageDir . '/Nazo Puyo (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo 2-gameplay.png')) {
        if (rename($imageDir . '/Nazo Puyo (Japan)-gameplay.png', $imageDir . '/Nazo Puyo 2-gameplay.png')) {
            echo "✓ Nazo Puyo (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo 2-gameplay.png\n";
        $skipped++;
    }
}

// Nazo Puyo - Arle no Roux (Japan) → Nazo Puyo - Arle no Roux
if (file_exists($imageDir . '/Nazo Puyo - Arle no Roux (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo - Arle no Roux-artwork.png')) {
        if (rename($imageDir . '/Nazo Puyo - Arle no Roux (Japan)-artwork.png', $imageDir . '/Nazo Puyo - Arle no Roux-artwork.png')) {
            echo "✓ Nazo Puyo - Arle no Roux (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo - Arle no Roux-artwork.png\n";
        $skipped++;
    }
}

// Nazo Puyo - Arle no Roux (Japan) → Nazo Puyo - Arle no Roux
if (file_exists($imageDir . '/Nazo Puyo - Arle no Roux (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo - Arle no Roux-cover.png')) {
        if (rename($imageDir . '/Nazo Puyo - Arle no Roux (Japan)-cover.png', $imageDir . '/Nazo Puyo - Arle no Roux-cover.png')) {
            echo "✓ Nazo Puyo - Arle no Roux (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo - Arle no Roux-cover.png\n";
        $skipped++;
    }
}

// Nazo Puyo - Arle no Roux (Japan) → Nazo Puyo - Arle no Roux
if (file_exists($imageDir . '/Nazo Puyo - Arle no Roux (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo - Arle no Roux-gameplay.png')) {
        if (rename($imageDir . '/Nazo Puyo - Arle no Roux (Japan)-gameplay.png', $imageDir . '/Nazo Puyo - Arle no Roux-gameplay.png')) {
            echo "✓ Nazo Puyo - Arle no Roux (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo - Arle no Roux-gameplay.png\n";
        $skipped++;
    }
}

// Nazo Puyo 2 (Japan) → Nazo Puyo 2
if (file_exists($imageDir . '/Nazo Puyo 2 (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo 2-artwork.png')) {
        if (rename($imageDir . '/Nazo Puyo 2 (Japan)-artwork.png', $imageDir . '/Nazo Puyo 2-artwork.png')) {
            echo "✓ Nazo Puyo 2 (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo 2-artwork.png\n";
        $skipped++;
    }
}

// Nazo Puyo 2 (Japan) → Nazo Puyo 2
if (file_exists($imageDir . '/Nazo Puyo 2 (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo 2-cover.png')) {
        if (rename($imageDir . '/Nazo Puyo 2 (Japan)-cover.png', $imageDir . '/Nazo Puyo 2-cover.png')) {
            echo "✓ Nazo Puyo 2 (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo 2-cover.png\n";
        $skipped++;
    }
}

// Nazo Puyo 2 (Japan) → Nazo Puyo 2
if (file_exists($imageDir . '/Nazo Puyo 2 (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Nazo Puyo 2-gameplay.png')) {
        if (rename($imageDir . '/Nazo Puyo 2 (Japan)-gameplay.png', $imageDir . '/Nazo Puyo 2-gameplay.png')) {
            echo "✓ Nazo Puyo 2 (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nazo Puyo 2-gameplay.png\n";
        $skipped++;
    }
}

// Ninja Gaiden (Japan) → Ninja Gaiden
if (file_exists($imageDir . '/Ninja Gaiden (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Ninja Gaiden-artwork.png')) {
        if (rename($imageDir . '/Ninja Gaiden (Japan)-artwork.png', $imageDir . '/Ninja Gaiden-artwork.png')) {
            echo "✓ Ninja Gaiden (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninja Gaiden-artwork.png\n";
        $skipped++;
    }
}

// Ninja Gaiden (Japan) → Ninja Gaiden
if (file_exists($imageDir . '/Ninja Gaiden (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Ninja Gaiden-cover.png')) {
        if (rename($imageDir . '/Ninja Gaiden (Japan)-cover.png', $imageDir . '/Ninja Gaiden-cover.png')) {
            echo "✓ Ninja Gaiden (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninja Gaiden-cover.png\n";
        $skipped++;
    }
}

// Ninja Gaiden (Japan) → Ninja Gaiden
if (file_exists($imageDir . '/Ninja Gaiden (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ninja Gaiden-gameplay.png')) {
        if (rename($imageDir . '/Ninja Gaiden (Japan)-gameplay.png', $imageDir . '/Ninja Gaiden-gameplay.png')) {
            echo "✓ Ninja Gaiden (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninja Gaiden-gameplay.png\n";
        $skipped++;
    }
}

// Ninja Gaiden (Sega - Tecmo)[tr fr] → Ninja Gaiden (Sega - Tecmo)[tr pt Manao][pt-br]
if (file_exists($imageDir . '/Ninja Gaiden (Sega - Tecmo)[tr fr]-cover.png')) {
    if (!file_exists($imageDir . '/Ninja Gaiden (Sega - Tecmo)[tr pt Manao][pt-br]-cover.png')) {
        if (rename($imageDir . '/Ninja Gaiden (Sega - Tecmo)[tr fr]-cover.png', $imageDir . '/Ninja Gaiden (Sega - Tecmo)[tr pt Manao][pt-br]-cover.png')) {
            echo "✓ Ninja Gaiden (Sega - Tecmo)[tr fr]-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninja Gaiden (Sega - Tecmo)[tr pt Manao][pt-br]-cover.png\n";
        $skipped++;
    }
}

// Ninku 2 - Tenkuuryuu-e no Michi (Japan) → Ninku 2 - Tenkuuryuu-e no Michi
if (file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-artwork.png')) {
        if (rename($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-artwork.png', $imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-artwork.png')) {
            echo "✓ Ninku 2 - Tenkuuryuu-e no Michi (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku 2 - Tenkuuryuu-e no Michi-artwork.png\n";
        $skipped++;
    }
}

// Ninku 2 - Tenkuuryuu-e no Michi (Japan) → Ninku 2 - Tenkuuryuu-e no Michi
if (file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-cover.png')) {
        if (rename($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-cover.png', $imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-cover.png')) {
            echo "✓ Ninku 2 - Tenkuuryuu-e no Michi (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku 2 - Tenkuuryuu-e no Michi-cover.png\n";
        $skipped++;
    }
}

// Ninku 2 - Tenkuuryuu-e no Michi (Japan) → Ninku 2 - Tenkuuryuu-e no Michi
if (file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-gameplay.png')) {
        if (rename($imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi (Japan)-gameplay.png', $imageDir . '/Ninku 2 - Tenkuuryuu-e no Michi-gameplay.png')) {
            echo "✓ Ninku 2 - Tenkuuryuu-e no Michi (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku 2 - Tenkuuryuu-e no Michi-gameplay.png\n";
        $skipped++;
    }
}

// Ninku Gaiden - Hiroyuki Daikatsugeki (Japan) → Ninku Gaiden - Hiroyuki Daikatsugeki
if (file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-artwork.png')) {
        if (rename($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-artwork.png', $imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-artwork.png')) {
            echo "✓ Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku Gaiden - Hiroyuki Daikatsugeki-artwork.png\n";
        $skipped++;
    }
}

// Ninku Gaiden - Hiroyuki Daikatsugeki (Japan) → Ninku Gaiden - Hiroyuki Daikatsugeki
if (file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-cover.png')) {
        if (rename($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-cover.png', $imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-cover.png')) {
            echo "✓ Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku Gaiden - Hiroyuki Daikatsugeki-cover.png\n";
        $skipped++;
    }
}

// Ninku Gaiden - Hiroyuki Daikatsugeki (Japan) → Ninku Gaiden - Hiroyuki Daikatsugeki
if (file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-gameplay.png')) {
        if (rename($imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-gameplay.png', $imageDir . '/Ninku Gaiden - Hiroyuki Daikatsugeki-gameplay.png')) {
            echo "✓ Ninku Gaiden - Hiroyuki Daikatsugeki (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku Gaiden - Hiroyuki Daikatsugeki-gameplay.png\n";
        $skipped++;
    }
}

// Ninku Japan En Jatr Env0 1 → Ninku (Japan) (en-ja)[tr en][v0.1]
if (file_exists($imageDir . '/Ninku Japan En Jatr Env0 1-cover.png')) {
    if (!file_exists($imageDir . '/Ninku (Japan) (en-ja)[tr en][v0.1]-cover.png')) {
        if (rename($imageDir . '/Ninku Japan En Jatr Env0 1-cover.png', $imageDir . '/Ninku (Japan) (en-ja)[tr en][v0.1]-cover.png')) {
            echo "✓ Ninku Japan En Jatr Env0 1-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Ninku (Japan) (en-ja)[tr en][v0.1]-cover.png\n";
        $skipped++;
    }
}

// Nomo Hideo no World Series Baseball (Japan) → Nomo Hideo no World Series Baseball
if (file_exists($imageDir . '/Nomo Hideo no World Series Baseball (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Nomo Hideo no World Series Baseball-artwork.png')) {
        if (rename($imageDir . '/Nomo Hideo no World Series Baseball (Japan)-artwork.png', $imageDir . '/Nomo Hideo no World Series Baseball-artwork.png')) {
            echo "✓ Nomo Hideo no World Series Baseball (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nomo Hideo no World Series Baseball-artwork.png\n";
        $skipped++;
    }
}

// Nomo Hideo no World Series Baseball (Japan) → Nomo Hideo no World Series Baseball
if (file_exists($imageDir . '/Nomo Hideo no World Series Baseball (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Nomo Hideo no World Series Baseball-cover.png')) {
        if (rename($imageDir . '/Nomo Hideo no World Series Baseball (Japan)-cover.png', $imageDir . '/Nomo Hideo no World Series Baseball-cover.png')) {
            echo "✓ Nomo Hideo no World Series Baseball (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nomo Hideo no World Series Baseball-cover.png\n";
        $skipped++;
    }
}

// Nomo Hideo no World Series Baseball (Japan) → Nomo Hideo no World Series Baseball
if (file_exists($imageDir . '/Nomo Hideo no World Series Baseball (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Nomo Hideo no World Series Baseball-gameplay.png')) {
        if (rename($imageDir . '/Nomo Hideo no World Series Baseball (Japan)-gameplay.png', $imageDir . '/Nomo Hideo no World Series Baseball-gameplay.png')) {
            echo "✓ Nomo Hideo no World Series Baseball (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Nomo Hideo no World Series Baseball-gameplay.png\n";
        $skipped++;
    }
}

// Out Run Europa Probe Sega U S Gold Usatr (Pt) → Out Run Europa (Probe - Sega - U.S. Gold) (USA)[tr pt Lohan][100%][pt-br]
if (file_exists($imageDir . '/Out Run Europa Probe Sega U S Gold Usatr (Pt)-cover.png')) {
    if (!file_exists($imageDir . '/Out Run Europa (Probe - Sega - U.S. Gold) (USA)[tr pt Lohan][100%][pt-br]-cover.png')) {
        if (rename($imageDir . '/Out Run Europa Probe Sega U S Gold Usatr (Pt)-cover.png', $imageDir . '/Out Run Europa (Probe - Sega - U.S. Gold) (USA)[tr pt Lohan][100%][pt-br]-cover.png')) {
            echo "✓ Out Run Europa Probe Sega U S Gold Usatr (Pt)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Out Run Europa (Probe - Sega - U.S. Gold) (USA)[tr pt Lohan][100%][pt-br]-cover.png\n";
        $skipped++;
    }
}

// OutRun (Europe, Brazil) → OutRun Europa
if (file_exists($imageDir . '/OutRun (Europe, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/OutRun Europa-cover.png')) {
        if (rename($imageDir . '/OutRun (Europe, Brazil)-cover.png', $imageDir . '/OutRun Europa-cover.png')) {
            echo "✓ OutRun (Europe, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa-cover.png\n";
        $skipped++;
    }
}

// OutRun (Europe, Brazil) → OutRun Europa
if (file_exists($imageDir . '/OutRun (Europe, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/OutRun Europa-gameplay.png')) {
        if (rename($imageDir . '/OutRun (Europe, Brazil)-gameplay.png', $imageDir . '/OutRun Europa-gameplay.png')) {
            echo "✓ OutRun (Europe, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa-gameplay.png\n";
        $skipped++;
    }
}

// OutRun Europa (Europe) → OutRun Europa
if (file_exists($imageDir . '/OutRun Europa (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/OutRun Europa-artwork.png')) {
        if (rename($imageDir . '/OutRun Europa (Europe)-artwork.png', $imageDir . '/OutRun Europa-artwork.png')) {
            echo "✓ OutRun Europa (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa-artwork.png\n";
        $skipped++;
    }
}

// OutRun Europa (Europe) → OutRun Europa
if (file_exists($imageDir . '/OutRun Europa (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/OutRun Europa-cover.png')) {
        if (rename($imageDir . '/OutRun Europa (Europe)-cover.png', $imageDir . '/OutRun Europa-cover.png')) {
            echo "✓ OutRun Europa (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa-cover.png\n";
        $skipped++;
    }
}

// OutRun Europa (Europe) → OutRun Europa
if (file_exists($imageDir . '/OutRun Europa (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/OutRun Europa-gameplay.png')) {
        if (rename($imageDir . '/OutRun Europa (Europe)-gameplay.png', $imageDir . '/OutRun Europa-gameplay.png')) {
            echo "✓ OutRun Europa (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa-gameplay.png\n";
        $skipped++;
    }
}

// OutRun Europa (USA) → OutRun Europa
if (file_exists($imageDir . '/OutRun Europa (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/OutRun Europa-artwork.png')) {
        if (rename($imageDir . '/OutRun Europa (USA)-artwork.png', $imageDir . '/OutRun Europa-artwork.png')) {
            echo "✓ OutRun Europa (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa-artwork.png\n";
        $skipped++;
    }
}

// OutRun Europa (USA) → OutRun Europa
if (file_exists($imageDir . '/OutRun Europa (USA)-cover.png')) {
    if (!file_exists($imageDir . '/OutRun Europa-cover.png')) {
        if (rename($imageDir . '/OutRun Europa (USA)-cover.png', $imageDir . '/OutRun Europa-cover.png')) {
            echo "✓ OutRun Europa (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa-cover.png\n";
        $skipped++;
    }
}

// OutRun Europa (USA) → OutRun Europa
if (file_exists($imageDir . '/OutRun Europa (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/OutRun Europa-gameplay.png')) {
        if (rename($imageDir . '/OutRun Europa (USA)-gameplay.png', $imageDir . '/OutRun Europa-gameplay.png')) {
            echo "✓ OutRun Europa (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: OutRun Europa-gameplay.png\n";
        $skipped++;
    }
}

// Pac-Attack (USA) → Pac-Attack
if (file_exists($imageDir . '/Pac-Attack (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Pac-Attack-artwork.png')) {
        if (rename($imageDir . '/Pac-Attack (USA)-artwork.png', $imageDir . '/Pac-Attack-artwork.png')) {
            echo "✓ Pac-Attack (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Attack-artwork.png\n";
        $skipped++;
    }
}

// Pac-Attack (USA) → Pac-Attack
if (file_exists($imageDir . '/Pac-Attack (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Pac-Attack-cover.png')) {
        if (rename($imageDir . '/Pac-Attack (USA)-cover.png', $imageDir . '/Pac-Attack-cover.png')) {
            echo "✓ Pac-Attack (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Attack-cover.png\n";
        $skipped++;
    }
}

// Pac-Attack (USA) → Pac-Attack
if (file_exists($imageDir . '/Pac-Attack (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Pac-Attack-gameplay.png')) {
        if (rename($imageDir . '/Pac-Attack (USA)-gameplay.png', $imageDir . '/Pac-Attack-gameplay.png')) {
            echo "✓ Pac-Attack (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Attack-gameplay.png\n";
        $skipped++;
    }
}

// Pac-Man (USA) → Pac-Man
if (file_exists($imageDir . '/Pac-Man (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Pac-Man-artwork.png')) {
        if (rename($imageDir . '/Pac-Man (USA)-artwork.png', $imageDir . '/Pac-Man-artwork.png')) {
            echo "✓ Pac-Man (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Man-artwork.png\n";
        $skipped++;
    }
}

// Pac-Man (USA) → Pac-Man
if (file_exists($imageDir . '/Pac-Man (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Pac-Man-cover.png')) {
        if (rename($imageDir . '/Pac-Man (USA)-cover.png', $imageDir . '/Pac-Man-cover.png')) {
            echo "✓ Pac-Man (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Man-cover.png\n";
        $skipped++;
    }
}

// Pac-Man (USA) → Pac-Man
if (file_exists($imageDir . '/Pac-Man (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Pac-Man-gameplay.png')) {
        if (rename($imageDir . '/Pac-Man (USA)-gameplay.png', $imageDir . '/Pac-Man-gameplay.png')) {
            echo "✓ Pac-Man (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pac-Man-gameplay.png\n";
        $skipped++;
    }
}

// Panzer Dragoon Mini (Japan) (En) → Panzer Dragoon Mini
if (file_exists($imageDir . '/Panzer Dragoon Mini (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Panzer Dragoon Mini-artwork.png')) {
        if (rename($imageDir . '/Panzer Dragoon Mini (Japan) (En)-artwork.png', $imageDir . '/Panzer Dragoon Mini-artwork.png')) {
            echo "✓ Panzer Dragoon Mini (Japan) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Panzer Dragoon Mini-artwork.png\n";
        $skipped++;
    }
}

// Panzer Dragoon Mini (Japan) (En) → Panzer Dragoon Mini
if (file_exists($imageDir . '/Panzer Dragoon Mini (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Panzer Dragoon Mini-cover.png')) {
        if (rename($imageDir . '/Panzer Dragoon Mini (Japan) (En)-cover.png', $imageDir . '/Panzer Dragoon Mini-cover.png')) {
            echo "✓ Panzer Dragoon Mini (Japan) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Panzer Dragoon Mini-cover.png\n";
        $skipped++;
    }
}

// Panzer Dragoon Mini (Japan) (En) → Panzer Dragoon Mini
if (file_exists($imageDir . '/Panzer Dragoon Mini (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Panzer Dragoon Mini-gameplay.png')) {
        if (rename($imageDir . '/Panzer Dragoon Mini (Japan) (En)-gameplay.png', $imageDir . '/Panzer Dragoon Mini-gameplay.png')) {
            echo "✓ Panzer Dragoon Mini (Japan) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Panzer Dragoon Mini-gameplay.png\n";
        $skipped++;
    }
}

// Paperboy 2 (USA) → Paperboy 2
if (file_exists($imageDir . '/Paperboy 2 (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Paperboy 2-artwork.png')) {
        if (rename($imageDir . '/Paperboy 2 (USA)-artwork.png', $imageDir . '/Paperboy 2-artwork.png')) {
            echo "✓ Paperboy 2 (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Paperboy 2-artwork.png\n";
        $skipped++;
    }
}

// Paperboy 2 (USA) → Paperboy 2
if (file_exists($imageDir . '/Paperboy 2 (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Paperboy 2-cover.png')) {
        if (rename($imageDir . '/Paperboy 2 (USA)-cover.png', $imageDir . '/Paperboy 2-cover.png')) {
            echo "✓ Paperboy 2 (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Paperboy 2-cover.png\n";
        $skipped++;
    }
}

// Paperboy 2 (USA) → Paperboy 2
if (file_exists($imageDir . '/Paperboy 2 (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Paperboy 2-gameplay.png')) {
        if (rename($imageDir . '/Paperboy 2 (USA)-gameplay.png', $imageDir . '/Paperboy 2-gameplay.png')) {
            echo "✓ Paperboy 2 (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Paperboy 2-gameplay.png\n";
        $skipped++;
    }
}

// Pete Sampras Tennis (USA, Europe) → Pete Sampras Tennis
if (file_exists($imageDir . '/Pete Sampras Tennis (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Pete Sampras Tennis-artwork.png')) {
        if (rename($imageDir . '/Pete Sampras Tennis (USA, Europe)-artwork.png', $imageDir . '/Pete Sampras Tennis-artwork.png')) {
            echo "✓ Pete Sampras Tennis (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pete Sampras Tennis-artwork.png\n";
        $skipped++;
    }
}

// Pete Sampras Tennis (USA, Europe) → Pete Sampras Tennis
if (file_exists($imageDir . '/Pete Sampras Tennis (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Pete Sampras Tennis-cover.png')) {
        if (rename($imageDir . '/Pete Sampras Tennis (USA, Europe)-cover.png', $imageDir . '/Pete Sampras Tennis-cover.png')) {
            echo "✓ Pete Sampras Tennis (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pete Sampras Tennis-cover.png\n";
        $skipped++;
    }
}

// Pete Sampras Tennis (USA, Europe) → Pete Sampras Tennis
if (file_exists($imageDir . '/Pete Sampras Tennis (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Pete Sampras Tennis-gameplay.png')) {
        if (rename($imageDir . '/Pete Sampras Tennis (USA, Europe)-gameplay.png', $imageDir . '/Pete Sampras Tennis-gameplay.png')) {
            echo "✓ Pete Sampras Tennis (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pete Sampras Tennis-gameplay.png\n";
        $skipped++;
    }
}

// Phantasy Star Adventure (Japan) → Phantasy Star Adventure
if (file_exists($imageDir . '/Phantasy Star Adventure (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Adventure-artwork.png')) {
        if (rename($imageDir . '/Phantasy Star Adventure (Japan)-artwork.png', $imageDir . '/Phantasy Star Adventure-artwork.png')) {
            echo "✓ Phantasy Star Adventure (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Adventure-artwork.png\n";
        $skipped++;
    }
}

// Phantasy Star Adventure (Japan) → Phantasy Star Adventure
if (file_exists($imageDir . '/Phantasy Star Adventure (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Adventure-cover.png')) {
        if (rename($imageDir . '/Phantasy Star Adventure (Japan)-cover.png', $imageDir . '/Phantasy Star Adventure-cover.png')) {
            echo "✓ Phantasy Star Adventure (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Adventure-cover.png\n";
        $skipped++;
    }
}

// Phantasy Star Adventure (Japan) → Phantasy Star Adventure
if (file_exists($imageDir . '/Phantasy Star Adventure (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Adventure-gameplay.png')) {
        if (rename($imageDir . '/Phantasy Star Adventure (Japan)-gameplay.png', $imageDir . '/Phantasy Star Adventure-gameplay.png')) {
            echo "✓ Phantasy Star Adventure (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Adventure-gameplay.png\n";
        $skipped++;
    }
}

// Phantasy Star Gaiden (Japan) → Phantasy Star Gaiden
if (file_exists($imageDir . '/Phantasy Star Gaiden (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Gaiden-artwork.png')) {
        if (rename($imageDir . '/Phantasy Star Gaiden (Japan)-artwork.png', $imageDir . '/Phantasy Star Gaiden-artwork.png')) {
            echo "✓ Phantasy Star Gaiden (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Gaiden-artwork.png\n";
        $skipped++;
    }
}

// Phantasy Star Gaiden (Japan) → Phantasy Star Gaiden
if (file_exists($imageDir . '/Phantasy Star Gaiden (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Gaiden-cover.png')) {
        if (rename($imageDir . '/Phantasy Star Gaiden (Japan)-cover.png', $imageDir . '/Phantasy Star Gaiden-cover.png')) {
            echo "✓ Phantasy Star Gaiden (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Gaiden-cover.png\n";
        $skipped++;
    }
}

// Phantasy Star Gaiden (Japan) → Phantasy Star Gaiden
if (file_exists($imageDir . '/Phantasy Star Gaiden (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Gaiden-gameplay.png')) {
        if (rename($imageDir . '/Phantasy Star Gaiden (Japan)-gameplay.png', $imageDir . '/Phantasy Star Gaiden-gameplay.png')) {
            echo "✓ Phantasy Star Gaiden (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Gaiden-gameplay.png\n";
        $skipped++;
    }
}

// Phantasy Star Gaiden (Japan)[tr en] → Phantasy Star Adventure (Japan)[tr en AGTP][v1.00]
if (file_exists($imageDir . '/Phantasy Star Gaiden (Japan)[tr en]-cover.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Adventure (Japan)[tr en AGTP][v1.00]-cover.png')) {
        if (rename($imageDir . '/Phantasy Star Gaiden (Japan)[tr en]-cover.png', $imageDir . '/Phantasy Star Adventure (Japan)[tr en AGTP][v1.00]-cover.png')) {
            echo "✓ Phantasy Star Gaiden (Japan)[tr en]-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Adventure (Japan)[tr en AGTP][v1.00]-cover.png\n";
        $skipped++;
    }
}

// Phantasy Star Gaiden (Japan)[tr pt] → Phantasy Star Adventure (Japan)[tr pt CBT][pt-br]
if (file_exists($imageDir . '/Phantasy Star Gaiden (Japan)[tr pt]-cover.png')) {
    if (!file_exists($imageDir . '/Phantasy Star Adventure (Japan)[tr pt CBT][pt-br]-cover.png')) {
        if (rename($imageDir . '/Phantasy Star Gaiden (Japan)[tr pt]-cover.png', $imageDir . '/Phantasy Star Adventure (Japan)[tr pt CBT][pt-br]-cover.png')) {
            echo "✓ Phantasy Star Gaiden (Japan)[tr pt]-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Phantasy Star Adventure (Japan)[tr pt CBT][pt-br]-cover.png\n";
        $skipped++;
    }
}

// Pinball Dreams (USA) → Pinball Dreams
if (file_exists($imageDir . '/Pinball Dreams (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Pinball Dreams-artwork.png')) {
        if (rename($imageDir . '/Pinball Dreams (USA)-artwork.png', $imageDir . '/Pinball Dreams-artwork.png')) {
            echo "✓ Pinball Dreams (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pinball Dreams-artwork.png\n";
        $skipped++;
    }
}

// Pinball Dreams (USA) → Pinball Dreams
if (file_exists($imageDir . '/Pinball Dreams (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Pinball Dreams-cover.png')) {
        if (rename($imageDir . '/Pinball Dreams (USA)-cover.png', $imageDir . '/Pinball Dreams-cover.png')) {
            echo "✓ Pinball Dreams (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pinball Dreams-cover.png\n";
        $skipped++;
    }
}

// Pinball Dreams (USA) → Pinball Dreams
if (file_exists($imageDir . '/Pinball Dreams (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Pinball Dreams-gameplay.png')) {
        if (rename($imageDir . '/Pinball Dreams (USA)-gameplay.png', $imageDir . '/Pinball Dreams-gameplay.png')) {
            echo "✓ Pinball Dreams (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pinball Dreams-gameplay.png\n";
        $skipped++;
    }
}

// Pocket Jansou (Japan) → Pocket Jansou
if (file_exists($imageDir . '/Pocket Jansou (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Pocket Jansou-artwork.png')) {
        if (rename($imageDir . '/Pocket Jansou (Japan)-artwork.png', $imageDir . '/Pocket Jansou-artwork.png')) {
            echo "✓ Pocket Jansou (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pocket Jansou-artwork.png\n";
        $skipped++;
    }
}

// Pocket Jansou (Japan) → Pocket Jansou
if (file_exists($imageDir . '/Pocket Jansou (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Pocket Jansou-cover.png')) {
        if (rename($imageDir . '/Pocket Jansou (Japan)-cover.png', $imageDir . '/Pocket Jansou-cover.png')) {
            echo "✓ Pocket Jansou (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pocket Jansou-cover.png\n";
        $skipped++;
    }
}

// Pocket Jansou (Japan) → Pocket Jansou
if (file_exists($imageDir . '/Pocket Jansou (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Pocket Jansou-gameplay.png')) {
        if (rename($imageDir . '/Pocket Jansou (Japan)-gameplay.png', $imageDir . '/Pocket Jansou-gameplay.png')) {
            echo "✓ Pocket Jansou (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pocket Jansou-gameplay.png\n";
        $skipped++;
    }
}

// Popeye no Beach Volleyball (Japan) → Popeye no Beach Volleyball
if (file_exists($imageDir . '/Popeye no Beach Volleyball (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Popeye no Beach Volleyball-artwork.png')) {
        if (rename($imageDir . '/Popeye no Beach Volleyball (Japan)-artwork.png', $imageDir . '/Popeye no Beach Volleyball-artwork.png')) {
            echo "✓ Popeye no Beach Volleyball (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Popeye no Beach Volleyball-artwork.png\n";
        $skipped++;
    }
}

// Popeye no Beach Volleyball (Japan) → Popeye no Beach Volleyball
if (file_exists($imageDir . '/Popeye no Beach Volleyball (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Popeye no Beach Volleyball-cover.png')) {
        if (rename($imageDir . '/Popeye no Beach Volleyball (Japan)-cover.png', $imageDir . '/Popeye no Beach Volleyball-cover.png')) {
            echo "✓ Popeye no Beach Volleyball (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Popeye no Beach Volleyball-cover.png\n";
        $skipped++;
    }
}

// Popeye no Beach Volleyball (Japan) → Popeye no Beach Volleyball
if (file_exists($imageDir . '/Popeye no Beach Volleyball (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Popeye no Beach Volleyball-gameplay.png')) {
        if (rename($imageDir . '/Popeye no Beach Volleyball (Japan)-gameplay.png', $imageDir . '/Popeye no Beach Volleyball-gameplay.png')) {
            echo "✓ Popeye no Beach Volleyball (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Popeye no Beach Volleyball-gameplay.png\n";
        $skipped++;
    }
}

// Power Drive (Europe) → Power Drive
if (file_exists($imageDir . '/Power Drive (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Power Drive-artwork.png')) {
        if (rename($imageDir . '/Power Drive (Europe)-artwork.png', $imageDir . '/Power Drive-artwork.png')) {
            echo "✓ Power Drive (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Power Drive-artwork.png\n";
        $skipped++;
    }
}

// Power Drive (Europe) → Power Drive
if (file_exists($imageDir . '/Power Drive (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Power Drive-cover.png')) {
        if (rename($imageDir . '/Power Drive (Europe)-cover.png', $imageDir . '/Power Drive-cover.png')) {
            echo "✓ Power Drive (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Power Drive-cover.png\n";
        $skipped++;
    }
}

// Power Drive (Europe) → Power Drive
if (file_exists($imageDir . '/Power Drive (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Power Drive-gameplay.png')) {
        if (rename($imageDir . '/Power Drive (Europe)-gameplay.png', $imageDir . '/Power Drive-gameplay.png')) {
            echo "✓ Power Drive (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Power Drive-gameplay.png\n";
        $skipped++;
    }
}

// Pro Yakyuu GG League (Japan) → Pro Yakyuu GG League
if (file_exists($imageDir . '/Pro Yakyuu GG League (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League-artwork.png')) {
        if (rename($imageDir . '/Pro Yakyuu GG League (Japan)-artwork.png', $imageDir . '/Pro Yakyuu GG League-artwork.png')) {
            echo "✓ Pro Yakyuu GG League (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu GG League-artwork.png\n";
        $skipped++;
    }
}

// Pro Yakyuu GG League (Japan) → Pro Yakyuu GG League
if (file_exists($imageDir . '/Pro Yakyuu GG League (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League-cover.png')) {
        if (rename($imageDir . '/Pro Yakyuu GG League (Japan)-cover.png', $imageDir . '/Pro Yakyuu GG League-cover.png')) {
            echo "✓ Pro Yakyuu GG League (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu GG League-cover.png\n";
        $skipped++;
    }
}

// Pro Yakyuu GG League (Japan) → Pro Yakyuu GG League
if (file_exists($imageDir . '/Pro Yakyuu GG League (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Pro Yakyuu GG League-gameplay.png')) {
        if (rename($imageDir . '/Pro Yakyuu GG League (Japan)-gameplay.png', $imageDir . '/Pro Yakyuu GG League-gameplay.png')) {
            echo "✓ Pro Yakyuu GG League (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Pro Yakyuu GG League-gameplay.png\n";
        $skipped++;
    }
}

// Puyo Puyo Tsuu (Japan) → Puyo Puyo Tsuu
if (file_exists($imageDir . '/Puyo Puyo Tsuu (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Puyo Puyo Tsuu-artwork.png')) {
        if (rename($imageDir . '/Puyo Puyo Tsuu (Japan)-artwork.png', $imageDir . '/Puyo Puyo Tsuu-artwork.png')) {
            echo "✓ Puyo Puyo Tsuu (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puyo Puyo Tsuu-artwork.png\n";
        $skipped++;
    }
}

// Puyo Puyo Tsuu (Japan) → Puyo Puyo Tsuu
if (file_exists($imageDir . '/Puyo Puyo Tsuu (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Puyo Puyo Tsuu-cover.png')) {
        if (rename($imageDir . '/Puyo Puyo Tsuu (Japan)-cover.png', $imageDir . '/Puyo Puyo Tsuu-cover.png')) {
            echo "✓ Puyo Puyo Tsuu (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puyo Puyo Tsuu-cover.png\n";
        $skipped++;
    }
}

// Puyo Puyo Tsuu (Japan) → Puyo Puyo Tsuu
if (file_exists($imageDir . '/Puyo Puyo Tsuu (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Puyo Puyo Tsuu-gameplay.png')) {
        if (rename($imageDir . '/Puyo Puyo Tsuu (Japan)-gameplay.png', $imageDir . '/Puyo Puyo Tsuu-gameplay.png')) {
            echo "✓ Puyo Puyo Tsuu (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puyo Puyo Tsuu-gameplay.png\n";
        $skipped++;
    }
}

// Puzzle Bobble (Japan) → Puzzle Bobble
if (file_exists($imageDir . '/Puzzle Bobble (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Puzzle Bobble-artwork.png')) {
        if (rename($imageDir . '/Puzzle Bobble (Japan)-artwork.png', $imageDir . '/Puzzle Bobble-artwork.png')) {
            echo "✓ Puzzle Bobble (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle Bobble-artwork.png\n";
        $skipped++;
    }
}

// Puzzle Bobble (Japan) → Puzzle Bobble
if (file_exists($imageDir . '/Puzzle Bobble (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Puzzle Bobble-cover.png')) {
        if (rename($imageDir . '/Puzzle Bobble (Japan)-cover.png', $imageDir . '/Puzzle Bobble-cover.png')) {
            echo "✓ Puzzle Bobble (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle Bobble-cover.png\n";
        $skipped++;
    }
}

// Puzzle Bobble (Japan) → Puzzle Bobble
if (file_exists($imageDir . '/Puzzle Bobble (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Puzzle Bobble-gameplay.png')) {
        if (rename($imageDir . '/Puzzle Bobble (Japan)-gameplay.png', $imageDir . '/Puzzle Bobble-gameplay.png')) {
            echo "✓ Puzzle Bobble (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle Bobble-gameplay.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Ichidanto-R (Japan) → Puzzle _ Action - Ichidanto-R
if (file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R-artwork.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-artwork.png', $imageDir . '/Puzzle _ Action - Ichidanto-R-artwork.png')) {
            echo "✓ Puzzle _ Action - Ichidanto-R (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Ichidanto-R-artwork.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Ichidanto-R (Japan) → Puzzle _ Action - Ichidanto-R
if (file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R-cover.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-cover.png', $imageDir . '/Puzzle _ Action - Ichidanto-R-cover.png')) {
            echo "✓ Puzzle _ Action - Ichidanto-R (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Ichidanto-R-cover.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Ichidanto-R (Japan) → Puzzle _ Action - Ichidanto-R
if (file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Ichidanto-R-gameplay.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Ichidanto-R (Japan)-gameplay.png', $imageDir . '/Puzzle _ Action - Ichidanto-R-gameplay.png')) {
            echo "✓ Puzzle _ Action - Ichidanto-R (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Ichidanto-R-gameplay.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Tanto-R (Japan) → Puzzle _ Action - Tanto-R
if (file_exists($imageDir . '/Puzzle _ Action - Tanto-R (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Tanto-R-artwork.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Tanto-R (Japan)-artwork.png', $imageDir . '/Puzzle _ Action - Tanto-R-artwork.png')) {
            echo "✓ Puzzle _ Action - Tanto-R (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Tanto-R-artwork.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Tanto-R (Japan) → Puzzle _ Action - Tanto-R
if (file_exists($imageDir . '/Puzzle _ Action - Tanto-R (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Tanto-R-cover.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Tanto-R (Japan)-cover.png', $imageDir . '/Puzzle _ Action - Tanto-R-cover.png')) {
            echo "✓ Puzzle _ Action - Tanto-R (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Tanto-R-cover.png\n";
        $skipped++;
    }
}

// Puzzle _ Action - Tanto-R (Japan) → Puzzle _ Action - Tanto-R
if (file_exists($imageDir . '/Puzzle _ Action - Tanto-R (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Puzzle _ Action - Tanto-R-gameplay.png')) {
        if (rename($imageDir . '/Puzzle _ Action - Tanto-R (Japan)-gameplay.png', $imageDir . '/Puzzle _ Action - Tanto-R-gameplay.png')) {
            echo "✓ Puzzle _ Action - Tanto-R (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Puzzle _ Action - Tanto-R-gameplay.png\n";
        $skipped++;
    }
}

// Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe) → Quest for the Shaven Yak Starring Ren Hoek _ Stimpy
if (file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-artwork.png')) {
        if (rename($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-artwork.png', $imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-artwork.png')) {
            echo "✓ Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-artwork.png\n";
        $skipped++;
    }
}

// Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe) → Quest for the Shaven Yak Starring Ren Hoek _ Stimpy
if (file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-cover.png')) {
        if (rename($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-cover.png', $imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-cover.png')) {
            echo "✓ Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-cover.png\n";
        $skipped++;
    }
}

// Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe) → Quest for the Shaven Yak Starring Ren Hoek _ Stimpy
if (file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-gameplay.png')) {
        if (rename($imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-gameplay.png', $imageDir . '/Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-gameplay.png')) {
            echo "✓ Quest for the Shaven Yak Starring Ren Hoek _ Stimpy (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Quest for the Shaven Yak Starring Ren Hoek _ Stimpy-gameplay.png\n";
        $skipped++;
    }
}

// R B I Baseball 94 (USA) → R.B.I. Baseball '94
if (file_exists($imageDir . '/R B I Baseball 94 (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/R.B.I. Baseball \'94-artwork.png')) {
        if (rename($imageDir . '/R B I Baseball 94 (USA)-artwork.png', $imageDir . '/R.B.I. Baseball \'94-artwork.png')) {
            echo "✓ R B I Baseball 94 (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: R.B.I. Baseball \'94-artwork.png\n";
        $skipped++;
    }
}

// R B I Baseball 94 (USA) → R.B.I. Baseball '94
if (file_exists($imageDir . '/R B I Baseball 94 (USA)-cover.png')) {
    if (!file_exists($imageDir . '/R.B.I. Baseball \'94-cover.png')) {
        if (rename($imageDir . '/R B I Baseball 94 (USA)-cover.png', $imageDir . '/R.B.I. Baseball \'94-cover.png')) {
            echo "✓ R B I Baseball 94 (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: R.B.I. Baseball \'94-cover.png\n";
        $skipped++;
    }
}

// R B I Baseball 94 (USA) → R.B.I. Baseball '94
if (file_exists($imageDir . '/R B I Baseball 94 (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/R.B.I. Baseball \'94-gameplay.png')) {
        if (rename($imageDir . '/R B I Baseball 94 (USA)-gameplay.png', $imageDir . '/R.B.I. Baseball \'94-gameplay.png')) {
            echo "✓ R B I Baseball 94 (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: R.B.I. Baseball \'94-gameplay.png\n";
        $skipped++;
    }
}

// Rastan Saga (Japan) → Rastan Saga
if (file_exists($imageDir . '/Rastan Saga (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Rastan Saga-artwork.png')) {
        if (rename($imageDir . '/Rastan Saga (Japan)-artwork.png', $imageDir . '/Rastan Saga-artwork.png')) {
            echo "✓ Rastan Saga (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rastan Saga-artwork.png\n";
        $skipped++;
    }
}

// Rastan Saga (Japan) → Rastan Saga
if (file_exists($imageDir . '/Rastan Saga (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Rastan Saga-cover.png')) {
        if (rename($imageDir . '/Rastan Saga (Japan)-cover.png', $imageDir . '/Rastan Saga-cover.png')) {
            echo "✓ Rastan Saga (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rastan Saga-cover.png\n";
        $skipped++;
    }
}

// Rastan Saga (Japan) → Rastan Saga
if (file_exists($imageDir . '/Rastan Saga (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Rastan Saga-gameplay.png')) {
        if (rename($imageDir . '/Rastan Saga (Japan)-gameplay.png', $imageDir . '/Rastan Saga-gameplay.png')) {
            echo "✓ Rastan Saga (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rastan Saga-gameplay.png\n";
        $skipped++;
    }
}

// Riddick Bowe Boxing (Japan) (En) → Riddick Bowe Boxing
if (file_exists($imageDir . '/Riddick Bowe Boxing (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Riddick Bowe Boxing-artwork.png')) {
        if (rename($imageDir . '/Riddick Bowe Boxing (Japan) (En)-artwork.png', $imageDir . '/Riddick Bowe Boxing-artwork.png')) {
            echo "✓ Riddick Bowe Boxing (Japan) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Riddick Bowe Boxing-artwork.png\n";
        $skipped++;
    }
}

// Riddick Bowe Boxing (Japan) (En) → Riddick Bowe Boxing
if (file_exists($imageDir . '/Riddick Bowe Boxing (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Riddick Bowe Boxing-cover.png')) {
        if (rename($imageDir . '/Riddick Bowe Boxing (Japan) (En)-cover.png', $imageDir . '/Riddick Bowe Boxing-cover.png')) {
            echo "✓ Riddick Bowe Boxing (Japan) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Riddick Bowe Boxing-cover.png\n";
        $skipped++;
    }
}

// Riddick Bowe Boxing (Japan) (En) → Riddick Bowe Boxing
if (file_exists($imageDir . '/Riddick Bowe Boxing (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Riddick Bowe Boxing-gameplay.png')) {
        if (rename($imageDir . '/Riddick Bowe Boxing (Japan) (En)-gameplay.png', $imageDir . '/Riddick Bowe Boxing-gameplay.png')) {
            echo "✓ Riddick Bowe Boxing (Japan) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Riddick Bowe Boxing-gameplay.png\n";
        $skipped++;
    }
}

// Riddick Bowe Boxing (USA) → Riddick Bowe Boxing
if (file_exists($imageDir . '/Riddick Bowe Boxing (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Riddick Bowe Boxing-artwork.png')) {
        if (rename($imageDir . '/Riddick Bowe Boxing (USA)-artwork.png', $imageDir . '/Riddick Bowe Boxing-artwork.png')) {
            echo "✓ Riddick Bowe Boxing (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Riddick Bowe Boxing-artwork.png\n";
        $skipped++;
    }
}

// Riddick Bowe Boxing (USA) → Riddick Bowe Boxing
if (file_exists($imageDir . '/Riddick Bowe Boxing (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Riddick Bowe Boxing-cover.png')) {
        if (rename($imageDir . '/Riddick Bowe Boxing (USA)-cover.png', $imageDir . '/Riddick Bowe Boxing-cover.png')) {
            echo "✓ Riddick Bowe Boxing (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Riddick Bowe Boxing-cover.png\n";
        $skipped++;
    }
}

// Riddick Bowe Boxing (USA) → Riddick Bowe Boxing
if (file_exists($imageDir . '/Riddick Bowe Boxing (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Riddick Bowe Boxing-gameplay.png')) {
        if (rename($imageDir . '/Riddick Bowe Boxing (USA)-gameplay.png', $imageDir . '/Riddick Bowe Boxing-gameplay.png')) {
            echo "✓ Riddick Bowe Boxing (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Riddick Bowe Boxing-gameplay.png\n";
        $skipped++;
    }
}

// Rise of the Robots (USA, Europe) → Rise of the Robots
if (file_exists($imageDir . '/Rise of the Robots (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Rise of the Robots-artwork.png')) {
        if (rename($imageDir . '/Rise of the Robots (USA, Europe)-artwork.png', $imageDir . '/Rise of the Robots-artwork.png')) {
            echo "✓ Rise of the Robots (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rise of the Robots-artwork.png\n";
        $skipped++;
    }
}

// Rise of the Robots (USA, Europe) → Rise of the Robots
if (file_exists($imageDir . '/Rise of the Robots (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Rise of the Robots-cover.png')) {
        if (rename($imageDir . '/Rise of the Robots (USA, Europe)-cover.png', $imageDir . '/Rise of the Robots-cover.png')) {
            echo "✓ Rise of the Robots (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rise of the Robots-cover.png\n";
        $skipped++;
    }
}

// Rise of the Robots (USA, Europe) → Rise of the Robots
if (file_exists($imageDir . '/Rise of the Robots (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Rise of the Robots-gameplay.png')) {
        if (rename($imageDir . '/Rise of the Robots (USA, Europe)-gameplay.png', $imageDir . '/Rise of the Robots-gameplay.png')) {
            echo "✓ Rise of the Robots (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Rise of the Robots-gameplay.png\n";
        $skipped++;
    }
}

// Road Rash (USA) → Road Rash
if (file_exists($imageDir . '/Road Rash (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Road Rash-artwork.png')) {
        if (rename($imageDir . '/Road Rash (USA)-artwork.png', $imageDir . '/Road Rash-artwork.png')) {
            echo "✓ Road Rash (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Road Rash-artwork.png\n";
        $skipped++;
    }
}

// Road Rash (USA) → Road Rash
if (file_exists($imageDir . '/Road Rash (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Road Rash-cover.png')) {
        if (rename($imageDir . '/Road Rash (USA)-cover.png', $imageDir . '/Road Rash-cover.png')) {
            echo "✓ Road Rash (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Road Rash-cover.png\n";
        $skipped++;
    }
}

// Road Rash (USA) → Road Rash
if (file_exists($imageDir . '/Road Rash (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Road Rash-gameplay.png')) {
        if (rename($imageDir . '/Road Rash (USA)-gameplay.png', $imageDir . '/Road Rash-gameplay.png')) {
            echo "✓ Road Rash (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Road Rash-gameplay.png\n";
        $skipped++;
    }
}

// RoboCop Versus The Terminator (USA, Europe) → RoboCop Versus The Terminator
if (file_exists($imageDir . '/RoboCop Versus The Terminator (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/RoboCop Versus The Terminator-artwork.png')) {
        if (rename($imageDir . '/RoboCop Versus The Terminator (USA, Europe)-artwork.png', $imageDir . '/RoboCop Versus The Terminator-artwork.png')) {
            echo "✓ RoboCop Versus The Terminator (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: RoboCop Versus The Terminator-artwork.png\n";
        $skipped++;
    }
}

// RoboCop Versus The Terminator (USA, Europe) → RoboCop Versus The Terminator
if (file_exists($imageDir . '/RoboCop Versus The Terminator (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/RoboCop Versus The Terminator-cover.png')) {
        if (rename($imageDir . '/RoboCop Versus The Terminator (USA, Europe)-cover.png', $imageDir . '/RoboCop Versus The Terminator-cover.png')) {
            echo "✓ RoboCop Versus The Terminator (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: RoboCop Versus The Terminator-cover.png\n";
        $skipped++;
    }
}

// RoboCop Versus The Terminator (USA, Europe) → RoboCop Versus The Terminator
if (file_exists($imageDir . '/RoboCop Versus The Terminator (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/RoboCop Versus The Terminator-gameplay.png')) {
        if (rename($imageDir . '/RoboCop Versus The Terminator (USA, Europe)-gameplay.png', $imageDir . '/RoboCop Versus The Terminator-gameplay.png')) {
            echo "✓ RoboCop Versus The Terminator (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: RoboCop Versus The Terminator-gameplay.png\n";
        $skipped++;
    }
}

// Royal Stone (USA) → Royal Stone
if (file_exists($imageDir . '/Royal Stone (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Royal Stone-artwork.png')) {
        if (rename($imageDir . '/Royal Stone (USA)-artwork.png', $imageDir . '/Royal Stone-artwork.png')) {
            echo "✓ Royal Stone (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone-artwork.png\n";
        $skipped++;
    }
}

// Royal Stone (USA) → Royal Stone
if (file_exists($imageDir . '/Royal Stone (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Royal Stone-cover.png')) {
        if (rename($imageDir . '/Royal Stone (USA)-cover.png', $imageDir . '/Royal Stone-cover.png')) {
            echo "✓ Royal Stone (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone-cover.png\n";
        $skipped++;
    }
}

// Royal Stone (USA) → Royal Stone
if (file_exists($imageDir . '/Royal Stone (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Royal Stone-gameplay.png')) {
        if (rename($imageDir . '/Royal Stone (USA)-gameplay.png', $imageDir . '/Royal Stone-gameplay.png')) {
            echo "✓ Royal Stone (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone-gameplay.png\n";
        $skipped++;
    }
}

// Royal Stone - Hirakareshi Toki no Tobira (Japan) → Royal Stone - Hirakareshi Toki no Tobira
if (file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-artwork.png')) {
        if (rename($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-artwork.png', $imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-artwork.png')) {
            echo "✓ Royal Stone - Hirakareshi Toki no Tobira (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone - Hirakareshi Toki no Tobira-artwork.png\n";
        $skipped++;
    }
}

// Royal Stone - Hirakareshi Toki no Tobira (Japan) → Royal Stone - Hirakareshi Toki no Tobira
if (file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-cover.png')) {
        if (rename($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-cover.png', $imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-cover.png')) {
            echo "✓ Royal Stone - Hirakareshi Toki no Tobira (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone - Hirakareshi Toki no Tobira-cover.png\n";
        $skipped++;
    }
}

// Royal Stone - Hirakareshi Toki no Tobira (Japan) → Royal Stone - Hirakareshi Toki no Tobira
if (file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-gameplay.png')) {
        if (rename($imageDir . '/Royal Stone - Hirakareshi Toki no Tobira (Japan)-gameplay.png', $imageDir . '/Royal Stone - Hirakareshi Toki no Tobira-gameplay.png')) {
            echo "✓ Royal Stone - Hirakareshi Toki no Tobira (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Royal Stone - Hirakareshi Toki no Tobira-gameplay.png\n";
        $skipped++;
    }
}

// Samurai Shodown (USA) → Samurai Shodown
if (file_exists($imageDir . '/Samurai Shodown (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Samurai Shodown-artwork.png')) {
        if (rename($imageDir . '/Samurai Shodown (USA)-artwork.png', $imageDir . '/Samurai Shodown-artwork.png')) {
            echo "✓ Samurai Shodown (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Shodown-artwork.png\n";
        $skipped++;
    }
}

// Samurai Shodown (USA) → Samurai Shodown
if (file_exists($imageDir . '/Samurai Shodown (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Samurai Shodown-cover.png')) {
        if (rename($imageDir . '/Samurai Shodown (USA)-cover.png', $imageDir . '/Samurai Shodown-cover.png')) {
            echo "✓ Samurai Shodown (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Shodown-cover.png\n";
        $skipped++;
    }
}

// Samurai Shodown (USA) → Samurai Shodown
if (file_exists($imageDir . '/Samurai Shodown (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Samurai Shodown-gameplay.png')) {
        if (rename($imageDir . '/Samurai Shodown (USA)-gameplay.png', $imageDir . '/Samurai Shodown-gameplay.png')) {
            echo "✓ Samurai Shodown (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Shodown-gameplay.png\n";
        $skipped++;
    }
}

// Samurai Spirits (Japan) → Samurai Spirits
if (file_exists($imageDir . '/Samurai Spirits (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Samurai Spirits-artwork.png')) {
        if (rename($imageDir . '/Samurai Spirits (Japan)-artwork.png', $imageDir . '/Samurai Spirits-artwork.png')) {
            echo "✓ Samurai Spirits (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Spirits-artwork.png\n";
        $skipped++;
    }
}

// Samurai Spirits (Japan) → Samurai Spirits
if (file_exists($imageDir . '/Samurai Spirits (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Samurai Spirits-cover.png')) {
        if (rename($imageDir . '/Samurai Spirits (Japan)-cover.png', $imageDir . '/Samurai Spirits-cover.png')) {
            echo "✓ Samurai Spirits (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Spirits-cover.png\n";
        $skipped++;
    }
}

// Samurai Spirits (Japan) → Samurai Spirits
if (file_exists($imageDir . '/Samurai Spirits (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Samurai Spirits-gameplay.png')) {
        if (rename($imageDir . '/Samurai Spirits (Japan)-gameplay.png', $imageDir . '/Samurai Spirits-gameplay.png')) {
            echo "✓ Samurai Spirits (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Samurai Spirits-gameplay.png\n";
        $skipped++;
    }
}

// Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan) → Sassou Shounen Eiyuuden - Coca-Cola Kid
if (file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-artwork.png')) {
        if (rename($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-artwork.png', $imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-artwork.png')) {
            echo "✓ Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sassou Shounen Eiyuuden - Coca-Cola Kid-artwork.png\n";
        $skipped++;
    }
}

// Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan) → Sassou Shounen Eiyuuden - Coca-Cola Kid
if (file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-cover.png')) {
        if (rename($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-cover.png', $imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-cover.png')) {
            echo "✓ Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sassou Shounen Eiyuuden - Coca-Cola Kid-cover.png\n";
        $skipped++;
    }
}

// Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan) → Sassou Shounen Eiyuuden - Coca-Cola Kid
if (file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-gameplay.png')) {
        if (rename($imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-gameplay.png', $imageDir . '/Sassou Shounen Eiyuuden - Coca-Cola Kid-gameplay.png')) {
            echo "✓ Sassou Shounen Eiyuuden - Coca-Cola Kid (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sassou Shounen Eiyuuden - Coca-Cola Kid-gameplay.png\n";
        $skipped++;
    }
}

// Schtroumpfs Autour Du Monde Les Europe En Fr De (Es) → Schtroumpfs Autour du Monde, Les
if (file_exists($imageDir . '/Schtroumpfs Autour Du Monde Les Europe En Fr De (Es)-artwork.png')) {
    if (!file_exists($imageDir . '/Schtroumpfs Autour du Monde, Les-artwork.png')) {
        if (rename($imageDir . '/Schtroumpfs Autour Du Monde Les Europe En Fr De (Es)-artwork.png', $imageDir . '/Schtroumpfs Autour du Monde, Les-artwork.png')) {
            echo "✓ Schtroumpfs Autour Du Monde Les Europe En Fr De (Es)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Schtroumpfs Autour du Monde, Les-artwork.png\n";
        $skipped++;
    }
}

// Schtroumpfs Autour Du Monde Les Europe En Fr De (Es) → Schtroumpfs Autour du Monde, Les
if (file_exists($imageDir . '/Schtroumpfs Autour Du Monde Les Europe En Fr De (Es)-cover.png')) {
    if (!file_exists($imageDir . '/Schtroumpfs Autour du Monde, Les-cover.png')) {
        if (rename($imageDir . '/Schtroumpfs Autour Du Monde Les Europe En Fr De (Es)-cover.png', $imageDir . '/Schtroumpfs Autour du Monde, Les-cover.png')) {
            echo "✓ Schtroumpfs Autour Du Monde Les Europe En Fr De (Es)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Schtroumpfs Autour du Monde, Les-cover.png\n";
        $skipped++;
    }
}

// Scratch Golf (Japan) → Scratch Golf
if (file_exists($imageDir . '/Scratch Golf (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Scratch Golf-artwork.png')) {
        if (rename($imageDir . '/Scratch Golf (Japan)-artwork.png', $imageDir . '/Scratch Golf-artwork.png')) {
            echo "✓ Scratch Golf (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Scratch Golf-artwork.png\n";
        $skipped++;
    }
}

// Scratch Golf (Japan) → Scratch Golf
if (file_exists($imageDir . '/Scratch Golf (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Scratch Golf-cover.png')) {
        if (rename($imageDir . '/Scratch Golf (Japan)-cover.png', $imageDir . '/Scratch Golf-cover.png')) {
            echo "✓ Scratch Golf (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Scratch Golf-cover.png\n";
        $skipped++;
    }
}

// Scratch Golf (Japan) → Scratch Golf
if (file_exists($imageDir . '/Scratch Golf (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Scratch Golf-gameplay.png')) {
        if (rename($imageDir . '/Scratch Golf (Japan)-gameplay.png', $imageDir . '/Scratch Golf-gameplay.png')) {
            echo "✓ Scratch Golf (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Scratch Golf-gameplay.png\n";
        $skipped++;
    }
}

// Scratch Golf (USA) → Scratch Golf
if (file_exists($imageDir . '/Scratch Golf (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Scratch Golf-artwork.png')) {
        if (rename($imageDir . '/Scratch Golf (USA)-artwork.png', $imageDir . '/Scratch Golf-artwork.png')) {
            echo "✓ Scratch Golf (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Scratch Golf-artwork.png\n";
        $skipped++;
    }
}

// Scratch Golf (USA) → Scratch Golf
if (file_exists($imageDir . '/Scratch Golf (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Scratch Golf-cover.png')) {
        if (rename($imageDir . '/Scratch Golf (USA)-cover.png', $imageDir . '/Scratch Golf-cover.png')) {
            echo "✓ Scratch Golf (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Scratch Golf-cover.png\n";
        $skipped++;
    }
}

// Scratch Golf (USA) → Scratch Golf
if (file_exists($imageDir . '/Scratch Golf (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Scratch Golf-gameplay.png')) {
        if (rename($imageDir . '/Scratch Golf (USA)-gameplay.png', $imageDir . '/Scratch Golf-gameplay.png')) {
            echo "✓ Scratch Golf (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Scratch Golf-gameplay.png\n";
        $skipped++;
    }
}

// Sega Game Pack 4 in 1 (Europe) → Sega Game Pack 4 in 1
if (file_exists($imageDir . '/Sega Game Pack 4 in 1 (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Sega Game Pack 4 in 1-artwork.png')) {
        if (rename($imageDir . '/Sega Game Pack 4 in 1 (Europe)-artwork.png', $imageDir . '/Sega Game Pack 4 in 1-artwork.png')) {
            echo "✓ Sega Game Pack 4 in 1 (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sega Game Pack 4 in 1-artwork.png\n";
        $skipped++;
    }
}

// Sega Game Pack 4 in 1 (Europe) → Sega Game Pack 4 in 1
if (file_exists($imageDir . '/Sega Game Pack 4 in 1 (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Sega Game Pack 4 in 1-cover.png')) {
        if (rename($imageDir . '/Sega Game Pack 4 in 1 (Europe)-cover.png', $imageDir . '/Sega Game Pack 4 in 1-cover.png')) {
            echo "✓ Sega Game Pack 4 in 1 (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sega Game Pack 4 in 1-cover.png\n";
        $skipped++;
    }
}

// Sega Game Pack 4 in 1 (Europe) → Sega Game Pack 4 in 1
if (file_exists($imageDir . '/Sega Game Pack 4 in 1 (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sega Game Pack 4 in 1-gameplay.png')) {
        if (rename($imageDir . '/Sega Game Pack 4 in 1 (Europe)-gameplay.png', $imageDir . '/Sega Game Pack 4 in 1-gameplay.png')) {
            echo "✓ Sega Game Pack 4 in 1 (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sega Game Pack 4 in 1-gameplay.png\n";
        $skipped++;
    }
}

// Sensible Soccer - European Champions (Europe) → Sensible Soccer - European Champions
if (file_exists($imageDir . '/Sensible Soccer - European Champions (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Sensible Soccer - European Champions-artwork.png')) {
        if (rename($imageDir . '/Sensible Soccer - European Champions (Europe)-artwork.png', $imageDir . '/Sensible Soccer - European Champions-artwork.png')) {
            echo "✓ Sensible Soccer - European Champions (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sensible Soccer - European Champions-artwork.png\n";
        $skipped++;
    }
}

// Sensible Soccer - European Champions (Europe) → Sensible Soccer - European Champions
if (file_exists($imageDir . '/Sensible Soccer - European Champions (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Sensible Soccer - European Champions-cover.png')) {
        if (rename($imageDir . '/Sensible Soccer - European Champions (Europe)-cover.png', $imageDir . '/Sensible Soccer - European Champions-cover.png')) {
            echo "✓ Sensible Soccer - European Champions (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sensible Soccer - European Champions-cover.png\n";
        $skipped++;
    }
}

// Sensible Soccer - European Champions (Europe) → Sensible Soccer - European Champions
if (file_exists($imageDir . '/Sensible Soccer - European Champions (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sensible Soccer - European Champions-gameplay.png')) {
        if (rename($imageDir . '/Sensible Soccer - European Champions (Europe)-gameplay.png', $imageDir . '/Sensible Soccer - European Champions-gameplay.png')) {
            echo "✓ Sensible Soccer - European Champions (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sensible Soccer - European Champions-gameplay.png\n";
        $skipped++;
    }
}

// Shadam Crusader - Harukanaru Oukoku (Japan) → Shadam Crusader - Harukanaru Oukoku
if (file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku-artwork.png')) {
        if (rename($imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-artwork.png', $imageDir . '/Shadam Crusader - Harukanaru Oukoku-artwork.png')) {
            echo "✓ Shadam Crusader - Harukanaru Oukoku (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shadam Crusader - Harukanaru Oukoku-artwork.png\n";
        $skipped++;
    }
}

// Shadam Crusader - Harukanaru Oukoku (Japan) → Shadam Crusader - Harukanaru Oukoku
if (file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku-cover.png')) {
        if (rename($imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-cover.png', $imageDir . '/Shadam Crusader - Harukanaru Oukoku-cover.png')) {
            echo "✓ Shadam Crusader - Harukanaru Oukoku (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shadam Crusader - Harukanaru Oukoku-cover.png\n";
        $skipped++;
    }
}

// Shadam Crusader - Harukanaru Oukoku (Japan) → Shadam Crusader - Harukanaru Oukoku
if (file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Shadam Crusader - Harukanaru Oukoku-gameplay.png')) {
        if (rename($imageDir . '/Shadam Crusader - Harukanaru Oukoku (Japan)-gameplay.png', $imageDir . '/Shadam Crusader - Harukanaru Oukoku-gameplay.png')) {
            echo "✓ Shadam Crusader - Harukanaru Oukoku (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shadam Crusader - Harukanaru Oukoku-gameplay.png\n";
        $skipped++;
    }
}

// Shaq Fu (USA) → Shaq Fu
if (file_exists($imageDir . '/Shaq Fu (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Shaq Fu-artwork.png')) {
        if (rename($imageDir . '/Shaq Fu (USA)-artwork.png', $imageDir . '/Shaq Fu-artwork.png')) {
            echo "✓ Shaq Fu (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shaq Fu-artwork.png\n";
        $skipped++;
    }
}

// Shaq Fu (USA) → Shaq Fu
if (file_exists($imageDir . '/Shaq Fu (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Shaq Fu-cover.png')) {
        if (rename($imageDir . '/Shaq Fu (USA)-cover.png', $imageDir . '/Shaq Fu-cover.png')) {
            echo "✓ Shaq Fu (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shaq Fu-cover.png\n";
        $skipped++;
    }
}

// Shaq Fu (USA) → Shaq Fu
if (file_exists($imageDir . '/Shaq Fu (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Shaq Fu-gameplay.png')) {
        if (rename($imageDir . '/Shaq Fu (USA)-gameplay.png', $imageDir . '/Shaq Fu-gameplay.png')) {
            echo "✓ Shaq Fu (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shaq Fu-gameplay.png\n";
        $skipped++;
    }
}

// Shining Force - The Sword of Hajya (USA) → Shining Force - The Sword of Hajya
if (file_exists($imageDir . '/Shining Force - The Sword of Hajya (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Shining Force - The Sword of Hajya-artwork.png')) {
        if (rename($imageDir . '/Shining Force - The Sword of Hajya (USA)-artwork.png', $imageDir . '/Shining Force - The Sword of Hajya-artwork.png')) {
            echo "✓ Shining Force - The Sword of Hajya (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force - The Sword of Hajya-artwork.png\n";
        $skipped++;
    }
}

// Shining Force - The Sword of Hajya (USA) → Shining Force - The Sword of Hajya
if (file_exists($imageDir . '/Shining Force - The Sword of Hajya (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Shining Force - The Sword of Hajya-cover.png')) {
        if (rename($imageDir . '/Shining Force - The Sword of Hajya (USA)-cover.png', $imageDir . '/Shining Force - The Sword of Hajya-cover.png')) {
            echo "✓ Shining Force - The Sword of Hajya (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force - The Sword of Hajya-cover.png\n";
        $skipped++;
    }
}

// Shining Force - The Sword of Hajya (USA) → Shining Force - The Sword of Hajya
if (file_exists($imageDir . '/Shining Force - The Sword of Hajya (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Shining Force - The Sword of Hajya-gameplay.png')) {
        if (rename($imageDir . '/Shining Force - The Sword of Hajya (USA)-gameplay.png', $imageDir . '/Shining Force - The Sword of Hajya-gameplay.png')) {
            echo "✓ Shining Force - The Sword of Hajya (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force - The Sword of Hajya-gameplay.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan) → Shining Force Gaiden - Ensei, Jashin no Kuni e
if (file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-artwork.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-artwork.png', $imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-artwork.png')) {
            echo "✓ Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Ensei, Jashin no Kuni e-artwork.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan) → Shining Force Gaiden - Ensei, Jashin no Kuni e
if (file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-cover.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-cover.png', $imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-cover.png')) {
            echo "✓ Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Ensei, Jashin no Kuni e-cover.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan) → Shining Force Gaiden - Ensei, Jashin no Kuni e
if (file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-gameplay.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-gameplay.png', $imageDir . '/Shining Force Gaiden - Ensei, Jashin no Kuni e-gameplay.png')) {
            echo "✓ Shining Force Gaiden - Ensei, Jashin no Kuni e (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Ensei, Jashin no Kuni e-gameplay.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Final Conflict (Japan) → Shining Force Gaiden - Final Conflict
if (file_exists($imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Final Conflict-artwork.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-artwork.png', $imageDir . '/Shining Force Gaiden - Final Conflict-artwork.png')) {
            echo "✓ Shining Force Gaiden - Final Conflict (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Final Conflict-artwork.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Final Conflict (Japan) → Shining Force Gaiden - Final Conflict
if (file_exists($imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Final Conflict-cover.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-cover.png', $imageDir . '/Shining Force Gaiden - Final Conflict-cover.png')) {
            echo "✓ Shining Force Gaiden - Final Conflict (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Final Conflict-cover.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden - Final Conflict (Japan) → Shining Force Gaiden - Final Conflict
if (file_exists($imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden - Final Conflict-gameplay.png')) {
        if (rename($imageDir . '/Shining Force Gaiden - Final Conflict (Japan)-gameplay.png', $imageDir . '/Shining Force Gaiden - Final Conflict-gameplay.png')) {
            echo "✓ Shining Force Gaiden - Final Conflict (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden - Final Conflict-gameplay.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden II - Jashin no Kakusei (Japan) → Shining Force Gaiden II - Jashin no Kakusei
if (file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-artwork.png')) {
        if (rename($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-artwork.png', $imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-artwork.png')) {
            echo "✓ Shining Force Gaiden II - Jashin no Kakusei (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden II - Jashin no Kakusei-artwork.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden II - Jashin no Kakusei (Japan) → Shining Force Gaiden II - Jashin no Kakusei
if (file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-cover.png')) {
        if (rename($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-cover.png', $imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-cover.png')) {
            echo "✓ Shining Force Gaiden II - Jashin no Kakusei (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden II - Jashin no Kakusei-cover.png\n";
        $skipped++;
    }
}

// Shining Force Gaiden II - Jashin no Kakusei (Japan) → Shining Force Gaiden II - Jashin no Kakusei
if (file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-gameplay.png')) {
        if (rename($imageDir . '/Shining Force Gaiden II - Jashin no Kakusei (Japan)-gameplay.png', $imageDir . '/Shining Force Gaiden II - Jashin no Kakusei-gameplay.png')) {
            echo "✓ Shining Force Gaiden II - Jashin no Kakusei (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shining Force Gaiden II - Jashin no Kakusei-gameplay.png\n";
        $skipped++;
    }
}

// Shinobi II - The Silent Fury (USA, Europe) → Shinobi II - The Silent Fury
if (file_exists($imageDir . '/Shinobi II - The Silent Fury (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Shinobi II - The Silent Fury-cover.png')) {
        if (rename($imageDir . '/Shinobi II - The Silent Fury (USA, Europe)-cover.png', $imageDir . '/Shinobi II - The Silent Fury-cover.png')) {
            echo "✓ Shinobi II - The Silent Fury (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shinobi II - The Silent Fury-cover.png\n";
        $skipped++;
    }
}

// Shinobi II - The Silent Fury (World) → Shinobi II - The Silent Fury
if (file_exists($imageDir . '/Shinobi II - The Silent Fury (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Shinobi II - The Silent Fury-artwork.png')) {
        if (rename($imageDir . '/Shinobi II - The Silent Fury (World)-artwork.png', $imageDir . '/Shinobi II - The Silent Fury-artwork.png')) {
            echo "✓ Shinobi II - The Silent Fury (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shinobi II - The Silent Fury-artwork.png\n";
        $skipped++;
    }
}

// Shinobi II - The Silent Fury (World) → Shinobi II - The Silent Fury
if (file_exists($imageDir . '/Shinobi II - The Silent Fury (World)-cover.png')) {
    if (!file_exists($imageDir . '/Shinobi II - The Silent Fury-cover.png')) {
        if (rename($imageDir . '/Shinobi II - The Silent Fury (World)-cover.png', $imageDir . '/Shinobi II - The Silent Fury-cover.png')) {
            echo "✓ Shinobi II - The Silent Fury (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shinobi II - The Silent Fury-cover.png\n";
        $skipped++;
    }
}

// Shinobi II - The Silent Fury (World) → Shinobi II - The Silent Fury
if (file_exists($imageDir . '/Shinobi II - The Silent Fury (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Shinobi II - The Silent Fury-gameplay.png')) {
        if (rename($imageDir . '/Shinobi II - The Silent Fury (World)-gameplay.png', $imageDir . '/Shinobi II - The Silent Fury-gameplay.png')) {
            echo "✓ Shinobi II - The Silent Fury (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Shinobi II - The Silent Fury-gameplay.png\n";
        $skipped++;
    }
}

// Side Pocket (USA) → Side Pocket
if (file_exists($imageDir . '/Side Pocket (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Side Pocket-artwork.png')) {
        if (rename($imageDir . '/Side Pocket (USA)-artwork.png', $imageDir . '/Side Pocket-artwork.png')) {
            echo "✓ Side Pocket (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Side Pocket-artwork.png\n";
        $skipped++;
    }
}

// Side Pocket (USA) → Side Pocket
if (file_exists($imageDir . '/Side Pocket (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Side Pocket-cover.png')) {
        if (rename($imageDir . '/Side Pocket (USA)-cover.png', $imageDir . '/Side Pocket-cover.png')) {
            echo "✓ Side Pocket (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Side Pocket-cover.png\n";
        $skipped++;
    }
}

// Side Pocket (USA) → Side Pocket
if (file_exists($imageDir . '/Side Pocket (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Side Pocket-gameplay.png')) {
        if (rename($imageDir . '/Side Pocket (USA)-gameplay.png', $imageDir . '/Side Pocket-gameplay.png')) {
            echo "✓ Side Pocket (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Side Pocket-gameplay.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bartman Meets Radioactive Man (USA) → Simpsons, The - Bartman Meets Radioactive Man
if (file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-artwork.png')) {
        if (rename($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-artwork.png', $imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-artwork.png')) {
            echo "✓ Simpsons, The - Bartman Meets Radioactive Man (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bartman Meets Radioactive Man-artwork.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bartman Meets Radioactive Man (USA) → Simpsons, The - Bartman Meets Radioactive Man
if (file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-cover.png')) {
        if (rename($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-cover.png', $imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-cover.png')) {
            echo "✓ Simpsons, The - Bartman Meets Radioactive Man (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bartman Meets Radioactive Man-cover.png\n";
        $skipped++;
    }
}

// Simpsons, The - Bartman Meets Radioactive Man (USA) → Simpsons, The - Bartman Meets Radioactive Man
if (file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-gameplay.png')) {
        if (rename($imageDir . '/Simpsons, The - Bartman Meets Radioactive Man (USA)-gameplay.png', $imageDir . '/Simpsons, The - Bartman Meets Radioactive Man-gameplay.png')) {
            echo "✓ Simpsons, The - Bartman Meets Radioactive Man (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Simpsons, The - Bartman Meets Radioactive Man-gameplay.png\n";
        $skipped++;
    }
}

// Smurfs Travel the World the Europe En Fr De (Es) → Smurfs Travel the World, The
if (file_exists($imageDir . '/Smurfs Travel the World the Europe En Fr De (Es)-artwork.png')) {
    if (!file_exists($imageDir . '/Smurfs Travel the World, The-artwork.png')) {
        if (rename($imageDir . '/Smurfs Travel the World the Europe En Fr De (Es)-artwork.png', $imageDir . '/Smurfs Travel the World, The-artwork.png')) {
            echo "✓ Smurfs Travel the World the Europe En Fr De (Es)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Smurfs Travel the World, The-artwork.png\n";
        $skipped++;
    }
}

// Smurfs Travel the World the Europe En Fr De (Es) → Smurfs Travel the World, The
if (file_exists($imageDir . '/Smurfs Travel the World the Europe En Fr De (Es)-gameplay.png')) {
    if (!file_exists($imageDir . '/Smurfs Travel the World, The-gameplay.png')) {
        if (rename($imageDir . '/Smurfs Travel the World the Europe En Fr De (Es)-gameplay.png', $imageDir . '/Smurfs Travel the World, The-gameplay.png')) {
            echo "✓ Smurfs Travel the World the Europe En Fr De (Es)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Smurfs Travel the World, The-gameplay.png\n";
        $skipped++;
    }
}

// Solitaire FunPak (USA) → Solitaire FunPak
if (file_exists($imageDir . '/Solitaire FunPak (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Solitaire FunPak-artwork.png')) {
        if (rename($imageDir . '/Solitaire FunPak (USA)-artwork.png', $imageDir . '/Solitaire FunPak-artwork.png')) {
            echo "✓ Solitaire FunPak (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Solitaire FunPak-artwork.png\n";
        $skipped++;
    }
}

// Solitaire FunPak (USA) → Solitaire FunPak
if (file_exists($imageDir . '/Solitaire FunPak (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Solitaire FunPak-cover.png')) {
        if (rename($imageDir . '/Solitaire FunPak (USA)-cover.png', $imageDir . '/Solitaire FunPak-cover.png')) {
            echo "✓ Solitaire FunPak (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Solitaire FunPak-cover.png\n";
        $skipped++;
    }
}

// Solitaire FunPak (USA) → Solitaire FunPak
if (file_exists($imageDir . '/Solitaire FunPak (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Solitaire FunPak-gameplay.png')) {
        if (rename($imageDir . '/Solitaire FunPak (USA)-gameplay.png', $imageDir . '/Solitaire FunPak-gameplay.png')) {
            echo "✓ Solitaire FunPak (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Solitaire FunPak-gameplay.png\n";
        $skipped++;
    }
}

// Sonic Blast (World) → Sonic Blast
if (file_exists($imageDir . '/Sonic Blast (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic Blast-artwork.png')) {
        if (rename($imageDir . '/Sonic Blast (World)-artwork.png', $imageDir . '/Sonic Blast-artwork.png')) {
            echo "✓ Sonic Blast (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Blast-artwork.png\n";
        $skipped++;
    }
}

// Sonic Blast (World) → Sonic Blast
if (file_exists($imageDir . '/Sonic Blast (World)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic Blast-cover.png')) {
        if (rename($imageDir . '/Sonic Blast (World)-cover.png', $imageDir . '/Sonic Blast-cover.png')) {
            echo "✓ Sonic Blast (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Blast-cover.png\n";
        $skipped++;
    }
}

// Sonic Blast (World) → Sonic Blast
if (file_exists($imageDir . '/Sonic Blast (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic Blast-gameplay.png')) {
        if (rename($imageDir . '/Sonic Blast (World)-gameplay.png', $imageDir . '/Sonic Blast-gameplay.png')) {
            echo "✓ Sonic Blast (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Blast-gameplay.png\n";
        $skipped++;
    }
}

// Sonic Drift (Japan) (En) → Sonic Drift 2 (Japan)[b2]
if (file_exists($imageDir . '/Sonic Drift (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic Drift 2 (Japan)[b2]-cover.png')) {
        if (rename($imageDir . '/Sonic Drift (Japan) (En)-cover.png', $imageDir . '/Sonic Drift 2 (Japan)[b2]-cover.png')) {
            echo "✓ Sonic Drift (Japan) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Drift 2 (Japan)[b2]-cover.png\n";
        $skipped++;
    }
}

// Sonic Drift 2 (World) → Sonic Drift 2
if (file_exists($imageDir . '/Sonic Drift 2 (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic Drift 2-artwork.png')) {
        if (rename($imageDir . '/Sonic Drift 2 (World)-artwork.png', $imageDir . '/Sonic Drift 2-artwork.png')) {
            echo "✓ Sonic Drift 2 (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Drift 2-artwork.png\n";
        $skipped++;
    }
}

// Sonic Drift 2 (World) → Sonic Drift 2
if (file_exists($imageDir . '/Sonic Drift 2 (World)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic Drift 2-cover.png')) {
        if (rename($imageDir . '/Sonic Drift 2 (World)-cover.png', $imageDir . '/Sonic Drift 2-cover.png')) {
            echo "✓ Sonic Drift 2 (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Drift 2-cover.png\n";
        $skipped++;
    }
}

// Sonic Drift 2 (World) → Sonic Drift 2
if (file_exists($imageDir . '/Sonic Drift 2 (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic Drift 2-gameplay.png')) {
        if (rename($imageDir . '/Sonic Drift 2 (World)-gameplay.png', $imageDir . '/Sonic Drift 2-gameplay.png')) {
            echo "✓ Sonic Drift 2 (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Drift 2-gameplay.png\n";
        $skipped++;
    }
}

// Sonic Labyrinth (World) → Sonic Labyrinth
if (file_exists($imageDir . '/Sonic Labyrinth (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic Labyrinth-artwork.png')) {
        if (rename($imageDir . '/Sonic Labyrinth (World)-artwork.png', $imageDir . '/Sonic Labyrinth-artwork.png')) {
            echo "✓ Sonic Labyrinth (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Labyrinth-artwork.png\n";
        $skipped++;
    }
}

// Sonic Labyrinth (World) → Sonic Labyrinth
if (file_exists($imageDir . '/Sonic Labyrinth (World)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic Labyrinth-cover.png')) {
        if (rename($imageDir . '/Sonic Labyrinth (World)-cover.png', $imageDir . '/Sonic Labyrinth-cover.png')) {
            echo "✓ Sonic Labyrinth (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Labyrinth-cover.png\n";
        $skipped++;
    }
}

// Sonic Labyrinth (World) → Sonic Labyrinth
if (file_exists($imageDir . '/Sonic Labyrinth (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic Labyrinth-gameplay.png')) {
        if (rename($imageDir . '/Sonic Labyrinth (World)-gameplay.png', $imageDir . '/Sonic Labyrinth-gameplay.png')) {
            echo "✓ Sonic Labyrinth (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic Labyrinth-gameplay.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog (Japan, USA) → Sonic The Hedgehog 2
if (file_exists($imageDir . '/Sonic The Hedgehog (Japan, USA)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2-cover.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog (Japan, USA)-cover.png', $imageDir . '/Sonic The Hedgehog 2-cover.png')) {
            echo "✓ Sonic The Hedgehog (Japan, USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog 2-cover.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog (Japan, USA) → Sonic The Hedgehog 2
if (file_exists($imageDir . '/Sonic The Hedgehog (Japan, USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2-gameplay.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog (Japan, USA)-gameplay.png', $imageDir . '/Sonic The Hedgehog 2-gameplay.png')) {
            echo "✓ Sonic The Hedgehog (Japan, USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog 2-gameplay.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En) → Sonic The Hedgehog - Triple Trouble
if (file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble-artwork.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En)-artwork.png', $imageDir . '/Sonic The Hedgehog - Triple Trouble-artwork.png')) {
            echo "✓ Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog - Triple Trouble-artwork.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En) → Sonic The Hedgehog - Triple Trouble
if (file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble-cover.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En)-cover.png', $imageDir . '/Sonic The Hedgehog - Triple Trouble-cover.png')) {
            echo "✓ Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog - Triple Trouble-cover.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En) → Sonic The Hedgehog - Triple Trouble
if (file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble-gameplay.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En)-gameplay.png', $imageDir . '/Sonic The Hedgehog - Triple Trouble-gameplay.png')) {
            echo "✓ Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog - Triple Trouble-gameplay.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) → Sonic The Hedgehog - Triple Trouble
if (file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble-artwork.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-artwork.png', $imageDir . '/Sonic The Hedgehog - Triple Trouble-artwork.png')) {
            echo "✓ Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog - Triple Trouble-artwork.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) → Sonic The Hedgehog - Triple Trouble
if (file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble-cover.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-cover.png', $imageDir . '/Sonic The Hedgehog - Triple Trouble-cover.png')) {
            echo "✓ Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog - Triple Trouble-cover.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil) → Sonic The Hedgehog - Triple Trouble
if (file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog - Triple Trouble-gameplay.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-gameplay.png', $imageDir . '/Sonic The Hedgehog - Triple Trouble-gameplay.png')) {
            echo "✓ Sonic The Hedgehog - Triple Trouble (USA, Europe, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog - Triple Trouble-gameplay.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog 2 (World) → Sonic The Hedgehog 2
if (file_exists($imageDir . '/Sonic The Hedgehog 2 (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2-artwork.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog 2 (World)-artwork.png', $imageDir . '/Sonic The Hedgehog 2-artwork.png')) {
            echo "✓ Sonic The Hedgehog 2 (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog 2-artwork.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog 2 (World) → Sonic The Hedgehog 2
if (file_exists($imageDir . '/Sonic The Hedgehog 2 (World)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2-cover.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog 2 (World)-cover.png', $imageDir . '/Sonic The Hedgehog 2-cover.png')) {
            echo "✓ Sonic The Hedgehog 2 (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog 2-cover.png\n";
        $skipped++;
    }
}

// Sonic The Hedgehog 2 (World) → Sonic The Hedgehog 2
if (file_exists($imageDir . '/Sonic The Hedgehog 2 (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic The Hedgehog 2-gameplay.png')) {
        if (rename($imageDir . '/Sonic The Hedgehog 2 (World)-gameplay.png', $imageDir . '/Sonic The Hedgehog 2-gameplay.png')) {
            echo "✓ Sonic The Hedgehog 2 (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic The Hedgehog 2-gameplay.png\n";
        $skipped++;
    }
}

// Sonic _ Tails 2 (Japan) (En) → Sonic _ Tails 2 (Japan)[t]
if (file_exists($imageDir . '/Sonic _ Tails 2 (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Sonic _ Tails 2 (Japan)[t]-artwork.png')) {
        if (rename($imageDir . '/Sonic _ Tails 2 (Japan) (En)-artwork.png', $imageDir . '/Sonic _ Tails 2 (Japan)[t]-artwork.png')) {
            echo "✓ Sonic _ Tails 2 (Japan) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic _ Tails 2 (Japan)[t]-artwork.png\n";
        $skipped++;
    }
}

// Sonic _ Tails 2 (Japan) (En) → Sonic _ Tails 2 (Japan)[t]
if (file_exists($imageDir . '/Sonic _ Tails 2 (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/Sonic _ Tails 2 (Japan)[t]-cover.png')) {
        if (rename($imageDir . '/Sonic _ Tails 2 (Japan) (En)-cover.png', $imageDir . '/Sonic _ Tails 2 (Japan)[t]-cover.png')) {
            echo "✓ Sonic _ Tails 2 (Japan) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic _ Tails 2 (Japan)[t]-cover.png\n";
        $skipped++;
    }
}

// Sonic _ Tails 2 (Japan) (En) → Sonic _ Tails 2 (Japan)[t]
if (file_exists($imageDir . '/Sonic _ Tails 2 (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sonic _ Tails 2 (Japan)[t]-gameplay.png')) {
        if (rename($imageDir . '/Sonic _ Tails 2 (Japan) (En)-gameplay.png', $imageDir . '/Sonic _ Tails 2 (Japan)[t]-gameplay.png')) {
            echo "✓ Sonic _ Tails 2 (Japan) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sonic _ Tails 2 (Japan)[t]-gameplay.png\n";
        $skipped++;
    }
}

// Sorcery Saga II - Arle, Age 16 (USA) → Sorcery Saga II - Arle, Age 16
if (file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16-artwork.png')) {
        if (rename($imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-artwork.png', $imageDir . '/Sorcery Saga II - Arle, Age 16-artwork.png')) {
            echo "✓ Sorcery Saga II - Arle, Age 16 (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga II - Arle, Age 16-artwork.png\n";
        $skipped++;
    }
}

// Sorcery Saga II - Arle, Age 16 (USA) → Sorcery Saga II - Arle, Age 16
if (file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16-cover.png')) {
        if (rename($imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-cover.png', $imageDir . '/Sorcery Saga II - Arle, Age 16-cover.png')) {
            echo "✓ Sorcery Saga II - Arle, Age 16 (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga II - Arle, Age 16-cover.png\n";
        $skipped++;
    }
}

// Sorcery Saga II - Arle, Age 16 (USA) → Sorcery Saga II - Arle, Age 16
if (file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga II - Arle, Age 16-gameplay.png')) {
        if (rename($imageDir . '/Sorcery Saga II - Arle, Age 16 (USA)-gameplay.png', $imageDir . '/Sorcery Saga II - Arle, Age 16-gameplay.png')) {
            echo "✓ Sorcery Saga II - Arle, Age 16 (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga II - Arle, Age 16-gameplay.png\n";
        $skipped++;
    }
}

// Sorcery Saga III - The Ultimate Queen (USA) → Sorcery Saga III - The Ultimate Queen
if (file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen-artwork.png')) {
        if (rename($imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-artwork.png', $imageDir . '/Sorcery Saga III - The Ultimate Queen-artwork.png')) {
            echo "✓ Sorcery Saga III - The Ultimate Queen (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga III - The Ultimate Queen-artwork.png\n";
        $skipped++;
    }
}

// Sorcery Saga III - The Ultimate Queen (USA) → Sorcery Saga III - The Ultimate Queen
if (file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen-cover.png')) {
        if (rename($imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-cover.png', $imageDir . '/Sorcery Saga III - The Ultimate Queen-cover.png')) {
            echo "✓ Sorcery Saga III - The Ultimate Queen (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga III - The Ultimate Queen-cover.png\n";
        $skipped++;
    }
}

// Sorcery Saga III - The Ultimate Queen (USA) → Sorcery Saga III - The Ultimate Queen
if (file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sorcery Saga III - The Ultimate Queen-gameplay.png')) {
        if (rename($imageDir . '/Sorcery Saga III - The Ultimate Queen (USA)-gameplay.png', $imageDir . '/Sorcery Saga III - The Ultimate Queen-gameplay.png')) {
            echo "✓ Sorcery Saga III - The Ultimate Queen (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sorcery Saga III - The Ultimate Queen-gameplay.png\n";
        $skipped++;
    }
}

// Space Harrier (World) → Space Harrier
if (file_exists($imageDir . '/Space Harrier (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Space Harrier-artwork.png')) {
        if (rename($imageDir . '/Space Harrier (World)-artwork.png', $imageDir . '/Space Harrier-artwork.png')) {
            echo "✓ Space Harrier (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Space Harrier-artwork.png\n";
        $skipped++;
    }
}

// Space Harrier (World) → Space Harrier
if (file_exists($imageDir . '/Space Harrier (World)-cover.png')) {
    if (!file_exists($imageDir . '/Space Harrier-cover.png')) {
        if (rename($imageDir . '/Space Harrier (World)-cover.png', $imageDir . '/Space Harrier-cover.png')) {
            echo "✓ Space Harrier (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Space Harrier-cover.png\n";
        $skipped++;
    }
}

// Space Harrier (World) → Space Harrier
if (file_exists($imageDir . '/Space Harrier (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Space Harrier-gameplay.png')) {
        if (rename($imageDir . '/Space Harrier (World)-gameplay.png', $imageDir . '/Space Harrier-gameplay.png')) {
            echo "✓ Space Harrier (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Space Harrier-gameplay.png\n";
        $skipped++;
    }
}

// Spider-Man - Return of the Sinister Six (USA, Europe) → Spider-Man - Return of the Sinister Six
if (file_exists($imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Spider-Man - Return of the Sinister Six-artwork.png')) {
        if (rename($imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-artwork.png', $imageDir . '/Spider-Man - Return of the Sinister Six-artwork.png')) {
            echo "✓ Spider-Man - Return of the Sinister Six (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Spider-Man - Return of the Sinister Six-artwork.png\n";
        $skipped++;
    }
}

// Spider-Man - Return of the Sinister Six (USA, Europe) → Spider-Man - Return of the Sinister Six
if (file_exists($imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Spider-Man - Return of the Sinister Six-cover.png')) {
        if (rename($imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-cover.png', $imageDir . '/Spider-Man - Return of the Sinister Six-cover.png')) {
            echo "✓ Spider-Man - Return of the Sinister Six (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Spider-Man - Return of the Sinister Six-cover.png\n";
        $skipped++;
    }
}

// Spider-Man - Return of the Sinister Six (USA, Europe) → Spider-Man - Return of the Sinister Six
if (file_exists($imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Spider-Man - Return of the Sinister Six-gameplay.png')) {
        if (rename($imageDir . '/Spider-Man - Return of the Sinister Six (USA, Europe)-gameplay.png', $imageDir . '/Spider-Man - Return of the Sinister Six-gameplay.png')) {
            echo "✓ Spider-Man - Return of the Sinister Six (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Spider-Man - Return of the Sinister Six-gameplay.png\n";
        $skipped++;
    }
}

// Sports Illustrated - Championship Football _ Baseball (USA) → Sports Illustrated - Championship Football _ Baseball
if (file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball-artwork.png')) {
        if (rename($imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-artwork.png', $imageDir . '/Sports Illustrated - Championship Football _ Baseball-artwork.png')) {
            echo "✓ Sports Illustrated - Championship Football _ Baseball (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Illustrated - Championship Football _ Baseball-artwork.png\n";
        $skipped++;
    }
}

// Sports Illustrated - Championship Football _ Baseball (USA) → Sports Illustrated - Championship Football _ Baseball
if (file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball-cover.png')) {
        if (rename($imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-cover.png', $imageDir . '/Sports Illustrated - Championship Football _ Baseball-cover.png')) {
            echo "✓ Sports Illustrated - Championship Football _ Baseball (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Illustrated - Championship Football _ Baseball-cover.png\n";
        $skipped++;
    }
}

// Sports Illustrated - Championship Football _ Baseball (USA) → Sports Illustrated - Championship Football _ Baseball
if (file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sports Illustrated - Championship Football _ Baseball-gameplay.png')) {
        if (rename($imageDir . '/Sports Illustrated - Championship Football _ Baseball (USA)-gameplay.png', $imageDir . '/Sports Illustrated - Championship Football _ Baseball-gameplay.png')) {
            echo "✓ Sports Illustrated - Championship Football _ Baseball (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Illustrated - Championship Football _ Baseball-gameplay.png\n";
        $skipped++;
    }
}

// Sports Trivia (USA) → Sports Trivia
if (file_exists($imageDir . '/Sports Trivia (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Sports Trivia-artwork.png')) {
        if (rename($imageDir . '/Sports Trivia (USA)-artwork.png', $imageDir . '/Sports Trivia-artwork.png')) {
            echo "✓ Sports Trivia (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia-artwork.png\n";
        $skipped++;
    }
}

// Sports Trivia (USA) → Sports Trivia
if (file_exists($imageDir . '/Sports Trivia (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Sports Trivia-cover.png')) {
        if (rename($imageDir . '/Sports Trivia (USA)-cover.png', $imageDir . '/Sports Trivia-cover.png')) {
            echo "✓ Sports Trivia (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia-cover.png\n";
        $skipped++;
    }
}

// Sports Trivia (USA) → Sports Trivia
if (file_exists($imageDir . '/Sports Trivia (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sports Trivia-gameplay.png')) {
        if (rename($imageDir . '/Sports Trivia (USA)-gameplay.png', $imageDir . '/Sports Trivia-gameplay.png')) {
            echo "✓ Sports Trivia (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia-gameplay.png\n";
        $skipped++;
    }
}

// Sports Trivia - Championship Edition (USA) → Sports Trivia - Championship Edition
if (file_exists($imageDir . '/Sports Trivia - Championship Edition (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Sports Trivia - Championship Edition-artwork.png')) {
        if (rename($imageDir . '/Sports Trivia - Championship Edition (USA)-artwork.png', $imageDir . '/Sports Trivia - Championship Edition-artwork.png')) {
            echo "✓ Sports Trivia - Championship Edition (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia - Championship Edition-artwork.png\n";
        $skipped++;
    }
}

// Sports Trivia - Championship Edition (USA) → Sports Trivia - Championship Edition
if (file_exists($imageDir . '/Sports Trivia - Championship Edition (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Sports Trivia - Championship Edition-cover.png')) {
        if (rename($imageDir . '/Sports Trivia - Championship Edition (USA)-cover.png', $imageDir . '/Sports Trivia - Championship Edition-cover.png')) {
            echo "✓ Sports Trivia - Championship Edition (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia - Championship Edition-cover.png\n";
        $skipped++;
    }
}

// Sports Trivia - Championship Edition (USA) → Sports Trivia - Championship Edition
if (file_exists($imageDir . '/Sports Trivia - Championship Edition (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sports Trivia - Championship Edition-gameplay.png')) {
        if (rename($imageDir . '/Sports Trivia - Championship Edition (USA)-gameplay.png', $imageDir . '/Sports Trivia - Championship Edition-gameplay.png')) {
            echo "✓ Sports Trivia - Championship Edition (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sports Trivia - Championship Edition-gameplay.png\n";
        $skipped++;
    }
}

// Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA) → Star Trek - The Next Generation - The Advanced Holodeck Tutorial
if (file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-artwork.png')) {
        if (rename($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-artwork.png', $imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-artwork.png')) {
            echo "✓ Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek - The Next Generation - The Advanced Holodeck Tutorial-artwork.png\n";
        $skipped++;
    }
}

// Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA) → Star Trek - The Next Generation - The Advanced Holodeck Tutorial
if (file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-cover.png')) {
        if (rename($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-cover.png', $imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-cover.png')) {
            echo "✓ Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek - The Next Generation - The Advanced Holodeck Tutorial-cover.png\n";
        $skipped++;
    }
}

// Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA) → Star Trek - The Next Generation - The Advanced Holodeck Tutorial
if (file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-gameplay.png')) {
        if (rename($imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-gameplay.png', $imageDir . '/Star Trek - The Next Generation - The Advanced Holodeck Tutorial-gameplay.png')) {
            echo "✓ Star Trek - The Next Generation - The Advanced Holodeck Tutorial (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek - The Next Generation - The Advanced Holodeck Tutorial-gameplay.png\n";
        $skipped++;
    }
}

// Star Trek Generations - Beyond the Nexus (USA) → Star Trek Generations - Beyond the Nexus
if (file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus-artwork.png')) {
        if (rename($imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-artwork.png', $imageDir . '/Star Trek Generations - Beyond the Nexus-artwork.png')) {
            echo "✓ Star Trek Generations - Beyond the Nexus (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek Generations - Beyond the Nexus-artwork.png\n";
        $skipped++;
    }
}

// Star Trek Generations - Beyond the Nexus (USA) → Star Trek Generations - Beyond the Nexus
if (file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus-cover.png')) {
        if (rename($imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-cover.png', $imageDir . '/Star Trek Generations - Beyond the Nexus-cover.png')) {
            echo "✓ Star Trek Generations - Beyond the Nexus (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek Generations - Beyond the Nexus-cover.png\n";
        $skipped++;
    }
}

// Star Trek Generations - Beyond the Nexus (USA) → Star Trek Generations - Beyond the Nexus
if (file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Star Trek Generations - Beyond the Nexus-gameplay.png')) {
        if (rename($imageDir . '/Star Trek Generations - Beyond the Nexus (USA)-gameplay.png', $imageDir . '/Star Trek Generations - Beyond the Nexus-gameplay.png')) {
            echo "✓ Star Trek Generations - Beyond the Nexus (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Star Trek Generations - Beyond the Nexus-gameplay.png\n";
        $skipped++;
    }
}

// Streets of Rage (World) → Streets of Rage 2
if (file_exists($imageDir . '/Streets of Rage (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Streets of Rage 2-artwork.png')) {
        if (rename($imageDir . '/Streets of Rage (World)-artwork.png', $imageDir . '/Streets of Rage 2-artwork.png')) {
            echo "✓ Streets of Rage (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Streets of Rage 2-artwork.png\n";
        $skipped++;
    }
}

// Streets of Rage (World) → Streets of Rage 2
if (file_exists($imageDir . '/Streets of Rage (World)-cover.png')) {
    if (!file_exists($imageDir . '/Streets of Rage 2-cover.png')) {
        if (rename($imageDir . '/Streets of Rage (World)-cover.png', $imageDir . '/Streets of Rage 2-cover.png')) {
            echo "✓ Streets of Rage (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Streets of Rage 2-cover.png\n";
        $skipped++;
    }
}

// Streets of Rage (World) → Streets of Rage 2
if (file_exists($imageDir . '/Streets of Rage (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Streets of Rage 2-gameplay.png')) {
        if (rename($imageDir . '/Streets of Rage (World)-gameplay.png', $imageDir . '/Streets of Rage 2-gameplay.png')) {
            echo "✓ Streets of Rage (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Streets of Rage 2-gameplay.png\n";
        $skipped++;
    }
}

// Streets of Rage 2 (World) → Streets of Rage 2
if (file_exists($imageDir . '/Streets of Rage 2 (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Streets of Rage 2-artwork.png')) {
        if (rename($imageDir . '/Streets of Rage 2 (World)-artwork.png', $imageDir . '/Streets of Rage 2-artwork.png')) {
            echo "✓ Streets of Rage 2 (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Streets of Rage 2-artwork.png\n";
        $skipped++;
    }
}

// Streets of Rage 2 (World) → Streets of Rage 2
if (file_exists($imageDir . '/Streets of Rage 2 (World)-cover.png')) {
    if (!file_exists($imageDir . '/Streets of Rage 2-cover.png')) {
        if (rename($imageDir . '/Streets of Rage 2 (World)-cover.png', $imageDir . '/Streets of Rage 2-cover.png')) {
            echo "✓ Streets of Rage 2 (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Streets of Rage 2-cover.png\n";
        $skipped++;
    }
}

// Streets of Rage 2 (World) → Streets of Rage 2
if (file_exists($imageDir . '/Streets of Rage 2 (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Streets of Rage 2-gameplay.png')) {
        if (rename($imageDir . '/Streets of Rage 2 (World)-gameplay.png', $imageDir . '/Streets of Rage 2-gameplay.png')) {
            echo "✓ Streets of Rage 2 (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Streets of Rage 2-gameplay.png\n";
        $skipped++;
    }
}

// Super Battletank (USA) → Super Battletank
if (file_exists($imageDir . '/Super Battletank (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Super Battletank-artwork.png')) {
        if (rename($imageDir . '/Super Battletank (USA)-artwork.png', $imageDir . '/Super Battletank-artwork.png')) {
            echo "✓ Super Battletank (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Battletank-artwork.png\n";
        $skipped++;
    }
}

// Super Battletank (USA) → Super Battletank
if (file_exists($imageDir . '/Super Battletank (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Super Battletank-cover.png')) {
        if (rename($imageDir . '/Super Battletank (USA)-cover.png', $imageDir . '/Super Battletank-cover.png')) {
            echo "✓ Super Battletank (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Battletank-cover.png\n";
        $skipped++;
    }
}

// Super Battletank (USA) → Super Battletank
if (file_exists($imageDir . '/Super Battletank (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Battletank-gameplay.png')) {
        if (rename($imageDir . '/Super Battletank (USA)-gameplay.png', $imageDir . '/Super Battletank-gameplay.png')) {
            echo "✓ Super Battletank (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Battletank-gameplay.png\n";
        $skipped++;
    }
}

// Super Columns (Japan) → Super Columns
if (file_exists($imageDir . '/Super Columns (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Super Columns-artwork.png')) {
        if (rename($imageDir . '/Super Columns (Japan)-artwork.png', $imageDir . '/Super Columns-artwork.png')) {
            echo "✓ Super Columns (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Columns-artwork.png\n";
        $skipped++;
    }
}

// Super Columns (Japan) → Super Columns
if (file_exists($imageDir . '/Super Columns (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Super Columns-cover.png')) {
        if (rename($imageDir . '/Super Columns (Japan)-cover.png', $imageDir . '/Super Columns-cover.png')) {
            echo "✓ Super Columns (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Columns-cover.png\n";
        $skipped++;
    }
}

// Super Columns (Japan) → Super Columns
if (file_exists($imageDir . '/Super Columns (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Columns-gameplay.png')) {
        if (rename($imageDir . '/Super Columns (Japan)-gameplay.png', $imageDir . '/Super Columns-gameplay.png')) {
            echo "✓ Super Columns (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Columns-gameplay.png\n";
        $skipped++;
    }
}

// Super Golf (USA) → Super Golf
if (file_exists($imageDir . '/Super Golf (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Super Golf-artwork.png')) {
        if (rename($imageDir . '/Super Golf (USA)-artwork.png', $imageDir . '/Super Golf-artwork.png')) {
            echo "✓ Super Golf (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Golf-artwork.png\n";
        $skipped++;
    }
}

// Super Golf (USA) → Super Golf
if (file_exists($imageDir . '/Super Golf (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Super Golf-cover.png')) {
        if (rename($imageDir . '/Super Golf (USA)-cover.png', $imageDir . '/Super Golf-cover.png')) {
            echo "✓ Super Golf (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Golf-cover.png\n";
        $skipped++;
    }
}

// Super Golf (USA) → Super Golf
if (file_exists($imageDir . '/Super Golf (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Golf-gameplay.png')) {
        if (rename($imageDir . '/Super Golf (USA)-gameplay.png', $imageDir . '/Super Golf-gameplay.png')) {
            echo "✓ Super Golf (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Golf-gameplay.png\n";
        $skipped++;
    }
}

// Super Momotarou Dentetsu III (Japan) → Super Momotarou Dentetsu III
if (file_exists($imageDir . '/Super Momotarou Dentetsu III (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Super Momotarou Dentetsu III-artwork.png')) {
        if (rename($imageDir . '/Super Momotarou Dentetsu III (Japan)-artwork.png', $imageDir . '/Super Momotarou Dentetsu III-artwork.png')) {
            echo "✓ Super Momotarou Dentetsu III (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Momotarou Dentetsu III-artwork.png\n";
        $skipped++;
    }
}

// Super Momotarou Dentetsu III (Japan) → Super Momotarou Dentetsu III
if (file_exists($imageDir . '/Super Momotarou Dentetsu III (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Super Momotarou Dentetsu III-cover.png')) {
        if (rename($imageDir . '/Super Momotarou Dentetsu III (Japan)-cover.png', $imageDir . '/Super Momotarou Dentetsu III-cover.png')) {
            echo "✓ Super Momotarou Dentetsu III (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Momotarou Dentetsu III-cover.png\n";
        $skipped++;
    }
}

// Super Momotarou Dentetsu III (Japan) → Super Momotarou Dentetsu III
if (file_exists($imageDir . '/Super Momotarou Dentetsu III (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Momotarou Dentetsu III-gameplay.png')) {
        if (rename($imageDir . '/Super Momotarou Dentetsu III (Japan)-gameplay.png', $imageDir . '/Super Momotarou Dentetsu III-gameplay.png')) {
            echo "✓ Super Momotarou Dentetsu III (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Momotarou Dentetsu III-gameplay.png\n";
        $skipped++;
    }
}

// Super Space Invaders (USA, Europe) → Super Space Invaders
if (file_exists($imageDir . '/Super Space Invaders (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Super Space Invaders-artwork.png')) {
        if (rename($imageDir . '/Super Space Invaders (USA, Europe)-artwork.png', $imageDir . '/Super Space Invaders-artwork.png')) {
            echo "✓ Super Space Invaders (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Space Invaders-artwork.png\n";
        $skipped++;
    }
}

// Super Space Invaders (USA, Europe) → Super Space Invaders
if (file_exists($imageDir . '/Super Space Invaders (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Super Space Invaders-cover.png')) {
        if (rename($imageDir . '/Super Space Invaders (USA, Europe)-cover.png', $imageDir . '/Super Space Invaders-cover.png')) {
            echo "✓ Super Space Invaders (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Space Invaders-cover.png\n";
        $skipped++;
    }
}

// Super Space Invaders (USA, Europe) → Super Space Invaders
if (file_exists($imageDir . '/Super Space Invaders (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Space Invaders-gameplay.png')) {
        if (rename($imageDir . '/Super Space Invaders (USA, Europe)-gameplay.png', $imageDir . '/Super Space Invaders-gameplay.png')) {
            echo "✓ Super Space Invaders (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Space Invaders-gameplay.png\n";
        $skipped++;
    }
}

// Super Star Wars - Return of the Jedi (USA, Europe) → Super Star Wars - Return of the Jedi
if (file_exists($imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Super Star Wars - Return of the Jedi-artwork.png')) {
        if (rename($imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-artwork.png', $imageDir . '/Super Star Wars - Return of the Jedi-artwork.png')) {
            echo "✓ Super Star Wars - Return of the Jedi (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Star Wars - Return of the Jedi-artwork.png\n";
        $skipped++;
    }
}

// Super Star Wars - Return of the Jedi (USA, Europe) → Super Star Wars - Return of the Jedi
if (file_exists($imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Super Star Wars - Return of the Jedi-cover.png')) {
        if (rename($imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-cover.png', $imageDir . '/Super Star Wars - Return of the Jedi-cover.png')) {
            echo "✓ Super Star Wars - Return of the Jedi (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Star Wars - Return of the Jedi-cover.png\n";
        $skipped++;
    }
}

// Super Star Wars - Return of the Jedi (USA, Europe) → Super Star Wars - Return of the Jedi
if (file_exists($imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Super Star Wars - Return of the Jedi-gameplay.png')) {
        if (rename($imageDir . '/Super Star Wars - Return of the Jedi (USA, Europe)-gameplay.png', $imageDir . '/Super Star Wars - Return of the Jedi-gameplay.png')) {
            echo "✓ Super Star Wars - Return of the Jedi (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Super Star Wars - Return of the Jedi-gameplay.png\n";
        $skipped++;
    }
}

// Superman - The Man of Steel (Europe) → Superman - The Man of Steel
if (file_exists($imageDir . '/Superman - The Man of Steel (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Superman - The Man of Steel-artwork.png')) {
        if (rename($imageDir . '/Superman - The Man of Steel (Europe)-artwork.png', $imageDir . '/Superman - The Man of Steel-artwork.png')) {
            echo "✓ Superman - The Man of Steel (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Superman - The Man of Steel-artwork.png\n";
        $skipped++;
    }
}

// Superman - The Man of Steel (Europe) → Superman - The Man of Steel
if (file_exists($imageDir . '/Superman - The Man of Steel (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Superman - The Man of Steel-cover.png')) {
        if (rename($imageDir . '/Superman - The Man of Steel (Europe)-cover.png', $imageDir . '/Superman - The Man of Steel-cover.png')) {
            echo "✓ Superman - The Man of Steel (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Superman - The Man of Steel-cover.png\n";
        $skipped++;
    }
}

// Superman - The Man of Steel (Europe) → Superman - The Man of Steel
if (file_exists($imageDir . '/Superman - The Man of Steel (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Superman - The Man of Steel-gameplay.png')) {
        if (rename($imageDir . '/Superman - The Man of Steel (Europe)-gameplay.png', $imageDir . '/Superman - The Man of Steel-gameplay.png')) {
            echo "✓ Superman - The Man of Steel (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Superman - The Man of Steel-gameplay.png\n";
        $skipped++;
    }
}

// Sylvan Tale (Japan) → Sylvan Tale
if (file_exists($imageDir . '/Sylvan Tale (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale-artwork.png')) {
        if (rename($imageDir . '/Sylvan Tale (Japan)-artwork.png', $imageDir . '/Sylvan Tale-artwork.png')) {
            echo "✓ Sylvan Tale (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale-artwork.png\n";
        $skipped++;
    }
}

// Sylvan Tale (Japan) → Sylvan Tale
if (file_exists($imageDir . '/Sylvan Tale (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale-cover.png')) {
        if (rename($imageDir . '/Sylvan Tale (Japan)-cover.png', $imageDir . '/Sylvan Tale-cover.png')) {
            echo "✓ Sylvan Tale (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale-cover.png\n";
        $skipped++;
    }
}

// Sylvan Tale (Japan) → Sylvan Tale
if (file_exists($imageDir . '/Sylvan Tale (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale-gameplay.png')) {
        if (rename($imageDir . '/Sylvan Tale (Japan)-gameplay.png', $imageDir . '/Sylvan Tale-gameplay.png')) {
            echo "✓ Sylvan Tale (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale-gameplay.png\n";
        $skipped++;
    }
}

// Sylvan Tale (Japan)[tr en] → Sylvan Tale (Japan)[tr en AGTP][v1.00]
if (file_exists($imageDir . '/Sylvan Tale (Japan)[tr en]-cover.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale (Japan)[tr en AGTP][v1.00]-cover.png')) {
        if (rename($imageDir . '/Sylvan Tale (Japan)[tr en]-cover.png', $imageDir . '/Sylvan Tale (Japan)[tr en AGTP][v1.00]-cover.png')) {
            echo "✓ Sylvan Tale (Japan)[tr en]-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale (Japan)[tr en AGTP][v1.00]-cover.png\n";
        $skipped++;
    }
}

// Sylvan Tale (Japan)[tr ru ALLiGaToR] → Sylvan Tale (Japan)[tr en AGTP][v1.00]
if (file_exists($imageDir . '/Sylvan Tale (Japan)[tr ru ALLiGaToR]-cover.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale (Japan)[tr en AGTP][v1.00]-cover.png')) {
        if (rename($imageDir . '/Sylvan Tale (Japan)[tr ru ALLiGaToR]-cover.png', $imageDir . '/Sylvan Tale (Japan)[tr en AGTP][v1.00]-cover.png')) {
            echo "✓ Sylvan Tale (Japan)[tr ru ALLiGaToR]-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale (Japan)[tr en AGTP][v1.00]-cover.png\n";
        $skipped++;
    }
}

// Sylvan Tale (USA) → Sylvan Tale
if (file_exists($imageDir . '/Sylvan Tale (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale-artwork.png')) {
        if (rename($imageDir . '/Sylvan Tale (USA)-artwork.png', $imageDir . '/Sylvan Tale-artwork.png')) {
            echo "✓ Sylvan Tale (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale-artwork.png\n";
        $skipped++;
    }
}

// Sylvan Tale (USA) → Sylvan Tale
if (file_exists($imageDir . '/Sylvan Tale (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale-cover.png')) {
        if (rename($imageDir . '/Sylvan Tale (USA)-cover.png', $imageDir . '/Sylvan Tale-cover.png')) {
            echo "✓ Sylvan Tale (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale-cover.png\n";
        $skipped++;
    }
}

// Sylvan Tale (USA) → Sylvan Tale
if (file_exists($imageDir . '/Sylvan Tale (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Sylvan Tale-gameplay.png')) {
        if (rename($imageDir . '/Sylvan Tale (USA)-gameplay.png', $imageDir . '/Sylvan Tale-gameplay.png')) {
            echo "✓ Sylvan Tale (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Sylvan Tale-gameplay.png\n";
        $skipped++;
    }
}

// T2 - The Arcade Game (Japan) (En) → T2 - The Arcade Game
if (file_exists($imageDir . '/T2 - The Arcade Game (Japan) (En)-artwork.png')) {
    if (!file_exists($imageDir . '/T2 - The Arcade Game-artwork.png')) {
        if (rename($imageDir . '/T2 - The Arcade Game (Japan) (En)-artwork.png', $imageDir . '/T2 - The Arcade Game-artwork.png')) {
            echo "✓ T2 - The Arcade Game (Japan) (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: T2 - The Arcade Game-artwork.png\n";
        $skipped++;
    }
}

// T2 - The Arcade Game (Japan) (En) → T2 - The Arcade Game
if (file_exists($imageDir . '/T2 - The Arcade Game (Japan) (En)-cover.png')) {
    if (!file_exists($imageDir . '/T2 - The Arcade Game-cover.png')) {
        if (rename($imageDir . '/T2 - The Arcade Game (Japan) (En)-cover.png', $imageDir . '/T2 - The Arcade Game-cover.png')) {
            echo "✓ T2 - The Arcade Game (Japan) (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: T2 - The Arcade Game-cover.png\n";
        $skipped++;
    }
}

// T2 - The Arcade Game (Japan) (En) → T2 - The Arcade Game
if (file_exists($imageDir . '/T2 - The Arcade Game (Japan) (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/T2 - The Arcade Game-gameplay.png')) {
        if (rename($imageDir . '/T2 - The Arcade Game (Japan) (En)-gameplay.png', $imageDir . '/T2 - The Arcade Game-gameplay.png')) {
            echo "✓ T2 - The Arcade Game (Japan) (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: T2 - The Arcade Game-gameplay.png\n";
        $skipped++;
    }
}

// T2 - The Arcade Game (USA, Europe) → T2 - The Arcade Game
if (file_exists($imageDir . '/T2 - The Arcade Game (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/T2 - The Arcade Game-artwork.png')) {
        if (rename($imageDir . '/T2 - The Arcade Game (USA, Europe)-artwork.png', $imageDir . '/T2 - The Arcade Game-artwork.png')) {
            echo "✓ T2 - The Arcade Game (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: T2 - The Arcade Game-artwork.png\n";
        $skipped++;
    }
}

// T2 - The Arcade Game (USA, Europe) → T2 - The Arcade Game
if (file_exists($imageDir . '/T2 - The Arcade Game (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/T2 - The Arcade Game-cover.png')) {
        if (rename($imageDir . '/T2 - The Arcade Game (USA, Europe)-cover.png', $imageDir . '/T2 - The Arcade Game-cover.png')) {
            echo "✓ T2 - The Arcade Game (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: T2 - The Arcade Game-cover.png\n";
        $skipped++;
    }
}

// T2 - The Arcade Game (USA, Europe) → T2 - The Arcade Game
if (file_exists($imageDir . '/T2 - The Arcade Game (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/T2 - The Arcade Game-gameplay.png')) {
        if (rename($imageDir . '/T2 - The Arcade Game (USA, Europe)-gameplay.png', $imageDir . '/T2 - The Arcade Game-gameplay.png')) {
            echo "✓ T2 - The Arcade Game (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: T2 - The Arcade Game-gameplay.png\n";
        $skipped++;
    }
}

// Tails Skypatrol Japan (En) → Tails' Skypatrol
if (file_exists($imageDir . '/Tails Skypatrol Japan (En)-artwork.png')) {
    if (!file_exists($imageDir . '/Tails\' Skypatrol-artwork.png')) {
        if (rename($imageDir . '/Tails Skypatrol Japan (En)-artwork.png', $imageDir . '/Tails\' Skypatrol-artwork.png')) {
            echo "✓ Tails Skypatrol Japan (En)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tails\' Skypatrol-artwork.png\n";
        $skipped++;
    }
}

// Tails Skypatrol Japan (En) → Tails' Skypatrol
if (file_exists($imageDir . '/Tails Skypatrol Japan (En)-cover.png')) {
    if (!file_exists($imageDir . '/Tails\' Skypatrol-cover.png')) {
        if (rename($imageDir . '/Tails Skypatrol Japan (En)-cover.png', $imageDir . '/Tails\' Skypatrol-cover.png')) {
            echo "✓ Tails Skypatrol Japan (En)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tails\' Skypatrol-cover.png\n";
        $skipped++;
    }
}

// Tails Skypatrol Japan (En) → Tails' Skypatrol
if (file_exists($imageDir . '/Tails Skypatrol Japan (En)-gameplay.png')) {
    if (!file_exists($imageDir . '/Tails\' Skypatrol-gameplay.png')) {
        if (rename($imageDir . '/Tails Skypatrol Japan (En)-gameplay.png', $imageDir . '/Tails\' Skypatrol-gameplay.png')) {
            echo "✓ Tails Skypatrol Japan (En)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tails\' Skypatrol-gameplay.png\n";
        $skipped++;
    }
}

// Taisen Mahjong HaoPai (Japan) → Taisen Mahjong HaoPai 2
if (file_exists($imageDir . '/Taisen Mahjong HaoPai (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Taisen Mahjong HaoPai 2-artwork.png')) {
        if (rename($imageDir . '/Taisen Mahjong HaoPai (Japan)-artwork.png', $imageDir . '/Taisen Mahjong HaoPai 2-artwork.png')) {
            echo "✓ Taisen Mahjong HaoPai (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen Mahjong HaoPai 2-artwork.png\n";
        $skipped++;
    }
}

// Taisen Mahjong HaoPai (Japan) → Taisen Mahjong HaoPai 2
if (file_exists($imageDir . '/Taisen Mahjong HaoPai (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Taisen Mahjong HaoPai 2-cover.png')) {
        if (rename($imageDir . '/Taisen Mahjong HaoPai (Japan)-cover.png', $imageDir . '/Taisen Mahjong HaoPai 2-cover.png')) {
            echo "✓ Taisen Mahjong HaoPai (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen Mahjong HaoPai 2-cover.png\n";
        $skipped++;
    }
}

// Taisen Mahjong HaoPai (Japan) → Taisen Mahjong HaoPai 2
if (file_exists($imageDir . '/Taisen Mahjong HaoPai (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Taisen Mahjong HaoPai 2-gameplay.png')) {
        if (rename($imageDir . '/Taisen Mahjong HaoPai (Japan)-gameplay.png', $imageDir . '/Taisen Mahjong HaoPai 2-gameplay.png')) {
            echo "✓ Taisen Mahjong HaoPai (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen Mahjong HaoPai 2-gameplay.png\n";
        $skipped++;
    }
}

// Taisen Mahjong HaoPai 2 (Japan) → Taisen Mahjong HaoPai 2
if (file_exists($imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Taisen Mahjong HaoPai 2-artwork.png')) {
        if (rename($imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-artwork.png', $imageDir . '/Taisen Mahjong HaoPai 2-artwork.png')) {
            echo "✓ Taisen Mahjong HaoPai 2 (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen Mahjong HaoPai 2-artwork.png\n";
        $skipped++;
    }
}

// Taisen Mahjong HaoPai 2 (Japan) → Taisen Mahjong HaoPai 2
if (file_exists($imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Taisen Mahjong HaoPai 2-cover.png')) {
        if (rename($imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-cover.png', $imageDir . '/Taisen Mahjong HaoPai 2-cover.png')) {
            echo "✓ Taisen Mahjong HaoPai 2 (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen Mahjong HaoPai 2-cover.png\n";
        $skipped++;
    }
}

// Taisen Mahjong HaoPai 2 (Japan) → Taisen Mahjong HaoPai 2
if (file_exists($imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Taisen Mahjong HaoPai 2-gameplay.png')) {
        if (rename($imageDir . '/Taisen Mahjong HaoPai 2 (Japan)-gameplay.png', $imageDir . '/Taisen Mahjong HaoPai 2-gameplay.png')) {
            echo "✓ Taisen Mahjong HaoPai 2 (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen Mahjong HaoPai 2-gameplay.png\n";
        $skipped++;
    }
}

// Taisen-gata Daisenryaku G (Japan) → Taisen-gata Daisenryaku G
if (file_exists($imageDir . '/Taisen-gata Daisenryaku G (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Taisen-gata Daisenryaku G-artwork.png')) {
        if (rename($imageDir . '/Taisen-gata Daisenryaku G (Japan)-artwork.png', $imageDir . '/Taisen-gata Daisenryaku G-artwork.png')) {
            echo "✓ Taisen-gata Daisenryaku G (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen-gata Daisenryaku G-artwork.png\n";
        $skipped++;
    }
}

// Taisen-gata Daisenryaku G (Japan) → Taisen-gata Daisenryaku G
if (file_exists($imageDir . '/Taisen-gata Daisenryaku G (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Taisen-gata Daisenryaku G-cover.png')) {
        if (rename($imageDir . '/Taisen-gata Daisenryaku G (Japan)-cover.png', $imageDir . '/Taisen-gata Daisenryaku G-cover.png')) {
            echo "✓ Taisen-gata Daisenryaku G (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen-gata Daisenryaku G-cover.png\n";
        $skipped++;
    }
}

// Taisen-gata Daisenryaku G (Japan) → Taisen-gata Daisenryaku G
if (file_exists($imageDir . '/Taisen-gata Daisenryaku G (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Taisen-gata Daisenryaku G-gameplay.png')) {
        if (rename($imageDir . '/Taisen-gata Daisenryaku G (Japan)-gameplay.png', $imageDir . '/Taisen-gata Daisenryaku G-gameplay.png')) {
            echo "✓ Taisen-gata Daisenryaku G (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taisen-gata Daisenryaku G-gameplay.png\n";
        $skipped++;
    }
}

// Tama _ Friends - 3 Choume Kouen Tamalympic (Japan) → Tama _ Friends - 3 Choume Kouen Tamalympic
if (file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-artwork.png')) {
        if (rename($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-artwork.png', $imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-artwork.png')) {
            echo "✓ Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tama _ Friends - 3 Choume Kouen Tamalympic-artwork.png\n";
        $skipped++;
    }
}

// Tama _ Friends - 3 Choume Kouen Tamalympic (Japan) → Tama _ Friends - 3 Choume Kouen Tamalympic
if (file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-cover.png')) {
        if (rename($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-cover.png', $imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-cover.png')) {
            echo "✓ Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tama _ Friends - 3 Choume Kouen Tamalympic-cover.png\n";
        $skipped++;
    }
}

// Tama _ Friends - 3 Choume Kouen Tamalympic (Japan) → Tama _ Friends - 3 Choume Kouen Tamalympic
if (file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-gameplay.png')) {
        if (rename($imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-gameplay.png', $imageDir . '/Tama _ Friends - 3 Choume Kouen Tamalympic-gameplay.png')) {
            echo "✓ Tama _ Friends - 3 Choume Kouen Tamalympic (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tama _ Friends - 3 Choume Kouen Tamalympic-gameplay.png\n";
        $skipped++;
    }
}

// Tarot no Yakata (Japan) → Tarot no Yakata
if (file_exists($imageDir . '/Tarot no Yakata (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Tarot no Yakata-artwork.png')) {
        if (rename($imageDir . '/Tarot no Yakata (Japan)-artwork.png', $imageDir . '/Tarot no Yakata-artwork.png')) {
            echo "✓ Tarot no Yakata (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarot no Yakata-artwork.png\n";
        $skipped++;
    }
}

// Tarot no Yakata (Japan) → Tarot no Yakata
if (file_exists($imageDir . '/Tarot no Yakata (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Tarot no Yakata-cover.png')) {
        if (rename($imageDir . '/Tarot no Yakata (Japan)-cover.png', $imageDir . '/Tarot no Yakata-cover.png')) {
            echo "✓ Tarot no Yakata (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarot no Yakata-cover.png\n";
        $skipped++;
    }
}

// Tarot no Yakata (Japan) → Tarot no Yakata
if (file_exists($imageDir . '/Tarot no Yakata (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Tarot no Yakata-gameplay.png')) {
        if (rename($imageDir . '/Tarot no Yakata (Japan)-gameplay.png', $imageDir . '/Tarot no Yakata-gameplay.png')) {
            echo "✓ Tarot no Yakata (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarot no Yakata-gameplay.png\n";
        $skipped++;
    }
}

// Tarzan - Lord of the Jungle (Europe) → Tarzan - Lord of the Jungle
if (file_exists($imageDir . '/Tarzan - Lord of the Jungle (Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Tarzan - Lord of the Jungle-artwork.png')) {
        if (rename($imageDir . '/Tarzan - Lord of the Jungle (Europe)-artwork.png', $imageDir . '/Tarzan - Lord of the Jungle-artwork.png')) {
            echo "✓ Tarzan - Lord of the Jungle (Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarzan - Lord of the Jungle-artwork.png\n";
        $skipped++;
    }
}

// Tarzan - Lord of the Jungle (Europe) → Tarzan - Lord of the Jungle
if (file_exists($imageDir . '/Tarzan - Lord of the Jungle (Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Tarzan - Lord of the Jungle-cover.png')) {
        if (rename($imageDir . '/Tarzan - Lord of the Jungle (Europe)-cover.png', $imageDir . '/Tarzan - Lord of the Jungle-cover.png')) {
            echo "✓ Tarzan - Lord of the Jungle (Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarzan - Lord of the Jungle-cover.png\n";
        $skipped++;
    }
}

// Tarzan - Lord of the Jungle (Europe) → Tarzan - Lord of the Jungle
if (file_exists($imageDir . '/Tarzan - Lord of the Jungle (Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Tarzan - Lord of the Jungle-gameplay.png')) {
        if (rename($imageDir . '/Tarzan - Lord of the Jungle (Europe)-gameplay.png', $imageDir . '/Tarzan - Lord of the Jungle-gameplay.png')) {
            echo "✓ Tarzan - Lord of the Jungle (Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tarzan - Lord of the Jungle-gameplay.png\n";
        $skipped++;
    }
}

// Taz in Escape from Mars (USA, Europe) → Taz in Escape from Mars
if (file_exists($imageDir . '/Taz in Escape from Mars (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Taz in Escape from Mars-artwork.png')) {
        if (rename($imageDir . '/Taz in Escape from Mars (USA, Europe)-artwork.png', $imageDir . '/Taz in Escape from Mars-artwork.png')) {
            echo "✓ Taz in Escape from Mars (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taz in Escape from Mars-artwork.png\n";
        $skipped++;
    }
}

// Taz in Escape from Mars (USA, Europe) → Taz in Escape from Mars
if (file_exists($imageDir . '/Taz in Escape from Mars (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Taz in Escape from Mars-cover.png')) {
        if (rename($imageDir . '/Taz in Escape from Mars (USA, Europe)-cover.png', $imageDir . '/Taz in Escape from Mars-cover.png')) {
            echo "✓ Taz in Escape from Mars (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taz in Escape from Mars-cover.png\n";
        $skipped++;
    }
}

// Taz in Escape from Mars (USA, Europe) → Taz in Escape from Mars
if (file_exists($imageDir . '/Taz in Escape from Mars (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Taz in Escape from Mars-gameplay.png')) {
        if (rename($imageDir . '/Taz in Escape from Mars (USA, Europe)-gameplay.png', $imageDir . '/Taz in Escape from Mars-gameplay.png')) {
            echo "✓ Taz in Escape from Mars (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Taz in Escape from Mars-gameplay.png\n";
        $skipped++;
    }
}

// Tengen World Cup Soccer (USA, Europe) → Tengen World Cup Soccer
if (file_exists($imageDir . '/Tengen World Cup Soccer (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Tengen World Cup Soccer-artwork.png')) {
        if (rename($imageDir . '/Tengen World Cup Soccer (USA, Europe)-artwork.png', $imageDir . '/Tengen World Cup Soccer-artwork.png')) {
            echo "✓ Tengen World Cup Soccer (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tengen World Cup Soccer-artwork.png\n";
        $skipped++;
    }
}

// Tengen World Cup Soccer (USA, Europe) → Tengen World Cup Soccer
if (file_exists($imageDir . '/Tengen World Cup Soccer (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Tengen World Cup Soccer-cover.png')) {
        if (rename($imageDir . '/Tengen World Cup Soccer (USA, Europe)-cover.png', $imageDir . '/Tengen World Cup Soccer-cover.png')) {
            echo "✓ Tengen World Cup Soccer (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tengen World Cup Soccer-cover.png\n";
        $skipped++;
    }
}

// Tengen World Cup Soccer (USA, Europe) → Tengen World Cup Soccer
if (file_exists($imageDir . '/Tengen World Cup Soccer (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Tengen World Cup Soccer-gameplay.png')) {
        if (rename($imageDir . '/Tengen World Cup Soccer (USA, Europe)-gameplay.png', $imageDir . '/Tengen World Cup Soccer-gameplay.png')) {
            echo "✓ Tengen World Cup Soccer (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tengen World Cup Soccer-gameplay.png\n";
        $skipped++;
    }
}

// Terminator 2 - Judgment Day (World) → Terminator 2 - Judgment Day
if (file_exists($imageDir . '/Terminator 2 - Judgment Day (World)-artwork.png')) {
    if (!file_exists($imageDir . '/Terminator 2 - Judgment Day-artwork.png')) {
        if (rename($imageDir . '/Terminator 2 - Judgment Day (World)-artwork.png', $imageDir . '/Terminator 2 - Judgment Day-artwork.png')) {
            echo "✓ Terminator 2 - Judgment Day (World)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Terminator 2 - Judgment Day-artwork.png\n";
        $skipped++;
    }
}

// Terminator 2 - Judgment Day (World) → Terminator 2 - Judgment Day
if (file_exists($imageDir . '/Terminator 2 - Judgment Day (World)-cover.png')) {
    if (!file_exists($imageDir . '/Terminator 2 - Judgment Day-cover.png')) {
        if (rename($imageDir . '/Terminator 2 - Judgment Day (World)-cover.png', $imageDir . '/Terminator 2 - Judgment Day-cover.png')) {
            echo "✓ Terminator 2 - Judgment Day (World)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Terminator 2 - Judgment Day-cover.png\n";
        $skipped++;
    }
}

// Terminator 2 - Judgment Day (World) → Terminator 2 - Judgment Day
if (file_exists($imageDir . '/Terminator 2 - Judgment Day (World)-gameplay.png')) {
    if (!file_exists($imageDir . '/Terminator 2 - Judgment Day-gameplay.png')) {
        if (rename($imageDir . '/Terminator 2 - Judgment Day (World)-gameplay.png', $imageDir . '/Terminator 2 - Judgment Day-gameplay.png')) {
            echo "✓ Terminator 2 - Judgment Day (World)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Terminator 2 - Judgment Day-gameplay.png\n";
        $skipped++;
    }
}

// Tesserae (USA) → Tesserae
if (file_exists($imageDir . '/Tesserae (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Tesserae-artwork.png')) {
        if (rename($imageDir . '/Tesserae (USA)-artwork.png', $imageDir . '/Tesserae-artwork.png')) {
            echo "✓ Tesserae (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tesserae-artwork.png\n";
        $skipped++;
    }
}

// Tesserae (USA) → Tesserae
if (file_exists($imageDir . '/Tesserae (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Tesserae-cover.png')) {
        if (rename($imageDir . '/Tesserae (USA)-cover.png', $imageDir . '/Tesserae-cover.png')) {
            echo "✓ Tesserae (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tesserae-cover.png\n";
        $skipped++;
    }
}

// Tesserae (USA) → Tesserae
if (file_exists($imageDir . '/Tesserae (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Tesserae-gameplay.png')) {
        if (rename($imageDir . '/Tesserae (USA)-gameplay.png', $imageDir . '/Tesserae-gameplay.png')) {
            echo "✓ Tesserae (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tesserae-gameplay.png\n";
        $skipped++;
    }
}

// Tom and Jerry - The Movie (Japan, Brazil) → Tom and Jerry - The Movie (Japan)[t +1]
if (file_exists($imageDir . '/Tom and Jerry - The Movie (Japan, Brazil)-cover.png')) {
    if (!file_exists($imageDir . '/Tom and Jerry - The Movie (Japan)[t +1]-cover.png')) {
        if (rename($imageDir . '/Tom and Jerry - The Movie (Japan, Brazil)-cover.png', $imageDir . '/Tom and Jerry - The Movie (Japan)[t +1]-cover.png')) {
            echo "✓ Tom and Jerry - The Movie (Japan, Brazil)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tom and Jerry - The Movie (Japan)[t +1]-cover.png\n";
        $skipped++;
    }
}

// Tom and Jerry - The Movie (Japan, Brazil) → Tom and Jerry - The Movie (Japan)[t +1]
if (file_exists($imageDir . '/Tom and Jerry - The Movie (Japan, Brazil)-gameplay.png')) {
    if (!file_exists($imageDir . '/Tom and Jerry - The Movie (Japan)[t +1]-gameplay.png')) {
        if (rename($imageDir . '/Tom and Jerry - The Movie (Japan, Brazil)-gameplay.png', $imageDir . '/Tom and Jerry - The Movie (Japan)[t +1]-gameplay.png')) {
            echo "✓ Tom and Jerry - The Movie (Japan, Brazil)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tom and Jerry - The Movie (Japan)[t +1]-gameplay.png\n";
        $skipped++;
    }
}

// Tom and Jerry the Movie Japan Brazil En (Ja) → Tom and Jerry - The Movie (Japan)[t +1]
if (file_exists($imageDir . '/Tom and Jerry the Movie Japan Brazil En (Ja)-artwork.png')) {
    if (!file_exists($imageDir . '/Tom and Jerry - The Movie (Japan)[t +1]-artwork.png')) {
        if (rename($imageDir . '/Tom and Jerry the Movie Japan Brazil En (Ja)-artwork.png', $imageDir . '/Tom and Jerry - The Movie (Japan)[t +1]-artwork.png')) {
            echo "✓ Tom and Jerry the Movie Japan Brazil En (Ja)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tom and Jerry - The Movie (Japan)[t +1]-artwork.png\n";
        $skipped++;
    }
}

// Tom and Jerry the Movie Japan Brazil En (Ja) → Tom and Jerry - The Movie (Japan)[t +1]
if (file_exists($imageDir . '/Tom and Jerry the Movie Japan Brazil En (Ja)-cover.png')) {
    if (!file_exists($imageDir . '/Tom and Jerry - The Movie (Japan)[t +1]-cover.png')) {
        if (rename($imageDir . '/Tom and Jerry the Movie Japan Brazil En (Ja)-cover.png', $imageDir . '/Tom and Jerry - The Movie (Japan)[t +1]-cover.png')) {
            echo "✓ Tom and Jerry the Movie Japan Brazil En (Ja)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tom and Jerry - The Movie (Japan)[t +1]-cover.png\n";
        $skipped++;
    }
}

// Tom and Jerry the Movie Japan Brazil En (Ja) → Tom and Jerry - The Movie (Japan)[t +1]
if (file_exists($imageDir . '/Tom and Jerry the Movie Japan Brazil En (Ja)-gameplay.png')) {
    if (!file_exists($imageDir . '/Tom and Jerry - The Movie (Japan)[t +1]-gameplay.png')) {
        if (rename($imageDir . '/Tom and Jerry the Movie Japan Brazil En (Ja)-gameplay.png', $imageDir . '/Tom and Jerry - The Movie (Japan)[t +1]-gameplay.png')) {
            echo "✓ Tom and Jerry the Movie Japan Brazil En (Ja)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Tom and Jerry - The Movie (Japan)[t +1]-gameplay.png\n";
        $skipped++;
    }
}

// Torarete Tamaruka (Japan) → Torarete Tamaruka
if (file_exists($imageDir . '/Torarete Tamaruka (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Torarete Tamaruka-artwork.png')) {
        if (rename($imageDir . '/Torarete Tamaruka (Japan)-artwork.png', $imageDir . '/Torarete Tamaruka-artwork.png')) {
            echo "✓ Torarete Tamaruka (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Torarete Tamaruka-artwork.png\n";
        $skipped++;
    }
}

// Torarete Tamaruka (Japan) → Torarete Tamaruka
if (file_exists($imageDir . '/Torarete Tamaruka (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Torarete Tamaruka-cover.png')) {
        if (rename($imageDir . '/Torarete Tamaruka (Japan)-cover.png', $imageDir . '/Torarete Tamaruka-cover.png')) {
            echo "✓ Torarete Tamaruka (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Torarete Tamaruka-cover.png\n";
        $skipped++;
    }
}

// Torarete Tamaruka (Japan) → Torarete Tamaruka
if (file_exists($imageDir . '/Torarete Tamaruka (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Torarete Tamaruka-gameplay.png')) {
        if (rename($imageDir . '/Torarete Tamaruka (Japan)-gameplay.png', $imageDir . '/Torarete Tamaruka-gameplay.png')) {
            echo "✓ Torarete Tamaruka (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Torarete Tamaruka-gameplay.png\n";
        $skipped++;
    }
}

// Urban Strike (USA) → Urban Strike
if (file_exists($imageDir . '/Urban Strike (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Urban Strike-artwork.png')) {
        if (rename($imageDir . '/Urban Strike (USA)-artwork.png', $imageDir . '/Urban Strike-artwork.png')) {
            echo "✓ Urban Strike (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Urban Strike-artwork.png\n";
        $skipped++;
    }
}

// Urban Strike (USA) → Urban Strike
if (file_exists($imageDir . '/Urban Strike (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Urban Strike-cover.png')) {
        if (rename($imageDir . '/Urban Strike (USA)-cover.png', $imageDir . '/Urban Strike-cover.png')) {
            echo "✓ Urban Strike (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Urban Strike-cover.png\n";
        $skipped++;
    }
}

// Urban Strike (USA) → Urban Strike
if (file_exists($imageDir . '/Urban Strike (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Urban Strike-gameplay.png')) {
        if (rename($imageDir . '/Urban Strike (USA)-gameplay.png', $imageDir . '/Urban Strike-gameplay.png')) {
            echo "✓ Urban Strike (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Urban Strike-gameplay.png\n";
        $skipped++;
    }
}

// Vampire - Master of Darkness (USA) → Vampire - Master of Darkness
if (file_exists($imageDir . '/Vampire - Master of Darkness (USA)-artwork.png')) {
    if (!file_exists($imageDir . '/Vampire - Master of Darkness-artwork.png')) {
        if (rename($imageDir . '/Vampire - Master of Darkness (USA)-artwork.png', $imageDir . '/Vampire - Master of Darkness-artwork.png')) {
            echo "✓ Vampire - Master of Darkness (USA)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Vampire - Master of Darkness-artwork.png\n";
        $skipped++;
    }
}

// Vampire - Master of Darkness (USA) → Vampire - Master of Darkness
if (file_exists($imageDir . '/Vampire - Master of Darkness (USA)-cover.png')) {
    if (!file_exists($imageDir . '/Vampire - Master of Darkness-cover.png')) {
        if (rename($imageDir . '/Vampire - Master of Darkness (USA)-cover.png', $imageDir . '/Vampire - Master of Darkness-cover.png')) {
            echo "✓ Vampire - Master of Darkness (USA)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Vampire - Master of Darkness-cover.png\n";
        $skipped++;
    }
}

// Vampire - Master of Darkness (USA) → Vampire - Master of Darkness
if (file_exists($imageDir . '/Vampire - Master of Darkness (USA)-gameplay.png')) {
    if (!file_exists($imageDir . '/Vampire - Master of Darkness-gameplay.png')) {
        if (rename($imageDir . '/Vampire - Master of Darkness (USA)-gameplay.png', $imageDir . '/Vampire - Master of Darkness-gameplay.png')) {
            echo "✓ Vampire - Master of Darkness (USA)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Vampire - Master of Darkness-gameplay.png\n";
        $skipped++;
    }
}

// Virtua Fighter Animation (USA, Europe) → Virtua Fighter Animation
if (file_exists($imageDir . '/Virtua Fighter Animation (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Animation-artwork.png')) {
        if (rename($imageDir . '/Virtua Fighter Animation (USA, Europe)-artwork.png', $imageDir . '/Virtua Fighter Animation-artwork.png')) {
            echo "✓ Virtua Fighter Animation (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Animation-artwork.png\n";
        $skipped++;
    }
}

// Virtua Fighter Animation (USA, Europe) → Virtua Fighter Animation
if (file_exists($imageDir . '/Virtua Fighter Animation (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Animation-cover.png')) {
        if (rename($imageDir . '/Virtua Fighter Animation (USA, Europe)-cover.png', $imageDir . '/Virtua Fighter Animation-cover.png')) {
            echo "✓ Virtua Fighter Animation (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Animation-cover.png\n";
        $skipped++;
    }
}

// Virtua Fighter Animation (USA, Europe) → Virtua Fighter Animation
if (file_exists($imageDir . '/Virtua Fighter Animation (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Animation-gameplay.png')) {
        if (rename($imageDir . '/Virtua Fighter Animation (USA, Europe)-gameplay.png', $imageDir . '/Virtua Fighter Animation-gameplay.png')) {
            echo "✓ Virtua Fighter Animation (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Animation-gameplay.png\n";
        $skipped++;
    }
}

// Virtua Fighter Mini (Japan) → Virtua Fighter Mini
if (file_exists($imageDir . '/Virtua Fighter Mini (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Mini-artwork.png')) {
        if (rename($imageDir . '/Virtua Fighter Mini (Japan)-artwork.png', $imageDir . '/Virtua Fighter Mini-artwork.png')) {
            echo "✓ Virtua Fighter Mini (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Mini-artwork.png\n";
        $skipped++;
    }
}

// Virtua Fighter Mini (Japan) → Virtua Fighter Mini
if (file_exists($imageDir . '/Virtua Fighter Mini (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Mini-cover.png')) {
        if (rename($imageDir . '/Virtua Fighter Mini (Japan)-cover.png', $imageDir . '/Virtua Fighter Mini-cover.png')) {
            echo "✓ Virtua Fighter Mini (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Mini-cover.png\n";
        $skipped++;
    }
}

// Virtua Fighter Mini (Japan) → Virtua Fighter Mini
if (file_exists($imageDir . '/Virtua Fighter Mini (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Virtua Fighter Mini-gameplay.png')) {
        if (rename($imageDir . '/Virtua Fighter Mini (Japan)-gameplay.png', $imageDir . '/Virtua Fighter Mini-gameplay.png')) {
            echo "✓ Virtua Fighter Mini (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Virtua Fighter Mini-gameplay.png\n";
        $skipped++;
    }
}

// WWF Wrestlemania - Steel Cage Challenge (USA, Europe) → WWF Wrestlemania - Steel Cage Challenge
if (file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-artwork.png')) {
    if (!file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge-artwork.png')) {
        if (rename($imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-artwork.png', $imageDir . '/WWF Wrestlemania - Steel Cage Challenge-artwork.png')) {
            echo "✓ WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: WWF Wrestlemania - Steel Cage Challenge-artwork.png\n";
        $skipped++;
    }
}

// WWF Wrestlemania - Steel Cage Challenge (USA, Europe) → WWF Wrestlemania - Steel Cage Challenge
if (file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-cover.png')) {
    if (!file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge-cover.png')) {
        if (rename($imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-cover.png', $imageDir . '/WWF Wrestlemania - Steel Cage Challenge-cover.png')) {
            echo "✓ WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: WWF Wrestlemania - Steel Cage Challenge-cover.png\n";
        $skipped++;
    }
}

// WWF Wrestlemania - Steel Cage Challenge (USA, Europe) → WWF Wrestlemania - Steel Cage Challenge
if (file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-gameplay.png')) {
    if (!file_exists($imageDir . '/WWF Wrestlemania - Steel Cage Challenge-gameplay.png')) {
        if (rename($imageDir . '/WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-gameplay.png', $imageDir . '/WWF Wrestlemania - Steel Cage Challenge-gameplay.png')) {
            echo "✓ WWF Wrestlemania - Steel Cage Challenge (USA, Europe)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: WWF Wrestlemania - Steel Cage Challenge-gameplay.png\n";
        $skipped++;
    }
}

// Wagyan Land (Japan) → Wagyan Land
if (file_exists($imageDir . '/Wagyan Land (Japan)-artwork.png')) {
    if (!file_exists($imageDir . '/Wagyan Land-artwork.png')) {
        if (rename($imageDir . '/Wagyan Land (Japan)-artwork.png', $imageDir . '/Wagyan Land-artwork.png')) {
            echo "✓ Wagyan Land (Japan)-artwork.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Wagyan Land-artwork.png\n";
        $skipped++;
    }
}

// Wagyan Land (Japan) → Wagyan Land
if (file_exists($imageDir . '/Wagyan Land (Japan)-cover.png')) {
    if (!file_exists($imageDir . '/Wagyan Land-cover.png')) {
        if (rename($imageDir . '/Wagyan Land (Japan)-cover.png', $imageDir . '/Wagyan Land-cover.png')) {
            echo "✓ Wagyan Land (Japan)-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Wagyan Land-cover.png\n";
        $skipped++;
    }
}

// Wagyan Land (Japan) → Wagyan Land
if (file_exists($imageDir . '/Wagyan Land (Japan)-gameplay.png')) {
    if (!file_exists($imageDir . '/Wagyan Land-gameplay.png')) {
        if (rename($imageDir . '/Wagyan Land (Japan)-gameplay.png', $imageDir . '/Wagyan Land-gameplay.png')) {
            echo "✓ Wagyan Land (Japan)-gameplay.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Wagyan Land-gameplay.png\n";
        $skipped++;
    }
}

// alien-syndrome-PAL → Alien Syndrome
if (file_exists($imageDir . '/alien-syndrome-PAL-cover.png')) {
    if (!file_exists($imageDir . '/Alien Syndrome-cover.png')) {
        if (rename($imageDir . '/alien-syndrome-PAL-cover.png', $imageDir . '/Alien Syndrome-cover.png')) {
            echo "✓ alien-syndrome-PAL-cover.png\n";
            $renamed++;
        }
    } else {
        echo "⚠️ EXISTE: Alien Syndrome-cover.png\n";
        $skipped++;
    }
}

echo "\n═══════════════════════════════════════════════════════════════════════════════\n";
echo "✅ Renommés: $renamed | ⚠️ Ignorés: $skipped\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n";
