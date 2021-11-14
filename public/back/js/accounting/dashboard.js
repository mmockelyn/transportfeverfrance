let chartIncoming = document.querySelector('.stat-incoming')
let chartOutgoing = document.querySelector('.stat-outgoing')
let sumIncoming = document.querySelector('.sumIncoming')
let sumOutgoing = document.querySelector('.sumOutgoing')
let balanceText = document.querySelector('.balanceText')

let divIncoming = document.querySelector('.cardIncoming')
let divOutgoing = document.querySelector('.cardOutgoing')

let divBalance = document.querySelector('.card-balance')

let a = chartIncoming.getAttribute("data-kt-chart-color"),
    b = chartOutgoing.getAttribute("data-kt-chart-color")
    o = KTUtil.getCssVariableValue("--bs-gray-800"),
    s = KTUtil.getCssVariableValue("--bs-" + a),
    r = KTUtil.getCssVariableValue("--bs-light-" + a),
    t = KTUtil.getCssVariableValue("--bs-" + b),
    u = KTUtil.getCssVariableValue("--bs-light-" + b);

divIncoming.classList.add('overlay')
divIncoming.classList.add('overlay-block')

divOutgoing.classList.add('overlay')
divOutgoing.classList.add('overlay-block')

divBalance.classList.add('overlay')
divBalance.classList.add('overlay-block')

$.ajax({
    url: '/api/back/accounting/getSalesStat',
    success: data => {
        divIncoming.classList.remove('overlay')
        divIncoming.classList.remove('overlay-block')
        sumIncoming.innerHTML = data.sum
        new ApexCharts(chartIncoming, {
            series: [{
                name: "Ventes & Dons",
                data: data.data
            }],
            chart: {
                fontFamily: "inherit",
                type: "area",
                height: '120',
                toolbar: {
                    show: !1
                },
                zoom: {
                    enabled: !1
                },
                sparkline: {
                    enabled: !0
                }
            },
            plotOptions: {},
            legend: {
                show: !1
            },
            dataLabels: {
                enabled: !1
            },
            fill: {
                type: "solid",
                opacity: .3
            },
            stroke: {
                curve: "smooth",
                show: !0,
                width: 3,
                colors: [s]
            },
            xaxis: {
                categories: ["Janv", "Fev", "Mars", "Avr", "Mai", "Juin", "Juil", "Aout", "Sept", "Oct", "Nov", "Dec"],
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                },
                labels: {
                    show: !1,
                    style: {
                        colors: o,
                        fontSize: "12px"
                    }
                },
                crosshairs: {
                    show: !1,
                    position: "front",
                    stroke: {
                        color: "#E4E6EF",
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: !0,
                    formatter: void 0,
                    offsetY: 0,
                    style: {
                        fontSize: "12px"
                    }
                }
            },
            yaxis: {
                min: 0,
                max: 60,
                labels: {
                    show: !1,
                    style: {
                        colors: o,
                        fontSize: "12px"
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: "none",
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: "none",
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: !1,
                    filter: {
                        type: "none",
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: "12px"
                },
                y: {
                    formatter: function(e) {
                        return e + " €"
                    }
                }
            },
            colors: [s],
            markers: {
                colors: [s],
                strokeColor: [r],
                strokeWidth: 3
            }
        }).render()
    }
})
$.ajax({
    url: '/api/back/accounting/getPurchaseStat',
    success: data => {
        divOutgoing.classList.remove('overlay')
        divOutgoing.classList.remove('overlay-block')
        sumOutgoing.innerHTML = data.sum
        new ApexCharts(chartOutgoing, {
            series: [{
                name: "Achats",
                data: data.data
            }],
            chart: {
                fontFamily: "inherit",
                type: "area",
                height: '120',
                toolbar: {
                    show: !1
                },
                zoom: {
                    enabled: !1
                },
                sparkline: {
                    enabled: !0
                }
            },
            plotOptions: {},
            legend: {
                show: !1
            },
            dataLabels: {
                enabled: !1
            },
            fill: {
                type: "solid",
                opacity: .3
            },
            stroke: {
                curve: "smooth",
                show: !0,
                width: 3,
                colors: [t]
            },
            xaxis: {
                categories: ["Janv", "Fev", "Mars", "Avr", "Mai", "Juin", "Juil", "Aout", "Sept", "Oct", "Nov", "Dec"],
                axisBorder: {
                    show: !1
                },
                axisTicks: {
                    show: !1
                },
                labels: {
                    show: !1,
                    style: {
                        colors: o,
                        fontSize: "12px"
                    }
                },
                crosshairs: {
                    show: !1,
                    position: "front",
                    stroke: {
                        color: "#E4E6EF",
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: !0,
                    formatter: void 0,
                    offsetY: 0,
                    style: {
                        fontSize: "12px"
                    }
                }
            },
            yaxis: {
                min: 0,
                max: 60,
                labels: {
                    show: !1,
                    style: {
                        colors: o,
                        fontSize: "12px"
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: "none",
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: "none",
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: !1,
                    filter: {
                        type: "none",
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: "12px"
                },
                y: {
                    formatter: function(e) {
                        return e + " €"
                    }
                }
            },
            colors: [t],
            markers: {
                colors: [t],
                strokeColor: [u],
                strokeWidth: 3
            }
        }).render()
    }
})
$.ajax({
    url: '/api/back/accounting/getBalance',
    success: data => {
        divBalance.classList.remove('overlay')
        divBalance.classList.remove('overlay-block')
        balanceText.innerHTML = data.sum

        if(data.class === 'info') {
            divBalance.classList.add('bg-info')
            balanceText.classList.add('text-info')
        } else if(data.class === 'danger') {
            divBalance.classList.add('bg-danger')
            balanceText.classList.add('text-danger')
        } else {
            divBalance.classList.add('bg-success')
            balanceText.classList.add('text-success')
        }
    }
})
