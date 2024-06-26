<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorias extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';

    use SoftDeletes;

    protected $fillable = ['name', 'description', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Categorias::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CAtegorias::class, 'parent_id');
    }
}
