<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime,DB;
use Illuminate\Support\Facades\Validator;
use App\Models\slote;
use App\Models\branch;
use App\Models\student;
use App\Models\plan;
use App\Models\deposit;
use App\Models\installment;
use App\Models\blog;
use App\Models\video;
use App\Models\chat;
use App\Models\refund_request;
use App\Models\cancelled_class;
use App\Models\attendance;
use App\Models\credit_class;

class UserApiController extends Controller
{
    
        public function profile_details()
        {
            $stdid=auth()->user()->id;
            //$std=student::select('class_mode')->where('id',$stdid)->first();
            $class_mode=auth()->user()->class_mode;
            if($class_mode=='Offline')
            {
              $profile_details = DB::table('students')
                                ->join('plans', 'students.plan', '=', 'plans.id')
                                ->join('slotes', 'students.slote', '=', 'slotes.id')
                                ->join('branches', 'students.branch', '=', 'branches.id')
                                ->select('students.name', 'students.mobile', 'students.alternative_mobile', 'students.email', 'students.address', 'students.dob', 'students.guardian', 'students.class_mode', 'students.valid_from', 'students.valid_to', 'students.approval_status', 'students.status', 'slotes.day as slote_day', 'slotes.slote as slote_time', 'branches.branch as branch')
                                ->where('students.id', $stdid)
                                ->first();  
            }
            else
            {
                $profile_details = DB::table('students')
                                ->join('plans', 'students.plan', '=', 'plans.id')
                                ->join('slotes', 'students.slote', '=', 'slotes.id')
                                ->select('students.name', 'students.mobile', 'students.alternative_mobile', 'students.email', 'students.address', 'students.dob', 'students.guardian', 'students.class_mode', 'students.valid_from', 'students.valid_to', 'students.approval', 'students.status', 'slotes.day as slote_day', 'slotes.slote as slote_time')
                                ->where('students.id', $stdid)
                                ->first(); 
            }
            

            return response()->json([

                    'profile_details'=>$profile_details,
                    'status_code'=>'01'
                    ],200);
        }

        public function paid_installments()
        {
            $stdid=auth()->user()->id;
            $installments=installment::where('student_id',$stdid)->where('payment_status','Paid')->orderBy('last_date','DESC')->get();

            return response()->json([

                    'installments'=>$installments,
                    'status_code'=>'01'
                    ],200);
        }

         public function pending_installments()
        {
            $stdid=auth()->user()->id;
            $installments=installment::where('student_id',$stdid)->where('payment_status','!=','Paid')->orderBy('last_date','DESC')->get();

            return response()->json([

                    'installments'=>$installments,
                    'status_code'=>'01'
                    ],200);
        }

        public function pay_installment(Request $req)
        {
            $stdid=auth()->user()->id;
            $installment=installment::where('student_id',$stdid)->where('id',$req->installment_id)->where('payment_status','!=','Paid')->first();
            if($installment)
            {
                installment::where('id',$req->installment_id)->update([

                    'payment_status'=>'Paid',
                    'payment_method'=>'Online',
                    'paid_amount'=>$req->paid_amount,
                    'reference_id'=>$req->reference_id,

                ]);
                return response()->json([

                    'message'=>'Installment paid successfully',
                    'status_code'=>'01'
                    ],200);
            }
            else
            {
               return response()->json([

                    'message'=>'Invalid installment id',
                    'status_code'=>'00'
                    ],400); 
            }

            
        }

        public function get_blogs()
        {
            //$stdid=auth()->user()->id;
            $blogs=blog::latest()->get();

            return response()->json([

                    'blogs'=>$blogs,
                    'status_code'=>'01'
                    ],200);
        }

        public function blog_details($bid)
        {
            //$stdid=auth()->user()->id;
            $blog=blog::where('id',$bid)->first();

            return response()->json([

                    'blog'=>$blog,
                    'status_code'=>'01'
                    ],200);
        }

