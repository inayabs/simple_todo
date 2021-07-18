<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;
use Validator;
use DB;
use Auth;

class TaskController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function getTasks(){
        $tasks = Task::with('category')->orderBy('id','desc')->get();

        return $tasks;
    }

    public function admodTask(Request $request){
        $user_id = Auth::user()->id;
        
        $validator = Validator::make($request->all(),[
            'task_title'=>'required',
            'task_category_id'=>'required',
            'task_content'=>'required',
        ]);

        if($validator->fails()){
            return response()->json(['status'=>'error','message'=>$validator->errors()]);
        }

        try{
            DB::beginTransaction();

            if(isset($request->id)){
                $task = Task::find($request->id);
                $task->task_title = $request->task_title;
                $task->task_category_id = $request->task_category_id;
                $task->task_content = $request->task_content;
                
                $task->update();
                DB::commit();
                return response()->json(['status'=>'update_success']);
            }else{
                $task = new Task;
                $task->user_id = $user_id;
                $task->task_title = $request->task_title;
                $task->task_category_id = $request->task_category_id;
                $task->task_content = $request->task_content;
                
                $task->save();
                DB::commit();
                return response()->json(['status'=>'store_success']);
            }
        }catch(Exception $e){
            DB::rollback();
            return response()->json(['status'=>'error','error'=>$e->getMessage()]);
        }
    }

    public function delete($id){
        $task = Task::find($id);

        $task->delete();
    }

    public function search($key){
        $filtered_task = Task::with('category')->where('task_title','LIKE','%'.$key.'%')->orderBy('id','desc')->get();
        
        return $filtered_task;
    }
}
