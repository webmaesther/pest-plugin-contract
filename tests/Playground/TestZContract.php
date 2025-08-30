<?php

use function Webmaesther\Pest\Contracts\contract;

contract('contract with a test', function () {
    test('true must be true', function () {
        expect(true)->toBeTrue();
    });
});
