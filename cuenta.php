<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Cuenta - MusicBot</title>
    <link rel="stylesheet" href="style.css">
<style>
        body { 
            margin: 0; 
            padding: 0; 
            height: 100vh; 
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            
            
        }
        .main-container { height: 100vh; display: flex; flex-direction: column; }
        
        /* Header MÁS GRANDE */
        .user-info-container {
            padding: 8px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            text-align: center;
            flex-shrink: 0;
            margin: 0;
            border: 0;
        }
        
        .user-info-container h1 {
            margin: 4px 0;
            font-size: 18px;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            font-weight: 600;
        }
        
        .user-details {
            font-size: 12px;
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 6px 0;
            color: rgba(255,255,255,0.95);
        }
        
        .user-details p { 
            margin: 0; 
            font-weight: 500;
        }
        
        /* Botón de cerrar sesión */
        .logout-button {
            background: rgb(254, 12, 12);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 6px 16px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 11px;
            margin-top: 4px;
            transition: all 0.3s;
            backdrop-filter: blur(10px);
            font-weight: 500;
        }
        
        .logout-button:hover {
            background: rgba(255,255,255,0.3);
            border-color: rgba(255,255,255,0.5);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .logout-button:active {
            transform: translateY(1px);
        }
        
        /* Chat ocupa todo el espacio */
        .chat-container { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            margin: 0; 
            padding: 0; 
            gap: 0;
        }
        .chat-embed { flex: 1; margin: 0; }
        .chat-embed iframe { width: 100%; height: 100%; border: none; }
        
    </style>

</head>
    <body>
        <div class="chat-container">
        <div class="user-info-container">
        <h1>Bienvenido, <?= htmlspecialchars($usuario['nombre_completo']) ?></h1>
        <div class="user-details">
            <p><strong>Usuario:</strong> <?= htmlspecialchars($usuario['nombre_usuario']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
            <p><strong>País:</strong> <?= htmlspecialchars($usuario['pais']) ?></p>
        </div>
        <button class="logout-button" onclick="window.location.href='logout.php'">
            Cerrar sesión
        </button>
        </div>
        <iframe src="index.php" style="width: 100%; height: 100%; border: none; margin: 0; padding: 0; display: block; vertical-align: top;"></iframe>
    </div>
    </body>
</html>