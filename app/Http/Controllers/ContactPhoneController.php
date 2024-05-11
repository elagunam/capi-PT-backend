<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactPhoneRequest;
use App\Http\Requests\UpdateContactPhoneRequest;
use App\Models\ContactPhone;

class ContactPhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreContactPhoneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactPhone $contactPhone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactPhone $contactPhone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactPhoneRequest $request, ContactPhone $contactPhone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactPhone $contactPhone)
    {
        //
    }
}
