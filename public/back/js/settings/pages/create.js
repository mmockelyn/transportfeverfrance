let quill = new Quill('#contents', {
    modules: {
        toolbar: [
            [{
                header: [1, 2, 3, 4, false]
            }],
            ['bold', 'italic', 'underline', 'align', 'background', "color", "blockquote"],
            ['image', 'code-block', 'video']
        ]
    },
    placeholder: 'Type your text here...',
    theme: 'snow' // or 'bubble'
});

$("#form_add_page").on('submit', e => {
    e.preventDefault()

    let form = $("#form_add_page")
    let btn = form.find('.btn-success')
    let uri = '/api/back/settings/cms/add'
    let data = form.serializeArray()

    let b_contents = $("#contents")
    let a_contents = $("#over_content")

    a_contents.val(b_contents.find('.ql-editor').html())

    console.log(a_contents.html())

    btn.attr('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: "POST",
        data: {"title": document.querySelector('[name="title"]').value, "body": b_contents.find('.ql-editor').html()},
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
