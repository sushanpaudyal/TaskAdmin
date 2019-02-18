@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Task</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form action="{{route('tasks.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="description">
                                </div>

                                <div class="form-group">
                                    <label>Command</label>
                                    <input type="text" class="form-control" name="command">
                                </div>

                                <div class="form-group">
                                    <label>CRON Expression</label>
                                    <input type="text" class="form-control" name="expression" value="* * * * *">
                                </div>

                                <div class="form-group">
                                    <label>Notification Email</label>
                                    <input type="text" class="form-control" name="notification_email">
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="dont_overlap" value="1">
                                    <label for="" class="form-check-label">Don't Overlap</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="run_in_maintenance" value="1">
                                    <label for="" class="form-check-label">Run in Maintainance</label>
                                </div>
                                <br>

                               <div class="float-right">
                                   <button class="btn btn-primary" type="submit">Create Task</button>
                                   <a href="{{route('tasks.index')}}" class="btn btn-danger">Cancel</a>
                               </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
