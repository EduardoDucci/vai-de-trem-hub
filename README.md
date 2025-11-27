Projeto SA – Vai de Trem 🚆

Aplicativo de gerenciamento de rodovias, com integração à API ViaCEP para facilitar o cadastro de endereços.

Integrantes

Jaison Conaco Junior

João Guilherme Duarte

Eduardo Ducci

Sobre

Neste projeto, após a conclusão dos mockups, desenvolvemos a primeira versão funcional do nosso aplicativo Vai de Trem, focado no gerenciamento de rodovias e trechos rodoviários.

O sistema permite o controle de informações relacionadas às rodovias, rotas e funcionários, proporcionando uma interface simples para cadastro, consulta e organização dos dados.
Atualmente, estamos na etapa de implementação em PHP, com integração ao banco de dados via MySQLi e uso da API ViaCEP para automatizar a busca de endereços por CEP.

Este repositório faz parte da Situação de Aprendizagem (SA) da matéria de Desenvolvimento de Sistemas.

Tecnologias Utilizadas

PHP (lógica de servidor e rotas internas)

MySQL / MySQLi (banco de dados relacional)

HTML5 (estrutura das páginas)

CSS3 (estilização e layout)

JavaScript (interações no front-end, consumo da API ViaCEP)

API ViaCEP (consulta de endereços por CEP)

Funcionalidades

Cadastro de rodovias e trechos;

Cadastro de funcionários vinculados à gestão das rodovias;

Consulta automática de endereço via CEP (API ViaCEP);

Visualização de informações cadastradas (rodovias, trechos, funcionários);

Edição de dados já cadastrados;

Exclusão de registros;

Navegação entre as telas do sistema de forma simples e organizada.

(As funcionalidades podem ser ajustadas/conferidas de acordo com o que vocês realmente implementaram na versão final.)

Como conectar com o Banco de Dados

Antes de utilizar o sistema, verifique se as variáveis no arquivo db.php estão corretas para o seu servidor local (ou remoto).
Altere principalmente as linhas referentes a:

$host     = "localhost";      // Host do banco
$username = "seu_usuario";    // Usuário do MySQL
$password = "sua_senha";      // Senha do MySQL
$database = "vai_de_trem";    // Nome do banco de dados
$port     = "3306";           // Porta do MySQL (padrão 3306)


Certifique-se de:

Ter criado o banco de dados com o mesmo nome configurado em $database;

Ter um usuário com permissão para acessar esse banco;

Ter o serviço MySQL rodando na máquina.

Script SQL

Execute o arquivo db.sql no seu banco de dados para:

Criar o banco (caso ainda não exista);

Criar as tabelas necessárias (rodovias, trechos, funcionários, etc.);

Inserir possíveis dados iniciais para teste (se estiverem incluídos no script).

Sem esse passo, o sistema poderá apresentar erros ao tentar salvar ou buscar informações no banco.

Importante ⚠️

Sem os dados de conexão corretos, o sistema não conseguirá acessar o banco de dados;

O banco de dados deve estar criado e configurado na sua máquina (ou servidor) para que você consiga navegar normalmente pelo aplicativo;

Verifique sempre se o db.php está apontando para o banco certo e se as tabelas foram criadas corretamente com o db.sql.

Evolução do Projeto

Utilizamos um quadro Kanban para organizar as tarefas da equipe, separando:

Planejamento e criação dos mockups;

Desenvolvimento do front-end (HTML, CSS, JS);

Implementação do back-end em PHP;

Integração com o banco de dados;

Integração com a API ViaCEP;

Testes e correções.

Esse fluxo ajudou a dividir melhor as responsabilidades entre os integrantes e visualizar o progresso de cada etapa.

ViaCEP – API

A API ViaCEP foi utilizada para automatizar a busca de endereços a partir do CEP informado pelo usuário.

Ela funciona como um serviço externo que retorna os dados de endereço (rua, bairro, cidade, UF) em formato JSON, que depois são tratados pelo nosso sistema e preenchidos automaticamente nos campos de formulário.

ViaCEP – Funcionalidades

Consulta de endereços por CEP;

Resposta em formato JSON;

Integração simples com JavaScript e PHP;

Redução de erros de digitação de endereços;

Preenchimento automático de campos, tornando o cadastro mais rápido.

ViaCEP – Limitações

Depende da disponibilidade do serviço ViaCEP (requisições externas);

Se o ViaCEP estiver fora do ar, a consulta de endereço não funcionará;

Não armazena histórico de consultas;

Responde apenas com os dados disponíveis para aquele CEP.

ViaCEP – Testes

Para testar a integração com a API ViaCEP dentro do sistema:

Acesse a tela de cadastro que possui o campo CEP;

Digite um CEP válido (por exemplo: 01001000);

Aguarde o preenchimento automático dos campos de endereço;

Verifique se rua, bairro, cidade e UF foram preenchidos corretamente.