@extends('examinee.layout')
@section('content')
    <div class="mb-5 dashboard-heading">
        <h3 class="fs-22 font-weight-semi-bold">Submit Course</h3>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="list-group list-group-flush">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('examinee.enrollment', $examFee->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card card-item">
            <div class="card-body">
                <h3 class="pb-2 fs-22 font-weight-semi-bold">Exam Registration info</h3>
                <div class="divider"><span></span></div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label for="itee_venue_id" class="label-text">Select a
                                            Venue</label>
                                        <select id="itee_venue_id" name="itee_venue_id" class="select-container-select"
                                            required>
                                            <option value="">Select Venue</option>
                                            @foreach ($venues as $venue)
                                                <option value="{{ $venue->id }}"
                                                    {{ old('itee_venue_id') == $venue->id ? 'selected' : '' }}>
                                                    {{ $venue->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <!-- Hidden Input Field to Hold the Value -->
                                        <input type="hidden" id="itee_exam_category_id" name="itee_exam_category_id"
                                            value="{{ $examFee->exam_category->id }}" required>

                                        <label for="itee_exam_category_id_display" class="label-text">Select a
                                            Exam Category</label>
                                        <select id="itee_exam_category_id_display" name="itee_exam_category_id_display"
                                            class="select-container-select" disabled>
                                            <option value="">Select Exam Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $examFee->exam_category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <input type="hidden" id="itee_exam_type_id" name="itee_exam_type_id"
                                            value="{{ $examFee->exam_type->id }}" required>

                                        <label for="itee_exam_type_id_display" class="label-text">Select a
                                            Exam Type</label>
                                        <select id="itee_exam_type_id_display" name="itee_exam_type_id_display"
                                            class="select-container-select" disabled>
                                            <option value="">Select Exam Type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ $type->id == $examFee->exam_type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <input type="hidden" id="itee_exam_fees_id" name="itee_exam_fees_id"
                                            value="{{ $examFee->id }}" required>
                                        <label for="exam_fees_id_display" class="label-text">Select a
                                            Exam Fee</label>
                                        <select id="exam_fees_id_display" name="exam_fees_id_display"
                                            class="select-container-select" disabled required>
                                            <option value="">Select Exam Fee</option>
                                            @foreach ($fees as $fee)
                                                <option value="{{ $fee->id }}"
                                                    {{ $fee->id == $examFee->id ? 'selected' : '' }}>
                                                    {{ $fee->name }} (BDT(৳) {{ $fee->fee }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <input type="hidden" id="itee_book_id" name="itee_book_id">
                                        <label for="itee_book_id_display" class="label-text">Select
                                            Exam Book</label>
                                        <select id="itee_book_id_display" name="itee_book_id_display[]"
                                            class="select-container-select" multiple>
                                            @foreach ($books as $book)
                                                <option value="{{ $book->id }}"
                                                    {{ old('itee_book_id') == $book->id ? 'selected' : '' }}>
                                                    {{ $book->book_name }} (BDT(৳)
                                                    {{ $book->book_price }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-lg-12 -->
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
        <div class="card card-item">
            <div class="card-body">
                <h3 class="pb-2 fs-22 font-weight-semi-bold">Personal info</h3>
                <div class="divider"><span></span></div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Full Name</label>
                                        <input maxlength="244" class="pl-3 form-control form--control" type="text"
                                            name="full_name" placeholder="Full Name" value="{{ $user->name }}" required>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Email Address</label>
                                        <input class="pl-3 form-control form--control" type="email" name="email"
                                            required placeholder="Email Address" value="{{ $user->email }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Mobile Number</label>
                                        <input class="pl-3 form-control form--control" type="tel" id="phone"
                                            name="phone" pattern="^\01[0-9]{9}$" placeholder="01xxxxxxxxx" required
                                            maxlength="244" value="{{ $user->phone }}">

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Date of Birth:</label>
                                        <input class="pl-3 form-control form--control" max="2005-12-31" type="date"
                                            id="dob" name="dob" required maxlength="244"
                                            value="{{ old('dob') }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label for="gender" class="label-text">Select a
                                            Gender</label>
                                        <select id="gender" name="gender" class="select-container-select" required>
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">LinkedIn Profile</label>
                                        <input class="pl-3 form-control form--control" type="text" name="linkedin"
                                            placeholder="LinkedIn Profile" required maxlength="244"
                                            value="{{ old('linkedin') }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Address</label>
                                        <textarea class="pl-3 form-control form--control" id="address" name="address" rows="3"
                                            placeholder="Enter your address" required>{{ old('address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Post Code</label>
                                        <input class="pl-3 form-control form--control" type="number" name="post_code"
                                            placeholder="Post Code" required min="0" max="9999"
                                            value="{{ old('post_code') }}">

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Occupation</label>
                                        <input class="pl-3 form-control form--control" type="text" name="occupation"
                                            placeholder="Occupation" required maxlength="244"
                                            value="{{ old('occupation') }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-0 form-group">
                                    {{-- <div class="media-body">
                                                    <div class="file-upload-wrap file-upload-wrap-2">
                                                        <input type="file" name="files[]"
                                                            class="multi file-upload-input with-preview" multiple>
                                                        <span class="file-upload-text"><i
                                                                class="mr-2 la la-photo"></i>Upload a Photo</span>
                                                    </div><!-- file-upload-wrap -->
                                                    <p class="fs-14">Max file size is 5MB, Minimum dimension: 200x200
                                                        And Suitable files are .jpg & .png</p>
                                                </div> --}}
                                    <label class="label-text">Profile Picture</label>
                                    <div class="file-upload-wrap">
                                        <input type="file" name="photo"
                                            accept=".jpg,.jpeg,.png,.gif,.JPG,.JPEG,.PNG,.GIF"
                                            class="multi file-upload-input">
                                        <span class="file-upload-text"><i class="mr-2 la la-cloud-upload fs-18"></i>Drop
                                            file
                                            here
                                            or click to upload.</span>
                                    </div><!-- file-upload-wrap -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div>
        </div><!-- end card-body -->
        <div class="card card-item">
            <div class="card-body">
                <h3 class="pb-2 fs-22 font-weight-semi-bold">Academic info</h3>
                <div class="divider"><span></span></div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label for="education_qualification" class="label-text">Education
                                            Qualification (Latest Certification Only)</label>
                                        <select id="education_qualification" name="education_qualification"
                                            class="select-container-select" required>
                                            <option value="">Select Education
                                                Qualification</option>
                                            <option value="ssc"
                                                {{ old('education_qualification') == 'ssc' ? 'selected' : '' }}>SSC or
                                                Equivalent</option>
                                            <option value="hsc"
                                                {{ old('education_qualification') == 'hsc' ? 'selected' : '' }}>HSC or
                                                Equivalent</option>
                                            <option value="bsc"
                                                {{ old('education_qualification') == 'bsc' ? 'selected' : '' }}>BSC or
                                                Equivalent</option>
                                            <option value="diploma"
                                                {{ old('education_qualification') == 'diploma' ? 'selected' : '' }}>Diploma
                                                or Equivalent</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Group or Subject Name</label>
                                        <input class="pl-3 form-control form--control" type="text" name="subject_name"
                                            placeholder="Group (Science, Humanities) or Subject (CSE, EEE) Name"
                                            maxlength="244" value="{{ old('subject_name') }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Passing Year</label>
                                        <input class="pl-3 form-control form--control" type="number" min="1971"
                                            max="2005" name="passing_year" placeholder="Passing Year" required
                                            value="{{ old('passing_year') }}">

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Institute</label>
                                        <input class="pl-3 form-control form--control" type="text""
                                            name="institute_name" placeholder="Institute" required maxlength="244"
                                            value="{{ old('institute_name') }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Result</label>
                                        <input class="pl-3 form-control form--control" type="number" min="2.00"
                                            max="5.00" step="0.1" name="result" placeholder="Result" required
                                            value="{{ old('result') }}">

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="w-auto select-container">
                                        <label class="label-text">Previous Passer ID (if any)</label>
                                        <input class="pl-3 form-control form--control" type="text" maxlength="244"
                                            name="previous_passing_id" placeholder="Previous Passer ID (if any)"
                                            value="{{ old('previous_passing_id') }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div>
        </div><!-- end card-body -->
        <div class="pb-4 course-submit-btn-box">
            <button class="btn theme-btn" type="submit">Submit Course</button>
        </div>
    </form>
    <script>
        document.getElementById('itee_book_id_display').addEventListener('change', function() {
            // Get the selected options as an array of values
            const selectedValues = Array.from(this.selectedOptions).map(option => option.value);

            // Join the array into a comma-separated string
            const selectedString = selectedValues.join('|');

            // Display the string in the input field
            document.getElementById('itee_book_id').value = selectedString;
        });
    </script>
@endsection
