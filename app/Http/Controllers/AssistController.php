<?php

namespace App\Http\Controllers;

use App\Models\Assist;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssistController extends Controller
{
    //

    public function mostrarVista():View
        {
            return view('students.findStudent');
        }

        public function buscarStudent(Request $request)
        {
            $dni = $request->input('dni');
            $student = Student::where('dni', $dni)->first();
            
            if($student){
                return view('students.checkAssist', compact('student'));
            }else{
                return('No existe');
            }
            

        }

        public function createAssist($id){
            $student= Student::find($id);
            if($student){
                Assist::create([
                    'student_id' => $student->id,
                ]);
                return ('asistencia cargada');
            }
        }
    
}

