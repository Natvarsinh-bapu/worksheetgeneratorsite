@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <a href="{{ url('/dashboard') }}" class="btn btn-warning">Back</a>
                    <span class="ml-2">Students of Class <b>{{ $classdata->name }}</b></span>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Enrollment No.</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($assigned_worksheets as $item)
                                <div class="font-weight-bold">
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->student->name }}</td>
                                        <td>{{ $item->student->enrollment_number }}</td>
                                        <td>{{ $item->student->email }}</td>
                                        <td>
                                            <a href="{{ url('/student-worksheets/' . $item->student->id) }}" class="btn btn-info">View worksheets</a>
                                        </td>
                                    </tr>
                                </div>
                            @empty
                                <tr>
                                    <td>
                                        No worksheet assigned to any student of class <b>{{ $classdata->name }}</b>
                                    </td>
                                </tr>
                            @endforelse                            
                        </tbody>
                    </table> 
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="m-2">
                                {{ $assigned_worksheets->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
