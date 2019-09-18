<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\Page;
use App\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use function GuzzleHttp\json_decode;

class PageController extends Controller
{
    // Add New Page
    public function newPage(Request $request)
    {

        if($request->isMethod('post'))
        {
            $request->validate([
                'name' => 'required',
            ]);
            $data = $request->all();
            $author = Auth::user()->id;
            
            if(!empty($data['status'])){
                $status = 1;
            }else{
                $status = 0;
            }
            
            if(!empty($data['feature_page'])){
                $featured = 1;
            }else{
                $featured = 0;
            }

            if(!empty($data['career_form'])){
                $career_form = 1;
            }else{
                $career_form = 0;
                
            }if(!empty($data['contact_form'])){
                $contact_form = 1;
            }else{
                $contact_form = 0;
            }

            $page_data = new page;

            $page_data->title           = $data['name'];
            $page_data->sub_title       = $data['sub_title'];
            $page_data->url             = $data['url'];
            // $page_data->page_cat        = $data['page_cat'];
            $page_data->page_type       = $data['page_type'];
            $page_data->template_type   = $data['template_type'];
            $page_data->author          = $author;
            $page_data->content         = $data['description'];
            // $page_data->form            = $data['form'];
            $page_data->status          = $status;
            $page_data->featured        = $featured;

            // Upload Page image/icon
            if ($request->hasFile('featured_image')) {
                $image_tmp = Input::file('featured_image');
                if ($image_tmp->isValid()) {

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'Repid_Deals_' . rand(1, 99999) . '.' . $extension;
                    $large_image_path = 'images/frontend/page_images/large/' . $filename;
                    $small_image_path = 'images/frontend/page_images/small/' . $filename;
                    // Resize image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(569, 395)->save($small_image_path);

                    // Store image in Page Image folder
                    $page_data->page_image = $filename;
                }
            }
            $page_data->save();

            return redirect('/admin/pages')->with('flash_message_success', 'Page Published Successfully!');
        }

        $page_category = PageCategory::where(['parent_cat' => 0])->get();
        $page_category_dropdown = '<option value="0" selected="selected">Main Category</option>';

        foreach ($page_category as $pCategory) {
            $page_category_dropdown .= "<option value='" . $pCategory->id . "'><strong>" . $pCategory->name . "</strong></option>";
            $sub_page_category = PageCategory::where(['parent_cat' => $pCategory->id])->get();
            foreach ($sub_page_category as $sub_pCategory) {
                $page_category_dropdown .= "<option value='" . $sub_pCategory->id . "'>&nbsp;--&nbsp;" . $sub_pCategory->name . "</option>";
                $sub_sub_page_category = PageCategory::where(['parent_cat' => $sub_pCategory->id])->get();
                foreach ($sub_sub_page_category as $sub_subpCategory) {
                    $page_category_dropdown .= "<option value='" . $sub_subpCategory->id . "'>&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $sub_subpCategory->name . "</option>";
                }
            }
        }

        return view('admin.pages.new_page', compact('page_category_dropdown'));
    }

    // View All Page in Admin Panel
    public function pagesAll()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();

