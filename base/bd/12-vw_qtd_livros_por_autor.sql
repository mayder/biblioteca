CREATE OR REPLACE VIEW vw_qtd_livros_por_autor AS
SELECT
    a.id AS autor_id,
    a.nome AS autor_nome,
    COUNT(DISTINCT la.livro_id) AS qtd_livros
FROM autor a
JOIN livro_autor la ON la.autor_id = a.id AND la.status = 1
GROUP BY a.id, a.nome;
