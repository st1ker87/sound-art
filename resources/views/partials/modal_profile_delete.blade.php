

@php

use App\Classes\IsNowInInterval;

$my_user		= Auth::user();
$my_profile		= $my_user->profile;
$my_contracts	= $my_user->contracts;
$is_any_contract = (!$my_contracts->isEmpty());
$is_active_sponsorship = false;
foreach ($my_contracts as $my_contract) {
    if ((new IsNowInInterval)->get($my_contract->date_start,$my_contract->date_end)) {
        $is_active_sponsorship = true;
    }
}

@endphp

@if ($my_profile)

@push('dashboard_head')
<style>
	.vertical_spacer {
		margin-bottom: 24px;
	}	
	.required_input_field {
		color: #e3342f; /* $red */
	}
	.modal-header,
	.modal-footer {
		border: none;
	}
	.modal-title {
		color: #212949; /* $primaryDarkBlue */
	}
	.modal-footer button {
		margin-left: 5px;
	}
</style>
@endpush

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h3 class="modal-title" id="demoModalLabel">Profile Removal</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>

				<div class="modal-body">
					<p>You are about to remove all your Profile's informations from this platform. No one will be able to reach you in the search area.</p>
					<p>
						@if ($is_active_sponsorship)
							Your current Sponsorship will cease immediately.				
						@endif
					</p>
					<p>All your past activities (sponsorships, messages, reviews) will remain in our database, unless you decide to cancel your account.</p>
					<p>This action can't be undone.</p>
				</div>

				<div class="modal-footer">
					<div>
						<form class="d-inline-block btn-block" action="{{ route('admin.profiles.destroy',$my_profile->id) }}" method="post">
							@csrf
							@method('DELETE')
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
							<button type="submit" class="btn btn-danger">Confirm Delete</button>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- MODAL DELETE PROFILE end-->

@endif
