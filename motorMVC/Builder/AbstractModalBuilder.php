<?php

namespace Motor\Mvc\Builder;

abstract class AbstractModalBuilder
{
    /**
     * idModal
     *
     * @var string
     */
    protected $idModal;

    /**
     * buttons
     *
     * @var array
     */
    protected $buttons = [];

    /**
     * headerModal
     *
     * @var array
     */
    protected $headerModal = [];

    /**
     * bodyModal
     *
     * @var array
     */
    protected $bodyModal = [];

    /**
     * footerModal
     *
     * @var array
     */
    protected $footerModal = [];

    /**
     * Method addHeader
     *
     *
     * @param string $id [id de la modal]
     * @param string $title [title du header de la modal]
     * @param array $options = [] [option de la balise container header  exemple class]
     * @param string $type = 'div' [type de l'élément de la modal par défaut div]
     *
     * @return AbstractModalBuilder
     */
    public function addHeader(string $id, string $title, array $options = [], string $type = 'div'): AbstractModalBuilder
    {
        $this->headerModal[] = [
            'type' => $type,
            'id' => $id,
            'title' => $title,
            'options' => $options,
        ];

        return $this;
    }

    /**
   * Method addBody
   *
   * 
   * @param string $id [id de la modal]
   * @param mixed $contentHtml [Insérer votre élémént HTML dans le corp du body]
   * @param array $options = [] [option de la balise container body - exemple class]
   *@param string $type = 'div' [type de l'élément de la modal par défaut div]

   * @return AbstractModalBuilder
   */
    public function addBody(string $id, string $contentHtml, array $options = [], string $type = 'div'): AbstractModalBuilder
    {
        $this->bodyModal[] = [
            'type' => $type,
            'id' => $id,
            'contentHtml' => $contentHtml,
            'options' => $options,
        ];

        return $this;
    }

    /**
     * Method addFooter
     *
     * @param string $id [id de la modal]
     * @param mixed $contentHtml [Insérer votre élémént HTML dans le corp du body]
     * @param array $options [option de la balise container footer - exemple class]
     * @param string $type = 'div' [type de l'élément de la modal par défaut div]
     *
     * @return AbstractModalBuilder
     */
    public function addFooter(string $id, string $contentHtml, array $options = [], string $type = 'div'): AbstractModalBuilder
    {
        $this->footerModal[] = [
            'type' => $type,
            'id' => $id,
            'contentHtml' => $contentHtml,
            'options' => $options,
        ];

        return $this;
    }
    // Méthode abstraite pour le rendu du formulaire
    abstract public function render();

    /**
     * Method createOpenButton
     *
     * Cette permet de générer le bouton de la modale en
     * correspondance avec son id définit lors de la création de l'instance
     *
     * @param string $anchor [Text du boutton ou du lien]
     * @param string $type [explicite description]
     * @param array $option [explicite description]
     *
     * @return string
     */
    public function createOpenButton(
        string $anchor,
        array $option = [
            'type' => 'button',
            'class' =>
                'block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
        ],
    ) {
        $output = '<button ';
        $output .= 'data-modal-target="' . $this->idModal . '" ';
        $output .= 'data-modal-toggle="' . $this->idModal . '" ';

        // Ajout des attributs du tableau d'options
        foreach ($option as $keyOption => $valueOption) {
            $output .= ' ' . $keyOption . '="' . $valueOption . '" ';
        }

        $output .= '">' . $anchor;
        $output .= '</button>';

        return $output;
    }
    /**
     * Get idModal
     *
     * @return  string
     */
    public function getIdModal()
    {
        return $this->idModal;
    }

    /**
     * Set idModal
     *
     * @param  string  $idModal  idModal
     *
     * @return  self
     */
    public function setIdModal(string $idModal)
    {
        $this->idModal = $idModal;

        return $this;
    }
}
