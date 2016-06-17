<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_files extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name'];

  /**
   * Get the user that owns the file.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
