/** ADICIONA O CAMPO PARA E-MAIL DINAMICAMENTE**/
var btn_add_email = document.querySelector("#addEmail");
// var btn_add_telefone = document.querySelector("#addTelefone");

btn_add_email.addEventListener("click", function(event){
	event.preventDefault();
	var i = document.getElementById('inputsEmails').getElementsByTagName('input').length;
	i += 1;
	if(i==3){
		return alert("Você pode cadastrar até 3 e-mails!");
	}
	var novoemail = `<div class="col-sm-6">
	<b><label for="email[`+i+`]">E-mail alternativo `+i+`</label></b>
		<div class="input-group">
			<input type="text" name="email[`+i+`]" " class="form-control estilo-botao-remove"  />
			<span class="input-group-btn">
		         <button class="btn btn-danger" onclick="this.parentNode.parentNode.parentNode.remove(this);" type="button"><span class="glyphicon glyphicon-remove"></span></button>
		     </span>
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
	if(i==3){
		return alert("Você pode cadastrar até 3 telefones!");
	}
	var novotelefone = `<div class="col-sm-4">
	<b><label for="telefone[`+i+`]">Telefone alternativo `+i+`</label></b>
		<div class="input-group">
			<input type="text" name="telefone[`+i+`]" class="campoTelefone form-control estilo-botao-remove"  />
			 <span class="input-group-btn">
		         <button class="btn btn-danger" onclick="this.parentNode.parentNode.parentNode.remove(this);" type="button"><span class="glyphicon glyphicon-remove"></span></button>
		     </span>
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

/** IMPLANTA O SELECT2 NAS BUSCAS **/
$(document).ready(function() {
    $(".select2").select2({
    	 maximumSelectionLength: 1
    });
});

