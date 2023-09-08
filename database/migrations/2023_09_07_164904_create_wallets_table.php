<?php

use App\Enums\{CurrencyEnum, StopTypeEnum, WalletMainEnum, WalletStatusEnum};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name')->default('Minha carteira');
            $table->string('logo')->default('public/img/app-wallet-passes.png');
            $table->string('currency', 5)->default(CurrencyEnum::BRL->value);
            $table->decimal('initial_balance')->default(0);
            $table->decimal('balance')->default(50);
            $table->integer('stop_type')->default(StopTypeEnum::proportional->value);
            $table->decimal('stop')->default(5);
            $table->decimal('take')->default(10);
            $table->decimal('profit')->default(0);
            $table->integer('status')->default(WalletStatusEnum::ACTIVE->value);
            $table->integer('main')->default(WalletMainEnum::YES->value);
            $table->boolean('is_binary')->default(false);
            $table->boolean('show_checklist')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
