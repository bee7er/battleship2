@extends('layouts.app')
@section('title') login @parent @endsection

@section('content')

    <section class="container is-fluid">

        <article class="panel is-success">
            <p class="panel-heading">Login</p>
            @include('common.msgs')
            @include('common.errors')

            <section class="hero">
                <div class="hero-body">
                    <div class="content">

                        <div class="cell bs-errors" id="customErrors"></div>

                        <form id="loginForm" action="{{env("BASE_URL", "/")}}auth/login" method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="field">
                                <label class="label">User name</label>
                                <div class="control">
                                    <input class="input is-success" type="text" placeholder="Enter your unique user name" name="userName" id="userName" value="{{ $userName }}">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Password</label>
                                <div class="control">
                                    <input class="input" type="password" name="password" id="password" placeholder="Password" />
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input type="checkbox" name="remember" id="remember"> Remember Me
                                </div>
                            </div>

                            <div class="field is-grouped">
                                <div class="control">
                                    <button type="submit" class="button is-link" onclick="validate()">Submit</button>
                                </div>
                                <div class="control">
                                    <button class="button is-link is-light" onclick="gotoUrl('loginForm', '{{env("BASE_URL", "/")}}home', 'GET')">Cancel</button>
                                </div>
                            </div>

                            <hr />
                            <div class="field">
                                <div class="control">
                                    Click <a class="" href="{{url('auth/register')}}">here to register</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </section>
        </article>
    </section>

@endsection

@section('page-scripts')
    <script type="text/javascript">
        /**
         * Validate the user login form and submit the request
         */
        function validate()
        {
            // Validate the form, also used by the register page
            if (validateUserForm()) {
                let f = $('#loginForm');
                f.submit();
            }

            return false;
        }
    </script>
@endsection
