@extends('admin_dashboard')
@section('admin')

<style>
    .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
</style>

<div class="content">
<!-- Start Content-->
<div class="container">
    <div class="main-body">
        <div class="row mt-4">
            <div class=" col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img style="border-radius: 200px;"  class="rounded-circle p-1 bg-primary" width="110" src="{{ asset('upload/supplier/'.$supplier->image) }}" alt="">

                            <div class="mt-3">
                                <h4 class="text-capitalize">{{ $supplier->name }}</h4>
                                <p class="text-capitalize">{{ $supplier->shopname }}</p>
                                <p class="text-capitalize text-muted font-size-sm">{{ $supplier->address }}</p>
                                {{-- <button class="btn btn-primary">Follow</button>
                                <button class="btn btn-outline-primary">Message</button> --}}
                            </div>
                        </div>
                        {{-- <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                                <span class="text-secondary">https://bootdey.com</span>
                            </li>
                        </ul> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                Jawad Ali
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div> <!-- content -->

@endsection
