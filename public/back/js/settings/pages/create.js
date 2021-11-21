new SimpleMDE({
    element: document.getElementById("editor")
})

$("#form_add_page").on('submit', e => {
    e.preventDefault()

    let form = $("#form_add_page")
    let btn = form.find('.btn-success')
    let uri = '/api/back/settings/cms/add'
    let data = form.serializeArray()

    btn.attr('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: "POST",
        data: data,
        success: data => {
            btn.removeAttr('data-kt-indicator')
            toastr.success(`La page <strong>${data.title}</strong> à été ajouter avec succès`)
            setTimeout(() => {
                window.location.href='/backoffice/settings/pages'
            }, 1900)
            console.log(data)
        },
        error: err => {
            btn.removeAttr('data-kt-indicator')
            toastr.error("Erreur lors de l'ajout de la page")
            console.error(err)
        }
    })
})
