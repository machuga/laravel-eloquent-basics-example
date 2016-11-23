<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        \DB::table('user_roles')->truncate();
        \DB::table('orders')->truncate();
        \DB::table('products')->truncate();
        \DB::table('order_product')->truncate();

        \DB::table('users')->insert(
            array_map(function($i) {
                return [
                    'name' => "User $i",
                    'email' => "user$i@example.com",
                    'user_role_id' => ($i % 3) + 1,
                ];
            }, range(1, 10))
        );

        \DB::table('products')->insert(
            array_map(function($i) {
                return [
                    'sku' => $i + 10000,
                    'name' => "Product $i",
                    'description' => "This is Product $i"
                ];
            }, range(1, 10))
        );

        \DB::table('user_roles')->insert([
            ['name' => 'Buyer'],
            ['name' => 'Admin'],
            ['name' => 'Moderator']
        ]);

        // Maybe change this to user orders, order_products, then link w/ 2-4
        // orders per user
        \DB::table('orders')->insert(
            array_reduce(range(1, 10), function($a, $i) {
                return array_merge($a, [['user_id' => $i], ['user_id' => $i]]);
            }, [])
        );

        \DB::table('order_product')->insert(
            array_reduce(range(1, 10), function($a, $i) {
                return array_merge($a, array_map(function($id) use ($i) {
                    return [
                        'order_id' => $i,
                        'product_id' => $id
                    ];
                }, $this->uniqueIds(rand(3, 6))));
            }, [])
        );
    }

    protected function randNum($max = 10) {
        return rand(1, $max);
    }

    protected function uniqueIds($count = 3) {
        return array_unique(array_map(function($num) {
            return $this->randNum();
        }, range(1, $count)));
    }
}
