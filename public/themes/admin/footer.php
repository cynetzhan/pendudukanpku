	<footer class="container-fluid footer">
		<p class="pull-right">
			Executed in {elapsed_time} seconds, using {memory_usage}.<br />
			Powered by <a href="http://cibonfire.com" target="_blank"><span class="icon-fire"></span>&nbsp;Bonfire</a> <?php echo BONFIRE_VERSION; ?>
		</p>
	</footer>
	<div id="debug"><!-- Stores the Profiler Results --></div>
    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    
	<?php 
 Assets::add_js(array(
 'jquery.min.js',
 'bootstrap.min.js'));

 echo Assets::js(); ?>
</body>
</html>