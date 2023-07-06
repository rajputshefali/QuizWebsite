<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Modules\Admin\Models\Question;
use App\Modules\Admin\Models\Answer;
use App\Modules\User\Models\Result;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionImport;

class QuestionController extends Controller
{
    public function queManage()
    {
        return view("Admin::queAdd");
    }
//add questins
    public function addQna(Request $request)
    {
      $request->validate([
        'question' => 'required',        
        'option1' => 'required',
        'option2' => 'required',
        'option3' => 'required',
        'option4' => 'required',
        'answer' => 'required',
        'category' => 'required',
      ]);
      $data = new Question;
      $data->question = $request['question'];
      $data->option1 = $request['option1'];
      $data->option2 =$request['option2'];
      $data->option3 =$request['option3'];
      $data->option4 =$request['option4'];
      $data->answer =$request['answer'];
      $data->category =$request['category'];


      $res = $data->save();
      if($res){
          return back()->with('success', 'Question added successfully');
          
      }

}




//manage questions
public function qnaManage(Request $request)
{
    $data = Question::get();
    return view('Admin::queManagement', compact('data'));
 
}


//edt
public function editQues($id)
{ 
  $role= Question::find($id);
 
   
    return view('Admin::que-edit',compact('role'));

  }

  //update
  public function updateQues(Request $request, $id)
        { 
          $user = Question::find($id);
          $user->question = $request->input('question');
          $user->option1 = $request->input('option1');
          $user->option2 = $request->input('option2');
          $user->option3 = $request->input('option3');
          $user->option4 = $request->input('option4');
          $user->answer = $request->input('answer');
          $user->category = $request->input('category');
          
            $user->update(); 
            return redirect()->back()->with('status','Updated Successfully');

          
        }


        //delete-qusetion
        
        public function deleteQues($id)
        {
          $delete = Question::where('id', $id)->firstorfail()->delete();
      
          return redirect()->back()->with('fail', 'Question  Deleted Successfully');   
   
        }

      

        //manage quiz-results
        public function quizResult()
        {
          $data = Result::get();
          return view("Admin::quiz-result", compact('data'));
        }

        public function deleteResult($id)
        {
          $delete = Result::where('id', $id)->firstorfail()->delete();
      
          return redirect()->back()->with('fail', 'Result  Deleted Successfully');   
   
        }
   
          public function importQue(){
            return view("Admin::importQues");
          }
   
          public function uploadQue(Request $request)
          {
            Excel::import(new QuestionImport, $request->file('file'));
            return back()->with('success','Questions imported successfully');
          }

     

}
