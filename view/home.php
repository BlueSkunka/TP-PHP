<?php
// print_r($associations);
?>

<div id="table_container">

  <table class="table table-striped">

    <thead class="thead-dark">
      <tr>
        <td>Nom</td>
        <td>Adresse </td>
      </tr>
    </thead>

    <tbody>

      <?php
      foreach ($associations as $association) {
        echo "<tr>";
        echo "<td>" . $association->getName() . "</td>";
        echo "<td>" . $association->getAdresse() . "</td>";
      }
      ?>

    </tbody>

  </table>

  <table class="table table-striped">

    <thead class="thead-dark">
      <tr>
        <td>Nom</td>
        <td>Adresse </td>
      </tr>
    </thead>

    <tbody>
      <?php
      foreach ($companies as $company) {
        echo "<tr>";
        echo "<td>" . $company->getName() . "</td>";
        echo "<td>" . $company->getAdresse() . "</td>";
      }
      ?></tbody>
  </table>

  <table class="table table-striped">

    <thead class="thead-dark">
      <tr>
        <td>Nom</td>
        <td>Adresse </td>
      </tr>
    </thead>

    <tbody></tbody>
  </table>
</div>