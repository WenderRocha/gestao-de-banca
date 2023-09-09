<?php

declare(strict_types = 1);

namespace App\Services\ServiceInterface\Wallet;

use App\Models\Wallet;

interface WalletServiceInterface
{
    public function findAll();
    public function findById(string|int $id): Wallet|null;
    public function create(array $data);
    public function delete(string|int $id): bool;
}
