<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Version;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function edit(Version $version)
    {
        $version->with('product');
        return view('dashboard.versions.edit', compact('version'));
    }


    public function update(Request $request, Version $version)
    {
        $request->validate([
            'status' => 'required'
        ]);


        if ($request->status == 'verified'){
            $version->product->update([
                'files' => $version->files,
                'access' => $version->access,
                'version' => $version->version,
                'version_at' => now(),
            ]);
        }

        $version->update([
            'status' => $request->status,
            'description' => $request->description,
        ]);


        return redirect(route('versions.index'))->with([
            'success' => 'آیتم با موفقت ویرایش شد'
        ]);
    }


    public function destroy(Version $version)
    {
        $version->delete();
        return back()->with('success', 'آیتم با موفقیت حذف گردید!');
    }
}
