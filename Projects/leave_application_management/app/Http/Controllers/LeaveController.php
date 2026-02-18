<?php

namespace App\Http\Controllers;

use App\Models\LeaveModel;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave=LeaveModel::all();
        return view('content',['leave'=>$leave]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create a validations
        $validated = $request->validate([
              
            'employee_name' => 'required|max:255',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
            'status' => 'required',
           ]);   
  
          //  create a ORM Elequent query builder for insert data
              
          $leave=array(
              "employee_name"=>$request->employee_name,
              "type"=>$request->type,
              "start_date"=>$request->start_date,
              "end_date"=>$request->end_date,
              "reason"=>$request->reason,
              "status"=>$request->status
          );
          // insert elequent ORM model
          LeaveModel::create($leave);
          return redirect('/')->with('success','Leave Applecation Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showEmployee = LeaveModel::where("id",$id)->first();
        return view('show',['showEmployee'=>$showEmployee]);   
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=LeaveModel::where("id",$id)->first();
        
        return view('edit_employee',["edit"=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
              
            'employee_name' => 'required|max:255',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
            'status' => 'required',
           ]); 

        $update=array(
            
            "employee_name"=>$request->employee_name,
              "type"=>$request->type,
              "start_date"=>$request->start_date,
              "end_date"=>$request->end_date,
              "reason"=>$request->reason,
              "status"=>$request->status
        );

        // applied update data of task manager app 
         LeaveModel::where('id',$id)->update($update);
         return redirect('/')->with('success','Leave Applicaion Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LeaveModel::where('id',$id)->delete();
        return redirect('/')->with('del','Leave Application Successfully Deleted');
    }
}
