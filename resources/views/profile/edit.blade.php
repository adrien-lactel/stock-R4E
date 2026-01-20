@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">👤 Mon profil</h1>
        <p class="text-gray-600 mt-1">Gérer vos informations personnelles et votre compte</p>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            ✅ Profil mis à jour avec succès.
        </div>
    @endif

    <div class="space-y-6">
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

</div>
@endsection
