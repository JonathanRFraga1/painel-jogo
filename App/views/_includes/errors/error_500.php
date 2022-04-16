<p>500</p>
<p>Internal Server Error</p>

<?php
if (DEBUG) {
    echo '<p>' . $this->error->getMessage() . '</p>';
    echo '<p>' . $this->error->getFile() . '</p>';
    echo '<p>' . $this->error->getLine() . '</p>';
    echo '<p>' . $this->error->getTraceAsString() . '</p>';
}
