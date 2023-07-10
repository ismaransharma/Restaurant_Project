@extends('layouts.app')

@section('content')

<head>
    <style>
    .dashboard-title p {
        font-size: 30px;
        font-weight: 600;
        margin: 0;
        margin-bottom: 2px;
        color: #43dfdf;
    }

    .card:hover {
        box-shadow: 1px 1px 5px #917f7f;
    }

    .card-header h5 span {
        color: #ff6700;
        font-weight: 600;
    }

    .card:hover {
        /* background-image: linear-gradient(to right, rgba(210, 0, 0, 1), rgba(254, 0, 0, 0)); */
        box-shadow: 1px 1px 5px #07076c;
        scale: 1.01;
    }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<section id="admin-home-page-dashboard">
    <div class="container">
        <div class="dashboard-title">
            <p class="pt-5 text-center">Welcome {{ Auth::user()->name}}</p>
            <p class="text-center">To Admin Dashboard</h2>
        </div>

        <div class="top-extra mb-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Hello Admin!</h4>
                        </div>
                        <div class="card-body">
                            <p>Take control of your online store, manage products, orders, and user accounts, and keep
                                your
                                business running smoothly. If you need any assistance, feel free to reach out to our
                                support
                                team.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 category">
                <div class="card">
                    <div class="card-header">
                        <h5><span>He</span>ro</h5>
                    </div>
                    <div class="card-body">
                        <p>Customize Your Hero Section From Here.</p>
                        <div class="button text-center">
                            <a href="{{ route('getHeroManage') }}"><button
                                    class="btn btn-success btn-sm">Manage</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection