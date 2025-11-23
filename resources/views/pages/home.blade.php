@extends('layouts.app')
@section('title') home @parent @endsection

@section('content')

    <section class="container is-fluid">

        <article class="panel is-success">
            <p class="panel-heading">Battleships</p>
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
