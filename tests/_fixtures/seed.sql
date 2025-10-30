INSERT INTO vendedor (nombre, apellido, telefono)
VALUES ('María', 'López', '55530101'),
       ('Juan', 'Pérez', '55550102');

INSERT INTO propiedad (titulo, precio, imagen,  descripcion, habitaciones, wc, estacionamiento, vendedor_id)
VALUES ('Casa zona 10', 125000, NULL, '3 habitaciones, 2 baños', 2, 2, 2, 1),
       ('Apartamento zona 15', 85000, NULL, '2 habitaciones, 1 parqueo', 3, 3, 3, 2);
