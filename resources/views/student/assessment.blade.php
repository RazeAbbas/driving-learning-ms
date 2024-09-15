@extends('layouts.student-assessment')
@section('content')
    <div class="row">
        <div class="col-lg-9 mt-5">
            <div class="announcements-wrapper-dashed rts-reviewd-area-dashed table-responsive" style="white-space: nowrap;">
                <h5 class="title">Assessment Quiz</h5>
                @if (count(@$questions) > 0)
                    <form action="{{ url('student/assessment', $assessment->id) }}" method="post" id="formSubmitted">
                        @csrf
                        @if (count(@$questions) > 0)
                            @foreach ($questions as $key => $question)
                                <div class="card quiz mt--30" data-id="{{ $key + 1 }}"
                                    @if (@$key > 0) style="display: none;" @endif>
                                    <div class="card-header py-4">
                                        <input name="questions[]" value="{{ $question->id }}" type="hidden">
                                        <h5 class="mb-0" style="font-size: 20px;">{{ $key + 1 }}.
                                            {{ $question->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($question->answers as $answer)
                                            <div class="information-quiz">
                                                <div class="form-check p-2">
                                                    <input class="form-check-input" type="radio"
                                                        name="answer_{{ @$question->id }}" value="{{ $answer->id }}"
                                                        id="option_{{ $answer->id }}">
                                                    <label class="form-check-label" for="option_{{ $answer->id }}">
                                                        {{ $answer->title }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        @if (count(@$questions) == 1)
                                            <button type="submit" style="margin-right: 10px;"
                                                class="rts-btn btn-primary">Submit</button>
                                            {{-- <button class="rts-btn btn-primary submited">Submit</button> --}}
                                        @elseif(@$key == 0)
                                            <button type="button" class="rts-btn btn-primary next">Next</button>
                                        @elseif(@$key + 1 == count(@$questions))
                                            <button type="button" class="rts-btn btn-primary prev"
                                                style="margin-right: 10px;">Prev</button>
                                            <button class="rts-btn btn-primary submited">Submit</button>
                                        @else
                                            <button type="button" class="rts-btn btn-primary prev mr-5"
                                                style="margin-right: 10px;">Prev</button>
                                            <button type="button" class="rts-btn btn-primary next">Next</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </form>
                @else
                    <div class="col-lg-12">
                        <p class="text-center mb-0">No question found</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-3 pt-5" id="main" style="display:none!important;">
            <div class="card">
                <div class="card-header d-flex justify-content-center p-3" style="background-color:#235347!important;">
                    <p class="mb-0 text-white" style="font-size: 20px;"><b><span id="active_question">1</span> of
                            {{ count(@$questions) }} @if (count(@$questions) > 1)
                                Questions
                            @else
                                Question
                            @endif
                        </b>
                    </p>
                </div>
                <div class="card-body text-center">
                    <div class="d-flex justify-content-center">
                        <div style="padding-right: 10px;">
                            <p class="mb-0" id="hours" style="font-size: 20px;">00</p>
                            <p class="mb-0" style="font-size: 12px;">Hours</p>
                        </div>
                        <div style="border-left: 1px solid #aaa; padding-left: 10px; padding-right: 10px;">
                            <p class="mb-0" id="minutes" style="font-size: 20px;">00</p>
                            <p class="mb-0" style="font-size: 12px;">Minutes</p>
                        </div>
                        <div style="border-left: 1px solid #aaa; padding-left: 10px; padding-right: 10px;">
                            <p class="mb-0" id="seconds" style="font-size: 20px;">00</p>
                            <p class="mb-0" style="font-size: 12px;">Seconds</p>
                        </div>
                    </div>
                    @if (count(@$questions) > 0)
                        @php
                            $last_key = 0;
                        @endphp
                        <div class="questions mt-5 row" style="padding-left: 10px;">
                            @foreach (@$questions as $key => $value)
                                @php
                                    $saved = 0;
                                    if (!empty($saved_answers)) {
                                        foreach ($saved_answers as $ke => $va) {
                                            $question_id = $key + 1;
                                            if ($va->question_id == $question_id) {
                                                $saved = 1;
                                            }
                                        }
                                    }
                                @endphp
                                <div class="col-lg-1 p-2 question m-1" data-id="{{ $key + 1 }}"
                                    @if (@$key == 0) style="background: #235347; color: #fff; cursor: pointer; width: 35px;" @else style="background: #ccc; cursor: pointer; width: 35px;" @endif>
                                    {{ $key + 1 }}</div>
                            @endforeach
                        </div>
                        <div class="mt-5">
                            <span class="px-3" style="background: #183831; margin-right: 5px;"></span> Completed
                            <span class="px-3" style="background: #255f52; margin-left: 5px; margin-right: 5px;"></span>
                            Selected
                            <span class="px-3" style="background: #ccc; margin-left: 5px; margin-right: 5px;"></span>
                            Remaining
                        </div>
                    @endif
                </div>
                <div class="card-footer p-0">
                    <button type="button" class="btn-smm w-100 submited text-white py-3"
                        style="border-radius: 0px 0px 5px 5px !important; background: #235347;">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on("click", ".submited", function() {
            var title = "Are you sure you want to submit your answers?";
            if ($('.answers:checked').length < 50) {
                title = "You have an unanswered questions! " + title;
            }
            Swal.fire({
                icon: "info",
                title: title,
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    localStorage.clear();
                    $('#formSubmitted').submit();
                    Swal.fire("Submitted!", "", "success");
                }
            });
        });
    </script>
    <script>
        $(document).on("click", ".next", function() {
            var active_question = $(this).parent().parent().next().attr("data-id");
            $("#active_question").text(active_question);
            $(".question[data-id='" + active_question + "']").css("background", "#255f52");
            $(".question[data-id='" + active_question + "']").css("color", "#fff");
            active_question = active_question - 1;
            if ($(this).parent().prev().find('input:checked').length > 0) {
                $(".question[data-id='" + active_question + "']").css("background", "#183831");
                $(".question[data-id='" + active_question + "']").css("color", "#fff");
            } else {
                $(".question[data-id='" + active_question + "']").css("background", "#ccc");
                $(".question[data-id='" + active_question + "']").css("color", "#000");
            }
            $(this).parent().parent().css("display", "none");
            $(this).parent().parent().next().css("display", "block");
        });

        $(document).on("click", ".prev", function() {
            var active_question = $(this).parent().parent().prev().attr("data-id");
            $("#active_question").text(active_question);
            $(".question[data-id='" + active_question + "']").css("background", "#255f52");
            $(".question[data-id='" + active_question + "']").css("color", "#fff");
            active_question = parseInt(active_question) + 1;
            if ($(this).parent().prev().find('input:checked').length > 0) {
                $(".question[data-id='" + active_question + "']").css("background", "#183831");
                $(".question[data-id='" + active_question + "']").css("color", "#fff");
            } else {
                $(".question[data-id='" + active_question + "']").css("background", "#ccc");
                $(".question[data-id='" + active_question + "']").css("color", "#000");
            }
            $(this).parent().parent().css("display", "none");
            $(this).parent().parent().prev().css("display", "block");
        });

        $(document).on("click", ".question", function() {
            var active_question = $(this).attr("data-id");
            $("#active_question").text(active_question);
            var active = $(this).text();
            $(".quiz").each(function(key, value) {
                var id = $(value).attr("data-id");
                if ($(value).find('.card-body').find('input:checked').length > 0) {
                    $(".question[data-id='" + id + "']").css("background", "#183831");
                    $(".question[data-id='" + id + "']").css("color", "#fff");
                } else {
                    $(".question[data-id='" + id + "']").css("background", "#ccc");
                    $(".question[data-id='" + id + "']").css("color", "#000");
                }
            });
            $(this).css("background", "#255f52");
            $(this).css("color", "#fff");
            $(".quiz").css("display", "none");
            console.log(".quiz[data-id='" + active + "']");
            $(".quiz[data-id='" + active + "']").css("display", "block");
        });
    </script>
    <script type="text/javascript">
        var total;

        function startTimer(duration) {
            var timer = duration,
                hours, minutes, seconds;
            var interval = setInterval(function() {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                $("#hours").text(hours);
                $("#minutes").text(minutes);
                $("#seconds").text(seconds);

                if (hours == "00" && minutes == "00" && seconds == "00") {
                    clearInterval(interval);
                    $(".assessment-form").submit();
                }

                if (--timer < 0) {
                    timer = duration;
                }
                total = timer;
            }, 1000);
        }

        $(document).ready(function() {
            var min = "{{ @$assessment->time_duration }}";
            var duration = 60 * parseFloat(min) - 1;
            startTimer(duration);

            $(document).on("click", ".next", function() {
                var active_question = $(this).parent().parent().next().attr("data-id");
                $("#active_question").text(active_question);
                $(".question[data-id='" + active_question + "']").css("background", "#255f52");
                $(".question[data-id='" + active_question + "']").css("color", "#fff");
                active_question = active_question - 1;
                if ($(this).parent().prev().find('input:checked').length > 0) {
                    $(".question[data-id='" + active_question + "']").css("background", "#183831");
                    $(".question[data-id='" + active_question + "']").css("color", "#fff");
                } else {
                    $(".question[data-id='" + active_question + "']").css("background", "#ccc");
                    $(".question[data-id='" + active_question + "']").css("color", "#000");
                }
                $(this).parent().parent().css("display", "none");
                $(this).parent().parent().next().css("display", "block");
            });

            $(document).on("click", ".prev", function() {
                var active_question = $(this).parent().parent().prev().attr("data-id");
                $("#active_question").text(active_question);
                $(".question[data-id='" + active_question + "']").css("background", "#255f52");
                $(".question[data-id='" + active_question + "']").css("color", "#fff");
                active_question = parseInt(active_question) + 1;
                if ($(this).parent().prev().find('input:checked').length > 0) {
                    $(".question[data-id='" + active_question + "']").css("background", "#183831");
                    $(".question[data-id='" + active_question + "']").css("color", "#fff");
                } else {
                    $(".question[data-id='" + active_question + "']").css("background", "#ccc");
                    $(".question[data-id='" + active_question + "']").css("color", "#000");
                }
                $(this).parent().parent().css("display", "none");
                $(this).parent().parent().prev().css("display", "block");
            });

            $(document).on("click", ".question", function() {
                var active_question = $(this).attr("data-id");
                $("#active_question").text(active_question);
                var active = $(this).text();
                $(".quiz").each(function(key, value) {
                    var id = $(value).attr("data-id");
                    if ($(value).find('.card-body').find('input:checked').length > 0) {
                        $(".question[data-id='" + id + "']").css("background", "#183831");
                        $(".question[data-id='" + id + "']").css("color", "#fff");
                    } else {
                        $(".question[data-id='" + id + "']").css("background", "#ccc");
                        $(".question[data-id='" + id + "']").css("color", "#000");
                    }
                });
                $(this).css("background", "#255f52");
                $(this).css("color", "#fff");
                $(".quiz").css("display", "none");
                $(".quiz[data-id='" + active + "']").css("display", "block");
            });
        });
    </script>
@endsection
