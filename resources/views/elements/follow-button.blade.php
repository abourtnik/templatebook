@if(!Auth::check())
    <button class="btn btn-warning disabled">
        <i class="fa fa-user-plus" aria-hidden="true"></i>
        <span>Suivre</span>
    </button>
@else
    @if(userFollowedByUser($user))
    <button class="btn btn-danger unfollow" user-id="{{ $user->id }}">
        <i class="fa fa-user-times" aria-hidden="true"></i>
        <span>Ne plus suivre</span>
    </button>
    @else
        @if(Auth::user()->id != $user->id)
            <button class="btn btn-warning follow" user-id="{{ $user->id }}">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                <span>Suivre</span>
            </button>
        @endif
    @endif
@endif