<div class="modal-header">
    <h5 class="modal-title">{{ @$page_title }}</h5>
    <a href="{{ url($module['action']) }}" class="btn-close" aria-label="Close"></a>
</div>
<div class="modal-body">
    <form class="" method="post" action="{{ $action }}" enctype="multipart/form-data"
        data-action="make_ajax_file" data-action-after="reload">
        @csrf
        <div class="card-body">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type='text' name="name" id="name" class="form-control" required="" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <label for="detail" class="form-label">Email</label>
                            <input type='text' name="email" id="email" class="form-control" required="" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <label for="detail" class="form-label">Phone</label>
                            <input type='text' name="phone" id="phone" class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <label for="detail" class="form-label">Address</label>
                            <input type='text' name="address" id="address" class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <label for="detail" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="1">Admin</option>
                                <option value="2">Instructor</option>
                                <option value="3">Student</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <label for="detail" class="form-label">Highest Degree</label>
                            <input type='text' name="highest_degree" id="highest_degree" class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <label for="detail" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-select">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <label for="detail" class="form-label">Instructor Degree</label>
                            <input type='text' name="instructor_degree" id="instructor_degree"
                                class="form-control" />
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success btn-block mr-2">Create</button>
            <a class="btn btn-secondary" href="{{ url($module['action']) }}">Cancel</a>
        </div>
    </form>
</div>
