# StartupModelSenior
Sistema para gestão de compras

Usuário
  Logar 
  Selecionar itens para realizar pedido 
Usuário -> Administrador  
  CRUD categorias 
  Gerir solicitações 
  CRUD itens 
  Gerar Relatórios 
  CRUD usuarios 

 Diagrama de Classes 

Este diagrama define a estrutura de dados e as relações entre os objetos do sistema. 

Classe 

Atributos Principais 

Usuario 

Nome, Crachá, Nível de Acesso (Comum/Adm) 

Item (Insumo) 

Descrição, Categoria, Unidade/Peso, Valor de Referência, Quantidade em Estoque 

Solicitacao 

Data, Usuário, Status (Flag), Turma (Opcional), Observação 

ItemSolicitado 

Item vinculado, Quantidade desejada 

PedidoCompra 

Lista de itens somados, Data de geração, Arquivo exportado (PDF/TXT) 

 

+-------------------+ 

|     Usuario       | 

+-------------------+ 

| id                      | 

| nome               | 

| cracha              | 

| nivelAcesso     | 

+-------------------+ 

 

+-------------------+ 

|     Categoria     | 

+-------------------+ 

| id                     | 

| nome              | 

+-------------------+ 

 

+-------------------+ 

|       Item          | 

+-------------------+ 

| id                       | 

| descricao         | 

| categoriaId       | 

| Quantidade     | 

| unidade de medida    | 

| valorReferencia   | 

+-------------------+ 

 

+-------------------+ 

|       Estoque     | 

+-------------------+ 

| id_item            | 

| descricao         | 

| unidadeOuPeso     | 

| valorReferencia   | 

| categoriaId       | 

+-------------------+ 

 

 

+---------------------------+ 

|   Solicitacao             | 

+---------------------------+ 

| id                        | 

| data                      | 

| status (espera/aprovado)  | 

| usuarioId                 | 

| itemId                      | 

|quantidade              | 

|turma                       | 

|observacao                       | 

+---------------------------+ 

 
 
Usuário  

Comum 

 

1. Tela login 

Tela para logar e iniciar o sistema 

Campos de Entrada: 

Nome do usuário 

Crachá: número do crachá 

Ações: 

Botões: Logar 

 

2. Tela de Seleção de Itens (Solicitação de Compra) 

Tela principal para o colaborador realizar seus pedidos de insumos. 

Identificação: 

Data: Preenchimento automático da data atual. 

Crachá: Identificação do solicitante. 

Seleção: 

Categoria: Filtro para facilitar a busca. 

Item: Lista de itens cadastrados para seleção. 

Quantidade: Número de unidades desejadas. 

Campos Adicionais: 

Indicação de Turma: Campo opcional para organização de consultas. 

Observação: Espaço para especificar marcas ou modelos. 

Ações: 

Botões: INCLUIR, CANCELAR. 

 

Tela para acompanhar os pedidos realizados 

 

Administrativo 

 

1. Tela login 

Tela para logar e iniciar o sistema 

Campos de Entrada: 

Nome do usuário 

Crachá: número do crachá 

Ações: 

Botões: Logar 

 

2. Tela de Categorias (Nível Administrador) 

Esta tela permite a gestão das categorias dos itens. 

Campos de Entrada: 

Nome:  

Ações: 

Botões: INCLUIR.  

Listar as Categorias, cada item ALTERAR, EXCLUIR. 
 

3. Tela de Itens (Nível Administrador) 

Esta tela permite a gestão do catálogo de insumos que estarão disponíveis para solicitação. 

Campos de Entrada: 

Nome:  

Descrição: Descrição do produto (ex: Mouse marca tal). 

Categoria: Seleção (Informática, Limpeza, etc.). 

Unidade/Peso: Quantidade em gramas ou unidades. 

Valor de Referência: Preço da última compra (opcional). 

Ações: 

Botões: INCLUIR.  

Listar as Categorias, cada item ALTERAR, EXCLUIR. 

 

3. Tela de Usuários (Nível Administrador) 

Utilizada para registrar colaboradores e definir suas permissões no sistema. 

Campos de Entrada: 

Nome: Nome completo do colaborador. 

Crachá: Identificador numérico único para evitar nomes iguais. 

Nível de Acesso: Dropdown com as opções "Usuário" ou "Administrador". 

Ações: 

Botões: INCLUIR.  

Listar as Categorias, cada item ALTERAR, EXCLUIR. 
 

4. Tela de Seleção de Itens (Solicitação de Compra) 

Tela principal para o colaborador realizar seus pedidos de insumos. 

Identificação: 

Data: Preenchimento automático da data atual. 

Crachá: Identificação do solicitante. 

Seleção: 

Categoria: Filtro para facilitar a busca. 

Item: Lista de itens cadastrados para seleção. 

Quantidade: Número de unidades desejadas. 

Campos Adicionais: 

Indicação de Turma: Campo opcional para organização de consultas. 

Observação: Espaço para especificar marcas ou modelos. 

Ações: 

Botões: INCLUIR, EXCLUIR, CANCELAR. 

 
Botão solicitar 

5. Tela de Gestão e Avaliação (Acompanhamento) 

Onde o gestor avalia as solicitações e o usuário consulta o status de seus pedidos. 

Lista de Solicitações: Exibição dos itens pedidos com data e descrição. 

Painel de Situação (Flags): 

Indicação visual para cada item: APROVADO, REPROVADO ou EM ESPERA. 

Recursos do Gestor: 

Filtro por solicitações "não atendidas". 

Opção de somar quantidades para gerar o pedido unificado em PDF ou texto. 

Ações: 

Botões: INCLUIR (para novos itens no pedido), EXCLUIR, CANCELAR. 

 

6. Tela relatório (Nível Administrador) 

Utilizado para emitir relatórios 

Pedidos de compras por período. 

Itens solicitados (por período ou por usuário). 

Status das solicitações (aprovadas, recusadas ou em espera). 

Lista de usuários e itens cadastrados com seus respectivos preços de referência. 
