@extends('layouts.app')

@section('content')

<?php
// dd($AboutUs);
?>

<section id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h5>About Us</h5>
                            </div>
                            <div class="col-md-6 text-center">
                                <h5 style="color: #fa6d05;">Make Sure To Active Status Minimum 1</h5>
                            </div>
                            <div class="col-md-4 text-end">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addAboutUsModal">Add About Us</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="width: 100%;">
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>First Description</th>
                                <th>First_Point</th>
                                <th>Second_Point</th>
                                <th>Third_Point</th>
                                <th>Last_Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AboutUs as $AboutUs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Str::limit($AboutUs->first_description ?? 'No Title', 20)}}</td>
                                <td>{{ Str::limit($AboutUs->first_point ?? 'No Title', 20)}}</td>
                                <td>{{ Str::limit($AboutUs->second_point ?? 'No Title', 20)}}</td>
                                <td>{{ Str::limit($AboutUs->third_point ?? 'No Title', 20)}}</td>
                                <td>{{ Str::limit($AboutUs->last_description ?? 'No Title', 20)}}</td>
                                <td>
                                    @if ($AboutUs->status == 'active')
                                    <span class="text-success"
                                        style="padding-left: 8px; font-weight: 600;">Active</span>
                                    @else
                                    <span class="text-danger"
                                        style="padding-left: 8px; font-weight: 600;">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('getEditAboutUs', $AboutUs->slug) }}"><button
                                            class="btn btn-success btn-sm">Edit</button></a>
                                    <a href="{{ route('getDeleteAboutUs', $AboutUs->slug) }}"><button
                                            class="btn btn-danger btn-sm">Delete</button></a>
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
</section>



<!-- Modal -->
<div class="modal fade" id="addAboutUsModal" tabindex="-1" aria-labelledby="addAboutUsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProductModalLabel"><b>Add AboutUs</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('postaddAboutUs') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">AboutUs First Description*</label>
                                <textarea type="text" name="first_description" cols="8" rows="5"
                                    class="form-control @error('first_description') is-invalid @enderror"
                                    id="first_description" placeholder="Enter AboutUs First Description"
                                    required>{{ old('first_description') }}</textarea>
                                @error('first_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">AboutUs First Point*</label>
                                <textarea type="text" name="first_point" cols="4" rows="2"
                                    class="form-control @error('first_point') is-invalid @enderror" id="first_point"
                                    placeholder="Enter AboutUs First Point" required>{{ old('first_point') }}</textarea>
                                @error('first_point')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">AboutUs Second Point*</label>
                                <textarea type="text" name="second_point" cols="4" rows="2"
                                    class="form-control @error('second_point') is-invalid @enderror" id="second_point"
                                    placeholder="Enter AboutUs Second Point"
                                    required>{{ old('second_point') }}</textarea>
                                @error('second_point')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">AboutUs Third Point*</label>
                                <textarea type="text" name="third_point" cols="4" rows="2"
                                    class="form-control @error('third_point') is-invalid @enderror" id="third_point"
                                    placeholder="Enter AboutUs Third Point" required>{{ old('third_point') }}</textarea>
                                @error('third_point')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">AboutUs Last Description*</label>
                                <textarea name="last_description"
                                    class="form-control @error('last_description') is-invalid @enderror"
                                    id="last_description" cols="15" rows="4"
                                    required>{{ old('last_description') }}</textarea>
                                @error('last_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label>Status*</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                                value="{{ old('status') }}" required>
                                <option value="active">Active</option>
                                <option value="inactive">Hidden</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="">AboutUs Image</label>
                            <input type="file" name="about_us_image" id="about_us_image"
                                class="form-control @error('about_us_image') is-invalid @enderror"
                                value="{{ old('about_us_image') }}" required>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">Contact Us Number*</label>
                                <input type="number" name="contact_us_number" id="contact_us_number"
                                    class="form-control @error('contact_us_number') is-invalid @enderror"
                                    value="9876543210" required>
                                @error('contact_us_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>





                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Save changes">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection