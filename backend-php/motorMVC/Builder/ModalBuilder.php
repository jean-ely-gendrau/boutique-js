<?php

namespace Motor\Mvc\Builder;

/**
 * ModalBuilder
 *
 * Cette Class permet de créer un template modal à insérer n'importe ou dans vos composants.
 *
 * Pour une implémentation optimale si vous avez beaucoup de modal à insérer à l'écran;
 * Utilisé une requête Javascipt pour implémenter le contenu de la modale dynamiquement.
 */
class ModalBuilder extends AbstractModalBuilder
{
    /**
     * Method __construct
     *
     * @param string $contentHtml [Passé votre élément HTML directement dans le constructeur pour une utilisation rapide de la modale]
     *
     * @return void
     */
    public function __construct(string $contentHtml = null)
    {
        // Génération d'un idmodal auto pour la gestion de l'ouverture et de fermeture
        // Cet id peu être définit avec la méthode setIdModal après avec instancié la CLASS.
        $this->generateIdModal();

        // Génération d'une modale si $contentHtml n'est pas null
        if (!is_null($contentHtml)) {
            $this->addBody('body-content-' . $this->idModal, $contentHtml);
        }
    }

    /************************************ MAGIC METHOD *********************************************/

    public function __serialize(): array
    {
        return [
            'idModal' => $this->idModal,
            'buttons' => $this->buttons,
            'headerModal' => $this->headerModal,
            'bodyModal' => $this->bodyModal,
            'footerModal' => $this->footerModal,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->idModal = $data['idModal'];
        $this->buttons = $data['buttons'];
        $this->headerModal = $data['headerModal'];
        $this->bodyModal = $data['bodyModal'];
        $this->footerModal = $data['footerModal'];
    }

    /************************************ GLOBAl METHOD *********************************************/
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
            '" tabindex="-1" class="fixed top-0 bottom-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">';
        $output .= '<div class="relative w-full max-w-lg max-h-full">';
        $output .= '<!-- Modal content -->';
        $output .= '<div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mb-5 min-h-[425px] md:min-h-[525px] lg:max-h-screen overflow-y-auto">';
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

    /**
     * Method renderHeader
     *
     * La méthode addHeader() définit le tableau $header lors de
     * l'instanciation de la class et l'appel des ses méthodes.
     *
     * Cette méthode est utilisée en interne pour générer le header
     * C'est lors de l'appel de la méthode ->render() qu'il est généré
     *
     * @param array $header [un tableau associative de configuration du header]
     *
     * @return string
     */
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
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="https://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Fermeture de la modale</span>
                </button>';
        $output .= '</' . $type . '>';

        return $output;
    }

    /**
     * Method renderBody
     *
     * La méthode addBody() définit le tableau $body lors de
     * l'instanciation de la class et l'appel des ses méthodes.
     *
     * Cette méthode est utilisée en interne pour générer le body
     * C'est lors de l'appel de la méthode ->render() qu'il est généré
     *
     * @param array $body [un tableau associative de configuration du body]
     *
     * @return string
     */
    protected function renderBody(array $body)
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
        $output .= $contentHtml;
        $output .= '</' . $type . '>';

        return $output;
    }

    /**
     * Method renderFooter
     *
     * La méthode addFooter() définit le tableau $footer lors de
     * l'instanciation de la class et l'appel des ses méthodes.
     *
     * Cette méthode est utilisée en interne pour générer le footer
     * C'est lors de l'appel de la méthode ->render() qu'il est généré
     *
     * @param array $footer [un tableau associative de configuration du footer]
     *
     * @return string
     */
    protected function renderFooter(array $footer)
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

    public function renderOpenButton(
        string $anchor,
        array $option = [
            'type' => 'button',
            'class' =>
            'block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
        ],
    ) {

        $output = '<' . $option['type'] ?? 'button';
        $output .= ' data-modal-target="' . $this->idModal . '" ';
        $output .= ' data-modal-toggle="' . $this->idModal . '" ';

        // Ajout des attributs du tableau d'options
        foreach ($option as $keyOption => $valueOption) {
            $output .= ' ' . $keyOption . '="' . $valueOption . '" ';
        }

        $output .= '>' . $anchor;
        $output .= '</' . $option['type'] ?? 'button' . '>';

        return $output;
    }
}
