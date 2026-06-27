@extends('layouts.app')

@section('title', 'Register - Maison de Hoor')

@section('content')
<div style="min-height: 90vh; display: flex; align-items: center; justify-content: center; background-color: #FFFCF7; padding: 2rem;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <!-- Card -->
                <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    <!-- Header -->
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <h1 style="font-size: 2rem; color: #2C2C2C; font-weight: 700; margin-bottom: 0.5rem;">
                            Create Account
                        </h1>
                        <p style="color: #999; font-size: 0.95rem;">Join Maison de Hoor and start shopping</p>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div style="margin-bottom: 1.5rem;">
                            <label for="name" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem;">
                                FULL NAME
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                   style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                                   onfocus="this.style.borderColor='#B49F79'"
                                   onblur="this.style.borderColor='#E0E0E0'">
                            @error('name')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div style="margin-bottom: 1.5rem;">
                            <label for="email" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem;">
                                EMAIL ADDRESS
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                                   onfocus="this.style.borderColor='#B49F79'"
                                   onblur="this.style.borderColor='#E0E0E0'">
                            @error('email')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div style="margin-bottom: 1.5rem;">
                            <label for="password" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem;">
                                PASSWORD
                            </label>
                            <input type="password" id="password" name="password" required
                                   style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                                   onfocus="this.style.borderColor='#B49F79'"
                                   onblur="this.style.borderColor='#E0E0E0'">
                            @error('password')
                                <span style="color: #E74C3C; font-size: 0.9rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div style="margin-bottom: 2rem;">
                            <label for="password_confirmation" style="display: block; font-weight: 600; color: #2C2C2C; margin-bottom: 0.5rem;">
                                CONFIRM PASSWORD
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                   style="width: 100%; padding: 12px 15px; border: 2px solid #E0E0E0; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                                   onfocus="this.style.borderColor='#B49F79'"
                                   onblur="this.style.borderColor='#E0E0E0'">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" style="width: 100%; padding: 12px; background: #B49F79; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 1rem; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s;"
                                onmouseover="this.style.background='#C893A0'"
                                onmouseout="this.style.background='#B49F79'">
                            Create Account
                        </button>
                    </form>

                    <!-- Divider -->
                    <div style="text-align: center; margin: 2rem 0; position: relative;">
                        <div style="border-top: 1px solid #E0E0E0;"></div>
                        <span style="background: white; padding: 0 1rem; color: #999; font-size: 0.9rem; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            OR
                        </span>
                    </div>

                    <!-- Login Link -->
                    <div style="text-align: center;">
                        <p style="color: #666; font-size: 0.95rem;">
                            Already have an account?
                            <a href="{{ route('login') }}" style="color: #B49F79; font-weight: 600; text-decoration: none;">
                                Sign in
                            </a>
                        </p>
                    </div>

                    <!-- Back to Shop -->
                    <div style="text-align: center; margin-top: 1.5rem;">
                        <a href="{{ route('home') }}" style="color: #999; font-size: 0.9rem; text-decoration: none;">
                            ← Back to Shop
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
