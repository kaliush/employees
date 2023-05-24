<?php

namespace App\Http\Controllers;

use App\Dtos\Position\CreatePositionDto;
use App\Dtos\Position\UpdatePositionDto;
use App\Http\Requests\CreatePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use App\Services\PositionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function __construct(private readonly PositionService $positionService)
    {
    }

    public function index(): View
    {
        $positions = $this->positionService->getAll();

        return view('positions.index', compact('positions'));
    }

    public function create(): View
    {
        return view('positions.create');
    }

    public function store(CreatePositionRequest $request): RedirectResponse
    {
        $position = $request->validated();
        $dto = new CreatePositionDto($position['name']);
        $this->positionService->create($dto);

        return redirect()->route('positions.index')->with('success', 'Position created successfully!');
    }

    public function edit(Position $position): View
    {
        return view('positions.edit', compact('position'));
    }

    public function update(UpdatePositionRequest $request, Position $position): RedirectResponse
    {
        $data = $request->validated();
        $dto = new UpdatePositionDto($data['name'] ?? $position->name);
        $this->positionService->update($dto, $position->id);

        return redirect()->route('positions.index')->with('success', 'Position updated successfully!');
    }

    public function destroy(Position $position): RedirectResponse
    {
        $this->positionService->delete($position);

        return redirect()->route('positions.index')->with('success', 'Position deleted successfully!');
    }
}
