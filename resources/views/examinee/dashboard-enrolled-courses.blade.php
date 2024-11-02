@extends('examinee.layout')
@section('content')
    <div class="pt-5 mb-5 dashboard-heading">
        <h3 class="fs-22 font-weight-semi-bold">Enrolled Exams</h3>
    </div>
    <div class="mb-5 dashboard-cards">
        @foreach ($examRegs as $examReg)
            <div class="card card-item card-item-list-layout">
                <div class="card-image">
                    <a href="{{ route('examinee.enroll', $examReg->id) }}" class="d-block">
                        <?php $imageUrl = $examReg->examType->image; ?>
                        <img class="card-img-top" src="{{ asset($imageUrl) }}" alt="Card image cap"
                            style="width: 370px; height: 247px;">
                    </a>
                </div><!-- end card-image -->
                <div class="card-body">
                    <h5 class="card-title"><a
                            href="{{ route('examinee.enroll', $examReg->id) }}">{{ $examReg->examType->name }}</a></h5>
                    <p class="card-text">{{ $examReg->category->name }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-black card-price font-weight-bold">BDT {{ $examReg->fee->fee }} (৳)</p>
                        <div class="pl-3 card-action-wrap">
                            <a href="{{ route('examinee.enroll', $examReg->id) }}"
                                class="ml-1 shadow-sm cursor-pointer icon-element icon-element-sm text-success"
                                data-toggle="tooltip" data-placement="top" data-title="Enroll"><i
                                    class="la la-edit"></i></a>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        @endforeach
    </div><!-- end col-lg-12 -->
@endsection
