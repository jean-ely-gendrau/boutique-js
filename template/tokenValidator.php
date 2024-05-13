<?php

declare(strict_types=1);

use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Constraint\RelatedTo;
use Lcobucci\JWT\Validation\Validator;

$parser = new Parser(new JoseEncoder());

$token = $parser->parse(
    'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.'
        . 'eyJzdWIiOiIxMjM0NTY3ODkwIn0.'
        . '2gSBz9EOsQRN9I-3iSxJoFt7NtgV6Rm0IL6a8CAwl3Q'
);

$validator = new Validator();

if (!$validator->validate($token, new RelatedTo('1234567891'))) {
    echo 'token OK!', PHP_EOL; // will print this
}

if (!$validator->validate($token, new RelatedTo('1234567890'))) {
    echo 'Invalid token (2)!', PHP_EOL; // will not print this
}
