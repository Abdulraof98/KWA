<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use DataTables;;
use Validator;
use App\Models\Blog;
use App\Models\Event;

class EventController extends AdminController
{
    public function index()
    {
        $data = [];
        return view('admin::event.index',$data);
    }

    public function event_list()
    {
        $event = Event::where('status', '<>', '3')->latest()->get();
        return Datatables::of($event)
            ->addIndexColumn()
            ->editColumn('created_at', function ($model) {
                return Carbon::parse($model->created_at)->diffForHumans();
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-editevent', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                        . '<i class="fa fa-edit"></i>'
                        . '</a>'
                        . '<a href="javascript:void(0);" onclick="deleteEvent(this);" data-href="' . Route("admin-deleteevent", ['id' => $model->id]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                        . '<i class="fa fa-trash"></i>'
                        . '</a>';
                // $action_html="";
                return $action_html;
            })
            ->make(true);
    }

    public function add()
    {
        $data = [];
        return view('admin::event.add');
    }

    public function post_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_en' => 'required|max:250',
            'title_dr' => 'required|max:250',
            'description_en' => 'required',
            'description_dr' => 'required',
            'image'=>'required|mimes:jpeg,jpg,png,gif',
            'status' => 'required'
        ]);

        if ($validator->passes()) {
            $input = $request->input();
            $destinationPath = 'public/uploads\admin\event';
            if($request->hasFile('image')) {
                $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
                $file = $request->file('image');
                $file->move(public_path('uploads/admin/event/'), $img_name);
                $input['image']=$img_name;
            }else{
                $input['image']="";
            }
            Event::create($input);
            $request->session()->flash('success', 'Event added successfully.');
            return redirect()->route('admin-event')->withErrors($validator)->withInput();
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $data = [];
        $data['model'] = Event::find($id);
        return view('admin::event.edit',$data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->start_date);
        $validator = Validator::make($request->all(), [
            'title_en' => 'required|max:250',
            'title_dr' => 'required|max:250',
            'description_en' => 'required',
            'description_dr' => 'required',
            // 'image'=>'required|mimes:jpeg,jpg,png,gif',
            'status' => 'required'
        ]);
    
        if ($validator->passes()) {
            $input = $request->input();
            $destinationPath = 'public/uploads\admin\event';
            if($request->hasFile('image')) {
                $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
                $file = $request->file('image');
                $file->move(public_path('uploads/admin/event/'), $img_name);
                $input['image']=$img_name;
            }else{
                unset($input['image']);
            }
            Event::find($id)->update($input);
            $request->session()->flash('success', 'Event updated successfully.');
            return redirect()->route('admin-event')->withErrors($validator)->withInput();
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function view($id)
    {
        $data = [];
        return view('event.view');
    }

    public function delete_event(Request $request)
    {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $model = Event::findOrFail($_GET['id']);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';
                $model->save();
                $request->session()->flash('success', 'Event deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-event');
    }

}
