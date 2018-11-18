@extends('layouts.app')

@section('content')
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row justify-content-md-center mt-5">
                <div class="col-sm-6 col-xl-4">
                    @can('read-users')
                        <users-count></users-count>
                    @endcan
                </div>
                <div class="col-sm-6 col-xl-4">
                    @can('read-roles')
                        <roles-count></roles-count>
                    @endcan
                </div>
                <div class="col-sm-6 col-xl-4">
                    <wallet-amount></wallet-amount>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-sm-6 col-xl-4">
                    <sku-breakdown-chart></sku-breakdown-chart>
                </div>
            </div>
        </div>
    </div>
@endsection
