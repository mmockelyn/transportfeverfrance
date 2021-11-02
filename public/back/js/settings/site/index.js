$("#form_edit_site").on('submit', e => {
    e.preventDefault()
    let form = $("#form_edit_site")
    let uri = form.attr('action')
    let btn = form.find('.btn-success')
    let data = form.serializeArray()

    btn.attr('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: "PUT",
        data: data,
        success: data => {
            btn.removeAttr('data-kt-indicator')
            toastr.success("La configuration du site à été modifier");
            setTimeout(() => {
                window.location.reload()
            }, 1900)
        },
        error: err => {
            btn.removeAttr('data-kt-indicator')
            toastr.error("Erreur lors de la mise à jour de la configuration du site!")
        }
    })
})
