// Function to open a modal
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = "block";
}

// Function to close a modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = "none";
}

// Optional: Close the modal if the user clicks anywhere outside of it
window.onclick = function(event) {
    if (event.target.className === "modal") {
        event.target.style.display = "none";
    }
}

<script>
document.getElementById('yourFormId').addEventListener('submit', function(event) {
    var name = document.forms["yourForm"]["name"].value;
    var pattern = /^[A-Za-z0-9]+$/;
    if (!pattern.test(name)) {
        alert("Only letters and numbers allowed in the name.");
        event.preventDefault();
    }
});