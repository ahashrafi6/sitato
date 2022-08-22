<?php

namespace App\Http\Controllers\Site\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MyFile;
use App\Jobs\ReleaseProject;
use App\Models\Project;

class IndexController extends Controller
{
    public function index()
    {
   /*       $project =  Project::find(1)->with('server')->first();
        ReleaseProject::dispatchSync($project);  */

        
        $user = auth()->user();

        return view('site.profile.pages.index', compact('user'));
    }

    public function notification($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        $notification->markAsRead();
        return redirect($notification->data['url']);
    }

    public function avatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:png,jpg,jpeg',
        ]);

        $user = auth()->user();
        $img = $request->file('avatar');
        if ($img) {
            $url = MyFile::FtpUpload($img, 'images/users');
            $user->update(['avatar' => $url]);
        }

        return redirect()->back()->with([
            'success' => true,
        ]);
    }
}
