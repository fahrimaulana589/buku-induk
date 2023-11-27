<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Clas;
use App\Models\Evaluasi;
use App\Models\Father;
use App\Models\Guardian;
use App\Models\Lesson;
use App\Models\Mother;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\User;
use Chiiya\FilamentAccessControl\Database\Seeders\FilamentAccessControlSeeder;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Database\Factories\TestFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(FilamentAccessControlSeeder::class);

        $user = User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => FilamentUser::class,
            'model_id' => $user->id
        ]);

        Mother::factory(12)->create();
        Father::factory(12)->create();

        Student::factory(1)->create();
        Guardian::factory(1)->create();

        Teacher::factory(5)->create();
        Clas::factory(1)->create([
            'name' => 'Kelas 1'
        ]);
        Clas::factory(1)->create([
            'name' => 'Kelas 2'
        ]);
        Clas::factory(1)->create([
            'name' => 'Kelas 3'
        ]);
        Clas::factory(1)->create([
            'name' => 'Kelas 4'
        ]);
        Clas::factory(1)->create([
            'name' => 'Kelas 5'
        ]);
        Clas::factory(1)->create([
            'name' => 'Kelas 6'
        ]);

        Lesson::factory(1)->create([
            'name' => 'Matematika'
        ]);

        Lesson::factory(1)->create([
            'name' => 'Indonesia'
        ]);

        SchoolYear::factory(1)->create([
            'name' => '2022/2023'
        ]);

        Test::factory(1)->create([
            'name' => 'UN'
        ]);

        Test::factory(1)->create([
            'name' => 'US'
        ]);

        Evaluasi::factory()->create([
            'name' => 'Sikap'
        ]);
    }
}
