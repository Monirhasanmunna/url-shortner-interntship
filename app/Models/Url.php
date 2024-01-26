<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['short_url', 'main_url'];


    public function scopeSearch($query, $search){
        return $query->where('main_url', 'Like', '%'. $search . '%')
                ->orWhere('short_url', 'Like', '%'. $search . '%');
    }
}
