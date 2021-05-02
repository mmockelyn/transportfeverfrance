@props(['comment'])

@foreach($download->comments as $comment)
    <div class="media mt-3 comment">
        @if($comment->user->avatar)
            <img class="align-self-center avatar mr-3" src="{{ $comment->user->avatar }}" alt="{{ $comment->user->email }}">
        @else
            <img class="align-self-center avatar mr-3" src="{{ \Creativeorange\Gravatar\Facades\Gravatar::get($comment->user->email) }}" alt="{{ $comment->user->email }}">
        @endif
        <div class="media-body">
            <div class="row">
                <div class="col-6 fw-bolder">
                    {{ $comment->user->name }}
                    @if(\Illuminate\Support\Facades\Auth::check())
                        @if($comment->depth < config('app.commentsNestedLevel'))
                            <button class="btn btn-xs btn-primary btn-icon replycomment"
                                    data-name="{{ $comment->user->name }}"
                                    data-id="{{ $comment->id }}"
                                    data-toggle="tooltip"
                                    data-theme="dark"
                                    title="Répondre"
                            ><i class="fa fa-reply"></i></button>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::user()->name == $comment->user->name)
                            <button class="btn btn-xs btn-danger btn-icon deletecomment"
                                    data-toggle="tooltip"
                                    data-theme="dark"
                                    title="Supprimer le commentaire"
                            ><i class="fas fa-trash"></i></button>
                        @endif
                    @endif
                </div>
                <div class="col-6">
                    <div class="text-right text-muted">{{ formatDateHour($comment->created_at) }}</div>
                </div>
            </div>
            <p>{{ $comment->content }}</p>
            <x-front.comments :comments="$comment->children"/>
        </div>
    </div>
@endforeach

