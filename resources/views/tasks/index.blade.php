@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tasks</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <th>Description</th>
                                <th>Last Run</th>
                                <th>Average Run Time</th>
                                <th>Next Run</th>
                            <th>Delete</th>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>
                                        <a href="{{route('tasks.edit', $task->id)}}">
                                            {{$task->description}}
                                        </a>
                                    </td>
                                    <td>{{$task->last_run}}</td>
                                    <td>{{$task->average_runtime}}</td>
                                    <td>{{$task->next_run}}</td>
                                    <td>
                                        <form id="delete-form-{{$task->id}}" action="{{route('tasks.destroy', $task->id)}}" method="post">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="btn btn-sm btn-danger" type="button" onclick="if(confirm('Are You Sure')) getElementById('delete-form-{{$task->id}}').submit();">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
