<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Models\Cms;
use Intervention\Image\ImageManagerStatic as Image;
use Session;

class CmsController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        // $data['page_name'] = $page_name = isset($_GET['page_name']) ? $_GET['page_name'] : "";
        // $data['title_en'] = $title_en = isset($_GET['title_en']) ? $_GET['title_en'] : "";
        // $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        // $query = Cms::where('slug', 'like', '%');
        // if ($page_name != "") {
        //     $query->where('page_name', 'like', '%' . $page_name . '%');
        // }
        // if ($title_en != "") {
        //     $query->where('title_en', 'like', '%' . $title_en . '%');
        // }
        $model = Cms::where('status','<>','2')->paginate(100);
        $data['model'] = $model;
        return view('admin::cms.index', $data);
    }

    public function view($id) {
        $data = [];
        $data['model'] = Cms::findOrFail($id);
        return view('admin::cms.view', $data);
    }
    public function create(){
        $data=[];
        
        return view('admin::cms.addcms');
    }
    public function create_post(Request $request){
       
            $input=[];
            $input=$request->except('_token');
            $input['type']='1'; //text
             
            Cms::create($input);
            $request->session()->flash('success','Class Added Successfully');

            return $this->index();
    }

    public function get_update($id) {
        $data = [];
        $data['model'] = Cms::findOrFail($id);
        return view('admin::cms.update', $data);
    }

    public function post_update(Request $request, $id) {
        $data = [];
        $model = Cms::findOrFail($id);
        $input=$request->except('_token');
        Cms::where('id',$id)->update($input);
            $request->session()->flash('success', 'Content updated successfully.');
        
        return redirect()->route('admin-updatecms', ['id' => $id])->withInput();
    }
    public function delete_cms($id){
         Cms::where('id',$id)->update(['status'=>'2']);
         Session::flash('success','CMS Deleted Successfully');
         return $this->index();
    }

}
