<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AdoptaCR - Gestión de Adopción</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/index.css">
  
  </head>

<body>



<!-- bar para ver diferente partes,LOGO,  Conózoncanos , trámites y servicios, FAQ, CONTACTO  (Andrés) -->

<!--                                                                          (Andrés) Terminado-->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        
    <a class="navbar-brand" href="index.php">
            <img src="./img/logo2.png" width="125"><br>
        </a>
        
          <button class="navbar-toggler" type="button"> 
            <span class="navbar-toggler-icon"></span>
        </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?php echo $activePage == 'inicio' ? 'active' : ''; ?>" href="index.php">
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?php echo $activePage == 'conocenos' ? 'active' : ''; ?>" href="conocenos.php">
                        Conócenos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?php echo $activePage == 'servicios' ? 'active' : ''; ?>" href="php/servicios.php">
                        Servicios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?php echo $activePage == 'tramites' ? 'active' : ''; ?>" href="tramites.php">
                        Trámites
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?php echo $activePage == 'faq' ? 'active' : ''; ?>" href="faq.php">
                        FAQ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?php echo $activePage == 'contacto' ? 'active' : ''; ?>" href="contacto.php">
                        Contacto
                    </a>
                </li>
            </ul>
        </div>
        
    </div>
    </nav>
    
    
</header>

<section id="Proceso-adoptarcr">
     <div class="logo">
        <span class="icono">💙</span>
        <section id="Nombre-Agencia">
            <h1>AdoptaCR</h1>
            <p>Proceso Inicial de Adopción</p>
        </section>
    </div>
</section>





<section class="hero">
    <div class="hero-contenido">
        <h2>Construyendo nuevas familias</h2>
        <p>
            Inicia tu proceso de adopción de forma digital, segura y organizada.
        </p>
        <a id="botonS" href="solicitud.php" class="botonS">Iniciar Solicitud</a>
    </div>
</section>

<!-- Bienvendo-->

<section class="info">
    <h2>Bienvenido</h2>
    <p>
        Esta plataforma permite a las personas interesadas iniciar 
        el proceso de adopción de manera digital facilitando el 
        registro, validación y seguimiento de solicitudes 
        bajo criterios estructurados
    </p>
</section>


            <!-- ponerlo en carousel  y usar cards con imaganes (Andrés) --> 

<!-- Proceso -->  

<section class="info-secciones">

    <h2>Información del Proceso</h2>

    <div class="grid-info">

        <div class="card">
            <h3 onclick="toggleSeccion('quienes')">¿Quiénes Somos?</h3>
            <div id="quienes" class="contenido">
                <p>
                    AdoptaCR es un sistema digital orientado a la gestión organizada 
                    del proceso inicial de adopción.
                </p>
                <p>
                    Su finalidad es facilitar la recopilación de información, 
                    promover transparencia y simular un entorno estructurado 
                    conforme a criterios académicos y legales
                </p>
            </div>
        </div>

        <div class="card">
            <h3 onclick="toggleSeccion('requisitos')">Requisitos Básicos</h3>
            <div id="requisitos" class="contenido">
                <ul>
                    <li>Ser mayor de 25 años.</li>
                    <li>Presentar documentación personal válida.</li>
                    <li>Demostrar estabilidad económica.</li>
                    <li>Aprobar evaluación socioeconómica.</li>
                    <li>No contar con antecedentes que afecten la idoneidad.</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <h3 onclick="toggleSeccion('proceso')">Proceso de Adopción</h3>

            <div id="proceso" class="contenido">
                <ol>
                    <li>Registro de solicitud inicial.</li>
                    <li>Validación de datos y documentación.</li>
                    <li>Evaluación psicológica y social.</li>
                    <li>Análisis de idoneidad.</li>
                    <li>Resolución final.</li>
                </ol>

                <a href="proceso.php" class="btn btn-masinformacion">Más información</a>
            </div>
        </div>

        <div class="card">
            <h3 onclick="toggleSeccion('legal')">Marco Legal</h3>
            <div id="legal" class="contenido">
                <p>
                    El proceso de adopción se encuentra regulado por la legislación 
                    costarricense vigente y supervisado por el Patronato Nacional 
                    de la Infancia (PANI).
                </p>
                <p>
                    Todo procedimiento debe garantizar el interés superior del menor.
                </p>
            </div>
        </div>

    </div>
</section>


<section class="valores">

    <h2>Nuestros Principios</h2>

    <div class="valores-grid">

        <div class="valor">
            <h4>Transparencia</h4>
            <p>Procesos claros y organizados en cada etapa del procedimiento.</p>
        </div>

        <div class="valor">
            <h4>Responsabilidad</h4>
            <p>Compromiso ético en la evaluación y gestión de solicitudes.</p>
        </div>

        <div class="valor">
            <h4>Compromiso Social</h4>
            <p>Promoción de hogares seguros y estables para la niñez.</p>
        </div>

    </div>

</section>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

<script>
function toggleSeccion(id) {
    var seccion = document.getElementById(id);

    if (seccion.style.display === "block") {
        seccion.style.display = "none";
    } else {
        seccion.style.display = "block";
    }
}
</script>

</body>
</html>