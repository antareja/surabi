<<<<<<< HEAD

<!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Navbar example</h1>
        <p>This example is a quick exercise to illustrate how the default, static navbar and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="../../components/index.html#navbar">View navbar docs &raquo;</a>
        </p>
        <?php
		foreach ($user as $users) {
		 echo '<p>'.$users->username.'</p>';
		 }
		 ?>
      </div>
=======
<?php
		foreach ($user as $users) {
		 echo $users->user_name;
		 }
		 ?>
>>>>>>> branch 'master' of git@github.com:antareja/surabi.git
