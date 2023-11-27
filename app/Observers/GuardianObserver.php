<?php

namespace App\Observers;

use App\Models\Guardian;
use App\Models\Student;

class GuardianObserver
{
    public function saving(Guardian $guardian): void
    {
        if ($guardian->type == 'ayah') {
            $murid = Student::find($guardian->student_id);
            if ($murid != null) {
                $guardian->name=$murid->father->name;
                $guardian->birth_place=$murid->father->birth_place;
                $guardian->birth_date=$murid->father->birth_date;
                $guardian->religion=$murid->father->religion;
                $guardian->citizenship=$murid->father->citizenship;
                $guardian->status='ayah';
                $guardian->phone=$murid->father->phone;
                $guardian->address=$murid->father->address;
            }
        }elseif ($guardian->type == 'ibu'){
            $murid = Student::find($guardian->student_id);
            if ($murid != null) {
                $guardian->name=$murid->mother->name;
                $guardian->birth_place=$murid->mother->birth_place;
                $guardian->birth_date=$murid->mother->birth_date;
                $guardian->religion=$murid->mother->religion;
                $guardian->citizenship=$murid->mother->citizenship;
                $guardian->status='ibu';
                $guardian->phone=$murid->mother->phone;
                $guardian->address=$murid->mother->address;
            }
        }
    }

}
