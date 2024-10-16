<x-app-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 p-5">
        <div class="rounded-xl bg-white shadow-2xl">
            <div class="mx-5 mt-5">
                <span>Quant. Por Valor</span>
            </div>
            <div id="chartBarPerValue"></div>
        </div>
        <div class="rounded-xl bg-white shadow-2xl">
            <div class="mx-5 mt-5">
                <span>Quant. Por UF</span>
            </div>
            <div id="chartDonutPerUf"></div>
        </div>
    </div>
    <script>
        var types = [{!! $types !!}];
        var types_count = [{!! $types_count !!}];
        var ufs = [{!! $ufs !!}];
        var ufs_count = [{!! $ufs_count !!}];
            console.log(types, types_count)
        var options = {
            series: [{
                'name': 'Valores',
                'data': types_count,
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    horizontal: false,
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: types,
            }
        };

        var optionsDonut = {
            series: ufs_count,
            labels: ufs,
            chart: {
                type: 'donut',
                height: 350
            },
            responsive: [{
                options: {
                    chart: {
                        width: 100
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

      new ApexCharts(document.querySelector("#chartBarPerValue"), options).render();
      new ApexCharts(document.querySelector("#chartDonutPerUf"), optionsDonut).render();
    </script>
</x-app-layout>
