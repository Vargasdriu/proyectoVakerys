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
.fondo{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.35);
    opacity:0;
    visibility:hidden;
    transition:.3s ease;
    z-index:998;
}
.fondo.activo{
    opacity:1;
    visibility:visible;
}
.sidebar{
    position:fixed;
    top:0;
    right:0;
    width:380px;
    max-width:90%;
    height:100vh;
    background:#f5f6f1;
    box-shadow:-5px 0 20px rgba(0,0,0,.15);
    transform:translateX(100%);
    transition:transform .35s ease;
    z-index:999;
    display:flex;
    flex-direction:column;
}
.sidebar.activo{
    transform:translateX(0);
}
.cabeceraCarrito{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:25px;
    background:#1d3021;
    color:white;
}
.cabeceraCarrito h2{
    margin:0;
    font-family:'Raleway',sans-serif;
    font-size:24px;
}
#cerrarCarrito{
    border:none;
    background:transparent;
    color:white;
    font-size:32px;
    cursor:pointer;
    line-height:1;
}
.contenidoCarrito{
    flex:1;
    overflow-y:auto;
    padding:20px;
}
.productoCarrito{
    background:white;
    border-radius:15px;
    padding:15px;
    margin-bottom:12px;
    box-shadow:0 3px 10px rgba(0,0,0,.08);
}
.productoCarrito h3{
    margin:0 0 8px;
    color:#1d3021;
    font-size:17px;
}
.productoCarrito p{
    margin:4px 0;
    color:#59645b;
    font-size:14px;
}
.pieCarrito{
    padding:20px;
    background:#cbd1c2;
    border-top:1px solid #b5bdad;
}
.resumenCarrito{
    display:flex;
    justify-content:space-between;
    margin-bottom:8px;
    color:#405044;
    font-size:14px;
}
#totalCarrito{
    margin:5px 0 18px;
    color:#1d3021;
    font-size:20px;
}
#comprar{
    width:100%;
    border:none;
    border-radius:12px;
    padding:14px;
    background:#1d3021;
    color:white;
    font-family:'Raleway',sans-serif;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    transition:.3s ease;
}
#comprar:hover{
    background:#29432d;
    transform:translateY(-2px);
}
#vaciarCarrito{
    width:100%;
    margin-top:10px;
    padding:10px;
    border:1px solid #1d3021;
    border-radius:12px;
    background:transparent;
    color:#1d3021;
    font-family:'Raleway',sans-serif;
    cursor:pointer;
    transition:.3s ease;
}
#vaciarCarrito:hover{
    background:#1d3021;
    color:white;
}
.carrito{
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
}
.carrito img{
    width:32px;
    height:32px;
    object-fit:contain;
    transition:.3s ease;
}
.carrito:hover img{
    transform:scale(1.1);
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
#btn-nav:checked ~ nav .menu li:nth-child(5){
    transition-delay:.25s;
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
.modoaccesible{
    display:flex !important;
    align-items:center;
    justify-content:center;
    gap:8px;
    margin:12px !important;
    padding:12px 16px !important;
    background:#f4d35e !important;
    color:#1d3021 !important;
    border:2px solid #1d3021;
    border-radius:30px;
    font-weight:700 !important;
    text-align:center;
    box-shadow:0 3px 0 #1d3021;
    transition:all .2s ease !important;
}
.menu a.modoaccesible:hover{
    background:#ffe477 !important;
    color:#1d3021 !important;
    padding-left:16px !important;
    transform:translateY(-2px);
    box-shadow:0 5px 0 #1d3021;
}
.modoaccesible:active{
    transform:translateY(1px);
    box-shadow:0 2px 0 #1d3021;
}
.modoaccesible:focus{
    outline:3px solid white;
    outline-offset:3px;
}
/* ===== CONSULTAR PEDIDO INTEGRADO AL MENÚ ===== */
.s {
    display: flex !important;
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 10px !important;
    width: 100% !important;
    padding: 14px 15px !important;
    margin: 0 !important;
    background: transparent !important;
    border: none !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    box-sizing: border-box !important;
}
.s #mensaje-consulta {
    font-family: 'Raleway', sans-serif !important;
    font-size: 18px !important;
    font-weight: 700 !important;
    color: #ffffff !important;
    text-align: left !important;
}
/* Título integrado con los enlaces del menú */
.s p {
    margin: 0 !important;
    padding: 0 0 8px !important;
    color: #ffffff !important;
    font-family: 'Raleway', sans-serif !important;
    font-size: 14px !important;
    line-height: 1.5 !important;
    text-align: left !important;
}
/* Sin adornos ni tarjetas */
.s p::after {
    display: none !important;
}
/* Formulario compacto */
.s form {
    display: flex !important;
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 9px !important;
    width: 100% !important;
    margin: 0 !important;
}
.s form br {
    display: none !important;
}
/* Campo sencillo */
.s input[type="number"],
.s input#numeroPedido {
    width: 100% !important;
    max-width: 100% !important;
    height: 39px !important;
    padding: 0 11px !important;
    margin: 0 !important;
    background: rgba(255, 255, 255, 0.08) !important;
    color: #ffffff !important;
    font-family: 'Raleway', sans-serif !important;
    font-size: 12px !important;
    border: 1px solid rgba(175, 193, 148, 0.35) !important;
    border-radius: 7px !important;
    outline: none !important;
    box-shadow: none !important;
    box-sizing: border-box !important;
    transition: .25s ease !important;
}
.s input[type="number"]::placeholder {
    color: #d0d8c9 !important;
    opacity: 1 !important;
}
.s input[type="number"]:focus {
    background: rgba(255, 255, 255, 0.13) !important;
    border-color: #afc194 !important;
    box-shadow: 0 0 0 2px rgba(175, 193, 148, 0.12) !important;
}
.s input[type="number"]::-webkit-inner-spin-button,
.s input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.s input[type="number"] {
    appearance: textfield;
    -moz-appearance: textfield;
}
/* Botón discreto, a juego con el menú */
.s button,
.s button#consultar {
    width: 100% !important;
    min-height: 37px !important;
    padding: 9px 10px !important;
    margin: 0 !important;
    background: #afc194 !important;
    color: #1d3021 !important;
    font-family: 'Raleway', sans-serif !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    border: none !important;
    border-radius: 7px !important;
    box-shadow: none !important;
    cursor: pointer !important;
    transition: background .25s ease !important;
}
.s button:hover {
    background: #d0dbbd !important;
    transform: none !important;
    box-shadow: none !important;
}
/* Resultado sin una caja grande */
.s #resultado {
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 !important;
    padding: 8px 0 !important;
    background: transparent !important;
    color: #f5f7f2 !important;
    border: none !important;
    border-top: 1px solid rgba(175, 193, 148, 0.25) !important;
    border-radius: 0 !important;
    font-family: 'Raleway', sans-serif !important;
    font-size: 12px !important;
    line-height: 1.6 !important;
    overflow-wrap: anywhere !important;
    box-sizing: border-box !important;
}
@media (max-width: 576px) {
    .s {
        padding: 12px 15px !important;
        gap: 9px !important;
    }
    .s p {
        font-size: 13px !important;
    }
}
@media (max-width:576px){
    .sidebar{
        width:100%;
        max-width:100%;
    }
    .cabeceraCarrito{
        padding:20px;
    }
    .contenidoCarrito{
        padding:15px;
    }
    .pieCarrito{
        padding:15px;
    }
}
</style>
<?php if (!empty($_SESSION['textoGrande'])) { ?>
<style>
.main-header .menu a { font-size:20px !important; }
.main-header .modoaccesible { font-size:20px !important; }
.main-header .s p { font-size:18px !important; }
.main-header .s #mensaje-consulta { font-size:22px !important; }
.main-header .s input { font-size:18px !important; }
.main-header .s button { font-size:18px !important; }
.main-header .s #resultado { font-size:18px !important; }
.main-header .cabeceraCarrito h2 { font-size:28px !important; }
.main-header .productoCarrito h3 { font-size:22px !important; }
.main-header .productoCarrito p { font-size:18px !important; }
.main-header .resumenCarrito { font-size:18px !important; }
.main-header #totalCarrito { font-size:24px !important; }
.main-header #comprar, .main-header #vaciarCarrito { font-size:18px !important; }
</style>
<?php } ?>
<header class="main-header">
    <a href="/proyectovakerys/paginadeinicio.php">
        <img src="/proyectovakerys/imagenes/logo.png" alt="Logo Vakery's">
    </a>
    <label for="btn-nav" class="btn-nav">
        <img src="/proyectovakerys/imagenes/menu.png" alt="Abrir menú de navegación">
    </label>
    <a href="#" name="carrito" id="carrito" class="carrito" aria-label="Abrir carrito">
        <img src="/proyectovakerys/imagenes/anadir-al-carrito.png" alt="Carrito">
    </a>
    <input type="checkbox" id="btn-nav">
    <nav aria-label="Menú principal">
        <ul class="menu">
            <li>
                <a href="/proyectovakerys/paginadeinicio.php">
                    Inicio
                </a>
            </li>
            <li>
                <a href="/proyectovakerys/paginanosotros.php">
                    Quiénes somos
                </a>
            </li>
            <li>
                <a href="/proyectovakerys/paginasproductos/productos.php">
                    Productos
                </a>
            </li>
            <li>
                <a href="/proyectovakerys/usuarios/login.php">
                    Iniciar sesión
                </a>
            </li>
            <li>
                <a name="modoaccesible" href="/proyectovakerys/modoaccesible.php"  class="modoaccesible" aria-label="Abrir modo accesible">
                    Modo accesible
                </a>
            </li>
            <li>
    <div class="s">
  <p id="mensaje-consulta">
    ¿TIENES UN PEDIDO PENDIENTE?
  </p>
    <p>
        Consulta el estado de tu pedido
    </p>
    <form action="/proyectovakerys/paginasproductos/consultar_pagina.php" method="GET">
        <input
            type="number"
            name="id"
            placeholder="Número de pedido"
            min="1"
            required
        >
        <br>
        <button type="submit">
            Consultar pedido
        </button>
    </form>
</div>
            </li>
        </ul>
    </nav>
    <div id="fondo" class="fondo"></div>
    <aside id="sidebar" class="sidebar" aria-label="Carrito de compras">
        <div class="cabeceraCarrito">
            <h2>Mi carrito</h2>
            <button id="cerrarCarrito"
                    type="button"
                    aria-label="Cerrar carrito">
                &times;
            </button>
        </div>
        <div id="contenidoCarrito" class="contenidoCarrito">
        </div>
        <div class="pieCarrito">
            <div class="resumenCarrito">
                <span>Productos:</span>
                <span id="cantidadCarrito">
                    0
                </span>
            </div>
            <h3 id="totalCarrito">
                Total: Bs 0.00
            </h3>
            <button id="comprar" type="button">
                Finalizar compra
            </button>
            <button id="vaciarCarrito" type="button">
                Vaciar carrito
            </button>
        </div>
    </aside>
</header>
