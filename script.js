let menu = document.querySelector("#menu-icon");
let navbar = document.querySelector(".navbar");

menu.addEventListener("click", function () {
    navbar.classList.toggle("active");
});

window.onscroll = () => {
    navbar.classList.remove("active");
}

const toggleModeButton = document.querySelector("#toggle-mode");
const body = document.body;

toggleModeButton.addEventListener("click", function () {
    body.classList.toggle("light-mode");
    body.classList.toggle("dark-mode");
});

const popup = document.getElementById("popup");
const closeBtn = document.getElementById("close-btn");

setTimeout(() => {
    popup.style.display = "block";
}, 3000);  

closeBtn.addEventListener("click", () => {
    popup.style.display = "none";
});

const modal = document.getElementById('purchaseModal');
const closeBtn1 = document.querySelector('.close-modal');

document.querySelectorAll('.fa-cart-plus').forEach(btn => {
    btn.addEventListener('click', () => {
        modal.style.display = 'block';
    });
});

// Close modal
closeBtn1.addEventListener('click', () => {
    modal.style.display = 'none';
});

// Click outside modal to close
window.onclick = (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};
    // Mengambil elemen modal dan tombol untuk membuka modal
    const modal3 = document.getElementById('purchaseModal');
    const openModalButton = document.querySelector('.openModal');
    const closeModalButton = document.querySelector('.close-modal');

    // Fungsi untuk menampilkan modal
    function openModal() {
        modal3.style.display = 'block';
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        modal3.style.display = 'none';
    }

    openModalButton.addEventListener('click', openModal);
    closeModalButton.addEventListener('click', closeModal);

    document.querySelector('.openModal').addEventListener('click', function() {
        document.getElementById('purchaseModal').style.display = 'block';
    });
    
    document.querySelector('.close-modal').addEventListener('click', function() {
        document.getElementById('purchaseModal').style.display = 'none';
    });
    
