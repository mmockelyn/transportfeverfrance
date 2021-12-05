let image_package = new KTImageInput('image_package')
let modal_edit_feature = $('#editFeature')

jQuery(document).ready(function() {
    $("#table_comments").KTDatatable({
        data: {
            saveState: {cookie: false},
        },

        layout: {
            scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
            footer: false, // display/hide footer,
            spinner: {
                type: 'loader',
                message: "Chargement de la liste des packages..."
            }
        },

        translate: {
            records: {
                noRecords: "Aucun commentaire pour ce mod"
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: 'Premier',
                            prev: 'Précédent',
                            next: 'Suivant',
                            last: 'Dernier',
                            more: 'Plus',
                            input: 'Nombre de page',
                            select: 'Nombre par page'
                        },
                        info: 'Affichage de {{start}} à {{end}} sur {{total}} éléments'
                    }
                }
            }
        },

        sortable: true,

        pagination: true,
    })
    $("#table_version").KTDatatable({
        data: {
            saveState: {cookie: false},
        },

        layout: {
            scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
            footer: false, // display/hide footer,
            spinner: {
                type: 'loader',
                message: "Chargement de la liste des versions..."
            }
        },

        translate: {
            records: {
                noRecords: "Aucune version du mod de disponible"
            },
            toolbar: {
                pagination: {
                    items: {
                        default: {
                            first: 'Premier',
                            prev: 'Précédent',
                            next: 'Suivant',
                            last: 'Dernier',
                            more: 'Plus',
                            input: 'Nombre de page',
                            select: 'Nombre par page'
                        },
                        info: 'Affichage de {{start}} à {{end}} sur {{total}} éléments'
                    }
                }
            }
        },

        sortable: true,

        pagination: true,
    })

    $('[name="short_content"]').maxlength({
        alwaysShow: true,
        threshold: 5,
        warningClass: "label label-danger label-rounded label-inline",
        limitReachedClass: "label label-primary label-rounded label-inline"
    });


    $(".inputmask").inputmask("9999", {
        "placeholder": "aaaa",
        autoUnmask: true
    });

    let meta = document.querySelector('.tagify')
    new Tagify(meta)

    $("#formEditPackageFeature").on('submit', (e) => {
        e.preventDefault()
        let form = $("#formEditPackageFeature")
        let uri = `/api/download/${form.find('[name="download_id"]').val()}/feature`
        let btn = form.find('.btn-success')
        let data = form.serializeArray()

        btn.fadeOut()

        $.ajax({
            url: uri,
            method: 'PUT',
            data: data,
            success: data => {
                btn.fadeIn()
                modal_edit_feature.modal('hide')
                toastr.success("Edition des infos de caractéristique mise à jours")
            },
            error: err => {
                btn.fadeIn()
                console.error(err)
                toastr.error('Erreur: '+err)
            }
        })
    })

});

document.querySelector('.btnEditFeature').addEventListener('click', (e) => {
    let btn = document.querySelector('.btnEditFeature')
    let id = btn.dataset.packageId

    $.ajax({
        url: '/api/download/'+id+'/feature',
        success: data => {
            console.log(data)
            modal_edit_feature.find('.modal-title').html('Edition des caractéristiques')
            modal_edit_feature.find('[name="type_vehicule"]').val(data.type_vehicule)
            modal_edit_feature.find('[name="conduite_vehicule"]').val(data.conduite_vehicule)
            modal_edit_feature.find('[name="vitesse"]').val(data.vitesse)
            modal_edit_feature.find('[name="performance"]').val(data.performance)
            modal_edit_feature.find('[name="traction"]').val(data.traction)
            modal_edit_feature.find('[name="dispo_start"]').val(data.dispo_start)
            modal_edit_feature.find('[name="dispo_end"]').val(data.dispo_end)
            modal_edit_feature.find('[name="capacity"]').val(data.capacity)
            modal_edit_feature.find('[name="capacity"]').val(data.capacity)
            modal_edit_feature.find('[name="feature_id"]').val(data.id)
            modal_edit_feature.find('[name="download_id"]').val(data.download_id)

            modal_edit_feature.modal('show')
        }
    })
})
