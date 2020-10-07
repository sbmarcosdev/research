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
