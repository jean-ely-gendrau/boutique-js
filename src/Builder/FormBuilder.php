<?php

namespace App\Boutique\Builder;

use App\Boutique\Components\Debug;
use App\Boutique\Validators\ValidatorJS;

// Classe de construction de formulaire de base
class FormBuilder extends AbstractFormBuilder
{
    /**
     * validationScripts
     *
     * Tableau des régles de validation de formulaire
     *
     * @var array
     */
    protected $validationScripts = [];

    public function __construct()
    {
        $this->setMethod('post');
    }

    /**
     * Method render
     *
     * La métod rend affiche le formulaire sur la page
     *
     * @return void
     */
    public function render()
    {
        $output = '<form '; // Démarrage de la balise form

        /* Assignation d'un valeur avec la condition Ternaire */
        $output .= !empty($this->id_form) // Si la propriété n'est pas null
            ? 'id="' . $this->id_form . '" ' // on concatène l'id à la balise
            : ''; // Sinon rien

        /* Assignation d'un valeur avec la condition Ternaire */
        $output .= !empty($this->name_form) // Si la propriété n'est pas null
            ? 'name="' . $this->name_form . '" ' // on concatène le nom à la balise
            : ''; // Sinon rien

        /* Assignation d'un valeur avec la condition Ternaire */
        $output .= !empty($this->class_form) // Si la propriété n'est pas null
            ? 'class="' . $this->class_form . '" ' // on concatène là class à la balise
            : ''; // Sinon rien

        /* Assignation d'un valeur avec la condition Ternaire */
        $output .= !empty($this->method) // Si la propriété n'est pas null
            ? 'method="' . $this->method . '" ' // on concatène là method à la balise
            : ''; // Sinon rien

        /* Assignation d'un valeur avec la condition Ternaire */
        $output .= !empty($this->action) // Si la propriété n'est pas null
            ? 'action="' . $this->action . '" ' // on concatène l'action à la balise
            : ''; // Sinon rien

        $output .= '>'; // Fermeture du <form>

        /**************************************
         *  Ajouts des champs au formulaire
         */
        foreach ($this->fields as $field) {
            $output .= $this->renderField($field);
        }

        /**************************************
         *  Ajouts des bouttons au formulaire
         */
        $output .= '<div class="';

        /* Assignation d'un valeur avec la condition Ternaire */
        $output .= !empty($this->class_action_group)
            ? $this->class_action_group
            : 'actions-group';

        $output .= '">'; // Fermetur balise Div

        foreach ($this->buttons as $button) {
            $output .= $this->renderElementAction($button);
        }

        $output .= '</div>';

        //$output .= '<button type="submit">Envoyer</button>';

        $output .= '</form>'; // Fermeture de l'élément form

        // Ajouter du scripts JS de validation des champs inputs à la fin du formulaire
        // Voir si il pourrait être rendu en bas de page
        /*
        $output .= '<script>';
        $output .= $this->generateValidationScript();
        $output .= '</script>';
*/
        return $output;
    }

