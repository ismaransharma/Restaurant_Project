@extends('layouts.app')

@section('content')


<?php
    // dd($heroes);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Edit AboutUs - {{ $AboutUs->slug }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <form action="{{ route('postEditAboutUs', $AboutUs->slug) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="row">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="">AboutUs First Description*</label>
                                        <textarea type="text" name="first_description"
                                            class="form-control @error('first_description') is-invalid @enderror"
                                            id="first_description"
                                            placeholder="Enter First Description">{{ $AboutUs->first_description }}</textarea>
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
                                        <input type="text" name="first_point"
                                            class="form-control @error('first_point') is-invalid @enderror"
                                            id="first_point" placeholder="Enter First Point"
                                            value="{{ $AboutUs->first_point }}">
                                        @error('first_point')
                                        <span class="invalid-feedback" role="alert" />
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="">AboutUs Second Point*</label>
                                        <input type="text" name="second_point"
                                            class="form-control @error('second_point') is-invalid @enderror"
                                            id="second_point" placeholder="Enter Second Point"
                                            value="{{ $AboutUs->second_point }}">
                                        @error('second_point')
                                        <span class="invalid-feedback" role="alert" />
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="">AboutUs Third Point*</label>
                                        <input type="text" name="third_point"
                                            class="form-control @error('third_point') is-invalid @enderror"
                                            id="third_point" placeholder="Enter Third Point"
                                            value="{{ $AboutUs->third_point }}">
                                        @error('third_point')
                                        <span class="invalid-feedback" role="alert" />
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="">AboutUs Last Description*</label>
                                        <textarea type="text" name="last_description"
                                            class="form-control @error('last_description') is-invalid @enderror"
                                            id="last_description"
                                            placeholder="Enter Last Description">{{ $AboutUs->last_description }}</textarea>
                                        @error('last_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="status">Status*</label>
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="active"
                                                <?php if($AboutUs->status == 'active') {echo('selected');}?>>
                                                Active</option>
                                            <option value="inactive"
                                                <?php if($AboutUs->status == 'inactive') { echo('selected'); } ?>>
                                                Hidden</option>
                                        </select>

                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="image">Hero Image<span class="text-danger">*</span></label>
                                        <input type="file"
                                            class="form-control  @error('about_us_image') is-invalid @enderror"
                                            id="about_us_image" name="about_us_image"
                                            value="{{ $AboutUs->about_us_image }}" />
                                        @if ($AboutUs->about_us_image != null)
                                        <img src="{{ asset('uploads/AboutUs/' . $AboutUs->about_us_image) }}"
                                            class="img-responsive img-fluid p-2" width="150" height="150" />
                                        @else
                                        <span class="text-danger">Image not available</span>
                                        @endif
                                        @error('about_us_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" value="Save changes">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection