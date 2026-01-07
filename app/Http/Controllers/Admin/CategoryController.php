<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function categories() {
        Session::put('page', 'categories');
        $categories = Category::with(['section', 'parentcategory'])->get();
        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status']=='Active') {
                $status = 0;
            }else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'category_id'=>$data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id=null) {
        if($id=="") {
            // Add Category Functionality
            $title = "კატეგორიის დამატება";
            $category = new Category;
            $categorydata = array();
            $getCategories = array();
            $message = "კატეგორია წარმატებით დაემატა!";
        }else {
            // Edit Category Functionality
            $title = "კატეგორიის რედაქტირება";
            $categorydata = Category::where('id', $id)->first();
            $categorydata = json_decode(json_encode($categorydata), true);
            $getCategories = Category::with('subcategories')->where(['parent_id'=>0, 'section_id'=>$categorydata['section_id']])->get();
            $getCategories = json_decode(json_encode($getCategories), true);
            $category = Category::find($id);
            $message = "კატეგორია წარმატებით გაახლდა!";
        }
        if($request->isMethod('post')) {
            $data = $request->all();

            // Category Validations
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',

            ];
            $customMessages = [
                'category_name.required' => 'კატეგორიის სახელი სავალდებულოა',
                'category_name.regex' => 'ვალიდური სახელი სავალდებულოა',
                'section_id.required' => 'სექცია სავალდებულოა',
                'url.required' => 'url სავალდებულოა',
            ];
            $this->validate($request, $rules, $customMessages);


            // Upload Category Image
            if($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()) {
                    // Get image extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate new image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'images/category_images/'.$imageName;
                    // Upload the Image
                    Image::make($image_tmp)->save($imagePath);
                    // Save Category Image
                    $category->category_image = $imageName;
                }
            }

            if(empty($data['category_discount'])) {
                $data['category_discount'] = "";
            }
            if(empty($data['description'])) {
                $data['description'] = "";
            }
            if(empty($data['meta_description'])) {
                $data['meta_description'] = "";
            }
            if(empty($data['meta_title'])) {
                $data['meta_title'] = "";
            }
            if(empty($data['meta_keywords'])) {
                $data['meta_keywords'] = "";
            }

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();

            session::flash('success_message', $message);
            return redirect('admin/categories');
        }

        // Get all Sections
        $getSections = Section::get();
        return view('admin.categories.add_edit_category')->with(compact('title', 'getSections', 'categorydata', 'getCategories'));
    }

    public function appendCategoryLevel(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            $getCategories = Category::with('subcategories')->where(['section_id'=>$data['section_id'], 'parent_id'=>0, 'status'=>1])->get();
            $getCategories = json_decode(json_encode($getCategories), true);
            return view('admin.categories.append_categories_level')->with(compact('getCategories'));
        }
    }

    public function deleteCategoryImage($id) {
        // Get Category Image
        $categoryImage = Category::select('category_image')->where('id', $id)->first();

        // Get category image path
        $category_image_path = 'images/category_images/';

        // Delete image from category images folder
        if(file_exists($category_image_path.$categoryImage->category_image)) {
            unlink($category_image_path.$categoryImage->category_image);
        }

        // Delete category image from categories table
        Category::where('id', $id)->update(['category_image'=>'']);
        $message = 'კატეგორიის ფოტო წარმატებით წაიშალა!';
        session::flash('success_message', $message);
        return redirect()->back();
    }

    public function deleteCategory($id) {
        Category::where('id', $id)->delete();
        $message = 'კატეგორია წარმატებით წაიშალა!';
        session::flash('success_message', $message);
        return redirect()->back();
    }
}
