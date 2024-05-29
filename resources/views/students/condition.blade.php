@extends('layouts.landing')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Condicion de estudiantes') }}
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
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <form action="{{ route('students.condition') }}" method="GET">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="year">Filtrar estudiantes por año:</label>
                                        <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                                            <option value="">Todos</option>
                                            @foreach ($years as $year)
                                                @if ($selectedYear == $year)
                                                    <option value="{{ $year }}" selected>{{ $year }}</option>
                                                @else
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('students.export') }}" class="btn btn-success btn-sm my-2">
                                    <i class="bi bi-file-earmark-arrow-down"></i> Descargar lista
                                </a>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Dni</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Asistencia(%)</th>
                                    <th scope="col">Condición</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($studentData as $data)
                                    <tr>
                                        <td>{{ $data['student']->dni }}</td>
                                        <td>{{ $data['student']->name }}</td>
                                        <td>{{ $data['student']->lastname }}</td>
                                        <td>{{ number_format($data['porcentaje_asistencia'],) }}%</td>
                                        <td>{{$data['condicion']}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <span class="text-danger">
                                                <strong>Ningún/a estudiante encontrado</strong>
                                            </span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $students->appends(['year' => $selectedYear])->links() }}
                    </div>
                </div>
            </div>    
        </div>
    </div>
</x-app-layout>
@endsection

