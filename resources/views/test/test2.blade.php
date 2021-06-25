
{{-- NON CANCELLARE QUESTA PAGINA DI TEST --}}
{{--        SERVE A STEFANO E YURI        --}}

@php

	$route_name = Route::currentRouteName();
	dump($route_name);
	
	if ($route_name == 'profiles.show') {
		// per profiles.show (PROFILO ESISTE)
		// visto da guest o admin: $profile viene da ProfileController
		$my_profile = $profile;
	} else {
		// per dashboard e simili (PROFILO PUÒ NON ESISTERE usare user)
		// visto da admin: $my_profile = Auth::user()->profile;
		$my_user = Auth::user();
		$my_profile = $my_user->profile;
	}

    $reviews = $my_user->reviews;
    // Set average vote to false
    $average_vote = false;
    // If collection of votes is not empty
    if($reviews->isNotEmpty()) {
        // Set average vote to 0 so I can start adding the votes found
        $average_vote = 0;
        // Keeps track of number of votes
        $counter = 0;
        foreach($reviews as $review) {
            // For each vote add +1 to counter
            $counter++;
            // Update average vote
            $average_vote += $review->rev_vote;
        }
        // When for loop ends, do average and round the result
        $average_vote = round($average_vote / $counter);
    }
@endphp

{{-- JUMBOTRON DASHBOARD --}}
<div class="jumbo-dash container-fluid">
	<div class="row jumbo_height">
		{{-- <div class="over-jumbo d-block d-xl-none"></div> --}}
		<div class="container jumbo_height">
			<div class="jumbo_img jumbo_height d-none d-lg-block">
				<div class="diagonal_container">
					<div class="diagonal"></div>
					@if ($my_profile)
						<img class="jumbo_height" src="{{asset('storage/'.$my_profile->image_url)}}" alt="">  
					@endif
				</div>
			</div>
			<div class="title-dash">
				<h1>{{ $my_user->name }} {{ $my_user->surname }}</h1>
				<h3>
					@foreach ($my_user->categories as $category)
						@if($loop->last)
							{{$category->name}}
						@else
							{{$category->name . ' |'}}
						@endif
					@endforeach
				</h3>
				<div class="votes">
					@if ($average_vote)
						@for ($i = 0; $i < $average_vote; $i++)
							<i class='fas fa-star'></i>   
						@endfor
					@else <span>No raiting</span>
					@endif 
				</div>
				@if ($my_profile)
					<p>{{ $my_profile->work_town }}</p>  
				@endif
			</div>
		</div>
	</div>
</div>

        