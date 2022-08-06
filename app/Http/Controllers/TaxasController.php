<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaxasRequest;
use App\Http\Requests\UpdateTaxasRequest;
use App\Models\Taxas;

class TaxasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaxasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaxasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taxas  $taxas
     * @return \Illuminate\Http\Response
     */
    public function show(Taxas $taxas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taxas  $taxas
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxas $taxas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaxasRequest  $request
     * @param  \App\Models\Taxas  $taxas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxasRequest $request, Taxas $taxas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taxas  $taxas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxas $taxas)
    {
        //
    }
}
