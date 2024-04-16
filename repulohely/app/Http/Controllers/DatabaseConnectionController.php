<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DatabaseConnectionController extends Controller
{
    public function index()
    {
        try {
            DB::connection()->getPdo();
            $connectionStatus = "Application is connected to the database.";
        } catch (\Exception $e) {
            $connectionStatus = "Could not connect to the database. Please check your configuration. Error: " . $e->getMessage();
        }

        return view('welcome', compact('connectionStatus'));
    }
}
