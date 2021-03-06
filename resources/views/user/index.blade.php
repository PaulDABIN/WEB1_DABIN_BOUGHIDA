@extends('layouts.app')

@section('content')
    @if(Session::has('erreur'))
        <h1>{{Session::get('erreur')}}</h1>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-user"></i> Votre profil </div>

                    @foreach($users as $user)
                        @if(Auth::check() && Auth::user()->id == $user->id)

                            <div class="panel-body">

                                <p><b>Nom </b>{{$user->name}}</p>
                                <p><b>Email </b>{{$user->email}}</p>

                                <p><b>Création le </b>{{$user->created_at}}</p>
                                <p><b>Mis à jour le </b>{{$user->updated_at}}</p>
                                <p><b>Catégorie </b>
                                    @if($user->admin == 1)
                                        Administrateur
                                    @else($user->admin == 0)
                                        Utilisateur
                                    @endif
                                </p>



                                <a href="{{ route('user.edit', $user->id)}}" class="btn btn-default btn-line btn-rect">
                                    <i class="fa fa-pencil"></i> Editer
                                </a>

                            </div>
                </div>
                @endif

                @endforeach


                @if(Auth::check() && Auth::user()->admin == 1)

                    <h2>Les utilisateurs du site</h2>
                    @foreach($users as $user)
                        <div class="panel-body col-md-3">

                            <p><b>Nom </b>{{$user->name}}</p>
                            <p><b>Email </b>{{$user->email}}</p>

                            <p><b>Création le </b>{{$user->created_at}}</p>
                            <p><b>Mis à jour le </b>{{$user->updated_at}}</p>
                            <p><b>Rôle </b>
                                @if($user->admin == 1)
                                    Administrateur
                                @else($user->admin == 0)
                                    Utilisateur
                                @endif
                            </p>



                            <a href="{{ route('user.edit', $user->id)}}" class="btn btn-success btn-line btn-rect">
                                <i class="fa fa-pencil"></i> Editer
                            </a>

                        </div>
                    @endforeach

                @endif
            </div>
        </div>
@endsection