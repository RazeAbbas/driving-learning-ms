@extends('layouts.student-assessment')
@section('content')
    <title>Assessment Result</title>

    <style>
        input[type=checkbox]~label::before,
        input[type=radio]~label::before {
            width: 0px !important;
        }

        input[type=checkbox]~label,
        input[type=radio]~label {
            padding-left: 15px !important;
            font-size: 20px !important;
        }

        .rate {
            display: flex;
            flex-direction: row-reverse;
            /* Reverse direction for RTL support */
            justify-content: center;
        }

        .rate input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .rate label {
            cursor: pointer;
            font-size: 24px;
            /* Adjust size as needed */
            color: #ccc;
            /* Adjust color as needed */
        }

        .rate input:checked~label,
        .rate input:checked~label i:before {
            color: #ffc107;
            /* Adjust color for filled star */
        }


        .nav-tabs .nav-link1 {
            margin-bottom: 0px !important;
            border: none !important;
            border-top-left-radius: unset !important;
            border-top-right-radius: unset !important;
        }

        a.nav-link1 {
            font-size: 20px !important;
            color: white !important;
        }

        a.nav-link.active {
            border-top: 0px !important;
            border-bottom: 3px solid white !important;
            border-left: 0px !important;
            border-right: 0px !important;
            color: white !important;
        }

        .nav-tabs .nav-link:hover {
            border: none;
            color: white !important;
        }

        .card-header-tabs .nav-link.active {
            background-color: transparent !important;
        }

        .header-card {
            align-items: flex-start !important;
            padding: 45px 40px !important;
            background: linear-gradient(-90deg, #2c0984 0%, #aa1eca 100%) !important;
            color: white !important;
        }

        .card-header-tabs {
            background-color: transparent !important;
            margin-top: 6px !important;
        }

        .edu-btn {
            text-align: center;
            border-radius: 5px;
            display: inline-block;
            line-height: 40px;
            color: #fff;
            background: #2c0984;
            padding: 0 20px;
            font-size: 15px;
            font-weight: 500;
            -webkit-transition: .4s;
            transition: .4s;
            font-family: var(--font-secondary);
            border: 0;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .edu-btn:after {
            content: "";
            height: 100%;
            background: linear-gradient(-90deg, #aa1eca 0%, #2c0984 100%);
            border-radius: 5px;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            transition: .4s;
            left: 0;
            width: 100%;
        }
    </style>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">

                <div class="col-md-12 mb-5">
                    <div class="card">
                        <div class="card-header p-5 flex-column" style="background-color:#235347;">
                            <div>
                                <h4 class="mb-0 mt-0 text-white">{{ @$assessment_result->course->course_name }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-pane fade active show" id="tabs-activity-8" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3 class="mt-3">Assessment Result</h3>
                                    </div>
                                    <div class="col-lg-12 pt-3">
                                        <div class="card">
                                            <div class="card-header"
                                                style="background-color: #235347; !important; color: #fff;">
                                                <p class="mb-0 text-white">Total Questions:
                                                    <b>{{ @$assessment_result->total_questions }}</b>
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <table class="table text-center">
                                                    <tr>
                                                        <th>Correct Answers</th>
                                                        <th>Incorrect Answers</th>
                                                        <th>Unanswered</th>
                                                        <th>Grade</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ @$assessment_result->total_correct }}</td>
                                                        <td>{{ @$assessment_result->total_wrong }}</td>
                                                        <td>{{ @$assessment_result->total_unanswered }}</td>
                                                        <td>{{ round(((int) @$assessment_result->total_correct / (int) @$assessment_result->total_questions) * 100) }}%
                                                        </td>
                                                        <td
                                                            @if (@$assessment_result->status == 'Fail') class="text-danger" @else class="text-success" @endif>
                                                            {{ @$assessment_result->status }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <hr />

                                            <div class="card-footer py-3 d-flex justify-content-end mt-5">
                                                {{-- @if (@$assessment_result->status == 'Fail')
                                                    <div class="buttons-area p-2">
                                                        <a href="{{ url('student/assessment', @$assessment_result->course->id) }}"
                                                            class="btn-smm rts-btn btn-primary p-2">Repeat Assessment</a>
                                                    </div>
                                                @else
                                                    @if (!empty($assessment_result->course->certification))
                                                        <div class="buttons-area p-2">
                                                            <a href="{{ url('student/download-certificate', @$assessment_result->id) }}"
                                                                class="btn-smm rts-btn btn-primary p-2"><i
                                                                    class="fas fa-download"></i> Download Certificate</a>
                                                        </div>
                                                    @endif
                                                @endif --}}
                                                {{-- @if (@$assessment_result->status == 'Fail')
                                                    <div class="buttons-area p-2">
                                                        <a href="{{ url('student/assessment', @$assessment_result->course->id) }}"
                                                            class="btn-smm rts-btn btn-primary p-2">Repeat Assessment</a>
                                                    </div>
                                                @elseif (@$show_certificate_button && !empty(@$assessment_result->course->certification))
                                                    <div class="buttons-area p-2">
                                                        <a href="{{ url('student/download-certificate', @$assessment_result->id) }}"
                                                            class="btn-smm rts-btn btn-primary p-2"><i
                                                                class="fas fa-download"></i> Download Certificate</a>
                                                    </div>
                                                @endif --}}
                                                <div class="buttons-area p-2">
                                                    @if (@$assessment_result->status == 'Fail')
                                                        <a href="{{ url('student/assessment', @$assessment_result->course->id) }}"
                                                            class="btn-smm rts-btn btn-primary p-2">Repeat Assessment</a>
                                                    @elseif (@$show_certificate_button && !empty(@$assessment_result->course->certification))
                                                        <a href="{{ url('student/download-certificate', @$assessment_result->id) }}"
                                                            class="btn-smm rts-btn btn-primary p-2"><i
                                                                class="fas fa-download"></i> Download Certificate</a>
                                                    @endif
                                                </div>


                                                {{-- <div class="buttons-area p-2">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#modal-report"
                                                        data-course-id="{{ @$assessment_result->course->id }}"
                                                        class="btn-smm rts-btn btn-primary p-2">Leave a rating</a>
                                                </div> --}}
                                                <div class="buttons-area p-2">
                                                    <a href="{{ url('student/course/watch', @$assessment_result->course->id) }}"
                                                        class="btn-smm rts-btn btn-primary p-2"
                                                        style="text-decoration: none;">Continue Learning</a>
                                                </div>
                                            </div>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ url('student/rating/create') }}" method="post" enctype="multipart/form-data"
                        data-action="make_ajax_file" data-action-after="reload" class="mb-0">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Review and Rating</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="course_id" value="{{ @$assessment_result->course->id }}">
                                <div class="col-lg-12 d-flex justify-content-center">
                                    {{-- <div class="rate">
                                        <input type="radio" id="star5" name="rating" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div> --}}
                                    <div class="rate">
                                        <input style="display:none;" type="radio" id="star5" name="rating"
                                            value="5" />
                                        <label for="star5" title="text"><i class="fas fa-star"></i></label>
                                        <input style="display:none;" type="radio" id="star4" name="rating"
                                            value="4" />
                                        <label for="star4" title="text"><i class="fas fa-star"></i></label>
                                        <input style="display:none;" type="radio" id="star3" name="rating"
                                            value="3" />
                                        <label for="star3" title="text"><i class="fas fa-star"></i></label>
                                        <input style="display:none;" type="radio" id="star2" name="rating"
                                            value="2" />
                                        <label for="star2" title="text"><i class="fas fa-star"></i></label>
                                        <input style="display:none;" type="radio" id="star1" name="rating"
                                            value="1" />
                                        <label for="star1" title="text"><i class="fas fa-star"></i></label>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                <div>
                                    <label class="form-label">Title</label>
                                    <input class="form-control" name="title" rows="3"/>
                                </div>
                            </div> --}}
                                <div class="col-lg-12 mt-2">
                                    <div>
                                        <label class="form-label">Write a review</label>
                                        <textarea class="form-control" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="rts-btn btn-border p-2" type="reset" data-bs-dismiss="modal">Cancel</button>
                            <button class="rts-btn btn-primary p-2" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
