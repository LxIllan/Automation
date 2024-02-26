<?php

namespace App\Http\Controllers;

use App\Http\Requests\PieceCategoryStoreRequest;
use App\Http\Requests\PieceCategoryUpdateRequest;
use App\Models\PieceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PieceCategoryController extends Controller
{
    public function index(Request $request): Response
    {
        $pieceCategories = PieceCategory::all();

        return view('pieceCategory.index', compact('pieceCategories'));
    }

    public function create(Request $request): Response
    {
        return view('pieceCategory.create');
    }

    public function store(PieceCategoryStoreRequest $request): Response
    {
        $pieceCategory = PieceCategory::create($request->validated());

        $request->session()->flash('pieceCategory.id', $pieceCategory->id);

        return redirect()->route('pieceCategory.index');
    }

    public function show(Request $request, PieceCategory $pieceCategory): Response
    {
        return view('pieceCategory.show', compact('pieceCategory'));
    }

    public function edit(Request $request, PieceCategory $pieceCategory): Response
    {
        return view('pieceCategory.edit', compact('pieceCategory'));
    }

    public function update(PieceCategoryUpdateRequest $request, PieceCategory $pieceCategory): Response
    {
        $pieceCategory->update($request->validated());

        $request->session()->flash('pieceCategory.id', $pieceCategory->id);

        return redirect()->route('pieceCategory.index');
    }

    public function destroy(Request $request, PieceCategory $pieceCategory): Response
    {
        $pieceCategory->delete();

        return redirect()->route('pieceCategory.index');
    }
}
