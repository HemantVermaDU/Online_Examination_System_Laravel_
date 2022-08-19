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
          <td>
            <button class="btn btn-info editButton" data-id="{{ $subject->id }}" data-subject="{{ $subject->subject }}" data-toggle="modal" data-target="#editSubjectModel">Edit</button>
          </td>
          <td>
            <button class="btn btn-danger deleteButton" data-id="{{ $subject->id }}" data-toggle="modal" data-target="#deleteSubjectModel">Delete</button>
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
   
  <!-- Modal -->
  <div class="modal fade" id="addSubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
  <form id="addSubject">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Subject</h5>
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


   <!--Edit Subject Modal -->
   <div class="modal fade" id="editSubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editSubject">
          @csrf
        <div class="modal-body">
          <label>Subject</label>
            <input type="text" name="subject" placeholder="Enter Subject Name" id="edit_subject" required>
            <input type="hidden" name="id" id="edit_subject_id">
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
      </div>
    </div>
  </div>


    <!--delete Subject Modal -->
    <div class="modal fade" id="deleteSubjectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
   
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Delete Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="deleteSubject">
            @csrf
          <div class="modal-body">
           <p>Are you Sure you want to delete subject?</p>
            
              <input type="hidden" name="id" id="delete_subject_id">
               
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  

  <script>
    //add subject
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

  //edit subject
   $('.editButton').click(function(){
     var subject_id =$(this).attr('data-id');
     var subject =$(this).attr('data-subject');

     $("#edit_subject").val(subject);
     $("#edit_subject_id").val(subject_id);

   });

   $("#editSubject").submit(function(e)
    {
     e.preventDefault();

  var formData = $(this).serialize();

  $.ajax({
    url:"{{ route('editSubject') }}",
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

  //delete subject

  $(".deleteButton").click(function(){

    var subject_id = $(this).attr('data-id');

    $("#delete_subject_id").val(subject_id);
  });

  
  $("#deleteSubject").submit(function(e)
    {
     e.preventDefault();

  var formData = $(this).serialize();

  $.ajax({
    url:"{{ route('deleteSubject') }}",
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