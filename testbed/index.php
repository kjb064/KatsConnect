<?php
//This section and the one below are reusable php sections for making any new page.
    include_once 'header.php';
    ?>
    <main>
        <div class="main-wrapper">
            <section class="main-container">
                <h2>KatsConnect Home</h2>

                <?php
                if (!isset($_SESSION['id'])) {
                    echo '<p class="login-status">You are logged out!</p>';
                }
                else if (isset($_SESSION['id'])){
                    echo '<p class="login-status">You are logged in!</p>';
                }
                ?>

            </section>
        </div>
    </main>

<?php
    require 'footer.php';
?>
