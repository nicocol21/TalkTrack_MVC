<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Chatbot - TalkTrack</title>

  <style>
    :root {
      --primary:    #3b82f6;     /* Azul principal vibrante */
      --primary-dark: #2563eb;   /* Azul más oscuro para hover */
      --primary-light: #60a5fa;  /* Azul claro para mensajes del usuario */
      --bg-chat:    #f8fafc;     /* Fondo muy claro con toque gris-azulado */
      --text-dark:  #1e293b;     /* Texto oscuro para buena legibilidad */
      --text-light: #64748b;     /* Texto secundario */
      --bot-msg:    #e2e8f0;     /* Fondo mensajes bot - gris azulado claro */
      --border:     #cbd5e1;     /* Bordes suaves */
      --shadow:     0 10px 25px rgba(59, 130, 246, 0.12);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
      background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .chat-container {
      width: 100%;
      max-width: 420px;
      height: 85vh;
      max-height: 720px;
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: var(--shadow);
      display: flex;
      flex-direction: column;
      border: 1px solid var(--border);
    }

    /* Header */
    .chat-header {
      background: var(--primary);
      color: white;
      padding: 16px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .chat-header h2 {
      font-size: 1.2rem;
      font-weight: 600;
    }

    .avatar {
      width: 38px;
      height: 38px;
      background: rgba(255,255,255,0.25);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
    }

    /* Área de mensajes */
    .messages {
      flex: 1;
      padding: 20px;
      overflow-y: auto;
      background: var(--bg-chat);
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .message {
      padding: 12px 16px;
      border-radius: 18px;
      font-size: 15px;
      line-height: 1.4;
      max-width: 82%;
      word-wrap: break-word;
      position: relative;
    }

    .user {
      background: var(--primary-light);
      color: #0f172a;
      align-self: flex-end;
      border-bottom-right-radius: 5px;
    }

    .bot {
      background: var(--bot-msg);
      color: var(--text-dark);
      align-self: flex-start;
      border-bottom-left-radius: 5px;
    }

    /* Área de entrada */
    .input-area {
      padding: 16px 20px;
      background: white;
      border-top: 1px solid var(--border);
      display: flex;
      gap: 10px;
    }

    .input-area input {
      flex: 1;
      padding: 14px 18px;
      border: 1px solid var(--border);
      border-radius: 30px;
      font-size: 15px;
      outline: none;
      transition: all 0.2s;
    }

    .input-area input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    .input-area button {
      width: 52px;
      height: 52px;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 50%;
      font-size: 1.1rem;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .input-area button:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
    }

    /* Scrollbar bonito */
    .messages::-webkit-scrollbar {
      width: 6px;
    }

    .messages::-webkit-scrollbar-track {
      background: transparent;
    }

    .messages::-webkit-scrollbar-thumb {
      background: #94a3b8;
      border-radius: 3px;
    }

    .messages::-webkit-scrollbar-thumb:hover {
      background: #64748b;
    }
  </style>
</head>
<body>

<div class="chat-container" role="region" aria-label="Chat con TalkTrack">

  <div class="chat-header">
    <div class="avatar">🤖</div>
    <h2>TalkTrack Bot</h2>
  </div>

  <div class="messages" id="messages"></div>

  <div class="input-area">
    <input 
      type="text" 
      id="userInput" 
      placeholder="Escribe tu mensaje..." 
      aria-label="Escribe tu pregunta"
      autocomplete="off"
    />
    <button onclick="sendMessage()">➤</button>
  </div>

</div>

<script>
  const messages = document.getElementById("messages");
  const input = document.getElementById("userInput");

  function addMessage(text, sender) {
    const div = document.createElement("div");
    div.classList.add("message", sender);
    div.textContent = text;
    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
  }

  function botResponse(input) {
    const pregunta = input.toLowerCase().trim();
    
    if (pregunta.includes("hola")) {
      return "¡Hola! Soy el asistente de TalkTrack 😊 ¿En qué te puedo ayudar hoy?";
    }
    if (pregunta.includes("que es") || pregunta.includes("qué es")) {
      return "TalkTrack es una app web para organizar tus tareas y proyectos personales o académicos de forma sencilla y efectiva.";
    }
    if (pregunta.includes("crear cuenta") || pregunta.includes("registrarme")) {
      return "Ve a la sección de registro, pon tu nombre, correo y contraseña. Luego confirma tu email y ¡listo!";
    }
    if (pregunta.includes("olvide") || pregunta.includes("contraseña")) {
      return "Haz clic en \"¿Olvidaste tu contraseña?\" en la pantalla de login. Te llegará un enlace para restablecerla.";
    }
    if (pregunta.includes("seguro") || pregunta.includes("seguridad")) {
      return "Sí, es bastante seguro. Usa autenticación por usuario/contraseña y cada proyecto está protegido por dueño.";
    }
    if (pregunta.includes("consejo") || pregunta.includes("tip")) {
      return "Divide las tareas grandes en pasos pequeños, pon fechas realistas y revisa tu progreso diario. ¡Funciona muy bien! 🚀";
    }
    if (pregunta.includes("tecnologia") || pregunta.includes("tecnologías")) {
      return "Frontend: HTML5 + CSS3 + JavaScript\\nBackend: PHP (MVC)\\nBase de datos: MySQL";
    }
    if (pregunta.includes("datos") || pregunta.includes("base de datos")) {
      return "Todo se guarda en MySQL: usuarios, proyectos, tareas y comentarios.";
    }
    if (pregunta.includes("celular") || pregunta.includes("móvil") || pregunta.includes("teléfono")) {
      return "¡Sí! Es 100% responsive. Funciona perfecto en celular, tablet y computadora.";
    }
    if (pregunta.includes("ventajas") || pregunta.includes("beneficios")) {
      return "Organizas mejor tu tiempo, reduces estrés, mejoras productividad y llevas control real de tus avances.";
    }
    if (pregunta.includes("que dia es") || pregunta.includes("qué día")) {
      return obtenerFechaActual();
    }
    if (pregunta.includes("que hora es") || pregunta.includes("qué hora")) {
      return obtenerHoraActual();
    }
    if (pregunta.includes("salir") || pregunta.includes("chao") || pregunta.includes("adiós")) {
      return "¡Gracias por charlar! Vuelve cuando necesites organizar tus tareas. 👋✨";
    }

    return "Mmm... aún no tengo respuesta para eso 😅 ¿Puedes preguntarme algo más?";
  }

  function sendMessage() {
    const text = input.value.trim();
    if (!text) return;

    addMessage(text, "user");
    input.value = "";

    setTimeout(() => {
      const respuesta = botResponse(text);
      addMessage(respuesta, "bot");
    }, 600);
  }

  input.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      sendMessage();
    }
  });

  // Saludo inicial (opcional)
  setTimeout(() => {
    addMessage("¡Hola! Soy el asistente de TalkTrack 😊 ¿En qué te ayudo hoy?", "bot");
  }, 800);

  function obtenerFechaActual() {
    const hoy = new Date();
    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return "Hoy es " + hoy.toLocaleDateString('es-ES', opciones);
  }

  function obtenerHoraActual() {
    const ahora = new Date();
    return "Son las " + ahora.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
  }
</script>

</body>
</html>
