<?php

namespace App\Http\Controllers\Ban;

use App\Http\Requests\CommentRequest;
use App\Model\Comment;
use App\Http\Controllers\Controller;
use App\Model\Shop;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $commentModel;

    public function __construct(Comment $commentModel)
    {
        $this->commentModel = $commentModel;
    }

    public function getCmtShop()
    {
        $shopModel = new Shop();
        $shop_id = $shopModel->getShopByUserId(Auth::user()->id)[0]->id;
        $objComment = $this->commentModel->getCommentAboutShop($shop_id);

        return view('ban.comment.indexShop', ['objComment' => $objComment]);
    }

    public function getCmtProduct()
    {
        $shopModel = new Shop();
        $shop_id = $shopModel->getShopByUserId(Auth::user()->id)[0]->id;
        $objComment = $this->commentModel->getCommentProductOfShop($shop_id);
        /*dd($objComment);*/

        return view('ban.comment.indexProduct', ['objComment' => $objComment]);
    }

    public function store(CommentRequest $request)
    {
        if ($this->commentModel->create($request->toArray()))
        {
            return redirect()->back();
        } else{
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $objCmt = Comment::find($id);
        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objCmt->shop_id != $objShop->id)
        {
            return false;
        }
        if ($objCmt->delete())
        {
            return redirect()->route('ban.comment.index')->with('msg_dlt', 'Xóa bình luận thành công');
        } else{
            return redirect()->route('ban.comment.index')->with('msg_dlt', 'Có lỗi khi xóa bình luận');
        }
    }

    public function updateActive($id)
    {
        $objCmt = $this->commentModel->find($id);

        $shopModel = new Shop();
        $objShop = $shopModel->getShopByUserId(Auth::user()->id)[0];
        if ($objCmt->shop_id != $objShop->id)
        {
            return false;
        }

        if ($objCmt->active_cmt == 0){
            $objCmt->active_cmt = 1;
            $active = 1;
        } else{
            $objCmt->active_cmt = 0;
            $active = 0;
        }
        $objCmt->save();
        return response()->json([
            'message'=>'Update thành công !',
            'active' => $active
        ]);
    }
}

