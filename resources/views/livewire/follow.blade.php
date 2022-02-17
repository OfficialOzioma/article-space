<div>
    <div class="d-flex justify-content-between align-items-center mt-4 px-4">
        <div class="row text-center m-t-20">
            <p class="mb-2">
                <small>Following:
                    <span class="badge badge rounded-pill bg-success">{{ $user->followings()->get()->count() }}</span>
                </small>
                <small>Followers:
                    <span
                        class="badge badge rounded-pill bg-success tl-follower">{{ $user->followers()->get()->count() }}</span>
                </small>
                <small>Articles:
                    <span class="badge rounded-pill bg-success">{{ $articlesCount }}</span>
                </small>
            </p>
        </div>
    </div>
    <div class="d-flex mt-4">
        <div class=" p-3">
            @if ($authicated_User ?? '' == true)
                <a href="{{ route('profile.settings', $user->username) }}">
                    <button class="btn btn-outline-secondary ">
                        Edit Profile
                    </button>
                </a>
            @else
                <button type="button" class="btn btn-outline-secondary" wire:click="follow" wire:loading.attr="disabled">
                    <strong>
                        {{ $following ? 'Unfollow' : 'Follow' }}
                    </strong>
                    <span wire:loading>
                        Please wait...
                    </span>
                </button>
            @endif
        </div>
        <div class=" p-3">
            <button type="button" class="btn btn-outline-success position-relative">
                <i class="fa fa-envelope" aria-hidden="true"></i> Chat
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    0
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
        </div>
    </div>
</div>
