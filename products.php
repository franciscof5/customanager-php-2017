<?php @include("header.php"); ?>

	<div id="main" class="row col-md-10 col-md-offset-1">
		<div class="row">
			<h4 class="pull-left">PRODUTOS</h4>
			<p class="text-right"><btn class="btn-sm btn-primary text-right" id="adc-btn" style="cursor: pointer;">ADICIONAR</btn></p>
		</div>
		
		<div class="row" id="row-adc" style="background-color:#EEE; padding:10px 10px;">
			<form class="form-horizontal need-validation" action="data.php" method="post">
			 <input type="hidden" name="ajaxcommand" value="add-product">

			 <div class="form-group col-md-4">
			   <label for="name">NOME</label>
			   <div class="controls">
                    <input id="input_name" name="name" type="text"  placeholder="Nome do produto" value="<?php echo !empty($name)?$name:'';?>"  required="" >
                </div>
			 </div>
			 
			 <div class="form-group col-md-4">
			   <label for="desc">DESCRIÇÃO</label>
			  	<div class="controls">
                    <input id="input_desc" name="desc" type="text" placeholder="Descrição curta" value="<?php echo !empty($email)?$email:'';?>" required="" >
                </div>
			 </div>
			 
			 <div class="form-group col-md-4">
			   <label for="price">PREÇO</label>
			   <div class="controls">
                    <input id="input_price" name="price" type="text"  placeholder="Preço" value="<?php echo !empty($mobile)?$mobile:'';?>" required="" >
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
				  <th>DESCRIÇÃO</th>
				  <th>PREÇO</th>
				  <th>PEDIDOS</th>
				  <th>REMOVER</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
			   //include "database.php";
			   $pdo = Database::connect();
			   $sql = 'SELECT * FROM products ';
			   foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td class="cust_db_id">'. $row['prod_id'] . '</td>';
						echo '<td class="cust_db_nome"><span class="edit">'. $row['prod_nome'] . '</span></td>';
						echo '<td class="cust_db_email"><span class="edit">'. $row['prod_desc'] . '</span></td>';
						echo '<td class="cust_db_telefone maskpreco"><span class="edit">'. $row['prod_preco'] . '</span></td>';
						echo '<td>'. "." . '</td>';
						echo '<td><button title="" data-placement="top" data-toggle="tooltip" class="btn btn-default btn-customer-delete" type="button" data-original-title="REMOVER PRODUTO" rel="tooltip"><i class="glyphicon glyphicon-remove-circle"></i></button></td>';
						echo '</tr>';
			   }
			   Database::disconnect();
			  ?>
			  </tbody>
			</table>
		</div>
		
		<div class="row">
			<nav>
			  <ul class="pagination">
			    <li>
			      <a href="#" aria-label="Previous">
			        <span aria-hidden="true">&laquo;</span>
			      </a>
			    </li>
			    <li><a href="#">1</a></li>
			    <li><a href="#">2</a></li>
			    <li><a href="#">3</a></li>
			    <li><a href="#">4</a></li>
			    <li><a href="#">5</a></li>
			    <li>
			      <a href="#" aria-label="Next">
			        <span aria-hidden="true">&raquo;</span>
			      </a>
			    </li>
			  </ul>
			</nav>
		</div>
	</div>

<?php @include("footer.php"); ?>
  
