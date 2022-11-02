<?php
if (isset($alert['messageAlert'])) {
    echo '<div class="alert alert-' . $alert['classAlert'] . '">' . $alert['messageAlert'] . '</div>';
}
?>