/*CODIGO AJAX PARA AS PAGINAÇÕES*/
$(document).ready(function(){
  //Ao clicar em um link da paginação será executada essa rotina
  $("#ajaxPagination li a").on("click",function(){

    //recupera a url do link clicado
    var URL_pagina = $(this).attr('href');

    $.ajax({
      //define o método da requisição
      method: 'GET',
      //define a url da requisição
      url: URL_pagina,
      //define o tipo de retorno
      dataType: 'html',
      //em caso de sucesso da requisição à url, executa a rotina
      success:function(response){
        //se retornou algum conteúdo, então exibe dentro da div cujo ID é
        //RegistrosPagina, caso contrário exibe o texto informando que não
        //foram localizados os registros
        if(response){
              $('#RegistrosPagina').remove();
              var atualizaListagem = $(response).find('#RegistrosPagina');
              $('#ListagemRegistros').html(atualizaListagem);
        }else{
          $('#RegistrosPagina').html('<p class="alert alert-info">Nenhum registro localizado.</p>', function() {});
        }
      },
      //em caso de erro, diz que a página não existe
      error: function(){
        $('#RegistrosPagina').html('<p class="alert alert-info">Página inexistente</p>');
      }
    });

    //bloqueia a abertura da url definida no atributo href do link
    return false;
  });
});

/*CODIGO AJAX PARA AS BUSCAS*/
$(document).ready(function(){
  //Ao clicar em um link da paginação será executada essa rotina
  $("#busca").on("keyup",function(){

    //recupera a url do link clicado
    var URL_pagina = baseUrl+uri_string;

    $.ajax({
      //define o método da requisição
      method: 'GET',
      //define a url da requisição
      url: URL_pagina,
      //define o tipo de retorno
      dataType: 'html',
        data: {busca: $(this).val(), limitereg: $('#limitereg').val()},
      success: function (response) {
            //se retornou algum conteúdo, então exibe dentro da div cujo ID é
            //RegistrosPagina, caso contrário exibe o texto informando que não
            //foram localizados os registros
            if(response){
              $('#RegistrosPagina').remove();
              var atualizaListagem = $(response).find('#RegistrosPagina');
              $('#ListagemRegistros').html(atualizaListagem);
            }else{
              $('#RegistrosPagina').html('<p class="alert alert-info">Nenhum registro localizado.</p>', function() {});
            }   
        },
     error: function(){
        $('#RegistrosPagina').html('<p class="alert alert-info">Página inexistente</p>');
      }
    });

    //bloqueia a abertura da url definida no atributo href do link
    //return false;
  });
});

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
   $(".campoHora").mask("99:99");
    $("#campoCPF").mask("999.999.999-99");
   $("#campoCep").mask("99999-999");
   $("#campoSenha").mask("***-****");
   
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
    if($(".consultaInstituicao").length){
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
    }
});

