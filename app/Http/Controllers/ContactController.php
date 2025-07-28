<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
        public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'nullable|string|max:20',
            'message' => 'required|string|min:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        Contact::create($request->only(['name', 'email', 'contact', 'message']));

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting us! We will get back to you soon.'
        ]);
    }
}
