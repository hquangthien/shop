<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CatRequest;
use App\Model\Cat;
use App\Http\Controllers\Controller;

class CatController extends Controller
{
    private $catModel;
    public function __construct(Cat $catModel)
    {
        $this->catModel = $catModel;
    }

    public function index()
    {
        return view('admin.cat.index');
    }

    public function create()
    {
        return view('admin.cat.create');
    }

    public function store(CatRequest $request)
    {
        $this->catModel->parrent_cat = $request->parrent_cat;
        $this->catModel->name = $request->name;
        if ($this->catModel->save()) {
            return redirect()->route('admin.cat.index')->with('msg', 'Thêm danh mục thành công');
        } else {
            return redirect()->route('admin.cat.index')->with('msg', 'Thêm danh mục thất bại');
        }
    }

    public function edit($id)
    {
        $objCat = $this->catModel->find($id);
        return view('admin.cat.edit', ['objCat' => $objCat]);
    }

    public function update(CatRequest $request, $id)
    {
        $objCat = $this->catModel->find($id);
        $objCat->name = $request->name;
        if ($request->parrent_cat != null){
            if (sizeof($this->catModel->getSubCat($objCat->id))){
                return redirect()->route('admin.cat.edit', ['id' => $id])->with('msg', 'Bạn không thể đặt danh mục cha vào trong một danh mục khác');
            } else{
                $objCat->parrent_cat = $request->parrent_cat;
            }
        }
        if ($objCat->save()){
            return redirect()->route('admin.cat.index')->with('msg', 'Cập nhật danh mục tin thành công');
        } else{
            return redirect()->route('admin.cat.index')->with('msg', 'Cập nhật danh mục tin thất bại');
        }
    }

    public function destroy($id)
    {
        try{
            $objCat = $this->catModel->find($id);
            if ($objCat->parrent_cat == null){
                $this->catModel->destroy($id);
                $objSubCat = $this->catModel->getSubCat($id);
                foreach ($objSubCat as $subCat){
                    $this->catModel->deleteCat($subCat->id);
                }
            } else{
                $this->catModel->deleteCat($id);
            }
            return redirect()->route('admin.cat.index')->with('msg_dlt', 'Xóa danh mục thành công');
        } catch (\Exception $exception){
            return redirect()->route('admin.cat.index')->with('msg_dlt', 'Có lỗi xảy ra khi xóa danh mục tin');
        }
    }
}
