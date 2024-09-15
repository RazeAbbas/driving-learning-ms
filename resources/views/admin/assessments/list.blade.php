@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .card-body .dropdown-menu.dropdown-menu-end.show {
            right: 197px !important;
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
                <div class="col card">
                    <div class="card-header">
                        <h2 class="page-title">
                            {{ @$page_title }}
                        </h2>
                        @if (\Auth::user()->role == 1)
                            <div class="card-actions card-toolbar">
                                <!--begin::Button-->
                                {{-- <a href="#data_modal" data-toggle="modal" data-url="{{ $action }}/create"
                        data-action="data_modal" class="btn btn-success d-none d-sm-inline-block">
                        <span class="svg-icon svg-icon-md">
                            + Add {{ @$module['singular'] }}
                        </span>
                    </a> --}}
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
                                        <th>Title</th>
                                        <th>Total Marks</th>
                                        <th>Time Duration</th>
                                        <th>Passing Percentage</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($Assessments['data']) && sizeof($Assessments['data']) > 0)
                                        @foreach ($Assessments['data'] as $key => $val)
                                            <tr class="list_{{ $val[$module['db_key']] }}"
                                                style="height: 100px !important;">
                                                <th scope="row">{{ ++$key }}</th>
                                                <td class="pl-0" data-id="{{ $val[$module['db_key']] }}" data-input="text"
                                                    data-field="course_name">{{ @$val['course']['course_name'] }}</td>
                                                <td class="pl-0" data-id="{{ $val[$module['db_key']] }}" data-input="text"
                                                    data-field="title">{{ $val['title'] }}</td>
                                                <td class="pl-0" data-id="{{ $val[$module['db_key']] }}" data-input="text"
                                                    data-field="total_marks">{{ @$val['total_marks'] }}
                                                </td>
                                                <td class="pl-0" data-id="{{ $val[$module['db_key']] }}"
                                                    data-input="text" data-field="time_duration">
                                                    {{ @$val['time_duration'] }} min</td>
                                                <td class="pl-0" data-id="{{ $val[$module['db_key']] }}"
                                                    data-input="text" data-field="passing_percentage">
                                                    {{ @$val['passing_percentage'] }}</td>
                                                {{-- <td class="pl-0">{{date('Y-m-d',strtotime($val['created_at']))}}</td> --}}

                                                <td class="pr-0 text-right">
                                                    <div class="btn-group dropleft">
                                                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" style="top: -20px !important;">
                                                            <a class="dropdown-item"
                                                                href="{{ url('admin/question/' . $val[$module['db_key']]) }}">View
                                                                Questions</a>
                                                            <a class="dropdown-item" href="#data_modal" data-toggle="modal"
                                                                data-url="{{ $action }}/edit/{{ $val[$module['db_key']] }}"
                                                                data-action="data_modal">Edit Assessment</a>
                                                            <a class="dropdown-item"
                                                                href="{{ url($module['action'] . '/delete/' . $val[$module['db_key']]) }}">Delete
                                                                Assessment</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {!! $Assessments['pagination'] !!}
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">No assessment found</td>
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
    {{-- <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Courses List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table"
                                data-url="{{ $action }}/edit">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($Assessments['data']) && sizeof($Assessments['data']) > 0)
                                        @foreach ($Assessments['data'] as $key => $val)
                                            <tr>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>{{ @$val['course']['course_name'] }}</td>
                                                <td>
                                                    <a href="{{ url('admin/question/' . $val[$module['db_key']]) }}">View Assessments <i class="fa fa-arrow-circle-o-right"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {!! $Assessments['pagination'] !!}
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">No Course found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
