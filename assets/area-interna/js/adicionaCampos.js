var btn_add_email = document.querySelector("#addEmail");
var btn_add_telefone = document.querySelector("#addTelefone");

btn_add_email.addEventListener("click", function(event){
	event.preventDefault();
	var i = document.getElementById('inputsEmails').getElementsByTagName('input').length;
	i += 1;
	var novoemail = `<div class="col-md-4">
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

btn_add_telefone.addEventListener("click", function(event){
	event.preventDefault();
	var i = document.getElementById('inputsTelefones').getElementsByTagName('input').length;
	i += 1;
	var novotelefone = `<div class="col-md-4">
	<b><label for="telefone[`+i+`]">Telefone alternativo `+i+`</label></b>
		<div class="input-group">
			<input type="text" id="campoTelefone" name="telefone[`+i+`]" class="form-control estilo-botao-remove"  />
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
});

