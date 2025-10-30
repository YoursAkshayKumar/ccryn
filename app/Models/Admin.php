<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Admin extends Model
{
  use HasFactory;
  protected $table = 'admin';
  protected $primaryKey = 'admin_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  public $timestamps = false;

  public function insertRec($_Request_Data)
  {
    $rtVal = $this->insertGetId([
      'first_name' => $_Request_Data['first_name'],
      'last_name' => $_Request_Data['last_name'],
      'username' => $_Request_Data['username'],
      'email' => $_Request_Data['email'],
      'password' => $_Request_Data['password_hash'],
      'password_text' => $_Request_Data['password'],
      'mobile' => $_Request_Data['mobile'],
      'gender' => isset($_Request_Data['gender']) ? $_Request_Data['gender'] : '',
      'created_on' => date('Y-m-d H:i:s'),
      'image' => isset($_Request_Data['image']) ? $_Request_Data['image'] : '',
    ]);
    return $rtVal;
  }

  public function updateRec($_Request_Data)
  {
    $data = array(
      'first_name' => $_Request_Data['first_name'],
      'last_name' => $_Request_Data['last_name'],
      'username' => $_Request_Data['username'],
      'email' => $_Request_Data['email'],
      'mobile' => $_Request_Data['mobile'],
      'gender' => isset($_Request_Data['gender']) ? $_Request_Data['gender'] : '',
      'updated_on' => date('Y-m-d H:i:s'),
      'image' => $_Request_Data['image'],
    );
    if (isset($_Request_Data['password']) && !empty($_Request_Data['password'])) {
      $data['password'] = password_hash($_Request_Data['password'], PASSWORD_DEFAULT);
      $data['password_text'] = $_Request_Data['password'];
    }
    $rtVal = $this
      ->where('admin_id', $_Request_Data['admin_id'])
      ->update($data);
    return $rtVal;
  }

  public function remove($id)
  {
    $rtVal = $this->where('admin_id', $id)->delete();
    return $rtVal;
  }

  public function get_by_auth($credentials)
  {
    if (isset($credentials['email'])) {
      $rtVal = $this->where('email', $credentials['email'])->first();
    } else if (isset($credentials['username'])) {
      $rtVal = $this->where('username', $credentials['username'])->first();
    }

    return $rtVal;
  }

  public function getRec($id)
  {
    $rtVal = $this->find($id);
    return $rtVal;
  }

  public function getRecByEmail($email)
  {
    $rtVal = $this
      ->where('email', $email)
      ->first();
    return $rtVal;
  }

  public function getRecByUsername($username)
  {
    $rtVal = $this
      ->where('username', $username)
      ->first();
    return $rtVal;
  }

  public function updateLastLogin($_Request_Data)
  {
    $data = array(
      'last_login' => date('Y-m-d H:i:s')
    );
    $rtVal = $this
      ->where('admin_id', $_Request_Data['admin_id'])
      ->update($data);
    return $rtVal;
  }

  public function updateImage($_Request_Data)
  {
    $data = array(
      'updated_on' => date('Y-m-d H:i:s'),
      'image' => $_Request_Data['image'],
    );
    $rtVal = $this
      ->where('admin_id', $_Request_Data['admin_id'])
      ->update($data);
    return $rtVal;
  }

  public function getRecAll()
  {
    $rtVal = $this->get();
    return $rtVal;
  }

  public function getCount($whereData = array())
  {
    $isDelete = 0;
    $query = $this;
    if (isset($whereData)) {
      if (isset($whereData['is_delete']) == true && empty($whereData['is_delete']) == false) {
        $isDelete =  $whereData['is_delete'];
      }
    }

    $rtVal = $query
      ->where('is_delete', $isDelete)
      ->count();
    return $rtVal;
  }

  public function ajaxAdminList($limit, $offset, $whereData = array(), $count = false, $orderInfo = array())
  {
    $where = "";
    $selectClause = "";
    $groupByClause = "";
    $limitClause = "";
    $orderClause = (count($orderInfo) > 0) ? " ORDER BY ad." . $orderInfo['orderByCol'] . " " . $orderInfo['orderByDir'] . " , ad.admin_id " . $orderInfo['orderByDir'] . " "  : " ORDER BY ad.created_on desc, ad.admin_id desc ";

    if ($count === true) {
      $joinClause = "";

      $selectClause = " COUNT(ad.admin_id) as AdminCount FROM admin as ad $joinClause WHERE 1=1";
      $groupByClause = "";
      $limitClause = "";
      $orderClause = "";
    } else {
      // DB::statement("SET SQL_MODE= 'STRICT_TRANS_TABLES,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
      $selectClause = " ad.admin_id,
      ad.first_name,
      ad.last_name,
      ad.username,
      ad.email,
      ad.password,
      ad.password_text,
      ad.mobile,
      ad.gender,
      ad.image,
      ad.created_on,
      ad.updated_on,
      ad.last_login,
      ad.type,
      ad.is_delete,
      ad.deleted_on,
      ad.token,
      ad.remember_token,
      ad.token_expires
        FROM admin as ad 
        WHERE 1=1
      ";
      $groupByClause = "";
      $limitClause = " limit " . $limit . " offset " . $offset;
    }

    $sql = "SELECT " . $selectClause;
    if (isset($whereData['is_delete']) == true) {
      $where .= " AND ad.is_delete = " . $whereData['is_delete'];
    }

    if (isset($whereData['search']) == true && empty($whereData['search']) == false) {
      $where .= " AND LOWER(CONCAT(IFNULL(ad.first_name,'') , IFNULL(ad.last_name,''))) LIKE '%" . str_replace(' ', '', strtolower($whereData['search'])) . "%'";
      $where .= " OR ad.email LIKE '%" . $whereData['search'] . "%'";
      $where .= " OR ad.first_name LIKE '%" . $whereData['search'] . "%'";
      $where .= " OR ad.last_name LIKE '%" . $whereData['search'] . "%'";
      $where .= " OR ad.mobile LIKE '%" . $whereData['search'] . "%'";
    }

    $sql = $sql . $where . $groupByClause . $orderClause . $limitClause;
    // if ($count === true){
    //   print_r($sql); exit;
    // }
    $rtVal = DB::select($sql);
    return $rtVal;
  }


  // Admin User Model
}
