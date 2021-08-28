const chart_view = new Chartisan({
    el: '#chart_view',
    url: "/api/chart/blog_view_chart?year=2021",
    hooks: new ChartisanHooks()
        .colors(['#c33'])
})

const chart_comments = new Chartisan({
    el: '#chart_comments',
    url: "/api/chart/blog_comment_chart?year=2021",
    hooks: new ChartisanHooks()
        .colors(['#c33'])
})
