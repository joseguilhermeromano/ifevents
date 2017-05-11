/** FORMATAÇÃO DE CAMPOS NO PADRÃO MASKED INPUT**/
jQuery(function($){
   $.mask.definitions['~']='[+-]';
   $(".datepicker").mask("99/99/9999");
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
/* Portuguese initialisation for the jQuery UI date picker plugin. */
/* Based on the Brazilian initialisation */
jQuery(function(){
  $.datepicker.regional['pt'] = {
    closeText: 'Fechar',
    prevText: '&#x3c;Anterior',
    nextText: 'Seguinte',
    currentText: 'Hoje',
    monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
    'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
    'Jul','Ago','Set','Out','Nov','Dez'],
    dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
    dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
    weekHeader: 'Sem',
    dateFormat: 'dd/mm/yy',
    firstDay: 0,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['pt']);
});﻿

$(function(){
  $('.datepicker').datepicker();
});


/*PERMITE TRAVAR INTERVALO DE DATAS NO DATEPICKER*/
// $( function() {
//     var dateFormat = "dd/mm/yy",
//     from = $( ".date-from" ).focusout(function(){ var b = '#'+$(this).attr('id');  return  console.log(b);}),
//     to = $( ".date-to" ).focusout(function(){ var b = '#'+$(this).attr('id');  return console.log(b); });
      // from.datepicker({
      //     defaultDate: "+1w",
      //     changeMonth: true,
      //     numberOfMonths: 1
      //   })
      //   .on( "change", function() {
      //     to.datepicker( "option", "minDate", getDate( this ) );
      //   }),
      // to.datepicker({
      //   defaultDate: "+1w",
      //   changeMonth: true,
      //   numberOfMonths: 1
      // })
      // .on( "change", function() {
      //   from.datepicker( "option", "maxDate", getDate( this ) );
      // });
  //     console.log();

  //   function getDate( element ) {
  //     var date;
  //     try {
  //       date = $.datepicker.parseDate( dateFormat, element.value );
  //     } catch( error ) {
  //       date = null;
  //     }

  //     return date;
  //   }
  // } );




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

$(document).ready(function() {
    $(".consultaUsuario").select2({
    tags: true,
    placeholder: "Buscar autor inscrito por nome",
    multiple: true,
    // tokenSeparators: [',', ' '],
    minimumInputLength: 2,
    // maximumSelectionLength: maximumSelectionLengthVariable,
    minimumResultsForSearch: 10,
    ajax: {
        url: baseUrl + "usuario/consultarParaSelect2",
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
                        text: item.user_nm,
                        id: item.user_nm + "-" + item.user_cd
                    }
                })
            };
        }
    }
});

});

/*implanta select 2 em inputs simples sem consulta ajax*/
$(".selectComum").select2({
  minimumResultsForSearch: Infinity
});

$(document).ready(function(){

 $('#teste').change(function () {
     // var optionSelected = $(this).find("option:selected");
     // var valueSelected  = optionSelected.val();
  console.log('teste');
// var conferencia = {conf_cd : $('.conferencia option:selected').val()};
// $(".consultaModalidade").select2({
//     minimumResultsForSearch: Infinity,
//     ajax: {
//         url: baseUrl + "modalidade/consultarParaSelect2",
//         dataType: "json",
//         type: "POST",
//         data: conferencia,
//         processResults: function (data) {
//             return {
//                 results: $.map(data, function (item) {
//                     return {
//                         text: item.mote_nm,
//                         id: item.mote_cd
//                     }
//                 })
//             };
//         }
//     }
// });

});

});



// $(".conferencia").change(function(){
// var conferencia = {conf_cd : $('#conferencia option:selected').val()};
// $(".consultaEixo").select2({
//     minimumResultsForSearch: Infinity,
//     ajax: {
//         url: baseUrl + "eixo-tematico/consultarParaSelect2",
//         dataType: "json",
//         type: "POST",
//         data: conferencia,
//         processResults: function (data) {
//             return {
//                 results: $.map(data, function (item) {
//                     return {
//                         text: item.mote_nm,
//                         id: item.mote_cd
//                     }
//                 })
//             };
//         }
//     }
// });

// });

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
                        text: item.conf_abrev,
                        id: item.conf_cd
                    }
                })
            };
        }
    }
});

});

