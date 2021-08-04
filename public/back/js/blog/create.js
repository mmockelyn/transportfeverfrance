tinymce.init({
    selector: '#content',
    toolbar: "advlist | autolink | link image | lists charmap | print preview numlist bullist table",
    plugins: "advlist autolink link image lists charmap print preview ",
    language: 'fr_FR'
});

new Tagify(document.querySelector('#meta_keywords'))
