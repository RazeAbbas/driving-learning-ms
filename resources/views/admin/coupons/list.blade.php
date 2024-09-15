@extends('layouts.admin')
@section('content')
<!-- Select2 -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col card">
                <div class="card-header">
                    <h2 class="page-title">
                        {{ @$page_title }}
                    </h2>
                    <div class="card-actions card-toolbar">
                        <!--begin::Button-->
                        <a href="#data_modal" data-toggle="modal" data-url="{{$action}}/create" data-action="data_modal" class="js-example-basic-multiple btn btn-success d-none d-sm-inline-block">
                            <span class="svg-icon svg-icon-md">
                                + Add  {{@$module['singular']}}
                            </span>
                        </a>
                        {{-- <a href="#data_modal" data-toggle="modal" data-url="{{$action}}/import" data-action="data_modal" class="btn btn-primary d-none d-sm-inline-block">
                            <span class="svg-icon svg-icon-md">
                                Bulk Upload
                            </span>
                        </a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Type / Value</th>
                                    <th>Valid From/ Until</th>
                                    <th>Max Uses / Used</th>
                                    {{-- <th>Corporate</th> --}}
                                     {{-- <th>Email</th>  --}}
                                    <th>Course Name</th>
                                    <th class="w-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $coupon)
                                    <tr>
                                        <th scope="row">{{ ($coupons->currentPage() - 1) * $coupons->perPage() + $loop->iteration }}</th>
                                        <td>{{ $coupon->code }}</td>
                                        <td>
                                            <span class="badge bg-success-lt">{{ $coupon->type }}</span> <br>
                                            <strong>Value:</strong> {{ $coupon->value }} {{ $coupon->type_raw == 'percentage' ? '%' : 'USD' }}
                                        </td>

                                        <td>
                                            <strong>Valid From:</strong> {{ $coupon->valid_from ? $coupon->valid_from->format('Y-m-d') : 'N/A' }} <br>
                                            <strong>Valid Until:</strong> {{ $coupon->valid_until ? $coupon->valid_until->format('Y-m-d') : 'N/A' }}

                                        </td>
                                        <td>
                                            <strong>Max Use:</strong>  {{ $coupon->max_uses }} <br>
                                            <strong>Used Count:</strong> {{ $coupon->used }}
                                        </td>
                                       {{--  <td>
                                            @if($coupon->is_corporate)
                                                {{ $coupon->corporate_name }}
                                            @else
                                                <span class="badge bg-danger">N/A</span>
                                            @endif

                                        </td>--}}
                                        {{-- <td>{{ $coupon->email }}</td>  --}}
                                        <td>
                                            @if($coupon->course_id)
                                           @if($coupon->course_id && $coupon->course_id != '-1')
                                            @foreach ($coupon->courses as $course)
                                            <strong>Course:</strong> {{ $course->course_name }} <br>
                                            @endforeach
                                            @else
                                            <strong>All Courses</strong> <br>
                                            @endif
                                            @endif
                                            {{-- @if($coupon->gap_analysis_id)
                                                @if($coupon->gap_analysis_id == 'leader')
                                                    Gap Analysis ( Leader )
                                                @elseif($coupon->gap_analysis_id == 'medical_rep')
                                                    Gap Analysis ( Medical Rep )
                                                @elseif($coupon->gap_analysis_id == 'both')
                                                    Gap Analysis ( Both )
                                                @endif
                                            @endif --}}
                                        </td>
                                        <td class="pr-0 text-right">
                                            <a href="#data_modal" data-toggle="modal"  data-url="{{$action}}/edit/{{$coupon[$module['db_key']]}}" data-action="data_modal" class="js-example-basic-multiple btn btn-primary d-none d-sm-inline-block">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a data-action="delete_record" href="javascript:void(0);" class="btn btn-danger d-none d-sm-inline-block mt-2" data-url="{{url($module['action'].'/delete/'.$coupon[$module['db_key']])}}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No coupons found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
