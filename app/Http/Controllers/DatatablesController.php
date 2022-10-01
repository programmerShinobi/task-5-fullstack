<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\DataTables\PostsDataTable;
use Illuminate\Support\Facades\Auth;


class DatatablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    // public function index()
    // {
    //     $data = Post::with('user')->latest()->get();

    //     return view('datatables.index', compact('data'));
    // }

    public function view_post_management()
    {
        $data = [
            "title" => "All Posts",
        ];
        $publish = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'publish')->count();
        $draft = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'draft')->count();
        $trash = Post::with('user')->where('user_id', Auth::user()->id)->where('status', 'trash')->count();

        return view('datatables.index', compact('data','publish','draft','trash'));
    }

    public function get_post_listed_publish(Request $request)
    {
        $input = (object) $request->all();
        $results = Post::get_post_listed_publish($input);
        $data = [];
        $no = $input->start;
        foreach ($results as $item) {
            $no++;
            $id = $item->id;
            $row = [];
            $row[] = $no;
            $row[] = $item->title;
            $row[] = $item->name;
            $button = "<a class='btn btn-warning btn-sm m-1' href='post/$id/draft'><i class='fa-solid fa-sheet-plastic'></i></a>";
            $button .= "<a class='btn btn-danger btn-sm m-1' href='post/$id/trash'><i class='fa-solid fa-trash'></i></a>";
            $row[] = $button;
            $data[] = $row;
        }

        $output = [
            "draw" => $input->draw,
            "recordsTotal" => Post::get_post_filter_count_publish($input),
            "recordsFiltered" => Post::get_post_filter_count_publish($input),
            "data" => $data
        ];

        return \response()->json($output);
    }

    public function get_post_listed_draft(Request $request)
    {
        $input = (object) $request->all();
        $results = Post::get_post_listed_draft($input);
        $data = [];
        $no = $input->start;
        foreach ($results as $item) {
            $no++;
            $id = $item->id;
            $row = [];
            $row[] = $no;
            $row[] = $item->title;
            $row[] = $item->name;
            $button = "<a class='btn btn-success btn-sm m-1' href='post/$id/publish'><i class='fa-solid fa-paper-plane'></i></a>";
            $button .= "<a class='btn btn-danger btn-sm m-1' href='post/$id/trash'><i class='fa-solid fa-trash'></i></a>";
            $row[] = $button;
            $data[] = $row;
        }

        $output = [
            "draw" => $input->draw,
            "recordsTotal" => Post::get_post_filter_count_draft($input),
            "recordsFiltered" => Post::get_post_filter_count_draft($input),
            "data" => $data
        ];

        return \response()->json($output);
    }

    public function get_post_listed_trash(Request $request)
    {
        $input = (object) $request->all();
        $results = Post::get_post_listed_trash($input);
        $data = [];
        $no = $input->start;
        foreach ($results as $item) {
            $no++;
            $id = $item->id;
            $row = [];
            $row[] = $no;
            $row[] = $item->title;
            $row[] = $item->name;
            $button = "<a class='btn btn-success btn-sm m-1' href='post/$id/publish'><i class='fa-solid fa-paper-plane'></i></a>";
            $button .= "<a class='btn btn-warning btn-sm m-1' href='post/$id/draft'><i class='fa-solid fa-sheet-plastic'></i></a>";
            $row[] = $button;
            $data[] = $row;
        }

        $output = [
            "draw" => $input->draw,
            "recordsTotal" => Post::get_post_filter_count_trash($input),
            "recordsFiltered" => Post::get_post_filter_count_trash($input),
            "data" => $data
        ];

        return \response()->json($output);
    }

    public function move_to_publish($id)
    {
        Post::move_to_publish($id);

        return redirect('/post')->with('success', " Your post has been publish.");
    }

    public function move_to_draft($id)
    {
        Post::move_to_draft($id);

        return redirect('/post')->with('success-update', " Your post has been draft.");
    }

    public function move_to_trash($id)
    {
        Post::move_to_trash($id);

        return redirect('/post')->with('success-delete', " Your post has been trashed.");
    }
}
