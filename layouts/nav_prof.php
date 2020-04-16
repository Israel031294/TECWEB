<nav class="blue darken-4">
    <div class="nav-wrapper">
        <a href="" class="brand-logo">CACEI</a>
        <a href="#" data-target="movil" class="sidenav-trigger"><i class="fa fa-bars fa-2x"></i></a>
        <ul id="nav-movile" class="right hide-on-med-and-down">
            <li><a href="">Perfil</a></li>
            <li><a id="salir">Salir</a></li>
        </ul>
    </div>
</nav>
<ul class="sidenav" id="movil">
    <li><a href="">Perfil</a></li>
    <li><a id="salirM">Salir</a></li>
</ul>

<div id="s">
    <script>
        $(".sidenav").sidenav();
        $("#s").remove();
    </script>
</div>