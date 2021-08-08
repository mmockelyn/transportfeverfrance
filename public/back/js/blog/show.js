const chart = new Chartisan({
    el: '#chart',
    url: "/api/chart/blog_view_chart?year=2021",
    hooks: new ChartisanHooks()
        .colors(['#c33'])
})
