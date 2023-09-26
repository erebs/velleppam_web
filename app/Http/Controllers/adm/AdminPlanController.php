<?php

namespace App\Http\Controllers\adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,Auth,Cache;
use App\Models\plan;
use App\Models\deposit;

class AdminPlanController extends Controller
{
    public function add_plan()
    {
        return view('plan.AddPlan');
    }

    public function plan_add(Request $req)
    {
       
       if(plan::where('name',$req->name)->exists())
       {
        $data['err']="error";
       }
       else
       {
                plan::create([
                'class_mode'=>$req->cmode,
                'name'=>$req->name,
                'month'=>$req->month,
                'actual_fee'=>$req->actual_fee,
                'offer_fee'=>$req->offer_fee,
                'monthly_fee'=>$req->installment,
                'status'=>'Active',

            ]) ;
            $data['success']="success";
       } 

        
        echo json_encode($data);
       
    }

    public function plans()
    {
        $plans=plan::where('status','Active')->latest()->get();
        return view('plan.Plans',['plans'=>$plans]);
    }

     public function delete_plan(Request $req)
    {
      
                plan::where('id',$req->body)->update([
                'status'=>'Deleted',

            ]) ;
            $data['success']="success";
       
        echo json_encode($data);
       
    }
    public function edit_plan($pid)
    {
        $planid=decrypt($pid);
        $plan=plan::where('id',$planid)->first();
        return view('plan.EditPlan',['plan'=>$plan]);
    }

        public function plan_edit(Request $req)
    {
       
       if(plan::where('name',$req->name)->where('id','!=',$req->planid)->exists())
       {
        $data['err']="error";
       }
       else
       {
                plan::where('id',$req->planid)->update([
                'class_mode'=>$req->cmode,
                'name'=>$req->name,
                'month'=>$req->month,
                'actual_fee'=>$req->actual_fee,
                'offer_fee'=>$req->offer_fee,
                'monthly_fee'=>$req->installment,

            ]) ;
            $data['success']="success";
       } 

        
        echo json_encode($data);
       
    }


    ///////////////////////


    public function deposit()
    {
        $deposit=deposit::get();
        return view('plan.Deposit',['deposit'=>$deposit]);
    }

            public function deposit_edit(Request $req)
    {
       
            deposit::where('id',$req->buid)->update([
                'fee'=>$req->amt,

            ]) ;
            $data['success']="success";
       
        echo json_encode($data);
       
    }
}
