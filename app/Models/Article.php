<?php

namespace App\Models;

use Parsedown;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    protected $fillable = ['title', 'content', 'category', 'status' ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
    }

    public function getUrlAttribute()
    {
        return route("article.show", $this->id);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getContentHtmlAttribute()
    {
        return strip_tags($this->contentHtml());
    }

    private function contentHtml()
    {
        return Parsedown::instance()->text($this->content);
    }

    public static function move_to_publish($id)
    {
        return DB::table("posts")->where("id", $id)
            ->update([
                "status" => "publish"
            ]);
    }

    public static function move_to_draft($id)
    {
        return DB::table("posts")->where("id", $id)
            ->update([
                "status" => "draft"
            ]);
    }

    public static function move_to_trash($id)
    {
        return DB::table("posts")->where("id", $id)
            ->update([
                "status" => "trash"
            ]);
    }
}
