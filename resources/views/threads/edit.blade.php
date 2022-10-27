@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Editar Tópico</h2>
            <hr>
        </div>
        <div class="col-12">
            <form action="{{route('threads.update', $thread->slug)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Título do Tópico</label>
                    <input type="text" name="title" value="{{$thread->title}}" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Conteúdo Tópico</label>
                    <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$thread->body}}</textarea>
                    @error('body')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <button class="btn btn-lg btn-info mt-3" type="submit">Atualizar Tópico</button>
            </form>
        </div>
    </div>
@endsection
