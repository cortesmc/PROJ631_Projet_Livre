import java.sql.*;
import java.util.ArrayList;

public class Main {
    public static void main(String[] args) throws SQLException, ClassNotFoundException {

        //new addLivreGUI();


//        new MainManagementGUI();

        Connection conn = ToolsBDD.connexionBDD(ToolsBDD.SERVER, "proj631_livres", ToolsBDD.USERNAME, ToolsBDD.PWD);

        System.out.println(conn);

        //        ToolsBDD.testConnexionBDD();
//        ToolsBDD.insertAuthorBDD(conn, "MATHYS LEBON");
//
//        ToolsBDD.insertGenreBDD(conn, "SUPER GENRE");

        new MainManagementGUI();
        new updateLivreGUI() ;

    }


}