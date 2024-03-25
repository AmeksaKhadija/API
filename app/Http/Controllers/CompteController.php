<?php

namespace App\Http\Controllers;

use App\Models\compte;
use App\Http\Requests\StorecompteRequest;
use App\Http\Requests\UpdatecompteRequest;

class CompteController extends Controller
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
     * @param  \App\Http\Requests\StorecompteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecompteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function show(compte $compte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function edit(compte $compte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecompteRequest  $request
     * @param  \App\Models\compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecompteRequest $request, compte $compte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(compte $compte)
    {
        //
    }
}
