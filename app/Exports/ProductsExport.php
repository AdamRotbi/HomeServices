<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // return Product::select('name', 'category_id', 'description', 'price', 'image')->get();
        return Product::select('name','description','price','image')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            // 'Category ID',
            'Description',
            'Price',
            'Image',
        ];
    }
}