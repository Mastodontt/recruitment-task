<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Pet;
use App\Http\Requests\Pets\PetCreateRequest;
use App\Http\Requests\Pets\PetDeleteRequest;
use App\Http\Requests\Pets\PetEditRequest;
use App\Http\Requests\Pets\PetIndexRequest;
use App\Http\Requests\Pets\PetShowRequest;
use App\Http\Requests\Pets\PetStoreRequest;
use App\Http\Requests\Pets\PetUpdateRequest;
use App\Services\Pets\PetClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

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

    public function store(PetStoreRequest $request): View|RedirectResponse
    {
        try {
            $response = $this->client->pets()->create($request->validated());
        } catch (\Throwable $exception) {
            Log::error('Failed to store pet: ', $exception->getMessage());

            if ($exception instanceof RequestException) {
                $errorResponse = $exception->response;
                $errorData = json_decode($errorResponse->body(), true);
                $errorMessage = $errorData['message'] ?? 'An error occurred while creating the pet.';
            }

            if ($exception instanceof ConnectionException) {
                $errorMessage = 'Unable to connect to the service. Please try again later.';
            }

            $errorMessage = $errorMessage ?? 'An error occurred while creating pet.';

            return back()->with(['error' => $errorMessage]);
        }

        $pet = Pet::fromArray(json_decode($response->body(), true));

        return view('pets.show', compact('pet'))->with('success', 'Pet created successfully!');
    }

    public function update(PetUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->client->pets()->update($request->validated());
        } catch (\Throwable $exception) {
            Log::error('Failed to update pet ID: '.$id, $exception->getMessage());

            if ($exception instanceof RequestException) {
                $errorResponse = $exception->response;
                $errorData = json_decode($errorResponse->body(), true);
                $errorMessage = $errorData['message'] ?? 'An error occurred while updating the pet.';
            }

            if ($exception instanceof ConnectionException) {
                $errorMessage = 'Unable to connect to the service. Please try again later.';
            }

            $errorMessage = $errorMessage ?? 'An error occurred while updating pet.';

            return back()->with(['error' => $errorMessage]);
        }

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully!');
    }

    public function show(PetShowRequest $request, int $id): View|RedirectResponse
    {
        try {
            $response = $this->client->pets()->getById($id);
        } catch (\Throwable $exception) {
            Log::error('Failed to show pet ID: '.$id, $exception->getMessage());

            if ($exception instanceof RequestException) {
                $errorResponse = $exception->response;
                $errorData = json_decode($errorResponse->body(), true);
                $errorMessage = $errorData['message'] ?? 'An error occurred while showing the pet.';
            }

            if ($exception instanceof ConnectionException) {
                $errorMessage = 'Unable to connect to the service. Please try again later.';
            }

            $errorMessage = $errorMessage ?? 'An error occurred while showing pet.';

            return back()->with(['error' => $errorMessage]);
        }

        $pet = Pet::fromArray(json_decode($response->body(), true));

        return view('pets.show', compact('pet'));
    }

    public function edit(PetEditRequest $request, int $id): View|RedirectResponse
    {
        try {
            $response = $this->client->pets()->getById($id);
        } catch (\Throwable $exception) {
            Log::error('Failed to edit pet ID: '.$id, $exception->getMessage());

            if ($exception instanceof RequestException) {
                $errorResponse = $exception->response;
                $errorData = json_decode($errorResponse->body(), true);
            }

            if ($exception instanceof ConnectionException) {
                $errorMessage = 'Unable to connect to the service. Please try again later.';
            }

            $errorMessage = $errorMessage ?? 'An error occurred while editing pet.';

            return back()->with(['error' => $errorMessage]);
        }

        $pet = Pet::fromArray(json_decode($response->body(), true));

        return view('pets.edit', compact('pet'));
    }

    public function destroy(PetDeleteRequest $request, int $id): RedirectResponse
    {
        try {
            $this->client->pets()->delete($id);
        } catch (\Throwable $exception) {
            Log::error('Failed to delete pet ID: '.$id, $exception->getMessage());

            if ($exception instanceof RequestException) {
                $errorResponse = $exception->response;
                $errorData = json_decode($errorResponse->body(), true);
                $errorMessage = $errorData['message'] ?? 'An error occurred while deleting the pet.';
            }

            if ($exception instanceof ConnectionException) {
                $errorMessage = 'Unable to connect to the service. Please try again later.';
            }

            $errorMessage = $errorMessage ?? 'An error occurred while deleting the pet.';

            return back()->with(['error' => $errorMessage]);
        }

        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully!');
    }
}
