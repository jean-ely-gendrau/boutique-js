<?php

namespace App\Boutique;

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

    /**
     * Method render
     *
     * La métod rend affiche le formulaire sur la page
     *
     * @return void
     */
    public function render()
    {
        $output = '<form>';
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

        $output = '<div class="form-group">';
        $output .= '<label for="' . $id . '">' . $label . '</label>';
        switch ($type) {
            case 'text':
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;

            case 'password':
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;

            case 'email':
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;

            case 'image':
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;

            case 'date':
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;

            case 'month':
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;

            case 'number':
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;

            case 'radio':
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;

            case 'checkbox':
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;

            case 'range':
                $output .=
                    '<input type="' .
                    $type .
                    '" name="' .
                    $name .
                    '" id="' .
                    $id .
                    '"';
                break;

            case 'reset':
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
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            foreach ($options['attributes'] as $attr => $value) {
                $output .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $output .= '>'; // Fermeture de la balise <input>
        $output .= '</div>';
        return $output;
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
