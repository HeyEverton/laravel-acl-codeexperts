<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadRequest;
use App\Models\{Channel, Thread, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ThreadController extends Controller
{

    public function __construct(private Thread $thread)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Channel $channel)
    {
        // $this->authorize('threads/index');

        $channelParam = $request->channel;
        if(null !== $channelParam) {
            $threads = $channel->whereSlug($channelParam)->first()->threads()->paginate(15);
        } else {
            $threads = $this->thread->orderBy('created_at', 'DESC')->paginate(15);            
        }

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Channel $channel)
    {
        return view('threads.create', [
            'channels' => $channel->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        try {
            $thread = $request->all();
            $thread['slug'] = Str::slug($thread['title']);

            $user = User::find(1);
            $thread = $user->threads()->create($thread);

            flash('Tópico criado')->success();

            return redirect()->route('threads.show', $thread['slug']);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ?$e->getMessage() : 'Erro ao processar o Tópico.';
            flash($message)->warning();         

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();

        return view('threads.show', compact('thread') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();
        
        $this->authorize('update', $thread);
        
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $thread)
    {
        try {
            $thread = $this->thread->whereSlug($thread)->first();
            $thread->update($request->all());

            flash('Tópico atualizado com sucesso!')->success();
            return redirect()->route('threads.show', $thread->slug);

        } catch (\Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar o Tópico.';
            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($thread)
    {
        try {
            $thread = $this->thread->whereSlug($thread)->first();
            if(!$thread) return redirect()->route('threads.index');
            $thread->delete();
            flash('Tópico excluído com sucesso!')->success();
            return redirect()->route('threads.index');

        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar o Tópico.';
            flash($message)->warning();

            return redirect()->back();
        }
    }
}
