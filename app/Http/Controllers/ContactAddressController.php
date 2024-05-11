<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactAddressRequest;
use App\Http\Requests\UpdateContactAddressRequest;
use App\Models\ContactAddress;

class ContactAddressController extends Controller
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
    public function store(StoreContactAddressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactAddress $contactAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactAddress $contactAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactAddressRequest $request, ContactAddress $contactAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactAddress $contactAddress)
    {
        //
    }
}
