import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.sql.SQLException;
import java.util.ArrayList;

public class MainManagementGUI extends JFrame implements ActionListener {

    private JLabel titleLabel;
    private JButton addButton, removeButton, updateButton;

    private ArrayList<String> books;

    public MainManagementGUI() {
        super("Library");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(800, 400);

        this.books = books;

        // create the title label with a font and font size
        titleLabel = new JLabel("Library Management", SwingConstants.CENTER);
        titleLabel.setFont(new Font("Arial", Font.BOLD, 20));

        // create the add, remove, and update buttons with a background color and font color
        addButton = new JButton("Add Book");
        addButton.setBackground(new Color(195, 195, 195));
        addButton.setForeground(Color.BLACK);
        removeButton = new JButton("Remove Book");
        removeButton.setBackground(new Color(195, 195, 195));
        removeButton.setForeground(Color.BLACK);
        updateButton = new JButton("Update Books");
        updateButton.setBackground(new Color(195, 195, 195));
        updateButton.setForeground(Color.BLACK);

        // add action listeners to the buttons
        addButton.addActionListener(this);
        removeButton.addActionListener(this);
        updateButton.addActionListener(this);

        // create a panel to hold the buttons with a border
        JPanel buttonPanel = new JPanel();
        buttonPanel.setLayout(new GridLayout(3, 1, 10, 10));
        buttonPanel.setBorder(BorderFactory.createEmptyBorder(10, 10, 10, 10));
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
            try {
                new removeLivreGUI();
            } catch (SQLException ex) {
                throw new RuntimeException(ex);
            }
            this.dispose();

        } else if (e.getSource() == updateButton) {
            try {
                new updateLivreGUI();
            } catch (SQLException ex) {
                throw new RuntimeException(ex);
            }
            this.dispose();
        }
    }
}
