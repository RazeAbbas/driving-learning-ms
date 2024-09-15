@extends('layouts.admin')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col card">
                    <div class="card-header">
                        <h5 class="card-title">{{ @$page_title }}</h5>
                    </div>
                    <div class="card-body">
                        <form class="" method="post" action="{{ $action }}" enctype="multipart/form-data"
                            data-action="make_ajax_file" data-action-after="{{ url('admin/courses') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Course Name</label>
                                            <input type='text' value="{{ @$row['course_name'] }}" name="course_name"
                                                id="course_name" class="form-control" required="" data-target="#slug" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Course Slug</label>
                                            <input type='text' name="slug" id="slug" class="form-control"
                                                required="" value="{{ @$row['slug'] }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Accredition</label>
                                            <input type='text' value="{{ @$row['accredition'] }}" name="accredition"
                                                id="accredition" class="form-control" required="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="is_featured" class="form-label">Is Featured ?</label>
                                            <select name="is_featured" id="is_featured" class="form-select">
                                                <option value="">Please select is course featured</option>
                                                <option value="yes" @if (@$row['is_featured'] == 'yes') selected @endif>Yes</option>
                                                <option value="no" @if (@$row['is_featured'] == 'no') selected @endif>No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Short Detail</label>
                                            <textarea name="short_detail" id="short_detail" class="form-control">{{ @$row['short_detail'] }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Long Detail</label>
                                            <textarea name="long_detail" id="long_detail" class="form-control">{{ @$row['long_detail'] }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type='number' value="{{ @$row['price'] }}" name="price" id="price"
                                                class="form-control" required/>
                                        </div>
                                    </div>


                                    {{-- <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="discount" class="form-label">Discount</label>
                                            <input type='number' value="{{ @$row['discount'] }}" name="discount"
                                                id="discount" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Discount End Date</label>
                                            <input type='date' value="{{ @$row['discount_end_date'] }}"
                                                name="discount_end_date" id="discount_end_date" class="form-control" />
                                        </div>
                                    </div> --}}

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Instructor</label>
                                            <select name="instructor_id" id="instructor_id" class="form-select"
                                                required="">
                                                <option value="">Select Instructor</option>
                                                @foreach ($instructors as $key => $val)
                                                    <option value="{{ $val->id }}"
                                                        @if ($val->id == $row['instructor_id']) selected @endif>
                                                        {{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="certification" class="form-label">Certificate</label>
                                            <input type="file" class="form-control" name="certification"
                                                id="certification">
                                        </div>
                                    </div>

                                    {{-- <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Dificulty Level</label>
                                            <select name="dificulty_level" id="dificulty_level" class="form-control">
                                                @foreach (config('constants.course_difficulity') as $key => $val)
                                                    <option value="{{ ++$key }}"
                                                        @if (++$key == $row['dificulty_level']) selected @endif>
                                                        {{ $val }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="language" class="form-label">Language</label>
                                            <select name="language" id="language" class="form-control">
                                                <option value="both" @if (@$row['language'] == 'both') selected @endif>
                                                    Both of them</option>
                                                <option value="english" @if (@$row['language'] == 'english') selected @endif>
                                                    English</option>
                                                <option value="arabic" @if (@$row['language'] == 'arabic') selected @endif>
                                                    Arabic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="featured_img" class="form-label">Feature Image</label>
                                            <input type='file' name="featured_img" id="featured_img"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="featured_video" class="form-label">Feature Video</label>
                                            <input type='file' name="featured_video" id="featured_video"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Category</label>
                                            <select name="cat_id" id="cat_id" class="form-select">
                                                @if (!empty($list))
                                                    @foreach ($list as $key => $val)
                                                        <option value="{{ $val['id'] }}"
                                                            @if ($val['id'] == $row['cat_id']) selected @endif>
                                                            {{ $val['title'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Save &
                                        Proceed</button>
                                    <a class="btn btn-secondary" href="{{ url($module['action']) }}">Cancel</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('script')
        <script type="text/javascript">
            $(document).on("keyup", '#course_name', function(event) {
                let val = $(this).val();
                let target = $(this).attr("data-target");
                $(target).val(baseJS.slugify(val));
            });
            document.getElementById("is_feature").addEventListener("change", function() {
                var selectedType = this.value;

                // Hide or disable the Feature Training Type dropdown based on the selected Course Type
                if (selectedType === "Featured training" || selectedType === "All") {
                    document.getElementById("featuredOptions").style.display = "block"; // Hide the options
                    // OR
                    // document.getElementById("feature_type").disabled = true; // Disable the dropdown
                } else {
                    document.getElementById("featuredOptions").style.display = "none"; // Show the options
                }

                // Show or hide options based on the selected Course Type
                if (selectedType === "Medical rep training") {
                    document.getElementById("medicalRepOptions").style.display = "block";
                    document.getElementById("leaderOptions").style.display = "none";
                } else if (selectedType === "Leader training") {
                    document.getElementById("medicalRepOptions").style.display = "none";
                    document.getElementById("leaderOptions").style.display = "block";
                } else if (selectedType === "Featured training") {
                    document.getElementById("medicalRepOptions").style.display = "none";
                    document.getElementById("leaderOptions").style.display = "none";
                } else {
                    // For other course types, show all options
                    document.getElementById("medicalRepOptions").style.display = "none";
                    document.getElementById("leaderOptions").style.display = "none";
                    document.getElementById("featuredOptions").style.display = "none";
                }
            });
        </script>
    @endsection
    {{-- <div class="card-footer">
    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="card">
        Cancel
    </a>
    <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="card">
        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
        Create new report
    </a>
</div> --}}
