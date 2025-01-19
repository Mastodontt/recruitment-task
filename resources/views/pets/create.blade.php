@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
@include('inc.alert')
<form action="{{ route('pets.store') }}" method="POST">
    @csrf
    @include('pets.form')
    <button type="submit" class="btn btn-primary">Create Pet</button>
    <a href="{{ route('pets.index') }}">
        <button type="button" class="btn btn-primary">Back</button>
    </a>
</form>
@endsection
