@extends('layouts.app')

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'line']});
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', 'X');
        data.addColumn('number', 'Presenças');

        data.addRows([
            [0, 0],   [1, 10],  [2, 23],  [3, 17],
        ]);

        var options = {
            hAxis: {
                title: 'Data',
                format: 'dd/MM/yyyy'
            },
            vAxis: {
                title: 'Presenças'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        chart.draw(data, options);
    }
</script>

    <div class="container">
        <h3>Relatório de Presenças Turma/Data</h3>
        <div id="chart_div" style="width: 100%; height: 500px;"></div>
    </div>
@endsection