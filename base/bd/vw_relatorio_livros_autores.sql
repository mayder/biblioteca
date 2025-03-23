CREATE OR REPLACE VIEW vw_relatorio_livros_autores AS
SELECT
    l.id AS livro_id,
    l.uuid AS livro_uuid,
    l.titulo AS livro_titulo,
    l.edicao,
    l.ano_publicacao,
    l.valor_recomendado,
    DATE_FORMAT(l.data_cadastro, '%d/%m/%Y %H:%i') AS livro_data_cadastro,
    DATE_FORMAT(l.data_alteracao, '%d/%m/%Y %H:%i') AS livro_data_alteracao,

    s.descricao AS situacao_livro,

    e.razao_social AS editora_nome,
    e.cnpj AS editora_cnpj,
    e.nome_fantasia AS editora_nome_fantasia,

    a.id AS autor_id,
    a.nome AS autor_nome,
    a.cpf AS autor_cpf,
    a.data_nascimento,
    
    ta.descricao AS tipo_autor,
    (
        SELECT GROUP_CONCAT(asb.descricao ORDER BY asb.descricao SEPARATOR ', ')
        FROM livro_assunto la2
        JOIN assunto asb ON asb.id = la2.assunto_id
        WHERE la2.livro_id = l.id AND asb.status = 1 AND la2.status = 1
    ) AS assuntos

FROM livro l
JOIN livro_autor la ON la.livro_id = l.id AND la.status = 1
JOIN autor a ON a.id = la.autor_id AND a.status = 1
LEFT JOIN tipo_autor ta ON ta.id = la.tipo_autor_id
LEFT JOIN situacao s ON s.id = l.situacao_id
LEFT JOIN editora e ON e.id = l.editora_id
WHERE l.valor_recomendado IS NOT NULL;