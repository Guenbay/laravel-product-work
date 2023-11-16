<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//نحدد Model الحقول التي يسمح بوصول المستخدم لها والتعديل عليها أو لا 
class Product extends Model
{
    use HasFactory;
//الحقول القابله لمليء
    protected $fillable = ['name','details','image'];

    protected $table = "products";

    protected $primaryKey = "id";


}
