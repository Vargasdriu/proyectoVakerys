<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Raleway',sans-serif;
}

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

nav{
    position:absolute;

    top:75px;
    left:0;

    color:white;
    width:220px;
    height:calc(100vh - 75px);

    background:rgba(29,48,33,.95);

    backdrop-filter:blur(8px);

    transform:translateX(-100%);
    transition:.4s ease;

    z-index:9999;
}

.carrito{
    position:absolute;
    right:20px;

    width:40px;
    height:40px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:8px;

    transition:.3s ease;
}

.carrito img{
    width:35px;
    height:35px;
    object-fit:contain;
}

.carrito:hover{
    background:rgba(255,255,255,.18);
    transform:scale(1.05);
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
/* ==============================
   FONDO DEL CARRITO
============================== */

.fondo {
    position: fixed;
    inset: 0;

    background: rgba(0, 0, 0, 0.35);

    opacity: 0;
    visibility: hidden;

    transition: 0.3s ease;

    z-index: 998;
}

.fondo.activo {
    opacity: 1;
    visibility: visible;
}


/* ==============================
   SIDEBAR
============================== */

.sidebar {
    position: fixed;

    top: 0;
    right: 0;

    width: 380px;
    max-width: 90%;

    height: 100vh;

    background: #f5f6f1;

    box-shadow: -5px 0 20px rgba(0, 0, 0, 0.15);

    transform: translateX(100%);

    transition: transform 0.35s ease;

    z-index: 999;

    display: flex;
    flex-direction: column;
}

.sidebar.activo {
    transform: translateX(0);
}


/* ==============================
   CABECERA
============================== */

.cabeceraCarrito {
    display: flex;

    align-items: center;
    justify-content: space-between;

    padding: 25px;

    background: #1d3021;

    color: white;
}

.cabeceraCarrito h2 {
    margin: 0;

    font-family: 'Raleway', sans-serif;

    font-size: 24px;
}

#cerrarCarrito {
    border: none;

    background: transparent;

    color: white;

    font-size: 32px;

    cursor: pointer;

    line-height: 1;
}


/* ==============================
   CONTENIDO
============================== */

.contenidoCarrito {
    flex: 1;

    overflow-y: auto;

    padding: 20px;
}


/* PRODUCTOS */

.productoCarrito {
    background: white;

    border-radius: 15px;

    padding: 15px;

    margin-bottom: 12px;

    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
}

.productoCarrito h3 {
    margin: 0 0 8px;

    color: #1d3021;

    font-size: 17px;
}

.productoCarrito p {
    margin: 4px 0;

    color: #59645b;

    font-size: 14px;
}


/* ==============================
   PIE
============================== */

.pieCarrito {
    padding: 20px;

    background: #cbd1c2;

    border-top: 1px solid #b5bdad;
}


.resumenCarrito {
    display: flex;

    justify-content: space-between;

    margin-bottom: 8px;

    color: #405044;

    font-size: 14px;
}


#totalCarrito {
    margin: 5px 0 18px;

    color: #1d3021;

    font-size: 20px;
}


/* ==============================
   BOTÓN COMPRAR
============================== */

#comprar {
    width: 100%;

    border: none;

    border-radius: 12px;

    padding: 14px;

    background: #1d3021;

    color: white;

    font-family: 'Raleway', sans-serif;

    font-size: 15px;

    font-weight: 600;

    cursor: pointer;

    transition: 0.3s ease;
}

#comprar:hover {
    background: #29432d;

    transform: translateY(-2px);
}


/* ==============================
   BOTÓN VACIAR
============================== */

#vaciarCarrito {
    width: 100%;

    margin-top: 10px;

    padding: 10px;

    border: 1px solid #1d3021;

    border-radius: 12px;

    background: transparent;

    color: #1d3021;

    font-family: 'Raleway', sans-serif;

    cursor: pointer;

    transition: 0.3s ease;
}

#vaciarCarrito:hover {
    background: #1d3021;

    color: white;
}


/* ==============================
   CARRITO DEL MENÚ
============================== */

.carrito {
    display: flex;

    align-items: center;
    justify-content: center;

    cursor: pointer;
}

.carrito img {
    width: 32px;
    height: 32px;

    object-fit: contain;

    transition: 0.3s ease;
}

.carrito:hover img {
    transform: scale(1.1);
}



@media (max-width: 600px) {

    .sidebar {
        width: 100%;
        max-width: 100%;
    }

    .cabeceraCarrito {
        padding: 20px;
    }

    .contenidoCarrito {
        padding: 15px;
    }

    .pieCarrito {
        padding: 15px;
    }
}
#btn-nav:checked ~ nav .menu li{
    opacity:1;
    transform:translateX(0);
}

#btn-nav:checked ~ nav .menu li:nth-child(1){
    transition-delay:.05s;
}

#btn-nav:checked ~ nav .menu li:nth-child(2){
    transition-delay:.10s;
}

#btn-nav:checked ~ nav .menu li:nth-child(3){
    transition-delay:.15s;
}

#btn-nav:checked ~ nav .menu li:nth-child(4){
    transition-delay:.20s;
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

    <a href="#" name="carrito" id="carrito" class="carrito">
        <img src="/proyectovakerys/imagenes/anadir-al-carrito.png" alt="Carrito">
    </a>

    <input type="checkbox" id="btn-nav">

    <nav>

        <ul class="menu">

            <li>
                <a href="/proyectovakerys/paginadeinicio.php">Inicio</a>
            </li>

            <li>
                <a href="/proyectovakerys/paginanosotros.php">Quiénes somos</a>
            </li>

            <li>
                <a href="/proyectovakerys/paginasproductos/productos.php">Productos</a>
            </li>

            <li>
                <a href="/proyectovakerys/usuarios/login.php">Iniciar sesión</a>
            </li>

        </ul>

    </nav>
<!-- ==============================
     CARRITO
============================== -->

<div id="fondo" class="fondo"></div>

<aside id="sidebar" class="sidebar">

    <div class="cabeceraCarrito">

        <h2>Mi carrito</h2>

        <button id="cerrarCarrito" type="button">
            &times;
        </button>

    </div>


    <div id="contenidoCarrito" class="contenidoCarrito">
        <!-- Aquí aparecerán los productos -->
    </div>


    <div class="pieCarrito">

        <div class="resumenCarrito">

            <span>Productos:</span>

            <span id="cantidadCarrito">0</span>

        </div>


        <h3 id="totalCarrito">
            Total: Bs 0.00
        </h3>

    <a href="recibo.php">
        <button id="comprar" type="button">
            Finalizar compra
        </button>
</a>

        <button id="vaciarCarrito" type="button">
            Vaciar carrito
        </button>

    </div>

</aside>
</header>
