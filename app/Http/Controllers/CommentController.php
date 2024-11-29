<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function store(Request $request, $id)
    {
        $content = $request->input('comment');

        Comment::create([
            'account_id' => Auth::id(),
            'forum_id' => $id,
            'content' => $content,
        ]);

        return redirect()->route('forums.show', $id);
    }

    public function delete($id, $forumid){
        $comment=Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('forums.show', $forumid);
    }

    public function deleteBackProfile($id){
        $comment=Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('profile.show');
    }

}
