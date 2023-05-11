import javax.tools.Tool;
import java.sql.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;

public class ToolsBDD {
//    public static final String SERVER     = "tp-epua:3308";
//    public static final String USERNAME   = "lebonmat";
//    public static final String PWD        = "yxr5ryhf";

    public static final String SERVER = "localhost:3306";
    public static final String USERNAME = "root";
    public static final String PWD = "";

//    public static void testConnexionBDD() throws ClassNotFoundException, SQLException {
//        Class.forName("com.mysql.cj.jdbc.Driver");
//        String url = "jdbc:mysql://tp-epua:3308/lebonmat"; // remplacer login par votre login
//        String user = "lebonmat"; // remplacer login par votre login
//        String password = "yxr5ryhf"; // remplacer mdp par votre mdp PhpMyAdmin
//
//        Connection con = DriverManager.getConnection(url, user, password);
//        if (con != null) {
//            System.out.println("Database Connected successfully");
//            //étape 3: créer l'objet statement
//            Statement stmt = con.createStatement();
//            ResultSet res = stmt.executeQuery("SELECT title FROM Book");
//            //étape 4: exécuter la requête
//            while(res.next())
//                System.out.println(res.getString(1));
//            //étape 5: fermer l'objet de connexion
//            con.close();
//
//            System.out.println("data selected successfully");
//        } else {
//            System.out.println("Database Connection failed");
//        }
//    }


    public static Connection connexionBDD(String server, String bddName, String username, String pwd) {
        /*
        Permet de se connecter à la BDD
        RETURN : Connection conn -> qui contient la connexion à la BDD
         */
        
        Connection conn = null;
        try
        {
            //étape 1: charger la classe de driver
            Class.forName("com.mysql.cj.jdbc.Driver");

            //étape 2: créer l'objet de connexion
            conn = DriverManager.getConnection(
                    "jdbc:mysql://" + server + "/" + bddName, username, pwd);
//                    "jdbc:mysql://tp-epua:3308/lebonmat" + username, username, pwd);

//                    "jdbc:mysql://localhost:3306/proj631_livres", "root", "");

//            //étape 3: créer l'objet statement
            Statement stmt = conn.createStatement();
            ResultSet res = stmt.executeQuery("SELECT title FROM Book");
//
//            //étape 4: exécuter la requête
            while(res.next())
                System.out.println(res.getString(1));
//
//            //étape 5: fermez l'objet de connexion
//            conn.close();

        }
        catch(Exception e){
            System.out.println(e);
        }

        return conn;
    }

    public static String selectFieldBDD(Connection conn, String query) throws SQLException {
        /*
        Permet de selectionner un champ dans la BDD selon une query
        RETURN : String result : qui est le champ resultant de la query
         */

        Statement stmt = conn.createStatement();
        ResultSet res = stmt.executeQuery(query);

        String result = "";

        //étape 4: exécuter la requête
        while(res.next())
            result = res.getString(1);

        return result;

    }


    // -------------------------------- METHODS BDD BOOK
    public static String getBookByTitle(Connection conn, String title) throws SQLException {

        Statement stmt = conn.createStatement();
        ResultSet res = stmt.executeQuery("SELECT title FROM Book WHERE title='"+title+"'");

        String titleFound = "";

        // -- Si le resultat est vide
        if (!res.next()) {
            return titleFound ;
        }
        else {
            // -- Sinon on fait la requete
            while(res.next()) {
                titleFound = res.getString(1);
            }
        }

        // -- On ferme la connexion
        conn.close();

        return titleFound;

    }

    public static boolean isBookExist(Connection conn, String title) throws SQLException {
        /*
        Check if a book exist already in the bdd
         */
        return (ToolsBDD.getBookByTitle(conn, title)).length() == 0 ? false : true;
    }

