<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageSize = 10;

        if ($request->filled('pageSize')){
            $pageSize = $request->pageSize;
        }


        $query = Contact::query();

        //SI INDICA EL FILTRO DE NOMBRE, BUSCAMOS POR NOMBRE
        if ($request->filled('fullname')) {
            $query->where('fullname', 'like', '%' . $request->fullname . '%');
        }

        //SI INDICA EL FILTRO DE EMAIL, BUSCAMOS CON EMAIL
        if ($request->filled('email')) {
            $query->whereHas('emails', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        if ($request->filled('phone_number')) {
            $query->whereHas('phones', function ($q) use ($request) {
                $q->where('phone_number', 'like', '%' . $request->phone_number . '%');
            });
        }

        if ($request->filled('city')) {
            $query->whereHas('addresses', function ($q) use ($request) {
                $q->where('city', 'like', '%' . $request->city . '%');
            });
        }

        $contacts = $query->paginate($pageSize);

        return response()->json($contacts);
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
    public function store(StoreContactRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
