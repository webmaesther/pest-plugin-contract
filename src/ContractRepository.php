<?php

declare(strict_types=1);

namespace Pest\Contracts;

use Closure;
use Pest\Contracts\Exceptions\ContractAlreadyExists;
use Pest\Contracts\Exceptions\ContractNotFound;

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

    public function store(string $description, Closure $contract): void
    {
        if (array_key_exists($description, $this->contracts)) {
            throw new ContractAlreadyExists;
        }

        $this->contracts[$description] = $contract;
    }

    public function retrieve(string $description): Closure
    {
        return $this->contracts[$description] ?? throw new ContractNotFound;
    }

    public static function clear(): void
    {
        self::$instance = null;
    }
}
