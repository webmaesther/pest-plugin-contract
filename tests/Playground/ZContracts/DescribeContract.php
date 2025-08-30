<?php

use function Webmaesther\Pest\Contracts\contract;

contract('contract closure', function () {

    describe('describe closure', function () {

        test('test closure', function () {
            expect(true)->toBeTrue();
        });
    });
});
