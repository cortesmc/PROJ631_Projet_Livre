import java.sql.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

public class ToolsBDD {
//    private static final String SERVER     = "tp-epua:3308";
//    private static final String USERNAME   = "lebonmat";
//    private static final String PWD        = "yxr5ryhf";

    public static final String SERVER = "localhost";
    public static final String USERNAME = "root";
    public static final String PWD = "";


    public static Connection connexionBDD(String server, String bddName, String username, String pwd) {
        Connection conn = null;
        try
        {
            //étape 1: charger la classe de driver
            Class.forName("com.mysql.cj.jdbc.Driver");

            //étape 2: créer l'objet de connexion
            conn = DriverManager.getConnection(
                    "jdbc:mysql://" + server + "/" + bddName, username, pwd);

//                    "jdbc:mysql://localhost:3306/theo", "root", "");


//            //étape 3: créer l'objet statement
//            Statement stmt = conn.createStatement();
//            ResultSet res = stmt.executeQuery("SELECT title FROM Book");
//
//            //étape 4: exécuter la requête
//            while(res.next())
//                System.out.println(res.getString(1));
//
//            //étape 5: fermez l'objet de connexion
//            conn.close();

        }
        catch(Exception e){
            System.out.println(e);
        }

        return conn;
    }

}


