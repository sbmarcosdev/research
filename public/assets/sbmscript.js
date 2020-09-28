function jsTeste(id) {

    var vDel = confirm("Deseja Realmente Excliur o id: " + id);

    if (vDel)           
             window.location = "teste";
        else 
            window.location = "home";
    }

function jsOption(opt) {
    
    if (opt =='1'){
        $('#op1').prop("selected", true);
    }
    else if (opt == '2'){
        $('#op2').prop("selected", true);
    }
    else if (opt == '3'){
        $('#op3').prop('selected', true);
    }
    else if (opt == '4'){
        $('#op4').prop("selected", true);
    }
    else if (opt == '5') {
        $('#op5').prop("selected", true);
    } else if (opt == '6') {
        $('#op6').prop("selected", true);
    }                        
}

function jsSelect() {

    if ($('#op4').prop("selected")) {

        $('#modalOpcoes').modal('show');
    }
}

function jsRedir(){

    window.location = "/dados/create";    
}


function jsDelete(id) {
    window.location = "/dados/excluir/" + id;
}

function jsDelete_Token() {

    id = $('#campo_id').val();
    let formData = new FormData();
    
    const token = document
        .querySelector(`input[name="_token"]`)
        .value;
    formData.append('id', id);    
    formData.append('_token', token);
    
    const url = `/dados/${id}`;
    fetch(url, {
        method: 'DELETE',
        body: formData
    });
}

function jsSimNao(v){

    $('#sim_nao').val(v);
}

function alertaSalvar() {
    Swal.fire({
    title: 'Sucesso!',
    text: 'Dados Gravados',
    icon: 'success'
    })  
} 

function alertFim(msg) {
    Swal.fire({
        title: 'Sucesso!',
        text: msg,
        icon: 'success'
    }).then((result) => {
        if (result.value) {
              //
        }
    })        
} 

function confirmaDelete() {

    id = $('#campo_id').val();
    
    Swal.fire({
        title: 'Confirma Exclusão?',
        text: "Esta ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, Excluir!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                    jsDelete(id);
                }
                else 
                window.location = "/dados";
        })        
}

