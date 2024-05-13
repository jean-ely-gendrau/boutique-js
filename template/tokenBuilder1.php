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

$now   = new DateTimeImmutable();
$token = $tokenBuilder
    // Configure l'éméteur (iss claim)
    ->issuedBy('http://example.com')
    // Configures le destinataire (aud claim)
    ->permittedFor('http://example.org')
    // Configures le sujet (sub claim)
    ->relatedTo('component1')
    // Configures l'id du token (jti claim)
    ->identifiedBy('4f1g23a12aa')
    // Configures le moment de l'émission du token (iat claim)
    ->issuedAt($now)
    // Configures le moment à partir duquel le token est valide (nbf claim)
    ->canOnlyBeUsedAfter($now->modify('+1 minute'))
    // Configures le moment à partir duquel le token n'est plus valide (exp claim)
    ->expiresAt($now->modify('+1 hour'))
    // Configure un claim personnalisé (uid) 
    ->withClaim('uid', 1)
    // Configures un header personnalisé (foo)
    ->withHeader('foo', 'bar')
    // Crée un token signé
    ->getToken($algorithm, $signingKey);

echo $token->toString();
var_dump($token->claims()->all());
echo $token->toString();