          public function get_videos()
        {
            //$stdid=auth()->user()->id;
            $videos=video::latest()->get();

            return response()->json([

                    'videos'=>$videos,
                    'status_code'=>'01'
                    ],200);
        }


          public function all_chat()
        {
            $stdid=auth()->user()->id;
            $chats=chat::where('status','Active')->where('sender',$stdid)->orWhere('receiver',$stdid)->oldest()->get();

            return response()->json([

                    'chats'=>$chats,
                    'status_code'=>'01'
                    ],200);
        }

        public function send_msg(Request $req)
    {
        $stdid=auth()->user()->id;
        chat::create([

            'sender'=>$stdid,
            'msg'=>$req->msg,
            'status'=>'Active',
            'receiver'=>'Admin'

        ]);

        return response()->json([

                    'message'=>'Message sent successfully',
                    'status_code'=>'01'
                    ],200);

    }

      public function delete_msg(Request $req)
    {
        $stdid=auth()->user()->id;
        if(chat::where('sender',$stdid)->where('id',$req->msg_id)->exists())
        {
          chat::where('id',$req->msg_id)->update([

            'status'=>'Deleted'

          ]);
           return response()->json([

                    'message'=>'Message deleted successfully',
                    'status_code'=>'01'
                    ],200);  
        }
        else
        {
             return response()->json([

                    'message'=>'Invalid message id',
                    'status_code'=>'00'
                    ],400);
        }
        

       

    }


          public function refund_requests()
        {
            $stdid=auth()->user()->id;
            $refund_requests=refund_request::where('student_id',$stdid)->latest()->get();

            return response()->json([

                    'refund_requests'=>$refund_requests,
                    'status_code'=>'01'
                    ],200);
        }

         public function send_refund_request()
        {
            $stdid=auth()->user()->id;
            refund_request::create([

                'student_id'=>$stdid,
                'status'=>'Pending'

            ]);

            return response()->json([

                    'message'=>'Request sent successfully',
                    'status_code'=>'01'
                    ],200);
        }

        public function delete_refund_request(Request $req)
        {
            $stdid=auth()->user()->id;

            if(refund_request::where('id',$req->req_id)->where('status','Pending')->where('student_id',$stdid)->exists())
            {
                refund_request::where('id',$req->req_id)->delete();
                return response()->json([

                    'message'=>'Request deleted successfully',
                    'status_code'=>'01'
                    ],200);
            }
            else
            {
                return response()->json([

                    'message'=>'Invalid request id',
                    'status_code'=>'01'
                    ],200);

            }

                

            
        }



        public function upcoming_classes()
{
    $stdid = auth()->user()->id;
    $days = slote::select('day')->where('id', auth()->user()->slote)->first();

    $start_date = date('Y-m-d');
    $end_date = auth()->user()->valid_to;
    $target_day = $days->day;

    $upcoming_dates = [];
    $current_date = strtotime($start_date);

    $first_month = '';
    $current_month = '';

    while ($current_date <= strtotime($end_date)) {
        $current_date_str = date('Y-m-d', $current_date);
        $current_month = date('F Y', $current_date);

        // Check if the current day matches the target day (e.g., Sunday)
        if (date('l', $current_date) === $target_day) {
            // Check if the date is in the cancelled_dates table
            $is_cancelled = cancelled_class::where('class_date', $current_date_str)->exists();

            // Determine the status based on whether it's cancelled or not
            $status = $is_cancelled ? 'cancelled' : 'active';

            if ($current_month !== $first_month) {
                // Store the first month name
                $first_month = $current_month;
                $upcoming_dates[] = [
                    'month' => $current_month,
                    'dates' => [],
                ];
            }

            // Add the date and status to the current month
            $upcoming_dates[count($upcoming_dates) - 1]['dates'][] = [
                'date' => $current_date_str,
                'status' => $status,
            ];
        }

        $current_date = strtotime('+1 day', $current_date);
    }

    return response()->json([
        'upcoming_classes' => $upcoming_dates,
        'status_code' => '01'
    ], 200);
}




