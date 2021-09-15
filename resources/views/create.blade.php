@extends('layout')


@section('main-content')
    <div>
        <div class="float-start">
            <h4 class="pb-3">Assign New Tasks</h4>
        </div>
        <div class="float-end">
            <a href="{{ route('index') }}" class = "btn btn-info">
               <i class="fa fa-arrow-left"></i> All Task
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
    
    <div class="alert show">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg">warning: Please fill All the Details</span>
        <span class="close-btn">
            <span class="fas fa-times"></span>
        </span>
    </div>           


     <div class="card card-body bg-light p-4">
         <form action = "{{ route('task.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="project" class="form-label">Projects</label>
                <select name="project" id="project" class="form-control">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">

                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                
            </div>

            <div class="name" id="employe_CC" style="float:left;">
                <div class="mb-3" >
                    <label for="employee" class="form-label">Employee</label>
                    <select name="employee" id="employee" class="form-control">
                        @foreach ($employees_connectchief as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                            
                    </select>
                </div>
            </div>


            <div class="name" id="employee_readbetter" style="float:left">
                <div class="mb-3" >
                    <label for="employee" class="form-label">Employee</label>
                    <select name="employee" id="employee" class="form-control">
                        @foreach ($employees_TheReadBetterCompany as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            


            <div class="deadline" style="float:right;">
                <label for="date" class="form-label">DeadLine Date</label>
                <input type="date" class="form-control" id="date"  name="date" >
            </div>
            <br>


             <div class="Give_email">
                 <br>
                 <br>
                 <br>
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control" id="description" name="description" rows="5" required ></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name  }}</option>
                    @endforeach
                </select>
            </div>

           
            
            <a href="{{ route('index') }}" class="btn btn-secondary mr-2"><i class="fa fa-arrow-left"></i>Cancel</a>

            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i>
                Save
            </button>
        </form>
    </div>
   
@endsection

@section('scripts')

    <script type="text/javascript">
    //  jQuery(document).ready(function ()
    // {
    //         jQuery('select[name="project"]').on('change',function(){
    //             var projectID = jQuery(this).val();
    //             if(projectID)
    //             {
    //                 jQuery.ajax({
    //                     url : '/getEmployees/' +projectID,
    //                     type : "GET",
    //                     dataType : "json",
    //                     success:function(data)
    //                     {
    //                         jQuery('select[name="employee"]').empty();
    //                         jQuery.each(data,function(key,value){
    //                             $('select[name="employee"]').append('<option value="'+ key +'">'+ value +'</option>');
    //                         });
    //                     }
    //                 });
    //             }
    //             else
    //             {
    //                 $('select[name="employee"]').empty();
    //             }
    //         });
    //  });
        $('#employe_CC').show();
        $('#employee_readbetter').hide();
    $('#project').on('change', function (e) {
        // alert(1);
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected == 1){
        $('#employe_CC').show();
        $('#employee_readbetter').hide();
    }
    else if(valueSelected == 2){
        $('#employee_readbetter').show();
        $('#employe_CC').hide();
    }
    });


     </script>

@endsection