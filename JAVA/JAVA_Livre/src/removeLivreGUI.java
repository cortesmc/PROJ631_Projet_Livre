import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.ArrayList;

public class removeLivreGUI extends JFrame implements ActionListener {

    private JComboBox<String> bookList;
    private JButton removeBtn, goBack;
    private ArrayList<String> books;

    public removeLivreGUI() throws SQLException {

        super("Remove Book");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(800, 400);

        // get the list of books
        Connection conn = ToolsBDD.connexionBDD(ToolsBDD.SERVER, "proj631_livres", ToolsBDD.USERNAME, ToolsBDD.PWD);
        this.books = ToolsBDD.getAllBooksTitle(conn);

        // create the book list combo box and remove button
        bookList = new JComboBox<>();
        
        for (String book : books) {
            bookList.addItem(book);
        }

        removeBtn = new JButton("Remove Book");
        removeBtn.addActionListener((event) -> {
            try {
                removeBtnListener(event);
            } catch (SQLException e) {
                throw new RuntimeException(e);
            }
        });

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
        panel1.add(removeBtn);

        panel2.add(panel);
        panel2.add(panel1);
        add(panel2);

        setVisible(true);
    }


    public void removeBtnListener(ActionEvent event) throws SQLException {
        String titleSelected = (String) this.bookList.getSelectedItem();

        int validation = JOptionPane.showConfirmDialog(this, "Voulez vous vraiment supprimé le livre : " + titleSelected + " ? ");
        // 0=yes, 1=no, 2=cancel

        if (validation == 0) {
            Connection conn = ToolsBDD.connexionBDD(ToolsBDD.SERVER, "proj631_livres", ToolsBDD.USERNAME, ToolsBDD.PWD);
            ToolsBDD.removeBookBDD(conn, titleSelected);

            dispose();
            new MainManagementGUI();
            JOptionPane.showMessageDialog(this, "Le livre "+ titleSelected + " a bien été supprimé !");

        }
    }

    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == removeBtn) {
            // get the selected book from the combo box
            String selectedTitle = (String) bookList.getSelectedItem();
        }
        if (e.getSource() == goBack) {
            new MainManagementGUI();
            this.dispose();
        }
    }
}
