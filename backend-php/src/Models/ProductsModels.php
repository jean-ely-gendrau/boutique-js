<?php

namespace App\Boutique\Models;

use JsonSerializable;

class ProductsModels implements JsonSerializable
{
    /**
     * id
     *
     * @var int
     */
    private $id;

    /**
     * name
     *
     * @var string
     */
    private $name;

    /**
     * description
     *
     * @var string
     */
    private $description;

    /**
     * price
     *
     * @var float
     */
    private $price;

    /**
     * quantity
     *
     * @var int
     */
    private $quantity;

    /**
     * category_id
     *
     * @var int
     */
    private $category_id;

    /**
     * sub_category_id
     *
     * @var int
     */
    private $sub_category_id;

    /**
     * created_at
     *
     * @var string
     */
    private $created_at;

    /**
     * updated_at
     *
     * @var string
     */
    private $updated_at;

    /**
     * url_images
     *
     * @var string
     */
    private $url_image;

    /************************************************* Other Properties */

    // CAT SUBCAT NAME

    /**
     * catName
     *
     * @var string
     */
    private $catName;

    /**
     * subCatName
     *
     * @var string
     */
    private $subCatName;

    /**
     * user_has_product
     *
     * @var string
     */
    private $user_has_product;

    /**
     * ordered
     *
     * @var string
     */
    private $ordered;

    /*** RATINGS PROPERTIES */

    /**
     * average_rating
     *
     * @var string
     */
    private $average_rating;

    /**
     * ratings_id
     *
     * @var int
     */
    private $ratings_id;

    /**
     * rating
     *
     * @var int
     */
    private $rating;

    /**
     * ratings
     *
     * @var array
     */
    private $ratings;

    /**
     * commentUsers_id
     *
     * @var int
     */
    private $ratingUsers_id;

    /**
     * usersRating
     *
     * @var string
     */
    private $usersRating;

    /*** COMMENTS PROPERTIES */

    /**
     * comments_id
     *
     * @var int
     */
    private $comments_id;

    /**
     * comment
     *
     * @var string
     */
    private $comment;

    /**
     * comments
     *
     * @var array
     */
    private $comments;

    /**
     * commentUsers_id
     *
     * @var int
     */
    private $commentUsers_id;

    /**
     * usersComment
     *
     * @var string
     */
    private $usersComment;

    public function __construct(mixed $data = [])
    {
        //Ajouté les propriétés et méthodes au besoins
        // Hydrate les propriété existante de la class avec les données passée en arguments
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        /**
         * Initialiser les propriétés après l'hydratation de données avec un tableau vide lors de l'instanciation de la class
         */
        $this->comments = [];
        $this->ratings = [];
    }

    /* ----------------------------------- METHOD MAGIC ------------------------------ */
    /* __get magic
     * https://www.php.net/manual/en/language.oop5.magic.php
     */

    /**
     * Get magic __get
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /*
     * Depuis Php 8.2 il est recommandé de ne pas implémenter cette méthode
     * sinon on obtiendrait une erreur de ce type
     * Using Dynamic Properties on Classes running PHP 8.2 will lead to PHP Deprecated
     *
     *
     * Set magic __set
     *
     * @param string $property La propriétée
     * @param mixed $value La valeur de la propriétée
     * @return self
     */
    public function __set(string $property, mixed $value)
    {
    }

    /************************************** Add/Create Méthode ***********************************/

    public function addComment($comment, $commentId, $usersComment)
    {
        // Vérifier la présence dans le tableau multidimentionnel
        if (!self::isInMultidimensionalArray($commentId, $this->comments)) {
            $this->comments[] = (object) ['comments_id' => $commentId, 'full_name' => $usersComment, 'comment' => $comment];
        }
    }

    public function addRating($rating, $ratingId, $usersRating)
    {
        // Vérifier la présence dans le tableau multidimentionnel
        if (!self::isInMultidimensionalArray($ratingId, $this->ratings)) {
            $this->ratings[] = (object) ['ratings_id' => $ratingId, 'full_name' => $usersRating, 'rating' => $rating];
        }
    }

    public static function createFromProduct(ProductsModels $product): self
    {
        // On hydrate les données en utilisant une instance de cette classe.
        return new self([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'category_id' => $product->category_id,
            'sub_category_id' => $product->sub_category_id,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
            'image_id' => $product->image_id,
            'image_url' => $product->image_url,
            'average_rating' => $product->average_rating
        ]);
    }
    /************************************** Getter/Setter ***********************************/

    /**
     * Get id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  int  $id  id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string  $name  name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description
     *
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param  string  $description  description
     *
     * @return  self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get price
     *
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param  float  $price  price
     *
     * @return  self
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return  int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set quantity
     *
     * @param  int  $quantity  quantity
     *
     * @return  self
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return  string
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set created_at
     *
     * @param  string  $created_at  created_at
     *
     * @return  self
     */
    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return  string
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set updated_at
     *
     * @param  string  $updated_at  updated_at
     *
     * @return  self
     */
    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get url_image
     *
     * @return  string
     */
    public function getUrl_image()
    {
        return $this->url_image;
    }

    /**
     * Set url_image
     *
     * @param  string  $url_image
     *
     * @return  self
     */
    public function setUrl_image(string $url_image)
    {
        $this->url_image = $url_image;

        return $this;
    }

