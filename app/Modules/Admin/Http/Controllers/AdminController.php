<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Admin\Models\Admin;
use Session;
use Hash;
use App\Modules\User\Models\User;
use Auth;
use Cookie;
use DB;
use Str;
use Carbon\Carbon;
use Mail;

class AdminController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Admin::welcome");
    }
    
    //adminRegistration
    public function adminRegister()
    {
        return view("Admin::adminRegister");
    }

    public function saveAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]/u',
            'email' => 'required|email|unique:admins|email:rfc,dns',
            'password' => 'required|min:6|max:12|regex:/^\S*$/u',
            'confirmpassword' => 'required|same:password'
        ]);

        $admin = new Admin;
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->password =bcrypt($request['password']);
        $res = $admin->save();
        if($res){
             return redirect('/admin/login')->with('success', 'you  have registered successfully');
            //  return redirect('/alogin');
        }else{
             return back()->with('fail', 'something went wrong');
        }
    }

    //adminLogin
    public function adminlogin()
    {
        return view("Admin::admin-login");
    }

    public function adminAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins',
            'password' => 'required'
        ]);

        $admin = Admin::where(['email'=> $request->email])->first();
        if($admin)
        {
         if(Hash::check($request->password, $admin->password))
         {
            $request->session()->put('adminId', $admin->id);
            Cookie::queue(Cookie::make('adminId', $admin->id));
           
        //  dd(session()->get('adminId'));
        return redirect('/admin/dashboard')->with('success' ,'Successfully logged in');

       } else{
        return back()->with('fail' ,'Password mismatched.');
       }
       
      }
     else{
      return back()->with('fail' ,'Credentials mismatched.');
     }
    }
  

    //dashboard
    public function AdminDash()
    {
        return view("Admin::admin-dashboard");
    }


    //userManagement
    public function userManage()
    {
        $data = User::get();
        return view("Admin::userManagement", compact('data'));
    }
    
    //edit-user role
    // public function userEdit($id)
    // {
    //     $user_role = User::get();

    // }


    //USER-trash
    public function userDelete($id)
        {
          $delete = User::where('id', $id)->firstorfail()->delete();
      
          return redirect()->back()->with('userDeleted', 'The  Requested User  is moved in trash Successfully');   
   
        }


        //user-trash view
        public function trash()
        {
            $data = User::onlyTrashed()->get();
        return view("Admin::user-trash", compact('data'));
        }

        //restore-user
        public function restore($id)
        {
          $restore = User::withTrashed()->find( $id);
          $restore->restore();
      
          return redirect()->back()->with('userRestore', 'The  Requested User  is restored Successfully');   
   
        }

        //permanent-delete user
        public function forceDelete($id)
        {
          $forceDelete = User::withTrashed()->find( $id);
          $forceDelete->forceDelete();
      
          return redirect()->back()->with('userDeleted', 'The  Requested User  is deleted permanently');   
   
        }
        
        //edit user ban/unban
        public function editRole($id)
        { 
          $user_role= User::find($id);
         
           
            return view('Admin::user-edit')->with('user_role', $user_role);

          }
        

        //update user role  
        public function updateRole(Request $request, $id)
        { 
          $user = User::find($id);
          $user->name = $request->input('name');
          $user->email = $request->input('email');
          $user->isBan = $request->input('isBan');
          if($user->isBan == 0 || $user->isBan == 1)
          {
            $user->update(); 
            return redirect()->back()->with('status','Updated Successfully');

          }
         else{
          return redirect()->back()->with('fail','can not update');

         }
        }




        //edit-user info
        public function edituser($id)
        {
            $data = User::where('id', $id)->first();
            return view("Admin::edit-user", compact('data'));
        }

        //update-user
        public function updateUser(Request $request, $id)
        {
            $user = User::find($id);
          $user->name = $request->input('name');
          $user->email = $request->input('email');
           $user->update();
           return redirect()->back()->with('update', 'User Information is updated successfully');
        }

         public function logout()
         {
            // Auth::logout();
            Cookie::forget('adminId');
            if (session()->has('adminId')) 
             {
               session()->pull('adminId');
               
             }
            return redirect('/');
         }


         //front-show
         public function front()
         {
            return view("Admin::front");
         }
        


         //statics
         public function showStatics()
         {
          // $post=DB::table('results')->get('*')->toArray();
          $post=DB::table('results')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get(['user_name','created_at','marks']);
          foreach($post as $row)
          {

          //  dd($row->marks);
            $data[]=array
            (
              'label'=> $row->user_name,
              'y'=> $row->marks
            );
          }
          return view('Admin::statictics',['data'=> $data]);
         }



    //edit profile
    public function profile()
    {
      // $id= Auth::user()->id;
      $id=  Session::get('adminId');
      $admin = Admin::find($id);
      return view("Admin::adminProfile", compact('admin'));
    }
    
    public function updateProfile(Request $request, $id)
    { 
      $adminUpdate = Admin::find($id);
      $adminUpdate->name = $request->input('name');
      $adminUpdate->email = $request->input('email');
      $adminUpdate->update(); 
      return redirect()->back()->with('update','Updated Successfully');

     
    }



    public function pwforget(){
      return view('Admin::pw-forget');
     }
  
     public function showform(Request $request)
     {
      $request->validate([
        'email' => 'required|email|exists:admins,email'
      ]);
  
      $token = Str::random(40);
      DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => Carbon::now(),
       ]);
  
       $action_link = route('reset', ['token'=>$token, 'email'=>$request->email]);
       $body= "You can reset your password by clicking the link below";
  
       Mail::send('forget', ['action_link'=> $action_link, 'body'=> $body], function($message)  use($request){
        $message->from('abhishektiwari@globussoft.in');
        $message->to($request->email)
                ->subject('reset password');
       });
       return back()->with('success', 'we have sent your password reset link successfully');
  
     }
  
  
     public function reseting(Request $request , $token=null)
     {
      return view("Admin::resetingpassword")->with(['token'=>$token, 'email'=>$request->email]);
  
     }
     public function resetpw(Request $request)
     {
      $request->validate([
        'email' => 'required|email|exists:users,email',
        'password'=> 'required|min:6|max:8|confirmed|regex:/^\S*$/u',
        'password_confirmation' => 'required'
         
      ]);
      $check_token = \DB::table('password_resets')->where([
        'email'=> $request->email,
        'token' => $request->token,
      ])->first();
  
      if(!$check_token )
          {
            return back()->with('fail', 'Invalid token');
          }else{
            Admin::where('email', $request->email)->update([
              'password'=>Hash::make($request->password)
            ]);
            DB::table('password_resets')->where([
              'email'=>$request->email
            ])->delete();
            return redirect()->route('admin/login')->with('success', 'Your password has been changed successfully, You can login now.');
          }
     }
  
  



}
