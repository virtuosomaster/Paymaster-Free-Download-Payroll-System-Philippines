<?php 
$dependant      = new Family;
$dependant_data = $dependant->get_dependant_data($user_id); ?>

<script>
  jQuery(document).ready(function ($) {
    $('#pit-dependant-table').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });
</script>