<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|max:200',
        ]);

        Auth::user()->statuses()->create([
            'content'=>$request['content'],
        ]);

        session()->flash('success','发布成功');
        return redirect()->back();
    }

    /**
     * 删除微博
     * @param Status $status
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Status $status)
    {
        $this->authorize('destroy',$status);
        $status->delete();
        session()->flash('success','微博删除成功');
        return redirect()->back();
    }
}
