<%@page import="java.text.SimpleDateFormat"%>
<%@page import="java.util.Date"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Google Tag Manager -->
       <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N4ZZ9MM');</script>-->
        <!-- End Google Tag Manager -->
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
                <a href="http://panelestxd.cencosud.corp/paneles"><img src="paris3.png" width="60" height="60"></a>
                <span style="font-size: 18px; position: relative; top: 3px; color: #777;">Tamaño de Despacho</span>
            </div>
        </nav>
    </header>
        
    <div class="container">
        <div class="well well-sm clearfix">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-2">  
                   <div class="pull-right"><form class="form-inline" method="get" action="index.jsp">
                       <div class="form-group" role="group" data-toggle='tooltip' title='Día a consultar'>
                           <%
                               Date myDate = new Date();
                               String fecha=new SimpleDateFormat("dd/MM/yyyy").format(myDate);
                           if(request.getParameter("fecha_consulta")!=null){
                                fecha = request.getParameter("fecha_consulta");
                            }else{
                            }
                           out.println("<input type='text' class='form-control demo'id='fecha_consulta' name='fecha_consulta' value='"+fecha+"'/>");
                           %>
                        </div> 

                        <div class="form-group" role="group">
                            <%
                               String dia=new SimpleDateFormat("dd").format(myDate);
                               String mes=new SimpleDateFormat("MM").format(myDate);
                               String anio=new SimpleDateFormat("yyyy").format(myDate);
                               String dia2="";
                                String mes2="";
                                String anio2="";
                               
                               if(request.getParameter("fecha_consulta")!=null){
                                fecha = request.getParameter("fecha_consulta");
                                String[] parts = fecha.split("/");
                                dia = parts[0]; // 
                                mes = parts[1]; // 
                                anio = parts[2]; //
                               }
                               
                                out.println("<a class='btn btn-success btn-block' id='exportar' href='exportar2.jsp?mes="+mes+"&anio="+anio+"&dia="+dia+"'>Exportar CSV</a>");
                               %>
                        </div>
                       </form></div>
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
                "minDate": '27/09/2017',
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
                    "Útimos 7 días": [
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
            $("#exportar").attr("href","exportar2.jsp?"+setDate($(this).val()));
        });
    });

    </script> 
        
    </body>
</html>
