<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name','hash','size','user_id'];

  /**
   * Get the user that owns the file.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
