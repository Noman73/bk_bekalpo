<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
class LocationController extends Controller
{
    public function getModal()
    {
        $division=Division::all();
        return view('frontend.modal.location.location',compact('division'))->render();
    }
}
