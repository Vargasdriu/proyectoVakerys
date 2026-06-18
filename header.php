<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Raleway',sans-serif;
}

/* HEADER */

.main-header{
    width:100%;
    height:75px;

    background:#afc194;

    display:flex;
    justify-content:center;
    align-items:center;

    position:fixed;
    top:0;
    left:0;

    z-index:10000;
}

.main-header img{
    max-height:55px;
    transition:.4s ease;
}

.main-header img:hover{
    transform:scale(1.05);
}

/* BOTÓN MENÚ */

.btn-nav{
    position:absolute;
    left:20px;

    cursor:pointer;
}

.btn-nav img{
    width:30px;
    height:30px;
}

#btn-nav{
    display:none;
}

/* MENÚ */

nav{
    position:absolute;

    top:75px;
    left:0;

    width:220px;
    height:calc(100vh - 75px);

    background:rgba(29,48,33,.95);

    backdrop-filter:blur(8px);

    transform:translateX(-100%);
    transition:.4s ease;

    z-index:9999;
}

#btn-nav:checked ~ nav{
    transform:translateX(0);
}

.menu{
    padding:0;
}

.menu li{
    list-style:none;

    border-bottom:1px solid rgba(255,255,255,.2);

    opacity:0;
    transform:translateX(-20px);

    transition:.4s ease;
}

#btn-nav:checked ~ nav .menu li{
    opacity:1;
    transform:translateX(0);
}

.menu a{
    display:block;

    padding:18px 15px;

    color:white;

    text-decoration:none;

    transition:.3s ease;
}

.menu a:hover{
    background:rgba(255,255,255,.08);

    padding-left:25px;

    box-shadow:inset 4px 0 0 #afc194;
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
            <li><a href="/proyectovakerys/paginadeinicio.php">Inicio</a></li>
            <li><a href="/proyectovakerys/paginanosotros.php">Quiénes somos</a></li>
            <li><a href="/proyectovakerys/paginaproductos.php">Productos</a></li>
            <li><a href="/proyectovakerys/usuarios/login.php">Iniciar sesión</a></li>
            
        </ul>
    </nav>

</header>