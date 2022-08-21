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
      <td>{{ $exam->time }}</td>
  </tr>
    
  @endforeach
@else
<tr>
  <td colspan="4">Subjects Not Found</td>
</tr>
  
@endif
</tbody>
</table>

<!-- Modal -->
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
            <select name="subject_id" id="" class="w-100">
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="submit" class="btn btn-primary">Add Exam</button>
        </div>
    </form>
      </div>
    </div>
  </div>

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
    });
</script>


@endsection
