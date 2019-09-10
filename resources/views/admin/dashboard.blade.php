@extends('admin.layout.base')
@section('title', 'Dashboard')
@section('data-page-id', 'adminDashboard')

@section('content')
    <div class="dashboard admin_shared">
        <div class="grid-x grid-margin-x collapse expanded" data-equalizer data-equalizer-on="medium">
            {{--Order sumamry--}}
            <div class="cell small-12 medium-3 column summary" data-equalizer-watch>
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Total Orders</p><h4>{{ $orders }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <a href="#">Order Details</a>
                        </div>
                    </div>
                </div>
            </div>

            {{--Stock sumamry--}}
            <div class=" cell small-12 medium-3 column summary" data-equalizer-watch>
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-thermometer-empty" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Stock</p><h4>{{$products}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <a href="/admin/products">View Products</a>
                        </div>
                    </div>
                </div>
            </div>

            {{--Revenue sumamry--}}
            <div class=" cell small-12 medium-3 column summary" data-equalizer-watch>
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-money" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Revenue</p><h4>${{ number_format($payments, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <a href="#">Payment Details</a>
                        </div>
                    </div>
                </div>
            </div>

            {{--Signup sumamry--}}
            <div class=" cell small-12 medium-3 column summary" data-equalizer-watch>
                <div class="card">
                    <div class="card-section">
                        <div class="row">
                            <div class="small-3 column">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <div class="small-9 column">
                                <p>Signup</p><h4>{{ $users }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-divider">
                        <div class="row column">
                            <a href="#">Registered Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard admin_shared">
        <div class="grid-x grid-margin-x collapse expanded graph">
            <div class="cell small-12 medium-6 column monthly-sales">
                <div class="card">
                    <div class="card-section">
                        <h4>Monthly Orders</h4>
                        <canvas id="order"></canvas>
                    </div>
                </div>
            </div>

            <div class=" cell small-12 medium-6 column monthly-revenue">
                <div class="card">
                    <div class="card-section">
                        <h4>Monthly Revenue</h4>
                        <canvas id="revenue"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
