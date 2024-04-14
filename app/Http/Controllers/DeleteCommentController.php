<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Gate;

class DeleteCommentController extends Controller
{
    public function __invoke(int $id, Comment $comment)
    {
        if (Gate::allows('delete', $comment)) {
            $comment->delete();
            return back();
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}