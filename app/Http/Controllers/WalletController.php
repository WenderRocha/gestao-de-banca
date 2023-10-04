<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Wallet;

use App\Services\Wallet\WalletServiceInterface;
use App\Http\Requests\{StoreWalletRequest, UpdateWalletRequest};

class WalletController extends Controller
{
    public function __construct(
        public WalletServiceInterface $walletService
    ) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallets = $this->walletService->findAll();

        return Inertia::render('Wallet', [
            'wallets' => $wallets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWalletRequest $request)
    {

        $create = $this->walletService->create($request->validated());

        if($create) {
            return redirect()->route('wallet.index');
        }

        return back()->withErrors('Erro ao cadastrar carteira', 'error');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWalletRequest $request)
    {
        //dd($request->validated());

        $update = $this->walletService->update($request->id, $request->validated());

        if(!$update) {
            return redirect()
            ->route('wallet.index')
            ->withErrors('Não foi possivel atualizar a carteira!', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string|int $id)
    {
        $delete = $this->walletService->delete($id);

        if($delete) {
            return redirect()->route('wallet.index');
        }

        return back()->withErrors('Não foi possivel deletar a carteira.');
    }
}
