<!DOCTYPE html>
<html>
    <head>
        <!-- Google Tag Manager -->
        <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N4ZZ9MM');</script> -->
        <!-- End Google Tag Manager -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Informe Tamaño de Producto</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="icon" type="image/png" href="paris3.png" />

    </head>

    <body>

      <!-- Navbar -->
      <header>
        <nav class="navbar navbar-default bg-primary navbar-static-top navbar-collapse" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="http://panelestxd.cencosud.corp/paneles"><img src="paris3.png" width="50" height="50"></a>
            <span style="font-size: 18px; position: relative; top: 3px; color: #777;">Informe Tamaño de Producto</span>
          </div>

          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-user"></span>
                    <?php
                    // echo $_SESSION['nombre'] . " " . $_SESSION['apellido'];
                    ?>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-right">
                  <li><a><h5>Comentarios</h5></a></li>
                  <li><a href="../txd_auth/help_scripts/close.php"><h5><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</h5></a></li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- Calculos -->
      <?php
      date_default_timezone_set("America/Santiago");
          $fecha = date('d/m/Y');
          $dia = date("d");
          $mes = date("m");
          $anio = date("Y");
          ?>
 <div class="form-group" role="group">
      <div class='container-fluid'>
          <div class="col-sm-10 col-sm-offset-1">
            <div class="well well-sm clearfix">
              <div class="pull-right">
                <form class="form-inline" id="form1" method="get" >                    
                 <div class="pull-right"><?php echo "<a class='btn btn-sm btn-success' href='exportar.php?mes=$mes&anio=$anio&dia=$dia'><span class='glyphicon glyphicon-export'></span> ";?>Descarga BD </a></div>
                </form>
              </div>  
            </div>
            <!-- Print tabla -->
            <?php
            $conexion = new mysqli('localhost', 'root', '123456', 'pruebas', '3306');
            if (mysqli_connect_errno()) {
                printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
                exit();
             }
              echo "<hr>";
              echo '<table class="table table-condensed table-hover" id="tabla" >';
                echo '<thead>';
                echo "<tr style='background-color: #337ab7; color: white'>";
                echo "<th> N° Departamento</th>";
                echo "<th> Departamento</th>";
                echo "<th> N° Sub Departamento</th>";
                echo "<th> Sub Departamento</th>";
                echo "<th> N° Clase</th>";
                echo "<th> Clase</th>";
                echo "<th> Tamaño</th>";
                echo "<th> Field5</th>";
                echo "<th> ShippingCalculationCode</th>";
                echo "<th> Peso</th>";
                //echo "<th> Tipo de orden           </th>";
                echo "</tr>";
                echo "</thead>";

                $query = "SELECT NDepto,Depto,NSubDepto,SubDepto,Nclase,Clase,TAMANO,FIELD5,ShippingCalculationCode,Weight FROM datos";
                $res = $conexion->query($query);
                echo "<tbody>";
                while($row = mysqli_fetch_assoc($res)){
                echo "<tr>";
                echo "<th>". $row['NDepto'] ."</th>";
                echo "<th>". $row[ 'Depto'] ."</th>";
                echo "<th>". $row[ 'NSubDepto'] ."</th>";
                echo "<th>". $row[ 'SubDepto'] ."</th>";
                echo "<th>". $row[ 'Nclase'] ."</th>";
                echo "<th>". $row[ 'Clase'] ."</th>";
                if($row[ 'TAMANO']=='Pequeno')echo "<th>".'Pequeño'."</th>";
                else echo "<th>".$row[ 'TAMANO']."</th>";
                echo "<th>". $row[ 'FIELD5']."</th>";
                echo "<th>". $row[ 'ShippingCalculationCode'] ."</th>";
                echo "<th>". $row[ 'Weight'] ."</th>";
                  echo "</tr>";
                }
                echo "</tbody>";
              echo "</table>";
            ?>
          </div>
      </div>
      </div>

      <!-- ===================================================================== -->
      <!-- =========================== FOOTER ================================== -->
      <!-- ===================================================================== -->

      <!-- datatables -->
      <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
      <script type="text/javascript" src="bootstrap-daterangepicker-master/moment.js"></script>
      <script type="text/javascript" src="bootstrap-daterangepicker-master/daterangepicker.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script type="text/javascript">
            // script daterange picker
            $('.demo').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "minDate": '02/10/2017',
                "maxDate": moment().format('DD/MM/YYYY'),
                "opens": "left",
                "ranges": {
                    "Hoy": [
                        moment().format('DD/MM/YYYY'),
                        moment().format('DD/MM/YYYY')
                    ],
                    "Ayer": [
                        moment().subtract(1, 'days'),
                        moment().subtract(1, 'days')
                    ],
                    "Últimos 7 días": [
                        moment().subtract(6, 'days'),
                        moment().format('DD/MM/YYYY')
                    ],
                    "Últimos 30 días": [
                        moment().subtract(29, 'days'),
                        moment().format('DD/MM/YYYY')
                    ],
                    "Mes actual": [
                        moment().startOf('month'),
                        moment().format('DD/MM/YYYY')
                    ],
                    "Mes anterior": [
                        moment().startOf('month').subtract(1,'month'),
                        moment().endOf('month').subtract(1,'month')
                    ]
                },
                "locale": {
                    "direction": "ltr",
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "Hasta",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Deciembre"
                    ]
                },
                "autoApply": true,
                "alwaysShowCalendars": true
            }, function(start, end, label) {
                console.log("New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
        });</script>

      <script>
        $(document).ready(function () {
          $('#tabla').DataTable({
            "order": [[ 1, "asc" ]],
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
              }
          });
        });
      </script>

    </body>
  </html>
