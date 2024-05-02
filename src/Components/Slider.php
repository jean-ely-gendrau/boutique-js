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
        foreach ($products as $productItem) :
            $slider .= "  <div class='bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-xl shadow-[3px_3px_9px_0px_rgba(0,0,0,0.6)]'>
                            <div class='bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='18px' class='fill-gray-800 inline-block' viewBox='0 0 64 64'>
                                    <path d='M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 div0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z' data-original='#000000'></path>
                                </svg>
                            </div>                 
                            <img id='{$productItem->id}' src='/assets/images/{$productItem->url_image}' alt='{$productItem->name}' class='w-32 h-28 mx-auto mt-12 article-image' />
                            <p id='{$productItem->id}' class='article-name mt-3 font-bold'>{$productItem->name}</p>
                            <div class='flex justify-center'>
                                <p class='mt-3 font-bold mr-2'>{$productItem->price}€</p>
                                <p class='mt-3 font-medium text-gray-300'>{$productItem->price}€</p>
                            </div>
                            <div>
                            <a  href='addtobasket.php'>
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
