<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use SoftDeletes;
    protected $fillable = ['category_id', 'code', 'name', 'unit', 'price', 'stock', 'image'];
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function transactionDetails() {
        return $this->hasMany(TransactionDetail::class);
    }
    public function purchaseDetails() {
        return $this->hasMany(PurchaseDetail::class);
    }
    // Accessor format Rupiah (Latihan 6 Soal 2) -> dipanggil lewat $product->formatted_price
    protected function formattedPrice(): Attribute {
        return Attribute::make(
            get: fn () => 'Rp ' . number_format($this->price, 0, ',', '.'),
        );
    }
}

