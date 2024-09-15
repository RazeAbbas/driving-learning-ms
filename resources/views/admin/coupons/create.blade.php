<style>
    .select2.select2-container.select2-container--default{
        width: 100% !important;
    }
    .select2-container {
    z-index: 99999;
}
</style>
<div class="modal-header">
    <h5 class="modal-title">{{@$page_title}}</h5>
    <a href="{{url($module['action'])}}" class="btn-close" aria-label="Close"></a>
</div>
<div class="modal-body">
    <form class="" method="post" action="{{$action}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="code">Coupon Code</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}" required>
                                <span class="btn" type="button" id="generateCode">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrows-shuffle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 4l3 3l-3 3" /><path d="M18 20l3 -3l-3 -3" /><path d="M3 7h3a5 5 0 0 1 5 5a5 5 0 0 0 5 5h5" /><path d="M21 7h-5a4.978 4.978 0 0 0 -3 1m-4 8a4.984 4.984 0 0 1 -3 1h-3" /></svg>
                                </button>
                            </div>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="type">Price Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="">Select type</option>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="value">Discount Value (%)</label>
                            <input type="number" step="0.01" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value') }}" required>
    
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="type" value="percentage">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="max_uses">Max Uses</label>
                            <input type="number" class="form-control @error('max_uses') is-invalid @enderror" id="max_uses" name="max_uses" value="{{ old('max_uses', 1) }}" required>
                            @error('max_uses')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="valid_from">Valid From</label>
                            <input type="date" class="form-control @error('valid_from') is-invalid @enderror" id="valid_from" name="valid_from" value="{{ old('valid_from') }}">
                            @error('valid_from')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="valid_until">Valid Until</label>
                            <input type="date" class="form-control @error('valid_until') is-invalid @enderror" id="valid_until" name="valid_until" value="{{ old('valid_until') }}">
                            @error('valid_until')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="valid_from">Email</label>
                            <input type="email" class="form-control @error('valid_from') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required list="emailList">
                            <datalist id="emailList">
                                @foreach ($users as $user)
                                    <option value="{{ $user->email }}"></option>
                                @endforeach
                            </datalist>
                            @error('valid_from')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="coupon_for">Coupon Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="coupon_for" name="coupon_for" required>
                                <option value="">This Coupon is for</option>
                                <option value="courses" {{ old('coupon_for') == 'courses' ? 'selected' : '' }}>Courses</option>
                            </select>
                            @error('coupon_for')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <label for="course_id" class="form-label">Course</label>
                            <select class="form-select" name="course_id" id="course_id">
                                <option value="">Select Course</option>
                                @foreach($courses as $val)
                                <option value="{{$val->id}}">{{$val->course_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Create</button>
                <a  class="btn btn-secondary" href="{{url($module['action'])}}">Cancel</a>
            </div>
        </div>

    </form>
</div>
<script>
$(document).ready(function() {
    function toggleElements(showCourse, showGapAnalysis) {
        console.log(showCourse, showGapAnalysis);
        if (showCourse) {
            $('#course_div').show();
            $('#course_id').prop("required", true);
            $('#course_id').prop("disabled", false);
        } else {
            $('#course_div').hide();
            $('#course_id').prop("required", false);
            $('#course_id').prop("disabled", true);
        }

        // if (showGapAnalysis) {
        //     $('#gap_analysis_div').show();
        //     $('#gap_analysis_id').prop("required", true);
        //     $('#gap_analysis_id').prop("disabled", false);
        // } else {
        //     $('#gap_analysis_div').hide();
        //     $('#gap_analysis_id').prop("required", false);
        //     $('#gap_analysis_id').prop("disabled", true);
        // }
    }

    $('#coupon_for').on('change', function() {
        var selectedValue = $(this).val();
        toggleElements(selectedValue === 'courses', selectedValue !== 'courses');
    });

    $('#generateCode').on('click', function() {
        var code = Math.random().toString(36).substring(2, 8).toUpperCase();
        $('#code').val(code);
    });

    $('#type').on('change', function() {
        var selectedValue = $(this).val();
        if (selectedValue == 'fixed') {
            $('#value').attr('placeholder', 'Enter Discount Amount');
            $('#value').val('');
        } else {
            $('#value').attr('placeholder', 'Enter Discount Percentage');
            $('#value').val('');
        }
    });

});
</script>
