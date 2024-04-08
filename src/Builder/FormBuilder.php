<?php

namespace App\Boutique;

// Classe de construction de formulaire de base
class FormBuilder extends AbstractFormBuilder
{
    protected $validationScripts = [];

    public function render()
    {
        $output = '<form>';
        foreach ($this->fields as $field) {
            $output .= $this->renderField($field);
        }
        $output .= '<button type="submit">Submit</button>';
        $output .= '</form>';

        // Ajouter les scripts de validation
        $output .= '<script>';
        foreach ($this->validationScripts as $script) {
            $output .= $script;
        }
        $output .= '</script>';

        return $output;
    }

    protected function renderField($field)
    {
        $type = $field['type'];
        $name = $field['name'];
        $label = $field['label'];
        $options = $field['options'];

        $output = '<div class="form-group">';
        $output .= '<label for="' . $name . '">' . $label . '</label>';
        switch ($type) {
            case 'text':
                $output .=
                    '<input type="text" name="' .
                    $name .
                    '" id="' .
                    $name .
                    '"';
                break;
            case 'password':
                $output .=
                    '<input type="password" name="' .
                    $name .
                    '" id="' .
                    $name .
                    '"';
                break;
            // Gérer d'autres types de champs selon les besoins
        }
        if (isset($options['class'])) {
            $output .= ' class="' . $options['class'] . '"';
        }
        if (isset($options['disabled']) && $options['disabled'] === true) {
            $output .= ' disabled';
        }
        if (isset($options['placeholder'])) {
            $output .= ' placeholder="' . $options['placeholder'] . '"';
        }
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            foreach ($options['attributes'] as $attr => $value) {
                $output .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $output .= '>';
        $output .= '</div>';
        return $output;
    }

    protected function addValidationScript($script)
    {
        $this->validationScripts[] = $script;
    }
}
