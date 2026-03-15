@extends('layouts.app')

@section('title', 'Liste des Permissions')

@section('content')

<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">

            <livewire:system.header-nav
                name="Liste des permissions"
                :nav="[
                    ['name' =>'Administration', 'url' => '#'],
                    ['name' => 'Liste des Permissions', 'url' => '#']
                ]"
            />

            <div class="d-flex gap-2">
                {{-- bouton futur --}}
            </div>

        </div>
        <!-- Page Header Close -->

        @include('partials.flash-message')

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">

                <livewire:admin.permissions-index />

            </div>
        </div>

    </div>
</div>

@endsection
