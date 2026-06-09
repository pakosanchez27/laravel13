@extends('layouts.auth')

@section('title')
    Confirma tu Cuenta
@endsection

@section('auth-content')
    <p class="mt-5 text-lg text-gray-600">Tu cuenta ha sido creada exitosamente. Por favor, verifica tu correo electrónico
        para activar tu cuenta.</p>

    @if (session('success'))
        <x-alert :message="session('success')" />
    @endif
    <p class="mt-3 text-sm text-gray-500">Si no has recibido el correo de verificación, puedes solicitar uno nuevo.</p>
    <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
        @csrf
        <button type="submit"
            class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Reenviar Correo de Verificación
        </button>
    </form>
@endsection
