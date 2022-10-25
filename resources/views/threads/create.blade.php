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
                    <label for="">Título do Tópico</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Conteúdo Tópico</label>
                    <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <button class="btn btn-lg btn-primary mt-3" type="submit">Criar Tópico</button>
            </form>
        </div>
    </div>
@endsection
