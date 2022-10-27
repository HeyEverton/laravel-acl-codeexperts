@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Tópicos</h2>
            <hr>
        </div>
    </div>

    <div class="col-12">
        @forelse ($threads as $thread)
        <div class="list-group mb-2">
            
            <a href="{{ route('threads.show', $thread->slug) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div class="">
                    <h5>{{ $thread->title }}</h5>
                    <small>Criado em {{ $thread->created_at->diffForHumans() }} por {{$thread->user->name}} </small>
                    <span class="badge  text-bg-primary">{{$thread->channel->slug}}</span>
                </div>

                
                    <span class="badge rounded-pill text-bg-warning">{{$thread->replies->count()}}</span>                                           
                </a>
            </div>

        @empty
            <div class="alert alert-warning">
                Nenhum Tópio encontrado.
            </div>
        @endforelse

        {{ $threads->links() }}
    </div>
@endsection()
