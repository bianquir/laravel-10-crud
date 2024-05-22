@extends('layouts.landing')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marcar asistencia') }}
        </h2>
    </x-slot>
    @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif
    <div class="card">
        <div class="card-header text-center">
            Ingrese DNI del estudiante para marcar su asistencia
        </div>
        <div class="card-body text-center">
            <form action="{{route('students.encontrado')}}" method="POST" class="mx-auto" style="max-width: 300px;">
                @csrf
                <div class="mb-3">
                    <label for="dni" class="visually-hidden">DNI del estudiante:</label>
                    <input type="number" class="form-control" id="dni" placeholder="DNI" name= "dni" required>
                </div>
                <button type="submit" class="btn btn-primary">Buscar estudiante</button>
            </form>
        </div>
    </div>
</x-app-layout>
@endsection

