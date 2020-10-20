<style>
    .rodape {
        position: absolute;
        height: 40px;
        width: 100%;
        bottom:0px;
        background: {{ Session::get('cor_topo_rodape')}} !important;;
    }

    .box_rodape {
        width: 360px !important;
        text-align: center;
    }
</style>
<footer>
    <div class="rodape"></div>
</footer>
</html>