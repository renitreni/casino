@extends('project-one.layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Referrals</h1>
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
                            <table id="referral-table"></table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
