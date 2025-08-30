<?php

declare(strict_types=1);

use function Webmaesther\Pest\Contracts\contract;

contract('contract with dataset', function () {

    test('must be string', function (mixed $value) {
        expect($value)->toBeString();
    });
});
