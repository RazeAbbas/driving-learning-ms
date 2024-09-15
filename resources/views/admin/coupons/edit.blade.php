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
            <input type="hidden" name="id" value="{{ $coupon->id }}">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="code">Coupon Code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $coupon->code) }}" required>
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="type">Coupon Type</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="">Select type</option>
                        <option value="fixed" {{ old('type', $coupon->type_raw) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                        <option value="percentage" {{ old('type', $coupon->type_raw) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div> --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label" for="value">Discount Value (%)</label>
                <input type="number" step="0.01" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $coupon->value) }}" required>
                @error('value')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <input type="hidden" name="type" value="percentage">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="max_uses">Max Uses</label>
                    <input type="number" class="form-control @error('max_uses') is-invalid @enderror" id="max_uses" name="max_uses" value="{{ old('max_uses', $coupon->max_uses) }}" required>
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
                    <input type="date" class="form-control @error('valid_from') is-invalid @enderror" id="valid_from" name="valid_from" value="{{ old('valid_from', $coupon->valid_from ? $coupon->valid_from->format('Y-m-d') : '') }}">
                    @error('valid_from')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="valid_until">Valid Until</label>

                    <input type="date" class="form-control @error('valid_until') is-invalid @enderror" id="valid_until" name="valid_until" value="{{ old('valid_until', $coupon->valid_until ? $coupon->valid_until->format('Y-m-d') : '') }}">
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
                    <input type="email" class="form-control @error('valid_from') is-invalid @enderror" id="email" name="email" value="{{ old('email', $coupon->email) }}" required list="emailList">
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
                        <option value="courses" {{ $coupon->course_id  ? 'selected' : '' }}>Courses</option>
                    </select>
                    @error('coupon_for')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> --}}
        </div>

        <div class="row">
            {{-- <div class="col-lg-6 col-md-6" id="gap_analysis_div" {{ $coupon->gap_analysis_id ? 'style=display:block' : 'style=display:none' }}>
                <div class="mb-3">
                    <label for="gap_analysis_id" class="form-label">Gap Analysis</label>
                    <select name="gap_analysis_id" id="gap_analysis_id" class="form-control">
                        <option value="">Select Gap Analysis</option>
                        <option value="leader" {{ $coupon->gap_analysis_id == 'leader' ? 'selected' : '' }}>Gap Analysis ( Leader )</option>
                        <option value="medical_rep" {{ $coupon->gap_analysis_id == 'medical_rep' ? 'selected' : '' }}>Gap Analysis ( Medical Rep )</option>
                        <option value="both" {{ $coupon->gap_analysis_id == 'both' ? 'selected' : '' }}>Both</option>
                    </select>
                </div>
            </div> --}}
            <div class="col-lg-6 col-md-6" id="course_div" {{ $coupon->course_id ? 'style=display:block' : 'style=display:none' }}>
                <div class="mb-3">
                    <label for="course_id" class="form-label">Course</label>
                    <select class="form-control" name="course_id" id="course_id">
                        <option value="">Select Course</option>
                        @foreach($courses as $val)
                        <option value="{{$val->id}}" {{ $val->id == $coupon->course_id ? 'selected' : '' }}>{{$val->course_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Update</button>
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
            $('#course_id').val('');
        }

        // if (showGapAnalysis) {
        //     $('#gap_analysis_div').show();
        //     $('#gap_analysis_id').prop("required", true);
        //     $('#gap_analysis_id').prop("disabled", false);

        // } else {
        //     $('#gap_analysis_div').hide();
        //     $('#gap_analysis_id').prop("required", false);
        //     $('#gap_analysis_id').prop("disabled", true);
        //     $('#gap_analysis_id').val('');
        // }
    }


    $('#coupon_for').on('change', function() {
        var selectedValue = $(this).val();
        toggleElements(selectedValue === 'courses', selectedValue !== 'courses');
    });
});
</script>

