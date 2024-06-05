<?php

namespace App\Http\Controllers;

use App\Models\Loggin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LogginController extends Controller
{
    public function index(){
        return view('students.logging', [
            'loggings'=> Loggin::latest()->paginate(10),
        ]);
    }
}