        /////////////////

          public function cancel_class(Request $req)
        {
            $stdid=auth()->user()->id;
            $dt=date('Y-m-d');

            if($req->class_date>$dt)
            {
                if(cancelled_class::where('class_date',$req->class_date)->where('student_id',auth()->user()->id)->where('slote',auth()->user()->slote)->where('rebooked_status','Pending')->exists())
                {
                   return response()->json([

                    'message'=>'Class already cancelled',
                    'status_code'=>'00'
                    ],400); 
                }
                else
                {
                cancelled_class::create([

                    'class_date'=>$req->class_date,
                    'student_id'=>auth()->user()->id,
                    'slote'=>auth()->user()->slote,
                    'reason'=>$req->reason,
                    'status'=>'Cancelled',

                ]);

                 credit_class::create([

                    'student_id'=>auth()->user()->id,
                    'details'=>'Credit class generated for '.date("d-M-Y", strtotime($req->class_date)).' slote (Regular Class).',
                    'type'=>'Credit',
                    'status'=>'Pending',
                    'slote'=>0,
                    'attendance'=>'Absent',
                    'added_by'=>'Admin',
                    'updated_by'=>'Admin',

                ]);
                return response()->json([

                    'message'=>'Class cancelled successfully',
                    'status_code'=>'01'
                    ],200);
                }
            }
            else
            {
                return response()->json([

                    'message'=>'Cancellation Faild',
                    'status_code'=>'00'
                    ],400);

            }

                

            
        }


           public function completed_classes()
        {
            $stdid=auth()->user()->id;

            $completed_classes=attendance::where('student_id',$stdid)->where('status','!=','Cancelled')->orderBy('at_date','DESC')->get();
                return response()->json([

                    'completed_classes'=>$completed_classes,
                    'status_code'=>'01'
                    ],200);
            
        }

           public function cancelled_classes()
        {
            $stdid=auth()->user()->id;

            $cancelled_classes=cancelled_class::where('student_id',$stdid)->orderBy('class_date','DESC')->get();
                return response()->json([

                    'cancelled_classes'=>$cancelled_classes,
                    'status_code'=>'01'
                    ],200);
            
        }

          public function class_note($aid)
        {
            $stdid=auth()->user()->id;

            $note=attendance::where('id',$aid)->first();
                return response()->json([

                    'note'=>$note->note,
                    'status_code'=>'01'
                    ],200);
            
        }


        public function cancel_classes(Request $req)
{
    $stdid = auth()->user()->id;
    $from_date = $req->from_date;
    $to_date = $req->to_date;
    $std = student::select('slote', 'valid_from', 'valid_to')->where('id', $stdid)->first();

    if ($from_date >= $std->valid_from && $from_date <= $std->valid_to) {
        if ($to_date >= $std->valid_from && $to_date <= $std->valid_to) {
            $currentDate = strtotime($from_date);
            $days = [];

            while ($currentDate <= strtotime($to_date)) {
                if (date('l', $currentDate) === $std->GetSlote->day) {
                    $days[] = date('Y-m-d', $currentDate);
                }
                $currentDate = strtotime('+1 day', $currentDate);
            }

            foreach ($days as $d) {
                if(cancelled_class::where('class_date',$d)->where('student_id',auth()->user()->id)->where('slote',auth()->user()->slote)->where('rebooked_status','Pending')->doesntExist())
                {
                    cancelled_class::create([
                        'class_date' => $d,
                        'student_id' => auth()->user()->id,
                        'slote' => auth()->user()->slote,
                        'reason' => $req->reason,
                        'status' => 'Cancelled',
                    ]);

                     credit_class::create([

                    'student_id'=>auth()->user()->id,
                    'details'=>'Credit class generated for '.date("d-M-Y", strtotime($d)).' slote.',
                    'type'=>'Credit',
                    'status'=>'Pending',
                    'slote'=>0,
                    'attendance'=>'Absent',
                    'added_by'=>'Admin',
                    'updated_by'=>'Admin',

                ]);
                }
            }

            return response()->json([
                'message' => 'Classes cancelled successfully',
                'status_code' => '00'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid to date',
                'valid_from' => $std->valid_from,
                'valid_to' => $std->valid_to,
                'status_code' => '00'
            ], 400);
        }
    } else {
        return response()->json([
            'message' => 'Invalid from date',
            'valid_from' => $std->valid_from,
            'valid_to' => $std->valid_to,
            'status_code' => '00'
        ], 400);
    }
}

///////////////////////////////////////////////////////


