<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Http\Requests\ReplyRequest;


class ReplyController extends Controller
{
    public function store(ReplyRequest $request)
    {
        try {
            $reply = $request->all();
            $reply['user_id'] = 1;

            $thread = Thread::find($request->thread_id);
            $thread->replies()->create($reply);

            flash('Resposta enviada com sucesso!')->success();
            return redirect()->back();

        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar o Tópico.';
            flash($message)->warning();   
            return redirect()->back();
        }
    }
}
