function jsOption(opt) {
        
        $('#op'+opt).prop("selected", true);
                            
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
    })
} 


function showPreview(objFileInput) {
    if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {

            $("#targetLayer").html('<img src="' + e.target.result + '"  style="height: 60px">');
 

        }
        fileReader.readAsDataURL(objFileInput.files[0]);
    }
    $("#div_arquivo_logo").html(objFileInput.files[0].name);
}


function jsBannerPreview(objFileInput) {
    if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $("#div_banner").html('<img src="' + e.target.result + '" width="500px" >');
        }
        fileReader.readAsDataURL(objFileInput.files[0]);
    }
    $("#div_arquivo_banner").html(objFileInput.files[0].name);
}


function jsExcluiImportacao(url) {
    swal.fire({
        title: 'Tem Certeza que deseja excluir os dados importados para esta campanha ?',
        text: "Esta ação não pode ser desfeita!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, Excluir!',
        cancelButtonText: 'Cancelar!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
            swal.fire(
                'Exclusão efetuada'
            )
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swal.fire('Exclusão Cancelada')
        }
    })
}