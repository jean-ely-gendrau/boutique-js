<?php

namespace App\Boutique;

/**
 * PasswordHashGenerate
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
    public function hash($password)
    {
        return \sodium_crypto_pwhash_str(
            $password,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE,
        );
    }

    public function verify(string $hash, string $password): bool
    {
        if ('' === $password || \strlen($password) < 10):
            return false;
        endif;

        if (\sodium_crypto_pwhash_str_verify($hash, $password)):
            return true;
        endif;
    }
}
