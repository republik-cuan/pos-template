<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
  protected $fillable = ['status'];

  public $status = [
    'order',
    'preorder',
    'verified',
  ];

  public function customer() {
    return $this->belongsTo(Customer::class);
  }

  public function items() {
    return $this->belongsToMany(Item::class);
  }
}
