$(".form_edit_social_provider").on('submit', e => {
    e.preventDefault()

    let form = $(".form_edit_social_provider")
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
            toastr.success("Les providers sociaux ont été mis à jours")
        },
        error: err => {
            btn.removeAttr('data-kt-indicator')
            toastr.error("Erreur lors de la mise à jour des providers sociaux")
        }
    })
})

