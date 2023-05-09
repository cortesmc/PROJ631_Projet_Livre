import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;

public class Main {
    public static void main(String[] args) {

        //new addLivreGUI();

        ArrayList<String> books = new ArrayList<>();
        //add les titre de livre existants dans la base de données
        books.add("Title 1");
        books.add("Title 2");
        books.add("Title 3");

//        new MainManagementGUI(books);

        Connection conn = ToolsBDD.connexionBDD(ToolsBDD.SERVER, "proj631_livres", ToolsBDD.USERNAME, ToolsBDD.PWD);
        System.out.println(conn);

    }
}