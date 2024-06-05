@extends('layouts.landing')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Condicion de estudiantes') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">ID_usuario</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">ip_Computer</th>
                                    <th scope="col">browser</th>
                                    <th scope="col">Realizado</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($loggings as $loggin)
                                    <tr>
                                        <td>{{ $loggin->id }}</td>
                                        <td>{{ $loggin->user_id }}</td>
                                        <td>{{ $loggin->action }}</td>
                                        <td>{{ $loggin->ip_computer}}</td>
                                        <td>{{$loggin->browser}}</td>
                                        <td>{{$loggin->created_at}}</td>
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
                    </div>
                </div>
            </div>    
        </div>
    </div>
</x-app-layout>
@endsection



