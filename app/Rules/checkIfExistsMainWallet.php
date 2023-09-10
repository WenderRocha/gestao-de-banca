<?php

namespace App\Rules;

use App\Models\Wallet;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class checkIfExistsMainWallet implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // Obtenha o valor de main da solicitação
        $main = request()->input('main');

        //obtem o ID do usuário logado
        $user_id = Auth::user()->id;

        if ($main) {

            //verifica se já existe uma carteira principal
            $exists = Wallet::where('user_id', $user_id)
                ->where('main', 1)
                ->exists();

            if ($exists) {
                $fail('Já existe uma carteira principal cadastrada.');
            }
        }
    }
}
