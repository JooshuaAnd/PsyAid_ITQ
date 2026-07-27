<?php

namespace App\Controllers;

class LandingController extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'PsyAid - Disaster Mental Health Command Center',
            'isLoggedIn' => session()->get('logged_in') ?? false,
            'role' => session()->get('role') ?? null,
            'poskoId' => session()->get('posko_id') ?? null,
        ];

        return view('landing/index', $data);
    }
//    public function index()
//     {
//         helper('url');

//         return view('landing/index', [
//             'title' => 'PsyAid Test'
//         ]);
//     }

}
