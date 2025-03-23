CREATE OR REPLACE VIEW vw_livros_por_ano_publicacao AS
SELECT
    l.ano_publicacao,
    COUNT(*) AS qtd_livros
FROM livro l
GROUP BY l.ano_publicacao
ORDER BY l.ano_publicacao;
