<?php
	include "database.php";
		
    if ( !empty($_POST)) {
    	
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $mobile = trim($_POST['mobile']);
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Por favor coloque um nome';//'Please enter Name';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Por favor preencha o email';//'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Por favor preencha o email corretamente';//'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Por favor informar telefone';//'Please enter Mobile Number';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
        	
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customers (clien_nome,clien_email,clien_telefone) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$mobile));
            Database::disconnect();
            //            
            {
		       header( 'HTTP/1.1 303 See Other' );
		       header( 'Location: customers.php?message=success' );
		       exit();
		    }
        } else {
        	echo '<div class="alert alert-danger">
				  <strong>Erro:</strong> '.$nameError.' '.$emailError.' '.$mobileError.'
				</div>';
        }
    }
?>
	
<?php
@include("header.php");
?>
	
	<?php
	if( isset( $_GET[ 'message' ] ) && $_GET[ 'message' ] == 'success' )
	{
		echo '<div class="alert alert-success">
					<strong>Sucesso!</strong> Cliente '.$name.' adicionado no banco de dados.
			</div>';
	}
	?>
	
		<div class="row">
			<h4 class="pull-left">CLIENTES</h4>
			<p class="text-right"><btn class="btn-sm btn-primary text-right" id="adc-btn" style="cursor: pointer;">ADICIONAR</btn></p>
		</div>
		
		<div class="row" id="row-adc" style="background-color:#EEE; padding:10px 10px;">
			<form class="form-horizontal need-validation" action="customers.php" method="post">

			 <div class="form-group col-md-4">
			   <label for="name">NOME</label>
			   <div class="controls">
                    <input id="input_name" name="name" type="text"  placeholder="Nome Completo" value="<?php echo !empty($name)?$name:'';?>" required="" >
                </div>
			 </div>
			 
			 <div class="form-group col-md-4">
			   <label for="email">EMAIL</label>
			  	<div class="controls">
                    <input id="input_email" name="email" type="text" placeholder="email@example.com" value="<?php echo !empty($email)?$email:'';?>" data-parsley-trigger="change" required="" type="email">
                </div>
			 </div>
			 
			 <div class="form-group col-md-4">
			   <label for="mobile">TELEFONE</label>
			   <div class="controls">
                    <input id="input_mobile" name="mobile" type="text"  placeholder="(00) 000 000 000" value="<?php echo !empty($mobile)?$mobile:'';?>" required="" >
                </div>
			 </div>

                <div class="form-actions">
                  <br />
                  <button type="submit" class="btn btn-sm btn-success">SALVAR</button>
                </div>
            </form>
		</div>
		<div class="row">
			
			<table class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>NOME</th>
				  <th>EMAIL</th>
				  <th>TELEFONE</th>
				  <th>PEDIDOS</th>
				  <th>REMOVER</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
			   
			   $pdo = Database::connect();
			   $sql = 'SELECT * FROM customers LIMIT 10';
			   foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td class="cust_db_id">'. $row['clien_id'] . '</td>';
						echo '<td class="cust_db_nome"><span class="edit" id="1">'. $row['clien_nome'] . '</span></td>';
						echo '<td class="cust_db_email"><span class="edit">'. $row['clien_email'] . '</span></td>';
						echo '<td class="cust_db_telefone"><span class="edit">'. $row['clien_telefone'] . '</span></td>';
						echo '<td>'. "." . '</td>';
						echo '<td><button title="" data-placement="top" data-toggle="tooltip" class="btn btn-default btn-customer-delete" type="button" data-original-title="REMOVER CLIENTE" rel="tooltip"><i class="glyphicon glyphicon-remove-circle"></i></button></td>';
						echo '</tr>';
			   }
			   Database::disconnect();
			  ?>
			  </tbody>
			</table>
		</div>

<?php
	@include("footer.php");
?>
  
