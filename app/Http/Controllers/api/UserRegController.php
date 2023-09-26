<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime,DB;

use App\Models\slote;
use App\Models\branch;
use App\Models\student;
use App\Models\plan;
use App\Models\deposit;
use App\Models\installment;

class UserRegController extends Controller
{
    public function branches()
        {

            $branches=branch::where('status','Active')->get();

            return response()->json([

                    'branches'=>$branches,
                    'status_code'=>'01'
                    ],200);
        }

        //        public function online_slotes(Request $req)
        // {
        //     $slotes = slote::where('class_mode', 'Online')
        //         ->where('day', $req->day)
        //         ->where('status', 'Active')
        //         ->get();

        //     foreach ($slotes as $s) {
        //         $std = student::where('slote', $s->id)
        //             ->where('status', 'Active')
        //             ->count();

        //         if ($std < $s->slote_limit) {
        //             $s->availability = 'Available';
        //         } else {
        //             $s->availability = 'Not Available';
        //         }
        //     }

        //     return response()->json([
        //         'slotes' => $slotes,
        //         'status_code' => '01',
        //     ], 200);
        // }

        // public function offline_slotes(Request $req)
        // {
        //     $slotes = slote::where('class_mode', 'Offline')
        //         ->where('branch', $req->branch_id)
        //         ->where('day', $req->day)
        //         ->where('status', 'Active')
        //         ->get();

        //     foreach ($slotes as $s) {
        //         $std = student::where('slote', $s->id)
        //             ->where('status', 'Active')
        //             ->count();

        //         if ($std < $s->slote_limit) {
        //             $s->availability = 'Available';
        //         } else {
        //             $s->availability = 'Not Available';
        //         }
        //     }

        //     return response()->json([
        //         'slotes' => $slotes,
        //         'status_code' => '01',
        //     ], 200);
        // }

        // public function online_plans()
        // {

        //     $plans=plan::where('class_mode','Online')->where('status','Active')->get();

        //     return response()->json([

        //             'plans'=>$plans,
        //             'status_code'=>'01'
        //             ],200);
        // }

        //  public function offline_plans()
        // {

        //     $plans=plan::where('class_mode','Offline')->where('status','Active')->get();

        //     return response()->json([

        //             'plans'=>$plans,
        //             'status_code'=>'01'
        //             ],200);
        // }



             public function check(Request $req)
    {
        $rules = [
                    
                    'mobile' => 'required',
                   

                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    if(student::where('mobile',$req->mobile)->exists())
                    {
                        return response()->json(['message'=>"Mobile number already exists",'status_code'=>'00'],400);
                    }
                    else
                    {
                        
                        return response()->json([

                            'message'=>'Mobile number verified successfully',
                            'status_code'=>'01'
                            ],200);

                     }

                 }
    }


      public function register(Request $req)
    {
        $rules = [
                    'name' => 'required',
                    'mobile' => 'required',
                    'dob' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                    'class_mode' => 'required',

                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    if(student::where('mobile',$req->mobile)->exists())
                    {
                        return response()->json(['message'=>"Mobile number already exists",'status_code'=>'00'],400);
                    }
                    else
                    {
                        student::create([

                            'name'=>$req->name,
                            'mobile'=>$req->mobile,
                            'dob'=>$req->dob,
                            'guardian'=>$req->guardian,
                            'alternative_mobile'=>$req->alternative_mobile,
                            'email'=>$req->email,
                            'address'=>$req->address,
                            'class_mode'=>$req->class_mode,
                            'branch'=>$req->branch,
                            'slote'=>0,
                            'deposit_status'=>'Pending',
                            'payment_status'=>'Pending',
                            'approval'=>'Pending',
                            'status'=>'Active',
                            'password'=>bcrypt($req->password)


                        ]);

                        $user=student::where('mobile', $req->mobile)->first(); 
                        $token=$user->createToken('user-app')->plainTextToken;
                        return response()->json([

                            'message'=>'Registration completed successfully.',
                            'token'=>$token,    
                            'name'=>$user->name,
                            'class_mode'=>$user->class_mode, 
                            'slote'=>$user->slote,
                            'status_code'=>'01'
                            ],200);

                     }

                 }
    }


