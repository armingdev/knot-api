<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreditCardRequest;
use App\Http\Requests\UpdateCreditCardRequest;
use App\Models\CreditCard;
use Illuminate\Http\JsonResponse;

class CreditCardController extends Controller
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
        return response()->json(CreditCard::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCreditCardRequest $request): JsonResponse
    {
        return response()->json(CreditCard::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(CreditCard $creditCard): JsonResponse
    {
        return response()->json($creditCard);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCreditCardRequest $request, CreditCard $creditCard): JsonResponse
    {
        $creditCard->update($request->validated());
        return response()->json($creditCard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CreditCard $creditCard): JsonResponse
    {
        return response()->json($creditCard->delete());
    }
}
