<?php
?>
<script src="<?php echo base_url_new()?>:8000/socket.io/socket.io.js"></script>
<script>
var socket = io.connect('<?php echo base_url_new()?>:8000');
// on message received we print all the data inside the #container div
socket.on('notification', function (data) {
	//alert(data);
	console.log(data);
});
</script>