/**GERA O LINK DA NOVA EDIÇÃO**/
$(document).ready(function(){
  $('.consultaConferencia').change(function(){
    var conferencia = {conf_cd : $('.consultaConferencia option:selected').val()};
    $.ajax({
        type: "POST",
        url: baseUrl + "edicao/geraNumeracaoEdicao",
        data: conferencia,
        async: true,
        dataType: "json",
        success: function(data) {
            $('#linkEvento').val('');
            $('#linkEvento').val($('#linkEvento').val()
              + baseUrl + 'evento/' + data + '-' + $('.consultaConferencia option:selected').text().toLowerCase());
        }
    }); 
  });
});

// /**CARREGA PLUGIN FILE UPLOAD BOOTSTRAP**/
  // initialize with defaults
$("#fileImage").ready(function(){

  $.ajax({
  type: "POST",
  url: baseUrl + "edicao/recuperaImagem",
  async: true,
  dataType: "json",
  success: function (data) {
      
    $("#fileImage").fileinput({
    language: 'pt-BR',
    theme: 'fa',
    showUpload: false,
    browseClass: 'btn btn-success',
    browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
    initialPreview: [data.initialPreview],
    initialPreviewAsData: data.initialPreviewAsData,
    initialPreviewShowDelete:data.initialPreviewShowDelete,
    initialPreviewConfig: [data.initialPreviewConfig],
    overwriteInitial: data.overwriteInitial,
    maxFileSize: data.maxFileSize,
    });


  }

  });


});

// /**CARREGA PLUGIN FILE UPLOAD para upload de arquivos pdf doc etc BOOTSTRAP**/
  // initialize with defaults
$("#file_artigo_1").ready(function(){

  // $.ajax({
  // type: "POST",
  // url: baseUrl + "artigo/recuperaArtigo",
  // async: true,
  // dataType: "json",
  // success: function (data) {
      
    $("#file_artigo_1").fileinput({
    language: 'pt-BR',
    theme: 'fa',
    showUpload: false,
    // maxFileCount: 1,
    maxFileSize: 4096,
    allowedFileExtensions: ["pdf", "docx"], 
    browseClass: 'btn btn-success',
    browseIcon: "<i class=\"fa fa-file\"></i> ",
    // initialPreview: [data.initialPreview],
    // initialPreviewAsData: data.initialPreviewAsData,
    // initialPreviewShowDelete:data.initialPreviewShowDelete,
    // initialPreviewConfig: [data.initialPreviewConfig],
    // overwriteInitial: data.overwriteInitial,
    // maxFileSize: data.maxFileSize,
    });


  // }

  // });


});

$("#file_artigo_2").ready(function(){

  // $.ajax({
  // type: "POST",
  // url: baseUrl + "artigo/recuperaArtigo",
  // async: true,
  // dataType: "json",
  // success: function (data) {
      
    $("#file_artigo_2").fileinput({
    language: 'pt-BR',
    theme: 'fa',
    showUpload: false,
    // maxFileCount: 1,
    maxFileSize: 4096,
    allowedFileExtensions: ["pdf", "docx"], 
    browseClass: 'btn btn-success',
    browseIcon: "<i class=\"fa fa-file\"></i> ",
    // initialPreview: [data.initialPreview],
    // initialPreviewAsData: data.initialPreviewAsData,
    // initialPreviewShowDelete:data.initialPreviewShowDelete,
    // initialPreviewConfig: [data.initialPreviewConfig],
    // overwriteInitial: data.overwriteInitial,
    // maxFileSize: data.maxFileSize,
    });


  // }

  // });


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

/** IMPLANTA O SELECT2 NA CONSULTA DE REVISORES **/
$(document).ready(function() {
    $(".consultaRevisores").select2({
    placeholder: "Selecionar Revisor por nome...",
    multiple: true,
    minimumInputLength: 2,
    maximumSelectionLength: 1,
    minimumResultsForSearch: 10,
    ajax: {
        url: baseUrl + "usuario/consultarRevisorSelect2",
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
                        text: item.user_nm,
                        id: item.user_cd
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


/*Seleciona linha da tabela de atribuições de artigos*/

$('#form_atribuicoes :checkbox').click(function() {
   var limit = 1;
   
   if($(this).hasClass("limited")) {
      var counter = $('.limited:checked').length;
      if(counter > limit) {
        this.checked = false;
        alert('Você pode selecionar apenas um revisor!');
      }else{
         $(this).parent().parent().toggleClass('linhaSelecionadaCheckbox');
      }
   }
  if(!$(this).hasClass("limited")){
      $(this).parent().parent().toggleClass('linhaSelecionadaCheckbox');
  }
    

});






