package br.com.infox.frames;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;

import com.mysql.jdbc.PreparedStatement;

import br.com.infox.cep.CepWebService;
import br.com.infox.dal.ConnectionModule;
import net.proteanit.sql.DbUtils;

import javax.swing.JTextField;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.ImageIcon;
import javax.swing.JTable;
import javax.swing.JComboBox;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.ResultSet;
import java.awt.event.ActionEvent;
import javax.swing.DefaultComboBoxModel;
import javax.swing.JScrollPane;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.Font;

public class Controle extends JFrame {
	
	Connection con = ConnectionModule.conector();
	PreparedStatement pst = null;
	ResultSet rs = null;

	private JPanel contentPane;
	private JTextField txtPesquisar;
	private JTable tbClientes;
	private JTextField txtNome;
	private JTextField txtSenha;
	private JTextField txtEmail;
	private JTextField txtId;
	private JTextField txtCargo;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Controle frame = new Controle();
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
	public Controle() {
		setResizable(false);
		setTitle("Cliente");
		setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		setBounds(100, 100, 663, 551);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		txtPesquisar = new JTextField();
		txtPesquisar.setBounds(20, 23, 242, 20);
		contentPane.add(txtPesquisar);
		txtPesquisar.setColumns(10);
		
		JLabel lblCampos = new JLabel("*Campos Obrigat\u00F3rios");
		lblCampos.setFont(new Font("Arial", Font.PLAIN, 17));
		lblCampos.setBounds(203, 234, 281, 28);
		contentPane.add(lblCampos);
		
		JLabel lblNome = new JLabel("* Nome");
		lblNome.setFont(new Font("Arial", Font.PLAIN, 17));
		lblNome.setBounds(10, 279, 91, 25);
		contentPane.add(lblNome);
		
		txtNome = new JTextField();
		txtNome.setBounds(111, 285, 536, 20);
		contentPane.add(txtNome);
		txtNome.setColumns(10);
		
		JLabel lblSenha = new JLabel("* Senha");
		lblSenha.setFont(new Font("Arial", Font.PLAIN, 17));
		lblSenha.setBounds(10, 401, 104, 28);
		contentPane.add(lblSenha);
		
		txtSenha = new JTextField();
		txtSenha.setBounds(111, 409, 182, 20);
		contentPane.add(txtSenha);
		txtSenha.setColumns(10);
		
		JLabel lblEmail = new JLabel("* Email");
		lblEmail.setFont(new Font("Arial", Font.PLAIN, 17));
		lblEmail.setBounds(10, 315, 104, 35);
		contentPane.add(lblEmail);
		
		txtEmail = new JTextField();
		txtEmail.setBounds(111, 326, 536, 20);
		contentPane.add(txtEmail);
		txtEmail.setColumns(10);
		
		JButton bntAdicionar = new JButton("");
		bntAdicionar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				adicionarCliente();
			}
		});
		bntAdicionar.setIcon(new ImageIcon(Controle.class.getResource("/br/com/infox/icones/create.png")));
		bntAdicionar.setToolTipText("Adicionar Cliente");
		bntAdicionar.setBounds(376, 437, 64, 64);
		contentPane.add(bntAdicionar);
		
		JButton btnAtualizar = new JButton("");
		btnAtualizar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				atualizar();
			}
		});
		btnAtualizar.setIcon(new ImageIcon(Controle.class.getResource("/br/com/infox/icones/update.png")));
		btnAtualizar.setToolTipText("Editar Cliente");
		btnAtualizar.setBounds(468, 437, 64, 64);
		contentPane.add(btnAtualizar);
		
		JButton btnRemover = new JButton("");
		btnRemover.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				remover();
			}
		});
		btnRemover.setIcon(new ImageIcon(Controle.class.getResource("/br/com/infox/icones/delete.png")));
		btnRemover.setToolTipText("Deletar Cliente");
		btnRemover.setBounds(566, 437, 64, 64);
		contentPane.add(btnRemover);
		
		JButton btnPesquisar = new JButton("");
		btnPesquisar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				pesquisarCliente();
				
			}
		});
		btnPesquisar.setIcon(new ImageIcon(Controle.class.getResource("/br/com/infox/icones/search.png")));
		btnPesquisar.setBounds(270, 23, 58, 35);
		contentPane.add(btnPesquisar);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(595, 138, -308, -50);
		contentPane.add(scrollPane);
		
		JScrollPane scrollpane = new JScrollPane();
		scrollpane.setBounds(20, 67, 614, 156);
		contentPane.add(scrollpane);
		
		tbClientes = new JTable();
		tbClientes.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				setarCampos();
			}
		});
		scrollpane.setViewportView(tbClientes);
		
		JLabel lblId = new JLabel("Id");
		lblId.setFont(new Font("Arial", Font.PLAIN, 17));
		lblId.setBounds(361, 19, 43, 20);
		contentPane.add(lblId);
		
		txtId = new JTextField();
		txtId.setBounds(388, 23, 70, 20);
		contentPane.add(txtId);
		txtId.setColumns(10);
		
		JLabel lblCargo = new JLabel("* Cargo");
		lblCargo.setFont(new Font("Arial", Font.PLAIN, 17));
		lblCargo.setBounds(10, 363, 91, 25);
		contentPane.add(lblCargo);
		
		txtCargo = new JTextField();
		txtCargo.setBounds(111, 367, 366, 20);
		contentPane.add(txtCargo);
		txtCargo.setColumns(10);
	}
	private void limpar() {
		txtNome.setText(null);
		txtSenha.setText(null);
		txtEmail.setText(null);
		txtCargo.setText(null);

	}
		
	private void adicionarCliente() {
		String create = "insert into usuario (username, password, email, cargo) values(?,?,?,?)";
		try {
			pst = (PreparedStatement) con.prepareStatement(create);
			// passagem de parâmetros
			pst.setString(1, txtNome.getText());
			pst.setString(2, txtSenha.getText());
			pst.setString(3, txtEmail.getText());
			pst.setString(4, txtCargo.getText());

			
			int r = pst.executeUpdate();
			if (r > 0) {
				JOptionPane.showMessageDialog(null, "Contato adicionado com sucesso");
				limpar();
			} // fim do if
			else {
				JOptionPane.showMessageDialog(null, "Não foi possivel cadastrar");
			} // fim do else
		} // fim do try
		catch (Exception e) {
			System.out.println(e);
		} // fim do catch

	}// fim do adicionar
	
	//método para pesquisar clientes pelo nome com filtro
	
    private void pesquisarCliente() {
        String read = "select * from usuario where username like ?";
        try {
            pst = (PreparedStatement) con.prepareStatement(read);
            //atenção ao "%" - continuação da String sql
            pst.setString(1, txtPesquisar.getText() + "%");
            rs = pst.executeQuery();
            // a linha abaixo usa a biblioteca rs2xml.jar para preencher a tabela
            tbClientes.setModel(DbUtils.resultSetToTableModel(rs));

        } catch (Exception e) {
			System.out.println(e);
		}
    }
    //método para setar os campos do formulário com o conteúdo da tabela
    public void setarCampos() {
    	int setar = tbClientes.getSelectedRow();
    	txtNome.setText(tbClientes.getModel().getValueAt(setar,1).toString());
    	txtSenha.setText(tbClientes.getModel().getValueAt(setar,2).toString());
    	txtEmail.setText(tbClientes.getModel().getValueAt(setar,3).toString());
    	txtCargo.setText(tbClientes.getModel().getValueAt(setar,4).toString());
    	txtId.setText(tbClientes.getModel().getValueAt(setar,0).toString());
    }
    private void atualizar() {
		String update = "update usuario set username=?, password=?, email=?, cargo=? where id=?";
		try {
			pst = (PreparedStatement) con.prepareStatement(update);
			// passagem de parâmetros
			pst.setString(1, txtNome.getText());
			pst.setString(2, txtSenha.getText());
			pst.setString(3, txtEmail.getText());
			pst.setString(4, txtCargo.getText());
			pst.setString(5, txtId.getText());
			
			
			int r = pst.executeUpdate();
			if (r > 0) {
				JOptionPane.showMessageDialog(null, "Contato Editado com sucesso");
				limpar();
			} // fim do if
			else {
				JOptionPane.showMessageDialog(null, "Não foi possivel Editar");
			} // fim do else
		}
     catch (Exception e) {
		System.out.println(e);
	}
// fim do try
    }
    private void remover() {
		// Criar uma caixa de diálogo para confirmar a exclusão
		int confirma = JOptionPane.showConfirmDialog(null, "Confirma a Exclusão Deste Curso?", "Atenção", JOptionPane.YES_NO_OPTION);
		if (confirma == JOptionPane.YES_OPTION) {
			String delete = "delete from usuario where id=?";
			try {
				pst = (PreparedStatement) con.prepareStatement(delete);
				pst.setString(1, txtId.getText());
				int r = pst.executeUpdate();
				if (r > 0) {
					JOptionPane.showMessageDialog(null, "Curso removido com Sucesso!");
				} else {
					JOptionPane.showMessageDialog(null, "Impossível remover o Curso!");
					
				}
				
			} catch (Exception e) {
				System.out.println(e);
			}
		}
}
}

    



