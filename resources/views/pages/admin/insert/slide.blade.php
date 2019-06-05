@extends('layouts.admin')

@section('title','Admin - Insert Slide')

@section('content')
    <h1>Insert slide</h1>
    <form action="{{url('/')}}/admin/insert/slide" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="caption">Caption:</label>
            <input type="text" name="caption" id="tbCaption" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="subCaption">Sub caption:</label>
            <input type="text" name="subCaption" id="tbSubCaption" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="picture">Image:</label>
            <input type="file" name="picture" id="fImage" class="form-control-file">
            <span class="font-italic">Picture must be in 16:9 aspect ratio.</span>
        </div>
        <div class="form-group">
            <label for="pictureAlt">Image alt:</label>
            <input type="text" name="pictureAlt" id="tbImageAlt" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="btnInsertSlide">Insert</button>
            <button type="reset" class="btn btn-danger" name="btnReset">Reset</button>
        </div>
    </form>
@endsection