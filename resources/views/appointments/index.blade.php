@extends('layouts.main')

@section('title', 'Appointments')

@section('content')

@if ($account->role == 'user' || $account->role == 'admin')
    @include('appointments.user')

@elseif ($account->role == 'professional')
    @include('appointments.professional')

@endif

@endsection
