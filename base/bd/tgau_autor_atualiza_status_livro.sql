CREATE TRIGGER tgau_autor_atualiza_status_livro
AFTER UPDATE ON autor
FOR EACH ROW
BEGIN
    IF NEW.status <> OLD.status THEN
        UPDATE livro_autor
        SET status = NEW.status,
            data_alteracao = CURRENT_TIMESTAMP
        WHERE autor_id = NEW.id;
    END IF;
END;