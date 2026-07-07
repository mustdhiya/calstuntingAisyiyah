<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usersData = [
            [
                'name'         => 'Admin SiCegah',
                'email'        => 'admin@sicegah.id',
                'phone_number' => '0811-1111-0000',
                'role'         => 'admin_wilayah',
                'city'         => 'Samarinda',
                'is_active'    => true,
            ],
            [
                'name'         => 'Khalida Aisyah',
                'email'        => 'khalida@sicegah.id',
                'phone_number' => '0812-3456-7890',
                'role'         => 'koordinator_cabang',
                'city'         => 'Balikpapan',
                'is_active'    => true,
            ],
            [
                'name'         => 'Rina Nurul',
                'email'        => 'rina@sicegah.id',
                'phone_number' => '0821-1234-5678',
                'role'         => 'kader_lapangan',
                'city'         => 'Balikpapan',
                'is_active'    => true,
            ],
            [
                'name'         => 'Ahmad Umar',
                'email'        => 'ahmad@example.com',
                'phone_number' => '0851-9876-5432',
                'role'         => 'pengguna_umum',
                'city'         => 'Kutai Kartanegara',
                'is_active'    => false,
            ],
            [
                'name'         => 'Siti Aminah',
                'email'        => 'siti.aminah@sicegah.id',
                'phone_number' => '0813-9876-5432',
                'role'         => 'kader_lapangan',
                'city'         => 'Samarinda',
                'is_active'    => true,
            ],
            [
                'name'         => 'Budi Santoso',
                'email'        => 'budi.santoso@sicegah.id',
                'phone_number' => '0812-9988-7766',
                'role'         => 'koordinator_cabang',
                'city'         => 'Bontang',
                'is_active'    => true,
            ],
            [
                'name'         => 'Dewi Lestari',
                'email'        => 'dewi.lestari@sicegah.id',
                'phone_number' => '0852-1122-3344',
                'role'         => 'kader_lapangan',
                'city'         => 'Kutai Timur',
                'is_active'    => true,
            ],
            [
                'name'         => 'Eko Prasetyo',
                'email'        => 'eko.prasetyo@example.com',
                'phone_number' => '0877-5566-7788',
                'role'         => 'pengguna_umum',
                'city'         => 'Penajam Paser Utara',
                'is_active'    => true,
            ],
            [
                'name'         => 'Fatmawati',
                'email'        => 'fatmawati@sicegah.id',
                'phone_number' => '0813-4455-6677',
                'role'         => 'kader_lapangan',
                'city'         => 'Paser',
                'is_active'    => true,
            ],
            [
                'name'         => 'Hendra Wijaya',
                'email'        => 'hendra.wijaya@sicegah.id',
                'phone_number' => '0812-7788-9900',
                'role'         => 'koordinator_cabang',
                'city'         => 'Berau',
                'is_active'    => true,
            ],
            [
                'name'         => 'Ika Kartika',
                'email'        => 'ika.kartika@sicegah.id',
                'phone_number' => '0822-3344-5566',
                'role'         => 'kader_lapangan',
                'city'         => 'Kutai Barat',
                'is_active'    => true,
            ],
            [
                'name'         => 'Joko Widodo',
                'email'        => 'joko.widodo@example.com',
                'phone_number' => '0811-2233-4455',
                'role'         => 'pengguna_umum',
                'city'         => 'Mahakam Ulu',
                'is_active'    => true,
            ],
            [
                'name'         => 'Lia Ananda',
                'email'        => 'lia.ananda@sicegah.id',
                'phone_number' => '0812-8877-6655',
                'role'         => 'kader_lapangan',
                'city'         => 'Samarinda',
                'is_active'    => true,
            ],
            [
                'name'         => 'Muhammad Yusuf',
                'email'        => 'muhammad.yusuf@sicegah.id',
                'phone_number' => '0813-1122-3344',
                'role'         => 'kader_lapangan',
                'city'         => 'Balikpapan',
                'is_active'    => true,
            ],
            [
                'name'         => 'Novianti',
                'email'        => 'novianti@example.com',
                'phone_number' => '0853-4455-6677',
                'role'         => 'pengguna_umum',
                'city'         => 'Bontang',
                'is_active'    => true,
            ],
        ];

        $roles = ['admin_wilayah', 'koordinator_cabang', 'kader_lapangan', 'pengguna_umum'];
        $cities = [
            'Samarinda', 'Balikpapan', 'Bontang', 'Kutai Kartanegara',
            'Kutai Timur', 'Kutai Barat', 'Berau', 'Paser',
            'Penajam Paser Utara', 'Mahakam Ulu'
        ];

        for ($i = 0; $i < 35; $i++) {
            $role = fake()->randomElement($roles);
            $cityName = fake()->randomElement($cities);
            $firstName = fake()->firstName();
            $lastName = fake()->lastName();
            $name = $firstName . ' ' . $lastName;
            $email = strtolower($firstName . '.' . $lastName . '@' . (fake()->boolean(70) ? 'example.com' : 'sicegah.id'));

            if (collect($usersData)->contains('email', $email)) {
                $email = strtolower($firstName . '.' . $lastName . rand(10, 99) . '@example.com');
            }

            $usersData[] = [
                'name'         => $name,
                'email'        => $email,
                'phone_number' => '08' . fake()->numerify('##-####-####'),
                'role'         => $role,
                'city'         => $cityName,
                'is_active'    => fake()->boolean(85),
            ];
        }

        foreach ($usersData as $userData) {
            User::create(array_merge($userData, [
                'password' => Hash::make('password'),
            ]));
        }
    }
}