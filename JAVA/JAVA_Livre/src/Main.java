import java.sql.*;
import java.util.ArrayList;

public class Main {
    public static void main(String[] args) throws SQLException {

        //new addLivreGUI();

        ArrayList<String> books = new ArrayList<>();
        //add les titre de livre existants dans la base de données
        books.add("Title 1");
        books.add("Title 2");
        books.add("Title 3");

        new MainManagementGUI();

        Connection conn = ToolsBDD.connexionBDD(ToolsBDD.SERVER, "proj631_livres", ToolsBDD.USERNAME, ToolsBDD.PWD);

//        ToolsBDD.insertAuthorBDD(conn, "MATHYS LEBON");
//
//        ToolsBDD.insertGenreBDD(conn, "SUPER GENRE");

    }


}