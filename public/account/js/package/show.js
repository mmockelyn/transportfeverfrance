let meta_keywords = document.querySelectorAll('.tagify')
let useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
const toastElement = document.getElementById('toastElement');
const toast = bootstrap.Toast.getOrCreateInstance(toastElement);
const currentdate = new Date()
const time = currentdate.getDay() + "/" + currentdate.getMonth()
    + "/" + currentdate.getFullYear() + " @ "
    + currentdate.getHours() + ":"
    + currentdate.getMinutes() + ":" + currentdate.getSeconds();
let modalEditFeatureVehicle = $("#modalEditFeatureVehicle")
let modalEditFeatureOther = $("#modalEditFeatureOther")


const formatAddUser = (item) => {
    if (!item.id) {
        return item.text;
    }

    let url = '/storage/files/shares/avatar/'+item.element.getAttribute('data-avatar')

    var img = $("<img>", {
        class: "rounded-circle me-2",
        width: 26,
        src: url
    });
    var span = $("<span>", {
        text: " " + item.text
    });
    span.prepend(img);
    return span;
}

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

tinymce.init({
    selector: 'textarea#description',
    plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable  charmap quickbars emoticons',
    tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
    tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
    tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
    tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
    mobile: {
        plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable  charmap quickbars emoticons'
    },
    menu: {
        tc: {
            title: 'Comments',
            items: 'addcomment showcomments deleteallconversations'
        }
    },
    menubar: 'file edit view insert format tools table tc help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    link_list: [
        { title: 'My page 1', value: 'https://www.tiny.cloud' },
        { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_list: [
        { title: 'My page 1', value: 'https://www.tiny.cloud' },
        { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_class_list: [
        { title: 'None', value: '' },
        { title: 'Some class', value: 'class-name' }
    ],
    importcss_append: true,
    templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
        { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
        { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
    tinycomments_mode: 'embedded',
    content_style: '.mymention{ color: gray; }',
    contextmenu: 'link image imagetools table configurepermanentpen',
    a11y_advanced_options: true,
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    language: 'fr_FR',
    setup: (editor) => {
        editor.on('change', () => {
            editor.save()
        })
    }
});
tinymce.init({
    selector: 'textarea#editor',
    plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable  charmap quickbars emoticons',
    tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
    tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
    tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
    tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
    mobile: {
        plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable  charmap quickbars emoticons'
    },
    menu: {
        tc: {
            title: 'Comments',
            items: 'addcomment showcomments deleteallconversations'
        }
    },
    menubar: 'file edit view insert format tools table tc help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    link_list: [
        { title: 'My page 1', value: 'https://www.tiny.cloud' },
        { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_list: [
        { title: 'My page 1', value: 'https://www.tiny.cloud' },
        { title: 'My page 2', value: 'http://www.moxiecode.com' }
    ],
    image_class_list: [
        { title: 'None', value: '' },
        { title: 'Some class', value: 'class-name' }
    ],
    importcss_append: true,
    templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
        { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
        { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
    tinycomments_mode: 'embedded',
    content_style: '.mymention{ color: gray; }',
    contextmenu: 'link image imagetools table configurepermanentpen',
    a11y_advanced_options: true,
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    language: 'fr_FR',
    setup: (editor) => {
        editor.on('change', () => {
            editor.save()
        })
    }
});

meta_keywords.forEach(key => {
    new Tagify(key)
})

$("#short_content").maxlength({
    warningClass: "badge badge-primary",
    limitReachedClass: "badge badge-success"
})

$('#user_id').select2({
    templateResult: function (item) {
        return formatAddUser(item);
    }
})

$("#list_download_comments").DataTable({
    language: {
        url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
    },
})

document.querySelectorAll('.publish').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault()

        btn.setAttribute('data-kt-indicator', 'on')

        $.ajax({
            url: `/api/download/${btn.dataset.download}/publish`,
            success: data => {
                btn.removeAttribute('data-kt-indicator')
                getToast('success', time, data.message)
            },
            error: data => {
                btn.removeAttribute('data-kt-indicator')
                getToast('success', time, data.message)
            }
        })
    })
})
document.querySelectorAll('.btnToggleView').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault()

        $.ajax({
            url: `/api/download/${btn.dataset.download}/version/${btn.dataset.version}`,
            success: data => {
                let modal = $("#modalViewVersion")
                modal.find('.modal-title').html('Note de version: '+data.version.version+'<br><span class="text-muted">'+data.download.title+'</span>')
                modal.modal('show')
            }
        })
    })
})
document.querySelector('#btnModalEditFeature').addEventListener('click', (e) => {
    console.log(e.target)
    $.ajax({
        url: '/api/download/'+e.target.dataset.id+'/feature',
        success: data => {
            console.log(data)
            if(data.feature.type_feature == 0) {
                modalEditFeatureVehicle.find('.modal-title').html()
                modalEditFeatureVehicle.find('[name="type_vehicule"]').val(data.feature.type_vehicule)
                $('[name="type_conduite"]').val(data.feature.conduite_vehicule).select2()
                modalEditFeatureVehicle.find('[name="vitesse"]').val(data.feature.vitesse)
                modalEditFeatureVehicle.find('[name="performance"]').val(data.feature.performance)
                modalEditFeatureVehicle.find('[name="traction"]').val(data.feature.traction)
                $('[name="ecartement"]').val(data.feature.ecartement).select2()
                modalEditFeatureVehicle.find('[name="capacity"]').val(data.feature.capacity)
                modalEditFeatureVehicle.find('[name="dispo_start"]').val(data.feature.dispo_start)
                modalEditFeatureVehicle.find('[name="dispo_end"]').val(data.feature.dispo_end)
                $('[name="pays"]').val(data.feature.pays).select2()
                $('[name="licence"]').val(data.download.licence).select2()
                modalEditFeatureVehicle.modal('show')
            } else {
                modalEditFeatureOther.find('.modal-title').html()
                modalEditFeatureOther.find('[name="dispo_start"]').val(data.feature.dispo_start)
                modalEditFeatureOther.find('[name="dispo_end"]').val(data.feature.dispo_end)
                $('[name="pays"]').val(data.feature.pays).select2()
                $('[name="licence"]').val(data.download.licence).select2()
                modalEditFeatureOther.modal('show')
            }
        }
    })
})

