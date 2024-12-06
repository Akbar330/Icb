<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PendaftaranExport implements FromView
{
    public function view():view{
        return view('docs.excel',[
            'pendaftarans' => Pendaftaran::all()
        ]);
    }
}

