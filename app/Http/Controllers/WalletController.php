<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreWalletRequest, UpdateWalletRequest};
use App\Models\Wallet;
use App\Services\ServiceInterface\Wallet\WalletServiceInterface;
use Inertia\Inertia;

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

        $create = $this->walletService->create($request->all());

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
    public function update(UpdateWalletRequest $request, Wallet $wallet)
    {
        //
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
