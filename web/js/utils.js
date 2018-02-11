/**
 * mostra um erro amigável em Ajax
 * @param {Object} elemento objeto com o elemento da página. Um selectbox, por exemplo
 * @param {Object} jqXHR objeto com o retorno do ajax
 * @return void 
 */
function showAjaxError(elemento, jqXHR)
{
    var div = $(elemento).parent();
    var help_block = div.find(".help-block");
    var mensagem = "Ocorreu um erro - " + jqXHR.responseText;
    div.removeClass("has-success");
    div.addClass("has-error");
    help_block.text(mensagem);
}

/**
 * mostra ou esconde o loader da página
 * dependerá do status de exibição do loader
 */
function showHideLoader()
{
    $(".loader").toggle();
}