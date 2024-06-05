<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChambreType;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roomTypes = ChambreType::all();

        // Passer les types de chambres à la vue
        return view('home', compact('roomTypes'));
      
    }
    public function chambres()
    {
        $roomTypes = ChambreType::all();
        return view('chambres', compact('roomTypes'));
    }
   
}
