## Desafio SAEP: Gestão para Clínica Veterinária - ClinicAu

**Tecnologias**: PHP 8.5, PostgreSQL, PDO

**Arquitetura**: MVC Artesanal, Autoload PSR-4 via composer

---

## Apresentação do Projeto e Visão Geral

 Esse documentovai descrever o projeto de desenvolvimento de um sistema de gestão para clínica veterinária ClinicAu, com foco em segurança, organização e eficiência. O sistema vai atender as necessidades de veterinários, recepcionistas e gestores de clínicas, proporcionando uma experiência de usuário intuitiva e segura.

- Segurança LGPD
- Sessão com Tempo de Expiração
- Código Limpo e Principio SOLID
- Uso de Credenciais
- Prevenção Anti-Vulnerabilidade (XSS, SQL Injection, CSRF)

### Informações do Sistema
- **Forma de acesso:** email => camila.vet@clinicau.com | senha => 123456
- **Nome do sistema:** ClinicAu - sistema de gestão de clínica veterinária
- **Público alvo:** Veterinários, recepcionistas e gestores de clínica
- **Problema:** Eliminação dos controles manuais, duplicidade de registro, perda de agendamentos, risco de vazamentos de dados (LGPD)

### Requisitos funcionais
- **RF-01:** Autenticação do usuário com sessão e expiração => O sistema deve autenticar o usuário com email e senha, exibindo alerta em caso de erro e a sessão deve expirar automaticamente após 15 minutos de inatividade.
- **RF-02:** Logout => encerramento da sessão, destruindo os dados do usuário
- **RF-03:** tela inicial após o login, deve exibir o nome do usuário logado.
- **RF-04:** Cadastrar informações dos tutores criptografando dados como o CPF.
- **RF-05:** Busca e listagem de tutores 
- **RF-06:** Cadastro dos pets com vínculo em tutor
- **RF-07:** Listagem dos pets 
- **RF-08:** Atualização de Agendamento 

### Requisitos não funcionais
- **RNF-01:** Arquitetura MVC
- **RNF-02:** Mapeamento via PSR-04
- **RNF-03:** Proteção e Criptografia
- **RNF-04:** Armazamento em Banco de Dados Relacional

### Diagrama de entidades relacionais

```mermaid
erDiagram
    title "DER - Sistema de Gestão da ClinicAu"

    usuarios {
        int id PK
        varchar nome
        varchar email UK
        varchar senha_hash
        varchar perfil
        timestamp criado_em
    }

    tutores {
        int id PK
        varchar nome
        varchar cpf_criptografado
        varchar telefone
        varchar email
        timestamp criado_em
    }

    pets {
        int id PK
        int tutor_id FK
        varchar nome
        varchar especie
        varchar raca
        date data_nascimento
        timestamp cadastrado_em
    }

    agendamentos {
        int id PK
        int tutor_id FK
        int pet_id FK
        int usuario_id FK
        date data_agendamento
        time hora_agendamento
        varchar servico
        varchar status
        text observacao
    }

    usuarios ||--o{ agendamentos : "agenda/gerencia"
    tutores ||--o{ pets : "possui (1:N)"
    tutores ||--o{ agendamentos : "responsavel (1:N)"
    pets ||--o{ agendamentos : "paciente (1:N)"
````






## Entregas
- Documentação de software
- DER
- Script de criação e população do banco de dados
- código fonte do **login**
- Código fonte da principal funcionalidade do sistema
- código fonte do gerenciamento de tutor
- código fonte do gerenciamento de pets
- código fonte do gerenciamento de agendamento