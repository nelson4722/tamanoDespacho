<%@page import="java.net.URLEncoder"%>
<%@page import="java.io.*"%>
<%@page import="java.text.SimpleDateFormat"%>
<%@page import="java.sql.*"%>
<%@page import="java.util.*"%>
<%@page import="java.awt.HeadlessException"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="javax.swing.JOptionPane"%> 
<%@page import="javax.naming.*"%>
<%@page import="java.text.*"%>
<%@page import="java.util.TimeZone"%>


<%
    String anio=request.getParameter("anio");
    String mes=request.getParameter("mes");
    String dia=request.getParameter("dia");
    
    response.setContentType("application/ms-excel; charset=UTF-8");
    response.setCharacterEncoding("UTF-8");
    response.setHeader("Content-Disposition","attachment; filename="+URLEncoder.encode("tamanodespacho-"+anio+mes+dia+".csv", "UTF-8"));

        try {
            PrintWriter outx = response.getWriter();
            Class.forName("com.mysql.jdbc.Driver").newInstance();
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/COMMERCE", "root", "123456");
            String query = "SELECT FIELD5, PARTNUMBER, CODE, CATENTTYPE_ID,WEIGHT, MARKFORDELETE FROM datos WHERE fecha ='"+anio+mes+dia+"'";
            Statement stmt = conn.createStatement();
            ResultSet rs = stmt.executeQuery(query);

            outx.println("DFC;PARTNUMBER;SHIPPINGCALCULATIONCODE;TYPE;WEIGHT;DELETE");
            while (rs.next()) {
                outx.println(rs.getString(1)+';'+rs.getString(2)+';'+rs.getString(3)+';'+rs.getString(4)+';'+rs.getString(5)+';'+rs.getString(6));
               }
            outx.flush();
            outx.close();
            conn.close();
        } catch (Exception e) {
            e.printStackTrace();
        }
    %>