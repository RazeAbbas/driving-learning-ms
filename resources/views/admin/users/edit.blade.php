<div class="modal-header">
    <h5 class="modal-title">{{@$page_title}}</h5>
    <a href="{{url($module['action'])}}" class="btn-close" aria-label="Close"></a>
</div>
<div class="modal-body">
    <form class="" method="post" action="{{$action}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type='text' value="{{@$row['name']}}" name="name" id="name" class="form-control" required=""  />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Email</label>
                                        <input type='text' value="{{@$row['email']}}" name="email" id="email" class="form-control" required="" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Phone</label>
                                        <input type='text' value="{{@$row['phone']}}" name="phone" id="phone" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Address</label>
                                        <input type='text' value="{{@$row['address']}}" name="address" id="address" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Role</label>
                                        <select name="role" id="role" class="form-select">
                                            <option value="1" @if(@$row['role'] == "1") selected @endif>Admin</option>
                                            <option value="2" @if(@$row['role'] == "2") selected @endif>Instructor</option>
                                            <option value="3" @if(@$row['role'] == "3") selected @endif>Student</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Highest Degree</label>
                                        <input type='text' value="{{@$row['highest_degree']}}" name="highest_degree" id="highest_degree" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Gender</label>
                                        <select name="gender" id="gender" class="form-select">
                                            <option value="Male" @if(@$row['gender'] == "Male") selected @endif>Male</option>
                                            <option value="Female" @if(@$row['gender'] == "Female") selected @endif>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Instructor Degree</label>
                                        <input type='text' value="{{@$row['instructor_degree']}}" name="instructor_degree" id="instructor_degree" class="form-control" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                            <a  class="btn btn-secondary" href="{{url($module['action'])}}">Cancel</a>
                        </div>
                    </form>
</div>
{{-- <div class="modal-footer">
    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
        Cancel
    </a>
    <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
        Create new report
    </a>
</div> --}}
