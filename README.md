# 🎬 Meus Filmes

Sistema de gerenciamento pessoal de filmes desenvolvido em Laravel com interface responsiva.

## 📋 Funcionalidades

- ✅ **Autenticação de usuários** - Sistema de login/registro
- 🎭 **Cadastro de filmes** - Título, diretor, ano, descrição, nota
- 🔍 **Busca avançada** - Por título, diretor, descrição ou ano  
- ✅ **Controle de status** - Marcar como assistido/não assistido
- 📱 **Interface responsiva** - Design adaptável com Tailwind CSS
- 👤 **Dados isolados** - Cada usuário vê apenas seus filmes

## 🚀 Como executar o projeto

### Pré-requisitos
- PHP 8.1+
- Composer
- Node.js 16+
- SQLite (ou MySQL/PostgreSQL)

### 📦 Instalação

1. **Clone o repositório:**
```bash
git clone git@github.com:MarcosViictor/avp1-framework-filmes.git
cd avp1-framework-filmes
```

2. **Instale as dependências do PHP:**
```bash
composer install
```

3. **Instale as dependências do Node.js:**
```bash
npm install
```

4. **Configure o ambiente:**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure o banco de dados:**
   
   **Para SQLite (recomendado para desenvolvimento):**
   ```bash
   touch database/database.sqlite
   ```
   
   **Para MySQL/PostgreSQL:** edite o `.env` com suas credenciais:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=meus_filmes
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```

6. **Execute as migrações:**
```bash
php artisan migrate
```

7. **Compile os assets:**
```bash
npm run build
# ou para desenvolvimento:
npm run dev
```

8. **Inicie o servidor:**
```bash
php artisan serve
```

O sistema estará disponível em: **http://localhost:8000**

## 🛠️ Scripts úteis

```bash
# Desenvolvimento com hot reload
npm run dev

# Build para produção  
npm run build

# Executar testes
php artisan test

# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Gerar dados de teste (opcional)
php artisan db:seed
```

## 🗂️ Estrutura do projeto

```
app/
├── Http/Controllers/
│   └── MovieController.php    # CRUD de filmes
├── Models/
│   ├── Movie.php             # Modelo do filme
│   └── User.php              # Modelo do usuário
database/
├── migrations/
│   └── create_movies_table.php
resources/
├── views/movies/             # Views dos filmes
└── css/                      # Estilos Tailwind
routes/
└── web.php                   # Rotas da aplicação
```

## 🎯 Uso do sistema

1. **Registre-se** ou faça **login**
2. **Adicione filmes** clicando no botão "+ Adicionar Filme"
3. **Gerencie status** usando os botões "✅ Marcar assistido" / "❌ Marcar não assistido"
4. **Busque filmes** usando o campo de pesquisa
5. **Edite** ou **remova** filmes conforme necessário

## 🔧 Tecnologias utilizadas

- **Backend:** Laravel 11, PHP 8.1+
- **Frontend:** Blade Templates, Tailwind CSS, Vite
- **Banco:** SQLite (desenvolvimento) / MySQL (produção)
- **Autenticação:** Laravel Breeze

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.