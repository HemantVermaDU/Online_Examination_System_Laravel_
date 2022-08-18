{{-- <h1>Admin Dashboard</h1>
<a href="/logout">Logout</a> --}}

@extends('master/admin-master')

@section('space-work')

<h1>Subjects</h1>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModel">
    Add Subjects
  </button>
<br><br>
  {{-- table --}}
  <table class="table">
    <thead>
      <th scope="col">#</th>
      <th scope="col">Subject</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </thead>
    <tbody>
      @if (count($subjects)>0)
        @foreach ($subjects as $subject )
        <tr>
          <td>{{ $subject->id }}</td>
          <td>{{ $subject->subject }}</td>
          <td></td>
          <td></td>
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
  <form id="addSubject">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Subjects</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>Subject</label>
            <input type="text" name="subject" placeholder="Enter Subject Name" required>
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="submit" class="btn btn-primary">Add</button>
        </div>
      </div>
    </form>
    </div>
  </div>



  <script>
  $(document).ready(function(){

    $("#addSubject").submit(function(e)
    {
     e.preventDefault();

  var formData = $(this).serialize();

  $.ajax({
    url:"{{ route('addSubject') }}",
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