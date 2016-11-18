@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Todo List
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        <ol>
                            <li v-for="todo in todos"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
