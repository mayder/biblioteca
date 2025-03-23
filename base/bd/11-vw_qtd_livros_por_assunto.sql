CREATE OR REPLACE VIEW vw_qtd_livros_por_assunto AS
SELECT
    a.id AS assunto_id,
    a.descricao AS assunto,
    COUNT(DISTINCT la.livro_id) AS qtd_livros
FROM assunto a
JOIN livro_assunto la ON la.assunto_id = a.id AND la.status = 1
GROUP BY a.id, a.descricao;
