<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = [
    'name',
    'phone',
    'email',
    'gender',
  ];

  public function purchases() {
    return $this->hasMany(Purchase::class);
  }
}
