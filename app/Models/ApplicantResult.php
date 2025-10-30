<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantResult extends Model
{
    protected $table = 'applicant_results';
    protected $primaryKey = 'result_id';

    protected $fillable = [
        'result_id',
        'applicant_id',
        'result_title',
        'result_file_url',
        'remarks',
        'published_at',
        'created_at',
        'updated_at'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}
