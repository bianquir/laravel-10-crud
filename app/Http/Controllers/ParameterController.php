<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParameterRequest;
use App\Http\Requests\UpdateParameterRequest;
use App\Models\Parameter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    public function index(): View
    {
        return view('students.config');
    }
    
    public function store(StoreParameterRequest $request): RedirectResponse
    {
        $parameter = Parameter::first();

        if ($parameter) {
            return $this->update($request, $parameter);
        } else {
            Parameter::create($request->all());
            return redirect()->route('students.index')
                ->withSuccess('Configuración establecida');
        }
    }

    public function update(Request $request, Parameter $parameter): RedirectResponse
    {
        $parameter->update($request->all());
        return redirect()->route('students.index')
            ->withSuccess('Configuración actualizada');
    }
}


//new UpdateParameterRequest($request->all()), $parameter

