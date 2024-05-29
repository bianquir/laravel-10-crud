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
                return redirect()->route('students.findStudent')->withError('El DNI ingresado no pertenece a un estudiante');
            }
            
        }

        public function createAssist($id) {
            $fecha = date('Y-m-d');
            $student = Student::find($id);
            
            if($student) {
                // Verificar si ya existe una asistencia para este estudiante en la fecha actual
                $queryDate = Assist::where('student_id', $student->id)
                                   ->whereDate('created_at', $fecha)
                                   ->exists();
                                   
                if($queryDate) {
                    return redirect()->route('students.findStudent')->withError('Ya existe una asistencia para este día');
                } else {
                    Assist::create([
                        'student_id' => $student->id,
                    ]);
                    return redirect()->route('students.findStudent')->withSuccess('Asistencia cargada correctamente');
                }
            } else {
                return redirect()->route('students.findStudent')->withError('No existe el estudiante');
            }
        }
        
}

