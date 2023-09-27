<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreManagementRequest, UpdateManagementRequest};
use App\Models\{Management, Wallet};
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($wallet_id = null)
    {

        $user_id = Auth::user()->id;

        if (!is_null($wallet_id)) {

            //caso wallet_id seja diferente de null, busca a carteira pelo wallet_id
            $wallet = Wallet::query()
            ->select()
            ->where('id', $wallet_id)->first()->toArray();
        } else {

            //se nao obtem a carteira padrão para ser exibida.
            $wallet = Wallet::query()
            ->select()
            ->where('user_id', $user_id)
            ->where('main', true)->first();
        }

        if (is_null($wallet)) {
            return redirect()->route('wallet.index')
            ->withErrors('Crie ou edite uma carteira e marque como principal.', 'mainError');
        }

        return Inertia::render('Dashboard', [
            'wallet' => $wallet,
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
    public function store(StoreManagementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Management $management)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Management $management)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManagementRequest $request, Management $management)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Management $management)
    {
        //
    }
}
