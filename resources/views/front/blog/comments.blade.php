<h3>
    Commentaires ({{ count($comments) }})
</h3>
@if(\Illuminate\Support\Facades\Auth::guest())
    <div class="alert alert-custom alert-danger" role="alert">
        <div class="alert-icon">
            <i class="flaticon-cancel"></i>
        </div>
        <div class="alert-text">Vous devez être <a href="{{ route('login') }}">connecter</a> pour publier un commentaire</div>
    </div>
@else
    <div class="h3 fw-bold">Nouveau commentaire
        <span id="forName"></span>
        <span><a id="abort" hidden href="#">Annuler la réponse</a></span>
    </div>
    <div id="alert" class="alert" role="alert" style="display: none">
        <p></p>
        <span class="alert-box__close"></span>
    </div>
    <form action="{{ route('front.blog.comment.store', $blog->id) }}" id="messageForm" method="post" autocomplete="off">
        <input type="hidden" id="commentId" name="commentId" value="">
        <input type="hidden" id="blogId" name="blogId" value="{{ $blog->id }}">
        <textarea name="message" id="message" class="form-control" cols="30" rows="10"></textarea>

        <button type="submit" class="btn btn-outline-success btn-block">Ajouter un commentaire</button>
    </form>
@endif

<div class="commentList">
    <x-front.comments :comments="$comments"></x-front.comments>
</div>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        (() => {
            // Variables
            const headers = {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
            const commentId = document.getElementById('commentId');
            const alert = document.getElementById('alert');
            const message = document.getElementById('message');
            const forName = document.getElementById('forName');
            const abort = document.getElementById('abort');
            const commentIcon = document.getElementById('commentIcon');
            const forSubmit = document.getElementById('forSubmit');
            const blogId = document.getElementById('commentId');
            // Add comment
            const addComment = async e => {
                e.preventDefault();
                // Get datas
                const datas = {
                    message: message.value
                };
                if(document.querySelector('#commentId').value !== '') {
                    datas['commentId'] = commentId.value;
                }
                // Icon
                commentIcon.hidden = false;
                forSubmit.hidden = true;
                // Send request
                const response = await fetch(`front/blog/${blogId}/comments`, {
                    method: 'POST',
                    headers: headers,
                    body: JSON.stringify(datas)
                });
                // Wait for response
                const data = await response.json();
                // Icon
                commentIcon.hidden = true;
                forSubmit.hidden = false;
                // Manage response
                if (response.ok) {
                    purge();
                    if(data == 'ok') {
                        showComments();
                        showAlert('success', 'Votre commentaire à bien été envoyée');
                    } else {
                        showAlert('info', "@lang(`Merci pour votre commentaire. Il apparaîtra lorsqu'un administrateur l'aura validé. Une fois que vous êtes validé, vos autres commentaires apparaissent immédiatement.`)");
                    }
                } else {
                    if(response.status == 422) {
                        showAlert('error', data.errors.message[0]);
                    } else {
                        errorAlert();
                    }
                }
            }
            const errorAlert = () =>  Swal.fire({
                icon: 'error',
                title: '@lang('Whoops!')',
                text: '@lang('Something went wrong!')'
            });
            // Show alert
            const showAlert = (type, text) => {
                alert.style.display = 'block';
                alert.className = '';
                alert.classList.add('alert-box', 'alert-' + type);
                alert.firstChild.textContent = text;
            }
            // Hide alert
            const hideAlert = () => alert.style.display = 'none';
            // Prepare show comments
            const prepareShowComments = e => {
                e.preventDefault();
                document.getElementById('showbutton').toggleAttribute('hidden');
                document.getElementById('showicon').toggleAttribute('hidden');
                showComments();
            }
            // Show comments
            const showComments = async () => {
                // Send request
                const response = await fetch(`front/blog/${blogId}/comments`, {
                    method: 'GET',
                    headers: headers
                });
                // Wait for response
                const data = await response.json();
                document.getElementById('commentsList').innerHTML = data.html;
                @if(\Illuminate\Support\Facades\Auth::check())
                document.getElementById('respond').hidden = false;
                @endif
            }
            // Reply to comment
            const replyToComment = e => {
                e.preventDefault();
                forName.textContent = `Répondre à ${e.target.dataset.name}`;
                commentId.value = e.target.dataset.id;
                abort.hidden = false;
                message.focus();
            }
            // Abort reply
            const abortReply = (e) => {
                e.preventDefault();
                purge();
            }
            // Purge reply
            const purge = () => {
                forName.textContent = '';
                commentId.value = '';
                message.value = '';
                abort.hidden = true;
            }
            // Delete comment
            const deleteComment = async e => {
                e.preventDefault();
                Swal.fire({
                    title: '@lang('Voulez-vous vraiment supprimer le commentaire?')',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui",
                    cancelButtonText: "Non",
                    preConfirm: () => {
                        return fetch(e.target.getAttribute('href'), {
                            method: 'DELETE',
                            headers: headers
                        })
                            .then(response => {
                                if (response.ok) {
                                    showComments();
                                } else {
                                    errorAlert();
                                }
                            });
                    }
                });
            }
            // Listener wrapper
            const wrapper = (selector, type, callback, condition = 'true', capture = false) => {
                const element = document.querySelector(selector);
                if(element) {
                    document.querySelector(selector).addEventListener(type, e => {
                        if(eval(condition)) {
                            callback(e);
                        }
                    }, capture);
                }
            };
            // Set listeners
            window.addEventListener('DOMContentLoaded', () => {
                wrapper('#showcomments', 'click', prepareShowComments);
                wrapper('#abort', 'click', abortReply);
                wrapper('#message', 'focus', hideAlert);
                wrapper('#messageForm', 'submit', addComment);
                wrapper('#commentsList', 'click', replyToComment, "e.target.matches('.replycomment')");
                wrapper('#commentsList', 'click', deleteComment, "e.target.matches('.deletecomment')");
            })
        })()
    </script>
@endsection

