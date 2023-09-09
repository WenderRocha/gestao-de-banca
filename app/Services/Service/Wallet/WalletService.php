<?php

declare(strict_types = 1);

namespace App\Services\Service\Wallet;

use App\Models\Wallet;
use App\Services\ServiceInterface\Wallet\WalletServiceInterface;
use Illuminate\Support\Facades\{Auth, Log};

class WalletService implements WalletServiceInterface
{
    /**
     * Efetua o cadastro de uma carteira para o usuário logado.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        try {

            $user = Auth::user();

            $data = $user->wallets()->create([
                'name'            => $data['name'],
                'currency'        => $data['currency'],
                'initial_balance' => $data['balance'],
                'balance'         => $data['balance'],
                'stop_type'       => $data['stopType'],
                'stop'            => $data['stop'],
                'take'            => $data['take'],
                'status'          => $data['status'],
                'main'            => $data['main'],
                'show_checklist'  => $data['checklist'],
            ]);

            return true;

        } catch (\Exception $e) {

            // Houve um erro ao criar a carteira, verifique o log
            Log::error('Erro ao criar carteira: ' . $e->getMessage());

            return false;
        }

    }

    /**
     * Retorna todas as carteiras do usuário logado
     *
     * @return void
     */
    public function findAll()
    {
        return Auth::user()->wallets;
    }

    /**
     * Retorna a carteira encontrada
     *
     * @param string|integer $id
     * @return Wallet
     */
    public function findById(string|int $id): Wallet|null
    {
        return Wallet::find($id);
    }

    /**
     * Deleta uma carteira do banco de dados
     *
     * @param string|integer $id
     * @return boolean
     */
    public function delete(string|int $id): bool
    {
        $wallet = $this->findById($id);

        if(!is_null($wallet)) {

            try {

                $wallet->delete();

                return true;

            } catch (\Exception $e) {

                // Houve um erro ao deletar a carteira, verifique o log
                Log::error('Erro ao deletar carteira: ' . $e->getMessage());

                return false;
            }

        }

        return false;
    }
}
