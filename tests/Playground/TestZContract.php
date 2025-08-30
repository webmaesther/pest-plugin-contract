<?php

declare(strict_types=1);

contract('contract with a test', function () {
    test('true must be true', function () {
        expect(true)->toBeTrue();
    });
});
