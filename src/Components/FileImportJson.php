<?php

namespace App\Boutique;

class FileImportJson
{
    /**
     * Method getFile
     *
     * @param string $filePath [chemin du fichier à partir du répertoire frontend exemple 'config/config.json']
     * @param bool $array [true si les données son retourner en array associative]
     *
     * @return mixed
     */
    public static function getFile(string $filePath, bool $array = false): mixed
    {
        $getFile = file_get_contents(
            __DIR__ . DIRECTORY_SEPARATOR . "../../{$filePath}",
        );
        return $array ? json_decode($getFile, true) : json_decode($getFile);
    }
}
