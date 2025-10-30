<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'step_no',
        'step_name',
        'status',
        'remarks',
        'query_text',
        'response_text',
        'query_date',
        'response_date',
        'download_link',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
