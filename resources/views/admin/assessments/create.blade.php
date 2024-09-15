@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h5 class="card-title">{{@$page_title}}</h5>
        </div>
        <div class="card-body">
            <form class="" method="post" action="{{url('admin/assessment/create' )}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
                @csrf
                <input type="hidden" name="course_id" value="{{ isset($course_id) ? $course_id : '' }}">
                <input type="hidden" name="lesson_id" value="{{ isset($lesson_id) ? $lesson_id : '' }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type='text' name="title" id="title" class="form-control" required="" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="time_duration" class="form-label">Time Duration (min) <span class="text-danger">*</span></label>
                                <input type='number' name="time_duration" id="time_duration" class="form-control" required="" />
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="course_id" class="form-label">Select Course <span class="text-danger">*</span></label>
                                <select name="course_id" id="course_id" class="form-select" required="">
                                    <option value="">Select</option>
                                    @if(count(@$courses) > 0)
                                    @foreach(@$courses as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->course_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="total_marks" class="form-label">Total Marks <span class="text-danger">*</span></label>
                                <input type='number' min="1" name="total_marks" id="total_marks" class="form-control" required="" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="passing_percentage" class="form-label">Passing Percentage <span class="text-danger">*</span></label>
                                <input type='number' name="passing_percentage" id="passing_percentage" class="form-control" required="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Create</button>
                    <a  class="btn btn-secondary" href="{{url('admin/assessment')}}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection