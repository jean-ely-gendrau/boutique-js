<?php

namespace App\Boutique\Builder;

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
        $output = '<form ';
        $output .= !empty($this->class_form)
            ? 'class="' . $this->class_form . '" '
            : '';
        $output .= !empty($this->method)
            ? 'method="' . $this->method . '" '
            : '';
        $output .= !empty($this->action)
            ? 'action="' . $this->action . '" '
            : '';
        $output .= '>';
        foreach ($this->fields as $field) {
            $output .= $this->renderField($field);
        }
        $output .= '<button type="submit">Envoyer</button>';
        $output .= '</form>';

        // Ajouter du scripts JS de validation à la fin du formulaire
        // Voir si il pourrait être rendu en bas de page
        $output .= '<script>';
        foreach ($this->validationScripts as $script) {
            $output .= $script;
        }
        $output .= '</script>';

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
        $output .= isset($options['class-group'])
            ? $options['class-group']
            : 'form-group' . '">';

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
        // Pour toute autre attributes à ajouté à l'input
        // Vous pouvez trouvez tout les attributs possible de balise sur https://developer.mozilla.org/fr/docs/Web/HTML/Element
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            foreach ($options['attributes'] as $attr => $value) {
                $output .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /**************************************
         * Fin des champs Input/TextArea/Select
         */
        // TEXTAREA
        if ($type === 'textarea') {
            $output .= '>';
            $output .= isset($options['value_area']) // ISSET value_area
                ? $options['value_area'] // Si une $options['value_area'] a été passée en argument
                : '' . '</textarea>'; // Fin de la balise Textarea
        }
        // SELECT
        elseif ($type === 'select') {
            $output .= '>';
            $output .= isset($options['options_select']) // ISSET options_select
                ? $this->addSelectedOption($options['options_select']) // Construction des options de l'élément select
                : '' . '</select>'; // Fin de la balise Select
        }
        // INPUT
        else {
            $output .= '>'; // Fin de la balise Input
        }

        $output .= '</div>';
        return $output;
    }

    /**
     * Method addSelectedOption
     *
     * Cette méthod créer la list des option d'une select élément
     *  @param array $optionsList [tableau des option à ajouter à l'élément select]
     *
     * @return void
     */
    protected function addSelectedOption(array $optionsList)
    {
        return join(
            '',
            array_map(function ($option) {
                return '<option>' . $option . '</option>';
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
}
