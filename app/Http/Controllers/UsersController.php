<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{


    public function create()
    {
        return view('users.create');
    }


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function store(Request $request)
    {
        //验证用户提交信息
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        //储存用户信息
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //注册成功自动登录
        Auth::login($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程');
        return redirect()->route('users.show', [$user]);
    }


    /**
     * 用户信息编辑页面
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * 更新用户个人信息
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(User $user,Request $request)
    {
        $this->validate($request,[
           'name' => 'required|unique:users|max:50',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success','个人资料更新成功');
        return redirect()->route('users.show',$user->id);
    }

}
