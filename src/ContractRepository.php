<?php

declare(strict_types=1);

namespace Pest\Contract;

use BackedEnum;
use Closure;
use Pest\Contract\Exceptions\ContractAlreadyExists;
use Pest\Contract\Exceptions\ContractNotFound;

final class ContractRepository
{
    private static ?self $instance = null;

    /**
     * @var array<string,Closure>
     */
    private array $contracts = [];

    private function __construct() {}

    public static function instance(): self
    {
        return self::$instance ??= new ContractRepository;
    }

    public function store(string|BackedEnum $description, Closure $contract): void
    {
        if ($description instanceof BackedEnum) {

            $description = (string) $description->value;
        }

        if (array_key_exists($description, $this->contracts)) {
            throw new ContractAlreadyExists;
        }

        $this->contracts[$description] = $contract;
    }

    public function retrieve(string|BackedEnum $description): Closure
    {
        if ($description instanceof BackedEnum) {
            $description = $description->value;
        }

        return $this->contracts[$description] ?? throw new ContractNotFound;
    }

    public static function clear(): void
    {
        self::$instance = null;
    }
}
