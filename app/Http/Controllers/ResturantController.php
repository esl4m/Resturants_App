<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResturantController extends Controller
{
    /**
     * Instantiate a new controller Resturant.
     *
     * @return void
     */
    public function __construct()
    {
        if (config('resturants_obj.restaurants')) {
            $this->my_resturants = config('resturants_obj.restaurants');
        }
        else {
            return dd('error, or file not found');
        }
    }

    /**
     * Display a list of resturants.
     * 
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        if ($this->my_resturants) {
            return view('resturants', ['all_resturants' => $this->my_resturants]);
        }
    }
}
