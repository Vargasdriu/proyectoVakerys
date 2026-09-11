<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Raleway', sans-serif;
}

.main-header {
    width: 100%;
    height: 75px;
    background: #afc194;
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 10000;
}

.main-header img {
    max-height: 55px;
    transition: .4s ease;
}

.main-header img:hover {
    transform: scale(1.05);
}

.btn-nav {
    position: absolute;
    left: 20px;
    cursor: pointer;
}

.btn-nav img {
    width: 30px;
    height: 30px;
}

#btn-nav {
    display: none;
}

nav {
    position: absolute;
    top: 75px;
    left: 0;
    color: white;
    width: 240px;
    height: calc(100vh - 75px);
    background: rgba(29, 48, 33, .97);
    backdrop-filter: blur(8px);
    transform: translateX(-100%);
    transition: .4s ease;
    z-index: 9999;
}

#btn-nav:checked ~ nav {
    transform: translateX(0);
}

.menu {
    padding: 0;
}

.menu li {
    list-style: none;
    border-bottom: 1px solid rgba(255,255,255,.2);
    opacity: 0;
    transform: translateX(-20px);
    transition: .4s ease;
}

#btn-nav:checked ~ nav .menu li {
    opacity: 1;
    transform: translateX(0);
}

#btn-nav:checked ~ nav .menu li:nth-child(1) {
    transition-delay: .05s;
}

#btn-nav:checked ~ nav .menu li:nth-child(2) {
    transition-delay: .10s;
}

#btn-nav:checked ~ nav .menu li:nth-child(3) {
    transition-delay: .15s;
}

#btn-nav:checked ~ nav .menu li:nth-child(4) {
    transition-delay: .20s;
}

#btn-nav:checked ~ nav .menu li:nth-child(5) {
    transition-delay: .25s;
}

#btn-nav:checked ~ nav .menu li:nth-child(6) {
    transition-delay: .30s;
}

#btn-nav:checked ~ nav .menu li:nth-child(7) {
    transition-delay: .35s;
}

.menu a {
    display: block;
    padding: 18px 20px;
    color: white;
    text-decoration: none;
    transition: .3s ease;
    font-size: 15px;
}

.menu a:hover {
    background: rgba(255,255,255,.08);
    padding-left: 30px;
    box-shadow: inset 4px 0 0 #afc194;
}

.tipoUsuario {
    position: absolute;
    right: 25px;
    color: #1d3021;
    font-weight: 600;
    font-size: 15px;
}


/@media (max-width: 576px) {

    .main-header {
        width: 92%;
        height: 65px;
        left: 4%;
        top: 10px;
        border-radius: 15px;
        padding: 0 15px;
    }

    .main-header > img {
        max-height: 45px;
        max-width: 140px;
    }

    .btn-nav {
        left: 15px;
    }

    .btn-nav img {
        width: 27px;
        height: 27px;
    }

    .tipoUsuario {
        right: 15px;
        font-size: 12px;
    }

    nav {
        top: 75px;
        width: 92%;
        left: 4%;
        height: calc(100vh - 85px);
        border-radius: 0 0 15px 15px;
    }

    .menu a {
        padding: 15px 20px;
        font-size: 14px;
    }

}

</style>


<header class="main-header">

    <img src="/proyectovakerys/imagenes/logo.png" alt="Logo Vakery's">

    <label for="btn-nav" class="btn-nav">
        <img src="/proyectovakerys/imagenes/menu.png" alt="Menú">
    </label>

    <input type="checkbox" id="btn-nav">

    <nav>

        <ul class="menu">

            <li>
                <a href="/proyectovakerys/paginaadmin.php">
                    Panel
                </a>
            </li>

            <li>
                <a href="/proyectovakerys/reportes.php">
                    Reportes
                </a>
            </li>

            <li>
                <a href="/proyectovakerys/Productos/leerproductos.php">
                    Productos
                </a>
            </li>

            <li>
                <a href="/proyectovakerys/Pedidos/leerpedido.php">
                    Pedidos
                </a>
            </li>

            <li>
                <a href="/proyectovakerys/Ventas/leerventa.php">
                    Ventas
                </a>
            </li>

            <li>
                <a href="/proyectovakerys/Usuarios/leerusuario.php">
                    Usuarios
                </a>
            </li>

            <li>
                <a href="/proyectovakerys/Usuarios/cerrarsesion.php">
                    Cerrar sesión
                </a>
            </li>

        </ul>

    </nav>

    <div class="tipoUsuario">
        Administrador
    </div>

</header>
