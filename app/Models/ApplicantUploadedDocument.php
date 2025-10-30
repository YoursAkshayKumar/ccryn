<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantUploadedDocument extends Model {
    protected $table = 'applicant_uploaded_documents';
    protected $primaryKey = 'document_id';
    protected $fillable = ['document_id','applicant_id','document_name','file_url','created_at','updated_at'];
}