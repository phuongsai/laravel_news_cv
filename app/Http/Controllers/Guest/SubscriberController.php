<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailValidationRequest;
use App\Models\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    public function store(EmailValidationRequest $request)
    {
        $message = '';
        try {
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();
            $message = 'Successfully added. Thanks!';
        } catch (\Exception $e) {
            $message = 'error';
            return response()->json($message, 500);
        }
        return response()->json($message, 200);
    }
}
