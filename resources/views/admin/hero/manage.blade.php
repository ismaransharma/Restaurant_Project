@extends('layouts.app')

@section('content')

<?php
// dd($heroes);
?>

<section id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Hero</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addHeroModal">Add Hero</button>
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
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($heroes as $hero)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hero->hero_title }}</td>
                                    <td>
                                        <img height="50" width="75"
                                            src="{{ asset('uploads/hero/' . $hero->hero_image) }}"
                                            class="img-responsive img-fluid" />
                                    </td>
                                    <td>{{ Str::limit($hero->hero_description ?? 'No Title', 50)}}</td>
                                    <td>
                                        @if ($hero->status == 'active')
                                        <span class="text-success"
                                            style="padding-left: 8px; font-weight: 600;">Active</span>
                                        @else
                                        <span class="text-danger"
                                            style="padding-left: 8px; font-weight: 600;">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('getEditHero', $hero->slug) }}"><button
                                                class="btn btn-success btn-sm">Edit</button></a>
                                        <a href="{{ route('getDeleteHero', $hero->slug) }}"><button
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
<div class="modal fade" id="addHeroModal" tabindex="-1" aria-labelledby="addHeroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProductModalLabel"><b>Add Hero</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('postaddHero') }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">Hero Title*</label>
                                <input type="text" name="hero_title"
                                    class="form-control @error('hero_title') is-invalid @enderror"
                                    value="{{ old('hero_title') }}" id="hero_title" placeholder="Enter Hero Title"
                                    required />
                                @error('hero_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-12">
                            <label for="">Hero Image</label>
                            <input type="file" name="hero_image" id="hero_image"
                                class="form-control @error('hero_image') is-invalid @enderror"
                                value="{{ old('hero_image') }}" required>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label for="">Hero Description*</label>
                                <textarea name="hero_description"
                                    class="form-control @error('hero_description') is-invalid @enderror"
                                    id="hero_description" cols="30" rows="10"
                                    required>{{ old('hero_description') }}</textarea>
                                @error('hero_description')
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