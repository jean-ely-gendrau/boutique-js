<?php

declare(strict_types=1);

use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token\Builder;


$tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
$algorithm    = new Sha256();
$signingKey   = InMemory::plainText(random_bytes(32));

$token = $tokenBuilder
    ->issuedBy($_SESSION["email"])
    ->withClaim('uid', 1)
    ->withHeader('foo', 'bar')
    ->getToken($algorithm, $signingKey);

$token->headers(); // Retrieves the token headers
$token->claims(); // Retrieves the token claims

echo $token->headers()->get('foo'), PHP_EOL; // will print "bar"
echo $token->claims()->get('iss'), PHP_EOL; // will print "http://example.com"
echo $token->claims()->get('uid'), PHP_EOL; // will print "1"

echo $token->toString(), PHP_EOL; // The string representation of the object is a JWT string