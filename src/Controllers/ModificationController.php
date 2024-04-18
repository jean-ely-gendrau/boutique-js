<?php







namespace App\Boutique\Controllers;


use App\Boutique\Manager\CrudManager;






class ModificationController
{
    public function __construct()
    {
        /* Action du constucteur */
    }

    /**
     * Méthode Index qui affiche les variables transmises à la méthode.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.s
     * @return void
     */
    public function Index(...$arguments)
    {
        /*
         * Utilisation de la méthode Index dans notre exemple avec l'affichage des variables transmises à la méthode
         */
        return var_dump($arguments);
    }

    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments Les arguments transmis à la méthode.
     * @return string Le contenu généré en rendant le template 'test-render' avec les arguments fournis.
     */

    public function View(...$arguments)
    {
    }



    public function Modification(...$arguments)
    {
        /** @var \App\Boutique\Utils\Render $render */

        $render = $arguments['render'];



        $id_user = new CrudManager('users', 'Modification');

        $id_user->getByEmail($_SESSION['email']);

        $paramSQL = [];

        echo "<pre>";
        // var_dump($arguments);
        foreach ($arguments as $key => $value) {
            if ($key == 'NewFullName') {
                if (preg_match('/^[a-zA-Z-\s]{8,45}$/', $value)) {
                    $paramSQL['NewFullName'] = $value;
                } else {
                    echo "Veuillez entre un nom et prenom valide minimum 8 characters maximum 45 characters";
                }
            } elseif ($key == 'NewBrithday') {
                if (preg_match('/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/(19|20)\d\d$/', $value)) {
                    $paramSQL['NewBrithday'] = $value;
                } else {
                    echo "Veuillez entre une date de naissance valide";
                }
            } elseif ($key == 'NewAdress') {
                if (preg_match('/^[0-9]{5}$/', $value)) {
                    $paramSQL['NewAdress'] = $value;
                } else {
                    echo "Veuillez entre un code postal valide";
                }
            } elseif ($key == 'nouveau_password') {
                if (
                    preg_match('/^(?(?=.*[A-Z])(?=.*[0-9])(?=.*[\%\$\,\;\!\-_@.])[a-zA-Z0-9\%\$\,\;\!\-_@.]{6,25})$/', $value)
                ) {
                    $paramSQL['nouveau_password'] = $value;
                } else {
                    echo "Veuillez entre un mot de passe valide avoir une longueur de 6 à 25 caractères ,contenir au moins une lettre majuscule, un chiffre et l'un des caractères spéciaux spécifiés : %, $, ,, ;, !, _, ou -.";
                }
            }
        }
        $user = new CrudManager('users', 'Modification');



        $user->update($user, array_keys($paramSQL));
    }
}
