@extends('project-one.layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="m-0">Referrals</h1>
                    <button type="button" class="btn btn-success ml-2" id="referralMdlBtn">
                        <i class="fa fa-plus"></i>
                        Generate Referral for Agent
                    </button>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Referrals</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="referral-table" class="table"></table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

    <!-- Modal -->
    <div class="modal fade" id="referralMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Assign an Agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Agent List (Agents with no refferal link)</label>
                            <select class="form-control agent-select">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary referralBtn">Assign</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let data = null;

            $('.referralBtn').on('click', function(){
                $.ajax({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem(
                            'bearer-token'));
                    },
                    url: '{{ route("api.create.referral") }}',
                    type: 'POST',
                    data: {
                        id: $('.agent-select').val()
                    },
                    success(value) {
                        $('#referralMdl').modal('hide');
                        table.draw();
                    }
                });
            });

            function getAgentList() {
                $.ajax({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem(
                            'bearer-token'));
                    },
                    url: '{{ route('api.agent-list') }}',
                    type: 'GET',
                    success(value) {
                        $('.agent-select')
                            .empty()
                            .append($('<option>', {
                                value: '',
                                text: 'Select Options'
                            }));
                        $.each(value, function(i, value) {
                            $('.agent-select').append($('<option>', {
                                value: value.id,
                                text: value.name
                            }));
                        });
                    }
                });
            }

            $(document).on('click', '#referralMdlBtn', function() {
                $('#referralMdl').modal('show');

                getAgentList();
            });

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
                    url: 'api/delete/referral/' + data.id,
                    type: 'DELETE',
                    success() {
                        $('#deleteMdl').modal('hide');
                        table.draw();
                    }
                });
            });

            let table = $('#referral-table').DataTable({
                serverSide: true,
                ajax: {
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem('bearer-token'));
                    },
                    url: '{{ route('api.referral-table') }}',
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
                        data: 'referral_link',
                        name: 'referral_link',
                        title: 'Referral Link'
                    },
                    {
                        data: 'agent.name',
                        name: 'agent.name',
                        title: 'Agent Name'
                    },
                ]
            });
        });
    </script>
@endpush
