<!DOCTYPE html>
<html lang="es">

    <head>
        <!-- Google Tag Manager -->
        <!--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N4ZZ9MM');</script>-->
        <!-- End Google Tag Manager -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>Tamaño de Despacho</title>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" media="all" href="bootstrap-daterangepicker-master/daterangepicker.css" />
        
        <link rel="icon" type="image/png" href="paris3.png" />

    </head>

    <body>
        <!-- Google Tag Manager (noscript) -->
        <!--<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N4ZZ9MM"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        

        <header>
        <nav class="navbar navbar-default">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="http://panelestxd.cencosud.corp/paneles"><img src="paris3.png" width="50" height="50"></a>
                <span style="font-size: 18px; position: relative; top: 3px; color: #777;">Tamaño de Despacho</span>
            </div>

            <div id="navbar" class="navbar-collapse collapse">

                <ul class="nav navbar-nav navbar-right">
                    
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'];?> 
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
       
    <div class="container">
        <div class="well well-sm">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-2">
                   <div class="pull-right"><form class="form-inline" id="form1" method="get"  action="info.php" >
                       <div class="form-group" role="group" data-toggle='tooltip' title='Día a consultar'>

                        <?php
                            date_default_timezone_set("America/Santiago");
                            if(isset($_GET['fecha_consulta'])){
                                $fecha = $_GET['fecha_consulta'];
                            }else{
                                $fecha = date('d/m/Y');
                            }

                            echo "<input type='text' class='form-control demo' id='fecha_consulta' name='fecha_consulta' value='$fecha' />";
                        ?>
                        </div>

                        <div class="form-group" role="group">

                            <?php

                                $dia = date("d");
                                $mes = date("m");
                                $anio = date("Y");
                              
                                if(isset($_GET['fecha_consulta'])) {
                                    $fecha_consulta = explode("/", $_GET['fecha_consulta']);

                                    $dia = $fecha_consulta[0];

                                    $mes = $fecha_consulta[1];

                                    $anio = $fecha_consulta[2];
                                }

                                echo "<a class='btn btn-success btn-block' id='exportar' href='exportar2.php?mes=$mes&anio=$anio&dia=$dia'>Exportar CSV</a>";
                            ?>
                        </div>
                       </form> </div>  
                       
                       <?php

                       //PONER FLAG SEGUN SU LOGICA
                       $conn = mysqli_connect('localhost', 'root', '123456', 'COMMERCE', '3306');
                       $res = mysqli_query($conn, "SELECT FIELD5, PARTNUMBER, CODE, CATENTTYPE_ID,`WEIGHT`, MARKFORDELETE FROM datos WHERE fecha ='".$anio.$mes.$dia."'");
                         // loop over the rows, outputting them
                         if(($row=mysqli_fetch_array($res, MYSQLI_ASSOC)) == NULL) { 
                            echo "<div class=\"alert alert-danger\" align=\"center\">No existe informe para descargar en día de hoy.</div>";  
                        }
                       ?>    

                </div>
            </div>
        </div>
    </div>





        
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="bootstrap-daterangepicker-master/moment.js"></script>
        <script type="text/javascript" src="bootstrap-daterangepicker-master/daterangepicker.js"></script>
        <!-- Latest compiled and minified JavaScript -->
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
        });
            
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
        });
    </script>

    <script type="text/javascript">
    function setDate(date){
        fecha = date.split("/");
        return "dia="+ fecha[0]+"&mes="+fecha[1]+"&anio="+fecha[2];
    };
    $(document).ready(function(){
        $("#fecha_consulta").change(function(){
            $("#exportar").attr("href","exportar2.php?"+setDate($(this).val()));
        });
    });

    </script> 

    </body>
</html>
