@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="jumbotron">
                    <h1> Bienvenue
                        @if(Auth::check())
                            </h1>
                    @else
                        </h1>
                        <p>Inscrivez vous pour accéder au site</p>

                        <a href="register"><button class="btn btn-primary">Inscription</button></a>
                        <a href="login"><button class="btn btn-default">Connexion</button></a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection