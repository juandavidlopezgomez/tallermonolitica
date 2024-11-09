<!-- Modal de Mensajes -->
<div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modalMessage"></p>
    </div>
</div>

<style>
/* Estilos del modal */
.modal {
    display: none; /* Oculto por defecto */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 400px;
    border-radius: 8px;
    text-align: center;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
}
</style>

<script>
// Función para mostrar el modal con un mensaje específico
function showModal(message) {
    document.getElementById("modalMessage").innerText = message;
    document.getElementById("messageModal").style.display = "block";
}

// Cerrar el modal cuando el usuario haga clic en la "x"
document.querySelector(".close").onclick = function() {
    document.getElementById("messageModal").style.display = "none";
};

// Cerrar el modal si el usuario hace clic fuera del contenido del modal
window.onclick = function(event) {
    if (event.target == document.getElementById("messageModal")) {
        document.getElementById("messageModal").style.display = "none";
    }
};
</script>
