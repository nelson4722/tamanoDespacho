/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dolar;

/**
 *
 * @author ernesto
 */
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Locale;
import java.util.logging.Level;
import java.util.logging.Logger;
public class Conexion {
    private Connection con;
    private Statement stat;  
    public Conexion(){
    }
    
    public String Consulta(String Fecha) throws ClassNotFoundException, SQLException{

    String resultado= "error";
            Class.forName("com.mysql.jdbc.Driver");
            con = DriverManager.getConnection("jdbc:mysql://localhost:3306/datos?zeroDateTimeBehavior=convertToNull",
                    "root", "zapdosce2");

            // Creamos un Statement para poder hacer peticiones a la bd
            stat = con.createStatement();

            // Seleccionar todos los datos por fecha
            String seleccionar = "select Valor from datos where Fecha='"+Fecha+"'";
            ResultSet rs = stat.executeQuery(seleccionar);

            // Recorrer todas las filas de la tabla Vdolar
            while (rs.next()) {
                resultado=rs.getString("Valor");
            }
        
    return resultado;    
    } 
    public boolean esFechaValida(String fecha) {
        try {
            SimpleDateFormat formatoFecha = new SimpleDateFormat("dd-MM-yyyy", Locale.getDefault());
            formatoFecha.setLenient(false);
            formatoFecha.parse(fecha);
        } catch (ParseException e) {
            return false;
        }
        return true;
    }
    
}
