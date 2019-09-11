<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class HomeController extends Controller
{
    private $settings;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Setting $settings)
    {
        $this->middleware('auth');
        $this->settings = $settings;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $settings = $this->settings->all()->first();
        session()->put('settings', $settings);
        return view('home');
    }
}
