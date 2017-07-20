<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GuestEditRequest;
use App\Http\Requests\GuestRequest;
use App\Model\Shop;
use App\User;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $objUser = $this->user->getAllGuest();
        return view('admin.guest.index', ['objUser' => $objUser]);
    }


    public function create()
    {
        return view('admin.auth.register');
    }

    public function store(GuestRequest $userRequest)
    {
        $userRequest['password'] = bcrypt(trim($userRequest['password']));
        if ($this->user->create($userRequest->toArray()))
        {
            return redirect()->route('user.index')->with('msg', 'Thêm người dùng thành công');
        }
    }

    public function edit($id)
    {
        $objFavouriteCat = $this->user->getFavouriteCat($id);
        $data = [];
        if (sizeof($objFavouriteCat) > 0)
        {
            $data['objFavouriteCat'] = $objFavouriteCat[0];
        }
        $objUser = $this->user->find($id);
        $data['objUser'] = $objUser;
        return view('vnexpress.guest.edit', $data);
    }

    public function update(GuestEditRequest $request, $id)
    {
        if ($request->cat_id != null)
        {
            $objCatUser = new Cat_User();
            $objCatUser->removeRelation($id);
            $objCatUser->cat_id = $request->cat_id;
            $objCatUser->user_id = $id;
            $objCatUser->save();
        }
        $objUser = $this->user->find($id);
        if ($request->has('password')){
            $request['password'] = bcrypt(trim($request->password));
        }

        if ($objUser->update($request->toArray())){
            return redirect()->route('profile', ['id' => $id])->with('msg', 'Cập nhật thành công');
        } else{
            return redirect()->route('profile', ['id' => $id])->with('msg', 'Cập nhật thất bại');
        }

    }

    public function destroy($id)
    {
        if ($this->user->destroy($id)){
            return redirect()->route('admin.guest.index')->with('msg_dlt', 'Xóa tài khoản thành công');
        } else{
            return redirect()->route('admin.guest.index')->with('msg_dlt', 'Xóa tài khoản thất bại');
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
            $objShop = Shop::where('user_id', '=', $id)->get();
            if (sizeof($objShop) > 0)
            {
                $objShop->active_shop = 0;
                $objShop->save();
            }

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
