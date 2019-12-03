package br.com.infox.dal;

import java.sql.Connection;
import java.sql.DriverManager;

public class ConnectionModule {

	public static Connection conector() {
		
		java.sql.Connection conection =null;
		String driver = "com.mysql.jdbc.Driver";
		
		String url = "jdbc:mysql://10.26.45.157:3306/adega?serverTimezone=UTC";
		
		String user = "root";
		
		String password = "pti@2018";
		try {
			Class.forName(driver);
			conection = DriverManager.getConnection(url,user,password);
			return conection;
		} catch (Exception e) {
			System.out.println(e);
			return null;
		}
	}
	
}