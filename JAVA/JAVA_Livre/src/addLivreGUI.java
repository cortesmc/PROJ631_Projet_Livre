import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.sql.*;
import java.util.ArrayList;

public class addLivreGUI extends JFrame implements ActionListener {

    private JTextField titleField, genreField, authorField,descriptionField;
    private JButton addButton, goBack;

    private ArrayList<String> books;

    public addLivreGUI(ArrayList<String> books) {
        super("Add Book");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(800, 400);

        this.books = books;

        // create the text fields and button
        titleField = new JTextField(20);
        genreField = new JTextField(20);
        authorField = new JTextField(20);
        descriptionField = new JTextField(100);
        addButton = new JButton("Add Book");
        addButton.addActionListener(this);
        goBack = new JButton("Back");
        goBack.addActionListener(this);

        // add the text fields and button to the frame
        JPanel panel = new JPanel();
        panel.setLayout(new GridLayout(5, 2));
        panel.add(new JLabel("Title:"));
        panel.add(titleField);
        panel.add(new JLabel("Genre:"));
        panel.add(genreField);
        panel.add(new JLabel("Author:"));
        panel.add(authorField);
        panel.add(new JLabel("Description:"));
        panel.add(descriptionField);
        panel.add(goBack);
        panel.add(addButton);
        add(panel);

        setVisible(true);
    }

    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == addButton) {
            // get the book information from the text fields
            String title = titleField.getText();
            String genre = genreField.getText();
            String author = authorField.getText();
            String description = descriptionField.getText();
            System.out.println("title : "+title+"\ngenre : "+genre+"\nauthor : "+author+"\nDescription : "+description);
        }
        if (e.getSource() == goBack) {
            new MainManagementGUI(this.books);
            this.dispose();
        }
    }
}
