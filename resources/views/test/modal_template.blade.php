<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap Modal Example in Laravel</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

	{{-- MODAL BUTTON -------------------------------------------------------------}}
	<!-- pulsante apri popup -->
	<button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#modal-element-1">Click Here</button>
	{{----------------------------------------------------------------------------}}
				


	{{----------------------------------------------------------------------------}}
	{{-- MODAL CONTENTS start ----------------------------------------------------}}

	<!-- Modal Start-->
	<div class="modal fade" id="modal-element-1" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title" id="demoModalLabel">TITLE</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body">
					CONTENT
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					
					<form method="post" action="{{ route('dashboard') }}">
						<button type="submit" class="btn btn-primary">Save changes</button>
					</form>
				</div>

			</div>
		</div>
	</div>
	<!-- Modal End-->


	<script type="application/javascript" src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	{{-- <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
	<script type="application/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


	{{-- MODAL CONTENTS end ------------------------------------------------------}}
	{{----------------------------------------------------------------------------}}


</body>
</html>


