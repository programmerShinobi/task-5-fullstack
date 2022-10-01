<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Parsedown;

class Category extends Model
{
    use HasApiTokens, HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['name'];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getNameHtmlAttribute()
    {
        return strip_tags($this->nameHtml());
    }

    private function nameHtml()
    {
        return Parsedown::instance()->text($this->name);
    }

    public static function get_category_count($category)
    {
        return DB::table("categories")
        ->join("posts", "posts.category_id", "=", "categories.id")
        ->where('categories.id', $category)
        ->count();
    }
}
