@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        

                        <div class="btn-group-vertical float-left club-header">
                            <h4>{{ $club->name }}</h4>
                        </div>

                        {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-danger" href="{{ route('club.index') }}">Voltar</a>
                        </div> --}}
                        <div class="btn-group-vertical float-right">
                            <a class="btn btn-info" href="{{ route('club.index') }}">Voltar</a>
                            {{-- <button type="button" class="btn btn-default">
                                
                            </button> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        <h5>Novo Associado</h5>
                        <form class="form-inline" action="{{ route('affiliates.store', ['club' => $club->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="bmd-label-floating">Associado</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <span class="form-group bmd-form-group">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </span>
                        </form>

                        <div class="table-responsive">
                            <table class="table table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Clube</th>
                                    <th>Associado</th>
                                    <th>Data de Associação</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($affiliates as $affiliate)
                                    <tr>
                                        <th scope="row">{{ $affiliate->id }}</th>
                                        <td>{{ $club->name }}</td>
                                        <td>{{ $affiliate->name }}</td>
                                        <td>{{ date('d/m/Y', strtotime($affiliate->associeted)) }}</td>
                                        <td>
                                            <a title="Excluir Associado" href="{{ route('affiliates.destroy', ['affiliates' => $affiliate->id, 'club' => $club->id])}}"><i class="fa fa-times" aria-hidden="true"></i></a>
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



    <script type="text/javascript">

        // CSRF Token
        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
    
          $( "#name" ).autocomplete({
            source: function( request, response ) {
              // Fetch data
              $.ajax({
                url:"/affiliates/get/",
                type: 'get',
                dataType: "json",
                data: {
                //    _token: CSRF_TOKEN,
                   search: request.term
                },
                success: function( data ) {
                   response( data );
                }
              });
            },
            select: function (event, ui) {

                $('#name').val(ui.item.label); // display the selected text
                
                return false;
            }
          });
    
        });
    </script>
    </div>
@endsection
