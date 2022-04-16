<p>404</p>
<p>Page not found</p>

<?php
if (DEBUG) {
    echo '<p>' . $_SERVER['PATH_INFO'] . '</p>';
    echo '<p>' . $_SERVER['REQUEST_URI'] . '</p>';
}
