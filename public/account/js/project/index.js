const toastElement = document.getElementById('toastElement');
const toast = bootstrap.Toast.getOrCreateInstance(toastElement);
const currentdate = new Date()
const time = currentdate.getDay() + "/" + currentdate.getMonth()
    + "/" + currentdate.getFullYear() + " à "
    + currentdate.getHours() + ":"
    + currentdate.getMinutes() + ":" + currentdate.getSeconds();

function getToast(type, time, message) {
    switch (type) {
        case 'info':
            toastElement.querySelector('.toast-header').classList.add('bg-info');
            toastElement.querySelector('.svg-icon').innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                <rect x="11" y="17" width="7" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
                <rect x="11" y="9" width="2" height="2" rx="1" transform="rotate(-90 11 9)" fill="black"/>
            </svg>
            `
            toastElement.querySelector('.me-auto').innerHTML = "Information"
            toastElement.querySelector('.toast-body').classList.add('bg-light-info');
            break;

        case 'success':
            toastElement.querySelector('.toast-header').classList.add('bg-success');
            toastElement.querySelector('.toast-header').classList.add('text-white');
            toastElement.querySelector('.svg-icon').classList.add('svg-icon-light')
            toastElement.querySelector('.svg-icon').innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black"/>
            </svg>
            `
            toastElement.querySelector('.me-auto').innerHTML = "Succès"
            toastElement.querySelector('.toast-body').classList.add('bg-light-success');
            break

        case 'warning':
            toastElement.querySelector('.toast-header').classList.add('bg-warning');
            toastElement.querySelector('.toast-header').classList.add('text-white');
            toastElement.querySelector('.svg-icon').classList.add('svg-icon-light')
            toastElement.querySelector('.svg-icon').innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"/>
                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"/>
            </svg>
            `
            toastElement.querySelector('.me-auto').innerHTML = "Attention"
            toastElement.querySelector('.toast-body').classList.add('bg-light-warning');
            break

        case 'error':
            toastElement.querySelector('.toast-header').classList.add('bg-danger');
            toastElement.querySelector('.toast-header').classList.add('text-white');
            toastElement.querySelector('.svg-icon').classList.add('svg-icon-light')
            toastElement.querySelector('.svg-icon').innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"/>
                <rect x="7" y="15.3137" width="12" height="2" rx="1" transform="rotate(-45 7 15.3137)" fill="black"/>
                <rect x="8.41422" y="7" width="12" height="2" rx="1" transform="rotate(45 8.41422 7)" fill="black"/>
            </svg>
            `
            toastElement.querySelector('.me-auto').innerHTML = "Erreur"
            toastElement.querySelector('.toast-body').classList.add('bg-light-danger');
            break
    }

    toastElement.querySelector('.toast-body').innerHTML = message.message
    toastElement.querySelector('#small').innerHTML = time;

    toast.show()

}

document.querySelector('.btn-warning').addEventListener('click', (e) => {
    e.preventDefault()
    let btn = document.querySelector('.btn-warning')

    btn.setAttribute('data-kt-indicator', 'on')

    $.ajax({
        url: `/account/project/register`,
        method: "POST",
        data: {"email": btn.dataset.email},
        success: data => {
            btn.removeAttribute('data-kt-indicator')
            getToast('success', time, data)
        },
        error: data => {
            btn.removeAttribute('data-kt-indicator')
            getToast('error', time, data)
        }
    })
});

$("#list_account_project").DataTable({
    language: {
        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
    },
})
