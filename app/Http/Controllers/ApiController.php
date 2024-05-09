<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class ApiController extends Controller
{
    public function condition($id){
        $resultado='';
        $student= Student::find($id);
        $cant = count($student->assist); 
       

        $condicion=($cant/5)*100;

        if ($condicion >= 80){
            $resultado= "Promoción";
        }
        if ($condicion >= 60 && $condicion <80){
           $resultado= "Regular";
        }
        if ($condicion < 60){
            $resultado= "Libre";
        }

        return( 'Condicion: '.$resultado);
       
    }
}

