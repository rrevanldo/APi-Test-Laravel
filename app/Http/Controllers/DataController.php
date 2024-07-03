<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DataController extends Controller
{
    public function push(Request $request)
    {
        $data = Session::get('data', []);
        $data[] = $request->all();
        Session::put('data', $data);
        return response()->json(end($data), 200);
    }

    public function pull()
    {
        $data = Session::get('data', []);
        return response()->json(['total' => count($data), 'data' => $data], 200);
    }

    public function clear()
    {
        Session::forget('data');
        return response()->json(null, 200);
    }
}