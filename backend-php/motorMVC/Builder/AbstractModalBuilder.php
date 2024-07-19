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
     * sizeModal
     *
     * @var string
     */
    protected $sizeModal;

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

    /**
     * Method generateIdModal
     *
     * Méthode utilisé en interne par la __CLASS__, l'id est générée lors de l'instanciation.
     * Il sera remplacé si vous utilisez le setIdModale(string) pour définir un id personnalisé.
     * 
     * Ou lors de l'instanciation rapide directement dans le constructeur du contenue HTML.
     * 
     * Cette méthode générait l'id de gestion de la modale.
     * 
     * @return AbstractModalBuilder
     */
    protected function generateIdModal()
    {
        $time = time();
        $stringIDHeX = range('A', 'F');
        $randHex = array_rand($stringIDHeX, 6);

        $stringIDNum = range('0', '9');
        $randNum = array_rand($stringIDNum, 6);

        $randomID = join(
            '',
            array_map(
                function ($x, $z) use ($stringIDHeX, $stringIDNum) {
                    return "{$stringIDHeX[$x]}{$stringIDNum[$z]}";
                },
                $randHex,
                $randNum,
            ),
        );
        $this->setIdModal($randomID . $time);

        return $this;
    }

    /************************************************ ABSTRACT METHODE ******************************************************/
    // render : Méthode abstraite pour le rendu du formulaire
    abstract public function render();


    /**
     * Method renderOpenButton
     *
     * Méthode abstraite pour la création d'un boutton de contrôlle Overture/Fermeture de Modal    
     *
     * Cette Méthode permet de générer le bouton de la modale en correspondance avec son id 
     * définit lors de la création de l'instance
     *
     * @param string $anchor [Texte du bouton ou du lieu qui ouvre la modale]
     * @param array $option [tableau de paramétre du boutton ['class'=>'la_class', type=>'button|link'] - Par défault c'est un boutton avec une class Tailwind FlowBite générique]
     *
     * @return string
     */
    abstract public function renderOpenButton(string $anchor, array $option);

    /************************************************ GETTER/SETTER ******************************************************/
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

    /**
     * Get sizeModal
     *
     * @return  string
     */
    public function getSizeModal()
    {
        return $this->sizeModal;
    }

    /**
     * Set sizeModal
     *
     * @param  string  $sizeModal  sizeModal
     *
     * @return  self
     */
    public function setSizeModal(string $sizeModal)
    {
        $this->sizeModal = $sizeModal;

        return $this;
    }
}
