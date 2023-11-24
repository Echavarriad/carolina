<?php

namespace App\Excel;
  
use Maatwebsite\Excel\Concerns\FromCollection;
  
class ExportExcel implements FromCollection
{
    public $collection;
    public function __construct($collection) {
        $this->collection = $collection;

    }
    public function collection()
    {
        return $this->collection;
    }
}