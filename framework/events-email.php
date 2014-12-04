<?php
	$email = $_GET['email'];
	$pozycja = $_GET['pozycja'];
?>

<form role="form" id="form" action="" method="post" enctype="multipart/form-data">
	  <div class="form-group">
	    <label for="name">Imię</label>
	    <input type="name" id="imie" class="form-control">
	  </div>
	  <div class="form-group">
	    <label for="surname">Nazwisko</label>
	    <input type="surname" id="nazwisko" class="form-control">
	  </div>
	  <div class="form-group">
	    <label for="email">Email</label>
	    <input type="email" id="email" class="form-control">
	  </div>
	  <div class="form-group">
	    <label for="tresc">Treść</label>
	    <textarea id="tresc" class="form-control" rows="3"></textarea>
	  </div>
	  <div class="form-group">
	    <label for="file">Wyślij plik</label>
	    <input type="file" id="file">
	  </div>
	  <input type="hidden" value="<?php echo $pozycja; ?>" id="stanowisko">
	  <input type="hidden" value="<?php echo $email; ?>" id="email_send">
	  <button type="submit" class="btn btn-primary btn-lg btn-block">Wyślij</button>
</form>

<script type"text/javascript">

$("#form").bind("submit", function () {

	var formData = {
            'imie'              : $('input[id=imie]').val(),
            'nazwisko'          : $('input[id=nazwisko]').val(),
            'email_send'        : $('input[id=email_send]').val(),
            'stanowisko'        : $('input[id=stanowisko]').val(),
            'email'             : $('input[id=email]').val(),
            'tresc'             : $('textarea[id=tresc]').val(),
            'plik'              : $('input[id=file]').val(),
        };
	//data = new FormData($('#form')[0]);
    $.fancybox.showLoading(); // it was $.fancybox.showActivity(); for v1.3.4
    $.ajax({
        type: "POST",
        cache: false,
        url: "http://kdp.frontlabs.pl/wp-content/themes/kdp/framework/email.php", // make sure your path is correct
        data: formData, // your were using $(form).serialize(),
        success: function (data) {
            $.fancybox(data);
        }
    });
    return false;
}); // bind

</script>
