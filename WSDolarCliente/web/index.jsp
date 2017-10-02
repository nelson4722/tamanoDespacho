<%--
    Document   : index
    Created on : 18-04-2016, 16:43:36
    Author     : usuario
--%>

<%@page import="dolar.Conexion"%>
<%@page import="java.text.SimpleDateFormat"%>
<%@page import="java.util.*"%>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dolar</title>
    </head>
    <body>
        <h1>Dolar Observado</h1>
        <form name="frmDolar" action="index.jsp" method="POST">
           <h4> El valor del dolar de hoy
            <%
                Date myDate = new Date();
                Conexion co = new Conexion();
                SimpleDateFormat sm = new SimpleDateFormat("dd-MM-yyyy");
                String Fecha = sm.format(myDate);
                out.println(Fecha+" es de $"+co.Consulta(Fecha));
            %>
            <br> </h4>
            <echo>Ingrese una Fecha para calcular el dolar:</echo>
            <br>
            <h4>Fecha: <input type="text" name="txtFecha" placeholder="dd-mm-aaaa" size="10" />
            <input type="submit" value="Calcular Dolar" name="btnDolar" /> </h4>
        </form>
            
            <h4>
            <%-- start web service invocation --%><hr noshade=?noshade? width=30% align= left />
            <%         
            // 02-01-2015
            String Fecha2 = request.getParameter("txtFecha");
            if(Fecha2!=null)
            {
                if(co.esFechaValida(Fecha2))
                {
                    if(co.Consulta(Fecha2)!="error")
                    out.println("En la fecha "+Fecha2+" el valor del dolar fue de $"+co.Consulta(Fecha2));
                    else
                    out.println("Valor no encontrado");
                }
                
            }   
            %>
            <%-- end web service invocation --%><hr noshade=?noshade? width=30% align= left />
            </h4> 
    </body>
</html>