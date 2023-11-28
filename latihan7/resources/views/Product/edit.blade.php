@extends('layouts.admin.master')
@section('tittle')
    Create New Product {{ $data->tittle }}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class = "alert alert-success alert-block">
            <button type = "button" class = "close" data-dismiss = "alert">x</button>
            <strong>{{ $message }}</strong>     
        </div>
    @endif
    <div class = "card p-3 rounded shadow-sm">
        <div class = "d-flex justify-content-between">
            <h6 class = "m-0 font-weight-bold text-primary">@yield('tittle')</h6>
            <a href = "{{ route('admin.product.index' }}" class = "btn btn-sm btn-outline-primary"><i
                class = "fa fa-list"></i>
            List Product</a>
        </div> 
    </div>    
    <div class = "card-body">
        <form action = "{{ 'admin.product.update', $data->id }}" method = "POST" enctype = "multipart/form-data">
            @csrf
            @method("PATCH")
            <div class = "row">
                <div class = "form-grup">
                    <label for= "tittle">Title product</label>
                    <input type = "text" class = "form-control @error('tittle') is-invalid @endrror" id="tittle"
                        name="tittle" autocomplete="off" value="{{ $data->tittle }}" required>
                    @error('tittle')
                    <span class = "invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>    
                @enderror
            </div>
        </div>                 