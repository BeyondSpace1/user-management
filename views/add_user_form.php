<form method="POST" action="?action=add" id="userForm">
    <label style="color:#000;">Name:</label>
    <input type="text" name="name" required class="input-field"><br>

    <label style="color:#000;">Email:</label>
    <input type="email" name="email" required class="input-field"><br>

    <label style="color:#000;">Password:</label>
    <input type="password" name="password" required class="input-field"><br>

    <button type="submit" class="btn-submit">Add User</button>
    <button type="button" class="cancel-btn">Cancel</button>
</form>

<style>
.input-field { width: 100%; padding: 8px; margin-bottom: 10px; border-radius: 6px; border: none; outline: none; background: rgba(255,255,255,0.3); color: #000; }
.btn-submit { width: 100%; padding: 10px; background: rgba(0,212,255,0.3); border: none; border-radius: 8px; color: white; font-weight: bold; cursor: pointer; transition: 0.3s; }
.btn-submit:hover { background: rgba(0,212,255,0.5); }
.cancel-btn { margin-top: 10px; padding: 8px; background: rgba(255,0,0,0.4); border-radius: 6px; color: white; cursor: pointer; width: 100%; border: none; }
.cancel-btn:hover { background: rgba(255,0,0,0.6); }
</style>
