import java.util.ArrayList;

public class Main {
    public static void main(String[] args) {

        //new addLivreGUI();

        ArrayList<String> books = new ArrayList<>();
        //add les titre de livre existants dans la base de données
        books.add("Title 1");
        books.add("Title 2");
        books.add("Title 3");

        new MainManagementGUI(books);

    }
}