<div class="modal-header">
    <h5 class="modal-title">{{@$page_title}}</h5>
    <a href="{{url($module['action'])}}" class="btn-close" aria-label="Close"></a>
</div>
<div class="modal-body">
    <form class="" method="post" action="{{$action}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="mb-3">
                        <label for="day" class="form-label">Select Day <span class="text-danger">*</span></label>
                        <select name="day" id="day" class="form-control" required="">
                            <option @if(@$row['day'] == "Monday") selected @endif>Monday</option>
                            <option @if(@$row['day'] == "Tuesday") selected @endif>Tuesday</option>
                            <option @if(@$row['day'] == "Wednesday") selected @endif>Wednesday</option>
                            <option @if(@$row['day'] == "Thursday") selected @endif>Thursday</option>
                            <option @if(@$row['day'] == "Friday") selected @endif>Friday</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time <span class="text-danger">*</span></label>
                        <input type="time" name="start_time" id="start_time" value="{{ substr(@$row['start_time'], 0, -3) }}" class="form-control" required="" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time <span class="text-danger">*</span></label>
                        <input type="time" name="end_time" id="end_time" value="{{ substr(@$row['end_time'], 0, -3) }}" class="form-control" required="" />
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Update</button>
            <a  class="btn btn-secondary" href="{{url($module['action'])}}">Cancel</a>
        </div>
    </form>
</div>
