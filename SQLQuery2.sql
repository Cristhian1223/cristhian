


USE MiTiendaNueva;

CREATE TABLE EjemploTiposDatosNueva (
    ID bigint PRIMARY KEY,
    CadenaUnicode NVARCHAR(100),
    NumeroAproximado FLOAT,
    CadenaBinaria VARBINARY(50),
    FechaYHora DATETIME,
    OtroTipoDeDato SQL_VARIANT,  
    CadenaDeCaracteres VARCHAR(255),
    NumeroExacto NUMERIC(10, 2),
    BitValor BIT,
    EnteroPequeno SMALLINT,
    DecimalPequeno SMALLMONEY,
    Entero INT,
    EnteroMinimo TINYINT
);