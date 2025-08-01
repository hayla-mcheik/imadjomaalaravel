<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-email', function() {
    $contact = App\Models\Contact::first();
    Mail::to('mcheikhayla26@gmail.com')->send(new App\Mail\ContactFormNotification($contact));
    return 'Test email sent';
});