@extends('layouts.admin')
@section('title')
    {{ $page_title }}
@endsection
@section('content')

    <div class="container-xl">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pt-3">
                <li class="breadcrumb-item"><a href="{{ url('admin/course') }}">Courses</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/lesson', $course_id) }}">Lessons</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chapters</li>
            </ol>
        </nav>
    </div>
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
                                {{-- <a href="#data_modal" data-toggle="modal" data-url="{{$action}}/create" data-action="data_modal" class="btn btn-success d-none d-sm-inline-block"> --}}
                                <a href="{{ $action }}/create" class="btn btn-success d-none d-sm-inline-block">
                                    <span class="svg-icon svg-icon-md">
                                        + Add {{ @$module['singular'] }}
                                    </span>
                                </a>
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
                                        <th>Chapter Name</th>
                                        <th>Course Name</th>
                                        <th>Lesson Name</th>
                                        <th class="w-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($Chapters['data']) && sizeof($Chapters['data']) > 0)
                                        @foreach ($Chapters['data'] as $key => $val)
                                            <tr class="list_{{ $val[$module['db_key']] }}">
                                                <th scope="row">{{ ++$key }}</th>
                                                <td class="pl-0" data-id="{{ $val[$module['db_key']] }}" data-input="text"
                                                    data-field="chapter_name">{{ $val['chapter_name'] }}</td>
                                                <td class="pl-0" data-id="{{ $val[$module['db_key']] }}"
                                                    data-input="text" data-field="course_name">
                                                    {{ $val['course']['course_name'] }}</td>
                                                <td class="pl-0" data-id="{{ $val[$module['db_key']] }}"
                                                    data-input="text" data-field="lesson_name">
                                                    {{ $val['lesson']['lesson_name'] }}</td>
                                                {{-- <td class="pl-0">{{date('Y-m-d',strtotime($val['created_at']))}}</td> --}}
                                                <td class="pr-0 text-right">
                                                    <div class="btn-group dropleft">
                                                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            {{-- <a class="dropdown-item" href="{{ url('admin/upload-subtitle', $val[$module['db_key']]) }}">Upload Subtitle</a> --}}
                                                            <a class="dropdown-item"
                                                                href="{{ $action }}/edit/{{ $val[$module['db_key']] }}"
                                                                data-action="data_modal">Edit Chapter</a>
                                                            {{-- <a class="dropdown-item" data-action="delete_record" data-url="{{url($module['action'].'/delete/'.$val[$module['db_key']], $val['lesson_id'])}}" href="javascript:void(0);">Delete Chapter</a> --}}
                                                            <a class="dropdown-item" data-action="delete_record"
                                                                data-url="{{ url('admin/chapter/' . $val['course_id'] . '/' . $val['lesson_id'] . '/delete', $val['id']) }}"
                                                                href="javascript:void(0);">Delete Chapter</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {!! $Chapters['pagination'] !!}
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No chapter found</td>
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
