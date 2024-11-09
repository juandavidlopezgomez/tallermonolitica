
<div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modalMessage"></p>
    </div>
</div>

<style>

.modal {
    display: none; /
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

function showModal(message) {
    document.getElementById("modalMessage").innerText = message;
    document.getElementById("messageModal").style.display = "block";
}


document.querySelector(".close").onclick = function() {
    document.getElementById("messageModal").style.display = "none";
};

/
window.onclick = function(event) {
    if (event.target == document.getElementById("messageModal")) {
        document.getElementById("messageModal").style.display = "none";
    }
};
</script>
