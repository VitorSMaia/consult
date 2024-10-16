<?php

namespace App\Http\Controllers;

use App\Events\Contact;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\ContactRequest;
use App\Mail\SendContact;
use App\Models\MessageUser;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use PHPUnit\Util\Exception;


class GuestController extends Controller
{
    public function sendContactForm(ContactRequest $request)
    {
        try {
//            $request = $request->all();
//            $message = $request['message'];
//            unset($request['message']);
//
//            $userDB = User::query()->create([
//                'full_name' => $request['name'],
//                'email' => $request['email'],
//                'phone' => $request['phone'],
//                'password' => '!QAZ12331JVEJV89908',
//            ]);
//
//            $messsageDB = MessageUser::query()->create(attributes: [
//                'user_id' => $userDB->id,
//                'message' => $message
//            ]);


            Contact::dispatch('Vitor');


            session()->flash('messageContactFailed', 'Contato recebido com sucesso!');
            return back();
        }catch (Exception $exception) {
            Log::debug($exception);
            session()->flash('messageContactFailed', User::USER_REPOSITORY_CREATE_UPDATE_FAIL);
            return back();
        }catch (ValidationException $validationException) {
            session()->flash('messageContactFailed', $validationException->getMessage());
            return back();
        }
    }
}
