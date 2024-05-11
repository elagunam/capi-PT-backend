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


    public function getOneById(Request $request){
        $id = $request->id;
        $contacts = Contact::with('phones', 'addresses', 'emails')->where('id', $id)->get();
        if(sizeof($contacts) < 1){
            $response['status'] = false;
            $response['message'] = 'No se encontró información del contacto especificado.';
            return response()->json($response);
        }

        $response['status'] = true;
        $response['contact'] = $contacts[0];
        $response['message'] = 'Se encontró información del contacto especificado.';
        return response()->json($response);
    }
}
