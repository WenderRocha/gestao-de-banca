<?php

declare(strict_types = 1);

namespace App\Services\ServiceInterface\Wallet;

interface WalletServiceInterface
{
    public function findAll();
    public function create(array $data);
}
