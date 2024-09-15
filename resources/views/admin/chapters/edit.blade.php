@extends('layouts.admin')
@section('title')
{{ $page_title }}
@endsection
@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h5 class="card-title">{{ @$page_title }}</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ $action }}" enctype="multipart/form-data" data-action="make_ajax_file"
            data-action-after="reload">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <label for="chapter_name" class="form-label">Chapter Name <span
                                class="text-danger">*</span></label>
                                <input type='text' name="chapter_name" id="chapter_name" value="{{ @$row['chapter_name'] }}" class="form-control" required="" data-target="#slug" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type='text' name="slug" id="slug" value="{{ @$row['slug'] }}"
                                class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            {{-- <div class="mb-3">
                                <label for="upload_type" class="form-label">Upload Type <span
                                    class="text-danger">*</span></label>
                                    <select name="upload_type" id="upload_type" class="form-select" required="">
                                        <option value="">--Select--</option>
                                        <option value="video" @if (@$row['upload_type'] == 'video') selected @endif>Video</option>
                                        <option value="pdf" @if (@$row['upload_type'] == 'pdf') selected @endif>PDF</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6" id="pdf">
                                <div class="mb-3">
                                    <label for="file" class="form-label">File</label>
                                    <input type='file' name="file" id="file" class="form-control" />
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control ckeditor">{{ $row['description'] }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Update</button>
                        <a class="btn btn-secondary" href="{{ url($module['action']) }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @section('script')
    <script type="text/javascript">
        $(document).on("keyup", '#chapter_name', function(event) {
            let val = $(this).val();
            let target = $(this).attr("data-target");
            $(target).val(baseJS.slugify(val));
        });
    </script>
    @endsection
    @endsection
    