<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Forum;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    //
    public function index(){
        $forums = Forum::all();
        $categories = Category::all();
        return view('forum.forum', compact('forums', 'categories'));
    }

    public function create(){
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $categories = Category::all();
        return view('forum.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $forums = Forum::create([
            'account_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->has('categories')) {
            $forums->categories()->attach($request->categories);
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $picture = Picture::create([
                    'pictureLink' => $path,
                ]);
                $forums->pictures()->attach($picture->id);
            }
        }

        return redirect()->route('forums.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $categories = $request->input('categories');

        $forums = Forum::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
        ->when($categories, function ($query, $categories) {
            return $query->whereHas('categories', function ($categoryQuery) use ($categories) {
                $categoryQuery->whereIn('categories.id', $categories);
            }, '=', count($categories));
        })
        ->get();


        $categories = Category::all();

        return view('forum.forum', compact('categories', 'forums'));
    }

    public function show($id){
        $forum = Forum::with(['comments', 'pictures', 'account'])->findOrFail($id);
        return view('forum.detail', compact('forum'));
    }

    public function delete($id){
        $forum = Forum::findOrFail($id);
        $forum->delete();
        return redirect()->route('profile.show');
    }

    public function updatePage($id){
        $forum = Forum::findOrFail($id);
        $categories = Category::all();
        return view('forum.update', compact('forum', 'categories'));
    }

    public function update(Request $request, $id){
        $forum = Forum::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $forum->update($validated);

        $forum->categories()->sync($request->categories);

        // Handle new images if provided
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $picture = Picture::create([
                    'pictureLink' => $path,
                ]);
                $forum->pictures()->attach($picture->id);
            }
        }

        return redirect()->route('profile.show');
    }
}
