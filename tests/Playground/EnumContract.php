<?php

declare(strict_types=1);

use Tests\Playground\Contracts\IntEnum;
use Tests\Playground\Contracts\StringEnum;

contract(StringEnum::TEXT, function () {

    test('true is true', function () {
        expect(true)->toBeTrue();
    });
});

contract(IntEnum::NUMBER, function () {

    test('false is false', function () {
        expect(false)->toBeFalse();
    });
});
