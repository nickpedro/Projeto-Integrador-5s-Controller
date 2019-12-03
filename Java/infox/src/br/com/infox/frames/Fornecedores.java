package br.com.infox.frames;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.border.LineBorder;

import br.com.infox.dal.ConnectionModule;
import net.proteanit.sql.DbUtils;

import java.awt.Color;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.JRadioButton;
import javax.swing.border.EtchedBorder;
import javax.swing.ImageIcon;
import javax.swing.JComboBox;
import javax.swing.DefaultComboBoxModel;
import javax.swing.JTable;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.awt.event.ActionEvent;
import javax.swing.JTextPane;
import javax.swing.ButtonGroup;
import java.awt.Font;
import javax.swing.JScrollPane;

public class Fornecedores extends JFrame {
	
	Connection con = ConnectionModule.conector();
	PreparedStatement pst = null;
	ResultSet rs = null;

	private JPanel contentPane;
	private JTextField txtPesquisar;
	private JTextField txtId;
	private JTextField txtFornecedor;
	private JTextField txtQFardo;
	private JTextField txtProduto;
	private JTextField txtEntrega;
	private final ButtonGroup buttonGroup = new ButtonGroup();
	private final ButtonGroup buttonGroup_1 = new ButtonGroup();
	private JTable Fornecedor;
	private JTextField txtChegada;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Fornecedores frame = new Fornecedores();
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
	public Fornecedores() {
		setTitle("OS");
		setResizable(false);
		setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		setBounds(100, 100, 664, 600);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JPanel panel_1 = new JPanel();
		panel_1.setBorder(new EtchedBorder(EtchedBorder.RAISED, Color.BLUE, Color.BLUE));
		panel_1.setBounds(10, 11, 638, 225);
		contentPane.add(panel_1);
		panel_1.setLayout(null);
		
		JLabel lblFornecedor = new JLabel("Fornecedor");
		lblFornecedor.setBounds(10, 11, 77, 14);
		panel_1.add(lblFornecedor);
		
		txtPesquisar = new JTextField();
		txtPesquisar.setBounds(10, 36, 468, 20);
		panel_1.add(txtPesquisar);
		txtPesquisar.setColumns(10);
		
		JLabel lblId = new JLabel("* id");
		lblId.setBounds(556, 11, 48, 14);
		panel_1.add(lblId);
		
		txtId = new JTextField();
		txtId.setBounds(556, 36, 72, 20);
		panel_1.add(txtId);
		txtId.setColumns(10);
		
		JButton button = new JButton("");
		button.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				pesquisar();
			}
		});
		button.setIcon(new ImageIcon(Fornecedores.class.getResource("/br/com/infox/icones/pesquisar.png")));
		button.setBounds(488, 21, 58, 35);
		panel_1.add(button);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(10, 75, 618, 139);
		panel_1.add(scrollPane);
		
		Fornecedor = new JTable();
		Fornecedor.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				setarCampos();
			}
		});
		scrollPane.setViewportView(Fornecedor);
		
		JLabel lblEquipamento = new JLabel("* Fornecedor");
		lblEquipamento.setFont(new Font("Arial", Font.PLAIN, 17));
		lblEquipamento.setBounds(10, 247, 101, 14);
		contentPane.add(lblEquipamento);
		
		txtFornecedor = new JTextField();
		txtFornecedor.setBounds(128, 244, 507, 20);
		contentPane.add(txtFornecedor);
		txtFornecedor.setColumns(10);
		
		JLabel lblDefeito = new JLabel("*Quantidade Fardo");
		lblDefeito.setFont(new Font("Arial", Font.PLAIN, 17));
		lblDefeito.setBounds(10, 289, 155, 14);
		contentPane.add(lblDefeito);
		
		txtQFardo = new JTextField();
		txtQFardo.setBounds(154, 288, 481, 20);
		contentPane.add(txtQFardo);
		txtQFardo.setColumns(10);
		
		txtProduto = new JTextField();
		txtProduto.setBounds(89, 354, 546, 20);
		contentPane.add(txtProduto);
		txtProduto.setColumns(10);
		
		JLabel lblTecnico = new JLabel("*Produto");
		lblTecnico.setFont(new Font("Arial", Font.PLAIN, 17));
		lblTecnico.setBounds(10, 355, 71, 14);
		contentPane.add(lblTecnico);
		
		JLabel lblTotal = new JLabel("*Entrega");
		lblTotal.setFont(new Font("Arial", Font.PLAIN, 17));
		lblTotal.setBounds(10, 434, 84, 14);
		contentPane.add(lblTotal);
		
		txtEntrega = new JTextField();
		txtEntrega.setBounds(91, 433, 544, 20);
		contentPane.add(txtEntrega);
		txtEntrega.setColumns(10);
		
		JButton btnAtualizar = new JButton("");
		btnAtualizar.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				atualizar();
			}
		});
		btnAtualizar.setToolTipText("Atualizar Os");
		btnAtualizar.setIcon(new ImageIcon(Fornecedores.class.getResource("/br/com/infox/icones/update.png")));
		btnAtualizar.setBounds(256, 496, 64, 64);
		contentPane.add(btnAtualizar);
		
		JLabel lblchegada = new JLabel("*Chegada");
		lblchegada.setFont(new Font("Arial", Font.PLAIN, 17));
		lblchegada.setBounds(-3, 389, 84, 14);
		contentPane.add(lblchegada);
		
		txtChegada = new JTextField();
		txtChegada.setColumns(10);
		txtChegada.setBounds(89, 388, 546, 20);
		contentPane.add(txtChegada);
	}
	
	
	/**
	 * Crud Read
	 */
	private void pesquisar() {
		
		
		 String read = "select * from tbadega where marca like ?";
	        try {
	            pst = (PreparedStatement) con.prepareStatement(read);
	            //atenção ao "%" - continuação da String sql
	            pst.setString(1, txtPesquisar.getText() + "%");
	            rs = pst.executeQuery();
	            // a linha abaixo usa a biblioteca rs2xml.jar para preencher a tabela
	            Fornecedor.setModel(DbUtils.resultSetToTableModel(rs));

	        } catch (Exception e) {
				System.out.println(e);
			}
	}// fim do construtor
	public void setarCampos() {
    	int setar = Fornecedor.getSelectedRow();
    	txtId.setText(Fornecedor.getModel().getValueAt(setar,0).toString());
    	txtFornecedor.setText(Fornecedor.getModel().getValueAt(setar,1).toString());
    	txtQFardo.setText(Fornecedor.getModel().getValueAt(setar,2).toString());
    	
    	txtProduto.setText(Fornecedor.getModel().getValueAt(setar,3).toString());
    	txtChegada.setText(Fornecedor.getModel().getValueAt(setar,4).toString());
    	txtEntrega.setText(Fornecedor.getModel().getValueAt(setar,5).toString());
    }
	/**
	 * Limpar campos
	 */
	private void limpar() {
		txtFornecedor.setText(null);
		txtQFardo.setText(null);
		txtProduto.setText(null);
		txtEntrega.setText(null);
		
	}

	/**
	 * CRUD atualizar
	 */
	private void atualizar() {
		String update = "update tbadega set marca=?, quantidadeFrd=?, nome=?, horario=?, entregues=? where id=? ";
		try {
			pst = (PreparedStatement) con.prepareStatement(update);
			// passagem de parâmetros
			pst.setString(1, txtFornecedor.getText());
			pst.setString(2, txtQFardo.getText());
			pst.setString(3, txtProduto.getText());
			pst.setString(4, txtChegada.getText());
			pst.setString(5, txtEntrega.getText());
			pst.setString(6, txtId.getText());
			int r = pst.executeUpdate();
			if (r > 0) {
				JOptionPane.showMessageDialog(null, "Tabela alterada com sucesso");
				limpar();
			} // fim do if
			else {
				JOptionPane.showMessageDialog(null, "Não foi possivel alterar a Tabela");
			} // fim do else
		} // fim do try
		catch (Exception e) {
			System.out.println(e);
		} // fim
	}// fim do construtor
}
