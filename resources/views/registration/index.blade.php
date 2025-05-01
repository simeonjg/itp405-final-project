@extends('layout')

@section('title', 'Sign Up')

@section('main')
  <h1>Create your MovieBuff Account</h1>

  <form method="POST" action="{{ route('registration.create') }}">
    @csrf
    <!-- First Name -->
    <div class="mb-3">
        <label for="first-name" class="form-label">First Name</label>
        <input type="text" name="first-name" id="first-name" class="form-control @error('first-name') is-invalid @enderror" value="{{ old('first-name') }}">
        @error ('first-name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Last Name -->
    <div class="mb-3">
        <label for="last-name" class="form-label">Last Name</label>
        <input type="text" name="last-name" id="last-name" class="form-control @error('last-name') is-invalid @enderror" value="{{ old('last-name') }}">
        @error ('last-name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
        @error ('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Username -->
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
        @error ('username')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
        @error ('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Subscription -->
    <div class="my-3 form-check">
        <input type="checkbox" name="is-subscribed" id="is-subscribed" class="form-check-input" value=1 {{ old('is-subscribed') ? 'checked' : '' }}>
        <label for="is-subscribed" class="form-check-label">Subscribe to Newsletter</label>
    </div>

    <button type="submit" class="btn btn-primary">
        Create Account
    </button>
@endsection 