<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class firstController extends Controller {

    public function index()
    {
        return view('first.home');
    }

    public function about() {
        return view('first.about');
    }

}
