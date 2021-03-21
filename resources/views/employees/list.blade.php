@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{$error}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Employees
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ url('employee/add') }}">+</a>
                    </div>
                </div>

                <div class="card-body">
                    @if(!empty($employees) && !$employees->isEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Company</th>
                            <th scope="col">Action</th>
                            </tr>
                            </tr>
                        </thead>
                        @php 
                            $i = 1;
                        @endphp
                        <tbody>
                            @foreach( $employees as $employee )
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->company->name }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ url('employee/edit/'. $employee->id) }}">Edit</a>    
                                        <form method="POST" action="{{ url('employee/delete') }}">
                                            <input type="hidden" name="id" value="{{ $employee->id }}" />
                                            <input type="hidden" name="toDelete" value="1" />
                                            @csrf
                                            <input type="submit" class="btn btn-danger" value="Delete" />  
                                        </form>    
                                    </td>
                                </tr>
                                <tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        No Data Found!!!
                    @endif
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
