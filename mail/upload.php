<?
//Recebe dados do formulário
/*$Nome	= $_POST["name1"];
$Endereco = $_POST["endereco"];
$Curso = $_POST["curso"];
$Equipe = $_POST["equipe"];

$mensagem = "
Nome: $Nome<br>
Endereco: $Endereco<br>
Curso: $Curso<br>
Equipe: $Equipe<br>";
*/

//Dados do Email a ser enviado
$Para = "romero_claudino@hotmail.com";
$Assunto = "Anexos.";

//Recebe o anexo
$tiposPermitidos= array('zip', 'rar');
$tamanhoPermitido = 4194304; //4mb

$arqName = $_FILES['arquivo']['name'];
$arqType = $_FILES['arquivo']['type'];
$arqSize = $_FILES['arquivo']['size'];
$arqTemp = $_FILES['arquivo']['tmp_name'];
$arqError = $_FILES['arquivo']['error'];
if($arqError == 0){
	if (array_search($arqType, $tiposPermitidos) === false) {
		echo 'O tipo de arquivo enviado é inválido!';
	}else if ($arqSize > $tamanhoPermitido) {
		echo 'O tamanho do arquivo enviado é maior que o limite!';
	} else {
		$fp = fopen($_FILES["arquivo"]["tmp_name"],"rb");
		$Anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"]));
		$Anexo = base64_encode($Anexo);
		fclose($fp);
		$Anexo = chunk_split($Anexo);
		$boundary = "XYZ-" . date("dmYis") . "-ZYX";
		$Corpo = "--$boundary\n";
		$Corpo .= "Content-Transfer-Encoding: 8bits\n";
		$Corpo .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n\n"; //plain
		//$Corpo .= "$mensagem\n";
		$Corpo .= "--$boundary\n";
		$Corpo .= "Content-Type: ".$arqName["type"]."\n";
		$Corpo .= "Content-Disposition: attachment; filename=\"".$arqName["name"]."\"\n";
		$Corpo .= "Content-Transfer-Encoding: base64\n\n";
		$Corpo .= "$Anexo\n";
		$Corpo .= "--$boundary--\r\n";
		$Headers = "MIME-Version: 1.0\n";
		//$Headers .= "From: \"$Nome\" <$Curso>\r\n";
		$Headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
		$Headers .= "$boundary\n";
		mail($Para,$Assunto,$Corpo,$Headers);
		echo"Mensagem enviada com sucesso.";
	}
}else{
	echo"Não foi possível enviar sua mensagem.";
}

?>