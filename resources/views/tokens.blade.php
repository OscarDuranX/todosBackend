@extends('adminlte::vendor.adminlte.layouts.app')

@section('htmlheader_title')
    Todo List
@endsection


@section('main-content')
    <div id="app">

        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>

    </div>
@endsection

