<?php

namespace App\Boutique\Manager;

/**
 * PasswordHashGenerate
 *
 * * La librairie Sodium dois être activée sur le serveur.
 * 
 * Afin de produire le même hachage de mot de passe à partir du même mot de passe,
 * les mêmes valeurs pour opslimitet memlimitdoivent être utilisées.
 * Ceux-ci sont intégrés dans le hachage généré, donc tout ce qui est nécessaire pour vérifier le hachage est inclus.
 * Cela permet à la fonction sodium_crypto_pwhash_str_verify() de vérifier le hachage sans avoir besoin de stockage
 * séparé pour les autres paramètres.
 *
 * https://www.php.net/manual/en/function.sodium-crypto-pwhash-str.php
 * https://www.php.net/manual/en/function.sodium-crypto-pwhash-str-verify.php
 */
class PasswordHashManager
{
    /**
     * Method hash
     *
     * Responsable de l'encodage de la chaîne d'entrée à l'aide de l'algorithme Argon2.
     * Il vérifie d'abord si la chaine de caractère est vide, et si oui, il renvoie la chaîne vide sans autre traitement
     * Cette vérification garantit que l'opération de hachage n'est pas effectuée sur un mot de passe vide,
     * évitant un traitement inutile et les problèmes potentiels qui pourraient résulter
     * du hachage d'un vide chaîne.
     * 
     * @param string $password [Le password à encoder sous forme de chaîne de caractère]
     *
     * @return string
     */
    public function hash(string $password): string
    {
        if (empty($password)) :
            return $password;
        endif;

        return \sodium_crypto_pwhash_str(
            $password,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE,
        );
    }

    /**
     * Method verify
     *
     * Cette méthode permet de verifier un mots de passe entrer par un utilisateur dans un formulaire de connexion.
     * Faite la récupération en Bdd de l'utilisateur qui souhaite ce connecter ,
     * Comprer le hash avec celui entrer dans le formulaire sans le convertir.
     * 
     * @param string $hash [hash provenant de la base de donnée]
     * @param string $password [mots de passe provenant de l'input password]
     *
     * @return bool
     */
    public function verify(string $hash, string $password): bool
    {
        if ('' === $password || \strlen($password) < 8) :
            return false;
        endif;

        if (\sodium_crypto_pwhash_str_verify($hash, $password)) :
            return true;
        endif;

        return false;
    }
}
