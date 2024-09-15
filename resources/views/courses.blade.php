@extends('layouts.app')
@section('content')
    <!-- bread crumb area -->
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">Our Courses</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="{{ url('home') }}">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="{{ url('courses') }}">All Courses</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->



    <!-- course area start -->
    <div class="rts-course-default-area rts-section-gap">
        <div class="container">
            <div class="row g-5">
                {{-- <div class="col-lg-3">
                    <!-- course-filter-area start -->
                    <div class="rts-course-filter-area">
                        <!-- single filter wized -->
                        <div class="single-filter-left-wrapper">
                            <h6 class="title">Category</h6>
                            <div class="checkbox-filter ">
                                <div class="checkbox-wrapper">
                                    <!-- single check box -->
                                    @foreach ($categories as $key => $category)
                                        <div class="single-checkbox-filter">
                                            <div class="check-box">
                                                <input type="checkbox" id="category-{{ $key }}"
                                                    value="{{ $category->id }}">
                                                <label for="category-{{ $key }}">{{ $category->title }}</label><br>
                                            </div>
                                            <span class="number">({{ $category->courses->count() }})</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- single filter wized end -->
                    </div>
                    <!-- course-filter-area end -->
                </div> --}}
                <div class="col-lg-9">
                    <!-- filter top-area  -->
                    <div class="d-flex flex-column flex-md-row mb-5">
                        <div class="col-md-4">
                            <div class="w-100 w-md-50">
                                <select class="form-select form-select-lg sort-select"
                                    style="font-size: 15px; font-family: sans-serif; color: rgb(115, 116, 119)">
                                    <option selected>Filter</option>
                                    <option value="1">A-Z</option>
                                    <option value="2">Z-A</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 d-flex justify-content-md-end justify-content-center">
                            <div id="pagination-info">
                                <!-- dynamically pagination is shown here -->
                            </div>
                        </div>
                    </div>

                    <!-- filter top-area end -->
                    <div class="tab-content" id="myTabContent">
                        <!------------- list view start ------------->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="profile-tab">
                            <div id="course-list-container">
                                <!-- Courses will be loaded dynamically here -->
                            </div>
                        </div>
                        <!------------- list view end ------------->
                    </div>

                    <!---------------- pagination links ---------------->
                    <div class="row mt--30">
                        <div class="col-lg-12">

                            <div class="rts-pagination-area-2">
                                <!--- pagination will be added dynamically here ---------->
                            </div>

                        </div>
                    </div>
                    <!---------------- pagination links end ---------------->
                </div>
            </div>
        </div>
    </div>
    <!-- course area end -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            // Function to generate HTML for a single course
            function generateCourseHtml(course) {
                // console.log(course);
                var html = '<div class="col-lg-12">' +
                    '<div class="rts-single-course course-list">' +
                    '<a href="{{ url('course/details') }}/' + course.id + '" class="thumbnail">' +
                    '<img src="{{ asset('storage/upload/298x200-') }}' + course.featured_img + '" alt="course">' +
                    '</a>' +
                    '<div class="save-icon" id="add-to-wishlist" course-id="' + course.id + '">' +
                    '<i class="fa-sharp fa-light fa-bookmark"></i>' +
                    '</div>' +
                    '<div class="information-inner">' +
                    '<div class="lesson-studente">' +
                    '<div class="lesson">' +
                    '<i class="fa-light fa-calendar-lines-pen"></i>' +
                    '<span>' + course.lessons_count + ' Lessons</span>' +
                    '</div>' +
                    '<div class="lesson">' +
                    '<i class="fa-light fa-user-group"></i>' +
                    '<span>'+ course.order_items_count +'</span>' +
                    '</div>' +
                    '</div>' +
                    '<a href="{{ url('course/details') }}/' + course.id + '">' +
                    '<h5 class="title">' + course.course_name + '</h5>' +
                    '</a>' +
                    '<p class="disc">' + course.short_detail + '</p>' +
                    '<p class="teacher">' + course.instructor.name + '</p>' +
                    // '<div class="rating-and-price">' +
                    // '<div class="rating-area">' +
                    // '<span>4.5</span>' +
                    // '<div class="stars">' +
                    // '<ul>' +
                    // '<li><i class="fa-sharp fa-solid fa-star"></i></li>' +
                    // '<li><i class="fa-sharp fa-solid fa-star"></i></li>' +
                    // '<li><i class="fa-sharp fa-solid fa-star"></i></li>' +
                    // '<li><i class="fa-sharp fa-solid fa-star"></i></li>' +
                    // '<li><i class="fa-sharp fa-regular fa-star"></i></li>' +
                    // '</ul>' +
                    // '</div>' +
                    // '</div>' +
                    '<div class="price-area">' +
                    (course.discount && new Date(course.discount_end_date) >= new Date() ?
                        '<div class="not price">$' + course.price + '</div>' +
                        '<div class="price">$' + (course.price - (course.price * (course.discount / 100))) +
                        '</div>' :
                        '<div class="price">$' + course.price + '</div>') +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                return html;
            }

            // -------generate pagination------------
            function generatePagination(response) {

                var paginationArea = $('.rts-pagination-area-2');
                paginationArea.empty(); // Clear existing pagination

                if (response.last_page > 1) {
                    var paginationHtml = '<ul class="pagination">';
                    paginationHtml += '<a href="' + response.first_page_url + '"><li class="' + (response
                            .current_page == 1 ? 'disabled' : '') +
                        '"><i class="fa-solid fa-chevron-left"></i></li></a>';

                    for (var i = 1; i <= response.last_page; i++) {
                        paginationHtml += '<a href="' + response.path + '?page=' + i + '"><li class="' + (response
                            .current_page == i ? 'active' : '') + '">' + i + '</li></a>';
                    }

                    paginationHtml += '<a href="' + response.next_page_url + '"><li class="' + (response
                            .current_page == response.last_page ? 'disabled' : '') +
                        '"><i class="fa-solid fa-chevron-right"></i></li></a>';
                    paginationHtml += '</ul>';

                    paginationArea.append(paginationHtml);
                }
            }

            //------------ show paginated courses
            $('body').on('click', '.pagination a', function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                var clickedPage = $(this).text();
                $('.pagination li').removeClass('active');
                var clickedLink = $(this); // Store reference to the clicked pagination link

                let data = getFilterParams();
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: data,
                    dataType: 'json', // Update to 'json' since you're expecting JSON response
                    success: function(response) {
                        var courses = response.data;
                        var courseListContainer = $('#course-list-container');
                        courseListContainer.empty();
                        $.each(courses, function(index, course) {
                            var courseHtml = generateCourseHtml(course);
                            courseListContainer.append(courseHtml);
                        });

                        // Scroll to the top of the course list container
                        $('html, body').animate({
                            scrollTop: $('#course-list-container').offset().top
                        }, 500);

                        // Generate pagination based on the provided response
                        generatePagination(response);
                        updatePaginationInfo(response);

                        // Add 'active' class to the clicked pagination link
                        clickedLink.parent('li').addClass('active');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            });

            /*---------- sort filter--------------*/
            $('body').on('change', '.sort-select', function(e) {
                e.preventDefault();
                let val = $(this).val();
                let data = {
                    sort: val,
                    expectsJson: true,
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('courses.sort') }}",
                    type: 'GET',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        var courses = response.data;
                        var courseListContainer = $('#course-list-container');
                        courseListContainer.empty();
                        $.each(courses, function(index, course) {
                            var courseHtml = generateCourseHtml(course);
                            courseListContainer.append(courseHtml);
                        });
                        generatePagination(response);
                        updatePaginationInfo(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            });



            //--------------update pagination info------------
            function updatePaginationInfo(response) {
                var currentPage, perPage, totalResults;

                if (response) {
                    currentPage = response.current_page;
                    perPage = response.per_page;
                    totalResults = response.total;
                } else {
                    currentPage = {{ $courses->currentPage() }};
                    perPage = {{ $courses->count() }};
                    totalResults = {{ $courses->total() }};
                }

                var start = (currentPage - 1) * perPage + 1;
                var end = Math.min(start + perPage - 1, totalResults);

                var paginationInfo = 'Showing ' + start + '-' + end + ' of ' + totalResults + ' results';
                $('#pagination-info').text(paginationInfo);
            }
            //------- add event listener to check boxes------------
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', handleCheckboxClick);
            });

            //------------ applying filter ---------
            function handleCheckboxClick() {
                let data = getFilterParams();

                $.ajax({
                    url: "{{ route('courses.filter') }}",
                    type: 'GET',
                    data: data,
                    success: function(response) {
                        var courses = response.data;
                        console.log(response);
                        var courseListContainer = $('#course-list-container');
                        courseListContainer.empty(); // Clear existing courses

                        // Append each course to the container
                        $.each(courses, function(index, course) {
                            var courseHtml = generateCourseHtml(course);
                            courseListContainer.append(courseHtml);
                        });
                        generatePagination(response);
                        updatePaginationInfo(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            function getFilterParams() {
                var checkedCategories = document.querySelectorAll(
                    'input[type="checkbox"][id^="category-"]:checked');
                var categoryValues = Array.from(checkedCategories).map(function(checkbox) {
                    return checkbox.value;
                });
                let data = {
                    categoryids: categoryValues,
                    expectsJson: true,
                    _token: "{{ csrf_token() }}"
                };

                return data;
            }


            /* Function to load courses via AJAX */
            function loadCourses() {
                $.ajax({
                    url: "{{ route('courses.list') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        var courses = response.data;
                        var courseListContainer = $('#course-list-container');
                        courseListContainer.empty(); // Clear existing courses

                        // Append each course to the container
                        $.each(courses, function(index, course) {
                            var courseHtml = generateCourseHtml(course);
                            courseListContainer.append(courseHtml);
                        });
                        generatePagination(response);
                        updatePaginationInfo(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Load courses when the document is ready
            loadCourses();
        });
    </script>
@endsection
