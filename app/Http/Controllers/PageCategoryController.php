<?php

namespace App\Http\Controllers;

use Image;
use App\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PageCategoryController extends Controller
{
    // Add New Category
    public function newCategory(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $category = new PageCategory;

            $category->name         = $data['name'];
            $category->url          = $data['url'];
            $category->parent_cat   = $data['parent_cat'];
            $category->description  = $data['description'];

            // Upload Category image/icon
            if ($request->hasFile('cat_image')) {
                $image_tmp = Input::file('cat_image');
                if ($image_tmp->isValid()) {

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'Repid_Deals_cat_' . rand(1, 99999) . '.' . $extension;
                    $large_image_path = 'images/frontend/page_images/category/large/' . $filename;
                    // Resize image
                    Image::make($image_tmp)->resize(1920, 500)->save($large_image_path);

                    // Store image in category folder
                    $category->cat_image = $filename;
                }
            }
            $category->save();

            return redirect('/admin/page_categories')->with('flash_message_success', 'Page Category Added Successfully!');
        }

        $page_category = PageCategory::where(['parent_cat'=>0])->get();
        $page_category_dropdown = '<option value="0" selected="selected">Main Category</option>';

        foreach($page_category as $pCategory){
            $page_category_dropdown .= "<option value='".$pCategory->id."'><strong>".$pCategory->name."</strong></option>";
            $sub_page_category = PageCategory::where(['parent_cat'=>$pCategory->id])->get();
            foreach($sub_page_category as $sub_pCategory){
                $page_category_dropdown .= "<option value='".$sub_pCategory->id."'>&nbsp;--&nbsp;".$sub_pCategory->name."</option>";
                $sub_sub_page_category = PageCategory::where(['parent_cat'=>$sub_pCategory->id])->get();
                foreach($sub_sub_page_category as $sub_subpCategory){
                    $page_category_dropdown .= "<option value='".$sub_subpCategory->id."'>&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;".$sub_subpCategory->name."</option>";
                }
            }
        }

        return view('admin.pages.new_category', compact('page_category_dropdown'));
    }

    // View All Category in Admin Panel
    public function categoryAll()
    {
        $categories = PageCategory::orderBy('name', 'asc')->get();
        return view('admin.pages.category_all', compact('categories'));
    }

    // Enable Page Category
    public function enableCategory($id=null)
    {
        if(!empty($id))
        {
            PageCategory::where('id', $id)->update(['status' => '1']);
            return redirect()->back()->with('flash_message_success', 'Category Enabled Successfully!');
        }
    }

    // Disable Page Category
    public function disableCategory($id=null)
    {
        if(!empty($id))
        {
            PageCategory::where('id', $id)->update(['status' => '0']);
            return redirect()->back()->with('flash_message_success', 'Category Disabled Successfully!');
        }
    }

    // Delete Page Category
    public function deleteCategory($id=null)
    {
        if(!empty($id))
        {
            PageCategory::where('id', $id)->delete();
            return redirect()->back()->with('flash_message_success', 'Category Deleted Successfully!');
        }
    }

    // Edit Page Category
    public function editCategory($id=null)
    {
        $pcat = PageCategory::where('id', $id)->first();
        $pcat = json_decode(json_encode($pcat));

        return view('admin.pages.edit_category', compact('pcat'));
    }
}


