# Le Jeu du Pendu

## Contexte

Exercice de synthèse pour le cours de PHP sur les fondamentaux de la programmation, dispensé à l'IFOSUP de Wavre durant l'année scolaire 2024/2025 par Christophe Van Maercke.

Cet exercice couvre les bases suivantes :

- variables
- structures conditionnelles
- structures itératives
- fonctions
- manipulation de fichiers

## Consignes

- **Objectif** : Développer un jeu du pendu qui se joue dans le terminal.
- **Fonctionnalités** :
    - Le mot est choisi aléatoirement à partir d'un mini dictionnaire situé dans le fichier `data/dictionnaire.json`.
    - Les mots présents dans le dictionnaire sont classés dans 4 catégories que l'on peut sélectionner à l'aide d'un argument facultatif en appelant la fonction principale que vous développerez dans le fichier `fonctions/app.php`. Si aucune catégorie n'est précisée lors de l'appel, le mot à découvrir est choisi aléatoirement parmi toutes les catégories.
    - Le jeu affiche diverses informations avant chaque nouveau tour :
        - Le nombre de vies restantes.
        - Les lettres qui ont déjà été proposées. Par exemple : `[o, s, e]`.
        - Les lettres découvertes ainsi que des traits d'union pour celles qui restent encore à découvrir. Par exemple : `_o_sso_`.
    - Seules les lettres en minuscules et sans accents sont autorisées en entrée utilisateur. Si le joueur saisit autre chose, un message d'avertissement lui sera affiché.
    - Lorsque le joueur termine une partie, afficher s'il a gagné ou perdu et le mot qu'il fallait découvrir.

- **Voici une méthode permettant de vérifier qu'une chaîne de caractères n'est composée que de lettres non accentuées** : Pour comparer une plage de caractères à partir de leurs codes ASCII, vous pouvez vous référer à la [table des codes ASCII](https://www.ascii-code.com/fr).

    - `$entreeUtilisateur >= "A" && $entreeUtilisateur <= "Z"` : Si le code ASCII du caractère contenu dans la variable `$entreeUtilisateur` est compris entre celui de "A" (65) et celui de "Z" (90), il s'agit d'une lettre majuscule sans accent.
    - `$entreeUtilisateur >= "a" && $entreeUtilisateur <= "z"` : Si le code ASCII du caractère contenu dans la variable `$entreeUtilisateur` est compris entre celui de "a" (97) et celui de "z" (122), il s'agit d'une lettre minuscule sans accent.

- **Quelques fonctions prédéfinies pouvant s'avérer utiles** :
    - `array_fill()` : Permet de remplir un tableau avec une même valeur.
    - `array_rand()` : Permet de sélectionner aléatoirement la clé d'un tableau.
    - `in_array()` : Permet de vérifier si une valeur existe dans un tableau.
    - `isset()` : Permet de vérifier si un élément existe.
    - `strlen()` : Retourne le nombre d'octets d'une chaîne. En encodage UTF-8, chaque caractère non accentué (ASCII standard) occupe 1 octet.
    - `strtolower()` : Permet de passer toutes les lettres d'une chaîne en minuscules.
    - `str_contains()` : Permet de savoir si un caractère est présent dans une chaîne.
    - N'oubliez de consulter [la documentation officielle de PHP](https://www.php.net/manual/fr/).

- **Développeur(s)** : ...