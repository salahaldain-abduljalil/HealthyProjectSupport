@include('frontend.partial.head')

<div class="d-flex mb-4 comment-card" data-id="{{ $comments->id }}">
    <img src="img/user.jpg" class="img-fluid rounded-circle" style="width: 45px; height: 45px;">
    <div class="ps-3">
        <h6><a href="">{{ $comments->user_id }}</a>
            <small><i>{{ \Carbon\Carbon::parse($comments->created_at)->diffForHumans() }}</i></small>
        </h6>
        <p>{{ $comments->long_descp }}</p>
        <button class="btn btn-sm btn-light" onclick="toggleElement();">رد</button>
    </div>
</div>

@include('frontend.partial.scripts')
