<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Feedback;
use App\Models\User;
use App\Policies\ManagerPolicy;
use Illuminate\Http\Request;

class ManagerController extends Controller
{

    public function __construct()
    {
        $this->middleware('manager');
        $this->middleware('auth');
    }


    public function index()
    {
        $apps = Application::where('status', 0)->get();
        return view('home.manager.index', ['data' => $apps]);
    }

    public function checked()
    {
        $apps = Application::where('status', 1)->get();
        return view('home.manager.checked', ['data' => $apps]);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'reply_message' => 'required|min:3',
            'app_id' => 'integer',
            'user_id' => 'integer',
        ]);

        $replyMessage = Feedback::create([
            'reply_message' => $request->input('reply_message'),
            'app_id' => $request->input('app_id'),
            'user_id' => $request->input('user_id'),
        ]);

        $statusChange = Application::find($request->input('app_id'))->update([
            'status' => 1,
        ]);

        return redirect()->route('home.manager.checked')->with('success', 'Application has been reviewed');
    }


    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'reply_message' => 'required',
        ]);

        $changeReplyMessage = Feedback::find($id)->update([
            'reply_message' => $request->input('reply_message'),
        ]);

        return redirect()->route('home.manager.checked')->with('success', 'Edited reply message');
    }


    // public function recheck(Request $request, $id)
    // {
    //     $validation = $request->validate([
    //         'status' => 'required',
    //     ]);

    //     if ($request->input('status') == 0) {
    //         $appRecheck = Application::find($id)->update([
    //             'status' => 0,
    //         ]);

    //         $feedbackRecheck = Application::find($id)->feedback->update([
    //             'reply_message' => '',
    //         ]);
    //     }

    //     return redirect()->route('home.manager.index')->with('success', 'Application sent to review');
    // }

    public function destroy($id)
    {
        Application::find($id)->update([
            'status' => 0,
        ]);

        Application::find($id)->feedback->delete();

        return redirect()->route('home.manager.index')->with('success', 'Application sent to review');
    }
}
