<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page','cms-pages');

        $cmsPages = CmsPage::get()->toArray();
        // echo "<pre>"; print_r($cmsPages); die;

        return view('admin.pages.cms_pages')->with(compact('cmsPages'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id=null)
    {
        if($id==""){
            $title = "Add CMS Page";
            $cmspage = new CmsPage;
            $message = "CMS page added succesfully";
           }else{
            $title = "Edit CMS Page";
            $cmspage = CmsPage::find($id);
            $message = 'CMS Page updated succesfully';
           }
    
           if($request->isMethod('post')){
              $data = $request->all();
              
    
              $rules = [
                'title' => 'required',
                'url' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required',
                'meta_keywords' => 'required' 
              ];
    
              $customMessages = [
                'title.required' => 'Title field is mandatory',
                'url.required' => 'URL  field is mandatory',
                'meta_title.required' => 'Meta title field is mandatory',
                'meta_description.required' => 'Meta description is mandatory',
                'meta_keywords.required' => 'Meta Keywords is mandatory',
    
              ];
    
              $this->validate($request, $rules, $customMessages);
    
              $cmspage->title = $data['title'];
              $cmspage->url= $data['url'];
              $cmspage->description = $data['description'];
              $cmspage->meta_title = $data['meta_title'];
              $cmspage->meta_description = $data['meta_description'];
              $cmspage->meta_keywords = $data['meta_keywords'];
              $cmspage->status = 1;
              $cmspage->save();
    
              return redirect('admin/cms-pages')->with('success_message', $message);
           }
           return view('admin.pages.add_edit_cmspages')->with(compact('title', 'cmspage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();

            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }

            CmsPage::where('id', $data['page_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status, 'page_id'=>$data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CmsPage::where('id', $id)->delete();

        return redirect()->back()->with('succes_message', 'CMS Page deleted succesfully');
    }
}
