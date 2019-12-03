package br.com.infox.frames;

import java.awt.Color;
import java.awt.EventQueue;
import java.awt.Font;
import java.awt.Panel;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.text.DateFormat;
import java.util.Date;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.SwingConstants;
import javax.swing.border.EmptyBorder;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;

public class Principal extends JFrame {

	private JPanel contentPane;
	private JLabel lblData;
	public Panel panel;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Principal frame = new Principal();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public Principal() {
		addWindowListener(new WindowAdapter() {
			@Override
			public void windowActivated(WindowEvent e) {
				alterarLabel();
			}
		});
		setTitle("InfoX - Sistema para controle de OS");
		setResizable(false);
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 485, 232);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JLabel lblNewLabel = new JLabel("");
		lblNewLabel.setIcon(new ImageIcon(Principal.class.getResource("/br/com/infox/icones/x.png")));
		lblNewLabel.setBounds(720, 527, 256, 256);
		contentPane.add(lblNewLabel);
		
		JButton btnSobre = new JButton("Sobre");
		btnSobre.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				About sobre = new About();
				sobre.setVisible(true);
			}
		});
		btnSobre.setBounds(373, 11, 89, 23);
		contentPane.add(btnSobre);
		
		JButton btnCliente = new JButton("");
		btnCliente.setToolTipText("Cliente");
		btnCliente.setIcon(new ImageIcon(Principal.class.getResource("/br/com/infox/icones/iconfinder_Client_Male_Light_80824.png")));
		btnCliente.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				Controle cliente = new Controle();
				cliente.setVisible(true);
			}
		});
		btnCliente.setBounds(48, 60, 124, 124);
		contentPane.add(btnCliente);
		
		JButton btnOs = new JButton("");
		btnOs.setToolTipText("OS");
		btnOs.setIcon(new ImageIcon(Principal.class.getResource("/br/com/infox/icones/ordem de servico 1.png")));
		btnOs.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				Fornecedores os = new Fornecedores();
				os.setVisible(true);
				
			}
		});
		btnOs.setBounds(236, 60, 124, 124);
		contentPane.add(btnOs);
		
		panel = new Panel();
		panel.setBackground(Color.LIGHT_GRAY);
		panel.setBounds(0, 527, 794, 44);
		contentPane.add(panel);
		panel.setLayout(null);
		
		lblData = new JLabel("");
		lblData.setFont(new Font("Tahoma", Font.BOLD, 16));
		lblData.setBounds(10, 11, 422, 14);
		panel.add(lblData);
	}
	private void alterarLabel() {
		Date data = new Date();
		DateFormat formatador = DateFormat.getDateInstance(DateFormat.FULL);
		lblData.setText(formatador.format(data));
		
	}
	
}
