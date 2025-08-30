<?php

declare(strict_types=1);

namespace Webmaesther\Pest\Contracts;

use Closure;
use Pest\Concerns\Expectable;
use Pest\PendingCalls\DescribeCall;
use Pest\PendingCalls\TestCall;
use Pest\Support\HigherOrderTapProxy;
use PHPUnit\Framework\TestCase;
use Webmaesther\Pest\Contracts\Exceptions\ContractAlreadyExists;
use Webmaesther\Pest\Contracts\Exceptions\ContractNotFound;

/**
 * @throws ContractAlreadyExists
 */
function contract(string $description, Closure $tests): void
{
    ContractRepository::instance()->store($description, $tests);
}

/**
 * @return HigherOrderTapProxy<Expectable|TestCall|TestCase>|Expectable|TestCall|TestCase|mixed
 *
 * @throws ContractNotFound
 */
function fulfill(string $description): DescribeCall // @phpstan-ignore-line
{
    return describe($description, ContractRepository::instance()->retrieve($description));
}
