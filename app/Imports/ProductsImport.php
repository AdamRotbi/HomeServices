<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $category = Category::find($row['category_id']);
        if (!$category) {
            return null;
        }

        $product = Product::where('name', $row['name'])->first();
        if ($product) {
            return null;
        }

        if (!asset('storage/images/' . $row['image'])) {
            return new Product([
                'name'          => $row['name'],
                'category_id'   => $row['category_id'],
                'description'   => $row['description'],
                'price'         => $row['price'],
                'image'         => "noImage",
            ]);
        }

        return new Product([
            'name'          => $row['name'],
            'category_id'   => $row['category_id'],
            'description'   => $row['description'],
            'price'         => $row['price'],
            'image'         => $row['image'],
        ]);
    }
}