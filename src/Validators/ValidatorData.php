<?php

namespace App\Boutique;

use Attribute;

/**
 * ValidatorData
 * Déclaration #[Attribute]
 * Les attributs permettent d'ajouter des informations de métadonnées structurées et lisibles par la machine sur les déclarations dans le code:
 * les classes, les méthodes, les fonctions, les paramètres, les propriétés et les constantes de classe peuvent être la cible d'un attribut. 
 * Les métadonnées définies par les attributs peuvent ensuite être inspectées au moment de l'exécution à l'aide de l'API de Réflexion. 
 * Les attributs peuvent donc être considérés comme un langage de configuration intégré directement dans le code.
 * 
   https://www.php.net/manual/fr/language.attributes.overview.php
 */
#[Attribute]
class ValidatorData
{
    public string $type;
    public ?array $options;
    public ?string $messageError;

    private object $fileMessage;

    public function __construct(string $type, ?array $options = null)
    {
        $this->fileMessage = FileImportJson::getFile(
            'config/error-message.fr.json',
        );
        $this->type = $type;
        $this->options = $options;
        var_dump($this->fileMessage);
    }

    public function validate($value): bool
    {
        switch ($this->type) {
            case 'numeric': // Si c'est un numérique
                if (is_numeric($value)):
                    return true;
                else:
                    $this->messageError =
                        'Veuillez entrez une valeur numérique';
                    return false;
                endif;

            case 'email': // Filter Mail
                if (filter_var($value, FILTER_VALIDATE_EMAIL) === false):
                    $this->messageError = 'Veuillez entrez une email valide';
                    return false;
                else:
                    return true;
                endif;

            case 'string': // Si c'est une chaîne de caratère
                if (!is_string($value)):
                    $this->messageError = 'Veuillez vérifier vos données.';
                    return false;
                else:
                    return true;
                endif;

            case 'length': // Si c'est une valeur comprise entre min et max
                $length = strlen($value);

                // Si la valeur est inférieur à celle définit dans l'attrribut
                if (
                    $this->options &&
                    isset($this->options['min']) &&
                    $length < $this->options['min']
                ):
                    $this->messageError = "Veuillez entrez une longueur valide comprise entre $this->options['min'] et {$this->options['max']} caratères";

                    return false;
                endif;

                // Si la valeur est suppérieur à celle définit dans l'attrribut
                if (
                    $this->options &&
                    isset($this->options['max']) &&
                    $length > $this->options['max']
                ):
                    $this->messageError = "Veuillez entrez une longueur valide comprise entre $this->options['min'] et {$this->options['max']} caratères";

                    return false;
                endif;

                return true;

            case 'in': // Si la valeur ne ce trouve pas dans le tableau
                $this->messageError = "La valeur n'as pas était trouvé";

                return in_array($value, $this->options);

            case 'full_name': // Pour le champ full_name
                if (preg_match('/^(\w{3,25})$/', $value)):
                    // test regex sur les caratère \w min 3 et max 25

                    return true; // Si le masque est bon true
                endif;

                $this->messageError = "Votre prénom n'as pas un format valide";

                return false;

            case 'password':
                if (
                    preg_match(
                        '/^(?(?=.*[A-Z])(?=.*[0-9])(?=.*[\%\$\,\;\!\-_])[a-zA-Z0-9\%\$\,\;\!\-_]{6,25})$/',
                        $value,
                    )
                ):
                    // test regex une majuscule minimum, un caratère numeric minimum, un caratère spécial minimum % $ , ; ! _ - sont accépté, 6 caratère min et 25 max.

                    return true; // Si le masque est bon true
                endif;

                $this->messageError =
                    'Votre mots de passe dois être conforme au modèle exemple : A12xHs5a!25';

                return false;

            case 'passwordCompare':
                if ($value === $this->options['password']):
                    // test password identique

                    return true; // Si le masque est bon true
                endif;

                $this->messageError = 'Les mots de passe ne sont pas identique';

                return false;

            case 'regex':
                if (preg_match('/^' . $this->options['regex'] . '$/', $value)):
                    // test regex sur les caratère \w min 3 et max 25

                    return true; // Si le masque est bon true
                endif;

                $this->messageError = "Ooops une erreur c'est produite";

                return false;

            default:
                return false;
        }
    }
}
