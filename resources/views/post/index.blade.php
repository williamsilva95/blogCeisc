@extends('main')

@section('content')
    <div class="container mt-4">
        <br/>
        <div class="card">
            <div class="card-header text-right">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <button onClick="inserir();" class="btn btn-primary btn-sm" role="button" data-toggle="modal">Adicionar</button>
                        <a href="{{url('post/exportar')}}" class="btn btn-success btn-sm" role="button"> Exportar </a> 
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline my-lg-0 d-flex justify-content-end" action="{{url('post/pesquisar')}}" method="post">
                            {{csrf_field()}}
                            <input class="form-control mr-sm-2 form-control-sm" type="search" placeholder="Search" aria-label="Search" name="texto">
                            <button class="btn btn-success btn-sm" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($result as $value)
                        <div class="col-md-4 mb-3">
                            <div class="card text-center ml-2 mb-5 h-100">
                                <img src="{{ url('storage/'.$value->imagem) }}" alt="{{$value->titulo}}"
                                     class="card-img-top" height="300"/>
                                <div class="card-body">
                                    <h5 class="card-title">{{$value->titulo}}</h5>
                                    <p class="card-text">{{$value->descricao}}</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <small class="text-muted text-left ml-2"> Publicado por: {{Auth::user()->name}}</small>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <small class="text-muted text-right mr-2">{{ date("d-m-Y", strtotime($value->created_at)) }}</small>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button onClick="visualizar({{$value->id}})" class="btn btn-success btn-sm mr-3" role="button">Vizualizar</button>
                                    <button onClick="editar({{$value->id}})" class="btn btn-primary btn-sm mr-3" role="button">Editar</button>
                                    <button onClick="deletar('{{$value->id}}', '{{$value->titulo}}')" class="btn btn-danger btn-sm " role="button">Deletar</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-9 skin-pattern">
                            {!! $result->render(); !!}
                        </div>
                        <div class="col-md-3" style="text-align: right;">
                            <br/>
                            Mostrando {!! $result->firstItem() !!} a {!! $result->lastItem() !!}
                            de {!! $result->total() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts-footer')
    <script type="text/javascript" src="{{ asset('js/app/post.js') }}"></script>
@endsection
