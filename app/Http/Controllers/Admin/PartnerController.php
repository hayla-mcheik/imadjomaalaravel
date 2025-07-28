<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return response()->json([
'partners' => $partners
        ]);
    }
    
    public function store(Request $request)
    {

    }
    public function update(Request $request , $id)
    {

    }
    public function destroy($id)
    {

    }
}
