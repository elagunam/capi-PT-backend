<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactAddressRequest;
use App\Http\Requests\UpdateContactAddressRequest;
use App\Models\ContactAddress;
use Illuminate\Http\Request;

class ContactAddressController extends Controller
{

    private function getAddressesForContactById($contact_id){
        $addresses = ContactAddress::where('contact_id', $contact_id)->where('deleted', 0)->get();
        if(sizeof($addresses) < 1){
            return [];
        }
        return $addresses;
    }

    public function getOneById(Request $request){
        $id = $request->id;
        $addresses = ContactAddress::where('id', $id)->get();
        if(sizeof($addresses) < 1){
            $response['status'] = false;
            $response['message'] = 'No se encontró información.';
            return response()->json($response);
        }

        $response['status'] = true;
        $response['address'] = $addresses[0];
        $response['message'] = 'Se encontró información';
        return response()->json($response);
    }

    public function save(Request $request){
        

        if(!$request->filled(['contact_id', 'address', 'city', 'country', 'zip'])){
            $response['status'] = false;
            $response['message'] = 'Debe completar el formulario para guardar la informacíon';
            return response()->json($response);
        }

        $contact_id = $request->contact_id;
        $address = $request->address;
        $city = $request->city;
        $country = $request->country;
        $zip = $request->zip;

        
        if($request->filled(['id'])){
            $id = $request->id;
            $addresses = ContactAddress::where('id', $id)->where('contact_id', $contact_id)->get();
            if(sizeof($addresses) < 1){
                $response['status'] = false;
                $response['message'] = 'No se encontró información especificada';
                return response()->json($response);
            }
            $contactAddress = $addresses[0];
        }else{
            $contactAddress = new ContactAddress;
            $contactAddress->contact_id = $contact_id;
        }

        $contactAddress->address = $address;
        $contactAddress->city = $city;
        $contactAddress->country = $country;
        $contactAddress->zip = $zip;

        

        if(!$contactAddress->save()){
            $response['status'] = false;
            $response['message'] = '¡Oops! Parece que algo salió mal';
            return response()->json($response);
        }

        $addresesForContact = $this->getAddressesForContactById($contactAddress->contact_id);
        

        $response['status'] = true;
        $response['addresses'] = $addresesForContact;
        $response['message'] = 'Información guardada';
        return response()->json($response);
    }
}
