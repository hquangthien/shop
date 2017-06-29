<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdvEditRequest;
use App\Http\Requests\AdvRequest;
use App\Model\Adv;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdvController extends Controller
{
    private $advModel;

    public function __construct(Adv $advModel)
    {
        $this->advModel = $advModel;
    }

    public function index()
    {
        $objAdv = $this->advModel->orderBy('id', 'DESC')->paginate(5);
        return view('admin.adv.index', ['objAdv' => $objAdv]);
    }

    public function create()
    {
        return view('admin.adv.create');
    }

    public function store(AdvRequest $request)
    {
        $objAdv = new $this->advModel();
        $objAdv->name = $request->name;
        $objAdv->link = $request->link;
        $objAdv->position = $request->position;

        if ($request->hasFile('image')){
            $picture = $request->file('image')->store('/files');
            $picture = last(explode('/', $picture));
            $objAdv->image = $picture;
        }

        if ($objAdv->save()){
            return redirect()->route('admin.adv.index')->with('msg', 'Thêm thành công');
        } else{
            return redirect()->route('admin.adv.index')->with('msg', 'Thêm thất bại');
        }

    }

    public function edit($id)
    {
        $objAdv = $this->advModel->find($id);
        return view('admin.adv.edit', ['objAdv' => $objAdv]);
    }


    public function update(AdvEditRequest $request, $id)
    {
        $objAdv = $this->advModel->find($id);
        $objAdv->name = $request->name;
        $objAdv->link = $request->link;
        $objAdv->position = $request->position;

        if ($request->image != null){
            Storage::delete('files/'.$objAdv->image);
            $picture = $request->file('image')->store('/files');
            $picture = last(explode('/', $picture));
            $objAdv->image = $picture;
        }

        if ($objAdv->save()){
            return redirect()->route('admin.adv.index')->with('msg', 'Cập nhật thành công');
        } else{
            return redirect()->route('admin.adv.index')->with('msg', 'Cập nhật thất bại');
        }
    }

    public function destroy($id)
    {
        $objAdv = $this->advModel->find($id);
        Storage::delete('files/'.$objAdv->image);
        if ($objAdv->delete()){
            return redirect()->route('admin.adv.index')->with('msg', 'Xóa thành công');
        } else{
            return redirect()->route('admin.adv.index')->with('msg', 'Xóa thất bại');
        }
    }

    public function updateActive($id)
    {
        $objAdv = $this->advModel->find($id);
        if ($objAdv->active_adv == 0){
            $objAdv->active_adv = 1;
            $active = 1;
        } else{
            $objAdv->active_adv = 0;
            $active = 0;
        }
        $objAdv->save();
        return response()->json([
            'message'=>'Update thành công !',
            'active' => $active
        ]);
    }
}
