<?php 
    // conexão com o banco de dados 
    $con=mysqli_connect("localhost","root",""); 
    mysqli_select_db($con, "dbceli");
     
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
    $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1; 
 
    //seleciona todos os itens da tabela 
    $cmd = "select * from candidato ca join curso c on ca.idcurso=c.id order by ca.idcandidato"; 
    $produtos = mysqli_query($con, $cmd); 
 
    //conta o total de itens 
    $total = mysqli_num_rows($produtos); 
 
    //seta a quantidade de itens por página, neste caso, 2 itens 
    $registros = 20; 
 
    //calcula o número de páginas arredondando o resultado para cima 
    $numPaginas = ceil($total/$registros); 
 
    //variavel para calcular o início da visualização com base na página atual 
    $inicio = ($registros*$pagina)-$registros; 
 
    //seleciona os itens por página 
    $cmd = "select * from candidato ca join curso c on ca.idcurso=c.id order by ca.idcandidato limit $inicio,$registros"; 
    $candidato = mysqli_query($con, $cmd); 
     
     
    //exibe os produtos selecionados 
    while ($candidato = mysqli_fetch_array($produtos)) { 
        echo $candidato['idcandidato']." - "; 
        echo $candidato['nome']." - "; 
        echo $candidato['documento']." - "; 
        echo $candidato['telefone']."-"; 
		echo $candidato['email']."-"; 
		echo $candidato['ie']."-";
		echo $candidato['curso']."<br/>"; 		
    } 
     
    //exibe a paginação 
    for($i = 1; $i < $numPaginas + 1; $i++) { 
        echo "<a href='paginacao.php?pagina=$i'>".$i."</a> "; 
    } 
?>