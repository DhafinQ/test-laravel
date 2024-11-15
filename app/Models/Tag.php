<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name'];

    public function article_tags(){
        return $this->hasMany(ArticleTag::class,'tag_id');
    }
}