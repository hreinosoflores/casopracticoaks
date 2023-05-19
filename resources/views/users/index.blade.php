@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gestion de usuarios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Gestion de usuarios</li>
                </ol>
            </div>
        </div>
    </div>
@stop
@section('content')
    <livewire:user-index />
@stop
@section('css')
@stop
@section('js')
@stop
