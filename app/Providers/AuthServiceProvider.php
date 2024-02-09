<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Clas;
use App\Models\Evaluasi;
use App\Models\Father;
use App\Models\Guardian;
use App\Models\Lesson;
use App\Models\Mother;
use App\Models\Note;
use App\Models\Report;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Test;
use App\Policies\ClasPolicy;
use App\Policies\EvaluasiPolicy;
use App\Policies\FatherPolicy;
use App\Policies\GuardPolicy;
use App\Policies\LessonPolicy;
use App\Policies\MotherPolicy;
use App\Policies\NotePolicy;
use App\Policies\ReportPolicy;
use App\Policies\SchoolYearPolicy;
use App\Policies\StudentPolicy;
use App\Policies\TeacherPolicy;
use App\Policies\TestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Father::class => FatherPolicy::class,
        Mother::class => MotherPolicy::class,
        Student::class => StudentPolicy::class,
        Clas::class => ClasPolicy::class,
        Teacher::class => TeacherPolicy::class,
        SchoolYear::class => SchoolYearPolicy::class,
        Evaluasi::class => EvaluasiPolicy::class,
        Note::class => NotePolicy::class,
        Test::class => TestPolicy::class,
        Lesson::class => LessonPolicy::class,
        Report::class => ReportPolicy::class,
        Guardian::class => GuardPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
