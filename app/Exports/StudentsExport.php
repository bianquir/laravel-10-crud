<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromArray, WithHeadings
{
    protected $studentData;

    public function __construct(array $studentData)
    {
        $this->studentData= $studentData;
    }

    public function array(): array
    {
        $exportData = [];

        foreach ($this->studentData as $data) {
            $exportData[] = [
                $data['student']['dni'],
                $data['student']['name'],
                $data['student']['lastname'],
                $data['porcentaje_asistencia'], 
                $data['condicion'], 
            ];
    }

        return $exportData;
    }

    public function headings(): array
    {
        return [
            'DNI',
            'Nombre',
            'Apellido',
            'Asistencia (%)',
            'Condición'
        ];
    }
}


