$(document).ready(function() {
	$(".number-decimal").mask('000.000.000.000.000,00', {reverse: true});
    $(".limpa_filtro").on("click", function(event){
    	$("input[type=text]").val("");
        $("input[type=checkbox]").prop("checked",false);
    });
});