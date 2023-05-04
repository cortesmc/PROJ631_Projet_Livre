import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.sql.*;

public class GUIaddLivre extends JFrame implements ActionListener {

    private JTextField titleField, genreField, authorField;
    private JButton addButton;

    public GUIaddLivre() {
        super("Add Book");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(500, 200);

        // create the text fields and button
        titleField = new JTextField(20);
        genreField = new JTextField(20);
        authorField = new JTextField(20);
        addButton = new JButton("Add Book");
        addButton.addActionListener(this);

        // add the text fields and button to the frame
        JPanel panel = new JPanel();
        panel.setLayout(new GridLayout(4, 2));
        panel.add(new JLabel("Title:"));
        panel.add(titleField);
        panel.add(new JLabel("Genre:"));
        panel.add(genreField);
        panel.add(new JLabel("Author:"));
        panel.add(authorField);
        panel.add(new JLabel(""));
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
            System.out.println("title : "+title+"\ngenre : "+genre+"\nauthor : "+author+"\n");
        }
    }
}
