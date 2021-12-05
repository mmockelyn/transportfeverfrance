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

let status = {
    0: {'title': 'Non Publier', 'class': 'badge-danger', 'icon': 'fa-times-circle'},
    1: {'title': 'Publier', 'class': 'badge-success', 'icon': 'fa-check-circle'},
};

$("#user_list_package").DataTable({
    language: {
        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
    },

    columnDefs:[
        {
            "render": (data, type, row) => {
                return `
                <div class="d-flex align-items-center mb-7">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-50px me-5">
                        <img src="/storage/files/shares/core/icons/${sl[data]['icon']}" class="" alt="">
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Text-->
                    <div class="flex-grow-1 ">
                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6 p-0">${sl[data]['title']}</a>
                    </div>
                    <!--end::Text-->
                </div>
                `;
            },
            "targets": 3
        },
        {
            "render": (data, type, row) => {
                return `
                <span class="badge ${status[data]['class']}"><i class="fa ${status[data]['icon']} text-white mr-1"></i> ${status[data]['title']}</span>
                `;
            },
            "targets": 4
        }
    ]
});
