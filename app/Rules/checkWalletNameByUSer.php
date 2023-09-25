<?php

namespace App\Rules;

use App\Models\Wallet;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class checkWalletNameByUSer implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // Obtem o nome da carteira
        $name = request()->input('name');

        //obtem o ID do usuário logado
        $user_id = Auth::user()->id;

        //verifica se já existe uma carteira cadastrada com esse nome
        $exists = Wallet::where('user_id', $user_id)
            ->where('name', $name)
            ->exists();

        if(request()->method() != 'PUT') {
            if ($exists) {
                $fail('Já existe uma carteira com esse nome.');
            }
        }

    }
}
