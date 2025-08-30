<?php

declare(strict_types=1);

use Pest\Concerns\Expectable;
use Pest\PendingCalls\DescribeCall;
use Pest\PendingCalls\TestCall;
use Pest\Support\HigherOrderTapProxy;
use PHPUnit\Framework\TestCase;
use Webmaesther\Pest\Contracts\ContractRepository;

if (! function_exists('contract')) {
    /**
     * Registers a new contract.
     */
    function contract(string $description, Closure $tests): void
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
    function fulfill(string $description): DescribeCall // @phpstan-ignore-line
    {
        return describe($description, ContractRepository::instance()->retrieve($description));
    }
}
