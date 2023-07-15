<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use App\Models\SubscriptionPlan;
use App\Models\Country;

class SubscrptionController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
         $data = [];
         return view('admin::subscription.index', $data);
     }

    public function plan_list()
    {
        $plan_list = SubscriptionPlan::where('status', '<>', '3');
        return Datatables::of($plan_list)
            ->addIndexColumn()
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('amount', function ($model) {
                return $model->amount;
            })
            ->editColumn('currency', function ($model) {
                return $model->currency;
            })
            ->editColumn('duration', function ($model) {
                return $model->duration;
            })
            ->editColumn('total_number', function ($model) {
                return $model->total_number;
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                if($model->name!="Free")
                {
                $action_html = '<a href="' . Route('admin-editsunscriptionplan', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                        . '<i class="fa fa-edit"></i>'
                        . '</a>';
                        // . '<a href="javascript:void(0);" onclick="deleteUser(this);" data-href="' . Route("admin-deleteuser", ['id' => $model->id]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                        // . '<i class="fa fa-trash"></i>'
                        // . '</a>';
                       
                // $action_html="";
                }else{
                    $action_html="";
                }
                return $action_html;
            })
            ->make(true);
    }

    public function edit($id)
    {
        $data=[];
        $data['model'] = $model = SubscriptionPlan::find($id);
        return view('admin::subscription.update', $data);
    }

    public function update(Request $request,$id)
    {

        $data = [];
        $model = SubscriptionPlan::find($id);

        $validator = Validator::make($request->all(), [
                    'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                    'status' => 'required',
        ]);
        
        if($validator->passes()) {
            $model->amount = $request->amount;
            $model->status = $request->status;
            $model->save();
            $request->session()->flash('success', 'Plan updated successfully.');
            return redirect()->route('admin-subscriptionplan')->withErrors($validator)->withInput();
        }else{
            return redirect()->route('admin-editsunscriptionplan', ['id' => $id])->withErrors($validator)->withInput();
        }
    }

 }
