CREATE OR REPLACE VIEW vw_livros_por_situacao AS
SELECT
    s.id AS situacao_id,
    s.descricao AS situacao,
    COUNT(l.id) AS qtd_livros
FROM biblioteca.situacao s
JOIN biblioteca.livro l ON l.situacao_id = s.id
GROUP BY s.id, s.descricao;