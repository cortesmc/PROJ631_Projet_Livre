import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.util.ArrayList;

public class MainManagementGUI extends JFrame implements ActionListener {

    private JLabel titleLabel;
    private JButton addButton, removeButton, updateButton;

    private ArrayList<String> books;

    public MainManagementGUI() {
        super("Library");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(400, 200);

        this.books = books;

        // create the title label
        titleLabel = new JLabel("Library Management", SwingConstants.CENTER);

        // create the add, remove, and update buttons
        addButton = new JButton("Add Book");
        removeButton = new JButton("Remove Book");
        updateButton = new JButton("Update Books");

        // add action listeners to the buttons
        addButton.addActionListener(this);
        removeButton.addActionListener(this);
        updateButton.addActionListener(this);

        // create a panel to hold the buttons
        JPanel buttonPanel = new JPanel();
        buttonPanel.setLayout(new GridLayout(1, 3));
        buttonPanel.add(addButton);
        buttonPanel.add(removeButton);
        buttonPanel.add(updateButton);

        // add the components to the frame
        JPanel mainPanel = new JPanel();
        mainPanel.setLayout(new BorderLayout());
        mainPanel.add(titleLabel, BorderLayout.NORTH);
        mainPanel.add(buttonPanel, BorderLayout.CENTER);
        add(mainPanel);

        setVisible(true);
    }

    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == addButton) {
            new addLivreGUI();
            this.dispose();
        } else if (e.getSource() == removeButton) {
            new removeLivreGUI(this.books);
            this.dispose();

        } else if (e.getSource() == updateButton) {
            // handle update books button click
            // ...
        }
    }

}
