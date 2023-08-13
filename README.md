# vitamina.web - cadastro de oportunidade de vendas


<p align="left">Sistema para cadastro de oportunidades de venda, construído a partir de framework laravel na versão mais recente e estável (composer create-project laravel/laravel vitamina-web-admin) (veio o Laravel v10.18.0). Foi adicionado neste projeto, um modelo de dashboard bootstrap 5 denominado "ample admin". Este dashboard/modelo foi obtido na web (Free Version) e incluído no projeto no diretório public (bootstrap, css, js, plugins). Foi criado um novo laravel-layout com os recursos desse modelo. Após isso, Alguns plugins JS foram adicionados por mim para aumentar a qualidade do projeto: select2, maskedinput e jquery-ui.</p>



## Começando

O projeto, foi construído num ambiente local com os seguintes recursos:

- [ubuntu0.22.04.4]
- [PHP v8.1.2]
- [mysql  Versão 8.0.33]



## Instalação (os ubuntu)

 git clone <br>
 composer install <br>

 curl -fsSL https://deb.nodesource.com/setup_current.x | sudo -E bash - <br>
 apt-get install -y nodejs <br>
 npm install <br>

 cp .env.example .env       (criar um database mysql e colocar as credenciais de conexão ao bd no .env)<br>
 php artisan key:generate <br>
 php artisan migrate        (Na última migration eu adicionei uma chamada p/ popular o BD com factories de produtos, users e clientes) <br>
 php artisan serve <br>
 npm run dev <br>




 


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
