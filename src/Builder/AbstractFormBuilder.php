<?php

namespace App\Boutique;

// Classe abstraite pour la construction de formulaires
abstract class AbstractFormBuilder
{
    protected $fields = [];
    protected $validator;

    // Méthode pour ajouter un champ au formulaire
    public function addField($type, $name, $label, $options = [])
    {
        $this->fields[] = [
            'type' => $type,
            'name' => $name,
            'label' => $label,
            'options' => $options,
        ];

        // Générer le code JavaScript de validation pour ce champ
        $this->generateValidationScript($name);
    }

    // Méthode abstraite pour le rendu du formulaire
    abstract public function render();

    // Méthode pour générer le code JavaScript de validation
    protected function generateValidationScript($fieldName)
    {
        if ($this->validator && $this->validator->hasRules($fieldName)) {
            $rules = $this->validator->getRules($fieldName);

            // Générer le code JavaScript de validation selon les règles définies dans Validator
            // Cela peut être adapté en fonction de vos règles de validation spécifiques
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
                    // Ajoutez d'autres types de règles de validation au besoin
                }
            }

            // Ajouter le code JavaScript de validation au formulaire
            $this->addValidationScript($validationScript);
        }
    }

    // Méthode abstraite pour ajouter le code JavaScript de validation au formulaire
    abstract protected function addValidationScript($script);
}
