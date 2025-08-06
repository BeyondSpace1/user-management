<div id="particles-js"></div>

<div class="container">
    <h2>User List</h2>
    <button class="btn-add" id="openAddForm">➕ Add User</button>
    <table id="userTable">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Created At</th><th>Actions</th>
        </tr>
        <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['name']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= $u['created_at'] ?></td>
            <td>
                <a href="?action=view&id=<?= $u['id'] ?>" class="btn-view" data-id="<?= $u['id'] ?>">View</a> |
                <a href="?action=delete&id=<?= $u['id'] ?>" class="btn-delete" data-id="<?= $u['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<!-- External Libraries -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Styles -->
<style>
body { margin: 0; font-family: 'Poppins', sans-serif; background: transparent; }
#particles-js { position: fixed; width: 100%; height: 100%; z-index: -1; }
.container { padding: 20px; margin: 50px auto; width: 90%; backdrop-filter: blur(12px); background: rgba(255,255,255,0.15); border-radius: 15px; box-shadow: 0 4px 30px rgba(0,0,0,0.1); }
h2 { margin-top: 0; color: #456987; text-align: center; }
table { width: 100%; border-collapse: collapse; background: rgba(255,255,255,0.25); border-radius: 10px; overflow: hidden; }
th, td { padding: 10px; text-align: left; color: #123456; }
th { background: rgba(255,255,255,0.3); }
tr:hover { background: rgba(255,255,255,0.15); }
.btn-add { margin-bottom: 10px; padding: 8px 15px; background: rgba(0,212,255,0.3); border-radius: 8px; color: white; font-weight: bold; border: none; cursor: pointer; }
.btn-add:hover { background: rgba(0,212,255,0.5); }
.cancel-btn { margin-top: 10px; padding: 8px; background: rgba(255,0,0,0.4); border-radius: 6px; color: white; cursor: pointer; width: 100%; border: none; }
.cancel-btn:hover { background: rgba(255,0,0,0.6); }
</style>

<!-- Scripts -->
<script>
// Particle.js Config
particlesJS("particles-js", {
    particles: { number: { value: 80 }, size: { value: 3 }, move: { speed: 2 }, line_linked: { enable: true, distance: 150, color: "#000" } }
});

// Open Add Form in SweetAlert2
$('#openAddForm').click(function() {
    $.get('views/add_user_form.php', function(formHtml) {
        Swal.fire({
            title: 'Add User',
            html: formHtml,
            showConfirmButton: false,
            width: 400,
            didOpen: () => {
                anime({ targets: '.swal2-html-container', scale: [0.8, 1], opacity: [0, 1], easing: 'easeOutElastic(1, .8)', duration: 800 });
                $('.cancel-btn').click(() => Swal.close());
                // $('#userForm').submit(function(e) {
                //     e.preventDefault();
                //     $.post('?action=add', $(this).serialize(), function() {
                //         Swal.fire({ icon: 'success', title: 'User Added!', timer: 1500, showConfirmButton: false });
                //         setTimeout(() => location.reload(), 1500);
                //     });
                // });
                $('#userForm').submit(function(e) {
                    e.preventDefault();
                    $.post('?action=add', $(this).serialize(), function(response) {
                        if (response.status === "success") {
                            Swal.fire({ icon: 'success', title: 'User Added!', timer: 1500, showConfirmButton: false });
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                        }
                    }, 'json');
                });
            }
        });
    });
});

// View User in SweetAlert2
$('.btn-view').click(function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    $.getJSON('?action=view&id=' + id, function(user) {
        if (user) {
            Swal.fire({
                title: user.name,
                html: `
                    <p><b>Email:</b> ${user.email}</p>
                    <p><b>Created At:</b> ${user.created_at}</p>
                `,
                icon: 'info',
                confirmButtonText: 'Close'
            });
        }
    });
});

// Delete Confirmation
$('.btn-delete').click(function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    Swal.fire({
        title: 'Are you sure?',
        text: "User will be permanently deleted",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) window.location.href = url;
    });
});


// Table Animation
anime({
    targets: 'tr',
    translateY: [50, 0],
    opacity: [0, 1],
    delay: anime.stagger(100),
    easing: 'easeOutExpo'
});
</script>
