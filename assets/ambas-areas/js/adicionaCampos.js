/** ADICIONA O CAMPO PARA E-MAIL DINAMICAMENTE**/
var btn_add_email = document.querySelector("#addEmail");
// var btn_add_telefone = document.querySelector("#addTelefone");

/** FORMATAÇÃO DE CAMPOS NO PADRÃO MASKED INPUT**/
jQuery(function($){
   $.mask.definitions['~']='[+-]';
   $("#campoData").mask("99/99/9999");
   $("#campoTelefone").focusout(function(){
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');
   $("#campoRG").mask("99.999.999-9");
    $("#campoCPF").mask("999.999.999-99");
   $("#campoCep").mask("99999-999");
   $("#campoSenha").mask("***-****");
   $('#campoQtdMaxSubmissaoAvaliador').mask('#');
   
});

btn_add_email.addEventListener("click", function(event){
	event.preventDefault();
	var i = document.getElementById('inputsEmails').getElementsByTagName('input').length;
	i += 1;
	if(i==3){
		return alert("Você pode cadastrar até 3 e-mails!");
	}
	var novoemail = `<div class="col-sm-6">
    <div class="form-group floating-label-form-group controls">
	<b><label for="email[`+i+`]">E-mail alternativo `+i+`</label></b>
		<div class="input-group">
			<input type="text" name="email[`+i+`]" " placeholder="E-mail alternativo `+i+`" class="form-control estilo-botao-remove"  />
			<span class="input-group-btn">
		         <button class="btn btn-danger" onclick="this.parentNode.parentNode.parentNode.parentNode.remove(this);" type="button"><span class="glyphicon glyphicon-remove"></span></button>
		     </span>
		</div>
	</div>
    </div>`;
	var div = document.querySelector("#inputsEmails");
	var elems = div.getElementsByTagName("input");

	for(var i = 0; i < elems.length; i++) {
	    // set attribute to property value
	    elems[i].setAttribute("value", elems[i].value);
	}
	// console.log(div.getElementsByName('email['+eval(i-1)+']').value);

	div.innerHTML = div.innerHTML + novoemail;
});
/** /ADICIONA O CAMPO PARA E-MAIL DINAMICAMENTE**/

/** ADICIONA O CAMPO PARA TELEFONE DINAMICAMENTE**/
var handleMasks = function (){
  $('.campoTelefone').focusout(function(){
    var phone, element;
    element = $(this);
    element.unmask();
    phone = element.val().replace(/\D/g, '');
    if(phone.length > 10) {
        element.mask("(99) 99999-999?9");
    } else {
        element.mask("(99) 9999-9999?9");
    }
}).trigger('focusout');
};

// and search for new HTML elements.
$(document).on('mask-it', function(){
    handleMasks();
}).trigger('mask-it');

 var addTelefone = function(){
	event.preventDefault();
	var i = document.getElementById('inputsTelefones').getElementsByTagName('input').length;
	i += 1;
	if(i>3){
		return alert("Você pode cadastrar até 3 telefones!");
	}
	var novotelefone = `<div class="col-sm-4">
    <div class="form-group floating-label-form-group floating-label-form-group-with-value controls">
	<b><label for="telefone[`+i+`]">Telefone/Celular `+i+`</label></b>
		<div class="input-group">
			<input type="text" name="telefone[`+i+`]" placeholder="Telefone/Celular `+i+`" class="campoTelefone form-control estilo-botao-remove"  />
			 <span class="input-group-btn">
		         <button class="btn btn-danger" onclick="this.parentNode.parentNode.parentNode.parentNode.remove(this);" type="button"><span class="glyphicon glyphicon-remove"></span></button>
		     </span>
	    </div>
	</div>
    </div>`;
	var div = document.querySelector("#inputsTelefones");
	var elems = div.getElementsByTagName("input");

	for(var i = 0; i < elems.length; i++) {
	    // set attribute to property value
	    elems[i].setAttribute("value", elems[i].value);
	}
	// console.log(div.getElementsByName('email['+eval(i-1)+']').value);

	div.innerHTML = div.innerHTML + novotelefone;
};



$('#addTelefone').on('click', function(){
	addTelefone();
    // call mask-it event
    $(this).trigger('mask-it');
});
/** /ADICIONA O CAMPO PARA TELEFONE DINAMICAMENTE**/

/** IMPLANTA O SELECT2 NA CONSULTA DE INSTITUIÇÕES **/
$(document).ready(function() {
    $(".consultaInstituicao").select2({
    // tags: true,
    placeholder: "Instituição",
    multiple: true,
    // tokenSeparators: [',', ' '],
    minimumInputLength: 2,
     maximumSelectionLength: 1,
    minimumResultsForSearch: 10,
    ajax: {
        url: baseUrl + "instituicao/consultarParaSelect2",
        dataType: "json",
        type: "POST",
        data: function (params) {

            var queryParameters = {
                term: params.term
            }
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.inst_nm,
                        id: item.inst_cd
                    }
                })
            };
        }
    }
});

});

/** Trava campo para aceitar somente números **/
function somenteNumeros(num) {
    var er = /[^0-9.]/;
    er.lastIndex = 0;
    if (er.test(num.value)) {
      num.value = "";
    }
}

/** Exibe  input de qtd maxima de submissoes para o cadastro de avaliadores (area do organizador) **/
 $('#tipoUsuario').change(function () {
     var optionSelected = $(this).find("option:selected");
     var valueSelected  = optionSelected.val();
     if(valueSelected==1){
     	$('#qtdMaxSubmissaoAval').show();
     }else{
     	$('#qtdMaxSubmissaoAval').hide();
     }
 });




