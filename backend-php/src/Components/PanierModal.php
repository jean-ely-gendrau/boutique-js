<?php

namespace App\Boutique\Components;

use App\Boutique\Models\Orders;
use App\Boutique\Models\Users;
use Motor\Mvc\Manager\CrudManager;

class PanierModal
{
    public function __construct()
    {
        
    }

    public function PanierDynamique(...$arguments)
    {
        if(isset($_SESSION['isConnected'])){

            $IdclientCrudManager = new CrudManager('users', Users::class);
            
            $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);
            $id = $Idclient->id;
            
            $panier = new CrudManager('orders', Orders::class);
            $paniers = $panier->getbyidbasket($id); // Get the orders by the client's id    
            
            $output = "<div class='flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600'>";
            $output .= "<h3 class='text-xl font-medium text-gray-900 dark:text-white'>TEST</h3>";
            $output .= "<div class='cart-item cart-column'>";
            foreach($paniers as $item){

                
                $filename = __DIR__ . "/../../public_html/assets/images/{$item['url_image']}";
                
                if (file_exists($filename) == true){
                    $output .= "<img src='http://{$_SERVER['HTTP_HOST']}/assets/images/{$item['url_image']}' data-url='http://{$_SERVER['HTTP_HOST']}/assets/images/{$item['url_image']}'";
                }else{
                    $output .= "<img src='http://{$_SERVER['HTTP_HOST']}/assets/images/tea-coffee.png' data-url='http://{$_SERVER['HTTP_HOST']}/assets/images/tea-coffee.png'";
                }
                
                $output.=  " class='cart-item-image' width='50' height='50'>
                    <span class=''>{$item['name']}</span>
                </div>
                    <span class=''>{$item['price']} €</span>
                <div class=''>
                    <input class='cart-quantity-input' type='number' value='1' data-id='{$item['orders_id']}'>
                    <button class='btn btn-danger' type='button' data-id='{$item['orders_id']}'>REMOVE</button>
                </div>
                ";
                $output .= "<button type='button' class='text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white' data-modal-hide=''>";
                $output .= "</button></div>";
            }
                return $output;
                //               <svg class='w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                //                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                //               </svg>
    //               <span class="sr-only">Fermeture de la modale</span>
    //             </button>';
    //     $output .= '</' . $type . '>';

    //     return $output;
    // }

    // /**
    //  * Method renderBody
    //  *
    //  * La méthode addBody() définit le tableau $body lors de
    //  * l'instanciation de la class et l'appel des ses méthodes.
    //  *
    //  * Cette méthode est utilisée en interne pour générer le body
    //  * C'est lors de l'appel de la méthode ->render() qu'il est généré
    //  *
    //  * @param array $body [un tableau associative de configuration du body]
    //  *
    //  * @return string
    //  */
    // protected function renderBody(array $body)
    // {
    //     $type = $body['type'];
    //     $id = $body['id'] ?? '';
    //     $contentHtml = $body['contentHtml'] ?? '';
    //     $options = $body['options'] ?? [];

    //     // Body éléments
    //     $output = '<!-- Modal body -->';
    //     $output .= '<' . $type . ' id="' . $id . '" class="';
    //     $output .= $options['container-class'] ?? 'p-4 md:p-5 space-y-4';
    //     $output .= '">';
    //     $output .= $contentHtml;
    //     $output .= '</' . $type . '>';

    //     return $output;
    // }

    // /**
    //  * Method renderFooter
    //  *
    //  * La méthode addFooter() définit le tableau $footer lors de
    //  * l'instanciation de la class et l'appel des ses méthodes.
    //  *
    //  * Cette méthode est utilisée en interne pour générer le footer
    //  * C'est lors de l'appel de la méthode ->render() qu'il est généré
    //  *
    //  * @param array $footer [un tableau associative de configuration du footer]
    //  *
    //  * @return string
    //  */
    // protected function renderFooter(array $footer)
    // {
    //     $type = $footer['type'];
    //     $id = $footer['id'] ?? '';
    //     $contentHtml = $footer['contentHtml'] ?? '';
    //     $options = $footer['options'] ?? [];

    //     // Header éléments
    //     $output = '<!-- Modal footer -->';
    //     $output .= '<' . $type . ' id="' . $id . '" class="';
    //     $output .= $options['container-class'] ?? 'flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600';
    //     $output .= '">';
    //     $output .= $contentHtml;
    //     $output .= '</' . $type . '>';

    //     return $output;
        
    }}}