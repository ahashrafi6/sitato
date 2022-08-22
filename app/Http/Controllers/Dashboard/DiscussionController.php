<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Course;
use App\Models\Discussion;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'discussion_id' => 'required',
            'body' => 'required|string|min:10'
        ]);

        $item = Discussion::find($request->discussion_id);
        $item->replies()->create([
            'user_id' => auth()->user()->id,
            'body' => $request->body,
            'status' => true,
            'meta' => ['product_id' => $item->meta['product_id']]
        ]);
        Product::whereId($item->meta['product_id'])->increment('discussion');

        return back()->with([
            'success' => 'پاسخ با موفقیت ثبت شد'
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Discussion $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        return view('dashboard.discussions.edit', compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Discussion $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $status = $request->status;

        if ($status) {
            $discussion->update([
                'status' => true,
            ]);
            if(isset($discussion->meta['product_id'])){
                Product::whereId($discussion->meta['product_id'])->increment('discussion');
            }
            if(isset($discussion->meta['article_id'])){
                Article::whereId($discussion->meta['article_id'])->increment('discussion');
            }
            if(isset($discussion->meta['course_id'])){
                Course::whereId($discussion->meta['course_id'])->increment('discussion');
            }
           
        } else {
            $discussion->update([
                'status' => false,
            ]);

            if(isset($discussion->meta['product_id'])){
                Product::whereId($discussion->meta['product_id'])->decrement('discussion');
            }
            if(isset($discussion->meta['article_id'])){
                Article::whereId($discussion->meta['article_id'])->decrement('discussion');
            }
            if(isset($discussion->meta['course_id'])){
                Course::whereId($discussion->meta['course_id'])->decrement('discussion');
            }
        }

        return back()->with([
            'success' => 'آپدیت با موفقیت انجام شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Discussion $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
        return back()->with('success', 'آیتم با موفقیت حذف گردید!');
    }
}
