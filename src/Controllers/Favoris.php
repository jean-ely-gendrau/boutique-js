<?php
namespace App\Boutique\Controllers;

use PDO;
use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Models\ProductsModels;

class Favoris extends CrudManager
{
    public function __construct()
    {
        parent::__construct('users', ProductsModels::class);
    }

    /**
     * The function `VerifyFavorite` checks if a user is connected and verifies if a product is a
     * favorite for that user.
     * 
     * @return string The function `VerifyFavorite` is returning a JSON-encoded boolean value `true` or
     * `false` based on the result of the `RequestFavorite` method. If the method returns a value
     * greater than 0, it will return `true`, otherwise it will return `false`. If the user is not
     * connected (based on the `['isConnected']` check), it will return a
     */
    public function VerifyFavorite(...$arguments): string
    {
        if (isset($_SESSION['isConnected'])) {
            $user = $this->getByEmail($_SESSION['email']);
            $idProduct = intval($arguments['product']);
            // var_dump($user->id);
            // var_dump($result[0]["product_count"]);
            if ($this->RequestFavorite($idProduct, $user->id) > 0) {
                return json_encode(True);
            } else {
                return json_encode(False);
            }
            // return json_encode([$user->id, intval($arguments['product'])]);
        } else {
            return json_encode("Connect to use");
        }
    }

    /**
     * The function `AddFavorite` in PHP checks if a user is connected, adds a product to their
     * favorites, and returns a JSON-encoded response.
     * 
     * @return string|bool The `AddFavorite` function returns a JSON-encoded string indicating whether
     * the favorite was successfully added, if the product is already a favorite, or if the user needs
     * to be connected to perform this action. The possible return values are:
     * - JSON-encoded string "Already fav" if the product is already a favorite.
     * - JSON-encoded boolean `true` if the favorite was successfully added.
     * - JSON-encoded boolean
     */
    public function ToggleFavorite(...$arguments): string|bool
    {
        if (isset($_SESSION['isConnected'])) {
            $user = $this->getByEmail($_SESSION['email']);
            $idProduct = intval($arguments['product']);
            $id = $user->id;
            if ($this->RequestFavorite($idProduct, $user->id) !== 0) {
                $sql = 'DELETE FROM `users_has_products` WHERE `users_has_products`.`users_id` = :idUser AND `users_has_products`.`products_id` = :idProduct';
                $supprFav = $this->getConnectBdd()->prepare($sql);
                $supprFav->bindParam(':idUser', $id, PDO::PARAM_INT);
                $supprFav->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
                $result = $supprFav->execute();
                if ($result) {
                    return json_encode('Suppre done');
                } else {
                    return json_encode('Suppre error');
                }
            } else {
                $sql = "INSERT INTO `users_has_products` (`users_id`, `products_id`) VALUES (:idUser, :idProduct)";
                $newFav = $this->getConnectBdd()->prepare($sql);
                $newFav->bindParam(':idUser', $id, PDO::PARAM_INT);
                $newFav->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
                $result = $newFav->execute();
                if ($result) {
                    return json_encode('Ajoute fav');
                } else {
                    return json_encode(False);
                }
            }
        } else {
            return json_encode("Connect to use");
        }
    }

    /**
     * The function `RequestFavorite` checks if a user has favorited a specific product in a database
     * table.
     * 
     * @param $idProduct The `idProduct` parameter in the `RequestFavorite` function represents the
     * unique identifier of a product that a user wants to check if it is a favorite for a specific
     * user.
     * @param $idUser The `idUser` parameter in the `RequestFavorite` function represents the ID of the
     * user for whom you want to check if a specific product is a favorite. This function queries the
     * database to count how many times the user with the given ID has the product with the specified
     * ID marked as a favorite in
     * 
     * @return int The function `RequestFavorite` is returning the count of how many times a
     * specific product has been marked as a favorite by a specific user.
     */
    private function RequestFavorite($idProduct, $idUser): int
    {
        $sql = "SELECT COUNT(*) AS product_count
        FROM users_has_products
        WHERE users_id = :idUser
        AND products_id = :idProduct";
        $checkVerify = $this->getConnectBdd()->prepare($sql);
        $checkVerify->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $checkVerify->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
        $checkVerify->execute();
        $result = $checkVerify->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]["product_count"];

    }
}