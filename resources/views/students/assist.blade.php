@extends('layouts.landing')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">


        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <div class="card" >
            <div class="card-header">
                <div class="float-start">
                    <h5 class="card-title">Assists for {{ $student->name }}</h5>
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive"> 
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($asistencias as $asistencia)
                                <tr>
                                    <td>{{ date_format($asistencia->created_at, "d-m-Y") }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No assists found for this student.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>    
</div>
@endsection