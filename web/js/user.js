/**
 * verifica se o aceite de termos foi checado antes de prosseguir
 * se estiver aceite, envia o formulário que irá ser validado pelo Yii2
 */
function verificaTermos()
{
	var isChecked = $("#user-aceitatermos:checked").val();
	if(isChecked != 1){
		$(".checkbox > .help-block-error")
		.addClass("help-block")
		.addClass("has-error")
		.text("É necessário aceitar os termos antes de prosseguir!");
	}else{
		$("#form-signup").submit();
	}
}
$(document).ready(function() {
	$("#btn-register").on("click",function(event){
		event.preventDefault();
		verificaTermos();
	})
});