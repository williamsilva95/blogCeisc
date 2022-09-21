function inserir(){
    $.get("post/create", function(){
        window.location.href = "post/create"
    });
}

function editar(id){
    $.get("post/edit/" + id, function(resposta){
        window.location.href = "post/edit/" + id
    });
}

function visualizar(id){
    $.get("post/show/" + id, function(resposta){
        window.location.href = "post/show/" + id
    });
}

function deletar(id, titulo){

    swal({
        title: 'Excluir Postagem',
        text: 'Deseja realmente excluir essa Postagem:' + titulo + '?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim",
        cancelButtonText: "Não",
        closeOnConfirm: false,
        closeOnCancel: true
    }).then((result) => {
        if(result.value) {
            $.ajax({
                type: "POST",
                url: "post/destroy",
                data: {_token: _token, id: id},
                success: function(data){
                    if (data.success == true) {
                        swal({
                            title: data.msg,
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then((result) => {
                            location.reload();
                        });
                    }else{
                        swal("Post", data.msg , "error");
                    }
                    CustomPreload.hide();
                }, error: function(){
                    CustomPreload.hide();
                    swal("Funções", 'Não é permitido a exclusão da Postagem.' , "error");
                }
            }).fail(function(resposta) {
                if(resposta.status == 401){
                    CustomPreload.hide();
                    swal("Funções", "Sem permissão para acessar essa funcionalidade." , "error");
                }
            });
        }
    });
}