    /**
     * Method renderField
     *
     * @param $field $field [explicite description]
     *
     * @return void
     */
    protected function renderField($field)
    {
        $type = $field['type'];
        $id = $field['id'];
        $name = $field['name'];
        $label = $field['label'];
        $options = $field['options'];

        $output = '<div class="';

        /* Assignation d'un valeur avec la condition Ternaire */
        $output .= isset($options['class-label-group'])
            ? $options['class-label-group']
            : 'label-group' . '">';

        /*******************************
         *         CHAMP LABEL
         */
        // Si $options['label-false'] existent est qu'elle strictement pas égal à 1 alors on ajoute un label
        // par défaut il y a toujours un label, pour le désactiver ajouter $options['label-false'] = 1 au tableau de paramètres
        if (!isset($options['label-false'])) {
            // Début de la balise label
            $output .= '<label for="' . $id . '"';

            // Si il y à une class-label dans les options
            if (isset($options['class-label'])) {
                $output .= ' class="' . $options['class-label'] . '"';
            }
            // Fin de la balise label
            $output .= '>' . $label . '</label>';
        }

        /**************************************
         *  Début des champs Input/TextArea/Select
         */
        switch ($type) {
            case 'textarea':
                // Début de la balise TextArea type === switch ($type)
                $output .=
                    '<textarea type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;
            case 'select':
                // Début de la balise Select
                $output .= '<select name="' . $name . '" id="' . $id . '"';
                break;
                /* Tout les champs Input ce ressemble écrivons en dernière condition de switch*/
            case 'text':
            case 'password':
            case 'email':
            case 'image':
            case 'date':
            case 'month':
            case 'number':
            case 'radio':
            case 'checkbox':
            case 'range':
            case 'reset':
            case 'file':
                // Début de la balise Input type === switch ($type)
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;
        }
        // Si il y à une class
        if (isset($options['class'])) {
            $output .= ' class="' . $options['class'] . '"';
        }
        // Si l'input et disabled
        if (isset($options['disabled']) && $options['disabled'] === true) {
            $output .= ' disabled';
        }
        // Si il y à un placeholder
        if (isset($options['placeholder'])) {
            $output .= ' placeholder="' . $options['placeholder'] . '"';
        }

        // Si l'input est requit pour la validation 
        if (isset($options['required'])) {
            $output .= ' required ';
        }

        // Pour toute autre attributes à ajouté à l'input
        // Vous pouvez trouvez tout les attributs possible de balise sur https://developer.mozilla.org/fr/docs/Web/HTML/Element
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            foreach ($options['attributes'] as $attr => $value) {
                $output .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /**************************************
         * generateValidationScript
         */

        foreach ($this->generateValidationScript($id) as $rules => $rule) {
            $output .= 'data-js="validateRules,blur"';
            $output .= 'data-key-input="' . $id . '"';
            $output .= 'data-message="' . $rule['message'] . '"';
            $output .= 'data-regex="' . $rule['regex'] . '"';
        }
        /**************************************
         * Fin des champs Input/TextArea/Select
         */
        // TEXTAREA
        if ($type === 'textarea') {
            $output .= '>';

            /* Assignation d'un valeur avec la condition Ternaire */
            $output .= isset($options['value-area']) // ISSET value-area
                ? $options['value-area'] // Si une $options['value-area'] a été passée en argument
                : '' . '</textarea>'; // Fin de la balise Textarea
        }
        // SELECT
        elseif ($type === 'select') {
            /* Assignation d'un valeur avec la condition Ternaire */
            $optionsMulti =
                isset($options['select-array-multi']) &&
                $options['select-array-multi'] === true
                ? true
                : false;

            /* Assignation d'un valeur avec la condition Ternaire */
            $optionSelectKey = isset($options['options-keys'])
                ? $options['options-keys']
                : [];

            /* Assignation d'un valeur avec la condition Ternaire */
            $isSelectedOption = isset($options['options-selected'])
                ? $options['options-selected']
                : false;

            $output .= '>';

            /* Assignation d'un valeur avec la condition Ternaire */
            $output .= isset($options['options-select-array']) // ISSET options-select
                ? $this->addSelectedOption(
                    $options['options-select-array'],
                    $optionSelectKey,
                    $optionsMulti,
                ) // Construction des options de l'élément select
                : '' . '</select>'; // Fin de la balise Select
        }
        // INPUT
        else {
            $output .= '>'; // Fin de la balise Input
        }

        // error-message : Ajout d'un paragraphe error, avec l'id définit dans le  js addAndCleanErrorHtmlMessage 
        if (isset($options['error-message']) && $options['error-message']) {
            $output .= '<p id="message-warn-' . $id . '"';

            // Si aucune class est ajouté au tableau d'options la class TailwindCSS  : text-red-600 text-sm  
            $output .= ' class="' . $options['error-message-class'] ?? 'text-red-600 text-sm' . '" ';

            $output .= '>' . $options['error-message'] . '</p>';
        }

        $output .= '</div>';
        return $output;
    }

    /**
     * Method renderElementAction
     *
     * @param array $elementAction [tableau des paramètres du boutton]
     *
     * @return void
     */
    protected function renderElementAction(array $elementAction)
    {
        //DEBUG var_dump($elementAction['options']);

        $type = $elementAction['type'];
        /* Assignation d'un valeur avec la condition Ternaire */
        $id = isset($elementAction['id'])
            ? 'id="' . $elementAction['id'] . '"'
            : '';
        /* Assignation d'un valeur avec la condition Ternaire */
        $name = isset($elementAction['name'])
            ? 'name="' . $elementAction['name'] . '"'
            : '';

        $options = $elementAction['options'];

        /* Assignation d'un valeur avec la condition Ternaire */
        $anchor = isset($options['anchor']) ? $options['anchor'] : 'envoyer';

        $output = '';
        switch ($type) {
            case 'link':
                $output .= '<a ' . $name . ' ' . $id . '';
                break;
            case 'reset':
            case 'submit':
            case 'button':
                $output .=
                    '<button type="' . $type . '" ' . $name . ' ' . $id . '';
                break;
        }
        // Si il y à une class
        if (isset($options['class'])) {
            $output .= ' class="' . $options['class'] . '"';
        }
        // Si l'input et disabled
        if (isset($options['disabled']) && $options['disabled'] === true) {
            $output .= ' disabled';
        }

        // Pour toute autre attributes à ajouté à l'input
        // Vous pouvez trouvez tout les attributs possible de balise sur https://developer.mozilla.org/fr/docs/Web/HTML/Element
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            foreach ($options['attributes'] as $attr => $value) {
                // Debug::view($attr, $value);
                $output .= ' ' . $attr . '="' . $value . '"';
            }
        }
        /* SWITCH de fermeture de Balise */

        switch ($type) {
            case 'link':
                $output .= '>' . $anchor . '</a>'; // Fin de la balise link
                break;
            case 'reset':
            case 'submit':
            case 'button':
                $output .= '>' . $anchor . '</button>'; // Fin de la balise Button
                break;
        }
        return $output;
    }

