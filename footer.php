<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Footer Vakery's</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Raleway', sans-serif;
}

.footer{
    background:#1f2d25;
    color:#e9ecef;
    padding:60px 40px 20px;
}


.footer-container{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap:40px;
    max-width:1100px;
    margin:auto;
}

.footer-col h2.logo{
    font-size:24px;
    margin-bottom:10px;
    color:#A3B18A;
}


.footer-col h3{
    font-size:13px;
    margin-bottom:15px;
    text-transform:uppercase;
    letter-spacing:1px;
    color:#A3B18A;
}


.footer-col p,
.footer-col a{
    font-size:14px;
    color:#cfd6d3;
    text-decoration:none;
    display:block;
    margin-bottom:8px;
    transition:.2s;
}

.footer-col a:hover{
    color:#ffffff;
    transform: translateX(4px);
}


.divider{
    height:1px;
    background:rgba(255,255,255,0.12);
    margin:35px auto 20px;
    max-width:800px;
}


.footer-bottom{
    text-align:center;
    font-size:12px;
    color:#9aa5a1;
}

.desc{
    line-height:1.6;
    max-width:260px;
}

</style>
</head>

<body>

<footer class="footer">

    <div class="footer-container">

        <!-- Marca -->
        <div class="footer-col">
            <h2 class="logo">Vakery’s</h2>
            <p class="desc">
                Repostería artesanal enfocada en calidad, frescura y diseño.
                Creamos experiencias dulces para cada ocasión.
            </p>
        </div>

        <!-- Navegación -->
        <div class="footer-col">
            <h3>Navegación</h3>
            <a href="#">Inicio</a>
            <a href="#">Productos</a>
            <a href="#">Sobre nosotros</a>
            <a href="#">Contacto</a>
        </div>

        <!-- Contacto -->
        <div class="footer-col">
            <h3>Contacto</h3>
            <p>Cochabamba, Bolivia</p>
            <p>+591 70000000</p>
            <p>vakerys@gmail.com</p>
        </div>

        <!-- Redes -->
        <div class="footer-col">
            <h3>Redes sociales</h3>
            <a href="https://www.instagram.com/vakerys?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">Instagram</a>
            <a href="#">Facebook</a>
            <a href="#">TikTok</a>
        </div>

    </div>

    <div class="divider"></div>

    <div class="footer-bottom">
        <p>© 2026 Vakery’s. Todos los derechos reservados.</p>
    </div>

</footer>

</body>
</html>