<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * ! HOME
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

	/**
     * ! DASHBOARD
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin_index()
    {
        return view('admin.dashboard');
    }


	/**
     * ! ADVANCED SEARCH
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search()
    {
        return view('guest.profiles.search'); // CRUD index profiles 
    }

}
