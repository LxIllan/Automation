<?php

namespace App\Http\Controllers;

use App\Http\Requests\PieceStoreRequest;
use App\Http\Requests\PieceUpdateRequest;
use App\Models\Piece;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PieceController extends Controller
{
    public function index(Request $request): Response
    {
        $pieces = Piece::all();

        return view('piece.index', compact('pieces'));
    }

    public function create(Request $request): Response
    {
        return view('piece.create');
    }

    public function store(PieceStoreRequest $request): Response
    {
        $piece = Piece::create($request->validated());

        $request->session()->flash('piece.id', $piece->id);

        return redirect()->route('piece.index');
    }

    public function show(Request $request, Piece $piece): Response
    {
        return view('piece.show', compact('piece'));
    }

    public function edit(Request $request, Piece $piece): Response
    {
        return view('piece.edit', compact('piece'));
    }

    public function update(PieceUpdateRequest $request, Piece $piece): Response
    {
        $piece->update($request->validated());

        $request->session()->flash('piece.id', $piece->id);

        return redirect()->route('piece.index');
    }

    public function destroy(Request $request, Piece $piece): Response
    {
        $piece->delete();

        return redirect()->route('piece.index');
    }
}
