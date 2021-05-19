let app = document.querySelector('#package_index')
let user_id = app.dataset.id

jQuery(document).ready(function() {
    $("#table_package").KTDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: `/api/user/${user_id}/packages`
                }
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
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
                noRecords: "Aucun package disponible pour votre compte"
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

        search: {
            input: $('#search_packages'),
            delay: 400,
            key: 'searchPackage'
        },

        columns: [{
            field: 'id',
            title: "ID",
            sortable: "asc",
            width: 40,
            type: 'number',
            selector: false,
            textAlign: 'left',
            template: (data) => {
                return `<span class="font-weight-bolder">${data.id}</span>`
            }
        }, {
            field: 'imgFile',
            title: "Visuel",
            width: 120,
            template: (data) => {
                return `
                <div class="symbol symbol-120 flex-shrink-0 mr-4">
                    <div class="symbol-label" style="background-image: url('${data.imgFile}')"></div>
                </div>
                `
            }
        }, {
            field: 'title',
            title: "Titre",
            template: (data) => {
                return `
                    <strong>${data.title}</strong><br>
                    <span class="h6 text-muted">${data.shortDescription}</span>
                `
            }
        }, {
            field: 'provider',
            title: "Source",
            template: (row) => {
                let sl = {
                    1: {
                        'title': 'Steam',
                        'icon': 'steam_icon.png',
                    },
                    2: {
                        'title': 'Transportfever.net',
                        'icon': 'tf_net_icon.png',
                    },
                    3: {
                        'title': 'Transport Fever France',
                        'icon': 'tf_france_icon.png',
                    },
                    0: {
                        'title': 'Inconnue',
                        'icon': 'null_icon.png',
                    }
                };
                console.log(row.provider)

                return `
                <div class="d-flex align-items-center bg-light-primary p-1">
                    <div class="symbol symbol-50 symbol-light-white mr-5">
                        <div class="symbol-label">
                            <img src="/storage/files/shares/core/icons/`+sl[row.provider].icon+`" class="h-50" alt="" />
                        </div>
                    </div>
                    <a href="#" class="text-dark">`+sl[row.provider].title+`</a>
                </div>
                `;
            }
        }, {
            field: 'state',
            title: "Etat",
            template: (row) => {
                let status = {
                    0: {'title': 'Non Publier', 'class': 'label-danger', 'icon': 'fa-times-circle'},
                    1: {'title': 'Publier', 'class': 'label-success', 'icon': 'fa-check-circle'},
                };

                return `
                <span class="label label-rounded label-inline ${status[row.state].class}"><i class="fa ${status[row.state].icon} text-white mr-1"></i> ${status[row.state].title}</span>
                `;
            }
        }, {
            field: 'actions',
            title: "Actions",
            template: (data) => {
                return `
                    <a href="/account/package/${data.id}" class="btn btn-primary btn-icon" data-toggle="tooltip" data-theme="dark" data-original-title="Voir le package"><i class="fa fa-eye"></i> </a>
                `
            }
        }]
    })
});