            public function login(Request $req)
    {
        $rules = [

                    'mobile' => 'required',
                    'password' => 'required',

                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    $user=student::where('mobile', $req->mobile)->first(); 
                    if($user)
                        {
                            if(Hash::check($req->password,$user->password))
                            {
                                $token=$user->createToken('user-app')->plainTextToken;

                                return response()->json([

                               // 'user_id'=>$user->id,    
                                'token'=>$token,    
                                'name'=>$user->name,
                                'class_mode'=>$user->class_mode, 
                                'slote'=>$user->slote,   
                                'message'=>'Login Success',
                                'status_code'=>'01'
                                ],200);
                            }
                            else
                            {
                                return response()->json([

                                'message'=>'Incorrect password ',
                                'status_code'=>'00'
                                ],400);
                            }
                          
                        }
                        else
                            {
                                return response()->json([

                                'message'=>'Invalid user ',
                                'status_code'=>'00'
                                ],400);
                            }

                 }
    }


     public function send_otp(Request $req)
    {
        
            

           $user=student::where('mobile',$req->mobile)->first();

           if($user)
        {
            //$otp = rand(1000, 9999);
            $otp='1111';
             // $response=Http::get('http://sms.erebs.in/api/sms_api.php?username=trac&api_password=9m82v925wrf&template_id=1207168616683035285&message=Hello '.$user->name.', your verification code is: '.$otp.'. Please enter this code to complete your shop registration. Thank you, Tool Rental Association for Care.&destination='.$req->mob.'&type=2&sender=TRACAP');

            return response()->json([
                    'otp'=>intval($otp),
                    'message'=>'Otp sent successfully',
                    'status_code'=>'01'
                    ],200);
        }
        else
        {
           return response()->json([
                    'message'=>'Invalid mobile number',
                    'status_code'=>'00'
                    ],400);
        }
        
    }

     public function reset_password(Request $req)
    {
        $user=student::where('mobile',$req->mobile)->first();

           if($user)
        {
        
          student::where('mobile',$req->mobile)->update([

            'password'=>bcrypt($req->password),

          ]);

           return response()->json([
                    'message'=>'Password changed successfully',
                    'status_code'=>'01'
                    ],200);
         }
         else
         {
            return response()->json([
                    'message'=>'Invalid mobile number',
                    'status_code'=>'00'
                    ],400);
         }  
        
    }


    /////////////////////////////////////


             public function get_plans()
        {
            $stdid=auth()->user()->id;
            $stddet=student::select('class_mode')->where('id',$stdid)->first();
            $plans=plan::where('class_mode',$stddet->class_mode)->where('status','Active')->get();

            return response()->json([

                    'plans'=>$plans,
                    'status_code'=>'01'
                    ],200);
        }

          public function deposit_amount()
        {

            $deposit_amount=deposit::where('id',1)->first();

            return response()->json([

                    'deposit_amount'=>$deposit_amount->fee,
                    'status_code'=>'01'
                    ],200);
        }

        public function get_slotes(Request $req)
        {
            $stdid=auth()->user()->id;
            $stddet=student::select('class_mode','branch')->where('id',$stdid)->first();
            if($stddet->class_mode=='Offline')
            {
                    $slotes = slote::where('class_mode', 'Offline')
                        ->where('branch', $stddet->branch)
                        ->where('day', $req->day)
                        ->where('status', 'Active')
                        ->get();

                    foreach ($slotes as $s) {
                        $std = student::where('slote', $s->id)
                            ->where('status', 'Active')
                            ->count();

                        if ($std < $s->slote_limit) {
                            $s->availability = 'Available';
                        } else {
                            $s->availability = 'Not Available';
                        }
                    }

                    return response()->json([
                        'slotes' => $slotes,
                        'status_code' => '01',
                    ], 200); 
              }
              else
              {
                 $slotes = slote::where('class_mode', 'Online')
                        ->where('day', $req->day)
                        ->where('status', 'Active')
                        ->get();

                    foreach ($slotes as $s) {
                        $std = student::where('slote', $s->id)
                            ->where('status', 'Active')
                            ->count();

                        if ($std < $s->slote_limit) {
                            $s->availability = 'Available';
                        } else {
                            $s->availability = 'Not Available';
                        }
                    }

                    return response()->json([
                        'slotes' => $slotes,
                        'status_code' => '01',
                    ], 200);
              }         
        }



        ///////////////////////////////////////


