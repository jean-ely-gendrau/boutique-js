<?php

namespace App\Boutique\Components;

/* La classe `Slider` contient les méthodes permettant de générer un slide Html pour les produits
 avec des boutons de scroll.
*/

class Slider
{
    public function __construct()
    {
    }

    /**
     * La fonction `buttonScrollX` génére le code html des boutons de scroll et utilise
     * les fonctions de teaCoffee.module.js afin d'animer par le scroll horizontal via $idElement.
     *
     * @param string idElement La fonction `buttonScrollX` génère du code HTML pour une paire
     * de boutons qui peuvent être utilisés pour le défilement horizontal. Le paramètre `idElement`
     * est utilisé pour spécifier l'ID de l'élément qui sera défilé horizontalement lorsque les boutons
     * sont cliqués.
     *
     * @return La fonction `buttonScrollX` renvoie une chaîne contenant le code HTML d'un élément
     * de navigation avec deux boutons de défilement horizontal.
     */
    public static function buttonScrollX(string $idElement)
    {
        return "<div id='nav' class='absolute top-0 w-[1152px]'>
                    <button data-js='handelScrollX,click' data-direction-scroll='l' data-scroll-x='{$idElement}' id='font' class='absolute -left-12 inline-block text-black my-40 cursor-pointer rounded-full text-6xl font-semibold w-12 h-12 text-center p-0 bg-white/30 dark:bg-gray-800/30 hover:bg-gray-400/30 active:bg-gray-600/30 focus:outline-none'>
                        <
                    </button>
                    <button data-js='handelScrollX,click' data-direction-scroll='r' data-scroll-x='{$idElement}' id='font' class='absolute -right-12 inline-block text-black my-40 cursor-pointer rounded-full text-6xl font-semibold w-12 h-12 text-center p-0 bg-white/30 dark:bg-gray-800/30 hover:bg-gray-400/30 active:bg-gray-600/30 focus:outline-none'>
                        >     
                    </button>
                </div>
            </div>";
    }

    /**
     * La fonction `generateProductList` génère un élément HTML de type slider affichant une liste
     * de produits avec leurs images, noms, prix, et un bouton "Ajouter au panier".
     *
     * @param array products La fonction `generateProductList` génère une liste d'articles de produits
     * dans un format de slider basé sur le tableau (array) de produits donné.
     * La fonction prend deux paramètres :
     *
     * @param string id Le paramètre `id` de la fonction `generateProductList` est utilisé pour
     * spécifier l'attribut id de l'élément `<ul>` qui contient la liste des produits.
     * Cet identifiant est généré dynamiquement en fonction des données fournies à la fonction.
     * Exemple d'appel de la fonction: $horizontalSlide->generateProductList($products, 'id-scroll-x-1');.
     *
     * @return La fonction `generateProductList` renvoie une chaîne de caractères contenant le code HTML d'une
     * liste déroulante de produits. La barre de défilement comprend des articles avec des images, des noms, des
     * prix et un bouton "Ajouter au panier". La fonction comprend également un bouton permettant de faire défiler
     * horizontalement la liste.
     */
    public function generateProductList(array $products, string $id)
    {
        $slider = "
            <div id='menu' class='relative flex justify-center'>
                <ul id='{$id}' class='block list-none p-0 whitespace-nowrap overflow-hidden max-w-6xl px-[20px]'>";
        foreach ($products as $productItem):
            $slider .= "  <div class='bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-xl shadow-[3px_3px_9px_0px_rgba(0,0,0,0.6)]'>
                            <div id='{$productItem->id}' class='favorites bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4'>
                                <svg class='fill-gray-800 inline-block' width='22px' viewBox='0 0 192 192' xmlns='http://www.w3.org/2000/svg' xml:space='preserve' fill='none'>
                            <g id='SVGRepo_bgCarrier' stroke-width='0'></g>
                            <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g>
                            <g id='SVGRepo_iconCarrier'>
                                <path
                                    d='M60.732 29.7C41.107 29.7 22 39.7 22 67.41c0 27.29 45.274 67.29 74 94.89 28.744-27.6 74-67.6 74-94.89 0-27.71-19.092-37.71-38.695-37.71C116 29.7 104.325 41.575 96 54.066 87.638 41.516 76 29.7 60.732 29.7z'
                                    style='clip-rule:evenodd;display:inline;fill:none;stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1'>
                                </path>
                            </g>
                                </svg>
                            </div>
                            <img id='{$productItem->id}' src='/assets/images/{$productItem->url_image}' alt='{$productItem->name}' class='w-32 h-28 mx-auto mt-12 article-image' />
                            <p id='{$productItem->id}' class='article-name mt-3 font-bold'>{$productItem->name}</p>
                            <div class='flex justify-center'>
                                <p class='mt-3 font-bold mr-2'>{$productItem->price}€</p>
                                <p class='mt-3 font-medium text-gray-300'>{$productItem->price}€</p>
                            </div>
                            <div>
                            <a  href='addtobasket/{$productItem->id}'>
                                <button type='button' class='w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full'>
                                    Add to cart
                                </button>
                            </a>
                            </div>
                        </div>";
        endforeach;
        $slider .= '</ul> ' . self::buttonScrollX($id);

        return $slider;
    }
}
