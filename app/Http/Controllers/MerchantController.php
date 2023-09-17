<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMerchantRequest;
use App\Http\Requests\UpdateMerchantRequest;
use App\Models\Merchant;
use Illuminate\Http\JsonResponse;

class MerchantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Merchant::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMerchantRequest $request): JsonResponse
    {
        return response()->json(Merchant::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Merchant $merchant): JsonResponse
    {
        return response()->json($merchant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMerchantRequest $request, Merchant $merchant): JsonResponse
    {
        $merchant->update($request->validated());
        return response()->json($merchant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Merchant $merchant): JsonResponse
    {
        return response()->json($merchant->delete());
    }
}
