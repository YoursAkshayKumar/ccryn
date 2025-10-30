<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class ApplicantAuth extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'applicants';
    protected $primaryKey = 'applicant_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'applicant_id','application_no','username','password','applicant_name','gender','dob','place_of_birth','fathers_name','category','religion','mobile_no','aadhaar_no','nationality','enrollment_no',
        'roll_no','highest_degree','photo_url','signature_url','declaration','created_at','updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            // Only hash if it's not already a bcrypt hash
            if (\Illuminate\Support\Facades\Hash::needsRehash($value)) {
                $this->attributes['password'] = \Illuminate\Support\Facades\Hash::make($value);
            } else {
                $this->attributes['password'] = $value;
            }
        }
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
}
