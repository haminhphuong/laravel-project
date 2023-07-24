@extends('admin.index')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
        <p class="mb-4">This is an example dashboard page.</p>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Number of Products</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $numProducts }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number of Categories</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $numCategories }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Number of Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $numUsers }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    /* Styles for the page heading */
    h1 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    /* Styles for the subheading */
    p {
        font-size: 16px;
        margin-bottom: 20px;
    }

    /* Styles for the cards */
    .card {
        border-radius: 10px;
    }

    /* Styles for the icons */
    i {
        margin-right: 10px;
    }

    /* Styles for the card titles */
    .text-xs {
        font-size: 14px;
        font-weight: bold;
    }

    /* Styles for the card values */
    .h5 {
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
    }


</style>
