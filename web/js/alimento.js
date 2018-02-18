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

/**
 * busca calorias de um alimento no servidor, através de AJAX
 * @param {String} action método do servidor no qual será chamado
 * @param {Object} params objeto com parâmetros a serem enviados 
 * @param {Object} elemento o elemento que disparou a ação, por exemplo, um selectbox
 * @return void
 */
function buscaCaloriasAlimento(action, params, elemento) {
    $.ajax({
        "url":action,
        "data": params,
        "dataType":"json", 
        "success": function(retorno) {
            var total_calorias = retorno.calorias + " calorias";
            $(".medida_caseira_field").val(retorno.medida_caseira);
            $(".calorias_total").val(total_calorias);
            showHideLoader();
        },
        "error": function(jqXHR, textStatus, errorThrown) {
            showAjaxError(elemento, jqXHR);
            showHideLoader();
        }
    });
}

$(document).ready(function() {
    var action = $(".cmb_alimento").data("action");
    var params = {
        "id": $(".cmb_alimento").val()
    };
    buscaInfoAlimento(action, params, "");
    showHideLoader();

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

    $(".cmb_alimento_refeicao").on("change", function(event) {
        var elemento = $(this);
        var action = elemento.data("action");
        var params = {
            "id": elemento.val(),
            "quantidade": $(".quantidade_alimento_refeicao").val()
        };
        showHideLoader();
        buscaInfoAlimento(action, params, "");
        showHideLoader();
        buscaCaloriasAlimento(action, params, elemento);
    });

    $(".quantidade_alimento_refeicao").on("change", function(event) {
        var elemento = $(".cmb_alimento_refeicao");
        var action = elemento.data("action");
        var params = {
            "id": elemento.val(),
            "quantidade": $(".quantidade_alimento_refeicao").val()
        };
        showHideLoader();
        buscaCaloriasAlimento(action, params, elemento);
    });
})