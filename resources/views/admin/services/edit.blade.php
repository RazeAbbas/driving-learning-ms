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
                        <label for="name" class="control-label">Service Title</label>
                        <input type='text' name="title" id="title" class="form-control" value="{{@$row['title']}}" required="" data-mask="slugify" data-target="#slug" />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description</label>
                        <textarea type='text' name="short_description" id="short_description" class="form-control" required="">{{@$row['short_description']}}</textarea>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="mb-3">
                        <label for="long_description" class="form-label">Long Description</label>
                        <textarea type='text' name="long_description" id="long_description" class="form-control" required="">{{@$row['long_description']}}</textarea>
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