        public function fee_details(Request $req)
{
    $stdid = auth()->user()->id;
    // $stddet = student::select('class_mode', 'branch')->where('id', $stdid)->first();
    $plan = plan::where('id', $req->plan_id)->first();
    $deposit = deposit::where('id', 1)->first();

    $startDay = $req->day;
    $startDate = $req->joining_date;
    $currentDate = new DateTime($startDate);
    $lastDayOfMonth = new DateTime($currentDate->format('Y-m-t'));
    $dayCount = 0;
    while ($currentDate <= $lastDayOfMonth) {
        if ($currentDate->format('l') === $startDay) {
            $dayCount++;
        }
        $currentDate->modify('+1 day');
    }

    if($dayCount>=4)
    {
        
           $firstDate = date('Y-m-01', strtotime($req->joining_date));
           $mon=$plan->month-1;
           $endDate = date('Y-m-t', strtotime($firstDate . " +$mon months"));


        if($req->pay_type=='Full')
        {
               return response()->json([
               'fee' => $plan->offer_fee,
               'extra_fee' =>0,
               'deposit' => $deposit->fee,
               'joining_date' => $req->joining_date,
               'valid_from' => $firstDate,
               'valid_to' => $endDate,
               'status_code' => '01',
                ], 200); 
        }
        else
        {
                return response()->json([
               'fee' => $plan->monthly_fee,
               'extra_fee' =>0,
               'deposit' => $deposit->fee,
                'joining_date' => $req->joining_date,
               'valid_from' => $firstDate,
               'valid_to' => $endDate,
               'status_code' => '01',
                ], 200); 
         }
    }
    else
    {
        $firstDate = date('Y-m-01', strtotime($req->joining_date . " 1 months"));
        $mon=$plan->month-1;
        $endDate = date('Y-m-t', strtotime($firstDate . " +$mon months"));
        $extra_fee=($plan->monthly_fee/4)*$dayCount;

        if($req->pay_type=='Full')
        {
               return response()->json([
               'fee' => $plan->offer_fee,
               'extra_fee' =>$extra_fee,
               'deposit' => $deposit->fee,
               'joining_date' => $req->joining_date,
               'valid_from' => $firstDate,
               'valid_to' => $endDate,
               'status_code' => '01',
                ], 200); 
        }
        else
        {
                return response()->json([
               'fee' => $plan->monthly_fee,
               'extra_fee' =>$extra_fee,
               'deposit' => $deposit->fee,
                'joining_date' => $req->joining_date,
               'valid_from' => $firstDate,
               'valid_to' => $endDate,
               'status_code' => '01',
                ], 200); 
         }

    }


}


      public function book_slote(Request $req)
    {
        $stdid = auth()->user()->id;
        $rules = [
                    'slote_id' => 'required',
                    'plan_id' => 'required',
                    'pay_type' => 'required',
                    'joining_date' => 'required',
                    'valid_from' => 'required',
                    'valid_to' => 'required',
                    'fee' => 'required',
                    'extra_fee' => 'required',
                    'deposit' => 'required',
                    'paid_amount' => 'required',
                    'payment_method' => 'required',
                    'reference_id' => 'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Validation error",'status_code'=>'00'],400);
                } 
            else 
                {
                    
                        student::where('id',$stdid)->update([


                            'slote'=>$req->slote_id,
                            'plan'=>$req->plan_id,
                            'joining_date'=>$req->joining_date,
                            'valid_from'=>$req->valid_from,
                            'valid_to'=>$req->valid_to,
                            'fee'=>$req->fee,
                            'extra_fee'=>$req->extra_fee,

                            'deposit_status'=>'Paid',
                            'deposit_method'=>'Online',
                            'deposit_amount'=>$req->deposit,
                            'deposit_date'=>date('Y-m-d'),
                            'deposit_reference_id'=>$req->reference_id,
                            'deposit_repay_status'=>'Pending',

                            'payment_type'=>$req->pay_type,
                            'payment_method'=>$req->payment_method,
                            'payment_approval'=>'Pending',
                            'payment_status'=>'Paid',
                            'paid_amount'=>$req->paid_amount,
                            'payment_date'=>date('Y-m-d'),
                            'reference_id'=>$req->reference_id,

                        ]);

                        if($req->pay_type=='Monthly')
                        {
                            installment::create([


                            'student_id'=>$stdid,
                            'plan_id'=>$req->plan_id,
                            'payment_method'=>'Online',
                            'payment_status'=>'Paid',
                            'approval_status'=>'Pending',
                            'fee'=>$req->fee,
                            'paid_amount'=>$req->paid_amount,
                            'payment_date'=>date('Y-m-d'),
                            'last_date'=>date('Y-m-d'),
                            'reference_id'=>$req->reference_id,

                        ]);

                        //     $lastDate = date('Y-m-10', strtotime($req->valid_from . " 1 months"));

                        //     installment::create([


                        //     'student_id'=>$stdid,
                        //     'plan_id'=>$req->plan_id,
                        //     'payment_status'=>'Pending',
                        //     'approval_status'=>'Pending',
                        //     'payment_method'=>'Pending',
                        //     'fee'=>$req->fee,
                        //     'last_date'=>$lastDate,


                        // ]);





                        }




                        return response()->json([

                            'message'=>'Slote booked successfully.',
                            'status_code'=>'01'
                            ],200);

                     }

                 
    }



    /////////////////////



              


}
