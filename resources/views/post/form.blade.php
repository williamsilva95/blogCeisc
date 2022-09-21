@extends('main')

@section('content')
    <br><br>
    <div class="mt-5 row d-flex justify-content-center">
        <div class="col-md-5">
            <br/>
            <div class="card">
                <div class="card-header text-center">
                    <h5> {{ (isset($post)) ? 'Editar' : 'Adicionar' }} Postagem</h5>
                </div>
                @if(isset($post))
                    {!! Form::model($post, ['action' => ('PostController@store'), 'id' => 'form-post', 'files' => true]) !!}
                @else
                    {!! Form::open(['action' => ('PostController@store'), 'id' => 'form-post', 'files' => true]) !!}
                @endif
                @if(session('erro'))
                    <div class="alert alert-danger">
                        {{session('erro')}}
                    </div>
                @endif
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    {!! Form::hidden('id', null) !!}
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('titulo', 'Título', ['class' => 'required']) !!}
                            {!! Form::text('titulo', isset($post) ? $post->titulo : null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('descricao', 'Descrição', ['class' => 'required']) !!}
                            {!! Form::textarea('descricao', isset($post) ? $post->descricao : null, ['class' => 'form-control','rows' => '3']) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="imagem">Imagem</label>
                            <input name="imagem" type="file" class="form-control-file" id="imagem" value="{{ isset($post) ? $post->imagem : null }}">
                        </div>
                    </div>
                    <br>
                    <div class="row d-flex justify-content-center">
                        <a href="{{url('/post')}}" type="button" class="btn btn-primary btn-flat btn-sm mr-3">Cancelar </a>
                        <button type="submit" class="sendDisabled btn btn-success btn-sm btn-flat" id="salvar">Salvar</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
