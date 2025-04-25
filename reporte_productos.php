<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generar Reportes</title>
  <style>
    /* General page styling */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f5f5f5;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    h1 {
      color: #6a1b9a;
      text-align: center;
      font-size: 2.5em;
      margin-bottom: 30px;
    }

    /* Button container */
    .button-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
      align-items: center;
    }

    .report-button {
      font-size: 1.2em;
      padding: 15px 30px;
      color: #fff;
      background-color: #6a1b9a;
      border: none;
      border-radius: 10px;
      width: 250px;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }

    .report-button:hover {
      background-color: #9c4dcc;
      box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
    }

    .report-button:focus {
      outline: none;
    }

  </style>
</head>
<body>

  <h1>¡Bienvenido! Elige un reporte para generar</h1>
  
  <div class="button-container">
    <button class="report-button" onclick="window.location.href='reporte_prod_por_tipo.php'">🛠️ Producción por Tipo</button>
    <button class="report-button" onclick="window.location.href='reporte_stock_min.php'">📉 Productos con Stock Bajo</button>
    <button class="report-button" onclick="window.location.href='reporte_ventas_mensuales.php'">📅 Ventas Mensuales</button>
  </div>

</body>
</html>
