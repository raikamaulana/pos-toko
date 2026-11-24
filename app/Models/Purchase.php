<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Purchase extends Model {
    protected $fillable = ['invoice_number', 'supplier_id', 'user_id', 'total', 'purchase_date'];
    protected $casts = ['purchase_date' => 'date', ];
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function details() { return $this->hasMany(PurchaseDetail::class); }
}