    public static void insertBookBDD(Connection conn, String title, String[] genres, String[] authors, String descr, String thumbnail, String year) throws SQLException {

        // Insert genre in TABLE GENRE
        for (String genre : genres)
            ToolsBDD.insertGenreBDD(conn, genre);

        // Insert Author in TABLE AUTHOR
        for (String author : authors)
            ToolsBDD.insertAuthorBDD(conn, author);

        // Insert Book in TABLE BOOK
        // the mysql insert statement
        String query = "INSERT INTO Book (title, resume, thumbnail, year)"
                + " values (?, ?, ?, ?)";

        // create the mysql insert preparedstatement
        PreparedStatement preparedStmt = conn.prepareStatement(query);
        preparedStmt.setString (1, title);
        preparedStmt.setString (2, descr);
        preparedStmt.setString (3, thumbnail);
        preparedStmt.setString (4, year);

        preparedStmt.execute();


        // -- Recup l'id du Livre inséré
        String idBook = ToolsBDD.selectFieldBDD(conn, "SELECT idBook FROM Book WHERE title='"+ title +"'");

        // -- Recup l'id des Genres insérés
        ArrayList<String> listIdGenres = new ArrayList<String>();
        for (String genre : genres)
            listIdGenres.add(ToolsBDD.selectFieldBDD(conn, "SELECT idGenre FROM Genre WHERE libele='"+ genre +"'"));

        // -- Recup l'id du Author inséré
        ArrayList<String> listIdAuthors = new ArrayList<String>();
        for (String author : authors)
            listIdAuthors.add(ToolsBDD.selectFieldBDD(conn, "SELECT idAuthor FROM Author WHERE name='"+ author +"'"));

        System.out.println(idBook);
        System.out.println(listIdGenres);
        System.out.println(listIdAuthors);


        // -- Insert into TABLE BELONG idBook & idGenre pour tous les genres
        for (String idGenre : listIdGenres)
            ToolsBDD.insertBelongBDD(conn, idBook, idGenre);


        // -- Insert into TABLE ISWRITE idAuthor & idBook pour tous les authors
        for (String idAuthor : listIdAuthors)
            ToolsBDD.insertIsWriteBDD(conn, idAuthor, idBook);

    }

    public static ArrayList<String> getAllBooksTitle(Connection conn) throws SQLException {
        /*
        Récupérer tous les titres des livres
         */
        ArrayList<String> listBooksTitle = new ArrayList<String>();

        Statement stmt = conn.createStatement();
        ResultSet res = stmt.executeQuery("SELECT title FROM Book");


        while(res.next())
            listBooksTitle.add(res.getString(1));

        conn.close();

        return listBooksTitle;

    }

    public static void removeBookBDD(Connection conn, String title) throws SQLException {
        /*
        Retirer un livre de la BDD avec son titre
         */

        System.out.println(title);

        // -- GET THE ID OF THE BOOK
        String idBook = ToolsBDD.selectFieldBDD(conn, "SELECT idBook FROM Book WHERE title='"+ title +"'");
        int idBookINT = Integer.parseInt(idBook);

        System.out.println(idBookINT);


        // -- TODO REMOVE FROM TABLE BELONG
        ToolsBDD.removeBelongFromIdBookBDD(conn, idBookINT);

        // -- TODO REMOVE FROM TABLE ISWRITE
        ToolsBDD.removeIsWriteFromIdBookBDD(conn, idBookINT);

        // -- TODO REMOVE FROM TABLE OWN
        ToolsBDD.removeOwnFromIdBookBDD(conn, idBookINT);

        // -- TODO REMOVE FROM TABLE REVIEW
        ToolsBDD.removeReviewFromIdBookBDD(conn, idBookINT);

        // -- REMOVE FROM TABLE BOOK
        String query = "DELETE FROM Book WHERE idBook = ?";
        PreparedStatement preparedStmt = conn.prepareStatement(query);
        preparedStmt.setInt(1, idBookINT);
        preparedStmt.execute();

    }


