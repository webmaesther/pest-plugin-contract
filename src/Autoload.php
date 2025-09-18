<?php

declare(strict_types=1);

use Pest\Concerns\Expectable;
use Pest\Contract\ContractRepository;
use Pest\PendingCalls\DescribeCall;
use Pest\PendingCalls\TestCall;
use Pest\Support\HigherOrderTapProxy;
use PHPUnit\Framework\TestCase;

if (! function_exists('contract')) {
    /**
     * Registers a new contract.
     */
    function contract(string|BackedEnum $description, Closure $tests): void
    {
        ContractRepository::instance()->store($description, $tests);
    }
}

if (! function_exists('fulfill')) {
    /**
     * Enforces the given contract.
     *
     * @return HigherOrderTapProxy<Expectable|TestCall|TestCase>|Expectable|TestCall|TestCase|mixed
     */
    function fulfill(string|BackedEnum $description): DescribeCall // @phpstan-ignore-line
    {
        if ($description instanceof BackedEnum) {
            $description = (string) $description->value;
        }

        return describe($description, ContractRepository::instance()->retrieve($description));
    }
}
