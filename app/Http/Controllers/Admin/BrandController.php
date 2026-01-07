<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function brands() {
        Session::put('page', 'brands');
        $brands = Brand::get();
        return view('admin.brands.brands')->with(compact('brands'));
    }

    public function updateBrandStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=='Active') {
                $status = 0;
            }else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'brand_id'=>$data['brand_id']]);
        }
    }

    public function addEditBrand(Request $request, $id=null) {
        Session::put('page', 'brands');
        if($id=="") {
            $title = "ბრენდის დამატება";
            $brand = new Brand;
            $message = 'ბრენდი წარმატებით დაემატა!';
        }else {
            $title = 'ბრენდის რედაქტირება';
            $brand = Brand::find($id);
            $message = 'ბრენდი წარმატებით გაახლდა!';
        }
        if($request->isMethod('post')) {
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;

            // Brand Validations
            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessages = [
                'brand_name.required' => 'ბრენდის სახელი სავალდებულოა',
                'brand_name.regex' => 'ვალიდური სახელი სავალდებულოა',
            ];
            $this->validate($request, $rules, $customMessages);

            $brand->name = $data['brand_name'];
            $brand->status = 1;
            $brand->save();

            session::flash('success_message', $message);
            return redirect('admin/brands');
        }
        return view('admin.brands.add_edit_brand')->with(compact('title', 'brand', 'message'));
    }
    public function deleteBrand($id) {
        Brand::where('id', $id)->delete();
        $message = 'ბრენდი წარმატებით წაიშალა!';
        session::flash('success_message', $message);
        return redirect()->back();
    }
}
