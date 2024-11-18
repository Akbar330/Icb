<?php

namespace App\Exports;

use App\Models\Berita;
use Maatwebsite\Excel\Concerns\FromCollection;

class BeritaExport implements FromCollection
{
    public function collection()
    {
        return Berita::all();
    }
}

