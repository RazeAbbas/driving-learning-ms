@extends('layouts.admin')
@section('content')
<style type="text/css">
    .card-body .dropdown-menu.dropdown-menu-end.show{
        right: 197px !important;
    }
    .relative {
        color: #182433 !important;
    }
    @media(max-width: 575px) {
        .dropdown-menu.dropdown-menu-end.show{
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
                        {{@$page_title}}
                    </h2>
                </div>
                <div class="card-body">
                    <h4 class="page-title" style="font-size: 18px;">Default Slots <span class="btn btn-success btn-sm add-slot px-2 ml-5" style="font-size: 18px; cursor: pointer; margin-left: 30px;">+</span></h4>
                    <form method="POST" action="{{ url('admin/availability/update-slots') }}" class="pb-5">
                        @csrf
                        <div class="row pt-3 slots">
                            @if(count($slots) > 0)
                            @foreach($slots as $key => $value)
                            <div class="col-lg-1 pt-2 d-flex justify-content-between">
                                <span class="btn btn-danger btn-sm remove-slot px-2" style="font-size: 18px; cursor: pointer; height: 35px;">x</span>
                            </div>
                            <div class="col-lg-11 d-flex justify-content-between pt-2 row">
                                <div class="col-lg-6 d-flex">
                                    <input type="time" name="start_time[]" value="{{ $value->start_time }}" class="form-control w-75" id="start_time" required>
                                    <input type="time" name="end_time[]" value="{{ $value->end_time }}" class="form-control w-75" style="margin-left: 10px;" id="end_time" required>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <p class="unavailable">No Default Slot Found</p>
                            @endif
                        </div>
                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ url('admin/availability/update') }}" class="row pt-3" style="border-top: 2px solid #eee;">
                        @csrf
                        @php
                            $i = 1;
                        @endphp
                        @if(!empty($Availability))
                            <div class="row">
                                @foreach($Availability as $key => $value)
                                    <div class="col-lg-2 pt-2 d-flex justify-content-between">
                                        <span class="btn btn-danger btn-sm remove px-2" style="font-size: 18px; cursor: pointer; height: 35px;">x</span>
                                        <p class="mt-1">{{ @$value['date'] }}</p>
                                        <input type="hidden" name="dates[]" value="{{ @$value['date'] }}">
                                        <input type="hidden" name="keys[]" value="{{ $key+1 }}">
                                    </div>
                                    <div class="offset-lg-1 col-lg-6 d-flex justify-content-between py-2 row">
                                        @if(!empty($value['slots']))
                                            @foreach($value['slots'] as $k => $val)
                                                <div class="col-lg-11 d-flex @if($k !== 0) mt-2 @endif">
                                                    <input type="time" name="start_time_{{$key+1}}[]" value="{{ $val->start_time }}" class="form-control w-75" id="start_time" required>
                                                    <input type="time" name="end_time_{{$key+1}}[]" value="{{ $val->end_time }}" class="form-control w-75" style="margin-left: 10px;" id="end_time" required>
                                                </div>
                                                @if($k !== 0)
                                                <div class="col-lg-1 text-center py-1 mt-2">
                                                    <div>
                                                        <span class="btn btn-danger btn-sm close px-2" style="font-size: 18px; cursor: pointer;">x</span>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-3 py-2">
                                        <div class="mt-2">
                                            <span class="btn btn-success btn-sm add px-2" data-key="{{$key+1}}" style="font-size: 18px; cursor: pointer; margin-left: 20px;">+</span>
                                        </div>
                                    </div>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </div>
                        @endif
                        <div class="col-lg-6 pt-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control start_date" min="{{ date("Y-m-d") }}" placeholder="yyyy-mm-dd">
                        </div>
                        <div class="col-lg-6 pt-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control end_date" min="{{ date("Y-m-d") }}" placeholder="yyyy-mm-dd">
                        </div>
                        <div class="row mt-5 data">
                            
                        </div>
                        <div class="col-lg-12 mt-5 mb-3">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on("change", ".start_date, .end_date", function () {
                var start_date = $(".start_date").val();
                var end_date = $(".end_date").val();

                if (start_date !== "" && end_date !== "") {
                    $(".data").html('');

                    var all_dates = dateRange(start_date, end_date);
                    
                    var i = {{$i}};
                    $(all_dates).each(function (key, value) {
                        value = convert(value);

                        var html = `<div class="col-lg-2 pt-2 d-flex justify-content-between">
                            <span class="btn btn-danger btn-sm remove px-2" style="font-size: 18px; cursor: pointer; height: 35px;">x</span>
                            <p class="mt-1">${value}</p>
                            <input type="hidden" name="dates[]" value="${value}">
                            <input type="hidden" name="keys[]" value="${i}">
                        </div>
                        <div class="offset-lg-1 col-lg-6 d-flex justify-content-between py-2 row">
                            <div class="col-lg-11 d-flex">
                                <input type="time" name="start_time_${i}[]" value="" class="form-control w-75" id="start_time" required>
                                <input type="time" name="end_time_${i}[]" value="" class="form-control w-75" style="margin-left: 10px;" id="end_time" required>
                            </div>
                        </div>
                        <div class="col-lg-3 py-2 d-flex justify-content-between">
                            <div class="mt-2">
                                <span class="btn btn-success btn-sm add px-2" data-key="${i}" style="font-size: 18px; cursor: pointer; margin-left: 20px;">+</span>
                            </div>
                            <div class="mt-2">
                                <input type="checkbox" class="use_default" data-key="${i}">
                                <label>Use Default Slots</label>
                            </div>
                        </div>`;

                        i = i + 1;

                        $(".data").append(html);
                    });
                } else if (start_date !== "" && end_date == "") {
                    $(".end_date").attr("min", start_date);
                } else if (start_date == "" && end_date !== "") {
                    $(".start_date").attr("max", end_date);
                }
            });

            function dateRange(startDate, endDate, steps = 1) {
                const dateArray = [];
                let currentDate = new Date(startDate);

                while (currentDate <= new Date(endDate)) {
                    dateArray.push(new Date(currentDate));
                    // Use UTC date to prevent problems with time zones and DST
                    currentDate.setUTCDate(currentDate.getUTCDate() + steps);
                }

                return dateArray;
            }

            function convert(str) {
                var date = new Date(str),
                    mnth = ("0" + (date.getMonth()+1)).slice(-2),
                    day  = ("0" + date.getDate()).slice(-2);
                    hours  = ("0" + date.getHours()).slice(-2);
                    minutes = ("0" + date.getMinutes()).slice(-2);
                return [ date.getFullYear(), mnth, day ].join("-");
            }

            $(document).on("click", ".add", function () {
                var attr = $(this).attr("data-key");
                var html = `<div class="col-lg-11 d-flex mt-2">
                    <input type="time" name="start_time_${attr}[]" class="form-control w-75" id="start_time">
                    <input type="time" name="end_time_${attr}[]" class="form-control w-75" style="margin-left: 10px;" id="end_time">
                </div>
                <div class="col-lg-1 text-center py-1 mt-2">
                    <div>
                        <span class="btn btn-danger btn-sm close px-2" style="font-size: 18px; cursor: pointer;">x</span>
                    </div>
                </div>`;
                // $(this).parent().parent().prev().find(".unavailable").remove();
                $(this).parent().parent().prev().append(html);
            });

            $(document).on("click", ".use_default", function () {
                var attr = $(this).attr("data-key");
                $(this).parent().parent().prev().html('');
                if($(this).is(":checked")) {
                    @if(count($slots) > 0)
                    @foreach($slots as $key => $value)
                    var html = `<div class="col-lg-11 d-flex @if($key !== 0) mt-2 @endif">
                        <input type="time" name="start_time_${attr}[]" class="form-control w-75" value="{{ $value->start_time }}">
                        <input type="time" name="end_time_${attr}[]" class="form-control w-75" style="margin-left: 10px;" value="{{ $value->end_time }}">
                    </div>
                    @if($key !== 0)
                    <div class="col-lg-1 text-center py-1 mt-2">
                        <div>
                            <span class="btn btn-danger btn-sm close px-2" style="font-size: 18px; cursor: pointer;">x</span>
                        </div>
                    </div>
                    @endif
                    `;
                    $(this).parent().parent().prev().append(html);
                    @endforeach
                    @endif
                } else {
                    var html = `<div class="col-lg-11 d-flex">
                        <input type="time" name="start_time_${attr}[]" class="form-control w-75">
                        <input type="time" name="end_time_${attr}[]" class="form-control w-75" style="margin-left: 10px;">
                    </div>`;
                    $(this).parent().parent().prev().append(html);
                }
            });

            $(document).on("click", ".add-slot", function () {
                $(".unavailable").remove();
                var html = `<div class="col-lg-1 pt-2 d-flex justify-content-between">
                    <span class="btn btn-danger btn-sm remove-slot px-2" style="font-size: 18px; cursor: pointer; height: 35px;">x</span>
                </div>
                <div class="col-lg-11 d-flex justify-content-between pt-2 row">
                    <div class="col-lg-6 d-flex">
                        <input type="time" name="start_time[]" class="form-control w-75" id="start_time" required>
                        <input type="time" name="end_time[]" class="form-control w-75" style="margin-left: 10px;" id="end_time" required>
                    </div>
                </div>`;
                $(this).parent().next().find(".slots").append(html);
            });

            $(document).on("click", ".close", function () {
                $(this).parent().parent().prev().remove();
                // if($(this).parent().parent().prev().length == 0){
                //     var html = `<div class="col-lg-12 d-flex mt-3 unavailable">
                //         <p>Unavailable</p>
                //     </div>`;
                //     $(this).parent().parent().parent().append(html);
                // }
                $(this).parent().parent().remove();
            });

            $(document).on("click", ".remove", function () {
                $(this).parent().next().remove();
                $(this).parent().next().remove();
                $(this).parent().remove();
            });
            $(document).on("click", ".remove-slot", function () {
                $(this).parent().next().remove();
                if($(this).parent().parent().children().length == 1){
                    var html = `<p class="unavailable">No Default Slot Found</p>`;
                    $(this).parent().parent().append(html);
                }
                $(this).parent().remove();
            });
        });
    </script>

@endsection