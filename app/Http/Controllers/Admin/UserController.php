<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Model\Role;
use App\Model\Shop;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $objUser = User::find($id);
        if ($objUser->role == 1)
        {
            Auth::logout();
            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục ko được phép');
        }
        if ($objUser->delete($id)){
            return redirect()->route('admin.user.index')->with('msg_dlt', 'Xóa tài khoản thành công');
        } else{
            return redirect()->route('admin.user.index')->with('msg_dlt', 'Xóa tài khoản thất bại');
        }
    }

    public function updateActive($id)
    {
        $objUser = $this->user->find($id);
        if ($objUser->role == 1)
        {
            Auth::logout();
            return redirect()->route('login')->with('msg', 'Bạn đã truy cập danh mục ko được phép');
        }
        $active = null;

        if ($objUser->active_user == 1)
        {
            $objUser->active_user = 0;
            $active = 0;
            $objShop = Shop::where('user_id', '=', $id)->first();
            if (sizeof($objShop) > 0)
            {
                $objShop->active_shop = 0;
                $objShop->save();
            }

        } else{
            $objUser->active_user = 1;
            $active = 1;
            $objShop = Shop::where('user_id', '=', $id)->first();
            if (sizeof($objShop) > 0)
            {
                $objShop->active_shop = 1;
                $objShop->save();
            }
        }
        $objUser->save();
        return response()->json([
            'message'=>'Update thành công !',
            'active' => $active
        ]);
    }
}
