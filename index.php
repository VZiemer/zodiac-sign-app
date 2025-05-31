<?php include('layouts/header.php'); ?>

<div class="card">
  <h1>Descubra seu Signo</h1>
  <form method="POST" action="show_zodiac_sign.php">
    <div class="mb-3">
      <label for="data_nascimento" class="form-label">Data de Nascimento</label>
      <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Consultar</button>
    </div>
  </form>
</div>