$("#formUpdateModInfo").on('submit', (e) => {
    e.preventDefault()
    let form = $("#formUpdateModInfo")
    let uri = form.attr('action')
    let btn = document.querySelector('.btn-success')
    let data = form.serializeArray()

    btn.setAttribute('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: "PUT",
        data: data,
        success: data => {
            btn.removeAttribute('data-kt-indicator')
            if (data.code == 'W202') {
                getToast('warning', time, data)
                KTUtil.scrollTop()
            } else {
                getToast('success', time, data)
                KTUtil.scrollTop()
            }
            getToast('success', time, data)
            KTUtil.scrollTop()
        },
        error: data => {
            btn.removeAttribute('data-kt-indicator')
            getToast('error', time, data)
            KTUtil.scrollTop()
        }
    })
})
$("#formEditFeatureVehicle").on('submit', (e) => {
    e.preventDefault()
    let form = $("#formEditFeatureVehicle")
    let uri = '/api/download/'+$('[name="download_id"]').val()+'/feature'
    let btn = document.querySelector('#formEditFeatureVehicle').querySelector('.btn-success')
    let data = form.serializeArray()

    btn.setAttribute('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: 'PUT',
        data: data,
        success: data => {
            btn.removeAttribute('data-kt-indicator')
            getToast('success', time, data)
            form[0].reset()
            modalEditFeatureVehicle.modal('hide')
        },
        error: data => {
            btn.removeAttribute('data-kt-indicator')
            getToast('error', time, data)
        }
    })
})
$("#formEditFeatureOther").on('submit', (e) => {
    e.preventDefault()
    let form = $("#formEditFeatureOther")
    let uri = '/api/download/'+$('[name="download_id"]').val()+'/feature'
    let btn = document.querySelector('#formEditFeatureOther').querySelector('.btn-success')
    let data = form.serializeArray()

    btn.setAttribute('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: 'PUT',
        data: data,
        success: data => {
            btn.removeAttribute('data-kt-indicator')
            getToast('success', time, data)
            form[0].reset()
            modalEditFeatureOther.modal('hide')
        },
        error: data => {
            btn.removeAttribute('data-kt-indicator')
            getToast('error', time, data)
        }
    })
})
$("#formAddUser").on('submit', (e) => {
    e.preventDefault()
    let form = $("#formAddUser")
    let uri = form.attr('action')
    let btn = document.querySelector('#formAddUser').querySelector('.btn-success')
    let data = form.serializeArray()

    btn.setAttribute('data-kt-indicator', 'on')

    $.ajax({
        url: uri,
        method: 'POST',
        data: data,
        success: data => {
            btn.removeAttribute('data-kt-indicator')
            getToast('success', time, data)
            form[0].reset()
            $("#contentAuthors").html(data.content)
            $("#addUser").modal('hide')
        },
        error: data => {
            btn.removeAttribute('data-kt-indicator')
            getToast('error', time, data)
        }
    })
})
