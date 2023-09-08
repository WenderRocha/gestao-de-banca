<?php

namespace App\Http\Requests;

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
            'name'      => 'required',
            'currency'  => 'required',
            'balance'   => 'required',
            'stopType'  => 'required',
            'stop'      => 'required',
            'take'      => 'required',
            'main'      => 'required',
            'status'    => 'required',
            'checklist' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'Informe o nome da carteira.',
            'currency.required'  => 'Selecione a moeda.',
            'balance.required'   => 'Informe o saldo inicial.',
            'stopType.required'  => 'Escolha o tipo de stop.',
            'stop.required'      => 'Informe o stop loss.',
            'take.required'      => 'Informe o take profit.',
            'main.required'      => 'carteira principal ?.',
            'status.required'    => 'Selecione o status.',
            'checklist.required' => 'Exibir checklist ?',
        ];
    }
}
