@extends('layouts.app')
@section('title') home @parent @endsection

@section('content')

    <section class="container is-fluid">

        <article class="panel is-success">
            <p class="panel-heading">Sink My Boats</p>
            @include('common.msgs')
            @include('common.errors')
            <input type="hidden" id="userToken" value="{{$userToken}}" />

            <section class="hero">
                <div class="hero-body">
                    <div class="content">
                        <p>The classical game of two battling fleets, now played across the web.</p>
                        <p>You will find all the old favourites, aircraft carriers, battleships and more.</p>
                        <p>Create a game, choose an opponent, plot where your fleet goes on a grid and engage in battle.</p>
                        <p>Hope you enjoy the challenge.</p>
                    </div>
                    <div class="content">
                        <p class="is-size-3">What You Have To Do</p>
                        <ol class="is-size-4">
                            <li>Go to <span class="has-text-link">My Games</span></li>
                            <li>Click on <span class="has-text-link">Add Game</span></li>
                            <li>Click on <span class="has-text-link">Edit Grid</span></li>
                            <li>Click on the  <span class="has-text-link">Vessel Location Grid</span> to plot each vessel</li>
                            <li>If you want to get the game to plot the vessels just click on the  <span class="has-text-link">Go Random</span> button</li>
                            <li>XXXXXXXXX  <span class="has-text-link">Copy Link</span> button</li>
                        </ol>

                    </div>
                </div>
            </section>
        </article>
    </section>

@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(document).ready( function()
        {
            setCookie('user_token', $('#userToken').val(), 1);
        });
    </script>
@endsection
