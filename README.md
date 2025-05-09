Projeto Laravel com Docker Compose, PHP-FPM, Nginx e MySQL

Este repositório contém um projeto Laravel configurado para ser executado com Docker Compose, PHP-FPM, Nginx e MySQL. Abaixo estão as instruções para configurar e rodar o projeto em um ambiente de desenvolvimento local.

Pré-requisitos

Antes de começar, você precisará ter as seguintes ferramentas instaladas em sua máquina:

-   Docker
    
-   Docker Compose
    
-   Git
    
Clone o repositório do seu projeto Laravel:

git clone https://github.com/JoaoVitor2310/tms
cd tms

2.  Configurar variáveis de ambiente
    
Copie o arquivo .env.example para um novo arquivo .env:

cp .env.example .env

Edite o arquivo .env e configure as variáveis de ambiente, utilizando o docker-compose, fica:

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret

3.  Construir e iniciar os contêineres com Docker Compose
    

No diretório raiz do projeto, execute o seguinte comando para construir os contêineres Docker e iniciar o ambiente:

docker-compose up --build -d

Isso criará os contêineres para PHP-FPM, Nginx e MySQL. O parâmetro -d faz com que o Docker Compose execute os contêineres em segundo plano.

7.  Acessar o aplicativo
    
Após todas as etapas acima, o projeto Laravel estará rodando em http://localhost:8000. Você pode acessar o aplicativo no seu navegador e verificar se tudo está funcionando.