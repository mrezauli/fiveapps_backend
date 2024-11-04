@extends('examinee.layout')
@section('content')
    <div class="text-center">
        <h2>Payment</h2>
    </div>

    <div class="py-5 row">
        <div class="mb-4 col-md-4 order-md-2">
            <h4 class="mb-3 d-flex justify-content-between align-items-center">
                <span class="text-muted">Your cart</span>
            </h4>
            <ul class="mb-3 list-group">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{ $examReg->category->name }}</h6>
                        <small class="text-muted">{{ $examReg->examType->name }}</small>
                    </div>
                    <span class="text-muted">{{ $examReg->fee->fee }} BDT</span>
                </li>
                @foreach ($books as $book)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ $book->book_name }}</h6>
                        </div>
                        <span class="text-muted">{{ $book->book_price }} BDT</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong>{{ $totalBill }} TK</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Shipping Address</h4>
            <form action="{{ url('pay') }}" method="POST" class="needs-validation">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                <input type="hidden" value="{{ $totalBill }}" name="total_amount" />
                <input type="hidden" value="{{ $examReg->id }}" name="itee_exam_registration_id" />
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="firstName">Full name</label>
                        <input type="text" name="cus_name" class="form-control" id="customer_name" placeholder="John Doe"
                            value="{{ $examReg->full_name }}" required>
                        <div class="invalid-feedback">
                            Valid customer name is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mobile">Mobile</label>
                    <div class="input-group">
                        <input type="tel" name="cus_phone" class="form-control" id="mobile" placeholder="01xxxxxxxxx"
                            value="{{ $examReg->phone }}" required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your Mobile number is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted"></span></label>
                    <input type="email" name="cus_email" class="form-control" id="email" placeholder="you@example.com"
                        value="{{ $examReg->email }}" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="cus_add1" rows="3" placeholder="93 B, New Eskaton Road"
                        required>{{ $examReg->address }}</textarea>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-5">
                        <label for="country">Country</label>
                        <input name="cus_country" type="text" class="form-control" id="country" value="Bangladesh"
                            required>
                        <div class="invalid-feedback">
                            Please input a valid country.
                        </div>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="district">District</label>
                        <input name="cus_state" id="district" required type="text" class="form-control" id="address2"
                            placeholder="District">
                        <div class="invalid-feedback">
                            Please provide a valid district.
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="post code">Post Code</label>
                        <input type="text" name="cus_postcode" value="{{ $examReg->post_code }}" class="form-control"
                            id="post code" placeholder="Post Code" required>
                        <div class="invalid-feedback">
                            Post Code code required.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to Checkout</button>
            </form>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
@endsection
