<?php

namespace Motor\MVC\Builder;

class ModalContent extends AbstractModalBuilder
{
    /**
     * Method render
     *
     * La métode affiche la modal sur la page
     *
     * @return string
     */
    public function render()
    {
        $output =
            '<div id="' .
            $this->idModal .
            '" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">';
        $output .= '<div class="relative w-full max-w-lg max-h-full">';
        $output .= '<!-- Modal content -->';
        $output .= '<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">';
        /**************************************
         *  Ajouts des élémént du header
         */
        foreach ($this->headerModal as $header) {
            $output .= $this->renderHeader($header);
        }

        /**************************************
         *  Ajouts des élémént du body
         */
        foreach ($this->bodyModal as $body) {
            $output .= $this->renderBody($body);
        }

        /**************************************
         *  Ajouts des élémént du footer
         */
        foreach ($this->footerModal as $footer) {
            $output .= $this->renderFooter($footer);
        }

        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }

    protected function renderHeader($header)
    {
        $type = $header['type'];
        $id = $header['id'] ?? '';
        $title = $header['title'] ?? '';
        $options = $header['options'] ?? [];

        // Header éléments
        $output = '<' . $type . ' class="';
        $output .= $options['header-class'] ?? 'flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600';
        $output .= '">';

        $output .= '<h3 class="';
        $output .= $options['header-class'] ?? 'text-xl font-medium text-gray-900 dark:text-white';
        $output .= '">';
        $output .= $title;
        $output .= '</h3>';
        $output .=
            '<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="' .
            $this->idModal .
            '">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Fermeture de la modale</span>
                </button>';
        $output .= '</' . $type . '>';

        return $output;
    }

    protected function renderBody($body)
    {
        $type = $body['type'];
        $id = $body['id'] ?? '';
        $contentHtml = $body['contentHtml'] ?? '';
        $options = $body['options'] ?? [];

        // Body éléments
        $output = '<!-- Modal body -->';
        $output .= '<' . $type . ' id="' . $id . '" class="';
        $output .= $options['container-class'] ?? 'p-4 md:p-5 space-y-4';
        $output .= '">';

        $output .= '</' . $type . '>';

        return $output;
    }

    protected function renderFooter($footer)
    {
        $type = $footer['type'];
        $id = $footer['id'] ?? '';
        $contentHtml = $footer['contentHtml'] ?? '';
        $options = $footer['options'] ?? [];

        // Header éléments
        $output = '<!-- Modal footer -->';
        $output .= '<' . $type . ' id="' . $id . '" class="';
        $output .= $options['container-class'] ?? 'flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600';
        $output .= '">';

        $output .= $contentHtml;
        $output .= '</' . $type . '>';

        return $output;
    }
}
