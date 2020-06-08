$(function () {
    $('[data-plugin="knob"]').knob()
});
var options = {
    chart: {
        height: 350,
        type: "area",
        toolbar: {
            show: !1
        }
    },
    colors: ["#2fa97c", "#e4cc37"],
    dataLabels: {
        enabled: !1
    },
    series: [{
        name: "2018",
        data: [41, 47, 32, 75, 63, 35, 42, 20, 6, 15, 27, 39]
    }, {
        name: "2019",
        data: [35, 41, 62, 45, 14, 18, 29, 57, 28, 49, 35, 27]
    }],
    grid: {
        yaxis: {
            lines: {
                show: !1
            }
        }
    },
    stroke: {
        width: 3,
        curve: "stepline"
    },
    markers: {
        size: 0
    },
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        title: {
            text: "Month"
        }
    },
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            opacityFrom: .7,
            opacityTo: .9,
            stops: [0, 90, 100]
        }
    },
    legend: {
        position: "top",
        horizontalAlign: "right",
        floating: !0,
        offsetY: -25,
        offsetX: -5
    }
};
(chart = new ApexCharts(document.querySelector("#yearly-sale-chart"), options)).render();