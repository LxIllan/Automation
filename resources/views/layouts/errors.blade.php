@if ($errors->any())
<div class="alert alert-secondary mt-2 alert-dismissible">
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif