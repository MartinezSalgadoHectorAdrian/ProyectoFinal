<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Taller Mecánico</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
  
    <link rel="stylesheet" href="styles.css" />
</head>
<body>



        <?php
session_start(); // Inicia la sesión
?>
<header class="top-header">
    <div class="logo">AutoTorque</div>
    <div class="user-info">
        <?php
        if (isset($_SESSION['nombre'])) {
            // Si el usuario está logueado, mostramos su nombre y el botón de "Cerrar sesión"
            echo "<p>Hola, " . $_SESSION['nombre'] . "!</p>";
            echo "<a href='cerrarSesion.php'>Cerrar sesión</a>";
        } else {
            // Si el usuario no está logueado, mostramos el enlace de "Iniciar sesión"
            echo "<a href='Login.php'>Iniciar sesión</a>";
        }
        ?>
    </div>
</header>
    
    
    <section id="showcase" class="showcase">
        <header class="main-header">
            <div class="container">
                <nav>
                    <ul class="nav-links">
                        <li><a href="#showcase">Inicio</a></li>
                        <li><a href="#nosotros">Nosotros</a></li>
                        <li><a href="#servicios">Servicios</a></li>
                        <li><a href="Cliente.php">Cliente</a></li>
                        <li><a href="SolicitarCita.php">Citas</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                        <li><a href="Mecanico.php">Mecanico</a></li>
                    </ul>
                </nav>
            </div>
        </header>
   


      <video src="vecteezy_car-brakes-are-damaged-brake-assist-repair-car-maintenance_8084908.mp4" autoplay muted loop playsinline></video>
      
      <div class="overlay"></div>
      <div class="text">
        
        <h3>Taller Mecanico</h3>
        <p>
          En AutoTorque, ofrecemos servicios mecánicos de calidad con un equipo
          experto y herramientas de última generación. Nos especializamos en
          mantenimiento, reparaciones y diagnóstico, garantizando transparencia,
          confianza y la mejor atención para que tu vehículo siempre esté en
          óptimas condiciones
        </p>
      </div>
      <ul class="social">
       
          <a href="https://www.bing.com/ck/a?!&&p=fb072892995a25550ecdd50a5237aad9126799a18f45329985a4b0eb2f02771dJmltdHM9MTczMzg3NTIwMA&ptn=3&ver=2&hsh=4&fclid=0f8b0efc-551f-6c53-2c75-1a2554f16d86&psq=gas+monkey+facebook&u=a1aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL0dhc01vbmtleUdhcmFnZS8&ntb=1"><img src="https://i.ibb.co/x7P24fL/facebook.png" /></a>
       
      
          <a href="https://www.bing.com/ck/a?!&&p=ad965bbfe2b3b598b590bb45be7cefe0d8d95b3b56f0e91713795bf794264bc9JmltdHM9MTczMzg3NTIwMA&ptn=3&ver=2&hsh=4&fclid=0f8b0efc-551f-6c53-2c75-1a2554f16d86&psq=gas+monkey+twitter&u=a1aHR0cHM6Ly90d2l0dGVyLmNvbS9HYXNNb25rZXlHYXJhZ2Uvc3RhdHVzLzE1MDQxMDk4MzM3MDM4OTkxMzk&ntb=1"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png" /></a>
  
          <a href="https://www.bing.com/ck/a?!&&p=ef8464d2be2f7ac5c1c71578f6f34afe6e6178b5bb1d09424ac2626eee9ba341JmltdHM9MTczMzg3NTIwMA&ptn=3&ver=2&hsh=4&fclid=0f8b0efc-551f-6c53-2c75-1a2554f16d86&psq=gas+monkey+instagram&u=a1aHR0cHM6Ly93d3cuaW5zdGFncmFtLmNvbS9nYXNtb25rZXlnYXJhZ2Uv&ntb=1"><img src="https://i.ibb.co/ySwtH4B/instagram.png" /></a>

      </ul>
    </section>

    <section id="servicios" class="roles">
      <div class="container">
          <h2>selecciona el servicio que desees</h2>
          <div class="role-cards">
              <div class="card">
               <h3>Mecanica</h3>
               <p1>El correcto funcionamiento de tu automóvil es nuestro compromiso. Contamos con una amplia diversidad de servicios en mecánica express, general y mayor que van desde alineación de ruedas hasta reparaciones de motor.</p1>   
              
              </div>
              <div class="card">
                  
                      <h3>Hojalateria y Pintura</h3>
                      <p1>¡Que tu auto no pierda el encanto! Si tu auto sufrió una colisión, golpe o abolladura, recupera aquí la imagen que lo hizo atraer tu atención cuando lo viste por primera vez. Conoce los servicios en hojalatería y pintura y haz que te vehículo vuelva a sonreír.</p1>   
                    
              </div>
              <div class="card">
                  
                      <h3>Electricidad Automotriz</h3>
                      <p1>Es de vital importancia que el sistema eléctrico de tu automóvil esté siempre en óptimas condiciones, por eso, en Carfix nos ocupamos de diagnosticar fallos y hacer remplazo de piezas necesarias para asegurar el buen funcionamiento del mismo.</p1>   
                     
              </div>
              <div class="card">
               <h3>Escaner</h3>
               <p1>Si tu auto presenta una luz encendida en el tablero, podemos hacer un diagnóstico exacto de las fallas con el escáner, una herramienta que nos sirve para realizar una lectura del historial de errores de tu vehículo que nos permite realizar una correcta reparación.</p1>   
            
              </div>
              <div class="card">
                  
                      <h3>Estética Automotriz</h3>
                      <p1>Un auto con buen funcionamiento es ideal, pero que tenga una excelente imagen es mucho mejor. En Carfix nos encargamos del lavado de interiores y exteriores, pulido y encerado y hasta lavado de motor.</p1>   
                     
              </div>
              <div class="card">
                  
                      <h3>Venta y montaje de llantas</h3>
                      <p1>Las llantas son uno de los puntos de seguridad más importantes en un automóvil. En Carfix contamos con diferentes servicios como alineación y balanceo, además, tenemos a la venta las mejores marcas de llantas en el mercado.</p1>   
                     
              </div>
          </div>
      </div>
      <a  href="SolicitarCita.php" class="btn-secondary">Solicitar Cotizacion</a>
    </section>

    <section id="info-cards" class="info-cards">
      <div class="card card-blue">
        <img src="https://img.freepik.com/foto-gratis/hombre-arreglando-motocicleta-taller-moderno_158595-8129.jpg?t=st=1733602477~exp=1733606077~hmac=784d4a7a729070a2f244aecc317850f05cb75ad626b9ce8368bdf7134ef2922b&w=740" alt="Reparación de motor" style="width:100%; border-radius: 8px;">
        <h2>Reparación de Motor</h2>
        <p>Realizamos diagnósticos y reparaciones completas de motores, desde el cambio de piezas hasta la reconstrucción de componentes internos.</p>
      </div>
      
      <div class="card card-blue">
        <img src="https://img.freepik.com/foto-gratis/alto-angulo-mecanico-masculino-cambiando-ruedas-coche_23-2148327562.jpg?ga=GA1.1.767762080.1733602454&semt=ais_hybrid" alt="Alineación de ruedas" style="width:100%; border-radius: 8px;">
        <h2>Alineación de Ruedas</h2>
        <p>Ofrecemos un servicio de alineación de ruedas para garantizar la correcta dirección y mayor durabilidad de las llantas de tu vehículo.</p>
      </div>
      
      <div class="card card-blue">
        <img src="https://img.freepik.com/foto-gratis/verter-aceite-mecanico-motor-coche_1170-1308.jpg?ga=GA1.1.767762080.1733602454&semt=ais_hybrid" alt="Cambio de aceite" style="width:100%; border-radius: 8px;">
        <h2>Cambio de Filtros y Aceite</h2>
        <p>Cambiamos los filtros y el aceite de tu vehículo para mantener su motor en óptimas condiciones y mejorar el rendimiento del combustible.</p>
      </div>
      
      <div class="card card-blue">
        <img src="https://img.freepik.com/foto-gratis/composicion-moderna-mecanico-automoviles_23-2147881521.jpg?ga=GA1.1.767762080.1733602454&semt=ais_hybrid" alt="Reparación de suspensión" style="width:100%; border-radius: 8px;">
        <h2>Reparación de Suspensión</h2>
        <p>Reparamos y sustituimos los componentes de la suspensión, mejorando la estabilidad y seguridad al conducir tu vehículo.</p>
      </div>
      
      <div class="card card-blue">
        <img src="https://img.freepik.com/foto-gratis/trabajador-vista-lateral-reparando-auto_23-2150171256.jpg?ga=GA1.1.767762080.1733602454&semt=ais_hybrid" alt="Reparación de frenos" style="width:100%; border-radius: 8px;">
        <h2>Frenos y Discos</h2>
        <p>Realizamos mantenimiento y reparación de frenos y discos para garantizar un sistema de frenos seguro y eficiente en tu vehículo.</p>
      </div>
    </section>
    

    <script src="main.js"></script>


    <section>
      <h2 style="text-align: center;">Testimonios</h2>
      <div class="carousel-container">
        <div class="carousel">
          <div class="test">
            <img src="https://img.freepik.com/foto-gratis/hombre-guapo-elegante-tomando-selfie-redes-sociales-smartphone_176420-19612.jpg?ga=GA1.1.767762080.1733602454&semt=ais_hybrid" alt="" class="carousel-image">
            <h2>Josesito</h2>
            <p>Buena Atencion al cliente dejaron mi auto como nuevo.</p>
          </div>
          <div class="test">
            <img src="https://th.bing.com/th/id/OIP.4UUkMNTCP7wO1RJ0bZt70wHaHa?pid=ImgDet&w=184&h=184&c=7" alt=""  class="carousel-image">
            <h2>DonPollo</h2>
            <p>cero estrellas pense que era una pagina de pollos rostizados.</p>
          </div>
          <div class="test">
            <img src="https://img.freepik.com/foto-gratis/mujer-joven-posar-campo-al-aire-libre_23-2149334480.jpg?ga=GA1.1.767762080.1733602454&semt=ais_hybrid" alt=""  class="carousel-image">
            <h2>KarlaJimenez</h2>
            <p>Uno de los mejores talleres sin duda volveria por otros de sus servicios.</p>
          </div>
          <div class="test">
            <img src="https://th.bing.com/th/id/OIP.18nwr_sjE6_8mqU0CnNUxgAAAA?w=165&h=161&c=7&r=0&o=5&pid=1.7" alt=""  class="carousel-image">
            <h2>pussey2024</h2>
            <p>De donde se graduaron sus mecanicos? del tecnologico de novalgomdare, muy mal servicio.</p>
          </div>
          <div class="test">
            <img src="https://th.bing.com/th/id/OIP.Af22KYXDXoU85mfvmJobhgHaHJ?w=183&h=180&c=7&r=0&o=5&pid=1.7" alt=""  class="carousel-image">
            <h2>Mapache</h2>
            <p>no tiran comida a la basura, puros tornillos la otra vez me andaba asfixiando con uno, horrible servicio.</p>
          </div>
          <div class="test">
            <img src="https://img.freepik.com/vector-gratis/icono-herramienta-tornillo_24911-115874.jpg?ga=GA1.1.767762080.1733602454&semt=ais_hybrid" alt=""  class="carousel-image">
            <h2>Tornillo</h2>
            <p>Controlen su plaga de mapaches, la otra vez andaba matando a uno.</p>
          </div>
        </div>
      
    
        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
      </div>
    </section>


    
    <section class="nosotros"  id="nosotros">
     <img src="https://img.freepik.com/foto-gratis/hombre-guapo-mecanico-mujeres-autoservicio-posando_7502-4436.jpg?ga=GA1.1.767762080.1733602454&semt=ais_hybrid" alt="servicios" class="imagen">
      <div class="container">
        <h2>Nuestra Experiencia</h2>
        <p>
          Compromiso por la calidad, rapidez, confianza en el trabajo y lo más
          importante, la seguridad e integridad de cada uno de nuestros clientes
          son los valores que hacen de AutoTorque una empresa que día a día trabaja
          por ofrecer el mejor servicio integral automotriz.
        </p>
        <h2>Servicios</h2>
        <p>
          Contamos con un servicio integral total para tu vehículo. Conoce nuestros
          servicios en mecánica automotriz, hojalatería y pintura, electricidad
          automotriz, escáner, venta y montaje de llantas, y estética automotriz,
          con personal altamente especializado.
        </p>
        <a href="#servicios" class="btn-primary">Solicitar Servicio</a>
      </div>
    </section>

  


    
<!-- Sección de contacto -->
<section id="contacto" class="contacto">
      <div class="container">
        <h2>Ponte en Contacto con Nosotros</h2>
        <p>
          Escríbenos tus sugerencias, preguntas o solicita una cotización. Nuestro
          equipo se pondrá en contacto contigo a la brevedad posible.
        </p>
        <a href="wa.link/m8g41x" class="btn-w">Ir a WhatsApp</a>
        
        <div class="contact-info">
            <p>Teléfono: <a href="tel:+524811200959">481 120 0959</a></p>
            <p>Dirección: Calle 16 De Septiembre Sn, 79010 Ciudad Valles, San Luis Potosí · 03 km</p>
        </div>
        
      </div>
    </section>
    <script src="script.js"></script>

    <footer>
      <div class="container">
        <p>&copy; 2024 Taller Mecánico. Todos los derechos reservados.</p>
      </div>
    </footer>
  </body>
</html>
