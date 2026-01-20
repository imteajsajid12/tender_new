<?php

namespace App\Exports;
use App;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormsExport implements FromCollection, WithHeadings
{
    use Exportable;
    private $data;
    private $headings;

    public function __construct()
    {
        $this->data = App\Applications::get_export_data();
        $this->headings = App\Applications::get_export_headings();
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return $this->headings;
    }

}