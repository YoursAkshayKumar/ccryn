<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantAddress extends Model {
    protected $table = 'applicant_addresses';
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'address_id','applicant_id','correspondence_country','correspondence_district','correspondence_house_no',
        'correspondence_pin_code','correspondence_police_station','correspondence_state','correspondence_village_locality',
        'created_at','is_address_same','permanent_country','permanent_district','permanent_house_no','permanent_pin_code',
        'permanent_police_station','permanent_state','permanent_village_locality','updated_at'

    ];
}