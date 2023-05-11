import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Arrays;

public class updateLivreGUI extends JFrame implements ActionListener {

    private JComboBox<String> bookList;

    private JTextField titleField, genreField, authorField,descriptionField, thumbnailField, yearField;
    private JButton btnAddBook, goBack;

    private ArrayList<String> books;

    public updateLivreGUI() throws  SQLException{
        super("Update Book");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(800, 400);

        // get the list of books
        Connection conn = ToolsBDD.connexionBDD(ToolsBDD.SERVER, "proj631_livres", ToolsBDD.USERNAME, ToolsBDD.PWD);
        this.books = ToolsBDD.getAllBooksTitle(conn);

        // create the book list combo box and remove button
        bookList = new JComboBox<>();
        bookList.addActionListener( (event) -> {
            try {
                bookListListener(event);
            } catch (SQLException e) {
                throw new RuntimeException(e);
            }
        });
        for (String book : books) {
            bookList.addItem(book);
        }

        // create the text fields and button
        titleField = new JTextField(20);
        genreField = new JTextField(20);
        authorField = new JTextField(20);
        descriptionField = new JTextField(100);

        thumbnailField = new JTextField(100);
        yearField = new JTextField(4);

        btnAddBook = new JButton("Update Book");
        btnAddBook.addActionListener( (event) -> {
            try {
                btnUpdateBookListener(event);
            } catch (SQLException e) {
                throw new RuntimeException(e);
            }
        });

        goBack = new JButton("Back");
        goBack.addActionListener(this);

        // add the text fields and button to the frame
        JPanel panel = new JPanel();
        panel.setLayout(new GridLayout(9, 2));
        panel.add(new JLabel("Select book to update:"));
        panel.add(bookList);
        panel.add(new JLabel("Title:"));
        panel.add(titleField);
        panel.add(new JLabel("Genre:"));
        panel.add(genreField);
        panel.add(new JLabel("Author:"));
        panel.add(authorField);
        panel.add(new JLabel("Description:"));
        panel.add(descriptionField);

        panel.add(new JLabel("Lien de l'image:"));
        panel.add(thumbnailField);
        panel.add(new JLabel("Année:"));
        panel.add(yearField);

        panel.add(goBack);
        panel.add(btnAddBook);
        add(panel);

        setVisible(true);
    }

    public void btnUpdateBookListener(ActionEvent e) throws SQLException {

        // -- Get field to add a book
        String title = titleField.getText();
        String genre = genreField.getText();
        String author = authorField.getText();
        String description = descriptionField.getText();
        String thumbnail = thumbnailField.getText();
        String year = yearField.getText();


        // -- Get all name genre in list
        String[] genres =  genre.split(",");
        String[] authors = author.split(",");


        // -- Convert list to ArrayList
        ArrayList<String> listNewGenres = new ArrayList<String>();
        ArrayList<String> listNewAuthors = new ArrayList<String>();
        for (String Vgenre : genres) {
            listNewGenres.add(Vgenre);
        }

        for (String Vauthors : authors) {
            listNewAuthors.add(Vauthors);
        }


        // -- Check if all fields are not empty
        if ( title.length() == 0 && genre.length() == 0 && author.length() == 0 && description.length() == 0 && thumbnail.length() == 0 && year.length() == 0)
            JOptionPane.showMessageDialog(this, "Les champs sont vides");

        else {
            // -- Connexion BDD
            Connection conn = ToolsBDD.connexionBDD(ToolsBDD.SERVER, "proj631_livres", ToolsBDD.USERNAME, ToolsBDD.PWD);

            // -- Get book selected
            String titleSelected = (String) bookList.getSelectedItem();
            Book bookSelected = ToolsBDD.getBookAllInfoByTitleBDD(conn, titleSelected);


            ToolsBDD.updateBookBDD(conn, bookSelected, title, listNewGenres, listNewAuthors, description, thumbnail, year);
            dispose();
            new MainManagementGUI();
            JOptionPane.showMessageDialog(this, "Le livre "+ title + " a bien été modifié !");


        }


    }

    public void bookListListener(ActionEvent e) throws SQLException {

        String titleSelected = (String) bookList.getSelectedItem();

        Connection conn = ToolsBDD.connexionBDD(ToolsBDD.SERVER, "proj631_livres", ToolsBDD.USERNAME, ToolsBDD.PWD);
        Book bookSelected = ToolsBDD.getBookAllInfoByTitleBDD(conn, titleSelected);

        System.out.println(bookSelected);

        // -- GET ALL GENRE IN A SIMPLE STRING
        int i = 0;
        String strGenres = "";
        for (String genre : bookSelected.getListGenre()) {
            strGenres += genre;

            if (i < (bookSelected.getListGenre().toArray().length - 1) )
                strGenres += ",";

            i++;
        }

        // -- GET ALL AUTHORS IN A SIMPLE STRING
        int j = 0;
        String strAuthors = "";
        for (String author : bookSelected.getListAuthor()) {
            strAuthors += author;

            if (j < (bookSelected.getListAuthor().toArray().length - 1) )
                strAuthors += ",";

            j++;
        }


        // -- FILL ALL INPUT WITH BOOK SELECTED
        if(this.titleField != null && this.genreField != null && this.authorField != null && this.descriptionField != null && this.thumbnailField != null && this.yearField != null ) {
            this.titleField.setText( bookSelected.getTitle() );
            this.genreField.setText( strGenres );
            this.authorField.setText( strAuthors );
            this.descriptionField.setText( bookSelected.getResume() );
            this.thumbnailField.setText( bookSelected.getThumbnail() );
            this.yearField.setText( bookSelected.getYear() );
        }


    }

    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == btnAddBook) {
            // get the book information from the text fields

        }
        if (e.getSource() == goBack) {
            new MainManagementGUI();
            this.dispose();
        }
    }
}
