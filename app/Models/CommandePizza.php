<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandePizza extends Model
{
    use HasFactory;
    public $timestamps = false ;

    protected $fillable = ['commande_id', 'pizza_id', 'qte'];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }
}
