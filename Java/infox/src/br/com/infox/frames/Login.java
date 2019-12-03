package br.com.infox.frames;

import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.EventQueue;
import java.sql.Connection;
import java.sql.ResultSet;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;

import com.mysql.jdbc.PreparedStatement;

import br.com.infox.dal.ConnectionModule;

import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.JPasswordField;
import javax.swing.JButton;
import javax.swing.ImageIcon;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

public class Login extends JFrame {
	Connection con = ConnectionModule.conector();
	PreparedStatement pst = null;
	ResultSet rs = null;
	
	
	private JPanel contentPane;
	private JTextField txtUser;
	private JPasswordField txtPassword;
	private JButton btnLogin;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Login frame = new Login();
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
	public Login() {
		setResizable(false);
		setTitle("Login");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 351, 161);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JLabel lblUsurio = new JLabel("Usu\u00E1rio");
		lblUsurio.setBounds(10, 11, 48, 14);
		contentPane.add(lblUsurio);
		
		txtUser = new JTextField();
		txtUser.setBounds(55, 8, 190, 20);
		contentPane.add(txtUser);
		txtUser.setColumns(10);
		
		JLabel lblSenha = new JLabel("Senha");
		lblSenha.setBounds(10, 44, 48, 14);
		contentPane.add(lblSenha);
		
		txtPassword = new JPasswordField();
		txtPassword.setBounds(55, 41, 190, 20);
		contentPane.add(txtPassword);
		
		btnLogin = new JButton("Login");
		btnLogin.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
			login();
			}
		});
		btnLogin.setBounds(88, 89, 89, 23);
		contentPane.add(btnLogin);
		
		JLabel lblStatus = new JLabel("");
		lblStatus.setIcon(new ImageIcon(Login.class.getResource("/br/com/infox/icones/dberror.png")));
		lblStatus.setBounds(285, 11, 32, 32);
		contentPane.add(lblStatus);
		con = ConnectionModule.conector();
		if (con != null) {
			// System.out.println("banco conector");
			lblStatus.setIcon(new javax.swing.ImageIcon(getClass().getResource("/br/com/infox/icones/dbok.png")));
		} else {
			// System.out.println("erro de conexão");
			lblStatus.setIcon(new javax.swing.ImageIcon(getClass().getResource("/br/com/infox/icones/dberror.png")));
	}
	}
	
	//login
	private void login() {
		String read = "select * from usuario where username =? and password =?";
		try {
			pst = (PreparedStatement) con.prepareStatement(read);
			pst.setString(1, txtUser.getText());
			pst.setString(2, txtPassword.getText());
			rs = pst.executeQuery();
			if(rs.next()) {
				String perfil = rs.getString(3);
				if(perfil.equals("admin")) {
					Principal principal = new Principal();
					principal.setVisible(true);
					// Centralizar o Jframe
					
					principal.panel.setBackground(Color.RED
							);
					this.dispose();
					
				}
				else {
					Principal principal = new Principal();
					principal.setVisible(true);
					// Centralizar o Jframe
					principal.setLocationRelativeTo(null);
					this.dispose();
					}
				
			}else {
				JOptionPane.showMessageDialog(null, "usuário e/ou senha inválido(s)");
			}
		} catch (Exception e) {
			System.out.println(e);
		}
		//<enter> automatico
		getRootPane().setDefaultButton(btnLogin);
	}
	
	}
