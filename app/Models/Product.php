<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['nome', 'descricao', 'preco', 'quantidade_disponivel', 'categoria', 'imagem', 'id_fornecedor'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_fornecedor');
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'id_product');
    }

    public function productionOrders()
    {
        return $this->hasMany(ProductionOrder::class, 'product_id');
    }
}
