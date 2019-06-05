@extends('layouts.app')

@section('title','About')
@section('content')
    <div class="row content">
        <div class="col-invisible col-lg-3"></div>
        <div class="col-12 col-lg-6">
            <table class="table table-striped table-hover">
                <tr>
                    <th>Author's name:</th>
                    <td>Jovan Sekulic</td>
                </tr>
                <tr>
                    <th>Date of birth:</th>
                    <td>02.09.1996</td>
                </tr>
                <tr>
                    <th>Current location:</th>
                    <td>Belgrade, Serbia</td>
                </tr>
                <tr>
                    <th>Contact e-mail address:</th>
                    <td>jovan.sekulic.298.16@ict.edu.rs</td>
                </tr>
                <tr>
                    <th>Faculty:</th>
                    <td><a href="https://www.ict.edu.rs/" target="_blank">Visoka ICT Skola</a></td>
                </tr>
                <tr>
                    <th>General orientation:</th>
                    <td>Internet technologies</td>
                </tr>
                <tr>
                    <th>Year:</th>
                    <td>2018/19</td>
                </tr>
            </table>
        </div>
        <div class="col-invisible col-lg-3"></div>
    </div>
@endsection