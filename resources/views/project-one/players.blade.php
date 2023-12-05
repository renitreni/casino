@extends('project-one.layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="m-0">All Players</h1>
                    <button type="button" class="btn btn-success ml-2 createMdlBtn">
                        <i class="fa fa-plus"></i>
                        Add Player
                    </button>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All Players</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table id="user-table" class="table"></table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="createMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Player</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label>Name</label>
                            <input type="text" id="name" class="form-control">
                            <span id="name-error" class="text-danger"></span>
                        </div>
                        <div class="col-12 mb-2">
                            <label>E-mail</label>
                            <input type="email" id="email" class="form-control">
                            <span id="email-error" class="text-danger"></span>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Password</label>
                            <input type="password" id="password" class="form-control">
                            <span id="password-error" class="text-danger"></span>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Password Confirm</label>
                            <input type="password" id="password_confirmation" class="form-control">
                            <span id="password_confirmation-error" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success createBtn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label>Name</label>
                            <input type="text" id="name-edit" class="form-control">
                            <span id="name-error-edit" class="text-danger"></span>
                        </div>
                        <div class="col-12 mb-2">
                            <label>E-mail</label>
                            <input type="email" id="email-edit" class="form-control">
                            <span id="email-error-edit" class="text-danger"></span>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Role</label>
                            <select id="role-edit" class="form-control">
                                <option value="agent">Agent</option>
                                <option value="player">Player</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="passwordUpdate">
                                <label class="form-check-label" for="passwordUpdate">New Password</label>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Password</label>
                            <input type="password" id="password-edit" class="form-control">
                            <span id="password-error-edit" class="text-danger"></span>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Password Confirm</label>
                            <input type="password" id="password_confirmation-edit" class="form-control">
                            <span id="password_confirmation-error-edit" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info editBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    NOTICE: Data will be deleted!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger deleteBtn">Yes, delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.deleteMdlBtn', function() {
                data = $.parseJSON($(this).attr('data'));
                $('#deleteMdl').modal('show');
            });

            $(document).on('click', '.deleteBtn', function() {
                $.ajax({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem(
                            'bearer-token'));
                    },
                    url: 'api/delete/agent/' + data.id,
                    type: 'DELETE',
                    success() {
                        $('#deleteMdl').modal('hide');
                        table.draw();
                    }
                });
            });

            $('.createMdlBtn').click(function() {
                $('#createMdl').modal('show');
            });

            $('#password-edit').parent().hide();
            $('#password_confirmation-edit').parent().hide();
            $('#password-edit').val('');
            $('#password_confirmation-edit').val('');

            $(document).on('click', '#passwordUpdate', function() {
                if ($(this).is(':checked')) {
                    $('#password-edit').parent().show();
                    $('#password_confirmation-edit').parent().show();
                } else {
                    $('#password-edit').parent().hide();
                    $('#password_confirmation-edit').parent().hide();
                }
            });

            let data = null;
            $(document).on('click', '.editMdlBtn', function() {
                data = $.parseJSON($(this).attr('data'));

                $('#email-edit').val(data.email);
                $('#name-edit').val(data.name);
                $('#role-edit').val(data.roles[0].name).change();

                $('#editMdl').modal('show');
            });

            $(document).on('click', '.editBtn', function() {
                $.ajax({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem(
                            'bearer-token'));
                    },
                    url: '{{ route('api.update.player') }}',
                    type: 'PUT',
                    data: {
                        'id': data.id,
                        'role': $('#role-edit').val(),
                        'password_update': $('#passwordUpdate').is(':checked'),
                        'email': $('#email-edit').val(),
                        'name': $('#name-edit').val(),
                        'password': $('#password-edit').val(),
                        'password_confirmation': $('#password_confirmation-edit').val(),
                    },
                    success() {
                        table.draw();
                        $('#email-edit').val('');
                        $('#name-edit').val('');
                        $('#password-edit').val('');
                        $('#password_confirmation-edit').val('');
                        $('#editMdl').modal('hide');
                    },
                    error(value) {
                        let errors = value.responseJSON.errors

                        if (errors.email != undefined) {
                            $('#email-error-edit').html(errors.email);
                        }
                        if (errors.name != undefined) {
                            $('#name-error-edit').html(errors.name);
                        }
                        if (errors.password != undefined) {
                            $('#password-error-edit').html(errors.password);
                        }
                        if (errors.password_confirmation != undefined) {
                            $('#password_confirmation-error-edit').html(errors
                                .password_confirmation);
                        }
                    }
                })

            });

            $('.createBtn').click(function() {
                $('#email-error').html('');
                $('#name-error').html('');
                $('#password-error').html('');
                $('#password_confirmation-error').html('');

                $.ajax({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem(
                            'bearer-token'));
                    },
                    url: '{{ route('api.store.player') }}',
                    type: 'POST',
                    data: {
                        'email': $('#email').val(),
                        'name': $('#name').val(),
                        'password': $('#password').val(),
                        'password_confirmation': $('#password_confirmation').val(),
                    },
                    success() {
                        table.draw();
                        $('#email').val('');
                        $('#name').val('');
                        $('#password').val('');
                        $('#password_confirmation').val('');
                        $('#createMdl').modal('hide');
                    },
                    error(value) {
                        let errors = value.responseJSON.errors

                        if (errors.email != undefined) {
                            $('#email-error').html(errors.email);
                        }
                        if (errors.name != undefined) {
                            $this.errors.name = errors.name;
                            $('#name-error').html(errors.name);
                        }
                        if (errors.password != undefined) {
                            $('#password-error').html(errors.password);
                        }
                        if (errors.password_confirmation != undefined) {
                            $('#password_confirmation-error').html(errors.password_confirmation);
                        }
                    }
                })
            });

            let table = $('#user-table').DataTable({
                serverSide: true,
                ajax: {
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem('bearer-token'));
                    },
                    url: '{{ route('api.player-table') }}',
                    type: 'POST'
                },
                order: [
                    [1, 'asc']
                ],
                columns: [{
                        bSortable: false,
                        bSearchable: false,
                        data: 'actions',
                        title: 'Actions'
                    },
                    {
                        data: 'name',
                        title: 'Name'
                    },
                    {
                        data: 'email',
                        title: 'E-mail'
                    },
                    {
                        bSortable: false,
                        bSearchable: false,
                        data: function(value) {
                            let roles = '';
                            $.each(value.roles, function(index, value) {
                                roles += value.name
                            });
                            return roles;
                        },
                        title: 'Role'
                    },
                ]
            });
        });
    </script>
@endpush
