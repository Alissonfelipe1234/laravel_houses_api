<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'bedrooms',
        'bathrooms',
        'total_area',
        'purcharsed',
        'value',
        'discount',
    ];

    /**
     * The owner function
     *
     * @return Owner
     */
    public function owner(){
        return $this->belongsTo(Owner::class);
    }
}
