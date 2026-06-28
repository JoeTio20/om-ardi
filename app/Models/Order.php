<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {
    protected $fillable = ['first_name','last_name','whatsapp','address','city','postal_code','total','payment_method','status','items','midtrans_token'];
    protected $casts = ['items' => 'array'];
    public function getFullNameAttribute(): string { return $this->first_name.' '.$this->last_name; }
}
