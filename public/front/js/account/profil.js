let app = document.querySelector('#profile')
let tableDownload = document.querySelector('#listDownloadComment')
//let tableBlog = document.querySelector('#listDownloadComment')
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

function updatePassword() {
    $("#formPasswordUpdate").on('submit', (e) => {
        e.preventDefault()
        let form = $("#formPasswordUpdate")
        let url = form.attr('action')
        let btn = KTUtil.getById('btnFormPassUpdate')
        let data = form.serializeArray()

        KTUtil.btnWait(btn, 'spinner spinner-right spinner-white pr-15', 'Veuillez patientez...')

        $.ajax({
            url: url,
            method: 'PUT',
            data: data,
            statusCode: {
                200: (data) => {
                    KTUtil.btnRelease(btn)
                    toastr.success('Mise à jour de profil', 'Votre mot de passe à été redéfinie.')
                    form[0].reset()
                },
                500: (err) => {
                    KTUtil.btnRelease(btn)
                    toastr.error('Erreur', 'Erreur lors de la mise à jour de votre mot de passe')
                },
                422: (err) => {
                    KTUtil.btnRelease(btn)
                    toastr.warning('Erreur de Validation', 'Certains champs sont en erreurs, veuillez revérifier les champs et revalider le formulaire')
                }
            }
        })
    })
}

function deleteAccount() {
    $("#formDeleteAccount").on('submit', (e) => {
        e.preventDefault()
        let form = $("#formDeleteAccount")
        let url = form.attr('action')
        let btn = KTUtil.getById('btnDeleteAccount')
        let data = form.serializeArray()

        KTUtil.btnWait(btn, 'spinner spinner-right spinner-white pr-15', 'Veuillez patientez...')

        $.ajax({
            url: url,
            method: 'DELETE',
            data: data,
            success: (data) => {
                KTUtil.btnRelease(btn)
                toastr.success("Votre compte sera supprimer dans 5 jours.", "Suppression de votre compte")
            },
            error: (err) => {
                KTUtil.btnRelease(btn)
                toastr.error("Erreur lors de la programmation de la suppression de votre compte, contactez un administrateur")
            }
        })
    })
}

function startTotp() {
    $("#btnStartTotp").on('click', (e) => {
        let btn = KTUtil.getById('btnStartTotp')

        KTUtil.btnWait(btn, 'spinner spinner-right spinner-white pr-15', 'Veuillez patientez...')

        $.ajax({
            url: '/user/two-factor-authentication',
            method: "POST",
            success: (data) => {
                KTUtil.btnRelease(btn)
                toastr.success(`L'authentification TOTP à été activé`)
                $("#btnStartTotp").attr('id', 'btnEndTotp')
                $("#btnStartTotp").removeClass('btn-success')
                $("#btnStartTotp").addClass('btn-danger')
                $("#btnStartTotp").html('<i class="fas fa-unlock"></i> Désactiver l\'authentification TOTP')
                $.ajax({
                    url: '/user/two-factor-qr-code',
                    success: (data) => {
                        $("#contentSvgQrCode").html('<p>Veuillez télécharger Google Authenticator ou un autre Programme TOTP et scanner le QR Code ci-dessous:</p>'+data.svg)
                    },
                    error: (err) => {
                        console.error(err)
                    }
                })
                stopTotp()
            },
            error: (err) => {
                KTUtil.btnRelease(btn)
                console.error(err)
            }
        })
    })
}

function stopTotp() {
    $("#btnEndTotp").on('click', (e) => {
        let btn = KTUtil.getById('btnEndTotp')

        KTUtil.btnWait(btn, 'spinner spinner-right spinner-white pr-15', 'Veuillez patientez...')

        $.ajax({
            url: '/user/two-factor-authentication',
            method: "DELETE",
            success: (data) => {
                KTUtil.btnRelease(btn)
                toastr.success(`L'authentification TOTP à été désactiver`)
                btn.attr('id', 'btnStartTotp')
                btn.removeClass('btn-danger')
                btn.addClass('btn-success')
                btn.html('<i class="fas fa-lock"></i> Activer l\'authentification TOTP')
                startTotp()
            },
            error: (err) => {
                KTUtil.btnRelease(btn)
                console.error(err)
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

function loadDownloadComment()
{
    dt = $("#listDownloadComment").DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        order: [[5, 'desc']],
        stateSave: true,
        ajax: {
            url: "/api/list/download/comment/"+user_id,
        },
        columns: [
            { data: 'title' },
            { data: 'comment' },
            { data: 'date' },
            { data: null },
        ],
    })
}

function loadBlogComment()
{
    dt = $("#listblogComment").DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        order: [[5, 'desc']],
        stateSave: true,
        ajax: {
            url: "/api/list/blog/comment/"+user_id,
        },
        columns: [
            { data: 'title' },
            { data: 'comment' },
            { data: 'date' },
            { data: null },
        ],
    })
}

function init() {
    getUser()
    updateUser()
    updatePassword()
    deleteAccount()
    startTotp()
    stopTotp()
    loadDownloadComment()
    $('.summernote').summernote({
        height: 150
    });

    $(".pr-password").passwordRequirements({
        numCharacters: 6,
        useLowercase: true,
        useUppercase: true,
        useNumbers: true,
        useSpecial: true
    });

    $(".modal").on('hidden.bs.modal', (e) => {
        window.location.reload()
    })
}

init()
