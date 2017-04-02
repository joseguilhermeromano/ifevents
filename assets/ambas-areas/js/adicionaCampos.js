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
     if(valueSelected==2){
     	$('#qtdMaxSubmissaoAval').show();
     }else{
     	$('#qtdMaxSubmissaoAval').hide();
     }
 });

/*Oculta e exibe ids de tags html (usado nos inputs senha e email de cadastro de usuários */
$(function(){
      $(".btn-toggle").click(function(e){
          e.preventDefault();
          el = $(this).data('element');
          $(el).toggle();
      });
  });

/* APLICA EFEITO DE SETINHA NO MENU INTERNO*/
$(document).ready(function() {
    var url_atual =  window.location.href;
    var verfificaSeta=false;
    document.querySelectorAll("li.item-menu a").forEach(function (elem,i) {
        if(elem.getAttribute("href") == url_atual){
          elem.parentNode.className += " active";
          verfificaSeta = true;
        }
      });

    if(!verfificaSeta){
       document.querySelectorAll("ul.submenu li a").forEach(function (elem,i) {
        if(elem.getAttribute("href") == url_atual){
          elem.parentNode.parentNode.previousElementSibling.setAttribute("aria-expanded", "true");
          elem.parentNode.parentNode.className += " in"; 
          elem.parentNode.className += " active";
          elem.parentNode.parentNode.parentNode.className += " active"
        }
      });
    }

});






