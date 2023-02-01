<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PrestamosExport implements FromView, ShouldAutoSize
{
    protected $prestamo, $detalles;

    public function __construct($prestamo, $detalles)
    {
        $this->prestamo = $prestamo;
        $this->detalles = $detalles;
    }

    public function view():View
    {
        $prestamo = $this->prestamo;
        $detalles = $this->detalles;
        return view("prestamo.export",compact('prestamo', 'detalles'));
    }
}

