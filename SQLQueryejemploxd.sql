USE ejemplo;
Go
CREATE TABLE EjemploDa (
    ID INT PRIMARY KEY,
    Nombre NVARCHAR(50),
    Edad INT,
    FechaNacimiento DATE,
    SalarioMensual DECIMAL(10, 2),
    Puntuacion FLOAT,
    CodigoPostal VARCHAR(10),
    FechaContratacion DATETIME
);

--
INSERT INTO EjemploDa (ID, Nombre, Edad, FechaNacimiento, SalarioMensual, Puntuacion, CodigoPostal, FechaContratacion)
VALUES 
    (1, 'Juan P�rez', 30, '1992-05-15', 5000.50, 85.5, '12345', '2023-01-15T10:30:00'),
    (2, 'Mar�a Gonz�lez', 25, '1997-08-22', 6200.75, 92.3, '56789', '2022-12-01T15:45:00');
	Select * from EjemploDa;