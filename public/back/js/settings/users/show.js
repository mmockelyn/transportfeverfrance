document.querySelectorAll('.btnProvider').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault()
        if(btn.dataset.action === 'connect') {
            btn.setAttribute("data-kt-indicator", "on")
            window.location.href='/login/'+btn.dataset.provider
        } else {

        }
    })
})
