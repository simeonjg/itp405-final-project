@extends('layout')

@section('title', 'Profile - ' . $user->username)

@section('main')
    <h1>Profile</h1>
    <p>Hello {{ $user->username }}. View and/or edit your profile details below.</p>

    
    <!-- Alert section -->
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form section -->
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <!-- Name -->
        <div class="mb-3">
            <label for="first-name" class="form-label">First Name</label>
            <input type="text" name="first-name" id="first-name" class="form-control @error('first-name') is-invalid @enderror" value="{{ old('first-name', $user->first_name) }}">
            @error ('first-name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="mb-3">
            <label for="last-name" class="form-label">Last Name</label>
            <input type="text" name="last-name" id="last-name" class="form-control @error('last-name') is-invalid @enderror" value="{{ old('last-name', $user->last_name) }}">
            @error ('last-name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
            @error ('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}">
            @error ('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Subscription -->
        <div class="my-3 form-check">
            <input type="checkbox" name="is-subscribed" id="is-subscribed" class="form-check-input" value=1 {{ old('is-subscribed', $user->is_subscribed) ? 'checked' : '' }}>
            <label for="is-subscribed" class="form-check-label">Subscribed to Newsletter</label>
        </div>
    
        <button type="submit" class="btn btn-primary">
            Save Changes
        </button>
    </form>
@endsection