    /**
     * Method addSelectedOption
     *
     *  Cette méthode créer la list des option d'une select élément
     *  peu recevoir un tableau indexées par des number ou un tableau associatif indexées par des clé et aussi des tableau multidimentionnel
     *  Paramètres de la méthode :
     *  @param array $optionsList [tableau des option à ajouter à l'élément select]
     *  @param array $optionSelectKey [tableau optionnel des keyValue et keyText si optionsList est un tableau associatif/multidimentionnel, la keyText dans ce cas peu être égal à KeyValue]
     *  @param bool $optionsMulti [true|false]
     *
     * Le paramètre $optionSelectKey est optionnel, il est indispensable dans le cas ou $optionsList est un tableau associatif/multidimentionnel,
     * en effet vous aurez besoins de l'index key de la valeur à placé dans la balise value et pour le text
     *
     * Pour activer l'option mutildimentionnel, passé dans le tableau d'options de la méthode addbutton  la clé est la valeur suivante ['select-multi' => true]
     *
     * voici deux exemples:
     *
     * $formBuilder->addbutton('select', 'select-menu', 'select-menu', 'Sélection du Menu', [
     *   'class' => 'la-class',
     *   'class-label' => 'la-class-label',
     *   'option-list' => ['Cafer','Thé','Autre']
     *   ]);
     *
     * $formBuilder->addbutton('select', 'select-menu', 'select-menu', 'Sélection du Menu', [
     *   'class' => 'la-class',
     *   'class-label' => 'la-class-label',
     *   'option-list' => ['cat_name'=>'Cafer','Thé','Autre']
     *   ]);
     *
     * @return void
     */
    protected function addSelectedOption(
        array $optionsList,
        array $optionSelectKey = [],
        bool $optionsMulti = false,
        bool|string $isSelectedOption = false,
    ) {
        return join(
            '',
            array_map(function ($option) use (
                $optionSelectKey,
                $optionsMulti,
                $isSelectedOption,
            ) {
                /**************************************************************
                 *
                 * Multidimentionnel avec sélection de clé [obligatoire]
                 *
                 */
                if (
                    $optionsMulti && // Si Vrai
                    is_array($option) && // Si c'est un array AND
                    !empty($optionSelectKey) && // que l'array optionSelectKey n'est pas vide AND
                    !array_is_list($option) && // que ce n'est pas un array option list AND
                    !empty($option) // que l'array option n'est pas vide
                ) {
                    /* Assignation d'un valeur avec la condition Ternaire */
                    $optionSelected =
                        $isSelectedOption &&
                        $isSelectedOption === $optionSelectKey['keyValue']
                        ? 'selected'
                        : '';

                    return '<option ' .
                        $optionSelected .
                        ' value="' .
                        $option[$optionSelectKey['keyValue']] .
                        '">' .
                        $option[$optionSelectKey['keyText']] .
                        '</option>';
                }
                /**************************************************************
                 *
                 * Associatif avec sélection de clé [optionnel]
                 *
                 */
                elseif (
                    !$optionsMulti && // Si Faux
                    is_array($option) && // Si c'est un array AND
                    !empty($optionSelectKey) && // que l'array optionSelectKey n'est pas vide AND
                    !array_is_list($option) && // que ce n'est pas un array option list AND
                    !empty($option) // que l'array option n'est pas vide
                ) {
                    /* Assignation d'un valeur avec la condition Ternaire */
                    $optionSelected =
                        $isSelectedOption &&
                        $isSelectedOption === $optionSelectKey['keyValue']
                        ? 'selected'
                        : '';

                    return '<option ' .
                        $optionSelected .
                        ' value="' .
                        $option[$optionSelectKey['keyValue']] .
                        '">' .
                        $option[$optionSelectKey['keyText']] .
                        '</option>';
                }
                /**************************************************************
                 *
                 * Associatif sans sélection de clé
                 * ici en option nous aurron l'index du tableu comme value de l'option - array_keys
                 * et comme text on obtiendra la valeur de l'index du tableau - array_values
                 *
                 */
                elseif (
                    !$optionsMulti && // Si Faux
                    is_array($option) && // Si c'est un array AND
                    empty($optionSelectKey) && // que l'array optionSelectKey n'est pas vide AND
                    !array_is_list($option) && // que ce n'est pas un array option list AND
                    !empty($option) // que l'array option n'est pas vide
                ) {
                    /* Assignation d'un valeur avec la condition Ternaire */
                    $optionSelected =
                        $isSelectedOption &&
                        $isSelectedOption === array_keys($option)
                        ? 'selected'
                        : '';

                    return '<option ' .
                        $optionSelected .
                        ' value="' .
                        array_keys($option) . // On définit la value avec la clé de l'index de l'array
                        '">' .
                        array_values($option) . // On définit le text avec la valeur de l'array
                        '</option>';
                }
                /**************************************************************
                 *
                 * Tableau listé exemple ['item1','item2']
                 *
                 */
                elseif (!empty($option) && array_is_list($option)) {
                    /* Assignation d'un valeur avec la condition Ternaire */
                    $optionSelected =
                        $isSelectedOption && $isSelectedOption === $option
                        ? 'selected'
                        : '';

                    return '<option ' .
                        $optionSelected .
                        ' value="' .
                        $option .
                        '">' .
                        $option .
                        '</option>';
                }
                /**************************************************************
                 *
                 * Dans le cas ou aucun condition n'est remplit
                 *
                 */
                else {
                    return '<option value="aucun">Aucune options disponible</option>';
                }
            }, $optionsList),
        );
    }

    /**
     * Method addValidationScript
     *
     * Cette méthod permet d'ajouté les régles de validation de l'input
     *
     * @param $script $script [explicite description]
     *
     * @return void
     */
    protected function addValidationScript($script)
    {
        $this->validationScripts[] = $script;
    }

    /**
     * Method setValidatorJS
     *
     * Cette méthode pertmet de définir une instance du Validator JS
     * 
     * @param ValidatorJS $validator [Instance de ValidatorJS]
     *
     * @return void
     */
    public function setValidator(ValidatorJS $validator)
    {
        $this->validatorJS = $validator;
    }
}
