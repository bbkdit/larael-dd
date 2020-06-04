<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Validator;

class CategoryController extends Controller
{


    public function manageCategory()
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title','id')->all();
        return view('categoryTreeview',compact('categories','allCategories'));
    }



    public function createCategory(Request $request){
        // dd($request->all());
        Validator::make($request->all(), [
            'category_name' => 'required',
            'parent_id_' => 'required'
        ])->validate();
        
        $cat = new Category();
        $cat->title = $request->category_name;
        $cat->sub_id = $request->parent_id_;
        if($cat->save()){
            session()->flash('resMsg', 'Category inserted.');
            return redirect()->back();
        } else {
            session()->flash('errorMsg', 'Faild to insert category');
            return redirect()->back();
        }
    }

    public function editCategory($id){
        return view('edit', [
            'meta' => 'category',
            'category' => Category::where('id', $id)->where('is_deleted', 0)->first()
        ]);
    }
    
    public function updateCategory(Request $request){
        
        Validator::make($request->all(), [
            'category_id' => 'required',
            'category_name' => 'required',
        ])->validate();
        
        $cat = Category::where('id', $request->category_id)->where('is_deleted', 0)->first();
        if(!empty($cat)){
            $cat->title = (!empty($request->category_name)) ? $request->category_name : $cat->title ;
            if($cat->save()){
                session()->flash('resMsg', 'Category Updated.');
                return redirect('/');
            } else {
                session()->flash('errorMsg', 'Faild to update category');
                return redirect()->back();
            }
        } else {
            session()->flash('errorMsg', 'Something Went Wrong, Try Again!');
            return redirect()->back();
        }
    }

    public function deleteCategory(Request $request){
        $cat = Category::where('id', $request->did)->where('is_deleted', 0)->first();
        if(!empty($cat)){
            $cat->is_deleted = 1;
            $cat->delete();
            session()->flash('resMsg', 'Category Deleted');
            return redirect()->back();
            
        } else {
            session()->flash('errorMsg', 'Something Went Wrong, Try Again!');
            return redirect()->back();
        }
    }



    public function createSubCategory(Request $request){
        
        Validator::make($request->all(), [
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ])->validate();
        
        $cat = new Category();
        $cat->sub_id = $request->category_id;
        $cat->title = $request->subcategory_name;
        if($cat->save()){
            session()->flash('resMsg', 'Sub Category tnserted.');
            return redirect()->back();
        } else {
            session()->flash('errorMsg', 'Faild to insert sub-category');
            return redirect()->back();
        }
    }

    public function editSubCategory($id){
        return view('edit', [
            'meta' => 'subcategory',
            'subcat' => Category::where('sub_id', $id)->where('is_deleted', 0)->first()
        ]);
    }
    
    public function updateSubCategory(Request $request){
        
        Validator::make($request->all(), [
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ])->validate();
        
        $cat = Category::where('sub_id', $request->subcat_id)->where('is_deleted', 0)->first();
        if(!empty($cat)){
            $cat->sub_id = (!empty($request->category_id)) ? $request->category_id : $cat->sub_id ;
            $cat->title = (!empty($request->subcategory_name)) ? $request->subcategory_name : $cat->title ;
            if($cat->save()){
                session()->flash('resMsg', 'Sub-Category Updated.');
                return redirect('/');
            } else {
                session()->flash('errorMsg', 'Faild to update sub-category');
                return redirect()->back();
            }
        } else {
            session()->flash('errorMsg', 'Something Went Wrong, Try Again!');
            return redirect()->back();
        }
    }

    public function deleteSubCategory(Request $request){
        $cat = Category::where('id', $request->did)->where('is_deleted', 0)->first();
        if(!empty($cat)){
            $cat->is_deleted = 1;
            $cat->delete();
            session()->flash('resMsg', 'Sub-Category Deleted');
            return redirect()->back();
            
        } else {
            session()->flash('errorMsg', 'Something Went Wrong, Try Again!');
            return redirect()->back();
        }
    }
}
