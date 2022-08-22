<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        $detail->with('product');
        return view('dashboard.details.edit', compact('detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail $detail)
    {
        $request->validate([
            'status' => 'required'
        ]);


        if ($request->status == 'verified'){
            $detail->product->update([
                'demo' => $detail->demo,
                'icon' => $detail->icon,
                'mini_cover' => $detail->mini_cover,
                'cover' => $detail->cover,
                'cover2' => $detail->cover2,
            ]);
        }

        $detail->update([
            'status' => $request->status,
            'description' => $request->description,
        ]);


        return redirect(route('details.index'))->with([
            'success' => 'آیتم با موفقت ویرایش شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail $detail)
    {
        $detail->delete();
        return back()->with('success', 'آیتم با موفقیت حذف گردید!');
    }
}
