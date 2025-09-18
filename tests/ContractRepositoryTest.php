<?php

declare(strict_types=1);

use Pest\Contract\ContractRepository;
use Pest\Contract\Exceptions\ContractAlreadyExists;
use Pest\Contract\Exceptions\ContractNotFound;
use Tests\Playground\Contracts\IntEnum;
use Tests\Playground\Contracts\StringEnum;

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

    test('stores string backed enum contracts', function () {
        // Act && Assert
        expect(ContractRepository::instance()->store(StringEnum::TEXT, function () {}))
            ->toBeNull();
    });

    test('stores int backed enum contracts', function () {
        // Act && Assert
        expect(ContractRepository::instance()->store(IntEnum::NUMBER, function () {}))
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

    test('retrieves a string backed enum contract', function () {
        // Arrange
        $contract = function () {};
        ContractRepository::instance()->store(StringEnum::TEXT, $contract);

        // Act && Assert
        expect(ContractRepository::instance()->retrieve(StringEnum::TEXT))->toBe($contract);
    });

    test('retrieves an int backed enum contract', function () {
        // Arrange
        $contract = function () {};
        ContractRepository::instance()->store(IntEnum::NUMBER, $contract);

        // Act && Assert
        expect(ContractRepository::instance()->retrieve(IntEnum::NUMBER))->toBe($contract);
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
