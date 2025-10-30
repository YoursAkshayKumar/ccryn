<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class AdminPasswordResets extends Model
{
  use HasFactory;
  protected $table = 'admin_password_resets';
  const CREATED_AT = 'created_at';

  public function add_rec($rQ)
  {
    $rtVal = $this->insertGetId([
      'email' => $rQ['email'],
      'token' => $rQ['token'],
      'created_at' => date('Y-m-d H:i:s'),
    ]);
    return $rtVal;
  }

  public function remove_by_email($email)
  {
    $rtVal = $this->where('email', $email)->delete();
    return $rtVal;
  }

  public function get_rec_by_email($email) {
    $rtVal = $this
              ->where('email', $email)
              ->first();
    return $rtVal;
  }

  public function get_rec_all()
  {
    $rtVal = $this->get();

    return $rtVal;
  }
}
