@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm mb-4">
        <div class="card-header text-center bg-primary text-white">
            <h3>Import and View Stocks Data</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('stocks.import') }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-center">
                @csrf
                <div class="col-md-8">
                    <label for="file" class="form-label">Choose Excel File (.xlsx, .csv)</label>
                    <input type="file" class="form-control" id="file" name="file" required>
                </div>
                <div class="col-md-4 text-end">
                    <button type="submit" class="btn btn-success mt-4">
                        <i class="bi bi-upload"></i> Upload and Import
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header text-center bg-primary text-white">
            <h3>Stocks Data</h3>
        </div>
<div class="card-body">
    <div class="mb-3 d-flex">
        <input type="text" id="search" class="form-control me-2" placeholder="Search by Ticker or Company Name">
        <a href="{{ route('purification.index') }}" class="btn btn-primary">
            Go to Calculate Purification
        </a>
    </div>
    <div id="stock-data">
        @include('stocks.partials.stock_table', ['stocks' => $stocks])
    </div>
</div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "{{ route('stocks.search') }}",
                method: "GET",
                data: {search: query},
                success: function(data) {
                    $('#stock-data').html(data);
                }
            });
        });
    });
</script>

@endsection
