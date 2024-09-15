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
					@if($is_playable == "1")
					<form class="" method="post" action="{{$action}}" enctype="multipart/form-data" data-action="make_ajax_file" data-action-after="reload"> 
						@csrf
						<div class="card-body">
							<div class="row">
								<div class="col-lg-2 col-md-2">
									<div class="mb-3">
										<label for="language" class="form-label">Select Language</label>
									</div>
								</div>
								<div class="col-lg-10 col-md-10">
									<div class="mb-3">
										<select class="form-control" name="language">
											<option value="en">English</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2 col-md-2">
									<div class="mb-3">
										<label for="file" class="form-label">Upload File</label>
									</div>
								</div>
								<div class="col-lg-10 col-md-10">
									<div class="mb-3">
										<input type="file" name="file" id="file" class="form-control" />
									</div>
								</div>
							</div>
						</div>

						<div class="card-footer">
							<button type="submit" class="btn btn-success d-none d-sm-inline-block mr-2">Upload</button>
						</div>
					</form>
					@else
					<p class="text-center">Video not found</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection