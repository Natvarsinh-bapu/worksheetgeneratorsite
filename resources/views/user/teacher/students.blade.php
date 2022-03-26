@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/dashboard') }}" class="btn btn-warning">Back</a>
                    <span class="ml-2">Students of Class {{ $classdata->name }}</span>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Enrollment No.</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $item)
                                <div class="font-weight-bold">
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->enrollment_number }}</td>
                                        <td>{{ $item->email }}</td>
                                    </tr>
                                </div>
                            @empty
                                <tr>
                                    <td>
                                        No student available
                                    </td>
                                </tr>
                            @endforelse                            
                        </tbody>
                    </table>                    
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
