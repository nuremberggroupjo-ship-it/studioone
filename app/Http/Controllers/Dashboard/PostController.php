<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->getPosts($request);
        }

        return view('Dashboard.posts.index');
    }

    public function getPosts($request)
    {
        $posts = Post::latest()->get();

        return DataTables::of($posts)
            ->addColumn('action', function ($row) {
                $imagePath = $row->image_path 
                    ? Storage::url($row->image_path) 
                    : asset('default-post.jpg');

                return '
                    <a href="#" class="btn btn-sm btn-light edit-btn" data-id="' . $row->id . '">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '">Delete</a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'small_header' => 'required|string',
            'small_header_ar' => 'required|string',
            'name' => 'required|string',
            'name_ar' => 'required|string',
            'description' => 'required|string',
            'description_ar' => 'required|string',
            'button_name' => 'required|string',
            'button_name_ar' => 'required|string',
            'button_link' => 'required|url',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
        ]);

        $post = null;
        $imagePath = null;

        if ($request->has('id') && $request->id) {
            $post = Post::findOrFail($request->id);

            if ($request->hasFile('image_path')) {
                if ($post->image_path) {
                    Storage::disk('public')->delete($post->image_path);
                }

                $imagePath = $request->file('image_path')->store('posts_images', 'public');
            } else {
                $imagePath = $post->image_path;
            }
        } else {
            if ($request->hasFile('image_path')) {
                $imagePath = $request->file('image_path')->store('posts_images', 'public');
            }
        }

        $slug = Str::slug($request->name);

        if (!$post) {
            $slugCount = Post::where('slug', $slug)->count();
            if ($slugCount > 0) {
                $slug = $slug . '-' . time();
            }
        }

        if ($post) {
            $post->update([
                'small_header' => $request->small_header,
                'small_header_ar' => $request->small_header_ar,
                'name' => $request->name,
                'name_ar' => $request->name_ar,
                'description' => $request->description,
                'description_ar' => $request->description_ar,
                'button_name' => $request->button_name,
                'button_name_ar' => $request->button_name_ar,
                'button_link' => $request->button_link,
                'image_path' => $imagePath,
            ]);
            $message = 'Post updated successfully!';
        } else {
            $post = Post::create([
                'slug' => $slug,
                'small_header' => $request->small_header,
                'small_header_ar' => $request->small_header_ar,
                'name' => $request->name,
                'name_ar' => $request->name_ar,
                'description' => $request->description,
                'description_ar' => $request->description_ar,
                'button_name' => $request->button_name,
                'button_name_ar' => $request->button_name_ar,
                'button_link' => $request->button_link,
                'image_path' => $imagePath,
            ]);
            $message = 'Post created successfully!';
        }

        return response()->json(['message' => $message, 'post' => $post]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found'], 404);
        }

        return response()->json([
            'success' => true,
            'post' => $post
        ]);
    }
}