    // -------------------------------- METHODS BDD GENRE
    public static void insertGenreBDD(Connection conn, String genre) throws SQLException {
        // the mysql insert statement
        String query = "INSERT IGNORE INTO Genre (libele)"
                + " values (?)";

        // create the mysql insert preparedstatement
        PreparedStatement preparedStmt = conn.prepareStatement(query);
        preparedStmt.setString (1, genre);

        preparedStmt.execute();
    }


    // -------------------------------- METHODS BDD Author
    public static void insertAuthorBDD(Connection conn, String authorName) throws SQLException {
        // the mysql insert statement
        String query = "INSERT IGNORE INTO Author (name)"
                + " values (?)";

        // create the mysql insert preparedstatement
        PreparedStatement preparedStmt = conn.prepareStatement(query);
        preparedStmt.setString (1, authorName);

        preparedStmt.execute();

    }


    // -------------------------------- METHODS BDD BELONG
    public static void insertBelongBDD(Connection conn, String idBook, String idGenre) throws SQLException {
        // the mysql insert statement
        String query = "INSERT INTO Belong (idBook, idGenre)"
                + " values (?, ?)";

        // create the mysql insert preparedstatement
        PreparedStatement preparedStmt = conn.prepareStatement(query);
        preparedStmt.setString (1, idBook);
        preparedStmt.setString (2, idGenre);

        preparedStmt.execute();
    }

    public static void removeBelongFromIdBookBDD(Connection conn, int idBook) throws SQLException {
        // the mysql delete statement
        String query = "DELETE FROM Belong WHERE idBook = ?";

        // create the mysql insert preparedstatement
        PreparedStatement preparedStmt = conn.prepareStatement(query);
        preparedStmt.setInt(1, idBook);

        preparedStmt.execute();
    }


    // -------------------------------- METHODS BDD ISWRITE
    public static void insertIsWriteBDD(Connection conn, String idAuthor, String idBook) throws SQLException {
        // the mysql insert statement
        String query = "INSERT INTO IsWrite (idAuthor, idBook)"
                + " values (?, ?)";

        // create the mysql insert preparedstatement
        PreparedStatement preparedStmt = conn.prepareStatement(query);
        preparedStmt.setString (1, idAuthor);
        preparedStmt.setString (2, idBook);

        preparedStmt.execute();
    }

    public static void removeIsWriteFromIdBookBDD(Connection conn, int idBook) throws SQLException {
        // the mysql delete statement
        String query = "DELETE FROM IsWrite WHERE idBook = ?";

        // create the mysql insert preparedstatement
        PreparedStatement preparedStmt = conn.prepareStatement(query);
        preparedStmt.setInt(1, idBook);

        preparedStmt.execute();
    }


    // -------------------------------- METHODS BDD OWN
    public static void removeOwnFromIdBookBDD(Connection conn, int idBook) throws SQLException {
        // the mysql delete statement
        String query = "DELETE FROM Own WHERE idBook = ?";

        // create the mysql insert preparedstatement
        PreparedStatement preparedStmt = conn.prepareStatement(query);
        preparedStmt.setInt(1, idBook);

        preparedStmt.execute();
    }


    // -------------------------------- METHODS BDD REVIEW
    public static void removeReviewFromIdBookBDD(Connection conn, int idBook) throws SQLException {
        // the mysql delete statement
        String query = "DELETE FROM Review WHERE idBook = ?";

        // create the mysql insert preparedstatement
        PreparedStatement preparedStmt = conn.prepareStatement(query);
        preparedStmt.setInt(1, idBook);

        preparedStmt.execute();
    }

}


/*
SELECT b.title, g.libele, a.name
FROM Book b
    JOIN Belong bel ON b.idBook = bel.idBook
    JOIN Genre g ON bel.idGenre = g.idGenre

    JOIN IsWrite i ON b.idBook = i.idBook
    JOIN Author a ON i.idAuthor = i.idAuthor

WHERE b.title = "Harry Potter and the Order of the Phoenix";
 */


