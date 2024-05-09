@extends('layouts.landing')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marcar asistencia') }}
        </h2>
    </x-slot>
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Dni</th>
                        <th scope="col">Name</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Birthdate</th>
                        <th scope="col">Cluster</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">{{ $student->id }}</th>
                            <td>{{ $student->dni }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->lastname }}</td>
                            <td>{{ $student->Birthdate }}</td>
                            <td>{{$student->cluster}}</td>
                            <td>
                                <form action="{{route('assist.insert', $student->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary ml-3">Enviar Asistencia</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>
</x-app-layout>
@endsection