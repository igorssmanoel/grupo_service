<?php

namespace App\Controller;

use App\Model\Tournament;

final class AppController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::with(['winner', 'status'])->get();
        return self::view('index', ['tournaments' => $tournaments]);
    }
}
