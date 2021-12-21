let app = document.querySelector('#profile')
let tableDownload = document.querySelector('#listDownloadComment')
let templateDownload;
let datatableDownload;
//let tableBlog = document.querySelector('#listDownloadComment')
let user_id = app.dataset.id

let blockUI = new KTBlockUI(app);

function updateNumberComments(data) {
    let numberComment = app.querySelector('.numbercomment')
    let calc = data.user.blogcomments.length + data.user.downloadcomments.length
    if (calc !== 0) {
        numberComment.dataset.ktCountupValue = calc
        numberComment.innerHTML = calc
    }else {
        numberComment.dataset.ktCountupValue = 0
        numberComment.innerHTML = 0
    }
}

function updateUser() {
    $("#formUpdateUser").on('submit', (e) => {
        e.preventDefault()
        let form = $("#formUpdateUser")
        let url = form.attr('action')
        let btn = document.querySelector('#formUpdateUser').querySelector('.btn-success')
        let data = form.serializeArray()

        console.log(btn)
        btn.setAttribute('data-kt-indicator', 'on')

        $.ajax({
            url: url,
            method: 'PUT',
            data: data,
            success: (data) => {
                btn.removeAttribute('data-kt-indicator')
                toastr.success('Mise à jour de profil', 'Votre profil à été mise à jours')
            },
            error: (err) => {
                btn.removeAttribute('data-kt-indicator')
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
        let btn = document.querySelector('#formPasswordUpdate').querySelector('.btn-success')
        let data = form.serializeArray()

        btn.setAttribute('data-kt-indicator', 'on')

        $.ajax({
            url: url,
            method: 'PUT',
            data: data,
            statusCode: {
                200: (data) => {
                    btn.removeAttribute('data-kt-indicator')
                    toastr.success('Mise à jour de profil', 'Votre mot de passe à été redéfinie.')
                    form[0].reset()
                },
                500: (err) => {
                    btn.removeAttribute('data-kt-indicator')
                    toastr.error('Erreur', 'Erreur lors de la mise à jour de votre mot de passe')
                },
                422: (err) => {
                    btn.removeAttribute('data-kt-indicator')
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
        let btn = document.querySelector('#btnDeleteAccount')

        let data = form.serializeArray()

        btn.setAttribute('data-kt-indicator', 'on')

        $.ajax({
            url: url,
            method: 'DELETE',
            data: data,
            success: (data) => {
                btn.removeAttribute('data-kt-indicator')
                toastr.success("Votre compte sera supprimer dans 5 jours.", "Suppression de votre compte")
            },
            error: (err) => {
                btn.removeAttribute('data-kt-indicator')
                toastr.error("Erreur lors de la programmation de la suppression de votre compte, contactez un administrateur")
            }
        })
    })
}

function startTotp() {
    $("#btnStartTotp").on('click', (e) => {
        let btn = document.querySelector('#btnStartTotp')

        btn.setAttribute('data-kt-indicator', 'on')

        $.ajax({
            url: '/user/two-factor-authentication',
            method: "POST",
            success: (data) => {
                btn.removeAttribute('data-kt-indicator')
                toastr.success(`L'authentification TOTP à été activé`)
                $("#btnStartTotp").attr('id', 'btnEndTotp')
                $("#btnStartTotp").removeClass('btn-success')
                $("#btnStartTotp").addClass('btn-danger')
                $("#btnStartTotp").html(`
                <span class="indicator-label"><i class="fas fa-lock"></i> Désactiver l'authentification TOTP</span>
                <span class="indicator-progress">Veuillez patienter...</span>
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                `)
                $.ajax({
                    url: '/user/two-factor-qr-code',
                    success: (data) => {
                        $("#contentSvgQrCode").html('<p>Veuillez télécharger Google Authenticator ou un autre Programme TOTP et scanner le QR Code ci-dessous:</p>' + data.svg)
                    },
                    error: (err) => {
                        console.error(err)
                    }
                })
                stopTotp()
            },
            error: (err) => {
                btn.removeAttribute('data-kt-indicator')
                console.error(err)
            }
        })
    })
}

function stopTotp() {
    $("#btnEndTotp").on('click', (e) => {
        let btn = document.querySelector('#btnEndTotp')

        btn.setAttribute('data-kt-indicator', 'on')

        $.ajax({
            url: '/user/two-factor-authentication',
            method: "DELETE",
            success: (data) => {
                btn.removeAttribute('data-kt-indicator')
                toastr.success(`L'authentification TOTP à été désactiver`)
                btn.attr('id', 'btnStartTotp')
                btn.removeClass('btn-danger')
                btn.addClass('btn-success')
                btn.html(`
                <span class="indicator-label"><i class="fas fa-lock"></i> Activer l'authentification TOTP</span>
                <span class="indicator-progress">Veuillez patienter...</span>
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                `)
                startTotp()
            },
            error: (err) => {
                btn.removeAttribute('data-kt-indicator')
                console.error(err)
            }
        })
    })
}

function startNotificationPush() {
    $("#btnStartPushNotification").on('click', (e) => {
        e.preventDefault()
        let btn = KTUtil.getById('btnStartTotp')
        let id = $("#btnStartPushNotification").attr('data-user-id')

        KTUtil.btnWait(btn, 'spinner spinner-right spinner-white pr-15', 'Veuillez patientez...')

        $.ajax({
            url: `/api/user/${id}/mobile/activate`,
            method: "POST",
            success: (data) => {
                KTUtil.btnRelease(btn)
                toastr.success(`La notification Psuh mobile a été activer`)
                $("#btnStartPushNotification").attr('id', 'btnEndPushNotification')
                $("#btnStartPushNotification").removeClass('btn-success')
                $("#btnStartPushNotification").addClass('btn-danger')
                $("#btnStartPushNotification").html('<i class="fas fa-unlock"></i> Désactiver la notification Push Mobile')

                //stopTotp()
            },
            error: (err) => {
                KTUtil.btnRelease(btn)
                console.error(err)
            }
        })
    })
}

function getUser() {
    blockUI.block()

    $.ajax({
        url: '/api/user/' + user_id,
        method: 'GET',
        success: (data) => {
            blockUI.release()
            //execute Other Function
            console.log(data)
            updateNumberComments(data)
        },
        error: (err) => {
            console.error(err)
        }
    })
}

const initTableDownloadComment = () => {
    const tableRows = tableDownload.querySelectorAll('tbody tr')

    const subtable = document.querySelector('[data-kt-docs-datatable-subtable="subtable_template_download"]')
    templateDownload = subtable.cloneNode(true)
    templateDownload.classList.remove('d-none')

    subtable.parentNode.removeChild(subtable)

    datatableDownload = $(table).DataTable({
        "info": false,
        'order': [],
        "lengthChange": false,
        'pageLength': 6,
        'ordering': false,
        'paging': false,
        'columnDefs': [
            {orderable: false, targets: 0}, // Disable ordering on column 0 (checkbox)
            {orderable: false, targets: 2}, // Disable ordering on column 6 (actions)
            {orderable: true, targets: 1}, // Disable ordering on column 6 (actions)
        ]
    })

    datatableDownload.on('draw', () => {
        resetSubtableDownload()
        handleActionButtonDownload();
    })
}

const handleActionButtonDownload = () => {
    const buttons = document.querySelectorAll('[data-kt-docs-datatable-subtable="expand_row_download"]')

    buttons.forEach((button, index) => {
        button.addEventListener('click', e => {
            e.stopImmediatePropagation()
            e.preventDefault()

            let row = button.closest('tr')
            let rowClasses = ['isOpen', 'border-bottom-0']

            if (row.classList.contains('isOpen')) {
                while (row.nextSibling && row.nextSibling.getAttribute('data-kt-docs-datatable-subtable') == 'subtable_template_download') {
                    row.nextSibling.parentNode.removeChild(row.nextSibling);
                }

                row.classList.remove(...rowClasses)

                button.classList.remove('active')
            } else {
                populateTemplateDownload(dataDownload, row)
                row.classList.add(...rowClasses)
                button.classList.add('active')
            }
        })
    })
}

const populateTemplateDownload = (data, target) => {
    data.forEach((d, index) => {
        const newTemplateDownload = templateDownload.cloneNode(true)

        const comment = newTemplateDownload.querySelector('[data-kt-docs-datatable-subtable="template_download_comment"]')

        comment.innerHTML = d.comment

        if (data.length === 1) {
            let borderClasses = ['rounded', 'rounded-end-0'];

            newTemplateDownload.querySelectorAll('td')[0].classList.add(...borderClasses)

            newTemplateDownload.classList.add('border-bottom-0');
        } else {
            if (index === (data.length - 1)) {
                let borderClasses = ['rounded-start', 'rounded-bottom-0'];
                newTemplateDownload.querySelectorAll('td')[0].classList.add(...borderClasses);
            }

            if (index === 0) {
                let borderClasses = ['rounded-start', 'rounded-top-0'];
                newTemplateDownload.querySelectorAll('td')[0].classList.add(...borderClasses);
                newTemplateDownload.classList.add('border-bottom-0');
            }
        }

        const tbody = tableDownload.querySelector('tbody')

        tbody.insertBefore(newTemplateDownload, target.nextSibling)
    });
}

const resetSubtableDownload = () => {
    const subtable = document.querySelectorAll('[data-kt-docs-datatable-subtable="subtable_template_download"]')

    subtable.forEach(st => {
        st.parentNode.removeChild(st)
    });

    const rows = tableDownload.querySelectorAll('tbody tr')

    rows.forEach(r => {
        r.classList.remove('isOpen')
        if(r.querySelector('[data-kt-docs-datatable-subtable="expand_row"]')) {
            r.querySelector('[data-kt-docs-datatable-subtable="expand_row"]').classList.remove('active');
        }
    })
}

function loadBlogComment() {
    dt = $("#listblogComment").DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        order: [[5, 'desc']],
        stateSave: true,
        ajax: {
            url: "/api/list/blog/comment/" + user_id,
        },
        columns: [
            {data: 'title'},
            {data: 'comment'},
            {data: 'date'},
            {data: null},
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
    startNotificationPush()
    //loadDownloadComment()

    $(".modal").on('hidden.bs.modal', (e) => {
        window.location.reload()
    })

}

new SimpleMDE({
    element: document.getElementById("editor")
})

init()
