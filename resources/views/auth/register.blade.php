@extends('layouts.app')
@section('title') register @parent @endsection

<?php
use App\User;
?>

@section('content')

    <section class="container is-fluid">

        <article class="panel is-success">
            <p class="panel-heading">Register</p>
            @include('common.msgs')
            @include('common.errors')

            <section class="hero">
                <div class="hero-body">
                    <div class="content">

                        <div class="cell bs-errors" id="customErrors"></div>

                        <form id="registerForm" action="{{env("BASE_URL", "/")}}auth/register" method="POST" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="field">
                                <label class="label">User name (any {{User::USR_MIN_LEN}} or more characters)</label>
                                <div class="control">
                                    <input class="input is-success" type="text" placeholder="Choose a unique user name" name="userName" id="userName" value="{{ $userName }}">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Password (any {{User::PWD_MIN_LEN}} or more characters)</label>
                                <div class="control">
                                    <input class="input" type="password" name="password" id="password" placeholder="Password" />
                                </div>
                            </div>

                            <div class="field is-grouped">
                                <div class="control">
                                    <button type="submit" class="button is-link" onclick="return validate()">Submit</button>
                                </div>
                                <div class="control">
                                    <button type="button" class="button is-link is-light" onclick="gotoUrl('registerForm', '{{env("BASE_URL", "/")}}home', 'GET')">Cancel</button>
                                </div>
                            </div>

                            <hr />
                            <div class="field">
                                No personal details are recorded on this website.
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
            console.log('In validate');
            // Validate the form, also used by the login page
            if (validateUserForm()) {
                // Ok so far, check that the name is unique
                let userName = $('#userName');
                let data = {
                    userName: userName.val()
                };
                ajaxCall('/isUserNameUnique', JSON.stringify(data), uniqueNameCheck);
            }

            return false;
        }

        /**
         * Callback function receiving the latest move by the opponent
         */
        function uniqueNameCheck(returnedMoveData)
        {
            let message = '';
            if (null != returnedMoveData) {
                if (true == returnedMoveData.isUnique) {

                    console.log('Is unique');

                    // All good, submite details
                    let f = $('#registerForm');
                    f.submit();

                    console.log('Form submitted');

                    return false;
                }
                // Name is not unique
                let userName = $('#userName');
                message = "The name '" + userName.val() + "' has already been take.  Please choose another name.";
                $('#userName').select().focus();

            } else {
                message = 'Error on call to server';
            }

            let ce = $('#customErrors');
            ce.html(message).show().delay(3000).fadeOut();
            return false;
        }
    </script>
@endsection
