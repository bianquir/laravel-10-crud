@extends('layouts.landing')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configurar sistema') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <div class="float-start">
               
            </div>
            <div class="float-end">
                <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('parameters.store')}}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="days_classes" class="col-md-4 col-form-label text-md-end text-start">Dias de clases: </label>
                    <div class="col-md-6">
                      <input type="number" class="form-control @error('days_classes') is-invalid @enderror" id="days_classes" name="days_classes" value="{{old('days_classes')}}">
                        @if ($errors->has('days_classes'))
                            <span class="text-danger">{{ $errors->first('days_classes') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="promotion_percentage" class="col-md-4 col-form-label text-md-end text-start">Porcentaje promoción:</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control @error('promotion_percentage') is-invalid @enderror" id="promotion_percentage" name="promotion_percentage" value="{{old('promotion_percentage')}}">
                        @if ($errors->has('promotion_percentage'))
                            <span class="text-danger">{{ $errors->first('promotion_percentage') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="regular_percentage" class="col-md-4 col-form-label text-md-end text-start">Porcentaje regular</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control @error('regular_percentage') is-invalid @enderror" id="regular_percentage" name="regular_percentage" value="{{old('regular_percentaje')}}">
                        @if ($errors->has('regular_percentage'))
                            <span class="text-danger">{{ $errors->first('regular_percentage') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Configurar">
                </div>
                
            </form>
        </div>
    </div>
</div>    
</div>
</x-app-layout>
@endsection