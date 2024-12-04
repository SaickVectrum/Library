<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
		'name',
	];

	//Se coloca en plural el nombre de la función en caso de que sea a muchos
	public function books(): HasMany
	{
		//No es necesario poner los ids, pero se dejan para poder leerlo mejor
		return $this->hasMany(Book::class, 'category_id', 'id');
	}
}
