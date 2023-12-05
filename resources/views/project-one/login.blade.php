@extends('project-one.layouts.guest')

@section('content')
    <div id="app" class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <div class="d-flex flex-column">
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
                    <div class="mb-3">
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
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="button" @click="login" class="btn btn-primary btn-block">Sign In</button>
                            {{-- <button type="button" @click="checker" class="btn btn-primary btn-block">Checker</button> --}}
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                {{-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> --}}
                <!-- /.social-auth-links -->

                {{-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p> --}}
                {{-- <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> --}}
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
                        email: null,
                        password: null,
                    },
                    errors: {
                        email: null,
                        password: null,
                    }
                }
            },
            methods: {
                login() {
                    var $this = this;
                    $.ajax({
                        url: '{{ route('authenticate') }}',
                        data: $this.overview,
                        method: 'POST',
                        success(value) {
                            localStorage.setItem('bearer-token', 'Bearer ' + value);
                            window.location = "{{ route('dashboard') }}"
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
                $.ajax({
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization', localStorage.getItem('bearer-token'));
                    },
                    url: "/api/check-token",
                    method: 'POST',
                    success(value) {
                        window.location = "/dashboard"
                    },
                    complete: function(xhr, textStatus) {
                        if (window.location.pathname != '/login') {
                            if (xhr.status == 401) {
                                window.location = '/login'
                            }
                        }
                    }
                });
            }

            checker();
        })
    </script>
@endpush