        return view('admin.pages.pages_all', compact('pages'));
    }

    // Single Page Detail Page Function
    public function singlePage($url=null)
    {
        $pages = Page::where('url', $url)->orderBy('created_at', 'desc')->get();
        // echo "<pre>"; print_r($pages); die;
        foreach($pages as $page){
            $temp = $page['template_type'];
            // echo "<pre>"; print_r($temp);
        }
        if( $temp == 1 ){
            return view('frontend.pages.single_page', compact('pages'));
        }else{
            return view('frontend.pages.single_page_template_2', compact('pages'));
        }
    }

    // Make a Page Publish
    public function publishPage(Request $request, $id=null)
    {
        if(!empty($id))
        {
            Page::where(['id' => $id])->update(['status' => 1]);
            return redirect()->back()->with('flash_message_success', 'Page Published Successfully!');
        }
    }

    // Make a Page Draft
    public function draftPage(Request $request, $id=null)
    {
        if(!empty($id))
        {
            Page::where(['id' => $id])->update(['status' => 0]);
            return redirect()->back()->with('flash_message_success', 'Page Drafted Successfully!');
        }
    }

    // Delete Page
    public function deletePage($id=null)
    {
        if(!empty($id))
        {
            Page::where('id', $id)->delete();
            return redirect()->back()->with('flash_message_success', 'page Delete Successfully!');
        }
    }

    // Edit Page
    public function editPage(Request $request, $id=null)
    {
        $pages = Page::where('id', $id)->first();
        $pages = json_decode(json_encode($pages));
        
        if($request->isMethod('post'))
        {

            $data = $request->all();

            if(!empty($data['status'])){
                $status = 1;
            }else{
                $status = 0;
            }
            if(!empty($data['feature_page'])){
                $featured = 1;
            }else{
                $featured = 0;
            }
    
            if(!empty($data['career_form'])){
                $career_form = 1;
            }else{
                $career_form = 0;
            }if(!empty($data['contact_form'])){
                $contact_form = 1;
            }else{
                $contact_form = 0;
            }
    
    
            if ($request->hasFile('featured_image')) {
                $image_tmp = Input::file('featured_image');
                if ($image_tmp->isValid()) {
    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'Repid_Deals_' . rand(1, 99999) . '.' . $extension;
                    $large_image_path = 'images/frontend/page_images/large/' . $filename;
                    $small_image_path = 'images/frontend/page_images/small/' . $filename;
                    // Resize image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(569, 395)->save($small_image_path);
    
                    // Store image in Page Image folder
                    
                    Page::where(['id' => $id])->update([
                        
                        'title'         =>$data['name'],
                        'sub_title'     =>$data['sub_title'],
                        'url'           =>$data['url'],
                        'page_cat'      =>$data['post_cat'],
                        'page_type'     =>$data['post_type'],
                        'template_type' =>$data['template_type'],
                        'contact_form'  =>$contact_form,
                        'career_form'   =>$career_form,
                        'content'       =>$data['description'],
                        'page_image'    =>$filename
    
                    ]);
                }
            }else{
    
                Page::where(['id' => $id])->update([
                    
                    'title'         =>$data['name'],
                    'sub_title'     =>$data['sub_title'],
                    'url'           =>$data['url'],
                    'page_cat'      =>$data['post_cat'],
                    'page_type'     =>$data['post_type'],
                    'template_type' =>$data['template_type'],
                    'contact_form'  =>$contact_form,
                    'career_form'   =>$career_form,
                    'content'       =>$data['description'],
    
                ]);
            }
        }

        $page_category = PageCategory::where(['parent_cat' => 0])->get();
        $page_category_dropdown = '<option value="0" selected="selected">Main Category</option>';

        foreach ($page_category as $pCategory) {
            $page_category_dropdown .= "<option value='" . $pCategory->id . "'><strong>" . $pCategory->name . "</strong></option>";
            $sub_page_category = PageCategory::where(['parent_cat' => $pCategory->id])->get();
            foreach ($sub_page_category as $sub_pCategory) {
                $page_category_dropdown .= "<option value='" . $sub_pCategory->id . "'>&nbsp;--&nbsp;" . $sub_pCategory->name . "</option>";
                $sub_sub_page_category = PageCategory::where(['parent_cat' => $sub_pCategory->id])->get();
                foreach ($sub_sub_page_category as $sub_subpCategory) {
                    $page_category_dropdown .= "<option value='" . $sub_subpCategory->id . "'>&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;" . $sub_subpCategory->name . "</option>";
                }
            }
        }

        return view('admin.pages.edit_pages', compact('pages', 'page_category_dropdown'));
    }

    public function updatePage(Request $request, $id=null)
    {   
  
        $data = $request->all();

        if(!empty($data['status'])){
            $status = 1;
        }else{
            $status = 0;
        }
        if(!empty($data['feature_page'])){
            $featured = 1;
        }else{
            $featured = 0;
        }

        if(!empty($data['career_form'])){
            $career_form = 1;
        }else{
            $career_form = 0;
        }if(!empty($data['contact_form'])){
            $contact_form = 1;
        }else{
            $contact_form = 0;
        }


        if ($request->hasFile('featured_image')) {
            $image_tmp = Input::file('featured_image');
            if ($image_tmp->isValid()) {

                $extension = $image_tmp->getClientOriginalExtension();
                $filename = 'Repid_Deals_' . rand(1, 99999) . '.' . $extension;
                $large_image_path = 'images/frontend/page_images/large/' . $filename;
                $small_image_path = 'images/frontend/page_images/small/' . $filename;
                // Resize image
                Image::make($image_tmp)->save($large_image_path);
                Image::make($image_tmp)->resize(569, 395)->save($small_image_path);

                // Store image in Page Image folder
                
                Page::where(['id' => $id])->update([
                    
                    'title'         =>$data['name'],
                    'sub_title'     =>$data['sub_title'],
                    'url'           =>$data['url'],
                    // 'page_cat'      =>$data['post_cat'],
                    'page_type'     =>$data['post_type'],
                    'template_type' =>$data['template_type'],
                    'contact_form'  =>$contact_form,
                    'career_form'   =>$career_form,
                    'content'       =>$data['description'],
                    'page_image'    =>$filename

                ]);
            }
        }else{

            Page::where(['id' => $id])->update([
                
                'title'         =>$data['name'],
                'sub_title'     =>$data['sub_title'],
                'url'           =>$data['url'],
                // 'page_cat'      =>$data['post_cat'],
                'page_type'     =>$data['post_type'],
                'template_type' =>$data['template_type'],
                'contact_form'  =>$contact_form,
                'career_form'   =>$career_form,
                'content'       =>$data['description'],

            ]);
        }
        $pages = Page::orderBy('created_at', 'desc')->get();
        return view('admin.pages.pages_all', compact('pages'));
    }
}
