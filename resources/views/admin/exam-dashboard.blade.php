@extends('master/admin-master')
@section('space-work')

<h1>Exams</h1>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModel">
    Add Exam
  </button>
<br><br>

<table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Exam Name</th>
    <th scope="col">Subject</th>
    <th scope="col">Date</th>
    <th scope="col">Time</th>
    <th scope="col">Attempt</th>
    <th scope="col">Edit</th>
    <th scope="col">Delete</th>
  </tr>
</thead>
<tbody>
  @if (count($exams)>0)
  @foreach ($exams as $exam )
  <tr>
    <td>{{ $exam->id }}</td>
    <td>{{ $exam->exam_name }}</td>
    <td>{{ $exam->subjects[0]['subject'] }}</td>
      <td>{{ $exam->date }}</td>
      <td>{{ $exam->time }} Hrs</td>
      <td>{{ $exam->attempt }} Time</td>
      <td>
        <button class="btn btn-info editButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#editExamModel">Edit</button>
      </td>
      <td>
        <button class="btn btn-danger deleteButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#deleteExamModel">Delete</button>
      </td>
  </tr>
    
  @endforeach
@else
<tr>
  <td colspan="4">Subjects Not Found</td>
</tr>
  
@endif
</tbody>
</table>

<!--add exam Modal -->
<div class="modal fade" id="addSubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addExam">
            @csrf
        <div class="modal-body">
          <label>Exam Name</label>
            <input type="text" name="exam_name" placeholder="Enter Subject Name" class="w-100" required>
            <br>
            <label>Subject Name</label>
            <select name="subject_id" id="" class="w-100" required>
                <option value="">Select Subject</option>
                @if (count($subjects)>0)
                @foreach ($subjects as $subject )
                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                    
                @endforeach
                    
                @endif
            </select>
            <br>
            <label>Date</label>
            <input type="date" name="date" class="w-100" required min="@php echo date('Y-m-d') @endphp">
             <br>
             <label>Time</label>
             <input type="time" name="time" class="w-100" required >
             <br>
             <label>Attempt</label>
             <input type="number" name="attempt" min="1" placeholder="Enter Exam attemp time" class="w-100" required >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="submit" class="btn btn-primary">Add Exam</button>
        </div>
    </form>
      </div>
    </div>
  </div>



<!--edit  Modal -->
<div class="modal fade" id="editExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editExam">
          @csrf
      <div class="modal-body">
        <input type="hidden" name="exam_id" id="exam_id">
       
        <label>Exam Name</label>
          <input type="text" name="exam_name" id="exam_name"  placeholder="Enter Subject Name" class="w-100" required>
  <br>
          <label>Subject Name</label>
          <select name="subject_id" id="subject_id" class="w-100"  required>
              <option value="">Select Subject</option>
              @if (count($subjects)>0)
              @foreach ($subjects as $subject )
              <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                  
              @endforeach
                  
              @endif
          </select>
          <br>
          <label>Date</label>
          <input type="date" name="date" id="date" class="w-100" required min="@php echo date('Y-m-d') @endphp">
           <br>
           <label>Time</label>
           <input type="time" name="time" id="time" class="w-100" required >
           <br>
           <label>Attempt</label>
           <input type="number" name="attempt" id="attempt" min="1" placeholder="Enter Exam attemp time" class="w-100" required >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Edit Exam</button>
      </div>
  </form>
    </div>
  </div>
</div>

<!--Delete Exam Modal -->
<div class="modal fade" id="deleteExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="deleteExam">
          @csrf
      <div class="modal-body">
        <input type="hidden" name="exam_id" id="deleteExamId">
       <p>Are you sure you want to delete exam?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-danger">Delete Exam</button>
      </div>
  </form>
    </div>
  </div>
</div>


{{-- add exam --}}
<script>
    $(document).ready(function(){
    $("#addExam").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
        url:"{{ route('addExam') }}",
        type:"POST",
        data:formData,
        success:function(data){
            if(data.success == true){
                location.reload();
            }
            else{
                alert(data.msg);
            }
        }
        });
    });

    // edit exam
    $(".editButton").click(function(){
   var id = $(this).attr('data-id');
   $("#exam_id").val(id);

   var url ='{{ route("getExamDetail","id") }}';
   url = url.replace('id',id); 

   $.ajax({
          url:url,
          type:"GET",
          success:function(data){
           if(data.success == true){
            var exam = data.data;
            $("#exam_name").val(exam[0].exam_name);
            $("#subject_id").val(exam[0].subject_id);
            $("#date").val(exam[0].date);
            $("#time").val(exam[0].time);
            $("#attempt").val(exam[0].attempt);
           }
           else{
            alert(data.msg);
           }
          }
   });

    });

    $("#editExam").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
        url:"{{ route('updateExam') }}",
        type:"POST",
        data:formData,
        success:function(data){
            if(data.success == true){
                location.reload();
            }
            else{
                alert(data.msg);
            }
        }
        });

    });

     //delete exam

  $(".deleteButton").click(function(){

var id = $(this).attr('data-id');

$("#deleteExamId").val(id);
});


$("#deleteExam").submit(function(e)
{
 e.preventDefault();

var formData = $(this).serialize();

$.ajax({
url:"{{ route('deleteExam') }}",
type:"POST",
data:formData,
success:function(data){
if(data.success == true)
{
    location.reload();
}
else{
    alert(data.msg);
}
}
});
});
  });
</script>


@endsection
