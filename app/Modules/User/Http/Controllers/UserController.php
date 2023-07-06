<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\User\Models\User;
use Session;
use Hash;
use Str;
use Mail;
use DB;
use Carbon\Carbon;
use Auth;
use App\Modules\Admin\Models\Question;
use App\Modules\User\Models\ExamAnswer;
use App\Modules\User\Models\Result;
use Laravel\Socialite\Facades\Socialite;




class UserController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("User::welcome");
    }

    //user-registration
    public function userReg()
    {
        return view("User::register-user");
    }

    public function saveUser(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]/u',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|max:8|regex:/^\S*$/u',
            'confirmpassword' => 'required|same:password',

        ]);
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password =bcrypt($request['password']);
        $res = $user->save();
        if($res){
        return redirect('/user/login')->with('success', 'successfully registered');
        }
        else
        {
            return back()->with('fail', 'something went wrong');
        }
    }


    //user-login
    public function userLogin()
    {
        return view('User::login-user');
    }

    public function authUser(Request $request)
    {
      $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required'
      ]);
    //   $user = User::where(['email'=> $request->email])->first();
    //   if($user)
    //   {
    //     if(Hash::check($request->password, $user->password))
    //     {
    //      $request->session()->put('userId', $user->id);
    //     //  dd(session()->get('userId'));

    //      return redirect('/user/dashboard')->with('success', 'successfully logged in');
    //     }else{
    //      return back()->with('fail', 'password mismatched');
    //     }
    //   }else{
    //  return back()->with('fail', 'credentials mismatched');
    //   }
    if(Auth::attempt([
      'email' => $request->input('email'),
      'password' => $request->input('password')
     ]))
     { 
     $email= $request->input('email');


      $users = User::select('*')
              ->where('email', '=',$email )
               ->first();
      $users_id = $users->id;
      $users_name = $users->name;
         
      session()->put('loginId', $users_id);
      session()->put('user_name', $users_name);
      // dd(session()->get('user_name'));
      //  dd(session()->get('loginId'));
      return redirect('/user/dashboard');
      }
      else{
          return back()->with('fail','Credentials mismatched');
          }
  }

    //userDashboard (Front)
    public function userDashboard()
    {
        return view("User::user-dashboard");
    }
    
    //answer-dashboard
    public function answerDesk()
    {
      $data = Question::inRandomOrder(10)->get();
      return view("User::answerDashboard", compact('data'));
    }

   //quizSubmit
    public function quizSubmit(Request $request)
    {
      $user_token = str::random(20);
      Session::put('user_token', $user_token);
    // $marks=0;
    //  $marks= (strcmp(request()->input('ans_'.$i),$correct_ans) == 0 && !empty(request()->input('ans_'.$i)))
    //  {
    //  $marks==1;
    //  }
    
      
      $correct = Question::get();
      $qcount = count($request->que_id);

        for($i=1; $i <= $qcount; $i++)
        {
            $value = Question::where('id', $request->que_id[$i-1])->value('answer');
            $correct_ans = Question::where('id', $request->que_id[$i-1])->value($value);
        
            $marks = 0 ;
            if(strcmp($request->user_ans[$i-1],$correct_ans) == 0 && !empty($request->user_ans[$i-1]) ){
                $marks = 1 ;
            }

         ExamAnswer::insert([
                'user_id' => Session::get('loginId'),
                'question_id' => $request->que_id[$i-1],
                'user_ans'=> $request->user_ans[$i-1],
                'correct_ans' => $correct_ans,
                'user_token' =>  $user_token,
                'marks' => $marks,
            ]);           
        }
        return response()->json(['success' => "successfull"]);
      
    //   $qcount = count($request-> que_id);
     
      
    //   for( $i = 0; $i < $qcount; $i++)
    //   {
    //     $value = Question::where('id', $request-> que_id[$i])->value('answer');
    //     $correct_ans = Question::where('id', $request-> que_id[$i])->value($value);
    //     $marks = 0 ;
    //     if(strcmp(request()->input('user_ans'.($i+1)),$correct_ans) == 0 && !empty(request()->input('user_ans'.($i+1))) )
    //     {
    //     $marks = 1 ;
    //     }
    //     ExamAnswer::insert([
    //       'user_id' => Session::get('loginId'),
    //       'question_id' => $request-> que_id[$i],
    //       'answer'=> request()->input('user_ans'.($i+1)),
    //       'correct_ans' => $correct_ans,
    //       'user_token' =>  $user_token,
    //       'marks' => $marks,
    //     ]);
     
        
    //   }
    //   // dd(request()->input('ans_'.($i+1)));
    //  return response()->json(['success' => 'success']);
    
      
     
  }
 
  //endquiz dashboard
  public function endquiz(Request $request)
  {
    $item = Question::inRandomOrder(10)->get();

    
    $user_id = Session::get('loginId');
    $marks = ExamAnswer::where('user_id',$user_id)->sum('marks');
    $data = ExamAnswer::all();
    // $item=Question::all();

    return view('User::endquiz',['data'=>$data, 'marks'=>$marks, 'item'=>$item]);
    
    // $data = ExamAnswer::where(['user_token'=>  Session::get('user_token')])->get();
    // $sum = ExamAnswer::where(['user_token'=>  Session::get('user_token')])->sum('marks');
  //  dd( Session::get('userId'));

 
      // return view("User::endquiz", compact('data','sum'));
   
    // dd($data);
    
  }
  //result store

  public function storeResult()
  {
    
    $user_token = Session::get('user_token');
    $user_id = Session::get('loginId');
    $user_name = User::where('id',$user_id)->value('name');
    $marks = ExamAnswer::where('user_id',$user_id)->sum('marks');

    $result = new Result;
    $result->user_token = $user_token;
    $result->user_id = $user_id;
    $result->user_name = $user_name;
    $result->marks = $marks;
    $result->save();
    ExamAnswer::where('user_id',$user_id)->delete();
    Session::pull('user_token');

    return redirect('/user/dashboard');

    // Result::insert([
      
    //   'user_token' =>  Session::get('user_token'),
    //   'user_id' => Session::get('loginId'),
    //   'user_name' => Session::get('user_name'),
    //   'marks' => $marks,
    // ]);

    // $result = Result::get();
    // return $result;
  }







  //forget-password
  public function forgetPassword()
  {
      return view("User::forgetPassword");
  }

  public function resetPassword(Request $request)
  {
   $request->validate([
    'email'=>'required|email|exists:users,email'
   ]);

   $token = str::random(40);
   DB::table('password_resets')->insert([
    'email' => $request->email,
    'token' => $token,
    'created_at' => Carbon::now(),
   ]);

   $action_link = route('password-reset', ['token'=>$token, 'email'=>$request->email]);

   $body="You can reset your password by clicking the link below.";

   Mail::send('email-forgot', ['action_link'=> $action_link, 'body'=> $body], function($message)  use($request){
    $message->from('abhishektiwari@globussoft.in');
    $message->to($request->email)
            ->subject('reset password');
   });
   return back()->with('success', 'we have sent your password reset link successfully');
  }

  public function passwordReset(Request $request, $token=null)
  {
    return view("User::password-reset")->with(['token'=>$token, 'email'=>$request->email]);
  }

  public function reset(Request $request)
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
      User::where('email', $request->email)->update([
        'password'=>Hash::make($request->password)
      ]);

      DB::table('password_resets')->where([
        'email'=>$request->email
      ])->delete();
      return redirect()->route('user/login')->with('success', 'Your password has been changed successfully, You can login now.');
      }
    }

    // logout
    public function logout(Request $request)
      {
        Auth::logout();
        if (session()->has('loginId')) 
        {
          session()->pull('loginId');
        } 
        return redirect('/');
      }


      //user-result show on dashboard
      public function resultView()
      {
        $user_id = Session::get('loginId');

        $data= Result::where('user_id', $user_id)->get();
        return view("User::Result", compact('data'));
      }

    //edit-userProfile

    public function editProfile()
    {
      $user = auth()->user();
      $data['user'] = $user;
      return view("User::edit-profile", $data);
    }

    //update-profile
    public function updateProfile(Request $request)
    {
      $request->validate([
        'name'=>'required',
        'email'=>'required',
        
      ]);
      $user = auth()->user();
      $user->update([
        'name' => $request->name,
        'user' => $request->email,
       
      ]);
    
      return redirect()->back()->with('update', 'Your profile is updated successfully');
    }














      // loginwith google

