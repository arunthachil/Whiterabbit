<?php

namespace App\Http\Controllers;
use App\{User,FileSystem,UserFiles};
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $files = FileSystem::query();
        $auth_user = app('auth')->user()->first();
        $role = $auth_user->roles->first();
        if(isset($role) && isset($auth_user) && $role->name != 'Admin') {
            $files = $files->leftJoin('userfiles', function($join) use ($auth_user)
            {
              $join->on('userfiles.fileid', '=', 'filesystem.id')->where('userfiles.userid', '=', $auth_user->id);
           
            });
        }
        $files = $files->get()->toArray();
        // print_r($files);exit;
        return view('filesystem/list',compact('files'));
    }

    public function imageUpload()
    {
        $users = User::all()->toArray();
        return view('filesystem/imageUpload', compact('users'));
    }

    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user.*' => 'required|numeric|exists:users,id'
        ]);
        $imageName = time().'.'.$request->image->extension(); 
        $files = File::files(public_path('images')); 
        $uploadedImage = sha1_file($request->image); 
        foreach ($files as $indfile) {
            if (sha1_file($indfile) == $uploadedImage) {
                $identicalFileName = $indfile->getFilename();
                File::delete(public_path('images/'.$identicalFileName));
                $existingFile = FileSystem::where('filename', $identicalFileName)->first();
                FileSystem::where('filename', $identicalFileName)->delete();
                UserFiles::where('fileid', $existingFile->id)->delete();
            }     
        }
        $request->image->move(public_path('images'), $imageName); 
        $insertFile = FileSystem::create([
            'filename' => $imageName,
            'sha_value' => $uploadedImage
        ]);
        if($request->filled('user')){
            foreach ($request->user as $user) {
                UserFiles::create([
                    'fileid' => $insertFile->id,
                    'userid' => $user
                ]);
            }
        }
        return redirect('home')
            ->with('status','You have successfully upload image.')
            ->with('image',$imageName);
    }

    public function destroy($id)
    {
        $existingFile = FileSystem::where('id', $id)->first();
        FileSystem::where('id', $id)->delete();
        UserFiles::where('fileid', $existingFile->id)->delete();
        return true;
    }
}