<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Assist;
use App\Models\Parameter;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class StudentController extends Controller
{
    public function __construct()
    {
        // Aplicar el middleware 'loggin' solo a las rutas específicas
        $this->middleware('loggin')->only(['store', 'update', 'destroy']);

        //$this->middleware('loggin: edit')->only(['store']);
        //$this->middleware('loggin: update')->only(['update']);
        //$this->middleware('loggin: delete')->only(['destroy']);


    }
    public function index(Request $request) : View
    {
        $filterResults = $this->filterByYear($request);
        $students = $filterResults['studentsQuery']->paginate(5);
    
        $birthdays = $this->rememberBirthday();
    
        return view('students.index', [
            'students' => $students,
            'birthdays' => $birthdays,
            'selectedYear' => $filterResults['selectedYear'],
            'years' => $filterResults['years']
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request) : RedirectResponse
    {
        Student::create($request->all());
        return redirect()->route('students.index')
                ->withSuccess('New student is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student) : View
    {
        return view('students.show', [
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student) : View
    {
        return view('students.edit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student) : RedirectResponse
    {
        $student->update($request->all());
        return redirect()->back()
                ->withSuccess('Student is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student) : RedirectResponse
    {
        $student->delete();
        return redirect()->route('students.index')
                ->withSuccess('Student is deleted successfully.');
    }
    
    public function asistencia($id)
    {
        $student = Student::find($id);
        $asistencias = $student->assist; 
        
        
        return view('students.assist', compact('student', 'asistencias'));
    }

    public function rememberBirthday()
    {
        $dateNow = Carbon::now()->format('m-d');
        $birthdays = [];
        $students = Student::select('name', 'Birthdate')->get();

        if ($students) {
            foreach ($students as $student) {
                $studentBirthdate = Carbon::parse($student->Birthdate)->format('m-d');
                if ($studentBirthdate === $dateNow) {
                    $birthdays[] = $student;
                }
            }
        }

        return $birthdays;
    }

    public function filterByYear(Request $request)
    {
        $selectedYear = $request->input('year');
        
        $years = [];
        $results = Student::select('year')->distinct()->orderBy('year')->get();
    
        foreach ($results as $result){
            $years[] = $result->year; 
        }
        
        if ($selectedYear) {
            $studentsQuery = Student::where('year', $selectedYear);
        } else {
            $studentsQuery = Student::latest();
        }
        
        return compact('studentsQuery', 'years', 'selectedYear');
    }

    public function condition(Request $request)
    {
        $dias_clases = Parameter::select('days_classes')->first()->days_classes;
        $porcentaje_promocion = Parameter::select('promotion_percentage')->first()->promotion_percentage;
        $porcentaje_regular = Parameter::select('regular_percentage')->first()->regular_percentage;

        
        $filterResults = $this->filterByYear($request);
        $students = $filterResults['studentsQuery']->get();
    
      
        $studentData = [];
    
        foreach ($students as $student) {
            $total_assists = Assist::where('student_id', $student->id)->count();
        
            $porcentaje_asistencia = ($total_assists / $dias_clases) * 100;
        
            if ($porcentaje_asistencia >= $porcentaje_promocion) {
                $condicion = 'Promoción';
            } elseif ($porcentaje_asistencia >= $porcentaje_regular) {
                $condicion = 'Regular';
            } else {
                $condicion = 'Libre';
            }
        
           $studentData[] = [
                'student' => $student,
                'porcentaje_asistencia' => $porcentaje_asistencia, 
                'condicion' => $condicion
            ];
        }
    
        return view('students.condition', [
            'studentData' => $studentData,
            'students' => $students,
            'selectedYear' => $filterResults['selectedYear'],
            'years' => $filterResults['years']
        ]);
    }
    
    public function export(Request $request)
    {   
        $condicion= $this->condition($request);
        $data= $condicion['studentData'];
       
        return Excel::download(new StudentsExport($data), 'students.xlsx');
    }
}
