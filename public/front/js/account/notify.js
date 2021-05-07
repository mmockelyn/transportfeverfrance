function allMarkAsRead() {
    let btn = KTUtil.getById('btnAllMark')
    btn.addEventListener('click', (e) => {
        e.preventDefault
        KTUtil.btnWait(btn, 'spinner spinner-right spinner-white pr-15', 'Veuillez patientez...')

        $.ajax({
            url: '/account/notify/markAllRead',
            success: () => {
                window.location.reload()
            },
            error: (err) => {
                KTUtil.btnRelease(btn)
                toastr.error("Erreur lors de la mise à jours des notifications")
            }
        })
    })
}

function allTrash() {
    let btn = KTUtil.getById('btnAllTrash')
    btn.addEventListener('click', (e) => {
        e.preventDefault
        KTUtil.btnWait(btn, 'spinner spinner-right spinner-white pr-15', 'Veuillez patientez...')

        $.ajax({
            url: '/account/notify/allTrash',
            success: () => {
                window.location.reload()
            },
            error: (err) => {
                KTUtil.btnRelease(btn)
                toastr.error("Erreur lors de la mise à jours des notifications")
            }
        })
    })
}

function init() {
    allMarkAsRead()
    allTrash()

    $("#tableNotification").on('click', '.checknotif', (e) => {
        $.ajax({
            url: '/account/notify/'+e.target.dataset.notifId+'/read',
            success: (data) => {
                e.target.parentNode.parentNode.classList.remove('bg-light-primary')
            },
            error: (err) => {
                KTUtil.btnRelease(btn)
                toastr.error("Erreur lors de la mise à jours des notifications")
            }
        })
    })

    $("#tableNotification").on('click', '.deletenotif', (e) => {
        $.ajax({
            url: '/account/notify/'+e.target.dataset.notifId+'/trash',
            method: 'DELETE',
            success: (data) => {
                e.target.parentNode.parentNode.remove()
                console.log(data)
            },
            error: (err) => {
                KTUtil.btnRelease(btn)
                toastr.error("Erreur lors de la mise à jours des notifications")
            }
        })
    })
}

init()
