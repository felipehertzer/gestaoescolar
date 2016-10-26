/**
 * Created by User on 05/09/2016.
 */
$( document ).ready(function() {
    $('#multiselect').multiselect();

    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: 4
    });

    $('#tipopessoa').on('change', function() {
        if($(this).val() == "3"){
            $("#professor_funcionario, #responsavel, #funcoes").css('display', 'none');
            $("#aluno").css('display', 'block');
        } else if($(this).val() == "2"){

            $("#aluno, #professor_funcionario").css('display', 'none');
            $("#responsavel, #funcoes").css('display', 'block');
        } else {
            if($(this).val() == "0"){
                $("#funcoes").css('display', 'block');
            } else {
                $("#funcoes").css('display', 'none');
            }
            $("#aluno, #responsavel").css('display', 'none');
            $("#professor_funcionario").css('display', 'block');
        }
    });

    $('#id_materia').on('change', function() {
        var id_materia = $(this).val();
        $.ajax({
            url: "get-turmas",
            type: "POST",
            data: { 'id_materia' : id_materia } ,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#id_turma').find('option').remove().end();
                if (response.materias.length != 0 ) {
                    $.each(response.materias, function (v, k) {
                        $('#id_turma').append('<option value="' + k + '">' + v + '</option>');
                    });
                } else {
                    $('#id_turma').append('<option value="">Nenhuma turma encontrada</option>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});