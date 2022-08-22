<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('dashboard.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $status = $request->status;
        $product = $comment->commentable;

        if ($status) {
            $comment->update([
                'status' => true,
            ]);

            if($product->rate){
                $rate = [
                    'count' => $product->rate['count'] + 1,
                    'sum' => $product->rate['sum'] + $comment->rate,
                    'ave' => ($product->rate['sum'] + $comment->rate) / ($product->rate['count'] + 1),
                    'percent' => 100 - ((($product->rate['count'] + 1) * 5) - ($product->rate['sum'] + $comment->rate)) * 100 / (($product->rate['count'] + 1) * 5),
                ];
            }else{
                $rate = [
                    'count' => 1,
                    'sum' => $comment->rate,
                    'ave' => $comment->rate,
                    'percent' => 100 - (5 - $comment->rate) * 100 / 5,
                ];
            }
            $product->update([
                'rate' => $rate,
                'comment' => $product->comment + 1
            ]);

        }

        return back()->with([
            'success' => 'آپدیت با موفقیت انجام شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'آیتم با موفقیت حذف گردید!');
    }
}
