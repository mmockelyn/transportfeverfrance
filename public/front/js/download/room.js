var listener = new window.keypress.Listener();
let divAuthor = document.querySelector('#list_author')
let divRoom = document.querySelector('#room')
let slug = document.querySelector('.ticket').dataset.downloadSlug
let ticket_id = document.querySelector('.ticket').dataset.ticketId
let close_btn = document.querySelector('.closeticket')
const infos = {};

function getInfoTicket() {
    $.ajax({
        url: `/api/download/${slug}/ticket/${ticket_id}`,
        success: (data) => {
            console.log(data)
            infos.ticket = data.ticket
            infos.download = data.download
            infos.rooms = data.rooms
            setInterval(() => {
                showListAuthor()
            }, 30000)
            setInterval(() => {
                showRoom()
            }, 1000)
        },
        error: (err) => {
            console.error(err)
        }
    })
}

function showListAuthor() {
    divAuthor.innerHTML = ``
    Array.from(infos.download.users).forEach((user) => {
        let img = (user.avatar === null) ? '<img alt="Pic" src="' + user.avatar + '">' : '<img alt="Pic" src="' + user.avatar + '">'
        let last_seen = (user.last_seen === null) ? 'Jamais' : moment(user.last_seen).fromNow();

        divAuthor.innerHTML += `
           <div class="d-flex align-items-center justify-content-between mb-5">
               <div class="d-flex align-items-center">
                   <div class="symbol symbol-50 mr-3">
                       ${img}
                   </div>
                   <div class="d-flex flex-column">
                       <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">${user.name}</a>
                       <span class="text-muted font-weight-bold font-size-sm">${user.email}</span>
                   </div>
               </div>
               <div class="d-flex flex-column align-items-end">
                   <span class="text-muted font-weight-bold font-size-sm">${last_seen}</span>
               </div>
           </div>
        `
    })
}

function showRoom() {
    divRoom.innerHTML = ``
    Array.from(infos.rooms).forEach((room) => {
        let img = ((room.author_id !== null) ? (room.author.avatar === null) ? '<img alt="Pic" src="' + room.author.avatar + '">' : '<img alt="Pic" src="' + room.author.avatar + '">' : (room.user.avatar === null) ? '<img alt="Pic" src="' + room.user.avatar + '">' : '<img alt="Pic" src="' + room.user.avatar + '">')

        divRoom.innerHTML += `
           <div class="d-flex flex-column mb-5 ${(room.author_id !== null) ? 'align-items-start' : 'align-items-end'}">
               <div class="d-flex align-items-center">
                   <div class="symbol symbol-circle symbol-40 mr-3">
                       ${img}
                   </div>
                   <div>
                       <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">${(room.author_id !== null) ? room.author.name : 'Vous'}</a>
                       <span class="text-muted font-size-sm">${moment(room.updated_at).fromNow()}</span>
                   </div>
               </div>
               <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">${room.message}</div>
           </div>
        `
    })
}

function composer() {
    let form = $("#formConverse")
    let btn = KTUtil.getById('formSubmit')
    let url = form.attr('action')
    let data = form.serializeArray()

    KTUtil.btnWait(btn, 'spinner spinner-dark spinner-right pr-15', 'Chargement...')

    $.ajax({
        url: url,
        method: "POST",
        data: data,
        success: (data) => {
            KTUtil.btnRelease(btn)
            getInfoTicket()
        },
        error: (err) => {
            KTUtil.btnRelease(btn)
            toastr.error("Erreur Serveur", "Une erreur à eu lieu lors de l'envoie de votre message.")
            console.error(err)
        }
    })
}

function close_ticket() {
    let btn = KTUtil.getById('closeticket')

    KTUtil.btnWait(btn, 'spinner spinner-dark spinner-right pr-15')

    $.ajax({
        url: `/api/download/${slug}/ticket/${ticket_id}/close`,
        method: "GET",
        success: (data) => {
            KTUtil.btnRelease(btn)
            window.location.href = '/download/'+slug
        },
        error: (err) => {
            KTUtil.btnRelease(btn)
            toastr.error("Erreur Système", "Erreur lors de la cloture du ticket")
            console.error(err)
        }
    })
}

$("#formConverse").on('submit', (e) => {
    composer()
})

listener.simple_combo("ctrl enter", (e) => {
    composer()
})

close_btn.addEventListener('click', (e) => {
    e.preventDefault()
    close_ticket()
})


getInfoTicket()
