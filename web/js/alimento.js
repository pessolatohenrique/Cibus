/**
 * busca informações do alimento no servidor, através de AJAX
 * @param {String} action método do servidor no qual será chamado
 * @param {Object} params objeto com parâmetros a serem enviados 
 * @param {Object} elemento o elemento que disparou a ação, por exemplo, um selectbox
 * @return void
 */
function buscaInfoAlimento(action, params, elemento) {
    $.ajax({
        "url":action,
        "data": params,
        "dataType":"json", 
        "success": function(retorno) {
            $(".medida_caseira_field").val(retorno.medida_caseira);
            $(".grupo_alimentar_field").val(retorno.grupo);
            showHideLoader();

        },
        "error": function(jqXHR, textStatus, errorThrown) {
            showAjaxError(elemento, jqXHR);
            showHideLoader();
        }
    });
}

$(document).ready(function() {
    $(".cmb_alimento").on("change", function(){
        var elemento = $(this);
        var action = elemento.data("action");
        var params = {
            "id": elemento.val()
        };
        showHideLoader();
        buscaInfoAlimento(action, params, elemento);
    });

    $(".btn-continue").on("click", function(event){
        event.preventDefault();
        $(".continua_insercao").val("1");
        $(".formulario_dieta").submit();
    });
})