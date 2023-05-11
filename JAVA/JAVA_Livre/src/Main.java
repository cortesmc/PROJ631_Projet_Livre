import java.sql.*;
import java.util.ArrayList;

public class Main {
    public static void main(String[] args) throws SQLException, ClassNotFoundException {

        //new addLivreGUI();


//        new MainManagementGUI();

        Connection conn = ToolsBDD.connexionBDD(ToolsBDD.SERVER, "proj631_livres", ToolsBDD.USERNAME, ToolsBDD.PWD);

//        System.out.println(conn);

        //        ToolsBDD.testConnexionBDD();
//        ToolsBDD.insertAuthorBDD(conn, "MATHYS LEBON");
//
//        ToolsBDD.insertGenreBDD(conn, "SUPER GENRE");

        new MainManagementGUI();
//        new updateLivreGUI() ;

//        ToolsBDD.getBookAllInfoByTitleBDD(conn, "Shrek au pays des groseilles");

//        ToolsBDD.testConnexionBDD();

    }


}


//[AVENTURE, ACTION, CHILDREN]
//
//        [AVENTURE, AUTOBIOGRAPHY]
//
//On garde : AVENTURE
//
//        for genreNEW : listNEW:
//            if (!listOLD.contains(genreNEW))
//                -> INSERT IGNORE libele INTO GENRE
//                -> idGenre = SELECT L'ID GENRE INSÉRÉ'
//                -> INSERT IGNORE idBOOK, idGenre INTO BELONG
//
//
//        for genreOLD : listOLD:
//            if (!listnew.contains(genreOLD))
//                -> idGenre = SELECT L'ID GENRE genreOLD
//                -> Remove from BELONG Where idBook = IDBOOK AND idGENRE = idGenre
//
//
