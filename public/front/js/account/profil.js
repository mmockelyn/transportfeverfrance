let app = document.querySelector('#profile')
let user_id = app.dataset.id

function getUser() {
    KTApp.block(app)

    $.ajax({
        url: '/api/user/'+user_id,
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

function updateNumberComments(data) {
    let numberComment = app.querySelector('.numbercomment')
    let calc = data.user.blogcomments.length + data.user.downloadcomments.length
    if(calc !== 0)
        numberComment.innerHTML = calc
    else
        numberComment.innerHTML = 'Aucun Commentaire'
}

function init() {
    getUser()
}

init()
