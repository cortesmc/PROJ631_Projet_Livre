import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.util.ArrayList;

public class removeLivreGUI extends JFrame implements ActionListener {

    private JComboBox<String> bookList;
    private JButton removeButton, goBack;
    private ArrayList<String> books;

    public removeLivreGUI(ArrayList<String> books) {
        super("Remove Book");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(800, 400);

        // save the list of books
        this.books = books;

        // create the book list combo box and remove button
        bookList = new JComboBox<>();
        for (String book : books) {
            bookList.addItem(book);
        }
        removeButton = new JButton("Remove Book");
        removeButton.addActionListener(this);
        goBack = new JButton("Back");
        goBack.addActionListener(this);

        // add the book list combo box and remove button to the frame
        JPanel panel = new JPanel();
        JPanel panel1 = new JPanel();
        JPanel panel2 = new JPanel();

        panel.setLayout(new GridLayout(1, 1));
        panel1.setLayout(new GridLayout(1, 2));
        panel2.setLayout(new GridLayout(2, 1));

        panel.add(bookList);

        panel1.add(goBack);
        panel1.add(removeButton);

        panel2.add(panel);
        panel2.add(panel1);
        add(panel2);

        setVisible(true);
    }

    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == removeButton) {
            // get the selected book from the combo box
            String selectedTitle = (String) bookList.getSelectedItem();
        }
        if (e.getSource() == goBack) {
            new MainManagementGUI(this.books);
            this.dispose();
        }
    }
}
