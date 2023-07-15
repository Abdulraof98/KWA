<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use DataTables;;
use Validator;
use App\Models\Category;
use App\Models\Challenge;
use App\Models\ChallengeImage;
use App\Models\Participant;
use App\Models\UserMaster;
use URL;

class ChallengeController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        return view('admin::challenge.index', $data);
    }

    public function challenge_list()
    {
        $category_list = Challenge::select("challenges.*","user_master.first_name","user_master.last_name","categories.name as c_name")
                ->join('categories',"challenges.category","categories.id")
                ->join('user_master',"challenges.user_id","user_master.id")
                ->where('challenges.status', '1');
        return Datatables::of($category_list)
            ->addIndexColumn()
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->addColumn('first_name', function ($model) {
                return $model->user->name;
            })
            ->editColumn('categories.name', function ($model) {
                return $model->c_name;
            })
            ->editColumn('participation_start', function ($model) {
                if ($model->participants == '1') {
                    if($model->participation_duration == "Yes"){
                        return date("Y-m-d", strtotime($model->participation_expiry));
                    }else{
                        return 'Not limited';
                    }
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('voting_start', function ($model) {
                if($model->voting_duration == "Yes"){
                    return date("Y-m-d", strtotime($model->voting_expiry));
                }else{
                    return 'Not limited';
                }
            })
            ->editColumn('voting_type', function ($model) {
                return $model->voting_type;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-viewchallenge', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="view">'
                        . '<i class="fa fa-eye"></i>'
                        . '</a>';
                        if ($model->participants == '1') {
                            $action_html .='<a href="' . Route('admin-participants', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Participants">'
                            . '<i class="fa fa-users"></i>'
                            . '</a>';
                        }
                        $action_html .='<a href="javascript:void(0);" onclick="deleteChallenge(this);" data-href="' . Route("admin-deletechallenge", ['id' => $model->id]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                        . '<i class="fa fa-trash"></i>'
                        . '</a>';
                // $action_html="";
                return $action_html;
            })
            ->make(true);
    }

    public function challenge_view($id)
    {
        $data=[];
        $data['model'] = $model = Challenge::findOrFail($id);
        return view('admin::challenge.view', $data);
    }
    
    public function delete(Request $request) {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $model = Challenge::findOrFail($_GET['id']);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';
                $model->save();
                $images= ChallengeImage::where("challenge_id",$model->id)->get();
                foreach ($images as $value)
                {
                    $image=ChallengeImage::findOrFail($value->id);
                    $image->status="3";
                    $image->save();
                }
                $request->session()->flash('success', 'Challenge deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-challenge');
    }

    public function participants()
    {
        $data = [];
        return view('admin::challenge.participants',$data);
    }

    public function participant_list(Request $r){
       $data = Participant::where('challenge_id',$r->cid);
       return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function ($model) {
                return $model->user->name;
            })
            ->addColumn('email', function ($model) {
                return $model->user->email;
            })
            ->editColumn('image_name', function ($model) {
                if ($model->challenge->type == '1') {
                    return URL::asset('public/uploads/frontend/challenge/'.$model->image_name);
                }else{
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $model->image_name, $match);
                    $youtube_id = $match[1];
                    return 'https://img.youtube.com/vi/'.$youtube_id.'/hqdefault.jpg';
                }
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-view-participant', ['pid' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="view">'
                        . '<i class="fa fa-eye"></i>'
                        . '</a>';
                // $action_html="";
                return $action_html;
            })
            ->make(true);
    }

    public function view_participant($pid)
    {
        $data = [];
        $data['model'] = Participant::find($pid);
        return view('admin::challenge.view_participant',$data);
    }

    public function selected_challenges_feed()
    {
        $data = [];
        $data['model'] = Challenge::where("feed","0")->where("status","1")->where('voting_type','Public')
        ->where(function ($query) {
            $query->where('participation_start','<',date('Y-m-d'))
            ->orWhere('participation_start',null)
            ->orWhere('participation_end','>',date('Y-m-d'))
            ->orWhere('participation_end',null);
        })
        ->where(function ($query) {
            $query->where('voting_start','<',date('Y-m-d'))
            ->orWhere('voting_start',null)
            ->orWhere('voting_end','>',date('Y-m-d'))
            ->orWhere('voting_end',null);
        })->get();
        $data['type'] = 1;
        return view('admin::challenge.selected_challenges', $data);
    }

    public function selected_popular_creator()
    {
        $data = [];
        $data['model'] = UserMaster::where("popular_creator","0")->where("status","<>",'3')->where('type_id','2')->get();
        $data['type'] = 3;
        return view('admin::challenge.selected_challenges', $data);
    }

    public function selected_challenges_trending()
    {
        $data = [];
        $data['model'] = Challenge::where("trending","0")
        ->where("status","1")->where('voting_type','Public')
        ->where(function ($query) {
            $query->where('participation_start','<',date('Y-m-d'))
            ->orWhere('participation_start',null)
            ->orWhere('participation_end','>',date('Y-m-d'))
            ->orWhere('participation_end',null);
        })
        ->where(function ($query) {
            $query->where('voting_start','<',date('Y-m-d'))
            ->orWhere('voting_start',null)
            ->orWhere('voting_end','>',date('Y-m-d'))
            ->orWhere('voting_end',null);
        })->get();
        $data['type'] = 2;
        return view('admin::challenge.selected_challenges', $data);
    }

    public function selected_challenges_recommended()
    {
        $data = [];
        $data['model'] = Challenge::where("recommended","0")
        ->where("status","1")->where('voting_type','Public')
        ->where(function ($query) {
            $query->where('participation_start','<',date('Y-m-d'))
            ->orWhere('participation_start',null)
            ->orWhere('participation_end','>',date('Y-m-d'))
            ->orWhere('participation_end',null);
        })
        ->where(function ($query) {
            $query->where('voting_start','<',date('Y-m-d'))
            ->orWhere('voting_start',null)
            ->orWhere('voting_end','>',date('Y-m-d'))
            ->orWhere('voting_end',null);
        })->get();
        $data['type'] = 4;
        return view('admin::challenge.selected_challenges', $data);
    }

    public function selected_challenge_datatable(Request $r)
    {
        if ($r->type == 1) {
            $data = Challenge::where("feed","1")->where("status","1")->where('voting_type','Public')
            ->where(function ($query) {
                $query->where('participation_start','<',date('Y-m-d'))
                ->orWhere('participation_start',null)
                ->orWhere('participation_end','>',date('Y-m-d'))
                ->orWhere('participation_end',null);
            })
            ->where(function ($query) {
                $query->where('voting_start','<',date('Y-m-d'))
                ->orWhere('voting_start',null)
                ->orWhere('voting_end','>',date('Y-m-d'))
                ->orWhere('voting_end',null);
            })->orderBy('feed_date','DESC')->get();
        } elseif($r->type == 2) {
            $data= Challenge::where("trending","1")->where("status","1")->where('voting_type','Public')
            ->where(function ($query) {
                $query->where('participation_start','<',date('Y-m-d'))
                ->orWhere('participation_start',null)
                ->orWhere('participation_end','>',date('Y-m-d'))
                ->orWhere('participation_end',null);
            })
            ->where(function ($query) {
                $query->where('voting_start','<',date('Y-m-d'))
                ->orWhere('voting_start',null)
                ->orWhere('voting_end','>',date('Y-m-d'))
                ->orWhere('voting_end',null);
            })->orderBy('trending_date','DESC')->get();
        }elseif($r->type == 4) {
            $data= Challenge::where("recommended","1")->where("status","1")->where('voting_type','Public')
            ->where(function ($query) {
                $query->where('participation_start','<',date('Y-m-d'))
                ->orWhere('participation_start',null)
                ->orWhere('participation_end','>',date('Y-m-d'))
                ->orWhere('participation_end',null);
            })
            ->where(function ($query) {
                $query->where('voting_start','<',date('Y-m-d'))
                ->orWhere('voting_start',null)
                ->orWhere('voting_end','>',date('Y-m-d'))
                ->orWhere('voting_end',null);
            })->orderBy('recommended_date','DESC')->get();
        }else{
            $data = UserMaster::where("popular_creator","1")->where("status","<>",'3')->where('type_id','2')
            ->orderBy('popularity_date','DESC')->get();
        }
        $response = Datatables::of($data)
            ->addColumn('action', function ($model) {
                $action_html = '<input type="checkbox" class="ids" name="ids[]" value="'.$model->id.'">';
                return $action_html;
            })
            ->addIndexColumn();
            if ($r->type != 3) {
                $response->editColumn('image_name', function ($model) {
                    return URL::asset('public/uploads/frontend/challenge/'.$model->image);
                });
            } else {
                $response->addColumn('image_name', function ($model) {
                    if ($model->profile_picture == NULL ) {
                        return URL::asset('public/frontend/img/avatar.png');
                    }else{
                        return URL::asset('public/uploads/frontend/profile_picture/preview/'.$model->profile_picture);
                    }
                })
                ->editColumn('name', function ($model) {
                    return ucfirst($model->name);
                });
            }
            if ($r->type==1) {
                $response->addColumn('date', function ($model) {
                    return date("jS M Y, g:i A", strtotime($model->feed_date));
                });
            }elseif($r->type==2){
                $response->addColumn('date', function ($model) {
                    return date("jS M Y, g:i A", strtotime($model->trending_date));
                });
            }
            elseif($r->type==4){
                $response->addColumn('date', function ($model) {
                    return date("jS M Y, g:i A", strtotime($model->recommended_date));
                });
            }else{
                $response->addColumn('date', function ($model) {
                    return date("jS M Y, g:i A", strtotime($model->popularity_date));
                });
            }
            return $response->rawColumns(['action'])
                ->make(true);
    }

    public function add_selected_challenge(Request $r)
    {
        $response = [];
        if ($r->type == 1) {
            Challenge::find($r->cid)->update([
                'feed'=>'1',
                'feed_date'=>Carbon::now()
            ]);
            $response['challenge'] = Challenge::where("feed","0")->where("status","1")->where('voting_type','Public')
            ->where(function ($query) {
                $query->where('participation_start','<',date('Y-m-d'))
                ->orWhere('participation_start',null)
                ->orWhere('participation_end','>',date('Y-m-d'))
                ->orWhere('participation_end',null);
            })
            ->where(function ($query) {
                $query->where('voting_start','<',date('Y-m-d'))
                ->orWhere('voting_start',null)
                ->orWhere('voting_end','>',date('Y-m-d'))
                ->orWhere('voting_end',null);
            })->get();
        } elseif($r->type == 2) {
            Challenge::find($r->cid)->update([
                'trending'=>'1',
                'trending_date'=>Carbon::now()
            ]);
            $response['challenge'] = Challenge::where("trending","0")->where("status","1")->where('voting_type','Public')
            ->where(function ($query) {
                $query->where('participation_start','<',date('Y-m-d'))
                ->orWhere('participation_start',null)
                ->orWhere('participation_end','>',date('Y-m-d'))
                ->orWhere('participation_end',null);
            })
            ->where(function ($query) {
                $query->where('voting_start','<',date('Y-m-d'))
                ->orWhere('voting_start',null)
                ->orWhere('voting_end','>',date('Y-m-d'))
                ->orWhere('voting_end',null);
            })->get();
        }elseif($r->type == 4) {
            Challenge::find($r->cid)->update([
                'recommended'=>'1',
                'recommended_date'=>Carbon::now()
            ]);
            $response['challenge'] = Challenge::where("recommended","0")->where("status","1")->where('voting_type','Public')
            ->where(function ($query) {
                $query->where('participation_start','<',date('Y-m-d'))
                ->orWhere('participation_start',null)
                ->orWhere('participation_end','>',date('Y-m-d'))
                ->orWhere('participation_end',null);
            })
            ->where(function ($query) {
                $query->where('voting_start','<',date('Y-m-d'))
                ->orWhere('voting_start',null)
                ->orWhere('voting_end','>',date('Y-m-d'))
                ->orWhere('voting_end',null);
            })->get();
        }else{
            UserMaster::find($r->cid)->update([
                'popular_creator'=>'1',
                'popularity_date'=>Carbon::now()
            ]);
            $response['challenge'] = UserMaster::where("popular_creator","0")->where("status","<>","3")->where('type_id','2')->get();
        }
        if (count($response['challenge']) > 0) {
            $response['success'] = true;
        }else{
            $response['success'] = false;
        }
        return response()->json($response);
    }

    public function remove_selected_challenge(Request $r)
    {
        $response = [];
        for ($i=0; $i < count($r->cids); $i++) { 
            if ($r->type==1) {
                Challenge::find($r->cids[$i])->update([
                    'feed'=>'0',
                ]);
            } elseif($r->type==2) {
                Challenge::find($r->cids[$i])->update([
                    'trending'=>'0',
                ]);
            }elseif($r->type == 4) {
                Challenge::find($r->cids[$i])->update([
                    'recommended'=>'0',
                ]);
            }else{
                UserMaster::find($r->cids[$i])->update([
                    'popular_creator'=>'0',
                ]);
            }
        }
        $response['success'] = true;
        return response()->json($response);
    }

}
