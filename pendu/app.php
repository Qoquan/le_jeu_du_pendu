<?php
/*
    Ce fichier contient la fonction principale du jeu du pendu.

    Vous êtes encouragé à organiser les fonctions secondaires dans d'autres fichiers 
    et à utiliser les outils d'importation appropriés pour structurer votre code de manière claire et efficace.
*/
require_once 'fonctions.php';
$erreurs = 0;
$lettresDevinees = "";
$lettresErreur = [];
function jouerAuPendu() {
    global $erreurs, $lettresDevinees;

    // 1. Charger dictionnaire et choisir un mot
    $listeMots = recupererDictionnaire();
    $mot = choixDuMot($listeMots);

    // 2. Variables de jeu
    $maxErreurs = 6; // tu as 7 étapes (0 à 6)
    $lettresDevinees = "";
    $erreurs = 0;

    echo "Bienvenue au jeu du Pendu !" . PHP_EOL;

    // 3. Boucle principale
    while ($erreurs < $maxErreurs) {
        dessinerPendu($erreurs);
        afficherMot($mot, str_split($lettresDevinees));

        // Vérifier si gagné
        $motActuel = "";
        for ($i = 0; $i < strlen($mot); $i++) {
            if (strpos($lettresDevinees, $mot[$i]) !== false) {
                $motActuel .= $mot[$i];
            } else {
                $motActuel .= "_";
            }
        }
        if ($motActuel === $mot) {
            echo "Félicitations ! Vous avez trouvé le mot : $mot" . PHP_EOL;
            return;
        }

        // Demander une lettre
        $lettre = demanderLettres();
        lettreEstDansMot($lettre, $mot);
    }

    // 4. Partie perdue
    dessinerPendu($erreurs);
    echo "Dommage ! Vous avez perdu. Le mot était : $mot" . PHP_EOL;
}

jouerAuPendu();