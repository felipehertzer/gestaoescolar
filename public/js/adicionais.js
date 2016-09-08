/**
 * Created by User on 05/09/2016.
 */
$( document ).ready(function() {
    $('#multiselect').multiselect();

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
});