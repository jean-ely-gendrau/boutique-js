<?php

namespace App\Boutique\Models;

use App\Boutique\Manager\BddManager;
use PDO;


class ElementProduit
{

    private $dataBase;
    protected $serverPath;

    public function __construct(BddManager $bddManager)
    {
        global $serverName;
        $this->serverPath = $serverName;
        $this->dataBase = $bddManager->linkConnect();
    }

    public function produitElement($id_product)
    {
        //SELECT * FROM `products` WHERE id_product = 1;
        $sql = "SELECT * FROM products WHERE id_product = :id_product";
        $request = $this->dataBase->prepare($sql);
        $request->bindParam(':id_product', $id_product);
        $request->execute();
        $detail = $request->fetchAll(PDO::FETCH_ASSOC);

        foreach ($detail as $details) {
            $imageData = json_decode($details['images'], true);
            $details['images'] = $imageData;

            echo "<div class='bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-x1'>";
            echo "<div class='bg-grav-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4'>";
            echo "<svg xmlns='http://www.w3.org/2000/svg' width='18px' class='fill-gray-800 inline-block' viewBox='0 0 64 64'>";
            echo 'path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 div0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z" data-original="#000000"></path>';
            echo "</svg>";
            echo "</div>";
            echo '<img id="' . $details['id_product'] . '" class="article-image" src="http://' . $this->serverPath . '/assets/images/' . $details['images']['main'] . '"alt="' . $details["name"] . '">';
            echo "<p id='" . $details['id_product'] . "' class='mt-3 font-bold article-name'>" . $details["name"] . "</p>";
            echo "<div class='flex justify-center'>";
            echo "<p class='mt-3 font-bold mr-2'>" . $details["price"] . "€</p>";
            echo "<p class='mt-3 font-medium text-gray-300'>" . $details["price"] . "€";
            echo "</div>";
            echo "<div>";
            echo '<button type="button" class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full">Add to cart</button>';
            echo '</div>';
            echo '</div>';
        }

    }
}

?>