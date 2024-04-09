<?php

namespace App\Boutique\Builder;

// Classe abstraite pour la construction de formulaires de base
abstract class AbstractFormBuilder
{
    protected $class_form;
    protected $method;
    protected $action;
    protected $fields = [];
    protected $validator;

    /**
     * Method setClassForm
     *
     * Définir l'attribut class de la balise form
     *
     * @param string $class_form [class de la balise form]
     *
     * @return void
     */
    public function setClassForm(string $class_form)
    {
        $this->class_form = $class_form;
    }

    /**
     * Method setMethod
     *
     * Définir l'attribut method de la balise form
     *
     * @param string $method [type de méthode du formulaire POST|GET]
     *
     * @return void
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    /**
     * Method setAction
     *
     * Définir l'attribut action de la balise form
     *
     * @param string $action [page ou de traitement du formulaire]
     *
     * @return void
     */
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /** Ajouter des champs au formulaire / le champ label est ajouté automatiquement et lié au champ Input par son id
     *  Pour désactivé l'ajout automatique du label ajouté en dernier paramètre de la méthode
     *  un tableau $options ['label-false' = 1, 'autre_option' = 'valeur'...]
     *
     *  Paramètres de la méthod :
     *
     *  $type = type de l'input pris en charge : text,password, email ,image, date, month, number, radio, checkbox, range, reset
     *  $name = nom de l'input
     *  $label = text du label
     *  $options = toutes les options à ajouté à un champ input sous forme de tableau
     *  il est ainsi possible d'ajouter toute valeur : exemple pour ajouter une classe à notre input ['class', 'nom-de-classe']
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

        // Cette méthode génère le code Javascript pour la validation du champ
        $this->generateValidationScript($name);
    }

    // Méthode abstraite pour le rendu du formulaire
    abstract public function render();

    // Méthode pour générer le code Javascript de validation côté Client
    // La validation côté client améliore UI/UX pour le client
    // mais nécessite tout de même une validation côté serveur
    protected function generateValidationScript($fieldName)
    {
        if ($this->validator && $this->validator->hasRules($fieldName)) {
            $rules = $this->validator->getRules($fieldName);

            // Générer le code Javascript de validation selon les règles définies dans la class Validator
            // 3 méthodes de validation sont disponibles pour le moment

            // required, min_length, max_length
            // required le champ doit être rempli lors de la validation
            // min_length le nombre de caractère minimum n'a pas été atteinte
            // max_length le nombre de caractère maximum a été dépassé
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
                    // Pour continuer les méthodes de validation Javascript
                    // C'est du Javascript que l'on écrit au format TEXT car il est généré par PHP
                    // Dynamiquement côté serveur et sera rendu et interpréter côté client par le navigateur.
                }
            }

            // Ajouter le code JavaScript de validation au formulaire
            $this->addValidationScript($validationScript);
        }
    }

    // Méthode abstraite pour ajouter le code JavaScript de validation au formulaire
    abstract protected function addValidationScript($script);
}
