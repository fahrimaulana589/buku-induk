<?php

namespace Database\Seeders;

use App\Models\Clas;
use App\Models\Evaluasi;
use App\Models\Father;
use App\Models\Guardian;
use App\Models\Lesson;
use App\Models\Mother;
use App\Models\Profile;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\User;
use App\Models\FilamentUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = [
            'admin-users.update',
            'permissions.update',
            "lesson.update",
            "teacher.update",
            "class.update",
            "schoolYear.update",
            "test.update",
            "evaluasi.update",
            "mother.update",
            "father.update",
            "guard.update",
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
            "guard.view",
            "student.view",
            "naik.view",
            "aktif.view",
            "lulus.view",
            "keluar.view",
            "report.view",
            "ganti-kelas-guru.view",
            "ganti-kelas-guru.update",
            "profile.update",
            "report.create",
            "report.delete",
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'filament',
            ]);
        }

        $admin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'filament',
        ]);

        foreach ($permissions as $permission) {
            $admin->givePermissionTo($permission);
        }

        $permissions = [
            "mother.view",
            "father.view",
            "guard.view",
            "student.view",
            "aktif.view",
            "lulus.view",
            "keluar.view",
            "report.view",
            "profile.update",
        ];

        $guru = Role::create([
            'name' => 'Guru',
            'guard_name' => 'filament',
        ]);

        foreach ($permissions as $permission) {
            $guru->givePermissionTo($permission);
        }

        $adminUser = User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'remember_token' => '111111',
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => $admin->id,
            'model_type' => FilamentUser::class,
            'model_id' => $adminUser->id
        ]);

        $guruUser = FilamentUser::factory()->create([
            'first_name' => 'guru',
            'last_name' => 'guru',
            'email' => 'guru@admin.com',
            'password' => Hash::make('guru'),
            'remember_token' => '11111q',
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => $guru->id,
            'model_type' => FilamentUser::class,
            'model_id' => $guruUser->id
        ]);

        $permissions = [
            "mother.view",
            "father.view",
            "guard.view",
            "student.view",
            "aktif.view",
            "lulus.view",
            "keluar.view",
            "report.view",
            "profile.update",
            "report.create",
        ];

        $waliMurid = Role::create([
            'name' => 'Wali Murid',
            'guard_name' => 'filament',
        ]);

        foreach ($permissions as $permission) {
            $waliMurid->givePermissionTo($permission);
        }

        Mother::factory(12)->create();
        Father::factory(12)->create();

        Student::factory(1)->create([
            'mother_id' => 1,
            'father_id' => 1,
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
        $guruUser->teachers()->sync([1]);

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
        ])->clas()->attach([1 => ['teacher_id' => 1,'day' => 1]]);

        Lesson::factory()->create([
            'name' => 'Indonesia'
        ])->clas()->attach([1 => ['teacher_id' => 1,'day' => 1]]);

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

        Profile::factory()->create([
           'id' => 1
        ]);
    }
}
