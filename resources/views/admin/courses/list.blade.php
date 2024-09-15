@extends('layouts.admin')
@section('title')
    {{ $page_title }}
@endsection
@section('content')
    <style type="text/css">
        .card-body .dropdown-menu.dropdown-menu-end.show {
            right: 200px !important;
            bottom: 10px !important
        }

        .relative {
            color: #182433 !important;
        }

        @media(max-width: 575px) {
            .dropdown-menu.dropdown-menu-end.show {
                right: 0px !important;
            }
        }
    </style>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="card">
                    <form method="get" action="">
                        <div class="card-header">
                            <h2 class="page-title">Search</h2>
                        </div>
                        <div class="row card-body">
                            <div class="col-lg-4 col-md-4">
                                <label for="search" class="form-label">Search</label>
                                <input type='text' name="search" id="search" class="form-control"
                                    value="{{ @$search }}" placeholder="Search here....." />
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="category" class="form-label">Category</label>
                                <select name="cat_id" id="category" class="form-select">
                                    <option value="">Select Category</option>
                                    @foreach ($list as $key => $val)
                                        <option value="{{ $val['id'] }}"
                                            @if ($cat_id == $val['id']) selected @endif>{{ $val['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary d-none d-sm-inline-block mr-2">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col card mt-3">
                    <div class="card-header">
                        <h2 class="page-title">
                            {{ @$page_title }}
                        </h2>
                        @if (\Auth::user()->role == 1)
                            <div class="card-actions card-toolbar">
                                @if (App\Models\Categories::count() > 0)
                                    <a href="{{ $action }}/create" class="btn btn-success d-none d-sm-inline-block">
                                        <span class="svg-icon svg-icon-md">
                                            + Add {{ @$module['singular'] }}
                                        </span>
                                    </a>
                                    @else
                                    <a href="{{ $action }}/create" class="btn btn-success d-none d-sm-inline-block check_category">
                                        <span class="svg-icon svg-icon-md">
                                            + Add {{ @$module['singular'] }}
                                        </span>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table"
                                data-url="{{ $action }}/edit">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course Name</th>
                                        <th>Category</th>
                                        <th>Course Duration</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        @if (\Auth::user()->role == 1)
                                            <th class="w-1">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($Course['data']) && sizeof($Course['data']) > 0)
                                        @foreach ($Course['data'] as $key => $val)
                                            <tr class="list_{{ $val[$module['db_key']] }}" style="height:100px">
                                                <th scope="row">{{ ($currentPage - 1) * $perPage + $key + 1 }}</th>
                                                <td data-id="{{ $val[$module['db_key']] }}">
                                                    {{ $val['course_name'] }}</td>
                                                <td data-id="{{ $val[$module['db_key']] }}">
                                                    {{ $val['category']['title'] }}</td>
                                                <td data-id="{{ $val[$module['db_key']] }}">
                                                    {{ $val['course_duration'] }}</td>
                                                <td data-id="{{ $val[$module['db_key']] }}">
                                                    ${{ !empty($val['price']) ? $val['price'] : '0' }}</td>
                                                <td data-id="{{ $val[$module['db_key']] }}">
                                                    ${{ !empty($val['discount']) ? $val['discount'] : '0' }}</td>
                                                @if (\Auth::user()->role == 1)
                                                    <td class="">

                                                        <div class="btn-group dropright">
                                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ url('admin/lesson', $val[$module['db_key']]) }}">View
                                                                    Lessons</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ $action }}/edit/{{ $val[$module['db_key']] }}">Edit
                                                                    Course</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ url($module['action'] . '/delete/' . $val[$module['db_key']]) }}">Delete
                                                                    Course</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        {!! $Course['pagination'] !!}
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center">No course found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('body').on('click','.check_category',function(e){
            e.preventDefault();
            toastr.error('Please create a category first');
        });
    });
</script>
@endsection
