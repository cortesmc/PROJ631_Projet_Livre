import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.sql.*;
import java.util.ArrayList;

public class addLivreGUI extends JFrame implements ActionListener {

    private JTextField titleField, genreField, authorField,descriptionField, thumbnailField, yearField;
    private JButton btnAddBook, goBack;

    private ArrayList<String> books;

    public addLivreGUI() {
        super("Add Book");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(800, 400);

        this.books = books;

        // create the text fields and button
        titleField = new JTextField(20);
        genreField = new JTextField(20);
        authorField = new JTextField(20);
        descriptionField = new JTextField(100);

        thumbnailField = new JTextField(100);
        yearField = new JTextField(4);

        btnAddBook = new JButton("Add Book");
        btnAddBook.addActionListener( (event) -> {
            try {
                BtnAddBookListener(event);
            } catch (SQLException e) {
                throw new RuntimeException(e);
            }
        });

        goBack = new JButton("Back");
        goBack.addActionListener(this);

        // add the text fields and button to the frame
        JPanel panel = new JPanel();
        panel.setLayout(new GridLayout(7, 2));
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
    
    public void BtnAddBookListener(ActionEvent e) throws SQLException {

        // -- Get field to add a book
        String title = titleField.getText();
        String genre = genreField.getText();
        String author = authorField.getText();
        String description = descriptionField.getText();
        String thumbnail = thumbnailField.getText();
        String year = yearField.getText();

        String[] genres = genre.split(",");
        String[] authors = author.split(",");

        // -- TODO Check if all fields are not empty
        if ( title.length() == 0 && genre.length() == 0 && author.length() == 0 && description.length() == 0 && thumbnail.length() == 0 && year.length() == 0)
            JOptionPane.showMessageDialog(this, "Les champs sont vides");

        else {
            // -- TODO Check if the book doesn't exist yet with check by title
            Connection conn = ToolsBDD.connexionBDD(ToolsBDD.SERVER, "proj631_livres", ToolsBDD.USERNAME, ToolsBDD.PWD);

            if ( ToolsBDD.isBookExist(conn, title) )
                JOptionPane.showMessageDialog(this, "Le livre "+ title + " existe déjà !");

            else {
                ToolsBDD.insertBookBDD(conn, title, genres, authors, description, thumbnail, year);
                dispose();
                new MainManagementGUI();
                JOptionPane.showMessageDialog(this, "Le livre "+ title + " a bien été ajouté !");

            }

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
