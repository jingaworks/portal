<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Profile;
use App\Models\Certificate;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Region;
use App\Models\Place;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach(Region::all() as $region) {
            $places = Place::where('region_id', $region->id)
                    ->whereNotIn('tip', [40, 23])
                    ->whereNotIn('codp', [0])
                    ->inRandomOrder()
                    ->limit(3)
                    ->get();
            
            foreach($places as $place) {

                    $user = factory(User::class)->create();

                    $profile = factory(Profile::class)->create([
                        'created_by_id' => $user->id,
                        'region_id' => $place->region_id,
                        'place_id' => $place->id]);

                    factory(Certificate::class)->create([
                        'name' => $user->name,
                        'serie' => $place->region->mnemonic . '-' . mt_rand(1000000,9999999),
                        'valid_year' => '2020',
                        'profile_id' => $profile->id,
                        'created_by_id' => $user->id,
                        'region_id' => $place->region_id,
                        'place_id' => $place->id]);
                    
                    $subcategories = Subcategory::whereIn('category_id', [1, 2])->get();

                    foreach($subcategories as $subcategory) {

                        factory(Product::class)->create([
                            'category_id' => $subcategory->category_id,
                            'subcategory_id' => $subcategory->id,
                            'profile_id' => $profile->id,
                            'created_by_id' => $user->id,
                            'region_id' => $place->region_id,
                            'place_id' => $place->id]);
                    }
            }

        }
    }
}
