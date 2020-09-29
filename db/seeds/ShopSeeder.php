<?php


use Phinx\Seed\AbstractSeed;

class ShopSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $sql = 'TRUNCATE products';
        $this->adapter->query($sql);
        $sql = 'TRUNCATE cart';
        $this->adapter->query($sql);
        $sql = 'TRUNCATE feedback';
        $this->adapter->query($sql);
        $sql = 'TRUNCATE orders';
        $this->adapter->query($sql);


        $products = [
            [
                'name'=>'Пельмени',
                'description' => 'С мясом',
                'price' => 150,
            ],
            [
                'name'=>'Торт',
                'description' => 'Бисквитный',
                'price' => 100,
                'image' => 'tort.jpg',
            ],
            [
                'name'=>'Сыр',
                'description' => 'С плесенью',
                'price' => 450,
            ],
            [
                'name'=>'Вода',
                'description' => 'Без газа',
                'price' => 20,
            ],
            [
                'name'=>'Сок',
                'description' => 'Апельсиновый',
                'price' => 50,
            ],
        ];

        $this->table('products')->insert($products)->save();

        $sql = 'TRUNCATE users';
        $this->adapter->query($sql);


        $users = [
            [
                'login' => 'admin',
                'pass' => password_hash('123', PASSWORD_DEFAULT),
                'role' => 1,
            ],
            [
                'login' => 'user',
                'pass' => password_hash('123', PASSWORD_DEFAULT),
                'role' => 2,
            ]
        ];

        $this->table('users')->insert($users)->save();

    }
}
