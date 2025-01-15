<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pets\PetCreateRequest;
use App\Http\Requests\Pets\PetDeleteRequest;
use App\Http\Requests\Pets\PetEditRequest;
use App\Http\Requests\Pets\PetIndexRequest;
use App\Http\Requests\Pets\PetShowRequest;
use App\Http\Requests\Pets\PetStoreRequest;
use App\Http\Requests\Pets\PetUpdateRequest;
use App\Services\Pets\PetClient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

final class PetController
{
    public function __construct(private PetClient $client)
    {
    }

    public function index(PetIndexRequest $request): View
    {
        return view('pets.index');
    }

    public function create(PetCreateRequest $request): View
    {
        return view('pets.create');
    }

    public function store(PetStoreRequest $request): RedirectResponse
    {
        try {
            $this->client->pets()->create($request->validated());
        } catch (\Throwable $exception) {
            return back()->withErrors(['error' => 'An error occurred while creating the pet.']);
        }

        return redirect()->route('pets.index')->with('success', 'Pet created successfully!');
    }

    public function update(PetUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->client->pets()->update($request->validated());
        } catch (\Throwable $exception) {
            return back()->withErrors(['error' => 'An error occurred while updating the pet.']);
        }

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully!');
    }

    public function show(PetShowRequest $request, int $id): RedirectResponse
    {
        try {
            $response = $this->client->pets()->getById($id);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->withErrors(['error' => 'An error occurred while showing pet.']);
        }

        $pet = json_decode($response->body(), true);

        return view('pets.show', compact('pet'));
    }

    public function edit(PetEditRequest $request, int $id): RedirectResponse
    {
        try {
            $response = $this->client->pets()->getById($id);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->withErrors(['error' => 'An error occurred while editing pet.']);
        }

        $pet = json_decode($response->body(), true);

        return view('pets.edit', compact('pet'));
    }

    public function destroy(PetDeleteRequest $request, int $id): RedirectResponse
    {
        try {
            $this->client->pets()->delete($id);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->withErrors(['msg' => 'An error occured while deleting pet']);
        }

        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully!');
    }
}
