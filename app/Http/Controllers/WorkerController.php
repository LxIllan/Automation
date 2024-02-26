<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkerStoreRequest;
use App\Http\Requests\WorkerUpdateRequest;
use App\Models\Worker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerController extends Controller
{
    public function index(Request $request): Response
    {
        $workers = Worker::all();

        return view('worker.index', compact('workers'));
    }

    public function create(Request $request): Response
    {
        return view('worker.create');
    }

    public function store(WorkerStoreRequest $request): Response
    {
        $worker = Worker::create($request->validated());

        $request->session()->flash('worker.id', $worker->id);

        return redirect()->route('worker.index');
    }

    public function show(Request $request, Worker $worker): Response
    {
        return view('worker.show', compact('worker'));
    }

    public function edit(Request $request, Worker $worker): Response
    {
        return view('worker.edit', compact('worker'));
    }

    public function update(WorkerUpdateRequest $request, Worker $worker): Response
    {
        $worker->update($request->validated());

        $request->session()->flash('worker.id', $worker->id);

        return redirect()->route('worker.index');
    }

    public function destroy(Request $request, Worker $worker): Response
    {
        $worker->delete();

        return redirect()->route('worker.index');
    }
}
