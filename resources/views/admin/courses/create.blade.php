@extends('layouts.admin')
@section('content')
<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col card">
				<div class="card-header">
					<h5 class="card-title">{{@$page_title}}</h5>
				</div>
				<div class="card-body">
					<form class="" method="post" action="{{$action}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload">
						@csrf
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="course_name" class="form-label">Course Name</label>
										<input type='text' name="course_name" id="course_name" class="form-control" required="" data-target="#slug" />
									</div>
								</div>
								
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="slug" class="form-label">Course Slug</label>
										<input type='text' name="slug" id="slug" class="form-control" required="" readonly  />
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="accredition" class="form-label">Accredition</label>
										<input type='text' name="accredition" id="accredition" class="form-control" required="" />
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="is_featured" class="form-label">Is Featured ?</label>
										<select name="is_featured" id="is_featured" class="form-select">
											<option value="">Please select is course featured</option>
											<option value="yes">Yes</option>
											<option value="no">No</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="mb-3">
										<label for="short_detail" class="form-label">Short Detail</label>
										<textarea name="short_detail" id="short_detail" class="form-control"></textarea>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="mb-3">
										<label for="long_detail" class="form-label">Long Detail</label>
										<textarea name="long_detail" id="long_detail" class="form-control" ></textarea>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="price" class="form-label">Price</label>
										<input type='number' name="price" id="price" class="form-control" />
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="instructor_id" class="form-label">Instructor</label>
										<select name="instructor_id" id="instructor_id" class="form-select" required="">
											<option value="">Select Instructor</option>
											@foreach($instructors as $key => $val)
											<option value="{{$val->id}}">{{$val->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="certification" class="form-label">Certificate</label>
										<input type="file" class="form-control" name="certification" id="certification">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="language" class="form-label">Language</label>
										<select name="language" id="language" class="form-select">
											<option value="both">Both of them</option>
											<option value="english">English</option>
											<option value="arabic">Arabic</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="featured_img" class="form-label">Featured Image</label>
										<input type='file' name="featured_img" id="featured_img" class="form-control" />
									</div>
								</div>
								{{-- <div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="featured_video" class="form-label">Featured Video</label>
										<input type='file' name="featured_video" id="featured_video" class="form-control" />
									</div>
								</div> --}}
								<div class="col-lg-6 col-md-6">
									<div class="mb-3">
										<label for="cat_id" class="form-label">Category</label>
										<select name="cat_id" id="cat_id" class="form-select" required>
											@if(!empty($list))
											@foreach($list as $key => $val)
											<option value="{{$val['id']}}">{{$val['title']}}</option>
											@endforeach
											@endif
										</select>
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="card-footer">
							<button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Create</button>
							<a  class="btn btn-secondary" href="{{url($module['action'])}}">Cancel</a>
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
	$(document).on("keyup", '#course_name', function(event) {
		let val = $(this).val();
		let target = $(this).attr("data-target");
		$(target).val(baseJS.slugify(val));
	});
	document.getElementById("is_feature").addEventListener("change", function () {
		var selectedType = this.value;
		
		// Hide or disable the Feature Training Type dropdown based on the selected Course Type
		if (selectedType === "Featured training" || selectedType === "All") {
			document.getElementById("featuredOptions").style.display = "block"; // Hide the options
			// OR
			// document.getElementById("feature_type").disabled = true; // Disable the dropdown
		} else {
			document.getElementById("featuredOptions").style.display = "none"; // Show the options
		}
		
		// Show or hide options based on the selected Course Type
		if (selectedType === "Medical rep training") {
			document.getElementById("medicalRepOptions").style.display = "block";
			document.getElementById("leaderOptions").style.display = "none";
		} else if (selectedType === "Leader training") {
			document.getElementById("medicalRepOptions").style.display = "none";
			document.getElementById("leaderOptions").style.display = "block";
		} else if (selectedType === "Featured training") {
			document.getElementById("medicalRepOptions").style.display = "none";
			document.getElementById("leaderOptions").style.display = "none";
		}
		else {
			// For other course types, show all options
			document.getElementById("medicalRepOptions").style.display = "none";
			document.getElementById("leaderOptions").style.display = "none";
			document.getElementById("featuredOptions").style.display = "none";
		}
	});
</script>
@endsection

