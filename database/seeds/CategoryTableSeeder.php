<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie = [
            [
                'id'    => 1,
                'name' => 'Legume',
                'added_by_id' => 1,
                'approved' => 1,
                'approved_by_id' => 1,
            ],
            [
                'id'    => 2,
                'name' => 'Fructe',
                'added_by_id' => 1,
                'approved' => 1,
                'approved_by_id' => 1,
            ]
        ];

        Category::insert($categorie);
    }
}
