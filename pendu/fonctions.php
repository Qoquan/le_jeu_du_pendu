<?php
$erreurs = 0;
$lettresDevinees = "";
$lettresErreur = [];
function recupererDictionnaire() 
{
    
    $dicoChemin = __DIR__ . '/../data/dictionnaire.json';
    $contenu = file_get_contents($dicoChemin);
    $json = json_decode($contenu, true);
    // Aplatir récursivement et normaliser en MAJUSCULES
    $listeMots = [];
    $flatten = function ($item) use (&$listeMots, &$flatten) {
        if (is_array($item)) {
            foreach ($item as $v) $flatten($v);
        } elseif (is_string($item)) {
            $mot = strtoupper(trim($item));
            if ($mot !== '') $listeMots[] = $mot;
        }
        // Les autres types sont ignorés
    };
    $flatten($json);

    // Dédupliquer
    $listeMots = array_values(array_unique($listeMots));
    // Debug utile :
    // echo "[DEBUG] Mots chargés: " . count($listeMots) . PHP_EOL;
    return $listeMots; // <- on renvoie une LISTE PLATE de mots (en MAJ)
}
function choixDuMot($listeMots)
{
    $index = array_rand($listeMots);
    $mot = $listeMots[$index];
    return $mot;
}

function demanderLettres() 
{
    $lettres = readline("Entrez une lettre : ");
    $lettres = strtoupper($lettres);
    if (strlen($lettres) != 1 || !ctype_alpha($lettres)) {
        echo "Veuillez entrer une seule lettre." . PHP_EOL;
        return demanderLettres();
    }
    return $lettres;
}
function lettreEstDansMot($lettre, $mot)
{
    global $lettresDevinees, $erreurs, $lettresErreurs;

    // Si jamais $lettresErreurs n'est pas défini, on l'initialise
    if (!is_array($lettresErreurs)) {
        $lettresErreurs = [];
    }

    $trouve = false;

    for ($i = 0; $i < strlen($mot); $i++) {
        if ($mot[$i] === $lettre) {
            $trouve = true;
            // Ajouter la lettre devinée si elle n'est pas déjà présente
            if (strpos($lettresDevinees, $lettre) === false) {
                $lettresDevinees .= $lettre;
            }
        }
    }

    if ($trouve) {
        return $lettresDevinees;
    } else {
        $erreurs++;
        echo "Lettre incorrecte !" . PHP_EOL;
        // Ajouter la lettre erronée si elle n'y est pas déjà
        if (!in_array($lettre, $lettresErreurs)) {
            $lettresErreurs[] = $lettre;
            echo "Lettres erronées jusqu'à présent : " . implode(", ", $lettresErreurs) . PHP_EOL;
        }
        return $erreurs;
    }
}

function afficherMot($mot, $lettresDevinees) 
{
    $affichage = "";
    for ($i = 0; $i < strlen($mot); $i++) {
        if (in_array($mot[$i], $lettresDevinees)) {
            $affichage .= $mot[$i] . " ";
        } else {
            $affichage .= "_ ";
        }
    }
    echo "Mot à deviner : " . trim($affichage) . PHP_EOL;
}
function dessinerPendu($erreurs) {
    $etapes = [
        "
         -----
         |   |
             |
             |
             |
        ========",
        "
         -----
         |   |
         O   |
             |
             |
        ========",
        "
         -----
         |   |
         O   |
         |   |
             |
        ========",
        "
         -----
         |   |
         O   |
        /|   |
             |
        ========",
        "
         -----
         |   |
         O   |
        /|\\  |
             |
        ========",
        "
         -----
         |   |
         O   |
        /|\\  |
        /    |
        ========",
        "
         -----
         |   |
         O   |
        /|\\  |
        / \\  |
        ========"
    ];
    echo $etapes[$erreurs] . PHP_EOL;
}