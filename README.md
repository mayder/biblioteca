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
git clone https://github.com/mayder/biblioteca.git
cd biblioteca
```

2. **Instale as dependências:**

```bash
composer install
```

3. **Crie o banco de dados e importe o script:**

```sql
CREATE DATABASE biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Importe os scripts que estão na pasta `base/bd` em ordem.

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

## 📡 API RESTful

Seu projeto conta com uma API RESTful exposta por meio do módulo `/api`. Abaixo, veja os endpoints disponíveis e como utilizá-los:

### 🔒 Autenticação

> ⚠️ Atualmente a API está aberta (sem autenticação). Para uso em produção, recomenda-se proteger com JWT, OAuth2, ou outro método.

---

### 📘 Autores (`autor`)

**Endpoint Base**:  
`https://seusite.com/api/autor`

| Método | Rota                         | Ação                       |
|--------|------------------------------|----------------------------|
| GET    | `/api/autor`                | Lista todos os autores     |
| GET    | `/api/autor/{id}`           | Detalha um autor específico |
| POST   | `/api/autor`                | Cria um novo autor         |
| PUT    | `/api/autor/{id}`           | Atualiza um autor          |
| DELETE | `/api/autor/{id}`           | Remove um autor            |

---

### 📚 Livros (`livro`)

**Endpoint Base**:  
`https://seusite.com/api/livro`

| Método | Rota                         | Ação                       |
|--------|------------------------------|----------------------------|
| GET    | `/api/livro`                | Lista todos os livros      |
| GET    | `/api/livro/{id}`           | Detalha um livro específico |
| POST   | `/api/livro`                | Cria um novo livro         |
| PUT    | `/api/livro/{id}`           | Atualiza um livro          |
| DELETE | `/api/livro/{id}`           | Remove um livro            |

---

### 🏷️ Assuntos (`assunto`)

**Endpoint Base**:  
`https://seusite.com/api/assunto`

| Método | Rota                         | Ação                        |
|--------|------------------------------|-----------------------------|
| GET    | `/api/assunto`              | Lista todos os assuntos     |
| GET    | `/api/assunto/{id}`         | Detalha um assunto específico |
| POST   | `/api/assunto`              | Cria um novo assunto        |
| PUT    | `/api/assunto/{id}`         | Atualiza um assunto         |
| DELETE | `/api/assunto/{id}`         | Remove um assunto           |

---

> ℹ️ Todas as respostas da API são retornadas em formato JSON.  
> Os campos expostos estão definidos na função `fields()` de cada model.

---

## 📁 Estrutura Importante

- `models/` – Modelos principais das tabelas (`Livro`, `Autor`, `Assunto`, etc) e das views SQL utilizadas em relatórios.
- `controllers/` – Controllers padrão das telas e o controller dedicado ao relatório.
- `views/` – Interfaces principais com Bootstrap 5, gráficos via Chart.js e filtros avançados.
- `modules/api/` – Estrutura da API RESTful (módulo separado com suporte a versionamento).
- `widgets/Alert.php` – Componente customizado de exibição de mensagens com suporte a **Bootstrap Toasts**.
- `assets/custom.js` – Scripts customizados para aplicar máscaras (CPF, CNPJ, Moeda), além de exibir mensagens de erro ou sucesso via Toasts.
- `tests/unit/` – Casos de testes unitários com `PHPUnit`, seguindo abordagem TDD.
- `config/test_db.php` – Configuração para ambiente de testes.

---

## 💡 Observações

- ✅ Projeto construído com foco em clareza, desempenho e boa experiência do usuário.
- ⚙️ Utiliza **AjaxCrud** para criar CRUDs dinâmicos com modais, sem recarregar a página.
- 📊 Todos os relatórios são baseados em **views SQL**, permitindo alta performance e fácil entendimento.
- 🧪 Possui testes com **PHPUnit**, validando regras de negócio e formato dos dados.
- 🔒 Possui **tratamento de erros específicos**, evitando mensagens genéricas em ações sensíveis como exclusões com relacionamentos.
- 🧩 Implementa um **módulo de API RESTful** para integração com sistemas externos.
  - Os modelos usam `fields()` para definir os dados visíveis e já aplicam **formatação** (ex: datas, CPF, CNPJ).
  - Pronto para ser consumido por sistemas externos ou ferramentas como **Postman**, **Insomnia** etc.

---


## ✨ Desenvolvido por

**Breno Mayder da Silva Cruz**  
[LinkedIn](https://www.linkedin.com/in/brenomayder) • [GitHub](https://github.com/mayder)

---
