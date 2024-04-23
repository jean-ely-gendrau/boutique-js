<?php

namespace App\Boutique\Validators;

use App\Boutique\Components\FileImportJson;

class ReflectionValidator
{
    public static function importErrorMessage()
    {
        // Erreur par défault dans le cas ou aucun type d'eereur ou le fichier ne serairt pas trouvé
        $errorDefault = "Vérifier les données que vous avez saisie.";

        // Import du fichier json error dans le dossier /config
        // Vois ici la possibilité de charger un autre fichier
        $importMessageError = FileImportJson::getFile(
            'config/error-message.fr.json',
        );

        // Sélectrion de la branche ValidatorData dans le fichier Json
        // Vois ici la possibilité de charger un autre branche
        $fileMessage = $importMessageError?->ValidatorData;

        return (object)['errorDefault' => $errorDefault, 'fileMessage' => $fileMessage];
    }

    /**
     * Method validate
     *
     * @param $object $object [Instance de l'objet qui a des Attribut à analyser]
     *
     * @return array
     */
    public static function validate($object): array
    {
        $errors = [];
        // Nex Instance de ReflectionClass
        $reflection = new \ReflectionClass($object);
        $properties = $reflection->getProperties(); //Obtenir les propriétés de la classe


        $errorsMessage = self::importErrorMessage();

        // Parcours les propriétés de la class
        foreach ($properties as $property) {
            //ReflectionClass::getAttributes — Récupère les attributs d'une classe
            // Cela retourne un tableau vide si aucun attribut n'a été trouvé
            $attributes = $property->getAttributes(ValidatorData::class);

            // On parcours les attributs
            foreach ($attributes as $attribute) {
                $validator = $attribute->newInstance(); // New instance
                $propertyName = $property->getName(); // Nom de la propriété exemple pour (full_name) dans la class /Models/Users le nom de l'attribut en correspondance de ValidatorData -> #[ValidatorData('full_name')]
                $propertyValue = $property->getValue($object); // Valeur de la propriété dans l'exemple précedant il ni à pas de valeur. Nous pourrions avoir ceci : #[ValidatorData('string', ['min' => 6, 'max' => 20])]

                // Si la méthode return false (une erreur a été trouver lors de la validation de données)
                if (!$validator->validate($propertyValue)) {

                    // On ajoute au tableau errors le message indexés par son nom
                    $errors[$propertyName] = $errorsMessage->fileMessage->{$propertyName} ?? $errorsMessage->errorDefault;
                }
            }
        }

        return $errors;
    }
}
