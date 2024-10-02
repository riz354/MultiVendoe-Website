<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(AdminTableSeeder::class);
        $this->call(VendorsTableSeeder::class);
        $this->call(VendorBusinessDetailsTableSeeder::class);
        $this->call(VendorBankDetailsTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(AttributeTableSeeder::class);
        $this->call(ProductsFilterSeeder::class);
        $this->call(ProductsFilterValueSeeder::class);
        $this->call(CouponsSeeder::class);








    }
}
