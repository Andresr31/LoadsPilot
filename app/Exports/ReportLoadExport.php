<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use App\Models\LoadProduct;

class ReportLoadExport implements FromView, WithColumnWidths, WithStyles
{
    private $loadId;

    public function __construct($id)
    {
        $this->loadId = $id;
    }

    public function view(): View
    {
        return view('elements.loads.excel-loads', [
            'products' => LoadProduct::where('load_id',$this->loadId)->get()
        ]);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 18,
            'C' => 18,
            'D' => 18,
            'E' => 18,
            'F' => 18,
            'G' => 18,
            'H' => 18,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }
}
