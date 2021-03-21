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
                    Companies
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ url('company/add') }}">+</a>
                    </div>
                </div>

                <div class="card-body">
                    @if(!$companies->isEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">logo</th>
                            <th scope="col">website</th>
                            <th scope="col">Action</th>
                            </tr>
                            </tr>
                        </thead>
                        @php 
                            $i = 1;
                        @endphp
                        <tbody>
                            @foreach( $companies as $company )
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td> 
                                        <img src="{{ $company->logo }}" height="100px" width="100px" /> 
                                    </td>
                                    <td>{{ $company->website }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ url('company/edit/'. $company->id) }}">Edit</a>    
                                        <form method="POST" action="{{ url('company/delete') }}">
                                            <input type="hidden" name="id" value="{{ $company->id }}" />
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
