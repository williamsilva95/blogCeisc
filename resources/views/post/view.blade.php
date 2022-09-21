@extends('main')

@section('content')
    <div class="container mt-5">
        {{--Comentado por causa da adição dos swal --}}
        {{--@if(session('status'))
            <div class="row d-flex justify-content-center">
                 <div class="col-md-6 mt-3">
                    <div class="alert alert-success text-center">
                        {{session('status')}}
                    </div>
                 </div>
            </div>
        @endif--}}
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mt-3">
                <div class="card mb-3">
                    <img
                        src="{{ url('storage/'.$post->imagem) }}" alt="{{$post->titulo}}"
                        class="card-img-top" width="400" height="300"/>
                    <div class="card-body">
                        <h4 class="card-title text-center">{{$post->titulo}}</h4>
                        <p class="card-text">
                            {{$post->descricao}}
                        </p>
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <p class="card-text text-left mb-0">
                                    <small class="text-muted">Total Vizualização: {{ $post->total_visualizacao }}</small>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text text-right mb-0">
                                    <small class="text-muted">Publicado por: {{Auth::user()->name}}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{url('post/adicionar-gostei/'.$post->id)}}" class="btn btn-success btn-sm mr-3">Gostei ({{$post->total_gostei}})</a>
                        <a href="{{url('post/adicionar-naogostei/'.$post->id)}}" class="btn btn-danger btn-sm">Não Gostei ({{$post->total_naogostei}})</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/posts.js') }}"></script>
@endsection
