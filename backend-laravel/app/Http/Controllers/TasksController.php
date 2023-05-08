<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::get();  // select * from tasks; // Retorna um objeto do tipo Collection com varios objetos do tipo Task, onde cada Task vai ter atributos do registro e metodos de gestão
        return $tasks;
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'    => 'required|min:5|max:15',
            'descricao' => 'required'
        ]);
        $task              = new Task();
        $task->title       = $request->input('titulo');
        $task->description = $request->input('descricao');
        $task->save();
        return $task;
    }
    public function show($id)
    {
        $task = Task::where('id', $id)->first(); // essa linha traz o mesmo resultado da linha de baixo
        $task = Task::find($id);
        return $task;
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo'     => 'min:5|max:15|nullable',
            'descricao'  => 'nullable',
            'finalizado' => 'nullable|date_format:d/m/Y'
        ]);
        $task              = Task::find($id);
        $task->title       = $request->input('titulo', $task->title);
        $task->description = $request->input('descricao', $task->description);
        $task->finished_at = $request->exists('finalizado') ? Carbon::createFromFormat('d/m/Y', $request->input('finalizado'))->format('Y-m-d') : null;
        $task->save();
        return $task;
    }
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
    }
}
