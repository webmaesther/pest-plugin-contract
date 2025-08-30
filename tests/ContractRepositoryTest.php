<?php

use Pest\Contracts\ContractRepository;
use Pest\Contracts\Exceptions\ContractAlreadyExists;
use Pest\Contracts\Exceptions\ContractNotFound;

use function Pest\Faker\fake;

describe(ContractRepository::class, function (): void {
    beforeEach(function () {
        ContractRepository::clear();
    });

    test('cannot be constructed', function () {
        // Act && Assert
        expect(fn () => new ContractRepository)
            ->toThrow(Error::class);
    });

    test('is a singleton', function () {
        // Act && Assert
        expect(ContractRepository::instance())
            ->toBeInstanceOf(ContractRepository::class)
            ->toBe(ContractRepository::instance());
    });

    test('stores contracts', function () {
        // Act && Assert
        expect(ContractRepository::instance()->store(fake()->word(), function () {}))
            ->toBeNull();
    });

    test('retrieves a contract', function () {
        // Arrange
        $contract = function () {};
        $name = fake()->word();
        ContractRepository::instance()->store($name, $contract);

        // Act && Assert
        expect(ContractRepository::instance()->retrieve($name))->toBe($contract);
    });

    test('throws a ContractNotFound if the contract is not stored in it', function () {
        // Act && Assert
        expect(fn () => ContractRepository::instance()->retrieve(fake()->word()))
            ->toThrow(ContractNotFound::class);
    });

    test('throws a ContractAlreadyExists if the contract is already stored', function () {
        // Arrange
        $name = fake()->word();
        ContractRepository::instance()->store($name, function () {});

        // Act && Assert
        expect(fn () => ContractRepository::instance()->store($name, function () {}))
            ->toThrow(ContractAlreadyExists::class);
    });
});
