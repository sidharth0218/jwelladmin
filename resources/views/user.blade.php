@extends('layouts.app')

@section('content')

<div class="pc-container">
  <div class="pc-content">
    <h3 class="mb-4">User Management</h3>
    <button class="btn btn-primary mb-3" id="addUserBtn">Add User</button>

    <table id="userTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Add User</h5></div>
      <div class="modal-body">
        <form id="userForm">
          @csrf
          <input type="hidden" id="userId">
          <div class="mb-3">
            <label>Name</label>
            <input type="text" id="name" class="form-control">
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" id="email" class="form-control">
          </div>
          <div class="mb-3 password-field">
            <label>Password</label>
            <input type="password" id="password" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(function(){
  let table = $('#userTable').DataTable({
    ajax: "{{ route('admin.users.fetch') }}",
    columns: [
      {data: 'id'},
      {data: 'name'},
      {data: 'email'},
      {data: 'created_at'},
      {
        data: null,
        render: function(data){
          return `
            <button class="btn btn-sm btn-warning edit" data-id="${data.id}">Edit</button>
            <button class="btn btn-sm btn-danger delete" data-id="${data.id}">Delete</button>
          `;
        }
      }
    ]
  });

  $('#addUserBtn').click(() => {
    $('#userId').val('');
    $('#userForm')[0].reset();
    $('.password-field').show();
    $('#userModal').modal('show');
  });

  $('#userForm').submit(function(e){
    e.preventDefault();
    let id = $('#userId').val();
    let url = id ? `/admin/users/update/${id}` : "{{ route('admin.users.store') }}";
    $.post(url, {
      _token: "{{ csrf_token() }}",
      name: $('#name').val(),
      email: $('#email').val(),
      password: $('#password').val()
    }, function(){
      $('#userModal').modal('hide');
      table.ajax.reload();
    });
  });

  $('#userTable').on('click', '.edit', function(){
    let data = table.row($(this).parents('tr')).data();
    $('#userId').val(data.id);
    $('#name').val(data.name);
    $('#email').val(data.email);
    $('.password-field').hide();
    $('#userModal').modal('show');
  });

  $('#userTable').on('click', '.delete', function(){
    let id = $(this).data('id');
    if(confirm('Delete this user?')){
      $.ajax({
        url: `/admin/users/delete/${id}`,
        method: 'DELETE',
        data: {_token: "{{ csrf_token() }}"},
        success: () => table.ajax.reload()
      });
    }
  });
});
</script>
@endpush
