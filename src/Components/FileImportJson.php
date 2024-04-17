<?php

namespace App\Boutique\Components;

/**
 * FileImportJson
 *
 * Cette class permet de charger un fichier json et de retourner le résultat
 * sous forme de class stdClass() ou sous forme de tableau.
 *
 * Une méthode static prenant deux paramètres dont un optionnel.
 *
 * Paramètre :
 *
 * string $filePath = le chemin du fichier.
 * bool $array = true|false L'option par défaut est false. Dans le cas où vous souhaitez que les résultats soient sous forme de tableau associatif passé à true.
 *
 * Pour l'utiliser :
 * FileImportJson::getFile(string $filePath, bool $array = false)
 */
class FileImportJson
{
    /**
     * Method getFile
     *
     * @param string $filePath [chemin du fichier à partir de la racine de l'application: exemple 'config/config.json']
     * @param bool $array [true si les données son retourner en array associative]
     *
     * @return mixed
     */
    public static function getFile(string $filePath, bool $array = false): mixed
    {
        // Import du fichier. Vérifier que ce chemin mène à la racine : __DIR__ . DIRECTORY_SEPARATOR . "../../
        $getFile = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "../../{$filePath}");

        /* Assignation de la valeur de retour avec la condition Ternaire */
        return $array ? json_decode($getFile, true) /* Tableau Associatif */ : json_decode($getFile); /* stdClass */
    }
}
