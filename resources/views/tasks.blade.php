@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Todo List
@endsection


@section('main-content')
   <div id="app">

       <script>
           Window.access_token = {{ $access_token }}
       </script>

       <todos></todos>

   </div>
@endsection
