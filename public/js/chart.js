function showChart(text, element, series, categories, xtext = 'Tháng', ytext = 'Số lượng')
{
    var options = {
        series: series,
        chart: {
            height: 350,
            type: 'area',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: true,
        },
        stroke: {
            curve: 'straight'
        },
        title: {
            text: text,
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: categories,
            title: {
                text: xtext
            }
        },
        yaxis: {
            title: {
              text: ytext,
            },
          },
    };
    
    var chart = new ApexCharts(element, options);
    chart.render();
}