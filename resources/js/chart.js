import ApexCharts from 'apexcharts'

function renderHabitsChart(goodSeries, badSeries) {
    var options = {
        series: [
            { name: 'Good Habits', data: goodSeries },
            { name: 'Bad Habits',  data: badSeries  }
        ],
        chart: {
            height: 350,
            type: 'area'
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            type: 'datetime',  
        },
        tooltip: {
            x: {
                format: 'dd MMM yyyy'
            }
        },
        yaxis: {
            min: 0,
            labels: {
                formatter: val => Math.round(val)
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
}

export default renderHabitsChart;