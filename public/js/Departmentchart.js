<script>
        var options = {
            chart: {
                type: 'line',
            },
            series: [{
                name: 'Visits per Department',
                data: @json($data->pluck('visits'))
            }],
            xaxis: {
                categories: @json($data->pluck('department_name'))
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>