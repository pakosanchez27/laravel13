@extends('layouts.auth')

@section('title')
    Administra tus presupuestos
@endsection

@section('auth-content')
    <x-alert :message="session('success')" />
@endsection
