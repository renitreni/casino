@extends('project-one.layouts.guest')

@section('content')
    <div id="app" class="login-box">
        <div class="login-logo">
            <a href="../../index2.html">Registration Form</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="d-flex flex-column">
                    <div class="mb-1">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Name" v-model="overview.name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <ul class="">
                            <li v-for="item in errors.name" class="text-danger">@{{ item }}</li>
                        </ul>
                    </div>
                    <div class="mb-1">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email" v-model="overview.email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <ul class="">
                            <li v-for="item in errors.email" class="text-danger">@{{ item }}</li>
                        </ul>
                    </div>
                    <div class="mb-1">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Password" v-model="overview.password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <ul class="">
                            <li v-for="item in errors.password" class="text-danger">@{{ item }}</li>
                        </ul>
                    </div>
                    <div class="mb-2">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Password" v-model="overview.password_confirmation">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <ul class="">
                            <li v-for="item in errors.password_confirmation" class="text-danger">@{{ item }}</li>
                        </ul>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="button" @click="register" class="btn btn-primary btn-block">Register</button>
                            {{-- <button type="button" @click="checker" class="btn btn-primary btn-block">Checker</button> --}}
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    overview: {
                        name: null,
                        email: null,
                        password: null,
                    },
                    errors: {
                        name: null,
                        email: null,
                        password: null,
                    }
                }
            },
            methods: {
                register() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('api.register.member') }}',
                        data: $this.overview,
                        method: 'POST',
                        success(value) {
                            localStorage.setItem('bearer-token', 'Bearer ' + value);
                            window.location = "{{ route('api.register.member') }}"
                        },
                        error(value) {
                            let errors = value.responseJSON.errors
                            if (errors.email != undefined) {
                                $this.errors.email = errors.email;
                            }
                            if (errors.password != undefined) {
                                $this.errors.password = errors.password;
                            }
                        }
                    });
                },
            },
            mounted() {}
        }).mount('#app')
    </script>
    <script>
        $(document).ready(function() {
            function checker() {

            }
        })
    </script>
@endpush
