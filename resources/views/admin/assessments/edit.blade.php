<div class="modal-header">
    <h5 class="modal-title">{{ @$page_title }}</h5>
    <a href="{{ url($module['action']) }}" class="btn-close" aria-label="Close"></a>
</div>
<div class="modal-body">
    <form method="post" action="{{$action}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
    @csrf
    <input type="hidden" name="lesson_id" value="{{ $row['lesson_id'] }}">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type='text' name="title" id="title" value="{{ @$row['title'] }}"
                        class="form-control" required="" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="mb-3">
                    <label for="time_duration" class="form-label">Time Duration (min) <span
                            class="text-danger">*</span></label>
                    <input type='text' name="time_duration" id="time_duration" value="{{ @$row['time_duration'] }}"
                        class="form-control" required="" />
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="mb-3">
                    <label for="course_id" class="form-label">Select Course <span class="text-danger">*</span></label>
                    <select name="course_id" id="course_id" class="form-control" required="">
                        <option value="">--Select--</option>
                        @if (count(@$courses) > 0)
                            @foreach (@$courses as $key => $value)
                                <option value="{{ $value->id }}" @if (@$row['course_id'] == $value->id) selected @endif>
                                    {{ $value->course_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="mb-3">
                    <label for="total_marks" class="form-label">Total Marks <sp`an class="text-danger">*</span></label>
                    <input type='number' name="total_marks" id="total_marks" value="{{ @$row['total_marks'] }}"
                        class="form-control" required="" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="mb-3">
                    <label for="passing_percentage" class="form-label">Passing Percentage <span
                            class="text-danger">*</span></label>
                    <input type='number' name="passing_percentage" id="passing_percentage"
                        value="{{ @$row['passing_percentage'] }}" class="form-control" required="" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Update</button>
        <a class="btn btn-secondary" href="{{ url($module['action']) }}">Cancel</a>
    </div>
    </form>
</div>
