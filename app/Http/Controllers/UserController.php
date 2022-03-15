<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Application;
use App\Policies\UserPolicy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('user');
        $this->middleware('auth');
    }

    public function index()
    {
        $apps = Application::where('user_id', Auth::id())->where('status', 0)->get();
        return view('home.user.index', ['data' => $apps]);
    }

    public function checked() {
        $apps = Application::where('user_id', Auth::id())->where('status', 1)->get();
        return view('home.user.checked', ['data' => $apps]);
    }

    public function create() {
        return view('home.user.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'subject' => 'required|min:3',
            'message' => 'required|min:3',
            'file' => 'required|image|mimes:png,jpeg,jpg,pdf|max:2048',
        ]);

        if($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = $image->getClientOriginalName();


            $updatedFilename = 'files\\' . time() . $filename;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 400);
            $image_resize->save(public_path($updatedFilename));
        }

        $flight = Application::create([
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'file' => $updatedFilename,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('home.user.index')->with('success', 'Application created successfully');
    }


    public function edit($id)
    {
        $app = Application::find($id);
        return view('home.user.edit', ['app' => $app]);
    }


    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'subject' => 'required|min:3',
            'message' => 'required|min:3',
            'file' => 'required|image|mimes:png,jpeg,jpg,pdf|max:2048'
        ]);

        if($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = $image->getClientOriginalName();

            $updatedFilename = 'files\\' . time() . $filename;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 400);
            $image_resize->save(public_path($updatedFilename));
        }

        $flight = Application::find($id)->update([
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'file' => $updatedFilename,
        ]);

        return redirect()->route('home.user.index')->with('success', 'Application edited');
    }


    public function destroy($id)
    {
        $destroyApp = Application::destroy($id);
        return redirect()->route('home.user.index')->with('success', 'Application deleted successfully');
    }
}
