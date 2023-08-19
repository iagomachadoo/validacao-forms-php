<?php

// Incluindo o arquivo de conexão
include_once './conexao.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Contato</title>
</head>
<body>
    <h2>Formulário de Contato</h2>

    <!-- Start Tratamento dos dados -->

    <?php
        // Recebendo os dados de todos os campos
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // Verificando se o form foi enviado pelo btn
        if(!empty($dados['AddMsgContato'])){
            var_dump($dados);

            // Valida telefone
            function validaTelefone($tel){
                //processa a string mantendo apenas números no valor de entrada.
                $tel = preg_replace("/[^0-9]/", "", $tel); 
                    
                $lenValor = strlen($tel);
                
                //validando a quantidade de caracteres de telefone fixo ou celular.
                if($lenValor != 10 && $lenValor != 11)
                    return false;
                
                //DD e número de telefone não podem começar com zero.
                if($tel[0] == "0" || $tel[2] == "0")
                    return false;
                
                return true;
            }

            //  Validando campos individualmente
            if(empty($dados['nome'])){
                echo "<p style='color: red;'>Erro: o campo Nome é obrigatório</p>";

            }else if(empty($dados['email'])){
                echo "<p style='color: red;'>Erro: o campo Email é obrigatório</p>";

            }else if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
                echo "<p style='color: red;'>Erro: insira um Email válido</p>";

            }else if(empty($dados['tel'])){
                echo "<p style='color: red;'>Erro: o campo Telefone é obrigatório</p>";

            }else if(!validaTelefone($dados['tel'])){
                echo "<p style='color: red;'>Erro: insira um número de telefone válido</p>";

            }else if(empty($dados['assunto'])){
                echo "<p style='color: red;'>Erro: o campo Assunto é obrigatório</p>";

            }else if(empty($dados['conteudo'])){
                echo "<p style='color: red;'>Erro: o campo Conteúdo é obrigatório</p>";

            }else{
                // Criando a Query
                $query_contato = "INSERT INTO contatos (nome, email, telefone, assunto, conteudo) VALUES (:nome, :email, :telefone, :assunto, :conteudo)"; 
    
                // Preparando a query
                $add_contato = $conn->prepare($query_contato);
    
                // Atribuindo valores ao link da coluna
                // PDO::PARAM_STR força o valor como uma string. Aumenta a segurança da query, mas não é obrigatório
                $add_contato->bindParam(":nome", $dados['nome'], PDO::PARAM_STR);
                $add_contato->bindParam(":email", $dados['email'], PDO::PARAM_STR);
                $add_contato->bindParam(":telefone", $dados['tel'], PDO::PARAM_STR);
                $add_contato->bindParam(":assunto", $dados['assunto'], PDO::PARAM_STR);
                $add_contato->bindParam(":conteudo", $dados['conteudo'], PDO::PARAM_STR);
    
                // Executando a query
                $add_contato->execute();
    
                // Verificando se os dados foram inseridos com sucesso
                if($add_contato->rowCount()){
                    // Destruindo a variável dados caso o envio seja bem sucedido
                    unset($dados);

                    echo "<p style='color: green;'>Mensagem enviada com sucesso!</p>";
                }else{
                    echo "<p style='color: red;'>Erro: mensagem não enviada!</p>";
                }
            }
        }
    ?>

    <!-- End Tratamento dos dados -->
    <form action="" method="post">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" placeholder="Nome Completo" value="<?php if( isset($dados['nome']) ){ echo $dados['nome']; } ?>"><br><br>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Email" value="<?php if( isset($dados['email']) ){ echo $dados['email']; } ?>"><br><br>

        <label for="tel">Telefone</label>
        <input type="tel" name="tel" id="tel" placeholder="Telefone" value="<?php if( isset($dados['tel']) ){ echo $dados['tel']; } ?>"><br><br>

        <label for="assunto">Assunto</label>
        <input type="text" name="assunto" id="assunto" placeholder="Assunto" value="<?php if( isset($dados['assunto']) ){ echo $dados['assunto']; } ?>"><br><br>

        <label for="conteudo">Conteúdo</label>
        <textarea name="conteudo" id="conteudo" cols="30" rows="3" placeholder="Conteúdo da Mensagem" ><?php if( isset($dados['conteudo']) ){ echo $dados['conteudo']; } ?></textarea><br><br>

        <input type="submit" name="AddMsgContato" value="Enviar"><br><br>
    </form>
</body>
</html>