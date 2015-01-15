<?php
require_once("../../../../wp-load.php");
$pozycja = $_GET['pozycja'];
$id = $_GET['id'];

?>

<form role="form" id="form" action="<?php bloginfo('template_url'); ?>/framework/email.php" method="post"
      enctype="multipart/form-data">
    <div class="form-group">
        <label for="imie">Imię</label>
        <input type="text" id="imie" name="imie" class="form-control"/>
        <label class="error" for="imie" id="imie_error">To pole jest wymagane.</label>
    </div>
    <div class="form-group">
        <label for="nazwisko">Nazwisko</label>
        <input type="text" id="nazwisko" name="nazwisko" class="form-control"/>
        <label class="error" for="nazwisko" id="nazwisko_error">To pole jest wymagane.</label>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" class="form-control"/>
        <label class="error" for="email" id="email_error">To pole jest wymagane.</label>
    </div>
    <div class="form-group">
        <label for="tresc">Treść</label>
        <textarea id="tresc" name="tresc" class="form-control" rows="3"></textarea>
        <label class="error" for="tresc" id="tresc_error">To pole jest wymagane.</label>
    </div>
    <div class="form-group">
        <label for="file">Wyślij plik</label>
        <input type="file" id="file" name="file"/>
    </div>
    <input type="hidden" value="<?php echo $pozycja; ?>" id="stanowisko" name="stanowisko"/>
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/>
    <button type="submit" class="btn btn-primary btn-lg btn-block send">Wyślij</button>
</form>

<script type="text/javascript">


    $(function () {
        $('.error').hide();
        $("#form").submit(function (e) {

            $('.error').hide();
            var imie = $("input#imie").val();
            if (imie == "") {
                $("label#imie_error").show();
                $("input#imie").focus();
                return false;
            }

            var nazwisko = $("input#nazwisko").val();
            if (nazwisko == "") {
                $("label#nazwisko_error").show();
                $("input#nazwisko").focus();
                return false;
            }

            var email = $("input#email").val();
            if (email == "") {
                $("label#email_error").show();
                $("input#email").focus();
                return false;
            }

            var tresc = $("textarea#tresc").val();
            if (tresc == "") {
                $("label#tresc_error").show();
                $("textarea#tresc").focus();
                return false;
            }


            var formObj = $(this);
            var formURL = formObj.attr("action");
            var formData = new FormData(this);


            $.fancybox.showLoading();
            $.ajax({
                url: formURL,
                type: 'POST',
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {
                    $.fancybox(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
            e.preventDefault();

        });
    });


</script>
