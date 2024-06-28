<?php 

session_start();

session_destroy();

echo "
    <script>
        alert('Terima kasih!');
        location.href='index.php';
    </script>
";