CREATE OR REPLACE VIEW vw_valor_total_por_editora AS
SELECT
    e.id AS editora_id,
    e.razao_social,
    SUM(l.valor_recomendado) AS valor_total
FROM editora e
JOIN livro l ON l.editora_id = e.id
GROUP BY e.id, e.razao_social;
