<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Status;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Email;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->get();

        $projects = Project::all();

        $employees = Employee::all();
        $employeearray = [];
        foreach ($employees as $employee){
            $employeearray[$employee->id] = $employee;

        }

        $projectarray = [];
        foreach ($projects as $project){
            $projectarray[$project->id] = $project;
        }
        
        return view('index', compact('tasks', 'projectarray','employeearray'));    
    }
    // public function getEmployees($id)
    // {
    //     $employees = Employee::where('project_id',$id)->pluck("name","id");
    //     return json_encode($employees);
    // }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        $statuses = Status::all();
        // $employees = Employee::where('project_id',$id)->pluck("name","id");
        $employees_connectchief = Employee::where('project_id',1)->get();
        $employees_TheReadBetterCompany = Employee::where('project_id',2)->get();
        

        return view('create',[
            'statuses' => $statuses,
            'projects' => $projects,
            'employees_connectchief' => $employees_connectchief,
            'employees_TheReadBetterCompany' => $employees_TheReadBetterCompany

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);


        $task = new task();
        $task->email = $request->email;
        $task->title = $request->title;
        $task->employee = $request->employee;
        $task->date = $request->date;
        $task->description = $request->description;
        $task->project = $request->project;
        $task->status = $request->status;
        $task->save();
        Notification::route('mail', $request->email)->notify(new Email());
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $statuses = [
            [
                'label' => 'Todo',
                'value' => 'Todo',
    
            ],
            [
                'label' => 'Done',
                'value' => 'Done',
            ]
        ];
            return view('edit', compact('statuses', 'task'));
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
        $task = Task::findOrFail($id);
        $request->validate([
            'title' => 'required'
        ]);

        $task->title = $request->email;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('index');
    }
}
