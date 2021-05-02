@props(['comment'])

<div class="media mt-3 comment">
    <img class="align-self-center avatar mr-3" src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get($comment->user->email) }}" alt="{{ $comment->user->email }}">
    <div class="media-body">
        <div class="row">
            <div class="col-6 fw-bolder">{{ $comment->user->name }}</div>
            <div class="col-6">
                <div class="text-right text-muted">{{ formatDateHour($comment->created_at) }}</div>
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if($comment->depth < config('app.commentsNestedLevel'))
                        <a href="#" class="btn btn-primary btn-icon replycomment"
                           data-name="{{ $comment->user->name }}"
                           data-id="{{ $comment->id }}"
                           data-toggle="tooltip"
                           data-theme="dark"
                           title="Répondre"
                        ><i class="fa fa-reply"></i> </a>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->name == $comment->user->name)
                            <a href="{{ route('front.blog.comment.destroy', $comment->id) }}" class="btn btn-danger deletecomment"
                               data-toggle="tooltip"
                               data-theme="dark"
                               title="Supprimer le commentaire"
                            ><i class="fa fa-trash-o"></i> </a>
                    @endif
                @endif
            </div>
        </div>
        <p>{{ $comment->content }}</p>
        <x-front.comments :comments="$comment->children"/>
    </div>
</div>

