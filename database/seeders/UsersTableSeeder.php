<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'mohammed@gmail.com')->first();

        if (!$user) {
            User::create([
                'user_surname' => 'admin',
                'user_name_third' => 'admin',
                'user_type' => 'أدمن',
                'sex' => 'ذكر',
                'birthdate' => '2000-02-02',
                'birthplace' => 'صنعاء',
                'town' => 'صنعاء',
                'village' => 'صنعاء',
                'phone_number' => '777777777',
                'identity_type' => 'بطاقة شخصية',
                'identity_number' => '111111',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'//password
            ]);
        }
    }
}
