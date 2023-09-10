<?php

namespace App\Http\Requests;

use App\Rules\{NumericIfStopTypeIs2Rule, checkIfExistsMainWallet, checkWalletNameByUSer};
use Illuminate\Foundation\Http\FormRequest;

class StoreWalletRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', new checkWalletNameByUSer()],
            'currency'  => 'required|string',
            'balance'   => 'required|numeric|gt:0',
            'stopType'  => 'required',
            'stop'      => ['required', 'numeric', 'gt:0'],
            'take'      => ['required', 'numeric', 'gt:0'],
            'main'      => ['required', 'boolean', new checkIfExistsMainWallet()],
            'status'    => 'required|boolean',
            'checklist' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'Informe o nome da carteira.',
            'currency.required'  => 'Selecione a moeda.',
            'balance.required'   => 'Informe o saldo inicial.',
            'balance.gt'         => 'Informe um valor válido.',
            'stopType.required'  => 'Escolha o tipo de stop.',
            'stop.required'      => 'Informe o stop loss.',
            'stop.gt'            => 'Informe um valor válido.',
            'stop.numeric'       => 'Digite apenas números',
            'take.required'      => 'Informe o take profit.',
            'take.gt'            => 'Informe um valor válido.',
            'take.numeric'       => 'Digite apenas números.',
            'main.required'      => 'carteira principal ?.',
            'status.required'    => 'Selecione o status.',
            'checklist.required' => 'Exibir checklist ?',
            'main.boolean'       => 'Informe um valor válido.',
            'status.boolean'     => 'Informe um valor válido.',
            'checklist.boolean'  => 'Informe um valor válido.',
        ];
    }
}
