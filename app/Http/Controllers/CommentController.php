<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function new_comment(NewCommentRequest $request)
    {
        $com = new Comment();
        $rat = (int) $request->input('rating', 0);
        $rat = ($rat > 5) ? 5 : $rat;
        $rat = ($rat <= 0) ? 0 : $rat;
        $com->product_id = (int) $request->input('product_id', 1);
        $com->name = $request->input('name', 'Incognito');
        $com->email = $request->input('email');
        $com->comment = $request->input('comment', '');
        $com->appraisal = $rat;
        $com->save();
        return redirect()->route('product.show',
            ['product_alias'=>(int) $request->input('product_id', 1)]);
    }
}
