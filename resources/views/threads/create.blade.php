@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Criar Tópico</h2>
            <hr>
        </div>
        <div class="col-12">
            <form action="{{ route('threads.store')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="channel" >Escolha um canal para um tópico</label>
                    <select name="channel_id" id="channel" class="form-control mb-3 @error('channel_id') is-invalid @enderror">
                        <option value="">Selecione um canal</option>
                        @foreach ($channels as $channel)
                        <option value="{{$channel->id}}"
                            @if (old('channel_id') == $channel->id) @selected(true)  @endif
                            >{{$channel->name}}</option>                            
                        @endforeach
                    </select>
                    @error('channel_id')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Título do Tópico</label>
                    <input type="text" name="title" class="form-control mb-3 @error('title') is-invalid @enderror" value="{{old('title')}}">
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Conteúdo Tópico</label>
                    <textarea name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror" value="{{old('body')}}"></textarea>
                    @error('body')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <button class="btn btn-lg btn-primary mt-3" type="submit">Criar Tópico</button>
            </form>
        </div>
    </div>
@endsection
