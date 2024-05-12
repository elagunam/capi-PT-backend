<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactPhoneRequest;
use App\Http\Requests\UpdateContactPhoneRequest;
use App\Models\ContactPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactPhoneController extends Controller
{
    

    private function getPhonesForContactById($contact_id){
        $phones = ContactPhone::where('contact_id', $contact_id)->where('deleted', 0)->get();
        if(sizeof($phones) < 1){
            return [];
        }
        return $phones;
    }

    public function getOneById(Request $request){
        $id = $request->id;
        $phones = ContactPhone::where('id', $id)->get();
        if(sizeof($phones) < 1){
            $response['status'] = false;
            $response['message'] = 'No se encontró información.';
            return response()->json($response);
        }

        $response['status'] = true;
        $response['phone'] = $phones[0];
        $response['message'] = 'Se encontró información';
        return response()->json($response);
    }

    public function save(Request $request){
        

        if(!$request->filled(['contact_id', 'phone_number', 'type'])){
            $response['status'] = false;
            $response['message'] = 'Debe completar el formulario para guardar la informacíon';
            return response()->json($response);
        }

        $contact_id = $request->contact_id;
        $phone_number = $request->phone_number;
        $type = $request->type;

        
        if($request->filled(['id'])){
            $id = $request->id;
            $phones = ContactPhone::where('id', $id)->where('contact_id', $contact_id)->get();
            if(sizeof($phones) < 1){
                $response['status'] = false;
                $response['message'] = 'No se encontró información especificada';
                return response()->json($response);
            }
            $contactPhone = $phones[0];
        }else{
            $contactPhone = new ContactPhone;
            $contactPhone->contact_id = $contact_id;
        }

        $contactPhone->phone_number = $phone_number;
        $contactPhone->type = $type;

        

        if(!$contactPhone->save()){
            $response['status'] = false;
            $response['message'] = '¡Oops! Parece que algo salió mal';
            return response()->json($response);
        }

        $contactPhones = $this->getPhonesForContactById($contactPhone->contact_id);
        

        $response['status'] = true;
        $response['phones'] = $contactPhones;
        $response['message'] = 'Información guardada';
        return response()->json($response);
    }


    public function delete(Request $request){
        $id = $request->id;

        
        $phones = ContactPhone::where('id', $id)->get();
        if(sizeof($phones) < 1){
            $response['status'] = false;
            $response['message'] = 'No se encontró información';
            return response()->json($response);
        }
        $contactPhone = $phones[0];

        $contactPhone->deleted = 1;
        $contactPhone->deleted_at = DB::raw('now()');

        if(!$contactPhone->save()){
            $response['status'] = false;
            $response['message'] = '¡Oops! Parece que algo salió mal';
            return response()->json($response);
        }
        $contactPhones = $this->getPhonesForContactById($contactPhone->contact_id);
        
        $response['status'] = true;
        $response['phones'] = $contactPhones;
        $response['message'] = 'Dirección eliminada';
        return response()->json($response);
    }
}
