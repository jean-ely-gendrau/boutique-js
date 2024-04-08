<?php

namespace App\Boutique;

// Classe abstraite pour la construction de formulaires de base
abstract class AbstractFormBuilder
{
    protected $fields = [];
    protected $validator;

    // Méthode pour ajouter un champ au formulaire
    /*
        $type = type de l'input pris en charge : text,password, email ,image, date, month, number, radio, checkbox, range, reset
        $name = nom de l'input
        $label = text du label
        $options = toute les options à ajouté à un champ input sous forme de tableau
        il est ainsi possible d'ajouté toute valeur : exemple pour ajouté une classe à notre input ['class', 'nom-de-classe'] 
    */
    public function addField($type, $id, $name, $label, $options = [])
    {
        $this->fields[] = [
            'type' => $type,
            'id' => $id,
            'name' => $name,
            'label' => $label,
            'options' => $options,
        ];

        // Cette méthod génére le code JavaScript pour la validation du champ
        $this->generateValidationScript($name);
    }

    // Méthode abstraite pour le rendu du formulaire
    abstract public function render();

    // Méthode pour générer le code JavaScript de validation côté Client
    // La validation côté client améliore UI/UX pour le client
    // mais n'écessite tout de même une validation côté serveur
    protected function generateValidationScript($fieldName)
    {
        if ($this->validator && $this->validator->hasRules($fieldName)) {
            $rules = $this->validator->getRules($fieldName);

            // Générer le code JavaScript de validation selon les règles définies dans la class Validator
            // 3 méthode de validation sont disponible pour le moment

            // required, min_length, max_length
            // required le champ dois être remplit lors de la validation
            // min_length le nombre de caractère minimum n'as pas était atteinte
            // max_length le nombre de caractère maximum à était dépasser
            $validationScript =
                'var ' .
                $fieldName .
                ' = document.getElementById("' .
                $fieldName .
                '").value;';

            foreach ($rules as $rule) {
                switch ($rule['type']) {
                    case 'required':
                        $validationScript .=
                            'if (' .
                            $fieldName .
                            '.trim() === "") { alert("' .
                            $rule['message'] .
                            '"); return; }';
                        break;

                    case 'min_length':
                        $validationScript .=
                            'if (' .
                            $fieldName .
                            '.length < ' .
                            $rule['value'] .
                            ') { alert("' .
                            $rule['message'] .
                            '"); return; }';
                        break;

                    case 'max_length':
                        $validationScript .=
                            'if (' .
                            $fieldName .
                            '.length > ' .
                            $rule['value'] .
                            ') { alert("' .
                            $rule['message'] .
                            '"); return; }';
                        break;
                    // Pour continué les méthod de validation javascript
                    // C'est du javascript que l'on écrit au format TEXT car il est générer par PHP
                    // Dynamiquement côté serveur et sera rendu et interpréter côté client par le naviguateur.
                }
            }

            // Ajouter le code JavaScript de validation au formulaire
            $this->addValidationScript($validationScript);
        }
    }

    // Méthode abstraite pour ajouter le code JavaScript de validation au formulaire
    abstract protected function addValidationScript($script);
}
