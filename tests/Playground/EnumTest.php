<?php

declare(strict_types=1);

use Tests\Playground\Contracts\IntEnum;
use Tests\Playground\Contracts\StringEnum;

describe('test', function () {
    fulfill(StringEnum::TEXT);

    fulfill(IntEnum::NUMBER);
});
