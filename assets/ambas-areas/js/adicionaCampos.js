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
    $(".consultaInstituicao").select2({
    // tags: true,
    placeholder: "Selecionar Instituição por nome",
    // multiple: true,
    // tokenSeparators: [',', ' '],
    minimumInputLength: 2,
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
    multiple: false,
    // tokenSeparators: [',', ' '],
    minimumInputLength: 2,
    maximumSelectionLength: 1,
    minimumResultsForSearch: Infinity,
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
        url: baseUrl + "edicao/geraLinkEdicao",
        data: conferencia,
        async: true,
        dataType: "json",
        success: function(data) {
            $('#linkEvento').val('');
            $('#linkEvento').val(data);
        }
    }); 
  });
});

// /**CARREGA PLUGIN FILE UPLOAD BOOTSTRAP**/
  // initialize with defaults
$("#fileImage").ready(function(){
    
    var imagem = {
     language: 'pt-BR'
    ,theme: 'fa'
    ,showUpload: false
    ,browseClass: 'btn btn-success'
    ,browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> "};

    if($("#link_imagem").val()!=""){
    var nomeArquivo = extrairNomeArquivo($("#link_imagem").val());
     var tam;
        tam = $.ajax({
          dataType: "HEAD",
          async: false,
          url: baseUrl+$("#link_imagem").val(),
          success: function (data) {
            return data.getResponseHeader("Content-Length");
          }
        });
        console.log(tam);
        imagem.initialPreview = "<img src='"+baseUrl+$("#link_imagem").val()
    +"' class='file-preview-image kv-preview-data img-responsive' title='"
    +nomeArquivo+"' "
    +"style='with:auto; height: auto; max-height:160px' >";
    imagem.initialPreviewAsData = false;
    imagem.initialPreviewShowDelete = false;
    imagem.initialPreviewConfig = [{caption:nomeArquivo, size: tam}];
    imagem.overwriteInitial = true;
    imagem.maxFileSize = "1000000";
    }
    
    
    function extrairNomeArquivo(Caminho){
	Caminho 	= Caminho.replace("/\/g", "/");
	var Arquivo = Caminho.substring(Caminho.lastIndexOf('/') + 1);
	return Arquivo;
    }
      
    $("#fileImage").fileinput(
      imagem
    );
});


/* Upload de Anais e Resultados*/
 $('.uploadAnaisResultados').on('click',function(e){
    var codigoEdicao = $(this).attr('codigoedicao');
    var edicao = 'Upload de Anais & Resultados' + ' (' + $(this).attr('edicao') +')';
    $('#modalUploadAnaisResultados h4').html(edicao);
    
    function getAnaisResultados(anais, resultados){
        $.ajax({    
        type: "POST",
        url: baseUrl+'edicao/consulta-anais-e-resultados/' + codigoEdicao,
        async: false,
        dataType: "json",
        success: function(data) {
             anais(data.anais);
             resultados(data.resultados);
        }});
    }
    
     
    getAnaisResultados(function(anais){
        var input = $("#arquivoAnais");
        if (input.data('fileinput')) {
            input.fileinput('destroy');
        }
        input.fileinput('refresh', anais);
    }, function(resultados){
        var input = $("#arquivoResultados");
        if (input.data('fileinput')) {
            input.fileinput('destroy');
        }
        input.fileinput('refresh',resultados);
    });
});

/* Upload de Diretrizes de Submissão e Revisão*/
 $('#arquivoSubmissao #arquivoRevisao').ready(function(){
    var codigoEdicao = $('#codigoEdicao').val();
    
    function getSubmissaoRevisao(submissao, revisao){
        $.ajax({    
        type: "POST",
        url: baseUrl+'edicao/consulta-regras-submissao-e-revisao/' + codigoEdicao,
        async: false,
        dataType: "json",
        success: function(data) {
             submissao(data.submissao);
             revisao(data.revisao);
        }});
    }
    
     
    getSubmissaoRevisao(function(submissao){
        var input = $("#arquivoSubmissao");
        if (input.data('fileinput')) {
            input.fileinput('destroy');
        }
        input.fileinput('refresh', submissao);
    }, function(revisao){
        var input = $("#arquivoRevisao");
        if (input.data('fileinput')) {
            input.fileinput('destroy');
        }
        input.fileinput('refresh',revisao);
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
    multiple: false,
    // tokenSeparators: [',', ' '],
    minimumInputLength: 2,
    maximumSelectionLength: 1,
    minimumResultsForSearch: Infinity,
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
    minimumInputLength: 2,
    minimumResultsForSearch: Infinity,
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

// $(function atribuicao() {
//    var limit = 1;


   
  // if(!$(this).hasClass("limited")){
  //     $(this).parent().parent().toggleClass('linhaSelecionadaCheckbox');
  //     var submissoes = [];
  //     $("#form_atribuicoes").find("input[name='submissoes[]']").each(function(){
  //         if($(this).prop("checked")){
  //            submissoes.push($(this).attr('value'));
  //            checado = true;
  //         }

  //   });
    // $.ajax({
    //     type: "POST",
    //     url: baseUrl + "revisao/consultaRevisoresAtribuicao",
    //     data: {submissoes: submissoes},
    //     async: true,
    //     dataType: "json",
    //     success: function(lista) {
    //         if(lista != null){
    //            $(".mensagem").hide();
    //           $(".painel-atribuicao").show();
             
    //          $(".consultaRevisoresAtribuicao").select2({ data: [lista] });
    //         }else{
    //           if(checado==true){
    //             $(".mensagem").show();
    //           }else{ $(".mensagem").hide();}
    //           $(".painel-atribuicao").hide();
              
    //         }
    //     }
    // }) 

    

// });

// (function() {
//       var linksOnPage = document.querySelectorAll("a.atribuicao");
//       var link = "";
//       for (var i = 0; i < linksOnPage.length; i++) {
//         link = linksOnPage[i];
//         link.addEventListener("click", function(e){
//              console.log(e.parent());
//         });
//       }
//     })();


$('a.atribuicao').click(function() { 
    var idsubmissao = $(this).attr('idsubmissao');
    var idmodalidade = $(this).attr('idmodalidade');
    var ideixo = $(this).attr('ideixo');
    console.log(idmodalidade+ideixo);
    $('#form-atribuicao').attr('action', baseUrl + 'revisao/atribuir-revisor/');
    $('#input-submissao').attr('value', idsubmissao);

    $.ajax({
        type: "POST",
        url: baseUrl + "revisao/consultaRevisoresAtribuicao",
        data: {modalidade: idmodalidade, eixo: ideixo},
        async: true,
        dataType: "json",
        success: function(lista) {

          console.log(lista);
            if(lista != null){
               $(".mensagem").hide();
               $(".painel-atribuicao").show();
             $(".consultaRevisoresAtribuicao").select2({
                placeholder: "Selecionar Revisor",
                multiple: true,
                dataType: "json",
                data: lista
             });
            }else{
                $(".mensagem").show();
            }




        }
    }) 

});


//CONSULTA DE CEP USANDO WEBSERVICE REPUBLICA VIRTUAL 
$(document).ready(function() {

    function limpa_form() {
        // Limpa valores do formulário de cep.
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
    }
            
    //Quando o campo cep perde o foco.
    $("#campoCep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#logradouro").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");

                //Consulta o webservice viacep.com.br/

                  $.getJSON("//republicavirtual.com.br/web_cep.php?cep="+ cep +"&formato=json", function(dados) {

                    if (("resultado" in dados) != 0) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").val(dados.tipo_logradouro+' '+dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.cidade);
                        // $("#uf").children("option").change().val("MG");
                        $('#uf option').each(function() {
                            if($(this).val() == dados.uf) {
                                $(this).prop("selected", true);
                            }
                        });
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_form();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_form();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_form();
        }
    });
});

/*Carrega modal autormaiticamente (modalidades e eixos tematicos) area do revisor*/
$(document).ready(function() {
  var url = location.href;
  if(url.indexOf("revisao/consultar") != -1) {
      $('#selecionarModalidadesEixos').modal('show');
  }
   
});




