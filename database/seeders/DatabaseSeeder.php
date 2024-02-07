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
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(FilamentAccessControlSeeder::class);

        $permissions = [
            "lesson.update",
            "teacher.update",
            "class.update",
            "schoolYear.update",
            "test.update",
            "evaluasi.update",
            "mother.update",
            "father.update",
            "Guard.update",
            "student.update",
            "naik.update",
            "aktif.update",
            "lulus.update",
            "keluar.update",
            "report.update",
            "lesson.view",
            "teacher.view",
            "class.view",
            "schoolYear.view",
            "test.view",
            "evaluasi.view",
            "mother.view",
            "father.view",
            "Guard.view",
            "student.view",
            "naik.view",
            "aktif.view",
            "lulus.view",
            "keluar.view",
            "report.view"
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'filament',
            ]);
        }

        $role = Role::find(1);

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        $user = User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'remember_token' => '111111',
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => FilamentUser::class,
            'model_id' => $user->id
        ]);

        Mother::factory(12)->create();
        Father::factory(12)->create();

        Student::factory(1)->create([
            'mother_id' => 1,
            'father_id' => 1
        ]);

        Student::factory(1)->create([
            'mother_id' => 2,
            'father_id' => 2
        ]);

        Student::factory(1)->create([
            'mother_id' => 2,
            'father_id' => 2
        ]);

        Guardian::factory(1)->create([
            'student_id' => 1
        ]);

        Teacher::factory(5)->create();

        Clas::factory(1)->create([
            'name' => 'Kelas 1',
            'teacher_id' => '1'
        ]);
        Clas::factory(1)->create([
            'name' => 'Kelas 2',
            'teacher_id' => '1'
        ]);
        Clas::factory(1)->create([
            'name' => 'Kelas 3',
            'teacher_id' => '1'
        ]);
        Clas::factory(1)->create([
            'name' => 'Kelas 4',
            'teacher_id' => '1'
        ]);
        Clas::factory(1)->create([
            'name' => 'Kelas 5',
            'teacher_id' => '1'
        ]);
        Clas::factory(1)->create([
            'name' => 'Kelas 6',
            'teacher_id' => '1'
        ]);

        Lesson::factory()->create([
            'name' => 'Matematika'
        ])->clas()->attach([1 => ['teacher_id' => 1]]);

        Lesson::factory()->create([
            'name' => 'Indonesia'
        ])->clas()->attach([1 => ['teacher_id' => 1]]);

        SchoolYear::factory()->create([
            'name' => '2022/2023'
        ]);

        Test::factory()->create([
            'name' => 'UN'
        ]);

        Test::factory()->create([
            'name' => 'US'
        ]);

        Evaluasi::factory()->create([
            'name' => 'Sikap'
        ]);
    }
}
