<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <?php include_once "../layout/menu.php"; ?>
    <main>
        <div id="cadastro-categoria" class="screen">
            <h1>Cadastro de Categorias</h1>
            <div class="form-group">
                <label>Nome</label>
                <input type="text" placeholder="Ex: Informática, Limpeza">
            </div>
            <div class="btn-group">
                <button class="btn-add">INCLUIR</button>
                <!-- <button class="btn-del">EXCLUIR</button> -->
                <!-- <button class="btn-cancel">CANCELAR</button> -->
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Informática</td>
                        <td><button class="btn-add" style="padding:5px">Alterar</button> <button class="btn-del" style="padding:5px">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Limpeza</td>
                        <td><button class="btn-add" style="padding:5px">Alterar</button> <button class="btn-del" style="padding:5px">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Excritório</td>
                        <td><button class="btn-add" style="padding:5px">Alterar</button> <button class="btn-del" style="padding:5px">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Tempero</td>
                        <td><button class="btn-add" style="padding:5px">Alterar</button> <button class="btn-del" style="padding:5px">Excluir</button></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
