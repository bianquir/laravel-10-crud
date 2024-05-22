@extends('layouts.landing')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de alumnos') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        @if(!empty($birthdays) && count($birthdays) > 0)
            <div class="alert alert-success">
                <strong>¡Deseale un FELIZ CUMPLEAÑOS! a:</strong>
                <ul>
                    @foreach($birthdays as $studentBirthday)
                        <li>{{ $studentBirthday->name}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('students.create') }}" class="btn btn-success btn-sm my-2">
                            <i class="bi bi-plus-circle"></i> Add New Student
                        </a>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">S#</th>
                                    <th scope="col">Dni</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Lastname</th>
                                    <th scope="col">Birthdate</th>
                                    <th scope="col">Cluster</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    <tr>
                                        <th scope="row">{{ $student->id }}</th>
                                        <td>{{ $student->dni }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->lastname }}</td>
                                        <td>{{ $student->Birthdate }}</td>
                                        <td>{{ $student->cluster }}</td>
                                        <td>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-eye"></i> Show
                                                </a>
                                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this student?');">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                                <a href="{{ route('students.assists', $student->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-eye"></i> Assists
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <span class="text-danger">
                                                <strong>No Student Found!</strong>
                                            </span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $students->links() }}
                    </div>
                </div>
            </div>    
        </div>
    </div>
</x-app-layout>
@endsection
