@extends('examinee.layout')
@section('content')
    <div class="pt-5 mb-5 dashboard-heading">
        <h3 class="fs-22 font-weight-semi-bold">Result</h3>
    </div>
    <div class="mb-5 dashboard-cards">
        @foreach ($results as $result)
            <div class="card card-item card-item-list-layout">
                <div class="card-body">
                    <h5 class="card-title">{{ $result->examine_id }}
                    </h5>
                    <p class="card-text">{{ $result->name }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-black card-price font-weight-bold">Passer ID: {{ $result->passer_id }}</p>
                        <p class="text-black card-price font-weight-bold">Morning Passer:
                            {{ $result->morning_passer ? 'Yes' : 'No' }}</p>
                        <p class="text-black card-price font-weight-bold">Afternoon Passer:
                            {{ $result->afternoon_passer ? 'Yes' : 'No' }}</p>
                        <p class="text-black card-price font-weight-bold">Passing Session: {{ $result->passing_session }}
                        </p>
                        <p class="text-black card-price font-weight-bold">Exam Type: {{ $result->exam_type }}</p>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        @endforeach
    </div><!-- end col-lg-12 -->
@endsection