            public function credit_class()
        {
            $stdid=auth()->user()->id;

            $credit_classes=credit_class::where('student_id',$stdid)->where('type','Credit')->latest()->get();
                return response()->json([

                    'credit_classes'=>$credit_classes,
                    'status_code'=>'01'
                    ],200);
            
        }


        public function credit_class_slotes(Request $req)
        {
            
            $stdid=auth()->user()->id;
            $cdt=$req->class_date;
            $dayName = date('l', strtotime($cdt));
            $stddet=student::select('class_mode','branch')->where('id',$stdid)->first();
            if($stddet->class_mode=='Offline')
            {
                    $slotes = slote::where('class_mode', 'Offline')
                        ->where('branch', $stddet->branch)
                        ->where('day', $dayName)
                        ->where('status', 'Active')
                        ->get();

                    foreach ($slotes as $s) {
                        
                        $can = cancelled_class::where('slote', $s->id)->where('class_date', $cdt)->where('rebooked_status', 'Pending')->count(); 
                        $cred = credit_class::where('slote', $s->id)->where('booked_date', $cdt)->where('status', 'Booked')->count(); 

                         $std = student::where('slote', $s->id)->where('status', 'Active')->count(); 

                         $stdcnt= $std-$can+$cred;    

                        if ($stdcnt < $s->slote_limit) {
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
                        ->where('day', $dayName)
                        ->where('status', 'Active')
                        ->get();

                    foreach ($slotes as $s) {

                        $can = cancelled_class::where('slote', $s->id)->where('class_date', $cdt)->where('rebooked_status', 'Pending')->count(); 

                       $std = student::where('slote', $s->id)
                            ->where('status', 'Active')
                            ->count();
                        $cred = credit_class::where('slote', $s->id)->where('booked_date', $cdt)->where('status', 'Booked')->count(); 

                         $stdcnt= $std-$can+$cred; 
                        

                        if ($stdcnt < $s->slote_limit) {
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



        public function book_credit_class(Request $req)
    {
        $stdid = auth()->user()->id;
        $rules = [
                    'slote_id' => 'required',
                    'class_id' => 'required',
                    'class_date' => 'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Some required fields are missing",'status_code'=>'00'],400);
                } 
            else 
                {
                    
                        credit_class::where('id',$req->class_id)->update([

                            'slote'=>$req->slote_id,
                            'booked_date'=>$req->class_date,
                            'status'=>'Booked',                           

                        ]);

                        $can_class=cancelled_class::where('slote',$req->slote_id)->where('class_date',$req->class_date)->orderBy('id','ASC')->limit(1)->first();
                        if($can_class)
                        {
                            cancelled_class::where('id',$can_class->id)->update([

                                'rebooked_status'=>'Booked',
                                'rebooked_by'=>$stdid

                            ]);
                        }

                        return response()->json([

                            'message'=>'Slote booked successfully.',
                            'status_code'=>'01'
                            ],200);

                     }

                 
    }

     public function credit_class_note($aid)
        {
            $stdid=auth()->user()->id;

            $note=credit_class::where('id',$aid)->first();
                return response()->json([

                    'note'=>$note->note,
                    'status_code'=>'01'
                    ],200);
            
        }


          public function cancel_credit_class(Request $req)
        {
            $stdid=auth()->user()->id;
            $dt=date('Y-m-d');

            $class_det=credit_class::where('id',$req->class_id)->first();

            if($class_det->booked_date>$dt)
            {
                if(cancelled_class::where('class_date',$class_det->booked_date)->where('student_id',auth()->user()->id)->where('slote',$class_det->slote)->where('rebooked_status','Pending')->exists())
                {
                   return response()->json([

                    'message'=>'Class already cancelled',
                    'status_code'=>'00'
                    ],400); 
                }
                else
                {
                credit_class::where('id',$req->class_id)->update([

                    'cancel_reason'=>$req->reason,
                    'status'=>'Cancelled',

                ]);
                cancelled_class::create([

                    'class_date'=>$class_det->booked_date,
                    'student_id'=>auth()->user()->id,
                    'slote'=>$class_det->slote,
                    'reason'=>$req->reason,
                    'status'=>'Cancelled',

                ]);

                 credit_class::create([

                    'student_id'=>auth()->user()->id,
                    'details'=>'Credit class generated for '.date("d-M-Y", strtotime($class_det->booked_date)).' slote (Credit Class).',
                    'type'=>'Credit',
                    'status'=>'Pending',
                    'slote'=>0,
                    'attendance'=>'Absent',
                    'added_by'=>'Admin',
                    'updated_by'=>'Admin',

                ]);
                 
                return response()->json([

                    'message'=>'Class cancelled successfully',
                    'status_code'=>'01'
                    ],200);
                }
            }
            else
            {
                return response()->json([

                    'message'=>'Cancellation Faild',
                    'status_code'=>'00'
                    ],400);

            }

                

            
        }


    ////////////////////////////////////////// 


     public function paid_class()
        {
            $stdid=auth()->user()->id;

            $paid_classes=credit_class::where('student_id',$stdid)->where('type','Paid')->latest()->get();
                return response()->json([

                    'paid_classes'=>$paid_classes,
                    'status_code'=>'01'
                    ],200);
            
        }


        public function paid_class_slotes(Request $req)
        {
            
            $stdid=auth()->user()->id;
            $cdt=$req->class_date;
            $dayName = date('l', strtotime($cdt));
            $stddet=student::select('class_mode','branch')->where('id',$stdid)->first();
            if($stddet->class_mode=='Offline')
            {
                $fee=deposit::where('id',3)->first();
                    $slotes = slote::where('class_mode', 'Offline')
                        ->where('branch', $stddet->branch)
                        ->where('day', $dayName)
                        ->where('status', 'Active')
                        ->get();

                    foreach ($slotes as $s) {
                        
                        $can = cancelled_class::where('slote', $s->id)->where('class_date', $cdt)->where('rebooked_status', 'Pending')->count();
                        $cred = credit_class::where('slote', $s->id)->where('booked_date', $cdt)->where('status', 'Booked')->count(); 

                         $std = student::where('slote', $s->id)->where('status', 'Active')->count(); 

                         $stdcnt= $std-$can+$cred;    

                        if ($stdcnt < $s->slote_limit) {
                            $s->availability = 'Available';
                        } else {
                            $s->availability = 'Not Available';
                        }
                    }

                    return response()->json([

                        'fee' => $fee->fee,
                        'slotes' => $slotes,
                        'status_code' => '01',
                    ], 200); 
              }
              else
              {
                $fee=deposit::where('id',2)->first();
                 $slotes = slote::where('class_mode', 'Online')
                        ->where('day', $dayName)
                        ->where('status', 'Active')
                        ->get();

                    foreach ($slotes as $s) {

                        $can = cancelled_class::where('slote', $s->id)->where('class_date', $cdt)->where('rebooked_status', 'Pending')->count(); 
                        $cred = credit_class::where('slote', $s->id)->where('booked_date', $cdt)->where('status', 'Booked')->count(); 

                       $std = student::where('slote', $s->id)
                            ->where('status', 'Active')
                            ->count(); 

                         $stdcnt= $std-$can+$cred; 
                        

                        if ($stdcnt < $s->slote_limit) {
                            $s->availability = 'Available';
                        } else {
                            $s->availability = 'Not Available';
                        }
                    }

                    return response()->json([
                        'fee' => $fee->fee,
                        'slotes' => $slotes,
                        'status_code' => '01',
                    ], 200);
              } 
            
        }



        public function book_paid_class(Request $req)
    {
        $stdid = auth()->user()->id;
        $rules = [
                    'slote_id' => 'required',
                    'paid_amount' => 'required',
                    'class_date' => 'required',
                    ];
                
            $validator = Validator::make($req->all(), $rules);  

             if ($validator->fails()) 
                {
                   return response()->json(['message'=>"Some required fields are missing",'status_code'=>'00'],400);
                } 
            else 
                {
                    
                        credit_class::create([

                            'student_id'=>$stdid,
                            'slote'=>$req->slote_id,
                            'booked_date'=>$req->class_date,
                            'status'=>'Booked',
                            'type'=>'Paid',
                            'paid_amount'=>$req->paid_amount,
                            'payment_method'=>'Online',
                            'payment_date'=>date('Y-m-d'),
                            'reference_id'=>$req->reference_id,
                            'attendance'=>'Absent',
                            'added_by'=>'Admin',
                            'updated_by'=>'Admin',                            

                        ]);

                        $can_class=cancelled_class::where('slote',$req->slote_id)->where('class_date',$req->class_date)->orderBy('id','ASC')->limit(1)->first();
                        if($can_class)
                        {
                            cancelled_class::where('id',$can_class->id)->update([

                                'rebooked_status'=>'Booked',
                                'rebooked_by'=>$stdid

                            ]);
                        }

                        return response()->json([

                            'message'=>'Slote booked successfully.',
                            'status_code'=>'01'
                            ],200);

                     }

                 
    }

     public function paid_class_note($aid)
        {
            $stdid=auth()->user()->id;

            $note=credit_class::where('id',$aid)->first();
                return response()->json([

                    'note'=>$note->note,
                    'status_code'=>'01'
                    ],200);
            
        }  

         public function cancel_paid_class(Request $req)
        {
            $stdid=auth()->user()->id;
            $dt=date('Y-m-d');

            $class_det=credit_class::where('id',$req->class_id)->first();

            if($class_det->booked_date>$dt)
            {
                if(cancelled_class::where('class_date',$class_det->booked_date)->where('student_id',auth()->user()->id)->where('slote',$class_det->slote)->where('rebooked_status','Pending')->exists())
                {
                   return response()->json([

                    'message'=>'Class already cancelled',
                    'status_code'=>'00'
                    ],400); 
                }
                else
                {

                credit_class::where('id',$req->class_id)->update([

                    'cancel_reason'=>$req->reason,
                    'status'=>'Cancelled',

                ]);

                cancelled_class::create([

                    'class_date'=>$class_det->booked_date,
                    'student_id'=>auth()->user()->id,
                    'slote'=>$class_det->slote,
                    'reason'=>$req->reason,
                    'status'=>'Cancelled',

                ]);

                 credit_class::create([

                'student_id'=>auth()->user()->id,
                'details'=>'Credit class generated for '.date("d-M-Y", strtotime($class_det->booked_date)).' slote (Paid Class).',
                'type'=>'Credit',
                'status'=>'Pending',
                'slote'=>0,
                'attendance'=>'Absent',
                'added_by'=>'Admin',
                'updated_by'=>'Admin',

                ]);
                 
                return response()->json([

                    'message'=>'Class cancelled successfully',
                    'status_code'=>'01'
                    ],200);
                }
            }
            else
            {
                return response()->json([

                    'message'=>'Cancellation Faild',
                    'status_code'=>'00'
                    ],400);

            }

                

            
        }

                    


}
