<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantInternship extends Model {
    protected $table = 'applicant_internships';
    protected $primaryKey = 'internship_id';
    protected $fillable = [
        'internship_id','applicant_id','organization_name','address','district','internship_start','internship_end',
        'created_at','updated_at'
    ];
}
