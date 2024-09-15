@extends('layouts.student')
@section('content')
    <div class="col-lg-9">
        <div class="exrolled-course-wrapper-dashed">
            <h5 class="title">Enrolleld Courses</h5>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="true">Enrolleld Courses</button>
                </li>
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">Active Courses</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                        role="tab" aria-controls="contact" aria-selected="false">Completed Courses</button>
                </li> --}}
            </ul>
            <div class="tab-content mt--30" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row g-5">
                        @foreach ($enrolled_courses as $course)
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <!-- single course style two -->
                                <div class="single-course-style-three enroll-course">
                                    <a href="{{ url('student/course/watch', $course->id) }}" class="thumbnail">
                                        <img src="{{ asset('storage/upload/270x200-' . $course->featured_img) }}"
                                            alt="course">
                                    </a>
                                    <div class="body-area">
                                        <div class="course-top">
                                            <div class="price">${{ $course->price }}</div>
                                        </div>
                                        <a href="{{ url('student/course/watch', $course->id) }}">
                                            <h5 class="title">{{ $course->course_name }}</h5>
                                        </a>
                                        <div class="teacher-stars">
                                            <div class="teacher"><span>{{ $course->instructor->name }}</span></div>
                                            {{-- <ul class="stars">
                                                <li class="span">4.5</li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                            </ul> --}}
                                        </div>
                                        <div class="leasson-students">
                                            <div class="lesson">
                                                <i class="fa-light fa-calendar-lines-pen"></i>
                                                <span>{{ $course->lessons->count() }} Lessons</span>
                                            </div>
                                            {{-- <div class="students">
                                        <i class="fa-light fa-users"></i>
                                        <span>25 students</span>
                                    </div> --}}
                                        </div>
                                        <div class="progress-wrapper-lesson-compleate">
                                            <div class="compleate">
                                                <div class="compl">
                                                    @if ($course->isCompleted)
                                                        Complete
                                                    @else
                                                        In Progress
                                                    @endif
                                                </div>
                                                <div class="end">
                                                    <span>{{ $course->progress }}%</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar wow fadeInLeft bg--primary" role="progressbar"
                                                    style="width: {{ $course->progress }}%" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ url('student/course/watch', $course->id) }}" class="rts-btn btn-border">Start Course <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <!-- single course style two end -->
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row g-5">

                        @foreach ($enrolled_courses as $course)
                            @if ($course->progress > 0 && $course->progress < 100)
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <!-- single course style two -->
                                    <div class="single-course-style-three enroll-course">
                                        <a href="{{ url('student/course/watch', $course->id) }}" class="thumbnail">
                                            <img src="{{ asset('storage/upload/270x200-' . $course->featured_img) }}"
                                                alt="course">
                                        </a>
                                        <div class="body-area">
                                            <div class="course-top">
                                                <div class="price">${{ $course->price }}</div>
                                            </div>
                                            <a href="{{ url('student/course/watch', $course->id) }}">
                                                <h5 class="title">{{ $course->course_name }}</h5>
                                            </a>
                                            <div class="teacher-stars">
                                                <div class="teacher"><span>{{ $course->instructor->name }}</span></div>
                                                <ul class="stars">
                                                    <li class="span">4.5</li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                    <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="leasson-students">
                                                <div class="lesson">
                                                    <i class="fa-light fa-calendar-lines-pen"></i>
                                                    <span>{{ $course->lessons->count() }} Lessons</span>
                                                </div>
                                                {{-- <div class="students">
                                        <i class="fa-light fa-users"></i>
                                        <span>25 students</span>
                                    </div> --}}
                                            </div>
                                            <div class="progress-wrapper-lesson-compleate">
                                                <div class="compleate">
                                                    <div class="compl">
                                                        Complete
                                                    </div>
                                                    <div class="end">
                                                        <span>{{ $course->progress }}%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar wow fadeInLeft bg--primary"
                                                        role="progressbar" style="width: {{ $course->progress }}%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="rts-btn btn-border">Download Certificate</button>
                                        </div>
                                    </div>
                                    <!-- single course style two end -->
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row g-5">
                        @foreach ($enrolled_courses as $course)
                        @if ($course->progress == 100)
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <!-- single course style two -->
                                <div class="single-course-style-three enroll-course">
                                    <a href="{{ url('student/course/watch', $course->id) }}" class="thumbnail">
                                        <img src="{{ asset('storage/upload/270x200-' . $course->featured_img) }}"
                                            alt="course">
                                    </a>
                                    <div class="body-area">
                                        <div class="course-top">
                                            <div class="price">${{ $course->price }}</div>
                                        </div>
                                        <a href="{{ url('student/course/watch', $course->id) }}">
                                            <h5 class="title">{{ $course->course_name }}</h5>
                                        </a>
                                        <div class="teacher-stars">
                                            <div class="teacher"><span>{{ $course->instructor->name }}</span></div>
                                            <ul class="stars">
                                                <li class="span">4.5</li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-solid fa-star"></i></li>
                                                <li><i class="fa-sharp fa-regular fa-star"></i></li>
                                            </ul>
                                        </div>
                                        <div class="leasson-students">
                                            <div class="lesson">
                                                <i class="fa-light fa-calendar-lines-pen"></i>
                                                <span>{{ $course->lessons->count() }} Lessons</span>
                                            </div>
                                            {{-- <div class="students">
                                    <i class="fa-light fa-users"></i>
                                    <span>25 students</span>
                                </div> --}}
                                        </div>
                                        <div class="progress-wrapper-lesson-compleate">
                                            <div class="compleate">
                                                <div class="compl">
                                                    Complete
                                                </div>
                                                <div class="end">
                                                    <span>{{ $course->progress }}%</span>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar wow fadeInLeft bg--primary" role="progressbar"
                                                    style="width: {{ $course->progress }}%" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="rts-btn btn-border">Download Certificate</button>
                                    </div>
                                </div>
                                <!-- single course style two end -->
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection