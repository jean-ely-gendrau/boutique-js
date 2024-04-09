<?php

namespace App\Boutique\Builder;

// Classe abstraite pour la construction de formulaires de base
abstract class AbstractFormBuilder
{
    protected $class_form;
    protected $class_action_group;
    protected $method;
    protected $action;
    protected $buttons = [];
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
     * Method setClassActionGroup
     *
     * Définir l'attribut class de la div des éléments action du form button/link se trouvant au bas du formulaire
     *
     * @param string $class_action_group [class de la balise div des élément action button/link]
     *
     * @return void
     */
    public function setClassActionGroup(string $class_action_group)
    {
        $this->class_action_group = $class_action_group;
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

    /**
     * Method addElementAction
     *
     *  Ajouter des element cliquable au formulaire button|link
     *
     *  Paramètres de la méthod :
     *
     *  $type = type de l'input pris en charge : submit,button,reset submit = request POST|GET, button pour action JS
     *  $id = id du boutton/link
     *  $name = nom du boutton/link
     *  $options = toutes les options à ajouté à un champ button/link sous forme de tableau
     *
     *  il est ainsi possible d'ajouter toute valeur : exemple pour ajouter une classe à notre boutton ['class', 'nom-de-classe']
     *  ou du javascript ['onclick', 'nom_de_la_fonction('arguments')']
     *  ou du javascript et une class et plus ['onclick', 'nom_de_la_fonction('arguments')', 'class', 'nom-de-classe', autres...]
     *
     * @param string $type [type d'élément boutton|link]
     * @param string $id [id du boutton/link]
     * @param string $name [nom du boutton/link]
     * @param array $options [options de la balise boutton]
     *
     */
    public function addElementAction(
        string $type,
        string $id,
        string $name,
        array $options = [],
    ) {
        $this->buttons[] = [
            'type' => $type,
            'id' => $id,
            'name' => $name,
            'options' => $options,
        ];

        return $this;
    }

    /** Ajouter des champs au formulaire / le champ label est ajouté automatiquement et lié au champ Input par son id
     *  Pour désactivé l'ajout automatique du label ajouté en dernier paramètre de la méthode
     *  un tableau $options ['label-false' = 1, 'autre_option' = 'valeur'...]
     *
     *  Paramètres de la méthod :
     *
     *  $type = type de l'input pris en charge : text,password, email ,image, date, month, number, radio, checkbox, range, reset
     *    $id = id de l'input
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

        return $this;
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
