<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;


class Applicant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'applicants';
    protected $primaryKey = 'applicant_id';

    protected $fillable = [
        'applicant_id',
        'application_no',
        'username',
        'password',
        'applicant_name',
        'gender',
        'dob',
        'place_of_birth',
        'fathers_name',
        'category',
        'religion',
        'mobile_no',
        'aadhaar_no',
        'nationality',
        'enrollment_no',
        'roll_no',
        'highest_degree',
        'photo_url',
        'signature_url',
        'declaration',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function getAuthIdentifierName()
    {
        return 'application_no';
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function address()
    {
        return $this->hasOne(ApplicantAddress::class, 'applicant_id');
    }

    public function educations()
    {
        return $this->hasMany(ApplicantEducationQualification::class, 'applicant_id');
    }

    public function internship()
    {
        return $this->hasOne(ApplicantInternship::class, 'applicant_id');
    }

    public function documents()
    {
        return $this->hasMany(ApplicantUploadedDocument::class, 'applicant_id');
    }

    public function results()
    {
        return $this->hasMany(ApplicantResult::class, 'applicant_id');
    }

    public function statusSteps()
    {
        return $this->hasMany(ApplicationStatus::class);
    }

    public function getCount($whereData = array())
    {
        $query = $this;
        $rtVal = $query
            ->count();
        return $rtVal;
    }

    public function ajaxApplicantList($limit, $offset, $whereData = array(), $count = false, $orderInfo = array())
    {
        $where = "";
        $selectClause = "";
        $groupByClause = "";
        $limitClause = "";
        $orderClause = (count($orderInfo) > 0) ? " ORDER BY ap." . $orderInfo['orderByCol'] . " " . $orderInfo['orderByDir'] . " , ap.applicant_id " . $orderInfo['orderByDir'] . " "  : " ORDER BY ap.created_at desc, ap.applicant_id desc ";

        if ($count === true) {
            $joinClause = "";

            $selectClause = " COUNT(ap.applicant_id) as ApplicantCount FROM applicants as ap $joinClause WHERE 1=1";
            $groupByClause = "";
            $limitClause = "";
            $orderClause = "";
        } else {
            // DB::statement("SET SQL_MODE= 'STRICT_TRANS_TABLES,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
            $selectClause = " ap.*
                FROM applicants as ap 
                WHERE 1=1
            ";
            $groupByClause = "";
            $limitClause = " limit " . $limit . " offset " . $offset;
        }

        $sql = "SELECT " . $selectClause;
        if (isset($whereData['is_delete']) == true) {
            $where .= " AND ap.is_delete = " . $whereData['is_delete'];
        }

        if (isset($whereData['search']) == true && empty($whereData['search']) == false) {
            $where .= " AND LOWER(CONCAT(IFNULL(ap.first_name,'') , IFNULL(ap.last_name,''))) LIKE '%" . str_replace(' ', '', strtolower($whereData['search'])) . "%'";
            $where .= " OR ap.email LIKE '%" . $whereData['search'] . "%'";
            $where .= " OR ap.applicant_name LIKE '%" . $whereData['search'] . "%'";
            $where .= " OR ap.father_name LIKE '%" . $whereData['search'] . "%'";
            $where .= " OR ap.mobile LIKE '%" . $whereData['search'] . "%'";
        }

        $sql = $sql . $where . $groupByClause . $orderClause . $limitClause;
        // if ($count === true){
        //   print_r($sql); exit;
        // }
        $rtVal = DB::select($sql);
        return $rtVal;
    }

    public function getByAppNo($credentials)
    {
        if (isset($credentials['username'])) {
            $rtVal = $this->where('application_no', $credentials['username'])->first();
        } else {
            $rtVal = NULL;
        }

        return $rtVal;
    }

    public function remove($id)
    {
        $rtVal = $this->where('applicant_id', $id)->delete();
        return $rtVal;
    }

    // Applicant Model
}
