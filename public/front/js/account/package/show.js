let image_package = new KTImageInput('image_package')

jQuery(document).ready(function() {
    $('[name="short_content"]').maxlength({
        alwaysShow: true,
        threshold: 5,
        warningClass: "label label-danger label-rounded label-inline",
        limitReachedClass: "label label-primary label-rounded label-inline"
    });

    let meta = document.querySelector('.tagify')
    new Tagify(meta)
});
