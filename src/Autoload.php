<?php

declare(strict_types=1);

namespace Webmaesther\Pest\Contracts;

use Closure;
use Pest\PendingCalls\DescribeCall;
use Pest\Plugin;
use PHPUnit\Framework\TestCase;

Plugin::uses(Example::class);

/**
 * @return TestCase
 */
function example(string $argument)
{
    return test()->example(...func_get_args()); // @phpstan-ignore-line
}

function contract(string $description, Closure $tests): void
{
    ContractRepository::instance()->store($description, $tests);
}

function fulfill(string $description): DescribeCall
{
    return describe($description, ContractRepository::instance()->retrieve($description));
}
