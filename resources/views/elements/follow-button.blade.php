@if(!Auth::check())
    <button class="btn btn-warning disabled" user-id="{{ $user->id }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Suivre </button>
@else
    @if(userFollowedByUser($user))
    <button class="btn btn-danger unfollow" user-id="{{ $user->id }}"><i class="fa fa-user-times" aria-hidden="true"></i> Ne plus suivre </button>
    @else
        @if(Auth::user()->id != $user->id)
            <button class="btn btn-warning follow" user-id="{{ $user->id }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Suivre </button>
        @endif
    @endif
@endif