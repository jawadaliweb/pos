<?php

namespace App\Imports;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Product::create([
                'product_name' => $row[0],
                'product_code' => $row[1],
                'category_id' => $row[2],
                'product_image' => $row[3],
            ]);
        }
    }
}