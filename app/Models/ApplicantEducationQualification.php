<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantEducationQualification extends Model {
    protected $table = 'applicant_education_qualifications';
    protected $primaryKey = 'qualification_id';
    protected $fillable = [
        'qualification_id','applicant_id','qualification_name','examining_body','institution_name','course_start_year',
        'course_end_year','maximum_marks','obtained_marks','secured_percentage','cgpa','created_at','updated_at'
    ];
}