    /**
     * La fonction `jsonSerialize` renvoie toutes les propriétés
     * de l'objet sous forme de tableau associatif pour la sérialisation JSON, à l'exception des clés spécifiées.
     *
     * @return mixed La méthode `jsonSerialize` renvoie un tableau de toutes les propriétés publiques
     * de l'objet en utilisant la fonction `get_object_vars`.
     */
    public function jsonSerialize(): mixed
    {
        // array_diff_key et EXCLUDE_PROPERTIES permettent de retirer des clés du résultat que l'on ne souhaite pas renvoyer.
        return get_object_vars($this);
    }

    /**
     * Get category_id
     *
     * @return  int
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set category_id
     *
     * @param  int  $category_id  category_id
     *
     * @return  self
     */
    public function setCategory_id(int $category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get sub_category_id
     *
     * @return  int
     */
    public function getSub_category_id()
    {
        return $this->sub_category_id;
    }

    /**
     * Set sub_category_id
     *
     * @param  int  $sub_category_id  sub_category_id
     *
     * @return  self
     */
    public function setSub_category_id(int $sub_category_id)
    {
        $this->sub_category_id = $sub_category_id;

        return $this;
    }

    /**
     * Get user_has_product
     *
     * @return  string
     */
    public function getUser_has_product()
    {
        return $this->user_has_product;
    }

    /**
     * Set user_has_product
     *
     * @param  string  $user_has_product  user_has_product
     *
     * @return  self
     */
    public function setUser_has_product(string $user_has_product)
    {
        $this->user_has_product = $user_has_product;

        return $this;
    }

    /**
     * Get ordered
     *
     * @return  string
     */
    public function getOrdered()
    {
        return $this->ordered;
    }

    /**
     * Set ordered
     *
     * @param  string  $ordered  ordered
     *
     * @return  self
     */
    public function setOrdered(string $ordered)
    {
        $this->ordered = $ordered;

        return $this;
    }

    /**
     * Get average_rating
     *
     * @return  string
     */
    public function getAverage_rating()
    {
        return $this->average_rating;
    }

    /**
     * Set average_rating
     *
     * @param  string  $average_rating  average_rating
     *
     * @return  self
     */
    public function setAverage_rating(string $average_rating)
    {
        $this->average_rating = $average_rating;

        return $this;
    }





    /************************************** START ASSESSEUR NOTATIONS *******************************/

    /**
     * Get rating
     *
     * @return  int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * Set ratings
     *
     * @param  int  $rating  rating
     *
     * @return  self
     */
    public function setRating(int $rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * Get ratings_id
     *
     * @return  int
     */
    public function getRatings_id(): int
    {
        return $this->ratings_id;
    }

    /**
     * Set ratings_id
     *
     * @param  int  $ratings_id  ratings_id
     *
     * @return  self
     */
    public function setRatings_id(int $ratings_id): self
    {
        $this->ratings_id = $ratings_id;

        return $this;
    }

    /**
     * Get ratingUsers_id
     *
     * @return  int
     */
    public function getRatingUsers_id(): int
    {
        return $this->ratingUsers_id;
    }

    /**
     * Set ratingUsers_id
     *
     * @param  int  $ratingUsers_id  ratingUsers_id
     *
     * @return  self
     */
    public function setRatingUsers_id(int $ratingUsers_id): self
    {
        $this->ratingUsers_id = $ratingUsers_id;

        return $this;
    }

    /**
     * Get usersRating
     *
     * @return  string
     */
    public function getUsersRating()
    {
        return $this->usersRating;
    }

    /**
     * Set usersRating
     *
     * @param  string  $usersRating  usersRating
     *
     * @return  self
     */
    public function setUsersRating(string $usersRating)
    {
        $this->usersRating = $usersRating;

        return $this;
    }

    /**************************************   END ASSESSEUR NOTATIONS   ******************************/

    /************************************** START ASSESSEUR COMMENTAIRE *******************************/

    /**
     * Get comments_id
     *
     * @return  int
     */
    public function getComments_id(): int
    {
        return $this->comments_id;
    }

    /**
     * Set comments_id
     *
     * @param  int  $comments_id  comments_id
     *
     * @return  self
     */
    public function setComments_id(int $comments_id): self
    {
        $this->comments_id = $comments_id;
        return $this;
    }

    /**
     * Get comment
     *
     * @return  array
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set comment
     *
     * @param  string  $comment  comment
     *
     * @return  self
     */
    public function setComment(string $comment): self
    {

        $this->comment = $comment;


        return $this;
    }

    /**
     * Get commentUsers_id
     *
     * @return  int
     */
    public function getCommentUsers_id()
    {
        return $this->commentUsers_id;
    }

    /**
     * Set commentUsers_id
     *
     * @param  int  $commentUsers_id  commentUsers_id
     *
     * @return  self
     */
    public function setCommentUsers_id(int $commentUsers_id)
    {
        $this->commentUsers_id = $commentUsers_id;

        return $this;
    }

    /**
     * Get usersComment
     *
     * @return  string
     */
    public function getUsersComment()
    {
        return $this->usersComment;
    }

    /**
     * Set usersComment
     *
     * @param  string  $usersComment  usersComment
     *
     * @return  self
     */
    public function setUsersComment(string $usersComment)
    {
        $this->usersComment = $usersComment;

        return $this;
    }

    /************************************** END ASSESSEUR COMMENTAIRE *******************************/

    /************************************** Function Static *****************************************/
    public static function isInMultidimensionalArray($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (in_array($needle, (array)$item)) {
                return true;
            }
        }

        return false;
    }
}
