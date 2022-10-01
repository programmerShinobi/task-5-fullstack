<?php

namespace App\Models;

use Parsedown;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = "posts";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    protected $fillable = ['title', 'content', 'image', 'status', 'category_id', 'user_id', 'name'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
    }

    public function getUrlAttribute()
    {
        return route("posts.show", $this->id);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getContentHtmlAttribute()
    {
        return strip_tags($this->contentHtml());
    }

    public static function get_category_all()
    {
        return DB::table("categories")->get();
    }

    public static function get_category($post)
    {
        return DB::table("categories")->where('id', $post->category_id)->get();
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

    // public static function query_get_post_publish($input)
    // {
    //     $user_id = Auth::user()->id;
    //     $column_order = ["posts.title", "categories.name"];
    //     $column_search = ["posts.title", "categories.name"];
    //     $order = ["posts.id" => "DESC"];

    //     $result = DB::table("posts")
    //     ->select("posts.id", "posts.title", "categories.name", "category_id")
    //     ->join("categories", "categories.id", "=", "posts.category_id")
    //     ->where("posts.user_id", $user_id)
    //     ->where("posts.status", "publish")
    //         ->where(function ($query) use ($column_search, $input) {
    //             $i = 1;
    //             foreach ($column_search as $item) {
    //                 if ($input->search["value"]) {
    //                     if ($i == 1) {
    //                         $query->where($item, "LIKE", "%" . $input->search["value"] . "%");
    //                     } else {
    //                         $query->orWhere($item, "LIKE", "%" . $input->search["value"] . "%");
    //                     }
    //                 }
    //             }
    //         });

    //     if (isset($input->order) && !empty($input->order)) {
    //         $result->orderBy($column_order[$input->order["0"]["column"] - 1], $input->order["0"]["dir"]);
    //     } else if (isset($input->order)) {
    //         $result->orderBy(key($order), $order[key($order)]);
    //     }
    //     return $result;
    // }

    // public static function get_post_listed_publish($input)
    // {
    //     $query = self::query_get_post_publish($input);
    //     if ($input->length != -1) {
    //         $limit = $query->offset($input->start)->limit($input->length);
    //         // $query->dump();
    //         return $limit->get();
    //     }
    // }

    // public static function get_post_filter_count_publish($input)
    // {
    //     $query = self::query_get_post_publish($input);
    //     return $query->count();
    // }

    // public static function query_get_post_draft($input)
    // {
    //     $user_id = Auth::user()->id;
    //     $column_order = ["posts.title", "categories.name"];
    //     $column_search = ["posts.title", "categories.name"];
    //     $order = ["posts.id" => "DESC"];

    //     $result = DB::table("posts")
    //     ->select("posts.id", "posts.title", "categories.name", "category_id")
    //     ->join("categories", "categories.id", "=", "posts.category_id")
    //     ->where("posts.user_id", $user_id)
    //     ->where("posts.status", "draft")
    //         ->where(function ($query) use ($column_search, $input) {
    //             $i = 1;
    //             foreach ($column_search as $item) {
    //                 if ($input->search["value"]) {
    //                     if ($i == 1) {
    //                         $query->where($item, "LIKE", "%" . $input->search["value"] . "%");
    //                     } else {
    //                         $query->orWhere($item, "LIKE", "%" . $input->search["value"] . "%");
    //                     }
    //                 }
    //             }
    //         });

    //     if (isset($input->order) && !empty($input->order)) {
    //         $result->orderBy($column_order[$input->order["0"]["column"] - 1], $input->order["0"]["dir"]);
    //     } else if (isset($input->order)) {
    //         $result->orderBy(key($order), $order[key($order)]);
    //     }
    //     return $result;
    // }

    // public static function get_post_listed_draft($input)
    // {
    //     $query = self::query_get_post_draft($input);
    //     if ($input->length != -1) {
    //         $limit = $query->offset($input->start)->limit($input->length);
    //         // $query->dump();
    //         return $limit->get();
    //     }
    // }

    // public static function get_post_filter_count_draft($input)
    // {
    //     $query = self::query_get_post_draft($input);
    //     return $query->count();
    // }

    // public static function query_get_post_trash($input)
    // {
    //     $user_id = Auth::user()->id;
    //     $column_order = ["posts.title", "categories.name"];
    //     $column_search = ["posts.title", "categories.name"];
    //     $order = ["posts.id" => "DESC"];

    //     $result = DB::table("posts")
    //     ->select("posts.id", "posts.title", "categories.name", "category_id")
    //     ->join("categories", "categories.id", "=", "posts.category_id")
    //     ->where("posts.user_id", $user_id)
    //     ->where("posts.status", "trash")
    //         ->where(function ($query) use ($column_search, $input) {
    //             $i = 1;
    //             foreach ($column_search as $item) {
    //                 if ($input->search["value"]) {
    //                     if ($i == 1) {
    //                         $query->where($item, "LIKE", "%" . $input->search["value"] . "%");
    //                     } else {
    //                         $query->orWhere($item, "LIKE", "%" . $input->search["value"] . "%");
    //                     }
    //                 }
    //             }
    //         });

    //     if (isset($input->order) && !empty($input->order)) {
    //         $result->orderBy($column_order[$input->order["0"]["column"] - 1], $input->order["0"]["dir"]);
    //     } else if (isset($input->order)) {
    //         $result->orderBy(key($order), $order[key($order)]);
    //     }
    //     return $result;
    // }

    // public static function get_post_listed_trash($input)
    // {
    //     $query = self::query_get_post_trash($input);
    //     if ($input->length != -1) {
    //         $limit = $query->offset($input->start)->limit($input->length);
    //         // $query->dump();
    //         return $limit->get();
    //     }
    // }

    // public static function get_post_filter_count_trash($input)
    // {
    //     $query = self::query_get_post_trash($input);
    //     return $query->count();
    // }
}
