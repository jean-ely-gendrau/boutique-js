<?php

declare(strict_types=1);

use Lcobucci\JWT\Encoding\CannotDecodeContent;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token\InvalidTokenStructure;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Token\UnsupportedHeaderFound;
use Lcobucci\JWT\UnencryptedToken;

$parser = new Parser(new JoseEncoder());

try {
    $token = $parser->parse(
        'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.'
            . 'eyJzdWIiOiIxMjM0NTY3ODkwIn0.'
            . '2gSBz9EOsQRN9I-3iSxJoFt7NtgV6Rm0IL6a8CAwl3Q'
    );
} catch (CannotDecodeContent | InvalidTokenStructure | UnsupportedHeaderFound $e) {
    echo 'Oh no, an error: ' . $e->getMessage();
}
assert($token instanceof UnencryptedToken);

echo $token->claims()->get('sub'), PHP_EOL; // will print "1234567890"