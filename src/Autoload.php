<?php

declare(strict_types=1);

namespace Webmaesther\Pest\Contracts;

use Closure;
use Pest\PendingCalls\DescribeCall;

function contract(string $description, Closure $tests): void
{
    ContractRepository::instance()->store($description, $tests);
}

function fulfill(string $description): DescribeCall
{
    return describe($description, ContractRepository::instance()->retrieve($description));
}