$(document).ready(function() {
    
    if($(".consultaUnicoUsuario").length){
            $(".consultaUnicoUsuario").select2({
            tags: true,
            placeholder: "Buscar autor inscrito por nome",
            multiple: true,
            tokenSeparators: [','],
            minimumInputLength: 2,
            maximumSelectionLength: 1,
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
    }
});


$(document).ready(function() {
    
    if($(".consultaVariosUsuarios").length){
            $(".consultaVariosUsuarios").select2({
            tags: true,
            placeholder: "Buscar autor inscrito por nome",
            multiple: true,
            tokenSeparators: [','],
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
    }
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
    if($(".consultaConferencia").length){
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
    }
});

/**GERA O LINK DA NOVA EDIÇÃO**/
$(document).ready(function(){
  if($(".consultaConferencia").length){
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
  }
});

// /**CARREGA PLUGIN FILE UPLOAD BOOTSTRAP**/
  // initialize with defaults
$(document).ready(function(){
        
        function getImagem(imagem){
            $.ajax({    
                type: "POST",
                data: {link: $("#link_imagem").val()},
                url: baseUrl+'instituicao/resgataImagem',
                async: false,
                dataType: "json",
                success:function(data) {
                    imagem(data);
                }
            });
        }
        if($("#imagemInstituicao").length){
            getImagem(function(imagem){ 
                var input = $("#imagemInstituicao");
                if (input.data('fileinput')) {
                    input.fileinput('destroy');
                } 
                input.fileinput(imagem, 'refresh');
            });
        }
});

$(document).ready(function(){
        
        function getImagem(imagem){
            $.ajax({    
                type: "POST",
                data: {link: $("#link_imagem").val()},
                url: baseUrl+'edicao/resgataImagem',
                async: false,
                dataType: "json",
                success:function(data) {
                    imagem(data);
                }
            });
        }
        if($("#imagemEdicao").length){
            getImagem(function(imagem){ 
                var input = $("#imagemEdicao");
                if (input.data('fileinput')) {
                    input.fileinput('destroy');
                }
                input.fileinput(imagem, 'refresh');
            });
        }
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
        input.fileinput(anais,'refresh');
    }, function(resultados){
        var input = $("#arquivoResultados");
        if (input.data('fileinput')) {
            input.fileinput('destroy');
        }
        input.fileinput(resultados,'refresh');
    });
});

/* Upload de Diretrizes de Submissão e Revisão*/
 $(document).ready(function(){
    var codigoEdicao = $('#codigoEdicao').val();
    
    function getSubmissaoRevisao(submissao, revisao){
        $.ajax({    
        type: "POST",
        url: baseUrl+'edicao/consulta-regras-submissao-e-revisao/' + codigoEdicao,
        async: false,
        dataType: "json",
        success: function(data) {
            console.log(data);
             submissao(data.submissao);
             revisao(data.revisao);
        }});
    }
    
    if($("#dire_submissao").length && $("#dire_revisao").length){
        getSubmissaoRevisao(function(submissao){
            var input = $("#dire_submissao");
            if (input.data('fileinput')) {
                input.fileinput('destroy');
            }
            input.fileinput(submissao,'refresh');
        }, function(revisao){
            var input = $("#dire_revisao");
            if (input.data('fileinput')) {
                input.fileinput('destroy'); 
            }
            input.fileinput(revisao,'refresh');
        });
    }
});


// /**CARREGA PLUGIN FILE UPLOAD para upload de arquivos pdf doc etc BOOTSTRAP**/
$(document).ready(function(){
        
        function getArquivo(input,arquivo){
            $.ajax({    
                type: "POST",
                data: {link: $(input).val()},
                url: baseUrl+'submissao/obtemDadosArtigo',
                async: false,
                dataType: "json",
                success:function(data) {
                    data.previewFileExtSettings = [{ "doc" : function(ext) {
                        return ext.match(/(doc|docx)$/i);
                    }}];
                    arquivo(data);
                }
            });
        }
        var linkSemIdent = '#linkArqSemIdent';
        var linkComIdent = '#linkArqComIdent';
        if($("#arqSemIdent").length && $("#arqComIdent").length){
            getArquivo(linkSemIdent,function(arquivo){ 
                var input = $("#arqSemIdent");
                if (input.data('fileinput')) {
                    input.fileinput('destroy');
                }
                input.fileinput(arquivo,'refresh');
            });

            getArquivo(linkComIdent,function(arquivo){ 
                var input = $("#arqComIdent");
                if (input.data('fileinput')) {
                    input.fileinput('destroy');
                }
                input.fileinput(arquivo, 'refresh');
            });
        }
});

/** IMPLANTA O SELECT2 NA CONSULTA DE COMITÊS **/
$(document).ready(function() {
    if($(".consultaComite").length){
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
    }
});

/** IMPLANTA O SELECT2 NA CONSULTA DE E-mails **/
$(document).ready(function() {
    
    if($(".consultaEmails").length){
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
    }
});

/** IMPLANTA O SELECT2 NA CONSULTA DE REVISORES **/
$(document).ready(function() {
    if($(".consultaRevisores").length){
            $(".consultaRevisores").select2({
            minimumInputLength: 2,
            minimumResultsForSearch: Infinity,
            ajax: {
                url: baseUrl + "revisor/consultarRevisorSelect2",
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
    }
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




