<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;

class PendaftaranExport implements FromCollection
{
    public function collection()
    {
        return Pendaftaran::all();
    }
}

