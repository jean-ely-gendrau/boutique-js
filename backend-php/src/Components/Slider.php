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
        return "
                      <button  data-js='handelScrollX,click' data-direction-scroll='l' data-scroll-x='{$idElement}' id='font' type='button' class='hidden -left-8 lg:flex absolute top-0 start-0 z-30 justify-center w-12 h-12 my-40 cursor-pointer text-black rounded-full text-4xl font-semibold text-gray-700 dark:text-gray-200 bg-gray-400/30 text-center p-0 active:bg-gray-600/30 focus:outline-none items-start'>
                        <
                      </button>
                      <button data-js='handelScrollX,click' data-direction-scroll='r' data-scroll-x='{$idElement}' id='font' type='button' class='hidden -right-8 lg:flex absolute top-0 end-0 z-30 justify-center w-12 h-12 my-40 cursor-pointer text-black rounded-full text-4xl font-semibold text-gray-700 dark:text-gray-200 bg-gray-400/30 text-center p-0 active:bg-gray-600/30 focus:outline-none items-start'>
                        >
                      </button>";
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
            <div id='menu' class='relative flex mx-auto'>
                <ul id='{$id}' class='lg:ml-[3%] lg:mr-[3%] block list-none p-0 whitespace-nowrap overflow-x-auto max-with-full md:max-w-full lg:max-w-6xl'>";
        foreach ($products as $productItem):
            if ($productItem->user_has_product != null) {
                $inFav = "inFav ";
            } else {
                $inFav = null;
            }
            $slider .= "<div class='my-4 bg-gray-100 w-[20rem] sm:h-[20rem] lg:h-fit inline-block mx-4 rounded-2xl p-6 cursor-pointer lg:hover:-translate-y-2 transition-all relative shadow-[3px_3px_9px_0px_rgba(0,0,0,0.6)]'>
          <div id='{$productItem->id}' class='{$inFav}favorites bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4'>
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
          <div  id='{$productItem->id}' class='w-2/3 h-[220px] sm:h-[5rem] md:h-[5rem] lg:h-[220px] overflow-hidden mx-auto aspect-w-16 aspect-h-8 article-image'>";
            
            $filename = __DIR__ . "/../../public_html/assets/images/{$productItem->url_image}";
            
            if (file_exists($filename) == true){
                $slider .= "<img src='http://{$_SERVER['HTTP_HOST']}/assets/images/{$productItem->url_image}'";
            }else{
                $slider .= "<img src='http://{$_SERVER['HTTP_HOST']}/assets/images/tea-coffee.png'";
            }

             $slider .= "alt='image {$productItem->name}' class='h-full w-full object-contain' />
          </div>
          <div class='text-center mt-4'>
            <h3 id='{$productItem->id}' class='article-name text-lg font-extrabold text-gray-800'>{$productItem->name}</h3>
            <h4 class='text-2xl text-gray-800 font-bold mt-4'>{$productItem->price} € <span class='text-gray-400 ml-2 font-medium'>{$productItem?->pound}</span>
            </h4>
            <button data-js='handlePost,click' data-define-request='http://{$_SERVER['HTTP_HOST']}/addtobasket/{$productItem->id}' type='button' class='w-full flex items-center justify-center gap-3 mt-6 px-4 py-2.5 bg-transparent hover:bg-gray-200 text-base text-[#333] border-2 font-semibold border-[#333] rounded-xl'>
              <svg xmlns='http://www.w3.org/2000/svg' width='20px' height='20px' viewBox='0 0 512 512'>
                <path d='M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0' data-original='#000000'></path>
              </svg>
              Ajouter au panier</button>
          </div>
        </div>";
        endforeach;
        $slider .= '</ul> ' . self::buttonScrollX($id);

        return $slider;
    }
}
