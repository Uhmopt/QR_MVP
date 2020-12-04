<?php

use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plan')->insert([
            'name' => 'Free',
            'limit_items'=>30,
            'price'=>0,
            'paddle_id'=>"",
            'description'=>"If you run a small restaurant or bar, or just need the basics, this plan is great.",
            'features'=>"Full access to QR tool, Full access to the menu creation tool, Unlimited views, 20 items in the menu, Community support",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('plan')->insert([
            'name' => 'Pro',
            'limit_items'=>0,
            'price'=>9,
            'paddle_id'=>"",
            'description'=>"For bigger restaurants and bars. Offer a full menu. Limitless plan",
            'features'=>"Full access to QR tool, Full access to the menu creation tool, Unlimited views, Unlimited items in the menu, Dedicated Support",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('plan')->insert([
            'name' => 'Pro yearly',
            'limit_items'=>0,
            'price'=>87,
            'paddle_id'=>"",
            'period'=>2,
            'description'=>"Same as PRO, with a 20% discount. Enjoy your QR menu full year.",
            'features'=>"Full access to QR tool, Full access to the menu creation tool, Unlimited views, Unlimited items in the menu, Dedicated Support",
            'created_at' => now(),
            'updated_at' => now()
        ]);

       
    }
}
