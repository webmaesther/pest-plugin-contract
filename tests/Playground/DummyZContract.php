<?php

use function Webmaesther\Pest\Contracts\contract;

contract('example contract with a test', function () {
    test('example test', function () {
        expect(true)->toBeTrue();
    });
});
