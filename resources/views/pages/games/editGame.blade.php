<?php
use App\FleetVessel;
use App\Game;
?>

@extends('layouts.app')
@section('title') edit game @parent @endsection

@section('content')

    <div class="container is-fluid">

        <article class="panel is-success">
            <p class="panel-heading">@if (isset($game->id)){{'Edit Game'}}@else{{'Add Game'}}@endif</p>
            @include('common.msgs')
            @include('common.errors')

            <form id="gameForm" action="{{env("BASE_URL", "/")}}updateGame" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <input type="hidden" name="gameId" id="gameId" value="{{$game->id}}" />

                <table class="table is-bordered is-striped bs-form-table">
                    <tbody>
                        <tr class="">
                            <td class="cell bs-section-title" colspan="2">
                                <div class="cell bs-errors" id="customErrors"></div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="cell bs-section-title">
                                Game status:
                            </td>
                            <td class="cell bs-status" id="gameStatus">
                                @if (isset($game->id))
                                    {{ucfirst($game->status)}}
                                @else
                                    New
                                @endif
                            </td>
                        </tr>
                        <tr class="">
                            <td class="cell bs-section-title">
                                Game name:
                            </td>
                            <td class="cell">
                                <input type="text" id="gameName" name="gameName" value="@if (isset($game->id)){{ucfirst($game->name)}}@endif" />
                            </td>
                        </tr>
                        <tr class="">
                            <td class="cell bs-section-title">
                                Player 1:
                            </td>
                            <td class="cell">
                                {{$user->name}}
                            </td>
                        </tr>
                        @if (isset($game->id))
                            <tr class="">
                                <td class="cell bs-section-title">
                                    Player 2:
                                </td>
                                <td class="cell">
                                    <input type="hidden" id="playerTwoId" value="{{$game->player_two_id}}" />
                                    {{$playerTwo->name}}
                                </td>
                            </tr>
                        @else
                            <tr class="">
                                <td class="cell bs-section-title">
                                    Player 2
                                </td>
                                <td class="cell">
                                    You will send a link to your opponent
                                </td>
                            </tr>
                        @endif
                        <tr class="">
                            <td class="cell" colspan="2">
                                <input class="button is-pulled-right mr-6" type="submit" value="Submit input" onclick="return submitRequest();" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </article>
    </div>

@endsection

@section('page-scripts')
    <script type="text/javascript">
        /**
         * Validate the form and submit the add request
         */
        function submitRequest()
        {
            let f = $('#gameForm');
            let gameName = $('#gameName');
            let playerTwoId = $('#playerTwoId');

            let errors = [];
            let atLeastOne = false;
            if ('' == gameName.val()) {
                errors[errors.length] = 'Please enter a name for this game';
                atLeastOne = true;
                gameName.focus();
            }

            if ('' == playerTwoId.val()) {
                errors[errors.length] = 'Please select player 2 for this game';
                atLeastOne = true;
                playerTwoId.focus();
            }
            if (atLeastOne) {
                let errMsgs = sep = "";
                for (let i=0; i<errors.length; i++) {
                    errMsgs += (sep + errors[i]);
                    sep = '<br />';
                }
                let ce = $('#customErrors');
                ce.html(errMsgs).show().delay(3000).fadeOut();
                return false;
            }

            f.attr('action', '{{env("BASE_URL", "/")}}updateGame');
            f.submit();
            return false;
        }

        $(document).ready( function()
        {

        });
    </script>
@endsection