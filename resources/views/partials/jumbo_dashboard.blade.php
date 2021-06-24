@php
    $my_user 	= Auth::user();
    $my_profile = Auth::user()->profile;
    
    $votes = $my_profile->user->reviews;
    // Set average vote to false
    $average_vote = false;
    // If collection of votes is not empty
    if($votes->isNotEmpty()) {
        // Set average vote to 0 so I can start adding the votes found
        $average_vote = 0;
        // Keeps track of number of votes
        $counter = 0;
        foreach($votes as $vote) {
            // For each vote add +1 to counter
            $counter++;
            // Update average vote
            $average_vote += $vote->rev_vote;
        }
        // When for loop ends, do average and round the result
        $average_vote = round($average_vote / $counter);
    }
@endphp

{{-- JUMBOTRON DASHBOARD --}}
<div class="jumbo-dash container-fluid">
    <div class="row jumbo_height">
        <div class="over-jumbo d-block d-xl-none"></div>
        <div class="container jumbo_height">
            
            <span class="diagonal"></span>
            <div class="jumbo_img jumbo_height d-none d-lg-block">
                <img class="jumbo_height" src="{{asset('storage/'.$my_profile->image_url)}}" alt="">
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

        