BEGIN
    DECLARE discount_value DECIMAL(10,2);

    SET discount_value = IFNULL(NEW.discount, 0);

    IF discount_value = 0 THEN
        SET NEW.total = NEW.price;
    ELSE
        SET NEW.total = NEW.price - (NEW.price * discount_value / 100);
    END IF;
END
