let image_package = new KTImageInput('image_package')

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

    $('[name="short_content"]').maxlength({
        alwaysShow: true,
        threshold: 5,
        warningClass: "label label-danger label-rounded label-inline",
        limitReachedClass: "label label-primary label-rounded label-inline"
    });

    let meta = document.querySelector('.tagify')
    new Tagify(meta)
});
