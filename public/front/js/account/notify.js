function allMarkAsRead() {
    let btn = document.querySelector('#btnAllMark')
    btn.addEventListener('click', (e) => {
        e.preventDefault
        btn.setAttribute('data-kt-indicator', 'on')

        $.ajax({
            url: '/account/notify/markAllRead',
            success: () => {
                btn.removeAttribute('data-kt-indicator')
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
    let btn = document.querySelector('#btnAllTrash')
    btn.addEventListener('click', (e) => {
        e.preventDefault
        btn.setAttribute('data-kt-indicator', 'on')

        $.ajax({
            url: '/account/notify/allTrash',
            success: () => {
                btn.removeAttribute('data-kt-indicator')
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
