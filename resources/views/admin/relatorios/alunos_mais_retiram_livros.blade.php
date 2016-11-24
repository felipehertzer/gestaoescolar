@extends('layouts.app')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Aluno', 'Exemplares Retirados'],
            @foreach($alunos as $aluno)
                [ '{{ $aluno->nome }}', {{ $aluno->numero_exemplares_retirado }}],
            @endforeach
        ]);

        var options = {
            title: 'Alunos que mais retiram Livros',
            pieSliceText: 'value'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>

@section('content')
<div class="container">
    <div id="piechart" style="width: 100%; height: 500px;"></div>
</div>
@endsection
