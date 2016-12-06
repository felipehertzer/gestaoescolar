/**
 * Created by User on 05/09/2016.
 */
$( document ).ready(function() {

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
	
	
	if($('#tipopessoa').val() == "3"){
            $("#professor_funcionario, #responsavel, #funcoes").css('display', 'none');
            $("#aluno").css('display', 'block');
        } else if($('#tipopessoa').val() == "2"){

            $("#aluno, #professor_funcionario").css('display', 'none');
            $("#responsavel, #funcoes").css('display', 'block');
        } else {
            if($('#tipopessoa').val() == "0"){
                $("#funcoes").css('display', 'block');
            } else {
                $("#funcoes").css('display', 'none');
            }
            $("#aluno, #responsavel").css('display', 'none');
            $("#professor_funcionario").css('display', 'block');
        }
   

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
                $('.selectpicker').selectpicker('refresh');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $('#multiselect').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Procurar..." style="margin-bottom:8px;" />',
            right: '<input type="text" name="q" class="form-control" placeholder="Procurar..." style="margin-bottom:8px;" />',
        }
    });

    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.phone').mask('0000-0000');
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
});