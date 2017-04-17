/** FORMATAÇÃO DE CAMPOS NO PADRÃO MASKED INPUT**/
jQuery(function($){
   $.mask.definitions['~']='[+-]';
   $("#data_inicio_1, #data_inicio_2, #data_inicio_3, #data_fim_1, #data_fim_2, #data_fim_3 ").mask("99/99/9999");
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

/*TRADUÇÃO DO DATEPICKER*/
$(function() {
        $(".datepicker").datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                nextText: 'Próximo',
                prevText: 'Anterior',
                
            });
        $(".datepicker").datepicker(); 
    });



/** IMPLANTA O SELECT2 NA CONSULTA DE INSTITUIÇÕES **/
$(document).ready(function() {
    var maximumSelectionLengthVariable = ($(location).attr('href').indexOf('edicao') !== -1) ? 0 : 1;
    $(".consultaInstituicao").select2({
    // tags: true,
    placeholder: "Instituição (nome abreviado)",
    multiple: true,
    // tokenSeparators: [',', ' '],
    minimumInputLength: 2,
    maximumSelectionLength: maximumSelectionLengthVariable,
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
                        text: item.inst_abrev,
                        title: item.inst_nm,
                        id: item.inst_cd
                    }
                })
            };
        }
    }
});

});

/** IMPLANTA O SELECT2 NA CONSULTA DE CONFERÊNCIAS **/
$(document).ready(function() {
    $(".consultaConferencia").select2({
    // tags: true,
    placeholder: "Conferência (consulta por denominação)",
    multiple: true,
    // tokenSeparators: [',', ' '],
    minimumInputLength: 2,
    maximumSelectionLength: 1,
    minimumResultsForSearch: 10,
    ajax: {
        url: baseUrl + "conferencia/consultarParaSelect2",
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
                        text: item.conf_nm,
                        id: item.conf_cd
                    }
                })
            };
        }
    }
});

});

/** IMPLANTA O SELECT2 NA CONSULTA DE COMITÊS **/
$(document).ready(function() {
    $(".consultaComite").select2({
    // tags: true,
    placeholder: "Comitê (consulta por denominação)",
    multiple: true,
    // tokenSeparators: [',', ' '],
    minimumInputLength: 2,
    maximumSelectionLength: 1,
    minimumResultsForSearch: 10,
    ajax: {
        url: baseUrl + "comite/consultarParaSelect2",
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
                        text: item.comi_nm,
                        id: item.comi_cd
                    }
                })
            };
        }
    }
});

});

/** IMPLANTA O SELECT2 NA CONSULTA DE E-mails **/
$(document).ready(function() {
    $(".consultaEmails").select2({
    tags: true,
    placeholder: "Emails",
    multiple: true,
    // tokenSeparators: [',', ' '],
    minimumInputLength: 2,
     // maximumSelectionLength: 20,
    minimumResultsForSearch: 10,
    ajax: {
        url: baseUrl + "usuario/consultarEmailSelect",
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
                        text: item.email_email,
                        id: item.email_email
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

 /** Exibe  input de emails para a opcao especificar emails (area do organizador, notificacao de usuários)**/
 $('#tipoNotificacao').change(function () {
     var optionSelected = $(this).find("option:selected");
     var valueSelected  = optionSelected.val();
     if(valueSelected==1){
      $('#notificacoesEmails').show();
     }else{
      $('#notificacoesEmails').hide();
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

//Script para mostrar status de carregando no envio de notificações ou reposta de contato
$(document).ready(function () {
    if (typeof($("div#divCarregando")) !== "undefined") {
      $( "form" ).submit(function( event ) {
        $('#fundoTelaDivCarregando').css({"display": "block"});
        $("#divCarregando").show();
        $(window).load(function () {
            // Quando a página estiver totalmente carregada, remove o id
            $('#divCarregando').fadeOut('slow');
        });
      });
     }
});

/* APLICA EFEITO DE SETINHA NO MENU INTERNO*/
$(document).ready(function(){
  var verfificaSeta = false;
  $('li.item-menu a').each(function(i){ 
      // Aplica a cor de fundo 
      if($(location).attr('href') == $(this).attr('href')){
        $(this.parentNode).addClass('active');
        verfificaSeta = true;
        if($(this).parent().parent().hasClass('submenu')){
          $(this).parent().parent().attr('class', 'in');
        }
      }
  }); 

  if(!verfificaSeta){
      $('li.item-menu a').each(function(i){ 
          if($(location).attr('href') != $(this).attr('href')
            && $(location).attr('href').indexOf($(this).parent().attr('id')) !== -1){
            $(this).parent().addClass('active');
            verfificaSeta = true;
            if($(this).parent().parent().hasClass('submenu')){
              $(this).parent().parent().attr('class', 'in');
            }
          }


      });
  }

});
// $(document).ready(function() {
//     var url_atual =  window.location.href;
//     var verfificaSeta=false;
//     document.querySelectorAll("li.item-menu a").forEach(function (elem,i) {
//     if(elem.getAttribute("href") == url_atual){
//           //elem.parentNode.className += " active";
//           elem.parentNode.id = "seta";
//           verfificaSeta = true;
//         }
//       });

//     if(!verfificaSeta){
//        document.querySelectorAll("ul.submenu li a").forEach(function (elem,i) {
//         if(elem.getAttribute("href") == url_atual){
//           elem.parentNode.parentNode.previousElementSibling.setAttribute("aria-expanded", "true");
//           elem.parentNode.parentNode.className += " in"; 
//           elem.parentNode.className += " active";
//           elem.parentNode.parentNode.parentNode.className += " active";
//           verfificaSeta=true;
//         }

//     if(!verfificaSeta){
//         document.querySelectorAll("li.item-menu a").forEach(function (elem,i) {
//         if(elem.getAttribute("href") != url_atual && elem.id != '' && elem.id.indexOf(url_atual)){
//           elem.parentNode.className += " active";
//           verfificaSeta = true;
//         }
//       });
//     }


//       });
//     }

// });






