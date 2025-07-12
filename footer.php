<?php if (isset($_SESSION['swal'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let lastNotified = '';

function checkNotifications() {
    fetch("get-notifications.php")
        .then(res => res.json())
        .then(data => {
            const badge = document.querySelector(".notif-badge");
            if (badge) {
                badge.textContent = data.unread > 0 ? data.unread : "";
            }

            // Show SweetAlert if there's a new message
            if (data.unread > 0 && data.latest !== lastNotified) {
                Swal.fire({
                    icon: 'info',
                    title: 'New Notification',
                    text: data.latest,
                    timer: 4000,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false
                });
                lastNotified = data.latest;
            }
        });
}

setInterval(checkNotifications, 5000); // Check every 5 seconds
</script>
<?php endif; ?>
<!-- 🌙 Dark/Light Mode Toggle -->
           <!-- <button class="btn btn-dark" id="modeToggle" title="Toggle Dark/Light Mode">
              <i class="fas fa-moon" id="modeIcon"></i>
            </button>-->
<footer class="bg-dark text-white text-center py-3 mt-5">
    <div class="container">
        <p>&copy; <?= date('Y'); ?> Blog Management System. All rights reserved.</p>
    </div>
</footer>
<script>
   /* // Dark/Light mode toggle
    const toggleBtn = document.getElementById("modeToggle");
    const icon = document.getElementById("modeIcon");
    const body = document.body;

    // Check stored mode
    if (localStorage.getItem("theme") === "light") {
      body.classList.add("light-mode");
      icon.classList.remove("fa-moon");
      icon.classList.add("fa-sun");
    }

    toggleBtn.addEventListener("click", () => {
      body.classList.toggle("light-mode");
      const isLight = body.classList.contains("light-mode");
      icon.classList.toggle("fa-moon", !isLight);
      icon.classList.toggle("fa-sun", isLight);
      localStorage.setItem("theme", isLight ? "light" : "dark");
    });*/
  </script>
<script src="https://cdn.ckeditor.com/ckeditor5/45.0.0/ckeditor5.umd.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
