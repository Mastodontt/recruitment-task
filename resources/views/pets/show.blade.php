@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
@include('inc.alert')
<div class="container mt-5">
    <h1 class="mb-4">Pet Details</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h2>Pet: {{ $pet->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $pet->id }}</p>
            <p><strong>Status:</strong> {{ ucfirst($pet->status) }}</p>

            <h4>Category</h4>
            <p><strong>Category ID:</strong> {{ $pet->category['id'] }}</p>
            <p><strong>Category Name:</strong> {{ $pet->category['name'] }}</p>

            <h4>Photo URLs</h4>
            <ul>
                @foreach ($pet->photoUrls as $url)
                    <li>
                        <a href="{{ $url }}" target="_blank">{{ $url }}</a>
                    </li>
                @endforeach
            </ul>

            <h4>Tags</h4>
            @if (!empty($pet->tags))
                <ul>
                    @foreach ($pet->tags as $tag)
                        <li>
                            <strong>Tag ID:</strong> {{ $tag['id'] ?? '' }},
                            <strong>Name:</strong> {{ $tag['name'] ?? '' }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No tags available.</p>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('pets.index') }}" class="btn btn-secondary">Back</a>
        
        <form action="{{ route('pets.destroy', $pet->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this pet?')">Delete Pet</button>
        </form>
    </div>

</div>
@endsection
