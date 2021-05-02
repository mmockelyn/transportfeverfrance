$(document).ready(function() {
    var bigimage = $("#big");
    var thumbs = $("#thumbs");
    //var totalslides = 10;
    var syncedSecondary = true;

    bigimage
        .owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: true,
            autoplay: true,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
            ]
        })
        .on("changed.owl.carousel", syncPosition);

    thumbs
        .on("initialized.owl.carousel", function() {
            thumbs
                .find(".owl-item")
                .eq(0)
                .addClass("current");
        })
        .owlCarousel({
            items: 4,
            dots: true,
            nav: true,
            navText: [
                '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
            ],
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: 4,
            responsiveRefreshRate: 100
        })
        .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        //if loop is set to false, then you have to uncomment the next line
        //var current = el.item.index;

        //to disable loop, comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }
        //to this
        thumbs
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = thumbs.find(".owl-item.active").length - 1;
        var start = thumbs
            .find(".owl-item.active")
            .first()
            .index();
        var end = thumbs
            .find(".owl-item.active")
            .last()
            .index();

        if (current > end) {
            thumbs.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
            thumbs.data("owl.carousel").to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            bigimage.data("owl.carousel").to(number, 100, true);
        }
    }

    thumbs.on("click", ".owl-item", function(e) {
        e.preventDefault();
        var number = $(this).index();
        bigimage.data("owl.carousel").to(number, 300, true);
    });
    var sticky = new Sticky('.sticky');
});

$("#formPostComment").on('submit', (e) => {
    e.preventDefault()
    let form = $("#formPostComment")
    let url = form.attr('action')
    let btn = KTUtil.getById('btnForm')
    let data = form.serializeArray()

    KTUtil.btnWait(btn, 'spinner spinner-dark spinner-right pr-15', 'Chargement...')

    $.ajax({
        url: url,
        method: "POST",
        data: data,
        success: (data) => {
            KTUtil.btnRelease(btn)
            window.location.reload();
        },
        error: (err) => {
            KTUtil.btnRelease(btn)
            toastr.error("Erreur Serveur", "Impossible de publier le commentaire.")
        }
    })
})

document.querySelectorAll('.reportcomment').forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault()

        Swal.fire({
            title: "Êtes-vous sur ?",
            text: "Vous allez reporter ce commentaire. Le reportage de commentaire est uniquement pris en compte si vous juger que les propos de ce commentaire sont inaproprier.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Oui, Reporter",
            cancelButtonText: "Non, Annuler!",
            reverseButtons: !0,
            showLoaderOnConfirm: true,
            preConfirm: ()=>{
                $.ajax({
                    url: `/download/${btn.dataset.downloadSlug}/comment/${btn.dataset.commentId}/report`,
                    method: 'GET',
                    data:{},
                    success: function(resp)
                    {
                        if(resp) return "ok",
                            swal(
                                'Rapport envoyer !',
                                'Ce commentaire à bien été signaler !',
                                'success'
                            ).then(function() {
                                swal(
                                    'Erreur',
                                    'Une erreur à eu lieu lors de l\'envoie du rapport',
                                    'error'
                                )
                            });
                    }
                })
            }
        })
    })
})


