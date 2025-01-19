@extends('layouts.app')

@section('title', 'Pets')

@section('content')
@include('inc.alert')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-4">
            <a href="{{ route('pets.create') }}" class="btn btn-primary">Create New Pet</a>
        </div>

        <div class="col-md-8">
            <form id="search-form" class="d-flex justify-content-end">
                <input 
                    type="number" 
                    id="pet-id" 
                    name="pet_id" 
                    class="form-control me-2" 
                    placeholder="Enter Pet ID" 
                    required
                >
                <button 
                    type="button" 
                    id="show-btn" 
                    class="btn btn-info me-2"
                >
                    Show
                </button>
                <button 
                    type="button" 
                    id="edit-btn" 
                    class="btn btn-warning"
                >
                    Edit
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('show-btn').addEventListener('click', function () {
        const petId = document.getElementById('pet-id').value;
        if (petId) {
            window.location.href = `/pets/${petId}`;
        } else {
            alert('Please enter a valid Pet ID.');
        }
    });

    document.getElementById('edit-btn').addEventListener('click', function () {
        const petId = document.getElementById('pet-id').value;
        if (petId) {
            window.location.href = `/pets/${petId}/edit`;
        } else {
            alert('Please enter a valid Pet ID.');
        }
    });
</script>
@endsection
