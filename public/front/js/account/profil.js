let app = document.querySelector('#profile')
let user_id = app.dataset.id

function updateNumberComments(data) {
    let numberComment = app.querySelector('.numbercomment')
    let calc = data.user.blogcomments.length + data.user.downloadcomments.length
    if (calc !== 0)
        numberComment.innerHTML = calc
    else
        numberComment.innerHTML = 'Aucun Commentaire'
}

function updateUser() {
    $("#formUpdateUser").on('submit', (e) => {
        e.preventDefault()
        let form = $("#formUpdateUser")
        let url = form.attr('action')
        let btn = KTUtil.getById('btnFormUpdateUser')
        let data = form.serializeArray()

        KTUtil.btnWait(btn, 'spinner spinner-right spinner-white pr-15', 'Veuillez patientez...')

        $.ajax({
            url: url,
            method: 'PUT',
            data: data,
            success: (data) => {
                KTUtil.btnRelease(btn)
                toastr.success('Mise à jour de profil', 'Votre profil à été mise à jours')
            },
            error: (err) => {
                KTUtil.btnRelease(btn)
                toastr.error("Erreur Système", "Une erreur à eu lieu lors de la mise à jour de votre profil")
            }
        })
    })
}

function getUser() {
    KTApp.block(app)

    $.ajax({
        url: '/api/user/' + user_id,
        method: 'GET',
        success: (data) => {
            KTApp.unblock(app)
            //execute Other Function
            console.log(data)
            updateNumberComments(data)
        },
        error: (err) => {
            console.error(err)
        }
    })
}

function init() {
    getUser()
    updateUser()
    $('.summernote').summernote({
        height: 150
    });
}

init()
