@extends('layouts.admin')

@section('title','Admin - Slide List')

@section('content')
    <h1>Slides</h1>
    <div class="table-responsive-sm">
        <table class="table table-striped table-sm">
            <thead class="thead-dark">
            <th>#</th>
            <th>Caption</th>
            <th>Sub-caption</th>
            <th class="text-center">Action</th>
            </thead>
            <tbody>
            @foreach($slides as $slide)
                <tr>
                    <td>{{$slide->idSlide}}</td>
                    <td>{{$slide->caption}}</td>
                    <td>{{$slide->subCaption}}</td>
                    <td class="text-center" style="max-width: 80px">
                        <a href="{{url('/')}}/slides/edit/{{$slide->idSlide}}" class="btn btn-outline-primary">Update</a>
                        <a href="{{url('/')}}/slides/delete/{{$slide->idSlide}}" class="btn btn-outline-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection