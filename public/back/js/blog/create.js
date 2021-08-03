tinymce.init({
    selector: '#content',
    toolbar: "advlist | autolink | link image | lists charmap | print preview numlist bullist table",
    plugins: "advlist autolink link image lists charmap print preview table tabledelete tableprops tablerowprops tablecellprops tableinsertrowbefore tableinsertrowafter tabledeleterow tableinsertcolbefore tableinsertcolafter tabledeletecol",
    language: 'fr_FR'
});

new Tagify(document.querySelector('#meta_keywords'))
