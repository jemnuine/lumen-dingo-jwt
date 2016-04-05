<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Hello.
     *
     * @return Response
     */
    public function index()
    {
        return 'Hello!';
    }
}
