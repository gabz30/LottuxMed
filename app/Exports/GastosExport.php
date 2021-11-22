<?php

namespace App\Exports;

use App\Models\gastos;
use Maatwebsite\Excel\Concerns\FromCollection;

class GastosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return gastos::select('id','caja_id','monto','concepto','comentario','created_at')->get();
    }
}
