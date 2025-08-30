<?php

declare(strict_types=1);

use Pest\PendingCalls\DescribeCall;

use function Webmaesther\Pest\Contracts\contract;
use function Webmaesther\Pest\Contracts\fulfill;

test('can fulfill contracts', function () {
    // Arrange
    $closure = function () {
        test('example', function () {
            expect(true)->toBeTrue();
        });
    };

    // Act
    contract('contract name', $closure);
    /** @var DescribeCall $call */
    $call = fulfill('contract name');

    // Assert
    expect($call)->toBeInstanceOf(DescribeCall::class)
        ->tests->toBe($closure);
})->todo('figure out how to test this');