public function loginWithGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function callbackFromGoogle(Request $request)
{
    try {
        $user = Socialite::driver('google')->user();

        // Check Users Email If Already There
        $is_user = User::where('email', $user->getEmail())->first();

        if(!$is_user){

            $saveUser = User::updateOrCreate([
                'google_id' => $user->getId(),
            ],[
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make($user->getName().'@'.$user->getId())
            ]);
        }else{
            $saveUser = User::where('email',  $user->getEmail())->update([
                'google_id' => $user->getId(),
               
            ]);
            // $saveUser = User::where('email', $user->getEmail())->first();
        }

        
      
        $id = User::where('email',$user->getEmail())->value('id');
        // $name= User::where('email', $user->getEmail())->value('name');
        // $name = User::where('email', $user->getEmail())->value('name');
            Session::put('loginId',$id);
            // Session::put('name', $name);
         
            Auth::loginUsingId($id);
          

        

            // S::loginUsingId($id);

        return redirect()->route('/user/dashboard');

    } catch (\Throwable $th) {
        throw $th;
    }
// }
}


//graph Result
public function showGraph()
{
 // $post=DB::table('results')->get('*')->toArray();
 $user_id = Session::get('loginId');

 
//  $id = User::where('id',$user->id())->get();
//  $post=DB::table('results')->where('user_id', $user_id)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
 $post = Result::where('user_id', $user_id)->latest()->take(3)->get();

foreach($post as $row)
 {

 //  dd($row->marks);
   $data[]=array
   (
     'label'=> $row->user_name,
     'y'=> $row->marks
   );
 }
 return view('User::statics',['data'=> $data]);
}



//login with facebook
public function loginUsingFacebook()
{
   return Socialite::driver('facebook')->redirect();
}

public function callbackFromFacebook()
{
 try {
      $user = Socialite::driver('facebook')->user();

      $saveUser = User::updateOrCreate([
          'facebook_id' => $user->getId(),
      ],[
          'name' => $user->getName(),
          'email' => $user->getEmail(),
          'password' => Hash::make($user->getName().'@'.$user->getId())
           ]);


           $id = User::where('email',$user->getEmail())->value('id');
           
               Session::put('loginId',$id);
              
            
               Auth::loginUsingId($id);
   
           return redirect()->route('/user/dashboard');
     

     
      } catch (\Throwable $th) {
         throw $th;
      }
  }
}


