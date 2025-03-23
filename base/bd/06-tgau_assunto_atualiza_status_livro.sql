CREATE TRIGGER tgau_assunto_atualiza_status_livro
AFTER UPDATE ON assunto
FOR EACH ROW
BEGIN
    IF NEW.status <> OLD.status THEN
        UPDATE livro_assunto
        SET status = NEW.status,
            data_alteracao = CURRENT_TIMESTAMP
        WHERE assunto_id = NEW.id;
    END IF;
END