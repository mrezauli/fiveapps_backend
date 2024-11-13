@extends('examinee.layout')
@section('content')
    <div class="pt-5 mb-5 dashboard-heading">
        <h3 class="fs-22 font-weight-semi-bold">Admit Cards</h3>
    </div>
    <div class="mb-5 dashboard-cards">
        @foreach ($admitCards as $admitCard)
            <div class="card card-item card-item-list-layout">
                <div class="card-body">
                    <h5 class="card-title"><a
                            href="{{ url('/itee/download/admit/' . base64_encode($admitCard->id)) }}">{{ $admitCard->full_name }}</a>
                    </h5>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div class="pl-3 card-action-wrap">
                            <a href="{{ url('/itee/download/admit/' . base64_encode($admitCard->id)) }}"
                                class="ml-1 shadow-sm cursor-pointer icon-element icon-element-sm text-success"
                                data-toggle="tooltip" data-placement="top" data-title="Download"><i
                                    class="la la-download"></i></a>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        @endforeach
    </div><!-- end col-lg-12 -->
@endsection
