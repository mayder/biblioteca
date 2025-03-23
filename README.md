# 📚 Biblioteca Digital

Sistema desenvolvido em Yii2 com foco em gerenciamento de livros, autores e assuntos. Possui painel interativo, relatórios exportáveis, gráficos dinâmicos, TDD e tratamento de erros.

---

## ✅ Funcionalidades

- CRUD completo para:
  - Livros
  - Autores
  - Assuntos
- Painel com gráficos (Chart.js)
- Filtros avançados com Select2 e DatePicker
- Máscaras para CPF, CNPJ e moeda
- Relatório exportável (CSV/Excel)
- Relacionamento entre entidades
- Toasts com feedback de ações
- Testes automatizados (PHPUnit)
- Tratamento de erros de integridade referencial

---

## 📦 Tecnologias Utilizadas

- PHP 8.1+
- Yii2 Framework
- Bootstrap 5
- jQuery + Inputmask + Select2
- Chart.js
- PHPUnit
- MySQL

---

## 🛠️ Requisitos

- PHP 8.0+
- Composer
- MySQL 5.7+ ou superior

---

## 🚀 Instalação

1. **Clone o repositório:**

```bash
git clone https://github.com/seu-usuario/biblioteca-digital.git
cd biblioteca-digital
```

2. **Instale as dependências:**

```bash
composer install
```

3. **Crie o banco de dados e importe o script:**

```sql
CREATE DATABASE biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Importe o arquivo `database.sql` (fornecido na raiz do projeto).

4. **Configure a conexão com o banco:**
Edite o arquivo `config/db.php`:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=biblioteca',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
];
```

---

## 🧪 Rodando os Testes

1. Configure o banco de testes em `config/test_db.php`:

```php
$db['dsn'] = 'mysql:host=localhost;dbname=biblioteca';
$db['username'] = 'root';
$db['password'] = '';
return $db;
```

2. Execute os testes:

```bash
./vendor/bin/phpunit tests/unit/models/LivroTest.php
```

---

## 📊 Relatórios

Acesse o menu **Relatórios** para gerar e exportar os dados da view `vw_relatorio_livros_autores`.

Formatos disponíveis: **CSV, Excel, HTML** (PDF pode ser habilitado).

---

## 🔐 Acesso ao Sistema

- O sistema não possui controle de login neste desafio.
- Caso precise, a estrutura de autenticação pode ser facilmente adicionada.

---

## 📁 Estrutura Importante

- `models/` - Contém os modelos das tabelas e das views
- `controllers/` - Contém os controllers padrão e do relatório
- `views/` - Contém todas as interfaces
- `widgets/Alert.php` - Toast de mensagens padrão
- `assets/custom.js` - Máscaras e feedback JS

---

## 💡 Observações

- O projeto foi desenvolvido com foco em clareza, desempenho e boa UX.
- Utiliza **AjaxCrud** para operações modais e interativas.
- Segue os princípios do **TDD** com testes reais.
- Utiliza **views no banco** para performance e clareza nos relatórios.

---

## ✨ Desenvolvido por

**Breno Mayder da Silva Cruz**  
[LinkedIn](https://www.linkedin.com/in/brenomayder) • [GitHub](https://github.com/mayder)

---
