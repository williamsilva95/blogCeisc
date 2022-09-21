$(document).ready(function(){
    $.when(init());

    if(sessionStorage.getItem('columns')) {

        var ocultarColunas = JSON.parse(sessionStorage.getItem('columns'));

        // if(ocultarColunas.length == 11){
        //     $(".ocultar-colunas .select-all").click();
        // } else {
        $(ocultarColunas).each(function(index, el) {
            disabledColumnTable($(".ocultar-colunas").find("a:contains('"+ el +"')"),el);
        });
        // }
        // console.log(data);
        //Colocar o valor no input, ou seja lá o que quer fazer
    }

});

$(".dropdown-table a").click(function(event) {
    return false;
});

function disabledAllColumns(element){
    var a        = $(element);
    var hidden   = a.attr("data-hidden");

    if(hidden == "false"){
        a.find(".table-check-esc").css("background", "transparent");
        a.attr("data-hidden", "true");
    }
    else if(hidden == "true"){
        a.find(".table-check-esc").css("background", "#3c8dbc");
        a.attr("data-hidden", "false");
    }

    $(".ocultar-colunas a").each(function(i, el) {
        if(i > 0){
            disabledColumnTable(el, $(el).text(), hidden);
        }
    });
}

var dados = [];

function disabledColumnTable(element, name, hiddenAll = null){
    var a        = $(element);
    var hidden   = a.attr("data-hidden");
    var position;
    var indexOnDados;

    $("table.table tr th").each(function(index, el) {
        if($(el).text() == name){
            position = index;
        }
    });

    dados.forEach(function (index , element) {
        if(index == name) {
            indexOnDados = element;
        }
    });

    if(hiddenAll == null){
        if (dados.includes(name)) {
            dados.splice(indexOnDados, 1);
        } else {
            dados.push(name);
        }
    } else {
        if(hiddenAll == "false"){
            if (!dados.includes(name)) {
                dados.push(name);
            }
        }

        else if(hiddenAll == "true"){
            dados.splice(indexOnDados, 1);
        }
    }


    var colunas = JSON.stringify(dados);
    sessionStorage.setItem('columns', colunas);

    if(hiddenAll == null){
        if(hidden == "false"){
            var label = a.find(".table-check-esc");
            label.css("background", "transparent");
            $("table tr th:eq("+position+")").hide();
            $("table tbody tr").each(function(index, element) {
                $(element).find("td:eq("+position+")").hide();
            });
            a.attr("data-hidden", "true");
        }

        else if(hidden == "true"){
            var label = a.find(".table-check-esc");
            label.css("background", "#3c8dbc");
            $("table tr th:eq("+position+")").fadeIn();
            $("table tbody tr").each(function(index, element) {
                $(element).find("td:eq("+position+")").fadeIn();
            });
            a.attr("data-hidden", "false");
        }
    }
    else {
        if(hiddenAll == "false"){
            var label = a.find(".table-check-esc");
            label.css("background", "transparent");
            $("table tr th:eq("+position+")").hide();
            $("table tbody tr").each(function(index, element) {
                $(element).find("td:eq("+position+")").hide();
            });
            a.attr("data-hidden", "true");
        }

        else if(hiddenAll == "true"){
            var label = a.find(".table-check-esc");
            label.css("background", "#3c8dbc");
            $("table tr th:eq("+position+")").fadeIn();
            $("table tbody tr").each(function(index, element) {
                $(element).find("td:eq("+position+")").fadeIn();
            });
            a.attr("data-hidden", "false");
        }
    }

}

// function verificaCheck(name) {
//     var index = -1;
//     var obj = JSON.parse(sessionStorage.getItem("columns")) || {};
//
//     $(obj).each(function(index, el) {
//         console.log(name, el);
//         if(name == el){
//             obj.splice(index, 1);
//         }
//     });
//     localStorage.setItem("columns", JSON.stringify(obj)); //reescreve a localStorage
// }

function init(){
    $(".dropdown-table .dropdown-menu a").each(function(position, element_a){
        if($(element_a).attr("data-hidden") == "true"){
            var position_tr_td;
            $("table.table-hidden-column tr th").each(function(position_tr, element_th) {
                if($(element_th).text() == $(element_a).text()){
                    position_tr_td = position_tr;
                    return false;
                }
            });

            $("table.table-hidden-column tr th:eq("+position_tr_td+")").hide();
            $("table.table-hidden-column tbody tr").each(function(index, element_tr) {
                $(element_tr).find("td:eq("+position_tr_td+")").hide();
            });

            $(element_a).find(".table-check-esc").css("background", "transparent");
        }
    });
}
