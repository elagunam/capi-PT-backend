<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactEmailRequest;
use App\Http\Requests\UpdateContactEmailRequest;
use App\Models\Contact;
use App\Models\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactEmailController extends Controller
{

    private function getEmailsForContactById($contact_id){
        $emails = ContactEmail::where('contact_id', $contact_id)->where('deleted', 0)->get();
        if(sizeof($emails) < 1){
            return [];
        }
        return $emails;
    }

    public function getOneById(Request $request){
        $id = $request->id;
        $emails = ContactEmail::where('id', $id)->get();
        if(sizeof($emails) < 1){
            $response['status'] = false;
            $response['message'] = 'No se encontró información.';
            return response()->json($response);
        }

        $response['status'] = true;
        $response['email'] = $emails[0];
        $response['message'] = 'Se encontró información';
        return response()->json($response);
    }

    public function save(Request $request){
        

        if(!$request->filled(['contact_id', 'email',])){
            $response['status'] = false;
            $response['message'] = 'Debe completar el formulario para guardar la informacíon';
            return response()->json($response);
        }

        $contact_id = $request->contact_id;
        $email = $request->email;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['status'] = false;
            $response['message'] = 'El email especificado no tienen un formato válido';
            return response()->json($response);
        }

        
        if($request->filled(['id'])){
            $id = $request->id;
            $emails = ContactEmail::where('id', $id)->where('contact_id', $contact_id)->get();
            if(sizeof($emails) < 1){
                $response['status'] = false;
                $response['message'] = 'No se encontró información especificada';
                return response()->json($response);
            }
            $contactEmail = $emails[0];
        }else{
            $contactEmail = new ContactEmail;
            $contactEmail->contact_id = $contact_id;
        }

        $contactEmail->email = $email;

        

        if(!$contactEmail->save()){
            $response['status'] = false;
            $response['message'] = '¡Oops! Parece que algo salió mal';
            return response()->json($response);
        }

        $contactEmails = $this->getEmailsForContactById($contactEmail->contact_id);
        

        $response['status'] = true;
        $response['emails'] = $contactEmails;
        $response['message'] = 'Información guardada';
        return response()->json($response);
    }


    public function delete(Request $request){
        $id = $request->id;

        
        $mails = ContactEmail::where('id', $id)->get();
        if(sizeof($mails) < 1){
            $response['status'] = false;
            $response['message'] = 'No se encontró información';
            return response()->json($response);
        }
        $mail = $mails[0];

        $mail->deleted = 1;
        $mail->deleted_at = DB::raw('now()');

        if(!$mail->save()){
            $response['status'] = false;
            $response['message'] = '¡Oops! Parece que algo salió mal';
            return response()->json($response);
        }
        $contactEmails = $this->getEmailsForContactById($mail->contact_id);
        
        $response['status'] = true;
        $response['emails'] = $contactEmails;
        $response['message'] = 'Email eliminado';
        return response()->json($response);
    }
}
