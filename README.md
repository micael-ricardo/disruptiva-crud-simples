## Teste Disrupitiva

A aplicação consiste em um cadastro de pessoas(nome, idade, e-mail, senha, sexo) e endereços(tipo_logradouro, cidade, logradouro, numero, cep, bairro). Há validação de campos obrigatórios, mascaramento de CEP e lógica para exibição da classificação.
O back-end em laravel provê uma API REST para realizar as operações CRUD no banco de dados MySQL. O front-end consome essa API e exibe os dados em uma interface com jQuery, DataTables e Bootstrap.

## Tecnologias Utilizadas

- Laravel: Um framework PHP leve e eficiente para desenvolvimento web no back-end.
- jQuery e DataTables: Bibliotecas JavaScript para interação avançada com o cliente e manipulação de tabelas.
- Bootstrap: Um framework CSS popular para estilização responsiva e moderna.
- MVC: O padrão de arquitetura Model-View-Controller para organizar e separar o código em camadas distintas.
- MySQL: Um sistema de gerenciamento de banco de dados relacional para armazenar e recuperar dados.
- HTML: Linguagem de marcação para estruturar o conteúdo do projeto.

## Começando

- Clone este repositório: git clone https://github.com/micael-ricardo/disruptiva-crud-simples.git
- Navegue até o diretório do projeto: cd disruptiva-crud-simples
- Instale as dependências do projeto usando o Composer:  composer install
- Copie o arquivo de configuração .env.example para .env: cp .env.example .env
- Execute as migrações do banco de dados: php artisan migrate
- Execute as Seeders para popular o banco de dados: php artisan db:seed
- Inicie o servidor: php artisan serve

- Abra o navegador da web e acesse o endereço: http://localhost:8000/ para visualizar o sistema.



