<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->data();

        foreach ($data as $item) {
            User::create(
                $item
            );
        }
    }

    public function data()
    {
        return [
            [
                'name' => 'John Doe',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin123'),
                'role' => 'ADMIN'
            ],
        ];
    }
}
