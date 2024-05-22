<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index() : View
    {
        $students = Student::latest()->paginate(3);
        $birthdays = $this->rememberBirthday();
        
        return view('students.index', [
            'students' => $students,
            'birthdays' => $birthdays,
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


}
