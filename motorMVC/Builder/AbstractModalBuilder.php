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
        $this->headerModal[] = [
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
    public function addFooter(string $id, string $contentHtml, array $options, string $type = 'div'): AbstractModalBuilder
    {
        $this->headerModal[] = [
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
