<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Model\Role;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        view()->share('objRoles', Role::all());
    }

    public function index()
    {
        $objUser = $this->user->getAllUser();
        return view('admin.user.index', ['objUser' => $objUser]);
    }


    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $userRequest)
    {
        $userRequest['password'] = bcrypt(trim($userRequest['password']));
        if ($this->user->create($userRequest->toArray()))
        {
            return redirect()->route('admin.user.index')->with('msg', 'Thêm người dùng thành công');
        }
    }

    public function edit($id)
    {
        $objUser = $this->user->find($id);
        return view('admin.user.edit', ['objUser' => $objUser]);
    }

    public function update(UserEditRequest $request, $id)
    {
        $objUser = $this->user->find($id);
        if ($request->has('password')){
            $request['password'] = bcrypt(trim($request->password));
        }
        if ($objUser->update($request->toArray())){
            return redirect()->route('admin.user.index')->with('msg', 'Cập nhật thành công');
        } else{
            return redirect()->route('admin.user.index')->with('msg', 'Cập nhật thất bại');
        }

    }

    public function destroy($id)
    {
        if ($this->user->destroy($id)){
            return redirect()->route('admin.user.index')->with('msg', 'Xóa tài khoản thành công');
        } else{
            return redirect()->route('admin.user.index')->with('msg', 'Xóa tài khoản thất bại');
        }
    }

    public function updateActive($id)
    {
        $objUser = $this->user->find($id);
        $active = null;

        if ($objUser->active_user == 1)
        {
            $objUser->active_user = 0;
            $active = 0;
        } else{
            $objUser->active_user = 1;
            $active = 1;
        }
        $objUser->save();
        return response()->json([
            'message'=>'Update thành công !',
            'active' => $active
        ]);
    }
}
