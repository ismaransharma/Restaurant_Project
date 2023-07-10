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
                            <h5>Edit Product - {{ $heroes->hero_title }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="modal-body">
                        <form action="{{ route('postEditHero', $heroes->slug) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="row">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="">Hero Title*</label>
                                        <input type="text" name="hero_title"
                                            class="form-control @error('hero_title') is-invalid @enderror"
                                            value="{{ $heroes->hero_title }}" id="hero_title"
                                            placeholder="Enter Hero Title" />
                                        @error('hero_title')
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
                                                <?php if($heroes->status == 'active') {echo('selected');}?>>
                                                Active</option>
                                            <option value="inactive"
                                                <?php if($heroes->status == 'inactive') { echo('selected'); } ?>>
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
                                            class="form-control  @error('hero_image') is-invalid @enderror" id="image"
                                            name="hero_image" value="{{ $heroes->hero_image }}" />
                                        @if ($heroes->hero_image != null)
                                        <img src="{{ asset('uploads/hero/' . $heroes->hero_image) }}"
                                            class="img-responsive img-fluid p-2" width="150" height="150" />
                                        @else
                                        <span class="text-danger">Image not available</span>
                                        @endif
                                        @error('hero_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="">Hero Description*</label>
                                        <textarea name="hero_description"
                                            class="form-control @error('hero_description') is-invalid @enderror"
                                            id="hero_description" cols="30"
                                            rows="10">{{ $heroes->hero_description }}</textarea>
                                        @error('hero_description')
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