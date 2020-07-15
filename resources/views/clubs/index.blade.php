@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="btn-group-vertical float-left club-header">
                            <h4> Clubes </h4>
                        </div>

                        {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-danger" href="{{ route('club.index') }}">Voltar</a>
                        </div> --}}
                    </div>

                    <div class="card-body">

                        <form class="form-inline" action="{{ route('clubs.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="bmd-label-floating">Clube</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <span class="form-group bmd-form-group">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </span>
                        </form>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Clube</th>
                                    <th>Associados</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($clubs as $club)
                                    <tr>
                                        <th scope="row">{{ $club->id }}</th>
                                        <td><a href="{{ route('clubs.show', $club->id) }}">{{ $club->name }}</a></td>
                                        <td>{{ count($club->associations) }}</td>
                                        <td>
                                            <a title="Excluir clube" href="{{ route('clubs.destroy', ['club' => $club->id])}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
