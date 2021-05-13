jQuery(document).ready(function() {
    document.querySelectorAll('.btn-default').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault()

            $.ajax({
                url: '/account/messagerie/'+btn.dataset.messageId,
                method: 'DELETE',
                success: (data) => {
                    window.location.href='/account/messagerie'
                }
            })
        })
    })

    $("#kt_inbox_compose_form").on('submit', (e) => {
        e.preventDefault()
        let form = $("#kt_inbox_compose_form")
        let url = form.attr('action')
        let btn = KTUtil.getById('btnEnvoye')
        let data = form.serializeArray()

        KTUtil.btnWait(btn, 'spinner', 'Envoie en cours...')

        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: (data) => {
                KTUtil.btnRelease(btn)
                toastr.success('Votre message à bien été envoyer')
                form[0].reset()
                $("#compose").modal('hide')
            },
            error: (err) => {
                KTUtil.btnRelease(btn)
                console.error(err)
                toastr.error("Erreur lors de l'envoie de votre message")
            }
        })
    })
});
